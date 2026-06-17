<?//include("session.php")?>
<?//include("perfil.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>   
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/servicios.js"></script>  
<script type="text/javascript" src="./js/numero.js"></script>
<script type="text/javascript" src="./js/usuario.js"></script>  
<script type="text/javascript" src="./calendario/popcalendar.js"></script>  
   
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php");?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<?
	
	//$unidadUsuario = 2540;                     
	//$descripcionTipoServicio = "comisaria";   

	$codigoUnidad			 = $unidadUsuario;
	$nivelAnterior  		 = $codigoUnidad;             
	$inicio  				 = "0";
	
	$descripcionTipoServicio = "nacional";
	if ($codigoPerfil  == 30) $descripcionTipoServicio = "comisaria";
	if ($codigoPerfil  == 40) $descripcionTipoServicio = "prefectura";
	if ($codigoPerfil  == 50) $descripcionTipoServicio = "zona";
	
	$tipoUnidad = $descripcionTipoServicio;
	
	?>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">Servicios</div>
		<div id="subtitulo">En esta lista se encuentran los Servicios que se encuentran registrados.</div>
		<div style="height:25px"></div>
		<table width="100%">   
		    <tr> 
		      <td width="25%">&nbsp;</td>		
			  <td width="28%"align="right">FECHA&nbsp;:&nbsp;</td>
			  <td width="15%"><input id="textBuscar" type="text" readonly="yes" value="<?echo $fechaHoy?>"></td>
			  <td width="2%"><input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textBuscar, textBuscar,'dd-mm-yyyy','-1','-1')"></td>
			  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeServiciosAgregados('<?echo $codigoUnidad?>','<?echo $tipoUnidad?>',document.getElementById('textBuscar').value,'','0','0');"></td>
			  <td width="20%"><input type="button" id="btn100" value="BUSQUEDA AVANZADA >>>" disabled="yes"></td>
		    </tr>
		</table>
		<div style="height:2px"></div>
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>
		<div id="listado">
			<div id="cabeceraGrilla">
			<table cellspacing="1" cellpadding="1" width="100%">
		        <tr> 
		          <td id="nombreColumna" width="5%" align="center">No.</td>
		          <td id="nombreColumna" width="10%" align="center">FECHA</td>
		          <td id="nombreColumna" width="30%" align="center">UNIDAD</td>
		          <td id="nombreColumna" width="35%" align="center">SERVICIO</td>
		          <td id="nombreColumna" width="10%" align="center">HORARIO</td>
		          <td id="nombreColumna" width="10%" align="center">HORAS</td>
		        </tr>
		     </table>
		    </div>
			<div id="listadoServicios"></div>
		</div>
		<div style="height:2px"></div>
		<table width="100%"><tr class="linea"><td></td></tr></table>
		<div id="totalesGrilla">
			<table cellspacing="1" cellpadding="1" width="100%">
		    <tr> 
		      <td id="totalesColumna" width="78.03%" align="right">TOTALES&nbsp;:&nbsp;&nbsp;&nbsp;</td>
		      <td id="totalesColumna" width="10%" align="center"><div id="totalPersonal">-</div></td>
		      <td id="totalesColumna" width="11.97%" align="center"><div id="totalVehiculos">-</div></td>
		    </tr>
		    </table>
		</div>
		</div>
</body>
</html>
<?
	//$codigoUnidad	= 2600;
	//$inicio  		= "0";
	//$tipoUnidad 	= "prefectura";
	echo "<script>";
	//echo "leeServiciosAgregados('".$codigoUnidad."','".$tipoUnidad."','".$fecha."','".$codigoServicio."','".$inicio."','0');";
	echo "</script>";
?>