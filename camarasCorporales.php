<?
include("version.php");
include("session.php");
include("tiempo.php");
include("proteccion.php");
$fecha=date("Y-m-d");
$subMenu			= $_GET['subSeccion'];
$codPerfil			= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$tipoUnidad	    	= $_SESSION['USUARIO_TIPOUNIDAD'];
$unidadUsuario	   	= $_SESSION['USUARIO_CODIGOUNIDAD'];
$unidadPadre		= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$permisoRegistrar	= ($_SESSION['PERMISO_REGISTRAR']==1);
if ($tipoUnidad==30) $tipoDeUnidad="Prefectura."; else $tipoDeUnidad="Unidad.";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ES" lang="ES" dir="ltr" translate="no">
<head>
<title>PROSERVIPOL - Programaci&oacute;n de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/unidades.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/marcaCamara.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/modeloCamara.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/estadoRecurso.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/procedenciaCamara.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/horaFecha.js?v=<?echo version?>"></script>
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
<body onresize="actualizarTamanoLista('listado');">
	<input type="hidden" value="<?echo $unidadBloqueada?>" id="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $unidadUsuario?>" id="unidadUsuario"/>
	<input type="hidden" value="<?echo $unidadPadre?>" id="unidadPadre"/>
	<input type="hidden" value="<?echo $fecha?>" id="fecha"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite" id="textFechaLimite"/>
	<input type="hidden" value="" name="textFechaTermino" id="textFechaTermino"/>
	<input type="hidden" id="subMenu" value="<? echo $subMenu; ?>"/>
	<div id="cubreFondo" style="display:none;"></div>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
	<div id="titulo"><? if($subMenu=='agregados') echo "C&Aacute;MARAS CORPORALES AGREGADAS"; else echo "C&Aacute;MARAS CORPORALES"; ?></div>
	<div id="subtitulo"><? if($subMenu=='agregados') echo "En esta lista se encuentran las C&aacute;maras Corporales agregadas a esta ".$tipoDeUnidad; else echo "En esta lista se encuentran las C&aacute;maras Corporales asignadas a esta ".$tipoDeUnidad;  ?></div>
	<div style="height:68px"></div>
	<table width="100%">
	  <tr> 
	    <td width="25%"><input type="button" name="btnNuevaCamara" id="btn100" value="AGREGAR C&Aacute;MARA CORPORAL" onClick="fichaCamarasCorporales.className='fichaActiva'" <? if($subMenu=='agregados' || !$permisoRegistrar) echo "disabled";?>></td>
	  	<td width="20%" >&nbsp;</td>
		<td width="15%" align="right">Nro Serie&nbsp;:&nbsp;</td>
		<td width="30%"><input id="textBuscar" type="text" ></td>
	  	<td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeCamaras('<? echo $unidadUsuario ?>','','');"></td>
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
      <td id="colCodigoEquipo"	class="nombreColumna" width="15%" align="center"  onmousedown="cambiaOrdenLista('codigo','ASC')"><label id="labColCodigoEquipo">CODIGO EQUIPO</label></td>
      <td id="colMarca"			class="nombreColumna" width="15%" align="center"  onmousedown="cambiaOrdenLista('marca','ASC')"><label id="labColMarca">MARCA</label></td>
      <td id="colModelo"		class="nombreColumna" width="15%" align="center"  onmousedown="cambiaOrdenLista('modelo','ASC')"><label id="labColModelo">MODELO</label></td>
      <td id="colNroSerie"		class="nombreColumna" width="15%" align="center"  onmousedown="cambiaOrdenLista('nroserie','ASC')"><label id="labColNroSerie">NRO SERIE</label></td>
      <td id="colEstado"		class="nombreColumna" width="18%" align="center"  onmousedown="cambiaOrdenLista('estado','ASC')"><label id="labColEstado">ESTADO</label></td>
    </tr>
	</table>
	</div>
	<div id="listadoCamarasCorporales"></div>
	</div>
	<div style="height:2px"></div>
		<table width="100%"><tr class="linea"><td></td></tr></table>
	</div>
<? include("fichaCamaraCorporal.php"); ?>
</body>
</html>
<script type="text/javascript" src="./js/camarasCorporales.js?v=<?echo version?>"></script>
<script src=".\axios\dist\axios.js"></script>