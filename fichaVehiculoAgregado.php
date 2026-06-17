<?
include("version.php");
include("session.php");
include("tiempo.php");
$codigoVehiculo = $_GET["codigoVehiculo"];
$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad	    = $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS'];
$contrasena			= $_SESSION['USUARIO_CLAVE'];
$codPerfil	 	 	= $_SESSION['USUARIO_CODIGOPERFIL_PADRE'];
//$unidad = $_GET["unidad"];
//echo "codigoVehiculo " . $codigoVehiculo;
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaVehiculo.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/procedenciaVehiculo.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoVehiculo.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/clasificacionCitacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/estadoRecurso.js"></script>
<script type="text/javascript" src="./js/marcaVehiculo.js"></script>
<script type="text/javascript" src="./js/modeloVehiculo.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/vehiculos.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./js/lugarReparacion.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
<script type="text/javascript" src="./js/seccion.js"></script>
<script type="text/javascript" src="./js/fallaVehiculo.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/listaMultiple.js"></script>

</head>
<body style="margin-top:10; margin-left:10; background-color:#f5fbf3" onload="javascript:leeProcedenciaVehiculos('selProcedencia');leeTipoVehiculos('selTipoVehiculo');leeEstadosRecursos('selEstado','VEH'); leeMarcaVehiculos('selMarca');leeModeloVehiculos('','selModelo'); leeLugaresDeReparacion('selLugarReparacion'); leeSeccion('selSeccion'); leeClasificacionCitacionAgregado();" scroll="no">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="idVehiculo" type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codLugarReparacionBaseDatos" type="hidden" readonly="yes">
<input id="tipoUnidad" type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="seccionBaseDatos" type="hidden" readonly="yes">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="contrasena" type="hidden" value="<?echo $contrasena?>">
<input id="perfil" type="hidden" readonly="yes" value="<?echo $codPerfil?>">

<div id="mensajeCargando" style="display:none;">
	<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>

<div id="cubreVentana" style="display:none; position:absolute; z-index=1;">
	<table width="100%"><tr><td align="right" width="35%"></td></tr></table>
</div>

<div id="ventanaSeleccionaUnidad" style="position:absolute; z-index=2; display:none; border-left: 2px solid #ffffff;	border-top : 2px solid #ffffff;	border-right: 2px solid #909090;border-bottom: 2px solid #909090;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td><select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('<?echo $unidadUsuario?>',this.id);" onClick="habiltarAceptarUnidadAgregado(this.id)"></select></td>
		</tr>
		</table>
	</div>
	<table width="100%">
	<tr>
	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
    <td width="20%"><input type="button" id="btn100" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoVehiculo('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
	</tr>
	</table>
</div>

<div id="ventanaIngresoFecha" style="position:absolute; z-index=2; display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<input id="textTipo" type="hidden">
		<tr><td colspan="2"><div id="textTipoMovimentoVentanaFecha" /></td></tr>
		<tr style="padding: 2px 0px 10px 0px;">
			<td width="90%"><input id="textFechaVentanaFecha" type="text" readonly="yes"></td>
			<td width="10%">&nbsp;<input id="imagenCalendarioVentanaFecha" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaVentanaFecha, textFechaVentanaFecha,'dd-mm-yyyy','250','38')"></td>
		</tr>
		</table>
	</div>
	<table width="100%">
	<tr>
	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
    <td width="20%"><input type="button" id="btn100" name="btnAceptaFechaVentanaFecha" value="ACEPTAR" onClick="aceptaFechaVentanaIngresoFecha()"></td>        
    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoFecha()"></td>
	</tr>
	</table>
</div>

<div id="ventanaIngresoContrasena" style="position:absolute; z-index=2; display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="3"><div id="textTituloContrasena"/></td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>	
		<tr style="padding: 2px 0px 10px 0px;">
			<td width="50%"><input id="textContrasena" type="password" ></td>
			<td width="25%"><input type="button" id="btn100" name="btnAceptaContrasena" value="ACEPTAR" onClick="validaContrasena()"></td>
    	<td width="25%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoContrasena()"></td>
		</tr>
		</table>
	</div>
</div>

