var cargoFuncionariosDisponibles = 0;
function selectFuncionariosDisponibles(unidad, nombreObjeto, soloSinServicio){

	var fechaServicio 			 = document.getElementById('textFechaServicio').value;
	var opcionServicio  		 = document.getElementById("selServicio").value;
	var tipoServicio 			 = opcionServicio.substr(0,1);
	var servicio  				 = opcionServicio.substr(1,opcionServicio.length);
	var correlativo				 = document.getElementById("correlativoServicio").value;
	cargoFuncionariosDisponibles = 0;

	if (soloSinServicio == "1") correlativo = "-1";

	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();

	//div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";

    var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+tipoServicio+"&servicio="+servicio+"&correlativo="+correlativo;
    //alert(parametros);
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlListaFuncionariosDisponibles.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));

	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var nombre	 			= "";
				var grado		 		= "";
				var puntero				= 0;


				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					var mostrar		 = 1;
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					grado		 	 = xml.getElementsByTagName('grado')[i].text;

					var descripcion	 = nombre + " (" + grado + ")";

					//alert(document.getElementById('personalAsignado').length);
					for (k=0;k<document.getElementById('personalAsignado').length;k++){
						if (codigo == document.getElementById('personalAsignado').options[k].value) mostrar = 0;
					}

					if (mostrar == 1){
						var datosOpcion = new Option(descripcion, codigo, "", "");
						document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						puntero++;
					}
				}
			} else {
				document.getElementById(nombreObjeto).length = null;
				alert("NO EXISTEN FUNCIONARIOS PARA ASIGNAR A ESTE SERVICIO.   ");
			}

			cargoFuncionariosDisponibles = 1;
			habilitarBotonesAgregarQuitar();
		}
	}
}

function filtrarFuncionariosDisponibles(unidad){
	//alert(document.getElementById("cbFuncionariosSinServicio").checked );
	if (document.getElementById("cbFuncionariosSinServicio").checked) selectFuncionariosDisponibles(unidad,'funcionariosDisponibles','1');
	else selectFuncionariosDisponibles(unidad,'funcionariosDisponibles','');
}


function asignarPersonal(){


	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
  //alert(servicio);


      moverDatos('funcionariosDisponibles','personalAsignado');
	    ordenar(document.getElementById('personalAsignado'));
      habilitarBotonesAgregarQuitar();


 }

function desasignarPersonal(){
	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);

	if (tipoServicio != "O" && tipoServicio != "F" ) var tipo = "eliminar";
	else var tipo = "";


	//alert(servicio);
	//191, 194, 195, 196, 197, 198, 625


	if(servicio == 191 || servicio == 194 || servicio == 196 || servicio == 197 || servicio == 198 || servicio == 625) verificarFuncionarioJefaturaSupervisionTerreno();
	if (servicio != 142 && servicio != 143 && servicio != 144 && servicio != 145 && servicio != 146 && servicio != 147 && servicio != 148 && servicio != 149 && servicio != 151 && servicio != 152 && servicio != 153) verificarFuncionarioColacion();
	//verificarFuncionarioColacion();
	verificarFuncionarioMedios(tipo);
	moverDatos('personalAsignado','funcionariosDisponibles');
	ordenar(document.getElementById('funcionariosDisponibles'));
	habilitarBotonesAgregarQuitar();
}

//
//	VERIFICA SI LOS FUNCIONARIOS QUE HAN SIDO ASIGNADOS A UN SERVICIO,
//  ESTAN INCLUIDOS EN ALGUN MEDIO DE VIGILANCIA.
//
function verificarFuncionarioMedios(tipo){

	var cantidadFuncionariosAsignados = document.getElementById("personalAsignado").length;
	var funcionariosAsignados = document.getElementById("personalAsignado");
	for (var i=0; i<cantidadFuncionariosAsignados; i++){
		if (funcionariosAsignados.options[i].selected){
			var codFuncionarioAsignado = funcionariosAsignados.options[i].value;
			//alert(codFuncionarioAsignado);
			for (var j=0; j<arrayListaMV.length; j++){
				for (var k=0; k<arrayListaMV[j][4].length; k++){
					//alert(arrayListaMV[j][4][k]);
					if (codFuncionarioAsignado == arrayListaMV[j][4][k]) {
						if (tipo == "eliminar"){
							muestraAccesoriosFuncionario(k);
							eliminarFuncionarioAccesorios();
							listaPesonalAccesorios();
							arrayListaMV[j][6].splice(k,1);
							arrayListaMV[j][4].splice(k,1);
							listaMediosVigilancia();
							//alert(k);

						} else {
							funcionariosAsignados.options[i].selected = false;
							alert(arrayListaMV[j][6][k]+ ", NO SE PUEDE SACAR DEL SERVICIO PORQUE ESTA ASIGNADO A UN MEDIO DE VIGILANCIA. PRIMERO DEBE MODIFICAR EL MEDIO DE VIGILANCIA.");
						}
					}
				}
			}
		}
	}
}

function verificarFuncionarioColacion(){
	var cantidadFuncionariosAsignados = document.getElementById("personalAsignado").length;
	var funcionariosAsignados = document.getElementById("personalAsignado");
	var fechaServicio = document.getElementById("textFechaServicio").value;
	var mensajeFunConColacion = "";
	var unidadServicio = document.getElementById("unidadServicio").value;
	var mensajeConColacion = "";
	//var cantidadServiciosPorFuncionario = "";

	//alert("unidadServicio " + unidadServicio);
	var cantidadServiciosPorFuncionario = buscaTipoDeServiciosPorFuncionario(unidadServicio, fechaServicio, fechaServicio, 'COLACION');

	//alert(cantidadServiciosPorFuncionario);
	//alert("cantidad = " + cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario').length);

	for (var i=0; i<cantidadFuncionariosAsignados; i++){
		var codFuncionarioAsignado = funcionariosAsignados.options[i].value;
        var desFuncionarioAsignado = funcionariosAsignados.options[i].text;
        for(var j=0;j<cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario').length;j++){
        	var codigoFuncionarioCompara 		= cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario')[j].text;
        	var cantidadColacionCompara	 		= cantidadServiciosPorFuncionario.getElementsByTagName('cantidadColaciones')[j].text;
        	var cantidadOtrosServiciosCompara	= cantidadServiciosPorFuncionario.getElementsByTagName('cantidadOtrosServicios')[j].text;
        //alert("Colacion asignada: "+cantidadColacionCompara);
        	if (codigoFuncionarioCompara == codFuncionarioAsignado && cantidadColacionCompara >= 1 && cantidadOtrosServiciosCompara == 1){
        		funcionariosAsignados.options[i].selected = false;
        		mensajeFunConColacion += codFuncionarioAsignado +" - "+desFuncionarioAsignado+" \n";
        		break;
        	}
		}
	}



	if (mensajeFunConColacion != "") {
		mensajeConColacion = "LOS FUNCIONARIOS :\n\n";
		mensajeConColacion += mensajeFunConColacion;
		mensajeConColacion += "\nNO PUEDEN SER QUITADOS DE ESTE SERVICIO PORQUE TIENEN COLACION ASIGNADA.\nDEBE QUITARLES PRIMERO LA COLACION ASIGANDA.";
		alert(mensajeConColacion);
		return true;
	} else {
		return false;
	}
	//return false;


}

function verificarColacion(){
	//alert();

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);


	var cantidadFuncionariosAsignados = document.getElementById("personalAsignado").length;
	var funcionariosAsignados = document.getElementById("personalAsignado");
	var fechaServicio = document.getElementById("textFechaServicio").value;
	var mensajeFunConColacion = "";
	var unidadServicio = document.getElementById("unidadServicio").value;
	var mensajeConColacion = "";

	var cantidadServiciosPorFuncionario = buscaColacionPorFuncionario(unidadServicio, fechaServicio, fechaServicio);


	for (var i=0; i<cantidadFuncionariosAsignados; i++){
		var codFuncionarioAsignado = funcionariosAsignados.options[i].value;
        var desFuncionarioAsignado = funcionariosAsignados.options[i].text;
        for(var j=0;j<cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario').length;j++){

        	var codigoFuncionarioCompara 		= cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario')[j].text;
        	var cantidadColacionCompara	 		= cantidadServiciosPorFuncionario.getElementsByTagName('cantidadColaciones')[j].text;
        	var codigoServicioCompara	      = cantidadServiciosPorFuncionario.getElementsByTagName('codigoServicio')[j].text;

          //alert(cantidadCodigoServiciosCompara);

        	if (codigoFuncionarioCompara == codFuncionarioAsignado && cantidadColacionCompara >= 1 && codigoServicioCompara!=servicio ){
        		funcionariosAsignados.options[i].selected = false;
        		mensajeFunConColacion += codFuncionarioAsignado +" - "+desFuncionarioAsignado+" \n";
        		break;
        	}
		}
	}


	if (mensajeFunConColacion != "") {
		mensajeConColacion = "EL O LOS FUNCIONARIO(S) :\n\n";
		mensajeConColacion += mensajeFunConColacion;
		mensajeConColacion += "\nTIENE(N) COLACION ASIGNADA. \nPOR LO TANTO ESTE SERVICIO NO PODRA SER INGRESADO AL SISTEMA.";
		alert(mensajeConColacion);
		return true;
	} else {
		return false;
	}

}


function verificarFuncionarioJefaturaSupervisionTerreno(){

	var cantidadFuncionariosAsignados 			= document.getElementById("personalAsignado").length;
	var funcionariosAsignados 					= document.getElementById("personalAsignado");
	var fechaServicio 							= document.getElementById("textFechaServicio").value;
	var mensajeFunConJefaturaSupervisionTerreno = "";
	var unidadServicio 							= document.getElementById("unidadServicio").value;
	var mensajeConJefaturaSupervisionTerreno 	= "";
	//var cantidadServiciosPorFuncionario = "";

	//alert("unidadServicio " + unidadServicio);
	var cantidadServiciosPorFuncionario = buscaServiciosJefaturaSupervisionTerrenoPorFuncionario(unidadServicio, fechaServicio, fechaServicio);

	//alert(cantidadServiciosPorFuncionario);
	//alert("cantidad = " + cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario').length);

	for (var i=0; i<cantidadFuncionariosAsignados; i++){
		var codFuncionarioAsignado = funcionariosAsignados.options[i].value;
        var desFuncionarioAsignado = funcionariosAsignados.options[i].text;
        for(var j=0;j<cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario').length;j++){
        	var codigoFuncionarioCompara 				= cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario')[j].text;
        	var cantidadJefaturaServicioTerrenoCompara	= cantidadServiciosPorFuncionario.getElementsByTagName('cantidadSupervisiones')[j].text;
        	if (codigoFuncionarioCompara == codFuncionarioAsignado && cantidadJefaturaServicioTerrenoCompara >= 1){
        		funcionariosAsignados.options[i].selected = false;
        		mensajeFunConJefaturaSupervisionTerreno += codFuncionarioAsignado +" - "+desFuncionarioAsignado+" \n";
        		break;
        	}
		}
	}

	if (mensajeFunConJefaturaSupervisionTerreno != "") {
		mensajeConJefaturaSupervisionTerreno = "LOS FUNCIONARIOS :\n\n";
		mensajeConJefaturaSupervisionTerreno += mensajeFunConJefaturaSupervisionTerreno;
		mensajeConJefaturaSupervisionTerreno += "\nNO PUEDEN SER QUITADOS DE ESTE SERVICIO PORQUE TIENEN SERVICIO \"JEFATURA EN SUPERVISION O TERRENO\" ASIGNADA.\nDEBE QUITARLES PRIMERO ESTE SERVICIO ASIGNADO.";
		alert(mensajeConJefaturaSupervisionTerreno);
		return true;
	} else {
		return false;
	}
	//return false;



}



function habilitarBotonesAgregarQuitar(){
	var cantidadDisponible = document.getElementById('funcionariosDisponibles').length;
	var cantidadAsignado   = document.getElementById('personalAsignado').length;

	if (cantidadDisponible == 0) document.getElementById('Btn_Agregar').disabled = "true";
	else document.getElementById('Btn_Agregar').disabled = "";

	if (cantidadAsignado == 0) document.getElementById('Btn_Quitar').disabled = "true";
	else document.getElementById('Btn_Quitar').disabled = "";


	document.getElementById('tituloPersonalDisponible').innerHTML = "PERSONAL DISPONIBLE (" + cantidadDisponible + ")";
	document.getElementById('tituloPersonalAsignado').innerHTML = "PERSONAL ASIGNADO (" + cantidadAsignado + ")";

}


function irPaginaSiguiente(){

	var resultado 			= true;
	var datosServicios 		= document.getElementById("divDatosServicio").style.visibility;
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaKmsVehiculos 	= document.getElementById("divAsignaKmsVehiculos").style.visibility;
	var asignaArmas 		= document.getElementById("divAsignaArmas").style.visibility;
	var asignaAnimales 		= document.getElementById("divAsignaAnimales").style.visibility;
	var asignaAccesorios	= document.getElementById("divAsignaAccesorios").style.visibility;


	document.getElementById("divDatosServicio").style.visibility		= "hidden";
	document.getElementById("divAsignaFuncionarios").style.visibility	= "hidden";
	document.getElementById("divAsignaVehiculos").style.visibility		= "hidden";
	document.getElementById("divAsignaKmsVehiculos").style.visibility	= "hidden";
	document.getElementById("divAsignaArmas").style.visibility			= "hidden";
	document.getElementById("divAsignaAnimales").style.visibility		= "hidden";
	document.getElementById("divAsignaAccesorios").style.visibility		= "hidden";


	if (datosServicios == "visible") {
		document.getElementById("divAsignaFuncionarios").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
		habilitarBotonesAgregarQuitar();
		habilitarBotonesAgregarQuitarVehiculos();
	}

	if (asignaFuncionarios == "visible") {
		document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}


	if (asignaVehiculos == "visible") {
		if (document.getElementById("vehiculosAsignados").length > 0){
			//cantidadVehiculos();
			document.getElementById("divAsignaKmsVehiculos").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		} else {
			document.getElementById("divAsignaArmas").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		}
	}


	if (asignaKmsVehiculos == "visible") {
		document.getElementById("divAsignaArmas").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}


	if (asignaArmas == "visible") {
		document.getElementById("divAsignaAnimales").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}


	if (asignaAnimales == "visible") {
		document.getElementById("divAsignaAccesorios").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = true;
		if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnFinalizar").disabled = "";
	}
}


function irPaginaAnterior(){

	var resultado 			= true;
	var datosServicios 		= document.getElementById("divDatosServicio").style.visibility;
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaKmsVehiculos 	= document.getElementById("divAsignaKmsVehiculos").style.visibility;
	var asignaArmas 		= document.getElementById("divAsignaArmas").style.visibility;
	var asignaAnimales 		= document.getElementById("divAsignaAnimales").style.visibility;
	var asignaAccesorios	= document.getElementById("divAsignaAccesorios").style.visibility;

	document.getElementById("divDatosServicio").style.visibility		= "hidden";
	document.getElementById("divAsignaFuncionarios").style.visibility	= "hidden";
	document.getElementById("divAsignaVehiculos").style.visibility		= "hidden";
	document.getElementById("divAsignaKmsVehiculos").style.visibility	= "hidden";
	document.getElementById("divAsignaArmas").style.visibility			= "hidden";
	document.getElementById("divAsignaAnimales").style.visibility		= "hidden";
	document.getElementById("divAsignaAccesorios").style.visibility		= "hidden";

	if (asignaFuncionarios == "visible") {
		document.getElementById("divDatosServicio").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled  = true;
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;

	}

	if (asignaVehiculos == "visible") {
		document.getElementById("divAsignaFuncionarios").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}

	if (asignaKmsVehiculos == "visible") {
		document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}

	if (asignaArmas == "visible") {
		if (document.getElementById("vehiculosAsignados").length > 0){
			document.getElementById("divAsignaKmsVehiculos").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		} else {
			document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		}
	}

	if (asignaAnimales == "visible") {
		document.getElementById("divAsignaArmas").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}

	if (asignaAccesorios == "visible") {
		document.getElementById("divAsignaAnimales").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}
}


