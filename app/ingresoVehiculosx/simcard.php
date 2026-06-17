<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="./css/Cambio_Fecha.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/autocompletar.js"> </script>
<script type="text/javascript" src="./js/creaObjeto.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<script type="text/javascript" src="./js/procedenciaVehiculo.js"></script>
<script type="text/javascript" src="./js/marcaVehiculo.js"></script>
<script type="text/javascript" src="./js/modeloVehiculo.js"></script>
<script type="text/javascript" src="./js/tipoVehiculo.js"></script>
<script type="text/javascript" src="./js/simcard.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>

<title>Cambios en Fechas de ingreso</title>
</head>
<body onload="javascript:listaUnidades('20','20','selectUnidad');">
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
<br><b> Bienvenid@</b><br><br><b> La fecha de hoy es: </b><? echo date('d-m-Y'); ?><br><br></div>
<div id="form" class="texto2">
INGRESO DE SIMCAR<br>
	<div id="cuadro">
		<table cellpadding="0" cellspacing="0" width="83%">
			<tr>
				<td width="29%" align="right">(*) SIMCAR SERIE:&nbsp;</td>
				<td width="32%"><input id="simcardSerie" type="text" maxlength="7" onblur="leeDatosSimcard();"></td>
				<td width="39%"></td>
			</tr>
			<tr>
			  <td align="right">(*) SIMCAR TARJETA:</td>
			  <td><input id="simcardTarjeta" type="text" maxlength="6" /></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) SIM IMEI:&nbsp;</td>
			  <td><input id="simcardImei" type="text" maxlength="6" /></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) MARCA:</td>
			  <td><select name="simcadMarca">
                      <option selected="selected">Seleccione</option> 
                      <option value="GENVIC">GENVIC</option>
                      <option value="BLUEBIRD">BLUEBIRD</option>
                      <option value="SIMCARD">NO TIENE</option>
                    </select>
              </td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) MODELO:</td>
			  <td><select name="simcardModelo">
                      <option selected="selected">Seleccione</option> 
                      <option value="W8700B">W8700B</option>
                      <option value="EF500">EF500</option>
                      <option value="SIMCARD">NO TIENE</option>
              </select></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) AÑO DE FABRICACIÓN:</td>
			  <td><input id="simcardAnno" maxlength="4" type="text" /></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) ORIGEN SIMCAR:</td>
			  <td><input id="simcardOrigen" maxlength="4" type="text" /></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) ESTADO:&nbsp;</td>
			  <td><input id="textAnnoFabricacion" maxlength="4" type="text" /></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) FECHA ESTADO:</td>
			  <td><input id="simcardEstado" type="text" readonly="yes" >&nbsp;&nbsp;
					<input id="imagenCalendarioVehiculo" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaEstado, textFechaEstado,'dd-mm-yyyy','25%','40%')" ></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">(*) UNIDAD:</td>
			  <td><select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('<?echo $unidadUsuario?>',this.id);" onClick="habiltarAceptarUnidad(this.id)"></select>
              </td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">&nbsp;</td>
			  <td><span style="font-size:8px;">(*) DATOS OBLIGATORIOS</span></td>
			  <td></td>
		  </tr>
			<tr>
			  <td align="right">&nbsp;</td>
			  <td><span style="font-size:8px;">
			    <input type="button" name="btn" value="Guardar" onclick="guardarSimcard();"/>
			  </span></td>
			  <td></td>
		  </tr>
		</table>
	</div>
</div>
</div>
</body>