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

$codigoFunUsuarioOrigen		= $_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'];
$gradoUsuarioOrigen			= $_SESSION['USUARIO_GRADO_ORIGEN'];
$nombreCompletoUsuarioOrigen= $_SESSION['USUARIO_NOMBRE_ORIGEN'];
$codigoPerfilOrigen			= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$descripcionPerfilUsuario	= $_SESSION['USUARIO_PERFIL_ORIGEN'];
$codOrigen					= $_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN'];
$tipoUnidadOrigen			= $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'];
$desOrigen					= $_SESSION['USUARIO_DESCRIPCIONUNIDAD_ORIGEN'];
$tipoUnidadOrigen			= $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'];
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
<link href="./css/menuNavegacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<div id="banner">
	<div class="logo"><img src="images/logo_depto_transparente.png" width="75px" height="75px" /></div>
	<div class="bannerTitle"><img src="images/banner_titulo.png" width="320px" height="50px" /></div>
</div>
<div class="backHeader"></div>
<div id="usuario">
	<div id="nombreUnidad">CARABINEROS DE CHILE - <? echo $descripcionFiscalizador; ?> </div>
	<div id="linea1"></div>
	<div id="nombreUsuario"><? echo ($codigoFuncionarioUsuario!=$codigoFunUsuarioOrigen) ? $textoNombreUsuarioOrigen." || " : ""; ?> <? echo $textoNombreUsuario; ?></div>
</div>
<nav class="nav">
	<button class="menu-toggle"><i class="fa fa-bars"></i></button>
	<ul class="nav-main-menu">
		<? if(!(($permisoConsultarUnidad || $permisoConsultarPerfil) && ($unidadUsuario==20))){ ?>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Validar</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='capacitados.php';" ><a href="capacitados.php">Usuarios Proservipol</a></li>
				<li onclick="window.location='certificacionServicio.php';" ><a href="certificacionServicio.php">Validar</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Servicios</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<? if($tipoUnidad == 30 || $tipoUnidad == 120){ ?>
					<li onclick="window.location='serviciosUnidadesEspecializadas.php';" ><a href="serviciosUnidadesEspecializadas.php">Servicios</a></li>
				<? }else { ?>
					<li onclick="window.location='servicios.php';" ><a href="servicios.php">Servicios</a></li>
				<? } ?>
				<li onclick="window.location='actividadFueraCuartel.php';"><a href="actividadFueraCuartel.php">Comisi&oacute;n de Servicio</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Personal</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='personal.php';" ><a href="personal.php">Personal Unidad</a></li>
				<li onclick="window.location='personal.php?subSeccion=agregado';" ><a href="personal.php?subSeccion=agregados">Personal Agregado al Cuartel</a></li>
				<li onclick="window.location='personal.php?subSeccion=destinados';" ><a href="personal.php?subSeccion=destinados">Personal Destinado a Servicios en este Cuartel</a></li>
				<li onclick="window.location='licenciasDeConducir.php';" ><a href="licenciasDeConducir.php">Licencias de Conducir</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Licencias y Permisos</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='ferper.php';" ><a href="ferper.php">FERPER</a></li>
				<li onclick="window.location='licenciasMedicas.php';" ><a href="licenciasMedicas.php">Licencias Medicas</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Recursos Log&iacute;sticos</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>Veh&iacute;culos</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location='vehiculos.php';" ><a href="vehiculos.php">Veh&iacute;culos</a></li>
						<li onclick="window.location='vehiculos.php?subSeccion=agregados';" ><a href="vehiculos.php?subSeccion=agregados">Veh&iacute;culos agregados</a></li>
					</ul>
				</li>
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>Armas</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location='armas.php';" ><a href="armas.php">Armas</a></li>
						<li onclick="window.location='armas.php?subSeccion=agregado';" ><a href="armas.php?subSeccion=agregados">Armas agregadas</a></li>
					</ul>
				</li>
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>C&aacute;maras Corporales</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location=\'camarasCorporales.php\';" ><a href="camarasCorporales.php">C&aacute;maras Corporales</a></li>
						<li onclick="window.location=\'camarasCorporales.php?subSeccion=agregados\';" ><a href="camarasCorporales.php?subSeccion=agregados">C&aacute;maras Corporales agregadas</a></li>
					</ul>
				</li>
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>Animales</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location='animales.php';" ><a href="animales.php">Animales</a></li>
						<li onclick="window.location='animales.php?subSeccion=agregado';" ><a href="animales.php?subSeccion=agregados">Animales agregados</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Solicitudes</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='solicitudes.php';" ><a href="solicitudes.php">En tramite</a></li>
				<li onclick="window.location='solicitudesUnidadCerradas.php';" ><a href="solicitudesUnidadCerradas.php">Cerradas</a></li>
			</ul>
		</li>
		<? }
		if($codigoPerfilOrigen==90 || ($permisoConsultarUnidad || $permisoConsultarPerfil)){ ?>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Mesa de Ayuda</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="aparece_arbol();" ><a href="#" onclick="aparece_arbol();">Fiscalizaci&oacute;n</a></li>
				<? if($codigoPerfilOrigen==90){ ?>
				<li onclick="window.location='claveUsuario.php';" ><a href="claveUsuario.php">Gesti&oacute;n Usuario</a></li>
				<? } ?>
				<? if($codigoPerfilOrigen==90){ ?>
				<li onclick="window.location='certificadoCurso.php';" ><a href="certificadoCurso.php">Certificado Curso</a></li>
				<? } ?>
			</ul>
		</li>
		<? } ?>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Configuraci&oacute;n</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='consultas.php';" ><a href="consultas.php">Consultas</a></li>
				<li onclick="window.location='configuracion.php';" ><a href="configuracion.php">Cuadrantes</a></li>
				<li onclick="abrirVentanaUsuario();" ><a href="javascript:abrirVentanaUsuario()">Modifica Clave</a></li>
				<li onclick="cerrarAplicacion();" ><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
			</ul>
		</li>
	</ul>
</nav>
<script>
	function aparece_arbol(){
		window.location="unidades.php";
	}
</script>