<?include("session.php")?>
<?include("tiempo.php")?>
<?//include("perfil.php")?>
<?
$tipoUnidad = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion a�adida el 16-04-2015
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de sesion a�adida el 16-04-2015
$fecha_hra_inicio = $_SESSION['HORA_INICIO'];  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programaci�n de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="./js/creaObjeto.js"></script>   
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/servicios.js"></script>  
<script type="text/javascript" src="./js/usuario.js"></script>  
<script type="text/javascript" src="./js/horaFecha.js"></script>  
<script type="text/javascript" src="./calendario/popcalendar.js"></script>  

<script type="text/javascript" src="./js/vehiculos.js"></script>  
   
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>

</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<?include("header.php")?>
	<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>"><!--Variable oculta a�adida el 16-04-2015-->
    <input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!--Variable oculta a�adida el 16-04-2015-->
    	<input id="finicio"  type="hidden" readonly="yes" value="<?echo $fecha_hra_inicio?>"><!--Variable oculta a�adida el 16-04-2015-->
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">Servicios</div>
		<div id="subtitulo">En esta lista se encuentran los Servicios que se encuentran registrados.</div>
		<div style="height:45px"></div>
		<table width="100%">   
		    <tr> 
		      <td width="25%"><input type="button" name="btnNuevaReunion" id="btn100" value="NUEVO SERVICIO" onClick="javascript:abrirVentana('NUEVO SERVICIO ... ', '970', '460','fichaServicioCuadrante.php', '','','5','5')"></td>
		      <td></td>
			  <td width="28%"align="right">FECHA&nbsp;:&nbsp;</td>
			  <td width="15%"><input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/><input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite"/><input id="textBuscar" type="text" readonly="yes" value="<?echo $fechaHoy?>"></td>
			  <td width="2%"><input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textBuscar, textBuscar,'dd-mm-yyyy','-1','-1')"></td>
			  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeServicios('<?echo $unidadUsuario?>','','','');"></td>
			  <td width="20%"><input type="button" id="btn100" value="BUSQUEDA AVANZADA >>>" onClick="javascript:abrirVentana('BUSQUEDA AVANZADA DE SERVICIOS ... ', '900', '240','fichaBusqAvanzadaServicio.php', '','','5','5')"></td>
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
		          <td id="nombreColumna" width="15%" align="center">FECHA</td>
				  <td id="nombreColumna" width="25%" align="center">SERVICIO</td>
				  <td id="nombreColumna" width="25%" align="center">FUNCIONARIO</td>
		          <td id="nombreColumna" width="20%" align="center">HORARIO</td>
		          <!--<td id="nombreColumna" width="10%" align="center">PERSONAL</td>-->
		        </tr>
		     </table>
		    </div>
			<div id="listadoServicios"></div>
		</div>
			<div style="height:2px"></div>
			<table width="100%"><tr class="linea"><td></td></tr></table>
		</div>
</body>
</html>
<?
	echo "<script>";
	echo "leeServicios('".$unidadUsuario."','','','');";
	if ($codigoPerfil == 10 || $codigoPerfil == 20)	echo "leeVehiculosControlEstado('".$unidadUsuario."');";
				
	echo "</script>";
?>