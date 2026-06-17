<?
// INICIO DE FUNCIONES

Class dbCuadrantes extends Conexion
{			
	function listaCuadrantesUnidad($codUnidad, $unidad){
		 
		$sql = "SELECT
				  UNIDAD_CUADRANTE.CUADRANTE_CODIGO,
				  UNIDAD_CUADRANTE.CUA_CODIGO,
				  CUADRANTE.CUA_DESCRIPCION,
				  CUADRANTE.CUA_ABREVIATURA,
				  UNIDAD_CUADRANTE.UNI_CODIGO,
				  UNIDAD.UNI_DESCRIPCION,
				  UNIDAD_CUADRANTE.ACTIVO,
				  UNIDAD.UNI_PADRE
				FROM
				  UNIDAD_CUADRANTE
				  INNER JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				  INNER JOIN UNIDAD ON (UNIDAD_CUADRANTE.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				WHERE UNIDAD_CUADRANTE.ACTIVO = 1 AND UNIDAD_CUADRANTE.UNI_CODIGO = " . $codUnidad ."
				ORDER BY CUADRANTE.CUA_DESCRIPCION";
		
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
		 	
		 	
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			$unidad->setCuadrantes($cuadrante);
			$unidad->setPadreUnidad($myrow["UNI_PADRE"]); //A�adido
		 }
	}
	
	function listaCuadrantesEspecializadas($codUnidad, $unidad,$unidadUsuario,$tipoUnidad,$correlativo){
	
	if($tipoUnidad == 30 || $tipoUnidad == 120){
		if($correlativo!=""){
			$disponible="	AND 
		                UNIDAD_CUADRANTE.CUADRANTE_CODIGO NOT IN(
				        SELECT 
                        CUADRANTE_SERVICIO.CUADRANTE_CODIGO
                        FROM 
                        CUADRANTE_SERVICIO
                        WHERE
                        CUADRANTE_SERVICIO.UNI_CODIGO=".$unidadUsuario." AND
                        CORRELATIVO_SERVICIO=".$correlativo."
                )";
		}else{
			$disponible="";
		}
		//echo $disponible;
		$sql="SELECT DISTINCT
				  UNIDAD_CUADRANTE.CUADRANTE_CODIGO,
				  UNIDAD_CUADRANTE.CUA_CODIGO,
				  CUADRANTE.CUA_DESCRIPCION,
				  CUADRANTE.CUA_ABREVIATURA,
				  UNIDAD_CUADRANTE.UNI_CODIGO,
				  UNIDAD.UNI_PADRE,
				  UNIDAD.UNI_DESCRIPCION,
				  UNIDAD_CUADRANTE.ACTIVO
				FROM
				  UNIDAD_CUADRANTE
				  INNER JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				  INNER JOIN UNIDAD ON (UNIDAD_CUADRANTE.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				  LEFT OUTER JOIN CUADRANTE_SERVICIO ON (UNIDAD_CUADRANTE.CUADRANTE_CODIGO=CUADRANTE_SERVICIO.CUADRANTE_CODIGO)
				  WHERE UNIDAD_CUADRANTE.CUA_CODIGO <> 0 AND UNIDAD_CUADRANTE.ACTIVO = 1 AND UNIDAD_CUADRANTE.UNI_CODIGO = ". $codUnidad."" .$disponible;
		}
		// echo $sql;
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 $unidad = new unidad;
		 while($myrow = mysql_fetch_array($result)){
			$cuadrante = new cuadrante;
		 	$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
		 	$cuadrante->setDescripcion($myrow["CUA_DESCRIPCION"]);
		 	$cuadrante->setAbreviatura($myrow["CUA_ABREVIATURA"]);
		 	
		 	
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			$unidad->setCuadrantes($cuadrante);
			$unidad->setPadreUnidad($myrow["UNI_PADRE"]); //A�adido
			}
 }
	
}//end class   
?>