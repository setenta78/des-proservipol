<?include("session.php")?> 
<?include("tiempo.php")?>  
<?
	$unidadUsuario			= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
    $unidadEspecialidad		= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];
	$correlativo 			= $_GET['correlativo'];
	$tipoUnidad			    = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion añadida el 16-04-2015
	$contieneHijos          = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de sesion añadida el 16-04-2015
	
	if ($correlativo == "") $unidad = $unidadUsuario;
	else $unidad = $_GET['unidad'];
	
	
	////-- OBTIENE FECHA LIMITE DE ACTUALIZACION
    //
	//$fechaHoyLimite = date("Y-m-d");
	//$numeroDiaHoy = date("N", strtotime($fechaHoyLimite));
	//
	////if ($numeroDiaHoy == 1) $cantDias = 4;
	////else $cantDias = 2;
	//
	//switch ($numeroDiaHoy) {
	//    case 1:
	//        $cantDias = 5;
	//        break;
	//    case 2:
	//        $cantDias = 4;
	//        break;
	//   default:
	//        $cantDias = 3;
	//}
	//
	//$fechaLimite = date("d-m-Y", strtotime("$fechaHoyLimite -$cantDias day"));  
	//
	//$numeroDia2 = date('N', strtotime($fechaLimite));
	//
	////------------------------------------------
	
	
	
?>
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
<script type="text/javascript" src="./js/tipoServicioExtraordinario.js"></script>
<script type="text/javascript" src="./js/tipoArma.js"></script>
<script type="text/javascript" src="./js/tipoAnimal.js"></script>
<script type="text/javascript" src="./js/tipoAccesorio.js"></script>
<script type="text/javascript" src="./js/fichaServicio.js"></script>
<script type="text/javascript" src="./js/numero.js"></script>
<script type="text/javascript" src="./js/armas.js"></script>
<script type="text/javascript" src="./js/cuadrante.js"></script>
<script type="text/javascript" src="./js/factorDemanda.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>


<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>



</head>
<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" scroll="no">
<!--<input type="hidden" id="tienePlanCuadrante" value="">-->
<input type="hidden" id="tienePlanCuadrante" value="1">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>"><!--Variable oculta añadida el 16-04-2015-->
<input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!--Variable oculta añadida el 16-04-2015-->
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>"><!--Variable oculta añadida el 16-04-2015-->
<input id="correlativo"  type="hidden" readonly="yes" value="<?echo $correlativo?>"><!--Variable oculta añadida el 16-04-2015-->


<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>


<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>

