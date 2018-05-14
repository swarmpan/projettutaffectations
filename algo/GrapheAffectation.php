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


    public function __construct()
    {
        parent::__construct();
    }
    
    public function getArrayProjets() 
    {
        return $this->projets;
    }

    public function getArrayEtudiants() 
    {
        return $this->etudiants;
    }

    public function ajouterEtudiant(Etudiant $e) {
        $this->ajouterSommet($e);
        $this->etudiants[] = $e;
    }

    public function ajouterProjet(Projet $p) {
        $this->ajouterSommet($p);
        $this->projets[] = $p;
    }

    public function affecterVoeu(Etudiant $e, Projet $p) {
        $e->affectation = $this->getArcFromTo($e, $p);
    }

    public function nbEtudiantsParProjet(Projet $p): int {
        $compteur = 0;
        foreach ($this->etudiants as $etud) {
            if ($this->estAffecte($etud) && $etud->affectation->sommetTo === $p)
                $compteur++;
        }
        return $compteur;
    }

    public function supprimerAffectation(Etudiant $e) {
        $e->affectation = null;
    }

    public function estAffecte(Etudiant $e): bool {
        return $e->affectation != null;
    }

    public function tousEtudiantsAffectes(): bool {
        foreach ($this->etudiants as $etudiant) {
            if (! $this->estAffecte($etudiant))
                return false;
        }
        return true;
    }
}
