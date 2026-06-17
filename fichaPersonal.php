<?
include("version.php");
include("session.php");
include("tiempo.php");
$codigoFuncionario	= $_GET["codigoFuncionario"];
$subMenu			= $_GET["subMenu"];
$unidadUsuario		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
$tienePlanCuadrante	= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad			= $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos		= $_SESSION['USUARIO_CONTIENEHIJOS'];
$contrasena			= $_SESSION['USUARIO_CLAVE'];
$codPerfil			= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$UnidadTipo			= $_SESSION['USUARIO_UNIDADTIPO'];
$UnidadEspecialidad	= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);

$tipoUnidadNew			= $_SESSION['USUARIO_TIPO_UNIDAD'];
$especialidadUnidadNew	= $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'];
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/grado.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/cargo.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/cuadrante.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/funcionarios.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/seccion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
</head>
<body style="margin-top:10; background-color:#f5fbf3;" onload="javascript: leeEscalafon('selEscalafon'); leeSeccion('selSeccion'); leeCuadrantes('<? echo $unidadUsuario?>',false,'selCuadrante',false);" scroll="no">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="unidadPadre"  type="hidden" readonly="yes" value="<?echo $unidadPadre?>">
<input id="UnidadEspecialidad"  type="hidden" readonly="yes" value="<?echo $UnidadEspecialidad?>">
<input id="cargoBaseDatos" type="hidden" readonly="yes">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codCuadranteBaseDatos" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="seccionBaseDatos" type="hidden" readonly="yes">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="perfil"  type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="subMenu"  type="hidden" readonly="yes" value="<?echo $subMenu?>">
<input id="UnidadTipo"  type="hidden" readonly="yes" value="<?echo $UnidadTipo?>">
<input type="hidden" id="tienePlanCuadrante" value="<? echo $tienePlanCuadrante?>">
<input id="contrasena" type="hidden" value="<? echo $contrasena?>">
<input id="gradoBaseDatos" type="hidden" readonly="yes">
<input id="escalafonBaseDatos" type="hidden" readonly="yes">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">

<input id="tipoUnidadNew" value="<? echo $tipoUnidadNew; ?>" type="hidden" readonly="yes">
<input id="especialidadUnidadNew" value="<? echo $especialidadUnidadNew; ?>" type="hidden" readonly="yes">

<div id="mensajeCargando" style="display:none;">
	<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="cubreVentana" style="display:none;">
	<table width="100%"><tr><td align="right" width="35%"></td></tr></table>
