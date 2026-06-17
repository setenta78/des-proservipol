<?
// INICIO DE FUNCIONES

Class dbModeloVehiculo extends Conexion
{			
	function listaModelosVehiculos($marca, $modelos){
		 
		 $sql = "SELECT 
				  MARCA_VEHICULO.MVEH_CODIGO,
				  MARCA_VEHICULO.MVEH_DESCRIPCION,
				  MODELO_VEHICULO.MODVEH_CODIGO,
				  MODELO_VEHICULO.MODVEH_DESCRIPCION
				FROM
				  MODELO_VEHICULO
				  INNER JOIN MARCA_VEHICULO ON (MODELO_VEHICULO.MVEH_CODIGO = MARCA_VEHICULO.MVEH_CODIGO)";
	     
	     if ($marca != "") $sql .= " WHERE MODELO_VEHICULO.MVEH_CODIGO = ".$marca;
	     
	     $sql .= " ORDER BY MODELO_VEHICULO.MODVEH_DESCRIPCION";
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$marca = new marcaVehiculo;
		 	$marca->setCodigo(STRTOUPPER($myrow["MVEH_CODIGO"]));
		 	$marca->setDescripcion(STRTOUPPER($myrow["MVEH_DESCRIPCION"]));
		 	
		 	
		 	$modelo = new modeloVehiculo;
		 	$modelo->setMarca($marca);
		 	$modelo->setCodigo(STRTOUPPER($myrow["MODVEH_CODIGO"]));
		 	$modelo->setDescripcion(STRTOUPPER($myrow["MODVEH_DESCRIPCION"]));
		 	
		 	$modelos[$i] = $modelo;
		 	$i++;
		 }
	}
}//end class   
?>