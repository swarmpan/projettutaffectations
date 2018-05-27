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

// données parfaitement uniformes
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

// un peu modifié pour être équiprobable mais quand même généré de manière uniforme
class InequalTestSet extends TestSet
{
    public function __construct()
    {
        $this->voeux = [
            [3, 5, 6, 1, 4],
            [1, 4, 3, 2, 5],
            [3, 1, 2, 5, 6],
            [2, 1, 5, 4, 3],
            [5, 1, 6, 2, 4],
            [1, 3, 5, 6, 4],
            [3, 4, 5, 6, 1],
            [3, 4, 5, 1, 2],
            [4, 3, 2, 5, 6],
            [4, 3, 5, 1, 2],
            [3, 1, 5, 4, 6],
            [4, 6, 1, 5, 3],
            [3, 5, 4, 1, 2],
            [3, 2, 1, 5, 4],
            [4, 5, 2, 1, 3],
            [3, 1, 4, 6, 5],
            [5, 3, 6, 4, 1],
            [1, 2, 5, 6, 3],
            [2, 6, 5, 3, 4],
            [4, 6, 1, 3, 2],
            [3, 4, 5, 1, 2],
            [4, 3, 2, 5, 6],
            [4, 3, 6, 1, 2],
            [3, 1, 5, 4, 6]
        ];

        $this->nbEtudiants = count($this->voeux);
        $this->nbProjets = 6;
    }
}

// Jeu 1 du excel
class Jeu1 extends TestSet
{
    public function __construct()
    {
        $this->voeux = [
            [1, 2, 4, 3, 5],//1
            [2, 1, 5, 4, 3],
            [1, 5, 3, 2, 4],
            [2, 1, 4, 3, 5],
            [1, 2, 3, 4, 5],//5
            [2, 3, 4, 1, 5],
            [1, 5, 3, 2, 4],
            [2, 5, 1, 3, 4],
            [1, 3, 4, 5, 2],
            [2, 3, 5, 1, 4],//10
            [1, 4, 2, 5, 3],
            [2, 4, 1, 5, 3],
            [1, 2, 3, 4, 5],
            [2, 3, 5, 1, 4],
            [1, 4, 2, 3, 5],//15
            [2, 3, 5, 1, 4],
            [1, 4, 2, 5, 3],
            [3, 5, 1, 4, 2],
            [3, 1, 2, 4, 5],
            [5, 1, 4, 2, 3],//20
            [3,1,5,2,4],
            [4,2,1,3,5],
            [4,2,3,5,1] //23
        ];

        $this->nbEtudiants = count($this->voeux);
        $this->nbProjets = 5; // numerotes de 1 a 5
    }
}

// Jeu 2.1 du excel
class Jeu21 extends TestSet
{
    public function __construct()
    {
        $this->voeux = [
            [11,14,3,6,9],//1
            [3,6,5,4,12],
            [3,13,9,12,8],
            [4,6,3,10,5],
            [5,9,1,2,0],//5
            [4,7,13,12,3],
            [3,8,7,9,2],
            [5,12,11,13,10],
            [6,13,4,12,3],
            [7,4,13,6,9],//10
            [12,2,9,8,7],
            [5,1,4,3,2],
            [11,7,8,2,3],
            [7,14,8,11,6],
            [7,11,5,8,2], //15
            [8,0,9,7,3],
            [10,8,4,14,5],
            [13,6,3,10,12],
            [8,11,13,14,7],
            [3,7,6,0,4],//20
            [4,1,13,3,2],
            [12,7,8,9,11],
            [10,3,0,4,1],
            [8,1,7,3,12],
            [1,12,6,8,3],//25
            [4,11,10,9,0],
            [6,1,5,2,3],
            [10,1,9,3,0],
            [6,10,12,1,14],
            [6,9,8,4,2],//30
            [3,9,11,4,12],
            [6,0,1,3,2],
            [7,13,1,9,14],
            [7,12,11,14,13],
            [8,2,4,7,3],//35
            [7,8,3,1,9],
            [2,10,5,12,0],
            [8,13,14,11,3],
            [5,12,14,11,2],
            [7,11,2,8,3],//40
            [4,13,7,6,9],
            [9,8,0,11,7],
            [1,11,13,8,14],
            [10,13,6,9,5],
            [3,10,4,1,2], //45
            [7,3,6,10,0],
            [10,8,11,7,13],
            [12,3,6,1,2],
            [6,11,7,4,8],
            [5,11,14,13,10],//50
            [6,14,9,7,5],
            [8,2,1,6,13],
            [9,5,0,6,1],
            [11,2,7,10,6],
            [6,11,4,3,5]//55
        ];

        $this->nbEtudiants = count($this->voeux);
        $this->nbProjets = 15; // numerote de 0 a 14
    }
}

