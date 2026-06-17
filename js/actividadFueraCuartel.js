var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;
function leeFuncionarios(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Actividades Fuera del Cuartel ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlActividadFueraCuartel/xmlListaFuncionarioActividadFueraCuartel.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var apellido1   		= "";
				var apellido2	    	= "";
				var nombre2				= "";
				var nombre				= "";
				var nombreCompleto		= "";
				var usuarioProservipol	= "";
				var tipoActividad		= "";
				var codActividad		= "";
				var Rut					= "";
				var LinkConstancia		= "";
				var fechaInicio			= "";
				var fechaTermino		= "";
				var fechaInicioReal		= "";
				var fechaTerminoReal	= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 		 		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					apellido1   			= (xml.getElementsByTagName('apellido1')[i].text||xml.getElementsByTagName('apellido1')[i].textContent||"");
					apellido2	    		= (xml.getElementsByTagName('apellido2')[i].text||xml.getElementsByTagName('apellido2')[i].textContent||"");
					nombre2					= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					nombre					= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					nombreCompleto			= apellido1+" "+apellido2+", "+nombre+" "+nombre2;
					Rut						= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					usuarioProservipol		= (xml.getElementsByTagName('usuarioProservipol')[i].text||xml.getElementsByTagName('usuarioProservipol')[i].textContent||"");
					codUnidad				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					tipoActividad			= (xml.getElementsByTagName('tipoActividad')[i].text||xml.getElementsByTagName('tipoActividad')[i].textContent||"");
					codActividad			= (xml.getElementsByTagName('codActividad')[i].text||xml.getElementsByTagName('codActividad')[i].textContent||"");
					fechaInicio				= (xml.getElementsByTagName('fecha_inicio')[i].text||xml.getElementsByTagName('fecha_inicio')[i].textContent||"");
					fechaTermino			= (xml.getElementsByTagName('fecha_termino')[i].text||xml.getElementsByTagName('fecha_termino')[i].textContent||"");
					fechaInicioReal			= (xml.getElementsByTagName('fecha_inicio_real')[i].text||xml.getElementsByTagName('fecha_inicio_real')[i].textContent||"");
					fechaTerminoReal		= (xml.getElementsByTagName('fecha_termino_real')[i].text||xml.getElementsByTagName('fecha_termino_real')[i].textContent||"");
					
					LinkConstancia 			= '<a href="imprimible/servicios/fichaActividadFueraCuartel.php?codigoFuncionario='+codigo+'&rutFuncionario='+Rut+'&codActividad='+codActividad+'&usuarioProservipol='+usuarioProservipol+'" target="_blank"> <img src="img/adjunto.jpg" width=15 height=15 ></a>';
					resaltarLinea 	 		= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar        = "cambiarClase(this, '"+fondoLinea+"')";
					if(fechaInicioReal=="--") fechaInicioReal = fechaInicio;
					if(fechaTerminoReal=="--") fechaTerminoReal = fechaTermino;
					
					var marca1 				= (fechaInicio!=fechaInicioReal) ? "(*)" : "";
					var marca2 				= (fechaTermino!=fechaTerminoReal) ? "(*)" : "";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ACTIVIDAD FUERA CUARTEL', '920', '450','fichaActividadFueraCuartel.php?codActividad="+codActividad+"&codUnidad="+unidad+"','"+nroLinea+"','','50','50')";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='28%'><div id='valorColumna'>"+nombreCompleto+"</div></td>";
					listadoFuncionarios += "<td width='23%' align='left'><div id='valorColumna'>"+tipoActividad+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center' title='Fecha de inicio de la actividad: "+fechaInicioReal+"'>"+fechaInicioReal+marca1+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center' title='Fecha de termino de la actividad: "+fechaTerminoReal+"'>"+fechaTerminoReal+marca2+"</div></td>";
					listadoFuncionarios	+= "<td width='10%' align='center' title='Descargar constancia' ><div id='valorColumna'>"+LinkConstancia+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
			}
		}
	}
}

