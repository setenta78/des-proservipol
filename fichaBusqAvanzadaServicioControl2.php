<?include("session.php")?>   
<?include("tiempo.php")?>
<?
	$unidadEspecialidad	= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];
	
	$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$unidadPadre			= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	$codigoPerfil			= $_SESSION['USUARIO_CODIGOPERFIL'];
	
	//echo "unidad " . $unidadUsuario . "; unidadPadre = " . $unidadPadre . "; codigoPerfil = " . $codigoPerfil;
	
?>
<html>
<head>
<title>Genera Consulta ... </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/fichaBusqAvanzadaServicioControl.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/listaMultiple.js"></script>
<script type="text/javascript" src="./js/tipoServicio.js"></script>
<script type="text/javascript" src="./js/fichaBusqAvanzadaServicioControl.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>  

</head>
<body style="background-color:#ECECF0" scroll="no">
<BR>
<div style="width:98.5%;">
<input name="unidadUsuario"	type="hidden" value="<?echo $unidadUsuario?>">
<input name="unidadPadre"	type="hidden" value="<?echo $unidadPadre?>">
<input name="codigoPerfil"	type="hidden" value="<?echo $codigoPerfil?>">
	
<div id="divBusquedaServicioPorFuncionario">  

	<table cellpadding="0" cellspacing="0">
	<tr height="23">
		<td  class="tabActiva">&nbsp;&nbsp;&nbsp;POR FUNCIONARIO</td>
		<td  class= "tabDesactiva" OnMouseOver="cambiarClase(this, 'tabMousse')"  OnMouseOut="cambiarClase(this, 'tabDesactiva')" onClick="mostrarDivPorUnidad()">&nbsp;&nbsp;POR UNIDAD</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	
	<div id="marcoLevantado"> 
		
		    <table cellpadding="0" cellspacing="0" width="95%">
			 <tr> 
			   <td width="32%">&nbsp;</td>
			   <td width="34%" align="right">(*) FECHA INICIO BÚSQUEDA&nbsp;:&nbsp;</td>
			   <td width="34%" style="padding:0px 5px 0px 0px;"><input type="text" id="textFechaServicio1" readonly="yes"></td>
			   <td width="2%"><input name="idFechaServicio1" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicio1, textFechaServicio1,'dd-mm-yyyy','-1','-1')"></td>
			</tr>
			<tr> 
			   <td>(*) PARAMETROS OBLIGATORIOS</td>
			   <td align="right">(*) FECHA TÉRMINO BÚSQUEDA&nbsp;:&nbsp;</td>
			   <td style="padding:0px 5px 0px 0px;"><input type="text" id="textFechaServicio2" readonly="yes"></td>
			   <td><input name="idFechaServicio2" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicio2, textFechaServicio2,'dd-mm-yyyy','-1','-1')"></td>
			</tr>
			</table>
			<div id="linea"></div>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
		        <tr> 
		         	<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloDisponible">TITULO DISPONIBLE</div></td>
		         	<td width="1%" rowspan="4"></td>
		         	<td width="8%">&nbsp;</td>
		         	<td width="1%" rowspan="4"></td>
		         	<td width="45%" id="tituloSelecMultiple"><div id="tituloAsignado">TITULO ASIGNADO</div></td>
		        </tr>
		        <tr> 
		         	<td width="45%" rowspan="3"> 
		         			<select id="disponibles" size="6" multiple>
		         			<option value="0">CARGANDO ... </option></select> 
		           	</td>
		         	<td width="8%">
		         		<input id="btn100" type="button" name="Btn_Agregar" value=" >>" onclick="moverParametro('disponibles','asignado')"> 
		           		<input id="btn100" type="button" name="Btn_Quitar" value=" << " onclick="moverParametro('asignado','disponibles')">
		           	</td>
		         	<td width="45%"> 
		         		<select id="asignado" size="6" multiple>
		           		</select> 
		           	</td>
		        </tr>
		        </table>
			<div id="linea"></div>
				<table cellpadding="0" cellspacing="0" width="95%">
			 	<tr> 
			   		<td width="24%">&nbsp;</td>
			   		<td width="40%" align="right">(*) INDIQUE CODIGO DEL FUNCIONARIO&nbsp;(999999X)&nbsp;:&nbsp;</td>
			   		<td width="33%" style="padding:0px 5px 0px 0px;"><input type="text" id="textCodigoFuncionario"></td>
			   		<td width="3%"><input id="btn100" type="button" name="Btn_AyudaFuncionario" value="?" disabled="yes"></td>
				</tr>
				</table>
	</div>
