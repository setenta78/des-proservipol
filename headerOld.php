<?
$codigoFuncionarioUsuario	= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$gradoUsuario				= $_SESSION['USUARIO_GRADO'];
$nombreCompletoUsuario		= $_SESSION['USUARIO_NOMBRE'];
$codigoPerfil				= $_SESSION['USUARIO_CODIGOPERFIL'];
$perfil						= $_SESSION['USUARIO_PERFIL'];
$unidadUsuario				= $_SESSION['USUARIO_CODIGOUNIDAD'];
$tipoUnidad					= $_SESSION['USUARIO_TIPOUNIDAD'];
$descripcionUnidadUsuario	= $_SESSION['USUARIO_DESCRIPCIONUNIDAD'];
$unidadBloqueada			= $_SESSION['USUARIO_UNIDADBLOQUEO'];
$unidadEspecialidad			= $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD'];

$codigoUnidadPadre			= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoCuartel				= $_SESSION['USUARIO_TIPO_UNIDAD'];
$tipoCuartelOrigen			= $_SESSION['USUARIO_TIPO_UNIDAD_ORIGEN'];

$especialidadCuartel		= $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'];
$especialidadCuartelOrigen	= $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD_ORIGEN'];

$codigoFunUsuarioOrigen		= $_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'];
$gradoUsuarioOrigen			= $_SESSION['USUARIO_GRADO_ORIGEN'];
$nombreCompletoUsuarioOrigen= $_SESSION['USUARIO_NOMBRE_ORIGEN'];
$codigoPerfilOrigen			= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$descripcionPerfilUsuario	= $_SESSION['USUARIO_PERFIL_ORIGEN'];
$codOrigen					= $_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN'];
$tipoUnidadOrigen			= $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'];
$desOrigen					= $_SESSION['USUARIO_DESCRIPCIONUNIDAD_ORIGEN'];
$codigoUnidadPadreOrigen	= $_SESSION['USUARIO_CODIGOPADREUNIDAD_ORIGEN'];

$fechaLimite				= $_SESSION['FECHA_LIMITE'];
$fecha_hra_inicio			= $_SESSION['HORA_INICIO'];
$textoNombreUsuario			= $codigoFuncionarioUsuario." - ".$gradoUsuario." ".$nombreCompletoUsuario." (PERFIL: " .$perfil. ")";
$textoNombreUsuarioOrigen 	= $codigoFunUsuarioOrigen." - ".$gradoUsuarioOrigen." ".$nombreCompletoUsuarioOrigen." (PERFIL: ".$descripcionPerfilUsuario.")";
$anchoIzquierda				= "53%";
$contraloria				= "CONTRALORIA GRAL. DE CARABINEROS";
$departamento				= "DEPTO. CONTROL DE GESTI&Oacute;N Y SIST. DE INFORMACI&Oacute;N";

$permisoValidar = $_SESSION['PERMISO_VALIDAR'];
$permisoRegistrar = $_SESSION['PERMISO_REGISTRAR'];
$permisoConsultarUnidad = $_SESSION['PERMISO_CONSULTAR_UNIDAD'];
$permisoConsultarPerfil = $_SESSION['PERMISO_CONSULTAR_PERFIL'];

if($codigoPerfil==90){
	$descripcionFiscalizador = $departamento;
	$descripcionFiscalizador .= ($unidadUsuario==20) ? "" : " - ".$descripcionUnidadUsuario;
}
elseif($codigoPerfil==100 || $codigoPerfil==150){
	$descripcionFiscalizador = $contraloria;
	$descripcionFiscalizador .= ($unidadUsuario==20) ? "" : " - ".$descripcionUnidadUsuario;
}
else{
	$descripcionFiscalizador = $descripcionUnidadUsuario;
}

?>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
<div id="banner">
	<div class="logo"><img src="images/logoDepartamentoP.png" width="75px" height="75px" /></div>
	<div class="bannerTitle"><img src="images/banner_titulo.png" width="320px" height="50px" /></div>
