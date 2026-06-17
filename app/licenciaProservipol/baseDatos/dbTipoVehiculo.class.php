<?
// INICIO DE FUNCIONES

Class dbTipoVehiculo extends Conexion
{			
	function listaTipoVehiculos($tipos){
		 
		 $sql = "SELECT 
				  TIPO_VEHICULO.TVEH_CODIGO,
				  TIPO_VEHICULO.TVEH_DESCRIPCION
				FROM
				  TIPO_VEHICULO";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$tipo = new tipoVehiculo;
		 	$tipo->setCodigo(STRTOUPPER($myrow["TVEH_CODIGO"]));
		 	$tipo->setDescripcion(STRTOUPPER($myrow["TVEH_DESCRIPCION"]));
		 	
		 	$tipos[$i] = $tipo;
		 	$i++;
		 }
	}
}//end class   
?>