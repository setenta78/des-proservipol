<?php
require_once("class/class.php");
?>
<?php
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=reporte.xls");
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
<body onload="document.formulario.reset();">
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

<div id="delete">
<form name="form" method="post" action="" onsubmit="validate(this);">
<?php
//if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
//{
	//print_r($_POST);

		$obj=new Trabajo();
    $desv=$obj->get_certificado2();
	//exit;
//}

?>
</form>
</div>
</div>
<div id="imagen" style="text-align: center;">
<a href="index.php" target="_parent" onclick="goBack()">
<img src='img/icono_volver.jpg' width='55' height='55' border='0' align='middle' alt='Volver'/>
</a>

<?php
echo $muestra= "<td><a href=\"reporteNacional.php?unidad=".$unidad."&anno=".$anno."&mes=".$mes."\" \"><img src='img/microsoft-excel.png' width='50' height='52' border='0' align='middle' alt='Reporte'/></a></td>";
?>
</div>
</body>
</html>