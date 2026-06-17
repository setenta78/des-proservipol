<?
include("version.php");
include("session.php");
include("tiempo.php");
$codigoFuncionario 	= $_GET["codigoFuncionario"];
$codigoColor		= $_GET["codColor"];
$codigoFolio		= $_GET["codFolio"];
$unidadUsuario	   	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$tienePlanCuadrante	= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad			= $_SESSION['USUARIO_TIPOUNIDAD'];
$ip					= $_SESSION['DIRECCION_IP'];
$codPerfil	 	 	= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
$fecha              = date("Y-m-d");
?>
<html>
<head>
<title>LICENCIAS MEDICAS ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/licenciaMedica.js?v=<?echo version?>" charset="utf-8"></script>
<script type="text/javascript" src="./ventana/js/prototype.js?v=<?echo version?>"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaLicenciaMedica.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
</head>
<body style="margin-top:10; margin-left:10; background-color:#f0f6ef" scroll="no" onload="rutUsuario();cargaEspecialidades(); buscaDatosFichaLicencia();">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="cargoBaseDatos" type="hidden" readonly="yes">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codCuadranteBaseDatos" type="hidden" readonly="yes">
<input id="fecha"  type="hidden" readonly="yes" value="<?echo $fecha?>">
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="origenBaseDatos">
<input type="hidden" id="IpFuncionario" name="IpFuncionario" value="<? echo $ip; ?>">
<input type="hidden" id="unidadFuncionario" name="unidadFuncionario" value="">
<input type="hidden" id="codigoFuncionario" name="codigoFuncionario" value="<? echo $codigoFuncionario; ?>">
<input type="hidden" id="rutUsuario" name="rutUsuario" value="">
<input type="hidden" id="reparticionCodigo" name="reparticionCodigo" value="">
<input type="hidden" id="reparticionDescripcion" name="reparticionDescripcion" value="">
<input type="hidden" id="fechaTerminoInicial" name="fechaTerminoInicial" value="">
<input type="hidden" id="servicio" name="servicio" value="">
<input type="hidden" id="fechaTerminoReal" name="fechaTerminoReal" value="">
<input type="hidden" id="UltimoEstado" name="UltimoEstado" value="">
<? if($codigoFuncionario=="") echo '<input type="hidden" id="textFechaTermino" name="textFechaTermino" value="">'; ?>
<input id="perfil" type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="marcoLevantado">
<br>
<div id="seccion2">
<div id="seccion1" align="right">
<table id="tabla1" border="0" >
<tr>
<td align="right"><b><? if($codigoFuncionario=="") echo '(*)'; ?> FOLIO:</b></td>
<td>
<select id="Listcolor" name="Listcolor" onchange="validaPermiso();" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> >
	<option value="">SELECCIONE UNA OPCION ...</option>
	<option value="AA">LICENCIA INSTITUCIONAL</option>
	<option value="B">LICENCIA DIPRECA</option>
	<option value="N">LICENCIA ARMADA</option>
	<option value="E">LICENCIA EJERCITO</option>
	<option value="F">LICENCIA FACH</option>
	<option value="1">LICENCIA FONASA</option>
	<option value="2">LICENCIA ISAPRE</option>
	<option value="3">LICENCIA HOSPITAL PUBLICO O MEDICO EXTERNO</option>
	<option value="PP">PERMISO POSTNATAL PARENTAL</option>
	<option value="PV">PERMISO PARENTAL PREVENTIVO S/G/R LEY 21351</option>
	<option value="MP">RESOLUCI&Oacute;N MEDICINA PREVENTIVA</option>
	<option value="RL">RELA</option>
