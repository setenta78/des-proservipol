<?
include("version.php");
include("session.php");
include("tiempo.php");
$tipoUnidadNew			= ($_SESSION['USUARIO_TIPO_UNIDAD']=='') ? 'null' : $_SESSION['USUARIO_TIPO_UNIDAD'];
$especialidadUnidadNew	= ($_SESSION['USUARIO_ESPECIALIDAD_UNIDAD']=='') ? 'null' : $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
<title></title>
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/consultas.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>  
<script type="text/javascript" src="./js/funcionarios.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/vehiculos.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/armas.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/consultas.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/numero.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<script type="text/javascript" src="./calendario/dhtmlgoodies_calendar.js"></script>
<link href="./calendario/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css">
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
<div id="cubreFondo" style="display:none;"></div>
<input id="unidadUsuario"	type="hidden" readonly="yes" value="<?echo $unidadUsuario?>">
<input id="tipoUnidadNew" value="<? echo $tipoUnidadNew; ?>" type="hidden" readonly="yes" />
<input id="especialidadUnidadNew" value="<? echo $especialidadUnidadNew; ?>" type="hidden" readonly="yes" />
<div style="margin-left:10px; margin-right:10px; margin-top:1px;">
<br><div id="titulo">CONSULTAS</div>
<div id="subtitulo">Puede utilizar los distintos criterios de consulta para ver los servicios que se realizaron.</div>
<div style="height:5px"></div>
	<table width="100%">
    <tr> 
      <td width="30%" style="padding:0px 5px 0px 0px;">
      	<fieldset id="cuadro2" style="width:97%">
       	<legend>Tipo de Consulta </legend>
       	<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="50%"><input  checked="yes" type="radio" name="rbTipoConculta"  id="rbTipoConculta" value="1" onClick="listaFuncionarios('<? echo $unidadUsuario?>', 'selFiltroBusqueda', false, 'nombre', 'ASC')">Por Funcionario</td>
						<td width="50%"><input  type="radio" name="rbTipoConculta"  id="rbTipoConculta" value="4" onClick="listaArmas('<? echo $unidadUsuario?>', 'selFiltroBusqueda', false, 'serie', 'ASC')">Por Arma</td>
					</tr>
					<tr>
						<td><input type="radio" name="rbTipoConculta"  id="rbTipoConculta" value="2" onClick="listaVehiculos('<? echo $unidadUsuario?>', 'selFiltroBusqueda', false, 'patente', 'ASC')">Por Vehiculo</td>
						<td><input type="radio" disabled="yes" name="rbTipoConculta"  id="rbTipoConculta" value="5">Por Tipo Animal</td>
					</tr>
					<tr>
						<td><input type="radio" disabled="yes" name="rbTipoConculta"  id="rbTipoConculta" value="3">Por Cuadrante</td>
						<td><input type="radio" disabled="yes" name="rbTipoConculta"  id="rbTipoConculta" value="6">Por Tipo Accesorio</td>
					</tr>
				</table>
        </fieldset>
      </td>		
	  	<td width="70%" valign="baseline" style="padding:0px 0px 2px 3px;">
		  	<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td colspan="2" width="50%">DESDE :</td>
						<td colspan="3" width="50%">HASTA :</td>
					</tr>
					<tr>
						<td width="30%"><input id="textFechaDesde" type="text" readonly="yes"></td>
						<td width="5%" align="center" style="padding:0px 2px 0px 0px;"><input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaDesde,'dd-mm-yyyy',this,0,0)"></td>
						<td width="30%"><input id="textFechaHasta" type="text" readonly="yes"></td>
						<td width="5%" align="center" style="padding:0px 2px 0px 0px;"><input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="displayCalendar(textFechaHasta,'dd-mm-yyyy',this,0,0)"></td>
						<td width="30%"></td>
					</tr>
					<tr>
						<td colspan="4"><select id="selFiltroBusqueda"></select></td>
						<td></td>
					</tr>
					<tr>
					<td colspan="4" style="padding:1px 0px 0px 0px;">
					</td>
						<td style="padding:0px 0px 0px 5px;"><input id="btnBuscar" type="button" name="btnBuscar" value="BUSCAR" onClick="realizarConsulta()"></td>
					</tr>
				</table>
	  	</td>
		</tr>
	</table>
<table width="100%"><tr class="linea"><td></td></tr></table>
	<div style="height:2px"></div>
	<div id="listado" style="height:360px;">
		<div id="cabeceraGrilla">
		<table cellspacing="1" cellpadding="1" width="100%">
      <tr> 
        <td id="nombreColumna" width="5%" align="center">No.</td>
        <td id="nombreColumna" width="15%" align="center">FECHA</td>
        <td id="nombreColumna" width="35%" align="center">SERVICIO</td>
        <td id="nombreColumna" width="25%" align="center">HORARIO</td>
        <td id="nombreColumna" width="20%" align="center">UNIDAD</td>
      </tr>
	  </table>
	  </div>
		<div id="listadoServicios"></div>
	</div>
	<div style="height:2px"></div>
	<table width="100%"><tr class="linea"><td></td></tr></table>
</div>
</body>
</html>
<?
	echo "<script>";
	echo "listaFuncionarios('".$unidadUsuario."', 'selFiltroBusqueda', false, 'nombre', 'ASC');";
	echo "</script>";
?>