<?include("session.php")?>   
<?
	$codigoVehiculo = $_GET["codigoVehiculo"];
	$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$unidadPadre	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	//$unidad = $_GET["unidad"];
	//echo "codigoVehiculo " . $codigo;
	$codigo 			=  $_GET["codigo"];

?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaVehiculo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>



<script type="text/javascript" src="./js/sim.js"></script>

<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>

<script type="text/javascript" src="./calendario/popcalendar.js"></script>

<script type="text/javascript" src="./js/aplicacion.js"></script>

<script type="text/javascript" src="./js/estadoSimccar.js"></script>
<script type="text/javascript" src="./js/estadoSimccar2.js"></script>

</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0"  onload="javascript:leeEstadoSimccar('selEstado','VEH');leeEstadoSimccar2('selEstado2','VEH')"scroll="no">
<input id="ultimaFecha"    	type="hidden" readonly="yes">
<input id="idVehiculo" 		type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" 	type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codLugarReparacionBaseDatos" type="hidden" readonly="yes">
<input id="codigo" 	type="hiddEN" value="<?echo $codigo?>">
<input id="estadoBaseDatos2" type="hidden" readonly="yes">

<input id="ultimaFecha2" type="hidden" readonly="yes">
<input id="archivo2" type="hidden" readonly="yes">
<input id="codigoOculto" type="hidden" readonly="yes">

<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>

<div id="divDatosBasicos" style="position:absolute; visibility: visible;">     
	
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
				<td width="30%" align="right">(*) No. SERIE&nbsp;:&nbsp;</td>
				<td width="15%"><input id="textNumeroBCU" type="text" maxlength="25"></td>
				 <td width="15%"><input name="btnBuscarSimccar" type="button" id="btn100" value="BUSCAR" onClick="buscaDatosSimccar()"></td>
				<td width="40%"></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) No. TARJETA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textNombre" type="text"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) IMEI&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textRaza" type="text" ></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) MARCA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textFechaNacimiento" type="text" ></td>
				<td width="10%"></td>
			</tr>
						<tr style="padding: 0px 0px 2px 0px">
				<td align="right"><label id="labLugarReparacion">(*) MODELO&nbsp;:&nbsp;</lab></td>
				<td><input id="selTipoAnimal" type="text" > 
					</td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) A&Ntilde;O FABRICACION&nbsp;:&nbsp;</td>
				<td><input id="selColor" type="text" maxlength="4"  onkeypress="ValidaSoloNumerosAnno()"></td>
				<td></td>
			</tr>
			<tr id="origen1" style="padding: 0px 0px 2px 0px">
				<td width="30%" align="right">(*) ORIGEN SIMCCAR&nbsp;:&nbsp;</td>
				<td width="60%" colspan="5"><select id="selOrigen">
  <option value="0">SELECCIONE ORIGEN ...</option>
  <option value="INSTITUCIONAL">INSTITUCIONAL</option>
  <option value="EMPRESA EXTERNA">EMPRESA EXTERNA</option> 
</select></td>
				<td width="10%"></td>
			</tr>
				<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) VERIFICAR ESTADO&nbsp;:&nbsp;</td>
				<td><input type="checkbox" name="verificar" id="verificar" value="SI"/><input type="hidden" id="verificaOculto" size="3" maxlength="4">&nbsp;<label id="labConfirmar" disabled>VERIFICAR</lab>
					</td>
				<td></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">

			<tr style="padding: 0px 0px 2px 0px">
				<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
				<td width="60%" colspan="5"><select id="selEstado" onChange="activaFechaNuevoEstado();llamaFalla();"></select></td>
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
		  <td width="15%"><input name="btnDejarDisponible" type="button" id="btn100" value="TRASLADO"  onClick="activaVentanaIngresoFecha('1')" disabled="yes"></td>
		    <td width="15%"><input name="btnBaja" type="button" id="btn100" value="BAJA"  disabled="yes"></td>
	   	  <td width="15%"><!--<input name="btnHistoria" type="button" id="btn100" value="HISTORIA" onClick="verHistoriaVehiculo('<?echo $codigoVehiculo?>')">--></td>
	   	  <td width="15%">&nbsp;</td>
	   	  <td width="15%">&nbsp;<input name="btnGuardarOrganizacion" type="button" id="btn100" value="GUARDAR" onClick="guardarFichaCaballo()" disabled="yes"></td>
	      <td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();" disabled="yes"></td>
	</tr>
	</table>
	</div>
</div>
 
<!--<div id="ventanaIngresoFalla" style="display:none;">-->
<!--NAVEGACION 2-->