function cerrarVentanaActividadFueraCuartel(){
	if(top.cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		top.cerrarVentana();
	}
}

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";
	if(sentido == "desc") nuevoSentido = "asc";
	if(sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	switch(atributo){
		case "codigo":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColCodigo").innerHTML = "CODIGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigo").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "nombre":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColNombre").innerHTML = "NOMBRE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "tipo":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColTipo").innerHTML = "TIPO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colTipo").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "fechaI":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFechaI").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "fechaT":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFechaT").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "constancia":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colConstancia").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
	}
	idCargaListadoFuncionarios = setInterval("tituloColumnaNormal("+columna.id+")",500);
}

function tituloColumnaNormal(columna){
	if(cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		cambiarClase(columna,'nombreColumna');
	}
}

function mensajeActividadFueraCuartel(){
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  	var f = new Date();
	var fechaHoy = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
	var unidad = document.getElementById("unidad").value;
	var fecha = document.getElementById("fecha").value;
  	var mensaje = "";
  	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlActividadFueraCuartel/xmlMensajeActividadFueraCuartel.php",false);
 	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&fecha="+fecha));
  	//console.log(objHttpXMLFuncionarios.responseText);
  	if(objHttpXMLFuncionarios.responseText != "VACIO"){
  		//alert(objHttpXMLFuncionarios.responseText);
  		var xml = objHttpXMLFuncionarios.responseXML.documentElement;
  		mensaje += "ACTIVIDADES FUERA DEL CUARTEL INGRESADAS: "+fechaHoy.toUpperCase()+"\n\n";
    	if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
    	else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	  	for(var i=0;i<cantidadServiciosMostar;i++){
			var grado 		= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
			var nom1 		= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
			var nom2 		= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
			var ape1 	    = (xml.getElementsByTagName('apellido1')[i].text||xml.getElementsByTagName('apellido1')[i].textContent||"");
			var ape2        = (xml.getElementsByTagName('apellido2')[i].text||xml.getElementsByTagName('apellido2')[i].textContent||"");
			var codigo	  	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
			var tipo	  	= (xml.getElementsByTagName('tipoActividad')[i].text||xml.getElementsByTagName('tipoActividad')[i].textContent||"");
			var estado	  	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
			var estadoDesc	= "";
			if(estado=="2") estadoDesc = "-(ANULADA)";
			mensaje += (i+1) +". " +tipo+" - "+grado+" "+nom1+" "+nom2+" "+ape1+" "+ape2+" ("+codigo+")"+", "+estadoDesc+".\n";
		}
		if (cantidadServiciosMostar = xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function rutUsuario(){
	var objHttpXMLCodigo = new AJAXCrearObjeto();
	objHttpXMLCodigo.open("POST","./xml/xmlActividadFueraCuartel/xmlrutUsuario.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI());
	objHttpXMLCodigo.onreadystatechange=function(){
		if(objHttpXMLCodigo.readyState == 4){
			//alert(objHttpXMLCodigo.responseText);
			if (objHttpXMLCodigo.responseText != "VACIO"){
				var xml	= objHttpXMLCodigo.responseXML.documentElement;
				var rut	= "";
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					rut	= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					document.getElementById("rutUsuario").value = rut;
				}
			}
		}
	}
}

function ValidaDatosFuncionario(){
	var RutFuncionario	= eliminarBlancos(document.getElementById("txtrut").value.toUpperCase());
	if (RutFuncionario == ""){
		alert("DEBE INDICAR EL RUN DEL FUNCIONARIO ...... 	     ");
		document.getElementById("txtrut").value="";
		document.getElementById("txtrut").focus();
		return true;
	}
	return false;
}

function buscaDatosFuncionario(){
	if(ValidaDatosFuncionario()) return 0;
	var RutFuncionario	= eliminarBlancos(document.getElementById("txtrut").value.toUpperCase());
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var rutsinChar = RutFuncionario;
	rutsinChar=rutsinChar.replace(".","");
	rutsinChar=rutsinChar.replace(".","");
	rutsinChar=rutsinChar.replace("-","");
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlActividadFueraCuartel/xmlDatosFuncionarioFueraCuartel.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("rut="+rutsinChar));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//console.log(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//console.log(objHttpXMLFuncionarios.responseText);
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var primerApellido		= "";
				var segundoApellido		= "";
				var primerNombre	 	= "";
				var segundoNombre	 	= "";
				var unidadFuncionario	= "";
				var unidadUsuario		= "";

				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo	 		  	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					primerApellido	  	= (xml.getElementsByTagName('primerApellido')[i].text||xml.getElementsByTagName('primerApellido')[i].textContent||"");
					segundoApellido   	= (xml.getElementsByTagName('segundoApellido')[i].text||xml.getElementsByTagName('segundoApellido')[i].textContent||"");
					primerNombre 	  	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					segundoNombre 	  	= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					codigoCargo		  	= (xml.getElementsByTagName('codigoCargo')[i].text||xml.getElementsByTagName('codigoCargo')[i].textContent||"");
					unidadFuncionario 	= (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					unidadAgr	 		= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					unidadUsuario 		= document.getElementById("unidadUsuario").value;
					
					if(unidadUsuario != ((unidadAgr) ? unidadAgr : unidadFuncionario)){
						alert("EL FUNCIONARIO NO ESTA DISPONIBLE EN SU UNIDAD");
						top.cerrarVentana();
						return false;
					}
					/*
					if(codigoCargo==9460){
						document.getElementById("mensajeCargando").style.display = "none";
						alert ("EL FUNCIONARIO ESTA AGREGADO EN COMISIÓN DE SERVICIO, POR LO QUE NO PUEDE ASIGNARLO NUEVAMENTE A COMISIÓN...");
						document.getElementById("txtrut").value = "";
						document.getElementById("txtrut").disabled = false;
						document.getElementById("txtrut").focus();
						top.cerrarVentana();
						return false;
					}
					*/
					if(codigoCargo==3005){
						document.getElementById("mensajeCargando").style.display = "none";
						alert ("EL FUNCIONARIO ESTA AGREGADO A UNA UNIDAD SIN PROSERVIPOL...");
						document.getElementById("txtrut").value = "";
						document.getElementById("txtrut").disabled = false;
						document.getElementById("txtrut").focus();
						top.cerrarVentana();
						return false;
					}
					
					document.getElementById("fotoFuncionario").src 		= "./img/sinFoto.png";
					document.getElementById("unidadFuncionario").value	= unidadFuncionario;
					document.getElementById("idFuncionario").value		= codigo;
					document.getElementById("txtape1").value 			= primerApellido;
					document.getElementById("txtape2").value 			= segundoApellido;
					document.getElementById("txtnom").value 	 		= primerNombre+" "+segundoNombre;
					document.getElementById("mensajeCargando").style.display = "none";
					capturaCorrelativo();
				}
			}
			else {
				document.getElementById("mensajeCargando").style.display = "none";
				alert ("NO EXISTE O NO PERTENECE A NINGUNA UNIDAD ...");
				document.getElementById("txtrut").value = "";
				document.getElementById("txtrut").disabled = false;
				document.getElementById("txtrut").focus();
			}
		}
	}
}

