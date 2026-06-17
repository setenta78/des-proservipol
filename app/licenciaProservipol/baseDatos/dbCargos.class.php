<?
// INICIO DE FUNCIONES
//Funcion modificada el 30-04-2015
//Query fue modificada en forma total el 30-04-2015
Class dbCargos extends Conexion
{			
	function listaCargos($tipoUnidad,$cargos){
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