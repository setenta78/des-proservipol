<?
include("../../inc/configV4.inc.php");
	
	$unidad 	= $_POST['codigoUnidad'];
	$fecha 		= $_POST['fecha'];
	$fechaPaso  = explode("-",$fecha);
  $fecha      = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
	
  $CONECT1 = @mysql_connect(HOST,DB_USER,DB_PASS);
	mysql_select_db(DB);
	
	$sql1 = "SELECT 
						TIPO_ESCALAFON.TESC_DESCRIPCION,
						COUNT(TIPO_ESCALAFON.TESC_DESCRIPCION) AS CANT_FUNCIONARIOS
					FROM FUNCIONARIO
					INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
					AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
					LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					INNER JOIN ESCALAFON ON (GRADO.ESC_CODIGO = ESCALAFON.ESC_CODIGO)
					INNER JOIN TIPO_ESCALAFON ON (ESCALAFON.TESC_CODIGO = TIPO_ESCALAFON.TESC_CODIGO)
					WHERE
						CARGO_FUNCIONARIO.UNI_CODIGO = '".$unidad."' AND 
						CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND 
						(CARGO_FUNCIONARIO.FECHA_HASTA > '".$fecha."' OR CARGO_FUNCIONARIO.FECHA_HASTA IS NULL) AND 
						CARGO_FUNCIONARIO.CAR_CODIGO not in (1000,2000, 3500)
					GROUP BY
						TIPO_ESCALAFON.TESC_DESCRIPCION
						ORDER BY
						TIPO_ESCALAFON.TESC_CODIGO";
	
	$result1 = mysql_query($sql1,$CONECT1);
	
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='2' align='left' id='nombreColumna2'>PERSONAL UNIDAD</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='70%' align='left' id='nombreColumna2'>ESCALAFON</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>TOTAL</td>";
	echo "</tr>";
	$totalPersonalUnidad = 0;
	while ($myrow1 = mysql_fetch_array($result1)){
		echo "<tr>";
		echo "<td align='left' class='dato'>".$myrow1[TESC_DESCRIPCION]."</td>";
		echo "<td align='left' class='dato'>".$myrow1[CANT_FUNCIONARIOS]."</td>";
		echo "</tr>";
		$totalPersonalUnidad = $totalPersonalUnidad + $myrow1[CANT_FUNCIONARIOS];
	}
	echo "<tr>";
	echo "<td width='18%' align='right' id='nombreColumna2'>(+) TOTAL PERSONAL UNIDAD&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalUnidad."</td>";
	echo "</tr>";
	echo "</table>";
	
	$sql1 = "SELECT
						TIPO_ESCALAFON.TESC_DESCRIPCION,
						UNIDAD.UNI_DESCRIPCION,
						COUNT(TIPO_ESCALAFON.TESC_DESCRIPCION) AS CANT_FUNCIONARIOS
					FROM GRADO
					INNER JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
					INNER JOIN ESCALAFON ON (ESCALAFON.ESC_CODIGO = GRADO.ESC_CODIGO)
					INNER JOIN TIPO_ESCALAFON ON (TIPO_ESCALAFON.TESC_CODIGO = ESCALAFON.TESC_CODIGO)
					LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					LEFT OUTER JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
					INNER JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
						WHERE 
						(
							(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
							CARGO_FUNCIONARIO.FECHA_HASTA > '".$fecha."')
							OR
							(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
							CARGO_FUNCIONARIO.FECHA_HASTA IS NULL AND
							FUNCIONARIO.UNI_CODIGO IS NOT NULL AND
							FUNCIONARIO.UNI_CODIGO = CARGO_FUNCIONARIO.UNI_CODIGO)
						)
						AND (CARGO_FUNCIONARIO.CAR_CODIGO=3000 OR CARGO_FUNCIONARIO.CAR_CODIGO=3100 OR CARGO_FUNCIONARIO.CAR_CODIGO=3001 OR CARGO_FUNCIONARIO.CAR_CODIGO=3002 OR CARGO_FUNCIONARIO.CAR_CODIGO=3003 OR CARGO_FUNCIONARIO.CAR_CODIGO=3004 OR CARGO_FUNCIONARIO.CAR_CODIGO=3005 OR CARGO_FUNCIONARIO.CAR_CODIGO=6000)
						AND CARGO_FUNCIONARIO.UNI_AGREGADO='".$unidad."'
						GROUP BY TIPO_ESCALAFON.TESC_CODIGO, CARGO_FUNCIONARIO.UNI_CODIGO
						ORDER BY
						TIPO_ESCALAFON.TESC_CODIGO ASC;";
	
	$result1 = mysql_query($sql1,$CONECT1);
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='3' align='left' id='nombreColumna2'>PERSONAL AGREGADO A LA UNIDAD</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='30%' align='left' id='nombreColumna2'>ESCALAFON</td>";
	echo "<td width='40%' align='left' id='nombreColumna2'>ORIGEN</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>TOTAL</td>";
	echo "</tr>";
	$totalPersonalAgregadoALaUnidad = 0;
	
	while ($myrow1 = mysql_fetch_array($result1)){
	  echo "<tr>";
	  echo "<td align='left' class='dato'>".$myrow1[TESC_DESCRIPCION]."</td>";
	  echo "<td align='left' class='dato'>".$myrow1[UNI_DESCRIPCION]."</td>";
	  echo "<td align='left' class='dato'>".$myrow1[CANT_FUNCIONARIOS]."</td>";
	  echo "</tr>";
	  $totalPersonalAgregadoALaUnidad = $totalPersonalAgregadoALaUnidad + $myrow1[CANT_FUNCIONARIOS];
	}
	
	echo "<tr>";
	echo "<td colspan='2' align='right' id='nombreColumna2'>(+) TOTAL PERSONAL AGREGADO A LA UNIDAD&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalAgregadoALaUnidad."</td>";
	echo "</tr>";
	echo "</table>";	
	echo "<div class='linea'></div>";
	
	$sql1 = "SELECT
						TIPO_ESCALAFON.TESC_DESCRIPCION,
						UNIDAD.UNI_DESCRIPCION,
						COUNT(TIPO_ESCALAFON.TESC_DESCRIPCION) AS CANT_FUNCIONARIOS,
						MIN(CARGO_FUNCIONARIO.CAR_CODIGO) AS MIN_CODIGO_CARGO
					FROM GRADO
					INNER JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO) AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
					INNER JOIN ESCALAFON ON (ESCALAFON.ESC_CODIGO = GRADO.ESC_CODIGO)
					INNER JOIN TIPO_ESCALAFON ON (TIPO_ESCALAFON.TESC_CODIGO = ESCALAFON.TESC_CODIGO)
					LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					LEFT OUTER JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
					LEFT OUTER JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD.UNI_CODIGO)
					WHERE	CARGO_FUNCIONARIO.UNI_CODIGO = '".$unidad."'  AND
					(
						(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
						CARGO_FUNCIONARIO.FECHA_HASTA > '".$fecha."')
						OR
						(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
						CARGO_FUNCIONARIO.FECHA_HASTA IS NULL)
					)
					AND (CARGO_FUNCIONARIO.CAR_CODIGO=3000 OR CARGO_FUNCIONARIO.CAR_CODIGO=3100 OR CARGO_FUNCIONARIO.CAR_CODIGO=3001 OR CARGO_FUNCIONARIO.CAR_CODIGO=3002 OR CARGO_FUNCIONARIO.CAR_CODIGO=3003 OR CARGO_FUNCIONARIO.CAR_CODIGO=3004 OR CARGO_FUNCIONARIO.CAR_CODIGO=3005 OR CARGO_FUNCIONARIO.CAR_CODIGO=6000)	
					GROUP BY TIPO_ESCALAFON.TESC_CODIGO, CARGO_FUNCIONARIO.UNI_AGREGADO
					ORDER BY
					TIPO_ESCALAFON.TESC_CODIGO ASC;";
	
	$result1 = mysql_query($sql1,$CONECT1);
	
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='3' align='left' id='nombreColumna2'>PERSONAL AGREGADO A OTRA UNIDAD</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='30 %' align='left' id='nombreColumna2'>ESCALAFON</td>";
	echo "<td width='40%' align='left' id='nombreColumna2'>DESTINO</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>TOTAL</td>";
	echo "</tr>";
	$totalPersonalAgregadoAOtraUnidad = 0;
	$existeSoloAgregado = 0;
	while ($myrow1 = mysql_fetch_array($result1)){
		echo "<tr>";
		echo "<td align='left' class='dato'>".$myrow1[TESC_DESCRIPCION]."</td>";
		echo "<td align='left' class='dato'>".$myrow1[UNI_DESCRIPCION]."</td>";
		echo "<td align='left' class='dato'>".$myrow1[CANT_FUNCIONARIOS]."</td>";
		echo "</tr>";
		$totalPersonalAgregadoAOtraUnidad = $totalPersonalAgregadoAOtraUnidad + $myrow1[CANT_FUNCIONARIOS];
		if ($myrow1[MIN_CODIGO_CARGO] == 3000 && $fecha >= '20130701') $existeSoloAgregado = 1;
	}
	echo "<input id='existeSoloAgregado' type='hidden' value='".$existeSoloAgregado."'>";  
	echo "<tr>";
	echo "<td colspan='2' align='right' id='nombreColumna2'>(-) TOTAL PERSONAL AGREGADO A OTRA UNIDAD&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalAgregadoAOtraUnidad."</td>";
	echo "</tr>";
	echo "</table>";
	
	$sql1 = "SELECT
						TIPO_ESCALAFON.TESC_DESCRIPCION,
						CARGO.CAR_DESCRIPCION,
						COUNT(TIPO_ESCALAFON.TESC_DESCRIPCION) AS CANT_FUNCIONARIOS
					FROM GRADO
					INNER JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO)
					AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
					INNER JOIN ESCALAFON ON (ESCALAFON.ESC_CODIGO = GRADO.ESC_CODIGO)
					INNER JOIN TIPO_ESCALAFON ON (TIPO_ESCALAFON.TESC_CODIGO = ESCALAFON.TESC_CODIGO)
					LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					LEFT OUTER JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
					WHERE
						CARGO_FUNCIONARIO.UNI_CODIGO = '".$unidad."'  AND
						(
							(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
							CARGO_FUNCIONARIO.FECHA_HASTA > '".$fecha."')
							OR
							(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
							CARGO_FUNCIONARIO.FECHA_HASTA IS NULL)
						)
						AND
						(CARGO_FUNCIONARIO.CAR_CODIGO=4000
						OR CARGO_FUNCIONARIO.CAR_CODIGO=4100
						OR CARGO_FUNCIONARIO.CAR_CODIGO=5000
						OR CARGO_FUNCIONARIO.CAR_CODIGO=7010)
					GROUP BY 
						TIPO_ESCALAFON.TESC_CODIGO,
						CARGO.CAR_DESCRIPCION
						ORDER BY
						TIPO_ESCALAFON.TESC_CODIGO ASC;";
	
	$result1 = mysql_query($sql1,$CONECT1);
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='3' align='left' id='nombreColumna2'>PERSONAL NO OFERTA DE FORMA PERMANENTE</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='30%' align='left' id='nombreColumna2'>ESCALAFON</td>";
	echo "<td width='40%' align='left' id='nombreColumna2'>ESTADO HOY</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>TOTAL</td>";
	echo "</tr>";
	$totalPersonalNoEsOferta = 0;
	
	while ($myrow1 = mysql_fetch_array($result1)){
		echo "<tr>";
		echo "<td align='left' class='dato'>".$myrow1[TESC_DESCRIPCION]."</td>";
		echo "<td align='left' class='dato'>".$myrow1[CAR_DESCRIPCION]."</td>";
		echo "<td align='left' class='dato'>".$myrow1[CANT_FUNCIONARIOS]."</td>";
		echo "</tr>";
		$totalPersonalNoEsOferta = $totalPersonalNoEsOferta + $myrow1[CANT_FUNCIONARIOS];
	}
	echo "<tr>";
	echo "<td colspan='2' align='right' id='nombreColumna2'>(-) TOTAL PERSONAL NO DISPONIBLE (NO OFERTA)&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalNoEsOferta."</td>";
	echo "</tr>";
	echo "</table>";
	
	$totalPersonalDisponible = $totalPersonalUnidad + $totalPersonalAgregadoALaUnidad - $totalPersonalAgregadoAOtraUnidad - $totalPersonalNoEsOferta;
	echo "<div class='linea'></div>";
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td width='70%' align='right' id='nombreColumna2'>DOTACION AJUSTADA (PERSONAL UNIDAD + PERSONAL AGREGADO A LA UNIDAD - PERSONAL AGREGADO A OTRA UNIDAD - PERSONAL NO OFERTA)&nbsp;:&nbsp;</td>";
	echo "<td width='30%' align='left' class='dato'>".$totalPersonalDisponible."</td>";
	echo "</tr>";
	echo "</table>";
	echo "<div class='linea'></div>";
	
	$sql1 = "(SELECT
							FUNCIONARIO.FUN_CODIGO AS FUN_CODIGO,
							GRADO.GRA_DESCRIPCION AS GRA_DESCRIPCION,
							FUNCIONARIO.FUN_APELLIDOPATERNO AS FUN_APELLIDOPATERNO,
							FUNCIONARIO.FUN_APELLIDOMATERNO AS FUN_APELLIDOMATERNO,
							FUNCIONARIO.FUN_NOMBRE AS FUN_NOMBRE,
							'FUNCIONARIO DE LA UNIDAD' AS SITUACION
						FROM FUNCIONARIO
						INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
						LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
						WHERE CARGO_FUNCIONARIO.UNI_CODIGO = '".$unidad."' AND
							((CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND CARGO_FUNCIONARIO.FECHA_HASTA > '".$fecha."')
							OR
							(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL))
							AND CARGO_FUNCIONARIO.CAR_CODIGO != 1000 AND CARGO_FUNCIONARIO.CAR_CODIGO != 2000 AND CARGO_FUNCIONARIO.CAR_CODIGO != 3000 
							AND CARGO_FUNCIONARIO.CAR_CODIGO != 3100 AND CARGO_FUNCIONARIO.CAR_CODIGO != 3001 AND CARGO_FUNCIONARIO.CAR_CODIGO != 3002 
							AND CARGO_FUNCIONARIO.CAR_CODIGO != 3003 AND CARGO_FUNCIONARIO.CAR_CODIGO != 3004 AND CARGO_FUNCIONARIO.CAR_CODIGO != 3005
							AND CARGO_FUNCIONARIO.CAR_CODIGO != 4000 AND CARGO_FUNCIONARIO.CAR_CODIGO != 4100 AND CARGO_FUNCIONARIO.CAR_CODIGO != 5000 
							AND CARGO_FUNCIONARIO.CAR_CODIGO != 6000 AND CARGO_FUNCIONARIO.CAR_CODIGO != 7010 
							AND CARGO_FUNCIONARIO.CAR_CODIGO != 3500
							AND FUNCIONARIO.FUN_CODIGO NOT IN  (SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
																									FROM FUNCIONARIO_SERVICIO
																									INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
																									AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
																									WHERE SERVICIO.FECHA = '".$fecha."' AND SERVICIO.UNI_CODIGO = '".$unidad."')
							)
							UNION
							(SELECT
								FUNCIONARIO.FUN_CODIGO AS FUN_CODIGO,
								GRADO.GRA_DESCRIPCION AS GRA_DESCRIPCION,
								FUNCIONARIO.FUN_APELLIDOPATERNO AS FUN_APELLIDOPATERNO,
								FUNCIONARIO.FUN_APELLIDOMATERNO AS FUN_APELLIDOMATERNO,
								FUNCIONARIO.FUN_NOMBRE AS FUN_NOMBRE,
								'FUNCIONARIO AGREGADO A ESTA UNIDAD' AS SITUACION
							FROM FUNCIONARIO
							INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
							LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
							WHERE CARGO_FUNCIONARIO.UNI_AGREGADO = '".$unidad."' 
							AND FUNCIONARIO.UNI_CODIGO = CARGO_FUNCIONARIO.UNI_CODIGO
							AND CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND (CARGO_FUNCIONARIO.FECHA_HASTA > '".$fecha."' OR CARGO_FUNCIONARIO.FECHA_HASTA IS NULL) 
							AND FUNCIONARIO.FUN_CODIGO NOT IN (SELECT FUNCIONARIO_SERVICIO.FUN_CODIGO
																								FROM	FUNCIONARIO_SERVICIO
																								INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
																								WHERE SERVICIO.FECHA = '".$fecha."' AND SERVICIO.UNI_CODIGO = '".$unidad."'));";
	
	$result1 = mysql_query($sql1,$CONECT1);
	echo "<br>";echo "<br>";
	$totalPersonalSinServicioAsignado = 0;
	echo "<div class='linea'></div>";
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='3' align='left' id='nombreColumna2'>PERSONAL SIN SERVICIOS ASIGNADOS</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='30%' align='left' id='nombreColumna2'>NOMBRE</td>";
	echo "<td width='40%' align='left' id='nombreColumna2'>CODIGO</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>OBSERVACIONES</td>";
	echo "</tr>";
	
	while ($myrow1 = mysql_fetch_array($result1)){
		echo "<tr>";
		echo "<td class='dato'>".utf8_encode($myrow1[FUN_APELLIDOPATERNO])." ".utf8_encode($myrow1[FUN_APELLIDOMATERNO]).", ".utf8_encode($myrow1[FUN_NOMBRE])." (".$myrow1[GRA_DESCRIPCION].")</td>";
		echo "<td class='dato'>".$myrow1[FUN_CODIGO]."</td>";
		echo "<td class='dato'>".$myrow1[SITUACION]."</td>";
		echo "</tr>";
		$totalPersonalSinServicioAsignado = $totalPersonalSinServicioAsignado + 1;
	}
	
	echo "<tr>";
	echo "<td colspan='2' align='right' id='nombreColumna2'>TOTAL PERSONAL SIN SERVICIO ASIGNADO&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalSinServicioAsignado."</td>";
	echo "<input id='totalSinServicio' type='hidden' value='".$totalPersonalSinServicioAsignado."'>";  
	echo "</tr>";
	echo "</table>";
	echo "<div class='linea'></div>";
	
	$sql1 = "SELECT
						FUNCIONARIO.FUN_CODIGO AS FUN_CODIGO,
						GRADO.GRA_DESCRIPCION AS GRA_DESCRIPCION,
						FUNCIONARIO.FUN_APELLIDOPATERNO AS FUN_APELLIDOPATERNO,
						FUNCIONARIO.FUN_APELLIDOMATERNO AS FUN_APELLIDOMATERNO,
						FUNCIONARIO.FUN_NOMBRE AS FUN_NOMBRE,
						SERVICIO.HORA_INICIO,
						SERVICIO.HORA_TERMINO,
						TIPO_SERVICIO.TSERV_DESCRIPCION,
						TIPO_SERVICIO.TSERV_TIPO,
						SERVICIO.TSERV_CODIGO	
					FROM FUNCIONARIO	
					INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
					LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
					INNER JOIN FUNCIONARIO_SERVICIO ON (FUNCIONARIO.FUN_CODIGO = FUNCIONARIO_SERVICIO.FUN_CODIGO) 
					INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO) 						
					WHERE CARGO_FUNCIONARIO.UNI_CODIGO = '".$unidad."'  AND
					(
						(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
						CARGO_FUNCIONARIO.FECHA_HASTA > '".$fecha."')
						OR
						(CARGO_FUNCIONARIO.FECHA_DESDE <= '".$fecha."' AND
						CARGO_FUNCIONARIO.FECHA_HASTA IS NULL)
					)
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 3000
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 3100
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 3001
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 3002
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 3003
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 3004
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 3005
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 4000
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 5000
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 6000	
					AND CARGO_FUNCIONARIO.CAR_CODIGO != 7010
					AND SERVICIO.FECHA = '".$fecha."' AND SERVICIO.UNI_CODIGO = '".$unidad."'
					AND FUNCIONARIO.FUN_CODIGO IN (SELECT                                                                           
																				FUNCIONARIO_SERVICIO.FUN_CODIGO                                                
																				FROM FUNCIONARIO_SERVICIO
																				INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO) AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
																				WHERE SERVICIO.FECHA = '".$fecha."' AND SERVICIO.UNI_CODIGO = '".$unidad."'
																				GROUP BY FUNCIONARIO_SERVICIO.FUN_CODIGO
																				HAVING COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) > 1)
																				ORDER BY
																				FUNCIONARIO.ESC_CODIGO ASC,
																				FUNCIONARIO.GRA_CODIGO ASC,
																				FUNCIONARIO.FUN_CODIGO ASC,
																				SERVICIO.HORA_INICIO ASC;";
	
	$result1 = mysql_query($sql1,$CONECT1);
	echo "<div class='linea'></div>";
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='3' align='left' id='nombreColumna2'>PERSONAL CON MAS DE UNA ASIGNACION</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='30%' align='left' id='nombreColumna2'>NOMBRE</td>";
	echo "<td width='40%' align='left' id='nombreColumna2'>SERVICIO</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>OBSERVACIONES</td>";
	echo "</tr>";
	
	$codigoFunAux="";
	$codigoFunAux2 = "";
	$nombrefunAux = "";
	$horarioAux="";	
	
	$totalPersonalMasDeUnServicio = 0;
	$ausenciasNoValidas = 0;
	$funcionariosConProblemas = "";
	$cantidadDeAsignaciones = 0;
	$cantidadColacion = 0;
	$cont = 0;
	$colacionesNoValidas = 0;
	while ($myrow1 = mysql_fetch_array($result1)){
		if ($codigoFunAux2!=$myrow1[FUN_CODIGO]){
			if ($codigoFunAux2 != ""){
				if ($cantidadDeAsignaciones > 1 && $cantidadColacion >= 1){
					$colacionesNoValidas = $colacionesNoValidas + 1;
				}
			}
			$codigoFunAux2=$myrow1[FUN_CODIGO];
			$nombrefunAux = utf8_encode($myrow1[FUN_APELLIDOPATERNO])." ".utf8_encode($myrow1[FUN_APELLIDOMATERNO]).", ".utf8_encode($myrow1[FUN_NOMBRE])." - ".$myrow1[GRA_DESCRIPCION]. " (".$myrow1[FUN_CODIGO].")";
			$cantidadDeAsignaciones = 0;	
			$cantidadColacion = 0;
		}
		
		$horarioAux = "";
		if($myrow1[TSERV_TIPO]=="N" && $myrow1[TSERV_CODIGO] != 142 && $myrow1[TSERV_CODIGO] != 143 && $myrow1[TSERV_CODIGO] != 144 && $myrow1[TSERV_CODIGO] != 145 && $myrow1[TSERV_CODIGO] != 146 && $myrow1[TSERV_CODIGO] != 147 && $myrow1[TSERV_CODIGO] != 148  && $myrow1[TSERV_CODIGO] != 149  && $myrow1[TSERV_CODIGO] != 151  && $myrow1[TSERV_CODIGO] != 152  && $myrow1[TSERV_CODIGO] != 153){
	    $horarioAux="";
	    $ausenciasNoValidas = $ausenciasNoValidas + 1;
	    $funcionariosConProblemas = $funcionariosConProblemas . utf8_encode($myrow1[FUN_APELLIDOPATERNO])." ".utf8_encode($myrow1[FUN_APELLIDOMATERNO]).", ".utf8_encode($myrow1[FUN_NOMBRE])." - ".$myrow1[GRA_DESCRIPCION]. " (".$myrow1[FUN_CODIGO].")\n";
		} 
		else {
			if($myrow1[TSERV_CODIGO] != 142 && $myrow1[TSERV_CODIGO] != 143 && $myrow1[TSERV_CODIGO] != 144 && $myrow1[TSERV_CODIGO] != 145 && $myrow1[TSERV_CODIGO] != 146 && $myrow1[TSERV_CODIGO] != 147 && $myrow1[TSERV_CODIGO] != 148  && $myrow1[TSERV_CODIGO] != 149  && $myrow1[TSERV_CODIGO] != 151  && $myrow1[TSERV_CODIGO] != 152  && $myrow1[TSERV_CODIGO] != 153){
		    	$horarioAux=substr($myrow1[HORA_INICIO],0,5)." - ".substr($myrow1[HORA_TERMINO],0,5);
		    	if ($myrow1[TSERV_CODIGO]!= 607) $cantidadDeAsignaciones = $cantidadDeAsignaciones + 1;
		    }
		  else{
		    	$cantidadColacion = $cantidadColacion + 1;
			}		    
		}
		
		if($myrow1[TSERV_CODIGO]==580){
			$ausenciasNoValidas = $ausenciasNoValidas + 1;
		  $funcionariosConProblemas = $funcionariosConProblemas . utf8_encode($myrow1[FUN_APELLIDOPATERNO])." ".utf8_encode($myrow1[FUN_APELLIDOMATERNO]).", ".utf8_encode($myrow1[FUN_NOMBRE])." - ".$myrow1[GRA_DESCRIPCION]. " (".$myrow1[FUN_CODIGO].")\n";
		}
		
		if ($codigoFunAux!=$myrow1[FUN_CODIGO]){ 
			$nombreFuncionarioMasServicio = utf8_encode($myrow1[FUN_APELLIDOPATERNO])." ".utf8_encode($myrow1[FUN_APELLIDOMATERNO]).", ".utf8_encode($myrow1[FUN_NOMBRE])." - ".$myrow1[GRA_DESCRIPCION]. " (".$myrow1[FUN_CODIGO].")"; 	
			$totalPersonalMasDeUnServicio = $totalPersonalMasDeUnServicio + 1;
		} 
		else {                         
			$nombreFuncionarioMasServicio = "";
		}
		
		echo "<tr>";
		echo "<td class='dato'>".$nombreFuncionarioMasServicio."</td>";
		echo "<td class='dato'>".utf8_encode($myrow1[TSERV_DESCRIPCION])."</td>";
		echo "<td class='dato'>".$horarioAux."</td>";
		echo "</tr>";
	  $codigoFunAux=$myrow1[FUN_CODIGO];
	  $cont++;
	}

	if($cantidadDeAsignaciones > 1 && $cantidadColacion >= 1){
		$colacionesNoValidas = $colacionesNoValidas + 1;
	}
	
	echo "<tr>";
	echo "<td colspan='2' align='right' id='nombreColumna2'>TOTAL PERSONAL CON MAS DE UNA ASIGNACION&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalMasDeUnServicio."</td>";
	echo "<input id='totalAusenciasNoValidas' type='hidden' value='".$ausenciasNoValidas."'>";
	echo "<input id='funcionariosConProblemas' type='hidden' value='".$funcionariosConProblemas."'>";
	echo "<input id='colacionesNoValidas' type='hidden' value='".$colacionesNoValidas."'>";
	echo "</tr>";
	echo "</table>";
	echo "</table>";
	echo "<div class='linea'></div>";
	
	$sql1 = "SELECT 
					  FUNCIONARIO_SERVICIO.FUN_CODIGO,
					  FUNCIONARIO.FUN_APELLIDOPATERNO,
					  FUNCIONARIO.FUN_APELLIDOMATERNO,
					  FUNCIONARIO.FUN_NOMBRE,
					  FUNCIONARIO.FUN_NOMBRE2,
					  GRADO.GRA_DESCRIPCION,
					  SUM(CASE
					  		WHEN SERVICIO.TSERV_CODIGO = 22  THEN IF(SERVICIO.HORA_TERMINO > SERVICIO.HORA_INICIO, IF(((TIME_TO_SEC(SERVICIO.HORA_TERMINO) - TIME_TO_SEC(SERVICIO.HORA_INICIO))/60) < 61,	((TIME_TO_SEC(SERVICIO.HORA_TERMINO) - TIME_TO_SEC(SERVICIO.HORA_INICIO))/60)+1440, ((TIME_TO_SEC(SERVICIO.HORA_TERMINO) - TIME_TO_SEC(SERVICIO.HORA_INICIO))/60)),(1440 - (TIME_TO_SEC(SERVICIO.HORA_INICIO) - TIME_TO_SEC(SERVICIO.HORA_TERMINO)) / 60))
					  		WHEN SERVICIO.TSERV_CODIGO = 23  THEN ((TIME_TO_SEC(SERVICIO.HORA_TERMINO)-TIME_TO_SEC(SERVICIO.HORA_INICIO))/60) + 1440
					  		WHEN SERVICIO.TSERV_CODIGO = 142 THEN -30
					  		WHEN SERVICIO.TSERV_CODIGO = 148 THEN -45
					    	WHEN SERVICIO.TSERV_CODIGO = 143 THEN -60
					    	WHEN SERVICIO.TSERV_CODIGO = 149 THEN -75
					    	WHEN SERVICIO.TSERV_CODIGO = 144 THEN -90
					    	WHEN SERVICIO.TSERV_CODIGO = 151 THEN -105
					  		WHEN SERVICIO.TSERV_CODIGO = 145 THEN -120
					  		WHEN SERVICIO.TSERV_CODIGO = 152 THEN -135
					  		WHEN SERVICIO.TSERV_CODIGO = 146 THEN -150
					  		WHEN SERVICIO.TSERV_CODIGO = 153 THEN -165
					  		WHEN SERVICIO.TSERV_CODIGO = 147 THEN -180
					  		WHEN SERVICIO.TSERV_CODIGO = 607 THEN 0
					  		ELSE IF(SERVICIO.HORA_TERMINO > SERVICIO.HORA_INICIO,((TIME_TO_SEC(SERVICIO.HORA_TERMINO) - TIME_TO_SEC(SERVICIO.HORA_INICIO)) / 60),(1440 - (TIME_TO_SEC(SERVICIO.HORA_INICIO) - TIME_TO_SEC(SERVICIO.HORA_TERMINO)) / 60))
					   END) AS TIEMPO
					FROM FUNCIONARIO_SERVICIO
				  INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
				  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
				  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
				  INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
				  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
				  AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
					WHERE SERVICIO.UNI_CODIGO = '".$unidad."' AND SERVICIO.FECHA = '".$fecha."' AND TIPO_SERVICIO.TSERV_TIPO <> 'N'
					GROUP BY 
					  FUNCIONARIO_SERVICIO.FUN_CODIGO,
					  FUNCIONARIO.FUN_APELLIDOPATERNO,
					  FUNCIONARIO.FUN_APELLIDOMATERNO,
					  FUNCIONARIO.FUN_NOMBRE,
					  FUNCIONARIO.FUN_NOMBRE2,
					  GRADO.GRA_DESCRIPCION
					ORDER BY
					  TIEMPO,
					  FUNCIONARIO_SERVICIO.FUN_CODIGO";
	
	$result1 = mysql_query($sql1,$CONECT1);
	
	echo "<div class='linea'></div>";
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='2' align='left' id='nombreColumna2'>PERSONAL UNIDAD - TIEMPOS DE SERVICIOS ASIGNADOS</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='70%' align='left' id='nombreColumna2'>FUNCIONARIO</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>HORAS</td>";
	echo "</tr>";
	
	$totalPersonalHoras = 0;
	$tiempoTotal = 0;
	
	while ($myrow1 = mysql_fetch_array($result1)){
		$nombreFuncionarioHoras = utf8_encode($myrow1[FUN_APELLIDOPATERNO])." ".utf8_encode($myrow1[FUN_APELLIDOMATERNO]).", ".utf8_encode($myrow1[FUN_NOMBRE])." - ".$myrow1[GRA_DESCRIPCION]. " (".$myrow1[FUN_CODIGO].")"; 	
		$horasAsignadas			= floor($myrow1[TIEMPO]/60) . " hora(s)";
		
    if (($myrow1[TIEMPO]%60) > 0) $horasAsignadas .= " con ".($myrow1[TIEMPO]%60)." minuto(s)";
    $tiempoTotal        = $tiempoTotal + $myrow1[TIEMPO];
    $totalPersonalHoras = $totalPersonalHoras + 1;
    
		echo "<tr>";
		echo "<td align='left' class='dato'>".$nombreFuncionarioHoras."</td>";
		echo "<td align='left' class='dato'>".$horasAsignadas."</td>";
		echo "</tr>";
	}
	$totalPersonalAux = $totalPersonalHoras;
	if($totalPersonalHoras==0) $totalPersonalAux = 1;
	$tiempoPromedio = $tiempoTotal/$totalPersonalAux;
	$horasPromedio			= floor($tiempoPromedio/60) . " HORA(S)";
  if (($tiempoPromedio%60) > 0) $horasPromedio .= " CON ".($tiempoPromedio%60)." MINUTO(S)";
	
	echo "<tr>";
	echo "<td width='18%' align='right' id='nombreColumna2'>PROMEDIO DE HORAS ASIGNADAS POR FUNCIONARIO&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$horasPromedio."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='18%' align='right' id='nombreColumna2'>CANTIDAD DE FUNCIONARIOS CON SERVICIO ASIGNADO&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalHoras."</td>";
	echo "</tr>";
	echo "</table>";
	echo "<div class='linea'></div>";
	
	$sql1 = "SELECT 
						UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS TIPO,
						COUNT(FUNCIONARIO_SERVICIO.FUN_CODIGO) AS CANTIDAD
					FROM FUNCIONARIO_SERVICIO
					INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					WHERE
					SERVICIO.UNI_CODIGO = '".$unidad."' AND 
					SERVICIO.FECHA = '".$fecha."' AND 
					TIPO_SERVICIO.TSERV_TIPO = 'N' AND SERVICIO.TSERV_CODIGO NOT IN (142, 143,144,145,146,147,148,149,151,152,153)
					GROUP BY
					TIPO_SERVICIO.TSERV_DESCRIPCION
					ORDER BY
					TIPO_SERVICIO.TSERV_DESCRIPCION";
	
	$result1 = mysql_query($sql1,$CONECT1);
	
	echo "<div class='linea'></div>";
	echo "<table width='100%' cellspacing='1' cellpadding='1'>";
	echo "<tr>";
	echo "<td colspan='2' align='left' id='nombreColumna2'>PERSONAL UNIDAD - POR MOTIVO DE NO OFERTA</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td width='70%' align='left' id='nombreColumna2'>TIPO DE NO OFERTA</td>";
	echo "<td width='30%' align='left' id='nombreColumna2'>CANTIDAD</td>";
	echo "</tr>";
	
	$totalPersonalNoOferta = 0;
	while ($myrow1 = mysql_fetch_array($result1)){
    $totalPersonalNoOferta = $totalPersonalNoOferta + $myrow1[CANTIDAD];
		echo "<tr>";
		echo "<td align='left' class='dato'>".$myrow1[TIPO]."</td>";
		echo "<td align='left' class='dato'>".$myrow1[CANTIDAD]."</td>";
		echo "</tr>";
	}
	
	echo "<tr>";
	echo "<td width='18%' align='right' id='nombreColumna2'>TOTAL DE FUNCIONARIOS QUE NO OFERTAN&nbsp;:&nbsp;</td>";
	echo "<td align='left' id='nombreColumna2'>".$totalPersonalNoOferta."</td>";
	echo "</tr>";
	echo "</table>";
	echo "<div class='linea'></div>";
  mysql_close();
  
?>