</div>
<div id="ventanaSeleccionaUnidad" style="display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>
			<select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('<? $unidadUsuario ?>',this.id);" onClick="habiltarAceptarUnidadAgregado(this.id)"></select>
			</td>
		</tr>
		</table>
	</div>
	<table width="100%">
		<tr>
		  <td width="20%"></td>
	 	  <td width="20%">&nbsp;</td>
	 	  <td width="20%">&nbsp;</td>
	    <td width="20%"><input type="button" id="btnAceptaUnidadAgregado" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregado('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
	    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
		</tr>
	</table>
</div>
<div id="ventanaIngresoFecha" style="display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<input id="textTipo" type="hidden">
		<tr><td colspan="2"><div id="textTipoMovimentoVentanaFecha"></div></td></tr>
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
    <td width="20%"><input type="button" id="btn100" name="btnAceptaFechaVentanaFecha" value="ACEPTAR" onClick="aceptaFechaVentanaIngresoFecha()"></td>        
    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoFecha()"></td>
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
    	<td width="25%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoContrasena()"></td>
		</tr>
		</table>
	</div>
</div>
<div style="width:97%; margin-left:10px;">
<div id="marcoLevantado">
	<div id="cuadro">
	<table cellpadding="1" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="right">(*) CODIGO (SIN GUION)&nbsp;:&nbsp;</td>
			<td width="15%"><input id="textCodigoFuncionario" type="text" maxlength="7"></td>
			<td width="15%"><input name="btnBuscar" type="button" id="btnBuscar" value="BUSCAR" onClick="buscaDatosFuncionario()"></td>
			<td width="40%">&nbsp;</td>
		</tr>
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr style="padding: 0px 0px 3px 0px">
			<td width="30%" align="right">(*) ESCALAFON&nbsp;:&nbsp;</td>
			<td width="50%"><select id="selEscalafon" onChange="leeGrados('selGrado',this.value,this[this.selectedIndex].text)"></select></td>
			<td width="20%" rowspan="6" align="center"><img id="fotoFuncionario" width="121" height="119" align="center" src="./img/sinFoto.png" onerror="this.src='./img/sinFoto.png'"></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">(*) GRADO&nbsp;:&nbsp;</td>
			<td><select id="selGrado"></select></td>
		</tr>
		<tr>
			<td align="right">APELLIDO PATERNO&nbsp;:&nbsp;</td>
			<td><input id="textApellidoPaterno" type="text" readonly="yes"></td>
		</tr>
		<tr>
			<td align="right">APELLIDO MATERNO&nbsp;:&nbsp;</td>
			<td><input id="textApellidoMaterno" type="text" readonly="yes"></td>
		</tr>
		<tr>
			<td align="right">PRIMER NOMBRE&nbsp;:&nbsp;</td>
			<td><input id="textPrimerNombre" type="text" readonly="yes"></td>
		</tr>
		<tr>
			<td align="right">SEGUNDO NOMBRE&nbsp;:&nbsp;</td>
			<td><input id="textSegundoNombre" type="text" readonly="yes"></td>
		</tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">RUT&nbsp;:&nbsp;</td>
			<td><input id="textRutFuncionario" type="text" readonly="yes"></td>
		</tr>
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr id="filaSeccion" style="padding: 0px 0px 0px 0px">
			<td width="30%" align="right"><label id="labSeccion">(*) SECCI&Oacute;N&nbsp;&nbsp;:&nbsp;</lab></td>
			<td width="67%" colspan="2"><select id="selSeccion" onChange="activaFechaNuevoCargo()"></select></td>
			<td width="3%"></td>
    </tr>		
    <tr id="filaCategoriaCargo">
			<td width="30%" align="right"  style="padding: 0px 0px 4px 0px"><label id="labCategoriaCargo">(*) TIPO CARGO&nbsp;&nbsp;:&nbsp;</lab></td>
			<td width="67%" colspan="2" style="padding: 0px 0px 4px 0px"><select id="selCategoriaCargo" onChange="leeCargos('selCargo', document.getElementById('selCategoriaCargo').value, document.getElementById('selEscalafon').value, document.getElementById('selGrado').value)"></select></td>
			<td width="3%"  style="padding: 0px 0px 4px 0px"></td>
    </tr>
		<tr>
			<td width="30%" align="right"  style="padding: 0px 0px 4px 0px">(*) CARGO&nbsp;(FUNCI&Oacute;N)&nbsp;:&nbsp;</td>
			<td width="67%" colspan="2"  style="padding: 0px 0px 4px 0px"><select id="selCargo" disabled="yes" onChange="activaFechaNuevoCargo();"></select></td>
			<td width="3%"  style="padding: 0px 0px 4px 0px"></td>
		</tr>
		<tbody id="cuadranteCargo">
		<tr>
			<td width="30%" align="right"  style="padding: 0px 0px 4px 0px"><label id="labCuadrante" disabled="yes">(*) CUADRANTE&nbsp;:&nbsp;</lab></td>
			<td width="67%" colspan="2"  style="padding: 0px 0px 4px 0px"><select id="selCuadrante"  style="background-color:#E6E6E6" onChange="modificaCuadranteFuncionario()"></select></td>
			<td width="3%"  style="padding: 0px 0px 4px 0px"></td>
		</tr>
		</tbody>
		<tbody id="divUnidadAgregado">
		<tr >
			<td width="30%" align="right"><label id="labUnidadAgregado" disabled="yes">(*) UNIDAD DE DESTINO&nbsp;:&nbsp;</lab></td>
			<td width="67%" colspan="2">
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<input id="codigoUnidadAgregado" type="hidden">
						<td width="94%"><input id="textUnidadAgregado" type="text" readonly="yes" disabled="true" style="background-color:#E6E6E6"></td>
						<td width="6%" style="padding: 2px 0px 3px 3px"><input name="btnUnidades" type="button" id="btnUnidades" value="..." disabled="yes" onclick="activaBuscaUnidadAgregado()"></td>
					</tr>
				</table>
			</td>
			<td width="3%"></td>
		</tbody>
		</div>
		<tr>
			<td width="30%" align="right"><label id="labFechaCargo" disabled="yes">(*) FECHA MOVIMIENTO&nbsp;:&nbsp;</lab></td>
			<td width="22%"><input id="textFechaUltimoCargo" type="text" readonly="yes" disabled="true" style="background-color:#E6E6E6"></td>
			<td width="45%" style="padding: 0px 0px 0px 2px">
			<input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaUltimoCargo,'dd-mm-yyyy',this,-100,-195)" style="visibility:hidden">
			<label id="labFechaCargo1" disabled="yes">&nbsp;</lab>
			<input type="hidden" id="textCantDias2" value="" size="2">
			</td>
			<td width="3%"></td>
		</tr>
	</table>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td style="font-size:9px; font-weight:bold; padding: 5px 0px 0px 0px" align="left"><div id="labFechaCargoDesde"></div></td>
			<td style="font-size:9px; padding: 5px 0px 0px 0px" align="right">(*) DATOS OBLIGATORIOS</td>
		</tr>
	</table>
