<?include("session.php")?>  
<?include("tiempo.php")?> 
<?
	$codigoArma 	= $_GET["codigoArma"];
	$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$unidadPadre	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	$contieneHijos          = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de sesion añadida el 17-04-2015
	//$unidadUsuario	= 10;
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaArma.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/tipoArma.js"></script>
<script type="text/javascript" src="./js/marcaArma.js"></script>
<script type="text/javascript" src="./js/modeloArma.js"></script>
<script type="text/javascript" src="./js/estadoRecurso.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/armas.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" onload="javascript:leeTipoArma('selTipoArma');leeEstadosRecursos('selEstado','ARM');leeMarcaArmas('selMarca')" scroll="no">
<input id="ultimaFecha"    	type="hidden" readonly="yes">
<input id="idArma" 			type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" 	type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!--Variable oculta añadida el 17-04-2015-->

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
		      <td width="20%"><input type="button" id="btn100" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoArma('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
		      <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
		</tr>
		</table>
</div>


<div style="width:94%;">
<div id="marcoLevantado">
	<div id="cuadro">
	<table cellpadding="1" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="right">(*) NUMERO SERIE &nbsp;:&nbsp;</td>
			<td width="15%"><input id="textSerieArma" type="text"></td>
			 <td width="15%"><input name="btnBuscarArma" type="button" id="btn100" value="BUSCAR" onClick="buscaDatosArma()"></td>
			<td width="40%"></td>
		</tr>
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%">
		<!--
		<tr style="padding: 0px 0px 0px 0px">
			<td width="30%" align="right">(*) NUMERO INSTITUCIONAL&nbsp;:&nbsp;</td>
			<td width="60%"><input id="textNumeroInstitucional" type="text"></td>
			<td width="10%"></td>
		</tr>
		<tr style="padding: 0px 0px 1px 0px">
			<td align="right">(*) BCU&nbsp;:&nbsp;</td>
			<td><input id="textBCU" type="text"></td>
			<td></td>
		</tr>
		-->
		<tr style="padding: 0px 0px 2px 0px">
			<td width="30%" align="right">(*) TIPO ARMA&nbsp;:&nbsp;</td>
			<td width="60%"><select id="selTipoArma"></select></td>
			<td width="10%"></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">(*) MARCA&nbsp;:&nbsp;</td>
			<td><select id="selMarca" onChange="leeModeloArmas(this[this.selectedIndex].value,'selModelo')"></select></td>
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
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
			<td width="60%" colspan="2"><select id="selEstado" onChange="activaFechaNuevoEstado()"></select></td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="30%" align="right"><label id="labFechaEstado" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
			<td width="15%"><input id="textFechaNuevoEstado" type="text" readonly="yes" style="background-color:#E6E6E6"></td>
			<td width="45%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaArma" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaNuevoEstado, textFechaNuevoEstado,'dd-mm-yyyy','250','18')" style="visibility:hidden"></td>
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
	  <td width="15%"><input name="btnDejarDisponible" type="button" id="btn100" value="TRASLADO" onClick="liberaArma()" disabled="yes"></td>
	  <td width="15%"><input name="btnBaja" type="button" id="btn100" value="BAJA" onClick="bajaArma()" disabled="yes"></td>
   	  <td width="15%"><!--<input name="btnHistoria" type="button" id="btn100" value="HISTORIA" onClick="verHistoriaVehiculo('<?echo $codigoVehiculo?>')">--></td>
   	  <td width="15%">&nbsp;</td>
      <td width="20%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="GUARDAR" onClick="guardarFichaArma()" disabled="yes"></td>
      <td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();" disabled="yes"></td>
</tr>
</table>
</div>
</body>
</html>
<?
	if ($codigoArma != ""){
		if($contieneHijos==10){
		echo "<script>";
		echo "leeDatosArma('".$codigoArma."','0');";
		echo "document.getElementById('btnBuscarArma').disabled = 'true';";
		echo "document.getElementById('textSerieArma').readOnly = 'true';";
		echo "listaUnidades('".$unidadPadre."','".$unidadUsuario."','selectUnidad');\n";
		echo "</script>";
	 }else{
		echo "<script>";
		echo "leeDatosArma('".$codigoArma."','0');";
		echo "document.getElementById('btnBuscarArma').disabled = 'true';";
		echo "document.getElementById('textSerieArma').readOnly = 'true';";
		echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>";
	 }
	}else {
		if($contieneHijos==10){
		echo "<script>\n";
		echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';\n";
		echo "document.getElementById('labFechaEstado').disabled= '';\n";
		echo "document.getElementById('imagenCalendarioFichaArma').style.visibility = 'visible';\n";
		echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';\n";
		echo "document.getElementById('btnGuardarOrganizacion').disabled = '';\n";
		echo "document.getElementById('btnCerrarFichaFuncionario').disabled = '';\n";
		echo "listaUnidades('".$unidadPadre."','".$unidadUsuario."','selectUnidad');\n";
		echo "</script>\n";
	}else{
		echo "<script>\n";
		echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';\n";
		echo "document.getElementById('labFechaEstado').disabled= '';\n";
		echo "document.getElementById('imagenCalendarioFichaArma').style.visibility = 'visible';\n";
		echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';\n";
		echo "document.getElementById('btnGuardarOrganizacion').disabled = '';\n";
		echo "document.getElementById('btnCerrarFichaFuncionario').disabled = '';\n";
		echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>\n";
  	}
	}

?>