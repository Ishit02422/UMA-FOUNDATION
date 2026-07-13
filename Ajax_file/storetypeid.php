<?php
session_start();
$_SESSION["typeid"]=$_POST["typeid"];
echo $_SESSION["typeid"];
?>