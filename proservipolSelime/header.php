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

$fecha_hra_inicio= $_SESSION['HORA_INICIO'];

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
$fechaLimite = "01-08-2016";

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
<div id="contenedorMenu">
	<table width="100%" border="0">
	  <tr> 
	  	 <td width="50%">
	  	 <table width="100%">
		  	 <tr>
		  	 <?if ($codigoPerfil == 10 || $codigoPerfil == 20){?>
			  	 <a href="configuracion.php"><td width="10%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Configuración</td></a>
				 <td width="1%"class="opcionSubmenu">|</td>
				 <a href="javascript:abrirVentanaUsuario()"><td width="19%"  class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')" style="text-align:left">Modifica Clave</td></a>
				 <td width="70%"></td>
			 <?} else {?>
			 	<a href="javascript:abrirVentanaUsuario()"><td width="17%" class="opcionSubmenu" OnMouseOver="cambiarClase(this, 'opcionSubmenuResaltado')"  OnMouseOut="cambiarClase(this, 'opcionSubmenu')">Modifica Clave</td></a>
			 	<td width="83%"></td>
			 <?}?>
		  	 </tr>
	  	 </table>
	  	 </td>
		 <td width="50%">
		 <?if ($codigoPerfil == 10 || $codigoPerfil == 20){?>
		 	<ul class="menuPrincipal">    
				<li><a href="certificacionServicio.php">Validar</a></li>
				<li><a href="servicios.php">Servicios</a></li>     
				<li><a href="#">Personal</a>
					<ul>    
						<li><a href="personal.php">Personal Unidad</a></li>
						<li><a href="licenciasDeConducir.php">Licencias de Conducir</a></li>    
						<li><a href="personalAgregado.php">Agregados a la Unidad</a></li>  
						<li><a href="licenciasMedicas.php">Licencias Medicas</a></li> 
					</ul>
				</li>
				<li><a href="vehiculos.php">Vehiculos</a></li>
				<li><a href="armas.php">Armas</a></li>
				<li><a href="consultas.php">Consultas</a></li>
				<li><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
			</ul>
		<?}?>
		
		<?if ($codigoPerfil == 50 || $codigoPerfil == 55 || $codigoPerfil == 60 || $codigoPerfil == 40){?>
		 	<ul class="menuPrincipal">    
				<li style="border-left:0px;"></li>
				<li style="border-left:0px;"></li>
				<li><a href="serviciosUnidadesHijos.php">Servicios</a></li>     
				<li><a href="funcionariosUnidadesHijos.php">Personal</a></li>
				<li><a href="vehiculosUnidadesHijos.php">Vehiculos</a></li>
				<li><a href="controlIngresoDatos.php">Control</a></li>
				<li><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
			</ul>
		<?}?>
		
		<?if ($codigoPerfil == 30 || $codigoPerfil == 70){?>
		 	<ul class="menuPrincipal">  
		 		<li style="border-left:0px;"></li>
				<li><a href="certificacionServicio.php">Validar</a></li>
				<li><a href="serviciosUnidadesHijos.php">Servicios</a></li>     
				<li><a href="funcionariosUnidadesHijos.php">Personal</a></li>
				<li><a href="vehiculosUnidadesHijos.php">Vehiculos</a></li>
				<li><a href="consultas.php">Consultas</a></li>
				<li><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
			</ul>
		<?}?>
		
		<?if ($codigoPerfil == 80){?>
		 	<ul class="menuPrincipal">    
				<li><a href="certificacionServicio.php">Validar</a></li>
				<li><a href="servicios.php">Servicios</a></li>     
				<li><a href="#">Personal</a>
					<ul>    
						<li><a href="personal.php">Personal Unidad</a></li>
						<li><a href="licenciasDeConducir.php">Licencias de Conducir</a></li>     
					</ul>
				</li>
				<li><a href="vehiculos.php">Vehiculos</a></li>
				<li><a href="armas.php">Armas</a></li>
				<li><a href="consultas.php">Consultas</a></li>
				<li><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
			</ul>
		<?}?>
		
		
		</td>
	   </tr>
	 </table>
</div>