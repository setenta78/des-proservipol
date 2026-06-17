<?php
  session_start();
	$_SESSION["session_autent_ingreso"] = "NO";
	session_unset();
	session_destroy();
  header("location: index.php?ingreso=cerrar");
?>
