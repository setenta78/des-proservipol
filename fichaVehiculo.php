<?
include("version.php");
include("session.php");
include("tiempo.php");
$codigoVehiculo	= $_GET["codigoVehiculo"];
$subMenu		= $_GET["subMenu"];
$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$unidadPadre	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad		= $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos	= $_SESSION['USUARIO_CONTIENEHIJOS'];
$codFuncionario	= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$contrasena		= $_SESSION['USUARIO_CLAVE'];
$codPerfil		= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
$permisoConsultarPerfil	= ($_SESSION['PERMISO_CONSULTAR_PERFIL']==1);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaVehiculo.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/procedenciaVehiculo.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoVehiculo.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/estadoRecurso.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/marcaVehiculo.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/modeloVehiculo.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/clasificacionCitacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/vehiculos.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/lugarReparacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/seccion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/fallaVehiculo.js?v=<?echo version?>" charset="utf-8"></script>
<script type="text/javascript" src="./js/listaMultiple.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
</head>
<body style="margin-top:10; margin-left:10; background-color:#f5fbf3" onload="javascript:leeProcedenciaVehiculos('selProcedencia');leeTipoVehiculos('selTipoVehiculo');leeEstadosRecursos('selEstado','VEH'); leeMarcaVehiculos('selMarca');leeModeloVehiculos('','selModelo'); leeLugaresDeReparacion('selLugarReparacion'); leeSeccion('selSeccion'); leeClasificacionCitacion('selClasificacionCitacion');" scroll="no">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="idVehiculo" type="hidden" readonly="yes">
<input id="estadoBaseDatos" type="hidden" readonly="yes">
<input id="unidadUsuario" type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codLugarReparacionBaseDatos" type="hidden" readonly="yes">
<input id="codClasificacionCitacionBaseDatos" type="hidden" readonly="yes">
<input id="subMenu" type="hidden" readonly="yes" value="<?echo $subMenu?>">
<input id="tipoUnidad" type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="seccionBaseDatos" type="hidden" readonly="yes">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="codFuncionario" type="hidden" value="<?echo $codFuncionario?>">
<input id="contrasena" type="hidden" value="<?echo $contrasena?>">
<input id="perfil" type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">
<input id="permisoConsultarPerfil" type="hidden" readonly="yes" value="<?echo $permisoConsultarPerfil?>">
<div id="mensajeCargando" style="display:none;">
	<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="divListaVehiculos" style="display:none;" >
</div>
<div id="cubreVentana" style="display:none; position:absolute; z-index:100;">
	<table width="100%"><tr><td align="right" width="35%"></td></tr></table>
</div>
<div id="ventanaSeleccionaUnidad" style="position:absolute; z-index:200; display:none; border-left: 2px solid #ffffff;	border-top : 2px solid #ffffff;	border-right: 2px solid #909090;border-bottom: 2px solid #909090;">
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
    <td width="20%"><input type="button" id="btnAceptaUnidadAgregado" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoVehiculo('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
	</tr>
	</table>
</div>
<div id="ventanaIngresoFecha" style="position:absolute; z-index:200; display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<input id="textTipo" type="hidden">
		<tr><td colspan="2"><div id="textTipoMovimentoVentanaFecha" /></td></tr>
		<tr style="padding: 2px 0px 10px 0px;">
			<td width="90%"><input id="textFechaVentanaFecha" type="text" readonly="yes"></td>
			<td width="10%">&nbsp;<input id="imagenCalendarioVentanaFecha" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaVentanaFecha,'dd-mm-yyyy',this,-100,-195)"></td>
		</tr>
		</table>
	</div>
	<table width="100%">
	<tr>
	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
    <td width="20%"><input type="button" id="btnAceptaFechaVentanaFecha" name="btnAceptaFechaVentanaFecha" value="ACEPTAR" onClick="aceptaFechaVentanaIngresoFecha()"></td>        
    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoFecha()"></td>
	</tr>
	</table>
</div>
<div id="ventanaIngresoContrasena" style="position:absolute; z-index:200; display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr><td colspan="3"><div id="textTituloContrasena"/></td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		<tr style="padding: 2px 0px 10px 0px;">
			<td width="50%"><input id="textContrasena" type="password" ></td>
			<td width="25%"><input type="button" id="btnAceptaContrasena" name="btnAceptaContrasena" value="ACEPTAR" onClick="validaContrasena()"></td>
    	<td width="25%"><input type="button" id="btn100" value="CANCELAR" onClick="desactivaVentanaIngresoContrasena()"></td>
		</tr>
		</table>
	</div>
