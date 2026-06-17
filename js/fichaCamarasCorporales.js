selMarca.onchange = (e) => {
    leeModeloCamara(e.target.value, 'selModelo');
}

selEstado.onchange = (e) => {
	if(e.target.value==estadoBaseDatos.value){
		textUnidadAgregado.disabled= true;
        btnUnidades.disabled= true;
        textUnidadAgregado.value="";
		codUnidadAgregado.value="";
		imagenCalendarioFichaCamara.style.visibility = "hidden";
		textFechaNuevoEstado.value="";
		btnGuardar.disabled = true;
	}
	else{
		imagenCalendarioFichaCamara.style.visibility = "visible";
		textFechaNuevoEstado.value="";
		btnGuardar.disabled = false;
		if(e.target.value==3000){
			textUnidadAgregado.disabled= false;
			btnUnidades.disabled= false;
			imagenCalendarioFichaCamara.style.visibility = "visible";
			textFechaNuevoEstado.value="";
		}
		else{
			textUnidadAgregado.disabled= true;
			btnUnidades.disabled= true;
			textUnidadAgregado.value="";
			codUnidadAgregado.value="";
		}
	}
}

iconoBusqueda.addEventListener('click', (e) => {
    buscarCamara(null);
});

function cerrarFicha(){
    fichaCamarasCorporales.className='fichaOculta';
    resetFormulario();
}

function resetFormulario(){
	data = {
		CODIGO_CAMARA 	: '',
		CODIGO_EQUIPO	: '',
		NRO_SERIE		: '',
		CODIGO_MARCA 	: '',
		DESC_MARCA		: '',
		CODIGO_MODELO 	: '',
		DESC_MODELO		: '',
		CODIGO_ORIGEN	: '',
		CODIGO_SAP		: '',
		CODIGO_ESTADO	: '',
		DESC_ESTADO		: '',
		FECHA			: '',
		CODIGO_UNIDAD	: '',
		DESC_UNIDAD		: '',
		CODIGO_AGREGADO	: '',
		DESC_AGREGADO	: ''
	};
	textCodEquipo.value = "";
	asignarDatosCamara(data);
	desactivarBotones(true);
	textCodEquipo.disabled = false;
	btnGuardar.disabled = true;
	selEstado.disabled = false;
	iconoBusqueda.style.visibility = "visible";
	imagenCalendarioFichaCamara.style.visibility = "hidden";
}

function buscarCamara(codigoCamara){
	axios.get('http://proservipol.carabineros.cl/API/camaras/buscarCamara/', {
		params: {
			codigoCamara: codigoCamara,
			codigoEquipo: textCodEquipo.value
		}
	})
	.then(function(res) {
		(res.data.data.length==1) ? asignarDatosCamara(res.data.data[0]) : activarVentanaListaCamaras(res.data.data);
	})
	.catch(function() {
		alert('No se encontro la camara indicada');
		textCodEquipo.disabled = false;
	});
}

function abrirFichaCamara(codigoCamara){
	fichaCamarasCorporales.className='fichaActiva';
	buscarCamara(codigoCamara);
}

function activarVentanaListaCamaras(data){
	console.log(data[0]);
	document.getElementById("divListaCamaras").style.display = "block";
	document.getElementById("cubreVentana").style.display = "block";
	let listaCamaras	= "";
	let codigo			= "";
	let marcaModelo		= "";
	let nroSerie		= "";
	let estado			= "";
	listaCamaras += "<table width='100%' cellspacing='1' cellpadding='1'>";
	for(i=0;i<data.length;i++){
		codigo			= data[i].CODIGO_CAMARA;
		marcaModelo		= data[i].DESC_MARCA+" "+data[i].DESC_MODELO;
		nroSerie		= data[i].NRO_SERIE;
		estado			= data[i].DESC_ESTADO;

		listaCamaras	+= "<tr id='trNro"+i+"'>";
		listaCamaras	+= "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</td>";
		listaCamaras	+= "<td width='25%' align='center'>"+marcaModelo+"</td>";
		listaCamaras	+= "<td width='25%' align='center'>"+nroSerie+"</td>";
		listaCamaras	+= "<td width='25%' align='center'>"+estado+"</td>";
		listaCamaras	+= "<td width='20%'align='right'><input type='radio' id='radioCam' name='radioCam' value='"+codigo+"' onclick='document.getElementById(\"btnRadioCam\").disabled = false' /></td>";
		listaCamaras	+= "</tr>";
	}
	listaCamaras += "<tr><td colspan='5'>&nbsp;</td></tr>";
	listaCamaras += "<tr><td></td><td align='center' colspan='2'><input type='button' value='Aceptar' id='btnRadioCam' onclick='aceptarListaCamaras()' disabled></td>";
	listaCamaras += "<td></td><td><input type='button' value='Cancelar' onclick='cerrarListaCamaras()'></td></tr>";
	listaCamaras += "</table>";
	document.getElementById("divListaCamaras").innerHTML = listaCamaras;
	return;
}

