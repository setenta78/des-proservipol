<?
include("version.php");
include("session.php");
include("tiempo.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr" >
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php")?>
</head>
<body>
<div id="cubreFondo" style="display:none;"></div>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
	<div id="titulo">GESTI&Oacute;N DE USUARIO</div>
	<div id="subtitulo">Aplicativo para la asignaci&oacute;n, modificaci&oacute;n y eliminaci&oacute;n de las claves de usuario del sistema Proservipol</div>
	<div style="height:30px"></div>
	<table width="100%">
	    <tr>
	      <td width="25%">
	      	<input type="button" name="btnNueva" id="btn100" value="BUSCAR USUARIO" onClick="fichaClaveUsuario.className='fichaActiva';" >
	      </td>
		  <td width="20%">&nbsp;</td>
		  <td width="15%" align="right">UNIDAD&nbsp;:&nbsp;</td>
		  <td width="30%"><input id="textUnidad" type="text" style="text-transform:uppercase" onKeyup="console.log(this.value)" /></td>
		  <td width="10%" >&nbsp;</td>
	    </tr>
		</table>
	<div style="height:20px"></div>
	<table width="100%"><tr class="linea" ><td></td></tr></table>
	<div style="height:2px"></div>
	<div id="listado">
		
	</div>
	<div style="height:2px"></div>
	<table width="100%"><tr class="linea"><td></td></tr></table>
</div>
<? include("fichaClaveUsuario.php"); ?>
</body>
</html>
<?
if($codigoPerfilOrigen!=90){
	session_unset();
	session_destroy();
	echo '<script type="text/javascript">alert("Acceso Restringido"); window.location.href="index.php";</script>';
}
?>
<script>
//console.log(getCookie('token'));
</script>