<?php
/**
 * Created by PhpStorm.
 * User: Swarm
 * Date: 26/05/2018
 * Time: 19:37
 */

require_once ("{$ROOT}{$DS}model{$DS}modelRanking.php");
require_once ("{$ROOT}{$DS}model{$DS}modelProject.php");

// creation du fichier dat
$file = fopen('voeux_etudiants.dat', 'w');

// remplissage du fichier

// set STUDENT
$students = ModelRanking::getUniqueStudents();
$line = 'set STUDENT := ';
foreach ($students as $row) {
    $line .= $row['id_student'] . ' ';
}
$line .= ";\n";
fwrite($file, $line);

// param
$projects = ModelProject::getAllOrderAscBy('id_project');
$line = "param: PROJECT: Cmin Cmax :=\n";
foreach ($projects as $row) {
    $line .= $row['id_project'] . ' ' . $row['nbMinStudent'] . ' ' . $row['nbMaxStudent'] . "\n";
}
$line .= ";\n";
fwrite($file, $line);


//data
$line = 'param cost : ';
foreach ($projects as $row) {
    $line .= $row['id_project'] . ' ';
}
$line .= ":=\n";

foreach ($students as $row) {
    $line .= $row['id_student'] . ' ';
    $rankings = ModelRanking::getRankingsForStudent($row['id_student']);
    foreach ($rankings as $rank) {
        $line .= $rank['ranking'] . ' ';
    }
    $line .= "\n";
}
$line .= ";\n";
fwrite($file, $line);
