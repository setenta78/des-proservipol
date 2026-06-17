<?
include("version.php");
include("session.php");
include("tiempo.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>   
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/requerimiento.js?v=<?echo version?>"></script>  
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
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite"/>
	<input type="hidden" value="<?echo $codigoFuncionarioUsuario?>" name="usuario"/>
	<div id="cubreFondo" style="display:none;"></div>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">SOLICITUDES</div>
		<div id="subtitulo">En esta lista se encuentran las solicitudes de requerimientos realizadas por las Unidades.</div>
		<div style="height:90px"></div>
		<table width="100%">   
		    <tr> 
		      <td width="25%">
		      		<input type="button" name="btnNuevaReunion" id="btn100" value="AGREGAR SOLICITUD" onClick="javascript:abrirVentana('AGREGAR SOLICITUD ... ', '720', '575','fichaSolicitud.php','','','5','5')" disabled>
		      </td>		
			  <td width="15%"align="right">SOLICITUD&nbsp;:&nbsp;</td>
			  <td width="30%"><input id="textBuscar" type="text"></td>
			  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeFuncionarios('<? echo $unidadUsuario ?>','','');" disabled></td>
			  <td width="20%"><input type="button" id="btn100" value="BUSQUEDA AVANZADA >>>" disabled></td>
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
		          <td id="colNombre" class="nombreColumna" width="10%" align="center"  onmousedown="cambiaOrdenLista(this,'nombre','desc','<?echo $unidadUsuario?>')"><label id="labColNombre">UNIDAD</label></td>
		          <td id="colCodigo" class="nombreColumna" width="10%" align="center"  onmousedown="cambiaOrdenLista(this,'codigo','desc','<?echo $unidadUsuario?>')"><label id="labColCodigo">REQUERIMIENTO MODULO</label></td>
		          <td id="colNombre" class="nombreColumna" width="38%" align="center"  onmousedown="cambiaOrdenLista(this,'nombre','desc','<?echo $unidadUsuario?>')"><label id="labColNombre">GRUPO</label></td>
		          <!--<td id="colGrado"  class="nombreColumna" width="20%" align="center"  onmousedown="cambiaOrdenLista(this,'grado','desc','<?echo $unidadUsuario?>')"><label id="labColGrado">IDENTFICADOR</label></td> -->
		          <td id="colCargo"  class="nombreColumna" width="28%" align="center"  onmousedown="cambiaOrdenLista(this,'cargo','desc','<?echo $unidadUsuario?>')"><label id="labColCargo">ESTADO ACTUAL</label></td>
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
	echo "leeFuncionarios27('".$unidadUsuario."','','','".$codigoFuncionarioUsuario."');";
	echo "</script>";
?>