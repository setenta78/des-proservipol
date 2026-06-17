const tipoServicioDestinado = ['O611','O638','O884','O958','O961'];
const grupoServicioDestinado = ['X'];

var cargoFuncionariosDisponibles = 0;
var cargaAnimales = 0;
function selectFuncionariosDisponibles(unidad, nombreObjeto, soloSinServicio){
	var fechaServicio	= document.getElementById('textFechaServicio').value;
	var opcionServicio	= document.getElementById("selServicio").value;
	var tipoServicio	= opcionServicio.substr(0,1);
	var servicio		= opcionServicio.substr(1,opcionServicio.length);
	var correlativo		= document.getElementById("correlativoServicio").value;
	var horaI			= document.getElementById('selHoraInicio').value;
	var horaT			= document.getElementById('selHoraTermino').value;
	var unidadTipo		= document.getElementById('unidadTipo').value;
	
	cargoFuncionariosDisponibles = 0;
	if (soloSinServicio == "1") correlativo = "-1";
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&unidadTipo="+unidadTipo+"&fechaServicio="+fechaServicio+"&tipoServicio="+tipoServicio+"&servicio="+servicio+"&correlativo="+correlativo+"&horaInicio="+horaI+"&horaTermino="+horaT+"&especialidadUnidad="+especialidadUnidadNew.value;
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlListaFuncionariosDisponibles.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 			= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo			= "";
				var nombre			= "";
				var apellidoPaterno	= "";
				var apellidoMaterno	= "";
				var nombreCompleto	= "";
				var grado			= "";
				var puntero			= 0;
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					var mostrar		= 1;
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre			= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					apellidoPaterno	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					nombreCompleto	= apellidoPaterno + " " + apellidoMaterno + ", " + nombre;
					grado			= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					
					var descripcion	= nombreCompleto + " (" + grado + ")";
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
	if (document.getElementById("cbFuncionariosSinServicio").checked) selectFuncionariosDisponibles(unidad,'funcionariosDisponibles','1');
	else selectFuncionariosDisponibles(unidad,'funcionariosDisponibles','');
}

function asignarPersonal(){
	var opcionServicio	= document.getElementById("selServicio").value;
	var tipoServicio 	= opcionServicio.substr(0,1);
	var servicio  		= opcionServicio.substr(1,opcionServicio.length);
	moverDatos('funcionariosDisponibles','personalAsignado');
	ordenar(document.getElementById('personalAsignado'));
	habilitarBotonesAgregarQuitar();
}

function desasignarPersonal(){		
	var opcionServicio 	= document.getElementById("selServicio").value;
	var tipoServicio 	= opcionServicio.substr(0,1);
	var servicio  		= opcionServicio.substr(1,opcionServicio.length);
	var existeColacion 	= "";
	
	if (tipoServicio != "O" && tipoServicio != "F" ) var tipo = "eliminar";
	else var tipo = "";
	
    if(servicio == 191 || servicio == 194 || servicio == 196 || servicio == 197 || servicio == 198 || servicio == 625 || servicio == 635 || servicio == 636 || servicio == 665 || servicio == 666 || servicio == 667 || servicio == 796) verificarFuncionarioJefaturaSupervisionTerreno();
	if(servicio != 142 && servicio != 143 && servicio != 144 && servicio != 145 && servicio != 146 && servicio != 147 && servicio != 148 && servicio != 149 && servicio != 151 && servicio != 152 && servicio != 153) existeColacion = verificarFuncionarioColacion(true);
	
	if(existeColacion != true){
		verificarFuncionarioMedios(tipo);
		moverDatos('personalAsignado','funcionariosDisponibles');
		ordenar(document.getElementById('funcionariosDisponibles'));
		habilitarBotonesAgregarQuitar();
	}
}

function asignarDestino(){
	var abuelo	= document.getElementById('cuadrantesMV').value;
	var padre	= document.getElementById('cuadrantesMV');
	var unidadUsuario		= document.getElementById('unidadUsuario').value;
	var textoUnidadPadre	= abuelo;
	var largoTextoUnidadPadre = textoUnidadPadre.length;
	var marca = textoUnidadPadre.substr(largoTextoUnidadPadre-1,1);
	var seleccionado = document.getElementById("cuadrantesMV")[document.getElementById("cuadrantesMV").selectedIndex].text;
 	
	if(seleccionado=="..")	return false;
	
	if(abuelo==unidadUsuario || marca == "X" || marca == "A" || marca == "P"){
		return false;
	}else{
		moverDatos('cuadrantesMV','destinosSeleccionados');
 	}
}

function desasignarDestino(){
	moverDatos('destinosSeleccionados','cuadrantesMV');
}

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

function verificarFuncionarioColacion(mensaje){
	var cantidadFuncionariosAsignados = document.getElementById("personalAsignado").length;
	var funcionariosAsignados = document.getElementById("personalAsignado");
	var fechaServicio = document.getElementById("textFechaServicio").value;
	var unidadServicio = document.getElementById("unidadServicio").value;
	var codFuncionario = "";
	var mensajeConColacion = "0";
	var mensajeFunConColacion = "0";
	var cantidadServiciosPorFuncionario = buscaServiciosPorFuncionario(unidadServicio, fechaServicio, fechaServicio, 'COLACION');
	if(cantidadServiciosPorFuncionario != 'VACIO') {
		for (var i=0; i<cantidadFuncionariosAsignados; i++){
			var codFuncionarioAsignado = funcionariosAsignados.options[i].value;
	    var desFuncionarioAsignado = funcionariosAsignados.options[i].text;
	    for(var j=0;j<cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario').length;j++){
	      var codigoFuncionarioCompara = (cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario')[j].text||cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario')[j].textContent||"");
	      var cantidadColacionCompara	 = (cantidadServiciosPorFuncionario.getElementsByTagName('cantidadColaciones')[j].text||cantidadServiciosPorFuncionario.getElementsByTagName('cantidadColaciones')[j].textContent||"");
	     	if(mensaje){
		    	if(codigoFuncionarioCompara == codFuncionarioAsignado && funcionariosAsignados.options[i].selected){
		      	funcionariosAsignados.options[i].selected = false;
		      	mensajeFunConColacion += codFuncionarioAsignado +" - "+desFuncionarioAsignado+" \n";
		    	}
		    }
		    else{
		    	if(codigoFuncionarioCompara == codFuncionarioAsignado){
		      	funcionariosAsignados.options[i].selected = false;
		      	mensajeFunConColacion += codFuncionarioAsignado +" - "+desFuncionarioAsignado+" \n";
		    	}
		    }
			}
		}
	}
	if(mensajeFunConColacion != "0") {
		mensajeConColacion = "LOS FUNCIONARIOS :\n\n";
		mensajeConColacion += mensajeFunConColacion;
		mensajeConColacion += "\nNO PUEDEN SER ELIMINADO DE ESTE SERVICIO PORQUE TIENEN COLACION ASIGNADA.\nDEBE ELIMINAR ESTAS ANTES EL SERVICIO.";
		if(mensaje) alert(mensajeConColacion);
		return true;
	} else {
		return false;
	}
}