<div id="divDatosBasicos" style="position:absolute; visibility: visible;">
	<div style="width:94%;">
		<div id="marcoLevantado">
			<div id="cuadro">
				<table cellpadding="1" cellspacing="0" width="100%">
					<tr>
						<td width="30%" align="right">(*) BCU&nbsp;(SIN GUION):&nbsp;</td>
						<td width="15%"><input id="textNumeroBCU" type="text" maxlength="11"></td>
						<td width="15%"><input name="btnBuscarVehiculo" type="button" id="btn100" value="BUSCAR" onClick="buscaDatosVehiculo()"></td>
						<td width="40%"></td>
					</tr>
				</table>
			</div>
			<div id="cuadro">
				<table cellpadding="0" cellspacing="0" width="100%" border="0">
					<tr style="padding: 0px 0px 0px 0px">
						<td width="30%" align="right">PATENTE&nbsp;:&nbsp;</td>
						<td width="60%"><input id="textPatente" type="text" maxlength="6" readonly="yes"></td>
						<td width="10%"></td>
					</tr>
					<tr style="padding: 0px 0px 0px 0px">
						<td width="30%" align="right">NUMERO INSTITUCIONAL&nbsp;:&nbsp;</td>
						<td width="60%"><input id="textNumeroInstitucional" type="text" readonly="yes"></td>
						<td width="10%"></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td align="right">(*) PROCEDENCIA&nbsp;:&nbsp;</td>
						<td><select id="selProcedencia"></select></td>
						<td></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td align="right">TIPO VEHICULO&nbsp;:&nbsp;</td>
						<td><select id="selTipoVehiculo"></select></td>
						<td></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td align="right">MARCA&nbsp;:&nbsp;</td>
						<td><select id="selMarca" onChange="leeModeloVehiculos(this[this.selectedIndex].value,'selModelo')"></select></td>
						<td></td>
					</tr>
					<tr>
						<td align="right">MODELO&nbsp;:&nbsp;</td>
						<td><select id="selModelo"></select></td>
						<td></td>
					</tr>
				</table>
			</div>
			<div id="cuadro">
				<table cellpadding="0" cellspacing="0" width="100%" border="0">
					 <tr id="filaSeccion">
						<td width="30%" align="right">(*) SECCION&nbsp;:&nbsp;</td>
						<td width="60%" colspan="2"><select id="selSeccion" onChange="activaFechaNuevoEstado()"></select></td>
						<td width="10%"></td>
					 </tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
						<td width="60%" colspan="5"><select id="selEstado" onChange="activaFechaNuevoEstado();llamaFalla();fallaObligatoria();sinRegularizar();"></select></td>
						<td width="10%"></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td width="30%" align="right"><label id="labLugarReparacion" disabled="yes">(*) LUGAR&nbsp;:&nbsp;</lab></td>
						<td width="60%" colspan="5"><select id="selLugarReparacion" disabled="yes" onChange="habilitarCambioLugarReparacion()" style="background-color:#E6E6E6"></select></td>
						<td width="10%"></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td width="30%" align="right"><label id="labAnnoFab">AÑO DE FABRICACION&nbsp;:&nbsp;</lab></td>
						<td width="60%" colspan="5"><input id="textAnnoFab" type="text" size="10" maxlength="4" readonly="yes" onkeypress="ValidaSoloNumeros()">&nbsp;&nbsp;<input id="validaAnnoFab" type="checkbox" value="1" disabled><input id="validaAnnoOculto" type="hidden" size="3" maxlength="4"><label id="labConfirmar" disabled>CONFIRMAR</lab></td>
						<td width="10%"></td>
					</tr>
					<tr>
						<td width="30%" align="right"><label id="labFechaEstado" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
						<td width="20%"><input id="textFechaNuevoEstado" type="text" readonly="yes" disabled="yes" style="background-color:#E6E6E6"></td>
						<td width="5%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaVehiculo" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaNuevoEstado, textFechaNuevoEstado,'dd-mm-yyyy','250','18')" style="visibility:hidden"></td>
						<td width="5%"></td>
						<td width="10%" align="right"><label id="labDocumentoEstado" disabled="yes">NUM. DOC.&nbsp;:&nbsp;</lab></td>
						<td width="20%"><input id="textDocumentoNuevoEstado" type="text" style="background-color:#E6E6E6" disabled="yes"></td>
						<td width="10%"></td>
					</tr>
					<tbody id="divUnidadAgregado">
					<tr style="padding: 0px 0px 0px 0px">
						<td width="30%" align="right"><label id="labUnidadAgregado" disabled="yes">(*) UNIDAD AGREGADO&nbsp;:&nbsp;</lab></td>
						<td width="60%" colspan="5">
							<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<input id="codigoUnidadAgregado" type="hidden">
								<td width="94%"><input id="textUnidadAgregado" type="text" readonly="yes" style="background-color:#E6E6E6" disabled="yes"></td>
								<td width="6%" style="padding: 2px 0px 3px 3px"><input name="btnUnidades" type="button" id="btn100" value="..." onclick="activaBuscaUnidadAgregado()" disabled="yes"></td>
							</tr>
							</table>
						</td>
						<td width="10%"></td>
					</tr>	
					</tbody>
				</table>
			</div>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr style="padding: 5px 0px 0px 0px">
					<td style="font-size:8px; font-weight:bold;" align="left"><div id="labFechaCargoDesde"></div></td>
					<td style="font-size:8px;" align="right">(*) DATOS OBLIGATORIOS</td>
				</tr>
			</table>
		</div>
		<table width="105%">
		<tr> 
			<td width="15%"><input name="btnDejarDisponible2" type="button" id="btn100" value="TRASLADO" disabled="yes"></td>
			<td width="15%"><input name="btnBaja2" type="button" id="btn100" value="BAJA" disabled="yes"></td>
			<td width="15%"><!--<input name="btnHistoria" type="button" id="btn100" value="HISTORIA" onClick="verHistoriaVehiculo('<?echo $codigoVehiculo?>')">--></td>
			<td width="15%">&nbsp;</td>
			<td width="20%"><input name="btnGuardar2" type="button" id="btn100" value="GUARDAR" disabled="yes"></td>
			<td width="20%"><input name="btnCerrarFicha" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentanaFicha();" disabled="yes"></td>
		</tr>
		</table>
	</div>
	
