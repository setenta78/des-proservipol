<?
$unidadUsuario	   	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$tienePlanCuadrante	= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad			= $_SESSION['USUARIO_TIPOUNIDAD'];
$ip					= $_SESSION['DIRECCION_IP'];
$codPerfil	 	 	= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
$fecha              = date("Y-m-d");
?>
<div class="fichaOculta" id="fichaLicenciaMedica">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/FichaLicenciaMedicaModal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
	<div id="fichaContenedor" class="ficha-contenedor">
		<div class="ficha-header"><div class="ficha-titulo">Licencias Medicas</div></div>
		<a class="ficha-cerrar" onclick="cerrarFicha()">X</a>
        <div id="BuscarLicencia">
            RUT: </br><input type="text" id="txtRutI" name="txtRutI" size="20" value="" autocomplete="off" onkeypress="return solo_rut(event)"></br></br>
            <select id="ListaTipo" name="ListaTipo" >
                <option value="0">LICENCIA MEDICA</option>
                <option value="MP">RESOLUCI&Oacute;N MEDICINA PREVENTIVA</option>
            </select></br></br>
            <div id="BuscarLicenciaFolio">
            FOLIO: </br><input type="text" id="txtFolioI" name="txtFolioI" size="20" value="" autocomplete="off" onkeypress="return solo_rut(event)"></br></br>
            IMED: <input type="checkbox" id="checkImed" name="checkImed"></br></br>
            </div>
            <input type="button" id="Buscar" style="width: 200px; height: 20px" value ="BUSCAR" >
        </div>
        <div id="DatosLicencia" style="display:none;">

<input id="idFuncionario" type="hidden" readonly="yes">
<input id="unidadUsuario" type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="cargoBaseDatos" type="hidden" readonly="yes">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="codUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="desUnidadAgregadoBaseDatos" type="hidden" readonly="yes">
<input id="codCuadranteBaseDatos" type="hidden" readonly="yes">
<input id="fecha" type="hidden" readonly="yes" value="<?echo $fecha?>">
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="origenBaseDatos">
<input type="hidden" id="IpFuncionario" name="IpFuncionario" value="<? echo $ip; ?>">
<input type="hidden" id="unidadFuncionario" name="unidadFuncionario" value="">
<input type="hidden" id="rutUsuario" name="rutUsuario" value="">
<input type="hidden" id="reparticionCodigo" name="reparticionCodigo" value="">
<input type="hidden" id="reparticionDescripcion" name="reparticionDescripcion" value="">
<input type="hidden" id="fechaTerminoInicial" name="fechaTerminoInicial" value="">
<input type="hidden" id="servicio" name="servicio" value="">
<input type="hidden" id="fechaTerminoReal" name="fechaTerminoReal" value="">
<input type="hidden" id="UltimoEstado" name="UltimoEstado" value="">
<input id="perfil" type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">

<input type="hidden" id="codigoFuncionario" name="codigoFuncionario" value="">

<? if($codigoFuncionario=="") echo '<input type="hidden" id="textFechaTermino" name="textFechaTermino" value="">'; ?>
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<br>

<div class="seccion1" align="right">
    <div id="seccionA0a">
        <div class="seccion1uno" style="grid-column: 1" >
            <select id="Listcolor" name="Listcolor">
                <option value="">SELECCIONE UNA OPCION ...</option>
                <option value="AA">LICENCIA INSTITUCIONAL</option>
                <option value="B">LICENCIA DIPRECA</option>
                <option value="N">LICENCIA ARMADA</option>
                <option value="E">LICENCIA EJERCITO</option>
                <option value="F">LICENCIA FACH</option>
                <option value="1">LICENCIA FONASA</option>
                <option value="2">LICENCIA ISAPRE</option>
                <option value="3">LICENCIA HOSPITAL PUBLICO O MEDICO EXTERNO</option>
            </select>
        </div>
    </div>
    <div id="seccionA0b" class="seccion1dos" style="grid-column: 3;" >
        <b>FOLIO:</b>
        <input type="hidden" id="txtcolor" name="txtcolor" style="text-transform:uppercase;" value="<? echo $codigoColor; ?>" disabled="disabled" >
        <input type="text" id="txtfolio" name="txtfolio" size="14" maxlength="10" value="" disabled="disabled" >
    </div>
