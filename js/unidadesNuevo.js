unidadesMV.ondblclick = (e) => {
    let unidad = e.srcElement.value.split('-');
    if(unidad[1]=='X'){
        obtenerDatosUnidad(unidad[0]);
        return;
    }
    if(unidad[2]==1 && unidadUsuario.value!=unidad[0]){
        unidadesSeleccionados.length = null;
        moverDatos('unidadesMV','unidadesSeleccionados');
        obtenerDatosUnidad(unidadPadreUsuario.value);    
        Btn_AgregarUnidadMedio.disabled = true;
        Btn_QuitarUnidadMedio.disabled = false;
        return;
    }
}

Btn_AgregarUnidadMedio.onclick = () => {
    if(unidadesMV.value=='') return;
    let unidad = unidadesMV.value.split('-');
    let nombre = unidadesMV.options[unidadesMV.selectedIndex].text;
    if(nombre=='...' || unidad[2]==0 || unidadUsuario.value==unidad[0]) return;
    moverDatos('unidadesMV','unidadesSeleccionados');
    obtenerDatosUnidad(unidadPadreUsuario.value);
    Btn_AgregarUnidadMedio.disabled = true;
    Btn_QuitarUnidadMedio.disabled = false;
}

Btn_QuitarUnidadMedio.onclick = () => {
    unidadesSeleccionados.length = null;
    Btn_AgregarUnidadMedio.disabled = false;
    Btn_QuitarUnidadMedio.disabled = true;
}

function asignarDatosUnidad(data){
    unidadesMV.length = null;
    if(!data) return;
    let datosOpcion = new Option('OTRAS REPARTICIONES', 1+'- -1', '', '');
    if(data[0].codAbuelo) datosOpcion = new Option('...', data[0].codAbuelo+'-X-0', '', '');
    unidadesMV.options[0] = datosOpcion;
    for(i=0;i<data.length;i++){
        let codigoUnidad        = (data[i].conHijos==1) ? data[i].codUnidad+'-X-'+data[i].captura : data[i].codUnidad+'- -'+data[i].captura;
        let descripcionUnidad   = data[i].descUnidad;
        let datosOpcion         = new Option(descripcionUnidad, codigoUnidad, '', '');
        unidadesMV.options[i+1] = datosOpcion;
    }
}

function obtenerDatosUnidad(codUnidad){
    if(!codUnidad) return;
	/*
    axios.get('http://proservipol.carabineros.cl/API/buscarUnidad/', {
        params: {
            'codUnidad': (codUnidad) ? codUnidad : 20
        }
    })
    .then(function(res) {
        asignarDatosUnidad(res.data.data);
    })
    .catch(function(err) {
        if(err.response.status == 500){
            console.log('No se encontra unidad');
        }
    });
	*/
	var objHttpXMLUnidades = new AJAXCrearObjeto();
	objHttpXMLUnidades.open("POST","./xml/xmlUnidades/xmlBuscarUnidades.php",true);
	objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUnidades.send(encodeURI("codigoUnidad="+((codUnidad) ? codUnidad : 20)));
	objHttpXMLUnidades.onreadystatechange=function(){
		if(objHttpXMLUnidades.readyState == 4){
		    //console.log(objHttpXMLUnidades.responseText);
		    if(objHttpXMLUnidades.responseText != "VACIO"){
                var xml = objHttpXMLUnidades.responseXML.documentElement;
                var data = new Array();
                for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
                    data[i] = {
                            codUnidad   : (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||""),
                            descUnidad  : (xml.getElementsByTagName('descripcionUnidad')[i].text||xml.getElementsByTagName('descripcionUnidad')[i].textContent||""),
                            captura     : (xml.getElementsByTagName('captura')[i].text||xml.getElementsByTagName('captura')[i].textContent||""),
                            conHijos    : (xml.getElementsByTagName('conHijos')[i].text||xml.getElementsByTagName('conHijos')[i].textContent||""),
                            codAbuelo   : (xml.getElementsByTagName('codigoAbuelo')[i].text||xml.getElementsByTagName('codigoAbuelo')[i].textContent||""),
                            codPadre    : (xml.getElementsByTagName('codigoPadre')[i].text||xml.getElementsByTagName('codigoPadre')[i].textContent||"")
                            };
                }
                asignarDatosUnidad(data);
			}
		}
	}
}

