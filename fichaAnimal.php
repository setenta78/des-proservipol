<?
include("version.php");
include("session.php");
include("tiempo.php");
$codigoAnimal	= $_GET["codigoAnimal"];
$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$unidadPadre    = $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad	= $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos 	= $_SESSION['USUARIO_CONTIENEHIJOS'];
$contrasena	= $_SESSION['USUARIO_CLAVE'];
$codPerfil	= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaAnimal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/animal.js?v=<?echo version?>" charset="utf-8"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/estadoAnimal.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/seccion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
</head>
<body style="margin-top:10; margin-left:10; background-color:#f5fbf3"  onload="javascript:leeEstadoAnimal('selEstado'); leeSeccion('selSeccion');" scroll="no">
<input id="ultimaFecha"    	type="hidden" readonly="yes">
<input id="idAnimal" 		type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" 	type="hidden" readonly="yes" value="<?echo $unidadUsuario;?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codLugarReparacionBaseDatos" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="seccionBaseDatos" type="hidden" readonly="yes">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="contrasena" type="hidden" value="<?echo $contrasena?>">
<input id="perfil"  type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">
<input id="archivo2" type="hidden" readonly="yes">
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="cubreVentana" style="display:none;">
	<table width="100%"><tr><td align="right" width="35%"></td></tr></table>
</div>
<div id="ventanaSeleccionaUnidad" style="display:none; border-left: 2px solid #ffffff;	border-top : 2px solid #ffffff;	border-right: 2px solid #909090;border-bottom: 2px solid #909090;">
	<div id="usuarioCuadro">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td><select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('<?echo $unidadUsuario?>',this.id);" onClick="habiltarAceptarUnidadAgregado(this.id);"></select></td>
		</tr>
	</table>
	</div>
	<table width="100%">
	<tr>
		<td width="20%"></td>
		<td width="20%">&nbsp;</td>
		<td width="20%">&nbsp;</td>
		<td width="20%"><input type="button" id="btnAceptaUnidadAgregado" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoAnimal('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
		<td width="20%"><input type="button" id="CANCELAR" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
	</tr>
	</table>
</div>
<div id="ventanaIngresoFecha" style="display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
			<input id="textTipo" type="hidden">
			<tr>
				<td colspan="2"><div id="textTipoMovimentoVentanaFecha"></div></td>
			</tr>
			<tr style="padding: 2px 0px 10px 0px;">
				<td width="90%"><input id="textFechaVentanaFecha" type="text" readonly="yes"></td>
				<td width="10%">&nbsp;<input id="imagenCalendarioVentanaFecha" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaVentanaFecha,'dd-mm-yyyy',this,-100,-195)"></td>
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
		<tr><td colspan="3"><div id="textTituloContrasena"></div></td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		<tr style="padding: 2px 0px 10px 0px;">
			<td width="50%"><input id="textContrasena" type="password" ></td>
			<td width="25%"><input type="button" id="btnAceptaContrasena" name="btnAceptaContrasena" value="ACEPTAR" onClick="validaContrasena()"></td>
    	<td width="25%"><input type="button" id="CANCELAR" value="CANCELAR" onClick="desactivaVentanaIngresoContrasena()"></td>
		</tr>
		</table>
	</div>
