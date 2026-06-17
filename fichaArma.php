<?
include("version.php");
include("session.php");
include("tiempo.php");
$codigoArma 		= $_GET["codigoArma"];
$subSeccion			= $_GET['subSeccion'];
$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad	    = $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS'];
$contrasena			= $_SESSION['USUARIO_CLAVE'];
$codPerfil	= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaArma.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoArma.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/marcaArma.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/modeloArma.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/estadoRecurso.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/armas.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/seccion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
</head>
<body style="margin-top:10; margin-left:10; background-color:#f5fbf3" onload="javascript:leeTipoArma('selTipoArma');leeSeccion('selSeccion');leeEstadosRecursos('selEstado','ARM');leeMarcaArmas('selMarca');" scroll="no">
<input id="ultimaFecha"    	type="hidden" readonly="yes">
<input id="idArma" 			type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" 	type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="seccionBaseDatos" type="hidden" readonly="yes">
<input id="contrasena" type="hidden" value="<?echo $contrasena?>">
<input id="perfil"  type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">
<input id="subSeccion" type="hidden" readonly="yes" value="<?echo $subSeccion?>">
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="cubreVentana" style="display:none;">
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
			<td width="20%"><input type="button" id="btnAceptaUnidadAgregado" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoArma('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
			<td width="20%"><input type="button" id="CANCELAR" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
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
      <td width="20%"><input type="button" id="CANCELAR" value="CANCELAR" onClick="desactivaVentanaIngresoFecha()"></td>
	</tr>
	</table>
</div>
<div id="ventanaIngresoContrasena" style="display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="3"><div id="textTituloContrasena"><div></td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		<tr style="padding: 2px 0px 10px 0px;">
			<td width="50%"><input id="textContrasena" type="password" ></td>
			<td width="25%"><input type="button" id="btnAceptaContrasena" name="btnAceptaContrasena" value="ACEPTAR" onClick="validaContrasena()"></td>
    	<td width="25%"><input type="button" id="CANCELAR" value="CANCELARCANCELAR" onClick="desactivaVentanaIngresoContrasena()"></td>
		</tr>
		</table>
	</div>
</div>
<div style="width:94%;">
<div id="marcoLevantado">
	<div id="cuadro">
	<table cellpadding="1" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="right">(*) NUMERO SERIE &nbsp;:&nbsp;</td>
			<td width="15%"><input id="textSerieArma" type="text"></td>
			 <td width="15%"><input name="btnBuscarArma" type="button" id="btnBuscarArma" value="BUSCAR" onClick="buscaDatosArma()"></td>
			<td width="40%"></td>
		</tr>
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%">
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
		<tr id="filaSeccion">
			<td width="30%" align="right">(*) SECCION&nbsp;:&nbsp;</td>
			<td width="60%" colspan="2"><select id="selSeccion" onChange="activaFechaNuevoEstado()"></select></td>
			<td width="10%"></td>
		 </tr>
		<tr>
			<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
			<td width="60%" colspan="2"><select id="selEstado" onChange="activaFechaNuevoEstado()"></select></td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="30%" align="right"><label id="labFechaEstado" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
			<td width="15%"><input id="textFechaNuevoEstado" type="text" readonly="yes" style="background-color:#E6E6E6"></td>
			<td width="45%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaArma" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaNuevoEstado,'dd-mm-yyyy',this,-100,-195)" style="visibility:hidden"></td>
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
					<td width="6%" style="padding: 2px 0px 3px 3px"><input name="btnUnidades" type="button" id="btnUnidades" value="..." onclick="activaBuscaUnidadAgregado()" ></td>
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
	<td width="15%"><input name="btnDejarDisponible" type="button" id="btnDejarDisponible" value="TRASLADO" onClick="activaVentanaIngresoFecha('1')" disabled="yes"></td>
	<td width="15%"><input name="btnBaja" type="button" id="btnBaja" value="BAJA" onClick="activaVentanaIngresoFecha('2')" disabled="yes"></td>
	<td width="15%"></td>
	<td width="15%">&nbsp;</td>
	<td width="20%"><input name="btnGuardar" type="button" id="btnGuardar" value="GUARDAR" onClick="guardarFichaArma()" disabled="yes"></td>
	<td width="20%"><input name="btnCerrar" type="button" id="btnCerrar" value="CERRAR" onClick="top.cerrarVentanaFichaArmas();" ></td>
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
		//echo "document.getElementById('btnGuardar').disabled = '';\n";
		echo "document.getElementById('btnCerrar').disabled = '';\n";
		echo "listaUnidades('".$unidadPadre."','".$unidadUsuario."','selectUnidad');\n";
		echo "</script>\n";
	}else{
		echo "<script>\n";
		echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';\n";
		echo "document.getElementById('labFechaEstado').disabled= '';\n";
		echo "document.getElementById('imagenCalendarioFichaArma').style.visibility = 'visible';\n";
		echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';\n";
		//echo "document.getElementById('btnGuardar').disabled = '';\n";
		echo "document.getElementById('btnCerrar').disabled = '';\n";
		echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>\n";
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