function agregaMedioVigilanciaDestinos(validar){
    if (validar == 1) var validaOk = validaMedioVigilancia2();
    else var validaOk = "True";
    
    if (validaOk){
        var arrayPersonalMV					= new Array();
        var arrayPersonalDescMV				= new Array();
        var arrayCuadranteMV				= new Array();
        var arrayMedioVigilancia			= new Array();
        var arrayUnidadDestinoServicio		= new Array();
        var arrayUnidadDestinoServicioDesc 	= new Array();
        var arrayCuadranteDescMV			= new Array();
        var arrayUnidadDestinoCod 	        = new Array();
        var arrayUnidadDestinoDesc 	        = new Array();
        
        var largoPersonalMV	= personalServicioMedioDestino.length;
        var idVehiculo      = vehiculosServicioDestino.value;
        var idAnimal        = animalServicioDestino.value;
        var CantUnidadDestino = unidadesSeleccionados.length;
        
        if (idVehiculo != "") var descVehiculo = vehiculosServicioDestino.options[vehiculosServicioDestino.selectedIndex].text;
        else var descVehiculo = "";
        
        if (idAnimal != "") var descAnimal = animalServicioDestino.options[animalServicioDestino.selectedIndex].text;
        else var descAnimal = "";
        
        if (textKmFinal2.value== "" || textKmFinal2.value== 0){
            var kmInicial	= 0;
            var kmFinal		= 0;
        }else{
            var kmInicial	= textKmInicial2.value;
            var kmFinal		= textKmFinal2.value;
        }
        
        for (i=0;i<largoPersonalMV;i++){
            arrayPersonalMV[arrayPersonalMV.length] = personalServicioMedioDestino.options[i].value;
            arrayPersonalDescMV[arrayPersonalDescMV.length] = personalServicioMedioDestino.options[i].text;
        }
        
        for (i=0;i<CantUnidadDestino;i++){
            let unidad = unidadesSeleccionados.options[i].value.split('-')[0];
            arrayUnidadDestinoCod[arrayUnidadDestinoCod.length] = unidad;
            arrayUnidadDestinoDesc[arrayUnidadDestinoDesc.length] = unidadesSeleccionados.options[i].text;
            unidadServicioDestino.value = unidad;
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
        arrayMedioVigilancia[14] = arrayUnidadDestinoCod;
        arrayMedioVigilancia[15] = arrayUnidadDestinoDesc;
        
        if (idMV2.value != "") {
            var punteroArrayMV = idMV2.value;
            idMV2.value = "";
        } else {
            var punteroArrayMV = arrayListaMV.length;
        }
        arrayListaMV[punteroArrayMV] = arrayMedioVigilancia;
        if (idVehiculo != 0) vehiculosServicioDestino.options[vehiculosServicioDestino.selectedIndex] = null;
        if (idAnimal != 0) animalServicioDestino.options[animalServicioDestino.selectedIndex] = null;
        seleccionaAnimalMedioVigilancia2();
        seleccionaVehiculoMedioVigilancia2();
        listaMediosVigilancia2();
        Btn_QuitarUnidadMedio.disabled = true;
        unidadesMV.disabled = true;
        unidadesSeleccionados.disabled = true;
        btnEliminaDestino.disabled = true;
    }
}

function validaMedioVigilancia2(){
    var cantPersonal  	= personalServicioMedioDestino.length;
    var kmInicial 	  	= eliminarBlancos(textKmInicial2.value);
    var kmFinal 	  	= eliminarBlancos(textKmFinal2.value);
    var cantDestino   	= unidadesSeleccionados.length;
    var opcionServicio	= selServicio.value;
    var tipoServicio 	= opcionServicio.substr(0,1);
    var idAnimal 		= animalServicioDestino.value;
    
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
        if(ListaVehiculosDisponibles[i][0]==vehiculosServicioDestino.value){
            var indicaKm = ListaVehiculosDisponibles[i][2];
        }
    }
    
    if (vehiculosServicioDestino.value != 0 && indicaKm == 1){
        
        if (kmInicial == ""){
            alert("DEBE INGRESAR KILOMETRAJE INICIAL ...     ");
            textKmInicial2.value = "";
            textKmInicial2.focus();
            return false;
        }
        
        if (IsNumeric(kmInicial) == false){
            alert("DEBE INGRESAR KILOMETRAJE INICIAL VALIDO...     ");
            textKmInicial2.focus();
            return false;
        }
        
        if (IsNumeric(kmInicial) == 0){
            alert("DEBE INGRESAR KILOMETRAJE INICIAL VALIDO...     ");
            textKmInicial2.focus();
            return false;
        }
        
        if (kmFinal == ""){
            alert("DEBE INGRESAR KILOMETRAJE FINAL ...     ");
            textKmFinal2.value = "";
            textKmFinal2.focus();
            return false;
        }
        
        if (IsNumeric(kmFinal) == false){
            alert("DEBE INGRESAR KILOMETRAJE FINAL VALIDO...     ");
            textKmFinal2.focus();
            return false;
        }
        
        if (kmFinal*1 <= kmInicial*1){
            alert("EL KILOMETRAJE FINAL NO PUEDE SER MENOR O IGUAL QUE EL KILOMETRAJE INICIAL ....  ");
            textKmFinal2.focus();
            return false;
        }
        
        var cantidadKilometros = kmFinal - kmInicial;			
        if (cantidadKilometros>2500){
            alert("LA CANTIDAD DE KILOMETROS INGRESADOS EXCEDE LO ACEPTABLE PARA UN SERVICIO POLICIAL.         \nPARA CONSULTAS ANEXO NRO. 20843 O 20845.");
            textKmFinal2.focus();
            return false;
        }
        
        if (cantidadKilometros>250){
            if(confirm("ADVERTENCIA :\nEL KILOMETRAJE INGRESADO EXCEDE LOS 250KM.          \n\u00BFDESEA CONTINUAR?")!=true){    
                textKmFinal2.focus();
                return false;
            }
        }
    }
    return true;
}

