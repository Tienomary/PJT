<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
//dependances

require './class/database.php';
require './class/user.php';

//Connection à la bdd

$db_table = 'pjt';
$db_host = 'db';
$db_user = 'root';
$db_pass = 'root';
$bdd = new pjt\database($db_table,$db_user,$db_pass,$db_host);

//global VAR 
$appName = 'Projet PJT';

?>