<?php
session_start();
$idConnected ="";
if(isset($_GET['id']) AND $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    if (isset($bdd)) {
        $requser = $bdd->prepare('SELECT * FROM identification WHERE id_identification= ?');
    }
    if (isset($requser)) {
        $requser->execute(array($getid));
    }
    $userinfo = $requser->fetch();
    if(isset($_SESSION['id']) AND $userinfo['id_identification'] == $_SESSION['id']) {
        $isConnected = true;
        $pseudo = $userinfo['user'];
        $idConnected = $userinfo['id_identification'];
    }
    else{
        $isConnected = false;
    }
}
else{
    $isConnected = false;
}
//session_write_close();
?>