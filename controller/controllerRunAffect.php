<?php
/**
 * Created by PhpStorm.
 * User: Swarm
 * Date: 26/05/2018
 * Time: 19:56
 */

require_once ("{$ROOT}{$DS}model{$DS}model.php");

$result = ModelRanking::getAll();
print_r($result);

