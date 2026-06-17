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
				var xml 						= objHttpXMLLicencias.responseXML.documentElement;
				var codigo	 				= "";
				var nombre	 				= "";
				var tipoLicencia		= "";
				var Archivo					= "";
				var Rut							= "";
				var Color						= "";
				var Folio						= "";
				var tipoArchivo			= "NO EXISTEN ARCHIVOS ASOCIADOS ...";
				var LinkConstancia	= "";
				var LinkArchivo			= "";
				var mostrarEtiqueta = "";
				var fechaInicio			= "";
				var InicioD					= "";
				var fechaTermino		= "";
				var TerminoA				= "";
				var fechaInicioR		= "";
				var fechaTerminoR 	= "";
				var InicioVD 				= "";
				var TerminoVA				= "";
				
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoLicencias	= "";
								
				listadoLicencias = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				for(i=0;i<xml.getElementsByTagName('licencia').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
						
					codigo	 		 	= xml.getElementsByTagName('codigo')[i].text;
					nombre	 		 	= xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					tipoLicencia	= xml.getElementsByTagName('licenciaMedica')[i].text;
					Archivo				= xml.getElementsByTagName('archivo')[i].text;
					Rut						= xml.getElementsByTagName('rut')[i].text;
					Color					= xml.getElementsByTagName('color')[i].text;
					Folio					= xml.getElementsByTagName('folio')[i].text;
					fechaInicio		= xml.getElementsByTagName('fecha_inicio')[i].text; 
					fechaInicioR	= xml.getElementsByTagName('fecha_inicio_real')[i].text; 
					fechaTermino	= xml.getElementsByTagName('fecha_termino')[i].text;
					fechaTerminoR	= xml.getElementsByTagName('fecha_termino_real')[i].text;
					InicioVD			= xml.getElementsByTagName('inicio')[i].text;
					TerminoVA			= xml.getElementsByTagName('termino')[i].text;
					
					if(InicioVD==1)InicioD=" (*)";
					if(TerminoVA==1)TerminoA=" (*)"; 
					
					LinkConstancia 	= '<a href="imprimible/servicios/fichaLicencia.php?rutFuncionario='+Rut+'&codColor='+Color+'&codFolio='+Folio+'" target="_blank"> <img src="img/adjunto.jpg" width=15 height=15 ></a>';
					LinkArchivo			= '<a href="./archivos_licencia/'+Archivo+'" target="_blank"> <img src="img/carpeta.png" width=15 height=15 > </a>';
					
					//tipoArchivo			=	LinkArchivo+" "+LinkConstancia;
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('LICENCIA MEDICA ... ', '920', '780','fichaLicencia.php?codigoFuncionario="+codigo+"&codColor="+Color+"&codFolio="+Folio+"','"+nroLinea+"','','5','5')";
									
					//listadoLicencias += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoLicencias += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoLicencias += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoLicencias += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoLicencias += "<td width='28%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoLicencias += "<td width='20%' align='left'><div id='valorColumna'>"+tipoLicencia+"</div></td>";
					listadoLicencias += "<td width='10%' align='center' title='Fecha de inicio licencia: "+fechaInicio+"'>"+fechaInicioR+InicioD+"</div></td>";
					listadoLicencias += "<td width='10%' align='center' title='Fecha de termino licencia: "+fechaTermino+"'>"+fechaTerminoR+TerminoA+"</div></td>";
					listadoLicencias	+= "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkArchivo+"</div></td>";
					listadoLicencias	+= "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkConstancia+"</div></td>";
					listadoLicencias += "</tr>";
				}
				listadoLicencias += "</table>";
				//alert(listadoLicencias);
				div.innerHTML = listadoLicencias;
				cargaListadoLicencias = 1;
									
			}
			//else{
			//div.innerHTML = "";
			//alert("NO EXISTEN LICENCIAS MEDICAS REGISTRADAS PARA LA FECHA INDICADA.     ");
			//cargaListadoLicencias = 0;
			//}
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
	if (cargaListadoLicencias == 1){
		clearInterval(idCargaListadoLicencias);
		cambiarClase(columna,'nombreColumna');
	}		
}

