<?
// INICIO DE FUNCIONES

Class dbMovimiento extends Conexion
{			
	function listaMovimiento($factoresDemanda, $tipo){
		
		 if ($tipo == "180") $sqlFiltro = " TMOV_CODIGO IN(20,30,40,50,60,70,80,90,100)";
		 if ($tipo == "190") $sqlFiltro = " TMOV_CODIGO IN(30,40,50,60,70,90,100)";
		 if ($tipo == "200") $sqlFiltro = " TMOV_CODIGO IN(30,40,50,60,80,90,100)";
		 if ($tipo == "10") $sqlFiltro = " TMOV_CODIGO IN(90,100)";
		 
		$sql = "SELECT
				  TIPO_MOVIMIENTO.TMOV_CODIGO,
				  TIPO_MOVIMIENTO.TMOV_DESCRIPCION
				FROM
				  TIPO_MOVIMIENTO WHERE ". $sqlFiltro;
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
			$factorDemanda = new movimiento;
		 	$factorDemanda->setCodigo($myrow["TMOV_CODIGO"]);
		 	$factorDemanda->setDescripcion($myrow["TMOV_DESCRIPCION"]);

		 	
			$factoresDemanda[$i] = $factorDemanda;
			$i++;
		 }
	}
	
		function listaMovimiento2($factoresDemanda){
		 
		$sql = "SELECT
				  TIPO_MOVIMIENTO.TMOV_CODIGO,
				  TIPO_MOVIMIENTO.TMOV_DESCRIPCION
				FROM
				  TIPO_MOVIMIENTO WHERE TMOV_CODIGO IN(10,20,30)";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
			$factorDemanda = new movimiento;
		 	$factorDemanda->setCodigo($myrow["TMOV_CODIGO"]);
		 	$factorDemanda->setDescripcion($myrow["TMOV_DESCRIPCION"]);

		 	
			$factoresDemanda[$i] = $factorDemanda;
			$i++;
		 }
	}
	
		function listaMovimiento3($factoresDemanda){
		 
		$sql = "SELECT
				  TIPO_MOVIMIENTO.TMOV_CODIGO,
				  TIPO_MOVIMIENTO.TMOV_DESCRIPCION
				FROM
				  TIPO_MOVIMIENTO WHERE TMOV_CODIGO IN(40,50,60)";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
			$factorDemanda = new movimiento;
		 	$factorDemanda->setCodigo($myrow["TMOV_CODIGO"]);
		 	$factorDemanda->setDescripcion($myrow["TMOV_DESCRIPCION"]);

		 	
			$factoresDemanda[$i] = $factorDemanda;
			$i++;
		 }
	}
	
		function listaMovimiento4($factoresDemanda){
		 
		$sql = "SELECT
				  TIPO_MOVIMIENTO.TMOV_CODIGO,
				  TIPO_MOVIMIENTO.TMOV_DESCRIPCION
				FROM
				  TIPO_MOVIMIENTO WHERE TMOV_CODIGO IN(90)";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
			$factorDemanda = new movimiento;
		 	$factorDemanda->setCodigo($myrow["TMOV_CODIGO"]);
		 	$factorDemanda->setDescripcion($myrow["TMOV_DESCRIPCION"]);

		 	
			$factoresDemanda[$i] = $factorDemanda;
			$i++;
		 }
	}
	
}//end class   
?>