function validaDatosServicio(){
	//var servicio 			   = document.getElementById("selServicio").value;
	//var servicioExtraordinario = document.getElementById("selTipoExtraordinario").value;
	var descOtroExtraordinario = eliminarBlancos(document.getElementById("textOtroExtraordinario").value);
	var fechaServicio 		   = document.getElementById("textFechaServicio").value;
	var horaInicio 		   	   = document.getElementById("selHoraInicio").value;
	var horaTermino		   	   = document.getElementById("selHoraTermino").value;

	var opcionServicio  	   = document.getElementById("selServicio").value;
	var tipoServicio 		   = opcionServicio.substr(0,1);
	var servicio  			   = opcionServicio.substr(1,opcionServicio.length);

   	var opcionLicencia  	   = document.getElementById("selLicencia").value; //Agregado 30-06-2015
	var tipoLicencia 		   = opcionLicencia.substr(0,1); //Agregado 30-06-2015
	var licencia  			   = opcionLicencia.substr(1,opcionLicencia.length); //Agregado 30-06-2015


	//if (opcionServicio == 0){
	//	alert("DEBE INDICAR SERVICIO ....     ");
	//	document.getElementById("selServicio").focus();
	//	return false;
	//}

    //Validacion modificada 30-06-2015
	if (opcionServicio == 0 && opcionLicencia == 0){
		alert("DEBE INDICAR SERVICIO ....     ");
		document.getElementById("selServicio").focus();
		return false;
	}
    //Validacion agregada el 30-06-2015
    if(opcionServicio == 1 || opcionServicio == 2 || opcionServicio == 3 || opcionServicio == 4){
    	if (opcionLicencia == 0){
		alert("DEBE INDICAR LICENCIA ....     ");
		document.getElementById("selLicencia").focus();
        //alert(opcionLicencia);
		return false;
    	}
    }

	if (servicio == 1100){
		if (servicioExtraordinario == 0){
			alert("DEBE INDICAR QUE TIPO DE SERVICIO EXTRAORDINARIO ...           ");
			document.getElementById("selTipoExtraordinario").focus();
			return false;
		}

		if (servicioExtraordinario == 100 && descOtroExtraordinario == ""){
			alert("DEBE INDICAR QUE OTRO TIPO DE SERVICIO EXTRAORDINARIO ...           ");
			document.getElementById("textOtroExtraordinario").value = "";
			document.getElementById("textOtroExtraordinario").focus();
			return false;
		}
	}


	if (fechaServicio == ""){
		alert("DEBE INDICAR LA FECHA DEL SERVICIO ....     ");
		return false;
	}


	//if (tipoServicio != "N"){
	//	if (horaInicio == 0){
	//		alert("DEBE INDICAR HORA DE INICIO DEL SERVICIO ....     ");
	//		document.getElementById("selHoraInicio").focus();
	//		return false;
	//	}

	//	if (horaTermino == 0){
	//		alert("DEBE INDICAR HORA DE TERMINO DEL SERVICIO ....     ");
	//		document.getElementById("selHoraTermino").focus();
	//		return false;
	//	}

	//	if (servicio == 24 && horaTermino == horaInicio && horaTermino == "00:00" && horaInicio == "00:00"){
	//		alert("AMBAS HORAS, DE INICIO Y TERMINO NO PUEDEN SER 00:00");
	//		document.getElementById("selHoraTermino").focus();
	//		return false;
	//	}


	//}

    	//Modificado 30-06-2015
	if (tipoServicio != "N" && tipoServicio != "1"  && tipoServicio != "2" && tipoServicio != "3" && tipoServicio != "4"){

       //alert(tipoServicio);
       //alert(tipoLicencia);

		if (horaInicio == 0){
			alert("DEBE INDICAR HORA DE INICIO DEL SERVICIO ....     ");
			document.getElementById("selHoraInicio").focus();
			return false;
		}

		if (horaTermino == 0){
			alert("DEBE INDICAR HORA DE TERMINO DEL SERVICIO ....     ");
			document.getElementById("selHoraTermino").focus();
			return false;
		}

		if (servicio == 24 && horaTermino == horaInicio && horaTermino == "00:00" && horaInicio == "00:00"){
			alert("AMBAS HORAS, DE INICIO Y TERMINO NO PUEDEN SER 00:00");
			document.getElementById("selHoraTermino").focus();
			return false;
		}


	}

	return true;
}


function validaDatosAsignaFuncionarios(){


	var opcionServicio  	   = document.getElementById("selServicio").value;
	var tipoServicio 		   = opcionServicio.substr(0,1);
	var servicio  			   = opcionServicio.substr(1,opcionServicio.length);


	var cantFuncionariosAsignados = document.getElementById("personalAsignado").length;
	if (cantFuncionariosAsignados == 0){

			document.getElementById('btnCerrar').disabled = "";
			if (document.getElementById('correlativoServicio').value != "") document.getElementById('btnEliminar').disabled = "";
			document.getElementById('btnAnterior').disabled  = "";
			document.getElementById('btnSiguiente').disabled = "";
			if (tipoServicio == "A" || tipoServicio == "N") {
				document.getElementById('btnSiguiente').disabled = "true";
				document.getElementById('btnFinalizar').disabled = "";
				document.getElementById('btnFinalizar').value 	 = "FINALIZAR";
			}

			document.getElementById("mensajeGuardando").style.display = "none";



		alert("DEBE INDICAR LOS FUNCIONARIOS ASIGNADOS A ESTE SERVICIO.          ");
		return false;
	}
	return true;
}

function validaDatosAsignaVehiculos(){
	var cantVehiculosAsignados = document.getElementById("divAsignaVehiculos").length;
	if (cantVehiculosAsignados == 0){
		alert("DEBE INDICAR LOS VEHICULOS ASIGNADOS A ESTE SERVICIO");
		return false;
	}

	return true;
}

function validaDatosAsignaCaballos(){
	var cantCaballosAsignados = document.getElementById("divAsignaCaballos").length;
	if (cantCaballosAsignados == 0){
		alert("DEBE INDICAR LOS ANIMALES ASIGNADOS A ESTE SERVICIO");
		return false;
	}

	return true;
}

function validaDatosAsignaSimccar(){
	var cantSimccarAsignados = document.getElementById("divAsignaSimccar").length;
	if (cantSimccarAsignados == 0){
		alert("DEBE INDICAR LOS SIMCCAR ASIGNADOS A ESTE SERVICIO");
		return false;
	}

	return true;
}

function validaDatosAsignaMedios(){
	var cantFuncionariosAsignados = document.getElementById("personalServicio").length;
	var cantVehiculosAsignados 	  = document.getElementById("vehiculosServicio").length;
	var cantCaballosAsignados 	  = document.getElementById("caballosServicio").length;
	//var cantSimccarAsignados 	  = document.getElementById("simccarServicio").length;

	if (cantFuncionariosAsignados != 0){
		alert("DEBE INDICAR EL MEDIO DE VIGILANCIA AL QUE ES ASIGNADO EL O LOS FUNCIONARIOS.      ");
		return false;
	}

	if (cantVehiculosAsignados > 1){
		alert("DEBE INDICAR EL MEDIO DE VIGILANCIA AL QUE ES ASIGNADO EL O LOS VEHICULOS.      ");
		return false;
	}

	if (cantCaballosAsignados > 1){
		alert("DEBE INDICAR EL MEDIO DE VIGILANCIA AL QUE ES ASIGNADO EL O LOS ANIMALES.      ");
		return false;
	}
	
	//if (cantSimccarAsignados > 1){
	//	alert("DEBE INDICAR EL MEDIO DE VIGILANCIA AL QUE ES ASIGNADO LA SIMCCAR      ");
	//	return false;
	//}

	return true;
}



//function irPaginaSiguienteCuadrante(){
//
//	var resultado 			= true;
//	var datosServicios 		= document.getElementById("divDatosServicio").style.visibility;
//	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
//	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
//	var asignaMedios 		= document.getElementById("divAsignaMedios").style.visibility;
//	var asignaAccesorios	= document.getElementById("divAsignaAccesorios").style.visibility;
//	var correlativo			= document.getElementById("correlativoServicio").value;
//
//	var opcionServicio  	= document.getElementById("selServicio").value;
//	var tipoServicio 		= opcionServicio.substr(0,1);
//	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
//
//	var unidad				= document.getElementById("unidadServicio").value;
//
//	//document.getElementById("divDatosServicio").style.visibility	  = "hidden";
//	//document.getElementById("divAsignaFuncionarios").style.visibility = "hidden";
//	document.getElementById("divAsignaVehiculos").style.visibility	  = "hidden";
//	//document.getElementById("divAsignaMedios").style.visibility		  = "hidden";
//	document.getElementById("divAsignaAccesorios").style.visibility	  = "hidden";
//
//	if (datosServicios == "visible"){
//		var validaOk = validaDatosServicio();
//		if (validaOk){
//			var existe = false;
//			//if (correlativo == "" && servicio != 1100 && servicio != 2000 && servicio != 100 && servicio != 450  && servicio != 460) existe = verificaExisteServicio();
//
//			if (correlativo == "" && servicio != 1100 && servicio != 2000 && servicio != 100 && servicio != 450  && servicio != 460
//				&& servicio != 320 && servicio != 554 && servicio != 555 && servicio != 556 && servicio != 566 && servicio != 575 && servicio != 576) existe = verificaExisteServicio();
//
//			//alert("cargoFuncionariosDisponibles " + cargoFuncionariosDisponibles);
//			if (cargoFuncionariosDisponibles == 0) selectFuncionariosDisponibles(unidad,'funcionariosDisponibles','');
//			if (!existe){
//				//listarPersonalAsignado('personalAsignado');
//				document.getElementById("divDatosServicio").style.visibility	  = "hidden";
//				document.getElementById("divAsignaFuncionarios").style.visibility = "visible";
//				document.getElementById("btnAnterior").disabled  				  = "";
//				document.getElementById("btnSiguiente").disabled 				  = "";
//				document.getElementById("btnFinalizar").disabled 				  = true;
//
//				if (tipoServicio == "N" || tipoServicio == "A"){
//						document.getElementById("btnSiguiente").disabled = true;
//						if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnFinalizar").disabled = "";
//				}
//
//			} else {
//				var desServicio = document.getElementById("selServicio")[document.getElementById("selServicio").selectedIndex].text;
//				var fecha1 	 = fechaCompleta(document.getElementById("textFechaServicio").value);
//				var respuesta = confirm("\""+desServicio+"\" PARA EL "+fecha1+" YA HA SIDO INGRESADO.  \n¿DESEA ACTUALIZARLO?      ");
//				if (respuesta){
//					correlativo	= document.getElementById("correlativoServicio").value;
//					leeDatosServicio(unidad, correlativo, false);
//				} else {
//					cerrarVentanaServicio();
//				}
//			}
//		}
//	}
//
//
//
//
//	if (asignaFuncionarios == "visible") {
//		var validaOk = validaDatosAsignaFuncionarios();
//		if (validaOk){
//			document.getElementById("divAsignaFuncionarios").style.visibility = "hidden";
//			if (tipoServicio == "I"){
//				document.getElementById("divAsignaAccesorios").style.visibility	= "visible";
//				document.getElementById("btnAnterior").disabled  = "";
//				document.getElementById("btnSiguiente").disabled = true;
//				if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnFinalizar").disabled = "";
//			} else {
//				selectVehiculosDisponibles(unidad, 'vehiculosDisponibles');
//				document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
//				document.getElementById("btnAnterior").disabled = "";
//				document.getElementById("btnSiguiente").disabled = "";
//				document.getElementById("btnFinalizar").disabled = true;
//			}
//
//			listaArmasDisponibles(unidad, 'armasDisponibles');
//			leeTipoAccesorio('accesoriosDisponibles', true);
//			leeTipoAnimal('animalesDisponibles',true);
//			listarPersonalAsignado('personalServicio2');
//			listarPersonalAsignado('personalServicio');
//		}
//	}
//
//
//	if (asignaVehiculos == "visible") {
//			if (servicio == 2000){
//				document.getElementById('cuadrantesMV').disabled 				= "true";
//				document.getElementById('factorMV').disabled 	 				= "true";
//				document.getElementById('cuadrantesMV').style.backgroundColor 	= "#D4D4D4";
//				document.getElementById('factorMV').style.backgroundColor 		= "#D4D4D4";
//				document.getElementById('legFactor').disabled 	 				= "true";
//				document.getElementById('legCuadrante').disabled 	 			= "true";
//			}
//
//
//			document.getElementById("divAsignaMedios").style.visibility	= "visible";
//			document.getElementById("btnAnterior").disabled = "";
//			document.getElementById("btnSiguiente").disabled = "";
//			document.getElementById("btnFinalizar").disabled = true;
//			//if (correlativo == "") listarPersonalAsignado('personalServicio');
//			//if (correlativo == "") listarVehiculoAsignado('vehiculosServicio');
//			//if (correlativo == "") listarPersonalAsignado('personalServicio2');
//
//			listarVehiculoAsignado('vehiculosServicio');
//			//listarPersonalAsignado('personalServicio2');
//
//	}
//
//
//	if (asignaMedios == "visible") {
//		var validaOk = validaDatosAsignaMedios();
//		if (validaOk){
//			document.getElementById("divAsignaMedios").style.visibility = "hidden";
//			document.getElementById("divAsignaAccesorios").style.visibility	= "visible";
//			document.getElementById("btnAnterior").disabled = "";
//			document.getElementById("btnSiguiente").disabled = true;
//			//document.getElementById("btnFinalizar").disabled = "";
//			if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnFinalizar").disabled = "";
//		}
//	}
//}

// NUEVA FUNCION DE VALIDACION CABALLOS

// FIN NUEVA FUNCION CABALLOS

