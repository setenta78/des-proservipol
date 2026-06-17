<?
// INICIO DE FUNCIONES

Class dbFallaVehiculo extends Conexion{
				
	function listaFallaVehiculo($fallas){
		 
		 $sql = "SELECT 
                 TFALLA_CODIGO,
                 TFALLA_DESCRIPCION
                 FROM
                 TIPO_FALLA_VEHICULO WHERE TFALLA_ACTIVO = 1";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result) ){
		 	$falla = new fallaVehiculo;
		 	$falla->setCodigo($myrow["TFALLA_CODIGO"]);
		 	$falla->setDescripcion($myrow["TFALLA_DESCRIPCION"]);
		 	
		 	$fallas[$i] = $falla;
		 	$i++;
		 }
	}
	
	function FallaVehiculoPendiente($codVehiculo,$unidad,$dias,$fallas){
		 /*
		 $sql = "SELECT 
       					E.CORRELATIVO_ESTADOVEHICULO,
       					E.VEH_CODIGO,
       					E.FECHA_DESDE
						FROM ESTADO_VEHICULO E
						WHERE E.EST_CODIGO IN (31,32)
      				AND E.UNI_CODIGO = ".$unidad."
      				AND CURDATE() >= (E.FECHA_HASTA + INTERVAL ".$dias." DAY)
      				AND E.ARCHIVO IS NULL 
      				AND E.FECHA_DESDE > '20160801' ";
	   */  				 
	   
	   $sql = "SELECT 
       					(E.CORRELATIVO_ESTADOVEHICULO)-1,
       					E.VEH_CODIGO,
       					E.FECHA_DESDE
						FROM ESTADO_VEHICULO E
						WHERE E.EST_CODIGO = 1000
      				AND E.UNI_CODIGO = ".$unidad."
      				AND CURDATE() >= (E.FECHA_DESDE + INTERVAL 3 DAY)
      				AND E.FECHA_HASTA IS NULL";
	   
	   //echo $sql;
	   
	   if($codVehiculo!="")$sql = $sql." AND E.VEH_CODIGO = ".$codVehiculo." ";
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	
		 	$falla = new fallaPospuesta;
		 	$falla->setCodigo_Vehiculo($myrow["VEH_CODIGO"]);
		 	$falla->setCorrelativo_Estado($myrow["CORRELATIVO_ESTADOVEHICULO"]);
		 	$falla->setFecha_Desde($myrow["FECHA_DESDE"]);
		 	
		 	$fallas[$i] = $falla;
		 	$i++;
		 }
	}
	
	function insertFallas($correlativo, $codigoVehiculo, $unidad, $Fallas){
		
		$ListaFallas = unserialize(stripslashes($Fallas));
		
		$sql = "INSERT INTO FALLA_VEHICULO (CORRELATIVO_ESTADOVEHICULO ,VEH_CODIGO ,UNI_CODIGO ,TFALLA_CODIGO) 
				VALUES ";
				
		$cantidad = count($ListaFallas);
		
		for($i=0;$i < $cantidad;$i++){
			
			if($cantidad>1&&$i>0)	$sql = $sql.",";
			$sql = $sql."('".$correlativo."','".$codigoVehiculo."', '".$unidad."', '".$ListaFallas[$i]."')";
		  
		} 
				
		//echo $sql;
		//$result = 1;

		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	function updateArchivoFalla($correlativo, $codigoVehiculo, $archivo){
		
		$sql = "UPDATE ESTADO_VEHICULO
							SET ARCHIVO = '".$archivo."'
						WHERE CORRELATIVO_ESTADOVEHICULO = '".$correlativo."'
						AND VEH_CODIGO = '".$codigoVehiculo."'";
				
		//echo $sql;
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		
		return $result;
	}
	
	function FallaVehiculoLista($unidad,$dias,$fallas){
		 /*
		 $sql = "SELECT 
       					V.VEH_PATENTE,
       					T.TVEH_DESCRIPCION,
       					CONCAT(M.MVEH_DESCRIPCION,' ',MO.MODVEH_DESCRIPCION) MODELO
						FROM ESTADO_VEHICULO E
						JOIN VEHICULO V ON V.VEH_CODIGO = E.VEH_CODIGO
						JOIN TIPO_VEHICULO T ON T.TVEH_CODIGO = V.TVEH_CODIGO
						JOIN MARCA_VEHICULO M ON M.MVEH_CODIGO = V.MVEH_CODIGO
						JOIN MODELO_VEHICULO MO ON MO.MODVEH_CODIGO = V.MODVEH_CODIGO
						WHERE E.EST_CODIGO IN (31,32)
      				AND E.UNI_CODIGO = ".$unidad."
      				AND (CURDATE() >= (E.FECHA_HASTA + INTERVAL ".$dias." DAY) OR E.FECHA_HASTA IS NULL)
      				AND E.ARCHIVO IS NULL 
      				AND E.FECHA_DESDE > '20160801' ";
	   */  				 
	   
	   $sql = "SELECT 
       					V.VEH_PATENTE,
       					T.TVEH_DESCRIPCION,
       					CONCAT(M.MVEH_DESCRIPCION,' ',MO.MODVEH_DESCRIPCION) MODELO
						FROM ESTADO_VEHICULO E
						JOIN VEHICULO V ON V.VEH_CODIGO = E.VEH_CODIGO
						JOIN TIPO_VEHICULO T ON T.TVEH_CODIGO = V.TVEH_CODIGO
						JOIN MARCA_VEHICULO M ON M.MVEH_CODIGO = V.MVEH_CODIGO
						JOIN MODELO_VEHICULO MO ON MO.MODVEH_CODIGO = V.MODVEH_CODIGO
						WHERE E.EST_CODIGO = 1000
      				AND E.UNI_CODIGO = ".$unidad."
      				AND CURDATE() >= (E.FECHA_DESDE + INTERVAL ".$dias." DAY)
      				AND E.FECHA_HASTA IS NULL";
	   
	   //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	
		 	$falla = new vehiculo;
		 	$falla->setPatente($myrow["VEH_PATENTE"]);
		 	$falla->setTipoVehiculo($myrow["TVEH_DESCRIPCION"]);
		 	$falla->setModeloVehiculo($myrow["MODELO"]);
		 	
		 	$fallas[$i] = $falla;
		 	$i++;
		 }
	}

}//end class   
?>