<?php
/**
 * Created by PhpStorm.
 * User: conzatei
 * Date: 04/04/18
 * Time: 17:38
 */

require_once('GrapheAffectation.php');

function testAffectationEtudiant()
{
    $graphe = new GrapheAffectation();

    $p = new Projet();
    $graphe->ajouterProjet($p);


    for ($i = 0; $i < 6; $i++) {
        $e = new Etudiant($i);
        $graphe->ajouterEtudiant($e);
        $graphe->affecterVoeu($e, $p, 1);
        if(! $graphe->estAffecte($e))
            echo "Erreur dans l'affectation";
    }

    if($graphe->nbEtudiantsParProjet($p) != 6) {
        echo "Erreur dans le nb d'étudiants par projet";
    }
}

function testAffectationProjet()
{
    $graphe = new GrapheAffectation();

    $p0 = new Projet();
    $graphe->ajouterProjet($p0);
    $p1 = new Projet();
    $graphe->ajouterProjet($p1);


    for ($i = 0; $i < 6; $i++) {
        $e = new Etudiant($i);
        $graphe->ajouterEtudiant($e);
        if ($i<3) {
            $graphe->affecterVoeu($e, $p0, 1);
        }
        else {
            $graphe->affecterVoeu($e, $p1, 1);
        }
    }

    if($graphe->nbEtudiantsParProjet($p0) != 3) {
        echo "Erreur dans le nb d'étudiants par projet";
    }
    if($graphe->nbEtudiantsParProjet($p1) != 3) {
        echo "Erreur dans le nb d'étudiants par projet";
    }
}

function testSupprimerEtudiant ()
{
    $graphe = new GrapheAffectation();

    $p = new Projet();
    $graphe->ajouterProjet($p);

    $i = 0;
    $e = new Etudiant($i);
    $graphe->ajouterEtudiant($e);
    $graphe->affecterVoeu($e, $p, 1);
    if(! $graphe->estAffecte($e))
        echo "Erreur dans l'affectation";
    if($graphe->nbEtudiantsParProjet($p) != 1) {
        echo "Erreur dans le nb d'étudiants par projet";
    }
    $graphe->supprimerAffectation($e);
    if(! $graphe->estAffecte($e))
        echo "Erreur dans la suppression de l'affectation par étudiant";
    if($graphe->nbEtudiantsParProjet($p) != 1) {
        echo "Erreur dans la suppression de l'affectation par projet";
    }


}