function fechaValidacion (unidadServicios, fechaServicios){
	//alert(unidadServicios + " - " + fechaServicios);
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();

	objHttpXMLFechaValidacion.open("POST","./xml/xmlServicios/xmlFechaValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFechaValidacion.send(encodeURI("unidadServicios="+unidadServicios+"&fechaServicios="+fechaServicios));
	//alert(objHttpXMLFechaValidacion.responseText);
	var xml = objHttpXMLFechaValidacion.responseXML.documentElement;
	return xml.getElementsByTagName('fechaValidacion')[0].text;
}


function irPaginaSiguienteCuadrante(){

	var resultado 			= true;
	var datosServicios 		= document.getElementById("divDatosServicio").style.visibility;
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaMedios 		= document.getElementById("divAsignaMedios").style.visibility;
	var asignaAccesorios	= document.getElementById("divAsignaAccesorios").style.visibility;
	var correlativo			= document.getElementById("correlativoServicio").value;

	var asignaCaballos 	= document.getElementById("divAsignaCaballos").style.visibility; //Nueva 16/10/2017
	
	var asignaSimccar 	= document.getElementById("divAsignaSimccar").style.visibility; //Nueva 04/01/2018

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var grupoServicio	    = document.getElementById("selTipoServicio").value;

   	var opcionLicencia   	= document.getElementById("selLicencia").value; //Agregado 30-06-2015
	var tipoLicencia		= opcionLicencia.substr(0,1); //Agregado 30-06-2015
	var Licencia			= opcionLicencia.substr(1,opcionLicencia.length); //Agregado 30-06-2015

	var unidad				= document.getElementById("unidadServicio").value;

	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	var fechaServicioSel	= document.getElementById("textFechaServicio").value;

	//document.getElementById("divDatosServicio").style.visibility	  = "hidden";
	//document.getElementById("divAsignaFuncionarios").style.visibility = "hidden";
	document.getElementById("divAsignaVehiculos").style.visibility	  = "hidden";
	document.getElementById("divAsignaCaballos").style.visibility	  = "hidden"; //Nueva 16/10/2017
	//document.getElementById("divAsignaMedios").style.visibility	  = "hidden";
	document.getElementById("divAsignaAccesorios").style.visibility	  = "hidden";
	
	document.getElementById("divAsignaSimccar").style.visibility	  = "hidden"; //Nueva 04/01/2018

	if (datosServicios == "visible"){
		//alert(unidadBloqueada + " - " + fechaServicioSel + " - " + fechaLimite);
		var comparaFechaLimite = comparaFecha(fechaServicioSel, fechaLimite);
		//alert(comparaFechaLimite);


		var serviciosValidados = fechaValidacion(unidad, fechaServicioSel);
		//alert(serviciosValidados);

		//if (unidadBloqueada == 1 && comparaFechaLimite == 2) {
		if (serviciosValidados != "" || (unidadBloqueada == 1 && comparaFechaLimite == 2)) {

			if (serviciosValidados != ""){
				alert("PARA LA FECHA SELECCIONADA LOS SERVICIOS YA SE ENCUENTRAN VALIDADOS.\n\nNO SE PUEDEN AGREGAR Y/O ACTUALIZAR ... ");
				cerrarVentanaServicio();
			} else {
				alert("PARA LA FECHA SELECCIONADA EL SISTEMA SE ENCUENTRA BLOQUEADO.\n\nNO SE PUEDEN AGREGAR Y/O ACTUALIZAR SERVICIOS ... ");
				cerrarVentanaServicio();
			}
		} else {
			//alert(servicio);
			var validaOk = validaDatosServicio();




			if (validaOk){
				//var aceptaNoMoficarServicio = confirm("NO PODRA MODIFICAR EL TIPO DE SERVICIO Y SERVICIO INGRESADO. ¿DESEA CONTINUAR?");
				//if (aceptaNoMoficarServicio){
					var existe = false;
					//if (grupoServicio != 2 && correlativo == "" && servicio != 1100 && servicio != 2000 && servicio != 100 && servicio != 450
					//    && servicio != 460	&& servicio != 320 && servicio != 554 && servicio != 555 && servicio != 556 && servicio != 556
					//    && servicio != 563 && servicio != 400 && servicio != 410 && servicio != 30 && servicio != 576 && servicio != 566
					//    && servicio != 5000	&& servicio != 5001 && servicio != 5002 && servicio != 5003) existe = verificaExisteServicio();

					if (grupoServicio != 2  && correlativo == "" && servicio != 1100 && servicio != 2000 && servicio != 100 && servicio != 450
					    && servicio != 460	&& servicio != 320   && servicio != 554  && servicio != 555  && servicio != 556 && servicio != 563
					    && servicio != 400  && servicio != 410   && servicio != 30   && servicio != 576  && servicio != 566 && servicio != 5000
					    && servicio != 5001 && servicio != 5002  && servicio != 5003 && servicio != 581  && servicio != 582 && servicio != 583
					    && servicio != 584  && servicio != 585   && servicio != 586  && servicio != 587  && servicio != 588 && servicio != 589
					    && servicio != 590  && servicio != 591   && servicio != 592  && servicio != 593  && servicio != 594 && servicio != 595
					    && servicio != 596  && servicio != 597	&& servicio != 562  && servicio != 15   && servicio != 607 && servicio != 602
						 && servicio != 22   && servicio != 190   && servicio != 192  && servicio != 193  && servicio != 240 && servicio != 250
	                && servicio != 260  && servicio != 390   && servicio != 420  && servicio != 557  && servicio != 558 && servicio != 559
	                && servicio != 560  && servicio != 561   && servicio != 562  && servicio != 569  && servicio != 580 && servicio != 604
	                && servicio != 605  && servicio != 608   && servicio != 609  && servicio != 610  && servicio != 611 && servicio != 612
	                && servicio != 613  && servicio != 614   && servicio != 615  && servicio != 616  && servicio != 617 && servicio != 618
	                && servicio != 619  && servicio != 620   && servicio != 621  && servicio != 622  && servicio != 623 && servicio != 624
	                 && servicio != 626 && servicio != 197 && servicio != 24 && servicio != 23 && servicio != 577) existe = verificaExisteServicio();


					//alert("cargoFuncionariosDisponibles " + cargoFuncionariosDisponibles);
					if (cargoFuncionariosDisponibles == 0) selectFuncionariosDisponibles(unidad,'funcionariosDisponibles','');
					if (!existe){
						var aceptaNoMoficarServicio = confirm("NO PODRA MODIFICAR EL TIPO DE SERVICIO Y SERVICIO INGRESADO. ¿DESEA CONTINUAR?");
						if (aceptaNoMoficarServicio){
							//listarPersonalAsignado('personalAsignado');


							document.getElementById("selTipoServicio").disabled = true;
							document.getElementById("selServicio").disabled 	= true;
                            //Agregada 30-06-2015
                            document.getElementById("selLicencia").disabled 	= true;


							document.getElementById("divDatosServicio").style.visibility	  = "hidden";
							document.getElementById("divAsignaFuncionarios").style.visibility = "visible";
							document.getElementById("btnAnterior").disabled  				  = "";
							document.getElementById("btnSiguiente").disabled 				  = "";
							document.getElementById("btnFinalizar").disabled 				  = true;

                            //MODFICADO EL 30-06-215
							if (tipoServicio == "N" || tipoServicio == "A" || tipoLicencia=="N"){
									document.getElementById("btnSiguiente").disabled = true;
									if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnFinalizar").disabled = "";
							}
						}

					} else {
						//var desServicio = document.getElementById("selServicio")[document.getElementById("selServicio").selectedIndex].text;
                        //Condicion agregada el 30-06-2015
                   if(opcionServicio == 1 || opcionServicio == 2 || opcionServicio == 3 || opcionServicio==4){
						   desServicio = document.getElementById("selLicencia")[document.getElementById("selLicencia").selectedIndex].text;
						}else{
						   desServicio = document.getElementById("selServicio")[document.getElementById("selServicio").selectedIndex].text;
						}

						var fecha1 	 = fechaCompleta(document.getElementById("textFechaServicio").value);
						var respuesta = confirm("\""+desServicio+"\" PARA EL "+fecha1+" YA HA SIDO INGRESADO.  \n¿DESEA ACTUALIZARLO?      ");
						if (respuesta){
							correlativo	= document.getElementById("correlativoServicio").value;
							leeDatosServicio(unidad, correlativo, false);
						} else {
							cerrarVentanaServicio();
						}
					}
				//}

			}

		}
	}


	if (asignaFuncionarios == "visible") {
		var validaOk = validaDatosAsignaFuncionarios();
		if (validaOk){
			document.getElementById("divAsignaFuncionarios").style.visibility = "hidden";
			if (tipoServicio == "I"){
				document.getElementById("divAsignaAccesorios").style.visibility	= "visible";
				document.getElementById("btnAnterior").disabled  = "";
				document.getElementById("btnSiguiente").disabled = true;
				if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnFinalizar").disabled = "";
			} else {
				selectVehiculosDisponibles(unidad, 'vehiculosDisponibles');
				document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
				document.getElementById("btnAnterior").disabled = "";
				document.getElementById("btnSiguiente").disabled = "";
				document.getElementById("btnFinalizar").disabled = true;





			}

      
			listaArmasDisponibles(unidad, 'armasDisponibles');
			leeTipoAccesorio('accesoriosDisponibles', true);
			leeTipoAnimal('animalesDisponibles',true);
			listarPersonalAsignado('personalServicio2');
			listarPersonalAsignado('personalServicio');
			listarSimccarAsignado('simccarDisponibles2');
			//listarSimccarAsignado('simccarAsignados');
		}
	}


	if (asignaVehiculos == "visible") {
			//if (servicio == 2000){
			//	document.getElementById('cuadrantesMV').disabled 				= "true";
			//	document.getElementById('factorMV').disabled 	 				= "true";
			//	document.getElementById('cuadrantesMV').style.backgroundColor 	= "#D4D4D4";
			//	document.getElementById('factorMV').style.backgroundColor 		= "#D4D4D4";
			//	document.getElementById('legFactor').disabled 	 				= "true";
			//	document.getElementById('legCuadrante').disabled 	 			= "true";
			//}
			selectCaballosDisponibles(unidad, 'caballosDisponibles');
			selectPerrosDisponibles(unidad, 'perrosDisponibles');
			selectSimccarDisponibles(unidad, 'simccarDisponibles');
		  document.getElementById("divAsignaVehiculos").style.visibility	= "hidden";
		  document.getElementById("divAsignaCaballos").style.visibility	= "visible";

		  document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;


			//document.getElementById("divAsignaMedios").style.visibility	= "visible";
			//document.getElementById("btnAnterior").disabled = "";
			//document.getElementById("btnSiguiente").disabled = "";
			//document.getElementById("btnFinalizar").disabled = true;

			//if (correlativo == "") listarPersonalAsignado('personalServicio');
			//if (correlativo == "") listarVehiculoAsignado('vehiculosServicio');
			//if (correlativo == "") listarPersonalAsignado('personalServicio2');

			//listarVehiculoAsignado('vehiculosServicio');

			//listarPersonalAsignado('personalServicio2');
			//listarCaballosAsignado('caballosServicio');

	}

		if (asignaCaballos == "visible") {
			if (servicio == 2000){
				document.getElementById('cuadrantesMV').disabled 				= "true";
				document.getElementById('factorMV').disabled 	 				= "true";
				document.getElementById('cuadrantesMV').style.backgroundColor 	= "#D4D4D4";
				document.getElementById('factorMV').style.backgroundColor 		= "#D4D4D4";
				document.getElementById('legFactor').disabled 	 				= "true";
				document.getElementById('legCuadrante').disabled 	 			= "true";
			}
      document.getElementById("divAsignaCaballos").style.visibility	= "hidden";
			document.getElementById("divAsignaSimccar").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;

			listarVehiculoAsignado('vehiculosServicio');
			listarCaballosAsignado('caballosServicio');
			//listarSimccarAsignado('simccarServicio');
			listarSimccarAsignado('simccarDisponibles2');

}

		if (asignaSimccar == "visible") {
			if (servicio == 2000){
				document.getElementById('cuadrantesMV').disabled 				= "true";
				document.getElementById('factorMV').disabled 	 				= "true";
				document.getElementById('cuadrantesMV').style.backgroundColor 	= "#D4D4D4";
				document.getElementById('factorMV').style.backgroundColor 		= "#D4D4D4";
				document.getElementById('legFactor').disabled 	 				= "true";
				document.getElementById('legCuadrante').disabled 	 			= "true";
			}
			document.getElementById("divAsignaSimccar").style.visibility	= "hidden";
			document.getElementById("divAsignaMedios").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;

			listarVehiculoAsignado('vehiculosServicio');
			listarCaballosAsignado('caballosServicio');
			//listarSimccarAsignado('SimccarServicio');
			listarSimccarAsignado('simccarDisponibles2');

}

	if (asignaMedios == "visible") {
		var validaOk = validaDatosAsignaMedios();
		if (validaOk){
			document.getElementById("divAsignaMedios").style.visibility = "hidden";
			document.getElementById("divAsignaAccesorios").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = true;
			//document.getElementById("btnFinalizar").disabled = "";
			if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnFinalizar").disabled = "";
		}
	}
}

function irPaginaAnteriorCuadrante(){

	var resultado 			= true;
	var datosServicios 		= document.getElementById("divDatosServicio").style.visibility;
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaMedios 		= document.getElementById("divAsignaMedios").style.visibility;
	var asignaAccesorios	= document.getElementById("divAsignaAccesorios").style.visibility;

	var asignaCaballos= document.getElementById("divAsignaCaballos").style.visibility;
	
	var asignaSimccar= document.getElementById("divAsignaSimccar").style.visibility; //04-01-2018

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);

	document.getElementById("divDatosServicio").style.visibility		= "hidden";
	document.getElementById("divAsignaFuncionarios").style.visibility	= "hidden";
	document.getElementById("divAsignaVehiculos").style.visibility		= "hidden";
	document.getElementById("divAsignaMedios").style.visibility			= "hidden";
	document.getElementById("divAsignaCaballos").style.visibility			= "hidden";
	document.getElementById("divAsignaSimccar").style.visibility			= "hidden";
	//document.getElementById("divAsignaAccesorios").style.visibility		= "hidden";

	if (asignaFuncionarios == "visible") {
		document.getElementById("divDatosServicio").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = true;
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}

	if (asignaVehiculos == "visible") {
		document.getElementById("divAsignaFuncionarios").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}

		if (asignaCaballos == "visible") {
    document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}
	
	if (asignaSimccar == "visible") {
    document.getElementById("divAsignaCaballos").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}

	if (asignaMedios == "visible") {
		document.getElementById("divAsignaSimccar").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}

	if (asignaAccesorios == "visible") {
		//alert(tipoServicio);
		document.getElementById("divAsignaAccesorios").style.visibility	= "hidden";
		if (tipoServicio == "I"){
			document.getElementById("divAsignaFuncionarios").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		} else {
			document.getElementById("divAsignaMedios").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		}
	}
}


function seleccionTipoServicio(especialidad){
	var opcionTipoServicio = document.getElementById("selTipoServicio").value;
	//alert("opcionTipoServicio : " + opcionTipoServicio);
	//alert("especialidad : " + especialidad);
	document.getElementById('selServicio').length = null;
    document.getElementById('selLicencia').length = null; //Agregado 30-06-2015
	document.getElementById("textOtroExtraordinario").value = "";
	document.getElementById("textOtroExtraordinario").style.backgroundColor = "#D4D4D4";
	document.getElementById("textOtroExtraordinario").disabled = true;
	document.getElementById("idFechaServicio").focus();

	//if (opcionTipoServicio == 1) leeTipoServicios('selServicio',false,especialidad,'OPERATIVO');
	//if (opcionTipoServicio == 2) leeTipoServiciosExtraordinarios('selServicio',especialidad);
	//if (opcionTipoServicio == 3) leeTipoServicios('selServicio',false,especialidad,'ADMINISTRATIVO');
	//if (opcionTipoServicio == 4) leeTipoServicios('selServicio',false,especialidad,'SIN SERVICIO');
	//if (opcionTipoServicio == 5) leeTipoServicios('selServicio',false,especialidad,'INTRACUARTEL');
	//if (opcionTipoServicio == 6) leeTipoServicios('selServicio',false,especialidad,'OTRO CUARTEL');
	//if (opcionTipoServicio == 7) leeTipoServicios('selServicio',false,especialidad,'COLACION');

   	if (opcionTipoServicio == 1) leeTipoServicios('selServicio',false,especialidad,'OPERATIVO');
	if (opcionTipoServicio == 2) leeTipoServiciosExtraordinarios('selServicio',especialidad);
	if (opcionTipoServicio == 3) leeTipoServicios('selServicio',false,especialidad,'ADMINISTRATIVO');
	if (opcionTipoServicio == 4) leeTipoServicios('selServicio',false,especialidad,'SIN SERVICIO');
    if (opcionTipoServicio == 5) listaLicencias('selServicio') //Nuevo
	if (opcionTipoServicio == 6) leeTipoServicios('selServicio',false,especialidad,'INTRACUARTEL');
	if (opcionTipoServicio == 7) leeTipoServicios('selServicio',false,especialidad,'OTRO CUARTEL');
	if (opcionTipoServicio == 8) leeTipoServicios('selServicio',false,especialidad,'COLACION');
}



//function seleccionServicio(){
//	var opcionServicio  = document.getElementById("selServicio").value;
//	var tipoServicio 	= opcionServicio.substr(0,1);
//	var codigoServicio  = opcionServicio.substr(1,opcionServicio.length);
//
//	//alert(codigoServicio);
//
//	if (codigoServicio == 1100){
//		document.getElementById("selTipoExtraordinario").disabled = false;
//		document.getElementById("labDescripcion").disabled	= false;
//		//document.getElementById("selTipoExtraordinario").value = 0;
//		//document.getElementById("selTipoExtraordinario").focus();
//
//		//document.getElementById("selTipoExtraordinario").style.backgroundColor = "";
//		//document.getElementById("textOtroExtraordinario").style.backgroundColor = "";
//	}
//	else {
//
//		document.getElementById("selTipoExtraordinario").value 		= 0;
//		document.getElementById("selTipoExtraordinario").disabled	= true;
//		document.getElementById("labDescripcion").disabled			= true;
//		//document.getElementById("selTipoExtraordinario").style.backgroundColor = "#D4D4D4";
//
//
//		document.getElementById("textOtroExtraordinario").value     = "";
//		document.getElementById("textOtroExtraordinario").disabled  = true;
//		document.getElementById("textOtroExtraordinario").style.backgroundColor = "#D4D4D4";
//	}
//
//
//	//alert(tipoServicio);
//
//	if (tipoServicio == "N"){
//		document.getElementById("selHoraInicio").value     = 0;
//		document.getElementById("selHoraTermino").value    = 0;
//		document.getElementById("labHoraInicio").disabled  = true;
//		document.getElementById("selHoraInicio").disabled  = true;
//		document.getElementById("labHoraTermino").disabled = true;
//		document.getElementById("selHoraTermino").disabled = true;
//	} else {
//		document.getElementById("labHoraInicio").disabled  = false;
//		document.getElementById("selHoraInicio").disabled  = false;
//		document.getElementById("labHoraTermino").disabled = false;
//		document.getElementById("selHoraTermino").disabled = false;
//	}
//}

//NUEVA FUNCION AGREGADA 30-06-2015
function listaLicencias(nombreObjeto, multiple){

    var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
	//var datosOpcion1 = new Option("LICENCIAS VINCULADAS AL DESEMPENO LABORAL",1, "", "");
  //  var datosOpcion2 = new Option("ENFERMEDAD O ACCIDENTE COMUN", 2, "", "");
  //  var datosOpcion3 = new Option("LICENCIAS VINCULADAS LA MATERNIDAD", 3, "", "");
  //   var datosOpcion4 = new Option("ACOGIDO A LA MEDICINA PREVENTIVA", 4, "", "");
      var datosOpcion5 = new Option("LICENCIA MEDICA", 1, "", "");
       //var datosOpcion6 = new Option("LICENCIAS VINCULADAS LA MATERNIDAD", 2, "", "");
       //var datosOpcion7 = new Option("ACOGIDO A LA MEDICINA PREVENTIVA", 3, "", "");

    document.getElementById(nombreObjeto).options[0] = datosOpcion;
    //document.getElementById(nombreObjeto).options[1] = datosOpcion1;
    //document.getElementById(nombreObjeto).options[2] = datosOpcion2;
    //document.getElementById(nombreObjeto).options[3] = datosOpcion3;
    // document.getElementById(nombreObjeto).options[4] = datosOpcion4;
    document.getElementById(nombreObjeto).options[1] = datosOpcion5;
   // document.getElementById(nombreObjeto).options[2] = datosOpcion6;
   // document.getElementById(nombreObjeto).options[3] = datosOpcion7;

}
//FIN NUEVA FUNCION

//NUEVA FUNCION AGREGADA 30-06-2015
function Seleccionlicencia(){
    var opcionLicencia  = document.getElementById("selServicio").value;
    //alert("Opcion licencia: "+opcionLicencia);
    var opcionLicencia  = document.getElementById("selLicencia").value;
   	var tipoLicencia	= opcionLicencia.substr(0,1);
	var codigoLicencia  = opcionLicencia.substr(1,opcionLicencia.length);
    document.getElementById("idFechaServicio").focus();
    //alert("Opcion licencia: "+opcionLicencia);
    //alert("Tipo licencia: "+tipoLicencia);
    //alert("Codigo licencia: "+codigoLicencia);

    //Condicion agregada el 20-05-2015
   	if (tipoLicencia == "N"){
		document.getElementById("selHoraInicio").value     = 0;
		document.getElementById("selHoraTermino").value    = 0;
		document.getElementById("labHoraInicio").disabled  = true;
		document.getElementById("selHoraInicio").disabled  = true;
		document.getElementById("labHoraTermino").disabled = true;
		document.getElementById("selHoraTermino").disabled = true;
	} else {
		document.getElementById("labHoraInicio").disabled  = false;
		document.getElementById("selHoraInicio").disabled  = false;
		document.getElementById("labHoraTermino").disabled = false;
		document.getElementById("selHoraTermino").disabled = false;
	}
}
//FIN NUEVA OTRA FUNCION

