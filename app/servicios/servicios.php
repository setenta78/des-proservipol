<?php
include("../class/class.php");

if (isset($_SESSION["session_video_14"])) {
	$codigo = $_SESSION["session_video_14"];
	$grado  = $_SESSION["session_video_15"];
	$nombre = $_SESSION["session_video_16"];

	$tipo = $_SESSION["session_video_17"];

	$datos  = "(" . $grado . ")" . " - " . $nombre;
//require_once("class/class.php");
//Incluimos el archivo con la función o simplemente pegamos la función
//require('fechaTexto.php');
//$datos  = "(".$grado.")"." - ".$nombre;
//echo $codigo." ".$user." ".$descripcion
//La fecha que queremos pasar a castellano

//$miFecha = date("d-m-Y h:m:s");

// Devuelve el mes en español  

$mes_actu = date("n"); // Mes del 1 al 12 

    $array_mes_espa = array(
        1=>"Enero", 
        2=>"Febrero", 
        3=>"Marzo", 
        4=>"Abril", 
        5=>"Mayo", 
        6=>"Junio", 
        7=>"Julio", 
        8=>"Agosto", 
        9=>"Septiembre", 
        10=>"Octubre", 
        11=>"Noviembre", 
        12=>"Diciembre"
    ); 
  
$mes_espa = $array_mes_espa[$mes_actu];   

// echo "$mes_actu - $mes_espa";  

// ----------------------------------------

// Devuelve el dia de la semana en español

$dia_actu = date("w"); // Dia semana 0 a 6, donde 0 es domingo 

    $array_dia_semana = array(
        0=>"Domingo", 
        1=>"Lunes", 
        2=>"Martes", 
        3=>"Miércoles", 
        4=>"Jueves", 
        5=>"Viernes", 
        6=>"Sábado"
    );

$dia_semana = $array_dia_semana[$dia_actu];  

// echo "$dia_actu - $dia_semana"; 

// ----------------------------------------

$_dia = date("d");    // Devuelve el dia del mes
$_anio = date("Y");    // Devuelve el año

$_feespanol = " $dia_semana $_dia de $mes_espa de $_anio.";
// ----------------------------------------

//echo "$_feespanol";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>CONSULTAS SERVICIOS PROSERVIPOL</title>
<script src="js/creaObjeto.js" type="text/javascript" language="javascript"></script>
<script src="js/consulta.js" type="text/javascript" language="javascript"></script>
<script src="js/funciones.js" type="text/javascript" language="javascript"></script>     
<script src="js/jsCalendar.js" type="text/javascript" language="javascript"></script>
<script src="js/jsCalendar.datepicker.js" type="text/javascript" language="javascript"></script>
<script src="js/jsCalendar.lang.es.js" type="text/javascript" language="javascript"></script>
<link rel="stylesheet" href="css/jsCalendar.css" type="text/css"/>
<link rel="stylesheet" href="css/jsCalendar.micro.css" type="text/css"/>
<link rel="stylesheet" href="css/estilos.css" type="text/css"/>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<style type="text/css">
	.wrapper{
		width: 90%;
		margin: 0 auto;
	}
	.page-header h2{
		margin-top: 0;
	}
	table tr td:last-child a{
		margin-right: 15px;
	}
</style>

<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>

<style type="text/css">
#contenedor {width: 900px; height: 0px; display: table;}
#texto {display: table-cell; text-align: center; vertical-align: middle;}
</style>
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
</head>
<body>
 <table class="texto" border="0">
        <tr>
            <td><img src="../img/94_final.jpg" alt="Logo 94 años" width="150" height="154" align="middle">
            </td>
            <td align="left">CONTRALORIA GENERAL<br>
            CARABINEROS DE CHILE </td>
        </tr>
    </table>
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
  <div class="wrapper">
        <div class="container-fluid">
<input id="usuario" type="hidden" readonly value="<?php echo $codigo?>">	
<input id="tipo" type="hidden" readonly value="<?php echo $tipo?>">	
<div id="pagina">
<br>
<div class="texto3">
<table border='0'>
    <tr>
        <td width="385"><b>Hoy es:&nbsp;</b><?php echo $_feespanol?></td>
        <td width="443" align="right"><a href='eliminarFerperLicencia.php' target="_blank" class="btn btn-danger btn-sm">Eliminar Movimiento</a></td>
    </tr>
</table><br><br>
</div>
<div id="form" class="texto3">
<form name="formulario" method="post" action="">
<fieldset style="width:50%; height:160px; border:1px groove #ccc; border-radius:10px;">
<span style="font-weight:bold;font-family:Verdana;font-size: 12px;color:#00000;">CONSULTA SERVICIOS EFECTUADOS&nbsp;<img src="img/Search-icon.png" height="" width="" border="0" align="middle"></span>
<br><br>

<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="202">&nbsp;C&Oacute;DIGO DE FUNCIONARIO:</td>
		<td width="46">
			<input type="text" id="texto2" name="texto2" class="campos" size="7" style="text-transform:uppercase;" onclick="limpia(this);"/>
		</td>
		<td width="103">&nbsp;FECHA DESDE:</td>
		<td width="75">
			<input name="test-2" type="text" id="dateArrival1"  class="campos" size="10" data-years-line="3" data-date="now" data-datepicker data-language="es" data-class="material-theme micro-theme green"/>
		</td>
		<td width="109">&nbsp;FECHA HASTA:</td>                                                           		
		<td width="146">
			<input name="test-3" type="text" id="dateArrival2"  class="campos" size="10" data-years-line="3" data-date="now" data-datepicker data-language="es" data-class="material-theme micro-theme green"/>
		</td>
		<td width="153"> <a href="#" onclick="consultarServicio();" class="btn btn-primary btn-sm">BUSCAR</a>
                <input type="hidden" name="grabar" value="si"></td>
		</tr>
	<tr>
          <td height="50" colspan="7" align="right">
          		<!--<input type="button" id="btn"  value=" BUSCAR " title="CONSULTAR" onClick="consultarServicio();"/>-->
            
          </td>
	</tr>
	<tr>
	  <td height="50" colspan="7">                   
			
       </td>
	 </tr>
</table>

<br/>
</fieldset>
</form>
</div>
<div id="contenidoPagina"></div>
<br><br>
<?php include '../footer.php';?>
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
