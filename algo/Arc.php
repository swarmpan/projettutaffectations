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

    public $coefficient = 1;
    public $puissance = 1;
    public $expo = 0;

    /**
     * @return cout
     */
    public function getCout()
    {
        return $this->cout;
    }
    
    /**
     * @return capacite
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @return SommetFrom
     */
    public function getSommetFrom()
    {
        return $this->sommetFrom;
    }

    /**
     * @return SommetTo
     */
    public function getSommetTo()
    {
        return $this->sommetTo;
    }

    public function coutArc()
    {
        //pour linéaire choisir $puissance 1 et $expo 0
        // pour puissance prendre $coefficient 1 et $expo 0
        //pour expo prendre $lineaire et $puissance 1
        $power = pow($this->getCout(), $puissance);
        if ($expo == 0) {
            $exponentielle = 1;
        }
        else {
            $exponentielle = pow($expo, $this->getCout());
        }
        return $coefficient*$power*$exponentielle;
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
