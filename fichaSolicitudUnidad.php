<?
include("version.php");
include("session.php");
include("tiempo.php");
$fechaArchivo         = date("Y-m-d h_m_s");
$fechaRequerimiento   = date("d-m-Y");
$codigoFuncionario 		= $_GET["codigoFuncionario"];
$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
$unidadPadre		    	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoUnidad			      = $_SESSION['USUARIO_TIPOUNIDAD'];
$contieneHijos        = $_SESSION['USUARIO_CONTIENEHIJOS'];
$usuario              = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$solicitud            = $_GET["codigo"];
$codigoPerfil         = 10;
$descUnidadUsuario    = $_SESSION['USUARIO_DESCRIPCIONUNIDAD'];
?>
<html>
<head>
<title>REQUERIMIENTOS ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/requerimiento.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/problema.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/subproblema.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/movimiento2.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoServicio.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/tipoServicioExtraordinario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/fichaServicio.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js?v=<?echo version?>"> </script>
<script type="text/javascript" src="./ventana/js/window.js?v=<?echo version?>"> </script>
<script type="text/javascript" src="./ventana/js/effects.js?v=<?echo version?>"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js?v=<?echo version?>"> </script>
<script type="text/javascript" src="./ventana/js/debug.js?v=<?echo version?>"> </script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
<link href="./css/fichaServicio.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
</head>
<body style="margin-top:10; margin-left:10; background-color:#f0f6ef" onload="javascript:leeProblema('cboProblema');leeSubproblemas('','cboSubProblema');leeMovimiento2('cboMovimiento','<?echo $codigoPerfil; ?>');" scroll="yes">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="usuario"  type="hidden" readonly="yes" value="<?echo $usuario?>">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>">
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="codigo" value="">
<input type="hidden" id="codigoSolicitud" value="<?echo $solicitud?>">
<input type="hidden" id="fechaArchivo" value="<?echo $fechaArchivo?>">
<input type="hidden" id="movimiento">
<input type="hidden" id="codigoMovimiento">
<input type="hidden" id="valor2">
<input type="hidden" id="secciones">
<input type="hidden" id="tipoUnidad" value="<?echo $tipoUnidad?>">
<input type="hidden" id="descUnidad" value="<?echo $descUnidadUsuario?>">
<div id="mensajeCargando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;CARGANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<div id="mensajeGuardando" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"><img src='./img/ajax_loader.gif' width="20" height="20"></td><td width="65%" align="left">&nbsp;GUARDANDO DATOS, ESPERE POR FAVOR ......</td></table>
</div>
<u><b>SOLICITUD DE REQUERIMIENTO</b></u>
<br><br>
<div id="marcoLevantado">
<br>
<div id="pantalla2">
<fieldset>
<legend><b>DATOS DEL USUARIO</b></legend>
<br>
<table border="0">
<tr>
<td><b>CODIGO</b></td>	
<td><b>GRADO</b></td>	
<td><b>NOMBRE</b></td>
<td><b>PERFIL</b></td>	
</tr>
<tr>
<td><input type="text" id="codFun" size="8"/></td>
<td><input type="text" id="grado" size="15"/></td>
<td><input type="text" id="nom" size="30"/></td>
<td><input type="text" id="perfil" size="8"/></td>
</tr>
</table>
</fieldset>
</div>
<br><br>
<div id="pantalla3">
<fieldset>
<legend><b>REQUERIMIENTO PROSERVIPOL</b></legend>
<br>
<table border="0">
<tr>
<td><b>PROBLEMA</b></b></td>
<td><select id="cboProblema" onChange="leeSubproblemas(this[this.selectedIndex].value,'cboSubProblema')" disabled>
</select></td>
</tr>
<tr>
<td><b>SUB-PROBLEMA</b></td>
<td><select id="cboSubProblema" disabled>
</select></td>
</tr>
</table>
<br>
<div id="ide1" style="display:none;">
<table border="0">
<tr>
<td align="center"><label id="ident1"></lab></td>
<td align="center"><label id="ident2"></lab></td>
</tr>
<tr>
<td><input type="text" id="id1"/></td>
<td><input type="text" id="id2"/></td>
<td><div id="idFec" style="display:none;"><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(id2,'dd-mm-yyyy',this,-100,-195)"></div></td>
</tr>
</table>
</div>
<div id="tipoServicio" style="display:none;">
	<table cellpadding="1" cellspacing="0" width="100%" border="0">
	<tr>
	<td align="center" id="idEtiServ1">DIA</td>
	<td align="center" id="idEtiServ2">TIPO SERVICIO</td>
	</tr>
	<tr>
		<td width="24%"><input type="text" id="textDia2"/>&nbsp;<input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textDia2,'dd-mm-yyyy',this,-100,-195)"></td>
		<td width="36%">
	 	<select id="selTipoServicio" onChange="seleccionTipoServicio('<?echo $unidadEspecialidad?>')">
	    <option value="0">SELECCIONE UNA OPCION ...</option>
	    <option value="1">OPERATIVOS ORDINARIOS</option>
	    <option value="2">OPERATIVOS EXTRAORDINARIOS</option>
	    <option value="3">ADMINISTRATIVOS Y DE APOYO</option>
	    <option value="4">SIN SERVICIO POR OTRAS CAUSALES</option>
	    <option value="6">INTRACUARTEL</option>
	  	<option value="7">SERVICIOS Y TRAMITES FUERA DEL CUARTEL</option>
	  </select>
	</td>
	<td width="40%"></td>
	</tr>
	<tr>
		<td align="right"></td>
		<td  colspan="2">
	    <select id="selServicio" onChange="seleccionServicio()"></select>
		</td>
	</tr>
	<tr style="display:none;">
	  <td align="right">&nbsp;</td>
	  <td colspan="2"><input type="text" id="textOtroExtraordinario" maxlength="90" disabled style="background-Color:#D4D4D4;"></td>
	</tr>
	  <tr style="display:none;">
	  <td align="right">&nbsp;</td>
	  <td colspan="2"><select id="selLicencia" onChange="Seleccionlicencia()" disabled style="background-Color:#D4D4D4;"></select></td>
	</tr>
	</table>
	<br>
	<table cellpadding="1" cellspacing="0" width="100%" style="display:none;">
	<tr> 
	 <td width="24%" align="right">(*) FECHA&nbsp;:&nbsp;</td>
	 <td width="34%"><input type="text" id="textFechaServicio" readonly="yes"></td>
	 <td width="2%"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaServicio,'dd-mm-yyyy',this,-100,-195)"></td>
	 <td width="11%" align="right" id="labHoraInicio">(*) INICIO&nbsp;:&nbsp;</td>
	 <td width="9%"><select id="selHoraInicio"></select></td>
	 <td width="11%" align="right" id="labHoraTermino">(*) TERMINO&nbsp;:&nbsp;</td>
	 <td width="9%" align="right"><select id="selHoraTermino"></select></td>
	</tr>
	</table>
