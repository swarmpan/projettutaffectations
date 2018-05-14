<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 02/03/2018
 * Time: 10:45
 */

use PHPUnit\Framework\TestCase;

require_once ('GrapheAffectation.php');
require_once ('Etudiant.php');
require_once ('Projet.php');
require_once ('AlgoAPS.php');

class AlgoAPSTest extends TestCase
{
    public $grapheTest;

    public function setUp() {
        $this->grapheTest = new GrapheAffectation();

        // creation de 6 etudiants
        for ($i = 0; $i < 6; $i++) {
            $e = new Etudiant((string)$i);
            $this->grapheTest->ajouterEtudiant($e);
        }

        // creation de 3 projets
        for ($i = 0; $i < 3; $i++) {
            $p = new Projet("proj${i}");
            $this->grapheTest->ajouterProjet($p);
        }

        $voeux = [
            [1,2,3],
            [3,1,2],
            [2,3,1],
            [1,3,2],
            [1,2,3],
            [2,1,3]
        ];

        // attribution des voeux
        for ($e = 0; $e < 6; $e++) {
            for ($p = 0; $p < 3; $p++) {
                $arc = new Arc($this->grapheTest->etudiants[$e], $this->grapheTest->projets[$p],
                    $voeux[$e][$p]);
                $this->grapheTest->ajouterArc($arc);
            }
        }
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
            print $etud->login . " affecte a " . $etud->affectation->sommetTo->titre . "\n";
        }
    }


}
