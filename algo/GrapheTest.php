<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 02/03/2018
 * Time: 09:18
 */

declare(strict_types=1);

require_once ('Graphe.php');
require_once ('Sommet.php');

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

    /**
     * @depends testConstruct
     */
    public function testAjoutSommet(Graphe $graphe)
    {
        $s1 = new Sommet();
        $s2 = new Sommet();

        $graphe->ajouterSommet($s1);
        $graphe->ajouterSommet($s2);

        $sommets = $graphe->getSommets();

        $this->assertEquals(count($sommets), 2);
        $this->assertContains($s1, $sommets);
        $this->assertContains($s2, $sommets);
        $this->assertEquals($sommets[1], $s2);

        return $graphe;
    }

    /**
     * @depends testAjoutSommet
     */
    public function testAjoutArc(Graphe $graphe)
    {
        
    }


}