</div>
<div id="tipoUsuario" style="display:none;">
<table border="0">
<tr>
<td align="center"><label id="ident3"></lab></td>
<td align="center"><label id="ident4"></lab></td>
</tr>
<tr>
<td><input type="text" id="textTipoUsuario"/></td>
<td><select id="tipoDeUsuario">
  <option value="0">SELECCIONE OPCION ...</option>
  <option value="TITULAR">TITULAR</option>
  <option value="SUPLENTE">SUPLENTE</option>
  <option value="VALIDADOR">VALIDADOR</option>
</select></td>
<td></td>
</tr>
</table>
</div>
<br>
<table border="0">
<tr>
<td><b>OBSERVACION</b></td>
</tr>
<tr>
<td><textarea name="obs1" id="obs1" rows="4" cols="50"></textarea></td>
</tr>
</table>
<table border="0" style="display:none;">
<tr>
<td><b>OBSERVACION</b></td>
</tr>
<tr>
<td><textarea name="obs" id="obs" rows="4" cols="50" disabled></textarea></td>
</tr>
</table>
<br>
<div id="estado2" style="display:none;">
<fieldset>
<legend><b><h5>CAMBIO DE ESTADO</h5></b></legend>
<table border="0">
<tr>
<td></td>
</tr>
<tr>
<td><select id="cboMovimiento" onChange="hijomenor888();adjuntarArchivo()">
</select></td>
</tr>
</table>
<div id="adjunto" style="display:none;">
<table>
<tr>
<form name="formSubeArchivo" action="adjuntarArchivoSubirSolicitud.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo">
<td><input type="file" size="20" name="archivo" id="archivo"/></td>
</tr>
<tr>
<td>
	<input type="button" value="SUBIR" id="btnSubir" name="btnSubir" onClick="subirArchivo(this)"/>
	<input type="hidden" id="archivoServidor" value="">
	<input type="hidden" id="archivoLoad" value=0>
	<input type="hidden" id="rutArchi" name="rutArchi" value="">
	</form>
</td>
</tr>
</table>
</div>
</fieldset>
</div>
<br>
<div id="estado22" style="display:none;">
<table>
<tr>
<td><b>INDICACIONES</b></td>
</tr>
<tr>
<td><textarea name="resp" id="resp" rows="4" cols="50"></textarea></td>
</tr>
</table>
</div>
</fieldset>
</div>
</div>
<br>
<table width="95%">
<td width="10%">&nbsp;</td>
<td width="10%">&nbsp;</td>
<td width="10%"><input name="btnGuardarOrganizacion" type="button" id="btnGuardarOrganizacion" value="GUARDAR COMO PENDIENTE" onClick="guardarFichaCaballo();" disabled></td>
<td width="10%"><input name="btnGuardarOrganizacion2" type="button" id="btnGuardarOrganizacion2" value="ENVIAR SOLICITUD" onClick="guardarFichaCaballo6();"></td>
<td width="10%"><input name="btnCerrarFichaFuncionario" type="button" id="btnCerrarFichaFuncionario" value="CERRAR" onClick="top.cerrarVentana();"></td>
</tr>
</table>
<br>
<div id="listadoFuncionarios2"></div>
<br>
<div>
<div id="marcoLevantado">	
<fieldset>
<legend><b><h5>HISTORIAL DE LA SOLICITUD</h5></b></legend>
<br>
<div id="listadoFuncionarios"></div>
</fieldset>
</div>
</div>
</body>
</html>
<?
	echo "<script>";
	echo "leedatosSolicitudUnidad('".$unidadUsuario."','".$solicitud."','".$usuario."',".$tipoUnidad.");";
	echo "leeFuncionarios22('".$unidadSolicitud."','".$codigo."');";
	echo "</script>";
?>