</select>
<input type="hidden" id="txtcolor" name="txtcolor" size="1" style="text-transform:uppercase;" value="<? echo $codigoColor; ?>" readonly="yes" >
</td>
<td></td>
<td><input type="text" id="txtfolio" name="txtfolio" size="14" value="<? echo $codigoFolio; ?>" maxlength="10" value="" onKeypress="/* return solo_num(event) */" onblur="validarSubir();" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> ></td>
</tr>
</table>
</div>
<u><b>SECCION A: USO Y RESPONSABILIDAD EXCLUSIVA DEL PROFESIONAL</b></u>
<br><br>
<fieldset>
<legend><b>A.1 IDENTIFICACI&Oacute;N DEL TRABAJADOR</b></legend>
<br>
<table id="tabla2" width="100%" border="0">
<tr>
<td align="center"><input type="text" id="txtape1" name="txtape1" size="15" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtape2" name="txtape2" size="15" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtnom" name="txtnom" size="20" value="" readonly="yes"></td>
<td align="center"><input type="text" id="txtrut" name="txtrut" value="" size="15" maxlength="9" onKeypress="return solo_rut(event)" onblur="formato_rut(this);" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> ></td>
<td><img src="img/busqueda.png"  width="23" height="23" alt="Consultar Datos ..."/></td>
<td rowspan="6"><img id="fotoFuncionario" width="121" height="119" align="left" src="./img/sinFoto.png" onerror="this.src='./img/sinFoto.png'"></td>
</tr>
<tr>
<td align="center">APELLIDO PATERNO</td>
<td align="center">APELLIDO MATERNO</td>
<td align="center">NOMBRES</td>
<td align="center"><? if($codigoFuncionario=="") echo '(*)'; ?> RUN </td>
<td></td>
</tr>
<tr>
<td align="center"><input type="text" id="txtfechaO" name="txtfechaO" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfechaO,'dd-mm-yyyy',this,-100,-100);" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?>></td>
<? if($codigoFuncionario=="") echo '<td></td>'; ?>
<td align="center"><input type="text" id="txtfechaI" name="txtfechaI" size="10" onchange="activarInicioReal()" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfechaI,'dd-mm-yyyy',this,-100,-195);" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> ></td>
<? if($codigoFuncionario!="") echo '<td align="center"><input type="text" id="textFechaTermino" name="textFechaTermino" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaTerminoI,\'dd-mm-yyyy\',this,-100,-195);" disabled="disable"></td>'; ?>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"><? if($codigoFuncionario=="") echo '(*)'; ?> FECHA OTORGAMIENTO</td>
<? if($codigoFuncionario=="") echo '<td></td>'; ?>
<td align="center"><? if($codigoFuncionario=="") echo '(*)'; ?> FECHA INICIO REPOSO</td>
<? if($codigoFuncionario!="") echo '<td align="center"> FECHA TERMINO REPOSO</td>'; ?>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"><input type="text" id="txtdias" name="txtdias" size="3" maxlength="3" onKeypress="return solo_num(event)" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> ></td>
<? if($codigoFuncionario=="") echo '<td></td>'; ?>
<td align="center"><div id="seccion1a" <? if($codigoFuncionario=="") echo 'style="display:none;"'; ?> ><input type="text" id="fechaInicioReal" name="fechaInicioReal" size="10" value="" readonly="yes"></div></td>
<? if($codigoFuncionario!="") echo '<td align="center"><input type="text" id="txtfecF" name="txtfecF" size="10" value="" readonly="yes"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13"  onClick="displayCalendar(txtfecF,\'dd-mm-yyyy\',this,-100,-195);" ></td>'; ?>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"><? if($codigoFuncionario=="") echo '(*)'; ?> Nro DE DIAS</td>
<? if($codigoFuncionario=="") echo '<td></td> <td align="center"> FECHA REAL INICIO <input type="checkbox" id="optionInicio" name="optionInicio" onclick="inicioReal();" disabled></td>'; else echo '<td align="center"> FECHA REAL INICIO </td>'; ?>
<? if($codigoFuncionario!="") echo '<td align="center">FECHA TERMINO ANTICIPADO (*)</td>'; ?>
<td></td>
<td></td>
</tr>
</table>
</fieldset>
</div>
<br>
<div id="seccion3">
<fieldset>
<legend><b>A.2 TIPO LICENCIA</b></legend>
<br>
<table id="tabla4" border="0">
<tr>
<td><select id="cboLicencia" onchange="hijomenor()" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> >
  <option value="0">SELECCIONE UNA OPCION ...</option>
  <option value="633">ENFERMEDAD O ACCIDENTE COMUN</option>
  <option value="632">PRORROGA MEDICINA PREVENTIVA</option>
  <option value="170">LICENCIA MATERNAL PRE Y POST NATAL</option>
  <option value="162">ENFERMEDAD GRAVE HIJO MENOR DE UN A&Ntilde;O</option>
  <option value="718">ACCIDENTE EN ACTO DE SERVICIO</option>
  <option value="630">ENFERMEDAD PROFESIONAL</option>
  <option value="631">PATOLOGIA DEL EMBARAZO</option>
  <option value="849">LICENCIA MEDICA PREVENTIVA PARENTAL</option>
  <option value="925">LICENCIA SANNA</option>
