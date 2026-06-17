var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionarios(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Licencia ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaFuncionarioLicencia.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));  
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 						= objHttpXMLFuncionarios.responseXML.documentElement;
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
				var listadoFuncionarios	= "";
								
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
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
					var dblClick = "javascript:abrirVentana('LICENCIA MEDICA ... ', '920', '780','fichaAjusteLicencia.php?codigoFuncionario="+codigo+"&codColor="+Color+"&codFolio="+Folio+"','"+nroLinea+"','','5','5')";
					
					//alert(dblClick);
					
					//if (cargo == "TRASLADADO") cargo = "";
					//if (cuadrante != "") cargo += " "+cuadrante;
					//if (unidadAgregado != "") cargo += ", "+unidadAgregado;
					
					//if (cargo.length > 39) {
					//	var cargoMuestra = cargo.substr(0,37) + " ...";
					//	var mostrarEtiqueta = " title='"+cargo+"'";
					//} else {
					//	var cargoMuestra = cargo;
					//	var mostrarEtiqueta = "";
					//}
									
					//listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='28%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><div id='valorColumna'>"+tipoLicencia+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center' title='Fecha de inicio licencia: "+fechaInicio+"'>"+fechaInicioR+InicioD+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center' title='Fecha de termino licencia: "+fechaTermino+"'>"+fechaTerminoR+TerminoA+"</div></td>";
					listadoFuncionarios	+= "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkArchivo+"</div></td>";
					listadoFuncionarios	+= "<td width='10%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+LinkConstancia+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
									
			}
			//else{
				//div.innerHTML = "";
				//alert("NO EXISTEN LICENCIAS MEDICAS REGISTRADAS PARA LA FECHA INDICADA.     ");
				//cargaListadoFuncionarios = 0;
				//}
		}
	}
}

//INICIO
var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionariosA(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	//var contieneHijos = document.getElementById("contieneHijos").value; //Variable agregada el 28-04-2015
	//alert(contieneHijos);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlListaFuncionariosAgregados.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));  
	
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
				var cargo		 		= "";
				var cuadrante			= "";
				var unidadAgregado		= "";
   	    //var seccion				= ""; //Variable agregada el 28-04-2015
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					grado		 	 = xml.getElementsByTagName('grado')[i].text;
					cargo		 	 = xml.getElementsByTagName('cargo')[i].text;
					cuadrante		 = xml.getElementsByTagName('cuadrante')[i].text;
					unidadAgregado	 = xml.getElementsByTagName('unidadAgregado')[i].text;
                    //seccion	 		 = xml.getElementsByTagName('seccion')[i].text; //Tag agregado el 28-04-2015
										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
                    //Control agregado el 28-04-2015
                    if(contieneHijos == 1){
                        var alto=360;
                    }else{
                       var alto=350; 
                    }
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('FUNCIONARIO', '800', '"+alto+"','fichaPersonalAgregado.php?codigoFuncionario="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					if (cargo == "TRASLADADO") cargo = "";
					if (cuadrante != "") cargo += " "+cuadrante;
					//if (unidadAgregado != "") cargo += ", "+unidadAgregado;
					
					if (cargo.length > 39) {
						var cargoMuestra = cargo.substr(0,37) + " ...";
						var mostrarEtiqueta = " title='"+cargo+"'";
					} else {
						var cargoMuestra = cargo;
						var mostrarEtiqueta = "";
					}
                    //Linea de codigo agregada el 28-04-2015
									
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='38%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoFuncionarios += "<td width='15%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
					listadoFuncionarios+= "<td width='15%' align='left'><div id='valorColumna'>"+cargo+"</div></td>";
					listadoFuncionarios += "<td width='19%' align='left'><div id='valorColumna'>"+unidadAgregado+"</div></td>";
					listadoFuncionarios += "</tr>";
                    
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
				
			}
		}
	}
}
//FIN

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";  
	if (sentido == "desc") nuevoSentido = "asc"; 
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	switch(atributo){
		case "grado":                                    
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColGrado").innerHTML  = "GRADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colGrado").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};  
			break;
			
		case "nombre":                                    
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML  = "CARGO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};  
			break;
			
		case "codigo":                                    
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCargo").innerHTML  = "CARGO";
			document.getElementById("labColCodigo").innerHTML = "CODIGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigo").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};  
			break;
		
		case "cargo":                                    
			leeFuncionarios(unidad, atributo, sentido);
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML  = "CARGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCargo").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};  
			break;
	}
	
	idCargaListadoFuncionarios = setInterval("tituloColumnaNormal("+columna.id+")",500);
	
}

function tituloColumnaNormal(columna){
	if (cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		cambiarClase(columna,'nombreColumna');
	}		
}