function capturaCorrelativo(){
	var unidad	= document.getElementById("unidadFuncionario").value;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlActividadFueraCuartel/xmlCorrelativoAnterior.php",false);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("unidad="+unidad));
	//console.log(objHttpXMLServicios.responseText);
	if(objHttpXMLServicios.responseText != "VACIO") {
		var xml = objHttpXMLServicios.responseXML.documentElement;
		document.getElementById("correlativo").value = (xml.getElementsByTagName('ultimoCorrelativo')[0].text||xml.getElementsByTagName('ultimoCorrelativo')[0].textContent||"");
	}
}

function solo_num(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
	return true;
}

function solo_char(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode > 48 && charCode < 57)) return false;
	return true;
}

function solo_rut(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if((charCode < 48 || charCode > 57)&&(charCode != 75 && charCode != 107)) return false;
	return true;
}

function formato_rut(rut){
	var sRut1 = rut.value;
	var nPos = 0;
	var sInvertido = "";
	var sRut = "";
	for(var i = sRut1.length - 1; i >= 0; i-- ){
		sInvertido += sRut1.charAt(i);
		if(i == sRut1.length - 1 )
	    sInvertido += "-";
	  	else if (nPos == 3){
		sInvertido += ".";
		nPos = 0;
	  	}
		nPos++;
	}
	for(var j = sInvertido.length - 1; j >= 0; j-- ){
		if(sInvertido.charAt(sInvertido.length - 1) != ".") sRut += sInvertido.charAt(j);
		else if(j != sInvertido.length - 1 ) sRut += sInvertido.charAt(j);
	}
	rut.value = sRut.toUpperCase();
	Valida_Rut(rut);
}