function verificarFuncionarioJefaturaSupervisionTerreno(){
	var cantidadFuncionariosAsignados 					= document.getElementById("personalAsignado").length;
	var funcionariosAsignados 									= document.getElementById("personalAsignado");
	var fechaServicio 													= document.getElementById("textFechaServicio").value;
	var mensajeFunConJefaturaSupervisionTerreno = "";
	var unidadServicio 													= document.getElementById("unidadServicio").value;
	var mensajeConJefaturaSupervisionTerreno 		= "";
	var cantidadServiciosPorFuncionario = buscaServiciosJefaturaSupervisionTerrenoPorFuncionario(unidadServicio, fechaServicio, fechaServicio);
	
	for (var i=0; i<cantidadFuncionariosAsignados; i++){
		var codFuncionarioAsignado = funcionariosAsignados.options[i].value;
    var desFuncionarioAsignado = funcionariosAsignados.options[i].text;
  	for(var j=0;j<cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario').length;j++){
    	var codigoFuncionarioCompara = (cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario')[j].text||cantidadServiciosPorFuncionario.getElementsByTagName('codigoFuncionario')[j].textContent||"");
     	var cantidadJefaturaServicioTerrenoCompara	= (cantidadServiciosPorFuncionario.getElementsByTagName('cantidadSupervisiones')[j].text||cantidadServiciosPorFuncionario.getElementsByTagName('cantidadSupervisiones')[j].textContent||"");
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
		mensajeConJefaturaSupervisionTerreno += "\nNO PUEDEN SER ELIMINADO DE ESTE SERVICIO PORQUE TIENEN SERVICIO \"JEFATURA EN SUPERVISION O TERRENO\" ASIGNADA.\nDEBE QUITARLES PRIMERO ESTE SERVICIO ASIGNADO.";
		alert(mensajeConJefaturaSupervisionTerreno);
		return true;
	} else {
		return false;
	}
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
	var datosServicios 		= document.getElementById("divDatosServicio").style.visibility;
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaKmsVehiculos	= document.getElementById("divAsignaKmsVehiculos").style.visibility;
	var asignaArmas 		= document.getElementById("divAsignaArmas").style.visibility;
	var asignaAnimales 		= document.getElementById("divAsignaAnimales").style.visibility;
	var permisoRegistrar	= document.getElementById("permisoRegistrar").value;
	
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
			document.getElementById("divAsignaKmsVehiculos").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		} else {
			document.getElementById("divAsignaAnimales").style.visibility	= "visible";
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
		if(permisoRegistrar) document.getElementById("btnFinalizar").disabled = "";
	}
}

function irPaginaAnterior(){
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaKmsVehiculos 	= document.getElementById("divAsignaKmsVehiculos").style.visibility;
	var asignaArmas 		= document.getElementById("divAsignaArmas").style.visibility;
	var asignaAnimales 		= document.getElementById("divAsignaAnimales").style.visibility;
	var asignaAccesorios	= document.getElementById("divAsignaAccesorios").style.visibility;
	
	document.getElementById("divDatosServicio").style.visibility			= "hidden";
	document.getElementById("divAsignaFuncionarios").style.visibility	= "hidden";
	document.getElementById("divAsignaVehiculos").style.visibility		= "hidden";
	document.getElementById("divAsignaKmsVehiculos").style.visibility	= "hidden";
	document.getElementById("divAsignaArmas").style.visibility				= "hidden";
	document.getElementById("divAsignaAnimales").style.visibility			= "hidden";
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
	
	var descOtroExtraordinario 	= eliminarBlancos(document.getElementById("textOtroExtraordinario").value);
	var fechaServicio 		   	= document.getElementById("textFechaServicio").value;
	var horaInicio 		   	   	= document.getElementById("selHoraInicio").value;
	var horaTermino		  		= document.getElementById("selHoraTermino").value;
	
	var opcionServicio  		= document.getElementById("selServicio").value;
	var tipoServicio 			= opcionServicio.substr(0,1);
	var servicio  				= opcionServicio.substr(1,opcionServicio.length);
	
	var opcionLicencia			= document.getElementById("selLicencia").value;
	
  if (opcionServicio == 0 && opcionLicencia == 0){
		alert("DEBE INDICAR SERVICIO ....     ");
		document.getElementById("selServicio").focus();
		return false;
	}
  
  if(opcionServicio == 1 || opcionServicio == 2 || opcionServicio == 3 || opcionServicio == 4){
    if (opcionLicencia == 0){
		alert("DEBE INDICAR LICENCIA ....     ");
		document.getElementById("selLicencia").focus();
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
	
  if (tipoServicio != "N" && tipoServicio != "1"  && tipoServicio != "2" && tipoServicio != "3" && tipoServicio != "4"){
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
	var opcionServicio  = document.getElementById("selServicio").value;
	var tipoServicio 	= opcionServicio.substr(0,1);
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

function validaDatosAsignaAnimales(){
	var cantAnimalesAsignados = document.getElementById("divAsignaAnimales").length;
	if (cantAnimalesAsignados == 0){
		alert("DEBE INDICAR LOS ANIMALES ASIGNADOS A ESTE SERVICIO");
		return false;
	}
	return true;
}

function validaDatosAsignaMedios(){
	if(tipoServicioDestinado.includes(selServicio.value)||grupoServicioDestinado.includes(selServicio.value.substr(0,1))){
		var cantFuncionariosAsignados	= personalServicioDestino.length;
		var cantFuncionariosLista		= personalServicioMedioDestino.length;
		var cantVehiculosAsignados		= vehiculosServicioDestino.length;
		var cantAnimalesAsignados		= animalServicioDestino.length;
	}
	else{
		var cantFuncionariosAsignados	= personalServicio.length;
		var cantFuncionariosLista		= personalServicioMedio.length;
		var cantVehiculosAsignados		= vehiculosServicio.length;
		var cantAnimalesAsignados		= animalServicio.length;
	}
	
	var MV = arrayListaMV.length;

	if (cantFuncionariosAsignados != 0 || cantFuncionariosLista != 0){
		alert("DEBE INDICAR EL MEDIO DE VIGILANCIA AL QUE ES ASIGNADO EL O LOS FUNCIONARIOS.      ");
		return false;
	}
	if (cantVehiculosAsignados > 1){
		alert("DEBE INDICAR EL MEDIO DE VIGILANCIA AL QUE ES ASIGNADO EL O LOS VEHICULOS.      ");
		return false;
	}
	if (cantAnimalesAsignados > 1){
		alert("DEBE INDICAR EL MEDIO DE VIGILANCIA AL QUE ES ASIGNADO EL O LOS ANIMALES.      ");
		return false;
	}
	if (MV == 0){
		alert("DEBE INDICAR EL MEDIO DE VIGILANCIA.      ");
		return false;
	}
	return true;
}

function fechaValidacion(unidadServicios, fechaServicios){
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();
	objHttpXMLFechaValidacion.open("POST","./xml/xmlServicios/xmlFechaValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFechaValidacion.send(encodeURI("unidadServicios="+unidadServicios+"&fechaServicios="+fechaServicios));
	//alert(objHttpXMLFechaValidacion.responseText);
	var xml = objHttpXMLFechaValidacion.responseXML.documentElement;
	return (xml.getElementsByTagName('fechaValidacion')[0].text||xml.getElementsByTagName('fechaValidacion')[0].textContent||"");
}

function irPaginaSiguienteCuadrante(){
	var datosServicios 		= document.getElementById("divDatosServicio").style.visibility;
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaMedios 		= document.getElementById("divAsignaMedios").style.visibility;
	var asignaMedios2 		= document.getElementById("divAsignaMedios2").style.visibility;
	var correlativo			= document.getElementById("correlativoServicio").value;
	var asignaAnimales 		= document.getElementById("divAsignaAnimales").style.visibility;
	
	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	
	var opcionLicencia  	= document.getElementById("selLicencia").value;
	var tipoLicencia		= opcionLicencia.substr(0,1);
	var unidad				= document.getElementById("unidadServicio").value;
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	var fechaServicioSel	= document.getElementById("textFechaServicio").value;
	var permisoRegistrar	= document.getElementById("permisoRegistrar").value;
	
	document.getElementById("divAsignaVehiculos").style.visibility	  = "hidden";
	document.getElementById("divAsignaAnimales").style.visibility	  = "hidden";
	document.getElementById("divAsignaAccesorios").style.visibility	  = "hidden";
	if (datosServicios == "visible"){
		var comparaFechaLimite = comparaFecha(fechaServicioSel, fechaLimite);
		var serviciosValidados = fechaValidacion(unidad, fechaServicioSel);
		if (serviciosValidados != "" || (unidadBloqueada == 1 && comparaFechaLimite == 2)) {
			if (serviciosValidados != ""){
				alert("PARA LA FECHA SELECCIONADA LOS SERVICIOS YA SE ENCUENTRAN VALIDADOS.\n\nNO SE PUEDEN AGREGAR Y/O ACTUALIZAR ... ");
				cerrarVentanaServicio();
			} else {
				alert("PARA LA FECHA SELECCIONADA EL SISTEMA SE ENCUENTRA BLOQUEADO.\n\nNO SE PUEDEN AGREGAR Y/O ACTUALIZAR SERVICIOS ... ");
				cerrarVentanaServicio();
			}
		} else {
			var validaOk = validaDatosServicio();
			if (validaOk){
				var existe = false;
				if (cargoFuncionariosDisponibles == 0) selectFuncionariosDisponibles(unidad,'funcionariosDisponibles','');
				if (!existe){
					var aceptaNoMoficarServicio = confirm("NO PODRA MODIFICAR LA FECHA, HORARIO, TIPO DE SERVICIO O SERVICIO INGRESADO.  \n\u00BFDESEA CONTINUAR?");
					if (aceptaNoMoficarServicio){
						
						document.getElementById("selTipoServicio").disabled 				= true;
						document.getElementById("selServicio").disabled 					= true;
						document.getElementById("selLicencia").disabled 					= true;
						document.getElementById("idFechaServicio").disabled 				= true;
						document.getElementById("textFechaServicio").disabled 				= true;
						document.getElementById("selHoraInicio").disabled 					= true;
						document.getElementById("selHoraTermino").disabled 					= true;
						document.getElementById("divDatosServicio").style.visibility	  	= "hidden";
						document.getElementById("divAsignaFuncionarios").style.visibility	= "visible";
						document.getElementById("btnAnterior").disabled  					= "";
						document.getElementById("btnSiguiente").disabled 					= "";
						document.getElementById("btnFinalizar").disabled 					= true;
						
						if (tipoServicio == "N" || tipoServicio == "A" || tipoLicencia=="N"){
							document.getElementById("btnSiguiente").disabled = true;
							if(permisoRegistrar) document.getElementById("btnFinalizar").disabled = "";
						}
					}
				} else {
					if(opcionServicio == 1 || opcionServicio == 2 || opcionServicio == 3 || opcionServicio==4){
					  desServicio = document.getElementById("selLicencia")[document.getElementById("selLicencia").selectedIndex].text;
					}else{
					  desServicio = document.getElementById("selServicio")[document.getElementById("selServicio").selectedIndex].text;
					}
					
					var fecha1 	 	= fechaCompleta(document.getElementById("textFechaServicio").value);
					var respuesta	= confirm("\""+desServicio+"\" PARA EL "+fecha1+" YA HA SIDO INGRESADO.  \n\u00BFDESEA ACTUALIZARLO?");
					if (respuesta){
						correlativo	= document.getElementById("correlativoServicio").value;
						leeDatosServicio(unidad, correlativo, false);
					} else {
						cerrarVentanaServicio();
					}
				}
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
				if(permisoRegistrar) document.getElementById("btnFinalizar").disabled = "";
			} else {
				selectVehiculosDisponibles(unidad, 'vehiculosDisponibles');
				document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
				document.getElementById("btnAnterior").disabled = "";
				document.getElementById("btnSiguiente").disabled = "";
				document.getElementById("btnFinalizar").disabled = true;
			}
			
			listaArmasDisponibles(unidad, 'armasDisponibles');
			leeTipoAccesorio('accesoriosDisponibles');
			//leeTipoAnimal('animalesDisponibles',true);
			listaCamarasDisponibles(unidad, 'camarasDisponibles');
			listarPersonalAsignado('personalServicio2');
			listarPersonalAsignado('personalServicio');
			listarPersonalAsignado('personalServicioDestino');
		}
	}
	
	if (asignaVehiculos == "visible") {
		document.getElementById("divAsignaVehiculos").style.visibility	= "hidden";
		document.getElementById("divAsignaAnimales").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
		listarVehiculoAsignado('vehiculosServicio');
		(cargaAnimales == 0) ? selectAnimalesDisponibles(unidad) : null;
		(cargaAnimales == 1 && document.getElementById('animalesAsignados').length == 0 && document.getElementById('caballosDisponibles').length == 0 && document.getElementById('perrosDisponibles').length == 0) ? irPaginaSiguienteCuadrante() : null;
	}
	
	if (asignaAnimales == "visible") {
		if(tipoServicioDestinado.includes(selServicio.value)||grupoServicioDestinado.includes(selServicio.value.substr(0,1))){
			document.getElementById("divAsignaMedios2").style.visibility = "visible";
			listarVehiculoAsignado('vehiculosServicioDestino');
		}
		else{
			document.getElementById("divAsignaMedios").style.visibility	= "visible";
			listarVehiculoAsignado('vehiculosServicio');
		}
		
		document.getElementById("divAsignaVehiculos").style.visibility	= "hidden";
		document.getElementById("btnAnterior").disabled  = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
		listarAnimalesAsignado('animalServicio');
		listarAnimalesAsignado('animalServicioDestino');
	}
	
	if (asignaMedios == "visible" || asignaMedios2 == "visible") {
		var validaOk = validaDatosAsignaMedios();
		if (validaOk){
			document.getElementById("divAsignaMedios").style.visibility = "hidden";
			document.getElementById("divAsignaMedios2").style.visibility = "hidden";
			document.getElementById("divAsignaAccesorios").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = true;
			document.getElementById('btnAgregarAccesorios').disabled = (document.getElementById('personalServicio2').length == 0) ? true : false;
			if(permisoRegistrar) document.getElementById("btnFinalizar").disabled = "";
		}
	}
}

function irPaginaAnteriorCuadrante(){
	var asignaFuncionarios 	= document.getElementById("divAsignaFuncionarios").style.visibility;
	var asignaVehiculos 	= document.getElementById("divAsignaVehiculos").style.visibility;
	var asignaMedios 		= document.getElementById("divAsignaMedios").style.visibility;
	var asignaMedios2 		= document.getElementById("divAsignaMedios2").style.visibility;
	var asignaAccesorios	= document.getElementById("divAsignaAccesorios").style.visibility;
	var asignaAnimales		= document.getElementById("divAsignaAnimales").style.visibility;
	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	
	document.getElementById("divDatosServicio").style.visibility		= "hidden";
	document.getElementById("divAsignaFuncionarios").style.visibility	= "hidden";
	document.getElementById("divAsignaVehiculos").style.visibility		= "hidden";
	document.getElementById("divAsignaMedios").style.visibility			= "hidden";
	document.getElementById("divAsignaMedios2").style.visibility		= "hidden";
	document.getElementById("divAsignaAnimales").style.visibility		= "hidden";
	document.getElementById("divAsignaAccesorios").style.visibility		= "hidden";
	
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
	
	if (asignaAnimales == "visible") {
		document.getElementById("divAsignaVehiculos").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
	}
	
	if (asignaMedios == "visible" || asignaMedios2 == "visible") {
		document.getElementById("divAsignaAnimales").style.visibility	= "visible";
		document.getElementById("btnAnterior").disabled = "";
		document.getElementById("btnSiguiente").disabled = "";
		document.getElementById("btnFinalizar").disabled = true;
		(document.getElementById('caballosDisponibles').length == 0 && document.getElementById('perrosDisponibles').length == 0 && document.getElementById('animalesAsignados').length == 0) ? irPaginaAnteriorCuadrante() : null;
	}
	
	if (asignaAccesorios == "visible") {
		document.getElementById("divAsignaAccesorios").style.visibility	= "hidden";
		if (tipoServicio == "I"){
			document.getElementById("divAsignaFuncionarios").style.visibility	= "visible";
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		} else {
			if(tipoServicioDestinado.includes(selServicio.value)||grupoServicioDestinado.includes(selServicio.value.substr(0,1))){
				document.getElementById("divAsignaMedios2").style.visibility = "visible";
			}
			else{
				document.getElementById("divAsignaMedios").style.visibility	= "visible";
			}
			document.getElementById("btnAnterior").disabled = "";
			document.getElementById("btnSiguiente").disabled = "";
			document.getElementById("btnFinalizar").disabled = true;
		}
	}
}

function seleccionTipoServicio(){
	var opcionTipoServicio = document.getElementById("selTipoServicio").value;
	var especialidad = unidadEspecialidad.value;
	var grupo = selTipoServicio.value;
	document.getElementById('selServicio').length = null;
	document.getElementById('selLicencia').length = null;
	document.getElementById("textOtroExtraordinario").value = "";
	document.getElementById("textOtroExtraordinario").style.backgroundColor = "#D4D4D4";
	document.getElementById("textOtroExtraordinario").disabled = true;
	document.getElementById("idFechaServicio").focus();
	switch(opcionTipoServicio){
		case '1':
			leeTipoServicios('selServicio',false,especialidad,'OPERATIVO');
		break;
		case '2':
			leeTipoServiciosExtraordinarios('selServicio',especialidad,'E');
		break;
		case '3':
			leeTipoServiciosExtraordinarios('selServicio',especialidad,'X');
		break;
		case '4':
			leeTipoServicios('selServicio',false,especialidad,'INTRACUARTEL');
		break;
		case '5':
			leeTipoServicios('selServicio',false,especialidad,'VARIABLE');
		break;
		case '6':
			leeTipoServicios('selServicio',false,especialidad,'SERVICIO EN EL SECTOR DE OTRO CUARTEL');
		break;
		case '7':
			leeTipoServicios('selServicio',false,especialidad,'NO DISPONIBILIDAD ACTIVIDAD FUERA DEL CUARTEL');
		break;
		case '8':
			leeTipoServicios('selServicio',false,especialidad,'NO DISPONIBILIDAD');
		break;
		case '9':
			leeTipoServicios('selServicio',false,especialidad,'COLACION');
		break;
		case '20':
			leeTipoServiciosExtraordinariosN('selServicio','E');
		break;
		case '80':
			leeTipoServiciosExtraordinariosN('selServicio','X');
		break;
		default:
			leeTipoServiciosN('selServicio', grupo);
		break;
	}
}

function habilitarCheckFuncionariosDisponibles(habilitaCheck,moduloServ){
	var unidadCheck = document.getElementById("unidadUsuario").value;
	if(moduloServ){
		if(habilitaCheck){
			document.getElementById("divCheckDisponibles").innerHTML = "<td width='2%'><input type='checkbox' id='cbFuncionariosSinServicio' name='cbFuncionariosSinServicio' value='1' onclick='filtrarFuncionariosDisponibles("+unidadCheck+")' ></td><td width='43%' align='left' class='textoNormal'>MOSTRAR SOLO PERSONAL SIN SERVICIO ASIGNADO&nbsp;</td><td>&nbsp;</td>";
		}
		else{
		 	document.getElementById("divCheckDisponibles").innerHTML = "<td width='2%'>&nbsp;</td><td width='43%' align='left' class='textoNormal'>&nbsp;</td><td>&nbsp;</td>";
		}
	}
}

function listaLicencias(nombreObjeto, multiple){
	var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
	var datosOpcion5 = new Option("LICENCIA MEDICA", 1, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	document.getElementById(nombreObjeto).options[1] = datosOpcion5;
}

function Seleccionlicencia(){
	var opcionLicencia  = document.getElementById("selServicio").value;
	var opcionLicencia  = document.getElementById("selLicencia").value;
	var tipoLicencia	= opcionLicencia.substr(0,1);
	document.getElementById("idFechaServicio").focus();
  
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

function seleccionServicio(moduloServ){
	var opcionServicio  = document.getElementById("selServicio").value;
	var tipoServicio 	= opcionServicio.substr(0,1);
	var codigoServicio  = opcionServicio.substr(1,opcionServicio.length);
	
	if (opcionServicio == 1) leeTipoServicios('selLicencia',false,70,'OTRO');
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
	if (tipoServicio == "N" && (codigoServicio != "892" && codigoServicio != "870")){
		document.getElementById("selHoraInicio").value     = 0;
		document.getElementById("selHoraTermino").value    = 0;
		document.getElementById("labHoraInicio").disabled  = true;
		document.getElementById("selHoraInicio").disabled  = true;
		document.getElementById("labHoraTermino").disabled = true;
		document.getElementById("selHoraTermino").disabled = true;
	}
	else if(moduloServ){
		document.getElementById("labHoraInicio").disabled  = false;
		document.getElementById("selHoraInicio").disabled  = false;
	}
	if(tipoServicio == "N" || codigoServicio == 607){
		habilitarCheckFuncionariosDisponibles(false,moduloServ);
	}
	else{
		habilitarCheckFuncionariosDisponibles(true,moduloServ);
	}

	if(tipoServicioDestinado.includes(opcionServicio)||grupoServicioDestinado.includes(selServicio.value.substr(0,1))){
		obtenerDatosUnidad(unidadPadreUsuario.value);
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

var ListaVehiculosDisponibles = new Array;
function selectVehiculosDisponibles(unidad, nombreObjeto){
	var fechaServicio	= document.getElementById('textFechaServicio').value;
	var opcionServicio	= document.getElementById("selServicio").value;
	var servicio		= opcionServicio.substr(1,opcionServicio.length);
	var horaInicio		= document.getElementById('selHoraInicio').value;
	var horaTermino		= document.getElementById('selHoraTermino').value;
	var correlativo		= document.getElementById("correlativoServicio").value;
	
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+servicio+"&horaInicio="+horaInicio+"&horaTermino="+horaTermino+"&correlativo="+correlativo;
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlVehiculosDisponibles.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));
	objHttpXMLVehiculos.onreadystatechange=function(){
		//alert(objHttpXMLVehiculosreadyState);
		if(objHttpXMLVehiculos.readyState == 4){
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "SIN DATOS"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml 							= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 					= "";
				var tipo	 						= "";
				var patente		 				= "";
				var kmFinal		 				= "";
				var nroInstitucional	= "";
				
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipo		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					patente		= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
					kmFinal 	= (xml.getElementsByTagName('kmFinal')[i].text||xml.getElementsByTagName('kmFinal')[i].textContent||"");
					indicaKm	= (xml.getElementsByTagName('indicaKm')[i].text||xml.getElementsByTagName('indicaKm')[i].textContent||"");
					nroInstitucional = (xml.getElementsByTagName('numeroInstitucional')[i].text||xml.getElementsByTagName('numeroInstitucional')[i].textContent||"");
					ListaVehiculosDisponibles[i] = new Array;
					var descripcion	= tipo + " (" + patente + ")";
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
					ListaVehiculosDisponibles[i][0] = codigo;
					ListaVehiculosDisponibles[i][1] = kmFinal;
					ListaVehiculosDisponibles[i][2] = indicaKm;
				}
			} else {
				document.getElementById(nombreObjeto).length = null;
			}
			habilitarBotonesAgregarQuitarVehiculos();
		}
	}
}

var cargaListadoArmasDisponibles;
function listaArmasDisponibles(unidad, nombreObjeto){
	cargaListadoArmasDisponibles = 0;
	var fechaServicio 	= document.getElementById('textFechaServicio').value;
	var opcionServicio  = document.getElementById("selServicio").value;
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var horaInicio 			= document.getElementById('selHoraInicio').value;
	var horaTermino 		= document.getElementById('selHoraTermino').value;
	var correlativo			= document.getElementById("correlativoServicio").value;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLArmas = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio+"&horaTermino="+horaTermino+"&tipoServicio="+servicio+"&correlativo="+correlativo;
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlListaArmasDisponibles.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI(parametros));
	objHttpXMLArmas.onreadystatechange=function(){
		if(objHttpXMLArmas.readyState == 4){
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml 				= objHttpXMLArmas.responseXML.documentElement;
				var codigo 			= "";
				var numeroSerie	= "";
				var descripcion	= "";
				var tipo				= "";
				document.getElementById(nombreObjeto).length = null;
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipo 				= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					numeroSerie	= (xml.getElementsByTagName('numeroSerie')[i].text||xml.getElementsByTagName('numeroSerie')[i].textContent||"");
					descripcion = tipo + " (N/S. : " + numeroSerie + ")";
					var datosOpcion = new Option(descripcion, "P" + codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
				}
				cargaListadoArmasDisponibles = 1;
			}
		}
	}
}

function asignarVehiculo(){
	moverDatos('vehiculosDisponibles','vehiculosAsignados');
	ordenar(document.getElementById('vehiculosAsignados'));
	habilitarBotonesAgregarQuitarVehiculos();
}

function desasignarVehiculo(){
	verificarVehiculoMedios();
	moverDatos('vehiculosAsignados','vehiculosDisponibles');
	ordenar(document.getElementById('vehiculosDisponibles'));
	habilitarBotonesAgregarQuitarVehiculos();
}

function selectAnimalesDisponibles(unidad){
	var fechaServicio 	= document.getElementById('textFechaServicio').value;
	var opcionServicio  = document.getElementById("selServicio").value;
	var servicio  		= opcionServicio.substr(1,opcionServicio.length);
	var horaInicio 		= document.getElementById('selHoraInicio').value;
	var horaTermino 	= document.getElementById('selHoraTermino').value;
	var correlativo		= document.getElementById("correlativoServicio").value;
	document.getElementById('caballosDisponibles').length = null;
	document.getElementById('perrosDisponibles').length = null;
	document.getElementById('caballosDisponibles').options[0] = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById('perrosDisponibles').options[0] = new Option("CARGANDO DATOS ... ", 0, "", "");
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+servicio+"&horaInicio="+horaInicio+"&horaTermino="+horaTermino+"&correlativo="+correlativo;
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlAnimalesDisponibles.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI(parametros));
	objHttpXMLAnimales.onreadystatechange=function(){
		//alert(objHttpXMLAnimales.readyState);
		if(objHttpXMLAnimales.readyState == 4){
			//console.log(objHttpXMLAnimales.responseText);
			if (objHttpXMLAnimales.responseText != "SIN DATOS"){
				//alert(objHttpXMLAnimales.responseText);
				var xml 			= objHttpXMLAnimales.responseXML.documentElement;
				var codigo			= "";
				var tipoCodigo		= "";
				var tipoDescripcion	= "";
				var bcu				= "";
				var nombre			= "";
				var indCaballos		= 0;
				var indPerros		= 0;
				for(i=0;i<xml.getElementsByTagName('animal').length;i++){
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipoCodigo		= (xml.getElementsByTagName('tipoCodigo')[i].text||xml.getElementsByTagName('tipoCodigo')[i].textContent||"");
					tipoDescripcion	= (xml.getElementsByTagName('tipoDescripcion')[i].text||xml.getElementsByTagName('tipoDescripcion')[i].textContent||"");
					bcu				= (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
					nombre			= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					
					if(tipoCodigo == 10){
						document.getElementById('caballosDisponibles').options[indCaballos] = new Option(tipoDescripcion + " (" + nombre + ")", codigo, "", "");
						indCaballos ++;
					}
					else if(tipoCodigo == 40){
						document.getElementById('perrosDisponibles').options[indPerros] = new Option(tipoDescripcion + " (" + nombre + ")", codigo, "", "");
						indPerros++;
					}
				}
				(document.getElementById('caballosDisponibles').options[0].value == 0) ? document.getElementById('caballosDisponibles').length = null : null;
				(document.getElementById('perrosDisponibles').options[0].value == 0) ? document.getElementById('perrosDisponibles').length = null : null;
			} else {
				document.getElementById('caballosDisponibles').length = null;
				document.getElementById('perrosDisponibles').length = null;
				(document.getElementById('animalesAsignados').length == 0) ? irPaginaSiguienteCuadrante() : null;
			}
			cargaAnimales = 1;
			habilitarBotonesAgregarQuitarAnimales();
		}
	}
}

function asignarAnimal(){
	moverDatos('caballosDisponibles','animalesAsignados');
	moverDatos('perrosDisponibles','animalesAsignados');
	ordenar(document.getElementById('animalesAsignados'));
	document.getElementById('animalServicio').disabled = "";
	document.getElementById('animalServicio').style.backgroundColor = "";
	habilitarBotonesAgregarQuitarAnimales();
}

function desasignarAnimal(){
	verificarAnimalMedios();
	var cantidadAnimalesAsignados = document.getElementById("animalesAsignados").length;
	var animalesAsignados = document.getElementById("animalesAsignados");
	var moverAnimales = new Array;
	
	for (var i=0; i<cantidadAnimalesAsignados; i++){
		moverAnimales[i] = document.getElementById('animalesAsignados').options[i].text;
	}
	
	for (var i=0; i<moverAnimales.length; i++){
		var valorOption 	= moverAnimales[i];
		var letraInicial 	= valorOption.substring(0,1);
		
		if (animalesAsignados.options[i].selected && letraInicial == "C") {
			moverDatos('animalesAsignados','caballosDisponibles');
			i = moverAnimales
		}
		else if (animalesAsignados.options[i].selected && letraInicial == "P") {
			moverDatos('animalesAsignados','perrosDisponibles');
			i = moverAnimales;
		}
	}
	ordenar(document.getElementById('caballosDisponibles'));
	ordenar(document.getElementById('perrosDisponibles'));
	habilitarBotonesAgregarQuitarAnimales();
}

function verificarVehiculoMedios(){
	var cantidadVehiculosAsignados = document.getElementById("vehiculosAsignados").length;
	var vehiculosAsignados = document.getElementById("vehiculosAsignados");
	for (var i=0; i<cantidadVehiculosAsignados; i++){
		if (vehiculosAsignados.options[i].selected){
			var codVehiculoAsignado = vehiculosAsignados.options[i].value;
			for (var j=0; j<arrayListaMV.length; j++){
				if (codVehiculoAsignado == arrayListaMV[j][0]) {
					vehiculosAsignados.options[i].selected = false;
					alert(arrayListaMV[j][1]+ ", NO SE PUEDE SACAR DEL SERVICIO PORQUE ESTA ASIGNADO A UN MEDIO DE VIGILANCIA. PRIMERO DEBE MODIFICAR EL MEDIO DE VIGILANCIA.");
				}
			}
		}
	}
}

function verificarAnimalMedios(){
	var cantidadAnimalesAsignados = document.getElementById("animalesAsignados").length;
	var animalesAsignados = document.getElementById("animalesAsignados");
	for (var i=0; i<cantidadAnimalesAsignados; i++){
		if (animalesAsignados.options[i].selected){
			var codAnimalesAsignado = animalesAsignados.options[i].value;
			for (var j=0; j<arrayListaMV.length; j++){
				if (codAnimalesAsignado == arrayListaMV[j][9]) {
					animalesAsignados.options[i].selected = false;
					alert(arrayListaMV[j][10]+ ", NO SE PUEDE SACAR DEL SERVICIO PORQUE ESTA ASIGNADO A UN MEDIO DE VIGILANCIA. PRIMERO DEBE MODIFICAR EL MEDIO DE VIGILANCIA.");
				}
			}
		}
	}
}

function habilitarBotonesAgregarQuitarVehiculos(){
	var cantidadDisponible = document.getElementById('vehiculosDisponibles').length;
	var cantidadAsignado   = document.getElementById('vehiculosAsignados').length;
	
	if (cantidadDisponible == 0) document.getElementById('Btn_AgregarVehiculo').disabled = "true";
	else document.getElementById('Btn_AgregarVehiculo').disabled = "";
	
	if (cantidadAsignado == 0) document.getElementById('Btn_QuitarVehiculo').disabled = "true";
	else document.getElementById('Btn_QuitarVehiculo').disabled = "";
	
	document.getElementById('tituloVehiculoDisponible').innerHTML = "VEH\u00CDCULOS DISPONIBLES (" + cantidadDisponible + ")";
	document.getElementById('tituloVehiculoAsignado').innerHTML = "VEH\u00CDCULOS ASIGNADOS (" + cantidadAsignado + ")";
}

function habilitarBotonesAgregarQuitarAnimales(){
	var cantidadCaballosDisponible = document.getElementById('caballosDisponibles').length;
	var cantidadPerrosDisponible = document.getElementById('perrosDisponibles').length;
	var cantidadAsignado   = document.getElementById('animalesAsignados').length;
	
	if (cantidadCaballosDisponible == 0 && cantidadPerrosDisponible == 0) document.getElementById('Btn_AgregarAnimal').disabled = "true";
	else document.getElementById('Btn_AgregarAnimal').disabled = "";
	
	if (cantidadAsignado == 0) document.getElementById('Btn_QuitarAnimal').disabled = "true";
	else document.getElementById('Btn_QuitarAnimal').disabled = "";
	
	document.getElementById('tituloCaballoDisponible').innerHTML = "CABALLOS DISPONIBLES (" + cantidadCaballosDisponible + ")";
	document.getElementById('tituloPerroDisponible').innerHTML = "PERROS DISPONIBLES (" + cantidadPerrosDisponible + ")";
	document.getElementById('tituloAnimalAsignado').innerHTML = "ANIMALES ASIGNADOS (" + cantidadAsignado + ")";
}

function cantidadVehiculos(){
	var x				= document.getElementById('vehiculosAsignados');
	var cantidad		= x.length;
	var div				= document.getElementById("listadoVehiculosAsignados");
	var sw				= 0;
	var fondoLinea		= "";
	var listadoArmas	= "<table border='0' align='left' cellspacing='1' cellpadding='1'>";
	
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
}

function cantidadAnimales(){
	var x 				 	= document.getElementById('animalesAsignados');
	var cantidad   		 	= x.length;
	var div		 	 		= document.getElementById("listadoAnimalesAsignados");
	var sw		 	 		= 0;
	var fondoLinea 	 		= "";
	var listadoAnimales = "<table border='0' align='left' cellspacing='1' cellpadding='1'>";
	
	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}
		
		listadoAnimales += "<tr class='"+fondoLinea+"'>";
		listadoAnimales += "<td width='441px'><input type='text' name='textAnimalAsignado_"+i+"' id='textAnimalAsignado' value='"+x.options[i].text+"' readonly></td>";
		listadoAnimales += "<td width='22px'><input type='checkbox' id='cbEliminarAnimal'></td>";
		listadoAnimales += "</tr>";
	}
	listadoAnimales += "</table>";
	div.innerHTML = listadoAnimales;
}

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
		listadoAnimales += "<td width='396px'></td>";
		listadoAnimales += "<td width='22px'><input type='checkbox' id='cbEliminarAnimal'></td>";
		listadoAnimales += "</tr>";
	}
	listadoAnimales += "</table>";
	div.innerHTML = listadoAnimales;
	
	for(i=0;i<cantidad;i++) {
		leeTipoAnimal('selTipoAnimal_'+i);
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
	document.getElementById(nombreObjeto).length = null;
	var idest = 0;
	for (var i=0;i<x.length; i++){
		var codigo 		= x.options[i].value;
		var descripcion = x.options[i].text;
		var agregar 	= true;
		if(nombreObjeto=='personalServicio2'){
			for (var j=0; j<arrayListaAccesorios.length; j++){
				for (var k=0; k<arrayListaAccesorios[j].length; k++){
					if (codigo == arrayListaAccesorios[j][0]) agregar = false;
				}
			}
		}
		else{
			for (var j=0; j<arrayListaMV.length; j++){
				for (var k=0; k<arrayListaMV[j][4].length; k++){
					if (codigo == arrayListaMV[j][4][k]) agregar = false;
				}
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

function listarAnimalesAsignado(nombreObjeto){
	var z = document.getElementById('animalesAsignados');
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("SIN ANIMAL", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	
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

var idCargaArmasAsignadas;
function buscaDatosServicio(unidad, servicio, fecha){
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlVistaServicio.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("unidad="+unidad+"&fecha="+fecha+"&servicio="+servicio));
	objHttpXMLServicios.onreadystatechange=function(){
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			var xml				= objHttpXMLServicios.responseXML.documentElement;
			var codigoServicio	= (xml.getElementsByTagName('codigoServicio')[0].text||xml.getElementsByTagName('codigoServicio')[0].textContent||"");
			var fechaServicio	= (xml.getElementsByTagName('fecha')[0].text||xml.getElementsByTagName('fecha')[0].textContent||"");
			var horaInicio		= (xml.getElementsByTagName('horaInicio')[0].text||xml.getElementsByTagName('horaInicio')[0].textContent||"");
			var horaTermino		= (xml.getElementsByTagName('horaTermino')[0].text||xml.getElementsByTagName('horaTermino')[0].textContent||"");
			
			document.getElementById("selServicio").value		= codigoServicio;
			document.getElementById("textFechaServicio").value	= fechaServicio;
			document.getElementById("selHoraInicio").value		= horaInicio;
			document.getElementById("selHoraTermino").value		= horaTermino;
			
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
				cargaArmasAsignadas(armasAsignadas);
			}
			
			/*
			if (xml.getElementsByTagName('animalesAsignados').length>0){
				var animalesAsignados = xml.getElementsByTagName('animalesAsignados')[0];
				document.getElementById('textCantidadAnimales').value = animalesAsignados.getElementsByTagName('animal').length;
				cantidadAnimalesAsignados();
				cargaAnimalesAsignados(animalesAsignados);
			}
			*/
			
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
		codigo			= (funcionariosAsignados.getElementsByTagName('codigo')[i].text||funcionariosAsignados.getElementsByTagName('codigo')[i].textContent||"");
		apellidoPaterno	= (funcionariosAsignados.getElementsByTagName('apellidoPaterno')[i].text||funcionariosAsignados.getElementsByTagName('apellidoPaterno')[i].textContent||"");
		apellidoMaterno	= (funcionariosAsignados.getElementsByTagName('apellidoMaterno')[i].text||funcionariosAsignados.getElementsByTagName('apellidoMaterno')[i].textContent||"");
		nombre			= (funcionariosAsignados.getElementsByTagName('nombre')[i].text||funcionariosAsignados.getElementsByTagName('nombre')[i].textContent||"");
		grado			= (funcionariosAsignados.getElementsByTagName('grado')[i].text||funcionariosAsignados.getElementsByTagName('grado')[i].textContent||"");
		nombreCompleto	= apellidoPaterno + " " + apellidoMaterno + ", " + nombre + " (" +grado+")";
		var datosOpcion	= new Option(nombreCompleto, codigo, "", "");
		document.getElementById(nombreObjeto).options[i] = datosOpcion;
	}
}

function cargaVehiculosAsignados(vehiculosAsignados, nombreObjeto){
	var codigo, tipo, patente, kmInicial, kmFinal, totalKms, combustible, descripcion;
	document.getElementById(nombreObjeto).length = null;
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		codigo		= (vehiculosAsignados.getElementsByTagName('codigo')[i].text||vehiculosAsignados.getElementsByTagName('codigo')[i].textContent||"");
		tipo		= (vehiculosAsignados.getElementsByTagName('tipo')[i].text||vehiculosAsignados.getElementsByTagName('tipo')[i].textContent||"");
		patente		= (vehiculosAsignados.getElementsByTagName('patente')[i].text||vehiculosAsignados.getElementsByTagName('patente')[i].textContent||"");
		descripcion	= tipo + " ("+patente+")";
		var datosOpcion = new Option(descripcion, codigo, "", "");
		document.getElementById(nombreObjeto).options[i] = datosOpcion;
	}
	cantidadVehiculos();
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		codigo	 	= (vehiculosAsignados.getElementsByTagName('codigo')[i].text||vehiculosAsignados.getElementsByTagName('codigo')[i].textContent||"");
		tipo	 	= (vehiculosAsignados.getElementsByTagName('tipo')[i].text||vehiculosAsignados.getElementsByTagName('tipo')[i].textContent||"");
		patente		= (vehiculosAsignados.getElementsByTagName('patente')[i].text||vehiculosAsignados.getElementsByTagName('patente')[i].textContent||"");
		kmInicial	= (vehiculosAsignados.getElementsByTagName('kmInicial')[i].text||vehiculosAsignados.getElementsByTagName('kmInicial')[i].textContent||"");
		kmFinal		= (vehiculosAsignados.getElementsByTagName('kmFinal')[i].text||vehiculosAsignados.getElementsByTagName('kmFinal')[i].textContent||"");
		totalKms	= (vehiculosAsignados.getElementsByTagName('totalKms')[i].text||vehiculosAsignados.getElementsByTagName('totalKms')[i].textContent||"");
		combustible	= (vehiculosAsignados.getElementsByTagName('combustible')[i].text||vehiculosAsignados.getElementsByTagName('combustible')[i].textContent||"");
		descripcion = tipo + " ("+patente+")";
		
		var objetoVehiculo		= "textVehiculoAsignado_" + i;
		var objetoKmInicial		= "textKmInicial_" + i;
		var objetoKmFinal		= "textKmFinal_" + i;
		var objetoCombustible	= "textCombustible_" + i;
		
		document.getElementById(objetoVehiculo).value		= descripcion;
		document.getElementById(objetoKmInicial).value		= kmInicial;
		document.getElementById(objetoKmFinal).value		= kmFinal;
		document.getElementById(objetoCombustible).value	= combustible;
	}
}

function cargaAnimalesAsignados(animalesAsignados, nombreObjeto){
	var codigo, tipo, nombre, descripcion;
	document.getElementById(nombreObjeto).length = null;
	for(i=0;i<vehiculosAsignados.getElementsByTagName('animal').length;i++){
		codigo	 	= (animalesAsignados.getElementsByTagName('codigo')[i].text||animalesAsignados.getElementsByTagName('codigo')[i].textContent||"");
		tipo	 	= (animalesAsignados.getElementsByTagName('tipo')[i].text||animalesAsignados.getElementsByTagName('tipo')[i].textContent||"");
		nombre		= (animalesAsignados.getElementsByTagName('nombre')[i].text||animalesAsignados.getElementsByTagName('nombre')[i].textContent||"");
		descripcion = tipo + " ("+nombre+")";
		var datosOpcion = new Option(descripcion, codigo, "", "");
		document.getElementById(nombreObjeto).options[i] = datosOpcion;
	}
	cantidadAnimales();
	for(i=0;i<animalesAsignados.getElementsByTagName('animal').length;i++){
		codigo	 	= (animalesAsignados.getElementsByTagName('codigo')[i].text||animalesAsignados.getElementsByTagName('codigo')[i].textContent||"");
		tipo	 	= (animalesAsignados.getElementsByTagName('tipo')[i].text||animalesAsignados.getElementsByTagName('tipo')[i].textContent||"");
		nombre		= (animalesAsignados.getElementsByTagName('nombre')[i].text||animalesAsignados.getElementsByTagName('nombre')[i].textContent||"");
		descripcion = tipo + " ("+nombre+")";
		var objetoAnimal	= "textAnimalAsignado_" + i;
		document.getElementById(objetoAnimal).value	= descripcion;
	}
}

function cargaArmasAsignadas(armasAsignadas){
	alert("cargaCantidadArmas : " + cargaCantidadArmas);
	if (cargaCantidadArmas == 1){
		for(i=0;i<armasAsignadas.getElementsByTagName('arma').length;i++){
			var codigoTipoArma	 	= (armasAsignadas.getElementsByTagName('codigoTipo')[i].text||armasAsignadas.getElementsByTagName('codigoTipo')[i].textContent||"");
			var numeroArma	 		= (armasAsignadas.getElementsByTagName('numero')[i].text||armasAsignadas.getElementsByTagName('numero')[i].textContent||"");
			var codigoResponsable	= (armasAsignadas.getElementsByTagName('codigoFuncionario')[i].text||armasAsignadas.getElementsByTagName('codigoFuncionario')[i].textContent||"");
			var objetoArma 			= "selTipoArma_" + i;
			var objetoNumeroArma 	= "textIdentificacionArma_" + i;
			var objetoResponsable 	= "selResponsableArma_" + i;
			document.getElementById(objetoArma).value 		 	= codigoTipoArma;
			document.getElementById(objetoNumeroArma).value  	= numeroArma;
			document.getElementById(objetoResponsable).value	= codigoResponsable;
		}
		clearInterval(idCargaArmasAsignadas);
	}
}

function cargaAnimalesAsignados(animalesAsignados){
	for(i=0;i<animalesAsignados.getElementsByTagName('animal').length;i++){
		var codigoTipo	 	= (animalesAsignados.getElementsByTagName('codigoTipo')[i].text||animalesAsignados.getElementsByTagName('codigoTipo')[i].textContent||"");
		var cantidad 		= (animalesAsignados.getElementsByTagName('cantidad')[i].text||animalesAsignados.getElementsByTagName('cantidad')[i].textContent||"");
		var objetoTipo 		= "selTipoAnimal_" + i;
		var objetoCantidad 	= "textIdentificacionAnimal_" + i;
		document.getElementById(objetoTipo).value 	   = codigoTipo;
		document.getElementById(objetoCantidad).value  = cantidad;
	}
}

function cargaAccesoriosAsignados(accesoriosAsignados){
	for(i=0;i<accesoriosAsignados.getElementsByTagName('accesorio').length;i++){
		var codigoTipo		= (accesoriosAsignados.getElementsByTagName('codigoTipo')[i].text||accesoriosAsignados.getElementsByTagName('codigoTipo')[i].textContent||"");
		var cantidad 		= (accesoriosAsignados.getElementsByTagName('cantidad')[i].text||accesoriosAsignados.getElementsByTagName('cantidad')[i].textContent||"");
		var objetoTipo 		= "selTipoAccesorio_" + i;
		var objetoCantidad 	= "textCantAccesorio_" + i;
		document.getElementById(objetoTipo).value 	   = codigoTipo;
		document.getElementById(objetoCantidad).value  = cantidad;
	}
}

var arrayListaMV = new Array();
function agregaMedioVigilancia(validar){
	var tipoUnidad	= document.getElementById('tipoUnidad').value;
	var uniGope		= document.getElementById('unidadUsuario').value;
	if((tipoUnidad==30 || tipoUnidad==120)||(tipoUnidad==160 && uniGope==20)){
		if (validar == 1) var validaOk = validaMedioVigilancia();
		else var validaOK = "True";
		
		if (validaOk){
			var arrayPersonalMV					= new Array();
			var arrayPersonalDescMV				= new Array();
			var arrayCuadranteMV				= new Array();
			var arrayMedioVigilancia			= new Array();
			var arrayUnidadDestinoServicio		= new Array();
			var arrayUnidadDestinoServicioDesc 	= new Array();
			var arrayCuadranteDescMV			= new Array();
			
			var largoPersonalMV	= document.getElementById('personalServicioMedio').length;
			var idVehiculo 			= document.getElementById('vehiculosServicio').value;
			var CantUnidadDestinoServicio = document.getElementById('destinosSeleccionados').length;
			var idAnimal 			= document.getElementById('animalServicio').value;
			
			if (idVehiculo != "") var descVehiculo = document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex].text;
			else var descVehiculo = "";
			
			if (idAnimal != "") var descAnimal = document.getElementById('animalServicio').options[document.getElementById('animalServicio').selectedIndex].text;
			else var descAnimal = "";
			
			if (document.getElementById('textKmFinal').value== "" || document.getElementById('textKmFinal').value== 0){
				var kmInicial	= 0;
				var kmFinal		= 0;
			}else{
				var kmInicial	= document.getElementById('textKmInicial').value;
				var kmFinal		= document.getElementById('textKmFinal').value;
			}
			
			for (i=0;i<largoPersonalMV;i++){
				arrayPersonalMV[arrayPersonalMV.length] = document.getElementById('personalServicioMedio').options[i].value;
				arrayPersonalDescMV[arrayPersonalDescMV.length] = document.getElementById('personalServicioMedio').options[i].text;
			}
			
			for (i=0;i<CantUnidadDestinoServicio;i++){
				var textoDestinoServicio = document.getElementById('destinosSeleccionados').options[i].value;
				var largoTextoDestinoServicio= textoDestinoServicio.length;
				var marcaCuadrante = textoDestinoServicio.substr(largoTextoDestinoServicio-1,1);
				
				if(marcaCuadrante=="C"){
					var valorCuadrante = textoDestinoServicio.substr(0,largoTextoDestinoServicio-1);
					arrayCuadranteMV[arrayCuadranteMV.length] = valorCuadrante;
					arrayCuadranteDescMV[arrayCuadranteDescMV.length] = document.getElementById('destinosSeleccionados').options[i].text;
				}else{
					arrayUnidadDestinoServicio[arrayUnidadDestinoServicio.length] = document.getElementById('destinosSeleccionados').options[i].value;
					arrayUnidadDestinoServicioDesc[arrayUnidadDestinoServicioDesc.length] = document.getElementById('destinosSeleccionados').options[i].text;
				}	            
			}
			
			arrayMedioVigilancia[0] = idVehiculo;
			arrayMedioVigilancia[1] = descVehiculo;
			arrayMedioVigilancia[2] = kmInicial;
			arrayMedioVigilancia[3] = kmFinal;
			arrayMedioVigilancia[4] = arrayPersonalMV;
			arrayMedioVigilancia[5] = arrayCuadranteMV;
			arrayMedioVigilancia[6] = arrayPersonalDescMV;
			arrayMedioVigilancia[7] = 0;
			arrayMedioVigilancia[8] = "";
			arrayMedioVigilancia[9] = idAnimal;
			arrayMedioVigilancia[10] = descAnimal;
			arrayMedioVigilancia[11] = arrayCuadranteDescMV;
			arrayMedioVigilancia[12] = arrayUnidadDestinoServicio;
			arrayMedioVigilancia[13] = arrayUnidadDestinoServicioDesc;
			
			if (document.getElementById('idMV').value != "") {
				var punteroArrayMV = document.getElementById('idMV').value;
				document.getElementById('idMV').value = "";
			} else {
				var punteroArrayMV = arrayListaMV.length;
			}
			
			arrayListaMV[punteroArrayMV] = arrayMedioVigilancia;
			if (idVehiculo != 0) document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex] = null;
			if (idAnimal != 0) document.getElementById('animalServicio').options[document.getElementById('animalServicio').selectedIndex] = null;
			seleccionaAnimalMedioVigilancia();
			seleccionaVehiculoMedioVigilancia();
			listaMediosVigilancia();
	 	}	
	}else{
		if (validar == 1) var validaOk = validaMedioVigilancia();
		else var validaOK = "True";
		
		if (validaOk){
			var arrayPersonalMV 			= new Array();
			var arrayPersonalDescMV 	= new Array();
			var arrayCuadranteMV			= new Array();
			var arrayMedioVigilancia	= new Array();
			
			var largoPersonalMV = document.getElementById('personalServicioMedio').length;
			var CantCuadrantes 	= document.getElementById('cuadrantesMV').length;
			var idVehiculo 			= document.getElementById('vehiculosServicio').value;
			var idAnimal 				= document.getElementById('animalServicio').value;
			
			if (idVehiculo != "") var descVehiculo = document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex].text;
			else var descVehiculo = "";
			
			if (idAnimal != "") var descAnimal = document.getElementById('animalServicio').options[document.getElementById('animalServicio').selectedIndex].text;
			else var descAnimal = "";
			
			if (document.getElementById('textKmFinal').value== "" || document.getElementById('textKmFinal').value== 0){
				var kmInicial	= 0;
				var kmFinal		= 0;
			}else{
				var kmInicial	= document.getElementById('textKmInicial').value;
				var kmFinal		= document.getElementById('textKmFinal').value;
			}
			
			var idFactor		= document.getElementById('factorMV').value;
			var descFactor	= document.getElementById('factorMV').options[document.getElementById('factorMV').selectedIndex].text;
			
			for (i=0;i<largoPersonalMV;i++){
				arrayPersonalMV[arrayPersonalMV.length] = document.getElementById('personalServicioMedio').options[i].value;
				arrayPersonalDescMV[arrayPersonalDescMV.length] = document.getElementById('personalServicioMedio').options[i].text;
			}
			
			for (i=0;i<CantCuadrantes;i++){
				if (document.getElementById('cuadrantesMV').options[i].selected) {
					arrayCuadranteMV[arrayCuadranteMV.length] = document.getElementById('cuadrantesMV').options[i].value;
				}
			}
			
			arrayMedioVigilancia[0] = idVehiculo;
			arrayMedioVigilancia[1] = descVehiculo;
			arrayMedioVigilancia[2] = kmInicial;
			arrayMedioVigilancia[3] = kmFinal;
			arrayMedioVigilancia[4] = arrayPersonalMV;
			arrayMedioVigilancia[5] = arrayCuadranteMV;
			arrayMedioVigilancia[6] = arrayPersonalDescMV;
			arrayMedioVigilancia[7] = idFactor;
			arrayMedioVigilancia[8] = descFactor;
			arrayMedioVigilancia[9] = idAnimal;
			arrayMedioVigilancia[10] = descAnimal;
			
			if (document.getElementById('idMV').value != "") {
				var punteroArrayMV = document.getElementById('idMV').value;
				document.getElementById('idMV').value = "";
			} else {
				var punteroArrayMV = arrayListaMV.length;
			}
			
			arrayListaMV[punteroArrayMV] = arrayMedioVigilancia;
			if (idVehiculo != 0) document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex] = null;
			if (idAnimal != 0) document.getElementById('animalServicio').options[document.getElementById('animalServicio').selectedIndex] = null;
			seleccionaAnimalMedioVigilancia();
			seleccionaVehiculoMedioVigilancia();
			listaMediosVigilancia();
		}
 	}
}