</select></td>
<td>&nbsp;&nbsp;<b><? if($codigoFuncionario=="") echo '(*)'; ?> RECUPERABILIDAD LABORAL:</b></td>
<?
if($codigoFuncionario==""){
	echo'<td>SI</td>
			<td><input type="radio" id="optionRecup" name="optionRecup" value=1 checked="checked"></td>
			<td>NO</td>
			<td><input type="radio" id="optionRecup" name="optionRecup" value=2 ></td>';
}
else{
	echo '<td>SI</td>
				<td><input type="radio" id="optionRecup1" name="optionRecup" value=1 disabled="disabled"></td>
				<td>NO</td>
				<td><input type="radio" id="optionRecup2" name="optionRecup" value=2 disabled="disabled"></td>';
}
?>
</tr>
<tr>
<td></td>
<td>&nbsp;&nbsp;<b><? if($codigoFuncionario=="") echo '(*)'; ?> INICIO TRAMITE INVALIDEZ:</b></td>
<?
if($codigoFuncionario==""){
	echo'<td>SI</td>
			<td><input type="radio" id="optionInvalidez" name="optionInvalidez" value="1" ></td>
			<td>NO</td>
			<td><input type="radio" id="optionInvalidez" name="optionInvalidez" value="2" checked="checked" ></td>';
}
else{
	echo '<td>SI</td>
			<td><input type="radio" id="optionInvalidez1" name="optionInvalidez1" value="1" disabled="disabled"></td>
			<td>NO</td>
			<td><input type="radio" id="optionInvalidez2" name="optionInvalidez2" value="2" disabled="disabled"></td>';
}
?>
</tr>
</table>
<br>
</fieldset>
</div>
<div id="seccion3a" style="display:none;">
<br>
<fieldset>
<legend><b> IDENTIFICACI&Oacute;N DEL HIJO</b></legend>
<br>
Solo para licencias por enfermedad grave hijo menor de un a&ntilde;o y post natales (Art. 199 y 200 del C. del trabajo) y juicio de adopcion plena (Ley 18.867)
<br><br>
<table id="tabla3" border="0">
<tr>
<td align="center"><input type="text" id="txtruth" name="txtruth" size="15" maxlength="9" onKeypress="return solo_rut(event)" onblur="formato_rut(this)" <? if($codigoFuncionario!="") echo 'readonly="yes"'; ?> ></td>
<td align="center"><input type="text" id="txtfec3" name="txtfec3" size="10" value="" <? if($codigoFuncionario!="") echo 'readonly="yes"'; ?> ></td>
<td><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfec3,'dd-mm-yyyy',this,-100,-195);"></td>
</tr>
<tr>
<td align="center">RUN</td>
<td align="center">FECHA DE NACIMIENTO</td>
<td></td>
</tr>
</table>
</fieldset>
</div>
<br>
<div id="seccion4">
<fieldset>
<legend><b>A.3 CARACTERISTICAS DEL REPOSO</b></legend>
<br>
<table id="tabla5" border="0">
<tr>
<td>
	<select id="cboReposo" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?>>
	  <option value="0">SELECCIONE UNA OPCION ...</option>
	  <option value="1">REPOSO LABORAL TOTAL</option>
	  <option value="2">REPOSO LABORAL PARCIAL</option>
	</select>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><? if($codigoFuncionario=="") echo '(*)'; ?> LUGAR DE REPOSO:</b></td>