function Valida_Rut(Objeto){	
	var tmpstr = "";
	var intlargo = Objeto.value;
	
	if (intlargo.length> 0){
		crut = Objeto.value
		largo = crut.length;
		if ( largo <2 ){
			alert('rut invalido')
			Objeto.focus()
			return false;
		}
		
		for ( i=0; i <crut.length ; i++ )
		
		if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' ){
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut=tmpstr;
		largo = crut.length;
 
		if ( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else
			rut = crut.charAt(0);

		dv = crut.charAt(largo-1);
 
		if ( rut == null || dv == null )
		return 0;

		var dvr = '0';
		suma = 0;
		mul  = 2;

		for (i= rut.length-1 ; i>= 0; i--){
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}
 
		res = suma % 11;
		if (res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else{
			dvi = 11-res;
			dvr = dvi + "";
		}
		
		if ( dvr != dv.toLowerCase() ){
			alert('El Rut Ingresado no es Invalido');
			Objeto.value="";
			Objeto.focus();
			return false;
		}
		
		Objeto.disabled = true;
		buscaDatosFuncionario();
		return true;
	}
}

function tipoFicha(codActividad,codUnidad){
	var permisoRegistrar = document.getElementById("permisoRegistrar").value;
	if(codActividad==""){
		document.getElementById('btnAnularActividad').style.display="none";
		document.getElementById('btnSuspenderActividad').style.display="none";
	}
	else{
		if(!permisoRegistrar){
			document.getElementById('btnAnularActividad').disabled = "true";
			document.getElementById('btnSuspenderActividad').disabled = "true";
		}
		document.getElementById('btnGuardarActividad').style.display="none";
		document.getElementById('txtrut').disabled = true;
		document.getElementById('idFechaServicio1').disabled = true;
		document.getElementById('idFechaServicio2').disabled = true;
		document.getElementById('cboTipo').disabled = true;
		buscarDatos(codActividad,codUnidad);
	}
}

function buscarDatos(codActividad,codUnidad){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlActividadFueraCuartel/xmlDatosFichaActividad.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codActividad="+codActividad+"&codUnidad="+codUnidad));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//console.log(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//console.log(objHttpXMLFuncionarios.responseText);
				var xml				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo			= "";
				var primerApellido	= "";
				var segundoApellido = "";
				var primerNombre	= "";
				var segundoNombre	= "";
				var rut				= "";
				var fechaI			= "";
				var fechaT			= "";
				var fechaTR			= "";
				var tipo			= "";
				var unidad			= "";
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					
					txtCodigoActividad.value	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					codigoFun		= (xml.getElementsByTagName('codigoFuncionario')[i].text||xml.getElementsByTagName('codigoFuncionario')[i].textContent||"");
					primerApellido	= (xml.getElementsByTagName('primerApellido')[i].text||xml.getElementsByTagName('primerApellido')[i].textContent||"");
					segundoApellido	= (xml.getElementsByTagName('segundoApellido')[i].text||xml.getElementsByTagName('segundoApellido')[i].textContent||"");
					primerNombre	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					segundoNombre	= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					rut				= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					fechaI			= (xml.getElementsByTagName('fechaI')[i].text||xml.getElementsByTagName('fechaI')[i].textContent||"");
					fechaT			= (xml.getElementsByTagName('fechaT')[i].text||xml.getElementsByTagName('fechaT')[i].textContent||"");
					fechaTR			= (xml.getElementsByTagName('fechaTR')[i].text||xml.getElementsByTagName('fechaTR')[i].textContent||"");
					tipo			= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					unidad			= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					txtComision.value	= (xml.getElementsByTagName('numDocumento')[i].text||xml.getElementsByTagName('numDocumento')[i].textContent||"");

					document.getElementById("idFuncionario").value				= codigoFun;
					document.getElementById("txtrut").value						= rut;
					document.getElementById("txtape1").value 					= primerApellido;
					document.getElementById("txtape2").value 					= segundoApellido;
					document.getElementById("txtnom").value 	 				= primerNombre+" "+segundoNombre;
					document.getElementById("txtfec1").value 		 			= fechaI;
					document.getElementById("txtfec2").value 	 				= fechaT;
    				document.getElementById("txtFechaTerminoReal").value 	 	= fechaTR;
					document.getElementById("FechaFinalReal").value				= fechaTR;
					document.getElementById('cboTipo').value 					= tipo;
					document.getElementById("unidadFuncionario").value			= unidad;
					document.getElementById("mensajeCargando").style.display	= "none";
					cambioTipoFicha();
				}
			}
		}
	}
}

