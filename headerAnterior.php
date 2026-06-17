<?
$gradoUsuario 						= $_SESSION['USUARIO_GRADO'];
$nombreCompletoUsuario 		= $_SESSION['USUARIO_NOMBRE'];
$codigoFuncionarioUsuario = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$descripcionUnidadUsuario = $_SESSION['USUARIO_DESCRIPCIONUNIDAD'];
$perfil										= $_SESSION['USUARIO_PERFIL'];
$codigoPerfil							= $_SESSION['USUARIO_CODIGOPERFIL'];
$unidadBloqueada					= $_SESSION['USUARIO_UNIDADBLOQUEO'];
$unidadEspecialidad				= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];
$tipoUnidad								= $_SESSION['USUARIO_TIPOUNIDAD'];
$unidadUsuario						= $_SESSION['USUARIO_CODIGOUNIDAD'];
$fecha_hra_inicio					= $_SESSION['HORA_INICIO'];
$desPadre 								= $_SESSION['USUARIO_DESCRIPCIONUNIDAD_PADRE'];
$codPadre 								= $_SESSION['USUARIO_CODIGOUNIDAD_PADRE'];
$codigoPerfilPadre 				= $_SESSION['USUARIO_CODIGOPERFIL_PADRE'];
$descripcionPerfilUsuario	= $perfil;
//$descripcionPerfilUsuario	= $perfil->getDescripcionPerfil();
$textoNombreUsuario = $codigoFuncionarioUsuario . " - " . $gradoUsuario . " " . $nombreCompletoUsuario . " (PERFIL: " .$descripcionPerfilUsuario. ")";

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
	break;
}

//echo $tipoUnidad;		
//echo $codigoPerfilPadre; 	

$fechaLimite = date("d-m-Y", strtotime("$fechaHoyLimite -$cantDias day"));
$fechaLimite = "01-10-2020";

$numeroDia2 = date('N', strtotime($fechaLimite));

//echo $codigoPerfil;
//echo $unidadUsuario;
$contraloria="CONTRALORIA GRAL. DE CARABINEROS";
$departamento="DEPTO. CONTROL DE GESTI�N Y SIST. DE INFORMACI�N";

//------------------------------------------
?>
<link rel="icon" type="image/png" href="images/logoDepartamentoP.png" />
<div id="banner">
	<div class="logo"><img src="images/logoDepartamentoP.png" width="75px" height="75px" /></div>
	<div class="bannerTitle"><img src="images/banner_titulo.png" width="320px" height="50px" /></div>
</div>
<div class="backHeader"></div>
<div id="usuario">
	<div id="nombreUnidad">CARABINEROS DE CHILE - <? if($codigoPerfil==90){$descripcionUnidadUsuario=$departamento; echo $descripcionUnidadUsuario;}elseif($codigoPerfil==100 || $codigoPerfil==150) {$descripcionUnidadUsuario=$contraloria; echo $descripcionUnidadUsuario;}else{echo $descripcionUnidadUsuario;}?></div>
	<div id="linea1"></div>
	<div id="nombreUsuario"><? echo $textoNombreUsuario; ?></div>
