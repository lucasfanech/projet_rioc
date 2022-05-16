<?php
include ('db.php');
include ('checkLogin.php'); // nous renvoei $isConneected true ou false
include ('functions.php');
if (isset($_GET['idSession'])){
    endSession($_GET['idSession']);
    if (isset($_GET['id'])){
        header('Location: admin.php?id='.$_SESSION['id']);
    }
    else{
        header('Location: admin.php');
    }

}

?>