//Funcion modificada el 30-06-2015
function seleccionServicio(){
	var opcionServicio  = document.getElementById("selServicio").value;
	var tipoServicio 	= opcionServicio.substr(0,1);
	var codigoServicio  = opcionServicio.substr(1,opcionServicio.length);

          //Condicion Agregada 15-05-2015
    //  if (opcionServicio == 1) leeTipoServicios('selLicencia',false,70,'LABORAL');
    //  if (opcionServicio == 2) leeTipoServicios('selLicencia',false,70,'ENFERMEDAD');
    //  if (opcionServicio == 3) leeTipoServicios('selLicencia',false,70,'MATERNIDAD');
    //  if (opcionServicio == 4) leeTipoServicios('selLicencia',false,70,'PREVENTIVA');
        if (opcionServicio == 1) leeTipoServicios('selLicencia',false,70,'OTRO');
         //if (opcionServicio == 2) leeTipoServicios('selLicencia',false,70,'MATERNIDAD');
         // if (opcionServicio == 3) leeTipoServicios('selLicencia',false,70,'PREVENTIVA');

	//alert(codigoServicio);

	//if (codigoServicio == 1100){
	//	document.getElementById("selTipoExtraordinario").disabled = false;
	//	document.getElementById("labDescripcion").disabled	= false;
	//	//document.getElementById("selTipoExtraordinario").value = 0;
	//	//document.getElementById("selTipoExtraordinario").focus();
	//
	//	//document.getElementById("selTipoExtraordinario").style.backgroundColor = "";
	//	//document.getElementById("textOtroExtraordinario").style.backgroundColor = "";
	//}
	//else {
	//
	//	document.getElementById("selTipoExtraordinario").value 		= 0;
	//	document.getElementById("selTipoExtraordinario").disabled	= true;
	//	document.getElementById("labDescripcion").disabled			= true;
	//	//document.getElementById("selTipoExtraordinario").style.backgroundColor = "#D4D4D4";
	//
	//
	//	document.getElementById("textOtroExtraordinario").value     = "";
	//	document.getElementById("textOtroExtraordinario").disabled  = true;
	//	document.getElementById("textOtroExtraordinario").style.backgroundColor = "#D4D4D4";
	//}

	//alert(codigoServicio);
	if (codigoServicio == 5000 || codigoServicio == 5001 || codigoServicio == 5002 || codigoServicio == 5003){
		document.getElementById("textOtroExtraordinario").style.backgroundColor = "";
		document.getElementById("textOtroExtraordinario").disabled = false;
		document.getElementById("textOtroExtraordinario").focus();
	}
	else {
		document.getElementById("textOtroExtraordinario").value = "";
		document.getElementById("textOtroExtraordinario").style.backgroundColor = "#D4D4D4";
		document.getElementById("textOtroExtraordinario").disabled = true;
		document.getElementById("idFechaServicio").focus();
	}

    //CONDICION AGREGADA el 30-06-2015
	if (opcionServicio == 1 || opcionServicio == 2 || opcionServicio == 3){
		document.getElementById("selLicencia").style.backgroundColor = "";
		document.getElementById("selLicencia").disabled = false;
	}
	else {
		document.getElementById("selLicencia").value = "";
		document.getElementById("selLicencia").style.backgroundColor = "#D4D4D4";
		document.getElementById("selLicencia").disabled = true;
		document.getElementById("idFechaServicio").focus();
	}
	//FIN CONDICION AGREGADA

	//alert(tipoServicio);

	if (tipoServicio == "N"){
		document.getElementById("selHoraInicio").value     = 0;
		document.getElementById("selHoraTermino").value    = 0;
		document.getElementById("labHoraInicio").disabled  = true;
		document.getElementById("selHoraInicio").disabled  = true;
		document.getElementById("labHoraTermino").disabled = true;
		document.getElementById("selHoraTermino").disabled = true;
	} else {
		document.getElementById("labHoraInicio").disabled  = false;
		document.getElementById("selHoraInicio").disabled  = false;
		document.getElementById("labHoraTermino").disabled = false;
		document.getElementById("selHoraTermino").disabled = false;
	}
}


function seleccionTipoExtraordinario(){
	var opcionServicio = document.getElementById("selTipoExtraordinario").value;

	if (opcionServicio == 100){
		document.getElementById("textOtroExtraordinario").style.backgroundColor = "";
		document.getElementById("textOtroExtraordinario").disabled = false;
		document.getElementById("textOtroExtraordinario").focus();
	}
	else {
		document.getElementById("textOtroExtraordinario").value = "";
		document.getElementById("textOtroExtraordinario").style.backgroundColor = "#D4D4D4";
		document.getElementById("textOtroExtraordinario").disabled = true;
		document.getElementById("idFechaServicio").focus();
	}
}


function selectVehiculosDisponibles(unidad, nombreObjeto){

	var fechaServicio 		= document.getElementById('textFechaServicio').value;

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var correlativo			= document.getElementById("correlativoServicio").value;


	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+servicio+"&correlativo="+correlativo;

	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlVehiculosDisponibles.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));

	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculosreadyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "SIN DATOS"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			= "";
				var tipo	 			= "";
				var patente		 		= "";
				var nroInstitucional	= "";


				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					tipo	 		 = xml.getElementsByTagName('tipo')[i].text;
					patente		 	 = xml.getElementsByTagName('patente')[i].text;
					nroInstitucional = xml.getElementsByTagName('numeroInstitucional')[i].text;

					var descripcion	 = tipo + " (" + patente + ")";

					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
				}
			} else {
				document.getElementById(nombreObjeto).length = null;
			}

			habilitarBotonesAgregarQuitarVehiculos();
		}
	}
}


function asignarVehiculo(){
	moverDatos('vehiculosDisponibles','vehiculosAsignados');
	ordenar(document.getElementById('vehiculosAsignados'));
	habilitarBotonesAgregarQuitarVehiculos();
}


function desasignarVehiculo(){
	//alert(document.getElementById('vehiculosDisponibles').value);
	verificarVehiculoMedios();
	moverDatos('vehiculosAsignados','vehiculosDisponibles');
	ordenar(document.getElementById('vehiculosDisponibles'));
	habilitarBotonesAgregarQuitarVehiculos();
}

// NUEVA FUNCION CABALLOS DISPONBLES
function selectCaballosDisponibles(unidad, nombreObjeto){

	var fechaServicio 		= document.getElementById('textFechaServicio').value;

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var correlativo			= document.getElementById("correlativoServicio").value;


	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+servicio+"&correlativo="+correlativo;

	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlCaballosDisponibles.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));

	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculosreadyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "SIN DATOS"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;

				var codigo	 		= "";
				var tipo	 			= "";
				var bcu	 	     	= "";
				var nombre	    = "";
				var color ='style="color: #FF0000;';


				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					tipo	 		 = xml.getElementsByTagName('tipo')[i].text;
					bcu	 	     = xml.getElementsByTagName('bcu')[i].text;
					nombre     = xml.getElementsByTagName('nombre')[i].text;

					var descripcion	 = tipo + " (" + nombre + ")";

					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
				}
			} else {
				document.getElementById(nombreObjeto).length = null;
			}

			habilitarBotonesAgregarQuitarCaballos();
		}
	}
}

// NUEVA FUNCION CABALLOS DISPONBLES
function selectPerrosDisponibles(unidad, nombreObjeto){

	var fechaServicio 		= document.getElementById('textFechaServicio').value;

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var correlativo			= document.getElementById("correlativoServicio").value;


	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+servicio+"&correlativo="+correlativo;

	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlPerrosDisponibles.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));

	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculosreadyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "SIN DATOS"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;

				var codigo	 		= "";
				var tipo	 			= "";
				var bcu	 	     	= "";
				var nombre	    = "";
				var color ='style="color: #FF0000;';


				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					tipo	 		 = xml.getElementsByTagName('tipo')[i].text;
					bcu	 	     = xml.getElementsByTagName('bcu')[i].text;
					nombre     = xml.getElementsByTagName('nombre')[i].text;

					var descripcion	 = tipo + " (" + nombre + ")";

					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
				}
			} else {
				document.getElementById(nombreObjeto).length = null;
			}

			habilitarBotonesAgregarQuitarCaballos();
		}
	}
}



function asignarCaballo(){
	moverDatos('CaballosDisponibles','caballosAsignados');
	moverDatos('perrosDisponibles','caballosAsignados');
	ordenar(document.getElementById('vehiculosAsignados'));
	//var perro = document.getElementById('caballosDisponibles').value;
	//alert(perro);
	habilitarBotonesAgregarQuitarCaballos();
}


function desasignarCaballo(){
	verificarCaballoMedios();
		
	var cantidadCaballosAsignados = document.getElementById("caballosAsignados").length;
	var caballosAsignados = document.getElementById("caballosAsignados");

	for (var i=0; i<cantidadCaballosAsignados; i++){
			var valorOption 	= document.getElementById('caballosAsignados').options[i].text;
			var letraInicial 	= valorOption.substring(0,1);
			var valorCodigo 	= valorOption; 
			//alert(letraInicial);

				
		 if(caballosAsignados.options[i].selected && letraInicial == "C") moverDatos('caballosAsignados','caballosDisponibles');

	
		 if(caballosAsignados.options[i].selected && letraInicial == "P")  moverDatos('caballosAsignados','perrosDisponibles');
		

	}

		
	ordenar(document.getElementById('caballosDisponibles'));
	ordenar(document.getElementById('perrosDisponibles'));
	
	
	habilitarBotonesAgregarQuitarVehiculos();
}

// FIN NUEVAS FUNCIONES

// NUEVA FUNCION SIMCCAR DISPONBLES
function selectSimccarDisponibles(unidad, nombreObjeto){

	var fechaServicio 		= document.getElementById('textFechaServicio').value;

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var correlativo			= document.getElementById("correlativoServicio").value;


	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+servicio+"&correlativo="+correlativo;

	objHttpXMLVehiculos.open("POST","./xml/xmlSim/xmlCaballosDisponibles.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));

	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculosreadyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "SIN DATOS"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;

				var codigo	 		= "";
				//var tipo	 			= "";
				var bcu	 	     	= "";
				var nombre	    = "";
				//var color ='style="color: #FF0000;';
				var simccar="";


				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					//tipo	 		 = xml.getElementsByTagName('tipo')[i].text;
					bcu	 	     = xml.getElementsByTagName('serie')[i].text;

          simccar    = "SIMCCAR";
					var descripcion	 = simccar + " (" + bcu + ")";

					var datosOpcion = new Option(descripcion, "S" + codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
				}
			} else {
				document.getElementById(nombreObjeto).length = null;
			}

			habilitarBotonesAgregarQuitarCaballos();
		}
	}
}

function asignarSimccar(){
	moverDatos('simccarDisponibles','simccarAsignados');
	ordenar(document.getElementById('simccarAsignados'));
	habilitarBotonesAgregarQuitarSimccar();
}


function desasignarSimccar(){
	//alert(document.getElementById('vehiculosDisponibles').value);
	//verificarSimccarMedios();
	moverDatos('simccarAsignados','simccarDisponibles');
	ordenar(document.getElementById('simccarDisponibles'));
	habilitarBotonesAgregarQuitarSimccar();
}


//
//	VERIFICA SI LOS VEHICULOS QUE HAN SIDO ASIGNADOS A UN SERVICIO,
//  ESTAN INCLUIDOS EN ALGUN MEDIO DE VIGILANCIA.
//
function verificarVehiculoMedios(){
	var cantidadVehiculosAsignados = document.getElementById("vehiculosAsignados").length;
	var vehiculosAsignados = document.getElementById("vehiculosAsignados");

	for (var i=0; i<cantidadVehiculosAsignados; i++){
		if (vehiculosAsignados.options[i].selected){
			var codVehiculoAsignado = vehiculosAsignados.options[i].value;
			//alert(codVehiculoAsignado);
			for (var j=0; j<arrayListaMV.length; j++){
				//alert(arrayListaMV[j][0]);
				if (codVehiculoAsignado == arrayListaMV[j][0]) {
					vehiculosAsignados.options[i].selected = false;
					alert(arrayListaMV[j][1]+ ", NO SE PUEDE SACAR DEL SERVICIO PORQUE ESTA ASIGNADO A UN MEDIO DE VIGILANCIA. PRIMERO DEBE MODIFICAR EL MEDIO DE VIGILANCIA.");
				}
			}
		}
	}
}

function verificarCaballoMedios(){
	var cantidadCaballosAsignados = document.getElementById("caballosAsignados").length;
	var caballosAsignados = document.getElementById("caballosAsignados");

	for (var i=0; i<cantidadCaballosAsignados; i++){
		if (caballosAsignados.options[i].selected){
			var codCaballoAsignado = caballosAsignados.options[i].value;
			//alert(codVehiculoAsignado);
			for (var j=0; j<arrayListaMV.length; j++){
				//alert(arrayListaMV[j][0]);
				if (codCaballoAsignado == arrayListaMV[j][9]) {
					caballosAsignados.options[i].selected = false;
					alert(arrayListaMV[j][10]+ ", NO SE PUEDE SACAR DEL SERVICIO PORQUE ESTA ASIGNADO A UN MEDIO DE VIGILANCIA. PRIMERO DEBE MODIFICAR EL MEDIO DE VIGILANCIA.");
				}
			}
		}
	}
}

//function verificarSimccarMedios(){
//	var cantidadVehiculosAsignados = document.getElementById("simccarAsignados").length;
//	var vehiculosAsignados = document.getElementById("simccarAsignados");

//	for (var i=0; i<cantidadVehiculosAsignados; i++){
//		if (vehiculosAsignados.options[i].selected){
//			var codVehiculoAsignado = vehiculosAsignados.options[i].value;
			//alert(codVehiculoAsignado);
//			for (var j=0; j<arrayListaMV.length; j++){
				//alert(arrayListaMV[j][0]);
//				if (codVehiculoAsignado == arrayListaMV[j][11]) {
//					vehiculosAsignados.options[i].selected = false;
//					alert(arrayListaMV[j][12]+ ", NO SE PUEDE SACAR DEL SERVICIO PORQUE ESTA ASIGNADO A UN MEDIO DE VIGILANCIA. PRIMERO DEBE MODIFICAR EL MEDIO DE VIGILANCIA.");
//				}
//			}
//		}
//	}
//}


function habilitarBotonesAgregarQuitarVehiculos(){
	var cantidadDisponible = document.getElementById('vehiculosDisponibles').length;
	var cantidadAsignado   = document.getElementById('vehiculosAsignados').length;

	if (cantidadDisponible == 0) document.getElementById('Btn_AgregarVehiculo').disabled = "true";
	else document.getElementById('Btn_AgregarVehiculo').disabled = "";

	if (cantidadAsignado == 0) document.getElementById('Btn_QuitarVehiculo').disabled = "true";
	else document.getElementById('Btn_QuitarVehiculo').disabled = "";


	document.getElementById('tituloVehiculoDisponible').innerHTML = "VEHICULOS DISPONIBLES (" + cantidadDisponible + ")";
	document.getElementById('tituloVehiculoAsignado').innerHTML = "VEHICULOS ASIGNADOS (" + cantidadAsignado + ")";
}

// NUEVA 16/10/2017
function habilitarBotonesAgregarQuitarCaballos(){
	var cantidadDisponible = document.getElementById('caballosDisponibles').length;
	var cantidadAsignado   = document.getElementById('caballosAsignados').length;
	var cantidadDisponible2 = document.getElementById('perrosDisponibles').length;
	var cantidadAsignado2   = document.getElementById('perrosAsignados').length;

	if (cantidadDisponible == 0 || cantidadDisponible2 == 0) document.getElementById('Btn_AgregarCaballo').disabled = "true";
	else document.getElementById('Btn_AgregarCaballo').disabled = "";

	if (cantidadAsignado == 0 || cantidadAsignado2 == 0 ) document.getElementById('Btn_QuitarCaballo').disabled = "true";
	else document.getElementById('Btn_QuitarCaballo').disabled = "";



	document.getElementById('tituloCaballoDisponible').innerHTML = "ANIMALES DISPONIBLES (" + cantidadDisponible + ")";
	document.getElementById('tituloCaballoAsignado').innerHTML = "ANIMALES ASIGNADOS (" + cantidadAsignado + ")";
}
//FIN NUEVA

function habilitarBotonesAgregarQuitarSimccar(){
	var cantidadDisponible = document.getElementById('simccarDisponibles').length;
	var cantidadAsignado   = document.getElementById('simccarAsignados').length;

	if (cantidadDisponible == 0) document.getElementById('Btn_AgregarSimccar').disabled = "true";
	else document.getElementById('Btn_AgregarSimccar').disabled = "";

	if (cantidadAsignado == 0) document.getElementById('Btn_QuitarSimccar').disabled = "true";
	else document.getElementById('Btn_QuitarSimccar').disabled = "";


	document.getElementById('tituloSimccarDisponible').innerHTML = "SIMCCAR DISPONIBLES (" + cantidadDisponible + ")";
	document.getElementById('tituloSimccarAsignado').innerHTML = "SIMCCAR ASIGNADOS (" + cantidadAsignado + ")";
}

