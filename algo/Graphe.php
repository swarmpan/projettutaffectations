<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 28/02/2018
 * Time: 10:34
 */

require_once ('Arc.php');
require_once ('Sommet.php');

class Graphe
{
    public $sommets;
    public $arcs;

    /**
     * Graphe constructor.
     * @param $sommets
     * @param $arcs
     */
    public function __construct()
    {
        $this->sommets = array();
        $this->arcs = array();
    }


    public function ajouterSommet($sommet) {
        $this->sommets[] = $sommet;
    }

    public function ajouterArc($arc) {
        $this->arcs[] = $arc;
    }

    /**
     * @return array
     */
    public function getSommets()
    {
        return $this->sommets;
    }

    /**
     * @return array
     */
    public function getArcs()
    {
        return $this->arcs;
    }




    /**
     * Retourne tous les arcs partant d'un sommet
     * @param $sommet
     * @return array
     */
    public function getArcsFrom($sommet): array {
        $arcsSortants = array();
        foreach ($this->arcs as $arc) {
            if ($arc->sommetFrom === $sommet)
                $arcsSortants[] = $arc;
        }
        return $arcsSortants;
    }

    public function getArcFromTo(Sommet $s1, Sommet $s2): Arc {
        foreach ($this->arcs as $arc) {
            if ($arc->sommetFrom === $s1 && $arc->sommetTo === $s2)
                return $arc;
        }
        return null;
    }

    public function getArcCout($sommet, $i): Arc {
        $arcs = $this->getArcsFrom($sommet);
        foreach ($arcs as $arc) {
            if ($arc->getCout() === $i) {
                return $arc;
            }
        }
        return null;
    }
}