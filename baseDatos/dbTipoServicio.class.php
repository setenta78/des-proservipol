<?
Class dbTipoServicio extends Conexion{
	
	function listaTipoServicio($codUnidad, $grupo, $tipoServicios){
		$sql = "SELECT 
				  ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO AS TSERV_CODIGO,
				  TIPO_SERVICIO.TSERV_DESCRIPCION,
				  TIPO_SERVICIO.TSERV_TIPO,
				  ESPECIALIDAD_TSERVICIO.ACTIVO AS TSERV_ACTIVO
				FROM ESPECIALIDAD_TSERVICIO
				JOIN TIPO_SERVICIO ON (ESPECIALIDAD_TSERVICIO.TIPO_SERVICIO = TIPO_SERVICIO.TSERV_CODIGO)
				JOIN UNIDAD ON UNIDAD.UNI_CODIGO = {$codUnidad}
				WHERE
				  IF(UNIDAD.TCU_CODIGO IN (10,120), ESPECIALIDAD_TSERVICIO.UNIDAD_ESPECIALIDAD = 200, ESPECIALIDAD_TSERVICIO.UNIDAD_ESPECIALIDAD = IF(UNIDAD.UNI_ESPECIALIDAD IN (10,30,31,32,33,40,41,50,60,80,90,100,110,130,42,150,17,160,180,200),UNIDAD.UNI_ESPECIALIDAD,70)) AND
				  ESPECIALIDAD_TSERVICIO.ACTIVO = 1 AND 
				  ESPECIALIDAD_TSERVICIO.TIPO = 'O' AND 
				  TIPO_SERVICIO.TSERV_TIPO_ANALISIS_3 = '{$grupo}'
				  
				  UNION
				SELECT
					T.TSERV_CODIGO AS TSERV_CODIGO,
					T.TSERV_DESCRIPCION,
					T.TSERV_TIPO,
					T.TSERV_ACTIVO
					FROM TIPO_SERVICIO T
					JOIN UNIDAD U ON U.UNI_CODIGO = {$codUnidad} AND U.UNI_CODIGO_ESPECIALIDAD = 10
					WHERE T.TSERV_CODIGO IN (888,889) AND T.TSERV_TIPO_ANALISIS_3 = '{$grupo}'
					
				  UNION
				SELECT
					T.TSERV_CODIGO AS TSERV_CODIGO,
					T.TSERV_DESCRIPCION,
					T.TSERV_TIPO,
					T.TSERV_ACTIVO
					FROM TIPO_SERVICIO T
					WHERE T.TSERV_CODIGO IN (890,891) AND T.TSERV_TIPO_ANALISIS_3 = '{$grupo}'
					AND {$codUnidad} = 1175
					
				ORDER BY TSERV_DESCRIPCION";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
			$tipo = new tipoServicio;
			$tipo->setCodigo(STRTOUPPER($myrow["TSERV_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
			$tipo->setTipo(STRTOUPPER($myrow["TSERV_TIPO"]));
			$tipo->setActivo(STRTOUPPER($myrow["TSERV_ACTIVO"]));
			
			$tipoServicios[$i] = $tipo;
			$i++;
		}
	}
	
	function listaTipoServicioN($codUnidad, $grupo, $tipoServicios){
		$sql = "SELECT 
					S.TSERV_CODIGO,
					S.TSERV_DESCRIPCION,
					S.TSERV_TIPO,
					S.TSERV_ACTIVO
				FROM TIPO_SERVICIO S
				JOIN TIPO_SERVICIO_CUARTEL T ON S.TSERV_CODIGO = T.TSERV_CODIGO
				JOIN UNIDAD U ON U.TCU_CODIGO = T.TCU_CODIGO AND U.TESPC_CODIGO = T.TESPC_CODIGO
				WHERE U.UNI_CODIGO = {$codUnidad}
				AND T.GSER_CODIGO = {$grupo}
				ORDER BY T.ORDEN ASC";
	   	//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
			$tipo = new tipoServicio;
			$tipo->setCodigo(STRTOUPPER($myrow["TSERV_CODIGO"]));
			$tipo->setDescripcion(STRTOUPPER($myrow["TSERV_DESCRIPCION"]));
			$tipo->setTipo(STRTOUPPER($myrow["TSERV_TIPO"]));
			$tipo->setActivo(STRTOUPPER($myrow["TSERV_ACTIVO"]));
			
			$tipoServicios[$i] = $tipo;
			$i++;
		}
	}

	function listaGrupoTipoServicio($codUnidad, $grupoServicios){
		$sql = "SELECT 
					G.GSER_CODIGO,
					G.GSER_DESCRIPCION
				FROM GRUPO_SERVICIO G
				JOIN TIPO_SERVICIO_CUARTEL T ON T.GSER_CODIGO = G.GSER_CODIGO
				JOIN UNIDAD U ON U.TCU_CODIGO = T.TCU_CODIGO AND U.TESPC_CODIGO = T.TESPC_CODIGO
				WHERE U.UNI_CODIGO = {$codUnidad} AND T.ACTIVO = 1
				GROUP BY G.GSER_CODIGO
				ORDER BY G.GCAR_ORDEN_PRECEDENCIA ASC";
	   	//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
		 	$grupo = new grupoServicio;
		 	$grupo->setCodigo(STRTOUPPER($myrow["GSER_CODIGO"]));
		 	$grupo->setDescripcion(STRTOUPPER($myrow["GSER_DESCRIPCION"]));
		 	$grupoServicios[$i] = $grupo;
		 	$i++;
		}
	}
}
?>