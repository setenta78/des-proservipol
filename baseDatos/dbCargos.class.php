<?
Class dbCargos extends Conexion{
	
	function listaCargos($tipoUnidad,$categoria,$unidadEspecialidad,$escalafon,$grado,$tipoUnidadNew,$especialidadUnidadNew,$codUnidad,$cargos){
		$filtroEscalafon = "JOIN ESCALAFON ON ESCALAFON.ESC_CODIGO = {$escalafon} AND CARGO.CAR_GRUPO5 != IF(ESCALAFON.FILTRO_SERVICIOS_OPERATIVOS=1,'OPERATIVO','')";
		if($tipoUnidadNew==0 && $especialidadUnidadNew==0){
			$filtro = ($unidadEspecialidad==80) ? " AND CARGO_TUNIDAD.UNI_TIPOUNIDAD = 1080 " : " AND CARGO_TUNIDAD.UNI_TIPOUNIDAD = {$tipoUnidad} ";
			
			$filtroFrontera = ($unidadEspecialidad==80 && $tipoUnidad ==33) ? "UNION SELECT C.CAR_CODIGO, C.CAR_DESCRIPCION FROM CARGO C WHERE C.CAR_CODIGO = 300" : "";
			$filtroCargoPostulaciones = ($codUnidad==455||$codUnidad==1245) ? "UNION SELECT C.CAR_CODIGO, C.CAR_DESCRIPCION FROM CARGO C WHERE C.CAR_CODIGO = 7400 AND C.CAR_GRUPO5 = '{$categoria}'" : "";
			$filtroCargoOCI = ($codUnidad==1175) ? "UNION SELECT C.CAR_CODIGO, C.CAR_DESCRIPCION FROM CARGO C WHERE C.CAR_CODIGO IN (10470,10480) AND C.CAR_GRUPO5 = '{$categoria}'" : "";
			
			$sql = "SELECT CARGO_TUNIDAD.CAR_CODIGO, CARGO.CAR_DESCRIPCION
					FROM CARGO_TUNIDAD
					JOIN CARGO ON (CARGO_TUNIDAD.CAR_CODIGO = CARGO.CAR_CODIGO)
					{$filtroEscalafon}
					WHERE CARGO_TUNIDAD.ACTIVO = 1 AND CARGO.CAR_CODIGO NOT IN(1000,2000,3500)
					{$filtro}
					AND CARGO.CAR_GRUPO5 = '{$categoria}'
					{$filtroFrontera}
					{$filtroCargoPostulaciones}
					{$filtroCargoOCI}
					ORDER BY CAR_DESCRIPCION ASC";
		}
		else{
			$sql = "SELECT CARGO_CUARTEL.CAR_CODIGO, CARGO.CAR_DESCRIPCION
					FROM CARGO_CUARTEL
					JOIN CARGO ON (CARGO_CUARTEL.CAR_CODIGO = CARGO.CAR_CODIGO)
					{$filtroEscalafon}
					JOIN TIPO_CUARTEL ON (CARGO_CUARTEL.TCU_CODIGO = TIPO_CUARTEL.TCU_CODIGO)
					JOIN TIPO_ESPECIALIDAD_CUARTEL ON (CARGO_CUARTEL.TESPC_CODIGO = TIPO_ESPECIALIDAD_CUARTEL.TESPC_CODIGO)
					JOIN GRUPO_CARGO ON (CARGO_CUARTEL.GCAR_CODIGO = GRUPO_CARGO.GCAR_CODIGO)
					WHERE CARGO_CUARTEL.TCU_CODIGO = {$tipoUnidadNew} AND CARGO_CUARTEL.TESPC_CODIGO = {$especialidadUnidadNew} AND GRUPO_CARGO.GCAR_DESCRIPCION = '{$categoria}'
					ORDER BY CARGO_CUARTEL.ORDEN ASC";
		}
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
			$cargo = new cargo;
			$cargo->setCodigo($myrow["CAR_CODIGO"]);
			$cargo->setDescripcion($myrow["CAR_DESCRIPCION"]);
			$cargos[$i] = $cargo;
			$i++;
		}
	}
	
	function listaCategoriaCargos($tipoUnidad,$unidadTipo,$escalafon,$grado,$tipoUnidadNew,$especialidadUnidadNew,$categoria){
		$filtroEscalafon = "JOIN ESCALAFON ON (ESCALAFON.ESC_CODIGO = {$escalafon} AND CARGO.CAR_GRUPO5 != IF(ESCALAFON.FILTRO_SERVICIOS_OPERATIVOS=1,'OPERATIVO',''))";
		if($tipoUnidadNew==0 && $especialidadUnidadNew==0){
			$filtro = ($unidadTipo == 1 || $unidadTipo == 2) ? " AND CARGO.CAR_GRUPO5 NOT IN ('INTRACUARTEL','ADMINISTRATIVO Y DE APOYO') " : "";
			$sql = "SELECT DISTINCT CARGO.CAR_GRUPO5 TIPO_CARGO
					FROM CARGO_TUNIDAD
					JOIN CARGO ON (CARGO_TUNIDAD.CAR_CODIGO = CARGO.CAR_CODIGO)
					{$filtroEscalafon}
					WHERE CARGO_TUNIDAD.UNI_TIPOUNIDAD = {$tipoUnidad} 
					AND CARGO_TUNIDAD.ACTIVO = 1 AND CARGO.CAR_CODIGO NOT IN(1000,2000,3500)
					{$filtro}
					ORDER BY CARGO.CAR_DESCRIPCION ASC";
		}
		else{
			$sql = "SELECT DISTINCT GRUPO_CARGO.GCAR_DESCRIPCION TIPO_CARGO
					FROM CARGO_CUARTEL
					JOIN CARGO ON (CARGO_CUARTEL.CAR_CODIGO = CARGO.CAR_CODIGO)
					{$filtroEscalafon}
					JOIN TIPO_CUARTEL ON (CARGO_CUARTEL.TCU_CODIGO = TIPO_CUARTEL.TCU_CODIGO)
					JOIN TIPO_ESPECIALIDAD_CUARTEL ON (CARGO_CUARTEL.TESPC_CODIGO = TIPO_ESPECIALIDAD_CUARTEL.TESPC_CODIGO)
					JOIN GRUPO_CARGO ON (CARGO_CUARTEL.GCAR_CODIGO = GRUPO_CARGO.GCAR_CODIGO)
					WHERE CARGO_CUARTEL.TCU_CODIGO = {$tipoUnidadNew} AND CARGO_CUARTEL.TESPC_CODIGO = {$especialidadUnidadNew}
					ORDER BY GRUPO_CARGO.GCAR_ORDEN_PRECEDENCIA ASC";
		}
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result) ){
				$categorias = new CategoriaCargo;
				$categorias->setDescripcion($myrow["TIPO_CARGO"]);
				$categoria[$i] = $categorias;
				$i++;
			}
	}

}//end class
?>