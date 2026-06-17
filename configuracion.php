<?
include("session.php");
include("tiempo.php");
$tienePlanCuadrante = $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>   
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/usuario.js"></script>  
<script type="text/javascript" src="./js/cuadrante.js"></script>
<script type="text/javascript" src="./js/configuracion.js"></script>
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
		<div id="titulo">Configuración</div>
		<div id="subtitulo">Aqui Encontrará información de la Unidad</div>
		<div style="height:25px"></div>
		<table width="100%">
		    <tr>
		      <td width="28%" valign="bottom"><div id="subtitulo"><?if ($tienePlanCuadrante == 1) echo "CUARTEL POLICIAL CON PLAN CUADRANTE"; else echo "CUARTEL POLICIAL SIN PLAN CUADRANTE"?></div></td>		
			  <td width="25%">&nbsp;</td>
			  <td width="15%">&nbsp;</td>
			  <td width="2%">&nbsp;</td>
			  <td width="10%">&nbsp;</td>
			  <td width="20%"><input type="button" id="btnMostrarCuadrantes" name="btnMostrarCuadrantes" value="MOSTRAR >>>" onClick="mostrarCuadrantes()"></td>
		    </tr>
		</table>
		<table width="100%"><tr class="linea"><td></td></tr></table>
		<div id="muestraCuadrantes" style="visibility: hidden;">
			<table cellspacing="1" cellpadding="1" width="100%">
			<tr>
			  <td id="nombreColumna" width="5%" align="center">No.</td>
			  <td id="nombreColumna" width="25%" align="center">NOMBRE CUADRANTE</td>
			  <td id="nombreColumna" width="70%" align="center">LIMITES</td>
			</tr>
			</table>
			<div id="listadoCuadrantes"></div>
			<table width="100%"><tr class="linea"><td></td></tr></table>
		</div>
	</div>
</body>
</html>
<?
	echo "<script>";
	echo "leeCuadrantes('".$unidadUsuario."',true,'',false);";
	echo "</script>";
?>