<div style="width:99%;">
  <div id="divDatosServicio" style="position:absolute; visibility: visible; width:96%;">
  			<input type="hidden" id="hojaDeRuta">
  			<input type="hidden" id="correlativoServicio">
  			<input type="hidden" id="unidadServicio" value="<?echo $unidad?>">
		  <div id="marcoLevantado">   
		  	<div id="cuadro" style="padding: 20px 0px 0px 0px"> 
			    <table cellpadding="1" cellspacing="0" width="100%">
			    <tr> 
				   <td width="24%" align="right">(*) TIPO SERVICIO&nbsp;:&nbsp;</td>
				   <td width="36%">
				      <select id="selTipoServicio" onChange="seleccionTipoServicio('<?echo $unidadEspecialidad?>')">
				      <option value="0">SELECCIONE UNA OPCION ...</option>
				      <option value="1">OPERATIVOS ORDINARIOS</option>
				      <option value="2">OPERATIVOS EXTRAORDINARIOS</option>
				      <option value="3">ADMINISTRATIVOS Y DE APOYO</option>
				      <option value="4">SIN SERVICIO POR OTRAS CAUSALES</option>
             <option value="5">SIN SERVICIO POR LICENCIA</option>
				      <option value="6">INTRACUARTEL</option>
				      <option value="7">SERVICIOS Y TRAMITES FUERA DEL CUARTEL</option>
				      <option value="8">COLACION/DESCANSO</option>
				      </select>
					</td>
					<td width="40%">&nbsp;</td>
				</tr>
				<tr> 
				   <td align="right">(*) SERVICIO&nbsp;:&nbsp;</td>
				   <td  colspan="2">
				      <select id="selServicio" onChange="seleccionServicio()"></select>
					</td>
				</tr>
				<!--
				<tr> 
				    <td align="right"><label id="labDescripcion" disabled>(*) SERV. EXTRAORDINARIO&nbsp;:&nbsp;</label></td>
				    <td colspan="2">
				    	<select id="selTipoExtraordinario" disabled onchange="seleccionTipoExtraordinario()">
					    </select>
			         </td>
				 </tr>
				 -->
				 <tr> 
				    <td align="right">&nbsp;</td>
				    <td colspan="2"><input type="text" id="textOtroExtraordinario" maxlength="90" disabled style="background-Color:#D4D4D4;"></td>
				 </tr>
                 <tr> 
				    <td align="right">&nbsp;</td>
				    <td colspan="2"><select id="selLicencia" onChange="Seleccionlicencia()" disabled style="background-Color:#D4D4D4;"></select></td>
				 </tr>
				 </table>
			</div>
			
			<div id="cuadro"> 
			    <table cellpadding="1" cellspacing="0" width="100%">
				<tr> 
				   <td width="24%" align="right">(*) FECHA&nbsp;:&nbsp;</td>
				   <td width="34%"><input type="text" id="textFechaServicio" readonly="yes"></td>
				   <td width="2%"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicio, textFechaServicio,'dd-mm-yyyy','300','-1');"></td>
				   <td width="11%" align="right" id="labHoraInicio">(*) INICIO&nbsp;:&nbsp;</td>
				   <td width="9%"><select id="selHoraInicio"></select></td>
				   <td width="11%" align="right" id="labHoraTermino">(*) TERMINO&nbsp;:&nbsp;</td>
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
							    
								<textarea onkeydown="limitarTextArea(this,2000)" id="textObservaciones" class="Texto_100" rows="19"><?echo $textObservaciones?></textarea>
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
		  <!--
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr> 
			    <td width="45%"  align="right" class="textoNormal">MOSTRAR INDIVIDUALMENTE/POR CARGO&nbsp;:&nbsp;</td>
				<td width="55%" height="20">&nbsp;</td>
			</tr>	
			<tr> 
			 	<td align="right">
					<select id="selTipoDeOrden" disabled="yes>
					  <option value="0">Seleccione opción ... </option>
					  <option value="10" selected="yes">Personal Individual</option>
					  <option value="20">Personal por Cargo</option>
					</select>
			</td>
			<td><input type="checkbox" id="cbFuncionariosSinServicio" name="cbFuncionariosSinServicio" value="1" onclick="filtrarFuncionariosDisponibles('<?echo $unidadUsuario?>')"></td>
			</tr>
			</table>
			-->
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr> 
			    <td colspan="2" width="45%"  align="right" class="textoNormal">&nbsp;</td>
				<td width="55%" height="20">&nbsp;</td>
			</tr>	
			<tr>
				<td width="2%"><input type="checkbox" id="cbFuncionariosSinServicio" name="cbFuncionariosSinServicio" value="1" onclick="filtrarFuncionariosDisponibles('<?echo $unidadUsuario?>')"></td> 
			 	<td width="43%" align="left" class="textoNormal">MOSTRAR SOLO PERSONAL SIN SERVICIO ASIGNADO&nbsp;</td>
			 	<td>&nbsp;</td>
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
              			<select id="funcionariosDisponibles" size="26" multiple>
              			<option value="0">CARGANDO PERSONAL ... </option></select> 
                	</td>
              		<td width="8%">
              			<input id="btn100" type="button" name="Btn_Agregar" value=" >>" onclick="asignarPersonal()"> 
                		<input id="btn100" type="button" name="Btn_Quitar" value=" << " onclick="desasignarPersonal()">
                	</td>
              		<td width="45%"> 
              			<select id="personalAsignado" size="26" multiple>
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
              			<select id="vehiculosDisponibles" size="26" multiple>
              			<option value="0">CARGANDO VEHICULOS ... </option></select> 
                	</td>
              		<td width="8%">
              			<input id="btn100" type="button" name="Btn_AgregarVehiculo" value=" >>" onclick="asignarVehiculo()"> 
                		<input id="btn100" type="button" name="Btn_QuitarVehiculo" value=" << " onclick="desasignarVehiculo()">
                	</td>
              		<td width="45%"> 
              			<select id="vehiculosAsignados" size="26" multiple>
                		</select> 
                	</td>
            	</tr>
        	</table>
          </div>
      </div>
  </div>
  
  
  <div id="divAsignaMedios" style="position:absolute; visibility: hidden; width:100%;">
  		<input id="idMV" type="hidden">
		<div id="marcoLevantado">
		  <div id="cuadro">
        	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            	<tr> 
              		<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoDisponible">PERSONAL DE SERVICIO</div></td>
              		<td width="1%" rowspan="6"></td>
              		<td width="8%">&nbsp; </td>
              		<td width="1%" rowspan="6"></td>
              		<td width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoAsignado">MEDIO DE VIGILANCIA</div></td>
            	</tr>
            	<tr> 
              		<td width="45%" rowspan="6"> 
              			<select id="personalServicio" size="11" multiple>
                	</td>
              		<td width="8%" rowspan="5">
              			<input id="btn100" type="button" name="Btn_AgregarAsignaMedio" value=" >>" onClick="moverDatos('personalServicio','personalServicioMedio')"> 
                		<input id="btn100" type="button" name="Btn_QuitarAsignaMedio" value=" << " onClick="moverDatos('personalServicioMedio','personalServicio')"> 
                	</td>
              		<td width="45%"> 
              			<select id="personalServicioMedio" size="3" multiple>
                		</select> 
                	</td>
            	</tr>
            	<tr> 
             		<td width="45%"> 
              			<select id="vehiculosServicio" onChange="seleccionaVehiculoMedioVigilancia()">
                		</select> 
                	</td>
            	</tr>
            	<tr> 
             		<td width="45%"> 
              			<fieldset id="cuadro2" style="width:100%">
              				<legend>(*) Kilometraje</legend>
              				<table cellpadding="0" cellspacing="0" width="100%">
							<tr style="padding: 6px 0px 0px 0px">
								<td width="60%" align="right"><label id="labKmInicial">KM. INICIAL&nbsp;:&nbsp;</label></td>
								<td width="40%"><input id="textKmInicial" type="text"></td>
							</tr>
							<tr style="padding: 0px 0px 1px 0px">
								<td align="right"><label id="labKmFinal">KM. FINAL&nbsp;:&nbsp;</label></td>
								<td><input id="textKmFinal" type="text"></td>
							</tr>
							</table>
              			</fieldset>
              			

                	</td>
            	</tr>
            </table>
            </div>
            <div id="cuadro">
            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            	<tr> 
              		<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoDisponible">OPCIONES DE DESTINO</div></td>
              		<td width="1%" rowspan="6"></td>
              		<td width="8%">&nbsp; </td>
              		<td width="1%" rowspan="6"></td>
              		<td width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoAsignado">DESTINOS SELECCIONADOS</div></td>
            	</tr>
            	<tr> 
         	   		<td>
						<select id="cuadrantesMV" size="7" multiple ondblclick="listaUnidadesEspecializadas('<?echo $unidadUsuario?>',document.getElementById('cuadrantesMV').value,'cuadrantesMV')">
                   	</td>
                   	
                   	<td width="8%">
              			<input id="btn100" type="button" name="Btn_AgregarDestinoMedio" value=" >>" onClick="asignarDestino()"> 
                		<input id="btn100" type="button" name="Btn_QuitarDestinoMedio" value=" << " onClick="desasignarDestino()"> 
                	</td>
              		<td width="45%"> 
              			<select id="destinosSeleccionados" size="7" multiple>
                		</select> 
                	</td>
                   	
                   	
                   	
            	</tr>
        </table>
        </div>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
        	<td width="55%">
        	</td>
             		<td width="45%">
             			<table cellpadding="0" cellspacing="0" width="100%">
							<tr style="padding: 2px 0px 0px 0px">
								<td width="49%" align="right"><input id="btn100" type="button" name="btnEliminaMV" value="ELIMINAR" onClick="borraMedioVigilancia()" disabled="yes"> </td>
								<td width="1%" align="right"></td>
								<td width="48%"><input id="btn100" type="button" name="Btn_AgregarVehiculo" value="ACEPTAR" onClick="agregaMedioVigilancia(1)"> </td>
							</tr>
							</table>
                	</td>
                	
            	</tr>
        </table>
        	
        	
          
          	<fieldset id="cuadro2" style="padding: 10px 0px 0px 0px">
				<legend>Medios de Vigilancia Ingresados ... </legend>
				<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" style="padding: 9px 0px 0px 0px;">
					<div style="height: 40px">
	       				<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
	            			<tr height="30"> 
			              		<td width="40%" id="nombreColumna">VEHICULO</td>
			              		<td width="15%" id="nombreColumna">FUNCIONARIOS</td>
			              		<td width="15%" id="nombreColumna">KM. INICIAL</td>
			              		<td width="15%" id="nombreColumna">KM. FINAL</td>
			              		<td width="15%" id="nombreColumna">DESTINOS</td>
								
			            	</tr>
	        			</table>
	        			<div id="listadoMediosVigilancia"></div>
          			</div>
					</td>
				</tr>
				</table>
			</fieldset>
     	</div>
  </div>
  
  <div id="divAsignaAccesorios" style="visibility: hidden; width:100%;">
  	<input id="idLA" type="hidden">
	<div id="marcoLevantado" style="padding: 12px 0px 10px 0px;">
		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
           	<td height="30" width="45%" id="tituloSelecMultiple">ARMAS</td>
           	<td width="1%" rowspan="6">&nbsp;</td>
           	<td width="8%">&nbsp;</td>
           	<td width="1%" rowspan="4">&nbsp;</td>
           	<td width="45%" id="tituloSelecMultiple"><div id="tituloPersonalAsignado">PERSONAL CON ACCESORIO ASIGNADO</div></td>
        </tr>
    	<tr> 
            <td width="45%" valign="top">
            	<select id="armasDisponibles" size="14" multiple="yes">
              	</select> 
       		</td>
            <td width="8%" rowspan="3">
            	<input id="btn100" type="button" name="Btn_Agregar" value=" >>" onclick="asignarAccesorios()"> 
            	<input id="btn100" type="button" name="Btn_Quitar" value=" << " onclick="desAsignarAccedorio()">
            </td>
            <td width="45%" valign="top" rowspan="3">
            	<div id="cuadro" style="padding: 0px 0px 5px 0px;">
	            	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	        		<tr>
	        			<td style="padding: 0px 0px 0px 1px;">
	        				<select id="personalServicio2">
	            			</select>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td>
	        				<select id="personalServicioAccesorio" size="12">
	        				</select>
	        			</td>
	        		</tr>
					</table>

				</div>
					<table cellpadding="0" cellspacing="0" width="100%">
					<tr style="padding: 5px 0px 0px 0px">
						<td width="49%" align="right"><input id="btn100" type="button" name="btnEliminarAccesorios" value="ELIMINAR" onClick="eliminarFuncionarioAccesorios()" disabled="yes"> </td>
						<td width="1%" align="right"></td>
						<td width="48%"><input id="btn100" type="button" name="Btn_AgregarVehiculo" value="ACEPTAR" onClick="agregaFuncionarioAccesorios()"> </td>
					</tr>
					</table>
            </td>
     	</tr>
		<tr> 
            <td id="tituloSelecMultiple">ANIMALES</td>
        </tr>
            	<tr> 
              		<td>
              			<select id="animalesDisponibles" size="5" multiple="yes">
              				<option value="0">CARGANDO ANIMALES ... </option>
              			</select> 
              		</td>
            	</tr>
            	<tr> 
              		<td id="tituloSelecMultiple">ACCESORIOS</td>
              		<td rowspan="2" colspan="3">
              			<div id="cuadro" style="padding: 0px 0px 0px 0px;"></div>
              			<fieldset id="cuadro2">
							<legend>Accesorios Ingresados ... </legend>
							<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td align="right" style="padding: 3px 0px 0px 0px;">
								<div style="height: 10px">
				       				<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
				            			<tr height="30px"> 
						              		<td width="51%" id="nombreColumna">FUNCIONARIO</td>
						              		<td width="15%" id="nombreColumna">ARM.</td>
						              		<td width="15%" id="nombreColumna">ANI.</td>
						              		<td width="15%" id="nombreColumna">ACC.</td>
						              		<td width="4%" id="nombreColumna">&nbsp;</td>
						            	</tr>
				        			</table>
				        			<div id="listadoPersonalAccesorios"></div>
			          			</div>
								</td>
							</tr>
							</table>
						</fieldset>
              		
              		</td>
            	</tr>
            	<tr> 
              		<td>
              			<select id="accesoriosDisponibles" size="12" multiple="yes">
              				<option value="0">CARGANDO ACCESORIOS ... </option>
              			</select> 
              		</td>
            	</tr>
        	</table>
          </div>
         
      </div>
  <div style="padding:3px 0px 0px 0px;"></div>    
  <table width="100%">
  <tr> 
    <td width="20%"><input id="btn100" type="button" name="btnCerrar" value="CANCELAR" onclick="top.cerrarVentana();"></td>
    <td width="3%"><input id="btn100" type="button" name="btnAyuda" value="?" disabled="yes"></td>
  	<td width="17%"></td>
  	<td width="15%"><input id="btn100" type="button" name="btnEliminar" value="ELIMINAR" onclick="eliminarServicio();" disabled="yes"></td>
  	<td width="15%"><input id="btn100" type="button" name="btnAnterior" value="<<< ANTERIOR" onclick="irPaginaAnteriorCuadrante()" disabled="yes"></td>
  	<td width="15%"><input id="btn100" type="button" name="btnSiguiente" value="SIGUIENTE >>>" onclick="irPaginaSiguienteCuadrante()"></td>
  	<td width="15%"><input id="btn100" type="button" name="btnFinalizar" value="FINALIZAR" onClick="guardarServicio()" disabled="yes"></td>
  </tr>
  </table>
