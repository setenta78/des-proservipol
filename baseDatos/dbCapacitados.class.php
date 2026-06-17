<?
Class dbCapacitados extends Conexion {
	
	function listaFuncionariosCapacitados($Unidad, $NombreCampo, $TipoOrden, $funcionarios){
	
		$FechaHoy = date("Y-m-d");
		//if ($NombreCampo == "grado") $campoOrdenar = "FUNCIONARIO.ESC_CODIGO ".$TipoOrden.", FUNCIONARIO.GRA_CODIGO ".$TipoOrden.", FUNCIONARIO.FUN_CODIGO ".$TipoOrden;
		if ($NombreCampo == "grado") $campoOrdenar = "DATA.GRA_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "nombre") $campoOrdenar = "DATA.FUN_APELLIDOPATERNO ".$TipoOrden.", DATA.FUN_APELLIDOMATERNO ".$TipoOrden.", DATA.FUN_NOMBRE ".$TipoOrden;
		if ($NombreCampo == "codigo") $campoOrdenar = "DATA.FUN_CODIGO ".$TipoOrden;
		if ($NombreCampo == "cargo") $campoOrdenar = "DATA.CAR_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "fecha") $campoOrdenar = "DATA.FECHA_CAPACITACION ".$TipoOrden;
		if ($NombreCampo == "version") $campoOrdenar = "DATA.VERSION_PROSERVIPOL ".$TipoOrden;
		if ($NombreCampo == "capacitado") $campoOrdenar = "DATA.TUS_DESCRIPCION ".$TipoOrden;
		if ($NombreCampo == "nota") $campoOrdenar = "DATA.NOTA_PROSERVIPOL ".$TipoOrden;
		if ($NombreCampo == "fechaPerfil") $campoOrdenar = "DATA.US_FECHACREACION ".$TipoOrden;
		if ($NombreCampo == "") $campoOrdenar = "DATA.ESC_CODIGO, DATA.GRA_CODIGO";
		
		$sql = "SELECT 
					DATA.FUN_CODIGO,
					DATA.ESC_CODIGO,
					DATA.GRA_CODIGO,
					DATA.GRA_DESCRIPCION,
					DATA.FUN_APELLIDOPATERNO,
					DATA.FUN_APELLIDOMATERNO,
					DATA.FUN_NOMBRE,
					DATA.FUN_NOMBRE2,
					DATA.UNI_CODIGO,
					DATA.CAR_CODIGO,
					DATA.CAR_DESCRIPCION,
					DATA.FECHA_DESDE,	
					DATA.COD_UNIDAD_AGREGADO,
					DATA.DES_UNIDAD_AGREGADO,
					DATA.TUS_CODIGO,
					DATA.TUS_DESCRIPCION,
					DATA.US_FECHACREACION,
					DATA.VERSION_PROSERVIPOL,
					DATA.FECHA_CAPACITACION,
					DATA.NOTA_PROSERVIPOL,
					DATA.CODIGO_VERIFICACION
				FROM
				(
					SELECT 
						FUNCIONARIO.FUN_CODIGO,
						FUNCIONARIO.ESC_CODIGO,
						FUNCIONARIO.GRA_CODIGO,
						GRADO.GRA_DESCRIPCION,
						FUNCIONARIO.FUN_APELLIDOPATERNO,
						FUNCIONARIO.FUN_APELLIDOMATERNO,
						FUNCIONARIO.FUN_NOMBRE,
						FUNCIONARIO.FUN_NOMBRE2,
						FUNCIONARIO.UNI_CODIGO,
						CARGO.CAR_CODIGO,
						CARGO.CAR_DESCRIPCION,
						CARGO_FUNCIONARIO.FECHA_DESDE,
						CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_UNIDAD_AGREGADO,
						UNIDAD.UNI_DESCRIPCION AS DES_UNIDAD_AGREGADO,
						TIPO_USUARIO.TUS_CODIGO,
						TIPO_USUARIO.TUS_DESCRIPCION,
						USUARIO.US_FECHACREACION,
						CAPACITACION.VERSION_PROSERVIPOL,
						CAPACITACION.FECHA_CAPACITACION,
						CAPACITACION.NOTA_PROSERVIPOL,
						CAPACITACION.CODIGO_VERIFICACION
					FROM FUNCIONARIO
					JOIN CAPACITACION ON (CAPACITACION.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO AND CAPACITACION.ACTIVO = 1)
					LEFT JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO AND GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
					LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					LEFT JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
					LEFT JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD.UNI_CODIGO)
					LEFT JOIN USUARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
					LEFT JOIN TIPO_USUARIO ON (TIPO_USUARIO.TUS_CODIGO = USUARIO.TUS_CODIGO)
					WHERE
						IF(CARGO_FUNCIONARIO.UNI_AGREGADO IS NULL,CARGO_FUNCIONARIO.UNI_CODIGO,CARGO_FUNCIONARIO.UNI_AGREGADO) = ".$Unidad." 
						AND
						CARGO_FUNCIONARIO.FECHA_HASTA IS NULL AND CARGO_FUNCIONARIO.CAR_CODIGO NOT IN (3500)

					UNION

					SELECT 
						FUNCIONARIO.FUN_CODIGO,
						FUNCIONARIO.ESC_CODIGO,
						FUNCIONARIO.GRA_CODIGO,
						GRADO.GRA_DESCRIPCION,
						FUNCIONARIO.FUN_APELLIDOPATERNO,
						FUNCIONARIO.FUN_APELLIDOMATERNO,
						FUNCIONARIO.FUN_NOMBRE,
						FUNCIONARIO.FUN_NOMBRE2,
						FUNCIONARIO.UNI_CODIGO,
						CARGO.CAR_CODIGO,
						CARGO.CAR_DESCRIPCION,
						CARGO_FUNCIONARIO.FECHA_DESDE,
						CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_UNIDAD_AGREGADO,
						UNIDAD.UNI_DESCRIPCION AS DES_UNIDAD_AGREGADO,
						TIPO_USUARIO.TUS_CODIGO,
						TIPO_USUARIO.TUS_DESCRIPCION,
						USUARIO.US_FECHACREACION,
						CAPACITACION.VERSION_PROSERVIPOL,
						CAPACITACION.FECHA_CAPACITACION,
						CAPACITACION.NOTA_PROSERVIPOL,
						CAPACITACION.CODIGO_VERIFICACION
					FROM FUNCIONARIO
					LEFT JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO AND GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
					LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					LEFT JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
					LEFT JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD.UNI_CODIGO)
					LEFT JOIN USUARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
					LEFT JOIN TIPO_USUARIO ON (TIPO_USUARIO.TUS_CODIGO = USUARIO.TUS_CODIGO)
					LEFT JOIN CAPACITACION ON (CAPACITACION.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO AND CAPACITACION.ACTIVO = 1)
					WHERE
					IF(CARGO_FUNCIONARIO.UNI_AGREGADO IS NULL,CARGO_FUNCIONARIO.UNI_CODIGO,CARGO_FUNCIONARIO.UNI_AGREGADO) = ".$Unidad." 
					AND
					CARGO_FUNCIONARIO.FECHA_HASTA IS NULL 
					AND CARGO_FUNCIONARIO.CAR_CODIGO NOT IN (1000,3500) 
					AND USUARIO.FUN_CODIGO IS NOT NULL
					AND CAPACITACION.FUN_CODIGO IS NULL
				) DATA";
			
		$sql .= " ORDER BY ".$campoOrdenar;
		//echo $sql;
		
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$gradoJerarquico = new grado;
			$gradoJerarquico->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
			
			$cargo = new cargo;
			$cargo->setCodigo(STRTOUPPER($myrow["CAR_CODIGO"]));
			$cargo->setDescripcion(STRTOUPPER($myrow["CAR_DESCRIPCION"]));
			$cargo->setFechaDesde(STRTOUPPER($myrow["FECHA_DESDE"]));
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad($myrow["COD_UNIDAD_AGREGADO"]);
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DES_UNIDAD_AGREGADO"]));
      
			$capacitacion = new capacitacion;
			$capacitacion->setFechaCapacitacion(STRTOUPPER($myrow["FECHA_CAPACITACION"]));
			$capacitacion->setVersionProservipol(STRTOUPPER($myrow["VERSION_PROSERVIPOL"]));
			$capacitacion->setNotaProservipol(STRTOUPPER($myrow["NOTA_PROSERVIPOL"]));
			$capacitacion->setCodigoVerificacion(STRTOUPPER($myrow["CODIGO_VERIFICACION"]));
			
			$perfil = new perfil;
			$perfil->setCodigoPerfil(STRTOUPPER($myrow["TUS_CODIGO"]));
			$perfil->setDescripcionPerfil(STRTOUPPER($myrow["TUS_DESCRIPCION"]));
			$perfil->setFechaPerfil($myrow["US_FECHACREACION"]);

			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setGrado($gradoJerarquico);
			$persona->setCargo($cargo);
			$persona->setUnidadAgregado($unidadAgregado);
		  	$persona->setPerfil($perfil);
			$persona->setFechaCreacion($myrow["US_FECHACREACION"]);
			$persona->setCapacitacion($capacitacion);
			
			$funcionarios[$i] = $persona;
			$i++;
		}
	}
	
	function CantidadUsuarios($unidad, $usuarios){
		
		$sql = "SELECT U.UNI_CODIGO, U.FUN_CODIGO, U.TUS_CODIGO
						FROM USUARIO U WHERE U.UNI_CODIGO = '".$unidad."'";
		
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$usuario = new usuario;
			$usuario->setUnidad(STRTOUPPER($myrow["UNI_CODIGO"]));
			$usuario->setFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$usuario->setPerfil(STRTOUPPER($myrow["TUS_CODIGO"]));
			
			$usuarios[$i] = $usuario;
			$i++;
		}
	}
	
	function listaFuncionariosConCargoPorDefinir($Unidad, $funcionarios){
		
		$sql = "SELECT 
							F.FUN_CODIGO,
							F.FUN_NOMBRE,
							F.FUN_APELLIDOPATERNO,
							F.FUN_APELLIDOMATERNO,
							G.GRA_DESCRIPCION
						FROM FUNCIONARIO F
						JOIN GRADO G ON G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO
						JOIN CARGO_FUNCIONARIO CF ON CF.FUN_CODIGO = F.FUN_CODIGO
						WHERE CF.FECHA_HASTA IS NULL AND CF.CAR_CODIGO = 9200 
						AND CF.UNI_CODIGO = '".$Unidad."'
						ORDER BY F.FUN_CODIGO ASC";
		
		//echo $sql;
		
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
		
			$gradoJerarquico = new grado;
			$gradoJerarquico->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
		  
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setGrado($gradoJerarquico);
			
			$funcionarios[$i] = $persona;
			$i++;
		}
	}

	function buscarCertificado($codigoVerificacion, $codigoFuncionario, $certificado){

		$sql = "SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  CAPACITACION.VERSION_PROSERVIPOL,
				  CAPACITACION.FECHA_CAPACITACION,
				  CAPACITACION.NOTA_PROSERVIPOL,
				  CAPACITACION.CODIGO_VERIFICACION,
  				  CAPACITACION.TIPO_CAPACITACION
				FROM FUNCIONARIO
				JOIN CAPACITACION ON (CAPACITACION.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO AND CAPACITACION.ACTIVO = 1)
				LEFT JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO AND GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				WHERE CAPACITACION.ACTIVO = 1 AND CAPACITACION.CODIGO_VERIFICACION IS NOT NULL ";
		
		$sql .= ($codigoVerificacion) ? "AND CAPACITACION.CODIGO_VERIFICACION = '{$codigoVerificacion}'" : "AND FUNCIONARIO.FUN_CODIGO = '{$codigoFuncionario}'";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$gradoJerarquico = new grado;
			$gradoJerarquico->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
			
			$capacitacion = new capacitacion;
			$capacitacion->setFechaCapacitacion(STRTOUPPER($myrow["FECHA_CAPACITACION"]));
			$capacitacion->setVersionProservipol(STRTOUPPER($myrow["VERSION_PROSERVIPOL"]));
			$capacitacion->setNotaProservipol(STRTOUPPER($myrow["NOTA_PROSERVIPOL"]));
			$capacitacion->setCodigoVerificacion(STRTOUPPER($myrow["CODIGO_VERIFICACION"]));
			$capacitacion->setTipoCapacitacion(STRTOUPPER($myrow["TIPO_CAPACITACION"]));
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setGrado($gradoJerarquico);
			$persona->setCapacitacion($capacitacion);
			
			$certificado[$i] = $persona;
			$i++;
		}
	}
	
}//end class
?>