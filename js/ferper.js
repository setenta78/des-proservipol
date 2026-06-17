var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;
function leeFuncionarios(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var FechaCierre = document.getElementById("textFechaLimite").value;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Feriados y Permisos ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlListaFuncionarioFerper.php",true);
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
				var apellidoPaterno		= "";
				var apellidoMaterno		= "";
				var nombre2				= "";
				var nombre				= "";
				var nombreCompleto		= "";
				var tipoPermiso			= "";
				var usuarioProservipol	= "";
				var Archivo				= "";
				var Rut					= "";
				var Folio				= "";
				var LinkConstancia		= "";
				var LinkArchivo			= "";
				var mostrarEtiqueta 	= "";
				var fechaInicio			= "";
				var fechaTermino		= "";
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
					
					codigo	 		 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					apellidoPaterno				= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno				= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					nombre2						= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					nombre						= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					nombreCompleto				= apellidoPaterno + " " + apellidoMaterno	+	", "	+	nombre	+ " " + nombre2;
					tipoPermiso					= (xml.getElementsByTagName('permiso')[i].text||xml.getElementsByTagName('permiso')[i].textContent||"");
					Archivo						= (xml.getElementsByTagName('archivo')[i].text||xml.getElementsByTagName('archivo')[i].textContent||"");
					Rut							= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					Folio						= (xml.getElementsByTagName('folio')[i].text||xml.getElementsByTagName('folio')[i].textContent||"");
					usuarioProservipol			= (xml.getElementsByTagName('usuarioProservipol')[i].text||xml.getElementsByTagName('usuarioProservipol')[i].textContent||"");
					fechaInicio					= (xml.getElementsByTagName('fecha_inicio')[i].text||xml.getElementsByTagName('fecha_inicio')[i].textContent||"");
					fechaTermino				= (xml.getElementsByTagName('fecha_termino')[i].text||xml.getElementsByTagName('fecha_termino')[i].textContent||"");
					fechaTerminoReal			= (xml.getElementsByTagName('fecha_termino_real')[i].text||xml.getElementsByTagName('fecha_termino_real')[i].textContent||"");
					
					LinkConstancia 				= '<a href="imprimible/servicios/fichaPermiso.php?rutFuncionario='+Rut+'&codFolio='+Folio+'&usuarioProservipol='+usuarioProservipol+'" target="_blank"> <img src="img/adjunto.jpg" width=15 height=15 ></a>';
					LinkArchivo					= '<a href="./archivos_permiso/'+Archivo+'" target="_blank"> <img src="img/carpeta.png" width=15 height=15 > </a>';
					resaltarLinea 	 			= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 			= "cambiarClase(this, '"+fondoLinea+"')";
					if(fechaTerminoReal=="--") fechaTerminoReal = fechaTermino;
					
					var marca 						= (fechaTermino!=fechaTerminoReal) ? "(*)" : "";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('FERIADOS Y PERMISOS ... ', '920', '450','fichaPermiso.php?codigoFuncionario="+codigo+"&codFolio="+Folio+"&fechaCierre="+FechaCierre+"','"+nroLinea+"','','50','50')";
					var tipo = (tipoPermiso == 130 || tipoPermiso == 799) ? "feriado" : "permiso";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='28%'><div id='valorColumna'>"+nombreCompleto+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><div id='valorColumna'>"+tipoPermiso+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center' title='Fecha de inicio del "+tipo+": "+fechaInicio+"'>"+fechaInicio+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center' title='Fecha de termino del "+tipo+": "+fechaTerminoReal+"'>"+fechaTerminoReal+marca+"</div></td>";
					listadoFuncionarios	+= "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkArchivo+"</div></td>";
					listadoFuncionarios	+= "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkConstancia+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
			}
		}
	}
}

