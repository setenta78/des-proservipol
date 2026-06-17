<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="./css/Cambio_Fecha.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="./js/autocompletar.js"> </script>
	<script type="text/javascript" src="./js/creaObjeto.js"></script>

	<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
	<script type="text/javascript" src="./ventana/js/window.js"> </script>

	<script type="text/javascript" src="./ventana/js/effects.js"> </script>
	<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
	<script type="text/javascript" src="./ventana/js/debug.js"> </script>

	<script type="text/javascript" src="./js/procedenciaVehiculo.js"></script>
	<script type="text/javascript" src="./js/marcaVehiculo.js"></script>
	<script type="text/javascript" src="./js/modeloVehiculo.js"></script>
	<script type="text/javascript" src="./js/tipoVehiculo.js"></script>
	<script type="text/javascript" src="./js/vehiculos.js"></script>
	<script type="text/javascript" src="./js/unidades.js"></script>
	<script type="text/javascript" src="./calendario/popcalendar.js"></script>

	<link href="./ventana/css/default.css" rel="stylesheet" type="text/css">
	</link>
	<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css">
	</link>
	<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css">
	</link>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>INGRESO DE VEHICULOS</title>
</head>

<body onload="javascript:leeProcedenciaVehiculos('selProcedencia');leeTipoVehiculos('selTipoVehiculo');leeMarcaVehiculos('selMarca');leeModeloVehiculos('','selModelo');listaUnidades('20','20','selectUnidad');">
	<div id="pagina">
		<div id="logo" class="texto">
			<table class="texto" border="0">
				<tr>
					<td><img src="img/logo_depto.jpg" alt="Logo Departamento" align="middle"></td>
					<td align="center">CARABINEROS DE CHILE<br>INSPECTORIA GENERAL<br>DEPTO. CONTROL DE GESTION</td>
				</tr>
			</table>
		</div>
		<div class="texto2">
			<br><b> Bienvenid@</b><br><br><b> La fecha de hoy es: </b>
			<? echo date('d-m-Y'); ?><br><br></div>
		<div id="form" class="texto2">
			INGRESO DE VEHICULOS<br>

			<div id="cuadro">
            
            
                <table width="50%" border="0" align="center">
                  <tr>
                    <td colspan="2" align="center"><strong>INGRESO DE VEHICULOS</strong></td>
                  </tr>
                  <tr>
                    <td width="35%" align="right">(*) CODIGO SAP:&nbsp;</td>
                    <td width="65%"><input id="textNumeroBCU" type="text" maxlength="7" onblur="leeDatosVehiculo();" /></td>
                  </tr>
                  <tr>
                    <td align="right">(*) PATENTE&nbsp;:&nbsp;</td>
                    <td><input id="textPatente" type="text" maxlength="6" /></td>
                  </tr>
                  <tr>
                    <td align="right">(*) NUMERO INSTITUCIONAL&nbsp;:</td>
                    <td><input id="textNumeroInstitucional" type="text" maxlength="6" /></td>
                  </tr>
                  <tr>
                    <td align="right">(*) PROCEDENCIA&nbsp;</td>
                    <td><select name="selProcedencia" id="selProcedencia">
                    </select></td>
                  </tr>
                  <tr>
                    <td align="right">(*) TIPO VEHICULO&nbsp;:&nbsp;</td>
                    <td><select name="selTipoVehiculo" id="selTipoVehiculo">
                    </select></td>
                  </tr>
                  <tr>
                    <td align="right">(*) MARCA&nbsp;:&nbsp;</td>
                    <td><select name="selMarca" id="selMarca" onchange="leeModeloVehiculos(this[this.selectedIndex].value,'selModelo')">
                    </select></td>
                  </tr>
                  <tr>
                    <td align="right">(*) MODELO&nbsp;:&nbsp;</td>
                    <td><select name="selModelo" id="selModelo">
                    </select></td>
                  </tr>
                  <tr>
                    <td align="right">(*) AÑO DE FABRICACIÓN&nbsp;:&nbsp;</td>
                    <td><input id="textAnnoFabricacion" maxlength="4" type="text"></td>
                  </tr>
                  <tr>
                    <td align="right">(*) FECHA ESTADO :</td>
                    <td><input id="textFechaEstado" type="text" readonly="yes">&nbsp;&nbsp;
					<input id="imagenCalendarioVehiculo" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaEstado, textFechaEstado,'dd-mm-yyyy','25%','40%')"></td>
                  </tr>
                  <tr>
                    <td align="right"><label id="labUnidad">(*) UNIDAD :  </label></td>
                    <td><select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('<?echo $unidadUsuario?>',this.id);" onClick="habiltarAceptarUnidad(this.id)"></select></td>
                  </tr>
                  <tr>
                    <td style="font-size:8px;" align="right">(*) DATOS OBLIGATORIOS</td>
                    <td><input type="button" name="btn" value="Guardar" onclick="guardarVehiculo();" /></td>
                  </tr>
                </table>
            </div>
            <div id="cuadro">
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="12%" align="right">(*) CODIGO SAP:&nbsp;</td>
						<td width="15%"><input id="textNumeroBCU" type="text" maxlength="7" onblur="leeDatosVehiculo();"></td>
						<td width="55%"></td>
					</tr>
				</table>
			</div>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr style="padding: 5px 0px 0px 0px">
					<td width="12%" align="right">&nbsp;</td>
					<td style="font-size:8px;" align="left">(*) DATOS OBLIGATORIOS</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr style="padding: 5px 0px 0px 0px">
					<td width="12%" align="right">&nbsp;</td>
					<td style="font-size:8px;" align="left"><input type="button" name="btn" value="Guardar" onclick="guardarVehiculo();" /></td>
				</tr>
			</table>
            
				<table cellpadding="0" cellspacing="0" width="100%" border="0">
					<tr style="padding: 0px 0px 0px 0px">
						<td width="12%" align="right">(*) PATENTE&nbsp;:&nbsp;</td>
						<td width="60%"><input id="textPatente" type="text" maxlength="6"></td>
						<td width="10%"></td>
					</tr>
					<tr style="padding: 0px 0px 0px 0px">
						<td width="12%" align="right">(*) NUMERO INSTITUCIONAL&nbsp;:&nbsp;</td>
						<td width="60%"><input id="textNumeroInstitucional" type="text" maxlength="6"></td>
						<td width="10%"></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td align="right">(*) PROCEDENCIA&nbsp;:&nbsp;</td>
						<td><select id="selProcedencia"></select></td>
						<td></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td align="right">(*) TIPO VEHICULO&nbsp;:&nbsp;</td>
						<td><select id="selTipoVehiculo"></select></td>
						<td></td>
					</tr>
					<tr style="padding: 0px 0px 2px 0px">
						<td align="right">(*) MARCA&nbsp;:&nbsp;</td>
						<td><select id="selMarca" onChange="leeModeloVehiculos(this[this.selectedIndex].value,'selModelo')"></select></td>
						<td></td>
					</tr>
					<tr>
						<td align="right">(*) MODELO&nbsp;:&nbsp;</td>
						<td><select id="selModelo"></select></td>
						<td></td>
					</tr>
					<tr style="padding: 0px 0px 0px 0px">
						<td width="12%" align="right">(*) AÑO DE FABRICACIÓN&nbsp;:&nbsp;</td>
						<td width="60%"><input id="textAnnoFabricacion" maxlength="4" type="text"></td>
						<td width="10%"></td>
					</tr>
					<tr>
						<td width="12%" align="right"><label id="labFechaEstado">(*) FECHA ESTADO&nbsp;:&nbsp;</lab>
						</td>
						<td width="60%">
							<input id="textFechaEstado" type="text" readonly="yes">&nbsp;&nbsp;
							<input id="imagenCalendarioVehiculo" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaEstado, textFechaEstado,'dd-mm-yyyy','25%','40%')">
						</td>
						<td width="10%"></td>
					</tr>
					<tr style="padding: 0px 0px 0px 0px">
						<td width="15%" align="right"><label id="labUnidad">(*) UNIDAD &nbsp;:&nbsp;</lab>
						</td>
						<td width="60%" colspan="5">
							<select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('<?echo $unidadUsuario?>',this.id);" onClick="habiltarAceptarUnidad(this.id)"></select>
						</td>
						<td width="10%"></td>
					</tr>
				</table>
                <br />
                
	  </div>
	</div>
</body>