<?
// INICIO DE FUNCIONES

Class dbMarcaArma extends Conexion
{			
	function listaMarcasArmas($marcas){
		 
		 $sql = "SELECT 
				  MARCA_ARMA.MARM_CODIGO,
				  MARCA_ARMA.MARM_DESCRIPCION
				FROM
				  MARCA_ARMA";
	     
	     
	     //echo $sql;
	     $result = $this->execstmt($this->Conecta(),$sql);
	     mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$marca = new marcaArma;
		 	$marca->setCodigo(STRTOUPPER($myrow["MARM_CODIGO"]));
		 	$marca->setDescripcion(STRTOUPPER($myrow["MARM_DESCRIPCION"]));
		 			 	
		 	$marcas[$i] = $marca;
		 	$i++;
		 }
	}
}//end class   
?>