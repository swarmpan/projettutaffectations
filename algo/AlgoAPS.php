<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 28/02/2018
 * Time: 10:19
 */

require_once ('Etudiant.php');
require_once ('GrapheAffectation.php');

class AlgoAPS
{

    /**
     * AlgoAPS constructor.
     */
    public function __construct()
    {
    }

    public function run() {

    }

    public function tousEtudiantsAffectes(GrapheAffectation $g) {
        foreach ($g->etudiants as $etudiant) {
            if (! $this->estAffecte($g, $etudiant))
                return false;
        }
        return true;
    }

    public function estAffecte(Graphe $graphe, Etudiant $e) {
        $arcsFrom = $graphe->getArcsFrom($e);
        return count($arcsFrom) > 0;
    }
}