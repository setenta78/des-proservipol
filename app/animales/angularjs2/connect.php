<?php
	/*
	define('db_host', '192.168.0.68');
	define('db_user', 'admin');
	define('db_pass', '0000');
	define('db_name', 'BD_PRUEBA');
	*/
	
	define('db_host', '172.21.100.41');
	define('db_user', 'proservipolv3');
	define('db_pass', 'carta77');
	define('db_name', 'DB_PROSERVIPOL_V3');

	
	$conn = mysqli_connect(db_host,db_user,db_pass,db_name);
	
	$jsondata = array();

	if(mysqli_connect_errno()){
		try{
			throw new Exception("MySQL ERROR : ".mysqli_connect_error()."Servidor IP: ".db_host." ", mysqli_connect_errno());
		}catch(Exception $e){
			$jsondata[] = array('tipo' => 'error', 'mensaje' => utf8_encode($e->getMessage() . 'Error Nro:' . utf8_encode($e->getCode())));
			echo json_encode($jsondata);
			exit;
		}
	}
	
	
?>