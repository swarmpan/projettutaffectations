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
    public $rangaffect;

    public $affectation; // arc menant vers le projet affecté

    /**
     * Etudiant constructor.
     * @param $login
     */
    public function __construct($login)
    {
        $this->login = $login;
        $this->affectation = null;
    }
}