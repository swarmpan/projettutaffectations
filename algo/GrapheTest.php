<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 28/02/2018
 * Time: 15:51
 */

namespace algo;


class GrapheTest extends \PHPUnit_Framework_TestCase
{

    public function testGetArcs()
    {
    }

    public function testGraphe()
    {
        $graphe = new Graphe();
        $s1 = new Sommet();
        $s2 = new Sommet();
        $s3 = new Sommet();

        $graphe->ajouterSommet($s1);
        $graphe->ajouterSommet($s2);
        $graphe->ajouterSommet($s3);


    }
}
