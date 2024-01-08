<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
//dependances

require './class/database.php';

//Connection à la bdd

$db_table = 'pjt';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$bdd = new pjt\database($db_table,$db_user,$db_pass,$db_host);

$appName = 'Projet PJT';

?>