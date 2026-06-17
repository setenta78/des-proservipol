<?
Class dbArbolUnidad
{			

	function listarArbolUnidad($padre,$listadoArbolUnidad,$cantidadArbolUnidad){


		$sql = "SELECT 
           UNI_CODIGO,
  				 UNI_PADRE,
  				 UNI_DESCRIPCION,
  				 UNI_TIPOUNIDAD
				FROM
				  UNIDAD
				WHERE 1";

        $sql .= " AND UNIDAD.UNI_PADRE = '".$padre."'";

	
		$sql .= " ORDER BY UNIDAD.UNI_PADRE ASC";
		
		//echo $sql;
										
    $CONECT = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
    mysql_select_db(DB_DB_1);

    $result = mysql_query($sql,$CONECT);
    mysql_close();

		$i = 0;
		while($myrow = mysql_fetch_array($result)) {

			$arbolUnidad = new arbolUnidad;
			$arbolUnidad->setUnidad($myrow["UNI_CODIGO"]);
			$arbolUnidad->setPadre($myrow["UNI_PADRE"]);
			$arbolUnidad->setDescripcion($myrow["UNI_DESCRIPCION"]);
			$arbolUnidad->setTipoUnidad($myrow["UNI_TIPOUNIDAD"]);
			
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
  				 UNI_TIPOUNIDAD
				FROM
				  UNIDAD
				WHERE 1";

    //$sql .= " AND UNIDAD.UNI_CODIGO != '".$unidad."'";


    $sql .= " AND
    
    CASE WHEN (SELECT UNI_PADRE FROM UNIDAD WHERE UNIDAD.UNI_CODIGO = '".$unidad."') IS NULL THEN UNIDAD.UNI_PADRE IS NULL
    
    ELSE UNIDAD.UNI_PADRE IN (SELECT UNI_PADRE FROM UNIDAD WHERE UNIDAD.UNI_CODIGO = '".$unidad."' ) END ";
    
		$sql .= " ORDER BY UNIDAD.UNI_CODIGO ASC";
		
		//echo $sql;
										
    $CONECT = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
    mysql_select_db(DB_DB_1);

    $result = mysql_query($sql,$CONECT);
    mysql_close();
    
		$i = 0;
		while($myrow = mysql_fetch_array($result)) {

			$arbolUnidad = new arbolUnidad;
			$arbolUnidad->setUnidad($myrow["UNI_CODIGO"]);
			$arbolUnidad->setPadre($myrow["UNI_PADRE"]);
			$arbolUnidad->setDescripcion($myrow["UNI_DESCRIPCION"]);
			$arbolUnidad->setTipoUnidad($myrow["UNI_TIPOUNIDAD"]);
			
			$listadoArbolUnidad[$i] = $arbolUnidad;				
			$i++;
		}
		$cantidadArbolUnidad = $i;
	}









}//end class   
?>