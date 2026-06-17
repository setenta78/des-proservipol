<?
// INICIO DE FUNCIONES

Class dbEstadoRecurso extends Conexion
{			
	function listaEstadosRecursos($estados, $tipo){
		 
		 if ($tipo == "VEH") $sqlFiltro = " EST_CODIGO IN(10,21,31,32,40,50,1000,3000) AND ESTADO.EST_VEHICULO = 1";
		 if ($tipo == "ARM") $sqlFiltro = " EST_CODIGO IN(10,20,30,40,50,60,3000) AND ESTADO.EST_ARMA = 1";
		 
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
	
		function listaEstadoAnimal($estados, $tipo){
		 
		 		 $sql = "SELECT 
  				  ESTADO.EST_CODIGO,
  				  ESTADO.EST_DESCRIPCION,
  				  ESTADO.EST_ABREVIATURA
				 FROM
				  ESTADO WHERE EST_CODIGO IN(10,40,120,3000)";
			  
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$estado = new estadoAnimal;
		 	$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
		 	$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
		 	
		 	$estados[$i] = $estado;
		 	$i++;
		 }
	}
	
	function listaEstadoSimccar($estados, $tipo){
		 
		 		 $sql = "SELECT 
  				  ESTADO.EST_CODIGO,
  				  ESTADO.EST_DESCRIPCION,
  				  ESTADO.EST_ABREVIATURA
				 FROM
				  ESTADO WHERE EST_CODIGO IN(10,130,140,3000)";
			  
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$estado = new estadoAnimal;
		 	$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
		 	$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
		 	
		 	$estados[$i] = $estado;
		 	$i++;
		 }
	}
	
	function listaEstadoSimccar2($estados, $tipo){
		 
		 		 $sql = "SELECT 
  				  ESTADO.EST_CODIGO,
  				  ESTADO.EST_DESCRIPCION,
  				  ESTADO.EST_ABREVIATURA
				 FROM
				  ESTADO WHERE EST_CODIGO = 10";
			  
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$estado = new estadoAnimal;
		 	$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
		 	$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));
		 	
		 	$estados[$i] = $estado;
		 	$i++;
		 }
	}
	
}//end class   
?>