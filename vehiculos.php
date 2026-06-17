<?
include("version.php");
include("session.php");
include("proteccion.php");
$subSeccion     = $_GET['subSeccion'];
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS'];
$tipoUnidad	    = $_SESSION['USUARIO_TIPOUNIDAD'];
$codPerfil	 	= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
<title>PROSERVIPOL - Programaci&oacute;n de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/vehiculos.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?
include("header.php");
include("tiempo.php");
?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada" id="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite" id="textFechaLimite"/>
	<input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
	<div id="cubreFondo" style="display:none;"></div>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">VEH&Iacute;CULOS</div>
		<div id="subtitulo">En esta lista se encuentran los veh&iacute;culos <? if($subSeccion=='agregados') echo "agregados"; else echo "asignados"; ?> a esta <? if ($tipoUnidad==30) echo "Prefectura."; else echo "Unidad."; ?></div>
		<div style="height:68px"></div>
		<table width="100%">
		<tr>
			<td width="25%"><input type="button" name="btnNuevaReunion" id="btn100" value="AGREGAR VEHICULO" onClick="javascript:abrirVentana('AGREGAR VEHICULO ... ', '800', '390','fichaVehiculo.php','','','5','5')" <? if($subSeccion=='agregados' || !$permisoRegistrar) echo "disabled"; ?>></td>
			<td width="20%">&nbsp;</td>
			<td width="35%"align="right">PATENTE&nbsp;:&nbsp;</td>
			<td width="10%"><input id="textBuscar" type="text" onkeypress="<? if($subSeccion=='agregados') echo "leeVehiculosA('".$unidadUsuario."','','')"; else echo "leeVehiculos('".$unidadUsuario."','','')"; ?>" ></td>
			<td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="<? if($subSeccion=='agregados') echo "leeVehiculosA('".$unidadUsuario."','','')"; else echo "leeVehiculos('".$unidadUsuario."','','')"; ?>"></td>
		</tr>
		</table>
		<div style="height:2px"></div>
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>
		<div id="listado">
			<div id="cabeceraGrilla">
			<table cellspacing="1" cellpadding="1" width="100%">
				<tr>
				<?
				if($contieneHijos==1&&$subSeccion!='agregados'){
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colTipo' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'tipo','desc','".$unidadUsuario."')><label id='labColTipo'>TIPO VEH&Iacute;CULO</label></td>";
					echo "<td id='colMarca' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'marca','desc','".$unidadUsuario."')><label id='labColMarca'>MARCA/MODELO</label></td>";
					echo "<td id='colPatente' class='nombreColumna' width='10%' align='center' onmousedown=cambiaOrdenLista(this,'patente','desc','".$unidadUsuario."')><label id='labColPatente'>PATENTE</label></td>";	
					echo "<td id='colCodigoEquipo' class='nombreColumna' width='10%' align='center' onmousedown=cambiaOrdenLista(this,'codigoEquipo','desc','".$unidadUsuario."')><label id='labColCodigoEquipo'>CODIGO EQUIPO</label></td>";
					echo "<td id='colSeccion' class='nombreColumna' width='12%' align='center' onmousedown=cambiaOrdenLista(this,'seccion','desc','".$unidadUsuario."')><label id='labColSeccion'>SECCI&Oacute;N</label></td>";
					echo "<td id='colEstado' class='nombreColumna' width='18%' align='center' onmousedown=cambiaOrdenLista(this,'estado','desc','".$unidadUsuario."')><label id='labColEstado'>ESTADO</label></td>";
					echo "<td id='colNroTarjeta' class='nombreColumna' width='8%' align='center' onmousedown=cambiaOrdenLista(this,'nroTarjeta','desc','".$unidadUsuario."')><label id='labColNroTarjeta'>TARJETA COMBUSTIBLE</label></td>";
				}
				elseif($subSeccion=='agregados'){
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colTipo' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'tipo','desc','".$unidadUsuario."')><label id='labColTipo'>TIPO VEH&Iacute;CULO</label></td>";
					echo "<td id='colMarca' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'marca','desc','".$unidadUsuario."')><label id='labColMarca'>MARCA/MODELO</label></td>";
					echo "<td id='colPatente' class='nombreColumna' width='12%' align='center' onmousedown=cambiaOrdenLista(this,'patente','desc','".$unidadUsuario."')><label id='labColPatente'>PATENTE</label></td>";	
					echo "<td id='colCodigoEquipo' class='nombreColumna' width='12%' align='center' onmousedown=cambiaOrdenLista(this,'codigoEquipo','desc','".$unidadUsuario."')><label id='labColCodigoEquipo'>CODIGO EQUIPO</label></td>";
					echo "<td id='colUnidad' class='nombreColumna' width='24%' align='center' onmousedown=cambiaOrdenLista(this,'unidad','desc','".$unidadUsuario."')><label id='labColUnidad'>UNIDAD ORIGEN</label></td>";
					echo "<td id='colNroTarjeta' class='nombreColumna' width='8%' align='center' onmousedown=cambiaOrdenLista(this,'nroTarjeta','desc','".$unidadUsuario."')><label id='labColNroTarjeta'>TARJETA COMBUSTIBLE</label></td>";
				}
				else{
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colTipo' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'tipo','desc','".$unidadUsuario."')><label id='labColTipo'>TIPO VEH&Iacute;CULO</label></td>";
					echo "<td id='colMarca' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'marca','desc','".$unidadUsuario."')><label id='labColMarca'>MARCA/MODELO</label></td>";
					echo "<td id='colPatente' class='nombreColumna' width='12%' align='center' onmousedown=cambiaOrdenLista(this,'patente','desc','".$unidadUsuario."')><label id='labColPatente'>PATENTE</label></td>";	
					echo "<td id='colCodigoEquipo' class='nombreColumna' width='12%' align='center' onmousedown=cambiaOrdenLista(this,'codigoEquipo','desc','".$unidadUsuario."')><label id='labColCodigoEquipo'>CODIGO EQUIPO</label></td>";
					echo "<td id='colEstado' class='nombreColumna' width='24%' align='center' onmousedown=cambiaOrdenLista(this,'estado','desc','".$unidadUsuario."')><label id='labColEstado'>ESTADO</label></td>";
					echo "<td id='colNroTarjeta' class='nombreColumna' width='8%' align='center' onmousedown=cambiaOrdenLista(this,'nroTarjeta','desc','".$unidadUsuario."')><label id='labColNroTarjeta'>TARJETA COMBUSTIBLE</label></td>";
				}
				?>
				</tr>
		  </table>
		  </div>
			<div id="listadoVehiculos"></div>
		</div>
			<div style="height:2px"></div>
			<table width="100%"><tr class="linea"><td></td></tr></table>
		</div>
</body>
</html>
<? 
	echo "<script>";
		if($subSeccion=='agregados') echo "leeVehiculosA('".$unidadUsuario."','','');";
		else echo "leeVehiculos('".$unidadUsuario."','','');";
	echo "</script>";
?>