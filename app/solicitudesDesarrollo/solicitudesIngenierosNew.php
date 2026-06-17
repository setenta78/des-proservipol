<?php include("session.php"); ?>
<?php include("tiempo.php"); ?>
<?php //include("perfil.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
	<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
	<link href="./css/fichaPersonal.css" rel="stylesheet" type="text/css">
	<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">
	<script src="./js/creaObjeto.js" type="text/javascript"></script>
	<script src="./js/aplicacion.js" type="text/javascript"></script>
	<script src="./js/requerimiento.js" type="text/javascript"></script>
	<script src="./js/usuario.js" type="text/javascript"></script>
	<script src="./ventana/js/prototype.js" type="text/javascript"></script>
	<script src="./ventana/js/window.js" type="text/javascript"></script>
	<script src="./ventana/js/effects.js" type="text/javascript"></script>
	<script src="./ventana/js/window_effects.js" type="text/javascript"></script>
	<script src="./ventana/js/debug.js" type="text/javascript"></script>
	<link href="./ventana/css/default.css" rel="stylesheet" type="text/css">
	<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css">
	<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css">
</head>

<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<?php include("header.php"); ?>
	<input type="hidden" value="<?php echo $unidadBloqueada; ?>" name="textUnidadBloqueada" />
	<input type="hidden" value="<?php echo $fechaLimite; ?>" name="textFechaLimite" />
	<input type="hidden" value="<?php echo $codigoFuncionarioUsuario; ?>" name="usuario" />

	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">SOLICITUDES</div>
		<div id="subtitulo">Listado de solicitudes de requerimientos realizadas por las Unidades.</div>
		<div style="height:90px"></div>
		<table width="100%">
			<tr>
				<td width="20%">
					<input type="button" name="btnNuevaReunion" id="btn100" value="AGREGAR SOLICITUD" onClick="abrirVentana('AGREGAR SOLICITUD ... ', '720', '575','fichaSolicitud.php','','','5','5')" disabled>
				</td>
				<td width="15%" align="right">SOLICITUD&nbsp;:&nbsp;</td>
				<td width="30%"><input id="textBuscar" type="text"></td>
				<td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeFuncionarios('<?php echo $unidadUsuario; ?>','','');" disabled></td>
				<td width="20%"><input type="button" id="btn100" value="BUSQUEDA AVANZADA >>>" disabled></td>
			</tr>
		</table>
		<div style="height:2px"></div>
		<table width="100%">
			<tr class="linea">
				<td></td>
			</tr>
		</table>
		<div style="height:2px"></div>
		<div id="listado">
			<div id="cabeceraGrilla">
				<table cellspacing="1" cellpadding="1" width="100%">
					<tr>
						<td id="nombreColumna" width="4%" align="center">No.</td>
						<td id="colNombre" class="nombreColumna" width="9%" align="center" onmousedown="cambiaOrdenLista(this,'nombre','desc','<?php echo $unidadUsuario; ?>')"><label id="labColNombre">UNIDAD</label></td>
						<td id="colCodigo" class="nombreColumna" width="8%" align="center" onmousedown="cambiaOrdenLista(this,'codigo','desc','<?php echo $unidadUsuario; ?>')"><label id="labColCodigo">REQUERIMIENTO MODULO</label></td>
						<td id="colNombre" class="nombreColumna" width="10%" align="center" onmousedown="cambiaOrdenLista(this,'nombre','desc','<?php echo $unidadUsuario; ?>')"><label id="labColNombre">GRUPO</label></td>
						<td id="colGrado" class="nombreColumna" width="4%" align="center" onmousedown="cambiaOrdenLista(this,'grado','desc','<?php echo $unidadUsuario; ?>')"><label id="labColGrado">No. SOLICITUD</label></td>
						<td id="colGrado" class="nombreColumna" width="8%" align="center" onmousedown="cambiaOrdenLista(this,'grado','desc','<?php echo $unidadUsuario; ?>')"><label id="labColGrado">FECHA</label></td>
						<td id="colGrado" class="nombreColumna" width="4%" align="center" onmousedown="cambiaOrdenLista(this,'grado','desc','<?php echo $unidadUsuario; ?>')"><label id="labColGrado">No. DIAS</label></td>
						<td id="colGrado" class="nombreColumna" width="4%" align="center" onmousedown="cambiaOrdenLista(this,'grado','desc','<?php echo $unidadUsuario; ?>')"><label id="labColGrado">TRAMITE No.</label></td>
						<td id="colCargo" class="nombreColumna" width="10%" align="center" onmousedown="cambiaOrdenLista(this,'cargo','desc','<?php echo $unidadUsuario; ?>')"><label id="labColCargo">ESTADO ACTUAL</label></td>
					</tr>
				</table>
			</div>
			<div id="listadoFuncionarios"></div>
		</div>
		<div style="height:2px"></div>
		<table width="100%">
			<tr class="linea">
				<td></td>
			</tr>
		</table>
	</div>
</body>

</html>

<?php
echo "<script>";
echo "leeFuncionarios3('" . $unidadUsuario . "','','','" . $codigoFuncionarioUsuario . "');";
echo "</script>";
?>