<?
include("session.php");
include("tiempo.php");

$subSeccion    = $_GET['subSeccion'];
$contieneHijos = $_SESSION['USUARIO_CONTIENEHIJOS'];
$tipoUnidad	   = $_SESSION['USUARIO_TIPOUNIDAD'];
$codPerfil	 	 = $_SESSION['USUARIO_CODIGOPERFIL_PADRE'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="./js/creaObjeto.js"></script>   
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/funcionarios.js?v=1.1"></script>  
<script type="text/javascript" src="./js/usuario.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css" />
<link href="./ventana/css/debug.css" 		rel="stylesheet" type="text/css" />
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css" />
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<input type="hidden" value="<?echo $unidadBloqueada?>" id="textUnidadBloqueada" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" id="textFechaLimite" name="textFechaLimite"/>
	<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">PERSONAL</div>
		<div id="subtitulo">En esta lista se encuentra el personal <? if($subSeccion=='agregados') echo "agregados"; else echo "asignados"; ?> a esta <? if ($tipoUnidad==30) echo "Prefectura."; else echo "Unidad."; ?></div>
		<div style="height:68px"></div>
		<table width="100%">   
	    <tr> 
	      <td width="25%">
	      	<input type="button" name="btnNueva" id="btn100" value="AGREGAR FUNCIONARIO" onClick="javascript:abrirVentana('AGREGAR FUNCIONARIO ... ', '800', '400','fichaPersonal.php','','','5','5')" <? if($subSeccion=='agregados' || $subSeccion=='destinados' || $codPerfil==70 || $codPerfil==80 || $codPerfil == 90 || $codPerfil == 100  || $codPerfil == 110 || $codPerfil == 120 || $codPerfil == 130 || $codPerfil == 140 || $codPerfil == 150 || $codPerfil == 160 || $codPerfil == 180) echo "disabled"; ?>>
	      </td>
		  <td width="15%"align="right">NOMBRE&nbsp;:&nbsp;</td>
		  <td width="30%"><input id="textBuscar" type="text" ></td>
		  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="<? if($subSeccion=='agregados') echo "leeFuncionariosA('".$unidadUsuario."','','')"; else echo "leeFuncionarios('".$unidadUsuario."','','')"; ?>" ></td>
		  <td width="20%">&nbsp;</td>
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
					echo "<td id='colCodigo' 	class='nombreColumna' width='10%' align='center'  onmousedown=cambiaOrdenLista(this,'codigo','desc','".$unidadUsuario."')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' 	class='nombreColumna' width='25%' align='center'  onmousedown=cambiaOrdenLista(this,'nombre','desc','".$unidadUsuario."')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado'  	class='nombreColumna' width='13%' align='center'  onmousedown=cambiaOrdenLista(this,'grado','desc','".$unidadUsuario."')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colSeccion' class='nombreColumna' width='13%' align='center'  onmousedown=cambiaOrdenLista(this,'seccion','desc','".$unidadUsuario."')><label id='labColSeccion'>SECCION</label></td>";
					echo "<td id='colGrupo'  	class='nombreColumna' width='15%' align='center'  onmousedown=cambiaOrdenLista(this,'grupo','desc','".$unidadUsuario."')><label id='labColGrupo'>GRUPO</label></td>";
					echo "<td id='colCargo'  	class='nombreColumna' width='20%' align='center'  onmousedown=cambiaOrdenLista(this,'cargo','desc','".$unidadUsuario."')><label id='labColCargo'>CARGO</label></td>";
				}
				elseif($subSeccion=='agregados'){
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colCodigo' 	class='nombreColumna' width='16%' align='center'  onmousedown=cambiaOrdenLista(this,'codigo','desc','".$unidadUsuario."')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' 	class='nombreColumna' width='30%' align='center'  onmousedown=cambiaOrdenLista(this,'nombre','desc','".$unidadUsuario."')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado'  	class='nombreColumna' width='20%' align='center'  onmousedown=cambiaOrdenLista(this,'grado','desc','".$unidadUsuario."')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colUnidad'  class='nombreColumna' width='30%' align='center'  onmousedown=cambiaOrdenLista(this,'unidad','desc','".$unidadUsuario."')><label id='labColUnidad'>UNIDAD ORIGEN</label></td>";
			
			}elseif($subSeccion=='destinados'){
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colCodigo' 	class='nombreColumna' width='16%' align='center'  onmousedown=cambiaOrdenLista(this,'codigo','desc','".$unidadUsuario."')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' 	class='nombreColumna' width='30%' align='center'  onmousedown=cambiaOrdenLista(this,'nombre','desc','".$unidadUsuario."')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado'  	class='nombreColumna' width='20%' align='center'  onmousedown=cambiaOrdenLista(this,'grado','desc','".$unidadUsuario."')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colUnidad'  class='nombreColumna' width='30%' align='center'  onmousedown=cambiaOrdenLista(this,'unidad','desc','".$unidadUsuario."')><label id='labColUnidad'>UNIDAD ORIGEN</label></td>";
				}
				else{
		      echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colCodigo' 	class='nombreColumna' width='10%' align='center'  onmousedown=cambiaOrdenLista(this,'codigo','desc','".$unidadUsuario."')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' 	class='nombreColumna' width='34%' align='center'  onmousedown=cambiaOrdenLista(this,'nombre','desc','".$unidadUsuario."')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado'  	class='nombreColumna' width='16%' align='center'  onmousedown=cambiaOrdenLista(this,'grado','desc','".$unidadUsuario."')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colGrupo'  	class='nombreColumna' width='15%' align='center'  onmousedown=cambiaOrdenLista(this,'grupo','desc','".$unidadUsuario."')><label id='labColGrupo'>GRUPO</label></td>";
					echo "<td id='colCargo'  	class='nombreColumna' width='21%' align='center'  onmousedown=cambiaOrdenLista(this,'cargo','desc','".$unidadUsuario."')><label id='labColCargo'>CARGO</label></td>";
				}
			?>
			</tr>
		  </table>
		  </div>
		<div id="listadoFuncionarios"></div>
		</div>
	<div style="height:2px"></div>
		<table width="100%"><tr class="linea"><td></td></tr></table>
	</div>
</body>
</html>

<?
	echo "<script>";
	if($subSeccion=='agregados') echo "leeFuncionariosA('".$unidadUsuario."','','');";
		else if($subSeccion=='destinados') echo "leeFuncionariosD('".$unidadUsuario."','','');";
	else echo "leeFuncionarios('".$unidadUsuario."','','');";
	
	echo "</script>";
?>