function seleccionaVehiculoMedioVigilancia(){
	
	for (var i=0; i<ListaVehiculosDisponibles.length; i++){
		if(ListaVehiculosDisponibles[i][0]==document.getElementById('vehiculosServicio').value){
			var indicaKm = ListaVehiculosDisponibles[i][2];
		}
	}
	
	if (document.getElementById('vehiculosServicio').value == 0){
		document.getElementById('animalServicio').disabled = "";
		document.getElementById('animalServicio').style.backgroundColor = "";
		document.getElementById('textKmInicial').value = "";
		document.getElementById('textKmFinal').value = "";
		document.getElementById('labKmInicial').disabled = "true";
		document.getElementById('textKmInicial').disabled = "true";
		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal').disabled = "true";
		document.getElementById('textKmFinal').disabled = "true";
		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
	}
	else if(indicaKm == 0){
		document.getElementById('animalServicio').disabled = "true";
		document.getElementById('animalServicio').style.backgroundColor = "#D4D4D4";
		document.getElementById('textKmInicial').value = "";
		document.getElementById('textKmFinal').value = "";
		document.getElementById('labKmInicial').disabled = "true";
		document.getElementById('textKmInicial').disabled = "true";
		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal').disabled = "true";
		document.getElementById('textKmFinal').disabled = "true";
		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
	}
	else {
		document.getElementById('animalServicio').disabled = "true";
		document.getElementById('animalServicio').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmInicial').disabled = "";
		document.getElementById('textKmInicial').disabled = "";
		document.getElementById('textKmInicial').style.backgroundColor = "";
		document.getElementById('labKmFinal').disabled = "";
		document.getElementById('textKmFinal').disabled = "";
		document.getElementById('textKmFinal').style.backgroundColor = "";
	}
}