function mensajePermiso(){
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var diasSemana = new Array("Domingo","Lunes","Martes","Mi�rcoles","Jueves","Viernes","S�bado");
  	var f=new Date();
	var fechaHoy =diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
	var unidad = document.getElementById("unidad").value;
	var fecha = document.getElementById("fecha").value;
  	var mensaje="";
  	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlMensajePermiso.php",false);
 	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&fecha="+fecha));
  	//alert(objHttpXMLFuncionarios.responseText);
  	if(objHttpXMLFuncionarios.responseText != "VACIO"){
  	//console.log(objHttpXMLFuncionarios.responseText);
  	var xml = objHttpXMLFuncionarios.responseXML.documentElement;
  	mensaje += "FERIADOS Y PERMISOS INGRESADOS: "+fechaHoy.toUpperCase()+"\n\n";
    if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
    else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	  for(var i=0;i<cantidadServiciosMostar;i++){
	  	var grado 		  	= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
		  var nom1 		  	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
		  var nom2 		  	= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
		  var ape1 	      	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
		  var ape2        	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
		  var permiso 	 	= (xml.getElementsByTagName('permiso')[i].text||xml.getElementsByTagName('permiso')[i].textContent||"");
		  var codigo	  	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
		  var estado	  	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
		  var estadoDesc	= "";
		  if(estado=="2") estadoDesc = "-(ANULADA)";
		  mensaje += (i+1) +". " + grado+" "+nom1+" "+nom2+" "+ape1+" "+ape2+" ("+codigo+")"+", TIPO: ("+permiso.toUpperCase()+")"+estadoDesc+".\n";
		}
		if (cantidadServiciosMostar = xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function rutUsuario(){
	var objHttpXMLCodigo = new AJAXCrearObjeto();
	objHttpXMLCodigo.open("POST","./xml/xmlFerper/xmlrutUsuario.php",true);
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
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlDatosFuncionarioPermiso.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("rut="+rutsinChar));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml					= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo				= "";
				var apellidoPaterno		= "";
				var apellidoMaterno		= "";
				var primerNombre		= "";
				var segundoNombre		= "";
				var codigoCargo			= "";
				var unidadFuncionario	= "";
				var unidadAgregado		= "";
				var rut					= "";
				var unidadUsuario		= "";
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					apellidoPaterno		= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno		= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					primerNombre		= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					segundoNombre		= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					codigoCargo			= (xml.getElementsByTagName('codigoCargo')[i].text||xml.getElementsByTagName('codigoCargo')[i].textContent||"");
					unidadFuncionario	= (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					unidadAgregado		= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					rut					= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					unidadUsuario		= document.getElementById("unidadUsuario").value;
					
					document.getElementById("fotoFuncionario").src 		= "./img/sinFoto.png";
					document.getElementById("unidadFuncionario").value	= unidadFuncionario;
					document.getElementById("idFuncionario").value		= codigo;
					document.getElementById("codigoFuncionario").value	= codigo;
					document.getElementById("txtape1").value 			= apellidoPaterno;
					document.getElementById("txtape2").value 			= apellidoMaterno;
					document.getElementById("txtnom").value 	 		= primerNombre+" "+segundoNombre;
					document.getElementById("mensajeCargando").style.display = "none";
					capturaCorrelativo();
					validarSubir();
				}
			}
			else {
				document.getElementById("mensajeCargando").style.display = "none";
				alert ("NO EXISTE O NO PERTENECE A NINGUNA UNIDAD CON PROSERVIPOL...");
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
	objHttpXMLServicios.open("POST","./xml/xmlFerper/xmlCorrelativoAnterior.php",false);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("unidad="+unidad));
	//alert(objHttpXMLServicios.responseText);
	if (objHttpXMLServicios.responseText != "VACIO") {
		var xml = objHttpXMLServicios.responseXML.documentElement;
		document.getElementById("correlativo").value = (xml.getElementsByTagName('ultimoCorrelativo')[0].text||xml.getElementsByTagName('ultimoCorrelativo')[0].textContent||"");
	}
}

function validarSubir(){
	var rut		= document.getElementById('txtrut').value;
	var folio	= document.getElementById('txtfolio').value;
	document.getElementById('archivo').disabled = (rut != '' && folio != 0) ? false : true;
	document.getElementById('txtfolio').disabled = false;
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

function guardarPermiso(){
	var tipo = (document.getElementById("cboPermiso").value == 130 || document.getElementById("cboPermiso").value == 799) ? "FERIADO" : "PERMISO";
	if(validarPermiso()){
		if (confirm("ATENCIÓN :\nSE INGRESARÁ EL "+tipo+" DE ESTE FUNCIONARIO EN EL SISTEMA.          \n¿DESEA CONTINUAR?")) {
			nuevoPermiso();
		} else {
			return false;
		}
		document.getElementById('btnGuardarOrganizacion').value = "GUARDANDO ...";
		document.getElementById("mensajeGuardando").style.display = "";
		document.getElementById("mensajeGuardando").style.left = "170px";
		document.getElementById("mensajeGuardando").style.top  = "200px";
	}
}

function validarPermiso(){
	var folio		= document.getElementById("txtfolio").value;
	var rut			= eliminarBlancos(document.getElementById("txtrut").value);
	var fechaTer	= document.getElementById("txtfec2").value;
	var fechaIni	= document.getElementById("txtfec1").value;
	var tipo		= document.getElementById("cboPermiso").value;
	var archivo		= document.getElementById("archivo").value;
	var archivoLoad	= document.getElementById("archivoLoad").value;
	
	if (rut == "") {
		alert("DEBE INDICAR RUT ...... 	     ");
		document.getElementById("txtrut").focus();
		return false;
	}
	
	if (folio == 0) {
		alert("DEBE INGRESAR EL FOLIO DEL FERIADO O PERMISO  ...... 	     ");
		document.getElementById("txtfolio").focus();
		return false;
	}
	
	if (fechaIni == "") {
		alert("DEBE INDICAR LA FECHA DE INICIO DEL FERIADO O PERMISO  ...... 	     ");
		document.getElementById("txtfec1").focus();
		return false;
	}
	
	if (fechaTer == "") {
		alert("DEBE INDICAR LA FECHA DE TERMINO DEL FERIADO O PERMISO  ...... 	     ");
		document.getElementById("txtfec2").focus();
		return false;
	}
	
	if (tipo == 0) {
		alert("DEBE SELECCIONAR UN TIPO DE PERMISO ...... 	     ");
		document.getElementById("cboPermiso").focus();
		return false;
	}
		
	arrayAux = fechaIni.split("-");
	fechaIni = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0]);
	
	arrayAux = fechaTer.split("-");
	fechaTer = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0]);

	if (fechaIni > fechaTer) {
		alert("LA FECHA DE INICIO NO PUEDE SER SUPERIOR A LA FECHA DE TERMINO DEL FERIADO O PERMISO  ...... 	    \n"+document.getElementById("txtfec1").value+" > "+document.getElementById("txtfec2").value);
		document.getElementById("txtfec1").focus();
		return false;
	}
	
 	if(controlPermisoCierreValidacion("GUARDAR")) return false;
 	
 	if(controlPermisoFuncionario(folio)) return false;
	
	if(verificaExisteServicio()) return false;
	
	if(archivo == "") {
		alert("DEBE SUBIR EL DOCUMENTO ESCANEADO ...... 	     ");
		return false;
	}
	
	if(archivoLoad == 0) {
		alert("DEBE PRESIONAR EL BOTON SUBIR PARA CARGAR EL DOCUMENTO AL SISTEMA ...... 	     ");
		return false;
	}
	return true;
}

