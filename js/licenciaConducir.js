var cargaListadoFuncionariosLC;
function leeFuncionariosLicenciasConducir(unidad, campo, sentido){
	cargaListadoFuncionariosLC = 0;
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios y Licencias de Conducir ......</td>";
	objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlListaLicenciasDeConducir.php",true);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI("codigoUnidad="+unidad+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLLicenciasConducir.onreadystatechange=function(){
		//alert(objHttpXMLLicenciasConducir.readyState);
		if(objHttpXMLLicenciasConducir.readyState == 4){
			//alert(objHttpXMLLicenciasConducir.responseText);
			if (objHttpXMLLicenciasConducir.responseText != "VACIO"){
				//alert(objHttpXMLLicenciasConducir.responseText);
				var xml					= objHttpXMLLicenciasConducir.responseXML.documentElement;
				var codigo				= "";
				var nombreCompleto		= "";
				var nombre				= "";
				var nombre2				= "";
				var apellidoP			= "";
				var apellidoM			= "";
				var grado				= "";
				var cargo				= "";
				var cuadrante			= "";
				var unidadAgregado		= "";
				var fechaControlLM		= "";
				var fechaRenovacionLS	= "";
				var comunaMunicipal		= "";
				var LinkArchivo			= "";
				var sw					= 0;
				var fondoLinea			= "";
				var resaltarLinea		= "";
				var lineaSinResaltar	= "";
				var listadoFuncionarios	= "";
				var tieneLicencia		= "";
				var archivoLicencia		= "";
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					noTieneLicencia = "";
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					apellidoP			= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoM			= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					nombre				= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					nombre2				= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					nombreCompleto		= apellidoP + " " + apellidoM + ", " + nombre + " " + nombre2;
					grado				= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					cargo				= (xml.getElementsByTagName('cargo')[i].text||xml.getElementsByTagName('cargo')[i].textContent||"");
					cuadrante			= (xml.getElementsByTagName('cuadrante')[i].text||xml.getElementsByTagName('cuadrante')[i].textContent||"");
					fechaControlLM		= (xml.getElementsByTagName('fechaControlLCMunicipal')[i].text||xml.getElementsByTagName('fechaControlLCMunicipal')[i].textContent||"");
					fechaRenovacionLS	= (xml.getElementsByTagName('fechaControlLCSemep')[i].text||xml.getElementsByTagName('fechaControlLCSemep')[i].textContent||"");
					tieneLicencia		= (xml.getElementsByTagName('tieneLicencia')[i].text||xml.getElementsByTagName('tieneLicencia')[i].textContent||"");
					archivoLicencia		= (xml.getElementsByTagName('archivoLicencia')[i].text||xml.getElementsByTagName('archivoLicencia')[i].textContent||"");
					comunaMunicipal		= (xml.getElementsByTagName('comuna')[i].text||xml.getElementsByTagName('comuna')[i].textContent||"");
					
					resaltarLinea		= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
					
					if (fechaControlLM != ""){
						var mostrarFechaControlLM = fechaControlLM;
					} else {
						var mostrarFechaControlLM = "";
					}
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('LICENCIA DE CONDUCIR ... ', '900', '537','fichaPersonalLicenciaConducir.php?codigoFuncionario="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (cargo.length > 39) {
						var cargoMuestra = cargo.substr(0,37) + " ...";
						var mostrarEtiqueta = " title='"+cargo+"'";
					} else {
						var cargoMuestra = cargo;
						var mostrarEtiqueta = "";
					}
					
					if (tieneLicencia == ""){
						if (fechaRenovacionLS != ""){
							tieneLicencia = "SEMEP";
						} else {
							if (fechaControlLM != "") tieneLicencia = "MUNICIPAL";
						}
					}
					
					if (fechaRenovacionLS == "00-00-0000") fechaRenovacionLS = "RECHAZADO";
					
					var columnaDatosLicencia = "";
					var imagenDocumento = "";
					
					if (tieneLicencia == "NO TIENE") {
						imagenDocumento = "<img src='./img/adjunto.jpg' WIDTH='10' HEIGHT='10'>";
						columnaDatosLicencia ="<td colspan='2' width='26%'><div id='valorColumna' align='center'>NO TIENE LICENCIA CONDUCIR</div></td>";
					} else {
						if (tieneLicencia != ""){
							imagenDocumento = "<img src='./img/adjunto.jpg' WIDTH='10' HEIGHT='10'>";
							columnaDatosLicencia = "<td width='13%'><div id='valorColumna'>"+mostrarFechaControlLM+"</div></td>";
							columnaDatosLicencia += "<td width='13%'><div id='valorColumna'>"+fechaRenovacionLS+"</div></td>";
							if (archivoLicencia == "") imagenDocumento = "";
						} else {
							imagenDocumento = "";
							columnaDatosLicencia ="<td width='13%'><div id='valorColumna'></div></td>";
							columnaDatosLicencia +="<td width='13%'><div id='valorColumna'></div></td>";
						}
					}
					
					LinkArchivo	= '<a href="./archivos/'+archivoLicencia+'" target="_blank"> <img src="img/adjunto.jpg" width=15 height=15 border="0"> </a>';
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='38%'><div id='valorColumna'>"+nombreCompleto+"</div></td>";
					listadoFuncionarios += "<td width='16%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
					listadoFuncionarios += columnaDatosLicencia;
					listadoFuncionarios	+= "<td width='6%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkArchivo+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionariosLC = 1;
			}
		}
	}
}

var idCargarListas;
function cargarlistas(codigoFuncionario){
	if(cargaComunas==1&&cargaTipoClasificacionSemep==1){
		clearInterval(idCargarListas);
		leeDatosLCFuncionario(codigoFuncionario);
	}
}