function seleccionaAnimalMedioVigilancia(){
	if (document.getElementById('animalServicio').value == 0){
		document.getElementById('vehiculosServicio').disabled = "";
		document.getElementById('vehiculosServicio').style.backgroundColor = "";
		document.getElementById('labKmInicial').disabled = "true";
		document.getElementById('textKmInicial').disabled = "true";
		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal').disabled = "true";
		document.getElementById('textKmFinal').disabled = "true";
		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
	}else {
		document.getElementById('vehiculosServicio').disabled = "true";
		document.getElementById('vehiculosServicio').style.backgroundColor = "#D4D4D4";
		document.getElementById('textKmInicial').value = "";
		document.getElementById('textKmFinal').value = "";
		document.getElementById('labKmInicial').disabled = "true";
		document.getElementById('textKmInicial').disabled = "true";
		document.getElementById('textKmInicial').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal').disabled = "true";
		document.getElementById('textKmFinal').disabled = "true";
		document.getElementById('textKmFinal').style.backgroundColor = "#D4D4D4";
	} 
}

function borraMedioVigilancia(){
	var elementoBorrar = document.getElementById('idMV').value;
	arrayListaMV.splice(elementoBorrar,1);
	document.getElementById('idMV').value = "";
	moverDatos('personalServicioMedio', 'personalServicio', true);
	limpiaMedioVigilancia();
	listaMediosVigilancia();
}

