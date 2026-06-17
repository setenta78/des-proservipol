<?
class fechaHora{	

	var $descripcionMes = array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE', 'NOVIEMBRE','DICIEMBRE');

	
	function formatoEspanolFecha($fecha){
		$fechaPaso  = explode("-",$fecha);
   		$fechaFinal	= $fechaPaso[2] . "-" . $fechaPaso[1] . "-". $fechaPaso[0];
		return $fechaFinal;
	}
	
	
	function formatoFechaCompleta($fecha){
		$fechaPaso   = explode("-",$fecha);
		$numeroMes 	 = ($fechaPaso[1]*1)-1;
		$mesCompleto = $this->descripcionMes[$numeroMes];
   		$fechaFinal	 = $fechaPaso[2] . " DE " . $mesCompleto . " DEL ". $fechaPaso[0];
		return $fechaFinal;
	}
	
		
	// comparar fechas
	// si >0 fecha1 es mayor que fecha2
	// si <0 fecha1 es menor que fecha2
	// si =0 fecha1 es igual que fecha2	
		
	function compara_fechas($fecha1,$fecha2){
      	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1)) list($dia1,$mes1,$año1)=split("/",$fecha1);
	  	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1)) list($dia1,$mes1,$año1)=split("-",$fecha1);
      	if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2)) list($dia2,$mes2,$año2)=split("/",$fecha2);
	  	if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2)) list($dia2,$mes2,$año2)=split("-",$fecha2);
      	$dif = mktime(0,0,0,$mes1,$dia1,$año1) - mktime(0,0,0, $mes2,$dia2,$año2);
      	return ($dif);                         
	}

 

	
	
}//end class   
?>