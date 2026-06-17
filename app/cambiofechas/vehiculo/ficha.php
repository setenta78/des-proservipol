<?
	$codigo 	= $_GET["codigo"];
	$patente 	= $_GET["patente"];
	$fechaD 	= $_GET["fechaD"];
	$fechaH 	= $_GET["fechaH"];
	
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/rectificarFechas.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
</head>
<body style="margin-top:20; margin-left:30; background-color:#d0d0d0" scroll="no">
	
<fieldset style="width:100%; border:1px groove:#fff;">
<table width="100%">
<tr style="padding: 0px 0px 2px 0px">
			<td width="30%" align="right">Patente&nbsp;:&nbsp;</td>
			<td width="60%"><? echo $patente; ?><input id="textCodigo" type="hidden" readonly="yes" value="<? echo $codigo; ?>" style="background-color:#E6E6E6"></td>
			<td width="10%"></td>
</tr>
</table>
</fieldset>

<fieldset style="width:100%; border:1px groove:#fff;">
<table>
	<tr>
			<td width="30%" align="right">&nbsp;&nbsp;</td>
			<td width="15%">Desde</td>
			<td width="10%" style="padding: 0px 0px 0px 2px">
			</td>
			<td width="10%"></td>
			<td width="15%">Hasta</td>
			<td width="10%" style="padding: 0px 0px 0px 2px">
			</td>
			<td width="10%"></td>
</tr>
<tr>
			<td width="30%" align="right">Fecha &nbsp;:&nbsp;</td>
			<td width="15%"><input id="textFechaDNueva" type="text" readonly="yes" value="<? echo $fechaD; ?>" style="background-color:#E6E6E6">
				<input id="textFechaD" type="hidden" readonly="yes" value="<? echo $fechaD; ?>" ></td>
			<td width="10%" style="padding: 0px 0px 0px 2px">
				<input id="imagenCalendarioFichaArma" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaDNueva, textFechaDNueva,'dd-mm-yyyy','250','38')" style="visibility:visible">
			</td>
			<td width="10%"></td>
			<td width="15%"><input id="textFechaHNueva" type="text" readonly="yes" value="<? echo $fechaH; ?>" style="background-color:#E6E6E6">
				<input id="textFechaH" type="hidden" readonly="yes" value="<? echo $fechaH; ?>" ></td>
			<td width="10%" style="padding: 0px 0px 0px 2px">
				<input id="imagenCalendarioFichaArma" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="<? if($fechaH!="--") echo "popUpCalendar(textFechaHNueva, textFechaHNueva,'dd-mm-yyyy','250','38')"; ?>" style="visibility:<? if($fechaH==""){echo "hidden";} else{echo "visible";} ?>">
			</td>
			<td width="10%"></td>
</tr>
</table>
</fieldset>
<table width="100%">
<tr>
	<td width="20%"></td>
	<td width="20%"><input name="btnEliminar" type="button" id="btnEliminar" value="ELIMINAR" onClick="eliminarFicha()"></td>
	<td width="20%"><input name="btnCerrar" type="button" id="btnCerrar" value="CERRAR" onClick="top.cerrarVentana()"></td>
</tr>
</table>
</body>
</html>