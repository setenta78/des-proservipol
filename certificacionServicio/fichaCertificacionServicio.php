<?
session_start();
include("../version.php");
$permisoValidar   	= ($_SESSION['PERMISO_VALIDAR']==1);
$unidadUsuario   	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$codigoUsuario   	= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$contrasena			= $_SESSION['USUARIO_CLAVE'];
$codigoUsuario 	 	= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$ip 				= $_SESSION['DIRECCION_IP'];
$codPadre   		= $_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN'];
$tipoUnidad      	= $_SESSION['USUARIO_TIPOUNIDAD'];
$tipoUnidadPadre 	= $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'];
$descripcionUnidad  = $_GET['descripcionUnidad'];
$fechaServicios     = $_GET["fechaServicios"];
$fechaCertificado   = $_GET["fechaValidados"];
$unidadServicios    = $_GET["unidadServicios"];
$horaCertificado    = $_GET["horaCertificado"];
$codigoFuncionario  = $_GET["codigoFuncionario"];
?>
<html>
<head>
<title>Ficha Servicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/verdeStyle.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaCertificacionServicio.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/serviciosCertificado.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/numero.js?v=<?echo version?>"></script>
</head>
<body leftmargin="12" topmargin="10" marginwidth="0" marginheight="0" bgcolor="#f0f6ef" scroll="no" onload="leeMotivoDesvalidacion('selMotivo');" >
<input id="contrasena" type="hidden" value="<? echo $contrasena?>">
<input id="codFuncionario" type="hidden" value="<? echo $codigoUsuario?>">
<input id="codPadre" type="hidden" value="<? echo $codPadre?>">
<input id="tipoUnidad" type="hidden" value="<? echo $tipoUnidad?>">
<input id="tipoUnidadPadre" type="hidden" value="<? echo $tipoUnidadPadre?>">
<input id="permisoValidar" type="hidden" value="<? echo $permisoValidar?>">
<input id="ip" type="hidden" value="<? echo $ip?>">
<div style="width:100%; height:450px; overflow-y: none; scrollbar-track-color:#d0d0d0; scrollbar-face-color:#d0d0d0;padding:0px 2px 0px 2px;">
<div id="cubreVentana" style="display:none;"><table width="100%"><tr><td align="right" width="35%"></td></tr></table></div>
<div id="ventanaIngresoContrasena" style="display:none;">
	<div id="usuarioCuadro">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr><td colspan="3"><div id="textTituloContrasena"></div></td></tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr style="padding: 2px 0px 10px 0px;">
				<td width="25%"><div id="textMotivo">MOTIVO:</div></td>
				<td width="75%"> <select id="selMotivo" name="selMotivo"></select></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
			<tr style="padding: 2px 0px 10px 0px;">
				<td width="25%"><div id="textContrasenna">CONTRASE&Ntilde;A:</div></td>
				<td width="75%"><input id="textContrasena" type="password" ></td>
			</tr>
			<tr><td colspan="3">&nbsp;</td></tr>
		</table>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr style="padding: 2px 0px 10px 0px;">
				<td width="50%">&nbsp;</td>
				<td width="25%"><input type="button" id="btnAceptar" class="Boton_100" name="btnAceptaContrasena" value="ACEPTAR" onClick="validaContrasena('<? echo $unidadServicios;?>','<? echo $fechaServicios;?>','<? echo $fechaValidados;?>','<?echo $horaCertificado;?>','<?echo $codigoFuncionario;?>')"></td>
	    	<td width="25%"><input type="button" id="btnCancelar" class="Boton_100" value="CANCELAR" onClick="desactivaVentanaIngresoContrasena()"></td>
			</tr>
		</table>
	</div>
</div>

<input type="hidden" id="tipoServicio">
<table width="100%">
	<tr>
		<td align="left" width="80%"><div id="datosValidacion"></div></td>
	    <td align="right" width="20%">
	    	<table border="0" width="100%">
	    		<tr>
		    		<td onmouseover="this.style.cursor='hand'" align="right" onClick="cambiaLayer('layerResumenServicio')">VER RESUMEN</td>
						<td width="1%" align="center">|</td>
						<td onmouseover="this.style.cursor='hand'" onClick="cambiaLayer('layerListadoServicio')">VER SERVICIOS</td>
		    	</tr>
				</table>
	    </td>
	</tr>
</table>
<div class="linea"></div>
<div id="listado2">
	<div id="layerResumenServicio" style="position:absolute; width:100%; visibility:visible;">
		<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Cargando Resumen ...</td></tr></table>
	</div>
	<div id="layerListadoServicio" style="position:absolute; width:100%; visibility:hidden;">
	  <div id="cabeceraGrilla">
	  	<table cellspacing="1" cellpadding="1" width="100%">
	      <tr> 
	        <td id="nombreColumna" width="5%" align="center">N°</td>
	        <td id="nombreColumna" width="60%" align="center">SERVICIO</td>
	        <td id="nombreColumna" width="15%" align="center">HORARIO</td>
	        <td id="nombreColumna" width="10%" align="center">FUN.</td>
	        <td id="nombreColumna" width="10%" align="center">VEH.</td>
	      </tr>
	    </table>
	  </div>
		<div id="listadoServicios">
		<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ...</td></tr></table>
		</div>
	</div>	
	<div id="layerDetalleServicio" style="position:absolute; width:100%; visibility:hidden;">
		<div id="identificacionServicio" style="width:100%"></div>
		<div id="mediosDeVigilancia" style="width:100%"></div>
		<div id="observaciones" style="width:100%"></div>
	</div>
</div>
<br>
</div>
<div id="tablaBotones" style="position:fixed; width:100%; bottom:0px; clear:both; overflow:visible; background-color:#f0f6ef;">
<div class="linea"></div>
<table align="center" width="100%">
<tr>
  <td ><input type="button" id="btnImprimir" name="btnImprimir" value="CREAR PDF TOTALIDAD DE SERVICIOS" class="Boton_100" onclick="window.open('../imprimible/servicios/servicioFechaUnidad.php?codigoUnidad=<?echo $unidadServicios;?>&fecha1=<?echo $fechaServicios;?>');"></td>
  <td ><div id="imprimirServicioActual"></div></td>
  <td ><input type="button" id="btnDesValidar" name="btnDesValidar" value="DESVALIDAR" class="Boton_100" onclick="desvalidaServicios();" disabled></td>
  <td ><input type="button" id="btnValidar" name="btnValidar" value="VALIDAR" class="Boton_100" onclick="validaServicios('<?echo $unidadServicios;?>','<?echo $fechaServicios;?>','<?echo $codigoUsuario;?>');" disabled></td>
  <td ><input type="button" id="btnCerrar" name="btnCerrar" value="CANCELAR" class="Boton_100" onclick="top.cerrarVentana();"></td>
</tr>
</table>
</div>
</body>
</html>
<?
	echo "<script>\n";
	echo "leeDatosServicios('".$codigoUsuario."','".$unidadServicios."','".$fechaServicios."','".$descripcionUnidad."');\n";
	echo "</script>\n";
?>