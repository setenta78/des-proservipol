<?
Class dbVehiculos extends Conexion{	
	
	function nuevoVehiculo($vehiculo){ 
		
		$sql = "INSERT INTO VEHICULO 
			   (TVEH_CODIGO, PREC_CODIGO, VEH_BCU, VEH_SAP, UNI_CODIGO, MVEH_CODIGO, MODVEH_CODIGO, VEH_PATENTE, VEH_NUMEROINSITUCIONAL, ANNO_FABRICACION, VALIDA_ANNO_FABRICACION) VALUES
		 	   ( ".$vehiculo->getTipo().",
		 	     ".$vehiculo->getProcedencia().",
		 	    'SAP ".$vehiculo->getBCU()."',
		 	    '".$vehiculo->getBCU()."',
		 	     ".$vehiculo->getUnidad().",
		 	     ".$vehiculo->getMarca().",
		 	     ".$vehiculo->getModelo().",
		 	     '".$vehiculo->getPatente()."',
		 	     '".$vehiculo->getNumeroInstitucional()."',
		 	     ".$vehiculo->getAnnoFabricacion().",
		 	     1)";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function insertEstadoVehiculo($vehiculo, $fechaEstado){
		
		$sql = "INSERT INTO ESTADO_VEHICULO (VEH_CODIGO, UNI_CODIGO, EST_CODIGO, FECHA_DESDE)
				VALUES ((SELECT VEHICULO.VEH_CODIGO	FROM VEHICULO
								WHERE VEHICULO.VEH_SAP = '".$vehiculo->getBCU()."'),".$vehiculo->getUnidad().",".$vehiculo->getEstado().",'".$fechaEstado."')";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function buscaDatosVehiculo($bcuVehiculo, $cantidad){
      
		$sql = "SELECT 
				  VEHICULO.VEH_CODIGO,
				  VEHICULO.VEH_BCU
				FROM VEHICULO
				WHERE VEHICULO.VEH_BCU = 'SAP ".$bcuVehiculo."'";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$cantidad++;
		}
	}
	
}
	
?>