function listaFuncionarios(unidad, nombreObjeto, multiple, campo, sentido){
	cargaListadoFuncionarios = 0;
	
	
	document.getElementById(nombreObjeto).length = null;
	if (multiple == false ){		
		var datosOpcion = new Option("SELECCIONE FUNCIONARIO ... ", 0, "", "");
		document.getElementById(nombreObjeto).options[0] = datosOpcion;
	}
		
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlListaFuncionarios.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&campo="+campo+"&sentido="+sentido));  
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var nombre	 			= "";
				var grado		 		= "";
				var cargo		 		= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
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
				cargaListadoFuncionarios = 1;
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
	
	//if (!codigoValido){
	//	alert("EL CODIGO DE FUNCIONARIO INGRESADO NO TIENE UNA ESTRUCTURA VALIDA...... 	     ");
	//	document.getElementById("txtrut").focus();
	//	return false;
	//}
	
	document.getElementById("btnBuscarFuncionario").value = "BUSCANDO ...";
	document.getElementById("btnBuscarFuncionario").disabled = "true";
	leedatosFuncionario(codigoFuncionario, 1);
}

function buscaDatosFuncionario2(){
	var codigoFuncionario	= eliminarBlancos(document.getElementById("txtrut").value);
	if (codigoFuncionario != "") leedatosFuncionario(codigoFuncionario, 1);	
}


