<?php
  session_start();
	$_SESSION["session_autent_p2"] = "NO";
	session_unset();
	session_destroy();
  header("location: index.php?ingreso=cerrar");
?>
