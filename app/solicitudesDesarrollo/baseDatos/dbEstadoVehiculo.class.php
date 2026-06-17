<?
// INICIO DE FUNCIONES

Class dbEstadoVehiculo extends Conexion
{			
	function listaEstadosVehiculos($estados){
		 
		 $sql = "SELECT 
				  estado_vehiculo.Est_Codigo,
				  estado_vehiculo.Est_Descripcion,
				  estado_vehiculo.Est_Abreviatura
				 FROM
				  estado_vehiculo";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$estado = new estadoVehiculo;
		 	$estado->setCodigo(STRTOUPPER($myrow["Est_Codigo"]));
		 	$estado->setDescripcion(STRTOUPPER($myrow["Est_Descripcion"]));
		 	
		 	$estados[$i] = $estado;
		 	$i++;
		 }
	}
}//end class   
?>