<?
// INICIO DE FUNCIONES

Class dbMarcaVehiculo extends Conexion
{			
	function listaMarcasVehiculos($marcas){
		 
		 $sql = "SELECT 
				  MARCA_VEHICULO.MVEH_CODIGO,
				  MARCA_VEHICULO.MVEH_DESCRIPCION
				FROM
				  MARCA_VEHICULO ORDER BY MARCA_VEHICULO.MVEH_DESCRIPCION";
	     
	     
	     //echo $sql;
	     $result = $this->execstmt($this->Conecta(),$sql);
	     mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$marca = new marcaVehiculo;
		 	$marca->setCodigo(STRTOUPPER($myrow["MVEH_CODIGO"]));
		 	$marca->setDescripcion(STRTOUPPER($myrow["MVEH_DESCRIPCION"]));
		 			 	
		 	$marcas[$i] = $marca;
		 	$i++;
		 }
	}
}//end class   
?>