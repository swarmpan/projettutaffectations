<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 02/03/2018
 * Time: 10:39
 */

require_once ('Graphe.php');

class GrapheAffectation extends Graphe
{
    public $etudiants;
    public $projets;

    public function ajouterEtudiant(Etudiant $e) {
        $this->ajouterSommet($e);
        $this->etudiants[] = $e;
    }

    public function ajouterProjet(Projet $p) {
        $this->ajouterSommet($p);
        $this->projets[] = $p;
    }
}