<?php
require_once "model.php";

class ModelRanking extends Model
{
    private $id_student;
    private $id_project;
    private $ranking;
    protected static $table = 'student_project_ranking';
    protected static $primary = "id_student";

    public static function getRanking($student, $project)
    {
        $req_prep = Model::$pdo->prepare('SELECT * FROM '. static::$table .' WHERE id_student = :var1 AND id_project = :var2');
        $req_prep->execute(array("var1" => $student, "var2" => $project));
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Model'.ucfirst(static::$table));

        return $req_prep->fetch();
    }

    public static function getAll() {
        try {
            $rep = Model::$pdo->query('SELECT * FROM '. static::$table);
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

    public static function getUniqueStudents() {
        try {
            $rep = Model::$pdo->query('SELECT DISTINCT id_student FROM '. static::$table);
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

    public static function getRankingsForStudent($id_student) {
        try {
            $rep = Model::$pdo->query('SELECT * FROM '.static::$table.' WHERE id_student = \''.$id_student.'\' ORDER BY id_project ASC');
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
}