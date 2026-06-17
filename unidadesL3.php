<?
include("session.php");
include("tiempo.php");
include("proteccion.php");
$perfil1= $_SESSION['USUARIO_PROSERVIPOLPERFIL'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="./css/arbolUnidad.css" rel="stylesheet" type="text/css" />
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/crearArbolFiscalizadorL3.js"> </script>
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/aplicacion.js"></script>
<script type="text/javascript" src="./js/servicios.js"></script>  
<script type="text/javascript" src="./js/usuario.js"></script>  
<script type="text/javascript" src="./js/horaFecha.js"></script>
<script type="text/javascript" src="./calendario/popcalendar.js"></script>  

<script type="text/javascript" src="./js/vehiculos.js"></script>  
   
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>

<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>

<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<title>PROSERVIPOL - Programaci&oacuten de Servicios Policiales ...</title>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<?include("header.php")?>
	<input id="unidadPadre"  type="hidden" readonly="yes" value="<?echo $codPadre?>">
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">Unidades</div>
		<div id="subtitulo">En esta lista se encuentran las Unidades que puede consultar.</div>
		<div style="height:25px"></div>
		<div style="height:2px"></div>
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>
		<div id="listado">
			<div class="arbol" id="arbol" >
				<div id="TipoBase" onclick="cambiaPrimer('<? echo $codPadre; ?>','<? echo $codPadre; ?>','<? echo $desPadre; ?>')" onmouseover="cambiarClase(this,'resaltar')" OnMouseOut="cambiarClase(this,'arbol')">
				<img src='img/base.gif' /><? if($codPadre==20){echo "NIVEL NACIONAL ";}else{echo $desPadre;} ?></div>
				<div id="NodosBase">	</div>
			</div>
			<div style="height:2px"></div>
			</div>
		</div>
		<table width="100%"><tr class="linea"><td></td></tr></table>
</body>
</html>
<script type="text/javascript" >
	CrearPrimerArbol(<? echo "'".$codPadre."','".$codigoPerfilPadre."'"; ?>);
</script>