</div>
<div class="backHeader"></div>
<div id="usuario">
	<div id="nombreUnidad">CARABINEROS DE CHILE - <? echo $descripcionFiscalizador; ?></div>
	<div id="linea1"></div> 
	<div id="nombreUsuario"><? echo ($codigoFuncionarioUsuario!=$codigoFunUsuarioOrigen) ? $textoNombreUsuarioOrigen." || " : ""; ?> <? echo $textoNombreUsuario; ?></div>
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
			<? if(($permisoConsultarUnidad || $permisoConsultarPerfil) && ($unidadUsuario==20)){ ?>
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
			<li><a href="#">Validar</a>
			 <ul>
			  <li><a href="certificacionServicio.php">Validar</a></li>
			  <li><a href="capacitados.php">Usuarios Proservipol</a></li>
			 </ul>
			</li>
			<li><a href="#">Servicios</a>
				<ul>
					<? if($tipoUnidad == 30 || $tipoUnidad == 120){ ?>
					<li><a href="serviciosUnidadesEspecializadas.php">Servicios</a></li>
					<? }else { ?>
					<li><a href="servicios.php">Servicios</a></li>
					<? } ?>
					<li><a href="actividadFueraCuartel.php">Comisi&oacute;n de Servicio</a></li>
				</ul>
			</li>
			<li><a href="#">Personal</a>
			  <ul>
			   <li><a href="personal.php">Personal Unidad</a></li>
			   <li><a href="personal.php?subSeccion=agregados">Personal Agregado al Cuartel</a></li>
			   <li><a href="personal.php?subSeccion=destinados">Personal Destinado a Servicios en este Cuartel</a></li>
			   <li><a href="licenciasDeConducir.php">Licencias de Conducir</a></li>
			  </ul>
			</li>
			<li><a href="#">Licencias y Permisos</a>
			 <ul>
			  <li><a href="licenciasMedicas.php">Licencias Medicas</a></li>
			  <li><a href="ferper.php">FERPER</a></li>
			 </ul>
			</li>
			<li><a href="#">Veh&iacute;culos</a>
			 <ul>
			  <li><a href="vehiculos.php">Veh&iacute;culos</a></li>
			  <li><a href="vehiculos.php?subSeccion=agregados">Veh&iacute;culos agregados</a></li>
			 </ul>
			</li>
			<li><a href="#">Animales</a>
			 <ul>
			  <li><a href="animales.php">Animales</a></li>
			  <li><a href="animales.php?subSeccion=agregados">Animales agregados</a></li>
			 </ul>
			</li>
			<li><a href="#">Armas</a>
			 <ul> 
			  <li><a href="armas.php">Armas</a></li>
			  <li><a href="armas.php?subSeccion=agregados">Armas Agregadas</a></li>
			 </ul>
			</li>
			<li><a href="#">Solicitudes</a>
			 <ul>
			  <li><a href="solicitudes.php">En tramite</a></li>
			  <li><a href="solicitudesUnidadCerradas.php">Cerradas</a></li>
			 </ul>
			</li>
			<? } ?>
			<? if($codigoPerfilOrigen==90){ ?>

			 <li><a href="#">Mesa de Ayuda</a>
			  <ul>
				<li><a href="claveUsuario.php">Gesti&oacute;n Usuario</a></li>
				<li><a href="#" onclick="aparece_arbol();">Fiscalizaci&oacute;n</a></li>
			  </ul>
			 </li>

			<? } else if($permisoConsultarUnidad || $permisoConsultarPerfil){?>
					<li><a href="#" onclick="aparece_arbol();">Fiscalizaci&oacute;n</a></li>
			<? } ?>

			 <li><a href="#">Configuraci&oacute;n</a>
			  <ul>
			   <li><a href="consultas.php">Consultas</a></li>
			   <li><a href="configuracion.php">Cuadrantes</a></li>
			   <li><a href="javascript:abrirVentanaUsuario()">Modifica Clave</a></li>
			   <li><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
			  </ul>
			 </li>
		</td>
	</tr>
</table>
</div>
<script>
	function aparece_arbol(){
		window.location="unidades.php";
	}
</script>