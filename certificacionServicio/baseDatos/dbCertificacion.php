<?
Class dbCertificacion extends Conexion{
	
	function validar($unidad, $codFuncionario, $fecha){
		
		$sql = "INSERT INTO SERVICIOS_CERTIFICADO VALUES ('{$unidad}','{$fecha}',CURDATE(),'{$codFuncionario}',CURTIME());";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function desvalidar($unidad, $codFuncionario, $fechaServ, $fechaVal, $horaVal, $motivo, $funValida, $ip){
		
		$sql1 = "INSERT INTO SERVICIOS_DESVALIDADOS VALUES ({$unidad},'{$fechaServ}','{$fechaVal}','{$codFuncionario}','{$ip}',CURDATE(),CURTIME(),{$motivo},'{$funValida}','{$horaVal}');";
  		$sql2 = "DELETE FROM SERVICIOS_CERTIFICADO WHERE UNI_CODIGO = {$unidad} AND FECHA_SERVICIOS = '{$fechaServ}';";
		
		$result1 = $this->execstmt($this->Conecta(),$sql1);
		if($result1){
			$result2 = $this->execstmt($this->Conecta(),$sql2);
			mysql_close();
			return $result2;
		}
		mysql_close();
		return $result1;
	}

}