<?
include("version.php");
include("session.php");
include("tiempo.php");
$unidadUsuario		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
$unidadPadreUsuario	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tienePlanCuadrante	= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadEspecialidad	= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];
$correlativo		= $_GET['correlativo'];
$tipoUnidad			= $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos		= $_SESSION['USUARIO_CONTIENEHIJOS'];
$codPerfil			= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$unidadGope			= $_SESSION['USUARIO_CODIGOUNIDAD'];
$unidadTipo			= $_SESSION['USUARIO_UNIDADTIPO'];
$tipoUnidadNew			= $_SESSION['USUARIO_TIPO_UNIDAD'];
$especialidadUnidadNew	= $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
if ($correlativo == "") $unidad = $unidadUsuario;
else $unidad = $_GET['unidad'];
?>
<html>
<head>
<title>Nuevo Servicio ... </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaServicio.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/servicios.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/listaMultiple.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoServicio.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoServicioExtraordinario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoArma.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoAnimal.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoAccesorio.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/fichaServicio.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/numero.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/armas.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/cuadrante.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/factorDemanda.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
<link href="./ventana/css/default.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
</head>
<body style="margin-top:10; margin-left:10; background-color:#f5fbf3" scroll="no">
<input type="hidden" id="tienePlanCuadrante" value="1">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="unidadPadreUsuario" type="hidden" readonly="yes" value="<?echo $unidadPadreUsuario?>">
<input id="correlativo"  type="hidden" readonly="yes" value="<?echo $correlativo?>">
<input id="perfil"  type="hidden" readonly="yes" value="<?echo $codPerfilOrigen?>">
<input id="unidadGope"  type="hidden" readonly="yes" value="<?echo $unidadGope?>">
<input id="unidadTipo"	type="hidden" readonly="yes" value="<?echo $unidadTipo?>">
<input id="unidadEspecialidad" type="hidden" readonly="yes" value="<?echo $unidadEspecialidad?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">
<input id="especialidadUnidadNew" type="hidden" readonly="yes" value="<?echo $especialidadUnidadNew?>">
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
			      <option value="1">OPERATIVOS</option>
			      <option value="2">EXTRAORDINARIOS</option>
			      <option value="3">INTRACUARTEL FIJO</option>
			      <option value="4">INTRACUARTEL VARIABLE</option>
			      <option value="5">SERVICIO EN EL SECTOR DE OTRO CUARTEL</option>
			      <option value="6">ACTIVIDAD O SERVICIO FUERA DEL CUARTEL</option>
			      <option value="7">SIN SERVICIO</option>
			      <option value="8">COLACI&Oacute;N/DESCANSO</option>
					</select>
					</td>
					<td width="40%">&nbsp;</td>
				</tr>
				<tr> 
			   	<td align="right">(*) SERVICIO&nbsp;:&nbsp;</td>
			   	<td colspan="2"><select id="selServicio" onChange="seleccionServicio(true)"></select></td>
				</tr>
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
				<td width="2%"><input id="idFechaServicio" name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaServicio,'dd-mm-yyyy',this,-100,-195)"></td>
				<td width="11%" align="right" id="labHoraInicio" >(*) INICIO&nbsp;:&nbsp;</td>
				<td width="9%"><select id="selHoraInicio" onChange="activaHoras();" ></select></td>
				<td width="11%" align="right" id="labHoraTermino">(*) TERMINO&nbsp;:&nbsp;</td>
	   		<td width="9%" align="right"><select id="selHoraTermino" disabled></select></td>
			</tr>
			</table>
			</div>
			<div id="cuadro" style="padding: 10px 0px 0px 0px"> 
			<table width="100%" cellpadding="1" cellspacing="1">
			<tr> 
   			<td>
					<table style="width:100%" class="tableTituloTabla">
					<tr> 
						<td>&nbsp;DESCRIPCI&Oacute;N DEL SERVICIO&nbsp;:&nbsp;</td>
					</tr>
					</table>
					<table style="width:100%" cellpadding="0" cellspacing="0">
					<tr> 
						<td><textarea onkeydown="limitarTextArea(this,2000)" id="textObservaciones" class="Texto_100" rows="19" onkeypress="javascript:sinCaracteres(event)"><?echo $textObservaciones;?></textarea></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr style="padding: 5px 0px 0px 0px"><td style="font-size:8px;"align="right">(*) DATOS OBLIGATORIOS</td></tr>
		</table>
		</div>
  </div>
  <div id="divAsignaFuncionarios" style="position:absolute; visibility: hidden; width:100%;">
		<div id="marcoLevantado">
		  <div id="cuadro">
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr> 
				<td colspan="2" width="45%"  align="right" class="textoNormal">&nbsp;</td>
				<td width="55%" height="20">&nbsp;</td>
			</tr>	
			<tr>
				<div id="divCheckDisponibles"></div>
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
	    			<input id="Btn_Agregar" type="button" name="Btn_Agregar" value=" >>" onclick="asignarPersonal()"> 
	      		<input id="Btn_Quitar" type="button" name="Btn_Quitar" value=" << " onclick="desasignarPersonal()">
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
					  <option value="0">Seleccione opci&oacute;n ... </option>
					  <option value="10" selected="yes">Veh&iacute;culos Individual</option>
					  <option value="20">Veh&iacute;culos por Tipo</option>
					</select>
			</td>
			<td></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro">
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    	<tr> 
	  		<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoDisponible">VEH&Iacute;CULOS DISPONIBLES</div></td>
	  		<td width="1%" rowspan="4"></td>
	  		<td width="8%">&nbsp; </td>
	  		<td width="1%" rowspan="4"></td>
	  		<td width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoAsignado">VEH&Iacute;CULOS ASIGNADOS</div></td>
    	</tr>
    	<tr> 
	  		<td width="45%" rowspan="3"> 
	  			<select id="vehiculosDisponibles" size="26" multiple><option value="0">CARGANDO VEH&Iacute;CULOS ... </option></select>
	    	</td>
	  		<td width="8%">
	  			<input id="Btn_AgregarVehiculo" type="button" name="Btn_AgregarVehiculo" value=" >>" onclick="asignarVehiculo()"> 
	    		<input id="Btn_QuitarVehiculo" type="button" name="Btn_QuitarVehiculo" value=" << " onclick="desasignarVehiculo()">
	    	</td>
	  		<td width="45%"><select id="vehiculosAsignados" size="26" multiple></select></td>
    	</tr>
			</table>
    	</div>
    </div>
  </div>
	<div id="divAsignaAnimales" style="position:absolute; visibility: hidden; width:100%;">
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
					  <option value="0">Seleccione opci&oacute;n ... </option>
					  <option value="10" selected="yes">Animales Individual</option>
					  <option value="20">Animales por Tipo</option>
					</select>
			</td>
			<td></td>
			</tr>
			</table>
		  </div>
		  <div id="cuadro">
      	<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        	<tr> 
        		<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloCaballoDisponible">CABALLOS DISPONIBLES</div></td>
        		<td width="1%" rowspan="4"></td>
        		<td width="8%">&nbsp; </td>
        		<td width="1%" rowspan="4"></td>
        		<td width="45%" id="tituloSelecMultiple"><div id="tituloAnimalAsignado">ANIMALES ASIGNADOS</div></td>
        	</tr>
        	<tr> 
        		<td width="45%" rowspan="3"><select id="caballosDisponibles" size="12" multiple><option value="0">CARGANDO CABALLOS ... </option></select> 
        			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        				<tr><td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloPerroDisponible">PERROS DISPONIBLES</div></td></tr>
        				<tr><td width="100%" rowspan="3">	<select id="perrosDisponibles" size="12" multiple><option value="0">CARGANDO PERROS POLICIALES ... </option></select> </td></tr>
        			</table>
          	</td>
        		<td width="8%">
        			<input id="Btn_AgregarAnimal" type="button" name="Btn_AgregarAnimal" value=" >>" onclick="asignarAnimal()"> 
          		<input id="Btn_QuitarAnimal" type="button" name="Btn_QuitarAnimal" value=" << " onclick="desasignarAnimal()">
          	</td>
        		<td width="45%"> 
        			<select id="animalesAsignados" size="26" ></select> 
          	</td>
        	</tr>
      	</table>
      </div>
    </div>
  </div>
