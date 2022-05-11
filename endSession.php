<?php
include ('checkLogin.php'); // nous renvoei $isConneected true ou false
include ('functions.php');
if (isset($_GET['idSession'])){

    endSession($_GET['idSession']);
    header('admin.php');
}

?>