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

    // Map etudiants -> projets
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

    public function nbEtudiantsParProjet(Projet $p): int {
        $compteur = 0;
        foreach ($this->affectations as $affect) {
            if ($affect[0] === $p) {
                $compteur++;
            }
        }
        return $compteur;
    }

    public function supprimerAffectation(Etudiant $e) {
        unset($this->affectations[$e->email]);
    }

    public function estAffecte(Etudiant $e): bool {
        $arcsFrom = $this->getArcsFrom($e);
        return count($arcsFrom) > 0;
    }

    public function tousEtudiantsAffectes(): bool {
        foreach ($this->etudiants as $etudiant) {
            if (! $this->estAffecte($etudiant))
                return false;
        }
        return true;
    }
}