//var idAsignaCargoFichaPersonal;
//var idAsignaGradoFichaPersonal;
//var idAsignaFichaPersonal; 
function leedatosFuncionario(rut, tipo){
	
	//alert(tipo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var rutsinChar = rut;
	rutsinChar=rutsinChar.replace(".","");
	rutsinChar=rutsinChar.replace(".","");
	rutsinChar=rutsinChar.replace("-","");
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlDatosFuncionarioLicencia.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("rut="+rutsinChar)); 
	
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
				//var escalafon	 		  = "";
				//var grado		 		  = "";
				//var cargo		 		  = "";
				//var desCargo			  = "";
				//var cuadranteCargo		  = "";
				var unidadFuncionario	  = "";
				var unidadUsuario		  = "";
				//var descUnidadFuncionario = "";
				//var cargoFechaDesde		  = "";
				//var codigoUnidadAgregado  = "";
				//var desUnidadAgregado  	  = "";
        //        var dias  	              = ""; //Agregado 30-06-2015
        var rut		  = "";
								
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo	 		  		= xml.getElementsByTagName('codigo')[i].text;
					unidadAgr	 		  		= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;					
					apellidoPaterno	  		= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellifoMaterno   		= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre 	  		= xml.getElementsByTagName('nombre')[i].text;
					segundoNombre 	  		= xml.getElementsByTagName('nombre2')[i].text;
					//escalafon		  		= xml.getElementsByTagName('codigoEscalafon')[i].text;
					//grado		 	  		= xml.getElementsByTagName('codigoGrado')[i].text;
					//cargo		 	  		= xml.getElementsByTagName('codigoCargo')[i].text;
					//desCargo				= xml.getElementsByTagName('cargo')[i].text;
					//cuadranteCargo		 	= xml.getElementsByTagName('codigoCuadranteCargo')[i].text;
					unidadFuncionario 		= xml.getElementsByTagName('codigoUnidad')[i].text;
					//descUnidadFuncionario 	= xml.getElementsByTagName('unidad')[i].text;
					//cargoFechaDesde 		= xml.getElementsByTagName('fechaCargo')[i].text;
					//codigoUnidadAgregado 	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					//desUnidadAgregado 		= xml.getElementsByTagName('unidadAgregado')[i].text;
					unidadUsuario 			= document.getElementById("unidadUsuario").value;
          //dias 	            	= xml.getElementsByTagName('dia')[i].text; //Agregado 30-06-2015
          rut 			= xml.getElementsByTagName('rut')[i].text; 
					
					//if (cuadranteCargo == "") cuadranteCargo = 0;
					
					//alert(cargoFechaDesde);					
					//if (cargo == "") cargo = 0;
					
					document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";
					
					//alert(document.getElementById("fotoFuncionario").src);  
					if(unidadAgr==""){
						document.getElementById("unidadFuncionario").value	= unidadFuncionario;
						}
					else{
						document.getElementById("unidadFuncionario").value	= unidadAgr;
						}
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
			} else {
					if (document.getElementById("btnBuscarFuncionario").value == "BUSCANDO ..."){
						document.getElementById("mensajeCargando").style.display = "none";    
						alert ("NO EXISTE ...");
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


//function asignaGrado(valor){
//	if (cargaGrados == 1) {
//		clearInterval(idCargaGradoFichaPersonal);
//		document.getElementById("selGrado").value = valor;
//	}
//}
//
//function asignaCargo(valor){
//	if (cargaCargos == 1) {
//		clearInterval(idAsignaCargoFichaPersonal);
//		document.getElementById("selCargo").value 		= valor;
//		document.getElementById("cargoBaseDatos").value = valor;
//	}
//}

function nuevoFuncionario(){
	
	var codigoFuncionario	= document.getElementById("txtrut").value.toUpperCase();
	//var codigoEscalafon 	= document.getElementById("selEscalafon").value;
	//var codigoGrado			= document.getElementById("selGrado").value;
	var apellidoPaterno		= document.getElementById("txtape1").value.toUpperCase();
	var apellidoMaterno		= document.getElementById("txtape2").value.toUpperCase();
	var primerNombre		= document.getElementById("txtnom").value.toUpperCase();
	//var segundoNombre		= document.getElementById("textSegundoNombre").value.toUpperCase();
	//var codigoCargo			= document.getElementById("selCargo").value;
	//var codigoCuadrante		= document.getElementById("selCuadrante").value;
	
	var unidadUsuario		= document.getElementById("unidadUsuario").value;
	//alert(unidadUsuario);
	//var fechaCargo			= document.getElementById("textFechaUltimoCargo").value;
  //var dias			    = document.getElementById("textCantDias").value;	//Variable agregada el 28-04-2015
  
  var unidadFuncionario	= document.getElementById("unidadFuncionario").value;
  
  var rutsinchar = document.getElementById("txtrut").value;
  var color = document.getElementById("txtcolor").value;
  var folio = document.getElementById("txtfolio").value;
  var fecha1 = document.getElementById("txtfec1").value;
  var fecha2 = document.getElementById("txtfec2").value;
  var dias = document.getElementById("txtdias").value;
  var rutHijo = document.getElementById("txtruth").value;
  var fecha3 = document.getElementById("txtfec3").value;
  var tipoLicencia = document.getElementById("cboLicencia").value; 
  var tipoReposo = document.getElementById("cboReposo").value;
  var rutProfesional = document.getElementById("txtrutp").value;
  var especialidad = document.getElementById("cboEspecialidad").value;
  var archivo = document.getElementById("rutArchi").value;
  var ip = document.getElementById("IpFuncionario").value;
  var fechaReal = document.getElementById("fechaReal").value;
  if(fechaReal==""){
  	fechaReal = fecha2;
  	}
  var codigoFuncionario = document.getElementById("codigoFuncionario").value;
  var correlativo = document.getElementById("correlativo").value;
	var fechaTermino = document.getElementById("textFechaTermino").value;
	var fechaRegistro= document.getElementById("fecha").value;
 
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
	
	//parametros += "codigoFuncionario="+codigoFuncionario+"&codigoEscalafon="+codigoEscalafon+"&codigoGrado="+codigoGrado;
	//parametros += "&apellidoPaterno="+apellidoPaterno+"&apellidoMaterno="+apellidoMaterno+"&primerNombre="+primerNombre;
	//parametros += "&segundoNombre="+segundoNombre+"&codigoCargo="+codigoCargo+"&unidadUsuario="+unidadUsuario+"&fechaCargo="+fechaCargo;
	//parametros += "&codigoCuadrante="+codigoCuadrante+"&dias="+dias;
	
	//parametros += "codigoFuncionario="+codigoFuncionario+"&apellidoPaterno="+apellidoPaterno+"&apellidoMaterno="+apellidoMaterno+"&primerNombre="+primerNombre;
	//parametros += "&unidadUsuario="+unidadUsuario;
	
	parametros += "rut="+rutsinchar+"&color="+color+"&folio="+folio+"&fecha1="+fecha1+"&fecha2="+fecha2+"&dias="+dias+"&diasF="+diasF;
	parametros += "&rutHijo="+rutHijo+"&fecha3="+fecha3+"&tipoLicencia="+tipoLicencia+"&recuperacion="+recuperacion;
	parametros += "&invalidez="+invalidez+"&tipoReposo="+tipoReposo+"&lugarReposo="+lugarReposo+"&rutProfesional="+rutProfesional+"&codigoFuncionario="+codigoFuncionario+"&correlativo="+correlativo+"&fechaRegistro="+fechaRegistro;
	parametros += "&especialidad="+especialidad+"&tipoProfesional="+tipoProfesional+"&atencion="+atencion+"&ip="+ip+"&unidadFuncionario="+unidadFuncionario+"&archivo="+archivo+"&fechaReal="+fechaReal+"&fechaTermino="+fechaTermino;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlNuevaLicencia.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{      // alert(objHttpXMLFuncionarios.readyState);
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function guardarFichaFuncionario(){
	//desactivarBotones();
	//var validaOk = validarFichaFuncionario();
	//alert(document.getElementById("idFuncionario").value);
	
	/* Dar formato a las fechas y sumar los días */
	
	var codigoFuncionario = document.getElementById("idFuncionario").value;
	var fechaInicio = document.getElementById("txtfec2").value;
	var dias = document.getElementById("txtdias").value;
	var arrayAux = fechaInicio.split("-");
	var fechaTFDate = new Date(arrayAux[2],arrayAux[1]-1,arrayAux[0],01,00,00);
	
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
			var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTE FUNCIONARIO EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj){
				actualizarFuncionario();
			} else {
				activarBotones();
				return false;
			}
/*----------------------------------------------------------------------------------------------------------------------------------------------*/			
		} else {
/*----Crea nueva licencia------------------------------------------------------------------------------------------------------------------------------------------*/						
			
			/*var cantidadServicio = controlServicioLicencia(codigoFuncionario,fechaInicio,fechaTermino);
     	if(cantidadServicio == 1) return false;*/
      //if(controlValidacionServicio(codigoFuncionario,fechaInicio,fechaTermino)) return false;
      
			var msj=confirm("ATENCIÓN :\nSE INGRESARÁN LOS DATOS DE ESTE FUNCIONARIO EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) {
				nuevoFuncionario();
				nuevaLicenciaSelime();
			} else {
				activarBotones();
				return false;
			}
		document.getElementById('btnGuardarOrganizacion').value = "GUARDANDO ...";	
	  document.getElementById("mensajeGuardando").style.display = "";
	  document.getElementById("mensajeGuardando").style.left = "170px";
	  document.getElementById("mensajeGuardando").style.top  = "200px";
/*----------------------------------------------------------------------------------------------------------------------------------------------*/		
		}
		
	}
	//} else {
	//	activarBotones();
	//}
}

function cerrarVentanaPersonal(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		 top.cerrarVentana();
	}
}