</div>
<!--<div id="ventanaIngresoFalla" style="display:none;">-->
<!--<div id="divDatosFalla" style="position:absolute; visibility: hidden; height:305px; width:733px;" >-->
<div id="divDatosFalla" style="position:absolute; visibility: hidden; height:305px; width:733px;" >
	<div id="marcoLevantado">
		<table width="100%" height="80%" border="0" align="center" >
			<tr align="center">
				<td id="tituloSelecMultiple"><div id="tituloFallasPosibles">FALLAS POSIBLES</div></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td id="tituloSelecMultiple"><div id="tituloFallasPresentes">FALLAS PRESENTES</div></td>
			</tr>
			<tr align="center"> 
				<td > 
					<select id="fallasPosibles" size="16"  multiple>
						<option value="0">CARGANDO FALLAS ... </option>
					</select> 
				</td>
				<td>&nbsp;</td>
				<td>
					<input id="btn100" type="button" name="Btn_Agregar" value=" >> " onclick="asignarFalla()"> 
					<input id="btn100" type="button" name="Btn_Quitar" value=" << " onclick="desasignarFalla()">
				</td>
				<td>&nbsp;</td>
				<td> 
					<select id="fallasPresente" size="16" multiple></select> 
				</td>
			</tr>
		</table>
	</div>
  <table cellpadding="0" cellspacing="0" width="100%">
		<tr style="padding: 5px 0px 0px 0px">
			<td style="font-size:9px; font-weight:bold;" align="right"><div id="labFechaCargoPospuesta"></div></td>
		</tr>
	</table>  
	<table width="105%">
		<tr> 
	  	<td width="30%">
	  		<form name="formSubeArchivo" action="adjuntarArchivoSubirFallas.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo">
		  		<input type="hidden" id="rutArchi" name="rutArchi" value="">
		  		<input type="file" size="20" name="archivo" id="archivo" />
	  		</form>	
	  	</td>
   		<td width="15%">
   			<input type="hidden" id="correlativo" value="">
   	  	<input type="button" value="ACEPTAR" id="btn100" name="btnSubir" onClick="validacionFallas()"/>
			</td>
   		<td width="15%"><input name="btnPosponer" type="button" id="btn100" value="POSPONER" onClick="posponerIngreso()" ></td>
      <td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();" ></td>
		</tr>
	</table>
</div>
</body>
</html>
<?
	if ($codigoVehiculo != ""){
		if($contieneHijos==10 ){
			echo "<script>";
			if($codPerfil != 70 && $codPerfil != 80 && $codPerfil != 90 && $codPerfil != 100 && $codPerfil != 180) echo "fallaPospuestaDatos('".$codigoVehiculo."');";
			echo "leeDatosVehiculo('".$codigoVehiculo."','','0');";
			echo "document.getElementById('btnBuscarVehiculo').disabled = 'true';";
			echo "listaUnidades('".$unidadPadre."','".$unidadUsuario."','selectUnidad');\n";
			echo "</script>";
		}else{
			echo "<script>";
			if($codPerfil != 70 && $codPerfil != 80 && $codPerfil != 90 && $codPerfil != 100 && $codPerfil != 180) echo "fallaPospuestaDatos('".$codigoVehiculo."');";
			echo "leeDatosVehiculo('".$codigoVehiculo."','','0');";
			echo "document.getElementById('btnBuscarVehiculo').disabled = 'true';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
			echo "</script>";
		}
	} 
	else {
		if($contieneHijos==10){
			echo "<script>";
			echo "document.getElementById('textPatente').focus();";
			echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';";
			echo "document.getElementById('labFechaEstado').disabled= '';";
			echo "document.getElementById('imagenCalendarioFichaVehiculo').style.visibility = 'visible';";
			echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';";
			echo "document.getElementById('btnGuardar').disabled = 'true';";
			echo "document.getElementById('btnCerrarFicha').disabled = '';";
			echo "listaUnidades('".$unidadPadre."','".$unidadUsuario."','selectUnidad');\n";
			echo "</script>";
		}else{
			echo "<script>";
			echo "document.getElementById('textPatente').focus();";
			echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';";
			echo "document.getElementById('labFechaEstado').disabled= '';";
			echo "document.getElementById('imagenCalendarioFichaVehiculo').style.visibility = 'visible';";
			echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';";
			echo "document.getElementById('btnGuardar').disabled = 'true';";
			echo "document.getElementById('btnCerrarFicha').disabled = '';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
			echo "</script>";
		}
	}
	
	if($contieneHijos==1){
		echo "<script>";
		echo "document.getElementById('filaSeccion').style.visibility = 'visible';";
		echo "</script>";
  }else{
		echo "<script>";
		echo "document.getElementById('filaSeccion').style.visibility = 'hidden';";
		echo "</script>";
	}
?>