function validaMedioVigilancia(){
	var tipoUnidad   = document.getElementById('tipoUnidad').value;
	var uniGope   = document.getElementById('unidadUsuario').value;
	
	if((tipoUnidad==30 || tipoUnidad==120)||(tipoUnidad==160 && uniGope==0)){
	
		var cantPersonal  	= document.getElementById('personalServicioMedio').length;
		var kmInicial 	  	= eliminarBlancos(document.getElementById('textKmInicial').value);
		var kmFinal 	  	= eliminarBlancos(document.getElementById('textKmFinal').value);
		var planCuadrante 	= eliminarBlancos(document.getElementById('tienePlanCuadrante').value);
		var cantDestino   	= document.getElementById('destinosSeleccionados').length;
		var opcionServicio	= document.getElementById("selServicio").value;
		var tipoServicio 	= opcionServicio.substr(0,1);
		var idAnimal 		= document.getElementById('animalServicio').value;
		
		if (cantPersonal == 0) {
			alert("NO EXISTE PERSONAL SELECCIONADO ...     ");
			return false;
		}
		
		if (cantDestino == 0 && tipoServicio=="O") {
			alert("NO EXISTE DESTINO SELECCIONADO ...     ");
			return false;
		}
		
		if(idAnimal != 0 && cantPersonal > 1){
			alert("NO PUEDE INGRESAR MAS DE UN FUNCIONARIO POR ANIMAL");
			return false;
		}
		
		for (var i=0; i<ListaVehiculosDisponibles.length; i++){
			if(ListaVehiculosDisponibles[i][0]==document.getElementById('vehiculosServicio').value){
				var indicaKm = ListaVehiculosDisponibles[i][2];
			}
		}
		
		if (document.getElementById('vehiculosServicio').value != 0 && indicaKm == 1){
			
			if (kmInicial == ""){
				alert("DEBE INGRESAR KILOMETRAJE INICIAL ...     ");
				document.getElementById('textKmInicial').value = "";
				return false;
			}
			
			if (IsNumeric(kmInicial) == false){
				alert("DEBE INGRESAR KILOMETRAJE INICIAL VALIDO...     ");
				return false;
			}
			
			if (IsNumeric(kmInicial) == 0){
				alert("DEBE INGRESAR KILOMETRAJE INICIAL VALIDO...     ");
				return false;
			}
			
			if (kmFinal == ""){
				alert("DEBE INGRESAR KILOMETRAJE FINAL ...     ");
				document.getElementById('textKmFinal').value = "";
				return false;
			}
			
			if (IsNumeric(kmFinal) == false){
				alert("DEBE INGRESAR KILOMETRAJE FINAL VALIDO...     ");
				return false;
			}
			
			if (kmFinal*1 <= kmInicial*1){
				alert("EL KILOMETRAJE FINAL NO PUEDE SER MENOR O IGUAL QUE EL KILOMETRAJE INICIAL ....  ");
				return false;
			}
			
			var cantidadKilometros = kmFinal - kmInicial;			
			if (cantidadKilometros>2500){
				alert("LA CANTIDAD DE KILOMETROS INGRESADOS EXCEDE LO ACEPTABLE PARA UN SERVICIO POLICIAL.         \nPARA CONSULTAS ANEXO NRO. 20843 O 20845.");
				return false;
			}
			
			if (cantidadKilometros>250){
				if(confirm("ADVERTENCIA :\nEL KILOMETRAJE INGRESADO EXCEDE LOS 250KM.          \n\u00BFDESEA CONTINUAR?")!=true) return false;
			}
			
		}
		
		var opcionServicio  = document.getElementById("selServicio").value;
		var tipoServicio 	= opcionServicio.substr(0,1);
		var servicio 		= opcionServicio.substr(1,opcionServicio.length);
		return true;
	}
	else{
		var cantPersonal  = document.getElementById('personalServicioMedio').length;
		var kmInicial 	  = eliminarBlancos(document.getElementById('textKmInicial').value);
		var kmFinal 	  = eliminarBlancos(document.getElementById('textKmFinal').value);
		var planCuadrante = eliminarBlancos(document.getElementById('tienePlanCuadrante').value);
		var idAnimal	  = document.getElementById('animalServicio').value;
		
		if (cantPersonal == 0) {
			alert("NO EXISTE PERSONAL SELECCIONADO ...     ");
			return false;
		}
		
		if(idAnimal != 0 && cantPersonal > 1){
			alert("NO PUEDE INGRESAR MAS DE UN FUNCIONARIO POR ANIMAL");
			return false;
		}
		
		for (var i=0; i<ListaVehiculosDisponibles.length; i++){
			if(ListaVehiculosDisponibles[i][0]==document.getElementById('vehiculosServicio').value){
				var indicaKm = ListaVehiculosDisponibles[i][2];
			}
		}
		
		if(document.getElementById('vehiculosServicio').value != 0 && indicaKm == 1){
			
			if (kmInicial == ""){
				alert("DEBE INGRESAR KILOMETRAJE INICIAL ...     ");
				document.getElementById('textKmInicial').value = "";
				return false;
			}
							
			if (IsNumeric(kmInicial) == false){
				alert("DEBE INGRESAR KILOMETRAJE INICIAL VALIDO...     ");
				return false;
			}
			
			if (IsNumeric(kmInicial) == 0){
				alert("DEBE INGRESAR KILOMETRAJE INICIAL VALIDO...     ");
				return false;
			}
			
			var codigoVehiculoPaso = document.getElementById('vehiculosServicio').value;
			if (kmFinal == ""){
				alert("DEBE INGRESAR KILOMETRAJE FINAL ...     ");
				document.getElementById('textKmFinal').value = "";
				return false;
			}
			
			if (IsNumeric(kmFinal) == false){
				alert("DEBE INGRESAR KILOMETRAJE FINAL VALIDO...     ");
				return false;
			}
			
			if (kmFinal*1 <= kmInicial*1){
				alert("EL KILOMETRAJE FINAL NO PUEDE SER MENOR O IGUAL QUE EL KILOMETRAJE INICIAL ....  ");
				return false;
			}
			
			var cantidadKilometros = kmFinal - kmInicial;
			if (cantidadKilometros>2500){
				alert("LA CANTIDAD DE KILOMETROS INGRESADOS EXCEDE LO ACEPTABLE PARA UN SERVICIO POLICIAL.         \nPARA CONSULTAS ANEXO NRO. 20843 O 20845.");
				return false;
			}
			
			if (cantidadKilometros>250){
				if(confirm("ADVERTENCIA :\nEL KILOMETRAJE INGRESADO EXCEDE LOS 250KM.          \n\u00BFDESEA CONTINUAR?")!=true) return false;
			}
		}
		
		var opcionServicio	= document.getElementById("selServicio").value;
		var tipoServicio 	= opcionServicio.substr(0,1);
		var servicio 		= opcionServicio.substr(1,opcionServicio.length);
		var tipoUnidad   	= document.getElementById('tipoUnidad').value;
		var uniGope   		= document.getElementById('unidadUsuario').value;
		
		if (planCuadrante == 1 && (tipoServicio == "O" || tipoServicio == "F") && servicio != 2000){
			var tipoUnidad = document.getElementById('tipoUnidad').value;
			
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
				document.getElementById('factorMV').focus();
				return false;
			}
		}
		return true;
 	}
}

function limpiaMedioVigilancia(){
	var tipoUnidad = document.getElementById('tipoUnidad').value;
	var uniGope   = document.getElementById('unidadUsuario').value;
	document.getElementById('personalServicioMedio').length = null;
	document.getElementById('textKmInicial').value			= "";
	document.getElementById('textKmFinal').value			= "";
	document.getElementById('vehiculosServicio').value		= 0;
	document.getElementById('animalServicio').value			= 0;
	
 	if((tipoUnidad==30 || tipoUnidad==120)||(tipoUnidad==160 && uniGope==20)){
		document.getElementById('destinosSeleccionados').length = null;
	} 
	else{
		document.getElementById('factorMV').value	= 0;
		for (i=0; i<document.getElementById('cuadrantesMV').length; i++){
			document.getElementById('cuadrantesMV').options[i].selected = false;
		}
  }
	document.getElementById('btnEliminaMV').disabled = true;
}

function listaMediosVigilancia(){
	var tipoUnidad = document.getElementById('tipoUnidad').value;
	var uniGope   = document.getElementById('unidadUsuario').value;
 	if((tipoUnidad==30 || tipoUnidad==120)||(tipoUnidad==160 && uniGope==20)){
		var listaMedios = "";
		var sw = 0;
		var fondoLinea;
		listaMedios += "<table border='0' cellspacing='1' cellpadding='1'>";
		for (var i=0; i<arrayListaMV.length; i++){
			if (sw==0) {fondoLinea = "linea1"; sw =1;}
			else {fondoLinea = "linea2"; sw=0;}
			
			var resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
			var lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
			var cuadranteValor = arrayListaMV[i][5].length;
			var destinoValor = arrayListaMV[i][12].length;
			var destinoCuadrante = cuadranteValor+destinoValor;
			var descripcionFactor = "";
			
			if (arrayListaMV[i][7] != 0) var descripcionFactor = ", (FACTOR: " + arrayListaMV[i][8] + ")";
			else var descripcionFactor = "";
			
		  if (arrayListaMV[i][0] == 0) var medios1 = "SIN VEHICULO (INFANTERIA)";
		  else var medios1 = arrayListaMV[i][1];
		  
			if (arrayListaMV[i][9] == 0) var medios2 = ", SIN ANIMAL";
			else var medios2 = ","+arrayListaMV[i][10];
			
			listaMedios += "<tr id='linea"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onclick='muestraMedioViginlacia("+i+")'>";
			listaMedios += "<td width='356px' style='padding:0px 0px 0px 5px' align='left'>"+ medios1 + medios2 + descripcionFactor +"</td>";
			listaMedios += "<td width='136px' style='padding:0px 0px 0px 0px' align='center'>"+arrayListaMV[i][4].length+"</td>";
			listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='right'>"+formato_numero(arrayListaMV[i][2],0,',','.')+"</td>";
			listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='right'>"+formato_numero(arrayListaMV[i][3],0,',','.')+"</td>";
			listaMedios += "<td width='119px' style='padding:0px 0px 0px 0px' align='center'>"+destinoCuadrante+"</td>";
			listaMedios += "<tr>";
		}
		listaMedios += "</table>";
		document.getElementById("listadoMediosVigilancia").innerHTML = listaMedios;
		limpiaMedioVigilancia();
	
	}else{
		var listaMedios = "";
		var sw = 0;
		var fondoLinea;
		listaMedios += "<table border='0' cellspacing='1' cellpadding='1' width='99.98%'>";
		for (var i=0; i<arrayListaMV.length; i++){
			if (sw==0) {fondoLinea = "linea1";sw =1}
			else {fondoLinea = "linea2";sw=0}
			var resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
			var lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
			var descripcionCuadrantes = "";
			for (var j=0; j<arrayListaMV[i][5].length; j++){
				for (var k=0; k<document.getElementById('cuadrantesMV').length; k++){
					if (document.getElementById('cuadrantesMV').options[k].value == arrayListaMV[i][5][j]){
						var pasoDescCuadrante = document.getElementById('cuadrantesMV').options[k].text.split(" ");
						descripcionCuadrantes += pasoDescCuadrante[1] + ",";
					}
				}
			}
			
			if (arrayListaMV[i][7] != 0) var descripcionFactor = " (FACTOR: " + arrayListaMV[i][8] + ")";
			else var descripcionFactor = "";
			
		  if (arrayListaMV[i][0] == 0) var medios1 = "SIN VEH\u00CDCULO (INFANTERIA) ";
		  else var medios1 = arrayListaMV[i][1];
		  
			if (arrayListaMV[i][9] == 0) var medios2 = ", SIN ANIMAL";
			else var medios2 = ", "+arrayListaMV[i][10];
			
			descripcionCuadrantes = descripcionCuadrantes.substring(0,descripcionCuadrantes.length-1);
			listaMedios += "<tr id='linea"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onclick='muestraMedioViginlacia("+i+")'>";
			listaMedios += "<td width='356px' style='padding:0px 0px 0px 5px' align='left'>"+ medios1 + medios2 + descripcionFactor +"</td>";
			listaMedios += "<td width='136px' style='padding:0px 0px 0px 0px' align='center'>"+arrayListaMV[i][4].length+"</td>";
			listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='center'>"+formato_numero(arrayListaMV[i][2],0,',','.')+"</td>";
			listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='center'>"+formato_numero(arrayListaMV[i][3],0,',','.')+"</td>";
			listaMedios += "<td width='119px' style='padding:0px 0px 0px 0px' align='center'>"+descripcionCuadrantes+"</td>";
			listaMedios += "<tr>";
		}
		listaMedios += "</table>";
		document.getElementById("listadoMediosVigilancia").innerHTML = listaMedios;
		limpiaMedioVigilancia();
	}
}

