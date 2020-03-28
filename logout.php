<?php require_once("include/session.php"); ?>
<?php require_once("include/function.php"); ?>
<?php
$_SESSION["id"]=null;
session_destroy();
redirect("login.php");
?>