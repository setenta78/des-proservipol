<?
Class dbTaller extends Conexion{
	
	function evaluarPracticaLicenciaMedica($funcionario,&$taller){
/*---Parametros-------------------------------------------------------------------------------------------------------------------*/
		
		$taller = new taller;
		$taller->setFuncionario($funcionario);
		
/*---Evalua servicios ingresados--------------------------------------------------------------------------------------------------*/
		$sql = "SELECT 
								S.FECHA,
								S.HORA_INICIO,
								S.HORA_TERMINO
							FROM SERVICIO S
							JOIN FUNCIONARIO_SERVICIO FS ON (FS.UNI_CODIGO = S.UNI_CODIGO AND FS.CORRELATIVO_SERVICIO = S.CORRELATIVO_SERVICIO)
							WHERE S.TSERV_CODIGO = 569 
								AND S.FECHA BETWEEN '20180820' AND '20180901'
								AND FS.FUN_CODIGO = '".$funcionario."'";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		while($myrow = mysql_fetch_array($result)){
			
			$ServFecha 			= $myrow["FECHA"];
			$ServHrInicio		= $myrow["HORA_INICIO"];
			$ServHrTermino	= $myrow["HORA_TERMINO"];
			
		/*--- Evaluacion 1 actividad ---*/
			if($ServFecha=='2018-08-20'){
				if(($ServHrInicio == '08:00:00')&&($ServHrTermino == '20:00:00')){
					$taller->setAct1();
				}
				else{
					$taller->setAct1Desc('Error en ingresar el horario');
				}
			}
			else{
				$taller->setAct1Desc('Error en la fecha del servicio o no se ingreso');
			}
		
		/*--- Evaluacion 5 actividad ---*/	
			if($ServFecha=='2018-09-01'){
				if(($ServHrInicio == '08:00:00')&&($ServHrTermino == '20:00:00')){
					$taller->setAct5();
				}
				else{
					$taller->setAct5Desc('Error en ingresar el horario');
				}
			}
			else{
				$taller->setAct5Desc('Error en la fecha del servicio o no se ingreso');
			}
			
		}
		
		$taller->setAct1Desc('No se ingreso el servicio');
		$taller->setAct5Desc('No se ingreso el servicio');
		
/*---Evalua licencias ingresadas--------------------------------------------------------------------------------------------------*/
		$sql = "SELECT 
								L.COLOR_LICENCIA,
								L.FOLIO_LICENCIA,
								L.FECHA_OTORGAMIENTO,
								L.FECHA_INICIO,
								L.NUM_DIAS,
								L.FECHA_INICIO_REAL,
								L.FECHA_TERMINO_REAL,
								L.TIPO_LICENCIA_MEDICA,
								L.TIPO_REPOSO,
								L.TIPO_ATENCION,
								L.LUGAR_REPOSO,
								L.ESPECIALIDAD_PROFESIONAL,
								L.RUT_PROFESIONAL,
								L.ESTADO_LICENCIA,
								F.FUN_RUT,
								SUBSTR(F.FUN_RUT,1,8) FOLIO
							FROM LICENCIA_MEDICA L
							JOIN FUNCIONARIO F ON (F.FUN_RUT = L.FUN_RUT)
							WHERE F.FUN_CODIGO = '".$funcionario."'";
		
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$LicFechTREsp = 0;
		
		while($myrow = mysql_fetch_array($result)){
			
			$LicColor 	= $myrow["COLOR_LICENCIA"];
			$LicFolio 	= $myrow["FOLIO_LICENCIA"];
			$LicFechO 	= $myrow["FECHA_OTORGAMIENTO"];
			$LicFechI 	= $myrow["FECHA_INICIO"];
			$LicDias		= $myrow["NUM_DIAS"];
			$LicFechIR 	= $myrow["FECHA_INICIO_REAL"];
			$LicFechTR 	= $myrow["FECHA_TERMINO_REAL"];
			$LicTipo	 	= $myrow["TIPO_LICENCIA_MEDICA"];
			$LicReposo 	= $myrow["TIPO_REPOSO"];
			$LicAtenc 	= $myrow["TIPO_ATENCION"];
			$LicLugRep 	= $myrow["LUGAR_REPOSO"];
			$LicEspPro 	= $myrow["ESPECIALIDAD_PROFESIONAL"];
			$LicRutPro 	= $myrow["RUT_PROFESIONAL"];
			$LicEstado 	= $myrow["ESTADO_LICENCIA"];
			$LicRutFun 	= $myrow["FUN_RUT"];
			$LicRFolio	= $myrow["FOLIO"];
			
			$LicRutPro 	= $LicRutFun;
			$LicFolio1	= $LicRFolio;
			$LicFolio2	= $LicFolio1+1;
			
			/*--- Evaluacion 2 actividad ---*/
			/*--- Folio ---*/
			if($LicFolio == $LicFolio1){
				/*--- Color ---*/
				if($LicColor == '2'){
					/*--- Fecha de Otorgamiento ---*/
					if($LicFechO == '2018-08-20'){
						/*--- Fecha de Inicio ---*/
						if($LicFechI == '2018-08-20'){
							/*--- Fecha de Inicio Real ---*/
							if($LicFechIR == '2018-08-21'){
								/*--- Dias ---*/
								if($LicDias == '10'){
									/*--- Tipo de Licencia ---*/
									if($LicTipo == '633'){
										/*--- Tipo de Reposo ---*/
										if($LicReposo == '1'){
											/*--- Lugar de Reposo ---*/
											if($LicLugRep == '1'){
												/*--- Tipo de Atencion ---*/
												if($LicAtenc == '2'){
													/*--- Especialidad del Profesional ---*/
													if($LicEspPro == '25'){
														/*--- Rut del Profesional ---*/
														if($LicRutPro == $LicRutFun){
															/*--- Estado de la licencia ---*/
															if($LicEstado == '1'){
																/*--- Fecha de Termino Real ---*/
																if($LicFechTR == '2018-08-29'){
																	$taller->setAct2();
																}
																/*--- Fecha de Termino Anticipado ---*/
																elseif($LicFechTR == '2018-08-28'){
																	$LicFechTREsp = 1;
																	$taller->setAct2();
																}
																else{
																	$taller->setAct2Desc('Error al ingresar la fecha de termino real del reposo (Termino anticipado de la licencia)');
																}	
															}
															else{
																$taller->setAct2Desc('Se anulo la licencia');
															}
														}
														else{
															$taller->setAct2Desc('Error al ingresar el Rut del profesional');
														}	
													}
													else{
														$taller->setAct2Desc('Error al ingresar la especialidad del profesional');
													}	
												}
												else{
													$taller->setAct2Desc('Error al ingresar el tipo de atencion (Institucional - extra Institucional)');
												}	
											}
											else{
												$taller->setAct2Desc('Error al ingresar el lugar de reposo');
											}	
										}
										else{
											$taller->setAct2Desc('Error al ingresar el tipo de reposo');
										}	
									}
									else{
										$taller->setAct2Desc('Error al ingresar el tipo de licencia emitida');
									}	
								}
								else{
									$taller->setAct2Desc('Error al ingresar los dias de licencia');
								}	
							}
							else{
								$taller->setAct2Desc('Error al ingresar la fecha de inicio real del reposo');
							}
						}
						else{
							$taller->setAct2Desc('Error al ingresar la fecha de inicio del reposo');
						}
					}
					else{
						$taller->setAct2Desc('Error al ingresar la fecha de otorgamiento');
					}
				}
				else{
					$taller->setAct2Desc('Error al ingresar el tipo de licencia entregada');
				}
			}
			else{
				$taller->setAct2Desc('No se ingreso la licencia');
			}
			
			/*--- Evaluacion 3 actividad ---*/
			/*--- Folio ---*/
			if($LicFolio == $LicFolio2){
				/*--- Color ---*/
				if($LicColor == '2'){
					/*--- Fecha de Otorgamiento ---*/
					if($LicFechO == '2018-08-28'){
						/*--- Fecha de Inicio ---*/
						if($LicFechI == '2018-08-28'){
							/*--- Fecha de Termino Anticipado o real ---*/
							if($LicFechTR == '2018-09-01'){
								/*--- Dias ---*/
								if($LicDias == '5'){
									/*--- Tipo de Licencia ---*/
									if($LicTipo == '633'){
										/*--- Tipo de Reposo ---*/
										if($LicReposo == '1'){
											/*--- Lugar de Reposo ---*/
											if($LicLugRep == '1'){
												/*--- Tipo de Atencion ---*/
												if($LicAtenc == '2'){
													/*--- Especialidad del Profesional ---*/
													if($LicEspPro == '25'){
														/*--- Rut del Profesional ---*/
														if($LicRutPro == $LicRutFun){
															/*--- Fecha de Inicio Real ---*/
															if($LicFechIR == '2018-08-28'&&$LicFechTREsp==1){
																$taller->setAct3();
/*----------------------------- Evaluacion 4 actividad ---*/
																/*--- Estado de la licencia ---*/
																if($LicEstado == '2'){
																	$taller->setAct4();
																}
																else{
																	$taller->setAct4Desc('No se anulo la licencia indicada');
																}
															}
															elseif($LicFechIR == '2018-08-30'&&$LicFechTREsp==0){
																$taller->setAct3();
/*----------------------------- Evaluacion 4 actividad ---*/
																/*--- Estado de la licencia ---*/
																if($LicEstado == '2'){
																	$taller->setAct4();
																}
																else{
																	$taller->setAct4Desc('No se anulo la licencia indicada');
																}
															}
															else{
																$taller->setAct3Desc('Error al ingresar la fecha de inicio real del reposo');
															}
														}
														else{
															$taller->setAct3Desc('Error al ingresar el Rut del profesional');
														}
													}
													else{
														$taller->setAct3Desc('Error al ingresar la especialidad del profesional');
													}
												}
												else{
													$taller->setAct3Desc('Error al ingresar el tipo de atencion (Institucional - extra Institucional)');
												}
											}
											else{
												$taller->setAct3Desc('Error al ingresar el lugar de reposo');
											}
										}
										else{
											$taller->setAct3Desc('Error al ingresar el tipo de reposo');
										}
									}
									else{
										$taller->setAct3Desc('Error al ingresar el tipo de licencia emitida');
									}
								}
								else{
									$taller->setAct3Desc('Error al ingresar los dias de licencia');
								}
							}
							else{
								$taller->setAct3Desc('Error al ingresar la fecha de termino real del reposo (Termino anticipado de la licencia)');
							}
						}
						else{
							$taller->setAct3Desc('Error al ingresar la fecha de inicio del reposo');
						}
					}
					else{
						$taller->setAct3Desc('Error al ingresar la fecha de otorgamiento');
					}
				}
				else{
					$taller->setAct3Desc('Error al ingresar el tipo de licencia entregada');
				}
			}
			else{
				$taller->setAct3Desc('No se ingreso la licencia');
			}
		}
		$taller->setAct2Desc('No se ingreso la licencia');
		$taller->setAct3Desc('No se ingreso la licencia');
		$taller->setAct4Desc('No se ingreso la licencia');
		$taller->setActTotal();
	}
	
	function deleteServicios($codigoUnidad){
		
		$sql = "DELETE CS
						FROM FUNCIONARIO_SERVICIO FS
						LEFT JOIN CUADRANTE_SERVICIO CS ON CS.FUN_CODIGO = FS.FUN_CODIGO AND CS.UNI_CODIGO = FS.UNI_CODIGO AND CS.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
						WHERE FS.UNI_CODIGO = '".$codigoUnidad."'";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		
		$sql = "DELETE ACS
						FROM FUNCIONARIO_SERVICIO FS
						JOIN ACCESORIO_SERVICIO ACS ON ACS.FUN_CODIGO = FS.FUN_CODIGO AND ACS.UNI_CODIGO = FS.UNI_CODIGO AND ACS.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
						WHERE FS.UNI_CODIGO = '".$codigoUnidad."'";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		
		$sql = "DELETE ANS
						FROM FUNCIONARIO_SERVICIO FS
						JOIN ANIMAL_SERVICIO ANS ON ANS.FUN_CODIGO = FS.FUN_CODIGO AND ANS.UNI_CODIGO = FS.UNI_CODIGO AND ANS.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
						WHERE FS.UNI_CODIGO = '".$codigoUnidad."'";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		
		$sql = "DELETE ARS
						FROM FUNCIONARIO_SERVICIO FS
						JOIN ARMA_SERVICIO ARS ON ARS.FUN_CODIGO = FS.FUN_CODIGO AND ARS.UNI_CODIGO = FS.UNI_CODIGO AND ARS.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
						WHERE FS.UNI_CODIGO = '".$codigoUnidad."'";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		
		$sql = "DELETE FV, VS
						FROM FUNCIONARIO_SERVICIO FS
						JOIN FUNCIONARIO_VEHICULO FV ON FV.FUN_CODIGO = FS.FUN_CODIGO AND FV.FUN_UNI_CODIGO = FS.UNI_CODIGO AND FV.FUN_CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO
						JOIN VEHICULO_SERVICIO VS ON VS.UNI_CODIGO = FS.UNI_CODIGO AND VS.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO 
						WHERE FS.UNI_CODIGO = '".$codigoUnidad."'";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		
		$sql = "DELETE FS, S
						FROM FUNCIONARIO_SERVICIO FS
						JOIN SERVICIO S ON S.UNI_CODIGO = FS.UNI_CODIGO AND S.CORRELATIVO_SERVICIO = FS.CORRELATIVO_SERVICIO 
						WHERE FS.FUN_CODIGO = '".$codigoUnidad."'";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		
		mysql_close();
		return $result;
	}
	
	function deleteLicencias($codigoUnidad){
		
		$sql = "DELETE L
						FROM LICENCIA_MEDICA L
						JOIN FUNCIONARIO F ON (F.FUN_RUT = L.FUN_RUT)
						WHERE F.UNI_CODIGO = '".$codigoUnidad."'";
		
		//echo $sql . "\n\n";
		$result = $this->execstmt($this->Conecta(),$sql);
		
		mysql_close();
		return $result;
	}
	
	function deleteTaller($codigoUnidad){
		
		$resultBorrarServicios	= $this->deleteServicios($codigoUnidad);
		$resultBorrarLicencias	= $this->deleteLicencias($codigoUnidad);
		
		if($resultBorrarServicios==1&&$resultBorrarLicencias==1) return 1;
		else return $resultBorrarServicios;
	}
	
}
?>