</div>

<br>
    <u><b>SECCION A: USO Y RESPONSABILIDAD EXCLUSIVA DEL PROFESIONAL</b></u>
    <br><br>
    <fieldset>
    <legend><b>A.1 IDENTIFICACI&Oacute;N DEL TRABAJADOR</b></legend>
    <br>
    <div class="seccion2">
        <div class="seccion2r1c1" style="grid-column: 1; grid-row: 1;" align="center" >
            <input type="text" id="txtape1" name="txtape1" size="15" value="" readonly="yes">
            <br>PRIMER APELLIDO
        </div>
        <div class="seccion2r1c2" style="grid-column: 2; grid-row: 1;" align="center" >
            <input type="text" id="txtape2" name="txtape2" size="15" value="" readonly="yes">
            <br>SEGUNDO APELLIDO
        </div>
        <div class="seccion2r1c3" style="grid-column: 3; grid-row: 1;" align="center" >
            <input type="text" id="txtnom" name="txtnom" size="20" value="" readonly="yes">
            <br>NOMBRES
        </div>
        <div class="seccion2r1c4" style="grid-column: 4; grid-row: 1;" align="center" >
            <input type="text" id="txtrut" name="txtrut" value="" size="15" maxlength="10" disabled="disabled" >
            <br>RUN
        </div>
        <div class="seccion2r2c1" style="grid-column: 1; grid-row: 2;" align="center" >
            <input type="text" id="txtfechaO" name="txtfechaO" size="10" value="" readonly="yes">&nbsp;&nbsp;<input id="calendarioFechaO" name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfechaO,'dd-mm-yyyy',this,-100,-100);" >
            <br>FECHA OTORGAMIENTO
        </div>
        <div class="seccion2r2c2" style="grid-column: 2; grid-row: 2;" align="center" >
            <input type="text" id="txtfechaI" name="txtfechaI" size="10" onchange="activarInicioReal();activarFueraPlazo();" value="" readonly="yes">&nbsp;&nbsp;<input id="calendarioFechaI" name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfechaI,'dd-mm-yyyy',this,-100,-195);"  >
            <br>FECHA INICIO REPOSO
        </div>
        <div id="seccion2r2c3" class="seccion2r2c3" style="grid-column: 3; grid-row: 2; display: none;" align="center" >
            <input type="text" id="textFechaTermino" name="textFechaTermino" size="10" value="" readonly="yes">
            <br>FECHA TERMINO REPOSO
        </div>
        <div class="seccion2r3c1" style="grid-column: 1; grid-row: 3;" align="center" >
            <input type="number" id="txtdias" name="txtdias" min="1" max="150" onchange="activarInicioReal();" >
            <br>NRO DE DIAS
        </div>
        <div class="seccion2r3c2" style="grid-column: 2; grid-row: 3;" align="center" >
            <div id="seccion1a" style="display: none;" ><input type="text" id="fechaInicioReal" name="fechaInicioReal" size="10" value="" readonly="yes"></div>
            <br>FECHA REAL INICIO <input type="checkbox" id="optionInicio" name="optionInicio" onclick="inicioReal();" disabled>
        </div>
        <div id="seccion2r3c3" class="seccion2r3c3" style="grid-column: 3; grid-row: 3; display: none;" align="center" >
            <input type="text" id="txtfecF" name="txtfecF" size="10" value="" readonly="yes">&nbsp;&nbsp;<input id="calendarioFechaF" name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13"  onClick="displayCalendar(txtfecF,\'dd-mm-yyyy\',this,-100,-195);" >
            <br>FECHA TERMINO ANTICIPADO (*)
        </div>
        <div id="seccion2r3c4" class="seccion2r3c4" style="grid-column: 4; grid-row: 3;" align="center" >
            PRESENTADA FUERA DE PLAZO <input type="checkbox" id="optionFueraPlazo" name="optionFueraPlazo" disabled>
        </div>
    </div>
    </fieldset>
    <br>
    <div id="seccionA2">
    <fieldset>
        <legend><b>A.2 TIPO LICENCIA</b></legend>
        <br>
        <div class="seccion3">
            <div class="seccion3r1c1" style="grid-column: 1; grid-row: 1;" >
                <select id="cboLicencia" >
                    <option value="0">SELECCIONE UNA OPCION ...</option>
                    <option value="633">ENFERMEDAD O ACCIDENTE COMUN</option>
                    <option value="632">PRORROGA MEDICINA PREVENTIVA</option>
                    <option value="170">LICENCIA MATERNAL PRE Y POST NATAL</option>
                    <option value="162">ENFERMEDAD GRAVE HIJO MENOR DE UN A&Ntilde;O</option>
                    <option value="718">ACCIDENTE EN ACTO DE SERVICIO</option>
                    <option value="630">ENFERMEDAD PROFESIONAL</option>
                    <option value="631">PATOLOGIA DEL EMBARAZO</option>
                    <option value="849">LICENCIA MEDICA PREVENTIVA PARENTAL</option>
                    <option value="925">LICENCIA SANNA</option>
                </select>
            </div>
            <div class="seccion3r1c2" style="grid-column: 2; grid-row: 1;" align="center" >
                <br><b> RECUPERABILIDAD LABORAL:</b>
                <br>SI<input type="radio" id="optionRecup" name="optionRecup" value=1 checked="checked">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO<input type="radio" id="optionRecup" name="optionRecup" value=2 >
            </div>
            <div class="seccion3r2c1" style="grid-column: 3; grid-row: 1;" align="center" >
                <br><b>INICIO TRAMITE INVALIDEZ:</b>
                <br>SI<input type="radio" id="optionInvalidez" name="optionInvalidez" value="1" >
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO<input type="radio" id="optionInvalidez" name="optionInvalidez" value="2" checked="checked" >
            </div>
        </div>
    </fieldset>
    </div>
    <div id="seccionA2b" style="display:none;" >
    <br>
    <fieldset>
        <legend><b> IDENTIFICACI&Oacute;N DEL HIJO</b></legend>
        <br>
        <div class="seccion3a">
            <div class="seccion3ar1c1" style="grid-column: 1; grid-row: 1;" align="center" >
                <input type="text" id="txtruth" name="txtruth" size="15" maxlength="9" onKeypress="return solo_rut(event)" onblur="formato_rut(this)" <? if($codigoFuncionario!="") echo 'readonly="yes"'; ?> >
                <br>RUN
            </div>
            <div class="seccion3ar1c2" style="grid-column: 2; grid-row: 1;" align="center" >
                <input type="text" id="txtfec3" name="txtfec3" size="10" value="" <? if($codigoFuncionario!="") echo 'readonly="yes"'; ?> >
                <input id="calendarioFecha3" name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(txtfec3,'dd-mm-yyyy',this,-100,-195);">
                <br>FECHA DE NACIMIENTO
            </div>
        </div>
    </fieldset>
    </div>
    <br>
    <div id="seccionA3">
    <fieldset>
    <legend><b>A.3 CARACTERISTICAS DEL REPOSO</b></legend>
    <br>
    <div class="seccion4">
        <div class="seccion4r1c1" style="grid-column: 1; grid-row: 1;" >
            <select id="cboReposo" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?>>
                <option value="0">SELECCIONE UNA OPCION ...</option>
                <option value="1">REPOSO LABORAL TOTAL</option>
                <option value="2">REPOSO LABORAL PARCIAL</option>
            </select>
        </div>
        <div class="seccion4r1c2" style="grid-column: 2; grid-row: 1;" align="center" >
            <br><b>LUGAR DE REPOSO:</b>
            DOMICILIO<input type="radio" id="optionReposo" name="optionReposo" value="1" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            HOSPITAL<input type="radio" id="optionReposo" name="optionReposo" value="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            OTRO<input type="radio" id="optionReposo" name="optionReposo" value="3" >
        </div>
    </div>
    </fieldset>
    </div>
    <br>
    <div id="seccionA4">
        <fieldset>
        <legend><b>A.4 IDENTIFICACI&Oacute;N DEL PROFESIONAL</b></legend>
        <br>
        <div class="seccion5">
            <div id="seccion5r1c1" class="seccion5r1c1" style="grid-column: 1; grid-row: 1;" align="left" >
                <input type="text" id="txtrutp" name="txtrutp" size="15" maxlength="9" onKeypress="return solo_rut(event)" onblur="formato_rut(this)" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> >
                <br><b>RUN PROFESIONAL</b>
            </div>
            <div id="seccion5r1c2" class="seccion5r1c2" style="grid-column: 2; grid-row: 1;" align="center" >
                <br>TIPO PROFESIONAL:</b>
                MEDICO<input type="radio" id="optionMed" name="optionMed" value="1" onclick="especialidad()" checked="checked" >
                DENTISTA<input type="radio" id="optionDent" name="optionMed" value="2" onclick="especialidad()" >
                MATRONA<input type="radio"  id="optionMat" name="optionMed" value="3" onclick="especialidad()" >
            </div>
            <div id="seccion5r2c2" class="seccion5r2c2" style="grid-column: 3; grid-row: 1;" align="center" >
                <br><b>ATENCI&Oacute;N:</b>
                INSTITUCIONAL<input type="radio" id="optionAte" name="optionAte" value="1" checked="checked" >
                EXTRA INSTITUCIONAL<input type="radio" id="optionAte2" name="optionAte" value="2">
            </div>
            <div id="seccion5r3c1" class="seccion5r3c1" style="grid-column: 1; grid-row: 3;" align="left" >
                <br><b>ESPECIALIDAD PROFESIONAL</b>
                <br><select id="cboEspecialidad" <? if($codigoFuncionario!="") echo 'disabled="disabled"'; ?> ></select>
            </div>
        </div>
        </fieldset>
    </div>
    <br>
    <div class="seccion6">
        <div id="seccionA5">
            <div class="seccion6r1c1" style="grid-column: 1; grid-row: 1;" align="left" >
                <form name="formSubeArchivo" action="adjuntarArchivoSubirLicencia.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo">
                    <input type="file" size="20" name="archivo" id="archivo"/><br><br>
                    <input type="button" value="SUBIR" id="btnSubir" name="btnSubir" onClick="subirArchivo(this)"/>
                    <input type="hidden" id="archivoServidor" value="">
                    <input type="hidden" id="archivoLoad" value=0>
                    <input type="hidden" id="rutArchi" name="rutArchi" value="">
                </form>
            </div>
        </div>
        <?
            if(!$permisoRegistrar) $activo = 'disabled'; else $activo = 'enabled';
        ?>
            <div class="seccion6r1c3" style="grid-column: 3; grid-row: 1;" >
            <br><input name="btnGuardarLicencia" type="button" id="btnGuardarLicencia" value="GUARDAR" <? echo $activo; ?> onClick="guardarFichaLicencia()">
            </div>

            <div class="seccion6r1c3" style="grid-column: 3; grid-row: 1; display:none;" >
            <br><input name="btnGuardarLicencia" type="button" id="btnGuardarLicencia" value="RECORTAR"  <? echo $activo; ?> onClick="recortarLicencia()">
            </div>
            <div class="seccion6r1c4" style="grid-column:4; grid-row: 1; display:none;" >
            <br><input name="btnAnular" type="button" id="btnAnular" value="ANULAR"  <? echo $activo; ?> onClick="validaAnularLicencia()">
            </div>
        </div>
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


<script type="text/javascript" src=".\js\licenciaMedicaImed.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/licenciaMedicaN.js?v=<?echo version?>" charset="utf-8"></script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<script src=".\axios\dist\axios.js"></script>
<script>
rutUsuario();
cargaEspecialidades();
//buscaDatosFichaLicencia();
//camposObligatorios();
</script>