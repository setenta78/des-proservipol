<?
include("version.php");
include("session.php");
$codigoFuncionario 				= $_GET['codFuncionario'];
$nombreCompletoUsuario 		= $_GET['nombre'];
$gradoUsuario 						= $_GET['grado'];
$version							 		= $_GET['version'];
$fecha				 	 					= $_GET['fecha'];
$codigoPerfilUsuario			= $_GET['codPerfil'];
$descripcionPerfilUsuario	= $_GET['descPerfil'];
$codigoCargo							= $_GET['codCargo'];
$fechaCargo								= $_GET['fechaCargo'];
$unidadAgregado						= $_GET['unidadAgregado'];
$contrasena								= $_SESSION['USUARIO_CLAVE'];
$codigoUnidad 						= $_SESSION['USUARIO_CODIGOUNIDAD'];
if($codigoPerfilUsuario=="") $codigoPerfilUsuario = 0; 
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaCapacitados.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/capacitados.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#f5fbf3; overflow-y:hidden; overflow-x:hidden;" scroll="no" onload="javascript:document.getElementById('selPerfil').value='<? echo $codigoPerfilUsuario; ?>'; maximoUsuario();">
<input id="textPerfilActual" type="hidden" value="<?echo $codigoPerfilUsuario?>">
<input id="textcodFuncionario" type="hidden" value="<?echo $codigoFuncionario?>">
<input id="textCodCargo" type="hidden" value="<?echo $codigoCargo?>">
<input id="textFechaCargo" type="hidden" value="<?echo $fechaCargo?>">
<input id="contrasena" type="hidden" value="<?echo $contrasena?>">
<input id="codigoUnidad" type="hidden" value="<?echo $codigoUnidad?>">
<input id="unidadAgregado" type="hidden" value="<?echo $unidadAgregado?>">
<input id="titulares" type="hidden" value="">
<input id="suplentes" type="hidden" value="">
<input id="maximo" type="hidden" value="5">
<div id="cubreVentana" style="display:none;" ><table width="100%"><tr><td align="right" width="35%"></td></tr></table></div>
<div id="ventanaCambiaPerfil" style="display:none;">
	<div id="usuarioCuadro"><div align="center" id="tituloClave">ATENCION</div></div>
	<div id="usuarioCuadro"><div id="txtMensaje" align="center"></div></div>
	<table width="100%">
		<tr> 
		  <td width="20%"></td>
	 	  <td width="20%">&nbsp;</td>
	 	  <td width="20%">&nbsp;</td>
	    <td width="20%"><input type="button" id="btn100" value="SI" onClick="validaCambiarPerfil()"></td>
	    <td width="20%"><input type="button" id="btn100" value="NO" onClick="cerrarCambiarPerfil()"></td>
		</tr>
	</table>
</div>

<div id="ventanaValidaCambioPerfil" style="display:none;">
	<div id="usuarioCuadro"><div align="center" id="tituloClave">ASIGNAR PERFIL</div></div>
	<div id="usuarioCuadro">
		<table cellpadding="10" cellspacing="0" width="100%">
			<tr>
				<td width="50%" align="right">CONTRASEÑA&nbsp;:&nbsp;</td>
				<td width="20%"><input id="textClave" type="password" maxlength="10"></td>
				<td width="30%"></td>
			</tr>
			<tr>
				<td colspan="3"><div id="txtMensajeP">(*) Ingrese su contraseña para validar el cambio de perfil y activación de la cuenta de acceso</div></td>
			</tr>
		</table>
	</div>
	<table width="100%">
		<tr> 
		  <td width="20%"></td>
	 	  <td width="20%">&nbsp;</td>
	 	  <td width="20%">&nbsp;</td>
	    <td width="20%"><div id="btnAceptar"></div></td>
	    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarValidaCambiarPerfil()"></td>
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
					<td width="40%" align="right">VERSION PROSERVIPOL&nbsp;:&nbsp;</td>
					<td width="60%" id="usuarioLabSalida"><?echo $version?></td>
				</tr>
				<tr>
					<td width="40%" align="right">FECHA CAPACITACION&nbsp;:&nbsp;</td>
					<td width="60%" id="usuarioLabSalida"><?echo $fecha?></td>
				</tr>
			</table>
		</div>
		<div id="usuarioCuadro">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="40%" align="right">PERFIL ACTUAL&nbsp;:&nbsp;</td>
					<td width="60%" id="usuarioLabSalida"><?echo $descripcionPerfilUsuario?></td>
				</tr>
				<tr>
					<td width="40%" align="right">NUEVO PERFIL&nbsp;:&nbsp;</td>
					<td width="60%" id="usuarioLabSalida"><select id="selPerfil" onChange="habilitaFecha();"><option value="0">SELECCCIONE UNA OPCION ... </option><option value="10">TITULAR</option><option value="20">SUPLENTE</option></select></td>
				</tr>
				<tr>
					<td width="40%" align="right">FECHA&nbsp;:&nbsp;</td>
					<td width="60%" id="usuarioLabSalida" >
						<input type="text" id="txtfecha" name="txtfecha" size="10" value="" readonly="yes" <? if($codigoPerfilUsuario!=10) echo "disabled";?> >&nbsp;&nbsp;&nbsp;&nbsp;
						<input id="idFechaServicio" name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="14" onClick="displayCalendar(txtfecha,'dd-mm-yyyy',this,-110,-20);" <? if($codigoPerfilUsuario!=10) echo "disabled";?> >
					</td>
				</tr>
			</table>
		</div>
		<div id="labFechaCargoDesde">(*) FECHA QUE REGISTRA EL CARGO ACTUAL : <?echo $fechaCargo?></div>
	</div>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr style="padding: 5px 0px 0px 50px">
		  <td width="25%"><input type="button" id="usuarioBotonModificar" name="usuarioBotonModificar" value="ASIGNAR PERFIL" onClick="cambiarPerfil('cambiar')"></td>
		  <td width="25%"><input type="button" id="usuarioBotonBorrar" name="usuarioBotonBorrar" value="BORRAR PERFIL" onClick="cambiarPerfil('borrar')" <? if($codigoPerfilUsuario==0) echo "disabled";?>></td>
	    <td width="25%"><input type="button" id="usuarioBotonCerrar" name="usuarioBotonCerrar" value="CERRAR" onClick="top.cerrarVentana('ventanaUsuario');"></td>
		</tr>
	</table>
</div>
</body>
</html>