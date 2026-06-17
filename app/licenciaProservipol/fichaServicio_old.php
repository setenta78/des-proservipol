<html>
<head>
<title>Nuevo Servicio ... </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaServicio.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/servicios.js"></script>
<script type="text/javascript" src="./js/listaMultiple.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>  
<script type="text/javascript" src="./js/tipoServicio.js"></script>
<script type="text/javascript" src="./js/tipoArma.js"></script>
<script type="text/javascript" src="./js/tipoAnimal.js"></script>
<script type="text/javascript" src="./js/tipoAccesorio.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>


</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0">
<div style="width:100%;">
	<div id="divDatosServicio" style="position:absolute; visibility: visible; width:96%;">
		  <div id="marcoLevantado">   
		  	<div id="cuadro" style="padding: 20px 0px 0px 0px"> 
			    <table cellpadding="1" cellspacing="0" width="100%">
				<tr> 
				   <td width="24%" align="right">(*) SERVICIO&nbsp;:&nbsp;</td>
				   <td width="36%">
				      <select id="selServicio" onChange="seleccionServicio()"></select>
					</td>
					<td width="40%">&nbsp;</td>
				</tr>
				<tr> 
				    <td align="right"><label id="labDescripcion" disabled>(*) SERV. EXTRAORDINARIO&nbsp;:&nbsp;</label></td>
				    <td colspan="2">
				    	<select id="selTipoExtraordinario" disabled onchange="seleccionTipoExtraordinario()">
						  <option value="0">Seleccione Tipo Servicio Extraordinario ... </option>
					      <option value="10">Estadio</option>
						  <option value="20">Marcha</option>
						  <option value="30">Recital</option>
						  <option value="40">Evento Comunal</option>
						  <option value="100">Otro</option>
					    </select>
			         </td>
				 </tr>
				 <tr> 
				    <td align="right">&nbsp;</td>
				    <td colspan="2"><input type="text" id="textOtroExtraordinario" maxlength="50" disabled></td>
				 </tr>
				 </table>
			</div>
			
			<div id="cuadro"> 
			    <table cellpadding="1" cellspacing="0" width="100%">
				<tr> 
				   <td width="24%" align="right">(*) FECHA&nbsp;:&nbsp;</td>
				   <td width="34%"><input type="text" id="textFechaServicio" readonly></td>
				   <td width="2%"><input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicio, textFechaServicio,'dd-mm-yyyy','300','-1')"></td>
				   <td width="11%" align="right">(*) INICIO&nbsp;:&nbsp;</td>
				   <td width="9%"><select id="selHoraInicio"></select></td>
				   <td width="11%" align="right">(*) TERMINO&nbsp;:&nbsp;</td>
				   <td width="9%" align="right"><select id="selHoraTermino"></select></td>
				</tr>
				</table>
			</div>
			
			<div id="cuadro" style="padding: 10px 0px 0px 0px"> 
				<table width="100%" cellpadding="1" cellspacing="1">
				<tr> 
			   			<td>
							<table style="width:100%" class="tableTituloTabla">
							<tr> 
							     <td>&nbsp;DESCRIPCIÓN DEL SERVICIO&nbsp;:&nbsp;</td>
							</tr>
							</table>
							
							<table style="width:100%" cellpadding="0" cellspacing="0">
							<tr> 
							    <td>
								<textarea id="textObservaciones" class="Texto_100" rows="13"><?echo $textObservaciones?></textarea>
								</td>
							</tr>
							</table>
						</td>
				</tr>
				</table>
			</div>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr style="padding: 5px 0px 0px 0px">
				<td style="font-size:8px;"align="right">(*) DATOS OBLIGATORIOS</td>
			</tr>
			</table>
		</div>
	</div>
  
  
	<div id="divAsignaFuncionarios" style="position:absolute; visibility: hidden; width:100%;">
		<div id="marcoLevantado">
		  <div id="cuadro">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr> 
			    <td width="45%"  align="right" class="textoNormal">MOSTRAR INDIVIDUALMENTE/POR CARGO&nbsp;:&nbsp;</td>
				<td width="55%" height="20"></td>
			</tr>	
			<tr> 
			 	<td align="right">
					<select id="selTipoDeOrden" disabled="yes>
					  <option value="0">Seleccione opción ... </option>
					  <option value="10" selected="yes">Personal Individual</option>
					  <option value="20">Personal por Cargo</option>
					</select>
			</td>
			<td></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro">
        	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            	<tr> 
              		<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloPersonalDisponible">PERSONAL DISPONIBLE</div></td>
              		<td width="1%" rowspan="4"></td>
              		<td width="8%">&nbsp; </td>
              		<td width="1%" rowspan="4"></td>
              		<td width="45%" id="tituloSelecMultiple"><div id="tituloPersonalAsignado">PERSONAL ASIGNADO</div></td>
            	</tr>
            	<tr> 
              		<td width="45%" rowspan="3"> 
              			<select id="funcionariosDisponibles" size="20" multiple>
              			<option value="0">CARGANDO PERSONAL ... </option></select> 
                	</td>
              		<td width="8%">
              			<input id="btn100" type="button" name="Btn_Agregar" value=" >>" onclick="asignarPersonal()"> 
                		<input id="btn100" type="button" name="Btn_Quitar" value=" << " onclick="desasignarPersonal()">
                	</td>
              		<td width="45%"> 
              			<select id="personalAsignado" size="20" multiple>
                		</select> 
                	</td>
            	</tr>
        	</table>
          </div>
      </div>
  </div>
  
  <div id="divAsignaVehiculos" style="position:absolute; visibility: hidden; width:100%;">
		<div id="marcoLevantado">
		  <div id="cuadro">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr> 
			    <td width="45%"  align="right" class="textoNormal">MOSTRAR INDIVIDUALMENTE/POR TIPO&nbsp;:&nbsp;</td>
				<td width="55%" height="20"></td>
			</tr>	
			<tr> 
			 	<td align="right">
					<select id="selTipoDeOrden" disabled="yes">
					  <option value="0">Seleccione opción ... </option>
					  <option value="10" selected="yes">Vehiculos Individual</option>
					  <option value="20">Vehiculos por Tipo</option>
					</select>
			</td>
			<td></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro">
        	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            	<tr> 
              		<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoDisponible">VEHICULOS DISPONIBLES</div></td>
              		<td width="1%" rowspan="4"></td>
              		<td width="8%">&nbsp; </td>
              		<td width="1%" rowspan="4"></td>
              		<td width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoAsignado">VEHICULOS ASIGNADOS</div></td>
            	</tr>
            	<tr> 
              		<td width="45%" rowspan="3"> 
              			<select id="vehiculosDisponibles" size="20" multiple>
              			<option value="0">CARGANDO VEHICULOS ... </option></select> 
                	</td>
              		<td width="8%">
              			<input id="btn100" type="button" name="Btn_AgregarVehiculo" value=" >>" onclick="asignarVehiculo()"> 
                		<input id="btn100" type="button" name="Btn_QuitarVehiculo" value=" << " onclick="desasignarVehiculo()">
                	</td>
              		<td width="45%"> 
              			<select id="vehiculosAsignados" size="20" multiple>
                		</select> 
                	</td>
            	</tr>
        	</table>
          </div>
      </div>
  </div>
  
  
  <div id="divAsignaKmsVehiculos" style="position:absolute; visibility: hidden; width:100%;">
	<div id="marcoLevantado" style="height: 345px">
		  <div id="cuadro">
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
			<tr> 
			    <td height="20" colspan="4"></td>
			</tr>	
			<tr>
			<td width="31%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="34%">&nbsp;</td>
			<td width="20%"><input id="btn100" type="button" name="btnEliminarVehiculos" value="ELIMINAR"></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro" style="height: 273px">
       		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
            	<tr> 
              		<td height="30" width="50%" id="tituloSelecMultiple">VEHICULO</td>
              		<td width="15%" id="tituloSelecMultiple">KM. INICIAL</td>
              		<td width="15%" id="tituloSelecMultiple">KM. FINAL</td>
              		<td width="15%" id="tituloSelecMultiple">COMBUSTIBLE</td>
              		<td width="5%" id="tituloSelecMultiple">&nbsp;</td>
            	</tr>
        	</table>
        	<div id="listadoVehiculosAsignados"></div>
          </div>
     </div>
  </div>   

 <div id="divAsignaKmsVehiculos_2" style="position:absolute; visibility: hidden; width:100%;">
	<div id="marcoLevantado" style="height: 345px">
		  <div id="cuadro">
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
			<tr>
			<td width="10%" align="right">VEHICULO&nbsp;:&nbsp;</td>
			<td colspan="5"><select id="selVehiculo"></select></td>
			<td colspan="2"></td>
			</tr>
			<tr>
			<td width="10%" align="right">KM. INICIAL&nbsp;:&nbsp;</td>
			<td width="10%"><input type="text" id="textCantidadVehiculos"></td>
			<td width="10%" align="right">KM. FINAL&nbsp;:&nbsp;</td>
			<td width="10%"><input type="text" id="textCantidadVehiculos"></td>
			<td width="16%" align="right">COMBUSTIBLE&nbsp;(LTS)&nbsp;:&nbsp;</td>
			<td width="10%"><input type="text" id="textCantidadVehiculos"></td>
			<td width="17%" style="padding: 0px 0px 0px 4px"><input id="btn100" type="button" name="btnAgregarVehiculo" value="AGREGAR" style="height:19px"></td>
			<td width="17%"><input id="btn100" type="button" name="btnEliminarVehiculo" value="ELIMINAR" style="height:19px"></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro" style="height: 273px">
       		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
            	<tr> 
              		<td height="30" width="50%" id="tituloSelecMultiple">VEHICULO</td>
              		<td width="15%" id="tituloSelecMultiple">KM. INICIAL</td>
              		<td width="15%" id="tituloSelecMultiple">KM. FINAL</td>
              		<td width="15%" id="tituloSelecMultiple">COMBUSTIBLE</td>
              		<td width="5%" id="tituloSelecMultiple">&nbsp;</td>
            	</tr>
        	</table>
        	<div id="listadoVehiculosAsignados"></div>
          </div>
     </div>
  </div>   

 <div id="divAsignaArmas" style="position:absolute; visibility: hidden; width:100%;">
	<div id="marcoLevantado" style="height: 345px">
		  <div id="cuadro">
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
			<tr> 
			    <td height="20" colspan="4"></td>
			</tr>	
			<tr>
			<td width="31%">INDIQUE CANTIDAD DE ARMAS UTILIZADAS&nbsp;:&nbsp;</td>
			<td width="10%"><input type="text" id="textCantidadArmas" maxlength="2"></td>
			<td width="4%"><input id="btn100" type="button" name="btnCantidadArmas" value=">>" onClick="cantidadArmas()"></td>
			<td width="34%"></td>
			<td width="20%"><input id="btn100" type="button" name="btnEliminarMarcados" value="ELIMINAR"></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro" style="height: 273px">
       		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
            	<tr> 
              		<td height="30" width="30%" id="tituloSelecMultiple">TIPO DE ARMA</td>
              		<td width="20%" id="tituloSelecMultiple">IDENTIFICACIÓN</td>
              		<td width="45%" id="tituloSelecMultiple">FUNCIONARIO RESPONSABLE</td>
              		<td width="5%" id="tituloSelecMultiple">&nbsp;</td>
            	</tr>
        	</table>
        	<div id="listadoArmas"></div>
          </div>
     </div>
  </div>  
  
  
  <div id="divAsignaAnimales" style="position:absolute; visibility: hidden; width:100%;">
	<div id="marcoLevantado" style="height: 345px">
		  <div id="cuadro">
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
			<tr> 
			    <td height="20" colspan="4"></td>
			</tr>	
			<tr>
			<td width="33%">INDIQUE CANTIDAD DE ANIMALES UTILIZADOS&nbsp;:&nbsp;</td>
			<td width="10%"><input type="text" id="textCantidadAnimales" maxlength="2"></td>
			<td width="4%"><input id="btn100" type="button" name="btnCantidadAnimales" value=">>" onClick="cantidadAnimalesAsignados()"></td>
			<td width="32%"></td>
			<td width="20%"><input id="btn100" type="button" name="btnEliminarAnimales" value="ELIMINAR"></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro" style="height: 273px">
       		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
            	<tr> 
              		<td height="30" width="30%" id="tituloSelecMultiple">TIPO DE ANIMAL</td>
              		<td width="20%" id="tituloSelecMultiple">CANTIDAD</td>
              		<td width="45%" id="tituloSelecMultiple">&nbsp;</td>
              		<td width="5%" id="tituloSelecMultiple">&nbsp;</td>
            	</tr>
        	</table>
        	<div id="listadoAnimalesAsignados"></div>
          </div>
     </div>
  </div>  
  
  
  <div id="divAsignaAccesorios" style="visibility: hidden;">
	<div id="marcoLevantado" style="height: 345px">
		  <div id="cuadro">
			<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">
			<tr> 
			    <td height="20" colspan="4"></td>
			</tr>	
			<tr>
			<td width="35%">INDIQUE CANTIDAD DE ACCESORIOS UTILIZADOS&nbsp;:&nbsp;</td>
			<td width="10%"><input type="text" id="textCantidadAccesorios" maxlength="2"></td>
			<td width="4%"><input id="btn100" type="button" name="btnCantidadAccesorios" value=">>" onClick="cantidadAccesoriosAsignados()"></td>
			<td width="30%"></td>
			<td width="20%"><input id="btn100" type="button" name="btnEliminarAccesorios" value="ELIMINAR"></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro" style="height: 273px">
       		<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
            	<tr> 
              		<td height="30" width="30%" id="tituloSelecMultiple">TIPO DE ACCESORIO</td>
              		<td width="20%" id="tituloSelecMultiple">CANTIDAD</td>
              		<td width="43%" id="tituloSelecMultiple">&nbsp;</td>
              		<td width="7%" id="tituloSelecMultiple">&nbsp;</td>
            	</tr>
        	</table>
        	<div id="listadoAccesoriosAsignados"></div>
          </div>
     </div>
  </div>
  
  
  
  
  <table width="100%">
  <tr> 
    <td width="25%"><input id="btn100" type="button" name="btnCerrar" value="CANCELAR" onclick="top.closeAllModalWindows();"></td>
  	<td width="15%"></td>
  	<td width="20%"><input id="btn100" type="button" name="btnAnterior" value="<<< ANTERIOR" onclick="irPaginaAnterior()" disabled></td>
  	<td width="20%"><input id="btn100" type="button" name="btnSiguiente" value="SIGUIENTE >>>" onclick="irPaginaSiguiente()"></td>
  	<td width="20%"><input id="btn100" type="button" name="btnFinalizar" value="FINALIZAR" onClick="javascript:top.abrirVentana('VISTRA PREVIA - NUEVO SERVICIO ... ', '700', '500','www.alphaville.de', '')" disabled></td>
  </tr>
  </table>
</div>
</body>
</html>
<?
	$unidad 		= $_GET['unidad'];
	$codigoServicio = $_GET['codigoServicio'];
	$fecha			= $_GET['fecha'];

	echo "<script>\n";
	echo "selectFuncionariosDisponibles('610040000000','funcionariosDisponibles');\n";
	echo "listaHoras('selHoraInicio');\n";
	echo "listaHoras('selHoraTermino');\n";
	echo "leeTipoServicios('selServicio');\n";
	echo "selectVehiculosDisponibles('610040000000', 'vehiculosDisponibles');\n";
	if ($codigoServicio != "") echo "buscaDatosServicio('".$unidad."','".$codigoServicio."','".$fecha."');\n";
	echo "</script>\n";
?>