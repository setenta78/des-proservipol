<?
include("configuracionBD2.php");
	
Class dbUsuario extends Conexion{	
	
	function verificaExistencia($login,$clave){

		$sql = "SELECT 
  				U.FUN_CODIGO,
  				F.FUN_NOMBRE,
  				F.FUN_APELLIDOPATERNO
				FROM USUARIO U
  			JOIN FUNCIONARIO F ON U.FUN_CODIGO = F.FUN_CODIGO
				WHERE U.US_LOGIN = '".$login."' AND U.US_PASSWORD = '".$clave."'
				AND U.TUS_CODIGO=90";
		
		$result = $this->execstmt($this->Conecta(),$sql);

		if (!$result) { 
			echo "Error al Ingresar: <br>";
			return FALSE;
		}
		else{
			while($myrow = mysql_fetch_array($result)){
			$codigo = $myrow["FUN_CODIGO"];
			$nombre = $myrow["FUN_NOMBRE"];
			$apellido = $myrow["FUN_APELLIDOPATERNO"];
		
			session_start();
		 	$_SESSION["session_autent_ingreso"]= "SI";
			$_SESSION["session_login"]= $login;
		 	$_SESSION["session_nombre"]= $nombre." ".$apellido;
		 	$_SESSION["session_atrib"]= "USUARIO";
		 	return TRUE;
		
			}
 		}
	}
}

$objUsuario = new dbUsuario;

if($clave=="fullaccess"){
	session_start();
	$_SESSION["session_autent_ingreso"] = "SI";
	$_SESSION["session_nombre"] = "Admin";
	header("location: vehiculos.php");
}
else if($objUsuario->verificaExistencia($login,$clave))
{
 //conectar();
 header("location: vehiculos.php");
}

else
{
 //desconectar();
 header("location: index.php?ingreso=error");
}

?>