<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/vistaServicio.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/vistaServicio.js"></script>
</head>
<body>
<div id="especificaServicio"></div>
<div id="listadoRecursosAsignados">
	<div id="personal" style="position:relative;">
		<div id="subtitulo">PERSONAL QUE REALIZO EL SERVICIO</div>
		<table cellspacing="1" cellpadding="1" width="100%">
		    <tr> 
		      <td id="nombreColumna" width="5%" align="center">NRO.</td>
		      <td id="nombreColumna" width="35%" align="center">NOMBRE COMPLETO</td>
		      <td id="nombreColumna" width="24%" align="center">GRADO</td>
		      <td id="nombreColumna" width="36%" align="center">CODIGO FUNCIONARIO</td>
		    </tr>
		</table>
		<div id="listadoPersonalRealizoServicio"></div>
	</div>
	<div id="vehiculos">
		<div id="subtitulo">VEHICULOS ASIGNADOS</div>
		<table cellspacing="1" cellpadding="1" width="100%">
		   <tr> 
		     <td id="nombreColumna" width="5%" align="center">NRO.</td>
		     <td id="nombreColumna" width="35%" align="center">VEHICULO</td>
		     <td id="nombreColumna" width="12%" align="center">PATENTE</td>
		     <td id="nombreColumna" width="12%" align="center">KM. INICIAL</td>
		     <td id="nombreColumna" width="12%" align="center">KM. FINAL</td>
		     <td id="nombreColumna" width="12%" align="center">TOTAL KMS.</td>
		     <td id="nombreColumna" width="12%" align="center">COMBUSTIBLE</td>
		   </tr>
		</table>
		<div id="listadoVehiculosRealizoServicio"></div>
	</div>
	<div id="armamento">
		<div id="subtitulo">ARMAMENTO UTILIZADO</div>
		<table cellspacing="1" cellpadding="1" width="100%">
		   <tr> 
		     <td id="nombreColumna" width="5%" align="center">NRO.</td>
		     <td id="nombreColumna" width="35%" align="center">TIPO ARMA</td>
		     <td id="nombreColumna" width="24%" align="center">IDENTIFICACION</td>
		     <td id="nombreColumna" width="36%" align="center">RESPONSABLE</td>
		   </tr>
		</table>
		<div id="listadoArmamentoServicio"></div>
	</div>
	<div id="animales">
		<div id="subtitulo">ANIMALES ASIGNADOS</div>
		<table cellspacing="1" cellpadding="1" width="100%">
		   <tr> 
		     <td id="nombreColumna" width="5%" align="center">NRO.</td>
		     <td id="nombreColumna" width="35%" align="center">TIPO ANIMAL</td>
		     <td id="nombreColumna" width="24%" align="center">CANTIDAD</td>
		     <td id="nombreColumna" width="36%" align="center">&nbsp;</td>
		   </tr>
		</table>
		<div id="listadoAnimalesServicio"></div>
	</div>
	<div id="accesorios">
		<div id="subtitulo">ACCESORIOS UTILIZADOS</div>
		<table cellspacing="1" cellpadding="1" width="100%">
		   <tr> 
		     <td id="nombreColumna" width="5%" align="center">NRO.</td>
		     <td id="nombreColumna" width="35%" align="center">TIPO ACCESORIO</td>
		     <td id="nombreColumna" width="24%" align="center">CANTIDAD</td>
		     <td id="nombreColumna" width="36%" align="center">&nbsp;</td>
		   </tr>
		</table>
		<div id="listadoAccesoriosServicio"></div>
	</div>
</div>  
<div id="lineaSeparacion"></div>
<table width="100%" >
<tr> 
	<td width="20%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.closeAllModalWindows();"></td>
	<td width="30%">&nbsp;</td>
   	<td width="15%">&nbsp;</td>
   	<td width="15%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
</tr>
</table>
</body>
</html>
<?

	$unidad = $_GET['unidad'];
	$codigoServicio = $_GET['codigoServicio'];
	$fecha	= $_GET['fecha'];
	
	$fechaPaso 		= explode("-",$fecha);
   	$fechaBuscar    = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];

	echo "<script>";
	echo "buscaServicio('".$unidad."', '".$fechaBuscar."', '".$codigoServicio."');";
	echo "</script>";
?>