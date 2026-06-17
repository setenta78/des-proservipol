<?php
require_once("class/class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASIGNACIONES PENDIENTES</title>
<script src="js/autocompletar.js" type="text/javascript" language="javascript"></script>
<script src="js/funciones.js" type="text/javascript" language="javascript"></script>
<script src="js/popcalendar.js" type="text/javascript" language="javascript"></script>
<link rel="stylesheet" href="css/autocompletar.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/estilos.css" type="text/css" media="all" />
</head>
<body>
<div id="pagina">
<div id="logo" class="texto">
<table class="texto" border="0">
<tr>
<td><img src="img/logo_depto.jpg" alt="Logo Departamento" align="middle"></td>
<td align="center">CARABINEROS DE CHILE<br>INSPECTORIA GENERAL<br>DEPTO. CONTROL DE GESTION</td>
</tr>
</table>
</div>
<div class="texto3">
<?php 
echo "<br>";
$fecha=date("d/m/Y");
echo "<b>"." Bienvenid@"."</b>";
echo "<br>";
echo "<br>";
echo "<b>"." La fecha de hoy es: "."</b>".$fecha;
echo "<br>";
echo "<br>";
?>
</div>
<div id="form" class="texto3">
<form name="formulario" method="post" action="" onsubmit="return validar()">
<fieldset style="width:60%; height:275px;border:2px groove #ccc;">
<legend style="font-weight:bold;font-family:Verdana;font-size: 12px;color:#00000;"><?php echo "<img src='img/falta.png' width='83' height='80' border='0' align='middle' alt='Alerta'/>"; ?>  ASIGNACIONES PENDIENTES</legend>
<br>
<table border="0" align="center">
<tr align="center">
<td><img src='img/nivel_nacional.jpg' width='115' height='130' border='0' align='middle' alt='Nacional'/></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/zonas.png' width='60' height='130' border='0' align='middle' alt='Zonas'/></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/prefecturas.png' width='60' height='130' border='0' align='middle' alt='Prefecturas'/></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='img/unidades.png' width='60' height='130' border='0' align='middle' alt='Unidades'/></td>
</tr>
<tr align="center">
<td><a href="nivel_nacional.php" title="Nacional">Nivel nacional</a></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="zonas.php" title="Zonas">Zonas</a></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="prefecturas.php" title="Prefecturas">Prefecturas</a></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="unidades.php" title="Unidades">Unidades</a></td>
</tr>
</table>
</fieldset>
<div id="lista" class="autocompletar"></div>
<br />
<!--<div id="reloj"><img src="images/preloder.gif" /></div>-->

<br />

<div id="muestra">

</div>
</form>
</div>
<div id="delete">
<form name="form" method="post" action="" onsubmit="validate(this);">
<?php
//if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
//{
	//print_r($_POST);

		$obj=new Trabajo();
    $desv=$obj->get_certificado();
	//exit;
//}

?>
</form>
</div>
</div>
</body>
</html>
