<?
include("version.php");
include("session.php");
include("tiempo.php");

$codigoFuncionario	= $_GET["codigoFuncionario"];
$unidadUsuario		= $_SESSION['USUARIO_CODIGOUNIDAD'];
$tienePlanCuadrante	= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$subio				= $_GET["subio"];
$subirArchivo		= $_GET["subirArchivo"];
$nombreArvhio		= $_GET["nombreArvhio"];
$tipoSubir			= $_GET["tipoSubir"];
$codPerfil			= $_SESSION['USUARIO_CODIGOPERFIL_PADRE'];
?>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
	<link href="./css/fichaLicenciaConducir.css?v=<?echo version?>" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/grado.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/cargo.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/cuadrante.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/funcionarios.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/listaMultiple.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/tipoLicenciaConducir.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/comuna.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/licenciaConducir.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
	<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#f5fbf3; padding:10px 0px 0px 10px;" scroll="no" onLoad="inicializaVentanaLicenciaConducir('<?echo $codigoFuncionario?>','<?echo $subio?>','<?echo $tipoSubir?>','<?echo $nombreArvhio?>');">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="cargoBaseDatos" type="hidden" readonly="yes">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codCuadranteBaseDatos" type="hidden" readonly="yes">
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="origenBaseDatos">
<input type="hidden" id="permisoEscritura" value="<? echo ($codPerfil!=70 && $codPerfil!=80 && $codPerfil != 90 && $codPerfil != 100); ?>">
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="cubreVentanaPersonalLC" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"></td></table>
</div>
<div id="divSubirArchivo" style="display:none;">
	<div id="marcoLevantado">
		<table width="100%">
			<form name="formSubeArchivo" action="adjuntarArchivoSubir.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo">
				<input type="hidden" id="nombreArchivoAdjuntoFormateado" name="nombreArchivoAdjuntoFormateado" value="" />
				<input type="hidden" id="codigoFuncionarioPaso" name="codigoFuncionarioPaso" value="<?echo $codigoFuncionario?>" />
				<input type="hidden" id="subirArchivo" name="subirArchivo" value="1" />
				<input type="hidden" id="tipoSubir" name="tipoSubir" />
				<tr><td align="right"colspan="2"><input type="file" name="archivo" id="archivo" /></td></tr>
			</form>
			<tr>
				<td align="right" width="50%"><input type="button" value="CANCELAR" id="btnSubir" onClick="cerrarSubirArvhivo(this)" /></td>
				<td align="right" width="50%"><input type="submit" value="ACEPTAR" id="btnSubir" onClick="aceptarImagenDocumento()" /></td>
			</tr>
		</table>
	</div>