function controlServicioLicencia(funcionario,fecha1,fecha2){ 
    
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlServicios/xmlListaServiciosPorFuncionario.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+funcionario+"&fecha1="+fecha1+"&fecha2="+fecha2));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	mensaje += "NO PUEDE INGRESAR LICENCIA PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
        if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
        else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	var fecha 		         = xml.getElementsByTagName('fecha')[i].text;
		         var servicio 	         = xml.getElementsByTagName('desServicio')[i].text;
		         var unidad 	         	= xml.getElementsByTagName('desUnidad')[i].text;
		               
		        	mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
			}
			if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
			alert(mensaje);
			return 1;
	}     
}
   
     //var cantidadServicio = controlServicioLicencia(codigoFuncionario,fechaCargo,'01-01-3000');
     //  if(cantidadServicio == 1){
     //return false;
     //  }
       
  //Nueva funcion 2 -no finalizada-
function controlValidacionServicio (unidadServicios, fechaServicios,fecha2){
    var mensaje="";
	//alert(unidadServicios + " - " + fechaServicios);
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();
			
	objHttpXMLFechaValidacion.open("POST","./xml/xmlServicios/xmlControlValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFechaValidacion.send(encodeURI("unidadServicios="+unidadServicios+"&fechaServicios="+fechaServicios+"&fecha2="+fecha2));
	alert(objHttpXMLFechaValidacion.responseText);	   
	var xml = objHttpXMLFechaValidacion.responseXML.documentElement;   
	//return xml.getElementsByTagName('fechaValidacion')[0].text;  
    
       if (objHttpXMLFechaValidacion.responseText != "VACIO"){
        
        mensaje += "NO PUEDE INGRESAR LICENCIA PORQUE TIENE LOS SIGUIENTES DIAS VALIDADOS:\n\n";
        if (xml.getElementsByTagName('fechaServicio').length > 10) var cantidaDiasMostrar = 10;
        else var cantidadDiasMostrar = xml.getElementsByTagName('fechaServicio').length;
         for(var i=0;i<cantidaDiasMostrar.length;i++){
        	var fecha 		       = xml.getElementsByTagName('fechaServicio')[i].text; 
		} 
      	mensaje += "- FECHA: "+fecha;
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
    
    for(var i = sRut1.length - 1; i >= 0; i-- )
    {
        sInvertido += sRut1.charAt(i);
        if (i == sRut1.length - 1 )
            sInvertido += "-";
        else if (nPos == 3)
        {
            sInvertido += ".";
            nPos = 0;
        }
        nPos++;
    }
    for(var j = sInvertido.length - 1; j >= 0; j-- )
    {
        if (sInvertido.charAt(sInvertido.length - 1) != ".")
            sRut += sInvertido.charAt(j);
        else if (j != sInvertido.length - 1 )
            sRut += sInvertido.charAt(j);
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
	
	if (intlargo.length> 0)
	{
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
		validarSubir();
		buscaDatosFuncionario();	
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
	var folioColor 							= document.getElementById("txtcolor").value+document.getElementById("txtfolio").value;
	
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
	
	var color						= eliminarBlancos(document.getElementById("txtcolor").value);
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
	if(fechaInicioR=="")fechaInicioR=fechaRep;
	
	var parts = fechaTermino.split("-");
  fechaTermino = new Date(parts[2], parts[1]-1, parts[0]);
  
  parts = fechaInicioR.split("-");
  fechaInicioR = new Date(parts[2], parts[1]-1, parts[0]);
  
  parts = fechaRep.split("-");
  fechaRep = new Date(parts[2], parts[1]-1, parts[0]);

	//alert("Ter: "+fechaFormat+"  Re: "+fechaInicioR+"  rep: "+fechaRep);	
	//var fecha2          = "3000-01-01";
	//var fecha1          = fechaRep;
	//var funcionario     = document.getElementById("codigoFuncionario");
	
	if (rut == "") {
		alert("DEBE INDICAR RUT ...... 	     ");
		document.getElementById("txtrut").focus();
		return false;
	}

	if (color == "") {
		alert("DEBE INDICAR EL COLOR DE LA LICENCIA ...... 	     ");
		document.getElementById("txtcolor").focus();
		return false;
	}
	
	if (folio == 0) {
		alert("DEBE INGRESAR EL FOLIO DE LA LICENCIA  ...... 	     ");
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
		alert("DEBE INGRESAR LA CANTIDAD DE DIAS DE LA LICENCIA  ...... 	     ");
		document.getElementById("txtdias").focus();
		return false;
	}
	
	if (fechaInicioR < fechaRep) {
		alert("LA FECHA DE INICIO REAL NO PUEDE SER INFERIOR A LA FECHA DE INICIO DE LA LICENCIA  ...... 	     "+document.getElementById("fechaReal").value+">"+document.getElementById("txtfec2").value);
		document.getElementById("fechaReal").focus();
		return false;
	}
	
	if (fechaInicioR > fechaTermino) {
		alert("LA FECHA DE INICIO REAL NO PUEDE SER SUPERIOR A LA FECHA DE TERMINO DE LA LICENCIA  ...... 	     "+document.getElementById("fechaReal").value+">"+document.getElementById("textFechaTermino").value);
		document.getElementById("fechaReal").focus();
		return false;
	}
	
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
	
	var licenciaVerificar = controlLicenciaFuncionario(color,folio);
  //alert(licencia2);  
  if(licenciaVerificar == 1){
    return false;
  }  
  
  var servicioVerificar = verificaExisteServicio();
 	//alert(servicioVerificar);  
 	if(servicioVerificar){
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
	
	return true;
}


/*Función para validar si se ingresarón los datos necesarios para subir el archivo*/
function validarSubir(){
	var rut 	= document.getElementById('txtrut').value;
	var color = document.getElementById('txtcolor').value;
	var folio = document.getElementById('txtfolio').value;
	
	if(rut != '' && color != '' && folio != 0){
		document.getElementById('archivo').disabled = false;
		}
	else{
		document.getElementById('archivo').disabled = true;
		}
}


function controlFuncionarioAsignado(funcionario,fecha1,fecha2){ 
    
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaServiciosPorFuncionario.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+funcionario+"&fecha1="+fecha1+"&fecha2="+fecha2));  
   // alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	mensaje += "NO PUEDE INGRESAR LA LICENCIA PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
        if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
        else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	var fecha 		         = xml.getElementsByTagName('fecha')[i].text;
		         var servicio 	         = xml.getElementsByTagName('desServicio')[i].text;
		         var unidad 	         	= xml.getElementsByTagName('desUnidad')[i].text;
		               
		        	mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
			}
			if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
			alert(mensaje);
			return 1;
	}     
}

function controlLicenciaFuncionario(color,folio){ 
    
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaPorFuncionario.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("color="+color+"&folio="+folio));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('licencia')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
         	
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

function guardarFichaFuncionario2(){
	
var  codFuncionario = document.getElementById('codFuncionario').value;
var  fecha1 = document.getElementById('txtfec1').value;
var  fechaFinal = document.getElementById('txtfec2').value;

//alert(codFuncionario);
//alert(fecha1);
//alert(fechaFinal);

var funcionarioAsignado = controlFuncionarioAsignado(codFuncionario,fecha1,fechaFinal);
 // alert(funcionarioAsignado);  
if(funcionarioAsignado == 1){
       return false;
   }   
 
}

function guardarFichaFuncionario3(){
	
var  rut = document.getElementById('codFuncionario').value;
var  color = document.getElementById('txtcolor').value;
var  folio = document.getElementById('txtfolio').value;

//alert(rut);
//alert(color);
//alert(folio);

var licencias = controlLicenciaFuncionario(color,folio,rut);
  //alert(licencias);  
if(licencias == 1){
       return false;
   }   
 
}

//function verificaExisteServicio(){
	
//	var codFuncionario 	 = document.getElementById("codigoFuncionario").value;
//	var fecha1 	 = document.getElementById("fechaReal").value;
//	var fecha2	 = document.getElementById("textFechaTermino").value; 	
//	var objHttpXMLServicios = new AJAXCrearObjeto();
//	objHttpXMLServicios.open("POST","./xml/xmlLicenciaMedica/xmlListaServicios.php",false);
//	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//	objHttpXMLServicios.send(encodeURI("funcionario="+codFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));  
	//objHttpXMLServicios.onreadystatechange=function(){
//		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
//			if (objHttpXMLServicios.responseText != "VACIO") {
//				var xml = objHttpXMLServicios.responseXML.documentElement;   
				//document.getElementById("correlativoServicio").value = xml.getElementsByTagName('correlativoServicio')[0].text;
//				alert("PRESENTA SERVICIOS INGRESADOS ENTRE LAS FECHAS INDICADAS ...... 	     "); 
//				return true;
//			} 
//			else {				
//				return false;
//				}
//		}
	//}
//}

//Funcion servicio asignado
function verificaExisteServicio(){ 
    	
    var codFuncionario 	 = document.getElementById("codigoFuncionario").value;
	  var fecha1 	 = document.getElementById("fechaReal").value;
	  var fecha2	 = document.getElementById("textFechaTermino").value;
	  var fechaI	 = document.getElementById("txtfec2").value;
	  if(fecha1=="")fecha1=fechaI;
    var mensaje	 = "";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaServicios.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("funcionario="+codFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	mensaje += "NO PUEDE INGRESAR LA LICENCIA PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
        if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
        else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	var fecha 		         = xml.getElementsByTagName('fecha')[i].text;
		         var servicio 	         = xml.getElementsByTagName('desServicio')[i].text;
		         var unidad 	         	= xml.getElementsByTagName('desUnidad')[i].text;
		               
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
  var unidad=document.getElementById("unidadFuncionario").value; 
  var fecha1=document.getElementById("txtfec2").value;
  var fecha2	 = "30000101";
  var servicio=document.getElementById("servicio").value; 
  
	var arreglo = new Array();
		var arrayCorrelativoPaso = new Array();
	   
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaServiciosPorFuncionario.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicio="+servicio));  
   // alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	//mensaje += "CORRELATIVOS:\n\n";
        //if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
        //else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
        var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	 //var fecha 		         = xml.getElementsByTagName('fecha')[i].text;
		      	 var correlativo       = xml.getElementsByTagName('correlativoServicio')[i].text;
		         //var servicio 	       = xml.getElementsByTagName('desServicio')[i].text;
		         //var unidad 	        	= xml.getElementsByTagName('desUnidad')[i].text;
		               
		        	//mensaje += (i+1) +". " + ""+" - SERVICIO "+correlativo.toUpperCase()+"\n   ("+correlativo.toUpperCase()+").\n";
		        	//document.getElementById("correlativo").value=correlativo;
		        	
		        	arreglo[i]=correlativo;
		        		//arrayMedioVigilancia[0] = idVehiculo;
		        	//arreglo[i][0];
		        	//alert("Correlativo: "=arreglo);
		        
		       			arrayCorrelativoPaso[0] = new Array();
		
		//arrayCorrelativoPaso[i][0] = arreglo[i][0];
		
		        		var arregloCorrelativos	= php_serialize(arreglo);
			//alert("gsagagsa"+arregloCorrelativos);
		        	//Guardar en un arreglo
			}
			//if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
			//alert(mensaje);
			//alert("Hola!");
			var arregloCorrelativos	= php_serialize(arreglo);
			document.getElementById("correlativo").value=arregloCorrelativos;
			//alert(arregloCorrelativos	);
			return 1;
	}     
}

