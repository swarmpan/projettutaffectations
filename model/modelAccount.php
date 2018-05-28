<?php

require_once "model.php";
require_once "security.php";

class ModelAccount extends Model {
	
	private $id_account;
	private $type_account;
	private $name;
	private $firstname;
	private $mail;
	private $id_project;
	
	protected static $table = "account";
	protected static $primary = "id_account";

	function getIDAccount()		{return $this->id_account;}
	function getTypeAccount() 	{return $this->type_account;}
	function getName() 			{return $this->name;}
	function getFirstName() 	{return $this->firstname;}
	function getMail()			{return $this->mail;}
	function getIDProject()		{return $this->id_project;}

	function __construct($id_account = NULL, $type_account = NULL, $name = NULL, $firstname = NULL, $mail = NULL, $id_project = NULL) {
		if (!is_null($id_account)) 	$this->id_account = $id_account;
		if (!is_null($type_account))$this->type_account = $type_account;
		if (!is_null($name))		$this->name = $name;
		if (!is_null($firstname))	$this->firstname = $firstname;
		if (!is_null($mail))		$this->mail = $mail;
		if (!is_null($id_project))	$this->id_project = $id_project;
	}

	private function save() {
		
		try{
			$req_prep = Model::$pdo->prepare("INSERT INTO account(type_account, name, firstname, mail) VALUES (?, ?, ?, ?)");
			$req_prep->execute(array($this->type_account, $this->name, $this->firstname, $this->mail));
				
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}
	
	function update($id_account,$type_account,$name,$firstname,$mail,$id_project){
		try {
			if($id_account!=NULL) 	$this->id_account = $id_account;
			if($type_account!=NULL)	$this->type_account = $type_account;
			if($name!=NULL)			$this->name = $name;
			if($firstname!=NULL) 	$this->firstname = $firstname;
			if($mail!=NULL) 		$this->mail = $mail;
			if($id_project!=NULL) 	$this->id_project = $id_project;
			

			$req_prep = Model::$pdo->prepare("UPDATE account SET id_account = ?, type_account = ?, name = ?, firstname = ?, mail = ? WHERE id_account = ?");
			$req_prep->execute(array($this->id_account, $this->type_account, $this->name, $this->firstname, $this->mail,$this->id_account));
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}

	static function getAccoutByMail ($mail) {
		try {
			$req = Model::$pdo->prepare("SELECT * FROM account WHERE mail = ?");
		  	$req->execute(array($email));
		  	$req->setFetchMode(PDO::FETCH_CLASS, 'ModelAccount');
		  	
		  	return $req->Fetch();
		} 
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}	
	}

	static function countMail($mail) {
		$req_prep = Model::$pdo->prepare('SELECT COUNT(*) as nb_email FROM account WHERE mail = ?');
		$req_prep->execute(array($mail));
		$res = $req_prep->Fetch();
		return $res['nb_email'];
	}
	
}

?>

