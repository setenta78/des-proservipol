<?php
session_start();
if ($_SESSION["session_autent_ingreso"] == "SI") { header("location: modulos.php");}

else {

?>
<html>
<head>
<title>Aplicaciones Chris</title>
<link rel="stylesheet" href="style/estilos.css" type="text/css" media="all" />
</head>
<body>
<div id="logo" class="texto">
<table class="texto" border="0">
<tr>
<td><img src="img/logo_depto.jpg" alt="Logo Departamento" align="middle"></td>
<td align="center">CARABINEROS DE CHILE<br>INSPECTORIA GENERAL<br>DEPTO. CONTROL DE GESTION</td>
</tr>
</table>
</div>
<div>
<form name="ingreso" method="post" action="valida.php">
<fieldset style="width:40%; height:130px;border:2px groove #ccc;">
<legend style="font-weight:bold;font-family:Verdana;font-size: 12px;color:#00000;">INICIO DE SESION</legend>
<table border="0">
<tr>
<td>&nbsp;</td>
<td  class="texto"></td>
<td></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="texto">USUARIO:</td>
<td><input type="text" name="login" id="login"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td class="texto">PASSWORD:</td>
<td><input type="password" name="clave" id="clave"/></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="entrar" id="btn" value="INGRESAR"/></td>
</tr>
</table>
</fieldset>
		<?php if($ingreso=="error") echo "<div class='texto'>USUARIO O PASSWORD INCORRECTO(S)</div>";
           else if($ingreso=="error2") echo "<div class='texto'>INGRESA TU NOMBRE DE USUARIO Y PASSWORD</div>";
           else if($ingreso=="cerrar") echo "<div class='texto'>LA SESION HA SIDO CERRADA</div>";
		 ?>
</form>
</div>
<div id="registro" align="center" class="texto">
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@Desarrollos de Chris.
</div>
</body>
</html>
<?php
}
?>
