<?include("session.php")?>   
<?include("tiempo.php")?>
<?
	//$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	//$tipoConsulta 	= 1;
	
	$unidadEspecialidad	= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];
	
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
<script type="text/javascript" src="./calendario/popcalendar.js"></script>  

</head>
<body style="background-color:#d0d0d0" scroll="no">´

<div style="width:98.5%;">
<!--
	<table cellpadding="0" cellspacing="0" width="95%">
	 <tr style="padding:0px 0px 2px 0px;"> 
	   <td width="20%"><input type="button" id="btn100" value="POR FUNCIONARIO"></td>
	   <td width="20%"><input type="button" id="btn100" value="POR VEHICULO"></td>
	   <td width="60%"></td>
	</tr>
	</table>
-->
	<div id="marcoLevantado"> 
	<div id="divBusquedaServicioPorFuncionario">  
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
	echo "</script>\n";
?>