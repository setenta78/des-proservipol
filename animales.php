<?
include("version.php");
include("session.php");
include("tiempo.php");
include("proteccion.php");
$subSeccion    	= $_GET['subSeccion'];
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS'];
$tipoUnidad	    = $_SESSION['USUARIO_TIPOUNIDAD'];
$codPerfil	 	 	= $_SESSION['USUARIO_CODIGOPERFIL'];
$codPerfilOrigen	= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
<title>PROSERVIPOL - Programaci&oacuten de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion<? if(preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT']) && !preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) echo "Old"; ?>.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/fichaAnimal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/animal.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
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
<input type="hidden" value="<?echo $unidadBloqueada?>" id="textUnidadBloqueada" name="textUnidadBloqueada"/>
<input type="hidden" value="<?echo $fechaLimite?>" id="textFechaLimite" name="textFechaLimite"/>
<input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>">
<div id="cubreFondo" style="display:none;"></div>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
	<div id="titulo">ANIMALES</div>
	<div id="subtitulo">En esta lista se encuentran los Animales <? if($subSeccion=='agregados') echo "agregados"; else echo "asignados"; ?> a esta <? if ($tipoUnidad==30) echo "Prefectura."; else echo "Unidad."; ?></div>
	<div style="height:68px"></div>
	<table width="100%">
    <tr>
	    <td width="25%"><input type="button" name="btnNuevo" id="btn100" value="AGREGAR ANIMAL" onClick="javascript:abrirVentana('AGREGAR ANIMAL ... ', '800', '375','fichaAnimal.php','','','5','5')" <? if($subSeccion=='agregados' || !$permisoRegistrar) echo "disabled"; ?>></td>
		  <td width="20%" align="right" id="tituloTipoAnimal">TIPOS DE ANIMALES&nbsp;:&nbsp;</td>
		  <td width="20%"><select id="tipoAnimal" style="width:100%" onChange="eligeTipoAnimal();"><option value="" selected>TODOS LOS ANIMALES</option><option value="Caballos">CABALLOS</option><option value="Perros">PERROS</option></select></td>
		  <td width="10%" align="right">NOMBRE&nbsp;:&nbsp;</td>
		  <td width="15%"><input id="textBuscar" type="text" onKeyPress="<? if($subSeccion=='agregados') echo "leeAnimalesA('".$unidadUsuario."','','')"; else echo "leeAnimales('".$unidadUsuario."','','')"; ?>" onChange="<? if($subSeccion=='agregados') echo "leeAnimalesA('".$unidadUsuario."','','')"; else echo "leeAnimales('".$unidadUsuario."','','')"; ?>" ></td>
		  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="<? if($subSeccion=='agregados') echo "leeAnimalesA('".$unidadUsuario."','','')"; else echo "leeAnimales('".$unidadUsuario."','','')"; ?>"></td>
		  
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
					echo "<td id='colTipo'	 	class='nombreColumna' width='10%' align='center'  onmousedown=cambiaOrdenLista(this,'tipo','desc','".$unidadUsuario."')><label id='labColTipo'>TIPO</label></td>";
					echo "<td id='colNombre' 	class='nombreColumna' width='25%' align='center'  onmousedown=cambiaOrdenLista(this,'nombre','desc','".$unidadUsuario."')><label id='labColNombre'>NOMBRE DEL ANIMAL</label></td>";
					echo "<td id='colColor'  	class='nombreColumna' width='15%' align='center'  onmousedown=cambiaOrdenLista(this,'color','desc','".$unidadUsuario."')><label id='labColColor'>RAZA/COLOR</label></td>";
					echo "<td id='colBcu'	  	class='nombreColumna' width='13%' align='center'  onmousedown=cambiaOrdenLista(this,'BCU','desc','".$unidadUsuario."')><label id='labColBCU'>NRO. BCU</label></td>";
					echo "<td id='colSeccion' class='nombreColumna' width='15%' align='center'  onmousedown=cambiaOrdenLista(this,'seccion','desc','".$unidadUsuario."')><label id='labColSeccion'>SECCION</label></td>";
					echo "<td id='colEstado' 	class='nombreColumna' width='18%' align='center'  onmousedown=cambiaOrdenLista(this,'estado','desc','".$unidadUsuario."')><label id='labColEstado'>ESTADO</label></td>";
				}
				else if($subSeccion=='agregados'){
					echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colTipo' 		class='nombreColumna' width='15%' align='center'  onmousedown=cambiaOrdenLista(this,'tipo','desc','".$unidadUsuario."')><label id='labColTipo'>TIPO</label></td>";
					echo "<td id='colNombre' 	class='nombreColumna' width='25%' align='center'  onmousedown=cambiaOrdenLista(this,'nombre','desc','".$unidadUsuario."')><label id='labColNombre'>NOMBRE DEL ANIMAL</label></td>";
					echo "<td id='colColor'  	class='nombreColumna' width='15%' align='center'  onmousedown=cambiaOrdenLista(this,'color','desc','".$unidadUsuario."')><label id='labColColor'>RAZA/COLOR</label></td>";
					echo "<td id='colBcu'  		class='nombreColumna' width='18%' align='center'  onmousedown=cambiaOrdenLista(this,'BCU','desc','".$unidadUsuario."')><label id='labColBCU'>NRO. BCU</label></td>";
					echo "<td id='colUnidad' 	class='nombreColumna' width='23%' align='center'  onmousedown=cambiaOrdenLista(this,'unidad','desc','".$unidadUsuario."')><label id='labColUnidad'>UNIDAD ORIGEN</label></td>";
				}
				else{
		      echo "<td id='nombreColumna' width='4%' align='center'>No.</td>";
					echo "<td id='colTipo' 		class='nombreColumna' width='10%' align='center'  onmousedown=cambiaOrdenLista(this,'tipo','desc','".$unidadUsuario."')><label id='labColTipo'>TIPO</label></td>";
					echo "<td id='colNombre' 	class='nombreColumna' width='33%' align='center'  onmousedown=cambiaOrdenLista(this,'nombre','desc','".$unidadUsuario."')><label id='labColNombre'>NOMBRE DEL ANIMAL</label></td>";
					echo "<td id='colColor'  	class='nombreColumna' width='20%' align='center'  onmousedown=cambiaOrdenLista(this,'color','desc','".$unidadUsuario."')><label id='labColColor'>RAZA/COLOR</label></td>";
					echo "<td id='colBcu'  		class='nombreColumna' width='18%' align='center'  onmousedown=cambiaOrdenLista(this,'BCU','desc','".$unidadUsuario."')><label id='labColBCU'>NRO. BCU</label></td>";
					echo "<td id='colEstado' 	class='nombreColumna' width='15%' align='center'  onmousedown=cambiaOrdenLista(this,'estado','desc','".$unidadUsuario."')><label id='labColEstado'>ESTADO</label></td>";
				}
			?>
      </tr>
	  </table>
	  </div>
		<div id="listadoCaballos"></div>
		<div id="listadoPerros"></div>
	</div>
<div style="height:2px"></div>
<table width="100%"><tr class="linea"><td></td></tr></table>
</div>
</body>
</html>
<? 
	echo "<script>";
		if($subSeccion=='agregados') echo "leeAnimalesA('".$unidadUsuario."','','');";
		else echo "leeAnimales('".$unidadUsuario."','','');";
	echo "</script>";
?>