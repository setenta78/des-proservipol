<?
Class dbMotivo extends Conexion{

	function listaMotivos($motivos){
		 
		$sql = "SELECT 
                    TDESVALIDACION_CODIGO,
                    TDESVALIDACION_DESCRIPCION
                FROM TIPO_DESVALIDACION
                WHERE ACTIVO = 1";
		
	     //echo $sql;
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
			$motivo = new motivo;
		 	$motivo->setCodigo(STRTOUPPER($myrow["TDESVALIDACION_CODIGO"]));
		 	$motivo->setDescripcion(STRTOUPPER($myrow["TDESVALIDACION_DESCRIPCION"]));
		 	
		 	$motivos[$i] = $motivo;
		 	$i++;
		 }
	}
}
