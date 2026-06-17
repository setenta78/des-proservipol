<?
Class dbArbolUnidad extends conexion
{			

	function listarArbolUnidad($padre,$listadoArbolUnidad,$cantidadArbolUnidad){


		$sql = "SELECT 
           UNI_CODIGO,
  				 UNI_PADRE,
  				 UNI_DESCRIPCION,
  				 UNI_PLANCUADRANTE
				FROM
				  UNIDAD
				WHERE 1";

        $sql .= " AND UNIDAD.UNI_PADRE = '".$padre."'";

	
		$sql .= " ORDER BY UNIDAD.UNI_PADRE ASC";
		
		//echo $sql;
										
		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		$i = 0;
		while($myrow = mysql_fetch_array($result)) {

			$arbolUnidad = new arbolUnidad;
			$arbolUnidad->setUnidad($myrow["UNI_CODIGO"]);
			$arbolUnidad->setPadre($myrow["UNI_PADRE"]);
			$arbolUnidad->setDescripcion($myrow["UNI_DESCRIPCION"]);
			$arbolUnidad->setPlanCuadrante($myrow["UNI_PLANCUADRANTE"]);
			
			$listadoArbolUnidad[$i] = $arbolUnidad;				
			$i++;
		}
		$cantidadArbolUnidad = $i;
	}



	function listarArbolUnidadArriba($unidad,$listadoArbolUnidad,$cantidadArbolUnidad){

		$sql = "SELECT 
           UNI_CODIGO,
  				 UNI_PADRE,
  				 UNI_DESCRIPCION,
  				 UNI_PLANCUADRANTE
				FROM
				  UNIDAD
				WHERE 1";

    //$sql .= " AND UNIDAD.UNI_CODIGO != '".$unidad."'";


    $sql .= " AND
    
    CASE WHEN (SELECT UNI_PADRE FROM UNIDAD WHERE UNIDAD.UNI_CODIGO = '".$unidad."') IS NULL THEN UNIDAD.UNI_PADRE IS NULL
    
    ELSE UNIDAD.UNI_PADRE IN (SELECT UNI_PADRE FROM UNIDAD WHERE UNIDAD.UNI_CODIGO = '".$unidad."' ) END ";
    
		$sql .= " ORDER BY UNIDAD.UNI_CODIGO ASC";
		
		//echo $sql;
										
		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		$i = 0;
		while($myrow = mysql_fetch_array($result)) {

			$arbolUnidad = new arbolUnidad;
			$arbolUnidad->setUnidad($myrow["UNI_CODIGO"]);
			$arbolUnidad->setPadre($myrow["UNI_PADRE"]);
			$arbolUnidad->setDescripcion($myrow["UNI_DESCRIPCION"]);
			$arbolUnidad->setPlanCuadrante($myrow["UNI_PLANCUADRANTE"]);
			
			$listadoArbolUnidad[$i] = $arbolUnidad;				
			$i++;
		}
		$cantidadArbolUnidad = $i;
	}









}//end class   
?>