<?
Class dbCertificacion extends Conexion{
	
	function validar($unidad, $codFuncionario, $fecha){
		
		$sql = "INSERT INTO SERVICIOS_CERTIFICADO VALUES ('".$unidad."','".$fecha."',CURDATE(),'".$codFuncionario."');";
		
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function desvalidar($unidad, $codFuncionario, $fecha, $ip){
		
		$sql1 = "INSERT INTO SERVICIOS_DESVALIDADOS VALUES ('".$unidad."','".$fecha."',CURDATE(),'".$codFuncionario."','".$ip."','');";
  	$sql2 = "DELETE FROM SERVICIOS_CERTIFICADO WHERE UNI_CODIGO = '".$unidad."' AND FECHA_SERVICIOS ='".$fecha."';";
  	
		$result1 = $this->execstmt($this->Conecta(),$sql1);
		$result2 = $this->execstmt($this->Conecta(),$sql2);
		
		mysql_close();
		return $result1;
	}

}