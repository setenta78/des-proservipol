<?
// INICIO DE FUNCIONES

Class dbCargos extends Conexion
{			
	function listaCargos($tipoUnidad,$cargos){
		 
		 //$sql = "SELECT CAR_CODIGO, CAR_DESCRIPCION FROM CARGO  WHERE CAR_MOSTRAR = 1 AND CAR_ACTIVO = 1 ORDER BY CAR_DESCRIPCION";
		 
	 $sql = "SELECT 				  
		          CARGO_TUNIDAD.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION
				  FROM
				  CARGO_TUNIDAD
				  INNER JOIN CARGO ON (CARGO_TUNIDAD.CAR_CODIGO = CARGO.CAR_CODIGO)
				  WHERE
				  CARGO_TUNIDAD.UNI_TIPOUNIDAD = ".$tipoUnidad." AND 
			  CARGO_TUNIDAD.ACTIVO = 1 AND CARGO.CAR_CODIGO NOT IN(1000,2000,3500)	   		  
				  ORDER BY CARGO.CAR_DESCRIPCION";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result) ){
		 	$cargo = new cargo;
		 	$cargo->setCodigo($myrow["CAR_CODIGO"]);
		 	$cargo->setDescripcion($myrow["CAR_DESCRIPCION"]);
		 	
		 	$cargos[$i] = $cargo;
		 	$i++;
		 }
	}
}//end class   
?>