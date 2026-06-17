<?
Class dbArmas extends Conexion{	
	
	function listaTotalArmas($nSerie,$codigo,$armas){
		
		$condicion = ($codigo=="") ? "A.ARM_NUMEROSERIE LIKE '%{$nSerie}%'" : "A.ARM_CODIGO = {$codigo}";
		
		$sql = "SELECT 
					A.ARM_CODIGO,
					A.ARM_NUMEROSERIE,
					T.TARM_DESCRIPCION,
					IF(ISNULL(MA.MARM_DESCRIPCION),'NO INDICA',MA.MARM_DESCRIPCION) MARM_DESCRIPCION,
					IF(ISNULL(MO.MODARM_DESCRIPCION),'NO INDICA',MO.MODARM_DESCRIPCION) MODARM_DESCRIPCION,
					IF(ISNULL(U.UNI_DESCRIPCION),'SIN UNIDAD',U.UNI_DESCRIPCION) UNI_DESCRIPCION
				FROM ARMA A
				JOIN TIPO_ARMA T ON T.TARM_CODIGO = A.TARM_CODIGO
				LEFT JOIN MODELO_ARMA MO ON MO.MODARM_CODIGO = A.MODARM_CODIGO
				LEFT JOIN MARCA_ARMA MA ON MA.MARM_CODIGO = MO.MARM_CODIGO
				LEFT JOIN UNIDAD U ON U.UNI_CODIGO = A.UNI_CODIGO
				WHERE {$condicion}
				ORDER BY A.ARM_NUMEROSERIE ASC
				LIMIT 21";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$arma = new arma;
			$arma->setCodigo(STRTOUPPER($myrow["ARM_CODIGO"]));
			$arma->setNumeroSerie(STRTOUPPER($myrow["ARM_NUMEROSERIE"]));
			$arma->setModelo(STRTOUPPER($myrow["MARM_DESCRIPCION"])." ".STRTOUPPER($myrow["MODARM_DESCRIPCION"]));
			$arma->setTipo(STRTOUPPER($myrow["TARM_DESCRIPCION"]));
			$arma->setUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));
			
			$armas[$i] = $arma;
			$i++;
		}
	}
}

?>