function cantidadVehiculos(){

	var x 				 = document.getElementById('vehiculosAsignados')
	var cantidad   		 = x.length;

	//var cantidad 	 = document.getElementById('textCantidadVehiculos').value;
	var div		 	 = document.getElementById("listadoVehiculosAsignados");
	var sw		 	 = 0;
	var fondoLinea 	 = "";
	var listadoArmas = "<table border='0' align='left' cellspacing='1' cellpadding='1'>";

	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		listadoArmas += "<tr class='"+fondoLinea+"'>";
		listadoArmas += "<td width='441px'><input type='text' name='textVehiculoAsignado_"+i+"' id='textVehiculoAsignado' value='"+x.options[i].text+"' readonly></td>";
		listadoArmas += "<td width='130px'><input type='text' name='textKmInicial_"+i+"' id='textKmInicial'></td>";
		listadoArmas += "<td width='130px'><input type='text' name='textKmFinal_"+i+"' id='textKmFinal'></td>";
		listadoArmas += "<td width='130px'><input type='text' name='textCombustible_"+i+"' id='textCombustible'></td>";
		listadoArmas += "<td width='22px'><input type='checkbox' id='cbEliminarVehiculo'></td>";
		listadoArmas += "</tr>";
	}
	listadoArmas += "</table>";
	div.innerHTML = listadoArmas;

	//selectVehiculosDisponibles('610040000000', 'selVehiculo');
	//traspasarVehiculosAsignados();
}

function cantidadCaballos(){

	var x 				 = document.getElementById('caballosAsignados')
	var cantidad   		 = x.length;

	//var cantidad 	 = document.getElementById('textCantidadVehiculos').value;
	var div		 	 = document.getElementById("listadoCaballosAsignados");
	var sw		 	 = 0;
	var fondoLinea 	 = "";
	var listadoArmas = "<table border='0' align='left' cellspacing='1' cellpadding='1'>";

	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		listadoArmas += "<tr class='"+fondoLinea+"'>";
		listadoArmas += "<td width='441px'><input type='text' name='textCaballoAsignado_"+i+"' id='textCaballoAsignado' value='"+x.options[i].text+"' readonly></td>";
		listadoArmas += "<td width='22px'><input type='checkbox' id='cbEliminarVehiculo'></td>";
		listadoArmas += "</tr>";
	}
	listadoArmas += "</table>";
	div.innerHTML = listadoArmas;

	//selectVehiculosDisponibles('610040000000', 'selVehiculo');
	//traspasarVehiculosAsignados();
}

function cantidadSimccar(){

	var x 				 = document.getElementById('simccarAsignados')
	var cantidad   		 = x.length;

	//var cantidad 	 = document.getElementById('textCantidadVehiculos').value;
	var div		 	 = document.getElementById("listadoSimccarAsignados");
	var sw		 	 = 0;
	var fondoLinea 	 = "";
	var listadoArmas = "<table border='0' align='left' cellspacing='1' cellpadding='1'>";

	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		listadoArmas += "<tr class='"+fondoLinea+"'>";
		listadoArmas += "<td width='441px'><input type='text' name='textSimccarAsignado_"+i+"' id='textSimccarAsignado' value='"+x.options[i].text+"' readonly></td>";
		listadoArmas += "<td width='22px'><input type='checkbox' id='cbEliminarVehiculo'></td>";
		listadoArmas += "</tr>";
	}
	listadoArmas += "</table>";
	div.innerHTML = listadoArmas;

	//selectVehiculosDisponibles('610040000000', 'selVehiculo');
	//traspasarVehiculosAsignados();
}




//function traspasarVehiculosAsignados(){
//	var x = document.getElementById('vehiculosAsignados');
//
//	for (var i=0;i<x.length; i++){
//		document.getElementById('textVehiculoAsignado')[i].value = x.options[i].text;
//		//alert(x.options[i].text);
//	}
//
//}

var cargaCantidadArmas;
function cantidadArmas(){
	cargaCantidadArmas = 0;
	var cantidad 	 = document.getElementById('textCantidadArmas').value;
	var div		 	 = document.getElementById("listadoArmas");
	var sw		 	 = 0;
	var fondoLinea 	 = "";
	var listadoArmas = "<table border='0' align='left' cellspacing='1' cellpadding='1'>";

	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		listadoArmas += "<tr class='"+fondoLinea+"'>";
		listadoArmas += "<td width='263px'><select id='selTipoArma' name='selTipoArma_"+i+"'></select></td>";
		listadoArmas += "<td width='175px'><input type='text' id='textIdentificacionArma' name='textIdentificacionArma_"+i+"'></td>";
		listadoArmas += "<td width='397px'><select id='selResponsableArma' name='selResponsableArma_"+i+"'></select></td>";
		listadoArmas += "<td width='22px'><input type='checkbox' id='cbEliminar'></td>";
		listadoArmas += "</tr>";
	}
	listadoArmas += "</table>";
	div.innerHTML = listadoArmas;

	for(i=0;i<cantidad;i++){
		leeTipoArma('selTipoArma_'+i);
		listarPersonalAsignado('selResponsableArma_'+i);
	}

	cargaCantidadArmas = 1;
}


function cantidadAnimalesAsignados(){

	var cantidad 		= document.getElementById('textCantidadAnimales').value;
	var div		 		= document.getElementById("listadoAnimalesAsignados");
	var sw		 		= 0;
	var fondoLinea 		= "";
	var listadoAnimales = "<table border='0' align='left' cellspacing='1' cellpadding='1'>";

	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		listadoAnimales += "<tr class='"+fondoLinea+"'>";
		listadoAnimales += "<td width='263px'><select id='selTipoAnimal' name='selTipoAnimal_"+i+"'></select></td>";
		listadoAnimales += "<td width='175px'><input type='text' id='textIdentificacionAnimal' name='textIdentificacionAnimal_"+i+"'></td>";
		listadoAnimales += "<td width='396px'></td>"; //<select id='selResponsableAnimal' name='selResponsableAnimal_"+i+"'></select></td>";
		listadoAnimales += "<td width='22px'><input type='checkbox' id='cbEliminarAnimal'></td>";
		listadoAnimales += "</tr>";
	}
	listadoAnimales += "</table>";
	div.innerHTML = listadoAnimales;

	for(i=0;i<cantidad;i++) {
		leeTipoAnimal('selTipoAnimal_'+i);
		//listarPersonalAsignado('selResponsableAnimal_'+i);
	}
}

function cantidadAccesoriosAsignados(){

	var cantidad 		= document.getElementById('textCantidadAccesorios').value;
	var div		 		= document.getElementById("listadoAccesoriosAsignados");
	var sw		 		= 0;
	var fondoLinea 		= "";
	var listadoAnimales = "<table border='0' align='left' cellspacing='1' cellpadding='1'>";

	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		listadoAnimales += "<tr class='"+fondoLinea+"'>";
		listadoAnimales += "<td width='263px'><select id='selTipoAccesorio' name='selTipoAccesorio_"+i+"'></select></td>";
		listadoAnimales += "<td width='175px'><input type='text' id='textCantAccesorio' name='textCantAccesorio_"+i+"'></td>";
		listadoAnimales += "<td width='378px'></td>";
		listadoAnimales += "<td width='41px'><input type='checkbox' id='cbEliminarAccesorio'></td>";
		listadoAnimales += "</tr>";
	}
	listadoAnimales += "</table>";
	div.innerHTML = listadoAnimales;

	for(i=0;i<cantidad;i++) {
		leeTipoAccesorio('selTipoAccesorio_'+i);
	}

}

function listarPersonalAsignado(nombreObjeto){

	var x = document.getElementById('personalAsignado');

	//alert(document.getElementById(nombreObjeto).length);

	document.getElementById(nombreObjeto).length = null;
	//var datosOpcion = new Option("SELECCIONE FUNCIONARIO ... ", 0, "", "");
	//document.getElementById(nombreObjeto).options[0] = datosOpcion;

	//alert(x.length);
	var idest = 0;
	for (var i=0;i<x.length; i++){
		var codigo 		= x.options[i].value;
		var descripcion = x.options[i].text;

		var agregar = true;
		for (var j=0; j<arrayListaMV.length; j++){
			for (var k=0; k<arrayListaMV[j][4].length; k++){
				//alert(arrayListaMV[j][4][k]);
				if (codigo == arrayListaMV[j][4][k]) agregar = false;
				//alert(agregar);
			}
		}

		if (agregar){
			var datosOpcion = new Option(descripcion, codigo, "", "");
			document.getElementById(nombreObjeto).options[idest] = datosOpcion;
			idest++;
		}
	}
}


function listarVehiculoAsignado(nombreObjeto){

	var x = document.getElementById('vehiculosAsignados');
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("SIN VEHICULO (INFANTERIA)", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;

	//alert("Vehiculo");
	var idest = 1;
	for (var i=0;i<x.length; i++){
		var codigo 		= x.options[i].value;
		var descripcion = x.options[i].text;

		var agregar = true;
		for (var j=0; j<arrayListaMV.length; j++){
			if (codigo == arrayListaMV[j][0]) agregar = false;
		}

		if (agregar){
			var datosOpcion = new Option(descripcion, codigo, "", "");
			document.getElementById(nombreObjeto).options[idest] = datosOpcion;
			idest++;
		}
	}
}

//FUNCION NUEVA 20-10-2017
function listarCaballosAsignado(nombreObjeto){

	var z = document.getElementById('caballosAsignados');
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("SIN ANIMAL", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;

	//alert("Caballo");
	var idest = 1;
	for (var i=0;i<z.length; i++){
		var codigo 		= z.options[i].value;
		var descripcion = z.options[i].text;

		var agregar = true;
		for (var j=0; j<arrayListaMV.length; j++){
			if (codigo == arrayListaMV[j][9]) agregar = false;
		}

		if (agregar){
			var datosOpcion = new Option(descripcion, codigo, "", "");
			document.getElementById(nombreObjeto).options[idest] = datosOpcion;
			idest++;
		}
	}
}
//FIN

function listarSimccarAsignado(nombreObjeto){

	var y = document.getElementById('simccarAsignados');
	//alert(document.getElementById(nombreObjeto).length);
	document.getElementById(nombreObjeto).length = null;
	//var datosOpcion = new Option("SIN SIMCCAR", 0, "", "");
	//document.getElementById(nombreObjeto).options[0] = datosOpcion;

	//alert("Vehiculo");
	var idest = 0;
	for (var i=0;i<y.length; i++){
		var codigo 		= y.options[i].value;
		var descripcion = y.options[i].text;

		var agregar = true;
		for (var j=0; j<arrayListaMV.length; j++){
			if (codigo == arrayListaMV[j][11]) agregar = false;
		}

		if (agregar){
			var datosOpcion = new Option(descripcion, codigo, "", "");
			document.getElementById(nombreObjeto).options[idest] = datosOpcion;
			idest++;
		}
	}
}






var idCargaArmasAsignadas;
function buscaDatosServicio(unidad, servicio, fecha){
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlVistaServicio.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("unidad="+unidad+"&fecha="+fecha+"&servicio="+servicio));
	objHttpXMLServicios.onreadystatechange=function()
	{
		if(objHttpXMLServicios.readyState == 4)
		{
			//alert(objHttpXMLServicios.responseText);
			var xml = objHttpXMLServicios.responseXML.documentElement;
			var codigoServicio 	= xml.getElementsByTagName('codigoServicio')[0].text;
			var nombreServicio 	= xml.getElementsByTagName('nombreServicio')[0].text;
			var fechaServicio 	= xml.getElementsByTagName('fecha')[0].text;
			var horaInicio 		= xml.getElementsByTagName('horaInicio')[0].text;
			var horaTermino 	= xml.getElementsByTagName('horaTermino')[0].text;

			document.getElementById("selServicio").value 		= codigoServicio;
			document.getElementById("textFechaServicio").value 	= fechaServicio;
			document.getElementById("selHoraInicio").value 		= horaInicio;
			document.getElementById("selHoraTermino").value 	= horaTermino;

			if (xml.getElementsByTagName('funcionariosAsignados').length>0){
				var funcionariosAsignados 	= xml.getElementsByTagName('funcionariosAsignados')[0];
				var nombreObjeto			= "personalAsignado";
				cargaFuncionariosAsignados(funcionariosAsignados, nombreObjeto);
			}

			if (xml.getElementsByTagName('vehiculosAsignados').length>0){
				var vehiculosAsignados 	= xml.getElementsByTagName('vehiculosAsignados')[0];
				var nombreObjeto		= "vehiculosAsignados";
				cargaVehiculosAsignados(vehiculosAsignados, nombreObjeto);
			}


			if (xml.getElementsByTagName('armasAsignadas').length>0){
				var armasAsignadas = xml.getElementsByTagName('armasAsignadas')[0];
				document.getElementById('textCantidadArmas').value = armasAsignadas.getElementsByTagName('arma').length;
				cantidadArmas();
				//alert();
				//var funcionEjecutar = "cargaArmasAsignadas(armasAsignadas2)";
				//alert(armasAsignadas);
				//idCargaArmasAsignadas = setInterval(cargaArmasAsignadas(armasAsignadas),1000);
				cargaArmasAsignadas(armasAsignadas);
			}

			if (xml.getElementsByTagName('animalesAsignados').length>0){
				var animalesAsignados = xml.getElementsByTagName('animalesAsignados')[0];
				document.getElementById('textCantidadAnimales').value = animalesAsignados.getElementsByTagName('animal').length;
				cantidadAnimalesAsignados();
				cargaAnimalesAsignados(animalesAsignados);
			}

			if (xml.getElementsByTagName('accesoriosAsignados').length>0){
				var accesoriosAsignados = xml.getElementsByTagName('accesoriosAsignados')[0];
				document.getElementById('textCantidadAccesorios').value = accesoriosAsignados.getElementsByTagName('accesorio').length;
				cantidadAccesoriosAsignados();
				cargaAccesoriosAsignados(accesoriosAsignados);
			}

		}
	}
}

function cargaFuncionariosAsignados(funcionariosAsignados, nombreObjeto){
	var codigo, apellidoPaterno, apellidoMaterno, nombre, grado, nombreCompleto;

	document.getElementById(nombreObjeto).length = null;
	for(i=0;i<funcionariosAsignados.getElementsByTagName('funcionario').length;i++){
		codigo	 		= funcionariosAsignados.getElementsByTagName('codigo')[i].text;
		apellidoPaterno	= funcionariosAsignados.getElementsByTagName('apellidoPaterno')[i].text;
		apellidoMaterno	= funcionariosAsignados.getElementsByTagName('apellidoMaterno')[i].text;
		nombre		 	= funcionariosAsignados.getElementsByTagName('nombre')[i].text;
		grado	 		= funcionariosAsignados.getElementsByTagName('grado')[i].text;

		nombreCompleto	= apellidoPaterno + " " + apellidoMaterno + ", " + nombre + " (" +grado+")";

		var datosOpcion = new Option(nombreCompleto, codigo, "", "");
		document.getElementById(nombreObjeto).options[i] = datosOpcion;

	}
}

function cargaVehiculosAsignados(vehiculosAsignados, nombreObjeto){
	var codigo, tipo, patente, kmInicial, kmFinal, totalKms, combustible, descripcion;

	document.getElementById(nombreObjeto).length = null;
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		codigo	 	= vehiculosAsignados.getElementsByTagName('codigo')[i].text;
		tipo	 	= vehiculosAsignados.getElementsByTagName('tipo')[i].text;
		patente		= vehiculosAsignados.getElementsByTagName('patente')[i].text;

		descripcion = tipo + " ("+patente+")";

		var datosOpcion = new Option(descripcion, codigo, "", "");
		document.getElementById(nombreObjeto).options[i] = datosOpcion;
	}
	cantidadVehiculos();
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		codigo	 	= vehiculosAsignados.getElementsByTagName('codigo')[i].text;
		tipo	 	= vehiculosAsignados.getElementsByTagName('tipo')[i].text;
		patente		= vehiculosAsignados.getElementsByTagName('patente')[i].text;
		kmInicial	= vehiculosAsignados.getElementsByTagName('kmInicial')[i].text;
		kmFinal		= vehiculosAsignados.getElementsByTagName('kmFinal')[i].text;
		totalKms	= vehiculosAsignados.getElementsByTagName('totalKms')[i].text;
		combustible	= vehiculosAsignados.getElementsByTagName('combustible')[i].text;

		descripcion = tipo + " ("+patente+")";

		var objetoVehiculo		= "textVehiculoAsignado_" + i;
		var objetoKmInicial 	= "textKmInicial_" + i;
		var objetoKmFinal 		= "textKmFinal_" + i;
		var objetoCombustible 	= "textCombustible_" + i;

		document.getElementById(objetoVehiculo).value 		= descripcion;
		document.getElementById(objetoKmInicial).value  	= kmInicial;
		document.getElementById(objetoKmFinal).value  		= kmFinal;
		document.getElementById(objetoCombustible).value  	= combustible;
	}
}

function cargaCaballosAsignados(caballosAsignados, nombreObjeto){
	var codigo, tipo, patente, descripcion;

	document.getElementById(nombreObjeto).length = null;
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		codigo	 	= vehiculosAsignados.getElementsByTagName('codigo')[i].text;
		tipo	 	= vehiculosAsignados.getElementsByTagName('tipo')[i].text;
		patente		= vehiculosAsignados.getElementsByTagName('nombre')[i].text;

		descripcion = tipo + " ("+patente+")";

		var datosOpcion = new Option(descripcion, codigo, "", "");
		document.getElementById(nombreObjeto).options[i] = datosOpcion;
	}
	cantidadCaballos();
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		codigo	 	= vehiculosAsignados.getElementsByTagName('codigo')[i].text;
		tipo	 	= vehiculosAsignados.getElementsByTagName('tipo')[i].text;
		patente		= vehiculosAsignados.getElementsByTagName('nombre')[i].text;


		descripcion = tipo + " ("+patente+")";

		var objetoVehiculo		= "textVehiculoAsignado_" + i;


		document.getElementById(objetoVehiculo).value 		= descripcion;

	}
}