function muestraMedioViginlacia(numero){
	var tipoUnidad = document.getElementById('tipoUnidad').value;
  var uniGope   = document.getElementById('unidadUsuario').value;
 	if((tipoUnidad==30 || tipoUnidad==120)||(tipoUnidad==160 && uniGope==20)){
  	if (document.getElementById('idMV').value == ""){
   		var nombreObjeto = "linea"+numero;
			document.getElementById(nombreObjeto).className = 'lineaMarcada';
			document.getElementById(nombreObjeto)['onmouseout'] = new Function("this.className = 'lineaMarcada'");
			
			if (document.getElementById('idMV').value != 0) document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex] = null;
			if (document.getElementById('idMV').value != 0) document.getElementById('animalServicio').options[document.getElementById('animalServicio').selectedIndex] = null;
			
			document.getElementById('idMV').value 			= numero;
			document.getElementById('textKmInicial').value	= arrayListaMV[numero][2];
			document.getElementById('textKmFinal').value   	= arrayListaMV[numero][3];
			
			if (arrayListaMV[numero][0] != 0){
				var datosOpcion = new Option(arrayListaMV[numero][1], arrayListaMV[numero][0], "", "");
				document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').length] = datosOpcion;
			}
			
			if (arrayListaMV[numero][9] != 0){
				var datosOpcion = new Option(arrayListaMV[numero][10], arrayListaMV[numero][9], "", "");
				document.getElementById('animalServicio').options[document.getElementById('animalServicio').length] = datosOpcion;
			}
			
			document.getElementById('vehiculosServicio').value 		= arrayListaMV[numero][0];
			document.getElementById('animalServicio').value 		= arrayListaMV[numero][9];
			document.getElementById('personalServicioMedio').length = null;
			
			for (i=0; i<arrayListaMV[numero][4].length; i++){
				var datosOpcion = new Option(arrayListaMV[numero][6][i], arrayListaMV[numero][4][i], "", "");
				document.getElementById('personalServicioMedio').options[i] = datosOpcion;
			}
			
			for (i=0; i<arrayListaMV[numero][5].length; i++){
				var datosOpcion = new Option(arrayListaMV[numero][11][i], arrayListaMV[numero][5][i]+"C", "", "");
		 		document.getElementById('destinosSeleccionados').options[i] = datosOpcion;
			}
			
			for (j=0; j<arrayListaMV[numero][12].length; j++){
	     	var datosOpcion1 = new Option(arrayListaMV[numero][13][j], arrayListaMV[numero][12][j], "", "");
		 		document.getElementById('destinosSeleccionados').options[i++] = datosOpcion1;
	    }
	    
			document.getElementById('btnEliminaMV').disabled = "";
			seleccionaVehiculoMedioVigilancia();
			seleccionaAnimalMedioVigilancia();
		}
  }else{
		if (document.getElementById('idMV').value == ""){
			var nombreObjeto = "linea"+numero;
			document.getElementById(nombreObjeto).className = 'lineaMarcada';
			document.getElementById(nombreObjeto)['onmouseout'] = new Function("this.className = 'lineaMarcada'");
			
			if (document.getElementById('idMV').value != 0) document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').selectedIndex] = null;
			if (document.getElementById('idMV').value != 0) document.getElementById('animalServicio').options[document.getElementById('animalServicio').selectedIndex] = null;
			
			document.getElementById('idMV').value 			= numero;
			document.getElementById('textKmInicial').value	= arrayListaMV[numero][2];
			document.getElementById('textKmFinal').value   	= arrayListaMV[numero][3];
			document.getElementById('factorMV').value		= arrayListaMV[numero][7];
			
			if (arrayListaMV[numero][0] != 0){
				var datosOpcion = new Option(arrayListaMV[numero][1], arrayListaMV[numero][0], "", "");
				document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').length] = datosOpcion;
			}
			
			if (arrayListaMV[numero][9] != 0){
				var datosOpcion = new Option(arrayListaMV[numero][10], arrayListaMV[numero][9], "", "");
				document.getElementById('animalServicio').options[document.getElementById('animalServicio').length] = datosOpcion;
			}
			
			document.getElementById('vehiculosServicio').value	= arrayListaMV[numero][0];
			document.getElementById('animalServicio').value 	= arrayListaMV[numero][9];
			
			for (i=0; i<document.getElementById('cuadrantesMV').length; i++){
				document.getElementById('cuadrantesMV').options[i].selected = false;
			}
			
			for (i=0; i<arrayListaMV[numero][5].length; i++){
				for (j=0; j<document.getElementById('cuadrantesMV').length; j++){
					if (document.getElementById('cuadrantesMV').options[j].value == arrayListaMV[numero][5][i]) document.getElementById('cuadrantesMV').options[j].selected = true;
				}
			}
			
			document.getElementById('personalServicioMedio').length = null;
			for (i=0; i<arrayListaMV[numero][4].length; i++){
				var datosOpcion = new Option(arrayListaMV[numero][6][i], arrayListaMV[numero][4][i], "", "");
				document.getElementById('personalServicioMedio').options[i] = datosOpcion;
			}
			
			document.getElementById('btnEliminaMV').disabled = "";
			seleccionaVehiculoMedioVigilancia();
			seleccionaAnimalMedioVigilancia();
		}
  }
}

function asignarAccesorios(){
	moverDatos('armasDisponibles', 'personalServicioAccesorio');
	//moverDatos('animalesDisponibles', 'personalServicioAccesorio');
	moverDatos('accesoriosDisponibles', 'personalServicioAccesorio');
	for(var i=0;i<personalServicioAccesorio.length;i++){
		if(personalServicioAccesorio.options[i].value.substring(0,1)=="C") return;
	}
	moverDatos('camarasDisponibles', 'personalServicioAccesorio');
}

function desAsignarAccesorios(){
	var valorCodigo = document.getElementById('personalServicioAccesorio').value;
	var letraInicial = valorCodigo.substring(0,1);
	if (letraInicial == "P") moverDatos('personalServicioAccesorio','armasDisponibles');
	//if (letraInicial == "A") moverDatos('personalServicioAccesorio','animalesDisponibles');
	if (letraInicial == "O" || letraInicial == "F") moverDatos('personalServicioAccesorio','accesoriosDisponibles');
	if (letraInicial == "C") moverDatos('personalServicioAccesorio','camarasDisponibles');
	ordenarAccesorio('accesoriosDisponibles');
	//ordenar(document.getElementById('animalesDisponibles'));
	ordenar(document.getElementById('armasDisponibles'));
	ordenar(document.getElementById('camarasDisponibles'));
}

var arrayListaAccesorios = new Array();
function agregaFuncionarioAccesorios(){
	var arrayArmPersonal 			= new Array();
	var arrayDescArmPersonal 		= new Array();
	var arrayAniPersonal 			= new Array();
	var arrayDescAniPersonal 		= new Array();
	var arrayAccPersonal			= new Array();
	var arrayCamPersonal 			= new Array();
	var arrayDescCamPersonal 		= new Array();
	var arrayDescAccPersonal		= new Array();
	var arrayPersonaAccesorios		= new Array();
	var codFuncionario 				= document.getElementById('personalServicio2').value;
	var descFuncionario 			= document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex].text;
	var largoAccesoriosAsignados	= document.getElementById('personalServicioAccesorio').length;
	for (i=0;i<largoAccesoriosAsignados;i++){
		var valorOption 	= document.getElementById('personalServicioAccesorio').options[i].value;
		var letraInicial	= valorOption.substring(0,1);
		var valorCodido 	= valorOption;
		var descOpcion		= document.getElementById('personalServicioAccesorio').options[i].text;
		if (letraInicial == "P"){
			arrayArmPersonal[arrayArmPersonal.length]			= valorCodido;
			arrayDescArmPersonal[arrayDescArmPersonal.length]	= descOpcion;
		}
		if (letraInicial == "A"){
			arrayAniPersonal[arrayAniPersonal.length]			= valorCodido;
			arrayDescAniPersonal[arrayDescAniPersonal.length] 	= descOpcion;
		}
		if (letraInicial == "O" || letraInicial == "F"){
			arrayAccPersonal[arrayAccPersonal.length]			= valorCodido;
			arrayDescAccPersonal[arrayDescAccPersonal.length] 	= descOpcion;
		}
		if (letraInicial == "C"){
			arrayCamPersonal[arrayCamPersonal.length]			= valorCodido;
			arrayDescCamPersonal[arrayDescCamPersonal.length] 	= descOpcion;
		}
	}
	
	arrayPersonaAccesorios[0] = codFuncionario;
	arrayPersonaAccesorios[1] = descFuncionario;
	arrayPersonaAccesorios[2] = arrayArmPersonal;
	arrayPersonaAccesorios[3] = arrayAniPersonal;
	arrayPersonaAccesorios[4] = arrayAccPersonal;
	arrayPersonaAccesorios[5] = arrayDescArmPersonal;
	arrayPersonaAccesorios[6] = arrayDescAniPersonal;
	arrayPersonaAccesorios[7] = arrayDescAccPersonal;
	arrayPersonaAccesorios[8] = arrayCamPersonal;
	arrayPersonaAccesorios[9] = arrayDescCamPersonal;
	
	if (document.getElementById('idLA').value != ""){
		var punteroArrayListaAccesorios = document.getElementById('idLA').value;
		document.getElementById('idLA').value = "";
	} else {
		var punteroArrayListaAccesorios = arrayListaAccesorios.length;
	}

	arrayListaAccesorios[punteroArrayListaAccesorios] = arrayPersonaAccesorios;
	document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex] = null;
	limpiaAccesoriosFuncionario(false);
	listaPesonalAccesorios();
	ordenarAccesorio('accesoriosDisponibles');
	//ordenar(document.getElementById('animalesDisponibles'));
	ordenar(document.getElementById('armasDisponibles'));
	ordenar(document.getElementById('camarasDisponibles'));
	document.getElementById('btnEliminarAccesorios').disabled = true;
	document.getElementById('btnAgregarAccesorios').disabled = (document.getElementById('personalServicio2').length == 0) ? true : false;
}

function listaPesonalAccesorios(){
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
		listaPAccesorios += "<td width='30.5%' style='padding:0px 5px 0px 5px' align='left'>"+descFuncionario+"</td>";
		listaPAccesorios += "<td width='10%' style='padding:0px 5px 0px 0px' align='center'>"+arrayListaAccesorios[i][2].length+"</td>";
		listaPAccesorios += "<td width='10%' style='padding:0px 5px 0px 0px' align='center'>"+arrayListaAccesorios[i][8].length+"</td>";
		listaPAccesorios += "<td width='10%' style='padding:0px 5px 0px 0px' align='center'>"+arrayListaAccesorios[i][4].length+"</td>";
		listaPAccesorios += "<tr>";
	}
	listaPAccesorios += "</table>";
	document.getElementById("listadoPersonalAccesorios").innerHTML = listaPAccesorios;
}

function muestraAccesoriosFuncionario(numero){
	if (document.getElementById('idLA').value == ""){
		var nombreObjeto = "linea"+numero;
		document.getElementById(nombreObjeto).className = 'lineaMarcada';
		document.getElementById(nombreObjeto)['onmouseout'] = new Function("this.className = 'lineaMarcada'");
		if (document.getElementById('idLA').value != "") document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').selectedIndex] = null;
		limpiaAccesoriosFuncionario(false);
		document.getElementById('idLA').value = numero;
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
		/*
		for (i=0; i<arrayListaAccesorios[numero][3].length; i++){
			var datosOpcion = new Option(arrayListaAccesorios[numero][6][i], arrayListaAccesorios[numero][3][i], "", "");
			document.getElementById('personalServicioAccesorio').options[punteroSelect] = datosOpcion;
			punteroSelect++;
			for (j=0; j<document.getElementById('animalesDisponibles').length; j++){
				if (document.getElementById('animalesDisponibles').options[j].value == arrayListaAccesorios[numero][9][i]) document.getElementById('animalesDisponibles').options[j] = null;
			}
		}
		*/
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
			for (j=0; j<document.getElementById('camarasDisponibles').length; j++){
				if (document.getElementById('camarasDisponibles').options[j].value == arrayListaAccesorios[numero][8][i]) document.getElementById('camarasDisponibles').options[j] = null;
			}
		}
	}
	document.getElementById('btnEliminarAccesorios').disabled = "";
	document.getElementById('btnAgregarAccesorios').disabled = "";
}

function limpiaAccesoriosFuncionario(eliminar){
	var nombreObjeto = "";
	for (i=0; i<document.getElementById('personalServicioAccesorio').length; i++){
		var valorOption 	= document.getElementById('personalServicioAccesorio').options[i].value;
		var letraInicial 	= valorOption.substring(0,1);
		var valorCodido 	= valorOption;
		var descOpcion		= document.getElementById('personalServicioAccesorio').options[i].text;
		if (eliminar && letraInicial == "P") var nombreObjeto = "armasDisponibles";
		//if (letraInicial == "A") nombreObjeto = "animalesDisponibles";
		if (letraInicial == "O" || letraInicial == "F") nombreObjeto = "accesoriosDisponibles";
		if (eliminar && letraInicial == "C") nombreObjeto = "camarasDisponibles";
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
	ordenarAccesorio('accesoriosDisponibles');
	//ordenar(document.getElementById('animalesDisponibles'));
	ordenar(document.getElementById('armasDisponibles'));
	ordenar(document.getElementById('camarasDisponibles'));
	document.getElementById('btnAgregarAccesorios').disabled = (document.getElementById('personalServicio2').length == 0) ? true : false;
}

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
	if (validaDatosAsignaFuncionarios()){
		if (correlativo == "") guardarNuevoServicio();
		else actualizarServicio();
	}
}

