var cargaListadoLicencias;
var idCargaListadoLicencias;
function leeLicencia(unidad, campo, sentido){
	cargaListadoLicencias = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoLicencias");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Licencia ......</td>";
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaLicencias.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLLicencias.onreadystatechange=function(){
		//alert(objHttpXMLLicencias.readyState);
		if(objHttpXMLLicencias.readyState == 4){
			//alert(objHttpXMLLicencias.responseText);
			if (objHttpXMLLicencias.responseText != "VACIO"){
				//alert(objHttpXMLLicencias.responseText);
				var xml					= objHttpXMLLicencias.responseXML.documentElement;
				var codigo				= "";
				var nombre				= "";
				var nombre2				= "";
				var nombreCompleto		= "";
				var tipoLicencia		= "";
				var Archivo				= "";
				var Rut					= "";
				var Color				= "";
				var Folio				= "";
				var tipoArchivo			= "NO EXISTEN ARCHIVOS ASOCIADOS ...";
				var LinkConstancia		= "";
				var LinkArchivo			= "";
				var mostrarEtiqueta		= "";
				var fechaInicio			= "";
				var InicioD				= "";
				var fechaTermino		= "";
				var TerminoA			= "";
				var fechaInicioR		= "";
				var fechaTerminoR		= "";
				var InicioVD			= "";
				var TerminoVA			= "";
				var sw					= 0;
				var fondoLinea			= "";
				var resaltarLinea		= "";
				var lineaSinResaltar	= "";
				var listadoLicencias	= "";
				
				listadoLicencias = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('licencia').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre			= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					nombre2			= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					apellidoPaterno	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					nombreCompleto	= apellidoPaterno + " " + apellidoMaterno + ", " + nombre + " " + nombre2;
					tipoLicencia	= (xml.getElementsByTagName('licenciaMedica')[i].text||xml.getElementsByTagName('licenciaMedica')[i].textContent||"");
					Archivo			= (xml.getElementsByTagName('archivo')[i].text||xml.getElementsByTagName('archivo')[i].textContent||"");
					Rut				= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					Color			= (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");
					Folio			= (xml.getElementsByTagName('folio')[i].text||xml.getElementsByTagName('folio')[i].textContent||"");
					fechaInicio		= (xml.getElementsByTagName('fecha_inicio')[i].text||xml.getElementsByTagName('fecha_inicio')[i].textContent||"");
					fechaInicioR	= (xml.getElementsByTagName('fecha_inicio_real')[i].text||xml.getElementsByTagName('fecha_inicio_real')[i].textContent||"");
					fechaTermino	= (xml.getElementsByTagName('fecha_termino')[i].text||xml.getElementsByTagName('fecha_termino')[i].textContent||"");
					fechaTerminoR	= (xml.getElementsByTagName('fecha_termino_real')[i].text||xml.getElementsByTagName('fecha_termino_real')[i].textContent||"");
					InicioVD		= (xml.getElementsByTagName('inicio')[i].text||xml.getElementsByTagName('inicio')[i].textContent||"");
					TerminoVA		= (xml.getElementsByTagName('termino')[i].text||xml.getElementsByTagName('termino')[i].textContent||"");
					
					InicioD = (InicioVD==1) ? " (*)" : "";
					TerminoA= (TerminoVA==1) ? " (*)" : "";
					
					LinkConstancia	 = '<a href="imprimible/servicios/fichaLicencia.php?rutFuncionario='+Rut+'&codColor='+Color+'&codFolio='+Folio+'" target="_blank"> <img src="img/adjunto.jpg" width=15 height=15 ></a>';
					LinkArchivo	 = '<a href="./archivos_licencia/'+Archivo+'" target="_blank"> <img src="img/carpeta.png" width=15 height=15 > </a>';
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('LICENCIA MEDICA ... ', '920', '780','fichaLicencia.php?codigoFuncionario="+codigo+"&codColor="+Color+"&codFolio="+Folio+"','"+nroLinea+"','','5','5')";
					
					listadoLicencias += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoLicencias += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoLicencias += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoLicencias += "<td width='28%'><div id='valorColumna'>"+nombreCompleto+"</div></td>";
					listadoLicencias += "<td width='20%' align='left'><div id='valorColumna'>"+tipoLicencia+"</div></td>";
					listadoLicencias += "<td width='10%' align='center' title='Fecha de inicio original de la licencia: "+fechaInicio+"'>"+fechaInicioR+InicioD+"</div></td>";
					listadoLicencias += "<td width='10%' align='center' title='Fecha de termino original de la licencia: "+fechaTermino+"'>"+fechaTerminoR+TerminoA+"</div></td>";
					listadoLicencias += "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkArchivo+"</div></td>";
					listadoLicencias += "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkConstancia+"</div></td>";
					listadoLicencias += "</tr>";
				}
				listadoLicencias += "</table>";
				div.innerHTML = listadoLicencias;
				cargaListadoLicencias = 1;
			}
		}
	}
}

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";
	if (sentido == "desc") nuevoSentido = "asc";
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	switch(atributo){
		case "codigo":
			leeLicencia(unidad, atributo, sentido);
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColLicencia").innerHTML = "LICENCIA MEDICA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO REAL";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO REAL";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColCodigo").innerHTML = "CODIGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigo").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
		break;
		
		case "nombre":
			leeLicencia(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColLicencia").innerHTML = "LICENCIA MEDICA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO REAL";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO REAL";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColNombre").innerHTML = "NOMBRE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
		break;
		
		case "licencia":
			leeLicencia(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO REAL";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO REAL";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColLicencia").innerHTML = "LICENCIA MEDICA&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colLicencia").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
		break;
		
		case "fechaI":
			leeLicencia(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColLicencia").innerHTML = "LICENCIA MEDICA";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO REAL";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO REAL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFechaI").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
		break;
		
		case "fechaT":
			leeLicencia(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColLicencia").innerHTML = "LICENCIA MEDICA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO REAL";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO REAL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFechaT").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
		break;
		
		case "archivo":
			leeLicencia(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColLicencia").innerHTML = "LICENCIA MEDICA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO REAL";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO REAL";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colArchivo").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
		break;
		
		case "constancia":
			leeLicencia(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColLicencia").innerHTML = "LICENCIA MEDICA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO REAL";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO REAL";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";			
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colConstancia").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
		break;
	}
	idCargaListadoLicencias = setInterval("tituloColumnaNormal("+columna.id+")",500);
}

function tituloColumnaNormal(columna){
	if(cargaListadoLicencias == 1){
		clearInterval(idCargaListadoLicencias);
		cambiarClase(columna,'nombreColumna');
	}
}

function listaFuncionarios(unidad, nombreObjeto, multiple, campo, sentido){
	cargaListadoLicencias = 0;
	document.getElementById(nombreObjeto).length = null;
	if(multiple == false ){
		var datosOpcion = new Option("SELECCIONE FUNCIONARIO ... ", 0, "", "");
		document.getElementById(nombreObjeto).options[0] = datosOpcion;
	}
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlFuncionarios/xmlListaFuncionarios.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("codigoUnidad="+unidad+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLLicencias.onreadystatechange=function(){
		//alert(objHttpXMLLicencias.readyState);
		if(objHttpXMLLicencias.readyState == 4){
			//alert(objHttpXMLLicencias.responseText);
			if (objHttpXMLLicencias.responseText != "VACIO"){
				//alert(objHttpXMLLicencias.responseText);
				var xml					= objHttpXMLLicencias.responseXML.documentElement;
				var codigo				= "";
				var nombre				= "";
				var nombre2				= "";
				var apellidoMaterno		= "";
				var apellidoPaterno		= "";
				var nombreCompleto		= "";
				var grado				= "";
				var cargo				= "";
				var sw					= 0;
				var fondoLinea			= "";
				var listadoLicencias	= "";
				
				listadoLicencias = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre			= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					nombre2			= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					apellidoMaterno	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					apellidoPaterno	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					nombreCompleto	= apellidoPaterno + " " + apellidoMaterno + ", " + nombre + " " + nombre2;
					grado			= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					cargo			= (xml.getElementsByTagName('cargo')[i].text||xml.getElementsByTagName('cargo')[i].textContent||"");
					
					var descripcion = nombreCompleto + " ("+grado+")";
					var puntero;
					if (!multiple) puntero = i+1;
					else puntero = i;
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				}
				cargaListadoLicencias = 1;
			}
		}
	}
}

function mensajeLicencia(){
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var diasSemana = new Array("Domingo","Lunes","Martes","Mi\u00E9rcoles","Jueves","Viernes","S\u00E1bado");
	var f=new Date();
	var fechaHoy	=	diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
	var unidad		=	document.getElementById("unidad").value;
	var fecha		=	document.getElementById("fecha").value;
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlMensajeLicencia.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("unidad="+unidad+"&fecha="+fecha));
	//alert(objHttpXMLLicencias.responseText);
	if (objHttpXMLLicencias.responseText != "VACIO"){
		//alert(objHttpXMLLicencias.responseText);
		var xml = objHttpXMLLicencias.responseXML.documentElement;
		mensaje += "LICENCIAS INGRESADAS: "+fechaHoy.toUpperCase()+"\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var grado		= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
			var nom1		= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
			var nom2		= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
			var ape1		= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
			var ape2		= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
			var licencia	= (xml.getElementsByTagName('licenciaMedica')[i].text||xml.getElementsByTagName('licenciaMedica')[i].textContent||"");
			var codigo		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
			var estado		= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
			var estadoDesc	= "";
			
			if(estado=="2") estadoDesc = " - (ANULADA)";
			mensaje += (i+1) +". " + grado+" "+nom1+" "+nom2+" "+ape1+" "+ape2+" ("+codigo+")"+", TIPO LICENCIA: ("+licencia.toUpperCase()+")"+estadoDesc+".\n";
		}
		if (cantidadServiciosMostar = xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function buscaDatosFuncionario(){
	var codigoFuncionario	= eliminarBlancos(document.getElementById("txtrut").value.toUpperCase());
	if (codigoFuncionario == ""){
		alert("DEBE INDICAR EL RUN DEL FUNCIONARIO ...... 	     ");
		document.getElementById("txtrut").value="";
		document.getElementById("txtrut").focus();
		return false;
	}
	var regExCodigoFun = /^[0-9]{6,6}[A-Z]{1,1}$/;
	var codigoValido = codigoFuncionario.match(regExCodigoFun);
	document.getElementById("btnBuscarFuncionario").value = "BUSCANDO ...";
	document.getElementById("btnBuscarFuncionario").disabled = "true";
	leedatosFuncionario(codigoFuncionario, 1);
}

function leedatosFuncionario(rut, tipo){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var rutsinChar = rut;
	rutsinChar=rutsinChar.replace(".","");
	rutsinChar=rutsinChar.replace(".","");
	rutsinChar=rutsinChar.replace("-","");
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlDatosFuncionarioLicencia.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("rut="+rutsinChar));
	objHttpXMLLicencias.onreadystatechange=function(){
		//alert(objHttpXMLLicencias.readyState);
		if(objHttpXMLLicencias.readyState == 4){
			console.log(objHttpXMLLicencias.responseText);
			if (objHttpXMLLicencias.responseText != "VACIO"){
				//alert(objHttpXMLLicencias.responseText);
				var xml 				= objHttpXMLLicencias.responseXML.documentElement;
				var codigo	 			= "";
				var apellidoPaterno		= "";
				var apellidoMaterno		= "";
				var primerNombre	 	= "";
				var segundoNombre	 	= "";
				var unidadFuncionario	= "";
				var unidadUsuario		= "";
				var rut		  			= "";
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo	 		  	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					unidadAgr	 		= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					apellidoPaterno	  	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno   	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					primerNombre 	  	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					segundoNombre 	  	= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					codigoCargo		  	= (xml.getElementsByTagName('codigoCargo')[i].text||xml.getElementsByTagName('codigoCargo')[i].textContent||"");
					unidadFuncionario	= (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					rut 				= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					unidadUsuario 		= document.getElementById("unidadUsuario").value;
					
					if(unidadFuncionario == "") unidadFuncionario = 1;
					
					if(codigoCargo==3005){
						document.getElementById("mensajeCargando").style.display = "none";
						alert ("EL FUNCIONARIO ESTA AGREGADO A UNA UNIDAD SIN PROSERVIPOl...");
						document.getElementById("txtrut").value = "";
						document.getElementById("txtrut").disabled = false;
						document.getElementById("txtrut").focus();
						return false;
					}
					
					if(unidadAgr==1){
						document.getElementById("mensajeCargando").style.display = "none";
						alert ("EL FUNCIONARIO NO PERTENECE A UNA UNIDAD CON SISTEMA PROSERVIPOL ...");
						document.getElementById("txtrut").value = "";
						document.getElementById("txtrut").disabled = false;
						document.getElementById("txtrut").focus();
						return false;
					}
					else{
						document.getElementById("unidadFuncionario").value	= unidadFuncionario;
					}
					
					document.getElementById("fotoFuncionario").src 		= "./img/sinFoto.png";
					document.getElementById("idFuncionario").value		= codigo;
					document.getElementById("codigoFuncionario").value	= codigo;
					document.getElementById("txtape1").value 			= apellidoPaterno;
					document.getElementById("txtape2").value 			= apellidoMaterno;
					document.getElementById("txtnom").value 	 		= primerNombre+" "+segundoNombre;
											
					if (tipo == "1"){
						document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
						document.getElementById("btnBuscarFuncionario").disabled = "true";
						document.getElementById("mensajeCargando").style.display = "none";
					}
				}
			validaPermiso();
			} else {
				if (document.getElementById("btnBuscarFuncionario").value == "BUSCANDO ..."){
					document.getElementById("mensajeCargando").style.display = "none";
					alert ("NO EXISTE O NO PERTENECE A UNA UNIDAD CON SISTEMA PROSERVIPOL ...");
					document.getElementById("txtrut").value = "";
					document.getElementById("txtrut").disabled = false;
					document.getElementById("txtrut").focus();
				}
				document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
				document.getElementById("btnBuscarFuncionario").disabled = "";
			}
		}
	}
}

function rutUsuario(){
	var objHttpXMLCodigo = new AJAXCrearObjeto();
	objHttpXMLCodigo.open("POST","./xml/xmlLicenciaMedica/xmlrutUsuario.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI());
	objHttpXMLCodigo.onreadystatechange=function(){
		if(objHttpXMLCodigo.readyState == 4){
			//alert(objHttpXMLCodigo.responseText);
			if (objHttpXMLCodigo.responseText != "VACIO"){
				var xml = objHttpXMLCodigo.responseXML.documentElement;
				var rut = "";
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					rut	= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					document.getElementById("rutUsuario").value = rut;
				}
			}
		}
	}
}

function cargaEspecialidades(){
	var objHttpXMLEspecialidades = new AJAXCrearObjeto();
	objHttpXMLEspecialidades.open("POST","./xml/xmlLicenciaMedica/xmlEspecialidades.php",true);
	objHttpXMLEspecialidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEspecialidades.send(encodeURI());
	objHttpXMLEspecialidades.onreadystatechange=function(){
		if(objHttpXMLEspecialidades.readyState == 4){
			//alert(objHttpXMLEspecialidades.responseText);
			if (objHttpXMLEspecialidades.responseText != "VACIO"){
				var xml = objHttpXMLEspecialidades.responseXML.documentElement;
				var cantidad = xml.getElementsByTagName('especialidad').length;
				document.getElementById('cboEspecialidad').length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", "", "", "");
				document.getElementById('cboEspecialidad').options[0] = datosOpcion;
				for(i=0;i<cantidad;i++){
					var codigo = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					var descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById('cboEspecialidad').options[i+1] = datosOpcion;
				}
				cargaCargos = 1;
			}
		}
	}
}

/*Funci�n que habilita el ingreso de la informaci�n del hijo, si es que se elige la opci�n "enfermedad grave hijo menor a un a�o"*/
function hijomenor(){
	var valor = cboLicencia.value;
	if(valor==162){
		document.getElementById("seccion3a").style.display="block";
	}
	else{
		document.getElementById("seccion3a").style.display="none";
	}
}

/*Funci�n que habilita el ingreso de la especialidad del medico, si es que se elije dicha opci�n*/
function especialidad(){
	var medico = document.getElementById("optionMed").checked;
	if(medico){
		document.getElementById("seccion5a").style.display="block";
	}
	else{
		document.getElementById("seccion5a").style.display="none";
	}
}

function leeTipoLicencia(nombreObjeto){
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var color	= document.getElementById("txtcolor").value;
	if(color=="PP" || color=="MP" || color=="PV") return false;
	var objHttpXMLEstado = new AJAXCrearObjeto();
	objHttpXMLEstado.open("POST","./xml/xmlLicenciaMedica/xmlTipoLicencia.php",true);
	objHttpXMLEstado.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstado.send(encodeURI());
	objHttpXMLEstado.onreadystatechange=function(){
		if(objHttpXMLEstado.readyState == 4){
			//alert(objHttpXMLEstado.responseText);
			if (objHttpXMLEstado.responseText != "VACIO"){
				var xml			= objHttpXMLEstado.responseXML.documentElement;
				var codigo		= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 1000, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				
				for(i=0;i<xml.getElementsByTagName('tipo').length;i++){
					codigo		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
			}
		}
	}
}

/*Funci�n que restringe el ingreso a solo n�meros al campo indicado*/   
function solo_num(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
  return true;
}

/*Funci�n que restringe el ingreso a solo letras al campo indicado*/
function solo_char(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode > 48 && charCode < 57)) return false;
  return true;
}

/*Funci�n que restringe el ingreso a solo caracteres permitidos en el RUN como son los n�meros y la letra K*/
function solo_rut(evt){
	var charCode = (evt.which) ? evt.which : evt.keyCode;
  if((charCode < 48 || charCode > 57)&&(charCode != 75 && charCode != 107)) return false;
  return true;
}

/*Funci�n para dar formato de RUN a un campo determinado*/
function formato_rut(rut){
	var sRut1 = rut.value;
	var nPos = 0;
	var sInvertido = "";
	var sRut = "";
	
	for(var i = sRut1.length - 1; i >= 0; i-- ){
    sInvertido += sRut1.charAt(i);
    if (i == sRut1.length - 1 ) sInvertido += "-";
    else if (nPos == 3){
      sInvertido += ".";
      nPos = 0;
    }
    nPos++;
	}
	for(var j = sInvertido.length - 1; j >= 0; j-- ) {
	  if (sInvertido.charAt(sInvertido.length - 1) != ".") sRut += sInvertido.charAt(j);
	  else if (j != sInvertido.length - 1 ) sRut += sInvertido.charAt(j);
	}
	rut.value = sRut.toUpperCase();
	Valida_Rut(rut);
}

/*Funci�n para validar que el RUN ingresado sea valido*/
function Valida_Rut(Objeto){
	var tmpstr = "";
	var intlargo = Objeto.value
	var key=window.event.keyCode;
	
	if (intlargo.length> 0){
		crut = Objeto.value
		largo = crut.length;
		if ( largo <2 ){
			alert('rut inv\u00E1lido')
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

function activarInicioReal(){
	if(document.getElementById("txtfechaI").value!=""){
		document.getElementById("optionInicio").disabled=false;
	}
	else{
		document.getElementById("optionInicio").disabled=true;
	}
	inicioReal();
}

function inicioReal(){
	if(document.getElementById("optionInicio").checked){
		document.getElementById("seccion1a").style.display="block";
		let parts = document.getElementById("txtfechaI").value.split("-");
		let fechaInicio = new Date(parts[2], parts[1]-1, parts[0]);
		let fechaInicioN = new Date(fechaInicio);
		fechaInicioN.setDate(fechaInicioN.getDate() + 1);
		let dia = fechaInicioN.getDate();
		let mes = (fechaInicioN.getMonth()+1);
		let anno = fechaInicioN.getFullYear();
		if(dia.toString().length==1)dia="0"+dia.toString();
		if(mes.toString().length==1)mes="0"+mes.toString();
		let fechaI = dia+"-"+ mes +"-"+anno;
		document.getElementById("fechaInicioReal").value= fechaI;
	}
	else{
		document.getElementById("seccion1a").style.display="none";
		document.getElementById("fechaInicioReal").value="";
	}
}

/* Resoluci�n comisi�n medica - Permiso parental - RELA*/
function validaPermiso(){
	var color = document.getElementById("Listcolor").value;
	var rut = document.getElementById("txtrut").value;
	var folio = document.getElementById("txtfolio").value;
	var unidad = document.getElementById("unidadFuncionario").value;
	
	switch(color){
		case "PP":
			if(unidad==""){
				document.getElementById("Listcolor").value = "";
				alert('DEBE INGRESAR RUT DEL FUNCIONARIO ANTES DE ELEGIR EL TIPO DE LICENCIA');
			}
			else{
				document.getElementById('seccion5').style.display="none";
				document.getElementById('seccion4').style.display="none";
				document.getElementById('seccion3').style.display="none";
				document.getElementById('txtfolio').style.display="none";
				document.getElementById('seccionMensaje').style.display="block";
				document.getElementById("Mensaje").innerHTML = "(*) El permiso postnatal parental, no se trata de una licencia m\u00E9dica, pero se podr\u00E1 ingresar dentro de este m\u00F3dulo para facilitar su registro y mantener un control del mismo.";
				correlativoPermisoParental();
			}
		break;
		case "PV":
			if(unidad==""){
				document.getElementById("Listcolor").value = "";
				alert('DEBE INGRESAR RUT DEL FUNCIONARIO ANTES DE ELEGIR EL TIPO DE LICENCIA');
			}
			else{
				document.getElementById('seccion5').style.display="none";
				document.getElementById('seccion4').style.display="none";
				document.getElementById('seccion3').style.display="none";
				document.getElementById('txtfolio').style.display="none";
				document.getElementById('seccionMensaje').style.display="block";
				document.getElementById("Mensaje").innerHTML = "(*) El permiso parental preventivo, no se trata de una licencia m\u00E9dica, pero se podr\u00E1 ingresar dentro de este m\u00F3dulo para facilitar su registro y mantener un control del mismo.";
				correlativoPermisoParentalPreventivo();
			}
		break;
		case "MP":
			document.getElementById("txtfolio").value = "";
			document.getElementById('seccion5').style.display="none";
			document.getElementById('seccion4').style.display="none";
			document.getElementById('seccion3').style.display="none";
			document.getElementById('seccionMensaje').style.display="block";
			document.getElementById("Mensaje").innerHTML = "(*) El reposo indicado por medicina preventiva, deber\u00E1 ingresarse a trav\u00E9s de este m\u00F3dulo, ya que para efectos de registro ser\u00E1 tratada como una licencia m\u00E9dica.";
			document.getElementById('txtfolio').style.display="block";
		break;
		case "RL":
			document.getElementById('seccion3').style.display="none";
			document.getElementById('seccion4').style.display="none";
			document.getElementById('seccion5a').style.display="none";
			document.getElementById('seccion5b').style.display="none";
			document.getElementById('seccion5c').style.display="none";
			document.getElementById('seccionMensaje').style.display="block";
			document.getElementById('txtfolio').style.display="block";
			document.getElementById("Mensaje").innerHTML = "(*) Orden de reposo por contacto estrecho Covid-19 Laboral.";
		break;
		default:
			document.getElementById('seccionMensaje').style.display="none";
			document.getElementById("Mensaje").innerHTML = "";
			document.getElementById('seccion5').style.display="block";
			document.getElementById('seccion5a').style.display="block";
			document.getElementById('seccion5b').style.display="block";
			document.getElementById('seccion5c').style.display="block";
			document.getElementById('seccion4').style.display="block";
			document.getElementById('seccion3').style.display="block";
			document.getElementById('txtfolio').style.display="block";
		break;
	}
	
	if(folio.substr(0,unidad.length)==unidad){
		document.getElementById("txtfolio").value = "";
		document.getElementById('archivo').disabled = true;
	}
	else{
		document.getElementById('txtfolio').disabled = false;
		if(rut != '' && color != '' && folio != 0){
			document.getElementById('archivo').disabled = false;
		}
		else{
			document.getElementById('archivo').disabled = true;
		}
	}
}

function correlativoPermisoParental(){
	var unidadFuncionario = document.getElementById("unidadFuncionario").value;
	var parametros = "unidad="+unidadFuncionario;
	var objHttpXMLPermisoParental = new AJAXCrearObjeto();
	objHttpXMLPermisoParental.open("POST","./xml/xmlLicenciaMedica/xmlCorrelativoPermisoParental.php",true);
	objHttpXMLPermisoParental.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLPermisoParental.send(encodeURI(parametros));
	objHttpXMLPermisoParental.onreadystatechange=function(){
		//console.log(objHttpXMLPermisoParental.responseText);
		if(objHttpXMLPermisoParental.readyState == 4){
			if (objHttpXMLPermisoParental.responseText != "VACIO") {
				var xml = objHttpXMLPermisoParental.responseXML.documentElement;
				var correlativo = (xml.getElementsByTagName('ultimoCorrelativo')[0].text||xml.getElementsByTagName('ultimoCorrelativo')[0].textContent||"");
				document.getElementById("txtfolio").value = unidadFuncionario+"00"+correlativo;
				validarSubir();
			}
		}
	}
}

function correlativoPermisoParentalPreventivo(){
	var unidadFuncionario = document.getElementById("unidadFuncionario").value;
	var parametros = "unidad="+unidadFuncionario;
	var objHttpXMLPermisoParental = new AJAXCrearObjeto();
	objHttpXMLPermisoParental.open("POST","./xml/xmlLicenciaMedica/xmlCorrelativoPermisoParentalPreventivo.php",true);
	objHttpXMLPermisoParental.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLPermisoParental.send(encodeURI(parametros));
	objHttpXMLPermisoParental.onreadystatechange=function(){
		//alert(objHttpXMLPermisoParental.responseText);
		if(objHttpXMLPermisoParental.readyState == 4){
			if (objHttpXMLPermisoParental.responseText != "VACIO") {
				var xml = objHttpXMLPermisoParental.responseXML.documentElement;
				var correlativo = (xml.getElementsByTagName('ultimoCorrelativo')[0].text||xml.getElementsByTagName('ultimoCorrelativo')[0].textContent||"");
				document.getElementById("txtfolio").value = unidadFuncionario+"00"+correlativo;
				validarSubir();
			}
		}
	}
}

/*Funci�n para validar si se ingresaron los datos necesarios para subir el archivo*/
function validarSubir(){
	var rut		= document.getElementById('txtrut').value;
	var color	= document.getElementById('Listcolor').value;
	var folio	= document.getElementById('txtfolio').value;
	var fecha	= new Date();
	
	if(rut != '' && color != '' && folio != 0){
		document.getElementById('archivo').disabled = false;
	}
	else{
		document.getElementById('archivo').disabled = true;
	}
	
	if(color == "MP" && folio != 0){
		document.getElementById('txtfolio').value = fecha.getFullYear()+folio;
		document.getElementById('txtfolio').disabled = true;
	}
	else{
		document.getElementById('txtfolio').disabled = false;
	}
}

function buscaDatosFichaLicencia(){	
	var codFuncionario	= eliminarBlancos(document.getElementById("codigoFuncionario").value.toUpperCase());
	if(codFuncionario!=""){
		var CodColor	= eliminarBlancos(document.getElementById("txtcolor").value.toUpperCase());
		var codFolio	= eliminarBlancos(document.getElementById("txtfolio").value.toUpperCase());
		document.getElementById("Listcolor").value = CodColor;
		leedatosFicha(codFuncionario,CodColor,codFolio);
	}
}

function leedatosFicha(codFuncionario,CodColor,codFolio){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlDatosFichaLicencia.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("codFuncionario="+codFuncionario+"&color="+CodColor+"&folio="+codFolio));
	objHttpXMLLicencias.onreadystatechange=function(){
		//alert(objHttpXMLLicencias.readyState);
		if(objHttpXMLLicencias.readyState == 4){
			//alert(objHttpXMLLicencias.responseText);
			if (objHttpXMLLicencias.responseText != "VACIO"){
				//alert(objHttpXMLLicencias.responseText);
				var xml				= objHttpXMLLicencias.responseXML.documentElement;
				var codigo			= "";
				var apellidoPaterno	= "";
				var apellidoMaterno	= "";
				var primerNombre	= "";
				var segundoNombre	= "";
				var rut				= "";
				var fechaO			= "";
				var fechaI			= "";
				var dias			= "";
				var tipoLicencia	= "";
				var recuperacion	= "";
				var invalidez		= "";
				var tipoReposo		= "";
				var lugarReposo		= "";
				var rutProfesional	= "";
				var tipoProfesional	= "";
				var especialidad	= "";
				var tipoAtencion	= "";
				var rutHijo			= "";
				var fechaHijo		= "";
				var archivo			= "";
				var fechaTermino	= "";
				var unidad			= "";
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					apellidoPaterno	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					primerNombre	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					segundoNombre	= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					rut				= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					fechaO			= (xml.getElementsByTagName('fechaO')[i].text||xml.getElementsByTagName('fechaO')[i].textContent||"");
					fechaI			= (xml.getElementsByTagName('fechaI')[i].text||xml.getElementsByTagName('fechaI')[i].textContent||"");
					dias			= (xml.getElementsByTagName('dias')[i].text||xml.getElementsByTagName('dias')[i].textContent||"");
					fechaIR			= (xml.getElementsByTagName('fechaIR')[i].text||xml.getElementsByTagName('fechaIR')[i].textContent||"");
					fechaTR			= (xml.getElementsByTagName('fechaTR')[i].text||xml.getElementsByTagName('fechaTR')[i].textContent||"");
					tipoLicencia	= (xml.getElementsByTagName('tipoLicencia')[i].text||xml.getElementsByTagName('tipoLicencia')[i].textContent||"");
					recuperacion	= (xml.getElementsByTagName('recuperacion')[i].text||xml.getElementsByTagName('recuperacion')[i].textContent||"");
					invalidez		= (xml.getElementsByTagName('invalidez')[i].text||xml.getElementsByTagName('invalidez')[i].textContent||"");
					tipoReposo		= (xml.getElementsByTagName('tipoReposo')[i].text||xml.getElementsByTagName('tipoReposo')[i].textContent||"");
					lugarReposo		= (xml.getElementsByTagName('lugarReposo')[i].text||xml.getElementsByTagName('lugarReposo')[i].textContent||"");
					rutProfesional	= (xml.getElementsByTagName('rutProfesional')[i].text||xml.getElementsByTagName('rutProfesional')[i].textContent||"");
					tipoProfesional	= (xml.getElementsByTagName('tipoProfesional')[i].text||xml.getElementsByTagName('tipoProfesional')[i].textContent||"");
					especialidad	= (xml.getElementsByTagName('especialidad')[i].text||xml.getElementsByTagName('especialidad')[i].textContent||"");
					tipoAtencion	= (xml.getElementsByTagName('tipoAtencion')[i].text||xml.getElementsByTagName('tipoAtencion')[i].textContent||"");
					rutHijo			= (xml.getElementsByTagName('rutHijo')[i].text||xml.getElementsByTagName('rutHijo')[i].textContent||"");
					fechaHijo		= (xml.getElementsByTagName('fechaHijo')[i].text||xml.getElementsByTagName('fechaHijo')[i].textContent||"");
					archivo			= (xml.getElementsByTagName('archivo')[i].text||xml.getElementsByTagName('archivo')[i].textContent||"");
					fechaTermino	= (xml.getElementsByTagName('fechaTerminoInicial')[i].text||xml.getElementsByTagName('fechaTerminoInicial')[i].textContent||"");
					unidad			= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					
					document.getElementById("fotoFuncionario").src		= "./img/sinFoto.png"; /* "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg"; */
					document.getElementById("idFuncionario").value		= codigo;
					document.getElementById("txtrut").value				= rut;
					document.getElementById("txtape1").value			= apellidoPaterno;
					document.getElementById("txtape2").value			= apellidoMaterno;
					document.getElementById("txtnom").value				= primerNombre+" "+segundoNombre;
					document.getElementById("txtfechaO").value			= fechaO;
					document.getElementById("txtfechaI").value			= fechaI;
					document.getElementById("fechaInicioReal").value	= fechaIR;
					document.getElementById("fechaTerminoReal").value	= fechaTR;
					document.getElementById("txtdias").value			= dias;
					
					switch(CodColor){
						case "PP":
							document.getElementById('seccion3').style.display		="none";
							document.getElementById("seccion3a").style.display		="none";
							document.getElementById('seccion4').style.display		="none";
							document.getElementById('seccion5').style.display		="none";
							document.getElementById('seccionMensaje').style.display	="block";
							document.getElementById("Mensaje").innerHTML			= "(*) El permiso postnatal parental, no se trata de una licencia m\u00E9dica, pero se podr\u00E1 ingresar dentro de este m\u00F3dulo para facilitar su registro y mantener un control del mismo.";
						break;
						case "PV":
							document.getElementById('seccion3').style.display		="none";
							document.getElementById("seccion3a").style.display		="none";
							document.getElementById('seccion4').style.display		="none";
							document.getElementById('seccion5').style.display		="none";
							document.getElementById('seccionMensaje').style.display	="block";
							document.getElementById("Mensaje").innerHTML			= "(*) El permiso parental preventivo, no se trata de una licencia m\u00E9dica, pero se podr\u00E1 ingresar dentro de este m\u00F3dulo para facilitar su registro y mantener un control del mismo.";
						break;
						case "MP":
							document.getElementById('seccion3').style.display		="none";
							document.getElementById("seccion3a").style.display		="none";
							document.getElementById('seccion4').style.display		="none";
							document.getElementById('seccion5').style.display		="none";
							document.getElementById('seccionMensaje').style.display	="block";
							document.getElementById("Mensaje").innerHTML			= "(*) El reposo indicado por medicina preventiva, deber\u00E1 ingresarse a trav\u00E9s de este m\u00F3dulo, ya que para efectos de registro ser\u00E1 tratada como una licencia m\u00E9dica.";
						break;
						case "RL":
							document.getElementById('seccion3').style.display		= "none";
							document.getElementById('seccion3a').style.display		= "none";
							document.getElementById('seccion4').style.display		= "none";
							document.getElementById('seccion5a').style.display		= "none";
							document.getElementById('seccion5b').style.display		= "none";
							document.getElementById('seccion5c').style.display		= "none";
							document.getElementById("txtrutp").value				= rutProfesional;
							document.getElementById('seccionMensaje').style.display	= "block";
							document.getElementById('txtfolio').style.display		= "block";
							document.getElementById("Mensaje").innerHTML			= "(*) Orden de reposo por contacto estrecho Covid-19 Laboral.";
						break;
						default:
							document.getElementById('optionRecup'+recuperacion).checked		= "checked";
							document.getElementById('optionInvalidez'+invalidez).checked	= "checked";
							document.getElementById('txtruth').value						= rutHijo;
							document.getElementById('txtfec3').value						= fechaHijo;
							document.getElementById('cboReposo').value						= tipoReposo;
							document.getElementById('optionReposo'+lugarReposo).checked		= "checked";
							document.getElementById("txtrutp").value						= rutProfesional;
							document.getElementById('cboEspecialidad').value				= especialidad;
							document.getElementById('optionMed'+tipoProfesional).checked	= "checked";
							document.getElementById('optionAte'+tipoAtencion).checked		= "checked";
						break;
					}
					
					document.getElementById("txtarchivo").value				= archivo;
					document.getElementById("servicio").value				= tipoLicencia;
					document.getElementById('cboLicencia').value			= tipoLicencia;
					document.getElementById("textFechaTermino").value		= fechaTermino;
					document.getElementById("fechaTerminoInicial").value	= fechaTermino;
					document.getElementById("unidadFuncionario").value		= unidad;
					
					if(document.getElementById('optionMed1').checked){
						document.getElementById("seccion5a").style.display="block";
					}
					
					document.getElementById("mensajeCargando").style.display = "none";
				}
			}
		}
	}
}

/*Funci�n para subir el archivo digital al servidor, con formato RUN+"-"+COLORLICENCIA+" "+FOLIOLICENCIA */
function subirArchivo(boton){
	var rutaArchivo				= document.getElementById("archivo").value;
	var arrayRutaArchivo		= rutaArchivo.split("\\");
	var cantidadArreglo			= arrayRutaArchivo.length;
	var nombreDelArchivo		= arrayRutaArchivo[cantidadArreglo-1];
	var archivoServidor			=	document.getElementById("archivoServidor").value;
	var extension				= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toUpperCase();
	var extensiones_permitidas	= new Array(".JPG", ".JPEG", ".PNG", ".PDF");
	var noaceptada				= true;
	var rutsinchar				= document.getElementById("txtrut").value;
	var folioColor				= document.getElementById("Listcolor").value+document.getElementById("txtfolio").value;
	
	for(var i = 0; i < extensiones_permitidas.length; i++){
		if(extensiones_permitidas[i] == extension){
			noaceptada = false;
		}
	}
	
	if(noaceptada){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO JPG, JPEG, PNG O PDF");
		return false;
	}
	
	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace("-","");
	
	rutaArchivo = rutsinchar+"-"+folioColor+extension;
	
	if(rutsinchar == archivoServidor){
		alert("EL DOCUMENTO YA EXISTE");
		return false;
	}
	
	document.getElementById("rutArchi").value = rutaArchivo;
	document.formSubeArchivo.submit();
	
	boton.disabled = true;
	document.getElementById("archivo").disabled = true;
	document.getElementById("archivoLoad").value=1;
}

function guardarFichaLicencia(){
	var codigoFuncionario = document.getElementById("idFuncionario").value;
	var fechaInicio = document.getElementById("txtfechaI").value;
	var dias = document.getElementById("txtdias").value;
	var arrayAux = fechaInicio.split("-");
	var fechaTFDate = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0],01,00,00);
	if(dias.substr(0,1)=="0")dias = dias.substr(1,1);
	dias = parseInt(dias);
	fechaTFDate.setDate(fechaTFDate.getDate() + dias-1);
	var dia = fechaTFDate.getDate();
	var mes = (fechaTFDate.getMonth()+1);
	var ano = fechaTFDate.getFullYear();
	if(dia.toString().length==1)dia="0"+dia.toString();
	if(mes.toString().length==1)mes="0"+mes.toString();
	var fechaTermino = dia+"-"+ mes +"-"+ano;
	document.getElementById("textFechaTermino").value = fechaTermino;
	if(validarLicenciaMedica()){
		if(confirm("ATENCI\u00D3N :\nSE INGRESAR\u00C1N LOS DATOS DE ESTA LICENCIA AL SISTEMA, \n COMO TAMBIEN SE ELIMINAR\u00C1N LAS LICENCIAS M\u00C9DICAS PENDIENTES ASIGNADAS SI LAS TUVIERA     \n\u00BFDESEA CONTINUAR?")){
			//if(verificaServicioLicenciaTemporal()) return false;
			nuevaLicencia();
		} else {
			return false;
		}
		document.getElementById('btnGuardarLicencia').value = "GUARDANDO ...";
		document.getElementById("mensajeGuardando").style.display = "";
		document.getElementById("mensajeGuardando").style.left = "170px";
		document.getElementById("mensajeGuardando").style.top  = "200px";
	}
}

function verificaServicioLicenciaTemporal(){
	var codFuncionario	= document.getElementById("codigoFuncionario").value;
	var fechaIR			= document.getElementById("fechaInicioReal").value;
	var fechaTR			= document.getElementById("textFechaTermino").value;
	var fechaI			= document.getElementById("txtfechaI").value;
	if(fechaIR=="") fechaIR = fechaI;
	var mensaje = "";
	var objHttpXMLPendiente = new AJAXCrearObjeto();
	objHttpXMLPendiente.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaPendiente.php",false);
	objHttpXMLPendiente.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLPendiente.send(encodeURI("funcionario="+codFuncionario+"&fechaIR="+fechaIR+"&fechaTR="+fechaTR));
	//alert(objHttpXMLPendiente.responseText);
	if(objHttpXMLPendiente.responseText != "VACIO"){
		var xml = objHttpXMLPendiente.responseXML.documentElement;
		mensaje += "TIENE LAS SIGUIENTES LICENCIAS M\u00C9DICAS PENDIENTES ASIGNADAS:\n\n";
		let correlativos = "";
		let unidades = "";
		if(xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var codUnidad	= (xml.getElementsByTagName('codUnidad')[i].text||xml.getElementsByTagName('codUnidad')[i].textContent||"");
			var unidad		= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			var correlativo	= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
			
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
			correlativos += correlativo+",";
			unidades += codUnidad+",";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		if (confirm(mensaje+"\nSE SOBREESCRIBIR\u00C1N LAS LICENCIAS M\u00C9DICAS PENDIENTES POR LA LICENCIA INDICADA.          \n\u00BFDESEA CONTINUAR?")){
			correlativos 	= correlativos.substring(0,correlativos.length-1);
			unidades 			= unidades.substring(0,unidades.length-1);
			borrarLicenciaPendiente(correlativos, unidades);
			return false;
		}
		return true;
	}
	return false;
}

function borrarLicenciaPendiente(correlativo, codUnidad){
	var codFuncionario	= document.getElementById("codigoFuncionario").value;
	var parametros = "funcionario="+codFuncionario+"&correlativo="+correlativo+"&unidad="+codUnidad;
	var objHttpXMLPendiente = new AJAXCrearObjeto();
	objHttpXMLPendiente.open("POST","./xml/xmlLicenciaMedica/xmlBorrarLicenciaPendiente.php",true);
	objHttpXMLPendiente.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLPendiente.send(encodeURI(parametros));
	objHttpXMLPendiente.onreadystatechange=function(){
		if(objHttpXMLPendiente.readyState == 4){
			//alert(objHttpXMLPendiente.responseText);
			if (objHttpXMLPendiente.responseText != "VACIO"){
				var xml = objHttpXMLPendiente.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo != 1){
						alert('LAS LICENCIAS PENDIENTES NO PUDIERON SER BORRADAS DEL SISTEMA ....		\nCODIGO RECIBIDO : ' + codigo);
						return 0;
					}
				return 1;
				}
			}
		}
	}
}

function nuevaLicencia(){
	var unidadUsuario		= document.getElementById("unidadUsuario").value;
	var unidadFuncionario	= document.getElementById("unidadFuncionario").value;
	if(unidadFuncionario == "") unidadFuncionario = 1;
	var rutsinchar = document.getElementById("txtrut").value;
	var color = document.getElementById("Listcolor").value;
	var folio = document.getElementById("txtfolio").value;
	var fechaO = document.getElementById("txtfechaO").value;
	var fechaI = document.getElementById("txtfechaI").value;
	var dias = document.getElementById("txtdias").value;
	var archivo = document.getElementById("rutArchi").value;
	var ip = document.getElementById("IpFuncionario").value;
	var fechaReal = document.getElementById("fechaInicioReal").value;
	if(fechaReal=="") fechaReal = fechaI;
	var codigoFuncionario = document.getElementById("codigoFuncionario").value;
	var fechaTermino = document.getElementById("textFechaTermino").value;
	var fechaRegistro= document.getElementById("fecha").value;
	
	switch(color){
		case "PP":
			var rutHijo = "";
			var fecha3 = "";
			var tipoLicencia = "713";
			var tipoReposo = "1";
			var rutProfesional = "11.111.111-1";
			var especialidad = "";
			var recuperacion = "1";
			var invalidez = "2";
			var lugarReposo = "1";
			var tipoProfesional = "4";
			var atencion = "1";
		break;
		case "PV":
			var rutHijo = "";
			var fecha3 = "";
			var tipoLicencia = "863";
			var tipoReposo = "1";
			var rutProfesional = "11.111.111-1";
			var especialidad = "";
			var recuperacion = "1";
			var invalidez = "2";
			var lugarReposo = "1";
			var tipoProfesional = "4";
			var atencion = "1";
		break;
		case "MP":
				var rutHijo = "";
			var fecha3 = "";
			var tipoLicencia = "632";
			var tipoReposo = "1";
			var rutProfesional = "11.111.111-1";
			var especialidad = "";
			var recuperacion = "1";
			var invalidez = "2";
			var lugarReposo = "1";
			var tipoProfesional = "4";
			var atencion = "1";
		break;
		case "RL":
			var rutHijo = "";
			var fecha3 = "";
			var tipoLicencia = "860";
			var tipoReposo = "1";
			var especialidad = "11";
			var recuperacion = "1";
			var invalidez = "2";
			var lugarReposo = "1";
			var tipoProfesional = "1";
			var atencion = "1";
			var rutProfesional = document.getElementById("txtrutp").value;
		break;
		default:
			var rutHijo = document.getElementById("txtruth").value;
			var fecha3 = document.getElementById("txtfec3").value;
			var tipoLicencia = document.getElementById("cboLicencia").value;
			var tipoReposo = document.getElementById("cboReposo").value;
			var rutProfesional = document.getElementById("txtrutp").value;
			var especialidad = document.getElementById("cboEspecialidad").value;
			var recuperacion = "";
			var Lrecuperacion = document.getElementsByName("optionRecup");
			for(var i=0;i<Lrecuperacion.length;i++){
				if(Lrecuperacion[i].checked) recuperacion=Lrecuperacion[i].value;
			}
			
			var invalidez = "";
			var Linvalidez = document.getElementsByName("optionInvalidez");
			for(var i=0;i<Linvalidez.length;i++){
				if(Linvalidez[i].checked) invalidez=Linvalidez[i].value;
			}
			
			var lugarReposo = "";
			var LlugarReposo = document.getElementsByName("optionReposo");
			for(var i=0;i<LlugarReposo.length;i++){
				if(LlugarReposo[i].checked) lugarReposo=LlugarReposo[i].value;
			}
			
			var tipoProfesional = "";
			var LtipoProfesional = document.getElementsByName("optionMed");
			for(var i=0;i<LtipoProfesional.length;i++){
				if(LtipoProfesional[i].checked) tipoProfesional=LtipoProfesional[i].value;
			}
			
			var atencion = "";
			var Latencion = document.getElementsByName("optionAte");
			for(var i=0;i<Latencion.length;i++){
				if(Latencion[i].checked) atencion=Latencion[i].value;
			}
		break;
	}
	
	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace("-","");
	
	rutHijo=rutHijo.replace(".","");
	rutHijo=rutHijo.replace(".","");
	rutHijo=rutHijo.replace("-","");
	
	rutProfesional=rutProfesional.replace(".","");
	rutProfesional=rutProfesional.replace(".","");
	rutProfesional=rutProfesional.replace("-","");
	
	var fechaT = fechaTermino;
	sFecha = fechaT || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
	sep = sFecha.indexOf('/') != -1 ? '/' : '-';
	aFecha = sFecha.split(sep);
	fechaT = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
	fechaT = new Date(fechaT);
	
	var parametros = "";
	parametros += "rut="+rutsinchar+"&color="+color+"&folio="+folio+"&fechaO="+fechaO+"&fechaI="+fechaI+"&dias="+dias;
	parametros += "&rutHijo="+rutHijo+"&fecha3="+fecha3+"&tipoLicencia="+tipoLicencia+"&recuperacion="+recuperacion;
	parametros += "&invalidez="+invalidez+"&tipoReposo="+tipoReposo+"&lugarReposo="+lugarReposo+"&rutProfesional="+rutProfesional+"&codigoFuncionario="+codigoFuncionario+"&fechaRegistro="+fechaRegistro;
	parametros += "&especialidad="+especialidad+"&tipoProfesional="+tipoProfesional+"&atencion="+atencion+"&ip="+ip+"&unidadFuncionario="+unidadFuncionario+"&archivo="+archivo+"&fechaReal="+fechaReal+"&fechaTermino="+fechaTermino;
	//alert(parametros);
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlNuevaLicencia.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI(parametros));
	objHttpXMLLicencias.onreadystatechange=function(){
		 //alert(objHttpXMLLicencias.readyState);
		if(objHttpXMLLicencias.readyState == 4){
			//alert(objHttpXMLLicencias.responseText);
			if (objHttpXMLLicencias.responseText != "VACIO"){
			//console.log(objHttpXMLLicencias.responseText);
				var xml = objHttpXMLLicencias.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						top.leeLicencia(unidadUsuario, '', '');
						idCargaListadoLicencias = setInterval("cerrarVentanaLicencia()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function cerrarVentanaLicencia(){
	if(top.cargaListadoLicencias == 1){
		clearInterval(idCargaListadoLicencias);
		top.cerrarVentana();
	}
}

function controlServicioLicencia(funcionario,fecha1,fecha2){
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaServiciosPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("codigoFuncionario="+funcionario+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//alert(objHttpXMLLicencias.responseText);
	if(objHttpXMLLicencias.responseText != "VACIO"){
		var xml = objHttpXMLLicencias.responseXML.documentElement;
		mensaje += "NO PUEDE INGRESAR LICENCIA PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if(xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 	 = (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio = (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad 	 = (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if(cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function verificaExisteValidacion(tipoTexto,tipo){
	var unidad	= document.getElementById("unidadFuncionario").value;
	var codigoFuncionario = document.getElementById("idFuncionario").value;
	var fecha1	= document.getElementById("fechaInicioReal").value;
	var fecha2	= document.getElementById("textFechaTermino").value;
	var fechaI	= document.getElementById("txtfechaI").value;
	var fechaT	= "";
	var fechaL 	= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada	= top.document.getElementById("textUnidadBloqueada").value;
	
	if(document.body.contains(document.getElementById("txtfecF"))) var fechaT	= document.getElementById("txtfecF").value;
	if(fecha1=="")fecha1=fechaI;
	if(fechaT!="")fecha2=fechaT;
	
	var parts = fecha1.split("-");
	var fechaInicio = new Date(parts[2], parts[1]-1, parts[0]);
	
	var parts = fecha2.split("-");
	var fechaTermino = new Date(parts[2], parts[1]-1, parts[0]);
	
	parts = fechaL.split("-");
	var fechaLimite = new Date(parts[2], parts[1]-1, parts[0]);
	
	if((fechaInicio<fechaLimite)&&tipo=="guardar" && unidadBloqueada==1){
		alert("NO SE PUEDE INGRESAR "+tipoTexto+" CONTENIDA EN UN MES CERRADO");
		return true;
	}

	fechaLimite.setDate(fechaLimite.getDate() - 1);
	if(fechaTermino<fechaLimite && unidadBloqueada==1){
		alert("NO PUEDE "+tipo.toUpperCase()+" PORQUE "+tipoTexto+" ESTA CONTENIDA EN UN MES CERRADO");
		return true;
	}
	
	if(tipo=="recortar"){
		fecha1 = fecha2;
		fecha2 = "01-01-2500";
		fechaTermino.setDate(fechaTermino.getDate() + 1);
		let dia = fechaTermino.getDate();
		let mes = (fechaTermino.getMonth()+1);
		let anno = fechaTermino.getFullYear();
		if(dia.toString().length==1)dia="0"+dia.toString();
		if(mes.toString().length==1)mes="0"+mes.toString();
		fecha1 = dia+"-"+ mes +"-"+anno;
	}
	else{
		fecha2 = document.getElementById("textFechaTermino").value;
	}
	/*---Restricci�n de guardar servicios de licencia para d�as validados---*/
	/*---------------------------------------------------------------------------------------------*/
	var mensaje="";
	var cantidadDiasMostrar = 0;
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();
	objHttpXMLFechaValidacion.open("POST","./xml/xmlLicenciaMedica/xmlControlValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFechaValidacion.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//console.log(objHttpXMLFechaValidacion.responseText);
	if(objHttpXMLFechaValidacion.responseText != "VACIO"&&tipo!="guardar"){
		var xml = objHttpXMLFechaValidacion.responseXML.documentElement;
		mensaje += "NO PUEDE "+tipo.toUpperCase()+" "+tipoTexto+" PORQUE ESTE FUNCIONARIO TIENE LOS SIGUIENTES DIAS VALIDADOS:\n\n";
		var cantidadDiasMostrar = (xml.getElementsByTagName('servicio').length > 10) ? 10 : xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadDiasMostrar;i++){
			var fecha = (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var unidad = (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
			mensaje += "* FECHA: "+fecha+" -> "+unidad+"\n";
		}
		alert(mensaje);
	return true;
	}
	/*---------------------------------------------------------------------------------------------*/
	return false;
}

/*Funci�n para validar el ingreso de los datos de la ficha*/
function validarLicenciaMedica(){
	var color			= eliminarBlancos(document.getElementById("Listcolor").value);
	var folio			= document.getElementById("txtfolio").value;
	var rut				= eliminarBlancos(document.getElementById("txtrut").value);
	var fechaOto		= document.getElementById("txtfechaO").value;
	var fechaInicio		= document.getElementById("txtfechaI").value;
	var dias			= document.getElementById("txtdias").value;
	var licencia		= document.getElementById("cboLicencia").value;
	var reposo			= document.getElementById("cboReposo").value;
	var rutMedico		= eliminarBlancos(document.getElementById("txtrutp").value);
	var especialidad	= document.getElementById("cboEspecialidad").value;
	var tprofesional	= document.getElementById("optionMed").checked;
	var archivo			= document.getElementById("archivo").value;
	var archivoLoad		= document.getElementById("archivoLoad").value;
	var rutHijo			= eliminarBlancos(document.getElementById("txtruth").value);
	var fechaHijo		= document.getElementById("txtfec3").value;
	var fechaHoy		= new Date();
	fechaHoy.setDate(fechaHoy.getDate() + 9);
	
	if (rut == "") {
		alert("DEBE INDICAR RUT ...... 	     ");
		document.getElementById("txtrut").focus();
		return false;
	}
	
	var tipoTexto = "";
	switch(color){
		case "PP":
			tipoTexto = "EL PERMISO";
		break;
		case "PV":
			tipoTexto = "EL PERMISO";
		break;
		case "MP":
			tipoTexto = "LA RESOLUCI\u00D3N";
		break;
		case "RL":
			tipoTexto = "LA ORDEN";
		break;
		default:
			tipoTexto = "LA LICENCIA";
		break;
	}
	
	if (color == "") {
		alert("DEBE INDICAR EL TIPO DE "+tipoTexto+" ...... 	     ");
		document.getElementById("Listcolor").focus();
		return false;
	}
	
	if (folio == "") {
		alert("DEBE INGRESAR EL FOLIO DE "+tipoTexto+"  ...... 	     ");
		document.getElementById("txtfolio").focus();
		return false;
	}
	
	if (fechaOto == 0) {
		alert("DEBE INDICAR LA FECHA DE OTORGAMIENTO  ...... 	     ");
		document.getElementById("txtfechaO").focus();
		return false;
	}
	
	if (fechaInicio == 0) {
		alert("DEBE INDICAR LA FECHA DE REPOSO  ...... 	     ");
		document.getElementById("txtfechaI").focus();
		return false;
	}
	
	if (dias == 0) {
		alert("DEBE INGRESAR LA CANTIDAD DE DIAS DE "+tipoTexto+"  ...... 	     ");
		document.getElementById("txtdias").focus();
		return false;
	}
	
	var parts = fechaInicio.split("-");
	fechaInicio = new Date(parts[2], parts[1]-1, parts[0]);

	if((color != "PP") && (color != "PV") && (color != "MP") && (color != "RL")){
		
		if(licencia==162){
			if (rutHijo == "") {
				alert("DEBE INDICAR RUT DEL HIJO ...... 	     ");
				document.getElementById("txtruth").focus();
				return false;
			}
			
			if (fechaHijo == 0) {
				alert("DEBE INDICAR LA FECHA DE NACIMIENTO ...... 	     ");
				document.getElementById("txtfec3").focus();
				return false;
			}
		}
  	
		if (licencia == 0) {
			alert("DEBE SELECCIONAR UN TIPO DE LICENCIA ...... 	     ");
			document.getElementById("cboLicencia").focus();
			return false;
		}
		
		if (reposo == 0) {
			alert("DEBE SELECCIONAR LA CARACTERISTICA DEL REPOSO ...... 	     ");
			document.getElementById("cboReposo").focus();
			return false;
		}
				
		if (tprofesional) {
			if (especialidad == "") {
				alert("DEBE SELECCIONAR LA ESPECIALIDAD DEL PROFESIONAL ...... 	     ");
				document.getElementById("cboEspecialidad").focus();
				return false;
			}
		}
	}
	
	if (color == "RL" && rutMedico == "") {
		alert("DEBE INDICAR RUT DEL PROFESIONAL ...... 	     ");
		document.getElementById("txtrutp").focus();
		return false;
	}
	
	if (archivo == "") {
		alert("DEBE SUBIR EL DOCUMENTO ESCANEADO ...... 	     ");
		return false;
	}
	
	if (archivoLoad == 0) {
		alert("DEBE PRESIONAR EL BOTON SUBIR PARA CARGAR EL DOCUMENTO AL SISTEMA ...... 	     ");
		return false;
	}
	
	if(controlLicenciaFuncionario(color,folio,tipoTexto))	return false;
	
	if(verificaExisteServicio(tipoTexto))	return false;
	
	if(verificaExisteValidacion(tipoTexto,'guardar'))	return false;
	
	var f = new Date();
	var dia = f.getDate();
	var mes = (f.getMonth()+1);
	var ano = f.getFullYear();
	if(dia.toString().length==1)dia="0"+dia.toString();
	if(mes.toString().length==1)mes="0"+mes.toString();
	fechaHoy = dia+"-"+mes+"-"+ano;

	if(fechaInicio >= fechaHoy)	alert("SE ADVIERTE QUE LA LICENCIA ESTA SIENDO INGRESADA PARA 10 DIAS DESPUES DE LA FECHA ACTUAL ...... 	     ");
	return true;
}

function controlLicenciaFuncionario(color,folio,tipoTexto){
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("color="+color+"&folio="+folio));  
	//alert(objHttpXMLLicencias.responseText); 
	if (objHttpXMLLicencias.responseText != "VACIO"){
		var xml = objHttpXMLLicencias.responseXML.documentElement;
		mensaje += "NO PUEDE INGRESAR "+tipoTexto+" PORQUE YA EXISTE:\n\n";
		if (xml.getElementsByTagName('licencia').length >= 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('licencia').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var color	= (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");
			var folio	= (xml.getElementsByTagName('folio')[i].text||xml.getElementsByTagName('folio')[i].textContent||"");
			mensaje += (i+1) +". COLOR: " + color+" Y FOLIO: "+folio.toUpperCase()+"\n";
		}
		if (cantidadServiciosMostar = xml.getElementsByTagName('licencia').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function verificaExisteServicio(tipoTexto){
	var codFuncionario	= document.getElementById("codigoFuncionario").value;
	var fecha1 	 = document.getElementById("fechaInicioReal").value;
	var fecha2	 = document.getElementById("textFechaTermino").value;
	var fechaI	 = document.getElementById("txtfechaI").value;
	if(fecha1=="")fecha1=fechaI;
	var mensaje = "";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaServicios.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("funcionario="+codFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//alert(objHttpXMLLicencias.responseText);
	if (objHttpXMLLicencias.responseText != "VACIO"){
		var xml = objHttpXMLLicencias.responseXML.documentElement;
		mensaje += "NO PUEDE INGRESAR "+tipoTexto+" PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 	 = (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio = (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad 	 = (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function validaAnularLicencia(){
	var rut = document.getElementById('codigoFuncionario').value;
	var color = document.getElementById('txtcolor').value;
	var folio = document.getElementById('txtfolio').value;
	var fechaReal = document.getElementById("fechaTerminoReal").value;
	
  var tipoTexto = "";
	switch(color){
		case "PP":
			tipoTexto = "EL PERMISO";
		break;
		case "PV":
			tipoTexto = "EL PERMISO";
		break;
		case "MP":
			tipoTexto = "LA RESOLUCI\u00D3N";
		break;
		case "RL":
			tipoTexto = "LA ORDEN";
		break;
		default:
			tipoTexto = "LA LICENCIA";
		break;
	}
	controlLicenciaFuncionarioAnulada(tipoTexto,color,folio);
	
	if(verificaExisteValidacion(tipoTexto,'anular'))	return false;

	if(confirm("ATENCI\u00D3N :\nSE ANULAR\u00C1 "+tipoTexto+" EN EL SISTEMA.          \n\u00BFDESEA CONTINUAR?")){
		document.getElementById("txtfecF").value = fechaReal;
		actualizarLicencia(tipoTexto,"ANULADA");
	} else {
		return false;
	}
	
	document.getElementById('btnAnular').value = "ANULANDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
}

function controlLicenciaFuncionarioAnulada(tipoTexto,color,folio){
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaAnuladaPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("color="+color+"&folio="+folio));
	//console.log(objHttpXMLLicencias.responseText);
	if (objHttpXMLLicencias.responseText != "VACIO"){
		var xml		= objHttpXMLLicencias.responseXML.documentElement;
		var folio	= (xml.getElementsByTagName('folio')[0].text||xml.getElementsByTagName('folio')[0].textContent||"");
		var color	= (xml.getElementsByTagName('color')[0].text||xml.getElementsByTagName('color')[0].textContent||"");
		var estado	= (xml.getElementsByTagName('estado')[0].text||xml.getElementsByTagName('estado')[0].textContent||"");
		document.getElementById("UltimoEstado").value	= estado;
	}
}

function actualizarLicencia(tipoTexto,accion){
	var codigoFuncionario	= document.getElementById("codigoFuncionario").value;
	var color				= document.getElementById("txtcolor").value;
	var folio				= document.getElementById('txtfolio').value;
	var tipoLicencia		= document.getElementById('servicio').value;
	var fechaInicioReal		= document.getElementById("fechaInicioReal").value;
	var fechaTerminoReal	= document.getElementById("txtfecF").value;
	var fechaTerminoRealI	= document.getElementById("fechaTerminoInicial").value;
	var estado				= document.getElementById("UltimoEstado").value;
	
	var parametros = "color="+color+"&folio="+folio+"&codigoFuncionario="+codigoFuncionario+"&tipoLicencia="+tipoLicencia+"&fechaInicioReal="+fechaInicioReal+"&fechaTerminoReal="+fechaTerminoReal+"&fechaTerminoRealI="+fechaTerminoRealI+"&estado="+estado+"&accion="+accion;
  	//console.log(parametros);
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlLicenciaActualizar.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI(parametros));
	objHttpXMLLicencias.onreadystatechange=function(){
		if(objHttpXMLLicencias.readyState == 4){
			if (objHttpXMLLicencias.responseText != "VACIO"){
				//console.log(objHttpXMLLicencias.responseText);
				var xml = objHttpXMLLicencias.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						 alert(tipoTexto+' FUE '+accion+' EN EL SISTEMA ......        ');
						 top.leeLicencia(unidadUsuario, '', '');
						 idCargaListadoLicencias = setInterval("cerrarVentanaLicencia()",1000);
					}
					else alert(tipoTexto+' NO FUE '+accion+' CORRECTAMENTE ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function recortarLicencia(){
	var fechaTermino		= document.getElementById("txtfecF").value;
	var fechaInicioR		= document.getElementById("fechaInicioReal").value;
	var fechaTerminoR		= document.getElementById("textFechaTermino").value;
	var fechaTerminoReal	= document.getElementById("fechaTerminoReal").value;
	var color				= eliminarBlancos(document.getElementById("Listcolor").value);
	
	if(fechaTermino == ""){
		alert("DEBE INDICAR LA FECHA DE TERMINO ANTICIPADO ...... 	     ");
		document.getElementById("txtfecF").focus();
		return false;
	}
	
	if(fechaTermino == fechaTerminoReal){
		alert("LA FECHA DE TERMINO ANTICIPADO NO PUEDE SER IGUAL A LA FECHA REAL DE TERMINO ...... 	     ");
		document.getElementById("txtfecF").focus();
		return false;
	}
	
	var parts = fechaTermino.split("-");
  fechaTermino = new Date(parts[2], parts[1]-1, parts[0]);
  
  parts = fechaInicioR.split("-");
  fechaInicioR = new Date(parts[2], parts[1]-1, parts[0]);
  
  parts = fechaTerminoR.split("-");
  fechaTerminoR = new Date(parts[2], parts[1]-1, parts[0]);
	
	if(fechaTermino < fechaInicioR){
		alert("LA FECHA DE TERMINO ANTICIPADO NO PUEDE SER MENOR A LA FECHA REAL DE INICIO DEL REPOSO ...... 	     ");
		document.getElementById("txtfecF").focus();
		return false;
	}
	
	if(fechaTermino > fechaTerminoR){
		alert("LA FECHA DE TERMINO ANTICIPADO NO PUEDE SER MAYOR A LA FECHA REAL DE TERMINO ...... 	     ");
		document.getElementById("txtfecF").focus();
		return false;
	}
	
	var tipoTexto = "";
	switch(color){
		case "PP":
			tipoTexto = "EL PERMISO";
		break;
		case "PV":
			tipoTexto = "EL PERMISO";
		break;
		case "MP":
			tipoTexto = "LA RESOLUCI\u00D3N";
		break;
		case "RL":
			tipoTexto = "LA ORDEN";
		break;
		default:
			tipoTexto = "LA LICENCIA";
		break;
	}
	
	if(verificaExisteValidacion(tipoTexto,'recortar'))	return false;
	
	if(confirm("ATENCI\u00D3N :\nSE MODIFICAR\u00C1N LOS DATOS DE "+tipoTexto+" EN EL SISTEMA.          \n\u00BFDESEA CONTINUAR?")){
		actualizarLicencia(tipoTexto,"RECORTADA");
	} else {
		return false;
	}
	document.getElementById('btnGuardarLicencia').value = "RECORTANDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
}
