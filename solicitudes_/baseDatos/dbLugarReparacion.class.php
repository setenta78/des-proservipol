<?
// INICIO DE FUNCIONES

Class dbLugarReparacion extends Conexion
{			
	function listaLugarReparacion($lugaresDeReparacion){
		 
		 $sql = "SELECT 
  				  LUGAR_REPARACION.LREP_CODIGO,
  				  LUGAR_REPARACION.LREP_DESCRIPCION
				 FROM
				  LUGAR_REPARACION WHERE LUGAR_REPARACION.LREP_ACTIVO = 1";
			  
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$lugarDeReparacion = new lugarReparacion;
		 	$lugarDeReparacion->setCodigo(STRTOUPPER($myrow["LREP_CODIGO"]));
		 	$lugarDeReparacion->setDescripcion(STRTOUPPER($myrow["LREP_DESCRIPCION"]));
		 	
		 	$lugaresDeReparacion[$i] = $lugarDeReparacion;
		 	$i++;
		 }
	}
}//end class   
?>