function listaFuncionarios(unidad, nombreObjeto, multiple, campo, sentido){
	cargaListadoLicencias = 0;
	
	document.getElementById(nombreObjeto).length = null;
	if (multiple == false ){		
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
				var xml 		= objHttpXMLLicencias.responseXML.documentElement;
				var codigo	= "";
				var nombre	= "";
				var grado		= "";
				var cargo		= "";
				
				var sw 				 				= 0;
				var fondoLinea		 		= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoLicencias	= "";
				
				listadoLicencias = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	= xml.getElementsByTagName('codigo')[i].text;
					nombre	= xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					grado	= xml.getElementsByTagName('grado')[i].text;
					cargo	= xml.getElementsByTagName('cargo')[i].text;
					
					var descripcion = nombre + " ("+grado+")";
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

function buscaDatosFuncionario2(){
	var codigoFuncionario	= eliminarBlancos(document.getElementById("txtrut").value);
	if (codigoFuncionario != "") leedatosFuncionario(codigoFuncionario, 1);	
}

function leedatosFuncionario(rut, tipo){
	
	//alert(tipo);
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
			//alert(objHttpXMLLicencias.responseText);
			if (objHttpXMLLicencias.responseText != "VACIO"){
				//alert(objHttpXMLLicencias.responseText);
				var xml 				  = objHttpXMLLicencias.responseXML.documentElement;
				var codigo	 			  = "";
				var apellidoPaterno		  = "";
				var apellidoMaterno		  = "";
				var primerNombre	 	  = "";
				var segundoNombre	 	  = "";
				var unidadFuncionario	  = "";
				var unidadUsuario		  = "";
				var rut		  = "";
								
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo	 		  		= xml.getElementsByTagName('codigo')[i].text;
					unidadAgr	 		  		= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;					
					apellidoPaterno	  		= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellifoMaterno   		= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre 	  		= xml.getElementsByTagName('nombre')[i].text;
					segundoNombre 	  		= xml.getElementsByTagName('nombre2')[i].text;
					unidadFuncionario 		= xml.getElementsByTagName('codigoUnidad')[i].text;
					unidadUsuario 			= document.getElementById("unidadUsuario").value;
          rut 			= xml.getElementsByTagName('rut')[i].text; 
					
					if(unidadAgr==""){
						document.getElementById("unidadFuncionario").value	= unidadFuncionario;
					}
					else if(unidadAgr==1){
						document.getElementById("mensajeCargando").style.display = "none";    
						alert ("EL FUNCIONARIO NO PERTENECE A UNA UNIDAD CON SISTEMA PROSERVIPOL ...");
						document.getElementById("txtrut").value = "";
						document.getElementById("txtrut").disabled = false;
						document.getElementById("txtrut").focus();
					}
					else{
						document.getElementById("unidadFuncionario").value	= unidadAgr;
					}
					
					document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/"+codigo+".jpg";
					//alert(document.getElementById("fotoFuncionario").src);  
					
					document.getElementById("idFuncionario").value	= codigo;					
					document.getElementById("codigoFuncionario").value	= codigo;		
					//document.getElementById("txtrut").value		= rut;
					document.getElementById("txtape1").value 		= apellidoPaterno;
					document.getElementById("txtape2").value 		= apellifoMaterno;
					document.getElementById("txtnom").value 	 		= primerNombre+" "+segundoNombre;
					
					if (unidadFuncionario != "") var habilitarBotones = false;
					else var habilitarBotones = true;
						
					if (tipo == "1"){
						document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
						document.getElementById("btnBuscarFuncionario").disabled = "true";
						document.getElementById("mensajeCargando").style.display = "none";	
					}
					capturaCorrelativo();
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

function nuevaLicencia(){
	
	var codigoFuncionario	= document.getElementById("txtrut").value.toUpperCase();
	var apellidoPaterno		= document.getElementById("txtape1").value.toUpperCase();
	var apellidoMaterno		= document.getElementById("txtape2").value.toUpperCase();
	var primerNombre		= document.getElementById("txtnom").value.toUpperCase();
	var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoSelime		= document.getElementById("codigoSelime").value;
  
  var unidadFuncionario	= document.getElementById("unidadFuncionario").value;
	if(unidadFuncionario == "") unidadFuncionario=1;
  
  var rutsinchar = document.getElementById("txtrut").value;
  var color = document.getElementById("Listcolor").value;
  var folio = document.getElementById("txtfolio").value;
  var fecha1 = document.getElementById("txtfec1").value;
  var fecha2 = document.getElementById("txtfec2").value;
  var dias = document.getElementById("txtdias").value;
 	var archivo = document.getElementById("rutArchi").value;
 	var ip = document.getElementById("IpFuncionario").value;
 	var fechaReal = document.getElementById("fechaReal").value;
 	if(fechaReal=="") fechaReal = fecha2;
 	var codigoFuncionario = document.getElementById("codigoFuncionario").value;
 	var correlativo = document.getElementById("correlativo").value;
	var fechaTermino = document.getElementById("textFechaTermino").value;
	var fechaRegistro= document.getElementById("fecha").value;
  	
  if(color == "PP"){	
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
	}
	else if(color == "MP"){
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
	}
	else{
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
	
	var fechaI = fechaReal;
	var Fecha = new Date();
	var sFecha = fechaI || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
	var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
	var aFecha = sFecha.split(sep);
	var fechaI = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
	fechaI= new Date(fechaI);
	
	var fechaT = fechaTermino;
	sFecha = fechaT || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
	sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
	aFecha = sFecha.split(sep);
	fechaT = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
	fechaT= new Date(fechaT);
	
	var diasDif = fechaT.getTime() - fechaI.getTime();
 	var diasF = Math.round(diasDif/(1000 * 60 * 60 * 24));
	
	var parametros = "";
	
	parametros += "rut="+rutsinchar+"&color="+color+"&folio="+folio+"&fecha1="+fecha1+"&fecha2="+fecha2+"&dias="+dias+"&diasF="+diasF;
	parametros += "&rutHijo="+rutHijo+"&fecha3="+fecha3+"&tipoLicencia="+tipoLicencia+"&recuperacion="+recuperacion+"&selime="+codigoSelime;
	parametros += "&invalidez="+invalidez+"&tipoReposo="+tipoReposo+"&lugarReposo="+lugarReposo+"&rutProfesional="+rutProfesional+"&codigoFuncionario="+codigoFuncionario+"&correlativo="+correlativo+"&fechaRegistro="+fechaRegistro;
	parametros += "&especialidad="+especialidad+"&tipoProfesional="+tipoProfesional+"&atencion="+atencion+"&ip="+ip+"&unidadFuncionario="+unidadFuncionario+"&archivo="+archivo+"&fechaReal="+fechaReal+"&fechaTermino="+fechaTermino;
	
	//alert(parametros);
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlNuevaLicencia.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI(parametros));
	
	objHttpXMLLicencias.onreadystatechange=function(){
		if(objHttpXMLLicencias.readyState == 4){      
		// alert(objHttpXMLLicencias.readyState);
			if (objHttpXMLLicencias.responseText != "VACIO"){
			//alert(objHttpXMLLicencias.responseText);
				var xml = objHttpXMLLicencias.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						top.leeLicencia(unidadUsuario, '', '');
						idCargaListadoLicencias = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function guardarFichaLicencia(){
	/* Dar formato a las fechas y sumar los días */
	var codigoFuncionario = document.getElementById("idFuncionario").value;
	var fechaInicio = document.getElementById("txtfec2").value;
	var dias = document.getElementById("txtdias").value;
	var arrayAux = fechaInicio.split("-");
	var fechaTFDate = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0],01,00,00);
	if(dias.substr(0,1)=="0")dias = dias.substr(1,1);
	dias = parseInt(dias);
	fechaTFDate.setDate(fechaTFDate.getDate() + dias-1);
	
	var dia = fechaTFDate.getDate();
	var mes = (fechaTFDate.getMonth()+1);
	var ano = fechaTFDate.getYear();
	if(dia.toString().length==1)dia="0"+dia.toString();
	if(mes.toString().length==1)mes="0"+mes.toString();
	var fechaTermino = dia+"-"+ mes +"-"+ano;
	document.getElementById("textFechaTermino").value = fechaTermino;
	//alert(validaOk);
	//if (validaOk){
	if(validarLicenciaMedica()){
		
		if (codigoFuncionario == "") {
/*-----Modifica licencia-----------------------------------------------------------------------------------------------------------------------------------------*/
			var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTA LICENCIA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj){
				actualizarFuncionario();
			} else {
				btnGuardarLicencia();
				return false;
			}
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		} else {
/*----Crea nueva licencia----------------------------------------------------------------------------------------------------------------------------------------*/
			var msj=confirm("ATENCIÓN :\nSE INGRESARÁN LOS DATOS DE ESTA LICENCIA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) {
				nuevaLicencia();
				nuevaLicenciaSelime();
			} else {
				//activarBotones();
				return false;
			}
		document.getElementById('btnGuardarLicencia').value = "GUARDANDO ...";	
	  document.getElementById("mensajeGuardando").style.display = "";
	  document.getElementById("mensajeGuardando").style.left = "170px";
	  document.getElementById("mensajeGuardando").style.top  = "200px";
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------*/
		}
	}
}

function cerrarVentanaPersonal(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoLicencias == 1){
		clearInterval(idCargaListadoLicencias);
		top.cerrarVentana();
	}
}

function controlServicioLicencia(funcionario,fecha1,fecha2){ 
    
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlServicios/xmlListaServiciosPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("codigoFuncionario="+funcionario+"&fecha1="+fecha1+"&fecha2="+fecha2));  
	//alert(objHttpXMLLicencias.responseText); 
	var xml = objHttpXMLLicencias.responseXML.documentElement;
	if (objHttpXMLLicencias.responseText != "VACIO"){
		//alert("Tiene servicios asignados.");
		mensaje += "NO PUEDE INGRESAR LICENCIA PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 	 = xml.getElementsByTagName('fecha')[i].text;
			var servicio = xml.getElementsByTagName('desServicio')[i].text;
			var unidad 	 = xml.getElementsByTagName('desUnidad')[i].text;
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}     
}

//Nueva funcion 2
function verificaExisteValidacion(tipoTexto,tipo){
	
	var unidad	=	document.getElementById("unidadFuncionario").value;
	var fecha1	= document.getElementById("fechaReal").value;
	var fecha2	= document.getElementById("textFechaTermino").value;
	var fechaI	= document.getElementById("txtfec2").value;
	var fechaT	= "";
	var fechaL = top.document.getElementById("textFechaLimite").value;
	//alert(tipo);
	if(document.body.contains(document.getElementById("txtfecF"))) var fechaT	= document.getElementById("txtfecF").value;
	if(fecha1=="")fecha1=fechaI;
	if(fechaT!="")fecha2=fechaT;
	
	var parts = fecha2.split("-");
  var fechaTermino = new Date(parts[2], parts[1]-1, parts[0]);
  
  parts = fechaL.split("-");
  var fechaLimite = new Date(parts[2], parts[1]-1, parts[0]);
  	
  	/* CONTROL PARA REGISTRAR LICENCIA O FERIADOS CON MES CERRADO
	*/
  
	if (fechaTermino<=fechaLimite){
		alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaL);
		return true;
	}
	
	
	if(tipo=="recortar"){
		fecha1 = fecha2;
		fecha2 = "01-01-2500";
	}
	else{
		fecha2 = document.getElementById("textFechaTermino").value;
	}
	
  var mensaje="";
  var cantidadDiasMostrar = 0;
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();
	objHttpXMLFechaValidacion.open("POST","./xml/xmlLicenciaMedica/xmlControlValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//alert("unidad="+unidad+"&fecha1="+fecha1+"&fecha2="+fecha2);
	objHttpXMLFechaValidacion.send(encodeURI("unidad="+unidad+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//alert(objHttpXMLFechaValidacion.responseText);
	var xml = objHttpXMLFechaValidacion.responseXML.documentElement;
  if (objHttpXMLFechaValidacion.responseText != "VACIO"){
  	
    mensaje += "NO PUEDE INGRESAR "+tipoTexto+" PORQUE TIENE LOS SIGUIENTES DIAS VALIDADOS:\n\n";
    if (xml.getElementsByTagName('servicio').length > 10) var cantidadDiasMostrar = 10;
    else var cantidadDiasMostrar = xml.getElementsByTagName('servicio').length;
		
    for(var i=0;i<cantidadDiasMostrar;i++){
    	var fecha = xml.getElementsByTagName('fecha')[i].text;
   		mensaje += "- FECHA: "+fecha+" \n";
		}
		
		alert(mensaje);
    return true;
	}
	return false;   
}
//fin funcion 2

/*Función que habilita el ingreso de la información del hijo, si es que se elige la opción "enfermedad grave hijo menor a un año"*/
function hijomenor(){
	var valor = document.getElementById("cbolicencia").value;
	codigoSelime();
	//alert(document.getElementById("codigoSelime").value);
	if(valor==162){
		document.getElementById("seccion3a").style.display="block";
	}
	else{
		document.getElementById("seccion3a").style.display="none";
	}
}

/*Función que habilita el ingreso de la especialidad del medico, si es que se elije dicha opción*/
function especialidad(){
	var medico = document.getElementById("optionMed").checked;
	if(medico){
		document.getElementById("seccion5a").style.display="block";
	}
	else{
		document.getElementById("seccion5a").style.display="none";
	}
}

/*Función para limitar el ingreso de caracteres en un campo determinado, además de restringir el ingreso de los caracteres que se indiquen (solo números, solo letras o solo carecteres de RUN)*/
function maximo(objeto,maxi,tipo){
	if(objeto.value.length >= maxi){
		window.event.keyCode=0;
		return false;
	}
	if(tipo=="C"){
		solo_char();
	}
	else if(tipo=="N"){
		solo_num();
	}
	else if(tipo=="R"){
		solo_rut();
	}
}

/*Función de apoyo de "maximo", está restringe el ingreso a solo números al campo indicado*/   
function solo_num(){
	var key=window.event.keyCode;
	if(key==13)Objeto.blur();
	if (key < 48 || key > 57){
		window.event.keyCode=0;
	}
}

/*Función de apoyo de "maximo", está restringe el ingreso a solo letras al campo indicado*/
function solo_char(){
	var key=window.event.keyCode;
	if(key==13)Objeto.blur();
	if (key > 48 && key < 57){
		window.event.keyCode=0;
	}
}

/*Función de apoyo de "maximo", está restringe el ingreso a solo caracteres permitidos en el RUN como son los números y la letra K*/
function solo_rut(){
	var key=window.event.keyCode;
	if(key==13)Objeto.blur();
	if ((key < 48 || key > 57)&&(key != 75 && key != 107)){
		window.event.keyCode=0;
	}
}

/*Función para dar formato de RUN a un campo determinado*/
function formato_rut(rut){
		
	var sRut1 = rut.value;      //contador de para saber cuando insertar el . o la -
	var nPos = 0; 							//Guarda el rut invertido con los puntos y el guión agregado
	var sInvertido = ""; 				//Guarda el resultado final del rut como debe ser
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
	//Pasamos al campo el valor formateado
	rut.value = sRut.toUpperCase();
	Valida_Rut(rut);
}

/*Función para validar que el RUN ingresado sea valido*/
function Valida_Rut(Objeto){
	
	var tmpstr = "";
	var intlargo = Objeto.value
	var key=window.event.keyCode;
	
	if (intlargo.length> 0){
		
		crut = Objeto.value
		largo = crut.length;
		if ( largo <2 ){
			alert('rut inválido')
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
		//validaPermiso();
		return true;
	}
}

/*Función para subir el archivo digital al servidor, con formato RUN+"-"+COLORLICENCIA+" "+FOLIOLICENCIA */
function subirArchivo(boton){
	var rutaArchivo 						= document.getElementById("archivo").value;
	var arrayRutaArchivo 				= rutaArchivo.split("\\");
	var cantidadArreglo 				= arrayRutaArchivo.length;
	var nombreDelArchivo 				= arrayRutaArchivo[cantidadArreglo-1];	
	var archivoServidor					=	document.getElementById("archivoServidor").value;	
	var extension 							= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toUpperCase(); 	
	var extensiones_permitidas 	= new Array(".JPG", ".JPEG", ".PNG", ".PDF");
	var noaceptada  						= true;
	var rutsinchar							= document.getElementById("txtrut").value;
	var folioColor 							= document.getElementById("Listcolor").value+document.getElementById("txtfolio").value;
	
	for (var i = 0; i < extensiones_permitidas.length; i++) {
    if (extensiones_permitidas[i] == extension) {
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

/*Función para validar el ingreso de los datos de la ficha*/
function validarLicenciaMedica(){
	
	var color						= eliminarBlancos(document.getElementById("Listcolor").value);
	var folio						= document.getElementById("txtfolio").value;
	var rut							= eliminarBlancos(document.getElementById("txtrut").value);
	var fechaOto				= document.getElementById("txtfec1").value;
	var fechaRep				= document.getElementById("txtfec2").value;
	var dias						= document.getElementById("txtdias").value;
	var licencia		 		= document.getElementById("cbolicencia").value;
	var reposo			 		= document.getElementById("cboReposo").value;
	var rutMedico				= eliminarBlancos(document.getElementById("txtrutp").value);
	var especialidad		= document.getElementById("cboEspecialidad").value;
	var tprofesional		= document.getElementById("optionMed").checked;
	var archivo					= document.getElementById("archivo").value;
	var archivoLoad			= document.getElementById("archivoLoad").value;
	var rutHijo 				= eliminarBlancos(document.getElementById("txtruth").value);
	var fechaHijo				= document.getElementById("txtfec3").value;
	var fechaTermino		= document.getElementById("textFechaTermino").value;
	var fechaInicioR		= document.getElementById("fechaReal").value;
	var fechaHoy				= new Date();
	fechaHoy.setDate(fechaHoy.getDate() + 9);
	if(fechaInicioR=="")fechaInicioR=fechaRep;
	
	var parts = fechaTermino.split("-");
  fechaTermino = new Date(parts[2], parts[1]-1, parts[0]);
  
  parts = fechaInicioR.split("-");
  fechaInicioR = new Date(parts[2], parts[1]-1, parts[0]);
  
  parts = fechaRep.split("-");
  fechaRep = new Date(parts[2], parts[1]-1, parts[0]);
	
	if (rut == "") {
		alert("DEBE INDICAR RUT ...... 	     ");
		document.getElementById("txtrut").focus();
		return false;
	}
	
	var tipoTexto = "";
	if(color == "PP"){
		tipoTexto = "PERMISO";
	}
	else if(color == "MP"){
		tipoTexto = "RESOLUCIÓN";
	}
	else{
		tipoTexto = "LICENCIA";
	}
	
	if (color == "") {
		alert("DEBE INDICAR EL TIPO DE "+tipoTexto+" ...... 	     ");
		document.getElementById("Listcolor").focus();
		return false;
	}
	
	if (folio == 0) {
		alert("DEBE INGRESAR EL FOLIO DE "+tipoTexto+"  ...... 	     ");
		document.getElementById("txtfolio").focus();
		return false;
	}
	
	if (fechaOto == 0) {
		alert("DEBE INDICAR LA FECHA DE OTORGAMIENTO  ...... 	     ");
		document.getElementById("txtfec1").focus();
		return false;
	}
	
	if (fechaRep == "NaN") {
		alert("DEBE INDICAR LA FECHA DE REPOSO  ...... 	     ");
		document.getElementById("txtfec2").focus();
		return false;
	}
	
	if (dias == 0) {
		alert("DEBE INGRESAR LA CANTIDAD DE DIAS DE "+tipoTexto+"  ...... 	     ");
		document.getElementById("txtdias").focus();
		return false;
	}
	
	if (fechaInicioR < fechaRep) {
		alert("LA FECHA DE INICIO REAL NO PUEDE SER INFERIOR A LA FECHA DE INICIO DE "+tipoTexto+"  ...... 	     "+document.getElementById("fechaReal").value+">"+document.getElementById("txtfec2").value);
		document.getElementById("fechaReal").focus();
		return false;
	}
	
	if (fechaInicioR > fechaTermino) {
		alert("LA FECHA DE INICIO REAL NO PUEDE SER SUPERIOR A LA FECHA DE TERMINO DE "+tipoTexto+"  ...... 	     "+document.getElementById("fechaReal").value+">"+document.getElementById("textFechaTermino").value);
		document.getElementById("fechaReal").focus();
		return false;
	}
	
	if((color != "PP") && (color != "MP")){
		
		if(licencia==4){
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
			document.getElementById("cbolicencia").focus();
			return false;
		}
		
		if (reposo == 0) {
			alert("DEBE SELECCIONAR LA CARACTERISTICA DEL REPOSO ...... 	     ");
			document.getElementById("cboReposo").focus();
			return false;
		}
		
		if (rutMedico == "") {
			alert("DEBE INDICAR RUT DEL PROFESIONAL ...... 	     ");
			document.getElementById("txtrutp").focus();
			return false;
		}
		
		if (tprofesional) {
			if (especialidad == 0) {
				alert("DEBE SELECCIONAR LA ESPECIALIDAD DEL PROFESIONAL ...... 	     ");
				document.getElementById("cboEspecialidad").focus();
				return false;
			}
		}
		
		var servicioTemporal =	verificaServicioLicenciaTemporal();
  	if(servicioTemporal){
    	return false;
		}
		
	}
	
	var licenciaVerificar = controlLicenciaFuncionario(color,folio);
	//alert(licencia2);  
	if(licenciaVerificar == 1){
	  return false;
	}
	
	var servicioVerificar = verificaExisteServicio(tipoTexto);
	//alert(servicioVerificar);  
	if(servicioVerificar){
	  return false;
	}
	
	//var validacionVerificar = verificaExisteValidacion(tipoTexto,'valida');
	//alert("ERROR ACA");
	//alert(validacionVerificar);
	//if(validacionVerificar){
	//  return false;
	//}
	
	if (archivo == "") {
		alert("DEBE SUBIR EL DOCUMENTO ESCANEADO ...... 	     ");
		return false;
	}
	
	if (archivoLoad == 0) {
		alert("DEBE PRESIONAR EL BOTON SUBIR PARA CARGAR EL DOCUMENTO AL SISTEMA ...... 	     ");
		return false;
	}
	
	if (fechaRep >= fechaHoy ) {
		alert("SE ADVIERTE QUE LA LICENCIA ESTA SIENDO INGRESADA PARA 10 DIAS DESPUES DE LA FECHA ACTUAL ...... 	     ");
	}
	
	return true;
}

/*Función para validar si se ingresarón los datos necesarios para subir el archivo*/
function validarSubir(){
	var rut 	= document.getElementById('txtrut').value;
	var color = document.getElementById('Listcolor').value;
	var folio = document.getElementById('txtfolio').value;
	var fecha = new Date();
	
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

function controlFuncionarioAsignado(funcionario,fecha1,fecha2){ 
  
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaServiciosPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("codigoFuncionario="+funcionario+"&fecha1="+fecha1+"&fecha2="+fecha2));  
	// alert(objHttpXMLLicencias.responseText); 
	var xml = objHttpXMLLicencias.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
	
	if (objHttpXMLLicencias.responseText != "VACIO"){
		//alert("Tiene servicios asignados.");  
		
		mensaje += "NO PUEDE INGRESAR LA LICENCIA PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 		= xml.getElementsByTagName('fecha')[i].text;
			var servicio	= xml.getElementsByTagName('desServicio')[i].text;
			var unidad 	  = xml.getElementsByTagName('desUnidad')[i].text;
			
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}     
}

function controlLicenciaFuncionario(color,folio){ 
	
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("color="+color+"&folio="+folio));  
	//alert(objHttpXMLLicencias.responseText); 
	var xml = objHttpXMLLicencias.responseXML.documentElement;
	//return xml.getElementsByTagName('licencia')[0]; 
	
	if (objHttpXMLLicencias.responseText != "VACIO"){
	
		mensaje += "NO PUEDE INGRESAR LA LICENCIA PORQUE YA EXISTE:\n\n";
		if (xml.getElementsByTagName('licencia').length >= 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('licencia').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var color 		         = xml.getElementsByTagName('color')[i].text;
			var folio 	         = xml.getElementsByTagName('folio')[i].text;
			
			mensaje += (i+1) +". COLOR: " + color+" Y FOLIO: "+folio.toUpperCase()+"\n";
		}
		if (cantidadServiciosMostar = xml.getElementsByTagName('licencia').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

//Funcion servicio asignado
function verificaExisteServicio(tipoTexto){ 
	
	var codFuncionario 	 = document.getElementById("codigoFuncionario").value;
	var fecha1 	 = document.getElementById("fechaReal").value;
	var fecha2	 = document.getElementById("textFechaTermino").value;
	var fechaI	 = document.getElementById("txtfec2").value;
	if(fecha1=="")fecha1=fechaI;
	var mensaje	 = "";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaServicios.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("funcionario="+codFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));  
	//alert(objHttpXMLLicencias.responseText); 
	var xml = objHttpXMLLicencias.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0];
	if (objHttpXMLLicencias.responseText != "VACIO"){
		//alert("Tiene servicios asignados.");
		mensaje += "NO PUEDE INGRESAR "+tipoTexto+" PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 	 = xml.getElementsByTagName('fecha')[i].text;
			var servicio = xml.getElementsByTagName('desServicio')[i].text;
			var unidad 	 = xml.getElementsByTagName('desUnidad')[i].text;
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}
//fin nueva funcion

function servicioLicenciaCorrelativo(funcionario,fecha1,fecha2,servicio){ 
	
	var codigoFuncionario=document.getElementById("codigoFuncionario").value;
	if(codigoFuncionario != ""){
		var unidad=document.getElementById("unidadFuncionario").value;
		var fechaRealI = document.getElementById("fechaReal").value;
		var fechaRealT = document.getElementById("fechaTerminoReal").value;
		var fecha1=document.getElementById("txtfecF").value;
		var fecha2=document.getElementById("textFechaTermino").value;
		var servicio=document.getElementById("servicio").value;
		var arreglo = new Array();
		var arrayCorrelativoPaso = new Array();
		
		var mensaje="";
		var objHttpXMLLicencias = new AJAXCrearObjeto();
		objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaServiciosPorFuncionario.php",false);
		objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLLicencias.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2+"&fechaIR="+fechaRealI+"&fechaTR="+fechaRealT+"&servicio="+servicio));
		//alert(objHttpXMLLicencias.responseText);
		var xml = objHttpXMLLicencias.responseXML.documentElement;
		//return xml.getElementsByTagName('servicio')[0];
		//alert(objHttpXMLLicencias.responseText);
		if (objHttpXMLLicencias.responseText != "VACIO"){
			
			var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length
			for(var i=0;i<cantidadServiciosMostar;i++){
				//var fecha 		  = xml.getElementsByTagName('fecha')[i].text;
				var correlativo	= xml.getElementsByTagName('correlativoServicio')[i].text;
				
				arreglo[i]=correlativo;
				arrayCorrelativoPaso[0] = new Array();
				
				var arregloCorrelativos	= php_serialize(arreglo);
				//alert("gsagagsa"+arregloCorrelativos);
				//Guardar en un arreglo
			}
			var arregloCorrelativos	= php_serialize(arreglo);
			document.getElementById("correlativo").value=arregloCorrelativos;
			//alert(arregloCorrelativos	);
			return 1;
		}
	}
}

function servicioTerminoCorrelativo(funcionario,fecha1,fecha2,servicio){ 
	
	var codigoFuncionario=document.getElementById("codigoFuncionario").value; 
	var unidad=document.getElementById("unidadFuncionario").value; 
	/*var fecha1=document.getElementById("txtfec2").value;
	var fecha2	 = document.getElementById("txtfecF").value;*/
	var fecha1=document.getElementById("txtfecF").value;
	var fecha2=document.getElementById("textFechaTermino").value;
	var servicio=document.getElementById("servicio").value; 
	
	var arreglo = new Array();
	var arrayCorrelativoPaso = new Array();
	
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaServiciosPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicio="+servicio));
	//alert(objHttpXMLLicencias.responseText);
	var xml = objHttpXMLLicencias.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0];
	
	if (objHttpXMLLicencias.responseText != "VACIO"){
		var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length
		for(var i=0;i<cantidadServiciosMostar;i++){
			//var fecha 		  = xml.getElementsByTagName('fecha')[i].text;
			var correlativo	= xml.getElementsByTagName('correlativoServicio')[i].text;
			
			arreglo[i]=correlativo;
			arrayCorrelativoPaso[0] = new Array();
			
			var arregloCorrelativos	= php_serialize(arreglo);
			//alert("gsagagsa"+arregloCorrelativos);
			//Guardar en un arreglo
		}
		//if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
		//alert(mensaje);
		var arregloCorrelativos	= php_serialize(arreglo);
		document.getElementById("correlativoAnticipado").value=arregloCorrelativos;
		//alert(arregloCorrelativos	);
		return 1;
	}
}

function capturaCorrelativo(){
	
	var unidad 	 = document.getElementById("unidadFuncionario").value;
  var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlLicenciaMedica/xmlCorrelativoAnterior.php",false);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("unidad="+unidad));
	//alert(objHttpXMLServicios.responseText);
	if (objHttpXMLServicios.responseText != "VACIO") {
		var xml = objHttpXMLServicios.responseXML.documentElement;
		//var ultimoCorrelativo	=  xml.getElementsByTagName('ultimoCorrelativo')[0].text;
		//document.getElementById("correlativo").value=ultimoCorrelativo;
		document.getElementById("correlativo").value = xml.getElementsByTagName('ultimoCorrelativo')[0].text;
	}
  //document.getElementById("correlativo").value=ultimoCorrelativo;
}

function buscaDatosFichaLicencia(){
	
	var codFuncionario		= eliminarBlancos(document.getElementById("codigoFuncionario").value.toUpperCase());
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
				var xml 				  		= objHttpXMLLicencias.responseXML.documentElement;
				var codigo	 			  	= "";
				var apellidoPaterno		= "";
				var apellidoMaterno		= "";
				var primerNombre	 	  = "";
				var segundoNombre	 	  = "";
        var rut		  					= "";
        var color		  				= "";
        var folio		  				= "";
        var fechaO		  			= "";
        var fechaI		  			= "";
        var dias		  				= "";
        var fechaR		  			= "";
        var tipoLicencia 			= "";
        var recuperacion 			= "";
        var invalidez 				= "";
      	var tipoReposo 				= "";
      	var lugarReposo 			= "";
      	var rutProfesional 		= "";
      	var tipoProfesional 	= "";
      	var especialidad 			= "";
      	var tipoAtencion 			= "";
      	var rutHijo 					= "";
        var fechaHijo		  		= "";
        var archivo 					= "";
        var fechaTermino			= "";
        var unidad 						= "";
        
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo	 		  		 	= xml.getElementsByTagName('codigo')[i].text;
					apellidoPaterno	  	= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellifoMaterno   	= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre 	  		= xml.getElementsByTagName('nombre')[i].text;
					segundoNombre 	  	= xml.getElementsByTagName('nombre2')[i].text;
          rut 								= xml.getElementsByTagName('rut')[i].text;
          fechaO 							= xml.getElementsByTagName('fechaO')[i].text;
          fechaI 							= xml.getElementsByTagName('fechaI')[i].text;
          dias 								= xml.getElementsByTagName('dias')[i].text;
          fechaIR 						= xml.getElementsByTagName('fechaIR')[i].text;
          fechaTR 						= xml.getElementsByTagName('fechaTR')[i].text;
          tipoLicencia 				= xml.getElementsByTagName('tipoLicencia')[i].text;
          recuperacion 				= xml.getElementsByTagName('recuperacion')[i].text;
          invalidez 					= xml.getElementsByTagName('invalidez')[i].text;
          tipoReposo 					= xml.getElementsByTagName('tipoReposo')[i].text;
          lugarReposo 				= xml.getElementsByTagName('lugarReposo')[i].text;
          rutProfesional 			= xml.getElementsByTagName('rutProfesional')[i].text;
          tipoProfesional 		= xml.getElementsByTagName('tipoProfesional')[i].text;
          especialidad 				= xml.getElementsByTagName('especialidad')[i].text;
          tipoAtencion 				= xml.getElementsByTagName('tipoAtencion')[i].text;
          rutHijo 						= xml.getElementsByTagName('rutHijo')[i].text;
          fechaHijo 					= xml.getElementsByTagName('fechaHijo')[i].text;
          archivo 						= xml.getElementsByTagName('archivo')[i].text; 
          fechaTermino				= xml.getElementsByTagName('fechaTerminoInicial')[i].text;
          unidad              = xml.getElementsByTagName('unidad')[i].text;
					
					document.getElementById("fotoFuncionario").src		= "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";
					document.getElementById("idFuncionario").value		= codigo;
					document.getElementById("txtrut").value						= rut;
					document.getElementById("txtape1").value 					= apellidoPaterno;
					document.getElementById("txtape2").value 					= apellifoMaterno;
					document.getElementById("txtnom").value 	 				= primerNombre+" "+segundoNombre;
					document.getElementById("txtfec1").value 		 			= fechaO;
					document.getElementById("txtfec2").value 	 				= fechaI;
					document.getElementById("fechaReal").value 	 			= fechaIR;
					document.getElementById("fechaTerminoReal").value	= fechaTR;
					document.getElementById("txtdias").value 	 				= dias;
					
					if(tipoLicencia == "713" || tipoLicencia == "632"){
						document.getElementById("seccion3").style.display="none";
						document.getElementById("seccion3a").style.display="none";
						document.getElementById("seccion4").style.display="none";
						document.getElementById("seccion5").style.display="none";
						document.getElementById("seccion5a").style.display="none";
						document.getElementById("txtarchivo").value = archivo;
					}
					else{
    				document.getElementById('cboLicencia').value 									= tipoLicencia;
    				document.getElementById('optionRecup'+recuperacion).checked 	= "checked";
    				document.getElementById('optionInvalidez'+invalidez).checked 	= "checked";
    				document.getElementById('txtruth').value 											= rutHijo;
    				document.getElementById('txtfec3').value 											= fechaHijo;
    				document.getElementById('cboReposo').value 										= tipoReposo;
    				document.getElementById('optionReposo'+lugarReposo).checked 	= "checked";
						document.getElementById("txtrutp").value 	 										= rutProfesional;
						document.getElementById('cboEspecialidad').value 							= especialidad;
    				document.getElementById('optionMed'+tipoProfesional).checked 	= "checked";
    				document.getElementById('optionAte'+tipoAtencion).checked 		= "checked";
						document.getElementById("txtarchivo").value 	 								= archivo;
						document.getElementById("servicio").value 	 									= tipoLicencia;
					}
					
					document.getElementById("textFechaTermino").value 	 	=  fechaTermino;
					document.getElementById("fechaTerminoInicial").value	=  fechaTermino;
					document.getElementById("unidadFuncionario").value 	 	=  unidad;
					
					if(document.getElementById('optionMed1').checked){
						document.getElementById("seccion5a").style.display="block";
					}
					
					document.getElementById("mensajeCargando").style.display = "none";
				}
			}
		}
	}
}

function leeTipoLicencia(nombreObjeto){
	
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var color				= document.getElementById("txtcolor").value;
	if(color=="PP" || color=="MP") return false;
	var objHttpXMLEstado = new AJAXCrearObjeto();
	objHttpXMLEstado.open("POST","./xml/xmlLicenciaMedica/xmlTipoLicencia.php",true);
	objHttpXMLEstado.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstado.send(encodeURI());
	objHttpXMLEstado.onreadystatechange=function(){
		if(objHttpXMLEstado.readyState == 4){
			//alert(objHttpXMLEstado.responseText);
			if (objHttpXMLEstado.responseText != "VACIO"){
				var xml 			= objHttpXMLEstado.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";

				document.getElementById(nombreObjeto).length = null;
				
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 1000, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				
				for(i=0;i<xml.getElementsByTagName('tipo').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].text;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].text;
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
			}
		}
	}
}

function mensajeLicencia(unidad,fecha,servicio){
	
	var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	var f=new Date();
	//document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
	var fechaHoy =diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
	
	//var unidad="7800";
	var unidad = document.getElementById("unidad").value;
	var fecha = document.getElementById("fecha").value;
	//var fecha="20160913";
	
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlMensajeLicencia.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("unidad="+unidad+"&fecha="+fecha));
	//alert(objHttpXMLLicencias.responseText);
	var xml = objHttpXMLLicencias.responseXML.documentElement;
	//return xml.getElementsByTagName('licencia')[0];
	if (objHttpXMLLicencias.responseText != "VACIO"){
		//alert(objHttpXMLLicencias.responseText);
		mensaje += "LICENCIAS INGRESADAS: "+fechaHoy.toUpperCase()+"\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var grado 		  = xml.getElementsByTagName('grado')[i].text;
			var nom1 		    = xml.getElementsByTagName('nombre')[i].text;
			var nom2 		    = xml.getElementsByTagName('nombre2')[i].text;
			var ape1 	      = xml.getElementsByTagName('apellidoPaterno')[i].text;
			var ape2        = xml.getElementsByTagName('apellidoMaterno')[i].text;
			var licencia 	  = xml.getElementsByTagName('licenciaMedica')[i].text;
			var codigo	    = xml.getElementsByTagName('codigo')[i].text;
			var estado	    = xml.getElementsByTagName('estado')[i].text;
			var estadoDesc	= "";
			if(estado=="2") estadoDesc = " - (ANULADA)";
			mensaje += (i+1) +". " + grado+" "+nom1+" "+nom2+" "+ape1+" "+ape2+" ("+codigo+")"+", TIPO LICENCIA: ("+licencia.toUpperCase()+")"+estadoDesc+".\n";
		}
		if (cantidadServiciosMostar = xml.getElementsByTagName('servicio').length) mensaje += "...";
		alert(mensaje);
		return 1;
	}
}