function controlPermisoFuncionario(folio){
	var mensaje="";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlListaPermisoPorFuncionario.php",false);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("folio="+folio));
	//alert(objHttpXMLFuncionarios.responseText);
	if(objHttpXMLFuncionarios.responseText != "VACIO"){
		var xml = objHttpXMLFuncionarios.responseXML.documentElement;
		mensaje += "NO PUEDE INGRESAR EL FERIADO O PERMISO PORQUE YA EXISTE:\n\n";
		if(xml.getElementsByTagName('permiso').length >= 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('permiso').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var folio	= (xml.getElementsByTagName('folio')[i].text||xml.getElementsByTagName('folio')[i].textContent||"");
			mensaje += (i+1) +". FOLIO: "+folio.toUpperCase()+"\n";
		}
		if(cantidadServiciosMostar = xml.getElementsByTagName('permiso').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function verificaExisteServicio(){
	var codFuncionario 	 = document.getElementById("codigoFuncionario").value;
	var fechaI	 = document.getElementById("txtfec1").value;
	var fechaT	 = document.getElementById("txtfec2").value;
	var mensaje	 = "";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlListaServicios.php",false);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("funcionario="+codFuncionario+"&fecha1="+fechaI+"&fecha2="+fechaT));
	//alert(objHttpXMLFuncionarios.responseText);
	if(objHttpXMLFuncionarios.responseText != "VACIO"){
		var xml = objHttpXMLFuncionarios.responseXML.documentElement;
		mensaje += "NO PUEDE INGRESAR EL FERIADO O EL PERMISO PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
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

function subirArchivo(boton){
	var rutaArchivo 			= document.getElementById("archivo").value;
	var archivoServidor			= document.getElementById("archivoServidor").value;
	var extension				= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toUpperCase();
	var extensiones_permitidas	= new Array(".JPG", ".JPEG", ".PNG", ".PDF");
	var noaceptada  			= true;
	var rutsinchar				= document.getElementById("txtrut").value;
	var folio			 		= document.getElementById("txtfolio").value;
	
	for(var i = 0; i < extensiones_permitidas.length; i++){
    	if(extensiones_permitidas[i] == extension) noaceptada = false;
	} 

	if(noaceptada){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO JPG, JPEG, PNG O PDF");
   		return false;
  	}
	
	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace(".","");
	rutsinchar=rutsinchar.replace("-","");
	rutaArchivo = rutsinchar+"-"+folio+extension;
	
	if(rutsinchar == archivoServidor){
		alert("EL DOCUMENTO YA EXISTE");
		return false;
	}
	
	document.getElementById("rutArchi").value = rutaArchivo;
	document.formSubeArchivo.submit();
	boton.disabled = true;
	document.getElementById("archivo").disabled		= true;
	document.getElementById("archivoLoad").value	=	1;
}

function nuevoPermiso(){
	var tipo 				= (document.getElementById("cboPermiso").value == 130 || document.getElementById("cboPermiso").value == 799) ? "FERIADO" : "PERMISO";
	var codigoFuncionario	= document.getElementById("txtrut").value.toUpperCase();
	var unidadUsuario		= document.getElementById("unidadUsuario").value;
  	var unidadFuncionario	= (document.getElementById("unidadFuncionario").value=="") ? 1 : document.getElementById("unidadFuncionario").value;
  	var rutsinchar 			= document.getElementById("txtrut").value;
  	var folio 				= eliminarBlancos(document.getElementById("txtfolio").value);
  	var fechaI 				= document.getElementById("txtfec1").value;
  	var fechaT 				= document.getElementById("txtfec2").value;
 	var archivo 			= document.getElementById("rutArchi").value;
	var ip 					= document.getElementById("IpFuncionario").value;
 	var codigoFuncionario 	= document.getElementById("codigoFuncionario").value;
	var fechaRegistro		= document.getElementById("fecha").value;
  	var tipoPermiso 		= document.getElementById("cboPermiso").value;

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
	
	if(unidadFuncionario==0||unidadFuncionario==''){
		alert('OCURRIO UN ERROR AL REGISTRAR EL PERMISO');
		cerrarFicha();
		return;
	}
	
	var parametros = "";
	parametros += "rut="+rutsinchar+"&folio="+folio+"&fechaI="+fechaI+"&fechaT="+fechaT+"&tipoPermiso="+tipoPermiso+"&codigoFuncionario="+codigoFuncionario;
	parametros += "&fechaRegistro="+fechaRegistro+"&ip="+ip+"&unidadFuncionario="+unidadFuncionario+"&archivo="+archivo+"&dias="+dias;
	//console.log(parametros);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlNuevoPermiso.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		// alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
			//alert(objHttpXMLFuncionarios.responseText);
			var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('EL '+tipo+' FUE INGRESADO CON EXITO AL SISTEMA ......        ');
						top.leeFuncionarios(unidadUsuario, '', '');
						idCargaListadoFuncionarios = setInterval("cerrarVentanaFerper()",1000);
					}
					else alert('EL '+tipo+' NO FUE INGRESADO AL SISTEMA ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function tipoFicha(codFuncionario, Folio){
	var permisoRegistrar = document.getElementById("permisoRegistrar").value;
	if(codFuncionario==""){
		document.getElementById('btnAnularPermiso').style.display="none";
		document.getElementById('btnSuspenderPermiso').style.display="none";
	}
	else{
		if(!permisoRegistrar){
			document.getElementById('btnAnularPermiso').disabled = "true";
			document.getElementById('btnSuspenderPermiso').disabled = "true";
		}
		document.getElementById('btnGuardarOrganizacion').style.display="none";
		document.getElementById('btnSubir').style.display="none";
		document.getElementById('txtfolio').disabled = true;
		document.getElementById('txtrut').disabled = true;
		document.getElementById('idFechaServicio1').disabled = true;
		document.getElementById('idFechaServicio2').disabled = true;
		document.getElementById('cboPermiso').disabled = true;
		buscarDatos(codFuncionario, Folio);
	}
}

function buscarDatos(codFuncionario, Folio){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlDatosFichaPermiso.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codFuncionario="+codFuncionario+"&folio="+Folio));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo			= "";
				var apellidoPaterno	= "";
				var apellidoMaterno	= "";
				var primerNombre	= "";
				var segundoNombre	= "";
				var rut				= "";
				var folio			= "";
				var fechaI			= "";
				var fechaT			= "";
				var fechaR			= "";
				var tipoPermiso		= "";
				var archivo			= "";
				var unidad			= "";

				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					apellidoPaterno	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					primerNombre	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					segundoNombre	= (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					rut				= (xml.getElementsByTagName('rut')[i].text||xml.getElementsByTagName('rut')[i].textContent||"");
					fechaI			= (xml.getElementsByTagName('fechaI')[i].text||xml.getElementsByTagName('fechaI')[i].textContent||"");
					fechaT			= (xml.getElementsByTagName('fechaT')[i].text||xml.getElementsByTagName('fechaT')[i].textContent||"");
					fechaTR			= (xml.getElementsByTagName('fechaTR')[i].text||xml.getElementsByTagName('fechaTR')[i].textContent||"");
					fechaR			= (xml.getElementsByTagName('fechaR')[i].text||xml.getElementsByTagName('fechaR')[i].textContent||"");
					tipoPermiso		= (xml.getElementsByTagName('tipoPermiso')[i].text||xml.getElementsByTagName('tipoPermiso')[i].textContent||"");
					archivo			= (xml.getElementsByTagName('archivo')[i].text||xml.getElementsByTagName('archivo')[i].textContent||"");
					unidad			= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					folio			= (xml.getElementsByTagName('folio')[i].text||xml.getElementsByTagName('folio')[i].textContent||"");
					
					document.getElementById("fotoFuncionario").src				= "./img/sinFoto.png"; /*"http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";*/
					document.getElementById("codigoFuncionario").value			= codigo;
					document.getElementById("txtrut").value						= rut;
					document.getElementById("txtfolio").value					= folio;
					document.getElementById("txtape1").value 					= apellidoPaterno;
					document.getElementById("txtape2").value 					= apellidoMaterno;
					document.getElementById("txtnom").value 	 				= primerNombre+" "+segundoNombre;
					document.getElementById("txtfec1").value 		 			= fechaI;
					document.getElementById("txtfec2").value 	 				= fechaT;
					document.getElementById("txtFechaTerminoReal").value 	 	= fechaTR;
					document.getElementById("FechaRegistro").value 	 			= fechaR;
    				document.getElementById('cboPermiso').value 				= tipoPermiso;
					document.getElementById("unidadFuncionario").value			= unidad;
					document.getElementById("formArchivo").innerHTML			= archivo;
					document.getElementById("mensajeCargando").style.display	= "none";
				}
			}
		}
	}
}

function anularPermiso(){
	var tipo = (document.getElementById("cboPermiso").value == 130 || document.getElementById("cboPermiso").value == 799) ? "FERIADO" : "PERMISO";
  if(controlPermisoAnulado(tipo)) return false;
	if(controlPermisoCierreValidacion("ANULAR")) return false;
	if(confirm("ATENCION :\nSE ANULARÁ ESTE "+tipo+" EN EL SISTEMA.          \nDESEA CONTINUAR?")){
		actualizarPermiso("ANULADA",tipo);
	} else {
		return false;
	}
	document.getElementById('btnAnularPermiso').value = "ANULANDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
}

function suspenderPermiso(){
	var tipo = (document.getElementById("cboPermiso").value == 130 || document.getElementById("cboPermiso").value == 799) ? "FERIADO" : "PERMISO";
	if(controlPermisoSuspendido(tipo)) return false;
	if(controlPermisoCierreValidacion("SUSPENDER")) return false;
	if(confirm("ATENCION :\nSE SUSPENDERÁ PARTE DEL "+tipo+".          \nDESEA CONTINUAR?")){
		actualizarPermiso("SUSPENDIDA",tipo);
	} else {
		return false;
	}
	document.getElementById('btnSuspenderPermiso').value = "SUSPENDIENDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
}

function controlPermisoSuspendido(tipo){
	var fechaInicio			= document.getElementById("txtfec1").value;
	var fechaTermino		= document.getElementById("txtfec2").value;
	var fechaTerminoReal	= document.getElementById("txtFechaTerminoReal").value;
	var parts				= fechaInicio.split("-");
	fechaInicio 			= new Date(parts[2],parts[1]-1,parts[0]);
	parts 					= fechaTermino.split("-");
	fechaTermino 			= new Date(parts[2],parts[1]-1,parts[0]);
	parts 					= fechaTerminoReal.split("-");
	fechaTerminoReal 		= new Date(parts[2],parts[1]-1,parts[0]);
	if(fechaTerminoReal >= fechaTermino){
		alert("LA NUEVA FECHA DE TERMINO NO PUEDE SER IGUAL O MAYOR A LA FECHA DE TERMINO DEL "+tipo);
		return true;
	}
	if(fechaInicio > fechaTerminoReal){
		alert("LA NUEVA FECHA DE TERMINO NO PUEDE SER MENOR A LA FECHA DE INICIO DEL "+tipo);
		return true;
	}
	return false;
}

function controlPermisoCierreValidacion(mensaje){
	var codigoFuncionario	= document.getElementById("codigoFuncionario").value;
	var fechaCierre			= document.getElementById("FechaCierre").value;
	var fechaInicio			= document.getElementById("txtfec1").value;
	var fechaTermino		= document.getElementById("txtfec2").value;
	var fechaTerminoReal	= (mensaje!="SUSPENDER") ? document.getElementById("txtfec2").value : document.getElementById("txtFechaTerminoReal").value;
	var tipo				= (document.getElementById("cboPermiso").value == 130 || document.getElementById("cboPermiso").value == 799) ? "FERIADO" : "PERMISO";
	
	var fecha1 = fechaInicio;
	var fecha2 = fechaTerminoReal;
	if(mensaje=="SUSPENDER"){
		var parts2	= fechaTerminoReal.split("-");
		fechaTerminoReal2 = new Date(parts2[2],parts2[1]-1,parts2[0]);
		fechaTerminoReal2.setDate(fechaTerminoReal2.getDate() + 1);
		parts2	= fechaTerminoReal2.toISOString().slice(0, 10).split("-");
		var fecha1 = parts2[2]+"-"+parts2[1]+"-"+parts2[0];
		var fecha2 = fechaTermino;
	}
	
	var parts			= fechaInicio.split("-");
	fechaInicio			= new Date(parts[2],parts[1]-1,parts[0]);
	parts				= fechaTermino.split("-");
	fechaTermino		= new Date(parts[2],parts[1]-1,parts[0]);
	parts				= fechaTerminoReal.split("-");
	fechaTerminoReal	= new Date(parts[2],parts[1]-1,parts[0]);
	parts				= fechaCierre.split("-");
	fechaCierre			= new Date(parts[2],parts[1]-1,parts[0]);

	fechaCierre.setDate(fechaCierre.getDate() - 1);
	if((fechaInicio <= fechaCierre) && mensaje!="SUSPENDER"){
		alert("NO PUEDE "+mensaje+" EL "+tipo+", PORQUE SE ENCUENTRA CERRADO EL MES.");
		return true;
	}

	if((fechaTermino <= fechaCierre) && mensaje!="SUSPENDER"){
		alert("NO PUEDE "+mensaje+" EL "+tipo+", PORQUE SE ENCUENTRA CERRADO EL MES.");
		return true;
	}
	
	if((fechaTerminoReal < fechaCierre) && mensaje=="SUSPENDER"){
		alert("NO PUEDE "+mensaje+" EL "+tipo+", PORQUE SE ENCUENTRA CERRADO EL MES.");
		return true;
	}
	
	if(fechaTerminoReal < fechaInicio){
		alert("NO PUEDE "+mensaje+" EL "+tipo+", PORQUE LA FECHA DE TERMINO NO PUEDE SER MENOR A LA FECHA DE INICIO DEL FERIADO Y/O PERMISO.");
		return true;
	}
	
	var mensaje="";
  	var cantidadDiasMostrar = 0;
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();
	objHttpXMLFechaValidacion.open("POST","./xml/xmlFerper/xmlControlValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	console.log("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2);
	objHttpXMLFechaValidacion.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//alert(objHttpXMLFechaValidacion.responseText);
  	if(objHttpXMLFechaValidacion.responseText != "VACIO"){
		var xml = objHttpXMLFechaValidacion.responseXML.documentElement;
		mensaje += "NO PUEDE INGRESAR EL "+tipo+" PORQUE TIENE LOS SIGUIENTES DIAS VALIDADOS:\n\n";
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

function controlPermisoAnulado(tipo){ 
	var folioText = document.getElementById("txtfolio").value;
	var mensaje = "";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlListaPermisoAnulado.php",false);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("folio="+folioText));
	//alert(objHttpXMLFuncionarios.responseText);
	if(objHttpXMLFuncionarios.responseText != "VACIO"){
		var xml		= objHttpXMLFuncionarios.responseXML.documentElement;
		var folio	= (xml.getElementsByTagName('folio')[0].text||xml.getElementsByTagName('folio')[0].textContent||"");
		var estado	= (xml.getElementsByTagName('estado')[0].text||xml.getElementsByTagName('estado')[0].textContent||"");
		document.getElementById("UltimoEstado").value	= estado;
	}
	return false;
}

function actualizarPermiso(accion,tipo){
	var folio				= document.getElementById('txtfolio').value;
	var estado				= document.getElementById("UltimoEstado").value;
	var codigoFuncionario	= document.getElementById("codigoFuncionario").value;
	var tipoPermiso			= document.getElementById("cboPermiso").value;
	var fechaInicio			= document.getElementById("txtfec1").value;
	var fechaTermino		= document.getElementById("txtfec2").value;
	var fechaTerminoReal	= document.getElementById("txtFechaTerminoReal").value;
	var ipModifica			= document.getElementById("IpFuncionario").value;
	var usuario				= document.getElementById("usuario").value;
	var parametros = "accion="+accion+"&folio="+folio+"&estado="+estado+"&codigoFuncionario="+codigoFuncionario+"&tipoPermiso="+tipoPermiso+"&fechaInicio="+fechaInicio+"&fechaTermino="+fechaTermino+"&fechaTerminoReal="+fechaTerminoReal+"&ipModifica="+ipModifica+"&usuario="+usuario;
  	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	//console.log(parametros);
	objHttpXMLFuncionarios.open("POST","./xml/xmlFerper/xmlActualizarPermiso.php",true);
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
						alert('EL '+tipo+' FUE '+accion.substring(0,accion.length-1)+'O CON EXITO EN EL SISTEMA ......        ');
						top.leeFuncionarios(unidadUsuario, '', '');
						idCargaListadoFuncionarios = setInterval("cerrarVentanaFerper()",1000);
					}
					else alert('EL '+tipo+' NO FUE '+accion.substring(0,accion.length-1)+'O EN EL SISTEMA ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function cerrarVentanaFerper(){
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
			document.getElementById("labColPermiso").innerHTML = "FERIADO O PERMISO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColCodigo").innerHTML = "CODIGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigo").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "nombre":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColPermiso").innerHTML = "FERIADO O PERMISO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColNombre").innerHTML = "NOMBRE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "permiso":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColPermiso").innerHTML = "FERIADO O PERMISO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colPermiso").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "fechaI":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColPermiso").innerHTML = "FERIADO O PERMISO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFechaI").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "fechaT":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColPermiso").innerHTML = "FERIADO O PERMISO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFechaT").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "archivo":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColPermiso").innerHTML = "FERIADO O PERMISO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColConstancia").innerHTML = "CONSTANCIA";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colArchivo").onmousedown = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "constancia":
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColPermiso").innerHTML = "FERIADO O PERMISO";
			document.getElementById("labColFechaI").innerHTML = "FECHA INICIO";
			document.getElementById("labColFechaT").innerHTML = "FECHA TERMINO";
			document.getElementById("labColArchivo").innerHTML = "ARCHIVO";
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