function seleccionaAnimalMedioVigilancia2(){
	if (document.getElementById('animalServicioDestino').value == 0){
		document.getElementById('vehiculosServicioDestino').disabled = "";
		document.getElementById('vehiculosServicioDestino').style.backgroundColor = "";
		document.getElementById('labKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').style.backgroundColor = "#D4D4D4";
	}else {
		document.getElementById('vehiculosServicioDestino').disabled = "true";
		document.getElementById('vehiculosServicioDestino').style.backgroundColor = "#D4D4D4";
		document.getElementById('textKmInicial2').value = "";
		document.getElementById('textKmFinal2').value = "";
		document.getElementById('labKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').style.backgroundColor = "#D4D4D4";
	} 
}

function seleccionaVehiculoMedioVigilancia2(){
	
	for (var i=0; i<ListaVehiculosDisponibles.length; i++){
		if(ListaVehiculosDisponibles[i][0]==document.getElementById('vehiculosServicioDestino').value){
			var indicaKm = ListaVehiculosDisponibles[i][2];
		}
	}
	
	if(document.getElementById('vehiculosServicioDestino').value == 0){
		document.getElementById('animalServicioDestino').disabled = "";
		document.getElementById('animalServicioDestino').style.backgroundColor = "";
		document.getElementById('textKmInicial').value = "";
		document.getElementById('textKmFinal2').value = "";
		document.getElementById('labKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').style.backgroundColor = "#D4D4D4";
	}
	else if(indicaKm == 0){
		document.getElementById('animalServicioDestino').disabled = "true";
		document.getElementById('animalServicioDestino').style.backgroundColor = "#D4D4D4";
		document.getElementById('textKmInicial2').value = "";
		document.getElementById('textKmFinal2').value = "";
		document.getElementById('labKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').disabled = "true";
		document.getElementById('textKmInicial2').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').disabled = "true";
		document.getElementById('textKmFinal2').style.backgroundColor = "#D4D4D4";
	}
	else {
		document.getElementById('animalServicioDestino').disabled = "true";
		document.getElementById('animalServicioDestino').style.backgroundColor = "#D4D4D4";
		document.getElementById('labKmInicial2').disabled = "";
		document.getElementById('textKmInicial2').disabled = "";
		document.getElementById('textKmInicial2').style.backgroundColor = "";
		document.getElementById('labKmFinal2').disabled = "";
		document.getElementById('textKmFinal2').disabled = "";
		document.getElementById('textKmFinal2').style.backgroundColor = "";
	}
}