function inicializaVentanaLicenciaConducir(codigoFuncionario, subio, tipo, nombreArchivo){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left 	 = "120px";
	document.getElementById("mensajeCargando").style.top     = "250px";
	
	listaMultipleTiposLicenciaConducir('selClaseMunicipalOpciones');
	listaMultipleTiposRestriccionConducir('selRestriccionMunicipalOpciones','MUNICIPAL');
	listaMultipleTiposClasificacionSemep('selTipoVehiculoSemepOpciones');
	listaMultipleTiposRestriccionConducir('selRestriccionSemepOpciones','SEMEP');
	leeComunasListaSimple('selMunicipalidad', '');
	listaSimpleTiposEvaluacionSemep('selEvaluacionSemep');
	
	idCargarListas = setInterval("cargarlistas('"+codigoFuncionario+"')",1000);
	
	if(subio == 1){
		alert("EL ARCHIVO FUE GRABADO EN EL SERVIDOR SIN PROBLEMAS .......  ");
	}
	
	if(document.getElementById("permisoEscritura").value) document.getElementById("btnEliminarFicha").disabled = false;
}

function leeDatosLCFuncionario(codigoFuncionario){
	cargaDatosFuncionariosLC = 0;
	document.getElementById("mensajeCargando").style.display	= "";
	document.getElementById("mensajeCargando").style.left		= "120px";
	document.getElementById("mensajeCargando").style.top		= "250px";
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlDatosLicenciasDeConducirFuncionario.php",true);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI("codigoFuncionario="+codigoFuncionario));
	objHttpXMLLicenciasConducir.onreadystatechange=function(){
		//alert(objHttpXMLLicenciasConducir.readyState);
		if(objHttpXMLLicenciasConducir.readyState == 4){
			console.log(objHttpXMLLicenciasConducir.responseText);
			if(objHttpXMLLicenciasConducir.responseText != "VACIO"){
				//alert(objHttpXMLLicenciasConducir.responseText);
				var xml								= objHttpXMLLicenciasConducir.responseXML.documentElement;
				var codigo							= "";
				var nombreCompleto					= "";
				var nombre							= "";
				var nombre2							= "";
				var apellidoP						= "";
				var apellidoM						= "";
				var grado							= "";
				var cargo							= "";
				var numeroLCMunicipal				= "";
				var codigoComuna					= "";
				var fechaUltimoControlLCMunicipal	= "";
				var fechaControlLCMunicipal			= "";
				var observacionesLCMunicipal		= "";
				var codigoEvaluacion				= "";
				var fechaHabilitacionLCSemep		= "";
				var fechaRenovacionLCSemep			= "";
				var observacionesLCSemep			= "";
				var tieneLicenciaConducir			= "";
				var archivoLicenciaConducir			= "";
				
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre			= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					nombre2			= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					apellidoP		= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoM		= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					nombreCompleto	= apellidoP + " " + apellidoM + ", " + nombre + " " + nombre2;
					grado			= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					cargo			= (xml.getElementsByTagName('cargo')[i].text||xml.getElementsByTagName('cargo')[i].textContent||"");
					
					tieneLicenciaConducir	= (xml.getElementsByTagName('tieneLicencia')[i].text||xml.getElementsByTagName('tieneLicencia')[i].textContent||"");
					archivoLicenciaConducir	= (xml.getElementsByTagName('archivoLicencia')[i].text||xml.getElementsByTagName('archivoLicencia')[i].textContent||"");
					
					numeroLCMunicipal				= (xml.getElementsByTagName('numeroLCMunicipal')[i].text||xml.getElementsByTagName('numeroLCMunicipal')[i].textContent||"");
					codigoComuna					= (xml.getElementsByTagName('codigoComuna')[i].text||xml.getElementsByTagName('codigoComuna')[i].textContent||"");
					fechaUltimoControlLCMunicipal	= (xml.getElementsByTagName('fechaUltimoControlLCMunicipal')[i].text||xml.getElementsByTagName('fechaUltimoControlLCMunicipal')[i].textContent||"");
					fechaControlLCMunicipal			= (xml.getElementsByTagName('fechaControlLCMunicipal')[i].text||xml.getElementsByTagName('fechaControlLCMunicipal')[i].textContent||"");
					observacionesLCMunicipal		= (xml.getElementsByTagName('observacionesLCMunicipal')[i].text||xml.getElementsByTagName('observacionesLCMunicipal')[i].textContent||"");
					
					codigoEvaluacion			= (xml.getElementsByTagName('codigoEvaluacion')[i].text||xml.getElementsByTagName('codigoEvaluacion')[i].textContent||"");
					fechaHabilitacionLCSemep	= (xml.getElementsByTagName('fechaHabilitacionLCSemep')[i].text||xml.getElementsByTagName('fechaHabilitacionLCSemep')[i].textContent||"");
					fechaRenovacionLCSemep		= (xml.getElementsByTagName('fechaRenovacionLCSemep')[i].text||xml.getElementsByTagName('fechaRenovacionLCSemep')[i].textContent||"");
					observacionesLCSemep		= (xml.getElementsByTagName('observacionesLCSemep')[i].text||xml.getElementsByTagName('observacionesLCSemep')[i].textContent||"");
					clases						= (xml.getElementsByTagName('clasesLM')[i].text||xml.getElementsByTagName('clasesLM')[i].textContent||"");
					
					if (fechaRenovacionLCSemep == "00-00-0000") fechaRenovacionLCSemep = "";
					if (codigoComuna == "") codigoComuna = 0;
					
					document.getElementById("textCodigoFuncionario").value	= codigo;
					document.getElementById("textGrado").value				= grado;
					document.getElementById("textNombreCompleto").value		= nombreCompleto;
					document.getElementById("textCargoActual").value		= cargo;
					
					if (numeroLCMunicipal != "") document.getElementById("optionMunicipal").checked = true;
					licenciaMunicipal();
					
					document.getElementById("selMunicipalidad").value				= codigoComuna;
					document.getElementById("textNumeroLicenciaMunicipal").value	= numeroLCMunicipal;
					
					document.getElementById("textFechaUltimoControlMunicipal").value  = fechaUltimoControlLCMunicipal;
					document.getElementById("textFechaProximoControlMunicipal").value = fechaControlLCMunicipal;
					document.getElementById("textObservacionesMunicipal").value  			= observacionesLCMunicipal;
					
					if (fechaHabilitacionLCSemep == "00-00-0000") fechaHabilitacionLCSemep = fechaUltimoControlLCMunicipal;
					
					if (fechaHabilitacionLCSemep != "") {
						document.getElementById("optionSemep").checked = true;
					}
					
					licenciaSemep();
					document.getElementById("selEvaluacionSemep").value			= codigoEvaluacion;
					document.getElementById("textFechaHabilitacionSemep").value	= fechaHabilitacionLCSemep;
					document.getElementById("textFechaRenovacionSemep").value	= fechaRenovacionLCSemep;
					document.getElementById("textObservacionesSemep").value		= observacionesLCSemep;
					document.getElementById("fotoFuncionario").src = "./img/sinFoto.png";
					
					if (tieneLicenciaConducir == "NO TIENE") {
						document.getElementById("optionNoTiene").checked = true;
					}
					
					if (archivoLicenciaConducir != "") {
						document.getElementById("nombreArchivoSubir").innerHTML = archivoLicenciaConducir;
						document.getElementById("archivoEnServidor").value = archivoLicenciaConducir;
						document.getElementById("tipoArchivoEnServidor").value = tieneLicenciaConducir;
					} else {
						document.getElementById("archivoEnServidor").value = "";
						document.getElementById("tipoArchivoEnServidor").value = "";
					}
					
					for(var k=0;k<document.getElementById("selClaseMunicipalOpciones").length;k++){
						for(var j=0;j<xml.getElementsByTagName('codigoClase').length;j++){
							if (document.getElementById("selClaseMunicipalOpciones")[k].value == (xml.getElementsByTagName('codigoClase')[j].text||xml.getElementsByTagName('codigoClase')[j].textContent||"")){
								document.getElementById("selClaseMunicipalOpciones")[k].selected=true;
								seleccionaClaseLicenciaMunicipal(false);
							}
						}
					}
          
					for(var k=0;k<document.getElementById("selRestriccionMunicipalOpciones").length;k++){
						for(var j=0;j<xml.getElementsByTagName('codigoRestriccionLM').length;j++){
							if (document.getElementById("selRestriccionMunicipalOpciones")[k].value == (xml.getElementsByTagName('codigoRestriccionLM')[j].text||xml.getElementsByTagName('codigoRestriccionLM')[j].textContent||"")){
								document.getElementById("selRestriccionMunicipalOpciones")[k].selected=true;
								seleccionaRestriccionLicenciaMunicipal(false);
							}
						}
					}
			
					for(var k=0;k<document.getElementById("selTipoVehiculoSemepOpciones").length;k++){
						for(var j=0;j<xml.getElementsByTagName('codigoVehiculoAutorizado').length;j++){
							if (document.getElementById("selTipoVehiculoSemepOpciones")[k].value == (xml.getElementsByTagName('codigoVehiculoAutorizado')[j].text||xml.getElementsByTagName('codigoVehiculoAutorizado')[j].textContent||"")){
								document.getElementById("selTipoVehiculoSemepOpciones")[k].selected=true;
								seleccionaTipoVehiculoSemep(false);
							}
						}
					}
          
					for(var k=0;k<document.getElementById("selRestriccionSemepOpciones").length;k++){
						for(var j=0;j<xml.getElementsByTagName('codigoRestriccionLS').length;j++){
							if (document.getElementById("selRestriccionSemepOpciones")[k].value == (xml.getElementsByTagName('codigoRestriccionLS')[j].text||xml.getElementsByTagName('codigoRestriccionLS')[j].textContent||"")){
								document.getElementById("selRestriccionSemepOpciones")[k].selected=true;
								seleccionaRestriccionSemep(false);
							}
						}
					}
				
				}
				licenciaRechazada(false);
				document.getElementById("mensajeCargando").style.display = "none";
				cargaDatosFuncionariosLC = 1;
			}
		}
	}
}

