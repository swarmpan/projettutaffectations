<?php
require_once "model.php";

class ModelConfig extends Model {
	
	private $name;
	private $value;
	
	protected static $table = "config";
	protected static $primary = "name";

	function getName()		{return $this->name;}
	function getValue() 	{return $this->value;}

	function __construct($name = NULL, $value = NULL) {
		if (!is_null($name)) 	$this->name = $name;
		if (!is_null($value))	$this->value = $value;
	}

	private function save() {
		
		try{
			$req_prep = Model::$pdo->prepare("INSERT INTO config(name, value) VALUES (?, ?)");
			$req_prep->execute(array($this->name, $this->value));
				
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}
	
	function update($name,$value){
		try {
			if($name!=NULL) 	$this->name = $name;
			if($value!=NULL)	$this->value = $value;

			$req_prep = Model::$pdo->prepare("UPDATE config SET name = ?, value = ? WHERE name = ?");
			$req_prep->execute(array($this->name, $this->value, $this->name));
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}
	
	static function getValueOf($name){
		try {
			$req_prep = Model::$pdo->prepare("SELECT value FROM config WHERE name = ?");
			$req_prep->execute(array($name));
			$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelConfig');
			return $req_prep->fetch()->getValue();
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}
	
	static function setValueOf($name,$value){
		try {
			$req_prep = Model::$pdo->prepare("UPDATE config SET value = ? WHERE name = ?");
			$req_prep->execute(array($value, $name));
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}
	
	static function updateAdmin($login){
		if (ModelConfig::getValueOf('admin')==""){
			ModelConfig::setValueOf('admin',$login);
			return "En tant que premier visiteur, vous avez été nommé admin par défaut!";
		}
		return "";
	}
	
}

?>