function guardarActividad(){
	btnGuardarActividad.disabled = true;
	if(validarActividad()){
		if (confirm("ATENCIÓN :\nSE INGRESARÁ LA COMISIÓN DE SERVICIO DE ESTE FUNCIONARIO EN EL SISTEMA.          \n¿DESEA CONTINUAR?")) {
			nuevaActividad();
		} else {
			btnGuardarActividad.disabled = false;
			return false;
		}
		document.getElementById('btnGuardarActividad').value = "GUARDANDO ...";
		document.getElementById("mensajeGuardando").style.display = "";
		document.getElementById("mensajeGuardando").style.left = "170px";
		document.getElementById("mensajeGuardando").style.top  = "200px";
	}
}

function validarActividad(){
	var rut			= eliminarBlancos(document.getElementById("txtrut").value);
	var fechaTer	= document.getElementById("txtfec2").value;
	var fechaIni	= document.getElementById("txtfec1").value;
	var fechaCierre = document.getElementById("FechaCierre").value;
	var tipo		= document.getElementById("cboTipo").value;
	
	if (rut == "") {
		alert("DEBE INDICAR RUT ...... 	     ");
		document.getElementById("txtrut").focus();
		return false;
	}
	
	if (fechaIni == "") {
		alert("DEBE INDICAR LA FECHA DE INICIO DE LA COMISION DE SERVICIO  ...... 	     ");
		document.getElementById("txtfec1").focus();
		return false;
	}
	
	if (fechaTer == "") {
		alert("DEBE INDICAR LA FECHA DE TERMINO DE LA COMISION DE SERVICIO ...... 	     ");
		document.getElementById("txtfec2").focus();
		return false;
	}
	
	if (tipo == 0) {
		alert("DEBE SELECCIONAR UN TIPO DE LA COMISION DE SERVICIO ...... 	     ");
		document.getElementById("cboActividad").focus();
		return false;
	}
	
	var arrayAux = fechaCierre.split("-");
	fechaCierre = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0]);
	
	arrayAux = fechaIni.split("-");
	fechaIni = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0]);
	
	arrayAux = fechaTer.split("-");
	fechaTer = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0]);
	
	if(fechaCierre > fechaTer){
		alert("NO PUEDE "+mensaje+" LA COMISION DE SERVICIO, PORQUE SE ENCUENTRA CERRADO EL MES.");
		return true;
	}
	if(fechaCierre > fechaIni){
		alert("NO PUEDE "+mensaje+" LA COMISION DE SERVICIO, PORQUE SE ENCUENTRA CERRADO EL MES.");
		return true;
	}

	if (fechaIni > fechaTer) {
		alert("LA FECHA DE INICIO NO PUEDE SER SUPERIOR A LA FECHA DE TERMINO DE LA COMISIÓN DE SERVICIO  ...... 	    \n"+document.getElementById("txtfec1").value+" > "+document.getElementById("txtfec2").value);
		document.getElementById("txtfec1").focus();
		return false;
	}
	
	if(txtComision.value==""){
		alert("DEBE INGRESAR EL NUMERO DE LA RESOLUCIÓN");
		return true;
	}

 	if(controlActividadCierreValidacion("GUARDAR")) return false;
	if(verificaExisteServicio()) return false;
	
	return true;
}

