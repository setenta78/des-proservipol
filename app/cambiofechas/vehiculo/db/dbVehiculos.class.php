<?
Class dbVehiculos extends Conexion{	
	
	function listaTotalVehiculos($patente,$vehiculos){
				  
		$sql = "SELECT 
							V.VEH_CODIGO,
							V.VEH_PATENTE,
							V.VEH_COD_EQUIPO_SAP,
							T.TVEH_DESCRIPCION,
							IF(ISNULL(MA.MVEH_DESCRIPCION),'NO INDICA',MA.MVEH_DESCRIPCION) MVEH_DESCRIPCION,
							IF(ISNULL(MO.MODVEH_DESCRIPCION),'NO INDICA',MO.MODVEH_DESCRIPCION) MODVEH_DESCRIPCION,
							IF(ISNULL(U.UNI_DESCRIPCION),'SIN UNIDAD',U.UNI_DESCRIPCION) UNI_DESCRIPCION		
						FROM VEHICULO V
						JOIN TIPO_VEHICULO T ON T.TVEH_CODIGO = V.TVEH_CODIGO
						LEFT JOIN MARCA_VEHICULO MA ON MA.MVEH_CODIGO = V.MVEH_CODIGO
						LEFT JOIN MODELO_VEHICULO MO ON MO.MODVEH_CODIGO = V.MODVEH_CODIGO 
						LEFT JOIN UNIDAD U ON U.UNI_CODIGO = V.UNI_CODIGO
						WHERE V.VEH_PATENTE LIKE '%".$patente."%'
						ORDER BY V.VEH_PATENTE ASC
						LIMIT 21";
				
				$i=0;
				$result = $this->execstmt($this->Conecta(),$sql);
				mysql_close();
				while($myrow = mysql_fetch_array($result)){
					
					$vehiculo = new vehiculo;
					$vehiculo->setCodigoVehiculo(STRTOUPPER($myrow["VEH_CODIGO"]));
					$vehiculo->setPatente(STRTOUPPER($myrow["VEH_PATENTE"]));
					$vehiculo->setBcu(STRTOUPPER($myrow["VEH_COD_EQUIPO_SAP"]));
					$vehiculo->setModelo(STRTOUPPER($myrow["MVEH_DESCRIPCION"])." ".STRTOUPPER($myrow["MODVEH_DESCRIPCION"]));
					$vehiculo->setTipo(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));
					$vehiculo->setUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
					
					$vehiculos[$i] = $vehiculo;			
					$i++;
				}	
	}
	
}
	
?>