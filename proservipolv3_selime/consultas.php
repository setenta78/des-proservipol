<?include("session.php")?>
<?include("tiempo.php")?>
<?//include("perfil.php")?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/consultas.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="./js/creaObjeto.js"></script>   
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/usuario.js"></script>  
<script type="text/javascript" src="./js/funcionarios.js"></script>
<script type="text/javascript" src="./js/vehiculos.js"></script>
<script type="text/javascript" src="./js/servicios.js"></script>
<script type="text/javascript" src="./js/tipoServicio.js"></script>
<script type="text/javascript" src="./js/consultas.js"></script>
<script type="text/javascript" src="./js/numero.js"></script>
<script type="text/javascript" src="./js/horaFecha.js"></script>

<script type="text/javascript" src="./calendario/popcalendar.js"></script>  

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>

</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<?include("header.php")?>
	<div style="margin-left:10px; margin-right:10px; margin-top:1px;">
		<div style="height:45px"></div>
		<table width="100%">   
		    <tr> 
		      <td width="30%" style="padding:0px 5px 0px 0px;">
		      	<fieldset id="cuadro2" style="width:97%">
		        	<legend>Tipo de Consulta </legend>
		        	<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="50%"><input  checked="yes" type="radio" name="rbTipoConculta"  id="rbTipoConculta" value="1" onClick="listaFuncionarios('<? echo $unidadUsuario?>', 'selFiltroBusqueda', false, 'nombre', 'ASC')">Por Funcionario</td>
						<td width="50%"><input  disabled="yes" type="radio" name="rbTipoConculta"  id="rbTipoConculta" value="4">Por Arma</td>
					</tr>
					<tr>
						<td><input type="radio" name="rbTipoConculta"  id="rbTipoConculta" value="2" onClick="listaVehiculos('<? echo $unidadUsuario?>', 'selFiltroBusqueda', false, 'nombre', 'ASC')">Por Vehiculo</td>
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
						<td width="5%" align="center" style="padding:0px 2px 0px 0px;"><input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaDesde, textFechaDesde,'dd-mm-yyyy','-1','-1')"></td>
						<td width="30%"><input id="textFechaHasta" type="text" readonly="yes"></td>
						<td width="5%" align="center" style="padding:0px 2px 0px 0px;"><input name="" type="image" src="./img/calendarIconVerde.gif" width="15" height="13" onClick="popUpCalendar(textFechaHasta, textFechaHasta,'dd-mm-yyyy','-1','-1')"></td>
						<td width="30%"></td>
					</tr>
					<tr>
						<td colspan="4">
							<select id="selFiltroBusqueda">
                			</select> 
						</td>
						<td></td>
					</tr>
					<tr >
					<td colspan="4" style="padding:1px 0px 0px 0px;">
							<select id="selFiltroServicio">
                			</select> 
					</td>
						<td style="padding:0px 0px 0px 5px;"><input id="btn100" type="button" name="btnBuscar" value="BUSCAR" onClick="realizarConsulta()"></td>
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
			          <td id="nombreColumna" width="55%" align="center">SERVICIO</td>
			          <td id="nombreColumna" width="25%" align="center">HORARIO</td>
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
	//echo "listaVehiculos('".$unidadUsuario."', 'selFiltroBusqueda', false, 'nombre', 'ASC');";
	echo "leeTipoServicios('selFiltroServicio',false);\n";
	echo "</script>";
?>