<!-- Inicio -->
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
        	<td width="45%" rowspan="6"><select id="personalServicio" size="13" multiple></select></td>
        	<td width="8%" rowspan="5">
        		<input id="Btn_AgregarAsignaMedio" type="button" name="Btn_AgregarAsignaMedio" value=" >>" onClick="moverDatos('personalServicio','personalServicioMedio')"> 
          	<input id="Btn_QuitarAsignaMedio" type="button" name="Btn_QuitarAsignaMedio" value=" << " onClick="moverDatos('personalServicioMedio','personalServicio')"> 
          </td>
        	<td width="45%"><select id="personalServicioMedio" size="3" multiple></select></td>
      	</tr>
      	<tr> 
       		<td width="45%"> <select id="vehiculosServicio" onChange="seleccionaVehiculoMedioVigilancia()"></select></td>
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
      	<tr> 
   	   		<td>
   	   			<fieldset id="cuadro4" style="width:98.7%;">
	   	   			<legend id="legAnimal">(*) Animales</legend>
	        		<table cellpadding="0" cellspacing="0" width="100%" border="0">
								<tr>
									<td align="right" style="padding: 0px 0px 0px 0px"><select id="animalServicio" onChange="seleccionaAnimalMedioVigilancia()"></select></td>
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
   	   		<td><select id="cuadrantesMV" size="5" multiple ondblclick="listaUnidadesEspecializadas('<?echo $unidadUsuario?>',document.getElementById('cuadrantesMV').value,'cuadrantesMV')"></td>
          <td width="8%">
        		<input id="Btn_AgregarDestinoMedio" type="button" name="Btn_AgregarDestinoMedio" value=" >>" onClick="asignarDestino()"> 
          	<input id="Btn_QuitarDestinoMedio" type="button" name="Btn_QuitarDestinoMedio" value=" << " onClick="desasignarDestino()"> 
          </td>
        	<td><select id="destinosSeleccionados" size="5" multiple></select></td>
      	</tr>
      </table>
      </div>
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
		  <td width="55%"></td>
          <td width="45%">
          	<table cellpadding="0" cellspacing="0" width="100%">
				<tr style="padding: 2px 0px 0px 0px">
					<td width="49%" align="right"><input id="btnEliminaMV" type="button" name="btnEliminaMV" value="ELIMINAR" onClick="borraMedioVigilancia()" disabled="yes"> </td>
					<td width="1%" align="right"></td>
					<td width="48%"><input id="Btn_AgregarVehiculo" type="button" name="Btn_AgregarVehiculo" value="ACEPTAR" onClick="agregaMedioVigilancia(1)"> </td>
				</tr>
			</table>
          </td>
        </tr>
		</table>   	
		<fieldset id="cuadro2" style="padding: 10px 0px 0px 0px">
			<legend>Medios de Vigilancia Ingresados ... </legend>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
			<td align="right" style="padding: 0px 10px 10px 5px;">
			<div style="min-height: 40px">
   				<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
					<tr height="15">
					<td width="40%" id="nombreColumna">VEH&Iacute;CULO</td>
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
  <!-- inicio -->