</div>
<div id="ventanaHistorialTarjeta" style="position:absolute; z-index:200; display:none; border-left: 2px solid #ffffff;	border-top : 2px solid #ffffff;	border-right: 2px solid #909090;border-bottom: 2px solid #909090;">
	<div id="marcoLevantado">
		<div id="divListadoHistorialTC"></div>
	</div><br>
	<input type="button" value="NUEVA TARJETA" style="width: 150px; position: relative; left: 5%;" onclick="activaIngresoTarjeta();" >
	<input type="button" id="btn100" value="CERRAR" onClick="cerrarVentanaBuscaUnidad('ventanaHistorialTarjeta')" style="width: 100px; position: relative; left: 50%;" >
</div>
<div id="ventanaIngresoTarjeta" style="position:absolute; z-index:200; display:none; border-left: 2px solid #ffffff;	border-top : 2px solid #ffffff;	border-right: 2px solid #909090;border-bottom: 2px solid #909090;">
	<div id="marcoLevantado">
		<table cellpadding="2" cellspacing="2" width="100%">
		<tr>
			<td style="width: 0px;" >Patente:</td>
			<td colspan="3"><div id="PatenteDIV"></div></td>
		</tr>
		<tr>
			<td>Nro Tarjeta:</td>
			<td style="width: 90px;" ><input id="textNroTarjeta" type="text" size="9" maxlength="8" autocomplete="off" onkeypress="ValidaSoloNumeros()" onChange="btnAceptarCambioTC.disabled=false" ></td>
			<td style="width: 0px;" >-</td>
			<td><input id="textNroTarjetaDV" type="text" size="1" maxlength="1" autocomplete="off" onkeypress="ValidaSoloNumerosK()" ></td>
		</tr>
		<tr>
			<td>Valida Desde:</td>
			<td><input id="textFechaTarjeta" type="text" readonly="yes" disabled="yes" style="background-color:#E6E6E6;width: 110px;"></td>
			<td><input id="imagenCalendario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaTarjeta,'dd-mm-yyyy',this,-100,-195)"></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="3">
				<form id="formSubeArchivoTC" name="formSubeArchivoTC" action="adjuntarArchivoSubirTarjetaCombustible.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo" >
					<input type="file" size="20" name="archivoTC" id="archivoTC" style="display: none;" onChange="archivoCargado();" />
                    <input type="hidden" id="rutaArchivo" name="rutaArchivo" value="">
					<input type="hidden" id="validado" name="validado" value="1">
					<div id="bottonCargarArchivo" onClick="archivoTC.click();" style="cursor:pointer; width: 140px; border-width:2px; border-style:dotted; border-color: ghostwhite;" ><a style="position:relative; top:-8px; left: 15px;" >Subir Archivo</a><img src="./img/botonNube.png" width="25px" height="25px" style="position:relative; left:25px; top:0px;" ></div>
					<div id="bottonArchivoCargado" onClick="eliminarArchivo();" style="cursor:pointer; display:none;" ><a style="position:relative; top:-8px;">Archivo Cargado</a><img src="./img/aprobado.png" width="25px" height="25px" ></div>
	  			</form>
			</td>
		</tr>
		</table>
	</div>
	<table width="100%">
	<tr>
	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
 	  <td width="20%">&nbsp;</td>
    <td width="20%"><input type="button" id="btnAceptarCambioTC" name="btnAceptarCambioTC" value="ACEPTAR" disabled="yes" onClick="aceptarCambioTarjetaCombustible();"></td>        
    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaIngresoTarjeta'); cerrarVentanaBuscaUnidad('ventanaHistorialTarjeta');"></td>
	</tr>
	</table>