<?
if($codigoFuncionario==""){
	echo '<td>DOMICILIO</td>
	<td><input type="radio" id="optionReposo" name="optionReposo" value="1" checked="checked" ></td>
	<td>HOSPITAL</td>
	<td><input type="radio" id="optionReposo" name="optionReposo" value="2" ></td>
	<td>OTRO</td>
	<td><input type="radio" id="optionReposo" name="optionReposo" value="3" ></td>';
}
else{
	echo '<td>DOMICILIO</td>
	<td><input type="radio" id="optionReposo1" name="optionReposo" value="1" disabled="disabled"></td>
	<td>HOSPITAL</td>
	<td><input type="radio" id="optionReposo2" name="optionReposo" value="2" disabled="disabled"></td>
	<td>OTRO</td>
	<td><input type="radio" id="optionReposo3" name="optionReposo" value="3" disabled="disabled"></td>';
}
?>
</tr>
</table>
</div>
<br>
<div id="seccion5">
<fieldset>
<legend><b>A.4 IDENTIFICACI&Oacute;N DEL PROFESIONAL</b></legend>
<br>
<table id="tabla6" border="0">
<tr>
<td align="center"><input type="text" id="txtrutp" name="txtrutp" size="15" maxlength="9" onKeypress="return solo_rut(event)" onblur="formato_rut(this)" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> ></td>
<td>
</td>
<td>
<div id="seccion5c">
<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? if($codigoFuncionario=="") echo '(*)'; ?> TIPO PROFESIONAL:</b>&nbsp;&nbsp;
<?
if($codigoFuncionario==""){
	echo 'MEDICO<input type="radio" id="optionMed" name="optionMed" value="1" onclick="especialidad()" checked="checked">
				DENTISTA<input type="radio" id="optionDent" name="optionMed" value="2" onclick="especialidad()" >&nbsp;&nbsp;&nbsp;&nbsp;MATRONA<input type="radio"  id="optionMat" name="optionMed" value="3" onclick="especialidad()" >';
}
else{
	echo 'MEDICO<input type="radio" id="optionMed1" name="optionMed" value="1" disabled="disabled">
				DENTISTA<input type="radio" id="optionMed2" name="optionMed" value="2" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;MATRONA<input type="radio"  id="optionMed3" name="optionMed" value="3" disabled="disabled">';
}
?>
</div>
<td></td>
<td></td>
</tr>
<tr>
<td align="center"><b><? if($codigoFuncionario=="") echo '(*)'; ?> RUN PROFESIONAL</b></td>
<td></td>
<td>
<div id="seccion5b">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><? if($codigoFuncionario=="") echo '(*)'; ?> ATENCI&Oacute;N:</b>  
<?
if($codigoFuncionario==""){
	echo 'INSTITUCIONAL<input type="radio" id="optionAte" name="optionAte" value="1" checked="checked" >EXTRA INSTITUCIONAL</b><input type="radio" id="optionAte2" name="optionAte" value="2">';
}
else{
	echo 'INSTITUCIONAL<input type="radio" id="optionAte1" name="optionAte1" value="1" disabled="disabled">EXTRA INSTITUCIONAL</b><input type="radio" id="optionAte2" name="optionAte2" value="2" disabled="disabled">';
}
?>
</div>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
<br>
<div id="seccion5a">
<table>
<tr>
<td><b><? if($codigoFuncionario=="") echo '(*)'; ?> ESPECIALIDAD PROFESIONAL</b></td>
<td></td>
</tr>
<tr>
<td align="center" id="EspecialidadList"><select id="cboEspecialidad" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> ></select></td>
<td></td>
</tr>
</table>
</div>
<br>
</fieldset>
<br>
</div>
</div>
<br>
<table>
<tr align="left">
<form name="formSubeArchivo" action="adjuntarArchivoSubirLicencia.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo">
<td>
<? if($codigoFuncionario=="") echo '<input type="file" size="20" name="archivo" id="archivo" disabled/>'; else echo '<input type="text" id="txtarchivo" name="txtarchivo" size="30" disabled>'; ?>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<? if($codigoFuncionario=="") echo '<input type="button" value="SUBIR" id="btnSubir" name="btnSubir" onClick="subirArchivo(this)"/>'; ?>
<input type="hidden" id="archivoServidor" value="">
<input type="hidden" id="archivoLoad" value=0>
<input type="hidden" id="rutArchi" name="rutArchi" value="">
</form>
</td>
<td width="10%">&nbsp;</td>
<td width="10%">&nbsp;</td>
<?
if(!$permisoRegistrar) $activo = 'disabled'; else $activo = 'enabled';
if($codigoFuncionario==""){
	echo '<td width="20%"><input name="btnGuardarLicencia" type="button" id="btnGuardarLicencia" value="GUARDAR" onClick="guardarFichaLicencia()"></td>
		<td width="17%"><input name="btnBuscarFuncionario" type="button" id="btnBuscarFuncionario" value="BUSCAR" onClick="buscaDatosFuncionario()" disabled></td>';
}
else{
	echo '<td width="20%"><input name="btnGuardarLicencia" type="button" id="btnGuardarLicencia" value="RECORTAR"  '.$activo.' onClick="recortarLicencia()"></td>
		<td width="20%"><input name="btnAnular" type="button" id="btnAnular" value="ANULAR"  '.$activo.' onClick="validaAnularLicencia()"></td>';
}
?>
<td width="14%"><input name="btnCerrarFichaFuncionario" type="button" id="CERRAR" value="CERRAR" onClick="top.cerrarVentana();"></td>
</tr>
</table>
<div id="seccionMensaje">
<b><p id='Mensaje'></p></b>
</div>
</body>
</html>