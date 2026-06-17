<?php
//require_once("class/class.php");
//Incluimos el archivo con la función o simplemente pegamos la función
require('fechaTexto.php');
//if (isset($_SESSION["session_video_14"]))
//{
//$codigo = $_SESSION["session_video_14"];	
//$grado  = $_SESSION["session_video_15"];	
//$nombre = $_SESSION["session_video_16"];	

//$tipo = $_SESSION["session_video_17"];	

//$datos  = "(".$grado.")"." - ".$nombre;
//echo $codigo." ".$user." ".$descripcion
//La fecha que queremos pasar a castellano

$miFecha = date("d-m-Y h:m:s");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CONSULTAS SERVICIOS PROSERVIPOL</title>
<script src="js/creaObjeto.js" type="text/javascript" language="javascript"></script>
<script src="js/consulta.js" type="text/javascript" language="javascript"></script>
<script src="js/consulta_.js" type="text/javascript" language="javascript"></script>
<script src="js/funciones.js" type="text/javascript" language="javascript"></script>     



<!--
<script src="js/jsCalendar.js" type="text/javascript" language="javascript"></script>
<script src="js/jsCalendar.datepicker.js" type="text/javascript" language="javascript"></script>
<script src="js/jsCalendar.lang.es.js" type="text/javascript" language="javascript"></script>
<link rel="stylesheet" href="css/jsCalendar.css" type="text/css"/>
<link rel="stylesheet" href="css/jsCalendar.micro.css" type="text/css"/>
-->




<link rel="stylesheet" href="css/estilos.css" type="text/css"/>


<!--<script type="text/javascript" src="./js/horaFecha.js"></script> -->
<script type="text/javascript" src="./calendario/popcalendar.js"></script>


<style type="text/css">
#contenedor {width: 900px; height: 0px; display: table;}
#texto {display: table-cell; text-align: center; vertical-align: middle;}
</style>



<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
</head>
<body>
<input id="usuario" type="hidden" readonly="yes" value="<?php echo $codigo?>">	
<input id="tipo" type="hidden" readonly="yes" value="<?php echo $tipo?>">	
<div id="pagina">
<div id="logo" class="texto">
<table class="texto" border="0">
<tr>
<td><img src="img/logo_depto.jpg" alt="Logo Departamento" align="middle"></td>
<td align="center">CARABINEROS DE CHILE<br>CONTRALORIA GENERAL<br>DEPTO. CONTROL DE GEST. Y SIST. DE INFORMACI&Oacute;N</td>
</tr>
</table>
</div>
<div class="texto3">
<?php 
echo "<br>";
$fecha=date("d/m/Y");
echo "<table border='0'>";
echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";
echo "<tr>";
echo "<td><b>Hoy es:&nbsp;</b>".fechaTexto($miFecha)."</td>";
echo "<td></td>";
echo "</tr>";
echo "</table>";
//echo "<b>"." Bienvenid@"."</b>".": ".$datos. "<a href='salir.php'><img src='img/Actions-edit-delete-icon.png' border='0' align='middle' alt='Eliminar'/></a>"; 
//echo "<br>";
echo "<br>";
//echo "<b>"." Hoy es: "."</b>".fechaTexto($miFecha);
echo "<br>";
//echo "<br>";
?>
</div>



<div id="form" class="texto3">
	<!--<form name="formulario" method="post" action="">-->
	<!--<form name="formulario">-->
		
		<fieldset style="width:60%; height:100%;border:2px groove #ccc;">
			
			<legend style="font-weight:bold;font-family:Verdana;font-size: 12px;color:#00000;">CONSULTAS DIPECAR&nbsp;
				<img src="img/Search-icon.png" height="" width="" border="0" align="middle">
			</legend>
			
			<br>
		
			<table border="0">
			
				<tr>
					<td>&nbsp;C&Oacute;DIGO DE FUNCIONARIO:</td>
					<td>
						<input type="text" id="texto2" name="texto2" class="campos" size="7" style="text-transform:uppercase;" onclick="limpia(this);"/>
					</td>
					<!--
					<td>&nbsp;FECHA DESDE:</td>
					<td><input name="test-2" type="text" id="dateArrival1"  class="campos" size="10" data-years-line="3" data-date="now" data-datepicker data-language="es" data-class="material-theme micro-theme green"/></td>
					<td>&nbsp;FECHA HASTA:</td>                                                           		
					<td><input name="test-3" type="text" id="dateArrival2"  class="campos" size="10" data-years-line="3" data-date="now" data-datepicker data-language="es" data-class="material-theme micro-theme green"/></td>
					<td></td>
					-->
				</tr>
				
				<tr>
					<td align="right">FECHA DESDE&nbsp;:&nbsp;</td>
					<td>
						<input id="textFechaDesde" type="text" readonly="yes" value="<? echo $fechaHoy ?>">
					</td>
					<td>
						<input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaDesde, textFechaDesde,'dd/mm/yyyy','-1','-1')">
					</td>
				</tr>	
				
				<tr>
					<td align="right">FECHA HASTA&nbsp;:&nbsp;</td>
					<td>
						<input id="textFechaHasta" type="text" readonly="yes" value="<? echo $fechaHoy ?>">
					</td>
					<td>
						<input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaHasta, textFechaHasta,'dd/mm/yyyy','-1','-1')">
					</td>
				</tr>
				
				<tr>
					<td>
						<input type="button" id="btn" style="height:100%;width:100%;" value="CONSULTAR" title="CONSULTAR" onClick="consultarServicio(texto2,textFechaDesde,textFechaHasta);"/>
						<input type="hidden" name="grabar" value="si">
					</td>
				</tr>
						
			</table>
			
			<br>
		


		<!--<div id="reloj"><img src="images/preloder.gif" /></div>-->
		</fieldset>
		
		
	<!--</form>-->
	
	
	
	<!--
	<table>
		<tr>
			<td width="28%"align="right">FECHA&nbsp;:&nbsp;</td>
			<td width="15%">
				<input id="textBuscar" type="text" readonly="yes" value="<? echo $fechaHoy ?>">
			</td>
			<td width="2%">
				<input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textBuscar, textBuscar,'dd-mm-yyyy','-1','-1')">
			</td>
		</tr>	
	</table>	
	-->
	
		
		
</div>


<div id="contenidoPagina"></div>


<br>
<div id="contenedor">
<div id="texto" class="texto">@Desarrollado por Departamento Control de Gesti&oacute;n y Sistemas de Informaci&oacute;n</div>
</div>




</body>
</html>



<?php
//}else
//{
//	echo "
//	<script type='text/javascript'>
//	alert('DEBE INICIAR SESI\u00D3N PARA ACCEDER A ESTE CONTENIDO');
//	window.location='index.php';
//	</script>
//	";
//}
?>