function aceptarListaCamaras(){
	var codigoCam = document.querySelector('input[name="radioCam"]:checked').value;
	document.getElementById("divListaCamaras").style.display = "none";
	document.getElementById("cubreVentana").style.display = "none";
	buscarCamara(codigoCam);
}

function cerrarListaCamaras(){
	document.getElementById("divListaCamaras").style.display = "none";
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("textCodEquipo").value = "";
}

function asignarDatosCamara(data){
	//console.log(data);
	textCodEquipo.disabled = true;
	codCamara.value = data.CODIGO_CAMARA;
	textNroSerie.value = data.NRO_SERIE;
	selMarca.value = data.CODIGO_MARCA;
	
	if(data.CODIGO_MARCA){
		leeModeloCamara(data.CODIGO_MARCA, 'selModelo');
		cargaValorModeloCamara = setInterval("cargarModeloCamara("+data.CODIGO_MODELO+",selModelo)",1000);
	}
	else{
		selModelo.value = data.CODIGO_MODELO;
	}
	
	selOrigen.value = data.CODIGO_ORIGEN;
	textCodigoSap.value = data.CODIGO_SAP;
	
	selEstado.value = data.CODIGO_ESTADO;
	estadoBaseDatos.value = data.CODIGO_ESTADO;
	textFechaNuevoEstado.value = "";
	codUnidad.value = data.CODIGO_UNIDAD;
	descUnidad.value = data.DESC_UNIDAD;
	codUnidadAgregado.value = data.CODIGO_AGREGADO;
	textUnidadAgregado.value = data.DESC_AGREGADO;
	
	mensajeFecha.innerHTML = (data.FECHA) ? "FECHA DEL ESTADO ACTUAL : "+data.FECHA : "";
	fechaEstadoActual.value = data.FECHA;

	iconoBusqueda.style.visibility = "hidden";
	desactivarBotones(data.CODIGO_ESTADO==0||data.CODIGO_ESTADO==3000);

	if(textCodEquipo.value){
		if(unidadUsuario.value == data.CODIGO_UNIDAD && (data.CODIGO_ESTADO!=3500&&data.CODIGO_ESTADO!=3600)){
			alert("ESTA CAMARA CORPORAL YA PERTENECE A LA UNIDAD ...          ");
			cerrarFicha();
			return;
		}
		if(unidadUsuario.value == data.CODIGO_AGREGADO){
			alert("ESTA CAMARA CORPORAL YA ESTA AGREGADA A LA UNIDAD ...          ");
			cerrarFicha();
			return;
		}
		if(data.CODIGO_ESTADO == 100){
			alert("CAMARA CORPORAL FUE DADA DE BAJA ...          ");
			cerrarFicha();
			return;
		}
		
		if(unidadUsuario.value != data.CODIGO_UNIDAD && (data.CODIGO_ESTADO!=3500&&data.CODIGO_ESTADO!=3600)){
			alert("NO PUEDE AGREGAR ESTA CAMARA CORPORAL,\nYA QUE PERTENECE A LA " +data.DESC_UNIDAD+ ", Y AUN NO HA SIDO DESPACHADO ... ");
			cerrarFicha();
			return;
		}
		
		if(data.CODIGO_ESTADO==3500||data.CODIGO_ESTADO==3600){
			selEstado.value = 10;
			selEstado.disabled = true;
			imagenCalendarioFichaCamara.style.visibility = "visible";
			textFechaNuevoEstado.value="";
			btnGuardar.disabled = false;
			desactivarBotones(true);
		}
	}
	textCodEquipo.value = data.CODIGO_EQUIPO;
}

function desactivarBotones(desactivo){
	if(subMenu.value=='agregados') return;
	btnDejarDisponible.disabled = desactivo;
	btnBaja.disabled = desactivo;
}

