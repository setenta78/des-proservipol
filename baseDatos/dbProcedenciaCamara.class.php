<?
Class dbProcedenciaCamara extends Conexion{
	
	function listaProcedenciaCamara($procedencias){
		$sql = "SELECT 
					PROCEDENCIA_RECURSO.PREC_CODIGO,
					PROCEDENCIA_RECURSO.PREC_DESCRIPCION
				FROM PROCEDENCIA_RECURSO";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
		$procedencia = new procedenciaCamara;
		$procedencia->setCodigo(STRTOUPPER($myrow["PREC_CODIGO"]));
		$procedencia->setDescripcion(STRTOUPPER($myrow["PREC_DESCRIPCION"]));
		$procedencias[$i] = $procedencia;
		$i++;
		}
	}
}
?>