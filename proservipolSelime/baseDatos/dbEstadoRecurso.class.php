<?
// INICIO DE FUNCIONES

Class dbEstadoRecurso extends Conexion
{			
	function listaEstadosRecursos($estados, $tipo){
		 
		 if ($tipo == "VEH") $sqlFiltro = "ESTADO.EST_VEHICULO = 1";
		 if ($tipo == "ARM") $sqlFiltro = "ESTADO.EST_ARMA = 1";
		 
		 $sql = "SELECT 
  				  ESTADO.EST_CODIGO,
  				  ESTADO.EST_DESCRIPCION,
  				  ESTADO.EST_ABREVIATURA
				 FROM
				  ESTADO WHERE ". $sqlFiltro;
			  
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$estado = new estadoRecurso;
		 	$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
		 	$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
		 	
		 	$estados[$i] = $estado;
		 	$i++;
		 }
	}
}//end class   
?>