function verificaExisteServicio(){
	var codFuncionario 	 = document.getElementById("idFuncionario").value;
	var fechaI	 = document.getElementById("txtfec1").value;
	var fechaT	 = document.getElementById("txtfec2").value;
	var mensaje	 = "";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlActividadFueraCuartel/xmlListaServicios.php",false);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("funcionario="+codFuncionario+"&fecha1="+fechaI+"&fecha2="+fechaT));
	//alert(objHttpXMLFuncionarios.responseText);
	if(objHttpXMLFuncionarios.responseText != "VACIO"){
		var xml = objHttpXMLFuncionarios.responseXML.documentElement;
		mensaje += "NO PUEDE INGRESAR LA ACTIVIDAD PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if(xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad		= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if(cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function cambioTipoFicha(){
	(cboTipo.value=='867') ? numComision.style.display = 'block' : numComision.style.display = 'none';
}

function padNumber(number){
    var string  = '' + number;
    string      = string.length < 2 ? '0' + string : string;
    return string;
}

function controlActividadCierreValidacion(mensaje){
	var codigoFuncionario	= document.getElementById("idFuncionario").value;
	var fechaCierre			= document.getElementById("FechaCierre").value;
	var fechaInicio			= document.getElementById("txtfec1").value;
	var fechaTermino		= document.getElementById("txtfec2").value;
	var fechaTerminoReal	= (mensaje=="GUARDAR") ? document.getElementById("txtfec2").value : document.getElementById("txtFechaTerminoReal").value;
	
	var fecha1 = fechaInicio;
	var fecha2 = fechaTerminoReal;
	if(mensaje=="SUSPENDER"){
		parts	  	= fechaTerminoReal.split("-");
		date      	= new Date(new Date(parts[2],parts[1]-1,parts[0]));
		next_date 	= new Date(date.setDate(date.getDate() + 1));
		var fecha1 	= padNumber(next_date.getUTCDate())+'-'+padNumber(next_date.getUTCMonth()+1)+'-'+next_date.getUTCFullYear();
		var fecha2 	= fechaTermino;
	}
	if(mensaje=="ANULAR"){
		var fecha2 = fechaTermino;
	}
	
	parts				= fechaInicio.split("-");
	fechaInicio			= new Date(parts[2],parts[1]-1,parts[0]);
	parts				= fechaTermino.split("-");
	fechaTermino		= new Date(parts[2],parts[1]-1,parts[0]);
	parts				= fechaTerminoReal.split("-");
	fechaTerminoReal	= new Date(parts[2],parts[1]-1,parts[0]);
	parts				= fechaCierre.split("-");
	fechaCierre			= new Date(parts[2],parts[1]-1,parts[0]);
		
	if(fechaCierre > fechaTermino){
		alert("NO PUEDE "+mensaje+" LA COMISION DE SERVICIO, PORQUE SE ENCUENTRA CERRADO EL MES.");
		return true;
	}
	
	if(fechaCierre > fechaTerminoReal){
		alert("NO PUEDE "+mensaje+" LA COMISION DE SERVICIO, PORQUE SE ENCUENTRA CERRADO EL MES.");
		return true;
	}
	
	if(fechaTerminoReal < fechaInicio){
		alert("NO PUEDE "+mensaje+" LA COMISION DE SERVICIO, PORQUE LA FECHA DE TERMINO NO PUEDE SER MENOR A LA FECHA DE INICIO DE LA COMISION DE SERVICIO.");
		return true;
	}
	
	var mensaje="";
  	var cantidadDiasMostrar = 0;
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();
	objHttpXMLFechaValidacion.open("POST","./xml/xmlActividadFueraCuartel/xmlControlValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2);
	objHttpXMLFechaValidacion.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//console.log(objHttpXMLFechaValidacion.responseText);
  	if(objHttpXMLFechaValidacion.responseText != "VACIO"){
		var xml = objHttpXMLFechaValidacion.responseXML.documentElement;
		mensaje += "NO PUEDE "+mensaje+" LA COMISION DE SERVICIO PORQUE TIENE LOS SIGUIENTES DIAS VALIDADOS:\n\n";
		var cantidadDiasMostrar = (xml.getElementsByTagName('servicio').length > 10) ? 10 : xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadDiasMostrar;i++){
			var fecha = (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			mensaje += "- FECHA: "+fecha+" \n";
		}
		alert(mensaje);
		return true;
	}
	return false;
}

function nuevaActividad(){
	var unidadUsuario		= document.getElementById('unidadUsuario').value;
  	var unidadFuncionario	= (document.getElementById('unidadFuncionario').value=="") ? 1 : document.getElementById('unidadFuncionario').value;
  	var rutsinchar 			= txtrut.value;
  	var fechaI 				= txtfec1.value;
  	var fechaT 				= txtfec2.value;
	var ip 					= IpFuncionario.value;
 	var nDocumento			= txtComision.value;
 	var codigoFuncionario 	= document.getElementById('idFuncionario').value;
	var fechaRegistro		= fecha.value;
  	var tipoActividad 		= cboTipo.value;

	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace("-","");
	
	var Fecha 	= new Date();
	var sFecha 	= fechaI || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
	var sep 	= sFecha.indexOf('/') != -1 ? '/' : '-';
	var aFecha 	= sFecha.split(sep);
	var fechaDI = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
	fechaDI	= new Date(fechaDI);
	
	sFecha 	= fechaT || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
	sep 	= sFecha.indexOf('/') != -1 ? '/' : '-';
	aFecha 	= sFecha.split(sep);
	var fechaDT = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
	fechaDT = new Date(fechaDT);
	
	var diasDif = fechaDT.getTime() - fechaDI.getTime();
	var dias = Math.round(diasDif/(1000 * 60 * 60 * 24))+1;
	
	var parametros = "";
	parametros += "rut="+rutsinchar+"&fechaI="+fechaI+"&fechaT="+fechaT+"&tipoActividad="+tipoActividad+"&codigoFuncionario="+codigoFuncionario;
	parametros += "&fechaRegistro="+fechaRegistro+"&nDocumento="+nDocumento+"&ip="+ip+"&unidadFuncionario="+unidadFuncionario+"&dias="+dias;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlActividadFueraCuartel/xmlNuevaActividad.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//console.log(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
			//console.log(objHttpXMLFuncionarios.responseText);
			var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LA COMISIÓN DE SERVICIO FUE INGRESADA CON EXITO AL SISTEMA ......        ');
						top.leeFuncionarios(unidadUsuario, '', '');
						idCargaListadoFuncionarios = setInterval("cerrarVentanaActividadFueraCuartel()",1000);
					}
					else alert('LA COMISIÓN DE SERVICIO NO FUE INGRESADA AL SISTEMA ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function anularActividad(){
	if(controlActividadCierreValidacion("ANULAR")) return false;
	if(confirm("ATENCION :\nSE ANULARÁ ESTA COMISION DE SERVICIO EN EL SISTEMA.          \nDESEA CONTINUAR?")){
		actualizarActividad("ANULADA");
	} else {
		return false;
	}
	document.getElementById('btnAnularActividad').value = "ANULANDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
}

function suspenderActividad(){
	if(controlActividadSuspendido()) return false;
	if(controlActividadCierreValidacion("SUSPENDER")) return false;
	if(confirm("ATENCION :\nSE SUSPENDERÁ PARTE DE LA COMISION DE SERVICIO.          \nDESEA CONTINUAR?")){
		actualizarActividad("SUSPENDIDA");
	} else {
		return false;
	}
	document.getElementById('btnSuspenderActividad').value = "SUSPENDIENDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
}

function controlActividadSuspendido(){
	var fechaInicio			= document.getElementById("txtfec1").value;
	var fechaTermino		= document.getElementById("txtfec2").value;
	var fechaTerminoReal	= document.getElementById("txtFechaTerminoReal").value;
	var FechaFinalReal		= document.getElementById("FechaFinalReal").value;
	var parts				= fechaInicio.split("-");
	fechaInicio 			= new Date(parts[2],parts[1]-1,parts[0]);
	parts 					= fechaTermino.split("-");
	fechaTermino 			= new Date(parts[2],parts[1]-1,parts[0]);
	parts 					= fechaTerminoReal.split("-");
	fechaTerminoReal 		= new Date(parts[2],parts[1]-1,parts[0]);
	parts 					= FechaFinalReal.split("-");
	FechaFinalReal 			= new Date(parts[2],parts[1]-1,parts[0]);
	
	if(fechaTerminoReal >= fechaTermino){
		alert("LA NUEVA FECHA DE TERMINO NO PUEDE SER IGUAL O MAYOR A LA FECHA DE TERMINO DE LA COMISION DE SERVICIO");
		return true;
	}
	if(fechaInicio >= fechaTerminoReal){
		alert("LA NUEVA FECHA DE TERMINO NO PUEDE SER IGUAL O MENOR A LA FECHA DE INICIO DE LA COMISION DE SERVICIO");
		return true;
	}
	if(fechaTerminoReal >= FechaFinalReal){
		alert("LA NUEVA FECHA DE TERMINO NO PUEDE SER IGUAL O MAYOR A LA FECHA DE TERMINO ANTERIOR");
		return true;
	}
	return false;
}

function actualizarActividad(accion){
	var txtCodigoActividad	= document.getElementById("txtCodigoActividad").value;
	var unidadFuncionario	= (document.getElementById('unidadFuncionario').value=="") ? 1 : document.getElementById('unidadFuncionario').value;
	var codigoFuncionario	= document.getElementById("idFuncionario").value;
	var tipoActividad		= document.getElementById("cboTipo").value;
	var fechaInicio			= document.getElementById("txtfec1").value;
	var fechaTermino		= document.getElementById("txtfec2").value;
	var fechaTerminoReal	= document.getElementById("txtFechaTerminoReal").value;
	var ipModifica			= document.getElementById("IpFuncionario").value;
	var usuario				= document.getElementById("usuario").value;
	var parametros = "accion="+accion+"&codActividad="+txtCodigoActividad+"&codUnidad="+unidadFuncionario+"&codigoFuncionario="+codigoFuncionario+"&tipoActividad="+tipoActividad+"&fechaInicio="+fechaInicio+"&fechaTermino="+fechaTermino+"&fechaTerminoReal="+fechaTerminoReal+"&ipModifica="+ipModifica+"&usuario="+usuario;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlActividadFueraCuartel/xmlActualizarActividad.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LA COMISION DE SERVICIO FUE '+accion.substring(0,accion.length-1)+'O CON EXITO EN EL SISTEMA ......        ');
						top.leeFuncionarios(unidadUsuario, '', '');
						idCargaListadoFuncionarios = setInterval("cerrarVentanaActividadFueraCuartel()",1000);
					}
					else alert('LA COMISION DE SERVICIO NO FUE '+accion.substring(0,accion.length-1)+'O EN EL SISTEMA ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}
