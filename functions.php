<?php

function isSessionExists(){
    include('db.php');
    $sql = "SELECT * FROM `sessions` WHERE active = 1";
    if (!empty($connection)) {
        $result = mysqli_query($connection, $sql);
    }

    if($result){
        if (isset($result->fetch_row()[1])){
            return true;
        }
        else{
            return false;
        }

    }
    else{
        return mysqli_error($connection);
    }
    mysqli_close($connection);
}

function getSession(){
    include('db.php');
    $sql = "SELECT * FROM `sessions` WHERE active = 1";
    if (!empty($connection)) {
        $result = mysqli_query($connection, $sql);
    }

    if($result){
       $row = mysqli_fetch_row($result);
       return $row;

    }
    else{
        return mysqli_error($connection);
    }
    mysqli_close($connection);
}

function createSession($name){
    include('db.php');
    $sql = "INSERT INTO `sessions` (`id_session`, `active`, `session_name`) VALUES (NULL, '1', '".$name."')";
    if (!empty($connection)) {
        if ($connection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

}

function endSession($id){
    include('db.php');
    $sql = "UPDATE `sessions` SET `active` = '0' WHERE `sessions`.`id_session` = ".$id.";";
    if (!empty($connection)) {
        if ($connection->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}


// Fonction getWaitingList : affiche la liste d'attente en fonction de la sessionId et affiche dans l'ordre premier arrivé
function getWaitingList($sessionId){
    include('db.php');
    $sql = "SELECT * FROM `waiting_line` WHERE processing = 0 AND session_id = ".$sessionId." ORDER BY waiting_time;";
    if (isset($connection)){
        $result = $connection -> query($sql);
        // Associative array

        $wList = array();
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $wList[] = $row;
        }
        return $wList;
    }
}

// Fonction stateUser
function stateUser($sessionId, $userId){
    include('db.php');
    $sql = "SELECT * FROM `waiting_line` WHERE processing = 0 AND session_id = 22 AND user_id = 1 ORDER BY waiting_time;";
    if (!empty($connection)) {
        $result = mysqli_query($connection, $sql);
    }

    if($result){
        if (isset($result->fetch_row()[4])){
            if ($result->fetch_row()[4] == 0){
                return 1;
            }
            else if( $result->fetch_row()[4] == 1){
                return 2;
            }
        }
        else{
            return 0;
        }

    }
    else{
        return mysqli_error($connection);
    }
    // return | en appel = 1, en en verif = 2, rien = 0
}
?>