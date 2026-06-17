<?
Class dbFuncionarios extends Conexion {
	
	function listaTotalFuncionarios($Unidad, $tipoUnidadNew, $especialidadUnidadNew, $nombreBuscar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios){
		
		$FechaHoy = date("Y-m-d");
		if ($NombreCampo == "grado")  $campoOrdenar = "FUNCIONARIO.ESC_CODIGO {$TipoOrden}, FUNCIONARIO.GRA_CODIGO {$TipoOrden}, FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "nombre") $campoOrdenar = "FUNCIONARIO.FUN_APELLIDOPATERNO {$TipoOrden}, FUNCIONARIO.FUN_APELLIDOMATERNO {$TipoOrden}, FUNCIONARIO.FUN_NOMBRE {$TipoOrden}";
		if ($NombreCampo == "codigo") $campoOrdenar = "FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "cargo")  $campoOrdenar = "CARGO.CAR_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "grupo")  $campoOrdenar = "CARGO.CAR_GRUPO5 {$TipoOrden}";
		if ($NombreCampo == "seccion")  $campoOrdenar = "TIPO_SECCION.SEC_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "") $campoOrdenar = "FUNCIONARIO.ESC_CODIGO, FUNCIONARIO.GRA_CODIGO, FUNCIONARIO.FUN_CODIGO";
		
		if ($grado != "") $filtrarGrado = " AND GRADO.GRA_DESCRIPCION = '{$grado}' ";
		
		$sql = "SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  FUNCIONARIO.UNI_CODIGO,
				  CARGO.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION,
				  IF(CARGO_CUARTEL.TCU_CODIGO IS NULL && CARGO_CUARTEL.TESPC_CODIGO IS NULL,CARGO.CAR_GRUPO5,GRUPO_CARGO.GCAR_DESCRIPCION) GRUPOCARGO,
				  CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_UNIDAD_AGREGADO,
				  UNIDAD.UNI_DESCRIPCION AS DES_UNIDAD_AGREGADO,
				  CARGO_FUNCIONARIO.CUADRANTE_CODIGO,
				  CUADRANTE.CUA_ABREVIATURA,
				  CARGO_FUNCIONARIO.SEC_CODIGO,
				  TIPO_SECCION.SEC_DESCRIPCION
				FROM FUNCIONARIO
				JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				LEFT JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				LEFT JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD.UNI_CODIGO)
  				LEFT JOIN UNIDAD_CUADRANTE ON (CARGO_FUNCIONARIO.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
  				LEFT JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				LEFT JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = CARGO_FUNCIONARIO.SEC_CODIGO)
				LEFT JOIN CARGO_CUARTEL ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO_CUARTEL.CAR_CODIGO AND CARGO_CUARTEL.TCU_CODIGO = {$tipoUnidadNew} AND CARGO_CUARTEL.TESPC_CODIGO = {$especialidadUnidadNew})
				LEFT JOIN GRUPO_CARGO ON (CARGO_CUARTEL.GCAR_CODIGO = GRUPO_CARGO.GCAR_CODIGO)
				WHERE FUNCIONARIO.UNI_CODIGO = {$Unidad} {$filtrarGrado} AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";

		if ($nombreBuscar != "") $sql .= " AND (FUNCIONARIO.FUN_APELLIDOPATERNO like '%{$nombreBuscar}%' OR FUNCIONARIO.FUN_APELLIDOMATERNO like '%{$nombreBuscar}%' OR FUNCIONARIO.FUN_NOMBRE like '%{$nombreBuscar}%') ";
		
		$sql .= " ORDER BY {$campoOrdenar}";
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
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad($myrow["COD_UNIDAD_AGREGADO"]);
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["DES_UNIDAD_AGREGADO"]));
			
			$cuadrante = new cuadrante;
			$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
			$cuadrante->setAbreviatura($myrow["CUA_ABREVIATURA"]);
			
			$seccion = new seccion;
			$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
			$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
			
			$categoriaCargo = new categoriaCargo;
			$categoriaCargo->setDescripcion(STRTOUPPER($myrow["GRUPOCARGO"]));
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setGrado($gradoJerarquico);
			$persona->setCargo($cargo);
			$persona->setCategoriaCargo($categoriaCargo);
			$persona->setUnidadAgregado($unidadAgregado);
			$persona->setCuadrante($cuadrante);
          	$persona->setSeccion($seccion);
			$persona->setPerfil($myrow["TUS_CODIGO"]);
			$persona->setFechaCreacion($myrow["US_FECHACREACION"]);
					
			$funcionarios[$i] = $persona;
			$i++;
			}
	}
		
	function listaTotalFuncionariosAgregados($Unidad, $nombreBuscar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios){
		
		$FechaHoy = date("Y-m-d");
		if ($NombreCampo == "grado")  $campoOrdenar = "FUNCIONARIO.ESC_CODIGO {$TipoOrden}, FUNCIONARIO.GRA_CODIGO {$TipoOrden}, FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "nombre") $campoOrdenar = "FUNCIONARIO.FUN_APELLIDOPATERNO {$TipoOrden}, FUNCIONARIO.FUN_APELLIDOMATERNO {$TipoOrden}, FUNCIONARIO.FUN_NOMBRE {$TipoOrden}";
		if ($NombreCampo == "codigo") $campoOrdenar = "FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "cargo")  $campoOrdenar = "CARGO.CAR_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD.UNI_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "") $campoOrdenar = "FUNCIONARIO.ESC_CODIGO, FUNCIONARIO.GRA_CODIGO, FUNCIONARIO.FUN_CODIGO";
		if ($grado != "") $filtrarGrado = " AND GRADO.GRA_DESCRIPCION = '{$grado}' ";
		
		$sql = "SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  FUNCIONARIO.UNI_CODIGO,
				  CARGO.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION,
				  CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_UNIDAD_AGREGADO,
				  UNIDAD.UNI_DESCRIPCION AS UNIDAD_ORIGEN,
				  CARGO_FUNCIONARIO.CUADRANTE_CODIGO,
				  CUADRANTE.CUA_ABREVIATURA
				FROM FUNCIONARIO
				JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				LEFT JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				LEFT JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
  				LEFT JOIN UNIDAD_CUADRANTE ON (CARGO_FUNCIONARIO.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
  				LEFT JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				WHERE CARGO_FUNCIONARIO.UNI_AGREGADO = {$Unidad} {$filtrarGrado} AND CARGO_FUNCIONARIO.CAR_CODIGO <> 3006
				AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";
		
		if ($nombreBuscar != "") $sql .= " AND (FUNCIONARIO.FUN_APELLIDOPATERNO like '%{$nombreBuscar}%' OR FUNCIONARIO.FUN_APELLIDOMATERNO like '%{$nombreBuscar}%' OR FUNCIONARIO.FUN_NOMBRE like '%{$nombreBuscar}%') ";
		$sql .= " ORDER BY {$campoOrdenar}";
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
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad($myrow["COD_UNIDAD_AGREGADO"]);
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNIDAD_ORIGEN"]));
			
			$cuadrante = new cuadrante;
			$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
			$cuadrante->setAbreviatura($myrow["CUA_ABREVIATURA"]);
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setGrado($gradoJerarquico);
			$persona->setCargo($cargo);
			$persona->setUnidadAgregado($unidadAgregado);
			$persona->setCuadrante($cuadrante);
			
			$funcionarios[$i] = $persona;					
			$i++;
		}
	}
	
	function listaTotalFuncionariosDestinados($Unidad, $nombreBuscar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios){
	
		$FechaHoy = date("Y-m-d");
		if ($NombreCampo == "grado")  $campoOrdenar = "FUNCIONARIO.ESC_CODIGO {$TipoOrden}, FUNCIONARIO.GRA_CODIGO {$TipoOrden}, FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "nombre") $campoOrdenar = "FUNCIONARIO.FUN_APELLIDOPATERNO {$TipoOrden}, FUNCIONARIO.FUN_APELLIDOMATERNO {$TipoOrden}, FUNCIONARIO.FUN_NOMBRE {$TipoOrden}";
		if ($NombreCampo == "codigo") $campoOrdenar = "FUNCIONARIO.FUN_CODIGO {$TipoOrden}";
		if ($NombreCampo == "cargo")  $campoOrdenar = "CARGO.CAR_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "unidad")  $campoOrdenar = "UNIDAD.UNI_DESCRIPCION {$TipoOrden}";
		if ($NombreCampo == "") $campoOrdenar = "FUNCIONARIO.ESC_CODIGO, FUNCIONARIO.GRA_CODIGO, FUNCIONARIO.FUN_CODIGO";
		if ($grado != "") $filtrarGrado = " AND GRADO.GRA_DESCRIPCION = '{$grado}' ";
		
		$sql = "SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  FUNCIONARIO.UNI_CODIGO,
				  CARGO.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION,
				  CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_UNIDAD_AGREGADO,
				  UNIDAD.UNI_DESCRIPCION AS UNIDAD_ORIGEN,
				  CARGO_FUNCIONARIO.CUADRANTE_CODIGO,
				  CUADRANTE.CUA_ABREVIATURA
				FROM FUNCIONARIO
				JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				LEFT JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				LEFT JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
  				LEFT JOIN UNIDAD_CUADRANTE ON (CARGO_FUNCIONARIO.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
  				LEFT JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
				WHERE CARGO_FUNCIONARIO.UNI_AGREGADO = {$Unidad} AND  CARGO_FUNCIONARIO.CAR_CODIGO = 3006 {$filtrarGrado} AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";
		
		if ($nombreBuscar != "") $sql .= " AND (FUNCIONARIO.FUN_APELLIDOPATERNO like '%{$nombreBuscar}%' OR FUNCIONARIO.FUN_APELLIDOMATERNO like '%{$nombreBuscar}%' OR FUNCIONARIO.FUN_NOMBRE like '%{$nombreBuscar}%') ";
		
		$sql .= " ORDER BY {$campoOrdenar}";
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
			
			$unidadAgregado = new unidad;
			$unidadAgregado->setCodigoUnidad($myrow["COD_UNIDAD_AGREGADO"]);
			$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNIDAD_ORIGEN"]));
			
			$cuadrante = new cuadrante;
			$cuadrante->setCodigo($myrow["CUADRANTE_CODIGO"]);
			$cuadrante->setAbreviatura($myrow["CUA_ABREVIATURA"]);
			
			$persona = new funcionario;
			$persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$persona->setGrado($gradoJerarquico);
			$persona->setCargo($cargo);
			$persona->setUnidadAgregado($unidadAgregado);
			$persona->setCuadrante($cuadrante);
			$funcionarios[$i] = $persona;
			$i++;
		}
	}
	
	function buscaFuncionarios($codigoFuncionario, $funcionarios){
	   	
	    $sql = "SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  FUNCIONARIO.ESC_CODIGO,
				  FUNCIONARIO.FUN_RUT,
				  FUNCIONARIO.GRA_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  FUNCIONARIO.UNI_CODIGO,
				  UNIDAD.UNI_DESCRIPCION,
				  CARGO.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION,
				  IF(CARGO_CUARTEL.TCU_CODIGO IS NULL && CARGO_CUARTEL.TESPC_CODIGO IS NULL,CARGO.CAR_GRUPO5,GRUPO_CARGO.GCAR_DESCRIPCION) CATEGORIA_CARGO,
				  CARGO_FUNCIONARIO.FECHA_DESDE,
				  CARGO_FUNCIONARIO.CUADRANTE_CODIGO,
				  CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_AGREGADO,
  				  UNIDAD1.UNI_DESCRIPCION AS DES_AGREGADO,
  				  CARGO_FUNCIONARIO.CANT_DIAS,
                  CARGO_FUNCIONARIO.SEC_CODIGO,
			      TIPO_SECCION.SEC_DESCRIPCION
				FROM GRADO
				JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				LEFT JOIN UNIDAD ON (FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				LEFT JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				LEFT JOIN UNIDAD UNIDAD1 ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD1.UNI_CODIGO)
                LEFT JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = CARGO_FUNCIONARIO.SEC_CODIGO)
				LEFT JOIN CARGO_CUARTEL ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO_CUARTEL.CAR_CODIGO AND CARGO_CUARTEL.TCU_CODIGO = UNIDAD.TCU_CODIGO AND CARGO_CUARTEL.TESPC_CODIGO = UNIDAD.TESPC_CODIGO)
				LEFT JOIN GRUPO_CARGO ON (CARGO_CUARTEL.GCAR_CODIGO = GRUPO_CARGO.GCAR_CODIGO)
				WHERE CARGO_FUNCIONARIO.FECHA_HASTA IS NULL	
				AND FUNCIONARIO.FUN_CODIGO = '{$codigoFuncionario}'";
	    	    //echo $sql;
	    	    
			$i=0;
			$result = $this->execstmt($this->Conecta(),$sql);
			mysql_close();
			while($myrow = mysql_fetch_array($result)){
				$escalafon = new escalafon;
				$escalafon->setCodigo(STRTOUPPER($myrow["ESC_CODIGO"]));
				$escalafon->setDescripcion("");
				
				$grado = new grado;
				$grado->setEscalafon($escalafon);
				$grado->setCodigo(STRTOUPPER($myrow["GRA_CODIGO"]));
				$grado->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
				
				$cargo = new cargo;
				$cargo->setCodigo(STRTOUPPER($myrow["CAR_CODIGO"]));
				$cargo->setDescripcion(STRTOUPPER($myrow["CAR_DESCRIPCION"]));
				$cargo->setFechaDesde($myrow["FECHA_DESDE"]);
				$cargo->setCuadrante($myrow["CUADRANTE_CODIGO"]);
				$cargo->setDias($myrow["CANT_DIAS"]);
				
				$unidadAgregado = new unidad;
				$unidadAgregado->setCodigoUnidad($myrow["COD_AGREGADO"]);
				$unidadAgregado->setDescripcionUnidad($myrow["DES_AGREGADO"]);
				
				$unidad = new unidad;
				$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
				$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
				
				$seccion = new seccion;
				$seccion->setCodigo(STRTOUPPER($myrow["SEC_CODIGO"]));
				$seccion->setDescripcion(STRTOUPPER($myrow["SEC_DESCRIPCION"]));
				
				$funcionario = new funcionario;
				$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
				$funcionario->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
				$funcionario->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
				$funcionario->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
				$funcionario->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
				$funcionario->setGrado($grado);
				$funcionario->setCargo($cargo);
				$funcionario->setCategoriaCargo($myrow["CATEGORIA_CARGO"]);
				$funcionario->setUnidad($unidad);
				$funcionario->setUnidadAgregado($unidadAgregado);
				$funcionario->setSeccion($seccion);
				$funcionario->setRutFuncionario(STRTOUPPER($myrow["FUN_RUT"]));
				$funcionario->setPerfil($myrow["TUS_CODIGO"]);
				$funcionario->setFechaCreacion($myrow["US_FECHACREACION"]);
				
				$funcionarios[$i] = $funcionario;				
				$i++;
			}
	}
		
	function buscarFuncionarioPersonal($codigoFuncionario, $funcionarios){
	    	    
	    $sql = "SELECT 
					B.PEFBCOD,
					B.PEFBRUT,
					B.PEFBAPEP,
					B.PEFBAPEM,
					B.PEFBNOM1,
					B.PEFBNOM2,
					B.PEFBESC,
					B.PEFBGRA
				FROM pesbasi B
				WHERE B.PEFBCOD = '{$codigoFuncionario}'";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$escalafon = new escalafon;
			$escalafon->setCodigo(STRTOUPPER($myrow["PEFBESC"]));
			
			$grado = new grado;
			$grado->setEscalafon($escalafon);
			$grado->setCodigo(STRTOUPPER($myrow["PEFBGRA"]));
			
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["PEFBCOD"]));
			$funcionario->setRutFuncionario(STRTOUPPER($myrow["PEFBRUT"]));
			$funcionario->setApellidoPaterno(STRTOUPPER($myrow["PEFBAPEP"]));
			$funcionario->setApellidoMaterno(STRTOUPPER($myrow["PEFBAPEM"]));
			$funcionario->setPNombre(STRTOUPPER($myrow["PEFBNOM1"]));
			$funcionario->setSNombre(STRTOUPPER($myrow["PEFBNOM2"]));
			$funcionario->setGrado($grado);
			
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function updateFuncionario($funcionario){
				
		$sql = "UPDATE FUNCIONARIO SET
				ESC_CODIGO = {$funcionario->getGrado()->getEscalafon()->getCodigo()}, 
				GRA_CODIGO = {$funcionario->getGrado()->getCodigo()},
				FUN_APELLIDOPATERNO = '{$funcionario->getApellidoPaterno()}',
				FUN_APELLIDOMATERNO = '{$funcionario->getApellidoMaterno()}',
				FUN_NOMBRE = '{$funcionario->getPNombre()}',
				FUN_NOMBRE2 = '{$funcionario->getSNombre()}',
				UNI_CODIGO = '{$funcionario->getUnidad()->getCodigoUnidad()}'
				WHERE FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}'";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateCargoFuncionario($funcionario, $fechaNuevoCargo){
		
		$sql = "UPDATE CARGO_FUNCIONARIO SET
				FECHA_HASTA = '{$fechaNuevoCargo}'
				WHERE FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}' AND FECHA_HASTA IS NULL";
		//echo $sql;
		//$result = 1;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function updateCuadranteFuncionario($funcionario){
		
		$sql = "UPDATE CARGO_FUNCIONARIO SET
				CUADRANTE_CODIGO = {$funcionario->GetCargo()->getCuadrante()}
				WHERE FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}' AND FECHA_HASTA IS NULL";
		//echo $sql;
		//$result = 1;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function insertCargoFuncionario($funcionario, $fechaNuevoCargo){
		
		if ($funcionario->GetCargo()->getDias() == "") $diasGuardar = 'NULL';
		else $diasGuardar = $funcionario->GetCargo()->getDias();
		
		if ($funcionario->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
		else $seccionGuardar = $funcionario->getSeccion()->getCodigo();
		
		$sql = "INSERT INTO CARGO_FUNCIONARIO (FUN_CODIGO, CAR_CODIGO, UNI_CODIGO, FECHA_DESDE, CUADRANTE_CODIGO, UNI_AGREGADO, CANT_DIAS, SEC_CODIGO)
				VALUES ('{$funcionario->getCodigoFuncionario()}',{$funcionario->GetCargo()->getCodigo()},{$funcionario->getUnidad()->getCodigoUnidad()},'{$fechaNuevoCargo}',{$funcionario->GetCargo()->getCuadrante()},{$funcionario->getUnidadAgregado()->getCodigoUnidad()},{$diasGuardar},{$seccionGuardar});";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function insertCargoFuncionarioPaso($funcionario, $fechaNuevoCargo){
		
		if ($funcionario->getSeccion()->getCodigo() == 0) $seccionGuardar = 'NULL';
     	else $seccionGuardar = $funcionario->getSeccion()->getCodigo();
		
		$sql = "INSERT INTO CARGO_FUNCIONARIO_PASO(FUN_CODIGO, CAR_CODIGO, UNI_CODIGO, FECHA_DESDE, CUADRANTE_CODIGO, UNI_AGREGADO, CANT_DIAS, SEC_CODIGO)
				VALUES ('{$funcionario->getCodigoFuncionario()}',{$funcionario->GetCargo()->getCodigo()},{$funcionario->getUnidad()->getCodigoUnidad()},'{$fechaNuevoCargo}',{$funcionario->GetCargo()->getCuadrante()},{$funcionario->getUnidadAgregado()->getCodigoUnidad()},{$diasGuardar},{$seccionGuardar});";
		//echo $sql;
		//$result = 1;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function nuevoFuncionario($funcionario){

		$sql = "INSERT INTO FUNCIONARIO 
				(FUN_CODIGO, FUN_RUT, ESC_CODIGO, GRA_CODIGO, FUN_APELLIDOPATERNO, FUN_APELLIDOMATERNO, FUN_NOMBRE, UNI_CODIGO) VALUES
				('{$funcionario->getCodigoFuncionario()}',
				 '{$funcionario->getRutFuncionario()}',
				  {$funcionario->getGrado()->getEscalafon()->getCodigo()},
				  {$funcionario->getGrado()->getCodigo()},
				 '{$funcionario->getApellidoPaterno()}',
				 '{$funcionario->getApellidoMaterno()}',
				 '{$funcionario->getPNombre()}',
				  {$funcionario->getUnidad()->getCodigoUnidad()})";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function dejarDisponible($funcionario, $Fecha){
		
		$sql = "UPDATE FUNCIONARIO SET UNI_CODIGO = Null WHERE FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}'";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function bajaRetiroFuncionario($funcionario, $motivo, $fechaBajaRetiro){
		
		$sql = "INSERT INTO CARGO_FUNCIONARIO (FUN_CODIGO, CAR_CODIGO, UNI_CODIGO, FECHA_DESDE, FECHA_HASTA)
				VALUES ('{$funcionario->getCodigoFuncionario()}',
						 {$funcionario->GetCargo()->getCodigo()},
						 {$funcionario->getUnidad()->getCodigoUnidad()},
						'{$fechaBajaRetiro}',
						'{$fechaBajaRetiro}');";
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
		
	function bajaFuncionario($funcionario, $motivo, $fecha){
		$sql = "UPDATE FUNCIONARIO SET UNI_CODIGO = '-1' WHERE FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}'";
		return 1;
	}
	
	function retiroFuncionario($funcionario, $motivo, $fecha){
		$sql = "UPDATE funcionarios SET Unid_Id = '0' WHERE Fun_Codigo = '{$funcionario->getCodigoFuncionario()}'";
		return 1;
	}
	
	function borraFuncionario($funcionario){
		$sql = "DELETE FROM funcionarios WHERE Fun_Codigo = '{$funcionario->getCodigoFuncionario()}'";
		return 1;
	}
	
	function borraUsuario($funcionario){
		$sql = "DELETE FROM USUARIO WHERE FUN_CODIGO = '{$funcionario->getCodigoFuncionario()}'";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		return $result;
	}
	
	function listaFuncionariosDisponibles($unidad, $unidadTipo, $especialidadUnidad, $fechaServicio, $tipoServicio, $horaI, $horaT, $correlativo, $servicio, $nextDay, $funcionarios){	
		$nombreCampo 	 = "FUN_APELLIDOPATERNO, FUN_APELLIDOMATERNO, FUN_NOMBRE, FUN_NOMBRE2";
		$tipoOrden 	 	 = "ASC";
		
		if($tipoServicio=='E') $servicio = 1200;
		if($tipoServicio=='X') $servicio = 1300;
		
		$listaExcluyente = $this->listaFuncionariosExcluyentes($unidad, $fechaServicio, $servicio, $horaI, $horaT, $nextDay, $correlativo);
		$filtroEscalafon = "";
		
		if($servicio == 888 || $servicio == 889) $filtroEscalafon = 'JOIN ESCALAFON ON ESCALAFON.ESC_CODIGO = GRADO.ESC_CODIGO AND (ESCALAFON.FILTRO_SERVICIOS_OPERATIVOS = 1)';
		else if($tipoServicio == 'O' && $especialidadUnidad != 90 && $servicio != 861 && $servicio != 240 && $servicio != 580 && $servicio != 876) $filtroEscalafon = 'JOIN ESCALAFON ON ESCALAFON.ESC_CODIGO = GRADO.ESC_CODIGO AND ESCALAFON.FILTRO_SERVICIOS_OPERATIVOS = 0';
		
		//TIPO SERVICIO: COLACION - JEFATURA DE SUPERVISION
		if(in_array($servicio, array(142,143,144,145,146,147,148,149,151,152,153,607))){
			$sqlAux .= " AND FUNCIONARIO.FUN_CODIGO IN ({$listaExcluyente})";
		}
		//TIPO SERVICIO: NO DISPONIBILIDAD - CHECK MARCADO - OTROS
		else{
			$sqlAux .= " AND FUNCIONARIO.FUN_CODIGO NOT IN ({$listaExcluyente})";
		}
		
		$sql = "(SELECT
					FUNCIONARIO.FUN_CODIGO AS FUN_CODIGO,
					GRADO.GRA_DESCRIPCION AS GRA_DESCRIPCION,
					FUNCIONARIO.FUN_APELLIDOPATERNO AS FUN_APELLIDOPATERNO,
					FUNCIONARIO.FUN_APELLIDOMATERNO AS FUN_APELLIDOMATERNO,
					FUNCIONARIO.FUN_NOMBRE AS FUN_NOMBRE,
					FUNCIONARIO.FUN_NOMBRE2 AS FUN_NOMBRE2
				FROM FUNCIONARIO
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				{$filtroEscalafon}
				LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				WHERE CARGO_FUNCIONARIO.UNI_CODIGO = {$unidad}
				AND (CARGO_FUNCIONARIO.FECHA_DESDE <= '{$fechaServicio}' AND (CARGO_FUNCIONARIO.FECHA_HASTA > '{$fechaServicio}' OR CARGO_FUNCIONARIO.FECHA_HASTA IS NULL)) 
				AND (CARGO_FUNCIONARIO.CAR_CODIGO NOT IN (1000, 2000, 3000, 3100, 3001, 3002, 3003, 3004, 3005, 3006, 4000, 4100, 5000, 6000, 3500, 7010, 8400, 8520, 9340, 9350, 9360, 9370, 9380, 9390, 9400, 9410, 9420, 9430, 9440, 9460, 9840))
				{$sqlAux} )
				UNION 
				(SELECT 
					CARGO_FUNCIONARIO.FUN_CODIGO AS FUN_CODIGO,
					GRADO.GRA_DESCRIPCION AS GRA_DESCRIPCION,
					FUNCIONARIO.FUN_APELLIDOPATERNO AS FUN_APELLIDOPATERNO,
					FUNCIONARIO.FUN_APELLIDOMATERNO AS FUN_APELLIDOMATERNO,
					FUNCIONARIO.FUN_NOMBRE AS FUN_NOMBRE,
					FUNCIONARIO.FUN_NOMBRE2 AS FUN_NOMBRE2
					FROM FUNCIONARIO
					JOIN GRADO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
					{$filtroEscalafon}
					JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					WHERE CARGO_FUNCIONARIO.UNI_AGREGADO = {$unidad}
					AND CARGO_FUNCIONARIO.FECHA_DESDE <= '{$fechaServicio}' AND (CARGO_FUNCIONARIO.FECHA_HASTA > '{$fechaServicio}' OR CARGO_FUNCIONARIO.FECHA_HASTA IS NULL)
				{$sqlAux} )
				ORDER BY {$nombreCampo} {$tipoOrden}";
		$i=0;
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$grado = new grado;
			$grado->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
			$funcionario = new funcionario;
			$funcionario->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
			$funcionario->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
			$funcionario->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
			$funcionario->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
			$funcionario->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
			$funcionario->setGrado($grado);
			$funcionarios[$i] = $funcionario;
			$i++;
		}
	}
	
	function listaFuncionariosExcluyentes($unidad, $fechaServicio, $servicio, $horaI, $horaT, $nextDay, $correlativo){
		
		$sqlAux		= "";
		$sqlNotAux	= "";
		$sqlAuxJefatura = "";
		
		if($nextDay){
			$sqlControlHora = "AND (
								(SERVICIO.FECHA = '{$fechaServicio}' AND 
								(SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN SERVICIO.HORA_INICIO AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
									OR SEC_TO_TIME(TIME_TO_SEC('24:00')-1) BETWEEN SERVICIO.HORA_INICIO AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
									OR SERVICIO.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('24:00')-1)))
								OR 
								(SERVICIO.FECHA = DATE_ADD('{$fechaServicio}', INTERVAL 1 DAY) 
									AND SERVICIO.TSERV_CODIGO NOT IN (120,130,140,141,142,143,144,145,146,147,148,149,151,152,153,150,160,161,162,170,180,606,630,631,632,633,634,713,717,718,719,720,721,722,723,724,725,726,727,728,799,844,847,849,860,863,864,869)
									AND (SEC_TO_TIME(TIME_TO_SEC('00:00')+1) BETWEEN SERVICIO.HORA_INICIO AND SERVICIO.HORA_TERMINO
									OR SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1) BETWEEN SERVICIO.HORA_INICIO AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
									OR SERVICIO.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('00:00')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1)))
								OR 
								(SERVICIO.FECHA = DATE_ADD('{$fechaServicio}', INTERVAL -1 DAY)
									AND SERVICIO.HORA_INICIO>=IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
									AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO) BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1))
								OR 
								(SERVICIO.FECHA = '{$fechaServicio}'
									AND SERVICIO.TSERV_CODIGO IN (120,130,140,141,142,143,144,145,146,147,148,149,151,152,153,150,160,161,162,170,180,606,630,631,632,633,634,713,717,718,719,720,721,722,723,724,725,726,727,728,799,844,847,849,860,863,864,869))
								)";
			$sqlControlDia	= "AND (
									SERVICIO.FECHA = '{$fechaServicio}'
									OR (SERVICIO.FECHA = DATE_ADD('{$fechaServicio}', INTERVAL 1 DAY) AND (SEC_TO_TIME(TIME_TO_SEC('00:00')+1) BETWEEN SERVICIO.HORA_INICIO AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
										OR SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1) BETWEEN SERVICIO.HORA_INICIO AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
										OR SERVICIO.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('00:00')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1)))
									OR (SERVICIO.FECHA = DATE_ADD('{$fechaServicio}', INTERVAL -1 DAY)
										AND SERVICIO.TSERV_CODIGO NOT IN (120,130,140,141,142,143,144,145,146,147,148,149,151,152,153,150,160,161,162,170,180,606,630,631,632,633,634,713,717,718,719,720,721,722,723,724,725,726,727,728,799,844,847,849,860,863,864,869)
										AND SERVICIO.HORA_INICIO>=IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
										AND SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN '00:00:01' AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO))
									)";
		}
		else{
			$sqlControlHora = "AND (
								(SERVICIO.FECHA = '{$fechaServicio}' AND ( (SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN SERVICIO.HORA_INICIO AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
									OR SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1) BETWEEN SERVICIO.HORA_INICIO AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
									OR SERVICIO.HORA_INICIO BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1)))
								OR
									(SERVICIO.FECHA = DATE_ADD('{$fechaServicio}', INTERVAL -1 DAY)
									AND SERVICIO.HORA_INICIO>=IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
									AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO) BETWEEN SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) AND SEC_TO_TIME(TIME_TO_SEC('{$horaT}')-1))
								OR 
									(SERVICIO.FECHA = '{$fechaServicio}' 
									AND SERVICIO.TSERV_CODIGO IN (120,130,140,141,142,143,144,145,146,147,148,149,151,152,153,150,160,161,162,170,180,606,630,631,632,633,634,713,717,718,719,720,721,722,723,724,725,726,727,728,799,844,847,849,860,863,864,869)))
								)";
			$sqlControlDia	= "AND (
									SERVICIO.FECHA = '{$fechaServicio}' 
									OR (SERVICIO.FECHA = DATE_ADD('{$fechaServicio}', INTERVAL -1 DAY)
										AND SERVICIO.TSERV_CODIGO NOT IN (120,130,140,141,142,143,144,145,146,147,148,149,151,152,153,150,160,161,162,170,180,606,630,631,632,633,634,713,717,718,719,720,721,722,723,724,725,726,727,728,799,844,847,849,860,863,864,869)
										AND SERVICIO.HORA_INICIO>=IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO)
										AND SEC_TO_TIME(TIME_TO_SEC('{$horaI}')+1) BETWEEN '00:00:01' AND IF(SERVICIO.HORA_TERMINO='00:00:00','24:00:00',SERVICIO.HORA_TERMINO))
								)";
		}
		
		//Servicio existente
		if($correlativo != "" && $correlativo != "-1") {
			$sqlAux .= " OR (SERVICIO.UNI_CODIGO = {$unidad} AND SERVICIO.CORRELATIVO_SERVICIO = {$correlativo}) ";
			$sqlNotAux .= " AND SERVICIO.CORRELATIVO_SERVICIO != {$correlativo} ";
			$sqlAuxJefatura .= " AND NOT EXISTS (SELECT FUN.FUN_CODIGO 
												FROM FUNCIONARIO_SERVICIO FUN
												WHERE FUN.UNI_CODIGO = {$unidad} AND FUN.CORRELATIVO_SERVICIO = {$correlativo}
												AND FUNCIONARIO_SERVICIO.FUN_CODIGO = FUN.FUN_CODIGO) ";
		}
		
		//TIPO SERVICIO: COLACION
		if(in_array($servicio, array(142,143,144,145,146,147,148,149,151,152,153))){
			$sql = "SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
					FROM FUNCIONARIO_SERVICIO
					JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					JOIN TIPO_SERVICIO ON TIPO_SERVICIO.TSERV_CODIGO = SERVICIO.TSERV_CODIGO AND TIPO_SERVICIO.TSERV_CODIGO != 607
					WHERE SERVICIO.FECHA = '{$fechaServicio}' AND SERVICIO.UNI_CODIGO = {$unidad}
						{$sqlNotAux}
					AND SERVICIO.TSERV_CODIGO NOT IN (867)
					AND ((TIPO_SERVICIO.TSERV_TIPO != 'N' OR SERVICIO.TSERV_CODIGO = 892) OR TIPO_SERVICIO.TSERV_GRUPO = 'COLACION')
					GROUP BY FUNCIONARIO_SERVICIO.FUN_CODIGO
					HAVING SUM(IF(TIPO_SERVICIO.TSERV_GRUPO = 'COLACION',1,0)) = 0 AND SUM(IF(TIPO_SERVICIO.TSERV_GRUPO != 'COLACION',1,0)) < 2";
		}
		//TIPO SERVICIO: JEFATURA DE SUPERVISION
		else if($servicio == 607 || ($servicio == 607&&$correlativo=="-1")){
			$sql = "SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
					FROM FUNCIONARIO_SERVICIO
					JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					WHERE SERVICIO.UNI_CODIGO = {$unidad}
					AND SERVICIO.TSERV_CODIGO IN (191,194,195,196,197,198,201,625,635,636,665,666,667,677,747,752,793,794,796,800,817,827,828,829,830,831,832,833,834,850,874,933,939,940,941,942,947,949,954,955,959)
					AND CAST(CONCAT('{$fechaServicio}',' ','{$horaI}') AS DATETIME) BETWEEN CAST(CONCAT(SERVICIO.FECHA,' ',SERVICIO.HORA_INICIO) AS DATETIME) AND CAST(CONCAT(IF(SERVICIO.HORA_INICIO>=SERVICIO.HORA_TERMINO,DATE_ADD(SERVICIO.FECHA, INTERVAL +1 DAY),SERVICIO.FECHA),' ',SERVICIO.HORA_TERMINO) AS DATETIME)
					AND CAST(CONCAT(IF('{$horaI}'>='{$horaT}',DATE_ADD('{$fechaServicio}', INTERVAL +1 DAY),'{$fechaServicio}'),' ','{$horaT}') AS DATETIME) <= CAST(CONCAT(IF(SERVICIO.HORA_INICIO>=SERVICIO.HORA_TERMINO,DATE_ADD(SERVICIO.FECHA, INTERVAL +1 DAY),SERVICIO.FECHA),' ',SERVICIO.HORA_TERMINO) AS DATETIME)
					{$sqlAuxJefatura}";
		}
		//TIPO SERVICIO: NO DISPONIBILIDAD
		else if(in_array($servicio, array(120,130,140,141,150,160,161,162,170,180,606,630,631,632,633,634,713,717,718,719,720,721,722,723,724,725,726,727,728,799,844,847,849,860,863,864,869))){
			$sql = "SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
					FROM FUNCIONARIO_SERVICIO
					JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					WHERE SERVICIO.UNI_CODIGO = {$unidad} AND SERVICIO.FECHA = '{$fechaServicio}'";
		}
		//CUANDO ESTA MARCADO EL CHECK
		else if($correlativo == "-1"){
			$sql = "SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
					FROM FUNCIONARIO_SERVICIO
					JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					WHERE SERVICIO.UNI_CODIGO = {$unidad} 
						{$sqlControlDia}";
		}
		//CUANDO ES UN SERVICIO DE COMISION DE SERVICIO
		else if($servicio == 867){
			$sql = "SELECT CARGO_FUNCIONARIO.FUN_CODIGO
					FROM CARGO_FUNCIONARIO 
					WHERE CARGO_FUNCIONARIO.FECHA_HASTA IS NULL AND CARGO_FUNCIONARIO.CAR_CODIGO = 9460 AND IF(CARGO_FUNCIONARIO.UNI_AGREGADO,CARGO_FUNCIONARIO.UNI_AGREGADO,CARGO_FUNCIONARIO.UNI_CODIGO) = {$unidad}
					UNION 
					SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
					FROM FUNCIONARIO_SERVICIO
					JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					WHERE SERVICIO.UNI_CODIGO = {$unidad}
						{$sqlControlHora}
						{$sqlAux}";
		}
		//TIPO SERVICIO: OTROS
		else{
			$sql = "SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
					FROM FUNCIONARIO_SERVICIO
					JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					WHERE SERVICIO.UNI_CODIGO = {$unidad}
						{$sqlControlHora}
						{$sqlAux}";
		}
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$listaFuncionarios = "'',";
		while($myrow = mysql_fetch_array($result)){
			$listaFuncionarios .= "'".$myrow["FUN_CODIGO"]."',";
		}
		$listaFuncionarios = substr($listaFuncionarios, 0, strlen($listaFuncionarios)-1);
		return $listaFuncionarios;
	}
	
	function listaCantidadFuncionarios($unidad, $tipoUnidad, $escalafon, $grado, $desGrado, $fecha1, $inicio, $listaFuncionariosUnidad){
		
		if($desGrado != ""){
			//$filtro = " AND FUNCIONARIO.ESC_CODIGO = ". $escalafon. " AND FUNCIONARIO.GRA_CODIGO = ".$grado;
			$filtro = " AND GRADO.GRA_DESCRIPCION = '{$desGrado}'";
		}
		
		if($tipoUnidad == "nacional"){
			$unidadAgregada = "";
			$unidadFiltro   = "";
		}
		
		if($tipoUnidad == "zona"){
			if($inicio == "1"){
				$unidadAgregada = "IF(UNIDAD3.UNI_CODIGO={$unidad},UNIDAD2.UNI_CODIGO, UNIDAD3.UNI_CODIGO) AS UNI_CODIGO,";
				$unidadAgregada .= "IF(UNIDAD3.UNI_CODIGO={$unidad},UNIDAD2.UNI_DESCRIPCION, UNIDAD3.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
			}
			
			if($inicio == "0"){
				$unidadAgregada = "IF(UNIDAD3.UNI_CODIGO={$unidad},UNIDAD3.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,";
				$unidadAgregada .= "IF(UNIDAD3.UNI_CODIGO={$unidad},UNIDAD3.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
			}
			
			$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,";
		}
		
		if($tipoUnidad == "prefectura"){
			if($inicio == "1"){
				$unidadAgregada = "IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD1.UNI_CODIGO, UNIDAD2.UNI_CODIGO) AS UNI_CODIGO,";          
				$unidadAgregada .= "IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD1.UNI_DESCRIPCION, UNIDAD2.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
			}
			
			if($inicio == "0"){  
				$unidadAgregada = "IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD2.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,";          
				$unidadAgregada .= "IF (UNIDAD2.UNI_CODIGO={$unidad},UNIDAD2.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
			}
			
			$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,";
		}
		
		if($tipoUnidad == "comisaria"){
			if($inicio == "1"){
				$unidadAgregada = "IF (UNIDAD1.UNI_CODIGO={$unidad},UNIDAD.UNI_CODIGO, UNIDAD1.UNI_CODIGO) AS UNI_CODIGO,";
				$unidadAgregada .= "IF (UNIDAD1.UNI_CODIGO={$unidad},UNIDAD.UNI_DESCRIPCION, UNIDAD1.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
			}
			
			if($inicio == "0"){
				$unidadAgregada = "IF (UNIDAD1.UNI_CODIGO={$unidad},UNIDAD1.UNI_CODIGO, UNIDAD.UNI_CODIGO) AS UNI_CODIGO,";
				$unidadAgregada .= "IF (UNIDAD1.UNI_CODIGO={$unidad},UNIDAD1.UNI_DESCRIPCION, UNIDAD.UNI_DESCRIPCION) AS UNI_DESCRIPCION,";
			}
			
			$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,";
		}
		
		if($tipoUnidad == "destacamento"){
			$unidadAgregada = "UNIDAD.UNI_CODIGO, UNIDAD.UNI_DESCRIPCION,";
			$unidadAgrupar = "UNI_CODIGO, UNI_DESCRIPCION,";
		}

		$sql = "SELECT 
					{$unidadAgregada}{$correlativo}
					SERVICIO.TSERV_CODIGO,
					TIPO_SERVICIO.TSERV_DESCRIPCION,
					SERVICIO.FECHA,
					COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANT_PERSONAL,
					COUNT(DISTINCT(FUNCIONARIO_VEHICULO.VEH_CODIGO)) AS CANT_VEHICULOS
				FROM SERVICIO
				JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO) 
					AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
				JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				LEFT JOIN FUNCIONARIO_VEHICULO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = FUNCIONARIO_VEHICULO.FUN_UNI_CODIGO)
					AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_VEHICULO.FUN_CORRELATIVO_SERVICIO)
					AND (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO_VEHICULO.FUN_CODIGO)
				JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
				JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
				JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
				{$unidadFiltro} {$filtro}
				GROUP BY
					{$unidadAgregada}{$correlativo}
					SERVICIO.TSERV_CODIGO,
					TIPO_SERVICIO.TSERV_DESCRIPCION,
					SERVICIO.FECHA
				HAVING
					SERVICIO.FECHA = '{$fecha1}' 
				ORDER BY TIPO_SERVICIO.TSERV_ORDEN";
		
		$sql = "SELECT 
					{$unidadAgregada}
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO,
					GRADO.GRA_DESCRIPCION,
					COUNT(*) AS CANT_PERSONAL
				FROM FUNCIONARIO
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				JOIN UNIDAD ON (FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
				JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)       
				JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO) 
				{$unidadFiltro}{$filtro}
				GROUP BY {$unidadAgregada}
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO,
					GRADO.GRA_DESCRIPCION
				ORDER BY
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO";
			
		$sql = "SELECT 
					{$unidadAgregada}
					GRADO.GRA_DESCRIPCION,
					COUNT(*) AS CANT_PERSONAL
				FROM FUNCIONARIO
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				LEFT JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				JOIN UNIDAD ON (FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
				JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
				JOIN UNIDAD UNIDAD2 ON (UNIDAD1.UNI_PADRE = UNIDAD2.UNI_CODIGO)
				JOIN UNIDAD UNIDAD3 ON (UNIDAD2.UNI_PADRE = UNIDAD3.UNI_CODIGO)
				WHERE CARGO_FUNCIONARIO.FECHA_HASTA IS NULL AND
				(UNIDAD.UNI_PADRE = {$unidad} OR 
				UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = {$unidad} OR 
				UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = {$unidad} OR 
				UNIDAD.UNI_PADRE IN (SELECT UNIDAD.UNI_CODIGO FROM UNIDAD WHERE UNIDAD.UNI_PADRE = {$unidad}))))
				{$filtro}
				GROUP BY
					{$unidadAgrupar}
					GRADO.GRA_DESCRIPCION
				ORDER BY
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO";
		$cont=0;
		$i=0;
		$listaFuncionariosUnidad = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			
			$grado = new grado;
			$grado->setEscalafon($myrow["ESC_CODIGO"]);
			$grado->setCodigo($myrow["GRA_CODIGO"]);
			$grado->setDescripcion($myrow["GRA_DESCRIPCION"]);
			
			$funcionariosUnidad = new funcionariosUnidad;
			$funcionariosUnidad->setUnidad($unidad);
			$funcionariosUnidad->setGrado($grado);
			$funcionariosUnidad->setCantidadFuncionarios($myrow["CANT_PERSONAL"]);
			
			$listaFuncionariosUnidad[$i] = $funcionariosUnidad;
			$i++;
		}
	}
	
	function listaCantidadFuncionariosNuevo($unidad, $tipoUnidad, $tipoUnidadPadre, $escalafon, $grado, $desGrado, $fecha1, $inicio, $listaFuncionariosUnidad){
		
		$filtroGrado = "";
		if ($escalafon != "") $filtroGrado =  "AND FUNCIONARIO.ESC_CODIGO = {$escalafon} AND FUNCIONARIO.GRA_CODIGO = {$grado}";
		
		$sql = "SELECT 
					VISTA_UNIDADES_2.{$tipoUnidadPadre}_CODIGO AS UNI_CODIGO_PADRE,
					VISTA_UNIDADES_2.{$tipoUnidad}_CODIGO AS UNI_CODIGO,
					VISTA_UNIDADES_2.{$tipoUnidad}_DESCRIPCION AS UNI_DESCRIPCION,
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO,
					GRADO.GRA_DESCRIPCION,
					COUNT(*) AS CANT_PERSONAL,
					COUNT(IF(CARGO_FUNCIONARIO.CAR_CODIGO= 3000 OR CARGO_FUNCIONARIO.CAR_CODIGO= 3100, 1, NULL)) AS CANT_AGREGADOS
				FROM VISTA_UNIDADES_2
				JOIN CARGO_FUNCIONARIO ON (VISTA_UNIDADES_2.DESTACAMENTO_CODIGO = CARGO_FUNCIONARIO.UNI_CODIGO)
				JOIN FUNCIONARIO ON (CARGO_FUNCIONARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				WHERE ((CARGO_FUNCIONARIO.FECHA_HASTA IS NULL) AND (CARGO_FUNCIONARIO.CAR_CODIGO NOT IN (1000,2000,3500)))
				GROUP BY
					VISTA_UNIDADES_2.{$tipoUnidadPadre}_CODIGO,
					VISTA_UNIDADES_2.{$tipoUnidad}_CODIGO,
					VISTA_UNIDADES_2.{$tipoUnidad}_DESCRIPCION,
					GRADO.GRA_DESCRIPCION
				HAVING UNI_CODIGO_PADRE = {$unidad} {$filtroGrado}
				ORDER BY
					FUNCIONARIO.ESC_CODIGO,
					FUNCIONARIO.GRA_CODIGO";

		//echo $sql;
		$cont=0;
		$i=0;
		$listaFuncionariosUnidad = "";
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result) ){
			
			$unidad = new unidad;
			$unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
			
			$grado = new grado;
			$grado->setEscalafon($myrow["ESC_CODIGO"]);
			$grado->setCodigo($myrow["GRA_CODIGO"]);
			$grado->setDescripcion($myrow["GRA_DESCRIPCION"]);
			
			$funcionariosUnidad = new funcionariosUnidad;
			$funcionariosUnidad->setUnidad($unidad);
			$funcionariosUnidad->setGrado($grado);
			$funcionariosUnidad->setCantidadFuncionarios($myrow["CANT_PERSONAL"]);
			$funcionariosUnidad->setCantidadAgregados($myrow["CANT_AGREGADOS"]);
			
			$listaFuncionariosUnidad[$i] = $funcionariosUnidad;
			$i++;
		}
	}

	function actualizarCargoFuncionario_mysqli($funcionario){
		$sql = "CALL ActualizarCargoFuncionario
				('{$funcionario->getCodigoFuncionario()}',
				  {$funcionario->getUnidad()->getCodigoUnidad()},
				  {$funcionario->getGrado()->getEscalafon()->getCodigo()},
				  {$funcionario->getGrado()->getCodigo()},
				  {$funcionario->GetCargo()->getCodigo()},
				 '{$funcionario->GetCargo()->getFechaDesde()}',
				  {$funcionario->GetCargo()->getCuadrante()},
				  {$funcionario->getUnidadAgregado()->getCodigoUnidad()},
				  {$funcionario->getSeccion()->getCodigo()})";
		//echo $sql;
		$result = $this->execute($this->conect(),$sql);
		mysqli_close($this->conect());
		$row = $result->fetch_assoc();
		return ($row['message']=='OK') ? true : false;
	}

}//end class
?>