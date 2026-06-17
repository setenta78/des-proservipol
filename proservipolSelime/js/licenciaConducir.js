function licenciaMunicipal(){
	
	if (document.getElementById("optionMunicipal").checked){
		
		if (document.getElementById("optionNoTiene").checked) document.getElementById("optionNoTiene").click();
		
		
		
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
		
		document.getElementById("btnGuardarArchivo").disabled	= "";
		
	} else {
		
		if (document.getElementById("optionSemep").checked) document.getElementById("optionSemep").click();
		
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
		
		document.getElementById("btnGuardarArchivo").disabled	= "true"; 
	}
	
}

function licenciaSemep(){
	
	if (document.getElementById("optionSemep").checked){
		
		if (document.getElementById("optionNoTiene").checked) document.getElementById("optionNoTiene").click();
		if (!document.getElementById("optionMunicipal").checked) document.getElementById("optionMunicipal").click();
		
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
		
		document.getElementById("btnGuardarArchivo").disabled	= "";
		
	} else {
		
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

function licenciaRechazada(){
	
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
	
}


function noTieneLicencia(){
	if (document.getElementById("optionNoTiene").checked){
		if (document.getElementById("optionMunicipal").checked) document.getElementById("optionMunicipal").click();
		if (document.getElementById("optionSemep").checked) document.getElementById("optionSemep").click();
		
		document.getElementById("btnGuardarArchivo").disabled	= "";
	} else {
		document.getElementById("btnGuardarArchivo").disabled	= "true";
	}
}


function seleccionaClaseLicenciaMunicipal(){
	moverDatos('selClaseMunicipalOpciones','selClaseMunicipalOpcionesSeleccionadas');
	ordenar(document.getElementById('selClaseMunicipalOpcionesSeleccionadas'));
	
	if (document.getElementById('selClaseMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selClaseMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "";
}	

function quitaSeleccionClaseLicenciaMunicipal(){
	moverDatos('selClaseMunicipalOpcionesSeleccionadas','selClaseMunicipalOpciones');
	ordenar(document.getElementById('selClaseMunicipalOpciones'));
	
	if (document.getElementById('selClaseMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaClaseLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selClaseMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionClaseLicenciaMunicipal').disabled = "";
}	


function seleccionaRestriccionLicenciaMunicipal(){
	moverDatos('selRestriccionMunicipalOpciones','selRestriccionMunicipalOpcionesSeleccionadas');
	ordenar(document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas'));
	
	if (document.getElementById('selRestriccionMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "";
}	

function quitaSeleccionRestriccionLicenciaMunicipal(){
	moverDatos('selRestriccionMunicipalOpcionesSeleccionadas','selRestriccionMunicipalOpciones');
	ordenar(document.getElementById('selRestriccionMunicipalOpciones'));
	
	if (document.getElementById('selRestriccionMunicipalOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionLicenciaMunicipal').disabled = "";
	
	if (document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionLicenciaMunicipal').disabled = "";
}	


function seleccionaTipoVehiculoSemep(){
	moverDatos('selTipoVehiculoSemepOpciones','selTipoVehiculoSemepOpcionesSeleccionadas');
	ordenar(document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas'));
	
	if (document.getElementById('selTipoVehiculoSemepOpciones').length == 0) document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "";
	
	if (document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "";
}	

function quitaSeleccionTipoVehiculoSemep(){
	moverDatos('selTipoVehiculoSemepOpcionesSeleccionadas','selTipoVehiculoSemepOpciones');
	ordenar(document.getElementById('selTipoVehiculoSemepOpciones'));
	
	if (document.getElementById('selTipoVehiculoSemepOpciones').length == 0) document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnSeleccionaTipoVehiculoSemep').disabled = "";
	
	if (document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionTipoVehiculoSemep').disabled = "";
}	


function seleccionaRestriccionSemep(){
	moverDatos('selRestriccionSemepOpciones','selRestriccionSemepOpcionesSeleccionadas');
	ordenar(document.getElementById('selRestriccionSemepOpcionesSeleccionadas'));
	
	if (document.getElementById('selRestriccionSemepOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionSemep').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionSemep').disabled = "";
	
	if (document.getElementById('selRestriccionSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "";
}	

function quitaSeleccionRestriccionSemep(){
	moverDatos('selRestriccionSemepOpcionesSeleccionadas','selRestriccionSemepOpciones');
	ordenar(document.getElementById('selRestriccionSemepOpciones'));
	
	if (document.getElementById('selRestriccionSemepOpciones').length == 0) document.getElementById('btnSeleccionaRestriccionSemep').disabled = "true";
	else document.getElementById('btnSeleccionaRestriccionSemep').disabled = "";
	
	if (document.getElementById('selRestriccionSemepOpcionesSeleccionadas').length == 0) document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "true";
	else document.getElementById('btnQuitaSeleccionRestriccionSemep').disabled = "";
}	


function funcionarioLicenciaConducir(){
	
	var codigoFuncionario = document.getElementById("textCodigoFuncionario").value;	
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlDatosFuncionario.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigoFuncionario)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				  = objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			  = "";
				var apellidoPaterno		  = "";
				var apellidoMaterno		  = "";
				var primerNombre	 	  = "";
				var segundoNombre	 	  = "";
				var escalafon	 		  = "";
				var grado		 		  = "";
				var cargo		 		  = "";
				var desCargo			  = "";
				var cuadranteCargo		  = "";
				var unidadFuncionario	  = "";
				var unidadUsuario		  = "";
				var descUnidadFuncionario = "";
				var cargoFechaDesde		  = "";
				var codigoUnidadAgregado  = "";
				var desUnidadAgregado  	  = "";
								
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo	 		  		= xml.getElementsByTagName('codigo')[i].text;
					apellidoPaterno	  		= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellidoMaterno    		= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre 	  		= xml.getElementsByTagName('nombre')[i].text;
					segundoNombre 	  		= xml.getElementsByTagName('nombre2')[i].text;
					grado		 	  		= xml.getElementsByTagName('grado')[i].text;
					desCargo				= xml.getElementsByTagName('cargo')[i].text;
					desUnidadAgregado 		= xml.getElementsByTagName('unidadAgregado')[i].text;
					unidadFuncionario 		= xml.getElementsByTagName('codigoUnidad')[i].text;
										
					document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
					
					
					document.getElementById("idFuncionario").value				= codigo;
					document.getElementById("textGrado").value					= grado;
					document.getElementById("textNombreCompleto").value			= apellidoPaterno + " " + apellidoMaterno +", " + primerNombre + " " + segundoNombre;
					document.getElementById("textCargoActual").value 			= desCargo;
					
					alert(document.getElementById("unidadUsuario").value + " == " + unidadFuncionario);
					
					//document.getElementById("textApellidoMaterno").value 		= apellifoMaterno;
					//document.getElementById("textPrimerNombre").value 	 		= primerNombre;
					//document.getElementById("textSegundoNombre").value 	 		= segundoNombre;
					//document.getElementById("codigoUnidadAgregado").value 	 	= codigoUnidadAgregado;
					//document.getElementById("textUnidadAgregado").value 	 	= desUnidadAgregado;
					//document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					//document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					//document.getElementById("codCuadranteBaseDatos").value 		= cuadranteCargo;
					
					
					//alert(desCargo);
					
					
			} 
		}
	}
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
	
	leeDatosLCFuncionario(codigoFuncionario);
	
	if(subio == 1){
		
		//guardarDatosArchivo(codigoFuncionario, tipo, nombreArchivo);
		alert("EL ARCHIVO FUE GRABADO EN EL SERVIDOR SIN PROBLEMAS .......  ");
	}
	
	
	
}


function guardarDatosArchivo(codigoFuncionario, tipo, nombreArchivo){
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	
	//alert("codigoFuncionario="+codigoFuncionario+"&tipo="+tipo+"&nombreArchivo="+nombreArchivo);
	
	
	objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlDatosArchivo.php",true);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&tipo="+tipo+"&nombreArchivo="+nombreArchivo));
			
	//alert(objHttpXMLLicenciasConducir.responseText);		
}


function eliminarDatosArchivo(codigoFuncionario, tipo, nombreArchivo){
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	
	//alert("codigoFuncionario="+codigoFuncionario+"&tipo="+tipo+"&nombreArchivo="+nombreArchivo);
	
	
	objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlDatosArchivoBorrar.php",false);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&tipo="+tipo+"&nombreArchivo="+nombreArchivo));
			
	//alert(objHttpXMLLicenciasConducir.responseText);		
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
		
		//alert(municipalFechaUltimoControl);
		//alert(municipalFechaProximoControl);
		var comparaFechaControles = comparaFecha(municipalFechaUltimoControl,municipalFechaProximoControl);
		if (comparaFechaControles == 1 || comparaFechaControles == 0){
			alert("LA FECHA DEL PROXIMO CONTROL DE RENOVACION DE LICENCIA DE CONDUCIR, NO PUEDE SER MENOR O IGUAL QUE LA FECHA DE ULTIMO CONTROL.");
			document.getElementById("textFechaProximoControlMunicipal").value = "";
			document.getElementById("textFechaProximoControlMunicipal").focus();
			return false;  
		}
		
		var cantidadDeDias = cantidadDeDiasEntre(municipalFechaUltimoControl,municipalFechaProximoControl);
		if (cantidadDeDias < 365){
			var confirmaDiasEntreFechasMunicipal = confirm("ATENCION:\n\nLA FECHA DEL PROXIMO CONTROL DE RENOVACION DE LICENCIA DE CONDUCIR INGRESADA POR UD. ES MENOR DE UN AÑO DESDE LA FECHA DE ULTIMO CONTROL.\n\n¿ES CORRECTO? ¿DESEA CONTINUAR?");
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
			var semepFechaHabilitacion			= document.getElementById("textFechaHabilitacionSemep").value; 
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
					var confirmaDiasEntreFechasSemep = confirm("ATENCION:\n\nLA FECHA DE RENOVACION DE LA LICENCIA SEMEP INGRESADA POR UD. ES MENOR DE UN AÑO DESDE LA FECHA HABILITACION.\n\n¿ES CORRECTO? ¿DESEA CONTINUAR?");
				 	if (!confirmaDiasEntreFechasSemep)	{
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
	
	
	if (document.getElementById("optionNoTiene").checked){ 
			var archivoActa			= document.getElementById("archivo").value; 
						
			if (archivoActa == ""){
				alert("DEBE ADJUNTAR ARCHIVO DE ACTA ...     ");
				return false;                
			}
		
	}
	
	return true;
	
}


function guardarDatosLicenciaConducir(){
	
	var validacionOk = validaDatosLicenciaConducir();
	
	//alert(validacionOk);
	
	if (validacionOk){
		
			//if (document.getElementById("archivo").value != "") subirArchivo();   
			
			if (document.getElementById("archivoEnServidor").value != "") eliminarDatosArchivo(document.getElementById("textCodigoFuncionario").value, document.getElementById("tipoArchivoEnServidor").value, document.getElementById("archivoEnServidor").value)
			if (document.getElementById("archivo").value == "" && document.getElementById("archivoEnServidor").value != "" ) document.getElementById("archivo").value = document.getElementById("archivoEnServidor").value;
			if (document.getElementById("archivo").value != "" || document.getElementById("archivoEnServidor").value != "") subirArchivo(); 
			  
		
			var codigoFuncionario				= document.getElementById("textCodigoFuncionario").value;    
			var codigoUnidad					= document.getElementById("unidadUsuario").value;    
			
			var municipalComuna					= document.getElementById("selMunicipalidad").value; 
			var municipalNumero					= document.getElementById("textNumeroLicenciaMunicipal").value; 
			var municipalFechaUltimoControl		= document.getElementById("textFechaUltimoControlMunicipal").value; 
			var municipalFechaProximoControl	= document.getElementById("textFechaProximoControlMunicipal").value; 
			var municipalObservaciones			= document.getElementById("textObservacionesMunicipal").value; 
			
			
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
			
			
			var semepFechaHabilitacion			= document.getElementById("textFechaHabilitacionSemep").value; 
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
			
			
			var arrayMunicipalClaseParametro 			= php_serialize(arrayMunicipalClase);
			var aarrayMunicipalRestriccionParametro 	= php_serialize(arrayMunicipalRestriccion);
			var arraySemepVehiculoAutorizadoParametro 	= php_serialize(arraySemepVehiculoAutorizado);
			var arraySemepRestriccionParametro 			= php_serialize(arraySemepRestriccion);
			
			
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
				if(objHttpXMLLicenciasConducir.readyState == 4)
				{       
					//alert(objHttpXMLLicenciasConducir.responseText);
					if (objHttpXMLLicenciasConducir.responseText != "VACIO"){
						//alert(objHttpXMLLicenciasConducir.responseText);		
						var xml = objHttpXMLLicenciasConducir.responseXML.documentElement;
						for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
							var codigo = xml.getElementsByTagName('resultado')[i].text;
							if (codigo == 1) {
								
								//document.getElement	ById("mensajeGuardando").style.display = "none";
								alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
								
								//top.cerrarVentana();
								//idCargaListadoServicios = setInterval("cerrarVentanaLicenciaConducir()",1000);
								//subirArchivo();		
								
								top.leeFuncionariosLicenciasConducir(codigoUnidad,'','','');
								top.cerrarVentana();
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
						}
					}
				}
			}
			
			
			
	}
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
	
	//alert(parametros);
	
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
							var codigo = xml.getElementsByTagName('resultado')[i].text;
							if (codigo == 1) {
										
								//document.getElement	ById("mensajeGuardando").style.display = "none";
										alert('LOS DATOS FUERON BORRADOS CON EXITO A LA BASE DE DATOS ......        ');
										
										//top.cerrarVentana();
										//idCargaListadoServicios = setInterval("cerrarVentanaLicenciaConducir()",1000);
										//subirArchivo();		
										
										top.leeFuncionariosLicenciasConducir(codigoUnidad,'','','');
										top.cerrarVentana();
									}
									else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
								}
							}
						}
			}

}


function cerrarVentanaLicenciaConducir(){
	//if (top.cargaListadoServicios == 1){
		//clearInterval(idCargaListadoServicios);
		 top.cerrarVentana();
	//}
}

var cargaListadoFuncionariosLC;
function leeFuncionariosLicenciasConducir(unidad, campo, sentido){

	cargaListadoFuncionariosLC = 0;
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios y Licencias de Conducir ......</td>";
    
	objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlListaLicenciasDeConducir.php",true);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI("codigoUnidad="+unidad+"&campo="+campo+"&sentido="+sentido));  
	
	objHttpXMLLicenciasConducir.onreadystatechange=function()
	{
		//alert(objHttpXMLLicenciasConducir.readyState);
		if(objHttpXMLLicenciasConducir.readyState == 4)
		{       
			//alert(objHttpXMLLicenciasConducir.responseText);
			if (objHttpXMLLicenciasConducir.responseText != "VACIO"){
				//alert(objHttpXMLLicenciasConducir.responseText);		
				var xml 				= objHttpXMLLicenciasConducir.responseXML.documentElement;
				var codigo	 			= "";
				var nombre	 			= "";
				var grado		 		= "";
				var cargo		 		= "";
				var cuadrante			= "";
				var unidadAgregado		= "";
				var fechaControlLM		= "";
				var fechaRenovacionLS   = "";
				var comunaMunicipal		= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				var tieneLicencia	    = "";
				var archivoLicencia		= "";
				
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					
					noTieneLicencia = "";
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 		 	= xml.getElementsByTagName('codigo')[i].text;
					nombre	 		 	= xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					grado		 	 	= xml.getElementsByTagName('grado')[i].text;
					cargo		 	 	= xml.getElementsByTagName('cargo')[i].text;
					cuadrante		 	= xml.getElementsByTagName('cuadrante')[i].text;
					fechaControlLM	 	= xml.getElementsByTagName('fechaControlLCMunicipal')[i].text;
					fechaRenovacionLS 	= xml.getElementsByTagName('fechaControlLCSemep')[i].text;		
					
					
					tieneLicencia 		= xml.getElementsByTagName('tieneLicencia')[i].text;		
					archivoLicencia 	= xml.getElementsByTagName('archivoLicencia')[i].text;							
					
						
					
					comunaMunicipal		= xml.getElementsByTagName('comuna')[i].text;					
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					if (fechaControlLM != ""){
						var mostrarFechaControlLM = fechaControlLM; // + " (" + comunaMunicipal + ")";
					} else {
						var mostrarFechaControlLM = "";
					}
						
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('LICENCIA DE CONDUCIR ... ', '900', '537','fichaPersonalLicenciaConducir.php?codigoFuncionario="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					//if (cargo == "TRASLADADO") cargo = "";
					//if (cuadrante != "") cargo += " "+cuadrante;
					//if (unidadAgregado != "") cargo += ", "+unidadAgregado;
					
					if (cargo.length > 39) {
						var cargoMuestra = cargo.substr(0,37) + " ...";
						var mostrarEtiqueta = " title='"+cargo+"'";
					} else {
						var cargoMuestra = cargo;
						var mostrarEtiqueta = "";
					}
					
					//var tipoLicenciaMostrar;
					//var fechaLicenciaMOstrar;
					//
					//if (fechaRenovacionLS != "") {
					//	tipoLicenciaMostrar = "SEMEP";
					//	fechaLicenciaMOstrar = fechaRenovacionLS;
					//} else {
					//	if (fechaControlLM != "") {
					//		tipoLicenciaMostrar = "MUNICIPAL";               
					//		fechaLicenciaMOstrar = fechaControlLM;    
					//	} else {
					//		tipoLicenciaMostrar = "---";               
					//		fechaLicenciaMOstrar = "---";
					//	}
					//}   
					
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
					
					//alert (tieneLicencia);
					if (tieneLicencia == "NO TIENE") {
						//imagenDocumento = "<img src='./img/adjunto.jpg' WIDTH='10' HEIGHT='10'>&nbsp;<a href='./archivos/"+archivoLicencia+"' title='"+archivoLicencia+"'target='_blank'>Ver</a>";
						imagenDocumento = "<img src='./img/adjunto.jpg' WIDTH='10' HEIGHT='10'>";
						columnaDatosLicencia ="<td colspan='2' width='26%'><div id='valorColumna' align='center'>NO TIENE LICENCIA CONDUCIR</div></td>"; 
					} else {
						if (tieneLicencia != ""){
							//imagenDocumento = "<img src='./img/adjunto.jpg' WIDTH='10' HEIGHT='10'>&nbsp;<a href='./archivos/"+archivoLicencia+"' title='"+archivoLicencia+"'target='_blank'>Ver</a>";
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
					
									
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='38%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoFuncionarios += "<td width='16%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
					//listadoFuncionarios += "<td width='28%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+cargoMuestra+"</div></td>";
					//listadoFuncionarios += "<td width='13%'><div id='valorColumna'>"+mostrarFechaControlLM + "</div></td>";
					//listadoFuncionarios += "<td width='13%'><div id='valorColumna'>"+fechaRenovacionLS+"</div></td>";
					listadoFuncionarios += columnaDatosLicencia;
					
					
					listadoFuncionarios += "<td width='6%'><div id='valorColumna' align='center'>"+imagenDocumento+"</div></td>";
			
					listadoFuncionarios += "</tr>";   
					
					//alert(listadoFuncionarios);
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionariosLC = 1;
			}
		}
	}
}

var idCargaListadoFuncionariosLC;
function cambiaOrdenListaLicenciaConducir(columna, atributo, sentido, unidad){
	var nuevoSentido = "";  
	
	
	//alert(columna+" - "+atributo+" - "+sentido+" - "+unidad);
	
	
	if (sentido == "desc") nuevoSentido = "asc"; 
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	switch(atributo){
		case "grado":                                    
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColGrado").innerHTML  = "GRADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colGrado").onmousedown   = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};  
			break;
			
		case "nombre":                                    
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown  = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};  
			break;
			
		case "codigo":                                    
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigo").onmousedown  = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};  
			break;
		
		case "licenciaMunicipal":                                    
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColLicenciaMunicipal").innerHTML  = "MUNICIPAL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colLicenciaMunicipal").onmousedown   = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};  
			break;
			
		case "licenciaSemep":                                    
			leeFuncionariosLicenciasConducir(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColLicenciaSemep").innerHTML  = "SEMEP&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colLicenciaSemep").onmousedown   = function(){cambiaOrdenListaLicenciaConducir(columna, atributo, nuevoSentido, unidad)};  
			break;
	}
	
	idCargaListadoFuncionariosLC = setInterval("tituloColumnaNormalLC("+columna.id+")",500);
}

function tituloColumnaNormalLC(columna){
	if (cargaListadoFuncionariosLC == 1){
		//alert(columna);
		clearInterval(idCargaListadoFuncionariosLC);
		cambiarClase(columna,'nombreColumna');
	}		
}




//idCargaDatosFuncionariosLC = setInterval("tituloColumnaNormalLC("+columna.id+")",500);
function leeDatosLCFuncionario(codigoFuncionario){

	cargaDatosFuncionariosLC = 0;
	
	
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left 	 = "120px";
	document.getElementById("mensajeCargando").style.top     = "250px";
	
	
	
	var objHttpXMLLicenciasConducir = new AJAXCrearObjeto();
	
    objHttpXMLLicenciasConducir.open("POST","./xml/xmlLicenciaConducir/xmlDatosLicenciasDeConducirFuncionario.php",true);
	objHttpXMLLicenciasConducir.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicenciasConducir.send(encodeURI("codigoFuncionario="+codigoFuncionario));  
	
	objHttpXMLLicenciasConducir.onreadystatechange=function()
	{
		//alert(objHttpXMLLicenciasConducir.readyState);
		if(objHttpXMLLicenciasConducir.readyState == 4)
		{       
			//alert(objHttpXMLLicenciasConducir.responseText);
			if (objHttpXMLLicenciasConducir.responseText != "VACIO"){
				//alert(objHttpXMLLicenciasConducir.responseText);		
				var xml 							= objHttpXMLLicenciasConducir.responseXML.documentElement;
				
				var codigo	 						= "";
				var nombre	 						= "";
				var grado		 					= "";
				var cargo		 					= "";
				
				var numeroLCMunicipal				= "";
				var codigoComuna					= "";
				var fechaUltimoControlLCMunicipal	= "";
				var fechaControlLCMunicipal			= "";
				var observacionesLCMunicipal		= "";
					
				var codigoEvaluacion   				= "";
				var fechaHabilitacionLCSemep   		= "";
				var fechaRenovacionLCSemep   		= "";
				var observacionesLCSemep   			= "";
				
				var tieneLicenciaConducir			= "";
				var archivoLicenciaConducir			= "";
				
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
														
					codigo	 		 				= xml.getElementsByTagName('codigo')[i].text;
					nombre	 		 				= xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					grado		 	 				= xml.getElementsByTagName('grado')[i].text;
					cargo		 	 				= xml.getElementsByTagName('cargo')[i].text;
					
					tieneLicenciaConducir		 	= xml.getElementsByTagName('tieneLicencia')[i].text;
					archivoLicenciaConducir		 	= xml.getElementsByTagName('archivoLicencia')[i].text;
					
					numeroLCMunicipal		 	 	= xml.getElementsByTagName('numeroLCMunicipal')[i].text;
					codigoComuna		 	 		= xml.getElementsByTagName('codigoComuna')[i].text;
					fechaUltimoControlLCMunicipal	= xml.getElementsByTagName('fechaUltimoControlLCMunicipal')[i].text;
					fechaControlLCMunicipal		 	= xml.getElementsByTagName('fechaControlLCMunicipal')[i].text;
					observacionesLCMunicipal		= xml.getElementsByTagName('observacionesLCMunicipal')[i].text;
					
					codigoEvaluacion		 	 	= xml.getElementsByTagName('codigoEvaluacion')[i].text;
					fechaHabilitacionLCSemep		= xml.getElementsByTagName('fechaHabilitacionLCSemep')[i].text;
					fechaRenovacionLCSemep		 	= xml.getElementsByTagName('fechaRenovacionLCSemep')[i].text;
					observacionesLCSemep			= xml.getElementsByTagName('observacionesLCSemep')[i].text;
					
					clases							= xml.getElementsByTagName('clasesLM')[i].text;
					
					
					if (fechaRenovacionLCSemep == "00-00-0000") fechaRenovacionLCSemep = "";
					
					if (codigoComuna == "") codigoComuna = 0;
					
					document.getElementById("textCodigoFuncionario").value  = codigo;
					document.getElementById("textGrado").value  			= grado;
					document.getElementById("textNombreCompleto").value  	= nombre;
					document.getElementById("textCargoActual").value  		= cargo;
					
					if (numeroLCMunicipal != "") document.getElementById("optionMunicipal").checked = true;
					licenciaMunicipal();
					
					document.getElementById("selMunicipalidad").value  					= codigoComuna;
					//if (codigoComuna != "0") document.getElementById("selMunicipalidad").readOnly = true;
					
					
					document.getElementById("textNumeroLicenciaMunicipal").value  		= numeroLCMunicipal;
					if (numeroLCMunicipal != "") document.getElementById("textNumeroLicenciaMunicipal").readOnly = true;
					
					
					
					document.getElementById("textFechaUltimoControlMunicipal").value  	= fechaUltimoControlLCMunicipal;
					document.getElementById("textFechaProximoControlMunicipal").value  	= fechaControlLCMunicipal;
					document.getElementById("textObservacionesMunicipal").value  		= observacionesLCMunicipal;
					
					
					
					if (fechaHabilitacionLCSemep != "") {
						document.getElementById("optionSemep").checked = true;
						document.getElementById("imagenCalendarioHabilitacionSemep").onclick = "alert('NO SE PUEDE MODIFICAR ESTA FECHA ...')";

					}
					licenciaSemep();

					document.getElementById("selEvaluacionSemep").value  				= codigoEvaluacion;
					document.getElementById("textFechaHabilitacionSemep").value  		= fechaHabilitacionLCSemep;
					document.getElementById("textFechaRenovacionSemep").value  			= fechaRenovacionLCSemep;
					document.getElementById("textObservacionesSemep").value  			= observacionesLCSemep;
					
					document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
					
					if (tieneLicenciaConducir == "NO TIENE") {
						document.getElementById("optionNoTiene").checked = true;
						//document.getElementById("nombreArchivoSubir").innerHTML = archivoLicenciaConducir;
						
					}
					
					if (archivoLicenciaConducir != "") document.getElementById("nombreArchivoSubir").innerHTML = archivoLicenciaConducir;   
					
					if (archivoLicenciaConducir != "") {
						document.getElementById("archivoEnServidor").value = archivoLicenciaConducir;
						document.getElementById("tipoArchivoEnServidor").value = tieneLicenciaConducir;
					} else {
						document.getElementById("archivoEnServidor").value = "";
						document.getElementById("tipoArchivoEnServidor").value = "";
					}
					
					
					//alert(xml.getElementsByTagName('codigoClase').length);
					
                   
                   
                   
                   	for(var k=0;k<document.getElementById("selClaseMunicipalOpciones").length;k++){
                    	for(var j=0;j<xml.getElementsByTagName('codigoClase').length;j++){	
                    		//alert(document.getElementById("selClaseMunicipalOpciones")[k].value + " == " + xml.getElementsByTagName('codigoClase')[j].text);
                    		if (document.getElementById("selClaseMunicipalOpciones")[k].value == xml.getElementsByTagName('codigoClase')[j].text){
                    			document.getElementById("selClaseMunicipalOpciones")[k].selected=true;
                    			seleccionaClaseLicenciaMunicipal();
                    			
                    			
                    			//moverDatos('selClaseMunicipalOpciones','selClaseMunicipalOpcionesSeleccionadas');
								//ordenar(document.getElementById('selClaseMunicipalOpcionesSeleccionadas'));
                    		} 
                    	}	
                   	}
                   	
                   	
                   	for(var k=0;k<document.getElementById("selRestriccionMunicipalOpciones").length;k++){
                   		for(var j=0;j<xml.getElementsByTagName('codigoRestriccionLM').length;j++){	
                    		//alert(document.getElementById("selClaseMunicipalOpciones")[k].value + " == " + xml.getElementsByTagName('codigoClase')[j].text);
                    		if (document.getElementById("selRestriccionMunicipalOpciones")[k].value == xml.getElementsByTagName('codigoRestriccionLM')[j].text){
                    			document.getElementById("selRestriccionMunicipalOpciones")[k].selected=true;
                    			seleccionaRestriccionLicenciaMunicipal()
                    			//moverDatos('selRestriccionMunicipalOpciones','selRestriccionMunicipalOpcionesSeleccionadas');
								//ordenar(document.getElementById('selRestriccionMunicipalOpcionesSeleccionadas'));
                    		} 
                    	}	
                   	}
                   	
                   	for(var k=0;k<document.getElementById("selTipoVehiculoSemepOpciones").length;k++){
                   		for(var j=0;j<xml.getElementsByTagName('codigoVehiculoAutorizado').length;j++){	
                    		//alert(document.getElementById("selClaseMunicipalOpciones")[k].value + " == " + xml.getElementsByTagName('codigoClase')[j].text);
                    		if (document.getElementById("selTipoVehiculoSemepOpciones")[k].value == xml.getElementsByTagName('codigoVehiculoAutorizado')[j].text){
                    			document.getElementById("selTipoVehiculoSemepOpciones")[k].selected=true;
                    			seleccionaTipoVehiculoSemep();
                    			//moverDatos('selTipoVehiculoSemepOpciones','selTipoVehiculoSemepOpcionesSeleccionadas');
								//ordenar(document.getElementById('selTipoVehiculoSemepOpcionesSeleccionadas'));
                    		} 
                    	}	
                   	}
                   	
                   	
                   	for(var k=0;k<document.getElementById("selRestriccionSemepOpciones").length;k++){
                   		for(var j=0;j<xml.getElementsByTagName('codigoRestriccionLS').length;j++){	
                    		//alert(document.getElementById("selClaseMunicipalOpciones")[k].value + " == " + xml.getElementsByTagName('codigoClase')[j].text);
                    		if (document.getElementById("selRestriccionSemepOpciones")[k].value == xml.getElementsByTagName('codigoRestriccionLS')[j].text){
                    			document.getElementById("selRestriccionSemepOpciones")[k].selected=true;
                    			seleccionaRestriccionSemep();
                    			
                    			//moverDatos('selRestriccionSemepOpciones','selRestriccionSemepOpcionesSeleccionadas');
								//ordenar(document.getElementById('selRestriccionSemepOpcionesSeleccionadas'));
                    		} 
                    	}	
                   	}
                    

					
				}

				licenciaRechazada();
				document.getElementById("mensajeCargando").style.display = "none"; 
				//document.getElementById("cubreVentanaPersonalLC").style.display = "";
				cargaDatosFuncionariosLC = 1;
			}
		}
	}
	
	
}

function adjuntarArchivo(){
	
	//top.abrirVentana('ADJUNTAR ARCHIVO ... ', '600', '100','adjuntarArchivo.php','','','35','5');
	
	document.getElementById("cubreVentanaPersonalLC").style.display = "";
	document.getElementById("divSubirArchivo").style.display = "";
	document.getElementById("divSubirArchivo").style.left 	 = "120px";
	document.getElementById("divSubirArchivo").style.top     = "250px";
	
	
}

function cerrarSubirArvhivo(){
		document.getElementById("divSubirArchivo").style.display = "none";
		document.getElementById("cubreVentanaPersonalLC").style.display = "none";
}


function subirArchivo(){
	
	//var archivo = document.getElementById("archivo");
	//
	//var xhr = new AJAXCrearObjeto();
	//
	//xhr.open('POST','adjuntarArchivoSubir.php');
    //
	//xhr.setRequestHeader("Cache-Control", "no-cache");
	//xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	//xhr.setRequestHeader("X-File-Name", archivo.name);
    //
    //
	//xhr.send(archivo);
	
	if (document.getElementById("optionMunicipal").checked) document.getElementById("tipoSubir").value 	= "MUNICIPAL";
	if (document.getElementById("optionSemep").checked) document.getElementById("tipoSubir").value 		= "SEMEP";
	if (document.getElementById("optionNoTiene").checked) document.getElementById("tipoSubir").value 	= "NO TIENE";
		
		
	//alert(document.getElementById("tipoSubir").value);	
	
	
	
	//alert(document.getElementById("textCodigoFuncionario").value);
	//alert(document.getElementById("tipoSubir").value);
	//alert(document.getElementById("archivo").value);
	
	var rutaArchivo = document.getElementById("archivo").value;
	var arrayRutaArchivo = rutaArchivo.split("\\");
	var cantidadArreglo = arrayRutaArchivo.length;
	var nombreDelArchivo = arrayRutaArchivo[cantidadArreglo-1];
	//alert(nombreDelArchivo);
	
	if (nombreDelArchivo == "") nombreDelArchivo = document.getElementById("archivoEnServidor").value;
	
	guardarDatosArchivo(document.getElementById("textCodigoFuncionario").value, document.getElementById("tipoSubir").value, nombreDelArchivo)
	
	
	document.formSubeArchivo.submit();
	
}


function aceptarImagenDocumento(){
	if (document.getElementById("archivo").value != "") document.getElementById("nombreArchivoSubir").innerHTML = document.getElementById("archivo").value;
	cerrarSubirArvhivo();	
}
					
