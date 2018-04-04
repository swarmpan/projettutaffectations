<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 28/02/2018
 * Time: 10:35
 */

class Arc
{
    public $capacite;
    public $cout;

    public $sommetFrom;
    public $sommetTo;

    /**
     * @return Sommet
     */
    public function getCout()
    {
        return $this->cout;
    }

    /**
     * @return Sommet
     */
    public function getSommetFrom()
    {
        return $this->sommetFrom;
    }

    /**
     * @return Sommet
     */
    public function getSommetTo()
    {
        return $this->sommetTo;
    }




    /**
     * Arc constructor.
     * @param $capacite
     * @param $cout
     * @param $sommetFrom
     * @param $sommetTo
     */
    public function __construct($sommetFrom, $sommetTo, $cout, $capacite = 1)
    {
        $this->capacite = $capacite;
        $this->cout = $cout;
        $this->sommetFrom = $sommetFrom;
        $this->sommetTo = $sommetTo;
    }
}