</div>


<div id="divBusquedaServicioPorUnidad" style="display:none;">  

	<table cellpadding="0" cellspacing="0">
	<tr height="23">
		<td  class= "tabDesactiva" OnMouseOver="cambiarClase(this, 'tabMousse')"  OnMouseOut="cambiarClase(this, 'tabDesactiva')" onClick="mostrarDivPorFuncionario()">&nbsp;&nbsp;POR FUNCIONARIO</td>
		<td  class= "tabActiva">&nbsp;&nbsp;&nbsp;POR UNIDAD</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	
	<div id="marcoLevantado"> 
		
		    <table cellpadding="0" cellspacing="0" width="95%">
			 <tr> 
			   <td width="32%">(*) PARAMETROS OBLIGATORIOS</td>
			   <td width="34%" align="right">(*) FECHA BÚSQUEDA&nbsp;:&nbsp;</td>
			   <td width="34%" style="padding:0px 5px 0px 0px;"><input type="text" id="textFechaServicioPorUnidad1" readonly="yes"></td>
			   <td width="2%"><input name="idFechaServicio1" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicioPorUnidad1, textFechaServicioPorUnidad1,'dd-mm-yyyy','-1','-1')"></td>
			</tr>
			</table>
			<div id="linea"></div>
				<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" style="padding:0px 0px 4px 0px;">
		        <tr> 
		         	<td height="30" width="45%" id="tituloSelecMultiple"><div id="tituloDisponible">UNIDAD</div></td>
		         	<td width="1%" rowspan="4"></td>
		         	<td width="8%">&nbsp;</td>
		         	<td width="1%" rowspan="4"></td>
		         	<td width="45%" id="tituloSelecMultiple"><div id="tituloAsignado">UNIDAD SELECCIONADA (*)</div></td>
		        </tr>
		        <tr> 
		         	<td width="45%" rowspan="3"> 
		         			<select id="unidadesDisponibles" size="9" onDblClick="buscaListaUnidades(this.value,'unidadesDisponibles','<?echo $unidadUsuario?>');">
		         			<option value="0">CARGANDO ... </option></select> 
		           	</td>
		         	<td width="8%">
		         		<input id="btn100_selUnidad" type="button" name="Btn_Agregar" value=" >>" onclick="seleccionaUnidadLista('unidadesDisponibles','unidadSeleccionada')"> 
		           		<input id="btn100_noSelUnidad" type="button" name="Btn_Quitar" value=" << " onclick="seleccionaUnidadLista('unidadSeleccionada','unidadesDisponibles')" disabled="yes">
		           	</td>
		         	<td width="45%"> 
		         		<select id="unidadSeleccionada" size="9">
		           		</select> 
		           	</td>
		        </tr>
		        </table>
		        <div id="linea"></div>
	</div>
</div>



  
  <div style="padding:3px 0px 0px 0px;"></div>    
  <table width="100.5%">
  <tr> 
    <td width="25%"><input id="btn100" type="button" name="btnCerrar" value="CANCELAR" onclick="top.cerrarVentana();"></td>
    <td width="3%"><input  id="btn100" type="button" name="btnAyuda"  value="?" disabled="yes"></td>
  	<td width="12%">&nbsp;</td>
  	<td width="10%">&nbsp;</td>
  	<td width="10%">&nbsp;</td>
  	<td width="40%"><input id="btn100" type="button" name="btnBuscar" value="BUSCAR" onClick="busquedaAvanzadaServicios()"></td>
  </tr>
  </table>
</div>
</body>
</html>
<?
	$tipoConsulta = 1;
	echo "<script>\n";
	echo "inicializarConsultaAvanzadaServico('".$tipoConsulta."','".$unidadEspecialidad."');\n";
	echo "buscaListaUnidades('".$unidadUsuario."','unidadesDisponibles','".$unidadUsuario."');\n";
	echo "</script>\n";
?>