function listaMediosVigilancia2(){
    var listaMedios = "";
    var sw = 0;
    var fondoLinea;
    listaMedios += "<table border='0' cellspacing='1' cellpadding='1'>";
    for (var i=0; i<arrayListaMV.length; i++){
        if (sw==0) {fondoLinea = "linea1"; sw =1;}
        else {fondoLinea = "linea2"; sw=0;}
        
        var resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
        var lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
        var destino = arrayListaMV[i][15];
        var descripcionFactor = "";
        
        if (arrayListaMV[i][7] != 0) var descripcionFactor = ", (FACTOR: " + arrayListaMV[i][8] + ")";
        else var descripcionFactor = "";
        
        if (arrayListaMV[i][0] == 0) var medios1 = "SIN VEHICULO (INFANTERIA)";
        else var medios1 = arrayListaMV[i][1];
        
        if (arrayListaMV[i][9] == 0) var medios2 = ", SIN ANIMAL";
        else var medios2 = ","+arrayListaMV[i][10];
        
        listaMedios += "<tr id='linea"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onclick='muestraMedioViginlacia2("+i+")'>";
        listaMedios += "<td width='356px' style='padding:0px 0px 0px 5px' align='left'>"+ medios1 + medios2 + descripcionFactor +"</td>";
        listaMedios += "<td width='136px' style='padding:0px 0px 0px 0px' align='center'>"+arrayListaMV[i][4].length+"</td>";
        listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='right'>"+formato_numero(arrayListaMV[i][2],0,',','.')+"</td>";
        listaMedios += "<td width='131px' style='padding:0px 5px 0px 0px' align='right'>"+formato_numero(arrayListaMV[i][3],0,',','.')+"</td>";
        listaMedios += "<td width='119px' style='padding:0px 0px 0px 0px' align='center'>"+destino+"</td>";
        listaMedios += "<tr>";
    }
    listaMedios += "</table>";
    listadoMediosVigilanciaDestinos.innerHTML = listaMedios;
    limpiaMedioVigilancia2();
}

function limpiaMedioVigilancia2(){
	personalServicioMedioDestino.length = null;
	textKmInicial2.value                = "";
	textKmFinal2.value                  = "";
	vehiculosServicioDestino.value      = 0;
	animalServicioDestino.value         = 0;
}

function muestraMedioViginlacia2(numero){
  	if (idMV2.value == ""){
        var nombreObjeto = "linea"+numero;
        document.getElementById(nombreObjeto).className = 'lineaMarcada';
        document.getElementById(nombreObjeto)['onmouseout'] = new Function("this.className = 'lineaMarcada'");
        
        if (idMV2.value != 0) vehiculosServicioDestino.options[vehiculosServicioDestino.selectedIndex] = null;
        if (idMV2.value != 0) animalServicioDestino.options[animalServicioDestino.selectedIndex] = null;
        
        idMV2.value             = numero;
        textKmInicial2.value	= arrayListaMV[numero][2];
        textKmFinal2.value      = arrayListaMV[numero][3];
        
        if (arrayListaMV[numero][0] != 0){
            var datosOpcion = new Option(arrayListaMV[numero][1], arrayListaMV[numero][0], "", "");
            vehiculosServicioDestino.options[vehiculosServicioDestino.length] = datosOpcion;
        }
        
        if (arrayListaMV[numero][9] != 0){
            var datosOpcion = new Option(arrayListaMV[numero][10], arrayListaMV[numero][9], "", "");
            animalServicioDestino.options[animalServicioDestino.length] = datosOpcion;
        }
        
        vehiculosServicioDestino.value      = arrayListaMV[numero][0];
        animalServicioDestino.value         = arrayListaMV[numero][9];
        personalServicioMedioDestino.length = null;
        
        for (i=0; i<arrayListaMV[numero][4].length; i++){
            var datosOpcion = new Option(arrayListaMV[numero][6][i], arrayListaMV[numero][4][i], "", "");
            personalServicioMedioDestino.options[i] = datosOpcion;
        }
        
        for (i=0; i<arrayListaMV[numero][14].length; i++){
            var datosOpcion = new Option(arrayListaMV[numero][15][i], arrayListaMV[numero][14][i], "", "");
            unidadesSeleccionados.options[i] = datosOpcion;
        }
        btnEliminaDestino.disabled = "";
        seleccionaVehiculoMedioVigilancia2();
        seleccionaAnimalMedioVigilancia2();
    }
}