</div>
<div style="width:94%;">
<div id="marcoLevantado">
	<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr>
				<td width="30%" align="right">CODIGO (SIN GUION)&nbsp;:&nbsp;</td>
				<td width="35%"><input id="textCodigoFuncionario" type="text" maxlength="7"></td>
			 	<td width="15%" style="padding:0px 3px 0px 3px;"></td>
				<td width="20%" rowspan="6" style="padding:0px 0px 0px 10px;"><img id="fotoFuncionario" width="121" height="119" align="left" src="./img/sinFoto.png" onerror="this.src='./img/sinFoto.png'"><td>
			</tr>
			<tr >
				<td width="30%" align="right">GRADO&nbsp;:&nbsp;</td>
				<td width="50%" colspan="2"><input id="textGrado" type="text" readonly="yes"></td>
			</tr>
			<tr>
				<td align="right">NOMBRE&nbsp;:&nbsp;</td>
				<td colspan="2"><input id="textNombreCompleto" type="text" readonly="yes"></td>
			</tr>
			<tr>
				<td align="right">CARGO ACTUAL&nbsp;:&nbsp;</td>
				<td colspan="2"><input id="textCargoActual" type="text" readonly="yes"></td>
			</tr>
			<tr>
				<td align="right">LICENCIA CONDUCIR&nbsp;:&nbsp;</td>
				<td colspan="2">
					<table cellpadding="1" cellspacing="0" width="100%" border="0">
					<tr>
						<td width="2%"><input type="checkbox" id="optionMunicipal" name="optionMunicipal" onClick="licenciaMunicipal();"></td>
						<td width="7%">MUNICIPAL</td>
						<td width="4%" align="right"><input type="checkbox" id="optionSemep" name="optionSemep" onClick="licenciaSemep()"></td>
						<td width="2%">SEMEP</td>
						<td width="5%" align="right"><input type="checkbox" id="optionNoTiene" name="optionNoTiene" onClick="noTieneLicencia()"></td>
						<td width="25%">NO TIENE LICENCIA</td>
						<td width="5%">&nbsp;</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3" height="10px"></td>
			</tr>
		</table>
	</div>
	<fieldset id="grupoLicenciaMunicipal" style="width:105%; border-bottom : 1px solid #909090;	padding : 5px 5px 5px 5px;" disabled>
	<legend>&nbsp;MUNICIPAL&nbsp;</legend>
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr>
			<td colspan="6">
				<table cellpadding="0" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="30%" align="right">(*) MUNICIPALIDAD&nbsp;:&nbsp;</td>
					<td width="34%"><select id="selMunicipalidad" class="deshabilidado" onChange="habilitarBotonAcciones(true, true, false);"></select></td>
					<td width="14%" align="right">(*) NUMERO&nbsp;:&nbsp;</td>
					<td width="21%"><input id="textNumeroLicenciaMunicipal" class="deshabilidado" type="text" maxlength="10" onChange="habilitarBotonAcciones(true, true, true);" ></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="30%" align="right">(*) FECHA ULTIMO CONTROL&nbsp;:&nbsp;</td>
			<td width="17%"><input id="textFechaUltimoControlMunicipal" type="text" class="deshabilidado" readonly="yes" onChange="habilitarBotonAcciones(true, true, false);" disabled></td>
			<td width="4%" style="padding: 0px 0px 0px 2px"><input class="calendarioDeshabilidado" id="imagenCalendarioUltimoControlMunicipal" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaUltimoControlMunicipal,'dd-mm-yyyy',this,-100,-195)"></td>
			<td width="27%" align="right">(*) FECHA PROXIMO CONTROL&nbsp;:&nbsp;</td>
			<td width="17%"><input id="textFechaProximoControlMunicipal" type="text" readonly="yes" class="deshabilidado" onChange="habilitarBotonAcciones(true, true, false);" disabled></td>
			<td width="4%" style="padding: 0px 0px 0px 2px"><input class="calendarioDeshabilidado" id="imagenCalendarioProximoControlMunicipal" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaProximoControlMunicipal,'dd-mm-yyyy',this,-100,-195)"></td>
		</tr>
		<tr style="padding: 2px 0px 1px 0px">
			<td colspan="6">
				<table cellpadding="1" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="50%">
						<fieldset id="cuadro2" style="width:100%">
						<legend>&nbsp;(*) CLASE&nbsp;</legend>
							<table cellpadding="0" cellspacing="0" width="100%" border="0" style="padding:6px 0px 0px 0px;">
							<tr>
								<td width="40%"><select class="deshabilidado" id="selClaseMunicipalOpciones" multiple="yes" size="3"></select></td>
								<td width="20%" style="padding:0px 6px 0px 6px;">
									<input type="button" id="btnSeleccionaClaseLicenciaMunicipal" value=">" onClick="seleccionaClaseLicenciaMunicipal(true)">
									<input type="button" id="btnQuitaSeleccionClaseLicenciaMunicipal" value="<" onClick="quitaSeleccionClaseLicenciaMunicipal()">
								</td>
								<td width="40%"><select class="deshabilidado" id="selClaseMunicipalOpcionesSeleccionadas" multiple="yes" size="3"></select></td>
							</tr>
							</table>
						</fieldset>
					</td>
					<td width="50%">
						<fieldset id="cuadro2" style="width:100%">
						<legend>&nbsp;RESTRICCIONES&nbsp;</legend>
							<table cellpadding="0" cellspacing="0" width="100%" border="0" style="padding:6px 0px 0px 0px;">
							<tr>
								<td width="40%"><select class="deshabilidado" id="selRestriccionMunicipalOpciones" multiple="yes" size="3"></select></td>
								<td width="20%" style="padding:0px 6px 0px 6px;">
									<input type="button" id="btnSeleccionaRestriccionLicenciaMunicipal" value=">" onClick="seleccionaRestriccionLicenciaMunicipal(true)">
									<input type="button" id="btnQuitaSeleccionRestriccionLicenciaMunicipal" value="<" onClick="quitaSeleccionRestriccionLicenciaMunicipal()">
								</td>
								<td width="40%"><select class="deshabilidado" id="selRestriccionMunicipalOpcionesSeleccionadas" multiple="yes" size="3"></select></td>
							</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr style="padding: 2px 0px 1px 0px">
			<td width="30%" align="right">OBSERVACIONES&nbsp;:&nbsp;</td>
			<td width="70%" colspan="5"><textarea class="deshabilidado" id="textObservacionesMunicipal" rows="2" onkeyup="this.value=sinCaracteres(this.value)" onChange="habilitarBotonAcciones(true, true, false);" disabled></textarea></td>
		</tr>
	</table>
	</fieldset>
	<fieldset id="grupoLicenciaSemep" style="width:105%; border-bottom : 1px solid #909090;	padding : 5px 5px 5px 5px;" disabled>
	<legend>&nbsp;SEMEP&nbsp;</legend>
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr style="padding: 0px 0px 0px 0px">
			<td width="30%" align="right">(*) EVALUACION&nbsp;:&nbsp;</td>
			<td width="70%" colspan="5"><select class="deshabilidado" id="selEvaluacionSemep" onChange="licenciaRechazada(true)"></td>
		</tr>
		<tr>
			<td width="30%" align="right">(*) FECHA RINDE EXAMEN&nbsp;:&nbsp;</td>
			<td width="17%"><input id="textFechaHabilitacionSemep" type="text" readonly="yes" class="deshabilidado" onChange="habilitarBotonAcciones(true, true, true);" disabled></td>
			<td width="4%" style="padding: 0px 0px 0px 2px"><input class="calendarioDeshabilidado" id="imagenCalendarioHabilitacionSemep" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaHabilitacionSemep,'dd-mm-yyyy',this,-100,-195)"></td>
			<td width="27%" align="right">(*) FECHA RENOVACION&nbsp;:&nbsp;</td>
			<td width="17%"><input id="textFechaRenovacionSemep" type="text" readonly="yes" class="deshabilidado" onChange="habilitarBotonAcciones(true, true, false);" disabled></td>
			<td width="4%" style="padding: 0px 0px 0px 2px"><input class="calendarioDeshabilidado" id="imagenCalendarioRenovacionSemep" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaRenovacionSemep,'dd-mm-yyyy',this,-100,-195)"></td>
		</tr>
		<tr style="padding: 2px 0px 1px 0px">
			<td colspan="6">
				<table cellpadding="1" cellspacing="0" width="100%" border="0">
				<tr>
					<td width="50%">
						<fieldset id="cuadro2" style="width:100%">
						<legend>&nbsp;(*) TIPO VEHICULO&nbsp;</legend>
							<table cellpadding="0" cellspacing="0" width="100%" border="0" style="padding:6px 0px 0px 0px;">
							<tr>
								<td width="40%"><select class="deshabilidado" id="selTipoVehiculoSemepOpciones" multiple="yes" size="3"></select></td>
								<td width="20%" style="padding:0px 6px 0px 6px;">
									<input type="button" id="btnSeleccionaTipoVehiculoSemep" value=">" onClick="seleccionaTipoVehiculoSemep(true)">
									<input type="button" id="btnQuitaSeleccionTipoVehiculoSemep" value="<" onClick="quitaSeleccionTipoVehiculoSemep()"></td>
								<td width="40%"><select class="deshabilidado" id="selTipoVehiculoSemepOpcionesSeleccionadas" multiple="yes" size="3"></select></td>
							</tr>
							</table>
						</fieldset>
					</td>
					<td width="50%">
						<fieldset id="cuadro2" style="width:100%">
						<legend>&nbsp;RESTRICCIONES&nbsp;</legend>
							<table cellpadding="0" cellspacing="0" width="100%" border="0" style="padding:6px 0px 0px 0px;">
							<tr>
								<td width="40%"><select class="deshabilidado" id="selRestriccionSemepOpciones" multiple="yes" size="3"></select></td>
								<td width="20%" style="padding:0px 6px 0px 6px;">
									<input type="button" id="btnSeleccionaRestriccionSemep" value=">" onClick="seleccionaRestriccionSemep(true)">
									<input type="button" id="btnQuitaSeleccionRestriccionSemep" value="<" onClick="quitaSeleccionRestriccionSemep()"></td>
								<td width="40%"><select class="deshabilidado" id="selRestriccionSemepOpcionesSeleccionadas" multiple="yes" size="3"></select></td>
							</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr style="padding: 2px 0px 1px 0px">
			<td width="30%" align="right">OBSERVACIONES&nbsp;:&nbsp;</td>
			<td width="70%" colspan="5"><textarea class="deshabilidado" id="textObservacionesSemep" rows="2" onkeyup="this.value=sinCaracteres(this.value)" onChange="habilitarBotonAcciones(true, true, false);"></textarea></td>
		</tr>
	</table>
	</fieldset>
</div>
<table width="105%">
<tr>
	<td width="20%"><div id="nombreArchivoSubir"><input type="button" id="btnGuardarArchivo" value="ADJUNTAR ARCHIVO" onClick="adjuntarArchivo()" /></div></td>
	  <input type="hidden" id="archivoEnServidor">
	  <input type="hidden" id="tipoArchivoEnServidor">
	<td width="20%"></td>
	<td width="10%">&nbsp;</td>
  <td width="15%">
   	 <input name="btnEliminarFicha" type="button" id="btnEliminarFicha" value="ELIMINAR" onClick="eliminarDatosLicenciaConducir()" disabled>
  </td>
	<td width="15%"><input name="btnGuardarFicha" type="button" id="btnGuardarFicha" value="GUARDAR" onClick="guardarDatosLicenciaConducir()" disabled></td>
	<td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btnCerrarFichaFuncionario" value="CERRAR" onClick="top.cerrarVentana();"></td>
</tr>
</table>
</div>
<iframe name="frameSubirArchivo" id="frameSubirArchivo" style="display: none;"></iframe>
</body>
</html>