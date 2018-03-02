<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 28/02/2018
 * Time: 10:36
 */

require_once ('Sommet.php');

class Etudiant extends Sommet
{
    public $login;
    public $nom;
    public $prenom;
    public $email;

    /**
     * Etudiant constructor.
     * @param $login
     */
    public function __construct($login)
    {
        $this->login = $login;
    }
}