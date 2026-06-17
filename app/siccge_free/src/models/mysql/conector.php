<?php

define("host_local","localhost");
define("user_local","admin");	
define("pass_local","0000");
define("bd_local","db_reparticionesaupol2.0");

function conecta(){				    
	$conexion = mysqli_connect(host_local,user_local,pass_local,bd_local);
	
	$jsondata = array();

	if(mysqli_connect_errno()){
		try{
			throw new Exception("MySQL ERROR : ".mysqli_connect_error()."Servidor IP: ".host_local." ", mysqli_connect_errno());
		}catch(Exception $e){
			$jsondata[] = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage() . 'Error Nro:' . utf8_encode($e->getCode())));
			echo json_encode($jsondata);
			exit;
		}
	}else{
		return $conexion;
	}
	
}






define("host_personal","localhost");
define("user_personal","admin");
define("pass_personal","0000");
define("bd_personal","db_personal");

function conectadbpersonal(){			    
	$conexion = mysqli_connect(host_personal,user_personal,pass_personal,bd_personal);
	
	$jsondata = array();

	if(mysqli_connect_errno()){
		try{
			throw new Exception("MySQL ERROR : ".mysqli_connect_error()."Servidor IP: ".host_personal." ", mysqli_connect_errno());
		}catch(Exception $e){
			$jsondata[] = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage() . 'Error Nro:' . utf8_encode($e->getCode())));
			echo json_encode($jsondata);
			exit;
		}
	}else{
		return $conexion;
	}
	
}






define("host_carnew","168.88.11.3");
define("user_carnew","rmedina");	
define("pass_carnew","rmedina");
define("bd_carnew","CAR_NEW");

function conectadbcarnew(){			    
	$conexion = mysqli_connect(host_carnew,user_carnew,pass_carnew,bd_carnew);
	
	$jsondata = array();

	if(mysqli_connect_errno()){
		try{
			throw new Exception("MySQL ERROR : ".mysqli_connect_error()."Servidor IP: ".host_carnew." ", mysqli_connect_errno());
		}catch(Exception $e){
			//echo $e->getMessage() . "\n". "Error Nro: ".$e->getCode();					
			//$obj = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage() . 'Error Nro:' . utf8_encode($e->getCode())));
			$jsondata[] = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage() . 'Error Nro:' . utf8_encode($e->getCode())));
			echo json_encode($jsondata);
			exit;			
		}
	}else{
		return $conexion;
	}
	
}









/********************************************************************************************************/
/********************************************************************************************************/
/********************************************************************************************************/
/********************************************************************************************************/
/********************************************************************************************************/








function ejecutaSQL_select($con, $sql){

	if($con == 'reparticionesaupol2.0'){$coneccion=conecta();}
	if($con == 'personal'){$coneccion=conectadbpersonal();}
	if($con == 'carnew'){$coneccion=conectadbcarnew();}
	
	$jsondata = array();
	
	try{

		$Result = mysqli_query($coneccion,$sql);
		if($Result){
			return($Result);
		}else{
			throw new Exception("MySQL ERROR : " . mysqli_error($coneccion));
		}
		
		//mysqli_free_result($Result);
		//mysqli_close($con);
		
	}catch(Exception $e){
	 	$jsondata[] = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage()));
		echo json_encode($jsondata);
		exit;
	}		
	
}



function ejecutaSQL_insert($con, $sql){

	if($con == 'reparticionesaupol2.0'){$coneccion=conecta();}
	if($con == 'personal'){$coneccion=conectadbpersonal();}
	if($con == 'carnew'){$coneccion=conectadbcarnew();}
	
	$jsondata = array();
	
	try{

		$Result = mysqli_query($coneccion,$sql);
		if($Result){
			if(mysqli_affected_rows($coneccion) == 1){
				return(mysqli_insert_id($coneccion));
			}else{
				return(0);
			}			
		}else{
			throw new Exception("MySQL ERROR : " . mysqli_error($coneccion));
		}
		
		//mysqli_free_result($Result);
		//mysqli_close($con);
		
	}catch(Exception $e){
	 	$jsondata[] = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage()));
		echo json_encode($jsondata);
		exit;
	}		
	
}




function ejecutaSQL_update($con, $sql){

	if($con == 'reparticionesaupol2.0'){$coneccion=conecta();}
	if($con == 'personal'){$coneccion=conectadbpersonal();}
	if($con == 'carnew'){$coneccion=conectadbcarnew();}
	
	$jsondata = array();
	
	try{

		$Result = mysqli_query($coneccion,$sql);
		if($Result){
			if(mysqli_affected_rows($coneccion)==1){
				return(1);
			}else{
				return(0);
			}			
		}else{
			throw new Exception("MySQL ERROR : " . mysqli_error($coneccion));
		}
		
		//mysqli_free_result($Result);
		//mysqli_close($con);
		
	}catch(Exception $e){
	 	$jsondata[] = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage()));
		echo json_encode($jsondata);
		exit;
	}		
	
}

?>
