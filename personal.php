<?
include("version.php");
include("session.php");
include("tiempo.php");
include("proteccion.php");
$subSeccion     	= $_GET['subSeccion'];
$contieneHijos  	= $_SESSION['USUARIO_CONTIENEHIJOS'];
$tipoUnidad	    	= $_SESSION['USUARIO_TIPOUNIDAD'];
$codPerfil	 		= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$tipoUnidadNew			= ($_SESSION['USUARIO_TIPO_UNIDAD']=='') ? 'null' : $_SESSION['USUARIO_TIPO_UNIDAD'];
$especialidadUnidadNew	= ($_SESSION['USUARIO_ESPECIALIDAD_UNIDAD']=='') ? 'null' : $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'];
if ($tipoUnidad==30) $tipoDeUnidad="Prefectura."; else $tipoDeUnidad="Unidad.";
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
<script type="text/javascript" src="./js/funcionarios.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" rel="stylesheet" type="text/css" />
<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css" />
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css" />
<?include("header.php")?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<div id="cubreFondo" style="display:none;"></div>
	<input type="hidden" value="<?echo $unidadBloqueada?>" id="textUnidadBloqueada" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" id="textFechaLimite" name="textFechaLimite"/>
	<input id="tipoUnidadNew" value="<? echo $tipoUnidadNew; ?>" type="hidden" readonly="yes" />
	<input id="especialidadUnidadNew" value="<? echo $especialidadUnidadNew; ?>" type="hidden" readonly="yes" />
	<input id="contieneHijos" type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo"><? if($subSeccion=='agregados') echo "PERSONAL AGREGADO AL CUARTEL"; elseif($subSeccion=='destinados') echo "PERSONAL DESTINADO A SERVICIOS EN ESTE CUARTEL"; else echo "PERSONAL UNIDAD"; ?></div>
		<div id="subtitulo"><? if($subSeccion=='agregados') echo "Personal que se encuentra realizando funciones en este cuartel en calidad de agregado desde su unidad de origen."; elseif($subSeccion=='destinados') echo "Personal que se encuentra realizando funciones en este cuartel en calidad de destinado a servicio en otro cuartel desde su unidad de origen."; else echo "En esta lista se encuentra el personal asignados a esta ".$tipoDeUnidad;  ?></div>
		<div style="height:68px"></div>
		<table width="100%">
	    <tr>
	      <td width="25%">
	      	<input type="button" name="btnNueva" id="btn100" value="AGREGAR FUNCIONARIO" onClick="javascript:abrirVentana('AGREGAR FUNCIONARIO ... ', '800', '400','fichaPersonal.php','','','5','5')" <? if($subSeccion=='agregados' || $subSeccion=='destinados' || !$permisoRegistrar) echo "disabled"; ?> >
	      </td>
		  <td width="20%">&nbsp;</td>
		  <td width="15%"align="right">NOMBRE&nbsp;:&nbsp;</td>
		  <td width="30%"><input id="textBuscar" type="text"></td>
		  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="<? if($subSeccion=='agregados') echo "leeFuncionariosA('".$unidadUsuario."','','')"; elseif($subSeccion=='destinados') echo "leeFuncionariosD('".$unidadUsuario."','','')"; else echo "leeFuncionarios('".$unidadUsuario."','','')"; ?>" ></td>
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
					echo "<td id='colCodigo' class='nombreColumna' width='10%' align='center' onmousedown=cambiaOrdenLista(this,'codigo','desc','{$unidadUsuario}')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' class='nombreColumna' width='25%' align='center' onmousedown=cambiaOrdenLista(this,'nombre','desc','{$unidadUsuario}')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado' class='nombreColumna' width='13%' align='center' onmousedown=cambiaOrdenLista(this,'grado','desc','{$unidadUsuario}')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colSeccion' class='nombreColumna' width='13%' align='center' onmousedown=cambiaOrdenLista(this,'seccion','desc','{$unidadUsuario}')><label id='labColSeccion'>SECCI&Oacute;N</label></td>";
					echo "<td id='colGrupo' class='nombreColumna' width='15%' align='center' onmousedown=cambiaOrdenLista(this,'grupo','desc','{$unidadUsuario}')><label id='labColGrupo'>GRUPO</label></td>";
					echo "<td id='colCargo' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'cargo','desc','{$unidadUsuario}')><label id='labColCargo'>CARGO</label></td>";
				}
				elseif($subSeccion=='agregados'){
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colCodigo' class='nombreColumna' width='16%' align='center' onmousedown=cambiaOrdenLista(this,'codigo','desc','{$unidadUsuario}')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' class='nombreColumna' width='30%' align='center' onmousedown=cambiaOrdenLista(this,'nombre','desc','{$unidadUsuario}')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenLista(this,'grado','desc','{$unidadUsuario}')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colUnidad' class='nombreColumna' width='30%' align='center' onmousedown=cambiaOrdenLista(this,'unidad','desc','{$unidadUsuario}')><label id='labColUnidad'>UNIDAD ORIGEN</label></td>";
			
			}elseif($subSeccion=='destinados'){
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colCodigo' class='nombreColumna' width='16%' align='center' onmousedown=cambiaOrdenListaD(this,'codigo','desc','{$unidadUsuario}')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' class='nombreColumna' width='30%' align='center' onmousedown=cambiaOrdenListaD(this,'nombre','desc','{$unidadUsuario}')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado' class='nombreColumna' width='20%' align='center' onmousedown=cambiaOrdenListaD(this,'grado','desc','{$unidadUsuario}')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colUnidad' class='nombreColumna' width='30%' align='center' onmousedown=cambiaOrdenListaD(this,'unidad','desc','{$unidadUsuario}')><label id='labColUnidad'>UNIDAD ORIGEN</label></td>";
				}
				else{
		      echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colCodigo' class='nombreColumna' width='10%' align='center' onmousedown=cambiaOrdenLista(this,'codigo','desc','{$unidadUsuario}')><label id='labColCodigo'>CODIGO</label></td>";
					echo "<td id='colNombre' class='nombreColumna' width='34%' align='center' onmousedown=cambiaOrdenLista(this,'nombre','desc','{$unidadUsuario}')><label id='labColNombre'>NOMBRE</label></td>";
					echo "<td id='colGrado' class='nombreColumna' width='16%' align='center' onmousedown=cambiaOrdenLista(this,'grado','desc','{$unidadUsuario}')><label id='labColGrado'>GRADO</label></td>";
					echo "<td id='colGrupo' class='nombreColumna' width='15%' align='center' onmousedown=cambiaOrdenLista(this,'grupo','desc','{$unidadUsuario}')><label id='labColGrupo'>GRUPO</label></td>";
					echo "<td id='colCargo' class='nombreColumna' width='21%' align='center' onmousedown=cambiaOrdenLista(this,'cargo','desc','{$unidadUsuario}')><label id='labColCargo'>CARGO</label></td>";
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
	if($subSeccion=='agregados') echo "leeFuncionariosA('{$unidadUsuario}','','');";
	else if($subSeccion=='destinados') echo "leeFuncionariosD('{$unidadUsuario}','','');";
	else echo "leeFuncionarios('{$unidadUsuario}','','');";
	echo "</script>";
?>