</div>
<div style="width:94%;">
	<div id="marcoLevantado">
		<div id="cuadro">
		<table cellpadding="1" cellspacing="0" width="100%">
			<tr>
				<td width="30%" align="right">(*) BCU&nbsp;(SIN GUION):&nbsp;</td>
				<td width="15%"><input id="textNumeroBCU" type="text" maxlength="11"></td>
				<td width="15%"><input name="btnBuscarAnimal" type="button" id="btnBuscarAnimal" value="BUSCAR" onClick="buscaDatosAnimal()"></td>
				<td width="40%"></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) NOMBRE&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textNombre" type="text" maxlength="6" readonly="yes"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) RAZA&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textRaza" type="text" readonly="yes"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right">(*) FECHA NACIMIENTO&nbsp;:&nbsp;</td>
				<td width="60%"><input id="textFechaNacimiento" type="text" readonly="yes"></td>
				<td width="10%"></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right"><label id="labLugarReparacion">(*) TIPO DE ANIMAL&nbsp;:&nbsp;</lab></td>
				<td>
					<select id="selTipoAnimal">
					  <option value="0">SELECCIONE TIPO DE ANIMAL ...</option>
					  <option value="10">CABALLO</option>
					  <option value="40">PERRO</option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) COLOR&nbsp;:&nbsp;</td>
				<td>
					<select id="selColor">
					  <option value="0">SELECCIONE COLOR ...</option>
					  <option value="1">NO ESPECIFICADO</option>
					  <option value="10">NEGRO</option>
					  <option value="20">BAYO</option>
					  <option value="30">MULATO</option>
					  <option value="40">TORDILLO</option>
					  <option value="50">BARROSO</option>
					  <option value="60">ROSILLO</option>
					  <option value="70">ROSADO</option>
					  <option value="80">COLORADO</option>
					  <option value="90">ALAZAN</option>
					  <option value="100">BLANCO</option>
					  <option value="110">ALAZAN TOSTADO</option>
					  <option value="120">OVERO</option>
					  <option value="130">DORADILLO</option>
					  <option value="140">OVERO COLORADO</option>
					  <option value="150">AMARILLO</option>
					  <option value="160">CASTANO</option>
					  <option value="170">ZAINO</option>
					  <option value="180">PINTO</option>
					  <option value="190">GRIS</option>
					  <option value="200">MANTO NEGRO VIENTRE Y PATAS AMARILLAS</option>
					  <option value="210">CAFE</option>
					  <option value="220">MANTO ROJO FUEGO</option>
					  <option value="230">AMARILLO CON NEGRO</option>
					  <option value="240">CARBONADO</option>
					  <option value="250">BLANCO CON MANCHAS NEGRAS Y AMARILLAS</option>
					  <option value="260">RUBIO</option>
					</select></td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) PELAJE&nbsp;:&nbsp;</td>
				<td>
					<select id="selPelaje">
						<option value="0">SELECCIONE PELAJE ...</option>
						<option value="1">NO ESPECIFICADO</option>
						<option value="10">CORTO</option>
						<option value="20">MEDIO</option>
						<option value="30">LARGO</option>
					</select>
			  </td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) SEXO&nbsp;:&nbsp;</td>
				<td>
					<select id="selSexo">
					  <option value="0">SELECCIONE SEXO ...</option>
					  <option value="10">MACHO</option>
					  <option value="20">HEMBRA</option>
					</select>
				</td>
				<td></td>
			</tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td align="right">(*) VERIFICAR ESTADO&nbsp;:&nbsp;</td>
				<td><input type="checkbox" name="verificar" id="verificar" value="SI"/><input type="hidden" id="verificaOculto" size="3" maxlength="4">&nbsp;<label id="labConfirmar" disabled>VERIFICAR</lab></td>
				<td></td>
			</tr>
		</table>
		</div>
		<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
			<tr id="filaSeccion" style="padding: 0px 0px 0px 0px">
				<td width="30%" align="right"><label id="labSeccion">(*) SECCION&nbsp;&nbsp;:&nbsp;</lab></td>
				<td width="67%" colspan="2"><select id="selSeccion" onChange="activaFechaNuevoEstado()"></select></td>
				<td width="3%"></td>
		  </tr>
			<tr style="padding: 0px 0px 2px 0px">
				<td width="30%" align="right">(*) ESTADO&nbsp;:&nbsp;</td>
				<td width="60%" colspan="5"><select id="selEstado" onChange="activaFechaNuevoEstado();"></select></td>
				<td width="10%"></td>
			</tr>
			<tr>
				<td width="30%" align="right"><label id="labFechaEstado" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
				<td width="20%"><input id="textFechaNuevoEstado" type="text" readonly="yes" disabled="yes" style="background-color:#E6E6E6"></td>
				<td width="5%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaAnimal" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaNuevoEstado,'dd-mm-yyyy',this,-100,-195)" style="visibility:hidden"></td>
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
						<td width="6%" style="padding: 2px 0px 3px 3px"><input name="btnUnidades" type="button" id="btnUnidades" value="..." onclick="activaBuscaUnidadAgregado();" disabled="yes"></td>
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
	  <td width="15%"><input name="btnDejarDisponible" type="button" id="btnDejarDisponible" value="TRASLADO"  onClick="activaVentanaIngresoFecha('1');" disabled="yes"><input id="idBoton" type="hidden" readonly="yes" value="1"></td>
    <td width="15%"><input name="btnBaja" type="button" id="btnBaja" value="BAJA" onClick="activaVentanaIngresoFecha('2');" disabled="yes"><input id="idBoton" type="hidden" readonly="yes" value="2"></td>
 	  <td width="15%"></td>
 	  <td width="15%">&nbsp;</td>
 	  <td width="20%"><input name="btnGuardarAnimal" type="button" id="btnGuardarAnimal" value="GUARDAR" onClick="guardarFichaAnimal();" disabled="yes"><input id="idBoton" type="hidden" readonly="yes" value="3"></td>
    <td width="20%"><input name="btnCerrarFicha" type="button" id="btnCerrarFicha" value="CERRAR" onClick="top.cerrarVentana();" ></td>
	</tr>
	</table>
	</div>
