<?include("session.php")?>   
<?include("tiempo.php")?>
<?
	$codigoFuncionario 		= $_GET["codigoFuncionario"];
	$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
	$unidadPadre		    	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	$tipoUnidad			      = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion añadida el 14-09-2015
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/grado.js"></script>
<script type="text/javascript" src="./js/cargo.js"></script>
<script type="text/javascript" src="./js/cuadrante.js"></script>
<script type="text/javascript" src="./js/funcionarios.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./js/usuario.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" onload="javascript:leeEscalafon('selEscalafon'); leeCargos('selCargo'); leeCuadrantes('<? echo $unidadUsuario?>',false,'selCuadrante',false);" scroll="no">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="cargoBaseDatos" type="hidden" readonly="yes">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codCuadranteBaseDatos" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>"><!--Variable oculta añadida el 14-09-2015-->

<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">

<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>

<div id="cubreVentanaPersonal" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"></td></table>
</div>

<div id="ventanaSeleccionaUnidad" style="display:none;">
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
		      <td width="20%"><input type="button" id="btn100" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregado('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
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
		      <td width="20%"><input type="button" id="btn100" name="btnAceptaFechaVentanaFecha" value="ACEPTAR" onClick="aceptaFechaVentaIngresoFecha()"></td>        
		      <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentnaIngresoFecha()"></td>
		</tr>
		</table>
</div>




<div style="width:94%;">
<div id="marcoLevantado">
	<div id="cuadro">
	<table cellpadding="1" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="right">(*) CODIGO (SIN GUION)&nbsp;:&nbsp;</td>
			<td width="15%"><input id="textCodigoFuncionario" type="text" maxlength="7"></td>
			 <td width="15%"><input name="btnBuscarFuncionario" type="button" id="btn100" value="BUSCAR" onClick="buscaDatosFuncionario()"></td>
			<td width="40%"></td>
		</tr>
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr style="padding: 0px 0px 3px 0px">
			<td width="30%" align="right">(*) ESCALAFON&nbsp;:&nbsp;</td>
			<td width="50%"><select id="selEscalafon" onChange="leeGrados('selGrado',this.value,this[this.selectedIndex].text)"></select></td>
			<td width="20%" rowspan="6" align="center"><img id="fotoFuncionario" width="121" height="119" align="left" src="./img/sinFoto.gif" onerror="this.src='./img/sinFoto.gif'"><td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">(*) GRADO&nbsp;:&nbsp;</td>
			<td><select id="selGrado"></select></td>
		</tr>
		<tr>
			<td align="right">(*) APELLIDO PATERNO&nbsp;:&nbsp;</td>
			<td><input id="textApellidoPaterno" type="text"></td>
		</tr>
		<tr>
			<td align="right">(*) APELLIDO MATERNO&nbsp;:&nbsp;</td>
			<td><input id="textApellidoMaterno" type="text"></td>
		</tr>
		<tr>
			<td align="right">(*) PRIMER NOMBRE&nbsp;:&nbsp;</td>
			<td><input id="textPrimerNombre" type="text"></td>
		</tr>
		<tr>
			<td align="right">SEGUNDO NOMBRE&nbsp;:&nbsp;</td>
			<td><input id="textSegundoNombre" type="text"></td>
		</tr>
		
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr style="padding: 0px 0px 0px 0px">
			<td width="30%" align="right">(*) CARGO&nbsp;(FUNCIÓN)&nbsp;:&nbsp;</td>
			<td width="67%" colspan="2"><select id="selCargo" onChange="activaFechaNuevoCargo();activaLicencia()"></select></td>
			<td width="3%"></td>
		</tr>
		<tbody id="cuadranteCargo">
		<tr style="padding: 2px 0px 1px 0px">
			<td width="30%" align="right"><label id="labCuadrante" disabled="yes">(*) CUADRANTE&nbsp;:&nbsp;</lab></td>
			<td width="67%" colspan="2"><select id="selCuadrante" disabled="yes" style="background-color:#E6E6E6" onChange="modificaCudranteFuncionario()"></select></td>
			<td width="3%"></td>
		</tr>
		</tbody>
		<tbody id="divUnidadAgregado">
		<tr style="padding: 0px 0px 0px 0px">
			<td width="30%" align="right"><label id="labUnidadAgregado" disabled="yes">(*) UNIDAD AGREGADO&nbsp;:&nbsp;</lab></td>
			<td width="67%" colspan="2">
				<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<input id="codigoUnidadAgregado" type="hidden">
					<td width="94%"><input id="textUnidadAgregado" type="text" readonly="yes" disabled="true" style="background-color:#E6E6E6"></td>
					<td width="6%" style="padding: 2px 0px 3px 3px"><input name="btnUnidades" type="button" id="btn100" value="..." disabled="yes" onclick="activaBuscaUnidadAgregado()"></td>
				</tr>
				</table>
			</td>
			<td width="3%"></td>
		</tbody>
		</div>
		<tr>
			<td width="30%" align="right"><label id="labFechaCargo" disabled="yes">(*) FECHA MOVIMIENTO&nbsp;:&nbsp;</lab></td>
			<td width="22%"><input id="textFechaUltimoCargo" type="text" readonly="yes" disabled="true" style="background-color:#E6E6E6"></td>
			<td width="45%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaUltimoCargo, textFechaUltimoCargo,'dd-mm-yyyy','250','38')" style="visibility:hidden"><label id="labFechaCargo1" disabled="yes">&nbsp;&nbsp;(*) CANTIDAD DE DIAS&nbsp;:&nbsp;</lab><input id="textCantDias" type="text" maxlength="2" disabled="true" style="background-color:#E6E6E6" onkeypress="return validaNumeros(event)" onclick="textoClic()"><input type="hidden" id="textCantDias2" value="" size="2"></td>
			<td width="3%"></td>
		</tr>
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
	  <td width="15%"><input name="btnDejarDisponible" type="button" id="btn100" value="TRASLADO" onClick="activaVentnaIngresoFecha('1')" disabled="yes"></td>
	  <td width="15%"><input name="btnRetiro" type="button" id="btn100" value="RETIRO" onClick="activaVentnaIngresoFecha('2')" disabled="yes"></td>
	  <td width="15%"><input name="btnBaja" type="button" id="btn100" value="BAJA" onClick="activaVentnaIngresoFecha('3')" disabled="yes"></td>
   	  <td width="15%">&nbsp;</td>
      <td width="20%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="GUARDAR" onClick="guardarFichaFuncionario()" disabled="yes"></td>
      <td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();" disabled="yes"></td>
</tr>
</table>
</div>
</body>
</html>
<?
	if ($codigoFuncionario != ""){
		echo "<script>";
		echo "leedatosFuncionario('".$codigoFuncionario."','0');";
		echo "document.getElementById('btnBuscarFuncionario').disabled = 'true';";
		echo "document.getElementById('textCodigoFuncionario').readOnly = 'true';";
		echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>";
	} else {
		echo "<script>";
		echo "document.getElementById('btnGuardarOrganizacion').disabled = '';";
		echo "document.getElementById('btnCerrarFichaFuncionario').disabled = '';";
				
		echo "document.getElementById('labFechaCargo').innerHTML = '(*) FECHA PRESENTACIÓN&nbsp;:&nbsp;';";
		echo "document.getElementById('labFechaCargo').disabled= '';";
		echo "document.getElementById('imagenCalendarioFichaFuncionario').style.visibility = 'visible';";
		echo "document.getElementById('textFechaUltimoCargo').style.backgroundColor = '';";
		echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		
		echo "</script>";
	}

?>