<?php
require_once("class/class.php");

if (isset($_SESSION["session_video_14"])) {
	$codigo = $_SESSION["session_video_14"];
	$grado  = $_SESSION["session_video_15"];
	$nombre = $_SESSION["session_video_16"];

	$tipo = $_SESSION["session_video_17"];

	$datos  = "(" . $grado . ")" . " - " . $nombre;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONSULTAS PROSERVIPOL - ASIGNACIONES PENDIENTES POR UNIDAD</title>
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
<td align="center">CARABINEROS DE CHILE<br>SUB CONTRALORIA GENERAL<br>DEPTO. CONTROL DE GESTION</td>
</tr>
</table>
</div>
<div class="texto3">
			<?php
			$fecha = date("d/m/Y");
			echo "<table border='0'>";
			echo "<tr>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "</table>";
			echo "<b>" . " &nbsp;&nbsp;&nbsp;Bienvenid@" . "</b>" . ": " . $datos;
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp; VOLVER <a href='http://proservipol.carabineros.cl/app/aplicativos.php'><img src='../img/icono_volver.jpg' border='0'  width='30' align='middle' alt='Salir'/></a>";
			echo "<br>";
			?>
		</div>
<div class="texto3">
<?php 
echo "<br>";
$fecha=date("d/m/Y");
//echo "<b>"." Bienvenid@"."</b>";
//echo "<br>";
echo "<br>";
echo "<b>"." La fecha de hoy es: "."</b>".$fecha;
echo "<br>";
echo "<br>";
?>
</div>
<div id="form" class="texto3">
<form name="formulario" method="post" action="" onsubmit="return validar()">
<fieldset style="width:60%; height:130px;border:2px groove #ccc;">
<legend style="font-weight:bold;font-family:Verdana;font-size: 12px;color:#00000;">MOVIMIENTOS HISTORICOS FUNCIONARIO</legend>
<br>
<table border="0">
<tr>
<td>&nbsp;C&oacute;digo de Funcionario:</td>
<td>&nbsp;<input type="text" id="input2" name="texto2"/></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</fieldset>
<div id="lista" class="autocompletar"></div>
<br />
<!--<div id="reloj"><img src="images/preloder.gif" /></div>-->
<input type="submit" id="btn"  value="CONSULTAR" title="CONSULTAR"/><input type="hidden" name="grabar" value="si">

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
<?php
} else {
	echo "
	<script type='text/javascript'>
	alert('DEBE INICIAR SESI\u00D3N PARA ACCEDER A ESTE CONTENIDO');
	window.location='http://proservipol.carabineros.cl/app/';
	</script>
	";
}
?>