function activarBotones(){
	desactivarBotones(false);
}

function guardarFichaCamaraCorporal(){
	if(!textFechaNuevoEstado.value){
		alert("Debe indicar una fecha");
		textFechaNuevoEstado.focus();
		return;
	}

	if(textUnidadBloqueada.value == 1 && comparaFecha(textFechaLimite.value, textFechaNuevoEstado.value) == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + textFechaLimite.value);
		return;
	}

	if(comparaFecha(fechaEstadoActual.value, textFechaNuevoEstado.value) == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + fechaEstadoActual.value);
		return;
	}

	var cantidadServicio = cantidadServiciosCamara(codCamara.value, textFechaNuevoEstado.value, '01-01-3000');
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		return;
	}

	if(confirm("ATENCIÓN :\nSE MODIFICARÁ EL ESTADO ACTUAL DE LA CAMARA CORPORAL.          \n¿DESEA CONTINUAR?")){
		guardarCamara();
		cerrarFicha();
	}
}

function activaVentanaIngresoFecha(tipo, activar){
	cubreVentana.style.display = "";
	ventanaIngresoFecha.style.display  = "";
	textFechaVentanaFecha.value = "";
	if (tipo == 1) {
		textTipoMovimentoVentanaFecha.innerHTML = "Indique fecha en que se hace efectivo el Traslado de esta Camara :";
		tituloMovimentoVentanaFecha.innerHTML = "Trasladar Camara Corporal";
		textTipo.value=1;
	}
	if (tipo == 2){
		textTipoMovimentoVentanaFecha.innerHTML = "Indique fecha en que se hace efectivo la Baja de esta Camara :";
		tituloMovimentoVentanaFecha.innerHTML = "Dar Baja Camara Corporal";
		textTipo.value=2;
	}
}

function activaBuscaUnidadAgregado(){
	desactivarBotones(true);
	cubreVentana.style.display = "";
	ventanaSeleccionaUnidad.style.display = "";
	listaUnidades(unidadUsuario.value, unidadPadre.value, 'selectUnidad');
}

function aceptaFechaVentanaIngresoFecha(){
	if(!textFechaVentanaFecha.value){
		alert("Debe indicar una fecha");
		textFechaVentanaFecha.focus();
		return;		
	}

	if(textUnidadBloqueada.value == 1 && comparaFecha(textFechaLimite.value, textFechaVentanaFecha.value) == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + textFechaLimite.value);
		return;
	}

	if(comparaFecha(fechaEstadoActual.value, textFechaVentanaFecha.value) == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + fechaEstadoActual.value);
		return;
	}
	
	var cantidadServicio = cantidadServiciosCamara(codCamara.value, textFechaVentanaFecha.value, '01-01-3000');
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		return;
	}

	if(textTipo.value==1 && confirm("ATENCIÓN :\nLA CAMARA CORPORAL DEJARA DE ESTAR ASIGNADA A ESTA UNIDAD.          \n¿DESEA CONTINUAR?")) trasladarCamara();
	if(textTipo.value==2 && confirm("ATENCIÓN :\nSE REGISTRARA LA BAJA DE LA CAMARA CORPORAL, DEJARA DE ESTAR ASIGNADA A ESTA UNIDAD Y NO PODRÁ SER TOMADA POR NINGUNA OTRA UNIDAD.          \n¿DESEA CONTINUAR?")) bajaCamara();
	
	desactivaVentanaIngresoFecha();
	cerrarFicha();
}

function desactivaVentanaIngresoFecha(){
	activarBotones();
	cubreVentana.style.display = "none";
	ventanaIngresoFecha.style.display  = "none";
}

function cantidadServiciosCamara(codigoCamara, fecha1, fecha2){
	var mensaje	=	"";
	var parametros = "codigoCamara="+codigoCamara+"&fecha1="+fecha1+"&fecha2="+fecha2;
	var objHttpXMLCamara = new AJAXCrearObjeto();
	objHttpXMLCamara.open("POST","./xml/xmlServicios/xmlListaServiciosPorCamara.php",false);
	objHttpXMLCamara.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log(parametros);
	objHttpXMLCamara.send(encodeURI(parametros));
	//console.log(objHttpXMLCamara.responseText);
	if (objHttpXMLCamara.responseText != "VACIO"){
		mensaje += "NO PUEDE CAMBIAR DE ESTADO, PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		var xml = objHttpXMLCamara.responseXML.documentElement;
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio 	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad 	 	= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
	}
	return mensaje;
}

