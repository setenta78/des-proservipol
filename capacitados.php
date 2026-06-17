<?
include("version.php");
include("session.php");
$subSeccion    = $_GET['subSeccion'];
$contieneHijos = $_SESSION['USUARIO_CONTIENEHIJOS'];
$tipoUnidad	   = $_SESSION['USUARIO_TIPOUNIDAD'];
$codigoPerfil  = $_SESSION['USUARIO_CODIGOPERFIL'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programaci&oacute;n de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>   
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/capacitados.js?v=<?echo version?>"></script>  
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?
include("header.php");
include("tiempo.php");
?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
<input type="hidden" value="<?echo $unidadBloqueada?>" id="textUnidadBloqueada" name="textUnidadBloqueada"/>
<input type="hidden" value="<?echo $fechaLimite?>" id="textFechaLimite" name="textFechaLimite"/>
<input type="hidden" value="<?echo $codigoPerfil?>" id="textPerfilUsuario" name="textPerfilUsuario"/>
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<div id="cubreFondo" style="display:none;"></div>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
	<div id="titulo">PERSONAL CAPACITADO</div>
	<div id="subtitulo">En esta lista se encuentra el personal capacitado para ser encargado Proservipol</div>
	<div style="height:70px"></div>
	<table width="100%"><tr class="linea" ><td></td></tr></table>
	<div style="height:2px"></div>
	<div id="listado">
	<div id="cabeceraGrilla">
		<table cellspacing="1" cellpadding="1" width="100%">
		<tr>
			<td id='nombreColumna' width='3%' align='center'>No.</td>
			<td id='colCodigo' class='nombreColumna' width='7%' align='center' onmousedown=cambiaOrdenLista(this,'codigo','desc','<? echo $unidadUsuario; ?>')><label id='labColCodigo'>CODIGO</label></td>
			<td id='colNombre' class='nombreColumna' width='16%' align='center' onmousedown=cambiaOrdenLista(this,'nombre','desc','<? echo $unidadUsuario; ?>')><label id='labColNombre'>NOMBRE</label></td>
			<td id='colGrado' class='nombreColumna' width='10%' align='center' onmousedown=cambiaOrdenLista(this,'grado','desc','<? echo $unidadUsuario; ?>')><label id='labColGrado'>GRADO</label></td>
			<td id='colCargo'  class='nombreColumna' width='14%' align='center'  onmousedown=cambiaOrdenLista(this,'cargo','desc','<? echo $unidadUsuario; ?>')><label id='labColCargo'>CARGO</label></td>
			<td id='colFecha' class='nombreColumna' width='10%' align='center' onmousedown=cambiaOrdenLista(this,'fecha','desc','<? echo $unidadUsuario; ?>')><label id='labColFecha'>FECHA CAPACITACI&Oacute;N</label></td>
			<td id='colVersion' class='nombreColumna' width='10%' align='center' onmousedown=cambiaOrdenLista(this,'version','desc','<? echo $unidadUsuario; ?>')><label id='labColVersion'>VERSI&Oacute;N PROSERVIPOL</label></td>
			<td id='colNota' class='nombreColumna' width='9%' align='center' onmousedown=cambiaOrdenLista(this,'nota','desc','<? echo $unidadUsuario; ?>')><label id='labColNota'>NOTA PROSERVIPOL</label></td>
			<td id='colCapacitado' class='nombreColumna' width='7%' align='center' onmousedown=cambiaOrdenLista(this,'capacitado','desc','<? echo $unidadUsuario; ?>')><label id='labColCapacitado'>PERFIL</label></td>
			<td id='colFechaPerfil' class='nombreColumna' width='9%' align='center' onmousedown=cambiaOrdenLista(this,'fechaPerfil','desc','<? echo $unidadUsuario; ?>')><label id='labColFechaPerfil'>FECHA ASIGNACI&Oacute;N</label></td>
			<td id='colCertificado' class='nombreColumna' width='5%' align='center' onmousedown=cambiaOrdenLista(this,'codigo','desc','<? echo $unidadUsuario; ?>')><label id='labColCertificado'>CERTIFICADO</label></td>
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