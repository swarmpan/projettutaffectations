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

    public $affectations;


    public function __construct()
    {
        parent::__construct();
        $this->affectations = array();
    }

    public function ajouterEtudiant(Etudiant $e) {
        $this->ajouterSommet($e);
        $this->etudiants[] = $e;
    }

    public function ajouterProjet(Projet $p) {
        $this->ajouterSommet($p);
        $this->projets[] = $p;
    }

    public function affecterVoeu(Etudiant $e, Projet $p, int $rang) {
        $this->affectations[$e->email] = [$p, $rang];
    }
}