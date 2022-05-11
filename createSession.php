<?php
include('functions.php');
include ('checkLogin.php'); // nous renvoei $isConneected true ou false
if (isset($_POST['submitSession'])){
    $isActive = isSessionExists();
    if (!($isActive)){
        $sessionName = $_POST['session'];
        $result = createSession($sessionName);
        if ($result){

            header('Location: admin.php?id='.$_REQUEST['id']);
            exit();
        }
        else{
            echo "erreur de création de session";
        }
    }

}

?>