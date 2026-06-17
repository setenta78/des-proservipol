<?php
require_once("class/class.php");
//if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
//{
	//print_r($_POST);
	//$obj=new Trabajo();
    //$desv=$obj->get_certificado();
	//exit;
//}
//if (isset($_POST["grabar2"]) and $_POST["grabar2"]=="si")
//{
	//print_r($_POST);
	//$obj=new Trabajo();
	//$del=$obj->desvalidar();
	//exit;
//}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prototipo Buscador</title>
<script src="js/autocompletar.js" type="text/javascript" language="javascript"></script>
<script src="js/funciones.js" type="text/javascript" language="javascript"></script>
<script src="js/popcalendar.js" type="text/javascript" language="javascript"></script>
<link rel="stylesheet" href="css/autocompletar.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/estilos.css" type="text/css" media="all" />
</head>
<body onload="document.formulario.reset();">
<div id="pagina">
<div id="logo" class="texto">
<table >
<tr>
<td><IMG SRC="img/carabineros.png" WIDTH=99 HEIGHT=95 ALT="Logo Institucional" ALIGN="MIDDLE"></td>
<td align="center">&nbsp;&nbsp;CARABINEROS DE CHILE<br>&nbsp;&nbsp;INSPECTORIA GENERAL<br>&nbsp;&nbsp;DEPTO. CONTROL DE GESTION</td>
</tr>
</table>
<?php 
echo "<br>";
echo "<br>";
$fecha=date("d/m/Y");
echo "Bienvenid@";
echo "<br>";
echo " La fecha de hoy es: ".$fecha;
?>
</div>
<form name="formulario" method="post" action="">
<fieldset>
<legend><h3>Busqueda de Funcionario</h3></legend>
INGRESE CODIGO:&nbsp;<input type="text" id="input" name="func" class="campos" size="20"/><input type="hidden" id="input2" name="texto2"/>
</fieldset>
<br />
<input type="submit" id="btn"  value="Consultar" title="Consultar"/><input type="hidden" name="grabar" value="si">
<input type="reset" id="btn"  value="Limpiar" title="Consultar"/>
</form>
<div id="fun">

<?php
//if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
//{
	//print_r($_POST);
	$obj=new Trabajo();
    $desv=$obj->get_funcionario();
	
	//exit;
//}

?>


 </div>
</div>
</body>
</html>
