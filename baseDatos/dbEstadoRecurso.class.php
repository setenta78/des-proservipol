<?
// INICIO DE FUNCIONES

Class dbEstadoRecurso extends Conexion {
	
	function listaEstadosRecursos($estados, $tipo){
		if ($tipo == "VEH") $sqlFiltro = "ESTADO.EST_VEHICULO = 1";
		if ($tipo == "ARM") $sqlFiltro = "ESTADO.EST_ARMA = 1";
		if ($tipo == "CAM") $sqlFiltro = "ESTADO.EST_CAMARA_CORPORAL = 1";
		if ($tipo == "CAM1") $sqlFiltro = "ESTADO.EST_CAMARA_CORPORAL = 1 AND ESTADO.EST_CODIGO NOT IN (3600)";
		
		$sql = "SELECT 
				  		ESTADO.EST_CODIGO,
				  		ESTADO.EST_DESCRIPCION,
				  		ESTADO.EST_ABREVIATURA
			 			FROM ESTADO WHERE ". $sqlFiltro;
		
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
	
	function listaEstadoAnimal($estados){
		$sql = "SELECT 
						  ESTADO.EST_CODIGO,
						  ESTADO.EST_DESCRIPCION,
						  ESTADO.EST_ABREVIATURA
						FROM ESTADO WHERE EST_CODIGO IN(10,40,120,3000)";
		
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
	
	function listaEstadoSimccar($estados, $filtro){
		if ($filtro == "nueva") $sqlFiltro = "(10,3000)";
		if ($filtro == "mod1") $sqlFiltro = "(10,60,130,140,3000)";
		if ($filtro == "mod2") $sqlFiltro = "(10,3000)";
		if ($filtro == "mod3") $sqlFiltro = "(130,140)";
		
		$sql = "SELECT 
		  ESTADO.EST_CODIGO,
		  ESTADO.EST_DESCRIPCION,
		  ESTADO.EST_ABREVIATURA
		FROM ESTADO WHERE EST_CODIGO IN ".$sqlFiltro;
						
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
	
	function listaEstadosVehiculosLimitado($estados){
		
		$sql = "SELECT 
					  ESTADO.EST_CODIGO,
		  			ESTADO.EST_DESCRIPCION,
		  			ESTADO.EST_ABREVIATURA
						FROM ESTADO WHERE ESTADO.EST_CODIGO IN (1000)";
	  
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