function actualizarLicencia(){
	
	var codigoFuncionario = document.getElementById("codigoFuncionario").value;
	var unidadUsuario		= document.getElementById("unidadUsuario").value;
	var color				= document.getElementById("txtcolor").value;
	var folio 				= document.getElementById('txtfolio').value;
	var correlativo	=	servicioLicenciaCorrelativo();
	var correlativo 				= document.getElementById('correlativo').value;
	
	var fechaInicioReal = document.getElementById("fechaReal").value;
	var fechaTerminoReal = document.getElementById("txtfecF").value;
	var fechaTerminoInicial = document.getElementById("txtfecF").value;
	var fechaTermino = document.getElementById("fechaTerminoReal").value;
	var correlativoTermino = document.getElementById("correlativoAnticipado").value;
	
	var unidadFuncionario = document.getElementById("unidadFuncionario").value;
	var fechaInicial = document.getElementById("txtfec2").value;
	
	var estado 	= document.getElementById("UltimoEstado").value;
	
	var parametros = ""; 
	parametros =  "color="+color+"&folio="+folio+"&correlativo="+correlativo+"&codigoFuncionario="+codigoFuncionario+"&fechaTerminoInicial="+fechaTerminoInicial+"&correlativoTermino="+correlativoTermino+"&fechaTerminoReal="+fechaTerminoReal+"&unidadFuncionario="+unidadFuncionario+"&fechaInicial="+fechaInicial+"&fechaTermino="+fechaTermino+"&fechaInicioReal="+fechaInicioReal+"&estado="+estado;
	
	//alert(parametros);
  var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlLicenciaActualizar.php",true);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI(parametros));
	objHttpXMLLicencias.onreadystatechange=function(){
		if(objHttpXMLLicencias.readyState == 4){
			if (objHttpXMLLicencias.responseText != "VACIO"){
				//alert(objHttpXMLLicencias.responseText);
				var xml = objHttpXMLLicencias.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 AnulaLicenciaSelime();
						 alert('LOS DATOS FUERON MODIFICADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeLicencia(unidadUsuario, '', '');
						 idCargaListadoLicencias = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function modificarLicencia(){
	
	//var fechaTermino = document.getElementById("txtfecF").value;
	var rut = document.getElementById('codigoFuncionario').value;
	var color = document.getElementById('txtcolor').value;
	var folio = document.getElementById('txtfolio').value;
	var fechaReal = document.getElementById("fechaTerminoReal").value;
	//var fechaTermino = document.getElementById("txtfecF").value;
	
	var licencias = controlLicenciaFuncionarioAnulada(color,folio);
  //alert(licencias);
	if(licencias == 1)	return false;
  
  var tipoTexto = "";
	if(color == "PP"){
		tipoTexto = "PERMISO";
	}
	else if(color == "MP"){
		tipoTexto = "RESOLUCIÓN";
	}
	else{
		tipoTexto = "LICENCIA";
	}
	
	var validacionVerificar = verificaExisteValidacion(tipoTexto,'anular');
	//alert(validacionVerificar);
	if(validacionVerificar){
	  return false;
	}
  
	var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTA LICENCIA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
	if (msj){
	document.getElementById("txtfecF").value = fechaReal;
	actualizarLicencia();
	} else {
	////activarBotones();
	return false;
	}
	document.getElementById('btnAnular').value = "ANULANDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
	//actualizarLicencia();
}

function recortarLicencia(){
	
	var fechaTermino 	= document.getElementById("txtfecF").value;
	var fechaInicioR 	= document.getElementById("fechaReal").value;
	var fechaTerminoR = document.getElementById("textFechaTermino").value;
	var fechaTerminoReal	= document.getElementById("fechaTerminoReal").value;
	var color							= eliminarBlancos(document.getElementById("Listcolor").value);
	
	//alert("Anticipado: "+fechaTermino);
	//alert("Termino real :"+fechaTerminoReal);
	//alert("Termino normal: "+fechaTerminoR);
	
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
	if(color == "PP"){
		tipoTexto = "PERMISO";
	}
	else if(color == "MP"){
		tipoTexto = "RESOLUCIÓN";
	}
	else{
		tipoTexto = "LICENCIA";
	}
	
	var validacionVerificar = verificaExisteValidacion(tipoTexto,'recortar');
	//alert(validacionVerificar);
	if(validacionVerificar){
	  return false;
	}
	
	var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTA LICENCIA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
	if (msj){
  servicioTerminoCorrelativo();
	actualizarLicencia();
	
	} else {
		////activarBotones();
		return false;
	}
	document.getElementById('btnGuardarLicencia').value = "RECORTANDO ...";
	document.getElementById("mensajeGuardando").style.display = "";
	document.getElementById("mensajeGuardando").style.left = "170px";
	document.getElementById("mensajeGuardando").style.top  = "200px";
	//actualizarLicencia();
}

function inicioReal(){
	var inicio = document.getElementById("optionInicio").checked;	
	if(inicio){
		document.getElementById("seccion1a").style.display="block";
		}
	else{
		document.getElementById("seccion1a").style.display="none";
	}
}

function controlLicenciaFuncionarioAnulada(color,folio){
  
	var mensaje="";
	var objHttpXMLLicencias = new AJAXCrearObjeto();
	objHttpXMLLicencias.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaAnuladaPorFuncionario.php",false);
	objHttpXMLLicencias.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLicencias.send(encodeURI("color="+color+"&folio="+folio));
	//alert(objHttpXMLLicencias.responseText);
	var xml = objHttpXMLLicencias.responseXML.documentElement;
	//return xml.getElementsByTagName('licencia')[0];
	
	if (objHttpXMLLicencias.responseText != "VACIO"){
		
		var folio		= xml.getElementsByTagName('folio')[0].text;
		var color		= xml.getElementsByTagName('color')[0].text;
		var estado	= xml.getElementsByTagName('estado')[0].text;
		document.getElementById("UltimoEstado").value	= estado;
		
		switch(color){
			case 'AA':
				color = 'LICENCIA INSTITUCIONAL';
			break;
			case 'B':
				color = 'LICENCIA DIPRECA';
			break;
			case 'N':
				color = 'LICENCIA ARMADA';
			break;
			case 'E':
				color = 'LICENCIA EJERCITO';
			break;
			case 'F':
				color = 'LICENCIA FACH';
			break;
			case 1:
				color = 'LICENCIA FONASA';
			break;
			case 2:
				color = 'LICENCIA ISAPRE';
			break;
			case 3:
				color = 'LICENCIA HOSPITAL PUBLICO O MEDICO EXTERNO';
			break;
			case 'PP':
				color = 'PERMISO POSTNATAL PARENTAL';
			break;
			case 'MP':
				color = 'RESOLUCIÓN MEDICINA PREVENTIVA';
			break;
		}
		
		/*--- Cantidad de veces que puede anular una licencia ---*/
  	if(estado==4){
  		mensaje += "NO PUEDE ANULAR LA LICENCIA, PORQUE ESTE YA FUE ANULADO 3 VECES ANTERIORMENTE: \n";
    	if (xml.getElementsByTagName('licencia').length >= 10) var cantidadServiciosMostar = 10;
    	else var cantidadServiciosMostar = xml.getElementsByTagName('licencia').length;
	  	for(var i=0;i<cantidadServiciosMostar;i++){
		  	mensaje += "            "+color.toUpperCase()+" - FOLIO:  "+folio.toUpperCase()+"\n";
			}
			alert(mensaje);
			return 1;
  	}
		else if(estado==1){
			mensaje += "USTED ANULARÁ LA LICENCIA INDICADA, POR LO QUE LE QUEDARÁN 3 OPORTUNIDADES RESTANTES. \n";
		}
		else if(estado==2){
			mensaje += "ANULARÁ EL PERMISO POR SEGUNDA VEZ, SOLO QUEDARÁN 2 OPORTUNIDADES RESTANTES PARA LA ANULACIÓN. \n";
		}
		else if(estado==3){
			mensaje += "ESTA ES SU ÚLTIMA OPORTUNIDAD DE ANULACIÓN. \n";
		}
		alert(mensaje);
	}
}

function codigoSelime(){
	
	var tipoLicencia = document.getElementById('cboLicencia').value;
	var codigo 		= "";
	
	var objHttpXMLCodigo = new AJAXCrearObjeto();
	objHttpXMLCodigo.open("POST","./xml/xmlLicenciaMedica/xmlCodigoLicenciaSelime.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI("tipoLicencia="+tipoLicencia));
	
	objHttpXMLCodigo.onreadystatechange=function(){
		if(objHttpXMLCodigo.readyState == 4){
			//alert(objHttpXMLCodigo.responseText);
			if (objHttpXMLCodigo.responseText != "VACIO"){
				var xml 			= objHttpXMLCodigo.responseXML.documentElement;
				var selime="";
				for(i=0;i<xml.getElementsByTagName('tipoLicencia').length;i++){
					selime 	= xml.getElementsByTagName('codigo')[0].text;
					document.getElementById("codigoSelime").value = selime;
				}
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
				var xml 			= objHttpXMLCodigo.responseXML.documentElement;
				var rut 		= "";
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					rut 			= xml.getElementsByTagName('rut')[i].text;
					document.getElementById("rutUsuario").value = rut;
				}
			}
		}
	}
}

function reparticionCodigo(){
	
	var objHttpXMLCodigo = new AJAXCrearObjeto();
	objHttpXMLCodigo.open("POST","./xml/xmlLicenciaMedica/xmlreparticionCodigo.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI());
	objHttpXMLCodigo.onreadystatechange=function(){
		if(objHttpXMLCodigo.readyState == 4){
			//alert(objHttpXMLCodigo.responseText);
			if (objHttpXMLCodigo.responseText != "VACIO"){
				var xml 			= objHttpXMLCodigo.responseXML.documentElement;
				var codigo 		= "";
				
				//for(i=0;i<xml.getElementsByTagName('unidad').length;i++){
				codigo 			= xml.getElementsByTagName('codigo')[0].text;
				document.getElementById("reparticionCodigo").value = codigo;
				reparticionDescripcion(codigo);
				//}
			}
			else{
				alert("SU REPARTICION NO APARECE REGISTRADA EN SELIME WEB, POR FAVOR COMUNICARSE CON EL DEPARTAMENTO CONTROL DE GESTIÓN PARA DAR SOLUCIÓN A ESTE PROBLEMA.\n ERROR CODIGO: 000");
				idCargaListadoLicencias = setInterval("cerrarVentanaPersonal()",1000);
			}
		}
	}	
}

function reparticionDescripcion(codigo){
	
	//var codigo = document.getElementById("reparticionCodigo").value;
	var objHttpXMLCodigo = new AJAXCrearObjeto();
	objHttpXMLCodigo.open("POST","./xml/xmlLicenciaMedica/xmlreparticionDescripcion.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI("codigoUnidad="+codigo));
	objHttpXMLCodigo.onreadystatechange=function(){
		if(objHttpXMLCodigo.readyState == 4){
			//alert(objHttpXMLCodigo.responseText);
			if (objHttpXMLCodigo.responseText != "VACIO"){
				var xml 			= objHttpXMLCodigo.responseXML.documentElement;
				var descripcion 		= "";
				
				descripcion 			= xml.getElementsByTagName('descripcion')[0].text;
				document.getElementById("reparticionDescripcion").value = descripcion;
			}
		}
	}	
}

function nuevaLicenciaSelime(){
	
	var color						= document.getElementById("Listcolor").value;
	var folio						= document.getElementById("txtfolio").value;
	var rut							= document.getElementById("txtrut").value;
	var dias						= document.getElementById("txtdias").value;
	var fechaRep				= document.getElementById("txtfec2").value;	
	var licencia				= document.getElementById("codigoSelime").value;
	var fechaOto				= document.getElementById("txtfec1").value;
	var fechaRegistro		= document.getElementById("fecha").value;
	var rutUsuario			= document.getElementById("rutUsuario").value;
	var reparticionCod	= document.getElementById("reparticionCodigo").value;
	var reparticionDes	= document.getElementById("reparticionDescripcion").value;
	
	var atencion = "";
  if((color != "PP") && (color != "MP")){
   	var Latencion = document.getElementsByName("optionAte");
 		for(var i=0;i<Latencion.length;i++){
  	  if(Latencion[i].checked) atencion=Latencion[i].value;
  	}
  }
  else{
  	atencion = "1";
  }
	
	var parametros = "color="+color+"&folio="+folio+"&rut="+rut+"&dias="+dias+"&fecha2="+fechaRep+"&tipoLicencia="+licencia;
	parametros = parametros+"&atencion="+atencion+"&fecha1="+fechaOto+"&fechaRegistro="+fechaRegistro;
	parametros = parametros+"&rutUsuario="+rutUsuario+"&reparticionCod="+reparticionCod+"&reparticionDes="+reparticionDes;
	
	//alert(parametros);
	var objHttpXMLSelime = new AJAXCrearObjeto();		
	objHttpXMLSelime.open("POST","./xml/xmlLicenciaMedica/xmlNuevaLicenciaSelime.php",true);
	objHttpXMLSelime.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLSelime.send(encodeURI(parametros));
	objHttpXMLSelime.onreadystatechange=function(){
		if(objHttpXMLSelime.readyState == 4){       
			if (objHttpXMLSelime.responseText != "VACIO"){
				//alert(objHttpXMLSelime.responseText);
				var xml = objHttpXMLSelime.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo != 1){
						alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS SELIMEWEB ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
	}
}

function AnulaLicenciaSelime(){
	
	var color	= document.getElementById("txtcolor").value;
	var folio	= document.getElementById("txtfolio").value;
	var estado 	= document.getElementById("UltimoEstado").value;
	
	var parametros = "color="+color+"&folio="+folio+"&estado="+estado;
	//alert(parametros);
	var objHttpXMLSelime = new AJAXCrearObjeto();
	objHttpXMLSelime.open("POST","./xml/xmlLicenciaMedica/xmlAnulaLicenciaSelime.php",true);
	objHttpXMLSelime.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLSelime.send(encodeURI(parametros));
	objHttpXMLSelime.onreadystatechange=function(){
		if(objHttpXMLSelime.readyState == 4){       
			if (objHttpXMLSelime.responseText != "VACIO"){
				//alert(objHttpXMLSelime.responseText);
				var xml = objHttpXMLSelime.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].text;
					if (codigo != 1){
						alert('LA LICENCIA NO PUDO SER ANULADA EN LA BASE DE DATOS SELIMEWEB ....		\nCODIGO RECIBIDO : ' + codigo);
						return 0;
					}
					return 1;
				}
			}
		}
	}
}

function verificaServicioLicenciaTemporal(){ 
  
	var codFuncionario 	 = document.getElementById("codigoFuncionario").value;
	var fecha1 	 = document.getElementById("fechaReal").value;
	var fecha2	 = document.getElementById("textFechaTermino").value;
	var fechaI	 = document.getElementById("txtfec2").value;
	if(fecha1=="")fecha1=fechaI;
  var mensaje	 = "";
  var objHttpXMLPendiente = new AJAXCrearObjeto();
	objHttpXMLPendiente.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaPendiente.php",false);
	objHttpXMLPendiente.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLPendiente.send(encodeURI("funcionario="+codFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));
  //alert(objHttpXMLPendiente.responseText);
  var xml = objHttpXMLPendiente.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0];
   
  if (objHttpXMLPendiente.responseText != "VACIO"){
  	
  	mensaje += "TIENE LAS SIGUIENTES LICENCIAS MEDICAS PENDIENTES ASIGNADAS:\n\n";
  	correlativos = "";
  	unidades = "";
    if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
    else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	  for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 		        = xml.getElementsByTagName('fecha')[i].text;
		  var servicio 	        = xml.getElementsByTagName('desServicio')[i].text;
		  var unidad 	   	     	= xml.getElementsByTagName('desUnidad')[i].text;
		  var correlativo       = xml.getElementsByTagName('correlativoServicio')[i].text;
		  var codUnidad        	= xml.getElementsByTagName('codUnidad')[i].text;
		  
		 	mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		 	correlativos += correlativo+",";
		 	unidades += codUnidad+",";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
	 	alert(mensaje);
	 	var msj=confirm("SE SOBREESCRIBIRAN LAS LICENCIAS MEDICAS PENDIENTES POR LA LICENCIA INDICADA.          \n¿DESEA CONTINUAR?");
		if (msj){
			correlativos = correlativos.substring(0,correlativos.length-1);
			unidades = unidades.substring(0,unidades.length-1);
			borrarLicenciaPendiente(correlativos, unidades);
			return 0;
		}
		return 1;
	}
}

function borrarLicenciaPendiente(correlativo, codUnidad){
	
	var codFuncionario	= document.getElementById("codigoFuncionario").value;
	var parametros = "funcionario="+codFuncionario+"&correlativo="+correlativo+"&unidad="+codUnidad;
	//alert(parametros);
	
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
					var codigo = xml.getElementsByTagName('resultado')[i].text;
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

/* Resolución comisión medica y Permiso parental */
function validaPermiso(){
	
	var color = document.getElementById("Listcolor").value;
	var rut = document.getElementById("txtrut").value;
	var folio = document.getElementById("txtfolio").value;
	var unidad = document.getElementById("unidadFuncionario").value;
	
	if(color == "PP"){
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
			document.getElementById("Mensaje").innerHTML = "(*) El permiso postnatal parental, no se trata de una licencia médica, pero se podrá ingresar dentro de este módulo para facilitar su registro y mantener un control del mismo.";
			correlativoPermisoParental();
		}
	}
	else if(color == "MP"){
		document.getElementById("txtfolio").value = "";
		document.getElementById('seccion5').style.display="none";
		document.getElementById('seccion4').style.display="none";
		document.getElementById('seccion3').style.display="none";
		document.getElementById('seccionMensaje').style.display="block";
		document.getElementById("Mensaje").innerHTML = "(*) El reposo indicado por medicina preventiva, deberá ingresarse a través de este módulo, ya que para efectos de registro será tratada como una licencia médica.";
		document.getElementById('txtfolio').style.display="block";
	}
	else{
		document.getElementById('seccionMensaje').style.display="none";
		document.getElementById("Mensaje").innerHTML = "";
		document.getElementById('seccion5').style.display="block";
		document.getElementById('seccion4').style.display="block";
		document.getElementById('seccion3').style.display="block";
		document.getElementById('txtfolio').style.display="block";
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
	//alert(parametros);
	var objHttpXMLPermisoParental = new AJAXCrearObjeto();
	objHttpXMLPermisoParental.open("POST","./xml/xmlLicenciaMedica/xmlCorrelativoPermisoParental.php",true);
	objHttpXMLPermisoParental.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLPermisoParental.send(encodeURI(parametros));
	objHttpXMLPermisoParental.onreadystatechange=function(){
		//alert(objHttpXMLPermisoParental.responseText);
		if(objHttpXMLPermisoParental.readyState == 4){
			if (objHttpXMLPermisoParental.responseText != "VACIO") {
				var xml = objHttpXMLPermisoParental.responseXML.documentElement;
				var correlativo = xml.getElementsByTagName('ultimoCorrelativo')[0].text;
				document.getElementById("txtfolio").value = unidadFuncionario+"00"+correlativo;
				validarSubir();
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
				
			var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
			document.getElementById('cboEspecialidad').options[0] = datosOpcion;
			
			for(i=0;i<cantidad;i++){
				var codigo = xml.getElementsByTagName('codigo')[i].text;
				var descripcion = xml.getElementsByTagName('descripcion')[i].text;
				
				var datosOpcion = new Option(descripcion, codigo, "", "");
				document.getElementById('cboEspecialidad').options[i+1] = datosOpcion;
			}
			cargaCargos = 1;
			}
		}
	}
}