<?php
require_once("class/class.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CONSULTAS PROSERVIPOL - ASIGNACIONES PENDIENTES POR PREFECTURA</title>
<script src="js/autocompletar3.js" type="text/javascript" language="javascript"></script>
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
<fieldset style="width:60%; height:130px;border:2px groove #ccc;">
<legend style="font-weight:bold;font-family:Verdana;font-size: 12px;color:#00000;">BUSQUEDA POR PREFECTURAS</legend>
<br>
<table border="0">
<tr>
<td>&nbsp;Unidad</td>
<td>:&nbsp;<input type="text" id="input" name="texto" class="campos" size="40" style='text-transform:uppercase;' onKeyUp="autocompletar('lista',this.value);" /><input type="hidden" id="input2" name="texto2"/></td>
<td>&nbsp;Mes</td>
<td>&nbsp;:<select name="mes">
<option value="0">Seleccione mes</option>
<option value="1">Enero</option>
<option value="2">Febrero</option>
<option value="3">Marzo</option>
<option value="4">Abril</option>
<option value="5">Mayo</option>
<option value="6">Junio</option>
<option value="7">Julio</option>
<option value="8">Agosto</option>
<option value="9">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select></td>
<td>&nbsp;Anno</td>
<td>&nbsp;:<select name="anno">
<option value="0">Seleccione agno</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
</select></td>
</tr>
</table>
</fieldset>
<div id="lista" class="autocompletar"></div>
<!--<div id="reloj"><img src="images/preloder.gif" /></div>-->
<br />
<input type="submit" id="btn"  value="CONSULTAR" title="CONSULTAR"/><input type="hidden" name="grabar" value="si">
<input type="button" id="btn"  value="VOLVER ATRAS" title="VOLVER" onclick="history.back()"/>
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
    $desv=$obj->get_certificado4();
	//exit;
//}

?>
</form>
</div>
</div>
</body>
</html>
