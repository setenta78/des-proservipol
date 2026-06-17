<?include("session.php")?>
<?include("tiempo.php")?>
<?//include("perfil.php")?>
<?
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS']; //Variable de session añadida el 17-04-2015
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
<script type="text/javascript" src="./js/funcionarios.js"></script>  
<script type="text/javascript" src="./js/usuario.js"></script>

<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 		rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 		rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>

</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<?include("header.php")?>
	<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite"/>
	<input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!-- Variable agregada el 29-04-2015 -->
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">PERSONAL</div>
		<div id="subtitulo">En esta lista se encuentra el personal agregado a esta Unidad.<a href="#"></a></div>
		<div style="height:90px"></div>
		<table width="100%">   
		    <tr> 
		      <td width="25%">
		      		<input type="button" name="btnNuevaReunion" id="btn100" value="AGREGAR FUNCIONARIO" disabled onClick="javascript:abrirVentana('AGREGAR FUNCIONARIO ... ', '800', '350','fichaPersonal.php','','','5','5')">
		      </td>		
			  <td width="15%"align="right">NOMBRE&nbsp;:&nbsp;</td>
			  <td width="30%"><input id="textBuscar" type="text"></td>
			  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeFuncionariosA('<? echo $unidadUsuario ?>','','');"></td>
			  <td width="20%"><input type="button" id="btn100" value="BUSQUEDA AVANZADA >>>" disabled></td>
		    </tr>
		</table>
		<div style="height:2px"></div>
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>
		<div id="listado">
			<div id="cabeceraGrilla">
			<table cellspacing="1" cellpadding="1" width="100%">
		        <tr> 
		          <td id="nombreColumna" width="4%" align="center">No.</td>
		          <td id="colCodigo" class="nombreColumna" width="10%" align="center"  onmousedown="cambiaOrdenLista(this,'codigo','desc','<?echo $unidadUsuario?>')"><label id="labColCodigo">CODIGO</label></td>
		          <td id="colNombre" class="nombreColumna" width="38%" align="center"  onmousedown="cambiaOrdenLista(this,'nombre','desc','<?echo $unidadUsuario?>')"><label id="labColNombre">NOMBRE</label></td>
		          <td id="colGrado"  class="nombreColumna" width="15%" align="center"  onmousedown="cambiaOrdenLista(this,'grado','desc','<?echo $unidadUsuario?>')"><label id="labColGrado">GRADO</label></td>
		          <td id="colCargo"  class="nombreColumna" width="15%" align="center"  onmousedown="cambiaOrdenLista(this,'cargo','desc','<?echo $unidadUsuario?>')"><label id="labColCargo">CARGO</label></td>
				  <td id="colCargo"  class="nombreColumna" width="19%" align="center"  onmousedown="cambiaOrdenLista(this,'cargo','desc','<?echo $unidadUsuario?>')"><label id="labColCargo">UNIDAD ORIGEN</label></td>
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
	echo "leeFuncionariosA('".$unidadUsuario."','','');";
	echo "</script>";
?>