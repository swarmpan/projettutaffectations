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

class AlgoAPSTest extends TestCase
{
    public $grapheTest;

    public function setUp() {
        $this->grapheTest = new GrapheAffectation();

        // creation de 6 etudiants
        for ($i = 0; $i < 6; $i++) {
            $e = new Etudiant($i);
            $this->grapheTest->ajouterEtudiant($e);
        }

        // creation de 3 projets
        for ($i = 0; $i < 3; $i++) {
            $p = new Projet();
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

    public function testTousEtudiantsAffectes()
    {

    }

    public function testEstAffecte()
    {

    }
}
