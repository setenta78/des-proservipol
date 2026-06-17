<?include("session.php")?>   
<?include("tiempo.php")?>
<?
	$unidadUsuario	= $_SESSION['USUARIO_CODIGOUNIDAD'];
	$tipoConsulta 	= $_GET["tipoConsulta"];
?>
<html>
<head>
<title>Genera Consulta ... </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/fichaGeneraConsulta.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/listaMultiple.js"></script>
<script type="text/javascript" src="./js/tipoServicio.js"></script>
<script type="text/javascript" src="./js/fichaGeneraConsulta.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>  

</head>
<body style="background-color:#d0d0d0" scroll="no">´

<div style="width:98.5%;">
	<div id="marcoLevantado">   
    <table cellpadding="1" cellspacing="0" width="95%">
	 <tr> 
	   <td width="42%">&nbsp;</td>
	   <td width="24%" align="right">(*) FECHA DESDE&nbsp;:&nbsp;</td>
	   <td width="34%"><input type="text" id="textFechaServicio1" readonly></td>
	   <td width="2%"><input name="idFechaServicio1" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicio1, textFechaServicio1,'dd-mm-yyyy','300','-1')"></td>
	   
	</tr>
	<tr> 
	   <td>&nbsp;</td>
	   <td align="right">(*) FECHA HASTA&nbsp;:&nbsp;</td>
	   <td><input type="text" id="textFechaServicio2" readonly></td>
	   <td><input name="idFechaServicio2" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicio2, textFechaServicio2,'dd-mm-yyyy','300','-1')"></td>
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
         			<select id="disponibles" size="5" multiple>
         			<option value="0">CARGANDO PERSONAL ... </option></select> 
           	</td>
         	<td width="8%">
         		<input id="btn100" type="button" name="Btn_Agregar" value=" >>" onclick="moverParametro('disponibles','asignado')"> 
           		<input id="btn100" type="button" name="Btn_Quitar" value=" << " onclick="desasignarPersonal()">
           	</td>
         	<td width="45%"> 
         		<select id="asignado" size="5" multiple>
           		</select> 
           	</td>
        </tr>
        </table>
	<div id="linea"></div>
	</div>

  
  <div style="padding:3px 0px 0px 0px;"></div>    
  <table width="100.5%">
  <tr> 
    <td width="25%"><input id="btn100" type="button" name="btnCerrar" value="CANCELAR" onclick="top.closeAllModalWindows();"></td>
    <td width="3%"><input id="btn100" type="button" name="btnAyuda" value="?" disabled="yes"></td>
  	<td width="12%">&nbsp;</td>
  	<td width="10%">&nbsp;</td>
  	<td width="10%">&nbsp;</td>
  	<td width="40%"><input id="btn100" type="button" name="btnBuscar" value="BUSCAR" onClick="alert()"></td>
  </tr>
  </table>
</div>
</body>
</html>

<?
	echo "<script>\n";
	echo "inicializarGenerador('".$tipoConsulta."');\n";
	echo "</script>\n";
?>