function guardarNuevoServicio(){
	var tipoUnidad = document.getElementById('tipoUnidad').value;
 	var uniGope   = document.getElementById('unidadUsuario').value;
 	if((tipoUnidad==30 || tipoUnidad==120)||(tipoUnidad==160 && uniGope==20)){
 		var codigoUnidad				= document.getElementById("unidadServicio").value;
		var tipoServicioExtraordinario	= "0";
		var descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
		var fechaServicio 				= document.getElementById("textFechaServicio").value;
		var horaInicio					= document.getElementById("selHoraInicio").value;
		var horaTermino					= document.getElementById("selHoraTermino").value;
		var observaciones				= document.getElementById("textObservaciones").value;
		var opcionServicio				= document.getElementById("selServicio").value;
		var tipoServicio 	 			= opcionServicio.substr(1,opcionServicio.length);
		var grupo 				 		= opcionServicio.substr(0,1);
		var opcionLicencia 				= document.getElementById("selLicencia").value;
		var tipoLicencia 	 			= opcionLicencia.substr(1,opcionLicencia .length);
		var codigoUnidadDestino			= document.getElementById("unidadServicioDestino").value;
		
		if (grupo == "E") {
			tipoServicioExtraordinario 	= tipoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			tipoServicio = 1200;
		}

		if (grupo == "X") {
			tipoServicioExtraordinario 	= tipoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			tipoServicio = 1300;
		}
		
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
			arrayListaMVPaso[puntero][1] = arrayListaMV[puntero][1];
			arrayListaMVPaso[puntero][2] = arrayListaMV[puntero][2];
			arrayListaMVPaso[puntero][3] = arrayListaMV[puntero][3];
			arrayListaMVPaso[puntero][4] = arrayListaMV[puntero][4];
			arrayListaMVPaso[puntero][5] = arrayListaMV[puntero][5];
			arrayListaMVPaso[puntero][6] = '';
			arrayListaMVPaso[puntero][7] = arrayListaMV[puntero][7];
			arrayListaMVPaso[puntero][8] = arrayListaMV[puntero][8];
			arrayListaMVPaso[puntero][9] = arrayListaMV[puntero][9];
			arrayListaMVPaso[puntero][10] = arrayListaMV[puntero][10];
			arrayListaMVPaso[puntero][11] = arrayListaMV[puntero][11];
			arrayListaMVPaso[puntero][12] = arrayListaMV[puntero][12];
			arrayListaMVPaso[puntero][13] = arrayListaMV[puntero][13];
		}

		var arrayListaAccesoriosPaso = new Array();
		for (var puntero = 0; puntero < arrayListaAccesorios.length; puntero++){
			arrayListaAccesoriosPaso[puntero] = new Array();
			arrayListaAccesoriosPaso[puntero][0] = arrayListaAccesorios[puntero][0];
			arrayListaAccesoriosPaso[puntero][1] = '';
			arrayListaAccesoriosPaso[puntero][2] = arrayListaAccesorios[puntero][2];
			arrayListaAccesoriosPaso[puntero][3] = arrayListaAccesorios[puntero][3];
			arrayListaAccesoriosPaso[puntero][4] = arrayListaAccesorios[puntero][4];
			arrayListaAccesoriosPaso[puntero][5] = arrayListaAccesorios[puntero][5];
			arrayListaAccesoriosPaso[puntero][6] = arrayListaAccesorios[puntero][6];
			arrayListaAccesoriosPaso[puntero][7] = arrayListaAccesorios[puntero][7];
			arrayListaAccesoriosPaso[puntero][8] = arrayListaAccesorios[puntero][8];
		}
		var arregloMediosVigilancia 		= php_serialize(arrayListaMVPaso);
		var arregloAccesoriosFuncionarios	= php_serialize(arrayListaAccesoriosPaso);
		var parametros = "";
		parametros =  "codigoUnidad="+codigoUnidad+"&tipoServicio="+tipoServicio+"&tipoServicioExtraordinario="+tipoServicioExtraordinario;
		parametros += "&descServicioExtraordinario="+descServicioExtraordinario+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio;
		parametros += "&horaTermino="+horaTermino+"&observaciones="+observaciones+"&codigoUnidadDestino="+codigoUnidadDestino;
		parametros += "&arrayListaMV="+arregloMediosVigilancia+"&arrayListaAccesorios="+arregloAccesoriosFuncionarios;
		//console.log(parametros);
		var objHttpXMLServicios = new AJAXCrearObjeto();
		objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioNuevo.php",true);
		objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLServicios.send(encodeURI(parametros));
		objHttpXMLServicios.onreadystatechange=function(){
			//alert(objHttpXMLServicios.readyState);
			if(objHttpXMLServicios.readyState == 4){
				//console.log(objHttpXMLServicios.responseText);
				if (objHttpXMLServicios.responseText != "VACIO"){
					//alert(objHttpXMLServicios.responseText);
					var xml = objHttpXMLServicios.responseXML.documentElement;
					for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
						if (codigo == 1) {
							document.getElementById("mensajeGuardando").style.display = "none";
							alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
							top.leeServicios(codigoUnidad,'','','');
							idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
 	}else{
		var codigoUnidad 				= document.getElementById("unidadServicio").value;
		var tipoServicioExtraordinario	= "0";
		var descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
		var fechaServicio				= document.getElementById("textFechaServicio").value;
		var horaInicio					= document.getElementById("selHoraInicio").value;
		var horaTermino					= document.getElementById("selHoraTermino").value;
		var observaciones				= document.getElementById("textObservaciones").value;
		var opcionServicio 				= document.getElementById("selServicio").value;
		var tipoServicio 	 			= opcionServicio.substr(1,opcionServicio.length);
		var grupo 				 		= opcionServicio.substr(0,1);
		var opcionLicencia 				= document.getElementById("selLicencia").value;
		var tipoLicencia 	 			= opcionLicencia.substr(1,opcionLicencia .length);
		var codigoUnidadDestino			= document.getElementById("unidadServicioDestino").value;
		
		if (grupo == "E") {
			tipoServicioExtraordinario 	= tipoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			tipoServicio = 1200;
		}
		
		if (grupo == "X") {
			tipoServicioExtraordinario 	= tipoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			tipoServicio = 1300;
		}

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
			arrayListaMVPaso[puntero][1] = arrayListaMV[puntero][1];
			arrayListaMVPaso[puntero][2] = arrayListaMV[puntero][2];
			arrayListaMVPaso[puntero][3] = arrayListaMV[puntero][3];
			arrayListaMVPaso[puntero][4] = arrayListaMV[puntero][4];
			arrayListaMVPaso[puntero][5] = arrayListaMV[puntero][5];
			arrayListaMVPaso[puntero][6] = '';
			arrayListaMVPaso[puntero][7] = arrayListaMV[puntero][7];
			arrayListaMVPaso[puntero][8] = arrayListaMV[puntero][8];
			arrayListaMVPaso[puntero][9] = arrayListaMV[puntero][9];
			arrayListaMVPaso[puntero][10] = arrayListaMV[puntero][10];
		}

		var arrayListaAccesoriosPaso = new Array();
		for (var puntero = 0; puntero < arrayListaAccesorios.length; puntero++){
			arrayListaAccesoriosPaso[puntero] = new Array();
			arrayListaAccesoriosPaso[puntero][0] = arrayListaAccesorios[puntero][0];
			arrayListaAccesoriosPaso[puntero][1] = '';
			arrayListaAccesoriosPaso[puntero][2] = arrayListaAccesorios[puntero][2];
			arrayListaAccesoriosPaso[puntero][3] = arrayListaAccesorios[puntero][3];
			arrayListaAccesoriosPaso[puntero][4] = arrayListaAccesorios[puntero][4];
			arrayListaAccesoriosPaso[puntero][5] = arrayListaAccesorios[puntero][5];
			arrayListaAccesoriosPaso[puntero][6] = arrayListaAccesorios[puntero][6];
			arrayListaAccesoriosPaso[puntero][7] = arrayListaAccesorios[puntero][7];
			arrayListaAccesoriosPaso[puntero][8] = arrayListaAccesorios[puntero][8];
		}
		var arregloMediosVigilancia 		= php_serialize(arrayListaMVPaso);
		var arregloAccesoriosFuncionarios	= php_serialize(arrayListaAccesoriosPaso);
		var parametros = "";
		parametros =  "codigoUnidad="+codigoUnidad+"&tipoServicio="+tipoServicio+"&tipoServicioExtraordinario="+tipoServicioExtraordinario;
		parametros += "&descServicioExtraordinario="+descServicioExtraordinario+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio;
		parametros += "&horaTermino="+horaTermino+"&observaciones="+observaciones+"&codigoUnidadDestino="+codigoUnidadDestino;
		parametros += "&arrayListaMV="+arregloMediosVigilancia+"&arrayListaAccesorios="+arregloAccesoriosFuncionarios;
		//console.log(parametros);
		var objHttpXMLServicios = new AJAXCrearObjeto();
		objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioNuevo.php",true);
		objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLServicios.send(encodeURI(parametros));
		objHttpXMLServicios.onreadystatechange=function(){
			//alert(objHttpXMLServicios.readyState);
			if(objHttpXMLServicios.readyState == 4){
				//console.log(objHttpXMLServicios.responseText);
				if (objHttpXMLServicios.responseText != "VACIO"){
					//alert(objHttpXMLServicios.responseText);
					var xml = objHttpXMLServicios.responseXML.documentElement;
					for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
						if (codigo == 1) {
							document.getElementById("mensajeGuardando").style.display = "none";
							alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
							top.leeServicios(codigoUnidad,'','','');
							idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
 	}
}

function actualizarServicio(){
	var tipoUnidad = document.getElementById('tipoUnidad').value;
	var uniGope   = document.getElementById('unidadUsuario').value;
 	if((tipoUnidad==30 || tipoUnidad==120)||(tipoUnidad==160 && uniGope==20)){
		var codigoUnidad				= document.getElementById("unidadServicio").value;
		var correlativo 				= document.getElementById('correlativoServicio').value;
		var tipoServicioExtraordinario	= "0";
		var descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
		var fechaServicio				= document.getElementById("textFechaServicio").value;
		var horaInicio					= document.getElementById("selHoraInicio").value;
		var horaTermino					= document.getElementById("selHoraTermino").value;
		var observaciones				= document.getElementById("textObservaciones").value;
		var opcionServicio				= document.getElementById("selServicio").value;
		var tipoServicio 				= opcionServicio.substr(0,1);
		var codigoServicio  			= opcionServicio.substr(1,opcionServicio.length);
		var grupo 						= opcionServicio.substr(0,1);
		var opcionLicencia  			= document.getElementById("selLicencia").value;
		var codigoUnidadDestino			= document.getElementById("unidadServicioDestino").value;
   	
   	if(opcionLicencia!="") var tipoLicencia = opcionLicencia.substr(0,1); else var tipoLicencia = "";
   	if(opcionLicencia!="") var codigoLicencia = opcionLicencia.substr(1,opcionLicencia.length); else var codigoLicencia = "";
		
		var existeColacion = true;
		if (codigoServicio  == 142 || codigoServicio == 143 || codigoServicio == 144 || codigoServicio  == 145 || codigoServicio  == 146 || codigoServicio == 147 || codigoServicio  == 148 || codigoServicio  == 149 || codigoServicio  == 151 || tipoServicio  == 152 || codigoServicio == 153){
			existeColacion = verificarFuncionarioColacion(false);
		}
		
		if (existeColacion){
			top.leeServicios(codigoUnidad,'','','');
			idCargaListadoServicios = setInterval("cerrarVentanaServicio()",100);
		}
		
		if (grupo == "E") {
			tipoServicioExtraordinario 	= codigoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			codigoServicio = 1200;
		}
		
		if (grupo == "X") {
			tipoServicioExtraordinario 	= codigoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			codigoServicio = 1300;
		}

		if (grupo == 0) {
			codigoServicio  = codigoLicencia;
		}
		
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
			arrayListaMVPaso[puntero][1] = arrayListaMV[puntero][1];
			arrayListaMVPaso[puntero][2] = arrayListaMV[puntero][2];
			arrayListaMVPaso[puntero][3] = arrayListaMV[puntero][3];
			arrayListaMVPaso[puntero][4] = arrayListaMV[puntero][4];
			arrayListaMVPaso[puntero][5] = arrayListaMV[puntero][5];
			arrayListaMVPaso[puntero][6] = '';
			arrayListaMVPaso[puntero][7] = arrayListaMV[puntero][7];
			arrayListaMVPaso[puntero][8] = arrayListaMV[puntero][8];
			arrayListaMVPaso[puntero][9] = arrayListaMV[puntero][9];
			arrayListaMVPaso[puntero][10] = arrayListaMV[puntero][10];
			arrayListaMVPaso[puntero][11] = arrayListaMV[puntero][11];
			arrayListaMVPaso[puntero][12] = arrayListaMV[puntero][12];
			arrayListaMVPaso[puntero][13] = arrayListaMV[puntero][13];
		}
		
		var arrayListaAccesoriosPaso = new Array();
		for (var puntero = 0; puntero < arrayListaAccesorios.length; puntero++){
			arrayListaAccesoriosPaso[puntero] = new Array();
			arrayListaAccesoriosPaso[puntero][0] = arrayListaAccesorios[puntero][0];
			arrayListaAccesoriosPaso[puntero][1] = '';
			arrayListaAccesoriosPaso[puntero][2] = arrayListaAccesorios[puntero][2];
			arrayListaAccesoriosPaso[puntero][3] = arrayListaAccesorios[puntero][3];
			arrayListaAccesoriosPaso[puntero][4] = arrayListaAccesorios[puntero][4];
			arrayListaAccesoriosPaso[puntero][5] = arrayListaAccesorios[puntero][5];
			arrayListaAccesoriosPaso[puntero][6] = arrayListaAccesorios[puntero][6];
			arrayListaAccesoriosPaso[puntero][7] = arrayListaAccesorios[puntero][7];
			arrayListaAccesoriosPaso[puntero][8] = arrayListaAccesorios[puntero][8];
			arrayListaAccesoriosPaso[puntero][9] = arrayListaAccesorios[puntero][9];
		}
		var arregloMediosVigilancia 		= php_serialize(arrayListaMVPaso);
		var arregloAccesoriosFuncionarios	= php_serialize(arrayListaAccesoriosPaso);
		var parametros = "";
		parametros =  "codigoUnidad="+codigoUnidad+"&tipoServicio="+codigoServicio+"&tipoServicioExtraordinario="+tipoServicioExtraordinario;
		parametros += "&descServicioExtraordinario="+descServicioExtraordinario+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio;
		parametros += "&horaTermino="+horaTermino+"&observaciones="+observaciones+"&codigoUnidadDestino="+codigoUnidadDestino;
		parametros += "&arrayListaMV="+arregloMediosVigilancia+"&arrayListaAccesorios="+arregloAccesoriosFuncionarios+"&correlativo="+correlativo;
		var objHttpXMLServicios = new AJAXCrearObjeto();
		objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioActualizar.php",true);
		objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLServicios.send(encodeURI(parametros));
		objHttpXMLServicios.onreadystatechange=function(){
			//alert(objHttpXMLServicios.readyState);
			if(objHttpXMLServicios.readyState == 4){
				console.log(objHttpXMLServicios.responseText);
				if (objHttpXMLServicios.responseText != "VACIO"){
					//alert(objHttpXMLServicios.responseText);
					var xml = objHttpXMLServicios.responseXML.documentElement;
					for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
						if (codigo == 1) {
							document.getElementById("mensajeGuardando").style.display = "none";
							alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
							top.leeServicios(codigoUnidad, '', '', '');
							idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
	}else{
		var codigoUnidad 				= document.getElementById("unidadServicio").value;
		var correlativo 				= document.getElementById('correlativoServicio').value;
		var tipoServicioExtraordinario	= "0";
		var descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
		var fechaServicio 				= document.getElementById("textFechaServicio").value;
		var horaInicio					= document.getElementById("selHoraInicio").value;
		var horaTermino					= document.getElementById("selHoraTermino").value;
		var observaciones				= document.getElementById("textObservaciones").value;
		var opcionServicio  			= document.getElementById("selServicio").value;
		var tipoServicio 				= opcionServicio.substr(0,1);
		var codigoServicio  			= opcionServicio.substr(1,opcionServicio.length);
		var grupo 						= opcionServicio.substr(0,1);
		var existeColacion 				= true;
		var codigoUnidadDestino			= document.getElementById("unidadServicioDestino").value;
		
		if (codigoServicio  == 142 || codigoServicio == 143 || codigoServicio == 144 || codigoServicio  == 145 || codigoServicio  == 146 || codigoServicio == 147 || codigoServicio  == 148 || codigoServicio  == 149 || codigoServicio  == 151 || tipoServicio  == 152 || codigoServicio == 153){
			existeColacion = verificarFuncionarioColacion(false);
		}
		
		if (existeColacion){
			top.leeServicios(codigoUnidad,'','','');
			idCargaListadoServicios = setInterval("cerrarVentanaServicio()",100);
		}
		
		if (grupo == "E") {
			tipoServicioExtraordinario = codigoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			codigoServicio = 1200;
		}
		
		if (grupo == "X") {
			tipoServicioExtraordinario 	= codigoServicio;
			descServicioExtraordinario	= document.getElementById("textOtroExtraordinario").value;
			codigoServicio = 1300;
		}

		if (tipoServicio == "A" || tipoServicio == "I" || tipoServicio == "N"){
			listarPersonalAsignado('personalServicio');
			muestraMedioViginlacia(0);
			moverDatos('personalServicio','personalServicioMedio',true);
			agregaMedioVigilancia(1);
		}
		
		var arrayListaMVPaso = new Array();
		for (var puntero = 0; puntero < arrayListaMV.length; puntero++){
			arrayListaMVPaso[puntero] = new Array();
			arrayListaMVPaso[puntero][0] = arrayListaMV[puntero][0];
			arrayListaMVPaso[puntero][1] = arrayListaMV[puntero][1];
			arrayListaMVPaso[puntero][2] = arrayListaMV[puntero][2];
			arrayListaMVPaso[puntero][3] = arrayListaMV[puntero][3];
			arrayListaMVPaso[puntero][4] = arrayListaMV[puntero][4];
			arrayListaMVPaso[puntero][5] = arrayListaMV[puntero][5];
			arrayListaMVPaso[puntero][6] = '';
			arrayListaMVPaso[puntero][7] = arrayListaMV[puntero][7];
			arrayListaMVPaso[puntero][8] = arrayListaMV[puntero][8];
			arrayListaMVPaso[puntero][9] = arrayListaMV[puntero][9];
			arrayListaMVPaso[puntero][10] = arrayListaMV[puntero][10];
		}
		
		var arrayListaAccesoriosPaso = new Array();
		for (var puntero = 0; puntero < arrayListaAccesorios.length; puntero++){
			arrayListaAccesoriosPaso[puntero] = new Array();
			arrayListaAccesoriosPaso[puntero][0] = arrayListaAccesorios[puntero][0];
			arrayListaAccesoriosPaso[puntero][1] = '';
			arrayListaAccesoriosPaso[puntero][2] = arrayListaAccesorios[puntero][2];
			arrayListaAccesoriosPaso[puntero][3] = arrayListaAccesorios[puntero][3];
			arrayListaAccesoriosPaso[puntero][4] = arrayListaAccesorios[puntero][4];
			arrayListaAccesoriosPaso[puntero][5] = arrayListaAccesorios[puntero][5];
			arrayListaAccesoriosPaso[puntero][6] = arrayListaAccesorios[puntero][6];
			arrayListaAccesoriosPaso[puntero][7] = arrayListaAccesorios[puntero][7];
			arrayListaAccesoriosPaso[puntero][8] = arrayListaAccesorios[puntero][8];
			arrayListaAccesoriosPaso[puntero][9] = arrayListaAccesorios[puntero][9];
		}
		
		var arregloMediosVigilancia			= php_serialize(arrayListaMVPaso);
		var arregloAccesoriosFuncionarios	= php_serialize(arrayListaAccesoriosPaso);
		var parametros = "";
		parametros =  "codigoUnidad="+codigoUnidad+"&tipoServicio="+codigoServicio+"&tipoServicioExtraordinario="+tipoServicioExtraordinario;
		parametros += "&descServicioExtraordinario="+descServicioExtraordinario+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio;
		parametros += "&horaTermino="+horaTermino+"&observaciones="+observaciones+"&codigoUnidadDestino="+codigoUnidadDestino;
		parametros += "&arrayListaMV="+arregloMediosVigilancia+"&arrayListaAccesorios="+arregloAccesoriosFuncionarios+"&correlativo="+correlativo;
		console.log(parametros);
		var objHttpXMLServicios = new AJAXCrearObjeto();
		objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioActualizar.php",true);
		objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLServicios.send(encodeURI(parametros));
		objHttpXMLServicios.onreadystatechange=function(){
			//alert(objHttpXMLServicios.readyState);
			if(objHttpXMLServicios.readyState == 4){
				console.log(objHttpXMLServicios.responseText);
				if (objHttpXMLServicios.responseText != "VACIO"){
					//alert(objHttpXMLServicios.responseText);
					var xml = objHttpXMLServicios.responseXML.documentElement;
					for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
						if (codigo == 1) {
							document.getElementById("mensajeGuardando").style.display = "none";
							alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
							top.leeServicios(codigoUnidad, '', '', '');
							idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
 	}
}

function cerrarVentanaServicio(){
	if (top.cargaListadoServicios == 1){
		clearInterval(idCargaListadoServicios);
		top.document.getElementById("cubreFondo").style.display = "none";
		top.cerrarVentana();
	}
}

function eliminarServicio(){
	var opcionServicio  = document.getElementById("selServicio").value;
	var servicio		= opcionServicio.substr(1,opcionServicio.length);
	var existeColacion 	= false;
	var existeJefeSupervisionTerreno = false;
	
	var unidad				= document.getElementById("unidadServicio").value;
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	var fechaServicioSel	= document.getElementById("textFechaServicio").value;
	var comparaFechaLimite = comparaFecha(fechaServicioSel, fechaLimite);
	var serviciosValidados = fechaValidacion(unidad, fechaServicioSel);
	if (serviciosValidados != "" || (unidadBloqueada == 1 && comparaFechaLimite == 2)) {
		if (serviciosValidados != ""){
			alert("PARA LA FECHA SELECCIONADA LOS SERVICIOS YA SE ENCUENTRAN VALIDADOS.\n\nNO SE PUEDEN AGREGAR Y/O ACTUALIZAR ... ");
			cerrarVentanaServicio();
		} else {
			alert("PARA LA FECHA SELECCIONADA EL SISTEMA SE ENCUENTRA BLOQUEADO.\n\nNO SE PUEDEN AGREGAR Y/O ACTUALIZAR SERVICIOS ... ");
			cerrarVentanaServicio();
		}
		return false;
	}

	if (servicio != 142 && servicio != 143 && servicio != 144 && servicio != 145 && servicio != 146 && servicio != 147 && servicio != 148 && servicio != 149 && servicio != 151 && servicio != 152 && servicio != 153 && servicio != 607){
		existeColacion = verificarFuncionarioColacion(false);
		existeJefeSupervisionTerreno = verificarFuncionarioJefaturaSupervisionTerreno();
	}
	
	if(existeJefeSupervisionTerreno){
		return false;
	}
	
	if (existeColacion){
		alert("ESTE SERVICIO NO PUEDE SER ELIMINADO PORQUE HAY FUNCIONARIOS CON COLACIONES ASIGNADAS.\n\nPRIMERO DEBE QUITAR LAS COLACIONES ASIGNADAS DE LOS FUNCIONARIOS INDICADOS.");
		return false;
	}
	
	if(confirm("ESTE SERVICIO SER\u00C1 ELIMINADO. \u00BFDESEA CONTINUAR? ")){
		document.getElementById('btnCerrar').disabled    = "true";
		document.getElementById('btnEliminar').disabled  = "true";
		document.getElementById('btnAnterior').disabled  = "true";
		document.getElementById('btnSiguiente').disabled = "true";
		document.getElementById('btnFinalizar').disabled = "true";
		var codigoUnidad	= document.getElementById("unidadServicio").value;
		var correlativo		= document.getElementById('correlativoServicio').value;
		var parametros		= "codigoUnidad="+codigoUnidad+"&correlativo="+correlativo;
		var objHttpXMLServicios = new AJAXCrearObjeto();
		objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlServicioEliminar.php",true);
		objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLServicios.send(encodeURI(parametros));
		objHttpXMLServicios.onreadystatechange=function(){
			if(objHttpXMLServicios.readyState == 4){
				if (objHttpXMLServicios.responseText != "VACIO"){
					//alert(objHttpXMLServicios.responseText);
					var xml = objHttpXMLServicios.responseXML.documentElement;
					for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
						if (codigo == 1) {
							alert('LOS DATOS FUERON ELIMINADOS DE LA BASE DE DATOS ......        ');
							top.leeServicios(codigoUnidad, '', '', '');
							idCargaListadoServicios = setInterval("cerrarVentanaServicio()",1000);
						}
						else alert('LOS DATOS NO FUERON ELIMINADOS DE LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
	}
}

function verificaExisteServicio(){
	var unidad 	 = document.getElementById("unidadServicio").value;
	var fecha1 	 = document.getElementById("textFechaServicio").value;
	var fecha2	 = fecha1;
	var opcionServicio  = document.getElementById("selServicio").value;
	var servicio  		= opcionServicio.substr(1,opcionServicio.length);
	var opcionLicencia	= document.getElementById("selLicencia").value;
	var licencia 		= opcionLicencia.substr(1,opcionLicencia.length);
	if (opcionServicio==1 || opcionServicio==2 || opcionServicio==3 || opcionServicio==4)	servicio = licencia;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServicios.php",false);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicios="+servicio));
	objHttpXMLServicios.onreadystatechange=function(){
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO") {
				var xml = objHttpXMLServicios.responseXML.documentElement;
				document.getElementById("correlativoServicio").value = (xml.getElementsByTagName('correlativoServicio')[0].text||xml.getElementsByTagName('correlativoServicio')[0].textContent||"");
				return true;
			} else {return false;}
		}
	}
}

function activaHoras(){
	var horaI = document.getElementById("selHoraInicio").value;
	if(horaI!=0){
		var horaS = horaI.split(":");
		document.getElementById("selHoraTermino").innerHTML = "";
		document.getElementById("selHoraTermino").disabled = false;
		listaHoras('selHoraTermino',horaS[0]*1,horaS[1]*1);
	}
	else{
		document.getElementById("selHoraTermino").disabled = true;
	}
}

function sinCaracteres(keys) {
	var out = '';
    var filtro = '<>"';
    for (var i=0; i<keys.length; i++)
       if (filtro.indexOf(keys.charAt(i)) == -1) 
	     out += keys.charAt(i);
    return out;
}

var cargaListadoCamarasDisponibles;
function listaCamarasDisponibles(unidad, nombreObjeto){
	cargaListadoCamarasDisponibles = 0;
	var fechaServicio 	= document.getElementById('textFechaServicio').value;
	var opcionServicio  = document.getElementById("selServicio").value;
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var horaInicio 			= document.getElementById('selHoraInicio').value;
	var horaTermino 		= document.getElementById('selHoraTermino').value;
	var correlativo			= document.getElementById("correlativoServicio").value;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLCamaras = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&horaInicio="+horaInicio+"&horaTermino="+horaTermino+"&tipoServicio="+servicio+"&correlativo="+correlativo;
	objHttpXMLCamaras.open("POST","./xml/xmlCamaras/xmlListaCamarasDisponibles.php",true);
	objHttpXMLCamaras.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCamaras.send(encodeURI(parametros));
	objHttpXMLCamaras.onreadystatechange=function(){
		console.log(objHttpXMLCamaras.responseText);
		if(objHttpXMLCamaras.readyState == 4){
			if (objHttpXMLCamaras.responseText != "VACIO"){
				//console.log(objHttpXMLCamaras.responseText);
				var xml			 = objHttpXMLCamaras.responseXML.documentElement;
				var codigo		 = "";
				var codigoEquipo = "";
				var numeroSerie	 = "";
				var descripcion	 = "";
				var modelo		 = "";
				document.getElementById(nombreObjeto).length = null;
				for(i=0;i<xml.getElementsByTagName('camara').length;i++){
					codigo		 = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					codigoEquipo = (xml.getElementsByTagName('codigoEquipo')[i].text||xml.getElementsByTagName('codigoEquipo')[i].textContent||"");					
					modelo		 = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					numeroSerie	 = (xml.getElementsByTagName('numeroSerie')[i].text||xml.getElementsByTagName('numeroSerie')[i].textContent||"");
					descripcion	 = (numeroSerie=="") ? modelo + " (Cod Equipo: " + codigoEquipo + ")" :  modelo + " (N/S. : " + numeroSerie + ")";
					var datosOpcion = new Option(descripcion, "C" + codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
				}
				cargaListadoCamarasDisponibles = 1;
			}
		}
	}
}

function cantidadCamarasAsignadas(){
	var cantidad 		= document.getElementById('textCantidadAccesorios').value;
	var div		 		= document.getElementById("listadoAccesoriosAsignados");
	var sw		 		= 0;
	var fondoLinea 		= "";
	var listadoCamaras	= "<table border='0' align='left' cellspacing='1' cellpadding='1'>";
	
	for(i=0;i<cantidad;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}
		
		listadoCamaras += "<tr class='"+fondoLinea+"'>";
		listadoCamaras += "<td width='263px'><select id='selTipoAccesorio' name='selTipoAccesorio_"+i+"'></select></td>";
		listadoCamaras += "<td width='175px'><input type='text' id='textCantAccesorio' name='textCantAccesorio_"+i+"'></td>";
		listadoCamaras += "<td width='378px'></td>";
		listadoCamaras += "<td width='41px'><input type='checkbox' id='cbEliminarAccesorio'></td>";
		listadoCamaras += "</tr>";
	}
	listadoCamaras += "</table>";
	div.innerHTML = listadoCamaras;
	
	for(i=0;i<cantidad;i++) {
		leeTipoAccesorio('selTipoAccesorio_'+i);
	}
}