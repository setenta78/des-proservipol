<?include("session.php")?>
<?include("tiempo.php")?>
<?
	$codigoFuncionario 			= $_SESSION['USUARIO_CODIGOFUNCIONARIO']; 	
	$nombreCompletoUsuario 		= $_SESSION['USUARIO_NOMBRE']; 
	$descripcionUnidadUsuario 	= $_SESSION['USUARIO_DESCRIPCIONUNIDAD']; 
	$userName 	 				= $_SESSION['USUARIO_USERNAME']; 
	//$clave 		 				= $_SESSION['USUARIO_CLAVE'];
	$gradoUsuario 				= $_SESSION['USUARIO_GRADO'];
	$descripcionPerfilUsuario	= $_SESSION['USUARIO_PERFIL'];
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/fichaUsuario.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/usuario.js"></script>

</head>
<body style="background-color:#d0d0d0; overflow-y:hidden; overflow-x:hidden;" scroll="no">
<div id="ventanaCambiaContraseña" style="display:none;">
		<div id="usuarioCuadro">
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="60%" align="right">CONTRASEÑA ACTUAL&nbsp;:&nbsp;</td>
				<td width="20%"><input id="textClaveActual" type="password" maxlength="10"></td>
				<td width="20%"></td>
			</tr>
			</table>
		</div>
		<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="60%" align="right">INGRESE NUEVA CONTRASEÑA &nbsp;:&nbsp;</td>
				<td width="20%"><input id="textClaveNueva" type="password" maxlength="10"></td>
				<td width="20%"></td>
			</tr>
			<tr>
				<td align="right">REINGRESE NUEVA CONTRASEÑA &nbsp;:&nbsp;</td>
				<td><input id="textClaveNueva2" type="password" maxlength="10"></td>
				<td></td>
			</tr>
		</table>
		</div>
		<table width="100%">
		<tr> 
			  <td width="20%"></td>
		   	  <td width="20%">&nbsp;</td>
		   	  <td width="20%">&nbsp;</td>
		      <td width="20%"><input type="button" id="btn100" value="ACEPTAR" onClick="aceptarCambiarContrasena('<?echo $codigoFuncionario?>')"></td>        
		      <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarCambiarContrasena()"></td>
		</tr>
		</table>
</div>

<div style="width:95%;float:left">
	<div id="usuarioMarcoLevantado">
		<div id="usuarioCuadro">
		<table cellpadding="1" cellspacing="0" width="100%">
			<tr>
				<td width="40%" align="right">CODIGO FUNCIONARIO&nbsp;:&nbsp;</td>
				<td width="60%" id="usuarioLabSalida"><?echo $codigoFuncionario?></td>
			</tr>
			<tr>
				<td align="right">GRADO&nbsp;:&nbsp;</td>
				<td id="usuarioLabSalida"><?echo $gradoUsuario?></td>
			</tr>
			<tr>
				<td align="right">NOMBRE&nbsp;:&nbsp;</td>
				<td id="usuarioLabSalida"><?echo $nombreCompletoUsuario?></td>
			</tr>
		</table>
		</div>
		<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="40%" align="right">UNIDAD&nbsp;:&nbsp;</td>
				<td width="60%" id="usuarioLabSalida"><?echo $descripcionUnidadUsuario?></td>
			</tr>
		</table>
		</div>
		<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="40%" align="right">PERFIL&nbsp;:&nbsp;</td>
				<td width="60%" id="usuarioLabSalida"><?echo $descripcionPerfilUsuario?></td>
			</tr>
			<tr>
				<td align="right">NOMBRE DE USUARIO&nbsp;:&nbsp;</td>
				<td id="usuarioLabSalida"><?echo $userName?></td>
			</tr>
		</table>
		</div>
		<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td width="40%" align="right">CONTRASEÑA&nbsp;:&nbsp;</td>
				<td width="60%" id="usuarioLabSalida">*******</td>
			</tr>
		</table>
		</div>
	</div>
	<table width="104.4%" cellpadding="0" cellspacing="0" border="0">
	<tr style="padding: 2px 0px 0px 0px"> 
	  <td width="40%"><input type="button" id="usuarioBotonModificar" value="MODIFICAR CONTRASEÑA" onClick="cambiarContrasena()"></td>
	  <td width="25%"></td>
      <td width="35%"><input type="button" id="usuarioBotonCerrar" value="CERRAR" onClick="top.cerrarVentana('ventanaUsuario');"></td>
	</tr>
	</table>
</div>

</body>
</html>