<?
// Continua con la sesion de usuario
include("session.php");
include("tiempo.php");
//$fecha_hra_inicio=date("Y/m/d H:i:s");

//$sesionf=$_SESSION['HORA_INICIO'];

//echo $sesionf;

$NewUnidad = $_GET['unidad'];
$NewNombre = $_GET['nombre'];
$CodPerfil = $_GET['CodPerfil'];
$unidadPadre = $_GET['padre'];
$tienePlanCuadrante=$_GET['cuadrante'];
//$unidadPadre = $_GET['especialidad'];
$unidadEspecialidad= $_GET['especialidad'];
 if($_GET['especialidad']==""){
	$unidadEspecialidad= 0;
	}else{
$unidadEspecialidad= $_GET['especialidad'];
}

// Cambia las variables de sesion para seleccionar la unidad
$_SESSION['USUARIO_CODIGOUNIDAD'] = $NewUnidad;
$_SESSION['USUARIO_DESCRIPCIONUNIDAD'] = $NewNombre;
$_SESSION['USUARIO_CODIGOPADREUNIDAD'] = $unidadPadre;
$_SESSION['USUARIO_UNIDADESPECIALIDAD']= $unidadEspecialidad;
$_SESSION['USUARIO_UNIDADPLANCUADRANTE']=$tienePlanCuadrante;



	
/* Verifica que tipo de unidad fue selecionada y lo redirecciona donde corresponda */
switch($CodPerfil){
	
	//NACIONAL
	case 10:
		$_SESSION['USUARIO_CODIGOPERFIL'] = 60;
	  $_SESSION['HORA_INICIO'];  
		header ("Location: serviciosUnidadesHijos.php");
	break;
	
	//ZONA
	case 20:
		$_SESSION['USUARIO_CODIGOPERFIL'] = 50;
		$_SESSION['HORA_INICIO'];  
		header ("Location: serviciosUnidadesHijos.php");
	break;
   //PREFECTURAS
   case 30:
		$_SESSION['USUARIO_CODIGOPERFIL']   = 45;
		$_SESSION['USUARIO_CONTIENEHIJOS']  = 1; 
		$_SESSION['USUARIO_TIPOUNIDAD']     = 30;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 40;

		
		header ("Location: serviciosUnidadesEspecializadas.php");
	break;
	
	//COMISARIA
	case 50:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 50;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 0;


		header ("Location: servicios.php");
	break;
	
	//SUBCOMISARIA
	case 60:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 60;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 0;

		
		header ("Location: servicios.php");
	break;
	
		//TENENCIA
	case 70:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 60;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 0;

		 
		header ("Location: servicios.php");
	break;
	
	//RETEN
	case 80:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 80;

	  
		header ("Location: servicios.php");
	break;
	
		//Reten Temporal
	 case 110:
		$_SESSION['USUARIO_CODIGOPERFIL']   = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS']  = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']     = 110;

		header ("Location: servicios.php");
	break;
	
	//SUBPREFECTURA
	 case 120:
		$_SESSION['USUARIO_CODIGOPERFIL']   = 45;
		$_SESSION['USUARIO_CONTIENEHIJOS']  = 1; 
		$_SESSION['USUARIO_TIPOUNIDAD']     = 120;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 41;

		header ("Location: serviciosUnidadesEspecializadas.php");
	break;
	
		//ESCUCAR PM
	 case 130:
		$_SESSION['USUARIO_CODIGOPERFIL']   = 120;
		$_SESSION['USUARIO_CONTIENEHIJOS']  = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']     = 130;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 50;

    
		header ("Location: serviciosUnidadesEspecializadas.php");
	break;
	
		//ESCUCAR ESCUADRONES
	 case 135:
		$_SESSION['USUARIO_CODIGOPERFIL']   = 120;
		$_SESSION['USUARIO_CONTIENEHIJOS']  = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']     = 135;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 50;


		header ("Location: serviciosUnidadesEspecializadas.php");
	break;
	
		//OREDENES JUDICIALES
	case 140:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 140;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 60;


 
		header ("Location: servicios.php");
	break;
	
	 //CENCO
	case 150:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 150;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 80;


		header ("Location: servicios.php");
	break;
	
	 //GOPE
	case 160:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 160;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 110;
		
		header ("Location: servicios.php");
	break;
	
		 //GOPE
	case 180:
		$_SESSION['USUARIO_CODIGOPERFIL']  = 10;
		$_SESSION['USUARIO_CONTIENEHIJOS'] = 0; 
		$_SESSION['USUARIO_TIPOUNIDAD']    = 180;
		$_SESSION['USUARIO_UNIDADESPECIALIDAD'] = 130;
		
		header ("Location: servicios.php");
	break;
	
	default:
		header ("Location: unidades.php");
	break;
	}
?>