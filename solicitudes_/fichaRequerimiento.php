<?include("session.php")?>   
<?include("tiempo.php")?>
<?
  $fechaRequerimiento   = date("d-m-Y");
	$codigoFuncionario 		= $_GET["codigoFuncionario"];
	$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
	$unidadPadre		    	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	$tipoUnidad			      = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion añadida el 14-09-2015
	$contieneHijos        = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de sesion añadida el 17-04-2015
	$usuario              = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
?>
<html>
<head>
<title>REQUERIMIENTOS ...</title>	
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/requerimiento.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./css/fichaServicio.css" rel="stylesheet" type="text/css">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">


</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" scroll="no">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="usuario"  type="hidden" readonly="yes" value="<?echo $usuario?>">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>"><!--Variable oculta añadida el 14-09-2015-->
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!--Variable oculta añadida el 17-04-2015-->
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="codigo" value="">

<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<u><b>SOLICITUD DE REQUERIMIENTO</b></u>
<br><br>
<div id="marcoLevantado">
<div id="pantalla1">
<fieldset>
<legend><b>DATOS DE LA UNIDAD</b></legend>
<br>
<table border="0">
<tr>
<td>ZONA</td>	
<td>PREFECTURA</td>
<td>COMISARIA</td>	
<td>DESTACAMENTO</td>
</tr>
<tr>
<td><input type="text" id="zona"/></td>	
<td><input type="text" id="pref"/></td>	
<td><input type="text" id="com"/></td>	
<td><input type="text" id="dest"/></td>	
</tr>
</table>	
</fieldset>
</div>	
<br><br>
<div id="pantalla2">
<fieldset>
<legend><b>DATOS DEL USUARIO</b></legend>
<br>
<table border="0">
<tr>
<td>CODIGO</td>	
<td>GRADO</td>	
<td>NOMBRE</td>
<td>PERFIL</td>	
</tr>
<tr>
<td><input type="text" id="codFun"/></td>	
<td><input type="text" id="grado"/></td>	
<td><input type="text" id="nom"/></td>	
<td><input type="text" id="perfil"/></td>	
</tr>
</table>	
</fieldset>
</div>	
<br><br>
<div id="pantalla3">
<fieldset>
<legend><b>REQUERIMIENTO PROSERVIPOL V3.0</b></legend>
<br>
<table border="0">
<tr>
<td>TIPO REQUERIMIENTO</td>	
<td><select id="cboRequerimiento">
  <option value="0">SELECCIONE REQUERIMIENTO ...</option>
  <option value="10">PROBLEMA SISTEMA</option>
  <option value="20">DESVALIDACION</option>
  <option value="30">LICENCIA MATERNAL PRE NATAL</option>
</select></td>	
</tr>
<tr>	
<td>MODULO</td>
<td><select id="cboModulo">
  <option value="0">SELECCIONE MODULO ...</option>
  <option value="10">SERVICIOS</option>
  <option value="20">PERSONAL</option>
  <option value="30">VEHICULOS</option>
</select></td>	
</tr>
<tr>
<td>PROBLEMA</td>
<td><select id="cboProblema">
  <option value="0">SELECCIONE PROBLEMA ...</option>
  <option value="10">SERVICIOS</option>
  <option value="20">PERSONAL</option>
  <option value="30">VEHICULOS</option>
</select></td>	
</tr>
</table>	
<br>
<table border="0">
<tr>
<td>IDENTIFICADOR</td>
</tr>	
<tr>
<td><input type="text" id="identificador" value=""/></td>		
</tr>
</table>
<br>
<table border="0">
<tr>
<td>OBSERVACION</td>
</tr>	
<tr>
<td><textarea name="obs" id="obs" rows="4" cols="50"></textarea></td>		
</tr>
</table>
<br>
<table border="0">
<tr>
<td>INICIO SOLICITUD</td>
<td><input type="text" id="fSolicitud" value="<?echo $fechaRequerimiento?>"/></td>	
</tr>	
</table>
</fieldset>
</div>	
</div>
<br>
<table width="95%">
<td width="10%">&nbsp;</td>
<td width="10%">&nbsp;</td>
<td width="10%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="ENVIAR" onClick="guardarFichaCaballo();"></td>
<td width="10%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();"></td>	
</tr>	
</table>
</body>
</html>
<?
	echo "<script>";
  echo "leedatosUsuario(".$unidadUsuario.",'".$usuario."');\n";
  echo "</script>";	 
?>