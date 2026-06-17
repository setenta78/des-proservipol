<?
$codigoVehiculo = $_GET["codigoVehiculo"];
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/vistaServicio.css" rel="stylesheet" type="text/css">
<link href="./css/vistaHistoriaVehiculo.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/vehiculos.js"></script>
</head>
<body>
<div id="especificaServicio"></div>
<div id="listadoHistoriaVehiculo">
	<div id="personal" style="position:relative;">
		<div id="encabezado">
		<table cellspacing="1" cellpadding="1" width="100%">
		    <tr> 
		      <td id="nombreColumna" width="20%" align="center">FECHA</td>
		      <td id="nombreColumna" width="36%" align="center">ESTADO</td>
		      <td id="nombreColumna" width="44%" align="center">UNIDAD</td>
		    </tr>
		</table>
		</div>
		<div id="listadoHistoricoVehiculo"></div>
	</div>
</div>  
<div id="lineaSeparacion"></div>
<table width="100%" >
<tr> 
	<td width="30%">&nbsp;</td>
   	<td width="15%">&nbsp;</td>
   	<td width="15%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
    <td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.closeAllModalWindows();"></td>
</tr>
</table>
</body>
</html>
<?
	echo "<script>";
	echo "leeHistoricoEstados('".$codigoVehiculo."');";
	echo "</script>";
?>