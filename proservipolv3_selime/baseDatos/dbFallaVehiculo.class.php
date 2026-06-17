<?
// INICIO DE FUNCIONES

Class dbFallaVehiculo extends Conexion
{			
	function listaFallaVehiculo($fallas){
		 
		 $sql = "SELECT 
                 TFALLA_CODIGO,
                 TFALLA_DESCRIPCION
                 FROM
                 TIPO_FALLA_VEHICULO WHERE TFALLA_ACTIVO=1";
	     
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
}//end class   
?>