function trasladarCamara(){
	//console.log("trasladar");
	var parametros = "codigoCamara="+codCamara.value;
	parametros += "&codigoUnidad="+codUnidad.value;
	parametros += "&codigoEstado=3500";
	parametros += "&fechaEstado="+textFechaVentanaFecha.value;
	parametros += "&codigoUnidadAgregado=";
  	//console.log(parametros);
	var objHttpXMLEstadoCamara = new AJAXCrearObjeto();
	objHttpXMLEstadoCamara.open("POST","./xml/xmlCamaras/xmlActualizarCamaras.php",true);
	objHttpXMLEstadoCamara.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstadoCamara.send(encodeURI(parametros));
	objHttpXMLEstadoCamara.onreadystatechange=function(){
		if(objHttpXMLEstadoCamara.readyState == 4){
			if (objHttpXMLEstadoCamara.responseText != "VACIO"){
				//console.log(objHttpXMLEstadoCamara.responseText);
				var xml = objHttpXMLEstadoCamara.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if(codigo == 1){
						alert('LA ACTUALIZACION FUE GUARDADA CON EXITO EN LA BASE DE DATOS. LA CAMARA CORPORAL HA DEJADO DE ESTAR ASIGNADA A ESTA UNIDAD ...... ');
						(subMenu.value!="agregados") ? leeCamaras('CODIGO_CAMARA', 'ASC') : leeCamarasAgregadas('CODIGO_CAMARA', 'ASC');
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function bajaCamara(){
	//console.log("baja");
	var parametros = "codigoCamara="+codCamara.value;
	parametros += "&codigoUnidad="+codUnidad.value;
	parametros += "&codigoEstado=1000";
	parametros += "&fechaEstado="+textFechaVentanaFecha.value;
	parametros += "&codigoUnidadAgregado=";
  	//console.log(parametros);
	var objHttpXMLEstadoCamara = new AJAXCrearObjeto();
	objHttpXMLEstadoCamara.open("POST","./xml/xmlCamaras/xmlActualizarCamaras.php",true);
	objHttpXMLEstadoCamara.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstadoCamara.send(encodeURI(parametros));
	objHttpXMLEstadoCamara.onreadystatechange=function(){
		if(objHttpXMLEstadoCamara.readyState == 4){
			if (objHttpXMLEstadoCamara.responseText != "VACIO"){
				//console.log(objHttpXMLEstadoCamara.responseText);
				var xml = objHttpXMLEstadoCamara.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if(codigo == 1){
						alert('LA ACTUALIZACION FUE GUARDADA CON EXITO EN LA BASE DE DATOS. LA CAMARA CORPORAL NO SE ENCUENTRA DISPONIBLE PARA NINGUNA UNIDAD ...... ');
						(subMenu.value!="agregados") ? leeCamaras('CODIGO_CAMARA', 'ASC') : leeCamarasAgregadas('CODIGO_CAMARA', 'ASC');
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function guardarCamara(){
	var parametros = "codigoCamara="+codCamara.value;
	parametros += "&codigoUnidad="+unidadUsuario.value;
	parametros += "&codigoEstado="+selEstado.value;
	parametros += "&fechaEstado="+textFechaNuevoEstado.value;
	parametros += "&codigoUnidadAgregado="+codUnidadAgregado.value;
  	//console.log(parametros);
	var objHttpXMLEstadoCamara = new AJAXCrearObjeto();
	objHttpXMLEstadoCamara.open("POST","./xml/xmlCamaras/xmlActualizarCamaras.php",true);
	objHttpXMLEstadoCamara.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstadoCamara.send(encodeURI(parametros));
	objHttpXMLEstadoCamara.onreadystatechange=function(){
		if(objHttpXMLEstadoCamara.readyState == 4){
			if (objHttpXMLEstadoCamara.responseText != "VACIO"){
				//console.log(objHttpXMLEstadoCamara.responseText);
				var xml = objHttpXMLEstadoCamara.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if(codigo == 1){
						alert('LA ACTUALIZACION DEL ESTADO FUE GUARDADO CON EXITO EN LA BASE DE DATOS ...... ');
						(subMenu.value!="agregados") ? leeCamaras('CODIGO_CAMARA', 'ASC') : leeCamarasAgregadas('CODIGO_CAMARA', 'ASC');
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}