function cargaSimccarAsignados(simccarAsignados, nombreObjeto){
	var codigo, serie, descripcion;

	document.getElementById(nombreObjeto).length = null;
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		var simccar="SIMCCAR";
		codigo	 	= vehiculosAsignados.getElementsByTagName('codigoSimccar')[i].text;
		serie	 	= vehiculosAsignados.getElementsByTagName('serieSimccar')[i].text;


		descripcion = simccar + " ("+serie+")";

		var datosOpcion = new Option(descripcion, codigo, "", "");
		document.getElementById(nombreObjeto).options[i] = datosOpcion;
	}
	cantidadSimccar();
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		var simccar="SIMCCAR";
		codigo	 	= vehiculosAsignados.getElementsByTagName('codigoSimccar')[i].text;
		serie	 	= vehiculosAsignados.getElementsByTagName('serieSimccar')[i].text;



		descripcion = simccar + " ("+serie+")";

		var objetoVehiculo		= "textSimccarAsignado_" + i;


		document.getElementById(objetoVehiculo).value 		= descripcion;

	}
}

function cargaArmasAsignadas(armasAsignadas){
	alert("cargaCantidadArmas : " + cargaCantidadArmas);
	if (cargaCantidadArmas == 1){

		//alert(armasAsignadas.getElementsByTagName('arma').length);
		for(i=0;i<armasAsignadas.getElementsByTagName('arma').length;i++){
			//alert();
			var codigoTipoArma	 	= armasAsignadas.getElementsByTagName('codigoTipo')[i].text;
			var numeroArma	 		= armasAsignadas.getElementsByTagName('numero')[i].text;
			var codigoResponsable	= armasAsignadas.getElementsByTagName('codigoFuncionario')[i].text;

			var objetoArma 			= "selTipoArma_" + i;
			var objetoNumeroArma 	= "textIdentificacionArma_" + i;
			var objetoResponsable 	= "selResponsableArma_" + i;

			document.getElementById(objetoArma).value 		 = codigoTipoArma;
			document.getElementById(objetoNumeroArma).value  = numeroArma;
			document.getElementById(objetoResponsable).value = codigoResponsable;

			//alert(i + " --> " + codigoTipoArma + " --> " + numeroArma + " --> " + codigoResponsable);
			//alert("objetoArma : " + objetoArma);
			//alert(document.getElementById(objetoArma).value);
		}

		clearInterval(idCargaArmasAsignadas);
	}
	//alert();
}


function cargaAnimalesAsignados(animalesAsignados){

	//alert("ANIMAL");
	for(i=0;i<animalesAsignados.getElementsByTagName('animal').length;i++){
		//alert();
		var codigoTipo	 	= animalesAsignados.getElementsByTagName('codigoTipo')[i].text;
		var cantidad 		= animalesAsignados.getElementsByTagName('cantidad')[i].text;

		var objetoTipo 		= "selTipoAnimal_" + i;
		var objetoCantidad 	= "textIdentificacionAnimal_" + i;

		//alert(codigoTipo);
		document.getElementById(objetoTipo).value 	   = codigoTipo;
		document.getElementById(objetoCantidad).value  = cantidad;
	}
}


function cargaAccesoriosAsignados(accesoriosAsignados){

	//alert(armasAsignadas.getElementsByTagName('arma').length);
	//alert();
	for(i=0;i<accesoriosAsignados.getElementsByTagName('accesorio').length;i++){
		//alert();
		var codigoTipo	 	= accesoriosAsignados.getElementsByTagName('codigoTipo')[i].text;
		var cantidad 		= accesoriosAsignados.getElementsByTagName('cantidad')[i].text;

		var objetoTipo 		= "selTipoAccesorio_" + i;
		var objetoCantidad 	= "textCantAccesorio_" + i;

		//alert(codigoTipo);
		document.getElementById(objetoTipo).value 	   = codigoTipo;
		document.getElementById(objetoCantidad).value  = cantidad;
	}
}


//MEDIOS DE VIGILANCIA

var arrayListaMV = new Array();
function agregaMedioVigilancia(validar){

	if (validar == 1) var validaOk = validaMedioVigilancia();
	else var validaOK = "True";

	if (validaOk){
		var arrayPersonalMV 		= new Array();
		var arrayPersonalDescMV 	= new Array();
		var arrayCuadranteMV		= new Array();
		//var arrayFactorMV			= new Array();
		var arrayMedioVigilancia	= new Array();

		var largoPersonalMV 		= document.getElementById('personalServicioMedio').length;
		var CantCuadrantes 			= document.getElementById('cuadrantesMV').length;
		var idVehiculo 				= document.getElementById('vehiculosServicio').value;

		var idCaballo 				= document.getElementById('caballosServicio').value;
		
		//var idSimccar 				= document.getElementById('simccarServicio').value;
    //alert(idVehiculo);
		//alert(idVehiculo);
		if (idVehiculo != "") var descVehiculo = document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex].text;
		else var descVehiculo = "";

		if (idCaballo != "") var descCaballo = document.getElementById('caballosServicio').options[document.getElementById('caballosServicio').selectedIndex].text;
		else var descCaballo = "";
			
		//if (idSimccar != "") var descSimccar = document.getElementById('simccarServicio').options[document.getElementById('simccarServicio').selectedIndex].text;
		//else var descSimccar = "";	

     //alert("Codigo: "+idCaballo);
		//alert("Nombre: "+descCaballo);

		var kmInicial 				= document.getElementById('textKmInicial').value;
		var kmFinal 				= document.getElementById('textKmFinal').value;

		var idFactor				= document.getElementById('factorMV').value;
		var descFactor 				= document.getElementById('factorMV').options[document.getElementById('factorMV').selectedIndex].text;

		for (i=0;i<largoPersonalMV;i++){
			//alert(document.getElementById('personalServicioMedio').options[i].value);
			arrayPersonalMV[arrayPersonalMV.length] = document.getElementById('personalServicioMedio').options[i].value;
			arrayPersonalDescMV[arrayPersonalDescMV.length] = document.getElementById('personalServicioMedio').options[i].text;
		}

		for (i=0;i<CantCuadrantes;i++){
			if (document.getElementById('cuadrantesMV').options[i].selected) {
				//alert(document.getElementById('cuadrantesMV').options[i].value);
				arrayCuadranteMV[arrayCuadranteMV.length] = document.getElementById('cuadrantesMV').options[i].value;
			}
		}

		var kmInicialPaso = new	oNumero(kmInicial);

		arrayMedioVigilancia[0] = idVehiculo;
		arrayMedioVigilancia[1] = descVehiculo;
		arrayMedioVigilancia[2] = kmInicial;
		arrayMedioVigilancia[3] = kmFinal;
		arrayMedioVigilancia[4] = arrayPersonalMV;
		arrayMedioVigilancia[5] = arrayCuadranteMV;
		arrayMedioVigilancia[6] = arrayPersonalDescMV;
		arrayMedioVigilancia[7] = idFactor;
		arrayMedioVigilancia[8] = descFactor;
		arrayMedioVigilancia[9] = idCaballo;
		arrayMedioVigilancia[10] = descCaballo;
		//arrayMedioVigilancia[11] = idSimccar;
		//arrayMedioVigilancia[12] = descSimccar;

		if (document.getElementById('idMV').value != "") {
			var punteroArrayMV = document.getElementById('idMV').value;
			document.getElementById('idMV').value = "";
		} else {
			var punteroArrayMV = arrayListaMV.length;
		}

		arrayListaMV[punteroArrayMV] = arrayMedioVigilancia;
		if (idVehiculo != 0) document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex] = null;
		if (idCaballo != 0) document.getElementById('caballosServicio').options[document.getElementById('caballosServicio').selectedIndex] = null;
		//if (idSimccar != 0) document.getElementById('simccarServicio').options[document.getElementById('simccarServicio').selectedIndex] = null;

    //seleccionaSimccarMedioVigilancia();
    seleccionaCaballoMedioVigilancia();
		seleccionaVehiculoMedioVigilancia();
		listaMediosVigilancia();
	}
}


function seleccionaVehiculoMedioVigilancia(){
	//alert(document.getElementById('vehiculosServicio').value);
	if (document.getElementById('vehiculosServicio').value == 0){
		
		document.getElementById('caballosServicio').disabled = "";
    document.getElementById('caballosServicio').style.backgroundColor = "";

		document.getElementById('textKmInicial').value = "";
		document.getElementById('textKmFinal').value = "";

		document.getElementById('labKmInicial').disabled = "true";
		document.getElementById('textKmInicial').disabled = "true";
		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";

		document.getElementById('labKmFinal').disabled = "true";
		document.getElementById('textKmFinal').disabled = "true";
		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
	} else {
		document.getElementById('caballosServicio').disabled = "true";
    document.getElementById('caballosServicio').style.backgroundColor = "#D4D4D4";
		
		document.getElementById('labKmInicial').disabled = "";
		document.getElementById('textKmInicial').disabled = "";
		document.getElementById('textKmInicial').style.backgroundColor = "";

		document.getElementById('labKmFinal').disabled = "";
		document.getElementById('textKmFinal').disabled = "";
		document.getElementById('textKmFinal').style.backgroundColor = "";

	}
}

function seleccionaCaballoMedioVigilancia(){
	//alert(document.getElementById('vehiculosServicio').value);
	if (document.getElementById('caballosServicio').value == 0){
		
		document.getElementById('vehiculosServicio').disabled = "";
    document.getElementById('vehiculosServicio').style.backgroundColor = "";
    /*
    document.getElementById('labKmInicial').disabled = "true";
		document.getElementById('textKmInicial').disabled = "true";
		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";
		
		document.getElementById('labKmFinal').disabled = "true";
		document.getElementById('textKmFinal').disabled = "true";
		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
		
		document.getElementById('labKmInicial').disabled = "";
		document.getElementById('textKmInicial').disabled = "";
		document.getElementById('textKmInicial').style.backgroundColor = "";

		document.getElementById('labKmFinal').disabled = "";
		document.getElementById('textKmFinal').disabled = "";
		document.getElementById('textKmFinal').style.backgroundColor = "";
		*/
	}else {

		document.getElementById('vehiculosServicio').disabled = "true";
    document.getElementById('vehiculosServicio').style.backgroundColor = "#D4D4D4";
		/*
		document.getElementById('textKmInicial').value = "";
		document.getElementById('textKmFinal').value = "";
		
		document.getElementById('labKmInicial').disabled = "true";
		document.getElementById('textKmInicial').disabled = "true";
		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";

		document.getElementById('labKmFinal').disabled = "true";
		document.getElementById('textKmFinal').disabled = "true";
		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
		*/
	} 
}

//function seleccionaSimccarMedioVigilancia(){
	//alert(document.getElementById('vehiculosServicio').value);
//	if (document.getElementById('simccarServicio').value == 0){
//		
//		document.getElementById('vehiculosServicio').disabled = "";
//   document.getElementById('vehiculosServicio').style.backgroundColor = "";
    
//    document.getElementById('labKmInicial').disabled = "true";
//		document.getElementById('textKmInicial').disabled = "true";
//		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";
		
//		document.getElementById('labKmFinal').disabled = "true";
//		document.getElementById('textKmFinal').disabled = "true";
//		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
		
//	}else {

//		document.getElementById('vehiculosServicio').disabled = "true";
//    document.getElementById('vehiculosServicio').style.backgroundColor = "#D4D4D4";

//		document.getElementById('textKmInicial').value = "";
//		document.getElementById('textKmFinal').value = "";

//		document.getElementById('labKmInicial').disabled = "true";
//		document.getElementById('textKmInicial').disabled = "true";
//		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";

//		document.getElementById('labKmFinal').disabled = "true";
//		document.getElementById('textKmFinal').disabled = "true";
//		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";

//	} 
//}


function borraMedioVigilancia(){
	var elementoBorrar = document.getElementById('idMV').value;
	arrayListaMV.splice(elementoBorrar,1);
	document.getElementById('idMV').value = "";
	moverDatos('personalServicioMedio', 'personalServicio', true);
	limpiaMedioVigilancia();
	listaMediosVigilancia();
}


function validaMedioVigilancia(){

	var cantPersonal  = document.getElementById('personalServicioMedio').length;
	var kmInicial 	  = eliminarBlancos(document.getElementById('textKmInicial').value);
	var kmFinal 	  = eliminarBlancos(document.getElementById('textKmFinal').value);
	var planCuadrante = eliminarBlancos(document.getElementById('tienePlanCuadrante').value);
	var idCaballo 				= document.getElementById('caballosServicio').value;

	if (cantPersonal == 0) {
		alert("NO EXISTE PERSONAL SELECCIONADO ...     ");
		//document.getElementById('personalServicio').options[0].selected = true;
		//document.getElementById('personalServicio').focus();
		return false;
	}
	
	//if (cantPersonal > 1 && idCaballo != "") {
	//	alert("NO PUEDE ASIGNAR MAS DE UN FUNCIONARIO A UN ANIMAL ...     ");
		//document.getElementById('personalServicio').options[0].selected = true;
		//document.getElementById('personalServicio').focus();
	//	return false;
	//}

	//alert(document.getElementById('vehiculosServicio').value);

	//alert(IsNumeric(kmInicial));
	if (document.getElementById('vehiculosServicio').value != 0){

		if (kmInicial == ""){
			alert("DEBE INGRESAR KILOMETRAJE INICIAL ...     ");
			document.getElementById('textKmInicial').value = "";
			//document.getElementById('textKmInicial').focus();
			return false;
		}

		if (IsNumeric(kmInicial) == false){
			alert("DEBE INGRESAR KILOMETRAJE INICIAL VALIDO...     ");
			//document.getElementById('textKmInicial').focus();
			return false;
		}


		var codigoVehiculoPaso = document.getElementById('vehiculosServicio').value;
		var ultimoKmsVehiculo;
		//ultimoKmsVehiculo = leeUltimoKmVehiculo(codigoVehiculoPaso);
		//
		//if (kmInicial*1 < ultimoKmsVehiculo){
		//	alert("EL KILOMETRAJE INICIAL NO PUEDE SER INFERIOR A "+ultimoKmsVehiculo+" ....  ");
		//	//document.getElementById('textKmFinal').focus();
		//	return false;
		//}

		if (kmFinal == ""){
			alert("DEBE INGRESAR KILOMETRAJE FINAL ...     ");
			document.getElementById('textKmFinal').value = "";
			//document.getElementById('textKmFinal').focus();
			return false;
		}

		if (IsNumeric(kmFinal) == false){
			alert("DEBE INGRESAR KILOMETRAJE FINAL VALIDO...     ");
			//document.getElementById('textKmFinal').focus();
			return false;
		}

		if (kmFinal*1 <= kmInicial*1){
			alert("EL KILOMETRAJE FINAL NO PUEDE SER MENOR O IGUAL QUE EL KILOMETRAJE INICIAL ....  ");
			//document.getElementById('textKmFinal').focus();
			return false;
		}

		var cantidadKilometros = kmFinal - kmInicial;
		if (cantidadKilometros>2500){
			alert("LA CANTIDAD DE KILOMETROS INGRESADOS EXCEDE LO ACEPTABLE PARA UN SERVICIO POLICIAL.         \nPARA CONSULTAS ANEXO NRO. 20843 O 20845.");

			//document.getElementById('textKmFinal').focus();
			return false;
		}
	}

	var opcionServicio  = document.getElementById("selServicio").value;
	var tipoServicio 	= opcionServicio.substr(0,1);
	var servicio 		= opcionServicio.substr(1,opcionServicio.length);

	if (planCuadrante == 1 && (tipoServicio == "O" || tipoServicio == "F") && servicio != 2000){

		var seleccionoCuadrante = 0;
		for (var i=0; i<document.getElementById('cuadrantesMV').length; i++){
			if (document.getElementById('cuadrantesMV').options[i].selected) seleccionoCuadrante = 1;
		}

		if (seleccionoCuadrante == 0){
			alert("DEBE SELECCIONAR UN CUADRANTE ....         ");
			return false;
		}

		var factorMV = document.getElementById('factorMV').value;
		if (factorMV == 0){
			alert("DEBE SELECCIONAR UN FACTOR DE LA DEMANDA ....  ");
			//document.getElementById('factorMV').focus();
			return false;
		}
	}

	return true;
}


function limpiaMedioVigilancia(){
	document.getElementById('personalServicioMedio').length = null;
	document.getElementById('textKmInicial').value 			= "";
	document.getElementById('textKmFinal').value 			= "";
	document.getElementById('vehiculosServicio').value		= 0;
	document.getElementById('factorMV').value				= 0;
	document.getElementById('caballosServicio').value				= 0;
	//document.getElementById('simccarServicio').value				= 0;
	for (i=0; i<document.getElementById('cuadrantesMV').length; i++){
		document.getElementById('cuadrantesMV').options[i].selected = false;
	}
	document.getElementById('btnEliminaMV').disabled = true;
}


