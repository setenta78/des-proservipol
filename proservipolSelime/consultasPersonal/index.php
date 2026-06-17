<?php
session_start();
if ($_SESSION["session_autent_p2"] == "SI") { header("location: personalAgregado.php");}

else {

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>CONSULTAS PERSONAL</title>

<link rel="stylesheet" type="text/css" href="./inicio.css">

</head>
<body>

<b>CONSULTAS PERSONAL</b>
<div class="page">
<form name="ingreso" method="post" action="login.php">
<table class="tabla_inicio">
	<tr>
		<td  class="tabla_celda_izq">
		Usuario:
		</td>
		<td   class="tabla_celda_der">
		<input name="login" type="text" id="login" class="inputs">
		</td>
	</tr>
	<tr>
		<td  class="tabla_celda_izq">
		Password:
		</td>
		<td   class="tabla_celda_der">
		<input name="clave" type="password" id="clave" class="inputs">
		</td>
	</tr>
	<tr>
		<td  colspan="2">
		<input name="entrar" id="entrar" type="submit" value="Ingresar" class="boton">
		</td>
	</tr>
	<tr>
		<td  colspan="2">
		
		<?php if($ingreso=="error") echo "<div class='aviso'>USUARIO O PASSWORD INCORRECTO(S)</div>";
           else if($ingreso=="error2") echo "<div class='aviso'>INGRESA TU NOMBRE DE USUARIO Y PASSWORD</div>";
           else if($ingreso=="cerrar") echo "<div class='aviso'>LA SESION HA SIDO CERRADA</div>";
		 ?>
		
		</td>
	</tr>
</table>
</form>
</div>

</body>
</html>

<?php
}
?>