<div id="divAsignaMedios2" style="position:absolute; visibility: hidden; width:98%;">
	<input id="idMV2" type="hidden">
	<input id="unidadServicioDestino" type="hidden" value=0>
	<input id="unidadServicioDestinoDesc" type="hidden" value="">
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
					<td width="45%" rowspan="6"><select id="personalServicioDestino" size="13" multiple></select></td>
					<td width="8%" rowspan="5">
						<input id="Btn_AgregarAsignaMedio" type="button" name="Btn_AgregarAsignaMedio" value=" >>" onClick="moverDatos('personalServicioDestino','personalServicioMedioDestino')"> 
						<input id="Btn_QuitarAsignaMedio" type="button" name="Btn_QuitarAsignaMedio" value=" << " onClick="moverDatos('personalServicioMedioDestino','personalServicioDestino')"> 
					</td>
					<td width="45%"><select id="personalServicioMedioDestino" size="3" multiple></select></td>
				</tr>
				<tr> 
					<td width="45%"> <select id="vehiculosServicioDestino" onChange="seleccionaVehiculoMedioVigilancia2()"></select></td>
				</tr>
				<tr> 
					<td width="45%"> 
						<fieldset id="cuadro2" style="width:100%">
							<legend>(*) Kilometraje</legend>
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr style="padding: 6px 0px 0px 0px">
									<td align="right"><label id="labKmInicial2">KM. INICIAL&nbsp;:&nbsp;</label><input id="textKmInicial2" type="text" style="width:100px;" disabled></td>
									<td width="5%">&nbsp;</td>
									<td align="right"><label id="labKmFinal2">KM. FINAL&nbsp;:&nbsp;</label><input id="textKmFinal2" type="text" style="width:100px;" disabled></td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
				<tr> 
					<td>
						<fieldset id="cuadro3" style="width:98.7%;">
							<legend id="legAnimal">(*) Animales</legend>
							<table cellpadding="0" cellspacing="0" width="100%" border="0">
								<tr>
									<td align="right" style="padding: 0px 0px 0px 0px"><select id="animalServicioDestino" onChange="seleccionaAnimalMedioVigilancia2()"></select></td>
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
					<td width="45%" id="tituloSelecMultiple"><div id="tituloVehiculoAsignado">DESTINO SELECCIONADO</div></td>
				</tr>
				<tr> 
					<td><select id="unidadesMV" size="5"></td>
					<td width="8%">
					<input id="Btn_AgregarUnidadMedio" type="button" name="Btn_AgregarUnidadMedio" value=" >>"> 
					<input id="Btn_QuitarUnidadMedio" type="button" name="Btn_QuitarUnidadMedio" value=" << " disabled> 
					</td>
					<td><select id="unidadesSeleccionados" size="5"></select></td>
				</tr>
			</table>
		</div>
		<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr> 
				<td width="55%"></td>
				<td width="45%">
					<table cellpadding="0" cellspacing="0" width="100%">
						<tr style="padding: 2px 0px 0px 0px">
							<td width="49%" align="right"><input id="btnEliminaDestino" type="button" name="btnEliminaDestino" value="ELIMINAR" onClick="borraMedioDestino()" disabled="yes"> </td>
							<td width="1%" align="right"></td>
							<td width="48%"><input id="btnAgregarDestino" type="button" name="Btn_AgregarDestino" value="ACEPTAR" onClick="agregaMedioVigilanciaDestinos(1)"> </td>
						</tr>
					</table>
				</td>
			</tr>
		</table>   	
		<fieldset id="cuadro2" style="padding: 10px 0px 0px 0px">
			<legend>Medios de Vigilancia Ingresados ... </legend>
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" style="padding: 0px 10px 10px 5px;">
						<div style="min-height: 40px">
							<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
								<tr height="15">
									<td width="40%" id="nombreColumna">VEH&Iacute;CULO</td>
									<td width="15%" id="nombreColumna">FUNCIONARIOS</td>
									<td width="15%" id="nombreColumna">KM. INICIAL</td>
									<td width="15%" id="nombreColumna">KM. FINAL</td>
									<td width="15%" id="nombreColumna">DESTINO</td>
								</tr>
							</table>
							<div id="listadoMediosVigilanciaDestinos"></div>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</div>
