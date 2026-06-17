<?
session_start();
if ($_SESSION['USUARIO_USERNAME'] == "") header("location:index.php");
?>