</div>
</body>
</html>
<?
	//$unidad 		= $_GET['unidad'];
	//$correlativo 	= $_GET['correlativo'];
	//$fecha		= $_GET['fecha'];

	echo "<script>\n";
	//echo "leeTipoServicios('selServicio',false,'".$unidadEspecialidad."');\n";
	//echo "leeTipoServiciosExtraordinarios('selTipoExtraordinario','".$unidadEspecialidad."');\n"; 
	echo "listaHoras('selHoraInicio');\n";      
	echo "listaHoras('selHoraTermino');\n";
	//echo "leeFactoresDemanda('factorMV', false);\n";
	echo "seleccionaVehiculoMedioVigilancia();\n"; 
	//echo "leeCuadrantesConHijos('".$unidad."',false,'cuadrantesMV', true);\n";
	
	if ($correlativo != ""){
		echo "leeDatosServicio('".$unidad."','".$correlativo."');\n";
	}
	
	//echo "alert('" . $tienePlanCuadrante."')\n";
	//if ($tienePlanCuadrante == 0) {
		//echo "document.getElementById('cuadrantesMV').disabled 				= 'true';\n";
		//echo "document.getElementById('factorMV').disabled 	 				= 'true';\n";
		//echo "document.getElementById('cuadrantesMV').style.backgroundColor = '#D4D4D4';\n";
		//echo "document.getElementById('factorMV').style.backgroundColor 	= '#D4D4D4';\n";
		//echo "document.getElementById('legFactor').disabled 	 			= 'true';\n";
		//echo "document.getElementById('legCuadrante').disabled 	 			= 'true';\n";
	//}
	
	echo "</script>\n";
?>
<?  //Muestra listado inicial de unidades.
	echo "<script>\n";
	echo "listaUnidadesEspecializadas('".$unidadPadre."','".$unidadUsuario."','cuadrantesMV');\n";
	echo "</script>\n";
?>