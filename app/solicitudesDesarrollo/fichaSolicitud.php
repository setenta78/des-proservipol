<?include("session.php")?>   
<?include("tiempo.php")?>
<?
  $fechaSolicitud       = date("d-m-Y");
	$codigoFuncionario 		= $_GET["codigoFuncionario"];
	$unidadUsuario	   		= $_SESSION['USUARIO_CODIGOUNIDAD']; 
	$tienePlanCuadrante		= $_SESSION['USUARIO_UNIDADPLANCUADRANTE'];
	$unidadEspecialidad		= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];
	$unidadPadre		    	= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
	$tipoUnidad			      = $_SESSION['USUARIO_TIPOUNIDAD']; //Variable de sesion añadida el 14-09-2015
	$contieneHijos        = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de sesion añadida el 17-04-2015
	$usuario              = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
	$solicitud            = $_GET["codigo"];
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
<script type="text/javascript" src="./js/tipoServicio.js"></script>
<script type="text/javascript" src="./js/tipoServicioExtraordinario.js"></script>
<script type="text/javascript" src="./js/fichaServicio.js"></script>


<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./css/fichaServicio.css" rel="stylesheet" type="text/css">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">


</head>
<body style="margin-top:10; margin-left:10; background-color:#f0f6ef" scroll="no" onload="javascript:leeProblema('cboProblema');leeSubproblemas('','cboSubproblema')">
<input id="idFuncionario"  type="hidden" readonly="yes">
<input id="unidadUsuario"  type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="usuario"  type="hidden" readonly="yes" value="<?echo $usuario?>">
<input id="ultimaFecha" type="hidden" readonly="yes">
<input id="tipoUnidad"  type="hidden" readonly="yes" value="<?echo $tipoUnidad?>"><!--Variable oculta añadida el 14-09-2015-->
<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!--Variable oculta añadida el 17-04-2015-->
<input type="hidden" id="tienePlanCuadrante" value="<?echo $tienePlanCuadrante?>">
<input type="hidden" id="codigo" value="">
<input type="hidden" id="codigoSolicitud" value="<?echo $solicitud?>">
<input type="hidden" id="fSolicitud" value="<?echo $fechaSolicitud?>">
<input type="hidden" id="codigoMovimiento" value="1">
<input type="hidden" id="movimiento" value="2">
<input type="hidden" id="resp" value="Enviando ....">
<input type="hidden" id="idFechaServicio">



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
<td><b>PROBLEMA</b></td>	
<td><select id="cboProblema" onChange="leeSubproblemas(this[this.selectedIndex].value,'cboSubProblema')">
</select></td>	
</tr>
<tr>
<td><b>SUB-PROBLEMA</b></td>
<td><select id="cboSubProblema" onChange="hijomenor345();identificador();hijomenor666();hijomenor346();hijomenor347();">
</select></td>	
</tr>
</table>	
<div id="ide1" style="display:none;">
<table border="0">
<tr>
<td align="center"><label id="ident1"></lab></td>	
<td align="center"><label id="ident2"></lab></td>
</tr>	
<tr>
<td><input type="text" id="textUnidad"/></td>	
<td><input type="text" id="textDia"/></td>
<td><div id="idFec" style="display:none;"><input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia, textDia,'dd-mm-yyyy','250','38')"></div></td>
</tr>	
</table>	
</div>
<div id="tipoServicio" style="display:none;">
			    <table cellpadding="1" cellspacing="0" width="100%" border="0">
			    <tr>
			    <td align="center">DIA</td>	
			    <td align="center">TIPO SERVICIO</td>	
			    </tr>	
			    <tr> 
				   <td width="24%"><input type="text" id="textDia2"/>&nbsp;<input id="imagenCalendarioFichaFuncionario" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textDia2, textDia2,'dd-mm-yyyy','250','38')"></td>
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
				   <td width="2%"><input name="idFechaServicio" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaServicio, textFechaServicio,'dd-mm-yyyy','300','-1');"></td>
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
<div id="tipoAnimal" style="display:none;">
<table border="0">
<tr>
<td align="center"><label id="ident5"></lab></td>	
<td align="center"><label id="ident6"></lab></td>
</tr>	
<tr>
<td><input type="text" id="textTipoAnimal"/></td>	
<td><select id="tipoDeAnimal">
  <option value="0">SELECCIONE OPCION ...</option> 
  <option value="CABALLO">CABALLO</option>
  <option value="PERRO POLICIAL">PERRO POLICIAL</option>
</select></td>
<td></td>
</tr>	
</table>	
</div>
<table border="0">
<tr>
<td><b>OBSERVACION</b></td>
</tr>	
<tr>
<td><textarea name="obs" id="obs" rows="4" cols="50"></textarea></td>		
<td style="display:none;"><select id="cboMovimiento"></select></td>
</tr>
</table>
<br>
</fieldset>
</div>	
</div>
<br>
<table width="95%">
<td width="10%">&nbsp;</td>
<td width="10%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="GUARDAR COMO PENDIENTE" onClick="guardarFichaCaballo5();"></td>
<td width="10%"><input name="btnGuardarOrganizacion" type="button" id="btn100" value="ENVIAR SOLICITUD" onClick="guardarFichaCaballo();"></td>
<td width="10%"><input name="btnCerrarFichaFuncionario" type="button" id="btn100" value="CERRAR" onClick="top.cerrarVentana();"></td>	
</tr>	
</table>
</body>
</html>
<?
	echo "<script>";
	echo "leedatosUsuario(".$unidadUsuario.",'".$usuario."');";
	//echo "leedatosSolicitudUnidad('".$unidadUsuario."','".$codigo."');";
	echo "</script>";
?>