function listaMediosVigilancia(){
	//alert(arrayListaMV[0]);
	var listaMedios = "";
	var sw = 0;
	var fondoLinea;

	listaMedios += "<table border='0' cellspacing='1' cellpadding='1'>";
	for (var i=0; i<arrayListaMV.length; i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		var resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
		var lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";

		//if (arregloProblemas[i][2].length > 47) var descripcionProblema = arregloProblemas[i][2].substring(0,45) + "...";
		//else var descripcionProblema = arregloProblemas[i][2];

		//alert(arrayListaMV[i][5].length);
		var descripcionCuadrantes = "";
		for (var j=0; j<arrayListaMV[i][5].length; j++){

			for (var k=0; k<document.getElementById('cuadrantesMV').length; k++){
				//alert(document.getElementById('cuadrantesMV').options[k].value + " --> " + arrayListaMV[i][5][j]);
				if (document.getElementById('cuadrantesMV').options[k].value == arrayListaMV[i][5][j]){
					var pasoDescCuadrante = document.getElementById('cuadrantesMV').options[k].text.split(" ");
					descripcionCuadrantes += pasoDescCuadrante[1] + ",";
				}
			}
		}

		//alert(arrayListaMV[i][7]);

		if (arrayListaMV[i][7] != 0) var descripcionFactor = " (FACTOR: " + arrayListaMV[i][8] + ")";
		else var descripcionFactor = "";
		
	  if (arrayListaMV[i][0] == 0) var medios1 = "SIN VEHICULO (INFANTERIA), ";
	  else var medios1 = arrayListaMV[i][1]+", ";
		
		if (arrayListaMV[i][9] == 0) var medios2 = " SIN ANIMAL, ";
		else var medios2 = arrayListaMV[i][10]+", ";
		
		//if (arrayListaMV[i][0] == 0) var medios = arrayListaMV[i][12];
		//else var medios =  arrayListaMV[i][1];	
			

		descripcionCuadrantes = descripcionCuadrantes.substring(0,descripcionCuadrantes.length-1);
		listaMedios += "<tr id='linea"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onclick='muestraMedioViginlacia("+i+")'>";
		listaMedios += "<td width='356px' style='padding:0px 0px 0px 5px' align='left'>"+ medios1 + medios2 + descripcionFactor +"</td>";
		listaMedios += "<td width='136px' style='padding:0px 0px 0px 0px' align='center'>"+arrayListaMV[i][4].length+"</td>";
		//listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='right'>"+arrayListaMV[i][2]+"</td>";
		//listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='right'>"+arrayListaMV[i][3]+"</td>";

		listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='center'>"+formato_numero(arrayListaMV[i][2],0,',','.')+"</td>";
		listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='center'>"+formato_numero(arrayListaMV[i][3],0,',','.')+"</td>";
		//listaMedios += "<td width='117px' style='padding:0px 0px 0px 0px' align='center'>"+arrayListaMV[i][5]+"</td>";
		listaMedios += "<td width='119px' style='padding:0px 0px 0px 0px' align='center'>"+descripcionCuadrantes+"</td>";
		listaMedios += "<tr>";

		//alert(problemas);
	}
	listaMedios += "</table>";
	document.getElementById("listadoMediosVigilancia").innerHTML = listaMedios;

	limpiaMedioVigilancia();
}



function muestraMedioViginlacia(numero){
	//alert(document.getElementById('idMV').value);
	if (document.getElementById('idMV').value == ""){
		
		//alert(document.getElementById('vehiculosServicio').selectedIndex);

		//var objeto = "document.getElementById('linea"+numero+"')";
		//cambiarClase(objeto, 'lineaMarcada');

		var nombreObjeto = "linea"+numero;
		document.getElementById(nombreObjeto).className = 'lineaMarcada';
		document.getElementById(nombreObjeto)['onmouseout'] = new Function("this.className = 'lineaMarcada'");

		if (document.getElementById('idMV').value != 0) document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex] = null;
		
		if (document.getElementById('idMV').value != 0) document.getElementById('caballosServicio').options[document.getElementById('caballosServicio').selectedIndex] = null;
		
		//if (document.getElementById('idMV').value != 0) document.getElementById('simccarServicio').options[document.getElementById('simccarServicio').selectedIndex] = null;

		document.getElementById('idMV').value 				= numero;
		document.getElementById('textKmInicial').value 		= arrayListaMV[numero][2];
		document.getElementById('textKmFinal').value   		= arrayListaMV[numero][3];
		document.getElementById('factorMV').value			= arrayListaMV[numero][7];

		if (arrayListaMV[numero][0] != 0){
			var datosOpcion = new Option(arrayListaMV[numero][1], arrayListaMV[numero][0], "", "");
			document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').length] = datosOpcion;
		}
		
		if (arrayListaMV[numero][9] != 0){
			var datosOpcion = new Option(arrayListaMV[numero][10], arrayListaMV[numero][9], "", "");
			document.getElementById('caballosServicio').options[document.getElementById('caballosServicio').length] = datosOpcion;
		}
		
	//	if (arrayListaMV[numero][11] != 0){
	//		var datosOpcion = new Option(arrayListaMV[numero][12], arrayListaMV[numero][11], "", "");
	//		document.getElementById('simccarServicio').options[document.getElementById('simccarServicio').length] = datosOpcion;
	//	}

		document.getElementById('vehiculosServicio').value 	= arrayListaMV[numero][0];
		
		document.getElementById('caballosServicio').value 	= arrayListaMV[numero][9];
		
		//document.getElementById('simccarServicio').value 	= arrayListaMV[numero][11];

		for (i=0; i<document.getElementById('cuadrantesMV').length; i++){
			document.getElementById('cuadrantesMV').options[i].selected = false;
		}

		for (i=0; i<arrayListaMV[numero][5].length; i++){
			for (j=0; j<document.getElementById('cuadrantesMV').length; j++){
				//document.getElementById('cuadrantesMV').options[j].selected = false;
				if (document.getElementById('cuadrantesMV').options[j].value == arrayListaMV[numero][5][i])
						document.getElementById('cuadrantesMV').options[j].selected = true;
			}
		}

		document.getElementById('personalServicioMedio').length = null;
		for (i=0; i<arrayListaMV[numero][4].length; i++){
			var datosOpcion = new Option(arrayListaMV[numero][6][i], arrayListaMV[numero][4][i], "", "");
			document.getElementById('personalServicioMedio').options[i] = datosOpcion;
		}

		document.getElementById('btnEliminaMV').disabled = "";
		seleccionaVehiculoMedioVigilancia();
		seleccionaCaballoMedioVigilancia();
	}
}


//-----------------

//ACCESORIOS

function asignarAccesorios(){
	//moverDatos('personalServicio2', 'personalServicioAccesorio');
		//alert(document.getElementById('simccarDisponibles2').value);
	moverDatos('armasDisponibles', 'personalServicioAccesorio');
	moverDatos('animalesDisponibles', 'personalServicioAccesorio');
	moverDatos('accesoriosDisponibles', 'personalServicioAccesorio');
	moverDatos('simccarDisponibles2', 'personalServicioAccesorio');

	//ordenar(document.getElementById('accesoriosDisponibles'));
	//ordenar(document.getElementById('animalesDisponibles'));
	//ordenar(document.getElementById('armasDisponibles'));
}


function desAsignarAccedorio(){
	//alert(document.getElementById('personalServicioAccesorio').value);
	var valorCodido = document.getElementById('personalServicioAccesorio').value;
	var letraInicial = valorCodido.substring(0,1);
	if (letraInicial == "P") moverDatos('personalServicioAccesorio','armasDisponibles');
	if (letraInicial == "A") moverDatos('personalServicioAccesorio','animalesDisponibles');
	if (letraInicial == "O" || letraInicial == "F") moverDatos('personalServicioAccesorio','accesoriosDisponibles');
	if (letraInicial == "S") moverDatos('personalServicioAccesorio','simccarDisponibles2');
	ordenar(document.getElementById('accesoriosDisponibles'));
	ordenar(document.getElementById('animalesDisponibles'));
	ordenar(document.getElementById('armasDisponibles'));
	ordenar(document.getElementById('simccarDisponibles2'));
}



var arrayListaAccesorios = new Array();
function agregaFuncionarioAccesorios(){

	//alert(document.getElementById('personalServicio2').selectedIndex);
	//var validaOk = validaMedioVigilancia();
	//if (validaOk){
		var arrayArmPersonal 			= new Array(); 	// ARMAS ASIGNADAS CODIGO
		var arrayDescArmPersonal 		= new Array(); 	// ARMAS ASIGNADAS DESCRIPCION
		var arrayAniPersonal 			= new Array();	// ANIMALES ASIGNADOS CODIGO
		var arrayDescAniPersonal 		= new Array();	// ANIMALES ASIGNADOS DECRIPCION
		var arrayAccPersonal			= new Array();	// ACCESORIOS ASIGNADOS CODIGO
		var arrayDescAccPersonal		= new Array();	// ACCESORIOS ASIGNADOS DESCRIPCION
		var arrayPersonaAccesorios		= new Array();	// PERSONAL CON ARMAS, ANIMALES Y ACCESORIOS ASIGNADOS.
		
    var arraySimPersonal 		   	= new Array(); 	// SIMCCAR ASIGNADAS CODIGO
		var arrayDescSimPersonal 		= new Array(); 	// SIMCCAR ASIGNADAS DESCRIPCION

		var codFuncionario 				= document.getElementById('personalServicio2').value;
		var descFuncionario 			= document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex].text;

		//document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex] = null;

		var largoAccesoriosAsignados 	= document.getElementById('personalServicioAccesorio').length;

		for (i=0;i<largoAccesoriosAsignados;i++){
			var valorOption 	= document.getElementById('personalServicioAccesorio').options[i].value;
			var letraInicial 	= valorOption.substring(0,1);
			var valorCodido 	= valorOption; //.substring(1,valorOption.length);
			var descOpcion		= document.getElementById('personalServicioAccesorio').options[i].text;
			//alert(descOpcion);

			if (letraInicial == "P"){
				arrayArmPersonal[arrayArmPersonal.length] 			= valorCodido;
				arrayDescArmPersonal[arrayDescArmPersonal.length] 	= descOpcion;
			}
			if (letraInicial == "A") {
				arrayAniPersonal[arrayAniPersonal.length] 			= valorCodido;
				arrayDescAniPersonal[arrayDescAniPersonal.length] 	= descOpcion;
			}
			if (letraInicial == "O" || letraInicial == "F") {
				arrayAccPersonal[arrayAccPersonal.length] 			= valorCodido;
				arrayDescAccPersonal[arrayDescAccPersonal.length] 	= descOpcion;
			}
			
			if (letraInicial == "S"){
				arraySimPersonal[arraySimPersonal.length] 			= valorCodido;
				arrayDescSimPersonal[arrayDescSimPersonal.length] 	= descOpcion;
			}
		}

		//alert(arrayArmPersonal);
		arrayPersonaAccesorios[0] = codFuncionario;
		arrayPersonaAccesorios[1] = descFuncionario;
		arrayPersonaAccesorios[2] = arrayArmPersonal;
		arrayPersonaAccesorios[3] = arrayAniPersonal;
		arrayPersonaAccesorios[4] = arrayAccPersonal;
		arrayPersonaAccesorios[5] = arrayDescArmPersonal;
		arrayPersonaAccesorios[6] = arrayDescAniPersonal;
		arrayPersonaAccesorios[7] = arrayDescAccPersonal;
		
		arrayPersonaAccesorios[8] = arraySimPersonal;
		arrayPersonaAccesorios[9] = arrayDescSimPersonal;

		////alert(arrayMedioVigilancia[0]+";"+arrayMedioVigilancia[1]+";"+arrayMedioVigilancia[2]+";"+arrayMedioVigilancia[3]+";"+arrayMedioVigilancia[4]+";"+arrayMedioVigilancia[5]);
		//
		if (document.getElementById('idLA').value != "") {
			var punteroArrayListaAccesorios = document.getElementById('idLA').value;
			document.getElementById('idLA').value = "";
		} else {
			var punteroArrayListaAccesorios = arrayListaAccesorios.length;
		}

		arrayListaAccesorios[punteroArrayListaAccesorios] = arrayPersonaAccesorios;

		//alert(document.getElementById('personalServicio2').selectedIndex);
		var cantSimccar =arrayPersonaAccesorios[8].length;
		//alert(cantSimccar);
		//verificarSimccarAccesorios();
		
		if(cantSimccar==1 || cantSimccar==0){
		document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex] = null;
		limpiaAccesoriosFuncionario(false);
		listaPesonalAccesorios();

		ordenar(document.getElementById('accesoriosDisponibles'));
		ordenar(document.getElementById('animalesDisponibles'));
		ordenar(document.getElementById('armasDisponibles'));
		ordenar(document.getElementById('simccarDisponibles2'));
		document.getElementById('btnEliminarAccesorios').disabled = true;
	}else{
		alert("NO SE PUEDE ASIGNAR MAS DE UNA SIMCCAR ...");
		//limpiaAccesoriosFuncionario(false);
		//document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex] = null;
    //limpiaAccesoriosFuncionario(false);
    //eliminarFuncionarioAccesorios()
    


    
		//return false;
		cerrarVentanaServicio();
		}
	//}
}


function listaPesonalAccesorios(){
	//alert(arrayListaMV[0]);
	var listaPAccesorios = "";
	var sw = 0;
	var fondoLinea;

	listaPAccesorios += "<table border='0' cellspacing='1' cellpadding='1'>";
	for (var i=0; i<arrayListaAccesorios.length; i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}

		var resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
		var lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";

		var descFuncionario = arrayListaAccesorios[i][1].substring(0,27) + " ...";

		listaPAccesorios += "<tr id='linea"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onClick='muestraAccesoriosFuncionario("+i+")'>";
		listaPAccesorios += "<td width='40%' style='padding:0px 0px 0px 5px' align='left'>"+descFuncionario+"</td>";
		listaPAccesorios += "<td width='8%' style='padding:0px 0px 0px 0px' align='center'>"+arrayListaAccesorios[i][2].length+"</td>";
		listaPAccesorios += "<td width='9%' style='padding:0px 5px 0px 0px' align='center'>"+arrayListaAccesorios[i][3].length+"</td>";
		listaPAccesorios += "<td width='9%' style='padding:0px 5px 0px 0px' align='center'>"+arrayListaAccesorios[i][4].length+"</td>";
		listaPAccesorios += "<td width='9%' style='padding:0px 5px 0px 0px' align='center'>"+arrayListaAccesorios[i][8].length+"</td>";
		listaPAccesorios += "<tr>";

		//alert(problemas);
	}
	listaPAccesorios += "</table>";
	document.getElementById("listadoPersonalAccesorios").innerHTML = listaPAccesorios;

	//limpiaMedioVigilancia();
}





function muestraAccesoriosFuncionario(numero){

	//alert(document.getElementById('idLA').value);

	//if (document.getElementById('idLA').value != numero || document.getElementById('idLA').value == ""){
	if (document.getElementById('idLA').value == ""){

		var nombreObjeto = "linea"+numero;
		//alert(nombreObjeto);
		document.getElementById(nombreObjeto).className = 'lineaMarcada';
		document.getElementById(nombreObjeto)['onmouseout'] = new Function("this.className = 'lineaMarcada'");

		if (document.getElementById('idLA').value != "") document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex] = null;
		limpiaAccesoriosFuncionario(false);

		document.getElementById('idLA').value = numero;

		//alert(document.getElementById('idLA').value);

		var datosOpcion = new Option(arrayListaAccesorios[numero][1], arrayListaAccesorios[numero][0], "", "");
		document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').length] = datosOpcion;

		document.getElementById('personalServicio2').value 	= arrayListaAccesorios[numero][0];

		document.getElementById('personalServicioAccesorio').length = null;
		var punteroSelect = 0;
		for (i=0; i<arrayListaAccesorios[numero][2].length; i++){
			var datosOpcion = new Option(arrayListaAccesorios[numero][5][i], arrayListaAccesorios[numero][2][i], "", "");
			document.getElementById('personalServicioAccesorio').options[punteroSelect] = datosOpcion;
			punteroSelect++;
		}

		for (i=0; i<arrayListaAccesorios[numero][3].length; i++){
			var datosOpcion = new Option(arrayListaAccesorios[numero][6][i], arrayListaAccesorios[numero][3][i], "", "");
			document.getElementById('personalServicioAccesorio').options[punteroSelect] = datosOpcion;
			punteroSelect++;

			for (j=0; j<document.getElementById('animalesDisponibles').length; j++){
				if (document.getElementById('animalesDisponibles').options[j].value == arrayListaAccesorios[numero][3][i]) document.getElementById('animalesDisponibles').options[j] = null;
			}
		}

		for (i=0; i<arrayListaAccesorios[numero][4].length; i++){
			var datosOpcion = new Option(arrayListaAccesorios[numero][7][i], arrayListaAccesorios[numero][4][i], "", "");
			document.getElementById('personalServicioAccesorio').options[punteroSelect] = datosOpcion;
			punteroSelect++;

			for (j=0; j<document.getElementById('accesoriosDisponibles').length; j++){
				if (document.getElementById('accesoriosDisponibles').options[j].value == arrayListaAccesorios[numero][4][i]) document.getElementById('accesoriosDisponibles').options[j] = null;
			}
		}
		
		for (i=0; i<arrayListaAccesorios[numero][8].length; i++){
			var datosOpcion = new Option(arrayListaAccesorios[numero][9][i], arrayListaAccesorios[numero][8][i], "", "");
			document.getElementById('personalServicioAccesorio').options[punteroSelect] = datosOpcion;
			punteroSelect++;
		}
	}
	document.getElementById('btnEliminarAccesorios').disabled = "";
}