function licenciaMunicipal(){
	
	if(document.getElementById("optionMunicipal").checked){
		
		document.getElementById("nombreArchivoSubir").innerHTML = '<input type="button" id="btnGuardarArchivo" value="ADJUNTAR ARCHIVO" onClick="adjuntarArchivo()" />';
		(document.getElementById("optionNoTiene").checked) ? document.getElementById("optionNoTiene").click() : null;
		
		document.getElementById("selMunicipalidad").className 								= "habilidado";
		document.getElementById("textNumeroLicenciaMunicipal").className 					= "habilidado";
		document.getElementById("textFechaUltimoControlMunicipal").className 				= "habilidado";
		document.getElementById("textFechaProximoControlMunicipal").className 				= "habilidado";
		document.getElementById("imagenCalendarioUltimoControlMunicipal").className			= "calendarioHabilidado";
		document.getElementById("imagenCalendarioProximoControlMunicipal").className		= "calendarioHabilidado";
		document.getElementById("selClaseMunicipalOpciones").className 						= "habilidado";
		document.getElementById("selClaseMunicipalOpcionesSeleccionadas").className 		= "habilidado";
		document.getElementById("selRestriccionMunicipalOpciones").className 				= "habilidado";
		document.getElementById("selRestriccionMunicipalOpcionesSeleccionadas").className	= "habilidado";
		document.getElementById("textObservacionesMunicipal").className	= "habilidado";
		
		document.getElementById("textNumeroLicenciaMunicipal").disabled						= "";
		document.getElementById("grupoLicenciaMunicipal").disabled							= "";
		document.getElementById("textFechaUltimoControlMunicipal").disabled					= "";
		document.getElementById("textFechaProximoControlMunicipal").disabled				= "";
		document.getElementById("selClaseMunicipalOpciones").disabled						= "";
		document.getElementById("selClaseMunicipalOpcionesSeleccionadas").disabled			= "";
		document.getElementById("selRestriccionMunicipalOpciones").disabled					= "";
		document.getElementById("selRestriccionMunicipalOpcionesSeleccionadas").disabled	= "";
		document.getElementById("textObservacionesMunicipal").disabled	= "";
		
	} else {
		
		if (document.getElementById("optionSemep").checked){
			document.getElementById("nombreArchivoSubir").innerHTML = '<input type="button" id="btnGuardarArchivo" value="ADJUNTAR ARCHIVO" onClick="adjuntarArchivo()" />';
			document.getElementById("optionSemep").click();
		}
		
		document.getElementById("selMunicipalidad").className 								= "deshabilidado";
		document.getElementById("textNumeroLicenciaMunicipal").className 					= "deshabilidado";
		document.getElementById("textFechaUltimoControlMunicipal").className 				= "deshabilidado";
		document.getElementById("textFechaProximoControlMunicipal").className 				= "deshabilidado";
		document.getElementById("imagenCalendarioUltimoControlMunicipal").className 		= "calendarioDeshabilidado";
		document.getElementById("imagenCalendarioProximoControlMunicipal").className 		= "calendarioDeshabilidado";
		document.getElementById("selClaseMunicipalOpciones").className 						= "deshabilidado";
		document.getElementById("selClaseMunicipalOpcionesSeleccionadas").className 		= "deshabilidado";
		document.getElementById("selRestriccionMunicipalOpciones").className 				= "deshabilidado";
		document.getElementById("selRestriccionMunicipalOpcionesSeleccionadas").className 	= "deshabilidado";
		document.getElementById("textObservacionesMunicipal").className 					= "deshabilidado";
		
		document.getElementById("textNumeroLicenciaMunicipal").disabled						= "true";
		document.getElementById("grupoLicenciaMunicipal").disabled							= "true";
		document.getElementById("textFechaUltimoControlMunicipal").disabled					= "true";
		document.getElementById("textFechaProximoControlMunicipal").disabled				= "true";
		document.getElementById("selClaseMunicipalOpciones").disabled						= "true";
		document.getElementById("selClaseMunicipalOpcionesSeleccionadas").disabled			= "true";
		document.getElementById("selRestriccionMunicipalOpciones").disabled					= "true";
		document.getElementById("selRestriccionMunicipalOpcionesSeleccionadas").disabled	= "true";
		document.getElementById("textObservacionesMunicipal").disabled						= "true";
	}
}

