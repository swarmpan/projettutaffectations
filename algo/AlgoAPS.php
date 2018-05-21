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

    public function run(GrapheAffectation $g) {
        $i = 1;

        while (! $g->tousEtudiantsAffectes() && $i <= count($g->projets)) {

            foreach ($g->etudiants as $etudiant) {
                // si l'etudiant n'a pas d'affectation
                if (! $g->estAffecte($etudiant)) {
                    // trouver le voeu i
                    $meilleurVoeu = $g->getArcCout($etudiant, $i);
                    $g->affecterVoeu($etudiant, $meilleurVoeu->getSommetTo());
                }
            }

            foreach ($g->projets as $projet) {
                $nbEtud = $g->nbEtudiantsParProjet($projet);
                print "projet " . $projet->titre . ", nbetud = " . $nbEtud . "\n";

                // si trop d'etudiants dans le projet
                if ($nbEtud > $projet->capaciteMax) {
                    // recuperer les etudiants affectés a ce projet
                    $etudAffectes = $g->etudiantsAffectesAuProjet($projet);

                    // parmi eux, enlever les affectations de n etudiants (au hasard)
                    $difference = $nbEtud - $projet->capaciteMax;

                    for ($i = 0; $i < $difference; $i++) {
                        $random = rand(0, count($etudAffectes) - 1);
                        $g->supprimerAffectation($etudAffectes[$random]);
                    }
                }
            }

            // on passe au i+1 ieme voeu
            $i++;
        }

        // check nb etudiants minimum par projet
        // = groupes en sous effectif
    }
}