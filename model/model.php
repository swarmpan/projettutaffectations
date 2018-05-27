<?php
require_once "{$ROOT}{$DS}config{$DS}config.php";

class Model {
	
	public static $pdo;

	public static function Init() {
		$host = Config::getHostName();
		$dbname = Config::getDatabase();
		$login = Config::getLogin();
		$pass = Config::getPassword();

		try {
			self::$pdo = new PDO("mysql:host=".$host.";dbname=".$dbname,$login,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
  			if (Config::getDebug()) {
			    echo $e->getMessage();
			} 
			else {
			    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
			}
			die();
		}	
	}

	public static function getAll() {
		try {
			$rep = Model::$pdo->query('SELECT * FROM '.static::$table.' ORDER BY '.static::$primary.' DESC');
			$rep->setFetchMode(PDO::FETCH_CLASS, 'Model'.ucfirst(static::$table));
			$ans = $rep->fetchAll();

			return $ans;
		} 
		catch(PDOException $e) {
  			if (Config::getDebug()) {
			    echo $e->getMessage();
			} 
			else {
			    echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
			}
			die();
		}	
	}

	public static function getAllOrderAscBy($key) {
        try {
            $rep = Model::$pdo->query('SELECT * FROM '.static::$table.' ORDER BY '. $key .' ASC');
            $rep->setFetchMode(PDO::FETCH_CLASS, 'Model'.ucfirst(static::$table));
            $ans = $rep->fetchAll();

            return $ans;
        }
        catch(PDOException $e) {
            if (Config::getDebug()) {
                echo $e->getMessage();
            }
            else {
                echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

	public static function get($arg) {
		try {
		  	$req_prep = Model::$pdo->prepare('SELECT * FROM '. static::$table .' WHERE '. static::$primary .' = :nom_var');
		  	$req_prep->execute(array("nom_var" => $arg));
		  	$req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.ucfirst(static::$table));

		  	return $req_prep->fetch();
		}
		catch(PDOException $e) {
  			if (Config::getDebug()) {
			    echo $e->getMessage();
			} 
			else {
			    echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
			}
			die();
		}
	}

	public static function delete($arg) {
		try {
			$sql = 'DELETE FROM '. static::$table .' WHERE '. static::$primary .' = ?';
			$req_prep = Model::$pdo->prepare($sql);
			$req_prep->execute(array($arg));
		}
		catch(PDOException $e) {
  			if (Config::getDebug()) {
			    echo $e->getMessage();
			} 
			else {
			    echo 'Une erreur est survenue <a href="index.php"> retour a la page d\'accueil </a>';
			}
			die();
		}
	}
	
	public static function mainPage(){
		header('Location: index.php');
		die();
	}
	
	public static function theCatch($message = NULL){
		if (Config::getDebug()) echo $message;
		else Model::mainPage();
		die();
	}
	
}

Model::Init();
?>