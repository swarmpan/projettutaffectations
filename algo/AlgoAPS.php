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

        while (! $g->tousEtudiantsAffectes()) {
            foreach ($g->etudiants as $etudiant) {
                // trouver l'arc avec cout i
                $meilleurVoeu = $g->getArcCout($etudiant, $i);
                $g->affecterVoeu($etudiant, $meilleurVoeu->getSommetTo(), $i);
            }

            foreach ($g->projets as $projet) {
                $nbEtud = $g->nbEtudiantsParProjet($projet);

                // si trop d'etudiants dans le projet
                if ($nbEtud > $projet->capaciteMax) {
                    // enlever les affectations de n etudiants (au hasard)
                    $difference = $nbEtud - $projet->capaciteMax;

                    for ($i = 0; $i < $difference; $i++) {
                        $random = rand(0, $nbEtud - 1);
                        $g->supprimerAffectation($g->etudiants[$random]);
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