</div>
<div id="divDatosFalla" style="position:absolute; visibility: hidden; height:305px; width:733px;" >
<div id="marcoLevantado">
	<input type="hidden" id="correlativo" value="">
	<table width="100%" height="80%" border="0" align="center" >
		<tr align="center">
			<td id="tituloSelecMultiple"><div id="tituloFallasPosibles">FALLAS POSIBLES</div></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td id="tituloSelecMultiple"><div id="tituloFallasPresentes">FALLAS PRESENTES</div></td>
		</tr>
		<tr align="center">
			<td>
				<select id="fallasPosibles" size="16"  multiple>
				<option value="0">CARGANDO FALLAS ... </option></select>
			</td>
			<td>&nbsp;</td>
			<td>
				<input id="Btn_Agregar" type="button" name="Btn_Agregar" value=">>" >
				<input id="Btn_Quitar" type="button" name="Btn_Quitar" value="<<" >
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
				<input type="button" value="ACEPTAR" id="btnSubir" name="btnSubir"/>
			</td>
			<td width="15%"><input name="btnPosponer" type="button" id="btnPosponer" value="POSPONER" </td>
			<td width="20%"><input name="btnCerrarFichaAnimal" type="button" id="btnCerrarFichaAnimal" value="CERRAR" onClick="top.cerrarVentana();" ></td>
		</tr>
	</table>
</div>
</body>
</html>
<?
	if ($codigoAnimal != ""){
		echo "<script>";
			echo "leeDatosAnimal('".$codigoAnimal."','','0');";
			echo "document.getElementById('btnBuscarAnimal').disabled = 'true';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>";
	} else {
		echo "<script>";
			echo "document.getElementById('textNombre').focus();";
			echo "document.getElementById('labFechaEstado').innerHTML = '(*) FECHA INGRESO&nbsp;:&nbsp;';";
			echo "document.getElementById('labFechaEstado').disabled= '';";
			echo "document.getElementById('imagenCalendarioFichaAnimal').style.visibility = 'visible';";
			echo "document.getElementById('textFechaNuevoEstado').style.backgroundColor = '';";
			echo "document.getElementById('btnGuardarAnimal').disabled = 'true';";
			echo "document.getElementById('btnCerrarFichaAnimal').disabled = '';";
			echo "listaUnidades('".$unidadUsuario."','".$unidadPadre."','selectUnidad');\n";
		echo "</script>";
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