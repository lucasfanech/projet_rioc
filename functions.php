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
?>