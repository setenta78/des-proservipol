<?//Lista cuadrantes sin el cuadrante OTROS y con demanda
// INICIO DE FUNCIONES

Class dbCuadrantes extends Conexion
{			
	function listaCuadrantesUnidad($codUnidad, $unidad){
		 
		$sql = "SELECT
				  UNIDAD_CUADRANTE.CUADRANTE_CODIGO,
				  UNIDAD_CUADRANTE.CUA_CODIGO,
				  UNIDAD_CUADRANTE.CUA_DEMANDA,
				  CUADRANTE.CUA_DESCRIPCION,
				  CUADRANTE.CUA_ABREVIATURA,
				  UNIDAD_CUADRANTE.UNI_CODIGO,
				  UNIDAD.UNI_DESCRIPCION,
				  UNIDAD_CUADRANTE.ACTIVO
				FROM
				  UNIDAD_CUADRANTE
				  INNER JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				  INNER JOIN UNIDAD ON (UNIDAD_CUADRANTE.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE UNIDAD_CUADRANTE.ACTIVO = 1 AND UNIDAD_CUADRANTE.UNI_CODIGO = ".$codUnidad." AND UNIDAD_CUADRANTE.CUA_CODIGO <> 0";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 $unidad = new unidad;
		 while($myrow = mysql_fetch_array($result)){
			$cuadrante = new cuadrante;
		 	$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
		 	$cuadrante->setDescripcion($myrow["CUA_DESCRIPCION"]);
		 	$cuadrante->setAbreviatura($myrow["CUA_ABREVIATURA"]);
		 	$cuadrante->setDemanda($myrow["CUA_DEMANDA"]);
		 	
		 	
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			$unidad->setCuadrantes($cuadrante);
		 }
	}
	
}//end class   
?>