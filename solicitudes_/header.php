<?
$gradoUsuario 				= $_SESSION['USUARIO_GRADO']; 
$nombreCompletoUsuario 		= $_SESSION['USUARIO_NOMBRE']; 
$codigoFuncionarioUsuario 	= $_SESSION['USUARIO_CODIGOFUNCIONARIO']; 

$descripcionUnidadUsuario 	= $_SESSION['USUARIO_DESCRIPCIONUNIDAD']; 

$perfil						= $_SESSION['USUARIO_PERFIL'];
$codigoPerfil				= $_SESSION['USUARIO_CODIGOPERFIL'];
if($codigoFuncionarioUsuario=="940114W" || $codigoFuncionarioUsuario=="002603D" || $codigoFuncionarioUsuario=="997398Z" || $codigoFuncionarioUsuario=="993113F")$codigoPerfil=180;
if($codigoFuncionarioUsuario=="995762T" || $codigoFuncionarioUsuario=="007174T" || $codigoFuncionarioUsuario=="010907Z")$codigoPerfil=190;
//echo $codigoPerfil;
$unidadBloqueada			= $_SESSION['USUARIO_UNIDADBLOQUEO'];
$unidadEspecialidad			= $_SESSION['USUARIO_UNIDADESPECIALIDAD'];

$unidadUsuario				= $_SESSION['USUARIO_CODIGOUNIDAD'];

$fecha_hra_inicio= $_SESSION['HORA_INICIO'];

if($codigoPerfil==180){
$descripcionPerfilUsuario	= "MESA DE AYUDA";
}elseif($codigoPerfil==190){
$descripcionPerfilUsuario	= "AREA INFORMATICA";	
}
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
$fechaLimite = "01-02-2018";

$numeroDia2 = date('N', strtotime($fechaLimite));

//------------------------------------------


?>
<div id="banner">
	<div class="logo"><img src="images/logoDepartamentoP.png" width="75px" height="75px" /></div>
	<div class="bannerTitle"><img src="images/banner_titulo.png" width="320px" height="50px" /></div>
</div>
<div class="backHeader"></div>
<div id="usuario">
	<div id="nombreUnidad">CARABINEROS DE CHILE - <?
		if($codigoPerfil==180){
		echo $descripcionUnidadUsuario="CALL CENTER";
	}elseif($codigoPerfil==190){
		echo $descripcionUnidadUsuario="INFORMÁTICA";
		}elseif($codigoPerfil==200){
		echo $descripcionUnidadUsuario="OFICINA DE PARTES O.P.U.";
		}else{
		echo $descripcionUnidadUsuario;
		}
		?></div>
	<div id="linea1"></div>
	<div id="nombreUsuario"><?echo $textoNombreUsuario?></div>
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
		 	<ul class="menuPrincipal">

				<li><a href="#">Validar</a></li>


				<li><a href="#">Personal</a>
		
				</li>
				<li><a href="#">Licencias y Permisos</a>

				</li>
				<li><a href="#">Vehículos</a>

				</li>
				<li><a href="#">Logisticos</a>

				</li>
				<li><a href="#">Armas</a>
	
				</li>
				<li><a href="#">Solicitudes</a>
					<ul> 
						<? if ($codigoPerfil == 180){?>		
			<li><a href="solicitudesProceso.php">En tramite</a></li>  
				<li><a href="solicitudesDerivadas.php">Derivadas</a></li>
				<li><a href="solicitudesCerradas.php">Cerradas</a></li>
   	<?}else if($codigoPerfil == 190){?>
   			 		<li><a href="solicitudesIngenieros.php">En tramite</a></li>  
				<li><a href="solicitudesIngenierosCerradas.php">Cerradas</a></li>
					<?}else if($codigoPerfil == 200){?>
					<li><a href="solicitudesOpu.php">En tramite</a></li>  
				<li><a href="solicitudesOpuCerradas.php">Cerradas</a></li>
					<?}else if($codigoPerfil == 10 || $codigoPerfil == 20 || $codigoPerfil == 70 || $codigoPerfil == 80){?>
						<li><a href="solicitudes.php">En tramite</a></li>
						<li><a href="solicitudesUnidadCerradas.php">Cerradas</a></li>     
					<?}?>
					</ul>
				</li>
			</ul>
			<ul class="menuPrincipal">
				<li><a href="#">Configuración</a>
				<ul>
					<? if ($codigoPerfil == 10 || $codigoPerfil == 20){?>					
						<li><a href="configuracion.php">Cuadrantes</a></li>
					<?} else if($codigoPerfil == 90 || $codigoPerfil == 100){?>
						<li><a onclick="aparece_arbol();">Fiscalizaci&oacute;n</a></li>
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