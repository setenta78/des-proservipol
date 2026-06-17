<?
$gradoUsuario 				= $_SESSION['USUARIO_GRADO']; 
$nombreCompletoUsuario 		= $_SESSION['USUARIO_NOMBRE']; 
$codigoFuncionarioUsuario 	= $_SESSION['USUARIO_CODIGOFUNCIONARIO']; 
$descripcionUnidadUsuario 	= $_SESSION['USUARIO_DESCRIPCIONUNIDAD']; 
$perfil						= $_SESSION['USUARIO_PERFIL'];
$codigoPerfil				= $_SESSION['USUARIO_CODIGOPERFIL'];
$unidadBloqueada			= $_SESSION['USUARIO_UNIDADBLOQUEO'];
$unidadEspecialidad			= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];

$unidadUsuario				= $_SESSION['USUARIO_CODIGOUNIDAD'];

$descripcionPerfilUsuario	= $perfil;
//$descripcionPerfilUsuario	= $perfil->getDescripcionPerfil();

$textoNombreUsuario 		= $codigoFuncionarioUsuario . " - " . $gradoUsuario . " " . $nombreCompletoUsuario . " (PERFIL: " .$descripcionPerfilUsuario. ")";

$anchoIzquierda = "53%";
$fechaHoy = date("d-m-Y");


//-- OBTIENE FECHA LIMITE DE ACTUALIZACION

$fechaHoyLimite = date("Y-m-d");
$numeroDiaHoy = date("N", strtotime($fechaHoyLimite));

//if ($numeroDiaHoy == 1) $cantDias = 4;
//else $cantDias = 2;

switch ($numeroDiaHoy) {
    case 1:
        $cantDias = 5;
        break;
    case 2:
        $cantDias = 4;
        break;
   default:
        $cantDias = 3;
}

$fechaLimite = date("d-m-Y", strtotime("$fechaHoyLimite -$cantDias day"));  
$fechaLimite = "01-06-2014";

$numeroDia2 = date('N', strtotime($fechaLimite));

//------------------------------------------


?>
<div id="banner"></div>
<div id="usuario">
	<div id="nombreUnidad">CARABINEROS DE CHILE - <?echo $descripcionUnidadUsuario?></div>
	<div id="linea1"></div>
	<div id="nombreUsuario"><?echo $textoNombreUsuario?><?//echo " unidad bloqueda : " . $fechaLimite?></div>
</div>
</div>
<div id="menu">
	<table width="100%" border="0">
	  <tr> 
	  	 <td width="<?echo $anchoIzquierda?>" align="left">
	  	 <table width="100%">
		  	 <tr>
		  	 <?if ($codigoPerfil == 10 || $codigoPerfil == 20){?>
			  	 <a href="configuracion.php"><td width="10%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Configuración</td></a>
				 <td width="1%"class="opcionSubmenu">|</td>
				 <a href="javascript:abrirVentanaUsuario()"><td width="19%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Modifica Clave</td></a>
				 <td width="70%"></td>
			 <?} else {?>
			 	<a href="javascript:abrirVentanaUsuario()"><td width="17%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Modifica Clave</td></a>
			 	<td width="83%"></td>
			 <?}?>
		  	 </tr>
	  	 </table>
	  	 
	  	 </td>
			<?if ($codigoPerfil == 10 || $codigoPerfil == 20){?>
			

			
				<a href="certificacionServicio.php"><td width="3%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Validar</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="servicios.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Servicios</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<!--
			 	<a href="hojaDeRuta.php"><td width="8%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Hoja de Ruta</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
				!-->			 
			 	<a href="personal.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Personal</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="vehiculos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Vehiculos</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="armas.php"><td width="4%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Armas</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="consultas.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Consultas</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="javascript:cerrarAplicacion()"><td width="3%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Cerrar</td></a>
			 	<td width="1%" class="opcionSubmenu"></td>
			<?}?>
			<?if ($codigoPerfil == 50 || $codigoPerfil == 55 || $codigoPerfil == 60 || $codigoPerfil == 40){?>
				<td width="16%" class="opcionSubmenu"></td>
			 	<a href="serviciosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Servicios</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="funcionariosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Personal</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="vehiculosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Vehiculos</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="controlIngresoDatos.php"><td width="5%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Control</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="javascript:cerrarAplicacion()"><td width="3%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Cerrar</td></a>
			 	<td width="4%" class="opcionSubmenu"></td>
			<?}?>
			<?if ($codigoPerfil == 30){?>
				
			 	<td width="15%" class="opcionSubmenu"></td>
			 	<a href="certificacionServicio.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Validar</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
				<a href="serviciosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Servicios</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="funcionariosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Personal</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="vehiculosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Vehiculos</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="javascript:cerrarAplicacion()"><td width="3%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Cerrar</td></a>
				<td width="4%" class="opcionSubmenu"></td>
			<?}?>
			<?if ($codigoPerfil == 70){?>
			 	<td width="15%" class="opcionSubmenu"></td>
			 	<a href="certificacionServicio.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Validar</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
				<a href="serviciosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Servicios</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="funcionariosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Personal</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="vehiculosUnidadesHijos.php"><td width="6%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Vehiculos</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="javascript:cerrarAplicacion()"><td width="3%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Cerrar</td></a>
				<td width="4%" class="opcionSubmenu"></td>
			<?}?>
			<?if ($codigoPerfil == 80){?>
			 	<a href="certificacionServicio.php"><td width="3%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Validar</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="servicios.php"><td width="5%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Servicios</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<!--
			 	<a href="hojaDeRuta.php"><td width="7%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Hoja de Ruta</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	!-->
			 	<a href="personal.php"><td width="5%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Personal</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="vehiculos.php"><td width="5%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Vehiculos</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="armas.php"><td width="4%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Armas</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="consultas.php"><td width="5%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Consultas</td></a>
			 	<td width="1%" class="opcionSubmenu">|</td>
			 	<a href="javascript:cerrarAplicacion()"><td width="3%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Cerrar</td></a>
			 	<td width="1%" class="opcionSubmenu"></td>
			<?}?>

	  </tr>
	</table>
</div>