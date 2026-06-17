<?
include("version.php");
include("session.php");
include("tiempo.php");
$tipoUnidad 	= $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS'];
$codPerfil	 	= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programaci&oacute;n de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/Modal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/servicios.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/capacitados.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/vehiculos.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
    <input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
    <input id="perfil"  type="hidden" readonly="yes" value="<?echo $codigoPerfil?>">
  	<input id="perfilOrigen"  type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
	<div id="cubreFondo" style="display:none;"></div>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">Servicios</div>
		<div id="subtitulo">En esta lista se encuentran los Servicios que se encuentran registrados.</div>
		<div style="height:68px"></div>
		<table width="100%">   
		  <tr> 
		    <td width="25%"><input type="button" name="btnNuevaReunion" id="btnNuevaReunion" value="NUEVO SERVICIO" <? if(!$permisoRegistrar) echo 'disabled'; else echo 'enabled'; ?> onClick="fichaServicioUnidad.className='fichaActiva';"></td>
			<td width="20%"></td>  
			<td width="28%"align="right">FECHA&nbsp;:&nbsp;</td>
			<td width="15%"><input type="hidden" value="<?echo $unidadBloqueada?>" id="textUnidadBloqueada" name="textUnidadBloqueada"/><input type="hidden" value="<?echo $fechaLimite?>" id ="textFechaLimite" name="textFechaLimite"/><input id="textBuscar" type="text" readonly="yes" value="<?echo date("d-m-Y");?>"></td>
			<td width="2%"><input id="imgBuscar" name="imgBuscar" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textBuscar,'dd-mm-yyyy',this,0,0);"></td>
			<td width="10%"><input type="button" id="BUSCAR" value="BUSCAR" onClick="leeServicios('<?echo $unidadUsuario?>','','','');"></td>
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
	        <td id="nombreColumna" width="55%" align="center">SERVICIO</td>
	        <td id="nombreColumna" width="25%" align="center">HORARIO</td>
      	</tr>
		  </table>
		  </div>
			<div id="listadoServicios"></div>
		</div>
		<div style="height:2px"></div>
			<table width="100%"><tr class="linea"><td></td></tr></table>
		</div>
<? include("fichaServicioModal.php"); ?>
<? include("modal-popup.php"); ?>
</body>
</html>
<?
	echo "<script>";
	echo "leeServicios('".$unidadUsuario."','','','');";
	if($permisoRegistrar){
		echo "leeVehiculosControlEstado('".$unidadUsuario."');";
		echo "fallaPospuesta();";
		echo "cargoPorDefinir('".$unidadUsuario."');";
	}
	echo "</script>";
?>