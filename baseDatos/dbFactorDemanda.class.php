<?
Class dbFactorDemanda extends Conexion{
	function listaFactorDemanda($factoresDemanda){
		
		$sql = "SELECT
				  FACTORES.FACT_CODIGO,
				  FACTORES.FACT_DESCRIPCION,
				  FACTORES.FACT_ABREVIATURA
					FROM FACTORES";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
		$factorDemanda = new factor;
		$factorDemanda->setCodigo($myrow["FACT_CODIGO"]);
		$factorDemanda->setDescripcion($myrow["FACT_DESCRIPCION"]);
		$factorDemanda->setAbreviatura($myrow["FACT_ABREVIATURA"]);
		$factoresDemanda[$i] = $factorDemanda;
		$i++;
		}
	}
}
?>