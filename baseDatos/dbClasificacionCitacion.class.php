<?
Class dbClasificacionCitacion extends Conexion{

	function listaClasificacionCitacion($clasificacionCitacion){
		
        $sql = "SELECT 
                    TCLASIFICACION_CITACION_CODIGO,
                    TCLASIFICACION_CITACION_DESCRIPCION
                FROM TIPO_CLASIFICACION_CITACION
                WHERE TCLASIFICACION_CITACION_ACTIVO = 1
                ORDER BY TCLASIFICACION_CITACION_CODIGO ASC";
	    
	   	//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			$clasCitacion = new clasificacionCitacion;
			$clasCitacion->setCodigo($myrow["TCLASIFICACION_CITACION_CODIGO"]);
			$clasCitacion->setDescripcion($myrow["TCLASIFICACION_CITACION_DESCRIPCION"]);
			
		 	$clasificacionCitacion[$i] = $clasCitacion;
		 	$i++;
		}
	}

	function listaVehiculosSinClasificar($codigoUnidad, $vehiculos){
		
        $sql = "SELECT 
					V.VEH_CODIGO,
					V.VEH_PATENTE,
					T.TVEH_DESCRIPCION,
					E.EST_DESCRIPCION
				FROM ESTADO_VEHICULO EV
				JOIN VEHICULO V ON V.VEH_CODIGO = EV.VEH_CODIGO
				JOIN TIPO_VEHICULO T ON T.TVEH_CODIGO = V.TVEH_CODIGO
				JOIN ESTADO E ON E.EST_CODIGO = EV.EST_CODIGO 
				WHERE EV.EST_CODIGO IN (21,31,32,70,80)
				AND EV.UNI_CODIGO = {$codigoUnidad} AND EV.FECHA_HASTA IS NULL
				ORDER BY V.VEH_PATENTE ASC";
	    
	   	//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			
			$tipo = new tipoVehiculo;
			$tipo->setDescripcion(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));

			$estado = new estadoRecurso;
			$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
			
			$vehiculo = new vehiculo;
			$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
			$vehiculo->setTipoVehiculo($tipo);
			$vehiculo->setEstadoVehiculo($estado);
			$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));

			$vehiculos[$i] = $vehiculo;
		 	$i++;
		}
	}
	
	function insertClasificacionCitacion($lista){
		$cantidad = count($lista);
		for($i=0;$i < $cantidad;$i++){
			$sql = "UPDATE ESTADO_VEHICULO SET TCLASIFICACION_CITACION_CODIGO = {$lista[$i]->valor} WHERE VEH_CODIGO = {$lista[$i]->id} AND FECHA_HASTA IS NULL ";
			$result = $this->execstmt($this->Conecta(),$sql);
			//echo $sql;
		}
		mysql_close();
		return $result;
	}
}//end class
?>