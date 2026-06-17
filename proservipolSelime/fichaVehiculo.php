<?include("session.php")?>  
<?include("tiempo.php")?> 
<?
	$codigoVehiculo = $_GET["codigoVehiculo"];
	$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$unidadPadre	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
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
<script type="text/javascript" src="./js/procedenciaVehiculo.js"></script>
<script type="text/javascript" src="./js/tipoVehiculo.js"></script>
<script type="text/javascript" src="./js/estadoRecurso.js"></script>
<script type="text/javascript" src="./js/marcaVehiculo.js"></script>
<script type="text/javascript" src="./js/modeloVehiculo.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/vehiculos.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./js/lugarReparacion.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
<script type="text/javascript" src="./js/fallaVehiculo.js"></script>

</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" onload="javascript:leeProcedenciaVehiculos('selProcedencia');leeTipoVehiculos('selTipoVehiculo');leeEstadosRecursos('selEstado','VEH'); leeMarcaVehiculos('selMarca');leeModeloVehiculos('','selModelo'); leeLugaresDeReparacion('selLugarReparacion');leeFallaVehiculo('selTipoFalla')" scroll="no">
<input id="ultimaFecha"    	type="hidden" readonly="yes">
<input id="idVehiculo" 		type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" 	type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codLugarReparacionBaseDatos" type="hidden" readonly="yes">
<input id="codFallaBaseDatos" type="hidden" readonly="yes">

<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>

<div id="cubreVentanaPersonal" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"></td></table>
</div>

<div id="ventanaSeleccionaUnidad" style="display:none; border-left: 2px solid #ffffff;	border-top : 2px solid #ffffff;	border-right: 2px solid #909090;border-bottom: 2px solid #909090;">
		<div id="usuarioCuadro">
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('<?echo $unidadUsuario?>',this.id);" onClick="habiltarAceptarUnidadAgregado(this.id)"></select>
				</td>
			</tr>
			</table>
		</div>
		<table width="100%">
		<tr> 
			  <td width="20%"></td>
		   	  <td width="20%">&nbsp;</td>
		   	  <td width="20%">&nbsp;</td>
		      <td width="20%"><input type="button" id="btn100" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoVehiculo('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
		      <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
		</tr>
		</table>
</div>


<div id="ventanaIngresoFecha" style="display:none;">
		<div id="usuarioCuadro">
			<table cellpadding="0" cellspacing="0" width="100%">
			<input id="textTipo" type="hidden">
			<tr><td colspan="2"><div id="textTipoMovimentoVentanaFecha"><div></td></tr>
			<tr  style="padding: 2px 0px 10px 0px;">
				<td width="90%"><input id="textFechaVentanaFecha" type="text" readonly="yes">
				</td>
				<td width="10%">&nbsp;
				<input id="imagenCalendarioVentanaFecha" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaVentanaFecha, textFechaVentanaFecha,'dd-mm-yyyy','250','38')">
				</td>
			</tr>
			</table>
		</div>
		<table width="100%">
		<tr> 
			  <td width="20%"></td>
		   	  <td width="20%">&nbsp;</td>
		   	  <td width="20%">&nbsp;</td>
		      <td width="20%"><input type="button" id="btn100" name="btnAceptaFechaVentanaFecha" value="ACEPTAR" onClick="aceptaFechaVentanaIngresoFecha()"></td>        
		      <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoFecha()"></td>
		</tr>
		</table>
</div>







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
			<td width="30%" align="right">(*) PATENTE&nbsp;:&nbsp;</td>
			<td width="60%"><input id="textPatente" type="text" maxlength="6" readonly="yes"></td>
			<td width="10%"></td>
		</tr>
		<tr style="padding: 0px 0px 0px 0px">
			<td width="30%" align="right">(*) NUMERO INSTITUCIONAL&nbsp;:&nbsp;</td>
			<td width="60%"><input id="textNumeroInstitucional" type="text" readonly="yes"></td>
			<td width="10%"></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">(*) PROCEDENCIA&nbsp;:&nbsp;</td>
			<td><select id="selProcedencia"></select></td>
			<td></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">(*) TIPO VEHICULO&nbsp;:&nbsp;</td>
			<td><select id="selTipoVehiculo"></select></td>
			<td></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">(*) MARCA&nbsp;:&nbsp;</td>
			<td><select id="selMarca" onChange="leeModeloVehiculos(this[this.selectedIndex].value,'selModelo')"></select></td>
			<td></td>
		</tr>
		<tr>
			<td align="right">(*) MODELO&nbsp;:&nbsp;</td>
			<td><select id="selModelo"></select></td>
			<td></td>
		</tr>
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr style="padding: 0px 0px 2px 0px">
			<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
			<td width="60%" colspan="5"><select id="selEstado" onChange="activaFechaNuevoEstado()"></select></td>
			<td width="10%"></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td width="30%" align="right"><label id="labLugarReparacion" disabled="yes">(*) LUGAR&nbsp;:&nbsp;</lab></td>
			<td width="60%" colspan="5"><select id="selLugarReparacion" disabled="yes" onChange="habilitarCambioLugarReparacion()" style="background-color:#E6E6E6"></select></td>
			<td width="10%"></td>
		</tr>
		 <tr style="padding: 0px 0px 2px 0px">
			<td width="30%" align="right"><label id="labTipoFalla" disabled="yes">(*) TIPO DE FALLA&nbsp;:&nbsp;</lab></td>
			<td width="60%" colspan="5"><select id="selTipoFalla" disabled="yes"  onChange="habilitarTipoFalla()" style="background-color:#E6E6E6"></select></td>
			<td width="10%"></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td width="30%" align="right"><label id="labAnnoFab">(*) AÑO DE FABRICACION&nbsp;:&nbsp;</lab></td>
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
	  <td width="15%"><input name="btnDejarDisponible" type="button" id="btn100" value="TRASLADO" onClick="activaVentanaIngresoFecha('1')" disabled="yes"></td>
	  <td width="15%"><input name="btnBaja" type="button" id="btn100" value="BAJA" onClick="activaVentanaIngresoFecha('2')" disabled="yes"></td>
   	  <td width="15%"><!--<input name="btnHistoria" type="button" id="btn100" value="HISTORIA" onClick="verHistoriaVehiculo('<?echo $codigoVehiculo?>')">--></td>
   	  <td width="15%">&nbsp;</td>
      <td width="20%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="GUARDAR" onClick="guardarFichaVehiculo()" disabled="yes"></td>
      <td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();" disabled="yes"></td>
</tr>
</table>
</div>
</body>
</html>
<?
	if ($codigoVehiculo != ""){
		echo "<script>";
			echo "leeDatosVehiculo('".$codigoVehiculo."','','0');";
			echo "document.getElementById('btnBuscarVehiculo').disabled = 'true';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>";
	} else {
		echo "<script>";
			echo "document.getElementById('textPatente').focus();";
			echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';";
			echo "document.getElementById('labFechaEstado').disabled= '';";
			echo "document.getElementById('imagenCalendarioFichaVehiculo').style.visibility = 'visible';";
			echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';";
			echo "document.getElementById('btnGuardarOrganizacion').disabled = 'true';";
			echo "document.getElementById('btnCerrarFichaFuncionario').disabled = '';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>";
	}
?>