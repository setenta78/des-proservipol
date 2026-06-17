<?
// INICIO DE FUNCIONES

Class dbCargos extends Conexion
{			
	function listaCargos($cargos){
		 
		 $sql = "SELECT CAR_CODIGO, CAR_DESCRIPCION FROM CARGO  WHERE CAR_MOSTRAR = 1 AND CAR_ACTIVO = 1 ORDER BY CAR_DESCRIPCION";
	     
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