<div class="fichaOculta" id="fichaServicioUnidad">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/FichaModal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
	<div id="fichaContenedor" class="ficha-contenedor">
		<div class="ficha-header"><div class="ficha-titulo">Nuevo Servicio</div></div>
		<a class="ficha-cerrar" id="btnCerrarFicha">X</a>
        <div id="BuscarUsuario">
            Codigo Funcionario: </br><input type="text" id="txtCodFuncionario" name="txtCodFuncionario" size="20" value="" autocomplete="off" style="text-transform:uppercase"></br></br>
            <input type="button" id="btnBuscar" style="width: 200px; height: 20px" value ="BUSCAR" >
        </div>
        <div id="DatosUsuario" style="display:none;">

<? if($codigoFuncionario=="") echo '<input type="hidden" id="textFechaTermino" name="textFechaTermino" value="">'; ?>
<br>
<div id="tablaModal" style="display: flex;">
<div style="width:60%; margin-left:10px;">
	<div id="cuadro">
    <input id="tipoUsuario" type="hidden" value="">
    <input id="unidadUsuario" type="hidden" value="">
    <input id="unidadUsuarioCaptura" type="hidden" value="">
	<table cellpadding="0" cellspacing="5" width="100%">
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">RUT&nbsp;:&nbsp;</td>
			<td><input id="textRutFuncionario" type="text" readonly="yes"></td>
		</tr>
        <tr>
            <td width="30%" align="right">CODIGO (SIN GUION)&nbsp;:&nbsp;</td>
			<td><input id="textCodigoFuncionario" type="text" maxlength="7" readonly="yes"></td>
        </tr>
		<tr style="padding: 0px 0px 2px 0px">
			<td align="right">GRADO&nbsp;:&nbsp;</td>
			<td><input id="textGrado" type="text" readonly="yes"></td>
		</tr>
		<tr>
			<td align="right">APELLIDOS&nbsp;:&nbsp;</td>
			<td><input id="textApellido" type="text" readonly="yes"></td>
		</tr>
		<tr>
			<td align="right">NOMBRE&nbsp;:&nbsp;</td>
			<td><input id="textNombre" type="text" readonly="yes"></td>
		</tr>
		<tr>
			<td align="right">CONTRASE&Ntilde;A&nbsp;:&nbsp;</td>
			<td><input id="textContrasena" type="password" style="position: relative;width:70%;top: -8px;" ><img src="images/eyeClose.png" id="imgContrasena" value="0" width="30px" height="30px" style="position: relative; top: 2px; left: 5px; cursor:pointer;" ></td>
		</tr>
	</table>
    <br>
	</div>
    <br>
	<table cellpadding="0" cellspacing="0" width="100%">
        <tr id="filaTipoUsuario">
            <td width="30%" align="right"  style="padding: 0px 0px 4px 0px"><label id="labCategoriaCargo">(*) TIPO USUARIO&nbsp;:&nbsp;</lab></td>
            <td style="padding: 0px 0px 4px 0px">
                <select id="selTipoUsuario" align="center" style="width: 82%;">
                    <option value="0" align="center">---   SELECCIONE TIPO USUARIO   ---</option>
                    <option value="10" align="center">---   TITULAR   ---</option>
                    <option value="20" align="center">---   SUPLENTE   ---</option>
                    <option value="80" align="center">---   VALIDADOR   ---</option>
                    <option value="100" align="center">---   FISCALIZADOR   ---</option>
                    <option value="90" align="center">---   MESA AYUDA   ---</option>
                </select>
            </td>
        </tr>
		<tr>
			<td width="30%" align="right"><label id="labUnidad" disabled="yes">(*) UNIDAD&nbsp;:&nbsp;</lab></td>
			<td>
                <input id="codBuscarUnidad" type="hidden">
                <input id="codBuscarUnidadAll" type="hidden">
                <input id="textBuscarUnidad" type="text" readonly="yes" autocomplete="off">
			</td>
        </tr>
    </table>
    <br><br>
    <table cellpadding="10" cellspacing="0" width="100%">
        <tr>
        <td style="width: 48%;"><input name="btnGuardar" type="button" id="btnGuardar" value="GUARDAR"></td>
        <td style="width: 4%;">&nbsp;</td>
        <td><input name="btnEliminar" type="button" id="btnEliminar" value="ELIMINAR"></td>
        </tr>
	</table>

</div>
<div style="width:2.5%; margin-left:10px; margin-top: 3%;">
    <input type="button" id="btnAsignarUnidad" value="<<" style="height:80%" >
</div>
<div style="width:42%; margin-left:10px; ">
    <label>Buscar Unidad:</label>
    <input type="text" id="buscarUnidadNombre" autocomplete="off"><br><br>
    <select id="selUnidades" size="12" multiple="no" style="width: 100%;">
</div>

</div>

<script type="text/javascript" src="./js/gestionUsuario.js?v=<?echo version?>"></script>
<script src=".\axios\dist\axios.js"></script>