function servicioTerminoCorrelativo(funcionario,fecha1,fecha2,servicio){ 

	var codigoFuncionario=document.getElementById("codigoFuncionario").value; 
  var unidad=document.getElementById("unidadFuncionario").value; 
  var fecha1=document.getElementById("txtfec2").value;
  var fecha2	 = document.getElementById("txtfecF").value;
  var servicio=document.getElementById("servicio").value; 
	
	var arreglo = new Array();
		var arrayCorrelativoPaso = new Array();
	   
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaServiciosPorFuncionario.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicio="+servicio));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	//mensaje += "CORRELATIVOS:\n\n";
        //if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
        //else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
        var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	 //var fecha 		         = xml.getElementsByTagName('fecha')[i].text;
		      	 var correlativo       = xml.getElementsByTagName('correlativoServicio')[i].text;
		         //var servicio 	       = xml.getElementsByTagName('desServicio')[i].text;
		         //var unidad 	        	= xml.getElementsByTagName('desUnidad')[i].text;
		               
		        	//mensaje += (i+1) +". " + ""+" - SERVICIO "+correlativo.toUpperCase()+"\n   ("+correlativo.toUpperCase()+").\n";
		        	//document.getElementById("correlativo").value=correlativo;
		        	
		        	arreglo[i]=correlativo;
		        		//arrayMedioVigilancia[0] = idVehiculo;
		        	//arreglo[i][0];
		        	//alert("Correlativo: "=arreglo);
		        
		       			arrayCorrelativoPaso[0] = new Array();
		
		//arrayCorrelativoPaso[i][0] = arreglo[i][0];
		
		        		var arregloCorrelativos	= php_serialize(arreglo);
			//alert("gsagagsa"+arregloCorrelativos);
		        	//Guardar en un arreglo
			}
			//if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
			//alert(mensaje);
			//alert("Hola!");
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
	var CodColor					= eliminarBlancos(document.getElementById("txtcolor").value.toUpperCase());
	var codFolio					= eliminarBlancos(document.getElementById("txtfolio").value.toUpperCase());
	document.getElementById("Listcolor").value = CodColor;
	leedatosFicha(codFuncionario,CodColor,codFolio);
	
}

