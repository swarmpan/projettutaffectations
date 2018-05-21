<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 02/03/2018
 * Time: 10:45
 */

use PHPUnit\Framework\TestCase;

require_once('GrapheAffectation.php');
require_once('Etudiant.php');
require_once('Projet.php');
require_once('AlgoAPS.php');
require_once ('TestSet.php');

class AlgoAPSTest extends TestCase
{
    public $grapheTest;

    public function setUp() {
        $testset = new SmallTestSet();
        $this->grapheTest = $testset->generateGraph();
    }

    public function testGraphe()
    {
        $this->assertInstanceOf("GrapheAffectation", $this->grapheTest);
        $this->assertCount(6, $this->grapheTest->etudiants);
        $this->assertCount(3, $this->grapheTest->projets);
    }

    public function testAffectation()
    {
        $e1 = $this->grapheTest->etudiants[0];
        $e2 = $this->grapheTest->etudiants[1];
        $p1 = $this->grapheTest->projets[0];

        $this->grapheTest->affecterVoeu($e1, $p1, 1);

        $this->assertTrue($this->grapheTest->estAffecte($e1));
        $this->assertFalse($this->grapheTest->estAffecte($e2));
        $this->assertFalse($this->grapheTest->tousEtudiantsAffectes());
    }

    public function testAlgoAPS()
    {
        $algo = new AlgoAPS();
        $algo->run($this->grapheTest);
        $this->assertTrue($this->grapheTest->tousEtudiantsAffectes());
        foreach ($this->grapheTest->etudiants as $etud) {
            print $etud->login . " affecte a " . $etud->affectation->sommetTo->titre . ", voeu n° " . $etud->affectation->getCout() . "\n";
        }
        $this->assertEquals($this->grapheTest->projets[0], $this->grapheTest->etudiants[0]->affectation->sommetTo);
        $this->assertEquals($this->grapheTest->projets[2], $this->grapheTest->etudiants[1]->affectation->sommetTo);
        $this->assertEquals($this->grapheTest->projets[1], $this->grapheTest->etudiants[5]->affectation->sommetTo);
    }

    public function testCapaciteAtteinte()
    {
        $p0 = $this->grapheTest->projets[0];
        $p0->capaciteMax = 2;

        $algo = new AlgoAPS();
        $algo->run($this->grapheTest);
        $this->assertTrue($this->grapheTest->tousEtudiantsAffectes());
        foreach ($this->grapheTest->etudiants as $etud) {
            print $etud->login . " affecte a " . $etud->affectation->sommetTo->titre . ", voeu n° " . $etud->affectation->cout . "\n";
        }
        $this->assertCount(2, $this->grapheTest->etudiantsAffectesAuProjet($p0));
    }

    public function testBigDataset()
    {
        $graphe = (new InequalTestSet())->generateGraph();
        //$graphe->projets[2]->capaciteMax = 3;
        //$graphe->projets[3]->capaciteMax = 3;
        $algo = new AlgoAPS();
        $algo->run($graphe);
        $this->assertTrue($graphe->tousEtudiantsAffectes());
        foreach ($graphe->etudiants as $etud) {
            print $etud->login . " affecte a " . $etud->affectation->sommetTo->titre . ", voeu n° " . $etud->affectation->cout . "\n";
        }
    }
}
