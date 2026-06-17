<?include("session.php")?>   
<?include("tiempo.php")?>
<?
  $fechaArchivo         = date("Y-m-d h_m_s");
  $fechaRequerimiento   = date("d-m-Y");
	$codigoFuncionario 		= $_GET["codigoFuncionario"];
	$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
	$unidadPadre		    	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	$tipoUnidad			      = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion añadida el 14-09-2015
	$contieneHijos        = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de sesion añadida el 17-04-2015
	$usuario              = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	$solicitud            = $_GET["codigo"];
	$codigoPerfil         =10;
	//echo $solicitud;
?>
<html>
<head>
<title>REQUERIMIENTOS ...</title>	
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/requerimiento.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./js/unidades.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/problema.js"></script>
<script type="text/javascript" src="./js/subproblema.js"></script>
<script type="text/javascript" src="./js/movimiento2.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./css/fichaServicio.css" rel="stylesheet" type="text/css">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">


</head>
<body style="margin-top:10; margin-left:10; background-color:#f0f6ef" onload="javascript:leeProblema('cboProblema');leeSubproblemas('','cboSubproblema');leeMovimiento2('cboMovimiento','<?echo $codigoPerfil?>')">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="usuario"  type="hidden" readonly="yes" value="<?echo $usuario?>">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>"><!--Variable oculta añadida el 14-09-2015-->
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!--Variable oculta añadida el 17-04-2015-->
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="codigo" value="">
<input type="hidden" id="codigoSolicitud" value="<?echo $solicitud?>">
<input type="hidden" id="fechaArchivo" value="<?echo $fechaArchivo?>">
<input type="hidden" id="movimiento">
<input type="hidden" id="codigoMovimiento">

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
<legend><b>REQUERIMIENTO PROSERVIPOL V3.9.</b></legend>
<br>
<table border="0">
<tr>
<td><b>PROBLEMA</b></b></td>	
<td><select id="cboProblema" onChange="leeSubproblemas(this[this.selectedIndex].value,'cboSubProblema')" disabled>
</select></td>	
</tr>
<tr>
<td><b>SUB-PROBLEMA</b></td>
<td><select id="cboSubProblema" onchange="hijomenor()" disabled>
</select></td>	
</tr>
</table>	
<br>
<div id="identificador1" style="display:none;">
<table>
<tr>
<td align="center">SERVICIO</td>	
<td align="center">DIA </td>
</tr>	
<tr>
<td><input type="text" id="textUnidad"/></td>	
<td><input type="text" id="textDia"/><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia, textDia,'dd-mm-yyyy','250','38')"></td>	
</tr>	
</table>	
</div>
<div id="identificador2" style="display:none;">
<table>
<tr>
<td align="center">DIA</td>	
<td align="center">TIPO SERVICIO</td>
</tr>	
<tr>
<td><input type="text" id="textServicio"/><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia, textDia,'dd-mm-yyyy','250','38')"></td>	
<td><input type="text" id="textUnidad2" size="60"/></td>	
</tr>	
</table>	
</div>
<div id="identificador3" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">RUT</td>
</tr>	
<tr>
<td><input type="text" id="textFunc"/></td>	
<td><input type="text" id="textRut"/></td>	
</tr>	
</table>	
</div>
<div id="identificador4" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">FECHA CAMBIO ESTADO</td>
</tr>	
<tr>
<td><input type="text" id="textFunc2"/></td>	
<td><input type="text" id="textDia2"/><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia2, textDia2,'dd-mm-yyyy','250','38')"></td>	
</tr>	
</table>	
</div>
<div id="identificador5" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">RUT</td>
</tr>	
<tr>
<td><input type="text" id="textFunc3"/></td>	
<td><input type="text" id="textRut2"/></td>	
</tr>	
</table>	
</div>
<div id="identificador6" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">RUT CORRECTO</td>
</tr>	
<tr>
<td><input type="text" id="textFunc4"/></td>	
<td><input type="text" id="textRut3"/></td>	
</tr>	
</table>	
</div>
<div id="identificador7" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">NOMBRE CORRECTO</td>
</tr>	
<tr>
<td><input type="text" id="textFunc5"/></td>	
<td><input type="text" id="textNombre"/></td>	
</tr>	
</table>	
</div>
<div id="identificador8" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">UNIDAD</td>
</tr>	
<tr>
<td><input type="text" id="textFunc6"/></td>	
<td><input type="text" id="textUnidad3"/></td>	
</tr>	
</table>	
</div>
<div id="identificador9" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">TIPO DE USUARIO</td>
</tr>	
<tr>
<td><input type="text" id="textFunc7"/></td>	
<td><input type="text" id="textUsu"/></td>	
</tr>	
</table>	
</div>
<div id="identificador10" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
</tr>	
<tr>
<td><input type="text" id="textFunc8"/></td>	
</tr>	
</table>	
</div>
<div id="identificador11" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
</tr>	
<tr>
<td><input type="text" id="textFunc9"/></td>	
</tr>	
</table>	
</div>
<div id="identificador12" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">FOLIO LICENCIA</td>
</tr>	
<tr>
<td><input type="text" id="textFunc10"/></td>	
<td><input type="text" id="textFolio"/></td>	
</tr>	
</table>	
</div>
<div id="identificador13" style="display:none;">
<table>
<tr>
<td align="center">CODIGO FUNCIONARIO</td>	
<td align="center">FOLIO LICENCIA</td>
</tr>	
<tr>
<td><input type="text" id="textFunc11"/></td>	
<td><input type="text" id="textFolio2"/></td>	
</tr>	
</table>	
</div>
<div id="identificador14" style="display:none;">
<table>
<tr>
<td align="center">B.C.U.</td>	
<td align="center">TIPO ANIMAL</td>
</tr>	
<tr>
<td align="center"><input type="text" id="textBcu"/></td>	
<td align="center"><input type="text" id="textTipoAni"/></td>	
</tr>	
</table>	
</div>
<div id="identificador15" style="display:none;">
<table>
<tr>
<td align="center">B.C.U.</td>	
<td align="center">FECHA CAMBIO ESTADO</td>
</tr>	
<tr>
<td align="center"><input type="text" id="textBcu2"/></td>	
<td align="center"><input type="text" id="textDia3"/><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia3, textDia3,'dd-mm-yyyy','250','38')"></td>	
</tr>	
</table>	
</div>
<div id="identificador16" style="display:none;">
<table>
<tr>
<td align="center">B.C.U. ERRONEO</td>	
<td align="center">B.C.U. CORRECTO</td>
</tr>	
<tr>
<td><input type="text" id="textBcu3"/></td>	
<td><input type="text" id="textBcu4"/></td>	
</tr>	
</table>	
</div>
<div id="identificador17" style="display:none;">
<table>
<tr>
<td align="center">B.C.U.</td>	
<td align="center">PATENTE</td>
</tr>	
<tr>
<td><input type="text" id="textBcu5"/></td>	
<td><input type="text" id="textPatente"/></td>	
</tr>	
</table>	
</div>
<div id="identificador18" style="display:none;">
<table>
<tr>
<td align="center">B.C.U.</td>	
<td align="center">FECHA CAMBIO ESTADO</td>
</tr>	
<tr>
<td><input type="text" id="textBcu6"/></td>	
<td><input type="text" id="textDia4"/><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia4, textDia4,'dd-mm-yyyy','250','38')"></td>	
</tr>	
</table>	
</div>
<div id="identificador19" style="display:none;">
<table>
<tr>
<td align="center">B.C.U.</td>	
<td align="center">PATENTE CORRECTA</td>
</tr>	
<tr>
<td><input type="text" id="textBcu7"/></td>	
<td><input type="text" id="textPatente2"/></td>	
</tr>	
</table>	
</div>
<div id="identificador20" style="display:none;">
<table>
<tr>
<td align="center">PATENTE</td>	
<td align="center">B.C.U. CORRECTO</td>
</tr>	
<tr>
<td><input type="text" id="textPatente3"/></td>	
<td><input type="text" id="textBcu8"/></td>	
</tr>	
</table>	
</div>
<div id="identificador21" style="display:none;">
<table>
<tr>
<td align="center">N° DE SERIE</td>	
<td align="center">N° DE TARJETA</td>
</tr>	
<tr>
<td><input type="text" id="textSerie"/></td>	
<td><input type="text" id="textTarjeta"/></td>	
</tr>	
</table>	
</div>
<div id="identificador22" style="display:none;">
<table>
<tr>
<td align="center">N° DE SERIE</td>	
<td align="center">FECHA CAMBIO DE ESTADO</td>
</tr>	
<tr>
<td><input type="text" id="textSerie2"/></td>	
<td><input type="text" id="textDia5"/><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia5, textDia5,'dd-mm-yyyy','250','38')"></td>	
</tr>	
</table>	
</div>
<div id="identificador23" style="display:none;">
<table>
<tr>
<td align="center">N° DE SERIE ERRONEO</td>	
<td align="center">N° DE SERIE CORRECTO</td>
</tr>	
<tr>
<td><input type="text" id="textSerie3"/></td>	
<td><input type="text" id="textSerie4"/></td>	
</tr>	
</table>	
</div>
<div id="identificador24" style="display:none;">
<table>
<tr>
<td align="center">N° DE SERIE</td>	
<td align="center">MODELO ARMA</td>
</tr>	
<tr>
<td><input type="text" id="textSerie5"/></td>	
<td><input type="text" id="textModelo"/></td>	
</tr>	
</table>	
</div>
<div id="identificador25" style="display:none;">
<table>
<tr>
<td align="center">N° DE SERIE</td>	
<td align="center">FECHA CAMBIO DE ESTADO</td>
</tr>	
<tr>
<td><input type="text" id="textSerie6"/></td>	
<td><input type="text" id="textDia6"/><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia6, textDia6,'dd-mm-yyyy','250','38')"></td>	
</tr>	
</table>	
</div>
<div id="identificador26" style="display:none;">
<table>
<tr>
<td align="center">N° DE SERIE ERRONEO</td>	
<td align="center">N° DE SERIE CORRECTO</td>
</tr>	
<tr>
<td><input type="text" id="textSerie7"/></td>	
<td><input type="text" id="textSerie8"/></td>	
</tr>	
</table>	
</div>
<div id="identificador27" style="display:none;">
<table>
<tr>
<td align="center">DESCRIPCION INICIAL</td>	
<td align="center">DESCRIPCION FINAL</td>
</tr>	
<tr>
<td><input type="text" id="textDescUni"/></td>	
<td><input type="text" id="textDescUni2"/></td>	
</tr>	
</table>	
</div>
<div id="identificador28" style="display:none;">
<table>
<tr>
<td align="center">UNIDAD</td>	
</tr>	
<tr>
<td><input type="text" id="textUnidad4"/></td>	
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
	<input type="button" value="SUBIR" id="btn100" name="btnSubir" onClick="subirArchivo(this)"/>
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
<td width="10%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="GUARDAR COMO PENDIENTE" onClick="guardarFichaCaballo();" disabled></td>
<td width="10%"><input name="btnGuardarOrganizacion2" type="button" id="btn100" value="ENVIAR SOLICITUD" onClick="validarEstados();guardarFichaCaballo6();"></td>
<td width="10%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();"></td>	
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
	//echo "leedatosUsuario(".$unidadUsuario.",'".$usuario."');";
	echo "leedatosSolicitudUnidad('".$unidadUsuario."','".$solicitud."','".$usuario."');";
	echo "leeFuncionarios22('".$unidadSolicitud."','".$codigo."');";
	//echo "leeFuncionarios23('".$unidadSolicitud."','".$codigo."');";
	echo "</script>";
?>