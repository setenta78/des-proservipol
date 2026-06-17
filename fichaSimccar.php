<?
include("version.php");
include("session.php");
include("tiempo.php");
$codigoSimccar  = $_GET["codigoSimccar"];
$unidadUsuario  = $_SESSION['USUARIO_CODIGOUNIDAD'];
$unidadPadre	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$codigo 	= $_GET["codigo"];
$tipoUnidad	= $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS'];
$contrasena	= $_SESSION['USUARIO_CLAVE'];
$codPerfil	= $_SESSION['USUARIO_CODIGOPERFIL'];
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaSimccar.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/simccar.js?v=<?echo version?>" charset="utf-8"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/estadoSimccar.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/seccion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
</head>
<body style="margin-top:10; margin-left:10; background-color:#f5fbf3" onload="javascript:leeSeccion('selSeccion'); leeEstadoSimccar('selEstado2','mod2'); leeSeccion('selSeccion2');"scroll="no">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="idSimccar" type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codLugarReparacionBaseDatos" type="hidden" readonly="yes">
<input id="tipoUnidad" type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="seccionBaseDatos" type="hidden" readonly="yes">
<input id="codigo" type="hidden" value="<?echo $codigo?>">
<input id="estadoBaseDatos2" type="hidden" readonly="yes">
<input id="ultimaFecha2" type="hidden" readonly="yes">
<input id="archivo2" type="hidden" readonly="yes">
<input id="codigoOculto" type="hidden" readonly="yes">
<input id="perfil" type="hidden" readonly="yes" value="<?echo $codPerfil?>">
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="cubreVentana" style="position:absolute; z-index=1; display:none;">
<table width="100%"><tr><td align="right" width="35%"></td></tr></table>
</div>
	<div id="ventanaSeleccionaUnidad" style="position:absolute; z-index=2; display:none; border-left: 2px solid #ffffff;	border-top : 2px solid #ffffff;	border-right: 2px solid #909090;border-bottom: 2px solid #909090;">
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
			<td width="20%"><input type="button" id="btnAceptaUnidadAgregado" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoSimccar('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
			<td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');"></td>
		</tr>
		</table>
	</div>
	<div id="ventanaIngresoFecha" style="position:absolute; z-index=2; display:none;">
		<div id="usuarioCuadro">
			<table cellpadding="0" cellspacing="0" width="100%">
			<input id="textTipo" type="hidden">
			<tr><td colspan="2"><div id="textTipoMovimentoVentanaFecha"/></td></tr>
			<tr  style="padding: 2px 0px 10px 0px;">
				<td width="90%"><input id="textFechaVentanaFecha" type="text" readonly="yes">
				</td>
				<td width="10%">&nbsp;
				<input id="imagenCalendarioVentanaFecha" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaVentanaFecha,'dd-mm-yyyy',this,-100,-195)">
				</td>
			</tr>
			</table>
		</div>
		<table width="100%">
		<tr> 
			<td width="20%"></td>
			<td width="20%">&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="20%"><input type="button" id="btnAceptaFechaVentanaFecha" name="btnAceptaFechaVentanaFecha" value="ACEPTAR" onClick="aceptaFechaVentanaIngresoFecha()"></td>        
			<td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoFecha()"></td>
		</tr>
		</table>
	</div>