</div>
<div id="contenedorMenu">
<table width="100%" border="0">
	<tr> 
		<td>
			<ul class="SubmenuPrincipal">
			 <li> </li>
			 <li> </li>
			 <li> </li>
		 	</ul>
		 	<? if (($codigoPerfilPadre == 90 || $codigoPerfilPadre == 100 || $codigoPerfil == 180) && $codigoPerfil == $codigoPerfilPadre){ ?>
		 	<ul class="menuPrincipal">
		 	 <li> </li>
			 <li> </li>
			 <li> </li>
			 <li> </li>
			 <li> </li>
			 <li> </li>
			 <li> </li>
		 	<? } else{ ?>
		 	<ul class="menuPrincipal">
				<? if ($codigoPerfil == 80 || $codigoPerfilPadre == 90 || $codigoPerfilPadre == 100){?>
				<li><a href="#">Validar</a>
				<ul>
					<li><a href="certificacionServicio.php">Validaci�n</a></li>
					<li><a href="capacitados.php">Usuarios Proservipol</a></li>
				</ul>
				<?}elseif($codigoPerfilPadre == 150){?>
					<li><a href="#">Validar</a></li>
				<?}else{?>
					<li><a href="certificacionServicio.php">Validaci�n</a></li>
				<? } ?>
				</li>
				<? if ($tipoUnidad == 30 || $unidadEspecialidad == 30 || $unidadEspecialidad == 70 || $unidadEspecialidad == 120 || $unidadEspecialidad == 135 || $unidadEspecialidad == 140  || $unidadEspecialidad == 160){ ?>
					<li><a href="serviciosUnidadesEspecializadas.php">Servicios</a></li>
				<? }else if($unidadEspecialidad == 110 && $unidadUsuario==11910){?>
				<li><a href="serviciosUnidadesEspecializadasGope.php">Servicios</a></li>
					<?}else if($codigoPerfilPadre == 150){?>
				<li><a href="#">Servicios</a></li>  
					<? }else { ?>
					<li><a href="servicios.php">Servicios</a></li>
				<? } ?>
				<? if ($codigoPerfilPadre == 150){?>
						<li><a href="#">Personal</a></li>
					<? } else { ?>
			<li><a href="#">Personal</a>
					<ul>
						<li><a href="personal.php">Personal</a></li>
						<li><a href="personal.php?subSeccion=agregados">Personal Agregado</a></li>
						<li><a href="personal.php?subSeccion=destinados">Personal Destinado a Servicio en el Cuartel</a></li>
						<li><a href="licenciasDeConducir.php">Licencias de Conducir</a></li>
					</ul>
				<? } ?>
				</li>
					<? if ($codigoPerfilPadre == 150){?>
						<li><a href="#">Licencias y Permisos</a></li>
					<? } else { ?>
				<li><a href="#">Licencias y Permisos</a>
					<ul>
						<li><a href="licenciasMedicas.php">Licencias Medicas</a></li>
						<li><a href="ferper.php">FERPER</a></li>
					</ul>
					<? } ?>
				</li>
				<li><a href="#">Veh�culos</a>
					<ul>
						<li><a href="vehiculos.php">Veh�culos</a></li>
						<li><a href="vehiculos.php?subSeccion=agregados">Veh�culos agregados</a></li>
					</ul>
				</li>
				<? if ($codigoPerfilPadre == 150){?>
					<li><a href="#">Logisticos</a></li>
					<? } else { ?>
				<li><a href="#">Logisticos</a>
					<ul>
						<li><a href="animales.php">Animales</a></li>
						<li><a href="animales.php?subSeccion=agregados">Animales agregados</a></li>
						<li><a href="simccar.php">SIMCCAR</a></li>
						<li><a href="simccar.php?subSeccion=agregados">SIMCCAR Agregadas</a></li>
					</ul>
				<? } ?>
				</li>
				<? if ($codigoPerfilPadre == 150){?>
					<li><a href="#">Armas</a></li>
					<? } else { ?>
				<li><a href="#">Armas</a>
					<ul> 
						<li><a href="armas.php">Armas</a></li>
						<li><a href="armas.php?subSeccion=agregados">Armas Agregadas</a></li>
					</ul>
						<? } ?>
				</li>
				<? } ?>
				<? if ($codigoPerfilPadre == 150){?>
					<li><a href="#">Solicitudes</a></li>
					<? } else { ?>
				<li><a href="#">Solicitudes</a>
					 <ul>    
						<li><a href="solicitudes.php">En tramite</a></li>
						<li><a href="solicitudesUnidadCerradas.php">Cerradas</a></li>     
					</ul>
					<? } ?>
					</li>
			</ul>
			<ul class="menuPrincipal">
				<li><a href="#">Configuraci�n</a>
				<ul>
					<? if ($codigoPerfilPadre != 150){?>
					<li><a href="consultas.php">Consultas</a></li>
					<?}?>
					<? if (($codigoPerfil == 10 || $codigoPerfil == 20) && ($codigoPerfilPadre != 90 && $codigoPerfilPadre != 100 && $codigoPerfilPadre != 180 && $codigoPerfilPadre != 150)){?>
						<li><a href="configuracion.php">Cuadrantes</a></li>
					<?} if ($codigoPerfilPadre == 90 || $codigoPerfilPadre == 100 || $codigoPerfil == 180){?>
						<li><a href="#" onclick="aparece_arbol();">Fiscalizaci&oacute;n</a></li>
					
					<? }elseif ($codigoPerfilPadre == 150){?>
						<li><a href="#" onclick="aparece_arbolL3();">Fiscalizaci&oacute;n</a></li>
					<?}?>
					<li> <a href="javascript:abrirVentanaUsuario()">Modifica Clave</a> </li>
					<li><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
				</ul>
				</li>
			</ul>
		</td>
	</tr>
</table>
</div>
<script>
	var presionado = true;
	function aparece_arbol(){
	/*
		if(presionado){
			document.getElementById('navBar').style.display = 'block';
			presionado=false;
		}
		else{
			document.getElementById('navBar').style.display = 'none';
			presionado=true;	
		}
	*/
	//alert();
	window.location="unidades.php";
	}
	
//Para L3
	function aparece_arbolL3(){

	//alert();
	window.location="unidadesL3.php";
	}
</script>