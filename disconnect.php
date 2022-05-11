<?php
session_start();
$_SESSION = array();
session_unset();
header("Location: admin.php");
?>