<div id="divDatosBasicos" style="position:absolute; visibility: visible;">
	<div style="width:94%;">
	<div id="marcoLevantado">
		<div id="cuadro">
		<table cellpadding="1" cellspacing="0" width="100%">
			<tr>
				<td width="30%" align="right">(*) No. SERIE&nbsp;:&nbsp;</td>
				<td width="15%"><input id="textSerie" type="text" maxlength="25"></td>
				<td width="15%"><input name="btnBuscarSimccar" type="button" id="btnBuscarSimccar" value="BUSCAR" onClick="buscaDatosSimccar()"></td>
				<td width="40%"></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) No. TARJETA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textTarjeta" type="text"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) IMEI&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textImei" type="text" ></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) MARCA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="selMarca" type="text" ></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) MODELO&nbsp;:&nbsp;</td>
				<td><input id="selModelo" type="text" ></td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) A&Ntilde;O FABRICACION&nbsp;:&nbsp;</td>
				<td><input id="textAnno" type="text" maxlength="4"  onkeypress="ValidaSoloNumerosAnno()"></td>
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
				<td><input type="checkbox" name="verificar" id="verificar" value="SI"/><input type="hidden" id="verificaOculto" size="3" maxlength="4">&nbsp;<label id="labConfirmar" disabled>VERIFICAR</lab></td>
				<td></td>
			</tr>
			<tr id="filaSeccion" style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right"><label id="labSeccion">(*) SECCION&nbsp;&nbsp;:&nbsp;</lab></td>
				<td width="67%" colspan="2"><select id="selSeccion" onChange="activaFechaNuevoEstado();" ></select></td>
				<td width="3%"></td>
	    </tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr style="padding: 0px 0px 2px 0px">
				<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
				<td width="60%" colspan="5"><select id="selEstado" onChange="activaFechaNuevoEstado();llamaReemplazo();"></select></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="30%" align="right"><label id="labFechaEstado" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
				<td width="20%"><input id="textFechaNuevoEstado" type="text" readonly="yes" disabled="yes" style="background-color:#E6E6E6"></td>
				<td width="5%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaSimccar" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaNuevoEstado,'dd-mm-yyyy',this,-100,-195)" style="visibility:hidden"></td>
				<td width="5%"></td>
				<td width="10%" align="right"><label id="labDocumentoEstado" disabled="yes">NUM. DOC.&nbsp;:&nbsp;</lab></td>
				<td width="20%"><input id="textDocumentoNuevoEstado" type="text" style="background-color:#E6E6E6" disabled="yes"></td>
				<td width="10%"></td>
			</tr>
			<tbody id="divUnidadAgregado" >
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right"><label id="labUnidadAgregado" disabled="yes">(*) UNIDAD AGREGADO&nbsp;:&nbsp;</lab></td>
				<td width="60%" colspan="5">
					<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<input id="codigoUnidadAgregado" type="hidden">
						<td width="94%"><input id="textUnidadAgregado" type="text" readonly="yes" style="background-color:#E6E6E6" disabled="yes"></td>
						<td width="6%" style="padding: 2px 0px 3px 3px"><input name="btnUnidades" type="button" id="btnUnidades" value="..." onclick="activaBuscaUnidadAgregado()" disabled="yes"></td>
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
		<td width="15%"><input name="btnDejarDisponible" type="button" id="btnDejarDisponible" value="TRASLADO"  onClick="activaVentanaIngresoFecha('1')" disabled="yes"></td>
		<td width="15%"></td>
		<td width="15%"></td>
		<td width="15%">&nbsp;</td>
		<td width="20%"><input name="btnGuardarSimccar" type="button" id="btnGuardarSimccar" value="GUARDAR" onClick="guardarFichaSimccar()" disabled="yes"></td>
		<td width="20%"><input name="btnCerrarFichaSimccar" type="button" id="btnCerrarFichaSimccar" value="CERRAR" onClick="top.cerrarVentana();" disabled="yes"></td>
	</tr>
	</table>
	</div>