</div>
<div id="divDatosBasicos" style="position:absolute; visibility: visible;">
	<div style="width:94%;">
		<div id="marcoLevantado">
			<div id="cuadro">
				<table cellpadding="1" cellspacing="0" width="100%">
					<tr>
						<td width="30%" align="right">CODIGO EQUIPO&nbsp;:&nbsp;</td>
						<td width="20%"><input id="textCodigoEquipo" type="text" maxlength="11"></td>
						<td width="15%"><input name="btnBuscarVehiculo" type="button" id="btnBuscarVehiculo" value="BUSCAR" onClick="buscaDatosVehiculo()"></td>
						<td width="35%"></td>
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
					<tr style="padding: 0px 0px 2px 0px">
						<td width="30%" align="right"><label id="labAnnoFab">A&Ntilde;O DE FABRICACI&Oacute;N&nbsp;:&nbsp;</lab></td>
						<td width="60%" colspan="5"><input id="textAnnoFab" type="text" size="10" maxlength="4" readonly="yes" onkeypress="ValidaSoloNumeros()"><input id="validaAnnoOculto" type="hidden" size="3" maxlength="4"></td>
						<td width="10%"></td>
					</tr>
					
					<tr style="padding: 0px 0px 2px 0px">
						<td width="30%" align="right"><label id="labAnnoFab">NUMERO TARJETA&nbsp;:&nbsp;</lab></td>
						<td width="60%" ><div id="nroTarjeta" style="position:relative;display:none;"><div id="nroTarjertaDIV" style="position:absolute;top:50%;left:10%;transform:translate(-50%,-50%);cursor:default;"></div><div style="position:absolute;left:24%;transform:translate(-50%,-50%);cursor:pointer;" onClick="mostrarHistorialTC();" ><img src="./img/tarjetaAzul.png" width="25px" height="20px" ></div></div>
							<input id="btnSubirTarjeta" type="button" name="btnSubirTarjeta" value="Ingresar Tarjeta de Combustible" onclick="activaIngresoTarjeta();" style="width: 240px;" >
						</td>
						<td width="10%"></td>
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
						<td width="30%" align="right"><label id="labClasificacionCitacion" disabled="yes">(*) CAUSA DE NO DISPONIBILIDAD&nbsp;:&nbsp;</lab></td>
						<td width="60%" colspan="5"><select id="selClasificacionCitacion" disabled="yes"></select></td>
						<td width="10%"></td>
					</tr>
					<tr>
						<td width="30%" align="right"><label id="labFechaEstado" disabled="yes">(*) FECHA NUEVO ESTADO&nbsp;:&nbsp;</lab></td>
						<td width="20%"><input id="textFechaNuevoEstado" type="text" readonly="yes" disabled="yes" style="background-color:#E6E6E6"></td>
						<td width="5%" style="padding: 0px 0px 0px 2px"><input id="imagenCalendarioFichaVehiculo" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaNuevoEstado,'dd-mm-yyyy',this,-100,-195)" style="visibility:hidden"></td>
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
			<td width="15%"><input name="btnDejarDisponible" type="button" id="btnDejarDisponible" value="TRASLADO" onClick="activaVentanaIngresoFecha('1')" disabled="yes"></td>
			<td width="15%"><input name="btnBaja" type="button" id="btnBaja" value="BAJA" onClick="activaVentanaIngresoFecha('2')" disabled="yes"></td>
			<td width="15%">&nbsp;</td>
			<td width="15%">&nbsp;</td>
			<td width="20%"><input name="btnGuardar" type="button" id="btnGuardar" value="GUARDAR" onClick="guardarFichaVehiculo()" disabled="yes"></td>
			<td width="20%"><input name="btnCerrarFicha" type="button" id="btnCerrarFicha" value="CERRAR" onClick="top.cerrarVentanaFicha();" disabled="yes"></td>
		</tr>
		</table>
	</div>
</div>
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
					<input id="Btn_Agregar" type="button" name="Btn_Agregar" value=" >> " onclick="asignarFalla()"> 
					<input id="Btn_Quitar" type="button" name="Btn_Quitar" value=" << " onclick="desasignarFalla()">
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
   	  	<input type="button" value="ACEPTAR" id="btnSubir" name="btnSubir" onClick="validacionFallas()"/>
			</td>
   		<td width="15%"><input name="btnPosponer" type="button" id="btnPosponer" value="POSPONER" onClick="posponerIngreso()" ></td>
      <td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btnCerrarFichaFuncionario" value="CERRAR" onClick="top.cerrarVentana();" ></td>
		</tr>
	</table>
</div>
</body>
</html>
<?
	if ($codigoVehiculo != ""){
		if($contieneHijos==10 ){
			echo "<script>";
			if($permisoRegistrar) echo "fallaPospuestaDatos('".$codigoVehiculo."');";
			echo "leeDatosVehiculo('".$codigoVehiculo."','','0');";
			echo "document.getElementById('btnBuscarVehiculo').disabled = 'true';";
			echo "listaUnidades('".$unidadPadre."','".$unidadUsuario."','selectUnidad');\n";
			echo "</script>";
		}else{
			echo "<script>";
			if($permisoRegistrar) echo "fallaPospuestaDatos('".$codigoVehiculo."');";
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