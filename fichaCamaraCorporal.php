<div class="fichaOculta" id="fichaCamarasCorporales">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/FichaCamarasCorporalesModal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
<div id="fichaContenedor" class="ficha-contenedor">
<div class="ficha-header"><div class="ficha-titulo">C&aacute;maras Corporales</div></div>
<a class="ficha-cerrar" onclick="cerrarFicha()">X</a>
<input id="perfil" type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">
<? if($codigoFuncionario=="") echo '<input type="hidden" id="textFechaTermino" name="textFechaTermino" value="">'; ?>
<div id="divListaCamaras" style="display:none;" ></div>
<div id="cubreVentana" style="display:none;"></div>
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
    <td width="20%" align="left"><input type="button" id="btnAceptaUnidadAgregado" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregadoCamara('selectUnidad','codUnidadAgregado','textUnidadAgregado')"></td>        
    <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
	</tr>
	</table>
</div>
<div id="ventanaIngresoFecha" style="position:absolute; z-index:200; display:none; height:100px;" >
<div class="ficha-header"><div class="ficha-titulo" id="tituloMovimentoVentanaFecha"></div></div>
<a class="ficha-cerrar" onclick="desactivaVentanaIngresoFecha()">X</a>
    <div id="usuarioCuadro" style="position: relative; width: 80%; top: 35px; left: 80px;" >
		<input id="textTipo" type="hidden">
		<div id="textTipoMovimentoVentanaFecha" ></div>
		<input id="textFechaVentanaFecha" type="text" readonly="yes" style="width:75%;" >
        <input id="imagenCalendarioVentanaFecha" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaVentanaFecha,'dd-mm-yyyy',this,-100,-195)">
	</div>
	<input type="button" id="btnAceptaFechaVentanaFecha" name="btnAceptaFechaVentanaFecha" value="ACEPTAR" onClick="aceptaFechaVentanaIngresoFecha()" style="position:relative; top:45px; left:35%; width:35%;" >
</div>
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<br>
<div>
    <div class="contenidoDatos">
        <input id="codCamara" type="hidden" value="" >
        <div style="grid-column: 1; grid-row: 1;" align="right"><label>CODIGO EQUIPO:&nbsp;</label></div><div style="grid-column: 2; grid-row: 1;" align="left"><input id="textCodEquipo" type="text" ><img id="iconoBusqueda" src="img/busqueda.png" style="position:absolute; top:58px; cursor:pointer; width: 28px;" ></br></div>
    </div>
    <fieldset>
    <div class="contenidoDatos">
        <div style="grid-column: 1; grid-row: 1;" align="right"><label>NUMERO DE SERIE:&nbsp;</label></div><div style="grid-column: 2; grid-row: 1;" align="left"><input id="textNroSerie" type="text" readonly="yes" style="width:80%"></div>
        <div style="grid-column: 1; grid-row: 2;" align="right"><label>MARCA:&nbsp;</label></div><div style="grid-column: 2; grid-row: 2;" align="left"><select id="selMarca" style="width:90%" disabled></select></div>
        <div style="grid-column: 1; grid-row: 3;" align="right"><label>MODELO:&nbsp;</label></div><div style="grid-column: 2; grid-row: 3;" align="left"><select id="selModelo" style="width:90%" disabled><option value="0">SELECCIONE UNA OPCION ... </option></select></div>
        <div style="grid-column: 1; grid-row: 4;" align="right"><label>ORIGEN:&nbsp;</label></div><div style="grid-column: 2; grid-row: 4;" align="left"><select id="selOrigen" style="width:90%" disabled></select></div>
        <div style="grid-column: 1; grid-row: 5;" align="right"><label>CODIGO SAP:&nbsp;</label></div><div style="grid-column: 2; grid-row: 5;" align="left"><input id="textCodigoSap" type="text" readonly="yes" style="width:80%"></div>
    </div>
    </fieldset>
    <br>
    <div>
        <fieldset>
        <div class="contenidoDatos">
            <div style="grid-column: 1; grid-row: 1;" align="right"><label>ESTADO:&nbsp;</label></div><div style="grid-column: 2; grid-row: 1;" align="left"><select id="selEstado" style="width:90%" <? if($subMenu=='agregados') echo 'disabled'; ?> ></select></div>
            <div style="grid-column: 1; grid-row: 2;" align="right"><label>FECHA NUEVO ESTADO:&nbsp;</label></div><div style="grid-column: 2; grid-row: 2;" align="left"><input id="textFechaNuevoEstado" type="text" readonly="yes" style="width:25%; margin-right: 10px;"><input id="imagenCalendarioFichaCamara" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onclick="displayCalendar(textFechaNuevoEstado,'dd-mm-yyyy',this,-100,-195)" style="visibility: hidden;"></div>
            <div style="grid-column: 1; grid-row: 3;" align="right"><label>UNIDAD AGREGADO:&nbsp;</label></div><div style="grid-column: 2; grid-row: 3;" align="left"><input id="textUnidadAgregado" type="text" readonly="yes" style="width:90%" disabled="yes">&nbsp;<input type="button" id="btnUnidades" value="..." onclick="activaBuscaUnidadAgregado()" style="width:5%;" disabled="yes"></div>
            <input id="estadoBaseDatos" type="hidden" value="" >
            <input id="codUnidad" type="hidden" value="" >
            <input id="descUnidad" type="hidden" value="" >
            <input id="fechaEstadoActual" type="hidden" value="" >
            <input id="codUnidadAgregado" type="hidden" value="" >
        </div>
        </fieldset>
        <div id="mensajeFecha"></div>
    </div>
    <br>
    <div class="contenidoButton">
        <div style="grid-column: 1; grid-row: 1;"><input name="btnDejarDisponible" type="button" id="btnDejarDisponible" value="TRASLADO" onClick="activaVentanaIngresoFecha('1',true)" disabled="yes"></div>
        <div style="grid-column: 2; grid-row: 1;"><input name="btnBaja" type="button" id="btnBaja" value="BAJA" onClick="activaVentanaIngresoFecha('2',true)" disabled="yes"></div>
        <div style="grid-column: 4; grid-row: 1;"><input name="btnGuardar" type="button" id="btnGuardar" value="GUARDAR" onClick="guardarFichaCamaraCorporal()" disabled="yes"></div>
    </div>
    <div id="seccionMensaje">
    <b><p id='Mensaje'></p></b>
    </div> 
            </div>
            <div id="mensajeCargando" style="display:none;">
            <table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/fichaCamarasCorporales.js?v=<?echo version?>" charset="utf-8"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<script src=".\axios\dist\axios.js"></script>