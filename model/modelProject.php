<?php
require_once "model.php";
require_once "modelAccount.php";

class ModelProject extends Model {

	private $id_project;
	private $id_tutor;
	private $name;
	private $description;
	private $nbMinStudent;
	private $nbMaxStudent;
	private $nbMaxGroup;
	protected static $table = "project";
	protected static $primary = "id_project";
	
	function getIDProject()		{return $this->id_project;}
	function getIDTutor() 		{return $this->id_tutor;}
	function getName() 			{return $this->name;}
	function getDescription() 	{return $this->description;}
	function getShortDescription(){return substr(explode(chr(13),$this->description)[0],0,100);}
	function getNbMinStudent()	{return $this->nbMinStudent;}
	function getNbMaxStudent()	{return $this->nbMaxStudent;}
	function getNbMaxGroup()	{return $this->nbMaxGroup;}

	function __construct($id_project = NULL, $id_tutor = NULL, $name = NULL, $description = NULL, $nbMinStudent = NULL, $nbMaxStudent = NULL, $nbMaxGroup = NULL) {
		if (!is_null($id_project)) 		$this->id_project = $id_project;
		if (!is_null($id_tutor))		$this->id_tutor = $id_tutor;
		if (!is_null($name))			$this->name = $name;
		if (!is_null($description))		$this->description = $description;
		if (!is_null($nbMinStudent))	$this->nbMinStudent = $nbMinStudent;
		if (!is_null($nbMaxStudent))	$this->nbMaxStudent = $nbMaxStudent;
		if (!is_null($nbMaxGroup))		$this->nbMaxGroup = $nbMaxGroup;
	}

	function save() {
		if (ModelProject::getProjectByName($this->name))
			return 'Ce nom de projet est déjà utilisé';
		if ($this->nbMinStudent > $this->nbMaxStudent)
			return 'Le nombre maximum d\'étudiants doit être supérieur ou égal au nombre minimum d\'étudiants';
		try {
			$req_prep = Model::$pdo->prepare("INSERT INTO project(id_tutor, name, description, nbMinStudent, nbMaxStudent, nbMaxGroup) VALUES (?, ?, ?, ?, ?, ?)");
			$req_prep->execute(array($this->id_tutor, $this->name, $this->description, $this->nbMinStudent, $this->nbMaxStudent, $this->nbMaxGroup));
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}

	public static function update($tab) {
		try {
			$req_prep = Model::$pdo->prepare('UPDATE project SET id_project = ?, id_tutor = ?, name = ?, description = ?, nbMinStudent = ?, nbMaxStudent = ?, nbMaxGroup = ? WHERE id_project = ?');
			$req_prep->execute(array($tab['id_project'], $tab['id_tutor'], $tab['name'], $tab['description'], $tab['nbMinStudent'], $tab['nbMaxStudent'], $tab['nbMaxGroup'], $tab['id_project']));
		}
		catch(PDOException $e) {
			Model::theCatch($e->getMessage());
		}
	}
	
	static function getAllOrderByName(){
		$req_prep = Model::$pdo->prepare("SELECT * FROM project ORDER BY name ASC");
		$req_prep->execute(array());
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProject');
		$res = $req_prep->fetchAll();
		return $res;
	}
	
	static function getProjectByName($name){
		$req_prep = Model::$pdo->prepare("SELECT * FROM project WHERE name = ?");
		$req_prep->execute(array($name));
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProject');
		$res = $req_prep->fetch();
		return $res;
	}
	
	static function getProjectByTutor($id_tutor){
		$req_prep = Model::$pdo->prepare("SELECT * FROM project WHERE id_tutor = ? ORDER BY name ASC");
		$req_prep->execute(array($id_tutor));
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProject');
		$res = $req_prep->fetchAll();
		return $res;
	}
	
	static function getProjectByNotTutor($id_tutor){
		$req_prep = Model::$pdo->prepare("SELECT * FROM project WHERE id_tutor != ? ORDER BY name ASC");
		$req_prep->execute(array($id_tutor));
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelProject');
		$res = $req_prep->fetchAll();
		return $res;
	}
}
	
?>
