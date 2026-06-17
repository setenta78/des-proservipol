<?

function rules(){
	
	$codigoUnidad 		= $_GET['codigoUnidad'];
	$fecha				= $_GET['fecha'];
	
	$message = array();
	/*
	(isset($rutFuncionario)===false||$rutFuncionario==="") ? $message = $message + array("rutFuncionario" => "Se requiere que indique el Rut del Funcionario") : null;
	(isset($fechaDesde)===false||$fechaDesde==="") ? $message = $message + array("fechaDesde" => "Se requiere que indique la fecha desde") : null;
	(isset($fechaHasta)===false||$fechaHasta==="") ? $message = $message + array("fechaHasta" => "Se requiere que indique la fecha hasta") : null;
	
	preg_match('*\b'.preg_quote('-').'\b*i', $rutFuncionario) ? $message = $message + array("rutFuncionario" => "El Rut del Funcionario debe ir sin guion") : null;
	preg_match('*\b'.preg_quote('-').'\b*i', $fechaDesde) ? null : $message = $message + array("fechaDesde" => "La fecha Desde debe ser: DD-MM-YYYY");
	preg_match('*\b'.preg_quote('-').'\b*i', $fechaHasta) ? null : $message = $message + array("fechaHasta" => "La fecha Hasta debe ser: DD-MM-YYYY");
	
	$fechasFormat = explode('-', $fechaDesde);
	$fechaDesde  = date('Ymd',strtotime((strlen($fechasFormat[0])==2) ? $fechasFormat[2].$fechasFormat[1].$fechasFormat[0] : $fechasFormat[0].$fechasFormat[1].$fechasFormat[2]));
	$fechasFormat = explode('-', $fechaHasta);
	$fechaHasta  = date('Ymd',strtotime((strlen($fechasFormat[0])==2) ? $fechasFormat[2].$fechasFormat[1].$fechasFormat[0] : $fechasFormat[0].$fechasFormat[1].$fechasFormat[2]));
	
	($fechaDesde > $fechaHasta) ? $message = $message + array("fecha" => "La fecha Desde no puede ser mayor a la fecha Hasta") : null;
	*/
	if(count($message)>0){
		header("HTTP/1.0 412 Precondition Failed");
		return array("error" => $message, "code" => "412");
	}
	else{
		header("HTTP/1.1 200 OK");
		return array("codigoUnidad" 	=> $codigoUnidad,
		  	 		 "fecha"			=> $fecha);
	}
}
