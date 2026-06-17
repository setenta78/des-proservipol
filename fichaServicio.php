<?
include("version.php");
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
?>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/verdeStyle.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/servicios.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/numero.js?v=<?echo version?>"></script>
</head>
<body leftmargin="12" topmargin="10" marginwidth="0" marginheight="0" bgcolor="#f5fbf3" scroll="no">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<div class="linea"></div>
<div style="width:100%; height:439px; overflow-y: auto; scrollbar-track-color:#d0d0d0; scrollbar-face-color:#d0d0d0;padding:0px 2px 0px 2px;">
<input type="hidden" id="tipoServicio">
<input id="perfil"  type="hidden" readonly="yes" value="<?echo $codigoPerfil?>">
<input id="permisoRegistrar" type="hidden" readonly="yes" value="<?echo $permisoRegistrar?>">

<table width="100%" cellspacing="1" cellpadding="1">
<tr>
	<td class="textoNegrilla" width="100%"  align="left" colspan="2">Identificaci&oacute;n del Servicio</td>
</tr>
<tr>
	<td bgcolor="#000000"></td>
</tr>
<tr><td height="3"></td></tr>
</table>

<div id="identificacionServicio" style="width:100%"><table><tr><td><img src='./img/ajax_loader.gif' width='16' height='16'></td><td>&nbsp;CARGANDO INFORMACION DEL SERVICIO ......</td></tr></table></div>

<div id="mediosDeVigilancia" style="width:100%"></div>
<table width="100%" cellspacing="1" cellpadding="1">
<tr>
	<td class="textoNegrilla" width="100%"  align="left" colspan="2">Observaciones</td>
</tr>
<tr>
	<td bgcolor="#000000"></td>
</tr>
<tr><td height="3"></td></tr>
</table>
<table width="100%" cellspacing="1" cellpadding="1">
<tr>
	<td class="dato" width="100%"  align="left" colspan="2"><div id="observaciones"></div></td>
</tr>
</table>
</div>
<div class="linea"></div>

<table align="center" width="100%">
<tr>
  <td width="20%">
  	<input type="button" id="btnImprimir" name="btnImprimir" value="IMPRIMIR PDF" class="Boton_100" onclick="window.open('xml/xmlServicios/pdfDatosServicio.php?unidad=<?echo $unidad;?>&correlativo=<?echo $correlativo;?>');">
  </td>
  <td width="20%"></td>
  <td width="20%"></td>
  <td width="20%">&nbsp;</td>
  <td width="20%"><input type="button" id="btnCerrar" name="btnCerrar" value="CERRAR" class="Boton_100" onclick="top.cerrarVentana();"></td>
</tr>
</table>
</body>
</html>
<?
	$unidad = $_GET["unidad"];
	$correlativo = $_GET["correlativo"];
	echo "<script>\n";
	echo "leeDatosServicio('".$unidad."','".$correlativo."',true);\n";
	echo "</script>\n";
?>