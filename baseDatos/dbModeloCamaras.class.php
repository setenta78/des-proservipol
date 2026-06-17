<?
Class dbModeloCamaras extends Conexion{

	function listaModelosCamaras($marca, $modelos){
		
		$sql = "SELECT 
					MO.MODVC_CODIGO,
					MO.MODVC_DESCRIPCION
				FROM MODELO_VIDEOCAMARA MO
				WHERE MO.MVC_CODIGO = {$marca}";
	    
	    //echo $sql;    				
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
		 	$modelo = new modeloCamara;
		 	$modelo->setCodigo($myrow["MODVC_CODIGO"]);
		 	$modelo->setDescripcion(STRTOUPPER($myrow["MODVC_DESCRIPCION"]));
		 	$modelos[$i] = $modelo;
		 	$i++;
		}
	}
}
?>