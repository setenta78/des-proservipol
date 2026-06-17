<?
include("version.php");
include("session.php");
include("tiempo.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr" >
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
<div id="cubreFondo" style="display:none;"></div>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
	<div id="titulo"> CERTIFICADOS DE CAPACITACI&Oacute;N DE USUARIO AL CURSO PROSERVIPOL </div>
	<div id="subtitulo">Aplicativo ver certificados de aprobaci&oacute;n del curso proservipol, y revisar las capacitaciones realizadas por el personal.</div>
	<div style="height:30px"></div>
	<table width="100%">
	    <tr>
		  <td width="15%" align="right">CODIGO FUNCIONARIO&nbsp;:&nbsp;</td>
		  <td width="30%"><input id="textCodFuncionario" name="textCodFuncionario" type="text" style="text-transform:uppercase" /></td>
		  <td width="55%" >&nbsp;</td>
	    </tr>
		</table>
	<div style="height:15px"></div>
	<div id="listadoFuncionariosCapacitados" style="list-style-type:none;position:relative;left:50px;width:45%;" ></div>
	<div style="height:2px"></div>
	<div id="listado" style="visibility: collapse;" >
	<div id="cabeceraGrilla">
	<table cellspacing="1" cellpadding="1" width="100%">
    <tr>
      <td id="nombreColumna" width="5%" align="center">No.</td>
      <td id="colCapacitacion" class="nombreColumna" width="35%" align="center" ><label id="labColCapacitacion">CAPACITACI&Oacute;N</label></td>
      <td id="colFecha" class="nombreColumna" width="20%" align="center" ><label id="labColFecha">FECHA</label></td>
      <td id="colNota" class="nombreColumna" width="10%" align="center" ><label id="labColNota">NOTA</label></td>
      <td id="colCodVerificacion" class="nombreColumna" width="20%" align="center" ><label id="labColCodVerificacion">CODIGO VERIFICACI&Oacute;N</label></td>
      <td id="colCertificado" class="nombreColumna" width="10%" align="center" ><label id="labColCertificacion">CERTIFICADO</label></td>
    </tr>
	</table>
	</div>
	
	<div id="listadoCapacitaciones" ></div>
	</div>
</div>
<? include("fichaClaveUsuario.php"); ?>
</body>
</html>
<?
if($codigoPerfilOrigen!=90){
	session_unset();
	session_destroy();
	echo '<script type="text/javascript">alert("Acceso Restringido"); window.location.href="index.php";</script>';
}
?>
<script type="text/javascript" src="./js/certificadoCurso.js?v=<?echo version?>"></script>