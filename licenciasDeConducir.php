<?
include("version.php");
include("session.php");
include("tiempo.php");
include("proteccion.php");
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS'];
$tipoUnidad	    = $_SESSION['USUARIO_TIPOUNIDAD'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>   
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/funcionarios.js?v=<?echo version?>"></script>  
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/licenciaConducir.js?v=<?echo version?>"></script>   
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite"/>
	<div id="cubreFondo" style="display:none;"></div>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">LICENCIAS DE CONDUCIR</div>
		<div id="subtitulo">En esta lista se encuentra el personal asignado a esta <? if ($tipoUnidad==30) echo "Prefectura"; else echo "Unidad"; ?>, con y sin Licencias de Conducir.</div>
		<div style="height:68px"></div>
		<table width="100%">   
    <tr> 
	    <td width="25%"></td>		
		  <td width="15%"align="right"></td>
		  <td width="30%"></td>
		  <td width="10%"></td>
		  <td width="20%"></td>
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
        <td id="colCodigo" 			class="nombreColumna" width="10%" align="center"  onmousedown="cambiaOrdenListaLicenciaConducir(this,'codigo','desc','<?echo $unidadUsuario?>')"><label id="labColCodigo">CODIGO</label></td>
        <td id="colNombre" 			class="nombreColumna" width="38%" align="center"  onmousedown="cambiaOrdenListaLicenciaConducir(this,'nombre','desc','<?echo $unidadUsuario?>')"><label id="labColNombre">NOMBRE</label></td>
        <td id="colGrado"  			class="nombreColumna" width="16%" align="center"  onmousedown="cambiaOrdenListaLicenciaConducir(this,'grado','desc','<?echo $unidadUsuario?>')"><label id="labColGrado">GRADO</label></td>
        <td id="colLicenciaMunicipal" class="nombreColumna" width="13%" align="center"  onmousedown="cambiaOrdenListaLicenciaConducir(this,'licenciaMunicipal','desc','<?echo $unidadUsuario?>')"><label id="labColLicenciaMunicipal">MUNICIPAL</label></td>
        <td id="colLicenciaSemep"     class="nombreColumna" width="13%" align="center"  onmousedown="cambiaOrdenListaLicenciaConducir(this,'licenciaSemep','desc','<?echo $unidadUsuario?>')"><label id="labColLicenciaSemep">SEMEP</label></td>
        <td id="colArchivo"     class="nombreColumna" width="6%" align="center"  onmousedown="cambiaOrdenListaLicenciaConducir(this,'archivo','desc','<?echo $unidadUsuario?>')"><label id="labColArchivo">ARCHIVO</label></td>
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
	echo "leeFuncionariosLicenciasConducir('".$unidadUsuario."','','');";
	echo "</script>";
?>