function seleccionaClaseLicenciaMunicipal(modifica){
	moverDatos('selClaseMunicipalOpciones','selClaseMunicipalOpcionesSeleccionadas');
	ordenar(document.getElementById('selClaseMunicipalOpcionesSeleccionadas'));
	
	if (document.getElementById('selClaseMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selClaseMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "";
	(modifica) ? habilitarBotonAcciones(true, true, false) : null;
}

function licenciaSemep(){
	
	if (document.getElementById("optionSemep").checked){
		
		if (document.getElementById("optionNoTiene").checked){
			document.getElementById("nombreArchivoSubir").innerHTML = '<input type="button" id="btnGuardarArchivo" value="ADJUNTAR ARCHIVO" onClick="adjuntarArchivo()" />';

		}
		
		if (!document.getElementById("optionMunicipal").checked){
			document.getElementById("nombreArchivoSubir").innerHTML = '<input type="button" id="btnGuardarArchivo" value="ADJUNTAR ARCHIVO" onClick="adjuntarArchivo()" />';
			document.getElementById("optionMunicipal").click();
		}
		
		if (document.getElementById("optionMunicipal").checked){
			document.getElementById("nombreArchivoSubir").innerHTML = '<input type="button" id="btnGuardarArchivo" value="ADJUNTAR ARCHIVO" onClick="adjuntarArchivo()" />';
		}
		
		document.getElementById("selEvaluacionSemep").className 							= "habilidado";
		document.getElementById("textFechaHabilitacionSemep").className 					= "habilidado";
		document.getElementById("textFechaRenovacionSemep").className 						= "habilidado";
		document.getElementById("imagenCalendarioHabilitacionSemep").className				= "calendarioHabilidado";
		document.getElementById("imagenCalendarioRenovacionSemep").className				= "calendarioHabilidado";
		document.getElementById("selTipoVehiculoSemepOpciones").className 					= "habilidado";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").className 		= "habilidado";
		document.getElementById("selRestriccionSemepOpciones").className 					= "habilidado";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").className		= "habilidado";
		document.getElementById("textObservacionesSemep").className							= "habilidado";
		
		document.getElementById("selEvaluacionSemep").disabled								= "";
		document.getElementById("textFechaHabilitacionSemep").disabled						= "";
		document.getElementById("textFechaRenovacionSemep").disabled						= "";
		document.getElementById("selTipoVehiculoSemepOpciones").disabled					= "";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").disabled		= "";
		document.getElementById("selRestriccionSemepOpciones").disabled						= "";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").disabled		= "";
		document.getElementById("textObservacionesSemep").disabled							= "";
		document.getElementById("grupoLicenciaSemep").disabled								= "";
		
	} else {
		
		if (document.getElementById("optionMunicipal").checked) habilitarBotonAcciones(true, true, true);
		
		document.getElementById("selEvaluacionSemep").className 							= "deshabilidado";
		document.getElementById("textFechaHabilitacionSemep").className 					= "deshabilidado";
		document.getElementById("textFechaRenovacionSemep").className 						= "deshabilidado";
		document.getElementById("imagenCalendarioHabilitacionSemep").className				= "calendarioDeshabilidado";
		document.getElementById("imagenCalendarioRenovacionSemep").className				= "calendarioDeshabilidado";
		document.getElementById("selTipoVehiculoSemepOpciones").className 					= "deshabilidado";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").className 		= "deshabilidado";
		document.getElementById("selRestriccionSemepOpciones").className 					= "deshabilidado";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").className		= "deshabilidado";
		document.getElementById("textObservacionesSemep").className							= "deshabilidado";
		
		document.getElementById("selEvaluacionSemep").disabled								= "true";
		document.getElementById("textFechaHabilitacionSemep").disabled						= "true";
		document.getElementById("textFechaRenovacionSemep").disabled						= "true";
		document.getElementById("selTipoVehiculoSemepOpciones").disabled					= "true";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").disabled		= "true";
		document.getElementById("selRestriccionSemepOpciones").disabled						= "true";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").disabled		= "true";
		document.getElementById("textObservacionesSemep").disabled							= "true";
		document.getElementById("grupoLicenciaSemep").disabled								= "true";
		
	}
}

function seleccionaRestriccionLicenciaMunicipal(modifica){
	moverDatos('selRestriccionMunicipalOpciones','selRestriccionMunicipalOpcionesSeleccionadas');
	ordenar(document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas'));
	
	if (document.getElementById('selRestriccionMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "";
	
	(modifica) ? habilitarBotonAcciones(true, true, false) : null;
}

function seleccionaTipoVehiculoSemep(modifica){
	moverDatos('selTipoVehiculoSemepOpciones','selTipoVehiculoSemepOpcionesSeleccionadas');
	ordenar(document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas'));
	
	if (document.getElementById('selTipoVehiculoSemepOpciones').length == 0) document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "";
	
	if (document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "";
	
	(modifica) ? habilitarBotonAcciones(true, true, false) : null;
}

function seleccionaRestriccionSemep(modifica){
	moverDatos('selRestriccionSemepOpciones','selRestriccionSemepOpcionesSeleccionadas');
	ordenar(document.getElementById('selRestriccionSemepOpcionesSeleccionadas'));
	
	if (document.getElementById('selRestriccionSemepOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionSemep').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionSemep').disabled = "";
	
	if (document.getElementById('selRestriccionSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "";
	
	(modifica) ? habilitarBotonAcciones(true, true, false) : null;
}

function licenciaRechazada(modifica){
	
	if (document.getElementById("selEvaluacionSemep").value == 30 || document.getElementById("selEvaluacionSemep").value == 40){
		
		document.getElementById("imagenCalendarioRenovacionSemep").className				= "calendarioDeshabilidado";
		document.getElementById("textFechaRenovacionSemep").className 						= "deshabilidado";
		document.getElementById("selTipoVehiculoSemepOpciones").className 					= "deshabilidado";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").className 		= "deshabilidado";
		document.getElementById("selRestriccionSemepOpciones").className 					= "deshabilidado";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").className		= "deshabilidado";
		
		document.getElementById("textFechaRenovacionSemep").disabled						= "true";
		document.getElementById("selTipoVehiculoSemepOpciones").disabled					= "true";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").disabled		= "true";
		document.getElementById("selRestriccionSemepOpciones").disabled						= "true";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").disabled		= "true";
		
	} else {
		
		document.getElementById("textFechaRenovacionSemep").className 						= "habilidado";
		document.getElementById("imagenCalendarioRenovacionSemep").className				= "calendarioHabilidado";
		document.getElementById("selTipoVehiculoSemepOpciones").className 					= "habilidado";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").className 		= "habilidado";
		document.getElementById("selRestriccionSemepOpciones").className 					= "habilidado";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").className		= "habilidado";
		
		document.getElementById("textFechaRenovacionSemep").disabled						= "";
		document.getElementById("selTipoVehiculoSemepOpciones").disabled					= "";
		document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").disabled		= "";
		document.getElementById("selRestriccionSemepOpciones").disabled						= "";
		document.getElementById("selRestriccionSemepOpcionesSeleccionadas").disabled		= "";
	}
	
	(modifica) ? habilitarBotonAcciones(true, true, false) : null;
}

function validaDatosLicenciaConducir(){
	if (!document.getElementById("optionMunicipal").checked && !document.getElementById("optionSemep").checked && !document.getElementById("optionNoTiene").checked){
		alert("NO HA SELECCIONADO ALGUNA ALTERNATIVA:\n\nMUNICIPAL - SEMEP - NO TIENE LICENCIA.");
		return false;
	}
	
	if (document.getElementById("optionMunicipal").checked){
		var municipalComuna					= document.getElementById("selMunicipalidad").value;
		var municipalNumero					= document.getElementById("textNumeroLicenciaMunicipal").value;
		var municipalFechaUltimoControl		= document.getElementById("textFechaUltimoControlMunicipal").value;
		var municipalFechaProximoControl	= document.getElementById("textFechaProximoControlMunicipal").value;
		var cantidadClasesSeleccionadas		= document.getElementById('selClaseMunicipalOpcionesSeleccionadas').length;
		
		if (municipalComuna == 0){
			alert("DEBE INGRESAR COMUNA DE LA LICENCIA DE CONDUCIR ...     ");
			document.getElementById("selMunicipalidad").focus();
			return false;
		}
		
		if (municipalNumero == ""){
			alert("DEBE INGRESAR NUMERO DE LA LICENCIA DE CONDUCIR ...     ");
			document.getElementById("textNumeroLicenciaMunicipal").focus();
			return false;
		}
		
		if  (!/^([0-9])*$/.test(municipalNumero)){
			alert("EL VALOR INGRESADO COMO NUMERO DE LICENCIA DE CONDUCIR NO CORRESPONDE.");
			document.getElementById("textNumeroLicenciaMunicipal").value = "";
			document.getElementById("textNumeroLicenciaMunicipal").focus();
			return false;
		}
		
		if (municipalFechaUltimoControl == ""){
			alert("DEBE INGRESAR LA FECHA DEL ULTIMO CONTROL DE OBTENCION DE LICENCIA DE CONDUCIR ...     ");
			document.getElementById("textFechaUltimoControlMunicipal").focus();
			return false;
		}
		
		if (municipalFechaProximoControl == ""){
			alert("DEBE INGRESAR LA FECHA DEL PROXIMO CONTROL DE RENOVACION DE LICENCIA DE CONDUCIR ...     ");
			document.getElementById("textFechaProximoControlMunicipal").focus();
			return false;
		}
		
		var comparaFechaControles = comparaFecha(municipalFechaUltimoControl,municipalFechaProximoControl);
		if (comparaFechaControles == 1 || comparaFechaControles == 0){
			alert("LA FECHA DEL PROXIMO CONTROL DE RENOVACION DE LICENCIA DE CONDUCIR, NO PUEDE SER MENOR O IGUAL QUE LA FECHA DE ULTIMO CONTROL.");
			document.getElementById("textFechaProximoControlMunicipal").value = "";
			document.getElementById("textFechaProximoControlMunicipal").focus();
			return false;
		}
		
		var cantidadDeDias = cantidadDeDiasEntre(municipalFechaUltimoControl,municipalFechaProximoControl);
		if (cantidadDeDias < 365){
			var confirmaDiasEntreFechasMunicipal = confirm("ATENCION:\n\nLA FECHA DEL PROXIMO CONTROL DE RENOVACION DE LICENCIA DE CONDUCIR INGRESADA POR UD. ES MENOR DE UN A?O DESDE LA FECHA DE ULTIMO CONTROL.\n\n?ES CORRECTO? ?DESEA CONTINUAR?");
			 if (!confirmaDiasEntreFechasMunicipal)	{
			 	document.getElementById("textFechaProximoControlMunicipal").value = "";
			 	document.getElementById("textFechaProximoControlMunicipal").focus();
			 	return false;
			 }
		}
		
		if (cantidadClasesSeleccionadas == 0){
			alert("DEBE INGRESAR LA CLASE DE LICENCIA DE CONDUCIR ...     ");
			document.getElementById("selClaseMunicipalOpcionesSeleccionadas").focus();
			return false;
		}
	}
	
	if (document.getElementById("optionSemep").checked){
		var semepFechaHabilitacion		= document.getElementById("textFechaHabilitacionSemep").value;
		var semepFechaRenovacion			= document.getElementById("textFechaRenovacionSemep").value;
		var semepTipoEvaluacion				= document.getElementById("selEvaluacionSemep").value;
		var semepObservaciones				= document.getElementById("textObservacionesSemep").value;
		var cantidadVehiculosSeleccionadas	= document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas').length;
		
		if (semepTipoEvaluacion == 0){
			alert("DEBE INGRESAR LA EVALUACION SEMEP ...     ");
			document.getElementById("selEvaluacionSemep").focus();
			return false;
		}
		
		if (semepFechaHabilitacion == ""){
			alert("DEBE INGRESAR LA FECHA DE LA HABILITACION SEMEP ...     ");
			document.getElementById("textFechaHabilitacionSemep").focus();
			return false;
		}
		
		if (document.getElementById("selEvaluacionSemep").value != 30 && document.getElementById("selEvaluacionSemep").value != 40){
			if (semepFechaRenovacion == ""){
				alert("DEBE INGRESAR LA FECHA DE LA RENOVACION SEMEP ...     ");
				document.getElementById("textFechaRenovacionSemep").focus();
				return false;
			}
			
			var comparaFechaControlesSemep = comparaFecha(semepFechaHabilitacion,semepFechaRenovacion);
			if (comparaFechaControlesSemep == 1 || comparaFechaControlesSemep == 0){
				alert("LA FECHA DE RENOVACION DE LICENCIA SEMEP, NO PUEDE SER MENOR O IGUAL QUE LA FECHA DE HABILITACION.");
				document.getElementById("textFechaRenovacionSemep").value = "";
				document.getElementById("textFechaRenovacionSemep").focus();
				return false;
			}
			
			var cantidadDeDias = cantidadDeDiasEntre(semepFechaHabilitacion,semepFechaRenovacion);
			if (cantidadDeDias < 365){
				var confirmaDiasEntreFechasSemep = confirm("ATENCION:\n\nLA FECHA DE RENOVACION DE LA LICENCIA SEMEP INGRESADA POR UD. ES MENOR DE UN A?O DESDE LA FECHA HABILITACION.\n\n?ES CORRECTO? ?DESEA CONTINUAR?");
			 	if (!confirmaDiasEntreFechasSemep){
				 	document.getElementById("textFechaRenovacionSemep").value = "";
				 	document.getElementById("textFechaRenovacionSemep").focus();
				 	return false;
			 	}
			}
			
			if (cantidadVehiculosSeleccionadas == 0){
				alert("DEBE INGRESAR LA CLASE DE VEHICULOS AUTORIZADOS A CONDUCIR ...     ");
				document.getElementById("selTipoVehiculoSemepOpcionesSeleccionadas").focus();
				return false;
			}
		}
	}
	var archivoActa	= document.getElementById("archivo").value;
	var archivoEnServidor = document.getElementById("archivoEnServidor").value;
	if (archivoActa == "" && archivoEnServidor == ""){
		alert("DEBE ADJUNTAR ARCHIVO DE RESPALDO ...     ");
		return false;
	}
	return true;
}

function eliminarDatosLicenciaConducir(){
	var codigoUnidad			= document.getElementById("unidadUsuario").value;
	var existeLicenciaMunicipal = 0;
	var existeLicenciaSemep 	= 0;
	var noTieneLicencia 		= 0;
	var codigoFuncionario		= document.getElementById("textCodigoFuncionario").value;
	var municipalNumero			= document.getElementById("textNumeroLicenciaMunicipal").value;
	var semepFechaHabilitacion	= document.getElementById("textFechaHabilitacionSemep").value;
	var nombreArchivo			= document.getElementById("archivoEnServidor").value;
	
	if (document.getElementById("optionMunicipal").checked) existeLicenciaMunicipal = 1;
	if (document.getElementById("optionSemep").checked) existeLicenciaSemep = 1;
	if (document.getElementById("optionNoTiene").checked) noTieneLicencia = 1;
	
	var parametros = "";
	parametros =  "codigoFuncionario="+codigoFuncionario+"&municipalNumero="+municipalNumero+"&semepFechaHabilitacion="+semepFechaHabilitacion;
	parametros += "&existeLicenciaMunicipal="+existeLicenciaMunicipal+"&existeLicenciaSemep="+existeLicenciaSemep+"&noTieneLicencia="+noTieneLicencia+"&nombreArchivo="+nombreArchivo;
	
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlLicenciaConducirBorrar.php",true);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI(parametros));
	objHttpXMLLicenciasConducir.onreadystatechange=function(){
		if(objHttpXMLLicenciasConducir.readyState == 4)	{
			//alert(objHttpXMLLicenciasConducir.responseText);
			if (objHttpXMLLicenciasConducir.responseText != "VACIO"){
				//alert(objHttpXMLLicenciasConducir.responseText);
				var xml = objHttpXMLLicenciasConducir.responseXML.documentElement;
				for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LOS DATOS FUERON BORRADOS CON EXITO A LA BASE DE DATOS ......        ');
						top.leeFuncionariosLicenciasConducir(codigoUnidad,'','','');
						top.cerrarVentana();
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function quitaSeleccionClaseLicenciaMunicipal(){
	moverDatos('selClaseMunicipalOpcionesSeleccionadas','selClaseMunicipalOpciones');
	ordenar(document.getElementById('selClaseMunicipalOpciones'));
	
	if (document.getElementById('selClaseMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selClaseMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "";
	
	habilitarBotonAcciones(true, true, false);
}

function quitaSeleccionRestriccionLicenciaMunicipal(){
	moverDatos('selRestriccionMunicipalOpcionesSeleccionadas','selRestriccionMunicipalOpciones');
	ordenar(document.getElementById('selRestriccionMunicipalOpciones'));
	
	if (document.getElementById('selRestriccionMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "";
	
	habilitarBotonAcciones(true, true, false);
}

function quitaSeleccionTipoVehiculoSemep(){
	moverDatos('selTipoVehiculoSemepOpcionesSeleccionadas','selTipoVehiculoSemepOpciones');
	ordenar(document.getElementById('selTipoVehiculoSemepOpciones'));
	
	if (document.getElementById('selTipoVehiculoSemepOpciones').length == 0) document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "";
	
	if (document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "";
	
	habilitarBotonAcciones(true, true, false);
}

function quitaSeleccionRestriccionSemep(){
	moverDatos('selRestriccionSemepOpcionesSeleccionadas','selRestriccionSemepOpciones');
	ordenar(document.getElementById('selRestriccionSemepOpciones'));
	
	if (document.getElementById('selRestriccionSemepOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionSemep').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionSemep').disabled = "";
	
	if (document.getElementById('selRestriccionSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "";
	
	habilitarBotonAcciones(true, true, false);
}

function noTieneLicencia(){
	if (document.getElementById("optionNoTiene").checked){
		if (document.getElementById("optionMunicipal").checked) document.getElementById("optionMunicipal").click();
		if (document.getElementById("optionSemep").checked) document.getElementById("optionSemep").click();
		habilitarBotonAcciones(true, false, true);
	}
}

function guardarDatosLicenciaConducir(){
	var validacionOk = validaDatosLicenciaConducir();
	if (validacionOk){
		if(document.getElementById("archivoEnServidor").value == "") subirArchivo();
		var codigoFuncionario				= document.getElementById("textCodigoFuncionario").value;
		var codigoUnidad						= document.getElementById("unidadUsuario").value;
		var municipalComuna					= document.getElementById("selMunicipalidad").value;
		var municipalNumero					= document.getElementById("textNumeroLicenciaMunicipal").value;
		var municipalFechaUltimoControl		= document.getElementById("textFechaUltimoControlMunicipal").value;
		var municipalFechaProximoControl	= document.getElementById("textFechaProximoControlMunicipal").value;
		var municipalObservaciones				= document.getElementById("textObservacionesMunicipal").value;
		
		var arrayMunicipalClase				= new Array();
		var largoMunicipalClase 			= document.getElementById('selClaseMunicipalOpcionesSeleccionadas').length;
		for (i=0;i<largoMunicipalClase;i++){
			arrayMunicipalClase[arrayMunicipalClase.length] = document.getElementById('selClaseMunicipalOpcionesSeleccionadas').options[i].value;
		}
		
		var arrayMunicipalRestriccion		= new Array();
		var largoMunicipalRestriccion		= document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas').length;
		for (i=0;i<largoMunicipalRestriccion;i++){
			arrayMunicipalRestriccion[arrayMunicipalRestriccion.length] = document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas').options[i].value;
		}
		
		var semepFechaHabilitacion		= document.getElementById("textFechaHabilitacionSemep").value;
		var semepFechaRenovacion			= document.getElementById("textFechaRenovacionSemep").value;
		var semepTipoEvaluacion				= document.getElementById("selEvaluacionSemep").value;
		var semepObservaciones				= document.getElementById("textObservacionesSemep").value;
		
		var arraySemepVehiculoAutorizado	= new Array();
		var largoSemepVehiculoAutorizado	= document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas').length;
		for (i=0;i<largoSemepVehiculoAutorizado;i++){
			arraySemepVehiculoAutorizado[arraySemepVehiculoAutorizado.length] = document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas').options[i].value;
		}
		
		var arraySemepRestriccion			= new Array();
		var largoSemepRestriccion			= document.getElementById('selRestriccionSemepOpcionesSeleccionadas').length;
		for (i=0;i<largoSemepRestriccion;i++){
			arraySemepRestriccion[arraySemepRestriccion.length] = document.getElementById('selRestriccionSemepOpcionesSeleccionadas').options[i].value;
		}
		
		var arrayMunicipalClaseParametro 					= php_serialize(arrayMunicipalClase);
		var aarrayMunicipalRestriccionParametro 	= php_serialize(arrayMunicipalRestriccion);
		var arraySemepVehiculoAutorizadoParametro = php_serialize(arraySemepVehiculoAutorizado);
		var arraySemepRestriccionParametro 				= php_serialize(arraySemepRestriccion);
		
		var existeLicenciaMunicipal = 0;
		var existeLicenciaSemep 	= 0;
		if (document.getElementById("optionMunicipal").checked) existeLicenciaMunicipal = 1;
		if (document.getElementById("optionSemep").checked) existeLicenciaSemep = 1;
		
		var parametros = "";
		parametros =  "codigoFuncionario="+codigoFuncionario+"&municipalComuna="+municipalComuna+"&municipalNumero="+municipalNumero;
		parametros += "&municipalFechaUltimoControl="+municipalFechaUltimoControl+"&municipalFechaProximoControl="+municipalFechaProximoControl+"&municipalObservaciones="+municipalObservaciones;
		parametros += "&semepFechaHabilitacion="+semepFechaHabilitacion+"&semepFechaRenovacion="+semepFechaRenovacion+"&semepTipoEvaluacion="+semepTipoEvaluacion+"&semepObservaciones="+semepObservaciones;
		parametros += "&arrayMunicipalClase="+arrayMunicipalClaseParametro+"&arrayMunicipalRestriccion="+aarrayMunicipalRestriccionParametro+"&arraySemepVehiculoAutorizado="+arraySemepVehiculoAutorizadoParametro+"&arraySemepRestriccion="+arraySemepRestriccionParametro;
		parametros += "&existeLicenciaMunicipal="+existeLicenciaMunicipal+"&existeLicenciaSemep="+existeLicenciaSemep;
		//alert(parametros);
		var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
		objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlLicenciaConducirGuardar.php",true);
		objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLLicenciasConducir.send(encodeURI(parametros));
		objHttpXMLLicenciasConducir.onreadystatechange=function(){
			//alert(objHttpXMLServicios.readyState);
			if(objHttpXMLLicenciasConducir.readyState == 4){
				//alert(objHttpXMLLicenciasConducir.responseText);
				if (objHttpXMLLicenciasConducir.responseText != "VACIO"){
					//alert(objHttpXMLLicenciasConducir.responseText);
					var xml = objHttpXMLLicenciasConducir.responseXML.documentElement;
					for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
						if (codigo == 1){
							alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
							top.leeFuncionariosLicenciasConducir(codigoUnidad,'','','');
							top.cerrarVentana();
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
	}
}

function subirArchivo(){
	if (document.getElementById("optionMunicipal").checked) document.getElementById("tipoSubir").value 	= "MUNICIPAL";
	if (document.getElementById("optionSemep").checked) document.getElementById("tipoSubir").value 		= "SEMEP";
	if (document.getElementById("optionNoTiene").checked) document.getElementById("tipoSubir").value 	= "NO TIENE";
	
	var rutaArchivo = document.getElementById("archivo").value;
	var extension 	= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toUpperCase();
	var codigoFuncionario = document.getElementById("textCodigoFuncionario").value;
	var arrayRutaArchivo = rutaArchivo.split("\\");
	var cantidadArreglo = arrayRutaArchivo.length;
	var nombreDelArchivo = arrayRutaArchivo[cantidadArreglo-1];
	var nombreArchivoAdjuntoFormateado = "Licencia_Conducir_"+codigoFuncionario+extension;
	var extensiones_permitidas 	= new Array(".JPG", ".JPEG", ".PNG", ".PDF", ".DOCX", ".DOC");
	var noaceptada = true;
	document.getElementById("nombreArchivoAdjuntoFormateado").value = nombreArchivoAdjuntoFormateado;
	
	for(var i = 0; i < extensiones_permitidas.length; i++){
		(extensiones_permitidas[i] == extension) ? noaceptada = false : null;
	}
  
  if(noaceptada){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO PDF, DOCX, JPG, JPEG, PNG O DOC");
		habilitarBotonAdjuntar();
   	return true;
  }
  
	guardarDatosArchivo(document.getElementById("textCodigoFuncionario").value, document.getElementById("tipoSubir").value, nombreArchivoAdjuntoFormateado);
	document.formSubeArchivo.submit();
	return false;
}

function guardarDatosArchivo(codigoFuncionario, tipo, nombreArchivo){
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlDatosArchivo.php",true);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&tipo="+tipo+"&nombreArchivo="+nombreArchivo));
}

var idCargaListadoFuncionariosLC;
function cambiaOrdenListaLicenciaConducir(columna, atributo, sentido, unidad){
	var nuevoSentido = "";
	if (sentido == "desc") nuevoSentido = "asc";
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	switch(atributo){
		case "grado":
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColLicenciaSemep").innerHTML = "SEMEP";
			document.getElementById("labColGrado").innerHTML  = "GRADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colGrado").onmousedown   = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "nombre":
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColLicenciaSemep").innerHTML = "SEMEP";
			document.getElementById("labColNombre").innerHTML = "NOMBRE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown  = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "codigo":
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColLicenciaSemep").innerHTML = "SEMEP";
			document.getElementById("labColCodigo").innerHTML = "CODIGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigo").onmousedown  = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "licenciaMunicipal":
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColLicenciaSemep").innerHTML = "SEMEP";
			document.getElementById("labColLicenciaMunicipal").innerHTML  = "MUNICIPAL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colLicenciaMunicipal").onmousedown   = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "licenciaSemep":
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColLicenciaSemep").innerHTML  = "SEMEP&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colLicenciaSemep").onmousedown   = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "archivo":
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColLicenciaSemep").innerHTML = "SEMEP";
			document.getElementById("labColArchivo").innerHTML  = "ARCHIVO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colArchivo").onmousedown   = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};
			break;
	}
	idCargaListadoFuncionariosLC = setInterval("tituloColumnaNormalLC("+columna.id+")",500);
}

function adjuntarArchivo(){
	document.getElementById("cubreVentanaPersonalLC").style.display = "";
	document.getElementById("divSubirArchivo").style.display = "";
	document.getElementById("divSubirArchivo").style.left 	 = "120px";
	document.getElementById("divSubirArchivo").style.top     = "250px";
}

function tituloColumnaNormalLC(columna){
	if (cargaListadoFuncionariosLC == 1){
		clearInterval(idCargaListadoFuncionariosLC);
		cambiarClase(columna,'nombreColumna');
	}
}

function cerrarSubirArvhivo(){
	document.getElementById("divSubirArchivo").style.display = "none";
	document.getElementById("cubreVentanaPersonalLC").style.display = "none";
}

function aceptarImagenDocumento(){
	if (document.getElementById("archivo").value != "") document.getElementById("nombreArchivoSubir").innerHTML = document.getElementById("archivo").value;
	cerrarSubirArvhivo();
}

function habilitarBotonAdjuntar(){
	document.getElementById("archivo").value = "";
	document.getElementById("nombreArchivoSubir").innerHTML = '<input type="button" id="btnGuardarArchivo" value="ADJUNTAR ARCHIVO" onClick="adjuntarArchivo()" />';
	document.getElementById("archivoEnServidor").value = "";
}

function habilitarBotonAcciones(guardar, eliminar, adjuntar){
	document.getElementById("btnGuardarFicha").disabled =  (guardar) ? (document.getElementById("permisoEscritura").value) ? false : true : true;
	document.getElementById("btnEliminarFicha").disabled =  (eliminar) ? (document.getElementById("permisoEscritura").value) ? false : true : true;
	(adjuntar) ? habilitarBotonAdjuntar() : null;
}

function sinCaracteres(keys) {
	var out = '';
    var filtro = '<>"';
    for (var i=0; i<keys.length; i++)
       if (filtro.indexOf(keys.charAt(i)) == -1) 
	     out += keys.charAt(i);
    return out;
}