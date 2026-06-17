<?include("session.php")?>   
<?include("tiempo.php")?>
<?
  $fechaMovimiento      = date("d-m-Y");
  $fechaTermino         = date("Y-m-d");
	$codigoFuncionario 		= $_GET["codigoFuncionario"];
	$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
	$unidadPadre		    	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	$tipoUnidad			      = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion añadida el 14-09-2015
	$contieneHijos        = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de sesion añadida el 17-04-2015
	$usuario              = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	$unidadSolicitud      = $_GET["codigoUnidad"];
	$solicitud            = $_GET["codigo"];
	$codigoPerfil				  = $_SESSION['USUARIO_CODIGOPERFIL'];
	
?>
<html>
<head>
<title>MOVIMIENTOS ....</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">	

<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/requerimiento.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/problema.js"></script>
<script type="text/javascript" src="./js/subproblema.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./css/fichaServicio.css" rel="stylesheet" type="text/css">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">

</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="usuario"  type="hidden" readonly="yes" value="<?echo $usuario?>">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>"><!--Variable oculta añadida el 14-09-2015-->
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!--Variable oculta añadida el 17-04-2015-->
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="codigo" value="">
<input type="hidden" id="codigoSolicitud" value="<?echo $solicitud?>">
<input type="hidden" id="fechaMovimiento" value="<?echo $fechaMovimiento?>">
<input type="hidden" id="fechaTermino" value="<?echo $fechaTermino?>">
<input type="hidden" id="seccion" value="<?echo $seccion?>">
<input type="hidden" id="codigoMovimiento">



<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<u><b>MOVIMIENTOS DE LA SOLICITUD</b></u>
<br><br>
<div id="marcoLevantado">
<br>
<div id="listadoFuncionarios"></div>
<br>
<table width="95%">
<td width="10%">&nbsp;</td>
<td width="10%">&nbsp;</td>
<td width="10%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="ENVIAR" disabled></td>
<td width="10%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();"></td>	
</tr>	
</table>
<div id="listadoFuncionarios"></div>
</body>
</html>
<?
	echo "<script>";
	echo "leeFuncionarios22('".$unidadSolicitud."','".$codigo."');";
	echo "</script>";
?>