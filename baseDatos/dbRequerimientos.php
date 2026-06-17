<?
Class dbRequerimiento extends Conexion {

	function listaRequerimiento( $Unidad, $funcionarios ) {
		
		$sql = "SELECT 
				S.SOL_CODIGO,
				S.UNI_CODIGO,
				S.SOL_FECHA,
				P.PROB_DESCRIPCION,
				SP.SUBP_DESCRIPCION,
				TM.TMOV_DESCRIPCION,
				FECHA_TERMINO,
				CONCAT_WS(' ', UCASE(S.VALOR_IDENTI1),'/',UCASE(S.VALOR_IDENTI2)) IDENTIFICADORES,
				DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
				CONCAT_WS(' ', TM.TMOV_DESCRIPCION,'POR:',G.GRA_DESCRIPCION, F.FUN_APELLIDOPATERNO, F.FUN_APELLIDOMATERNO, F.FUN_NOMBRE) DATO_OPER,
				M.TMOV_CODIGO,
				M.MOV_CODIGO
			FROM SOLICITUD S
			JOIN MOVIMIENTO M ON S.SOL_CODIGO = M.SOL_CODIGO
			JOIN PROBLEMA P ON S.PROB_CODIGO = P.PROB_CODIGO
			JOIN SUBPROBLEMA SP ON S.PROB_CODIGO = SP.PROB_CODIGO AND S.SUBP_CODIGO = SP.SUBP_CODIGO
			JOIN TIPO_MOVIMIENTO TM ON M.TMOV_CODIGO = TM.TMOV_CODIGO
			JOIN FUNCIONARIO F ON M.FUNCIONARIO_IMPLICADO = F.FUN_CODIGO
			JOIN GRADO G ON F.ESC_CODIGO = G.ESC_CODIGO AND F.GRA_CODIGO = G.GRA_CODIGO
			JOIN CONFIG_SYS C ON C.ACTIVO = 1
			WHERE TM.TMOV_CODIGO IN (10,20,60,70,80,90,100)
			AND M.VISIBLE = 1 AND M.FECHA_TERMINO IS NULL
			AND S.UNI_CODIGO = {$Unidad} AND S.SOL_FECHA >= C.FECHA_LIMITE
			ORDER BY S.SOL_FECHA ASC";
			
		//echo $sql;
		$i = 0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$dioscar = new lSolicitud;
			$dioscar->setCodigoSolicitud($myrow["SOL_CODIGO"]);
			$dioscar->setUnidad($myrow["UNI_CODIGO"]);
			$dioscar->setFechaSolicitud($myrow["SOL_FECHA"]);
			$dioscar->setProblema(STRTOUPPER($myrow["PROB_DESCRIPCION"]));
			$dioscar->setSubProblema(STRTOUPPER($myrow["SUBP_DESCRIPCION"]));
			$dioscar->setTipoMovimiento(STRTOUPPER($myrow["TMOV_DESCRIPCION"]));
			$dioscar->setIdentificadores(STRTOUPPER($myrow["IDENTIFICADORES"]));
			$dioscar->setDiferenciaDias(STRTOUPPER($myrow["DIF_DIAS"]));
			$dioscar->setImplicado(STRTOUPPER($myrow["DATO_OPER"]));
			$dioscar->setCodigoTipoMov(STRTOUPPER($myrow["TMOV_CODIGO"]));
			$dioscar->setCorrelativoMov(STRTOUPPER($myrow["MOV_CODIGO"]));
			$funcionarios[$i] = $dioscar;
			$i++;
		}
	}
	
	function listaRequerimientoCerradas( $Unidad, $funcionarios ) {
		
		$sql = "SELECT 
					S.SOL_CODIGO,
					S.UNI_CODIGO,
					S.SOL_FECHA,
					P.PROB_DESCRIPCION,
					SP.SUBP_DESCRIPCION,
					TM.TMOV_DESCRIPCION,
					M.FECHA_TERMINO,
					CONCAT_WS(' ', UCASE(S.VALOR_IDENTI1),'/',UCASE(S.VALOR_IDENTI2)) IDENTIFICADORES,
					DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
					CONCAT_WS(' ', TM.TMOV_DESCRIPCION,'POR:',G.GRA_DESCRIPCION, F.FUN_APELLIDOPATERNO, F.FUN_APELLIDOMATERNO, F.FUN_NOMBRE) DATO_OPER,
					M.TMOV_CODIGO,
					M.MOV_CODIGO
				FROM SOLICITUD S
				JOIN MOVIMIENTO M ON S.SOL_CODIGO = M.SOL_CODIGO
				JOIN PROBLEMA P ON S.PROB_CODIGO = P.PROB_CODIGO
				JOIN SUBPROBLEMA SP ON S.PROB_CODIGO = SP.PROB_CODIGO AND S.SUBP_CODIGO = SP.SUBP_CODIGO
				JOIN TIPO_MOVIMIENTO TM ON M.TMOV_CODIGO = TM.TMOV_CODIGO
				JOIN FUNCIONARIO F ON M.FUNCIONARIO_IMPLICADO = F.FUN_CODIGO
				JOIN GRADO G ON F.ESC_CODIGO = G.ESC_CODIGO AND F.GRA_CODIGO = G.GRA_CODIGO
				JOIN CONFIG_SYS C ON C.ACTIVO = 1
				WHERE TM.TMOV_CODIGO IN (30,40,50) 
				AND M.VISIBLE = 1 AND M.FECHA_TERMINO IS NULL
				AND S.UNI_CODIGO= {$Unidad} AND S.SOL_FECHA >= C.FECHA_LIMITE
				ORDER BY S.SOL_FECHA ASC";
				
		//echo $sql;
		$i = 0;
		$result = $this->execstmt( $this->Conecta(),$sql);
		mysql_close();
		while ( $myrow = mysql_fetch_array( $result ) ) {
			$dioscar = new lSolicitud;
			$dioscar->setCodigoSolicitud($myrow["SOL_CODIGO"]);
			$dioscar->setUnidad( $myrow["UNI_CODIGO"]);
			$dioscar->setFechaSolicitud($myrow["SOL_FECHA"]);
			$dioscar->setProblema(STRTOUPPER($myrow["PROB_DESCRIPCION"]));
			$dioscar->setSubProblema(STRTOUPPER($myrow["SUBP_DESCRIPCION"]));
			$dioscar->setTipoMovimiento(STRTOUPPER($myrow["TMOV_DESCRIPCION"]));
			$dioscar->setIdentificadores(STRTOUPPER($myrow["IDENTIFICADORES"]));
			$dioscar->setDiferenciaDias(STRTOUPPER($myrow["DIF_DIAS"]));
			$dioscar->setImplicado(STRTOUPPER($myrow["DATO_OPER"]));
			$dioscar->setCodigoTipoMov(STRTOUPPER($myrow["TMOV_CODIGO"]));
			$dioscar->setCorrelativoMov(STRTOUPPER($myrow["MOV_CODIGO"]));
			$funcionarios[$i] = $dioscar;
			$i++;
		}
	}
	
  function listaTotalRequerimiento( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios ) {

    $FechaHoy = date( "Y-m-d" );


    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               MOVIMIENTO.MOV_CODIGO
               
              FROM
               `SOLICITUD`
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                WHERE
                TMOV_DESCRIPCION <> 'PENDIENTE' AND TMOV_DESCRIPCION <> 'CIERRE: RESUELTO FAVORABLEMENTE' AND TMOV_DESCRIPCION <> 'CIERRE: RESUELTO DESFAVORABLEMENTE' 
                AND TMOV_DESCRIPCION <> 'CIERRE: INADMISIBLE' AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A INFORMATICA' AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A O.P.U.'
                AND FECHA_TERMINO IS NULL
         
           ";

    if ( $nombreBucar != "" ) {
      $sql .= " AND (PROBLEMA.PROB_DESCRIPCION LIKE '" . $nombreBucar . "' OR SUBPROBLEMA.SUBP_DESCRIPCION LIKE '%" . $nombreBucar . "%') ";
    } else {
      $sql .= "";
    }
    $sql .= " ORDER BY SOLICITUD.SOL_FECHA";

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaTotalRequerimientoDerivadas( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios ) {

    $FechaHoy = date( "Y-m-d" );


    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               MOVIMIENTO.MOV_CODIGO
               
              FROM
               `SOLICITUD`
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                WHERE 
                TMOV_DESCRIPCION <> 'PENDIENTE' AND TMOV_DESCRIPCION <> 'OFICIALIZADO' AND TMOV_DESCRIPCION <> 'CIERRE: RESUELTO FAVORABLEMENTE' AND TMOV_DESCRIPCION <> 'CIERRE: RESUELTO DESFAVORABLEMENTE' 
                AND TMOV_DESCRIPCION <> 'CIERRE: INADMISIBLE' AND TMOV_DESCRIPCION <> 'EN TRAMITE: EVALUACION DE ANTECEDENTES' AND TMOV_DESCRIPCION <> 'EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES' 
                AND TMOV_DESCRIPCION <> 'EN TRAMITE: ENVIA ANTECEDENTES FALTANTES'
                AND FECHA_TERMINO IS NULL 
                 ORDER BY   
          SOLICITUD.SOL_FECHA
           ";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaTotalRequerimientoCerradas( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios ) {

    $FechaHoy = date( "Y-m-d" );


    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               MOVIMIENTO.MOV_CODIGO
               
              FROM
               `SOLICITUD`
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                WHERE TMOV_DESCRIPCION <> 'PENDIENTE' AND TMOV_DESCRIPCION <> 'OFICIALIZADO'  AND TMOV_DESCRIPCION <> 'EN TRAMITE: EVALUACION DE ANTECEDENTES' 
                AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A INFORMATICA' AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A O.P.U.' 
                AND TMOV_DESCRIPCION <> 'EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES' AND TMOV_DESCRIPCION <> 'EN TRAMITE: ENVIA ANTECEDENTES FALTANTES'
                AND FECHA_TERMINO IS NULL
                 ORDER BY   
          SOLICITUD.SOL_FECHA
           ";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaTotalRequerimiento2( $Unidad, $codigo, $funcionarios ) {

    $FechaHoy = date( "Y-m-d" );


    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               CONCAT_WS(' ','POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               MOVIMIENTO.MOV_CODIGO,
               MOVIMIENTO.TEXTO,
               MOVIMIENTO.FECHA_INICIO,
               MOVIMIENTO.ARCHIVO,
               MOVIMIENTO.FECHA
               
              FROM
               `SOLICITUD`
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                WHERE TMOV_DESCRIPCION <> 'PENDIENTE' AND `SOLICITUD`.`SOL_CODIGO`=" . $codigo . "
                 ORDER BY
          MOVIMIENTO.MOV_CODIGO ASC
           ";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );
      $dioscar->setMovimientoTexto( STRTOUPPER( $myrow[ "TEXTO" ] ) );
      $dioscar->setFechaInicio( STRTOUPPER( $myrow[ "FECHA_INICIO" ] ) );
      $dioscar->setArchivoSolicitud( $myrow[ "ARCHIVO" ] );
      $dioscar->setfechaArchivo( $myrow[ "FECHA" ] );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaTotalRequerimiento3( $Unidad, $codigo, $funcionarios ) {

    $FechaHoy = date( "Y-m-d" );


    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               CONCAT_WS(' ','POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               MOVIMIENTO.MOV_CODIGO,
               MOVIMIENTO.TEXTO,
               MOVIMIENTO.FECHA_INICIO,
               MOVIMIENTO.ARCHIVO
               
              FROM
               `SOLICITUD`
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                WHERE TMOV_DESCRIPCION <> 'PENDIENTE' AND `SOLICITUD`.`SOL_CODIGO`=" . $codigo . "
                 ORDER BY
          MOVIMIENTO.MOV_CODIGO ASC
           ";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );
      $dioscar->setMovimientoTexto( STRTOUPPER( $myrow[ "TEXTO" ] ) );
      $dioscar->setFechaInicio( STRTOUPPER( $myrow[ "FECHA_INICIO" ] ) );
      $dioscar->setArchivoSolicitud( $myrow[ "ARCHIVO" ] );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaIngeniero( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios, $usuario ) {

    $FechaHoy = date( "Y-m-d" );

    //$usuario1="010907Z";

    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               MOVIMIENTO.FUNCIONARIO_IMPLICADO,
               MOVIMIENTO.FUNCIONARIO_DERIBA,
               CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'A INFORMATICA POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               MOVIMIENTO.MOV_CODIGO
              FROM
               `SOLICITUD`
               
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                 INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                 AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                 INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
               
                WHERE MOVIMIENTO.SDEPTO_CODIGO=20  AND TMOV_DESCRIPCION <> 'PENDIENTE' AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A O.P.U.' AND TMOV_DESCRIPCION <> 'OFICIALIZADO' AND
                TMOV_DESCRIPCION <> 'CIERRE: RESUELTO DESFAVORABLEMENTE' AND TMOV_DESCRIPCION <> 'CIERRE: INADMISIBLE' AND TMOV_DESCRIPCION <> 'CIERRE: RESUELTO FAVORABLEMENTE'
                AND FECHA_TERMINO IS NULL AND SOLICITUD.SOL_FECHA BETWEEN '20220101' AND '20491231'
                
           ";

    if ( $nombreBucar != "" ) {
      $sql .= " AND (PROBLEMA.PROB_DESCRIPCION LIKE '" . $nombreBucar . "' OR SUBPROBLEMA.SUBP_DESCRIPCION LIKE '%" . $nombreBucar . "%') ";
    } else {
      $sql .= "";
    }
    $sql .= " ORDER BY SOLICITUD.SOL_FECHA";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }


  function listaIngenieroCerradas( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios, $usuario ) {

    $FechaHoy = date( "Y-m-d" );

    //$usuario1="010907Z";

    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               MOVIMIENTO.FUNCIONARIO_IMPLICADO,
               MOVIMIENTO.FUNCIONARIO_DERIBA,
               CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'A INFORMATICA POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               MOVIMIENTO.MOV_CODIGO
              FROM
               `SOLICITUD`
               
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                 INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                 AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                 INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
               
                WHERE MOVIMIENTO.SDEPTO_CODIGO=20  AND TMOV_DESCRIPCION <> 'PENDIENTE' AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A O.P.U.' AND TMOV_DESCRIPCION <> 'OFICIALIZADO' 
                AND TMOV_DESCRIPCION <> 'EN TRAMITE: EVALUACION DE ANTECEDENTES' 
                AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A INFORMATICA' AND TMOV_DESCRIPCION <> 'EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES' AND TMOV_DESCRIPCION <> 'EN TRAMITE: ENVIA ANTECEDENTES FALTANTES'
                AND FECHA_TERMINO IS NULL AND SOLICITUD.SOL_FECHA BETWEEN '20220101' AND '20491231'
                 ORDER BY
          SOLICITUD.UNI_CODIGO,       
          SOLICITUD.SOL_FECHA
           ";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaOpu( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios, $usuario ) {

    $FechaHoy = date( "Y-m-d" );

    //$usuario1="010907Z";

    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               MOVIMIENTO.FUNCIONARIO_IMPLICADO,
               MOVIMIENTO.FUNCIONARIO_DERIBA,
               CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'A O.P.U. POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               MOVIMIENTO.MOV_CODIGO
              FROM
               `SOLICITUD`
               
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                 INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                 AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                 INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
               
                WHERE MOVIMIENTO.SDEPTO_CODIGO=30  AND `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION` <> 'PENDIENTE' AND `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION` <> 'EN TRAMITE: DERIVADO A INFORMATICA' AND `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION` <> 'OFICIALIZADO'
                AND `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION` <> 'CIERRE: RESUELTO DESFAVORABLEMENTE'  AND `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION` <> 'CIERRE: INADMISIBLE'
                AND `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION` <> 'CIERRE: RESUELTO FAVORABLEMENTE' 
           ";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaOpuCerradas( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios, $usuario ) {

    $FechaHoy = date( "Y-m-d" );

    //$usuario1="010907Z";

    $sql = "SELECT  
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
               MOVIMIENTO.FUNCIONARIO_IMPLICADO,
               MOVIMIENTO.FUNCIONARIO_DERIBA,
               CONCAT_WS(' ',  `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,'A O.P.U. POR:',GRADO.GRA_DESCRIPCION, FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE) AS DATO_OPER,
               CONCAT_WS(' ', UCASE(`SOLICITUD`.VALOR_IDENTI1), UCASE(`SOLICITUD`.VALOR_IDENTI2)) AS IDENTIFICADORES,
               DATEDIFF(NOW(),FECHA) AS DIF_DIAS,
               MOVIMIENTO.MOV_CODIGO
              FROM
               `SOLICITUD`
               
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                 INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `SUBPROBLEMA`.`PROB_CODIGO`)
                 AND (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                
                INNER JOIN `PROBLEMA` ON (`SUBPROBLEMA`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                 INNER JOIN FUNCIONARIO ON (MOVIMIENTO.FUNCIONARIO_IMPLICADO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
               
                WHERE MOVIMIENTO.SDEPTO_CODIGO=30  AND TMOV_DESCRIPCION <> 'PENDIENTE' AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A INFORMATICA' AND TMOV_DESCRIPCION <> 'OFICIALIZADO'
                AND TMOV_DESCRIPCION <> 'EN TRAMITE: EVALUACION DE ANTECEDENTES' AND TMOV_DESCRIPCION <> 'EN TRAMITE: DERIVADO A O.P.U.'
                AND TMOV_DESCRIPCION <> 'EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES' AND TMOV_DESCRIPCION <> 'EN TRAMITE: ENVIA ANTECEDENTES FALTANTES'
                AND FECHA_TERMINO IS NULL AND SOLICITUD.SOL_FECHA BETWEEN '20220101' AND '20491231'
                 ORDER BY
          SOLICITUD.UNI_CODIGO,       
          SOLICITUD.SOL_FECHA
           ";
    //WHERE
    //`solicitud`.`UNI_CODIGO`=".$Unidad."

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      //$estado = new estadoRecurso;
      //$estado->setCodigo(STRTOUPPER($myrow["EST_CODIGO"]));
      //$estado->setDescripcion(STRTOUPPER($myrow["EST_DESCRIPCION"]));

      //$unidadAgregado = new unidad;
      //$unidadAgregado->setCodigoUnidad(STRTOUPPER($myrow["UNI_AGREGADO"]));
      //$unidadAgregado->setDescripcionUnidad(STRTOUPPER($myrow["UNI_DESCRIPCION"]));

      $dioscar = new lSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $dioscar->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $dioscar->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $dioscar->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $dioscar->setUnidadOrigen( STRTOUPPER( $myrow[ "UNI_DESCRIPCION" ] ) );
      $dioscar->setImplicado( STRTOUPPER( $myrow[ "DATO_OPER" ] ) );
      $dioscar->setIdentificadores( STRTOUPPER( $myrow[ "IDENTIFICADORES" ] ) );
      $dioscar->setDiferenciaDias( STRTOUPPER( $myrow[ "DIF_DIAS" ] ) );
      $dioscar->setCorrelativoMov( STRTOUPPER( $myrow[ "MOV_CODIGO" ] ) );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaTemporizador( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios ) {


    $sql = "SELECT 
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `MOVIMIENTO`.`MOV_CODIGO`,
               `MOVIMIENTO`.`TMOV_CODIGO`,
               `MOVIMIENTO`.`FECHA_INICIO`,
               SUBPROBLEMA.SUBP_DESCRIPCION
             FROM
          `SOLICITUD`
             INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
             INNER JOIN SUBPROBLEMA ON (SOLICITUD.SUBP_CODIGO=SUBPROBLEMA.SUBP_CODIGO)
             WHERE
              `SOLICITUD`.`UNI_CODIGO`=" . $Unidad . "  AND CURDATE()>=DATE_ADD(FECHA_INICIO,INTERVAL 24 HOUR) AND FECHA_TERMINO IS NULL
              AND VISIBLE=1 AND VALOR_IDENTI1 IS NULL AND VALOR_IDENTI2 IS NULL";

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {


      $dioscar = new movimientoSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setCodigoMovimiento( $myrow[ "MOV_CODIGO" ] );
      $dioscar->setCodigoTipoMovimiento( $myrow[ "TMOV_CODIGO" ] );
      $dioscar->setFechaInicio( $myrow[ "FECHA_INICIO" ] );
      $dioscar->setSubproblema( $myrow[ "SUBP_DESCRIPCION" ] );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }

  function listaTemporizador2( $Unidad, $nombreBucar, $escalafon, $grado, $NombreCampo, $TipoOrden, $funcionarios ) {


    $sql = "SELECT 
               `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `MOVIMIENTO`.`MOV_CODIGO`,
               `MOVIMIENTO`.`TMOV_CODIGO`,
               `MOVIMIENTO`.`FECHA_INICIO`,
                DATE_ADD(FECHA_INICIO,INTERVAL 24 HOUR) AS CALC_FECHA,
               SUBPROBLEMA.SUBP_DESCRIPCION
             FROM
          `SOLICITUD`
             INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
             INNER JOIN SUBPROBLEMA ON (SOLICITUD.SUBP_CODIGO=SUBPROBLEMA.SUBP_CODIGO)
             WHERE 
             `MOVIMIENTO`.`TMOV_CODIGO`=20 AND
            CURDATE()>=DATE_ADD(FECHA_INICIO,INTERVAL 24 HOUR) 
            AND FECHA_TERMINO IS NULL";

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {


      $dioscar = new movimientoSolicitud;
      $dioscar->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $dioscar->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $dioscar->setCodigoMovimiento( $myrow[ "MOV_CODIGO" ] );
      $dioscar->setCodigoTipoMovimiento( $myrow[ "TMOV_CODIGO" ] );
      $dioscar->setFechaInicio( $myrow[ "FECHA_INICIO" ] );
      $dioscar->setSubproblema( $myrow[ "SUBP_DESCRIPCION" ] );


      $funcionarios[ $i ] = $dioscar;
      $i++;
    }
  }


  function nuevoDioscar( $vehiculo ) {

    $sql = "INSERT INTO SOLICITUD
			       (UNI_CODIGO,PROB_CODIGO,SUBP_CODIGO,FUN_CODIGO,SOL_FECHA,SOL_TEXTO,VALOR_IDENTI1,VALOR_IDENTI2,ETIQUETA_IDENTI1,ETIQUETA_IDENTI2) VALUES
			 	    (" . $vehiculo->getUnidad() . ",  
             " . $vehiculo->getProblema() . ",  
            " . $vehiculo->getSubProblema() . ", 
           '" . $vehiculo->getFuncionario() . "', 
              NOW(),
            '" . $vehiculo->getObservacion() . "',
            '" . $vehiculo->getIdentificador1() . "',
            '" . $vehiculo->getIdentificador2() . "',
            '" . $vehiculo->getEtiqueta1() . "',
            '" . $vehiculo->getEtiqueta2() . "')";

    //echo $sql;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    //return $result;
    return mysql_insert_id( $this->Conecta() );
  }

  function updateSolicitud( $vehiculo ) {

    $sql = "UPDATE SOLICITUD SET
			    SOL_TEXTO = '" . $vehiculo->getObservacion() . "',
					VALOR_IDENTI1 = '" . $vehiculo->getIdentificador1() . "',
					VALOR_IDENTI2 = '" . $vehiculo->getIdentificador2() . "'
					WHERE SOL_CODIGO = " . $vehiculo->getCodigoSolicitud() . " ";

    //echo $sql;
    //$result = 1;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    return $result;
  }

  function updateEstadoSolicitud( $vehiculo, $fechaNuevoEstado ) {

    $sql = "UPDATE MOVIMIENTO SET
					FECHA_TERMINO = '" . $fechaNuevoEstado . "'
					WHERE SOL_CODIGO = " . $vehiculo->getCodigoSolicitud() . " AND FECHA_TERMINO IS NULL";

    //echo $sql;
    //$result = 1;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    return $result;
  }


  function updateTemporizador( $vehiculo ) {

    $sql = "UPDATE MOVIMIENTO 
               INNER JOIN SOLICITUD ON (MOVIMIENTO.SOL_CODIGO = SOLICITUD.SOL_CODIGO)
               SET VISIBLE=0
               WHERE 
               SOLICITUD.UNI_CODIGO=" . $vehiculo->getUnidad() . " AND CURDATE()>=DATE_ADD(MOVIMIENTO.FECHA_INICIO,INTERVAL 24 HOUR) 
              AND MOVIMIENTO.FECHA_TERMINO IS NULL AND VISIBLE=1  AND VALOR_IDENTI1 IS NULL 
              AND VALOR_IDENTI2 IS NULL";

    //echo $sql;
    //$result = 1;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    return $result;
  }

  function updateTemporizador2() {

    $sql = "UPDATE MOVIMIENTO 
INNER JOIN SOLICITUD ON (MOVIMIENTO.SOL_CODIGO = SOLICITUD.SOL_CODIGO)
SET TMOV_CODIGO=60
WHERE 
MOVIMIENTO.TMOV_CODIGO=20 AND CURDATE()>=DATE_ADD(MOVIMIENTO.FECHA_INICIO,INTERVAL 24 HOUR) 
AND MOVIMIENTO.FECHA_TERMINO IS NULL";

    //echo $sql;
    //$result = 1;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    return $result;
  }

  function insertMovimiento( $vehiculo, $fechaSolicitud ) {

    //echo "aqui";

    //echo "jjjj " . $vehiculo->getLugarReparacion()->getCodigo();

    $texto = "OFICIALIZADO POR USUARIO";
    $usuario = 10;
    $secciones = "NULL";
    $fechaInicio = date( "Y-m-d" );
    $fechaTermino = "NULL";
    $visible = 1;

    if ( $vehiculo->getFuncionarioDeriba() == "" )$unidadAgregadoGuardar = 'NULL';
    //else $unidadAgregadoGuardar = $vehiculo->getUnidadAgregado()->getCodigoUnidad();

    $sql = "INSERT INTO MOVIMIENTO (SOL_CODIGO, TMOV_CODIGO, TEXTO, FUNCIONARIO_IMPLICADO, ROL_FUNCIONARIO_IMPLICADO, FECHA,FECHA_INICIO,FUNCIONARIO_DERIBA,SDEPTO_CODIGO,ARCHIVO,VISIBLE)
					VALUES (" . $vehiculo->getCodigoSolicitud() . "," . $vehiculo->getTipoMovimiento() . ",'" . $vehiculo->getTextoMovimiento() . "','" . $vehiculo->getFuncionario() . "'," . $usuario . ",NOW(),'" . $fechaSolicitud . "','" . $unidadAgregadoGuardar . "'," . $vehiculo->getSecciones() . ",'" . $vehiculo->getArchivoSolicitud() . "'," . $visible . ")";

    //echo $sql;
    //$result = 1;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    return $result;
  }

  function insertMovimientoSolicitud( $vehiculo ) {

    //echo "aqui";

    //echo "jjjj " . $vehiculo->getLugarReparacion()->getCodigo();

    //$texto="ESTO ES UNA PRUEBA ...";
    $tipoUsuario = 10;
    $visible = 1;
    //$implicado="995762T";

    //if ($vehiculo->getFuncionarioDeriba() == 0) $funcionarioDerivadoGuardar = 'NULL';
    //else $funcionarioDerivadoGuardar = $vehiculo->getFuncionarioDeriba();

    $funcionarioDerivadoGuardar = 'NULL';

    if ( $vehiculo->getSecciones() == 0 )$seccionesGuardar = 'NULL';
    else $seccionesGuardar = $vehiculo->getSecciones();


    $sql = "INSERT INTO MOVIMIENTO (SOL_CODIGO, TMOV_CODIGO, TEXTO, FUNCIONARIO_IMPLICADO, ROL_FUNCIONARIO_IMPLICADO,FECHA,FECHA_INICIO,FUNCIONARIO_DERIBA,SDEPTO_CODIGO,ARCHIVO,VISIBLE)
					VALUES (" . $vehiculo->getCodigoSolicitud() . "," . $vehiculo->getCodigoTipoMovimiento() . ",'" . $vehiculo->getTextoMovimiento() . "','" . $vehiculo->getUsuarioImplicado() . "'," . $tipoUsuario . ",NOW(),'" . $vehiculo->getFechaInicio() . "','" . $funcionarioDerivadoGuardar . "'," . $seccionesGuardar . ",'" . $vehiculo->getArchivoSolicitud() . "'," . $visible . ")";

    //echo $sql;
    //$result = 1;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    return $result;
  }

	function datoUsuario($unidad,$usuario,$vista){

		$sql = "SELECT 
				  UNIDAD.UNI_DESCRIPCION AS DESTACAMENTO,
				  UNIDAD.UNI_CODIGO AS UNI_CODIGO,
				  FUNCIONARIO.FUN_CODIGO AS COD_FUNC,
				  GRADO.GRA_DESCRIPCION AS GRADO,
				  CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
				  TIPO_USUARIO.TUS_CODIGO,
				  TIPO_USUARIO.TUS_DESCRIPCION AS TIPO
				FROM USUARIO
				JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
				JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
				JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
				JOIN UNIDAD ON UNIDAD.UNI_CODIGO = USUARIO.UNI_CODIGO
				WHERE UNIDAD.UNI_CODIGO = {$unidad} AND USUARIO.US_LOGIN='{$usuario}'";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$vista = new vista;
			$vista->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$vista->setDestacamento($myrow["DESTACAMENTO"]);
			$vista->setFuncionario($myrow["COD_FUNC"]);
			$vista->setNomFuncionario($myrow["NOMBRE_COMPLETO"]);
			$vista->setTipoUsuario($myrow["TIPO"]);
			$vista->setGrado($myrow["GRADO"]);
		}
	}

function datoUsuarioSolicitud($unidad,$solicitud,$vista){
	
	$sql = "SELECT 
				UNIDAD.UNI_DESCRIPCION AS DESTACAMENTO,
				UNIDAD.UNI_CODIGO AS UNI_CODIGO,
				FUNCIONARIO.FUN_CODIGO AS COD_FUNC,
				GRADO.GRA_DESCRIPCION AS GRADO,
				CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
				TIPO_USUARIO.TUS_CODIGO,
				TIPO_USUARIO.TUS_DESCRIPCION AS TIPO,
				SOLICITUD.SOL_CODIGO,
				SOLICITUD.UNI_CODIGO,
				SOLICITUD.SOL_FECHA,
				SOLICITUD.SOL_TEXTO,
				SOLICITUD.PROB_CODIGO,
				SOLICITUD.SUBP_CODIGO,
				SOLICITUD.VALOR_IDENTI1,
				SOLICITUD.VALOR_IDENTI2,
				SOLICITUD.ETIQUETA_IDENTI1,
				SOLICITUD.ETIQUETA_IDENTI2,
				PROBLEMA.PROB_DESCRIPCION,
				SUBPROBLEMA.SUBP_DESCRIPCION,
				MOVIMIENTO.TEXTO,
				MOVIMIENTO.FECHA,
				MOVIMIENTO.TMOV_CODIGO,
				MOVIMIENTO.FUNCIONARIO_IMPLICADO,
				MOVIMIENTO.FUNCIONARIO_DERIBA,
				MOVIMIENTO.SDEPTO_CODIGO,
				TIPO_MOVIMIENTO.TMOV_DESCRIPCION
			FROM USUARIO
			JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
			jOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
			JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
			JOIN UNIDAD ON (USUARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
			JOIN SOLICITUD ON (UNIDAD.UNI_CODIGO = SOLICITUD.UNI_CODIGO) AND (SOLICITUD.FUN_CODIGO = USUARIO.FUN_CODIGO)
			JOIN MOVIMIENTO ON (SOLICITUD.SOL_CODIGO = MOVIMIENTO.SOL_CODIGO)
			JOIN PROBLEMA ON (SOLICITUD.PROB_CODIGO = PROBLEMA.PROB_CODIGO)
			JOIN SUBPROBLEMA ON (SOLICITUD.SUBP_CODIGO = SUBPROBLEMA.SUBP_CODIGO)
			JOIN TIPO_MOVIMIENTO ON (MOVIMIENTO.TMOV_CODIGO = TIPO_MOVIMIENTO.TMOV_CODIGO)
			WHERE UNIDAD.UNI_CODIGO = {$unidad} AND SOLICITUD.SOL_CODIGO = {$solicitud} AND FECHA_TERMINO IS NULL";
		//echo $sql;
		$i=0;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			$vista = new datoUsuarioSolicitud;
			$vista->setCodigoUnidad($myrow["UNI_CODIGO"]);
			$vista->setDestacamento($myrow["DESTACAMENTO"]);
			$vista->setFuncionario($myrow["COD_FUNC"]);
			$vista->setNomFuncionario($myrow["NOMBRE_COMPLETO"]);
			$vista->setTipoUsuario($myrow["TIPO"]);
			$vista->setGrado($myrow["GRADO"]);
			
			$vista->setCodigoSolicitud($myrow["SOL_CODIGO"]);
			$vista->setUnidad($myrow["UNI_CODIGO"]);
			$vista->setFechaSolicitud($myrow["SOL_FECHA"]);
			$vista->setProblema(STRTOUPPER($myrow["PROB_DESCRIPCION"]));
			$vista->setSubProblema(STRTOUPPER($myrow["SUBP_DESCRIPCION"]));
			$vista->setTipoMovimiento(STRTOUPPER($myrow["TMOV_DESCRIPCION"]));
			$vista->setCodigoProblema($myrow["PROB_CODIGO"]);
			$vista->setCodigoSubProblema($myrow["SUBP_CODIGO"]);
			$vista->setCodigoTipoMov($myrow["TMOV_CODIGO"]);
			$vista->setObservacion($myrow["SOL_TEXTO"]);
			
			$vista->setIdentificador1($myrow["VALOR_IDENTI1"]);
			$vista->setIdentificador2($myrow["VALOR_IDENTI2"]);
			$vista->setMovimientoTexto($myrow["TEXTO"]);
			$vista->setSecciones($myrow["SDEPTO_CODIGO"]);
		}
	}
	
	function datoSolicitud2( $unidad, $codigo, $solicitud ) {

    $sql = "SELECT 
  VISTA_ARBOL_UNIDADES_NACIONAL.ZONA_DESCRIPCION AS ZONA,
  VISTA_ARBOL_UNIDADES_NACIONAL.PREFECTURA_DESCRIPCION AS PREFECTURA,
  VISTA_ARBOL_UNIDADES_NACIONAL.COMISARIA_DESCRIPCION AS COMISARIA,
  VISTA_ARBOL_UNIDADES_NACIONAL.UNI_DESCRIPCION AS DESTACAMENTO,
  GRADO.GRA_DESCRIPCION AS GRADO,
  CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
  TIPO_USUARIO.TUS_DESCRIPCION AS TIPO,
  REQUERIMIENTO.REQ_CODIGO,
  REQUERIMIENTO.UNI_CODIGO,
  REQUERIMIENTO.FUN_CODIGO,
  REQUERIMIENTO.REQ_TIPO,
  REQUERIMIENTO.REQ_MODULO,
  REQUERIMIENTO.REQ_PROBLEMA,
  REQUERIMIENTO.REQ_OBS,
  REQUERIMIENTO.FECHA_INICIO,
  REQUERIMIENTO.FECHA_TERMINO,
  REQUERIMIENTO.ESTADO
FROM
 USUARIO
 INNER JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
 INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
  AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
 INNER JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
 INNER JOIN REQUERIMIENTO ON(USUARIO.US_LOGIN = REQUERIMIENTO.FUN_CODIGO)
 INNER JOIN VISTA_ARBOL_UNIDADES_NACIONAL ON (USUARIO.UNI_CODIGO = VISTA_ARBOL_UNIDADES_NACIONAL.UNI_CODIGO)
WHERE
  USUARIO.UNI_CODIGO=" . $unidad . " AND REQUERIMIENTO.REQ_CODIGO=" . $codigo . "
ORDER BY 
  VISTA_ARBOL_UNIDADES_NACIONAL.ZONA_DESCRIPCION,
  VISTA_ARBOL_UNIDADES_NACIONAL.PREFECTURA_DESCRIPCION,
  VISTA_ARBOL_UNIDADES_NACIONAL.COMISARIA_DESCRIPCION,
  VISTA_ARBOL_UNIDADES_NACIONAL.UNI_DESCRIPCION";

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      $solicitud = new solicitud;
      $solicitud->setZona( $myrow[ "ZONA" ] );
      $solicitud->setPrefectura( $myrow[ "PREFECTURA" ] );
      $solicitud->setComisaria( $myrow[ "COMISARIA" ] );
      $solicitud->setDestacamento( $myrow[ "DESTACAMENTO" ] );
      $solicitud->setNomFuncionario( $myrow[ "NOMBRE_COMPLETO" ] );
      $solicitud->setTipoUsuario( $myrow[ "TIPO" ] );
      $solicitud->setGrado( $myrow[ "GRADO" ] );
      $solicitud->setCodigoRequerimiento( $myrow[ "REQ_CODIGO" ] );
      $solicitud->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $solicitud->setFuncionario( $myrow[ "FUN_CODIGO" ] );
      $solicitud->setTipoRequerimiento( STRTOUPPER( $myrow[ "REQ_TIPO" ] ) );
      $solicitud->setModulo( STRTOUPPER( $myrow[ "REQ_MODULO" ] ) );
      $solicitud->setProblema( STRTOUPPER( $myrow[ "REQ_PROBLEMA" ] ) );
      $solicitud->setObservacion( STRTOUPPER( $myrow[ "REQ_OBS" ] ) );
      $solicitud->setFechaInicio( $myrow[ "FECHA_INICIO" ] );
      $solicitud->setFechaTermino( $myrow[ "FECHA_TERMINO" ] );
      $solicitud->setEstado( STRTOUPPER( $myrow[ "ESTADO" ] ) );

      //$funcionarios[$i] = $dioscar;					
      //$i++;
    }
  }

  function datoSolicitud( $unidad, $codigo, $solicitud ) {

    $sql = "     SELECT 
	    `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
                SOLICITUD.FUN_CODIGO,
               GRADO.GRA_DESCRIPCION AS GRADO,
              CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
                SOLICITUD.SOL_TEXTO,
                SOLICITUD.PROB_CODIGO,
                SOLICITUD.SUBP_CODIGO,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               MOVIMIENTO.TEXTO,
               MOVIMIENTO.FECHA,
               MOVIMIENTO.TMOV_CODIGO,
               MOVIMIENTO.FUNCIONARIO_IMPLICADO,
               MOVIMIENTO.FUNCIONARIO_DERIBA,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
              SOLICITUD.VALOR_IDENTI1,
              SOLICITUD.VALOR_IDENTI2
              FROM
               `SOLICITUD`
                INNER JOIN FUNCIONARIO ON (SOLICITUD.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          WHERE
          UNIDAD.UNI_CODIGO=" . $unidad . " AND SOLICITUD.SOL_CODIGO=" . $codigo . " AND FECHA_TERMINO IS NULL AND SOLICITUD.SOL_FECHA BETWEEN '20220101' AND '20491231'
          ";

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      $solicitud = new lSolicitud;
      $solicitud->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $solicitud->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $solicitud->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $solicitud->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $solicitud->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $solicitud->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $solicitud->setCodigoProblema( $myrow[ "PROB_CODIGO" ] );
      $solicitud->setCodigoSubProblema( $myrow[ "SUBP_CODIGO" ] );
      $solicitud->setCodigoTipoMov( $myrow[ "TMOV_CODIGO" ] );
      $solicitud->setUsuarioSolicitud( $myrow[ "FUN_CODIGO" ] );
      $solicitud->setGrado( $myrow[ "GRADO" ] );
      $solicitud->setNomCompleto( $myrow[ "NOMBRE_COMPLETO" ] );
      $solicitud->setObservacion( $myrow[ "SOL_TEXTO" ] );
      $solicitud->setMovimientoTexto( $myrow[ "TEXTO" ] );
      $solicitud->setIdentificador1( $myrow[ "VALOR_IDENTI1" ] );
      $solicitud->setIdentificador2( $myrow[ "VALOR_IDENTI2" ] );


      //$funcionarios[$i] = $dioscar;					
      //$i++;
    }
  }

  function datoMovimiento( $unidad, $codigo, $solicitud ) {

    $sql = "     SELECT 
	    `SOLICITUD`.`SOL_CODIGO`,
               `SOLICITUD`.`UNI_CODIGO`,
               `SOLICITUD`.`SOL_FECHA`,
                SOLICITUD.FUN_CODIGO,
               GRADO.GRA_DESCRIPCION AS GRADO,
              CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
                SOLICITUD.SOL_TEXTO,
                SOLICITUD.PROB_CODIGO,
                SOLICITUD.SUBP_CODIGO,
               `PROBLEMA`.`PROB_DESCRIPCION`,
               `SUBPROBLEMA`.`SUBP_DESCRIPCION`,
               MOVIMIENTO.TEXTO,
               MOVIMIENTO.FECHA,
               MOVIMIENTO.TMOV_CODIGO,
               MOVIMIENTO.FUNCIONARIO_IMPLICADO,
               MOVIMIENTO.FUNCIONARIO_DERIBA,
               `TIPO_MOVIMIENTO`.`TMOV_DESCRIPCION`,
               UNIDAD.UNI_DESCRIPCION,
              SOLICITUD.VALOR_IDENTI1,
              SOLICITUD.VALOR_IDENTI2
              FROM
               `SOLICITUD`
                INNER JOIN FUNCIONARIO ON (SOLICITUD.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
            INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
             AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                INNER JOIN `MOVIMIENTO` ON (`SOLICITUD`.`SOL_CODIGO` = `MOVIMIENTO`.`SOL_CODIGO`)
                INNER JOIN `PROBLEMA` ON (`SOLICITUD`.`PROB_CODIGO` = `PROBLEMA`.`PROB_CODIGO`)
                INNER JOIN `SUBPROBLEMA` ON (`SOLICITUD`.`SUBP_CODIGO` = `SUBPROBLEMA`.`SUBP_CODIGO`)
                INNER JOIN `TIPO_MOVIMIENTO` ON (`MOVIMIENTO`.`TMOV_CODIGO` = `TIPO_MOVIMIENTO`.`TMOV_CODIGO`)
                INNER JOIN UNIDAD ON(SOLICITUD.UNI_CODIGO = UNIDAD.UNI_CODIGO)
          WHERE
          UNIDAD.UNI_CODIGO=" . $unidad . " AND SOLICITUD.SOL_CODIGO=" . $codigo . " AND `movimiento`.TMOV_CODIGO NOT IN(10)
          ";

    //echo $sql;

    $i = 0;
    $result = $this->execstmt( $this->Conecta(), $sql );
    mysql_close();
    while ( $myrow = mysql_fetch_array( $result ) ) {

      $solicitud = new lSolicitud;
      $solicitud->setCodigoSolicitud( $myrow[ "SOL_CODIGO" ] );
      $solicitud->setUnidad( $myrow[ "UNI_CODIGO" ] );
      $solicitud->setFechaSolicitud( $myrow[ "SOL_FECHA" ] );
      $solicitud->setProblema( STRTOUPPER( $myrow[ "PROB_DESCRIPCION" ] ) );
      $solicitud->setSubProblema( STRTOUPPER( $myrow[ "SUBP_DESCRIPCION" ] ) );
      $solicitud->setTipoMovimiento( STRTOUPPER( $myrow[ "TMOV_DESCRIPCION" ] ) );
      $solicitud->setCodigoProblema( $myrow[ "PROB_CODIGO" ] );
      $solicitud->setCodigoSubProblema( $myrow[ "SUBP_CODIGO" ] );
      $solicitud->setCodigoTipoMov( $myrow[ "TMOV_CODIGO" ] );
      $solicitud->setUsuarioSolicitud( $myrow[ "FUN_CODIGO" ] );
      $solicitud->setGrado( $myrow[ "GRADO" ] );
      $solicitud->setNomCompleto( $myrow[ "NOMBRE_COMPLETO" ] );
      $solicitud->setObservacion( $myrow[ "SOL_TEXTO" ] );
      $solicitud->setMovimientoTexto( $myrow[ "TEXTO" ] );
      $solicitud->setIdentificador1( $myrow[ "VALOR_IDENTI1" ] );
      $solicitud->setIdentificador2( $myrow[ "VALOR_IDENTI2" ] );


      $solicitudes[ $i ] = $solicitud;
      $i++;
    }
  }


} //end class   
?>