<div id="divFicha2" style="position:absolute; visibility: hidden; height:705px; width:733px;">
	<div id="marcoLevantado">
		<div id="cuadro">
		<table cellpadding="1" cellspacing="0" width="100%">
			<tr>
				<td width="30%" align="right">(*) No. SERIE&nbsp;:&nbsp;</td>
				<td width="15%"><input id="textNumeroBCU2" type="text" maxlength="30"></td>
				 <td width="15%"><input name="btnBuscarSimccar2" type="button" id="btn100" value="BUSCAR" onClick="buscaDatosSimccarExt()"></td>
				<td width="40%"></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) No. TARJETA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textNombre2" type="text"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) IMEI&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textRaza2" type="text" ></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) MARCA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textFechaNacimiento2" type="text"></td>
				<td width="10%"></td>
			</tr>
						<tr style="padding: 0px 0px 2px 0px">
				<td align="right"><label id="labLugarReparacion">(*) MODELO&nbsp;:&nbsp;</lab></td>
				<td><input id="selTipoAnimal2" type="text"> 
					</td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) A&Ntilde;O FABRICACION&nbsp;:&nbsp;</td>
				<td><input id="selColor2" type="text" maxlength="4"  onkeypress="ValidaSoloNumerosAnno()"></td>
				<td></td>
			</tr>
			<tr id="origen2" style="padding: 0px 0px 2px 0px">
				<td width="30%" align="right">(*) ORIGEN SIMCCAR&nbsp;:&nbsp;</td>
				<td width="60%" colspan="5"><input id="selOrigen2" type="text"></td>
				<td width="10%"></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">

			<tr style="padding: 0px 0px 2px 0px">
				<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
				<td width="60%" colspan="5"><select id="selEstado2" onChange="activaFechaNuevoEstado2()"></select></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="30%" align="right"><label id="labFechaEstado2" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
				<td width="20%"><input id="textFechaNuevoEstado2" type="text" readonly="yes" disabled="yes" style="background-color:#E6E6E6"></td>
				<td width="5%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaVehiculo2" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar2(textFechaNuevoEstado2, textFechaNuevoEstado2,'dd-mm-yyyy','250','18')" style="visibility:hidden"></td>
				<td width="5%"></td>
				<td width="10%" align="right"><label id="labDocumentoEstado2" disabled="yes">NUM. DOC.&nbsp;:&nbsp;</lab></td>
				<td width="20%"><input id="textDocumentoNuevoEstado2" type="text" style="background-color:#E6E6E6" disabled="yes"></td>
				<td width="10%"></td>
			</tr>
			
			<tbody id="divUnidadAgregado">
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right"><label id="labUnidadAgregado2" disabled="yes">(*) UNIDAD AGREGADO&nbsp;:&nbsp;</lab></td>
				<td width="60%" colspan="5">
					<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<input id="codigoUnidadAgregado2" type="hidden">
						<td width="94%"><input id="textUnidadAgregado2" type="text" readonly="yes" style="background-color:#E6E6E6" disabled="yes"></td>
						<td width="6%" style="padding: 2px 0px 3px 3px"><input name="btnUnidades2" type="button" id="btn100" value="..."  disabled="yes"></td>
					</tr>
					</table>
				</td>
				<td width="10%"></td>
			</tbody>
			
		</table>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr style="padding: 5px 0px 0px 0px">
				<td style="font-size:8px; font-weight:bold;" align="left"><div id="labFechaCargoDesde2"></div></td>
				<td style="font-size:8px;" align="right">(*) DATOS OBLIGATORIOS</td>
			</tr>
		</table>
		
	</div>
		<table width="105%">
	<tr>
		  <td width="10%"><input name="btnDejarDisponible" type="button" id="btn100" value="CERRAR"  onClick="top.cerrarVentana();"></td>
		    <td width="10%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="REEMPLAZO" onClick="guardarFichaReemplazo()"></td>
		    <td width="10%"></td>
	   	  <td width="10%"><!--<input name="btnHistoria" type="button" id="btn100" value="HISTORIA" onClick="verHistoriaVehiculo('<?echo $codigoVehiculo?>')">--></td>
	   	  <td width="10%">&nbsp;</td>
	      <td width="10%">&nbsp;</td>
	</tr>
	</table>
</div>	
<!--FIN NAVEGACION 2-->
</body>
</html>
<?

	if ($codigo != ""){
		echo "<script>";
			echo "leedatosDioscar('".$codigo."','','0');";
		  echo "document.getElementById('btnBuscarSimccar').disabled = 'true';";
			echo "document.getElementById('btnGuardarOrganizacion').disabled = '';";
			echo "document.getElementById('btnCerrarFichaFuncionario').disabled = '';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
			echo "document.getElementById('origen1').style.visibility = 'hidden';";
			echo "document.getElementById('origen2').style.visibility = 'hidden';";
		echo "</script>";
	} else {
		echo "<script>";
			echo "document.getElementById('textNombre').focus();";
			echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';";
			echo "document.getElementById('labFechaEstado').disabled= '';";
			echo "document.getElementById('imagenCalendarioFichaVehiculo').style.visibility = 'visible';";
			echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';";
			echo "document.getElementById('btnGuardarOrganizacion').disabled = '';";
			echo "document.getElementById('btnCerrarFichaFuncionario').disabled = '';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
			echo "document.getElementById('origen1').style.visibility = 'hidden';";
			echo "document.getElementById('origen2').style.visibility = 'hidden';";
		echo "</script>";
	}
?>