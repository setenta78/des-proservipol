<?
Class dbMarcaCamaras extends Conexion{

	function listaMarcasCamaras($marcas){
		
		$sql = "SELECT 
					M.MVC_CODIGO,
					M.MVC_DESCRIPCION
				FROM MARCA_VIDEOCAMARA M";

		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
		 	$marca = new marcaCamara;
		 	$marca->setCodigo($myrow["MVC_CODIGO"]);
		 	$marca->setDescripcion(STRTOUPPER($myrow["MVC_DESCRIPCION"]));
		 	$marcas[$i] = $marca;
		 	$i++;
		}
	}
}
?>