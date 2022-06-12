<?php
//localhost
$db_host     = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name     = 'cmm';


$connection=mysqli_connect($db_host, $db_username, $db_password,$db_name);
try
{
    $bdd = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_username, $db_password);
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$db = $connection
or die('could not connect to database');

?>