function limpiaAccesoriosFuncionario(eliminar){
	var nombreObjeto = "";

	for (i=0; i<document.getElementById('personalServicioAccesorio').length; i++){
		var valorOption 	= document.getElementById('personalServicioAccesorio').options[i].value;
		var letraInicial 	= valorOption.substring(0,1);
		var valorCodido 	= valorOption; //.substring(1,valorOption.length);
		var descOpcion		= document.getElementById('personalServicioAccesorio').options[i].text;

		if (eliminar && letraInicial == "P") var nombreObjeto = "armasDisponibles";
		if (letraInicial == "A") nombreObjeto = "animalesDisponibles";
		if (letraInicial == "O" || letraInicial == "F") nombreObjeto = "accesoriosDisponibles";
		if (eliminar && letraInicial == "S") var nombreObjeto = "simccarDisponibles2";

		if (nombreObjeto != ""){
			var datosOpcion = new Option(descOpcion, valorOption, "", "");
			document.getElementById(nombreObjeto).options[document.getElementById(nombreObjeto).length] = datosOpcion;
			nombreObjeto = "";
		}
	}

	document.getElementById('personalServicioAccesorio').length = null;
}


function eliminarFuncionarioAccesorios(){
	var elementoBorrar = document.getElementById('idLA').value;
	limpiaAccesoriosFuncionario(true);
	document.getElementById('idLA').value = "";
	arrayListaAccesorios.splice(elementoBorrar,1);
	listaPesonalAccesorios();
	ordenar(document.getElementById('accesoriosDisponibles'));
	ordenar(document.getElementById('animalesDisponibles'));
	ordenar(document.getElementById('armasDisponibles'));
	ordenar(document.getElementById('simccarDisponibles2'));
}


//-------------


// guardar ficha


function guardarServicio(){
	document.getElementById('btnCerrar').disabled = "true";
	document.getElementById('btnEliminar').disabled = "true";
	document.getElementById('btnAnterior').disabled = "true";
	document.getElementById('btnSiguiente').disabled = "true";
	document.getElementById('btnFinalizar').disabled = "true";

	document.getElementById('btnFinalizar').value = "GUARDANDO ...";

	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";



	var correlativo = document.getElementById('correlativoServicio').value;
	var validaOk = validaDatosAsignaFuncionarios();
	if (validaOk){
		if (correlativo == "") guardarNuevoServicio();
		else actualizarServicio();
	}
}


function guardarNuevoServicio(){
	var codigoUnidad 				= document.getElementById("unidadServicio").value;
	//var tipoServicioExtraordinario	= document.getElementById("selTipoExtraordinario").value;
	var tipoServicioExtraordinario	= "0";
	var descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
	//var descServicioExtraordinario	= "";
	var fechaServicio 		 		= document.getElementById("textFechaServicio").value;
	var horaInicio					= document.getElementById("selHoraInicio").value;
	var horaTermino					= document.getElementById("selHoraTermino").value;
	var observaciones				= document.getElementById("textObservaciones").value;

	var opcionServicio  			= document.getElementById("selServicio").value;
	var tipoServicio 				= opcionServicio.substr(1,opcionServicio.length);
	var grupo 						= opcionServicio.substr(0,1);

   	var opcionLicencia  			= document.getElementById("selLicencia").value; //Agregada 30-06-2015
	var tipoLicencia 				= opcionLicencia.substr(1,opcionLicencia .length); //Agregada 30-06-2015

	//	var existeColacion = false;
	//if (tipoServicio  == 142 || tipoServicio == 143 || tipoServicio == 144 || tipoServicio  == 145 || tipoServicio  == 146 || tipoServicio  == 147 || tipoServicio  == 148 || tipoServicio  == 149 || tipoServicio  == 151 || tipoServicio  == 152 || tipoServicio  == 153){
	//	existeColacion = verificarColacion();
	//}


//if (existeColacion){
	//alert("ESTE SERVICIO NO PUEDE SER INGRESADO PORQUE HAY FUNCIONARIOS CON COLACIONES ASIGNADAS.");
//	top.leeServicios(codigoUnidad,'','','');
//	idCargaListadoServicios = setInterval("cerrarVentanaServicio()",100);
//}else{

	//alert(grupo);
	if (grupo == "E") {
		tipoServicioExtraordinario = tipoServicio;
		descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
		tipoServicio = 1100;
	}

        //Condicion agregada el 20-05-2015
	if (opcionServicio == 1 || opcionServicio == 2 || opcionServicio == 3 || opcionServicio == 4) {
		tipoServicio = tipoLicencia;
	}

	if (arrayListaMV.length == 0){
		moverDatos('personalAsignado','personalServicioMedio',true);
		agregaMedioVigilancia(1);
	}




	var arrayListaMVPaso = new Array();
	for (var puntero = 0; puntero < arrayListaMV.length; puntero++){

		arrayListaMVPaso[puntero] = new Array();

		arrayListaMVPaso[puntero][0] = arrayListaMV[puntero][0];
		arrayListaMVPaso[puntero][1] = "";
		arrayListaMVPaso[puntero][2] = arrayListaMV[puntero][2];
		arrayListaMVPaso[puntero][3] = arrayListaMV[puntero][3];
		arrayListaMVPaso[puntero][4] = arrayListaMV[puntero][4];
		arrayListaMVPaso[puntero][5] = arrayListaMV[puntero][5];
		arrayListaMVPaso[puntero][6] = "";
		arrayListaMVPaso[puntero][7] = arrayListaMV[puntero][7];
		arrayListaMVPaso[puntero][8] = "";
		
		arrayListaMVPaso[puntero][9] = arrayListaMV[puntero][9];
		arrayListaMVPaso[puntero][10] = "";
		//arrayListaMVPaso[puntero][11] = arrayListaMV[puntero][11];
		//arrayListaMVPaso[puntero][12] = "";
	}


	//var arregloMediosVigilancia 		= php_serialize(arrayListaMV);
	var arregloMediosVigilancia 		= php_serialize(arrayListaMVPaso);
	var arregloAccesoriosFuncionarios 	= php_serialize(arrayListaAccesorios);

	var parametros = "";
	parametros =  "codigoUnidad="+codigoUnidad+"&tipoServicio="+tipoServicio+"&tipoServicioExtraordinario="+tipoServicioExtraordinario;
	parametros += "&descServicioExtraordinario="+descServicioExtraordinario+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio;
	parametros += "&horaTermino="+horaTermino+"&observaciones="+observaciones+"&arrayListaMV="+arregloMediosVigilancia;
	parametros += "&arrayListaAccesorios="+arregloAccesoriosFuncionarios;

	//alert(parametros);

	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioNuevo.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI(parametros));

	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml = objHttpXMLServicios.responseXML.documentElement;
				for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1) {
						//alert(objHttpXMLServicios.responseText);
						document.getElementById("mensajeGuardando").style.display = "none";
						alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						top.leeServicios(codigoUnidad,'','','');
						idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);

					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}
//}


function actualizarServicio(){

	var codigoUnidad 				= document.getElementById("unidadServicio").value;
	var correlativo 				= document.getElementById('correlativoServicio').value;
	//var tipoServicioExtraordinario	= document.getElementById("selTipoExtraordinario").value;
	var tipoServicioExtraordinario	= "0";
	var descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
	var fechaServicio 		 		= document.getElementById("textFechaServicio").value;
	var horaInicio					= document.getElementById("selHoraInicio").value;
	var horaTermino					= document.getElementById("selHoraTermino").value;
	var observaciones				= document.getElementById("textObservaciones").value;

	var opcionServicio  			= document.getElementById("selServicio").value;
	var tipoServicio 				= opcionServicio.substr(0,1);
	var codigoServicio  			= opcionServicio.substr(1,opcionServicio.length);
	var grupo 						= opcionServicio.substr(0,1);

   	var opcionLicencia  			= document.getElementById("selLicencia").value; //Agregada 30-06-2015
	var tipoLicencia 				= opcionLicencia.substr(0,1); //Agregada 30-06-2015
    var codigoLicencia 		    	= opcionLicencia.substr(1,opcionLicencia.length); //Agregada 30-06-2015

    		var existeColacion = false;
	if (codigoServicio  == 142 || codigoServicio == 143 || codigoServicio == 144 || codigoServicio  == 145 || codigoServicio  == 146 || codigoServicio == 147 || codigoServicio  == 148 || codigoServicio  == 149 || codigoServicio  == 151 || tipoServicio  == 152 || codigoServicio == 153){
		existeColacion = verificarColacion();
	}

	if (existeColacion){
	//alert("ESTE SERVICIO NO PUEDE SER INGRESADO PORQUE HAY FUNCIONARIOS CON COLACIONES ASIGNADAS.");
	top.leeServicios(codigoUnidad,'','','');
	idCargaListadoServicios = setInterval("cerrarVentanaServicio()",100);
}else{

	//alert(grupo);
	if (grupo == "E") {
		tipoServicioExtraordinario = codigoServicio;
		descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
		codigoServicio = 1100;
	}

    //Condicion agregada el 20-05-2015
	if (grupo == 0) {
		codigoServicio  = codigoLicencia;
	}
    //Modificado el 30-06-2015
	if (tipoServicio == "A" || tipoServicio == "I" || tipoServicio == "N" || tipoLicencia =="N"){
		listarPersonalAsignado('personalServicio');
		muestraMedioViginlacia(0);
		moverDatos('personalServicio','personalServicioMedio',true);
		agregaMedioVigilancia(1);
	}


	var arrayListaMVPaso = new Array();
	for (var puntero = 0; puntero < arrayListaMV.length; puntero++){

		arrayListaMVPaso[puntero] = new Array();

		arrayListaMVPaso[puntero][0] = arrayListaMV[puntero][0];
		arrayListaMVPaso[puntero][1] = "";
		arrayListaMVPaso[puntero][2] = arrayListaMV[puntero][2];
		arrayListaMVPaso[puntero][3] = arrayListaMV[puntero][3];
		arrayListaMVPaso[puntero][4] = arrayListaMV[puntero][4];
		arrayListaMVPaso[puntero][5] = arrayListaMV[puntero][5];
		arrayListaMVPaso[puntero][6] = "";
		arrayListaMVPaso[puntero][7] = arrayListaMV[puntero][7];
		arrayListaMVPaso[puntero][8] = "";
		arrayListaMVPaso[puntero][9] = arrayListaMV[puntero][9];
		arrayListaMVPaso[puntero][10] = "";
	}


	var arrayListaAccesoriosPaso = new Array();
	//alert(arrayListaAccesorios.length);
	for (var puntero = 0; puntero < arrayListaAccesorios.length; puntero++){

		arrayListaAccesoriosPaso[puntero] = new Array();

		arrayListaAccesoriosPaso[puntero][0] = arrayListaAccesorios[puntero][0];
		arrayListaAccesoriosPaso[puntero][1] = "";
		arrayListaAccesoriosPaso[puntero][2] = arrayListaAccesorios[puntero][2];
		arrayListaAccesoriosPaso[puntero][3] = arrayListaAccesorios[puntero][3];
		arrayListaAccesoriosPaso[puntero][4] = arrayListaAccesorios[puntero][4];
		arrayListaAccesoriosPaso[puntero][5] = "";
		arrayListaAccesoriosPaso[puntero][6] = "";
		arrayListaAccesoriosPaso[puntero][7] = "";
		arrayListaAccesoriosPaso[puntero][8] = arrayListaAccesorios[puntero][8];
		arrayListaAccesoriosPaso[puntero][9] = "";
		//arrayListaAccesoriosPaso[puntero][10] = "";


		//alert(arrayListaAccesorios[puntero][2]);
	}

	//var arregloMediosVigilancia 		= php_serialize(arrayListaMV);
	var arregloMediosVigilancia 		= php_serialize(arrayListaMVPaso);
	//var arregloAccesoriosFuncionarios = php_serialize(arrayListaAccesorios);
	var arregloAccesoriosFuncionarios 	= php_serialize(arrayListaAccesoriosPaso);

	//alert(arregloAccesoriosFuncionarios);

	var parametros = "";
	parametros =  "codigoUnidad="+codigoUnidad+"&tipoServicio="+codigoServicio+"&tipoServicioExtraordinario="+tipoServicioExtraordinario;
	parametros += "&descServicioExtraordinario="+descServicioExtraordinario+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio;
	parametros += "&horaTermino="+horaTermino+"&observaciones="+observaciones+"&arrayListaMV="+arregloMediosVigilancia;
	parametros += "&arrayListaAccesorios="+arregloAccesoriosFuncionarios+"&correlativo="+correlativo;

	//alert(parametros);

	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioActualizar.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI(parametros));

	objHttpXMLServicios.onreadystatechange=function()
	{
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml = objHttpXMLServicios.responseXML.documentElement;
				for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1) {
						document.getElementById("mensajeGuardando").style.display = "none";
						alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						top.leeServicios(codigoUnidad, '', '', '');
						idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}
}


function cerrarVentanaServicio(){
	if (top.cargaListadoServicios == 1){
		clearInterval(idCargaListadoServicios);
		 top.cerrarVentana();
	}
}

// ELIMINAR SERVICIO

function eliminarServicio(){
	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);


	var existeColacion = false;
	if (servicio != 142 && servicio != 143 && servicio != 144 && servicio != 145 && servicio != 146 && servicio != 147 && servicio != 148 && servicio != 149 && servicio != 151 && servicio != 152 && servicio != 153){
		existeColacion = verificarFuncionarioColacion();
	}

	var existeJefeSupervisionTerreno = false;
	if (servicio != 607){
		existeJefeSupervisionTerreno = verificarFuncionarioJefaturaSupervisionTerreno();
	}

	//alert(existeColacion);
	//alert(existeJefeSupervisionTerreno);
	if (existeColacion ){
		alert("ESTE SERVICIO NO PUEDE SER ELIMINADO PORQUE HAY FUNCIONARIOS CON COLACIONES ASIGNADAS.\n\nPRIMERO DEBE QUITAR LAS COLACIONES ASIGNADAS DE LOS FUNCIONARIOS INDICADOS.");
	} else {
		if(existeJefeSupervisionTerreno){
			alert("ESTE SERVICIO NO PUEDE SER ELIMINADO PORQUE HAY FUNCIONARIOS CON JEFATURA DE SUPERVISION EN TERRENO ASIGNADO.\n\nPRIMERO DEBE QUITARLOS DEL SERVICIO \"JEFATURA DE SUPERVISION EN TERRENO\" LOS FUNCIONARIOS INDICADOS.");
	    }else {
				var respuestaOk = confirm("ESTE SERVICIO SERÁ ELIMINADO. ¿DESEA CONTINUAR? ");
				if (respuestaOk){

					document.getElementById('btnCerrar').disabled    = "true";
					document.getElementById('btnEliminar').disabled  = "true";
					document.getElementById('btnAnterior').disabled  = "true";
					document.getElementById('btnSiguiente').disabled = "true";
					document.getElementById('btnFinalizar').disabled = "true";


					var codigoUnidad 				= document.getElementById("unidadServicio").value;
					var correlativo 				= document.getElementById('correlativoServicio').value;
					var parametros =  "codigoUnidad="+codigoUnidad+"&correlativo="+correlativo;
					var objHttpXMLServicios = new AJAXCrearObjeto();

					objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioEliminar.php",true);
					objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
					objHttpXMLServicios.send(encodeURI(parametros));

					objHttpXMLServicios.onreadystatechange=function()
					{
						if(objHttpXMLServicios.readyState == 4){
							if (objHttpXMLServicios.responseText != "VACIO"){
								//alert(objHttpXMLServicios.responseText);
								var xml = objHttpXMLServicios.responseXML.documentElement;
								for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
									var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
									if (codigo == 1) {
										alert('LOS DATOS FUERON ELIMINADOS DE LA BASE DE DATOS ......        ');
										top.leeServicios(codigoUnidad, '', '', '');
										idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);
									}
									else alert('LOS DATOS NO FUERON ELIMINADOS DE LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
								}
							}
						}
					}
				}
			}
	}
}


//-------------

function verificaExisteServicio(){

	var unidad 	 = document.getElementById("unidadServicio").value;
	var fecha1 	 = document.getElementById("textFechaServicio").value;
	var fecha2	 = fecha1;
	//var servicio = document.getElementById("selServicio").value;

	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);

   	var opcionLicencia  	= document.getElementById("selLicencia").value; //Agregado 30-06-2015
	var tipoLicencia 		= opcionLicencia.substr(0,1); //Agregado 30-06-2015
	var licencia 			= opcionLicencia.substr(1,opcionLicencia.length); //Agregado 30-06-2015

      //Condicion agregada el 30-06-2015
	if (opcionServicio==1 || opcionServicio==2 || opcionServicio==3 || opcionServicio==4) {
		servicio = licencia;

	}
	//Fin condicion

	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServicios.php",false);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicios="+servicio));

	//objHttpXMLServicios.onreadystatechange=function(){
	//	if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO") {
				var xml = objHttpXMLServicios.responseXML.documentElement;
				document.getElementById("correlativoServicio").value = xml.getElementsByTagName('correlativoServicio')[0].text;
				return true;
			} else {return false;}
	//	}
	//}
}