//var idAsignaCargoFichaPersonal;
//var idAsignaGradoFichaPersonal;
//var idAsignaFichaPersonal; 
function leedatosFicha(codFuncionario,CodColor,codFolio){

	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlDatosFichaLicencia.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codFuncionario="+codFuncionario+"&color="+CodColor+"&folio="+codFolio));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				  		= objHttpXMLFuncionarios.responseXML.documentElement;
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
          fechaR 							= xml.getElementsByTagName('fechaR')[i].text; 
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
					
					document.getElementById("fotoFuncionario").src								= "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";						
					document.getElementById("idFuncionario").value								= codigo;					
					document.getElementById("txtrut").value												= rut;
					document.getElementById("txtape1").value 											= apellidoPaterno;
					document.getElementById("txtape2").value 											= apellifoMaterno;
					document.getElementById("txtnom").value 	 										= primerNombre+" "+segundoNombre;
					document.getElementById("txtfec1").value 		 									= fechaO;
					document.getElementById("txtfec2").value 	 										= fechaI;
					document.getElementById("fechaReal").value 	 									= fechaR;
					document.getElementById("txtdias").value 	 										= dias;
					
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
					
					document.getElementById("servicio").value 	 									=  tipoLicencia;
					
					document.getElementById("textFechaTermino").value 	 					=  fechaTermino;
					document.getElementById("fechaTerminoInicial").value 	 				=  fechaTermino;
					
					document.getElementById("unidadFuncionario").value 	 			  	=  unidad;
					
					/*
						if(document.getElementById('cboLicencia').value==4){
						document.getElementById("seccion3a").style.display="block";
					}*/
				
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
	
	var objHttpXMLEstado = new AJAXCrearObjeto();		
	objHttpXMLEstado.open("POST","./xml/xmlLicenciaMedica/xmlTipoLicencia.php",true);
	objHttpXMLEstado.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstado.send(encodeURI());
	objHttpXMLEstado.onreadystatechange=function()
	{
		if(objHttpXMLEstado.readyState == 4)
		{       
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
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlMensajeLicencia.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&fecha="+fecha));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('licencia')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
         	//alert(objHttpXMLFuncionarios.responseText); 
        	mensaje += "LICENCIAS INGRESADAS: "+fechaHoy.toUpperCase()+"\n\n";
        if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
        else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
	     
	        	var grado 		         = xml.getElementsByTagName('grado')[i].text;
		      	var nom1 		         = xml.getElementsByTagName('nombre')[i].text;
		      	var nom2 		         = xml.getElementsByTagName('nombre2')[i].text;
		        var ape1 	         = xml.getElementsByTagName('apellidoPaterno')[i].text;
		        var ape2           = xml.getElementsByTagName('apellidoMaterno')[i].text;
		        var licencia 	         	= xml.getElementsByTagName('licenciaMedica')[i].text;
		        var codigo	         	= xml.getElementsByTagName('codigo')[i].text;
		               
		      mensaje += (i+1) +". " + grado+" "+nom1+" "+nom2+" "+ape1+" "+ape2+" ("+codigo+")"+", TIPO LICENCIA: ("+licencia.toUpperCase()+")"+".\n";
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
	//var largoCorrelativos		= document.getElementById('correlativo').length;
	//alert(correlativo);
	//var correlativo2 				= document.getElementById('correlativo2').value;
	//var codigoFuncionario=document.getElementById("codigoFuncionario").value; 
	//var unidad 	 = 7800;
	//var fecha1 	 = "20160908";
	//var fecha2	 = "20160910";
 //var servicio = 630;
	
	var fechaTerminoReal = document.getElementById("txtfecF").value;
	var fechaTerminoInicial = document.getElementById("fechaTerminoInicial").value;
	var correlativoTermino = document.getElementById("correlativoAnticipado").value;
	
	var unidadFuncionario = document.getElementById("unidadFuncionario").value;
	var fechaInicial = document.getElementById("txtfec2").value;
	
	//alert(codigoFuncionario);
	
	//var auxiliar = new Array();
	//    auxiliar = servicioLicenciaCorrelativo();
	
	//if(auxiliar==1){
	//correlativo 				= document.getElementById('correlativo').value=auxiliar;
	//	alert(auxiliar);
	//	}
	    //auxiliar = new Array();
	//var auxiliar2;
	//var auxiliar = new Array();
  //var auxiliar = servicioLicenciaCorrelativo(codigoFuncionario,unidad,fecha1,fecha2, servicio);
  //var largoArreglo = auxiliar.length;
  //alert ("Largo: "+largoArreglo);
  //for(var i=0; i<4; i++){
	 //alert(auxiliar[i][0]);
	 //auxiliar = new Array();
   //alert("fsfsf"=auxiliar); 	
	//}
	

 //var auxiliar2 		= php_serialize(aux);

 //var arreglo2 = ["1", "4", "7"];

	 //var auxiliar3 		= php_serialize(arreglo2);
	var parametros = ""; 
	parametros =  "color="+color+"&folio="+folio+"&correlativo="+correlativo+"&codigoFuncionario="+codigoFuncionario+"&fechaTerminoInicial="+fechaTerminoInicial+"&correlativoTermino="+correlativoTermino+"&fechaTerminoReal="+fechaTerminoReal+"&unidadFuncionario="+unidadFuncionario+"&fechaInicial="+fechaInicial;
	
	//alert(parametros);
  
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlLicenciaActualizar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 AnulaLicenciaSelime();
						 alert('LOS DATOS FUERON MODIFICADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}

}

function modificarLicencia(){
	
	//var fechaTermino = document.getElementById("txtfecF").value;
	var  rut = document.getElementById('codigoFuncionario').value;
	var  color = document.getElementById('txtcolor').value;
	var  folio = document.getElementById('txtfolio').value;
	
	//var fechaTermino = document.getElementById("txtfecF").value;
	
	var licencias = controlLicenciaFuncionarioAnulada(color,folio,rut);
  //alert(licencias);  
	if(licencias == 1){
       return false;
   } 	
   
	var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTA LICENCIA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
	if (msj){
	actualizarLicencia();
	} else {
	//activarBotones();
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
	
	if(fechaTermino == ""){
		alert("DEBE INDICAR LA FECHA DE TERMINO ANTICIPADO ...... 	     ");
		document.getElementById("txtfecF").focus();
		return false;
	}
	
	if(fechaTermino == fechaTerminoR){
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
		
	var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTA LICENCIA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
	if (msj){
  servicioTerminoCorrelativo();
	actualizarLicencia();
	
	} else {
	//activarBotones();
	return false;
	}
	document.getElementById('btnGuardarOrganizacion').value = "RECORTANDO ...";	
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
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaAnuladaPorFuncionario.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("color="+color+"&folio="+folio));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('licencia')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
         	
        	mensaje += "NO PUEDE ANULAR LA LICENCIA, PORQUE ESTA YA FUE ANULADA ANTERIORMENTE: \n";
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

function codigoSelime(){
	
	var tipoLicencia = document.getElementById('cboLicencia').value;
	var codigo 		= "";
	
	var objHttpXMLCodigo = new AJAXCrearObjeto();		
	objHttpXMLCodigo.open("POST","./xml/xmlLicenciaMedica/xmlCodigoLicenciaSelime.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI("tipoLicencia="+tipoLicencia));
	
	objHttpXMLCodigo.onreadystatechange=function()
	{
		if(objHttpXMLCodigo.readyState == 4)
		{       
			//alert(objHttpXMLCodigo.responseText);
			if (objHttpXMLCodigo.responseText != "VACIO"){					
				var xml 			= objHttpXMLCodigo.responseXML.documentElement;

				//for(i=0;i<xml.getElementsByTagName('tipoLicencia').length;i++){
					codigo 	= xml.getElementsByTagName('codigo')[0].text;
					document.getElementById("codigoSelime").value = codigo;				
				//}
			}
		}
	}
}

function rutUsuario(){
	
	var objHttpXMLCodigo = new AJAXCrearObjeto();		
	objHttpXMLCodigo.open("POST","./xml/xmlLicenciaMedica/xmlrutUsuario.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI());
	objHttpXMLCodigo.onreadystatechange=function()
	{
		if(objHttpXMLCodigo.readyState == 4)
		{       
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
	objHttpXMLCodigo.onreadystatechange=function()
	{
		if(objHttpXMLCodigo.readyState == 4)
		{       
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
		}
	}	
}

function reparticionDescripcion(codigo){
	
	//var codigo = document.getElementById("reparticionCodigo").value;
	
	var objHttpXMLCodigo = new AJAXCrearObjeto();		
	objHttpXMLCodigo.open("POST","./xml/xmlLicenciaMedica/xmlreparticionDescripcion.php",true);
	objHttpXMLCodigo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCodigo.send(encodeURI("codigoUnidad="+codigo));
	objHttpXMLCodigo.onreadystatechange=function()
	{
		if(objHttpXMLCodigo.readyState == 4)
		{       
			//alert(objHttpXMLCodigo.responseText);
			if (objHttpXMLCodigo.responseText != "VACIO"){					
				var xml 			= objHttpXMLCodigo.responseXML.documentElement;
				var descripcion 		= "";
				
			//	for(i=0;i<xml.getElementsByTagName('unidad').length;i++){
					descripcion 			= xml.getElementsByTagName('descripcion')[0].text;
					document.getElementById("reparticionDescripcion").value = descripcion;
			//	}
			}
		}
	}	
}

function nuevaLicenciaSelime(){
	/*
	var color						= document.getElementById("txtcolor").value;
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
  var Latencion = document.getElementsByName("optionAte");
  for(var i=0;i<Latencion.length;i++){
    if(Latencion[i].checked) atencion=Latencion[i].value;
  }  
	
	var parametros = "color="+color+"&folio="+folio+"&rut="+rut+"&dias="+dias+"&fecha2="+fechaRep+"&tipoLicencia="+licencia;
	parametros = parametros+"&atencion="+atencion+"&fecha1="+fechaOto+"&fechaRegistro="+fechaRegistro;
	parametros = parametros+"&rutUsuario="+rutUsuario+"&reparticionCod="+reparticionCod+"&reparticionDes="+reparticionDes;
	
	//alert(parametros);
	
	var objHttpXMLSelime = new AJAXCrearObjeto();		
	objHttpXMLSelime.open("POST","./xml/xmlLicenciaMedica/xmlNuevaLicenciaSelime.php",true);
	objHttpXMLSelime.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLSelime.send(encodeURI(parametros));
	objHttpXMLSelime.onreadystatechange=function()
	{
		if(objHttpXMLSelime.readyState == 4)
		{       
				if (objHttpXMLSelime.responseText != "VACIO"){
				alert(objHttpXMLSelime.responseText);
				var xml = objHttpXMLSelime.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo != 1){
						alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS SELIMEWEB ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
	}*/
	return 1;
}

function AnulaLicenciaSelime(){
	
	var color						= document.getElementById("txtcolor").value;
	var folio						= document.getElementById("txtfolio").value;
	
	var parametros = "color="+color+"&folio="+folio;
	
	//alert(parametros);
	
	var objHttpXMLSelime = new AJAXCrearObjeto();		
	objHttpXMLSelime.open("POST","./xml/xmlLicenciaMedica/xmlAnulaLicenciaSelime.php",true);
	objHttpXMLSelime.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLSelime.send(encodeURI(parametros));
	objHttpXMLSelime.onreadystatechange=function()
	{
		if(objHttpXMLSelime.readyState == 4)
		{       
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
