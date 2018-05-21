<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 21/05/2018
 * Time: 15:15
 */

require_once ('GrapheAffectation.php');

abstract class TestSet
{
    public function generateGraph(): GrapheAffectation {
        $grapheTest = new GrapheAffectation();

        // creation de 20 etudiants
        for ($i = 0; $i < $this->nbEtudiants; $i++) {
            $e = new Etudiant((string)$i);
            $grapheTest->ajouterEtudiant($e);
        }

        // creation de 6 projets
        for ($i = 0; $i < $this->nbProjets; $i++) {
            $p = new Projet("proj" . ($i + 1));
            $grapheTest->ajouterProjet($p);
        }

        // attribution des voeux
        for ($e = 0; $e < $this->nbEtudiants; $e++) {
            for ($numvoeu = 0; $numvoeu < count($this->voeux[$e]); $numvoeu++) {
                $numProjet = ($this->voeux[$e][$numvoeu]) - 1;
                $arc = new Arc($grapheTest->etudiants[$e], $grapheTest->projets[$numProjet],
                    $numvoeu + 1);
                $grapheTest->ajouterArc($arc);
            }
        }

        return $grapheTest;
    }
}

class SmallTestSet extends TestSet
{
    /**
     * SmallTestSet constructor.
     */
    public function __construct()
    {
        $this->voeux = [
            [1,2,3],
            [3,1,2],
            [2,3,1],
            [1,3,2],
            [1,2,3],
            [2,1,3]
        ];

        $this->nbEtudiants = count($this->voeux);
        $this->nbProjets = 3;
    }
}

class RandomTestSet extends TestSet
{
    /**
     * RandomTestSet constructor.
     */
    public function __construct()
    {
        $this->voeux = [
            [3, 5, 6, 1, 4],
            [1, 4, 3, 2, 5],
            [2, 1, 3, 5, 6],
            [2, 1, 5, 4, 3],
            [5, 1, 6, 2, 4],
            [1, 3, 5, 6, 4],
            [6, 4, 5, 3, 1],
            [3, 6, 5, 1, 2],
            [4, 3, 2, 5, 6],
            [1, 3, 5, 4, 2],
            [6, 1, 5, 4, 3],
            [4, 6, 1, 5, 3],
            [3, 5, 4, 1, 2],
            [3, 2, 1, 5, 4],
            [4, 5, 2, 1, 3],
            [3, 1, 4, 6, 5],
            [5, 3, 6, 4, 1],
            [1, 2, 5, 6, 3],
            [2, 6, 5, 3, 4],
            [4, 6, 1, 3, 2]
        ];

        $this->nbEtudiants = count($this->voeux);
        $this->nbProjets = 6;
    }
}