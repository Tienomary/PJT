<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
//dependances

require './class/database.php';
require './class/user.php';
require './class/annonce.php';

//Connection à la bdd

$db_table = 'pjt';
$db_host = 'db';
$db_user = 'root';
$db_pass = 'root';

function checkDatabaseExistence($db_host, $db_user, $db_pass, $db_name) {
    try {
        $pdo = new PDO('mysql:host='.$db_host, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SHOW DATABASES LIKE :db_name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':db_name', $db_name, PDO::PARAM_STR);
        $stmt->execute();

        $databaseExists = $stmt->rowCount() > 0;

        return $databaseExists;
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la connexion au serveur MySQL : " . $e->getMessage());
    }
}

try {
    $databaseExists = checkDatabaseExistence($db_host, $db_user, $db_pass, $db_table);
    
    if (!$databaseExists) {
        $dbco = new PDO("mysql:host=$db_host", $db_user, $db_pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE $db_table";
        $dbco->exec($sql);
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_table", $db_user, $db_pass);
        $dbh->query(file_get_contents('pjt.sql'));

        die("La BDD vient d’être créé, rechargez la page !");
    } 
} catch (Exception $e) {
    echo $e->getMessage();
}


$bdd = new pjt\database($db_table,$db_user,$db_pass,$db_host);



//global VAR 
$appName = 'LocalRent ♻️';

?>