</div>
<div id="divFicha2" style="position:absolute; visibility: hidden; height:705px; width:733px;">
	<div id="marcoLevantado">
		<div id="cuadro">
		<table cellpadding="1" cellspacing="0" width="100%">
			<tr>
				<td width="30%" align="right">(*) No. SERIE&nbsp;:&nbsp;</td>
				<td width="15%"><input id="textSerie2" type="text" maxlength="30"></td>
				 <td width="15%"><input name="btnBuscarSimccar2" type="button" id="btnBuscarSimccar2" value="BUSCAR" onClick="buscaDatosSimccarExt()"></td>
				<td width="40%"></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) No. TARJETA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textTarjeta2" type="text"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) IMEI&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textImei2" type="text" ></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) MARCA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="selMarca2" type="text"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right"><label id="labLugarReparacion">(*) MODELO&nbsp;:&nbsp;</lab></td>
				<td><input id="selModelo2" type="text"></td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) A&Ntilde;O FABRICACION&nbsp;:&nbsp;</td>
				<td><input id="textAnno2" type="text" maxlength="4"  onkeypress="ValidaSoloNumerosAnno()"></td>
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
			<tr id="filaSeccion2" style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right"><label id="labSeccion2">(*) SECCION&nbsp;&nbsp;:&nbsp;</lab></td>
				<td width="67%" colspan="2"><select id="selSeccion2" onChange="activaFechaNuevoEstado2();" ></select></td>
				<td width="3%"></td>
	    </tr>
			<tr>
				<td width="30%" align="right"><label id="labFechaEstado2" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
				<td width="20%"><input id="textFechaNuevoEstado2" type="text" readonly="yes" disabled="yes" style="background-color:#E6E6E6"></td>
				<td width="5%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaSimccar2" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaNuevoEstado2,'dd-mm-yyyy',this,-100,-195)" style="visibility:hidden"></td>
				<td width="5%"></td>
				<td width="10%" align="right"><label id="labDocumentoEstado2" disabled="yes">NUM. DOC.&nbsp;:&nbsp;</lab></td>
				<td width="20%"><input id="textDocumentoNuevoEstado2" type="text" style="background-color:#E6E6E6" disabled="yes"></td>
				<td width="10%"></td>
			</tr>
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
	  <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
	  <td width="10%"></td>
   	<td width="10%"></td>
	  <td width="10%"><input name="btnGuardarSimccar2" type="button" id="btnGuardarSimccar2" value="REEMPLAZO" onClick="guardarFichaReemplazo();" disabled="yes"></td>
	  <td width="10%"><input name="btnCerrarFichaSimccar2" type="button" id="btnCerrarFichaSimccar2" value="CERRAR"  onClick="top.cerrarVentana();" disabled="yes"></td>
	</tr>
	</table>
</div>
</body>
</html>
<?
	if($codigo != ""){
		echo "<script>";
			echo "leeEstadoSimccar('selEstado','mod1');";
			echo "leedatosSimccar('".$codigo."','','0');";
		  echo "document.getElementById('btnBuscarSimccar').disabled = 'true';";
			echo "document.getElementById('btnCerrarFichaSimccar').disabled = '';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
			echo "document.getElementById('origen1').style.visibility = 'hidden';";
			echo "document.getElementById('origen2').style.visibility = 'hidden';";
		echo "</script>";
	}else {
		echo "<script>";
			echo "leeEstadoSimccar('selEstado','nueva');";
			echo "document.getElementById('textTarjeta').focus();";
			echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';";
			echo "document.getElementById('labFechaEstado').disabled= '';";
			echo "document.getElementById('imagenCalendarioFichaSimccar').style.visibility = 'visible';";
			echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';";
			echo "document.getElementById('btnCerrarFichaSimccar').disabled = '';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
			echo "document.getElementById('origen1').style.visibility = 'hidden';";
			echo "document.getElementById('origen2').style.visibility = 'hidden';";
		echo "</script>";
	}
	
	if($contieneHijos==1){
		echo "<script>";
			echo "document.getElementById('filaSeccion').style.visibility = 'visible';";
			echo "document.getElementById('filaSeccion2').style.visibility = 'visible';";
		echo "</script>";
  }else{
		echo "<script>";
		echo "document.getElementById('filaSeccion').style.visibility = 'hidden';";
		echo "document.getElementById('filaSeccion2').style.visibility = 'hidden';";
		echo "</script>";
	}
?>