</div>
<table width="100%">
<tr> 
	<td width="15%"><input name="btnDejarDisponible" type="button" id="btnDejarDisponible" value="TRASLADO" onClick="activaVentanaIngresoFecha('1')" disabled="yes"></td>
	<td width="15%"><input name="btnRetiro" type="button" id="btnRetiro" value="RETIRO" onClick="activaVentanaIngresoFecha('2')" disabled="yes"></td>
	<td width="15%"><input name="btnBaja" type="button" id="btnBaja" value="BAJA" onClick="activaVentanaIngresoFecha('3')" disabled="yes"></td>
	<td width="15%">&nbsp;</td>
	<td width="20%"><input name="btnGuardar" type="button" id="btnGuardar" value="GUARDAR" onClick="guardarFichaFuncionario()" disabled="yes"></td>
	<td width="20%"><input name="btnCerrarFicha" type="button" id="btnCerrarFicha" value="CERRAR" onClick="top.cerrarVentanaFicha();" disabled="yes"></td>
</tr>
</table>
</div>
</body>
</html>
<?
	if ($codigoFuncionario != ""){

		if($contieneHijos==10){
		echo "<script>";
		echo "leedatosFuncionario('{$codigoFuncionario}','0');";
		echo "document.getElementById('btnBuscar').disabled = 'true';";
		echo "document.getElementById('textCodigoFuncionario').readOnly = 'true';";
		echo "</script>";
		}else{
		echo "<script>";
		echo "leedatosFuncionario('{$codigoFuncionario}','0');";
		echo "document.getElementById('btnBuscar').disabled = 'true';";
		echo "document.getElementById('textCodigoFuncionario').readOnly = 'true';";
		echo "</script>";
		}
	} else {
		if($contieneHijos==10){
		echo "<script>";
		echo "document.getElementById('btnCerrarFicha').disabled = '';";
		echo "document.getElementById('labFechaCargo').innerHTML = '(*) FECHA PRESENTACI&Oacute;N&nbsp;:&nbsp;';";
		echo "document.getElementById('labFechaCargo').disabled= '';";
		echo "document.getElementById('imagenCalendarioFichaFuncionario').style.visibility = 'visible';";
		echo "document.getElementById('textFechaUltimoCargo').style.backgroundColor = '';";
		echo "</script>";
		}else{
		echo "<script>";
		echo "document.getElementById('btnCerrarFicha').disabled = '';";
		echo "document.getElementById('labFechaCargo').innerHTML = '(*) FECHA PRESENTACI&Oacute;N&nbsp;:&nbsp;';";
		echo "document.getElementById('labFechaCargo').disabled= '';";
		echo "document.getElementById('imagenCalendarioFichaFuncionario').style.visibility = 'visible';";
		echo "document.getElementById('textFechaUltimoCargo').style.backgroundColor = '';";
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