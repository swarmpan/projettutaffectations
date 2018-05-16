<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 28/02/2018
 * Time: 10:36
 */

require_once ('Sommet.php');

// PARCE QUE C'EST NOTRE PROJEEEEEEEEEET
class Projet extends Sommet
{
    public $titre;
    public $capaciteMin;
    public $capaciteMax;
    
    /**
     * @return int
     */
    public function getMin()
    {
        return $this->capaciteMin;
    }
    
    /**
     * @return int
     */
    public function getMax()
    {
        return $this->capaciteMax;
    }
    
    /**
     * Projet constructor.
     * @param $titre
     * @param $capaciteMin
     * @param $capaciteMax
     */
    public function __construct($titre, $capaciteMin = 4, $capaciteMax = 5)
    {
        $this->titre = $titre;
        $this->capaciteMin = $capaciteMin;
        $this->capaciteMax = $capaciteMax;
    }
}
