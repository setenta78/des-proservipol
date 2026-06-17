//'use strict';

app.controller('controllerPanel1', function($scope, $http, $state, $location, $timeout, gestionFiltro, listaChequeo, funcionesGlobales){
	
		document.getElementById('bloquea').style.display = 'block';
		document.body.setAttribute("style","overflow: hidden;")
			


		$scope.limpiarVariablesVista = function(){		
		
					$scope.dotacionCuartel 															= "-";
					$scope.dotacionFeriadosPwermisosLicenciasOtros			= "-";
					$scope.dotacionServiciosEfectivos										= "-";
					$scope.vehiculosCuartelTOTAL												= "-";
					$scope.vehiculosDISPONIBLESTOTAL 										= "-";
					$scope.vehiculosTERRITORIOTOTAL 										= "-";
					$scope.tiempoRespuestaINDICADOR 										= "-";
					$scope.cumplimientoOrdenesJudiciales 								= "-";
					$scope.controlesINDICADOR 													= "-";
					$scope.nroOrganizacionVigentes 											= "-";
					$scope.nroOrganizacionParticipantes 								= "-";
					$scope.nroProblemasResueltos 												= "-";
					
					$scope.colorIndicadorFeriadosPermisosLicencias			= "";
					$scope.colorIndicadorDotacionServiciosEfectivos			= "";
					$scope.semaforoIndicador08 													= "";
					$scope.semaforoIndicador09 													= "";
					$scope.colorIndicador10															= "";
					$scope.semaforoIndicador12 													= "";
					$scope.semaforoIndicador13 													= "";
					$scope.colorFuenteOrgVigentes 				 							= "";
					$scope.colorFuenteOrgParticipantes 				 					= "";
					$scope.colorFuente 				 													= "";

		}










		$scope.loadDotacion = function(value, callback) {
			
			console.log('START execution with value =', value);
			
			var $month						= $scope.cmbFiltroMeses;
			var $year							= $scope.cmbFiltroYears;
			var $codCuartel				= $scope.cmbFiltroCuarteles;
			var $columnName 			= window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			setTimeout(function(){ 	
				
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadDotacion', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){
						
						console.log(response);
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								//$scope.dotacionCuartelTOTAL = response.dotacionTOTAL;
								
								$scope.dotacionCuartel 															= response.asignadosMasAgregadosAlCuartel;
								$scope.intracuartelServicioOperativodeApoyo 				= response.ssOperativosApoyo;
								$scope.intracuartelGestionAdministracionyLogistica 	= response.gestionAdmyLog;
								$scope.intracuartelVariable 												= response.intracuartelVariable;
								$scope.destinadosalTerritorio 											= response.operativo;
								
								$scope.colorIndicador1 = response.COLOR1;
								$scope.colorIndicador2 = response.COLOR2;
								$scope.colorIndicador3 = response.COLOR3;
								$scope.colorIndicador4 = response.COLOR4;
																
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								$scope.dotacionCuartelTOTAL = "-";
								
								
								$scope.dotacionCuartel = response.asignadosMasAgregadosAlCuartel;
								$scope.intracuartelServicioOperativodeApoyo = response.ssOperativosApoyo;
								$scope.intracuartelGestionAdministracionyLogistica = response.gestionAdmyLog;
								$scope.intracuartelVariable = response.intracuartelVariable;
								$scope.destinadosalTerritorio = response.operativo;
								
								$scope.colorIndicador1 = response.COLOR1;
								$scope.colorIndicador2 = response.COLOR2;
								$scope.colorIndicador3 = response.COLOR3;
								$scope.colorIndicador4 = response.COLOR4;
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
						
					});
		    	
		  }, 0);	
		  
		}

	
		$scope.loadTasaReclamos = function(value, callback) {
			
			console.log('START execution with value =', value);
			
			var $month			= $scope.cmbFiltroMeses;
			var $year				= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadTasaDeReclamos', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){
						
						console.log(response);
						
						if(String(response.success) == "error"){
							response.mensaje=response.mensaje.replace('\r\n',' ');
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							
							
							if(response.contador > 0){
								$scope.tasaReclamos = response.TASA_RECLAMOS;
								$scope.semaforoTasaReclamo = response.SEMAFORO_TASA_RECLAMOS;
							  
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								$scope.tasaReclamos = "-";
								
														
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}

					});
		    	
		  }, 0);	
		  
		}

	
		$scope.loadDotacionNoDisponibilidad = function(value, callback) {
			
			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
				
			setTimeout(function(){ 	
				
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadNoDisponibilidad', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){
						
						console.log(response);
						//console.log(String(response.success));
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								//$scope.dotacionCuartelTOTAL = response.dotacionTOTAL;
								
								$scope.dotacionFeriadosPwermisosLicenciasOtros = response.dotacionFeriadosPwermisosLicenciasOtros;
								$scope.colorIndicadorFeriadosPermisosLicencias = response.colorIndicadorFeriadosPermisosLicencias;
								
																
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								
								$scope.dotacionFeriadosPwermisosLicenciasOtros = "-";
								
								//$scope.colorIndicador4 = response.COLOR4;
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
						
					});
		    	
		  }, 0);	
		  
		}

	
		$scope.loadDotacionServiciosEfectivos = function(value, callback) {
			
			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
				
			setTimeout(function(){ 	
				
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadDotacionServiciosEfectivos', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){
						
						console.log(response);
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								//$scope.dotacionCuartelTOTAL = response.dotacionTOTAL;
								
								$scope.dotacionServiciosEfectivos 							= response.dotacionServiciosEfectivos;
								$scope.colorIndicadorDotacionServiciosEfectivos = response.semaforoIndicador;
								
																
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								
								$scope.dotacionServiciosEfectivos = "-";
								
								//$scope.colorIndicador4 = response.COLOR4;
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
						
					});
		    	
		  }, 0);	
		  
		}	

		
		$scope.loadVehiculosCuartel = function(value, callback) {
			
			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-3.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1-5.class.php',{ accion : 'loadVehiculosCuartel', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){
						
						console.log(response);
						//console.log(String(response.success));
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								$scope.vehiculosCuartelTOTAL = response.vehiculosCargoCuartel;
								
								$scope.semaforoIndicador07 = response.semaforoIndicador07;
								
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								
								$scope.vehiculosCuartelTOTAL = "-";
								
								$scope.semaforoIndicador07 = "";
								
								swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		  
		}

		
		$scope.loadVehiculosDisponibles = function(value, callback) {

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-3.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadVehiculosDisponibles', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								$scope.vehiculosDISPONIBLESTOTAL = response.vehiculosDisponiblesTotal;
								
								$scope.semaforoIndicador08 = response.semaforoIndicador08;
								
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								
								$scope.vehiculosDISPONIBLESTOTAL = "-";
								
								$scope.semaforoIndicador08 = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		  
		}


		$scope.loadVehiculosUtilizadosTerritorio = function(value, callback) {

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
				
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadVehiculosUtilizadosTerritorio', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								$scope.vehiculosTERRITORIOTOTAL = response.vehiculosTERRITORIOTOTAL;
								
								$scope.semaforoIndicador09 = response.semaforoIndicador09;
								
								
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								
								$scope.vehiculosTERRITORIOTOTAL = "-";
								
								$scope.semaforoIndicador09 = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		  
		}

		
		$scope.loadTiempoRespuesta = function(value, callback) {
			
			//alert("1");

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadTiempoRespuesta', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
									//alert("2");
									if (response.tiempoRespuestaINDICADOR == "") {
												$scope.tiempoRespuestaINDICADOR = "-";
												$scope.semaforoIndicador10 			= "";
												$scope.colorIndicador10 				= "";
									} else {
												$scope.tiempoRespuestaINDICADOR = response.tiempoRespuestaINDICADOR;
												$scope.semaforoIndicador10 			= response.semaforoIndicador10;
												$scope.colorIndicador10 				= response.colorIndicador10;
									} 
									
									
									if(callback){
										callback(value, value * value);	
									}
								
							}else{
								
									//alert("3");
									$scope.tiempoRespuestaINDICADOR = "-";
									$scope.semaforoIndicador10 = "";
									
									//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
									
									if(callback){
										callback(value, value * value);	
									}
								
							}
						}

						document.getElementById('bloquea').style.display = 'none';
						document.body.setAttribute("style","overflow: scroll;");
						
					});
		    	
		  }, 0);	
		  
		}

		
		$scope.loadPredictorVictimizacion = function(value, callback) {
	
			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			

			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-3.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1-9.class.php',{ accion : 'loadPredictorVictimizacion', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){
						
						
						console.log(response);
						
						if(String(response.success) == "error"){
									
									//alert("1");
									response.mensaje=response.mensaje.replace('\r\n',' ');
									
									$scope.rsJSON = response.mensaje;
								
									$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
														"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
														"<strong>Alerta!</strong> " + response.mensaje +"</div>");
														
						}else{
									
									
									//alert(response.contador);
									if(response.contador > 0){
																				
																		
											var $colorPredictor = "black";
											var $flecha = "";
											
											if (response.ROBO_VIOLENCIA_COLOR_FLECHA == '#A5DF00') {$colorPredictor = "#A5DF00"; $flecha = response.ROBO_VIOLENCIA_FLECHA};
											if (response.ROBO_SORPRESA_COLOR_FLECHA == '#A5DF00') {$colorPredictor = "#A5DF00"; $flecha = response.ROBO_SORPRESA_FLECHA};
											if (response.ROBO_FUERZA_VIVIENDA_SORPRESA_COLOR_FLECHA == '#A5DF00') {$colorPredictor = "#A5DF00"; $flecha = response.ROBO_FUERZA_VIVIENDA_SORPRESA_FLECHA};
											if (response.ROBO_VEHICULO_FUERZA_VIVIENDA_COLOR_FLECHA == '#A5DF00') {$colorPredictor = "#A5DF00"; $flecha = response.ROBO_VEHICULO_FUERZA_VIVIENDA_FLECHA};
											if (response.ROBO_DESDE_VEHICULO_VIVIENDA_COLOR_FLECHA == '#A5DF00') {$colorPredictor = "#A5DF00"; $flecha = response.ROBO_DESDE_VEHICULO_VIVIENDA_FLECHA};
											if (response.HURTO_VIVIENDA_COLOR_FLECHA == '#A5DF00') {$colorPredictor = "#A5DF00"; $flecha = response.HURTO_VIVIENDA_FLECHA};
											if (response.LESIONES_VIVIENDA_COLOR_FLECHA == '#A5DF00') {$colorPredictor = "#A5DF00"; $flecha = response.LESIONES_VIVIENDA_FLECHA};
											
											if (response.ROBO_VIOLENCIA_COLOR_FLECHA == 'orange') {$colorPredictor = "orange";$flecha = response.ROBO_VIOLENCIA_FLECHA};
											if (response.ROBO_SORPRESA_COLOR_FLECHA == 'orange') {$colorPredictor = "orange";$flecha = response.ROBO_SORPRESA_FLECHA};
											if (response.ROBO_FUERZA_VIVIENDA_SORPRESA_COLOR_FLECHA == 'orange') {$colorPredictor = "orange";$flecha = response.ROBO_FUERZA_VIVIENDA_SORPRESA_FLECHA};
											if (response.ROBO_VEHICULO_FUERZA_VIVIENDA_COLOR_FLECHA == 'orange') {$colorPredictor = "orange";$flecha = response.ROBO_VEHICULO_FUERZA_VIVIENDA_FLECHA};
											if (response.ROBO_DESDE_VEHICULO_VIVIENDA_COLOR_FLECHA == 'orange') {$colorPredictor = "orange";$flecha = response.ROBO_DESDE_VEHICULO_VIVIENDA_FLECHA};
											if (response.HURTO_VIVIENDA_COLOR_FLECHA == 'orange') {$colorPredictor = "orange";$flecha = response.HURTO_VIVIENDA_FLECHA};
											if (response.LESIONES_VIVIENDA_COLOR_FLECHA == 'orange') {$colorPredictor = "orange";$flecha = response.LESIONES_VIVIENDA_FLECHA};
											
											if (response.ROBO_VIOLENCIA_COLOR_FLECHA == 'red') {$colorPredictor = "red";$flecha = response.ROBO_VIOLENCIA_FLECHA};
											if (response.ROBO_SORPRESA_COLOR_FLECHA == 'red') {$colorPredictor = "red";$flecha = response.ROBO_SORPRESA_FLECHA};
											if (response.ROBO_FUERZA_VIVIENDA_SORPRESA_COLOR_FLECHA == 'red') {$colorPredictor = "red";$flecha = response.ROBO_FUERZA_VIVIENDA_SORPRESA_FLECHA};
											if (response.ROBO_VEHICULO_FUERZA_VIVIENDA_COLOR_FLECHA == 'red') {$colorPredictor = "red";$flecha = response.ROBO_VEHICULO_FUERZA_VIVIENDA_FLECHA};
											if (response.ROBO_DESDE_VEHICULO_VIVIENDA_COLOR_FLECHA == 'red') {$colorPredictor = "red";$flecha = response.ROBO_DESDE_VEHICULO_VIVIENDA_FLECHA};
											if (response.HURTO_VIVIENDA_COLOR_FLECHA == 'red') {$colorPredictor = "red";$flecha = response.HURTO_VIVIENDA_FLECHA};
											if (response.LESIONES_VIVIENDA_COLOR_FLECHA == 'red') {$colorPredictor = "red";$flecha = response.LESIONES_VIVIENDA_FLECHA};
											
											
											//alert ("colorPredictor = " + $colorPredictor + ", flecha = " + $flecha);
											
											$scope.colorPredictorPanel1 = $colorPredictor;
											$scope.flechaPredictorPanel1 = $flecha;
											
											//alert ("colorPredictorPanel1 = " + $colorPredictorPanel1 + ", flechaPredictorPanel1 = " + $flechaPredictorPanel1);

											if(callback){
													callback(value, value * value);	
											}
										
									} else {
										
											$scope.colorPredictorPanel1 = "";
											$scope.flechaPredictorPanel1 = "-";
											
											//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
											
											if(callback){
													callback(value, value * value);	
											}
										
									}
						  }
					});
		    	
		  }, 0);	
		  
		}

		
		$scope.loadCumplimientoOrdenesJudiciales = function(value, callback) {
			
			//alert("1");

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			/*
		 	$('body').addClass('waitMe_body');
				
			var elem = $("<div class='waitMe_container img' ng-hide='eventos'><div class='fa-spin fa-5x'></div></div>");
			$('body').prepend(elem);
			*/
				
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadCumplimientoOrdenesJudiciales', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								//alert("2");
								$scope.cumplimientoOrdenesJudiciales = response.cumplimientoOrdenesJudiciales;
								$scope.semaforoIndicador12 = response.semaforoIndicador12;
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{
								
								//alert("3");
								
								$scope.cumplimientoOrdenesJudiciales = "-";
								$scope.semaforoIndicador12 = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		  
		}
		
		
		$scope.loadControles = function(value, callback) {
			
			//alert("1");

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			if ($codEspecialidad == 0 ) $codEspecialidad = 1;
			
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadControles', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								//alert("2");
								
								$scope.controlesINDICADOR = response.controlesINDICADOR;
								
								//$scope.semaforoIndicador13 = response.semaforoIndicador13;
								$scope.semaforoIndicador13 = "";
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{

								//alert("3");
								
								$scope.controlesINDICADOR = "-";
								
								$scope.semaforoIndicador13 = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		  
		}

		
		$scope.loadNroOrganizacionesVigentes = function(value, callback) {
			
			//alert("1");

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadNroOrganizacionesVigentes', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								//alert("2");
								
								$scope.nroOrganizacionVigentes = response.nroOrganizacionVigentes;
								
								//$scope.colorFuenteOrgVigentes = response.colorFuenteOrgVigentes;
								$scope.colorFuenteOrgVigentes = "";
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{

								//alert("3");
								
								$scope.nroOrganizacionVigentes = "-";
								
								$scope.colorFuenteOrgVigentes = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		  
		}

		
		$scope.loadNroOrganizacionesDistintasParticipantesenReunion = function(value, callback) {
			
			//alert("1");

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadNroOrganizacionesDistintasParticipantesenReunion', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								//alert("2");
								
								$scope.nroOrganizacionParticipantes = response.nroOrganizacionParticipantes;
								
								//$scope.colorFuenteOrgParticipantes = response.colorFuenteOrgParticipantes;
								$scope.colorFuenteOrgParticipantes = "";
								
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{

								//alert("3");
								
								$scope.nroOrganizacionParticipantes = "-";
								
								$scope.colorFuenteOrgParticipantes = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		  
		}

		
		$scope.loadNroProblemasIdentificados = function(value, callback) {
			//alert("1");

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			var $codEspecialidad 	= $scope.cmbFiltroEspecialidades;
			

			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadNroProblemasIdentificados', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName, codEspecialidad : $codEspecialidad })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								//alert("2");
								
								$scope.nroProblemasIdentificados = response.nroProblemasIdentificados;
								
								$scope.colorFuente = response.colorFuente;
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{

								//alert("3");
								
								$scope.nroProblemasIdentificados = "-";
								
								$scope.colorFuente = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
			
		}


		$scope.loadNroProblemasResueltos = function(value, callback) {
			//alert("1");

			console.log('START execution with value =', value);
			
			var $month	= $scope.cmbFiltroMeses;
			var $year		= $scope.cmbFiltroYears;
			var $codCuartel	= $scope.cmbFiltroCuarteles;
			var $columnName = window.localStorage.getItem('NameColumnTablaCuartel');
			
			/*
		 	$('body').addClass('waitMe_body');
				
			var elem = $("<div class='waitMe_container img' ng-hide='eventos'><div class='fa-spin fa-5x'></div></div>");
			$('body').prepend(elem);
			*/
				
			setTimeout(function(){ 	
				
				//$http.get('src/models/sql/panel1-7.class.php?action=cargarMeses')
				$http.post('src/models/sql/panel1.class.php',{ accion : 'loadNroProblemasResueltos', codCuartel : $codCuartel, year : $year, month : $month, columnName : $columnName })
					.success(function(response){

						console.log(response);
						//return false;
						
						if(String(response.success) == "error"){
							//alert("1");
							response.mensaje=response.mensaje.replace('\r\n',' ');
							
							$scope.rsJSON = response.mensaje;
						
							$("#mensaje").html("<div class='alert alert-danger alert-dismissible fade in' role='alert' ng-hide='alertaError'>" +
												"<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>x</span><span class='sr-only'>Cerrar</span></button>" +
												"<strong>Alerta!</strong> " + response.mensaje +"</div>");
						}else{
							//alert("2");
							if(response.contador > 0){
								
								//alert("2");
								
								$scope.nroProblemasResueltos = response.nroProblemasResueltos;
								
								$scope.colorFuente = response.colorFuente;
								
								if(callback){
									callback(value, value * value);	
								}
								
							}else{

								//alert("3");
								
								$scope.nroProblemasResueltos = "-";
								
								$scope.colorFuente = "";
								
								//swal({title: "Mensaje!!!", text: "No existen datos sobre el cuartel en el mes y año seleccionado para mostrar... !!!", type: "info"});
								
								if(callback){
									callback(value, value * value);	
								}
								
							}
						}
					});
		    	
		  }, 0);	
		}


		$scope.inicializarNombreColumnaCuartel = function(value, callback) { //NUEVO
			
					
					
					console.log('START execution with value =', value);
					
					if (typeof $scope.cmbFiltroEspecialidades == 'undefined') $scope.cmbFiltroEspecialidades =0;

					var cmbFiltroZona = "";
					var cmbFiltroPrefectura = "";
					var cmbFiltroComisaria = "";
					var cmbFiltroDestacamento = "";
					
					if(window.localStorage['lstorage_FiltroCuarteles']){
						
						if(window.localStorage['lstorage_FiltroCuarteles'] != undefined && window.localStorage['lstorage_FiltroCuartelesName'] == '[cod_zona]'){
							cmbFiltroZona = window.localStorage['lstorage_FiltroCuarteles'];
						}else{
							cmbFiltroZona = $scope.cmbFiltroZonas;
						}
						
						if(window.localStorage['lstorage_FiltroCuarteles'] != undefined && window.localStorage['lstorage_FiltroCuartelesName'] == '[cod_prefectura]'){
							cmbFiltroPrefectura = window.localStorage['lstorage_FiltroCuarteles'];
						}else{
							cmbFiltroPrefectura = $scope.cmbFiltroPrefecturas;
						}
						
						if(window.localStorage['lstorage_FiltroCuarteles'] != undefined && window.localStorage['lstorage_FiltroCuartelesName'] == '[cod_comisaria]'){
							cmbFiltroComisaria = window.localStorage['lstorage_FiltroCuarteles'];
						}else{
							cmbFiltroComisaria = $scope.cmbFiltroComisarias;
						}
						
						if(window.localStorage['lstorage_FiltroCuarteles'] != undefined && window.localStorage['lstorage_FiltroCuartelesName'] == '[cod_destacamento]'){
							cmbFiltroDestacamento = window.localStorage['lstorage_FiltroCuarteles'];
						}else{
							cmbFiltroDestacamento = $scope.cmbFiltroDestacamentos;
						}
					}
					
					var cmbFiltroZonaName = "";
					var cmbFiltroPrefecturaName = "";
					var cmbFiltroComisariaName = "";
					var cmbFiltroDestacamentoName = "";
					
					angular.forEach($scope.all_zonas, function (value, key){
		        if(value.COD_CUARTEL == cmbFiltroZona){
		            cmbFiltroZonaName = value.DES_CUARTEL;  
		        }
		      });
		      
		      angular.forEach($scope.all_prefecturas, function (value, key){
		        if(value.COD_CUARTEL == cmbFiltroPrefectura){
		            cmbFiltroPrefecturaName = value.DES_CUARTEL;  
		        }
		      });
		      
		      angular.forEach($scope.all_comisarias, function (value, key){
		        if(value.COD_CUARTEL == cmbFiltroComisaria){
		            cmbFiltroComisariaName = value.DES_CUARTEL;  
		        }
		      });
		      
		      angular.forEach($scope.all_destacamentos, function (value, key){
		        if(value.COD_CUARTEL == cmbFiltroDestacamento){
		            cmbFiltroDestacamentoName = value.DES_CUARTEL;  
		        }
		      });
					
					if(cmbFiltroZona != 0){
		      	$scope.cmbFiltroCuarteles = cmbFiltroZona;
		      	$scope.cmbFiltroCuartelesName = cmbFiltroZonaName;
		      }
		      
		      if(cmbFiltroPrefectura != 0){
		      	$scope.cmbFiltroCuarteles = cmbFiltroPrefectura;
		      	$scope.cmbFiltroCuartelesName = cmbFiltroPrefecturaName; 
		      }
		      
		      if(cmbFiltroComisaria != 0){
		      	$scope.cmbFiltroCuarteles = cmbFiltroComisaria;
		      	$scope.cmbFiltroCuartelesName = cmbFiltroComisariaName;
		      }
		      
		      if(cmbFiltroDestacamento != 0){
		      	$scope.cmbFiltroCuarteles = cmbFiltroDestacamento;
		      	$scope.cmbFiltroCuartelesName = cmbFiltroDestacamentoName;
		      }    
					
					if(cmbFiltroZona == 0 && cmbFiltroPrefectura == 0 && cmbFiltroComisaria == 0 && cmbFiltroDestacamento == 0){
						$scope.cmbFiltroCuartelesName = "Nacional";
						$scope.cmbFiltroCuarteles = "001";
					}
					 
					var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					
					$scope.cuartelElegido = $scope.cmbFiltroCuartelesName.toUpperCase();
					$scope.mesElegido = meses[$scope.cmbFiltroMeses - 1].toUpperCase();
					$scope.yearElegido = $scope.cmbFiltroYears;
					$scope.especialidadElegido = "TODAS LAS ESPECIALIDADES";
					
					if ($scope.cmbFiltroEspecialidades == 1)	$scope.especialidadElegido = "- TERRITORIALES";
					if ($scope.cmbFiltroEspecialidades == 17)	$scope.especialidadElegido = "- GOPE";
					
				  $scope.cmbFiltroCuarteles = window.localStorage['lstorage_FiltroCuarteles'];
					
					setTimeout(function(){ 	
						
						 
						$http.post('src/models/sql/panel1.class.php',{ accion : 'inicializarColumnaCuartel', codCuartel : $scope.cmbFiltroCuarteles, codEspecialidad : $scope.cmbFiltroEspecialidad, month : $scope.cmbFiltroMeses, year : $scope.cmbFiltroYears })
							.success(function(response){
								
								console.log(response);
								
								if(response.contador > 0){
									
									//alert(response.nameColumnCuartel);
									
									window.localStorage['NameColumnTablaCuartel'] = response.nameColumnCuartel;
									
									$scope.loadDotacion();
									$scope.loadTasaReclamos();
									$scope.loadDotacionNoDisponibilidad();
									$scope.loadDotacionServiciosEfectivos();
									$scope.loadVehiculosCuartel();
									$scope.loadVehiculosDisponibles();
									$scope.loadVehiculosUtilizadosTerritorio();
									$scope.loadTiempoRespuesta();
									$scope.loadPredictorVictimizacion();
									$scope.loadCumplimientoOrdenesJudiciales();
									$scope.loadControles();
									$scope.loadNroOrganizacionesVigentes();
									$scope.loadNroOrganizacionesDistintasParticipantesenReunion();
									$scope.loadNroProblemasResueltos();
									
									$scope.especialidad = window.localStorage['lstorage_FiltroCuartelesEspecialidad'];
								
									if(callback){
										callback(value, value * value);	
									}
									
								}else{
									
									$scope.limpiarVariablesVista();
													
									window.localStorage['NameColumnTablaCuartel'] = "";

									swal({title: "Mensaje!!!", text: "No se encuentra en nombre de columna de la tabla del cuartel seleccionado... !!!", type: "info"});
									
									console.log("Mensaje!!!: No se encuentra en nombre de columna de la tabla del cuartel seleccionado... !!!");
									
									document.getElementById('bloquea').style.display = 'none';
									document.body.setAttribute("style","overflow: scroll;");
									
									
									if(callback){
										callback(value, value * value);	
									}
									
								}
								
							});

				  }, 0);
		}

		//-------------------------------------

		$scope.actualizarListaChequeo = function($idMedida, $param1, $param2){
			
			 listaChequeo.actualizarListaChequeo($scope, $idMedida, $param1, $param2)
			
		}


		$scope.cerrarSesion = function(){
			
			 document.getElementById('bloquea').style.display = 'block';
			 document.body.setAttribute("style","overflow: hidden;");
			 
			 funcionesGlobales.cerrarSesion();
		}

		
		$scope.loading = function(panel){
			
			document.getElementById('bloquea').style.display = 'block';
			document.body.setAttribute("style","overflow: hidden;");
			
			funcionesGlobales.loading($scope, panel)
			
		}


		// INICIO FUNCIONES PARA FILTRO

	  $scope.filtroMacroZonasOptions = {
		    //displayText: "Seleccionar MacroZona"
		    displayText: "TODAS LAS MACROZONAS"
		};


		$scope.filtroZonasOptions = {
		    //displayText: "Seleccionar Zona"
		    displayText: "TODAS LAS ZONAS"
		};

		
		$scope.filtroPrefecturasOptions = {
		    //displayText: "Seleccionar Prefectura"
		    displayText: "TODAS LAS PREFECTURAS"
		};

		
		$scope.filtroComisariasOptions = {
		    //displayText: "Seleccionar Comisaria"
		    displayText: "TODAS LAS COMISARIAS"
		};

		
		$scope.filtroDestacamentosOptions = {
				//displayText: "Seleccionar Destacamentos"
		    displayText: "TODOS LOS DESTACAMENTOS"
		};

		
		$scope.filtroEspecialidadesOptions = {
		    //displayText: "Seleccionar Especialidad"
		    displayText: "TODAS LAS ESPECIALIDADES"
		};

		
		$scope.cargarFiltros = function(){
			gestionFiltro.cargarFiltroMeses($scope, 0, function (value, result) {
			    console.log('END execution with value =', value, 'and result =', result);
			    gestionFiltro.cargarFiltroYears($scope, 1, function (value, result) {
			        console.log('END execution with value =', value, 'and result =', result);
			        gestionFiltro.cargarFiltroCuarteles($scope, 2, function (value, result) {
			            console.log('END execution with value =', value, 'and result =', result);
					      	
			        });
			    });
			});
		}

		
		$scope.changeFiltroMeses = function(){
					gestionFiltro.changeFiltroAnnoMeses($scope)
		}
		
		
		$scope.changeFiltroYears = function(){
			gestionFiltro.changeFiltroAnnoMeses($scope)
		}

		
		$scope.cambiaFiltroZona = function(){
					$http.post('src/models/sql/login.class.php',{ accion 		: 'sesion_usuario'})
					.success(function(response){	
								if (response.session == 0){
										swal({title: "Mensaje!!!", text: "Su sesión ha expirado... !!!", type: "info"});
										$state.go('login');
								} else {
										gestionFiltro.changeFiltroZona($scope,0);
								}
					});	
			
			
		}
		
		
		$scope.cambiaFiltroPrefectura = function(){
			
					$http.post('src/models/sql/login.class.php',{ accion 		: 'sesion_usuario'})
					.success(function(response){	
								if (response.session == 0){
										swal({title: "Mensaje!!!", text: "Su sesión ha expirado... !!!", type: "info"});
										$state.go('login');
								} else {
										gestionFiltro.changeFiltroPrefectura($scope,0);
								}
					});	
		}

		
		$scope.cambiaFiltroComisaria = function(){
			
					$http.post('src/models/sql/login.class.php',{ accion 		: 'sesion_usuario'})
					.success(function(response){	
								if (response.session == 0){
										swal({title: "Mensaje!!!", text: "Su sesión ha expirado... !!!", type: "info"});
										$state.go('login');
								} else {
										gestionFiltro.changeFiltroComisaria($scope,0);
								}
					});	
		}
		
		
		$scope.cambiaFiltroDestacamento = function(){
			
					$http.post('src/models/sql/login.class.php',{ accion 		: 'sesion_usuario'})
					.success(function(response){	
								if (response.session == 0){
										swal({title: "Mensaje!!!", text: "Su sesión ha expirado... !!!", type: "info"});
										$state.go('login');
								} else {
										gestionFiltro.changeFiltroDestacamento($scope, 0);
								}
					});	
		}


		$scope.buscar = function(){
			
			  $scope.limpiarVariablesVista();
			  gestionFiltro.buscar($scope);
	  }


		$scope.limpiarFiltro = function(value, callback) {
		
				$scope.limpiarVariablesVista();
				gestionFiltro.limpiarFiltro($scope)	
	  }


});