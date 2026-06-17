<?include("session.php")?>
<?include("tiempo.php")?>
<?//include("perfil.php")?>
<?
$contieneHijos  = $_SESSION['USUARIO_CONTIENEHIJOS']; //Añadido recien
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css"><!--Archivo css añadido el 17-04-2015-->
<script type="text/javascript" src="./js/creaObjeto.js"></script>   
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/armas.js"></script>  
<script type="text/javascript" src="./js/usuario.js"></script>

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
	<input type="hidden" value="<?echo $unidadBloqueada?>" name="textUnidadBloqueada"/>
	<input type="hidden" value="<?echo $fechaLimite?>" name="textFechaLimite"/>
	<input id="contieneHijos"  type="hidden" readonly="yes" value="<?echo $contieneHijos?>"><!-- añadida -->
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">ARMAS</div>
		<div id="subtitulo">En esta lista se encuentran las Armas asignadas a esta <? if ($unidadUsuario==10270) echo "Subprefectura."; else echo "Prefectura."; ?></div>
		<div style="height:45px"></div>
		<table width="100%">   
		    <tr> 
		      <td width="25%">
		      		<input type="button" name="btnNuevaReunion" id="btn100" value="AGREGAR ARMA" onClick="javascript:abrirVentana('AGREGAR ARMA ... ', '800', '280','fichaArma.php','','','5','5')">
		      </td>		
			  <td width="35%"align="right">NUMERO SERIE&nbsp;:&nbsp;</td>
			  <td width="10%"><input id="textBuscar" type="text"></td>
			  <td width="10%"><input type="button" id="btn100" value="BUSCAR" onClick="leeArmas('<?echo $unidadUsuario?>')"></td>
			  <td width="20%"><input type="button" id="btn100" value="BUSQUEDA AVANZADA >>>" disabled></td>
		    </tr>
		</table>
		<div style="height:2px"></div>
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>
		<div id="listado">
			<div id="cabeceraGrilla">
			<table cellspacing="1" cellpadding="1" width="100%">
             <?
               if($contieneHijos==1){            
               echo "<tr>"; 
	           echo "<td id='nombreColumna' width='5%' align='center'>No.</td>";
               echo "<td id='nombreColumna' width='23%' align='center'>TIPO ARMA</td>";
               echo "<td id='nombreColumna' width='30%' align='center'>MARCA/MODELO</td>";
               echo "<td id='nombreColumna' width='15%' align='center'>NUMERO SERIE</td>";
		       echo "<td id='nombreColumna' width='15%' align='center'>SECCION</td>";
               echo "<td id='nombreColumna' width='19%' align='center'>ESTADO</td>";
               echo "</tr>";
               }else{
               echo "<tr>"; 
	           echo "<td id='nombreColumna' width='5%' align='center'>No.</td>";
               echo "<td id='nombreColumna' width='23%' align='center'>TIPO ARMA</td>";
               echo "<td id='nombreColumna' width='38%' align='center'>MARCA/MODELO</td>";
               echo "<td id='nombreColumna' width='15%' align='center'>NUMERO SERIE</td>";
               echo "<td id='nombreColumna' width='19%' align='center'>ESTADO</td>";
               echo "</tr>";
               }
             ?>
		     </table>
		    </div>
			<div id="listadoArmas"></div>
		</div>
			<div style="height:2px"></div>
			<table width="100%"><tr class="linea"><td></td></tr></table>
		</div>
</body>
</html>
<?
	echo "<script>";
	echo "leeArmas('".$unidadUsuario."');";
	echo "</script>";
?>