</div>
<!-- Fin -->
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
	      	<td width="45%" valign="top"><select id="armasDisponibles" size="9" multiple="yes"></select></td>
	        <td width="8%" rowspan="3">
	         	<input id="Btn_Agregar" type="button" name="Btn_Agregar" value=" >> " onclick="asignarAccesorios()"> 
	         	<input id="Btn_Quitar" type="button" name="Btn_Quitar" value=" << " onclick="desAsignarAccesorios()">
	        </td>
	        <td width="45%" valign="top" rowspan="3">
	         	<div id="cuadro" style="padding: 0px 0px 5px 0px;">
		        	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		        		<tr>
		        			<td style="padding: 0px 0px 0px 1px;"><select id="personalServicio2"></select></td>
		        		</tr>
		        		<tr>
		        			<td><select id="personalServicioAccesorio" size="12" style="max-height:150px;"></select></td>
		        		</tr>
							</table>
						</div>
						<table cellpadding="0" cellspacing="0" width="100%">
						<tr style="padding: 5px 0px 0px 0px">
							<td width="49%" align="right"><input id="btnEliminarAccesorios" type="button" name="btnEliminarAccesorios" value="ELIMINAR" onClick="eliminarFuncionarioAccesorios()" disabled="yes"> </td>
							<td width="1%" align="right"></td>
							<td width="48%"><input id="btnAgregarAccesorios" type="button" name="btnAgregarAccesorios" value="ACEPTAR" onClick="agregaFuncionarioAccesorios()"> </td>
						</tr>
						</table>
	        </td>
	     	</tr>
			<tr> 
	      		<td id="tituloSelecMultiple">CAMARAS CORPORALES</td>
	      	</tr>
	      	<tr> 
	    		<td><select id="camarasDisponibles" size="9" ></select></td>
	    	</tr>
	    	<tr>
	      	<td id="tituloSelecMultiple">
				<div>ACCESORIOS</div>
				<div align="center"> ORDENAR POR:
					<button id="rank" class="filtroAccesorio" onclick="cambiarFiltroAccesorio('rank','abc');" disabled>M&aacute;s Usados</button>
					<button id="abc" class="filtroAccesorio" onclick="cambiarFiltroAccesorio('abc','rank');">Alfab&eacute;ticamente</button>
				</div>
			</td>
	      	<td></td>
	      	<td rowspan="4" colspan="5">
		      	<div id="cuadro" style="padding: 0px 0px 0px 0px;"></div>
		      	<fieldset id="cuadro2">
							<legend>Accesorios Ingresados ... </legend>
							<table cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td align="right" style="padding: 3px 0px 0px 0px;">
								<div style="min-height: 40px">
				   				<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
				        		<tr height="20px"> 
				           		<td width="40%" id="nombreColumna">FUNCIONARIO</td>
				            	<td width="13%" id="nombreColumna">ARM.</td>
				            	<td width="13%" id="nombreColumna">CAM.</td>
				            	<td width="13%" id="nombreColumna">ACC.</td>
				            	<td width="4%" id="nombreColumna"> </td>
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
	      	<td><select id="accesoriosDisponibles" size="10" multiple="yes"><option value="0">CARGANDO ACCESORIOS ... </option></select></td>
	    	</tr>
			</table>
		</div>
	</div>
  <div style="padding:3px 0px 0px 0px;"></div>    
  <table width="100%">
  <tr> 
    <td width="20%"><input id="btnCerrar" type="button" name="btnCerrar" value="CANCELAR" onclick="top.cerrarVentana();"></td>
    <td width="3%"><input id="btnAyuda" type="button" name="btnAyuda" value="?" disabled="yes"></td>
  	<td width="17%"></td>
  	<td width="15%"><input id="btnEliminar" type="button" name="btnEliminar" value="ELIMINAR" onclick="eliminarServicio();" disabled="yes"></td>
  	<td width="15%"><input id="btnAnterior" type="button" name="btnAnterior" value="<<< ANTERIOR" onclick="irPaginaAnteriorCuadrante()" disabled="yes"></td>
  	<td width="15%"><input id="btnSiguiente" type="button" name="btnSiguiente" value="SIGUIENTE >>>" onclick="irPaginaSiguienteCuadrante()"></td>
  	<td width="15%"><input id="btnFinalizar" type="button" name="btnFinalizar" value="FINALIZAR" onClick="guardarServicio()" disabled="yes"></td>
  </tr>
  </table>
</div>
</body>
</html>
<script type="text/javascript" src="./js/unidadesNuevo.js?v=<?echo version?>"></script>
<script src=".\axios\dist\axios.js"></script>
<?
	echo "<script>\n";
	echo "listaHoras('selHoraInicio',0,0);\n";
	echo "leeGrupoServicios(".$tipoUnidadNew.",".$especialidadUnidadNew.");\n";
	echo "seleccionaVehiculoMedioVigilancia();\n";
	if ($correlativo != "") echo "leeDatosServicio('".$unidad."','".$correlativo."');\n";
	echo "listaUnidadesEspecializadas('".$unidadPadre."','".$unidadUsuario."','cuadrantesMV');\n";
	echo "</script>\n";
?>