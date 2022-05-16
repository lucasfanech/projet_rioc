<?php
include ('db.php');
include ('functions.php'); // Fonctions PHP
$isConnected = false;
include ('checkLogin.php'); // nous renvoei $isConneected true ou false
if ($isConnected) {
    if (isset($_GET['session'])) {
        $sessionId = $_GET['session'];
        echo "Session n°".$sessionId;
        $waitingList = getWaitingList($sessionId);
        var_dump($waitingList);
    } else {
        echo "Aucune session définie";
    }
}else{
    echo "Vous n'êtes pas connecté";
}
?>