function borraMedioDestino(){
	var elementoBorrar = idMV2.value;
	arrayListaMV.splice(elementoBorrar,1);
	idMV2.value = "";
	moverDatos('personalServicioMedioDestino', 'personalServicioDestino', true);
	limpiaMedioVigilancia2();
	listaMediosVigilancia2();
    btnEliminaDestino.disabled = true;
    if(arrayListaMV.length === 0){
        Btn_QuitarUnidadMedio.disabled = false;
        unidadesMV.disabled = false;
        unidadesSeleccionados.disabled = false;
        unidadServicioDestino.value = 0;
    }
}

function llenaArregloMediosDeVigilancia2(mediosDeVigilancia){
    for(var i=0;i<mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;i++){
        var medioDeVigilancia = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
        var vehiculo        = medioDeVigilancia.getElementsByTagName('vehiculo')[0];
        var codigoVehiculo  = (vehiculo.getElementsByTagName('codigoVehiculo')[0].text||vehiculo.getElementsByTagName('codigoVehiculo')[0].textContent||"");
        var patenteVehiculo = (vehiculo.getElementsByTagName('patenteVehiculo')[0].text||vehiculo.getElementsByTagName('patenteVehiculo')[0].textContent||"");
        var tipoVehiculo    = (vehiculo.getElementsByTagName('tipoVehiculo')[0].text||vehiculo.getElementsByTagName('tipoVehiculo')[0].textContent||"");
        var kmInicial       = (vehiculo.getElementsByTagName('kmInicial')[0].text||vehiculo.getElementsByTagName('kmInicial')[0].textContent||"");
        var kmFinal         = (vehiculo.getElementsByTagName('kmFinal')[0].text||vehiculo.getElementsByTagName('kmFinal')[0].textContent||"");
        var descripcion     = tipoVehiculo + " (" + patenteVehiculo + ")";
        var codigoAnimal    = (vehiculo.getElementsByTagName('codigoAnimal')[0].text||vehiculo.getElementsByTagName('codigoAnimal')[0].textContent||"");
        var nombreAnimal    = (vehiculo.getElementsByTagName('nombreAnimal')[0].text||vehiculo.getElementsByTagName('nombreAnimal')[0].textContent||"");
        var tipoAnimal      = (vehiculo.getElementsByTagName('tipoAnimal')[0].text||vehiculo.getElementsByTagName('tipoAnimal')[0].textContent||"");

        vehiculosServicioDestino.length = null;
        var datosOpcion = new Option(descripcion, codigoVehiculo, "", "");
        vehiculosServicioDestino.options[vehiculosServicioDestino.length] = datosOpcion;

        var descAnimal = tipoAnimal + " (" + nombreAnimal + ")";
        animalServicioDestino.length = null;
        var datosOpcion2 = new Option(descAnimal, codigoAnimal, "", "");
        animalServicioDestino.options[animalServicioDestino.length] = datosOpcion2;

        textKmInicial2.value = kmInicial;
        textKmFinal2.value 	= kmFinal;

        funcionarios = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
        for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
            var codigoFuncionario	= (funcionarios.getElementsByTagName('codigoFuncionario')[j].text||funcionarios.getElementsByTagName('codigoFuncionario')[j].textContent||"");
            var apellidoPaterno 	= (funcionarios.getElementsByTagName('apellidoPaterno')[j].text||funcionarios.getElementsByTagName('apellidoPaterno')[j].textContent||"");
            var apellidoMaterno 	= (funcionarios.getElementsByTagName('apellidoMaterno')[j].text||funcionarios.getElementsByTagName('apellidoMaterno')[j].textContent||"");
            var primerNombre 		= (funcionarios.getElementsByTagName('primerNombre')[j].text||funcionarios.getElementsByTagName('primerNombre')[j].textContent||"");
            var grado 				= (funcionarios.getElementsByTagName('grado')[j].text||funcionarios.getElementsByTagName('grado')[j].textContent||"");
            var descripcionFuncionario = apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
            var datosOpcion = new Option(descripcionFuncionario, codigoFuncionario, "", "");
            personalServicioMedioDestino.options[personalServicioMedioDestino.length] = datosOpcion;
        }

        var datosOpcionUnidad = new Option(unidadServicioDestinoDesc.value, unidadServicioDestino.value, "", "");
        unidadesSeleccionados.options[0] = datosOpcionUnidad;
        agregaMedioVigilanciaDestinos(1);
	}
}