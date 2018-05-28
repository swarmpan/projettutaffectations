<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 02/03/2018
 * Time: 09:18
 */

declare(strict_types=1);

require_once('Graphe.php');
require_once('GrapheAffectation.php');
require_once('Etudiant.php');
require_once('Projet.php');
require_once('Sommet.php');
require_once('Arc.php');

use PHPUnit\Framework\TestCase;

class GrapheTest extends TestCase
{

    public function testConstruct()
    {
        $graphe = new Graphe();
        $this->assertInstanceOf("Graphe", $graphe);
        $this->assertEmpty($graphe->getSommets());
        return $graphe;
    }

    public function testAjoutSommet()
    {
        $graphe = new Graphe();

        $s1 = new Sommet();
        $s2 = new Sommet();

        $graphe->ajouterSommet($s1);
        $graphe->ajouterSommet($s2);

        $sommets = $graphe->getSommets();

        $this->assertCount(2, $sommets);
        $this->assertContains($s1, $sommets);
        $this->assertContains($s2, $sommets);
        $this->assertSame($sommets[1], $s2);

        return $graphe;
    }

    public function testAjoutArc()
    {
        $graphe = new Graphe();

        $s1 = new Sommet();
        $s2 = new Sommet();
        $s3 = new Sommet();

        $graphe->ajouterSommet($s1);
        $graphe->ajouterSommet($s2);
        $graphe->ajouterSommet($s3);
        $this->assertNotSame($s1, $s2);

        $a1 = new Arc($s1, $s2, 1);
        $a2 = new Arc($s2, $s3, 2);
        $a3 = new Arc($s1, $s3, 5);
        $this->assertSame($a2->sommetFrom, $s2);
        $this->assertNotSame($a2->sommetFrom, $s1);

        $graphe->ajouterArc($a1);
        $graphe->ajouterArc($a2);
        $graphe->ajouterArc($a3);

        $this->assertCount(3, $graphe->getArcs());
        $this->assertSame($graphe->getArcs()[2], $a3);
        $this->assertSame($graphe->getArcs()[0]->sommetFrom, $s1);
        $this->assertNotSame($graphe->getArcs()[1]->sommetFrom, $s1);
        return $graphe;
    }

    /**
     * @depends testAjoutArc
     */
    public function testRechercheArc(Graphe $graphe)
    {
        $arcs = $graphe->getArcsFrom($graphe->getSommets()[0]);
        $this->assertCount(2, $arcs);
        $arcs = $graphe->getArcsFrom($graphe->getSommets()[1]);
        $this->assertCount(1, $arcs);

        $s2 = $graphe->sommets[1];
        $this->assertEquals($s2, $arcs[0]->sommetFrom);
        $this->assertEquals(2, $arcs[0]->getCout());
    }

    /**
     * @depends testAjoutArc
     */
    public function testRechercheCout(Graphe $graphe) {
        $arcTrouve = $graphe->getArcCout($graphe->sommets[0], 1);
        $this->assertEquals($graphe->arcs[0], $arcTrouve);
        $arcTrouve = $graphe->getArcCout($graphe->sommets[0], 5);
        $this->assertEquals($graphe->arcs[2], $arcTrouve);
        $arcTrouve = $graphe->getArcCout($graphe->sommets[0], 4);
        $this->assertNull($arcTrouve);
    }
}
