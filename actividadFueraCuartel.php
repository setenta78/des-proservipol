<?
include("version.php");
include("session.php");
include("tiempo.php");
$fecha = date("Y-m-d");
$codPerfil = $_SESSION['USUARIO_CODIGOPERFIL'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
<title>PROSERVIPOL - Programaci&oacute;n de Servicios Policiales ...</title>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/actividadFueraCuartel.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista('listado');mensajeActividadFueraCuartel();" onresize="actualizarTamanoLista('listado');">
	<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $unidadUsuario?>" id="unidad"/>
	<input type="hidden" value="<?echo $fecha?>" id="fecha"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite" id="textFechaLimite"/>
	<input type="hidden" value="" name="textFechaTermino" id="textFechaTermino"/>
	<div id="cubreFondo" style="display:none;"></div>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">COMISI&Oacute;N DE SERVICIO</div>
		<div id="subtitulo">En esta lista se encuentra el personal con comisi&oacute;n de servicio.</a></div>
		<div style="height:68px"></div>
		<table width="100%">
	    <tr>
		    <td width="25%"><input type="button" name="btnNuevaReunion" id="btn100" value="AGREGAR NUEVA COMISION DE SERVICIO" onClick="javascript:abrirVentana('COMISION DE SERVICIO', '920', '450','fichaActividadFueraCuartel.php?fechaCierre=<? echo $fechaLimite; ?>','','','50','50')" <? if(!$permisoRegistrar) echo "disabled";?>></td>		
            <td width="20%"></td>
            <td width="15%"align="right">NOMBRE&nbsp;:&nbsp;</td>
            <td width="30%"><input id="textBuscar" type="text"></td>
            <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeFuncionarios('<? echo $unidadUsuario; ?>','','');"></td>
	    </tr>
		</table>
		<div style="height:2px"></div>
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>
		<div id="listado">
			<div id="cabeceraGrilla">
				<table cellspacing="1" cellpadding="1" width="100%">
	        <tr>
	          <td id="nombreColumna" width="4%" align="center">No.</td>
	          <td id="colCodigo" class="nombreColumna" width="10%" align="center" onmousedown="cambiaOrdenLista(this,'codigo','desc','<?echo $unidadUsuario?>')"><label id="labColCodigo">CODIGO</label></td>
	          <td id="colNombre" class="nombreColumna" width="28%" align="center" onmousedown="cambiaOrdenLista(this,'nombre','desc','<?echo $unidadUsuario?>')"><label id="labColNombre">NOMBRE</label></td>
			  <td id="colTipo" class="nombreColumna" width="23%" align="center" onmousedown="cambiaOrdenLista(this,'tipo','desc','<?echo $unidadUsuario?>')"><label id="labColTipo">TIPO</label></td>
			  <td id="colFechaI" class="nombreColumna" width="10%" align="center" onmousedown="cambiaOrdenLista(this,'fechaI','desc','<?echo $unidadUsuario?>')"><label id="labColFechaI">FECHA INICIO</label></td>
	          <td id="colFechaT" class="nombreColumna" width="10%" align="center" onmousedown="cambiaOrdenLista(this,'fechaT','desc','<?echo $unidadUsuario?>')"><label id="labColFechaT">FECHA TERMINO</label></td>
	          <td id="colConstancia" class="nombreColumna" width="10%" align="center" onmousedown="cambiaOrdenLista(this,'constancia','desc','<?echo $unidadUsuario?>')"><label id="labColConstancia">CONSTANCIA</label></td>
	        </tr>
	     </table>
		  </div>
			<div id="listadoFuncionarios"></div>
		</div>
			<div style="height:2px"></div>
			<table width="100%"><tr class="linea"><td></td></tr></table>
		</div>
</body>
</html>
<?
	echo "<script>";
	echo "leeFuncionarios('".$unidadUsuario."','','');";
	echo "</script>";
?>