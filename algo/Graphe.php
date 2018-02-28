<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 28/02/2018
 * Time: 10:34
 */

namespace algo;

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
    public function getArcsFrom($sommet) {
        $arcsSortants = array();
        foreach ($this->arcs as $arc) {
            if ($arc->sommetFrom == $sommet)
                $arcsSortants[] = $arc;
        }
        return $arcsSortants;
    }
}