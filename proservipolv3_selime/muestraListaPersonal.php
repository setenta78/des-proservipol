<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Ficha Servicio: Primer Turno 10 de Enero del 2008</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/funcionarios.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/numero.js"></script>
</head>

<body>
<br>
<table cellspacing="1" cellpadding="1" width="99%" align="center">
<tr> 
  <td id="nombreColumna" width="4%" align="center">No.</td>
  <td id="colCodigo" class="nombreColumna" width="10%" align="center"><label id="labColCodigo">CODIGO</label></td>
  <td id="colNombre" class="nombreColumna" width="44%" align="center"><label id="labColNombre">NOMBRE</label></td>
  <td id="colGrado"  class="nombreColumna" width="19%" align="center"><label id="labColGrado">GRADO</label></td>
  <td id="colCargo"  class="nombreColumna" width="23%" align="center"><label id="labColCargo">CARGO</label></td>
</tr>
</table>

<div id="kk" style="width:98.5%; height:420px; overflow-y: scroll; scrollbar-track-color:#C8D0CE; scrollbar-face-color:#C8D0CE;padding:0px 2px 10px 7px;"> 	
</div>	
<div style="padding:5px 0px 0px 0px;"></div>		
<div class="linea" style="width:99%;"></div>
<table align="center" width="99%">
<tr> 
  <td width="20%">
  	<input type="button" name="btnImprimir" value="IMPRIMIR" id="btn100" onclick="alert('Imprimir')" disabled="yes">
  </td>
  <td width="20%"></td>
  <td width="20%"></td>
  <td width="20%">&nbsp;</td>
  <td width="20%"><input type="button" name="btnCerrar" value="CERRAR" id="btn100" onclick="top.cerrarVentana();"></td>
</tr>
</table>

</body>
</html>

<?
	$unidad = $_GET["unidad"];
	$grado = $_GET["grado"];
	echo "<script>\n";
	//echo "alert(document.getElementById('labServicio').value)";  
	echo "muestraListaFuncionarios('".$unidad."','','".$grado."');\n";
	echo "</script>\n";
?>