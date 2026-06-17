<?
session_start();

//echo "sesion";

//$_SESSION['USUARIO_USERNAME'] = $_COOKIE['proservipol'];

//echo $_SESSION['USUARIO_USERNAME'];

if ($_SESSION['USUARIO_USERNAME'] == "") header("location:index.php");
?>