var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionarios(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlListaFuncionarios.php",true);
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
										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('FUNCIONARIO', '800', '360','fichaPersonal.php?codigoFuncionario="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					if (cargo == "TRASLADADO") cargo = "";
					if (cuadrante != "") cargo += " "+cuadrante;
					if (unidadAgregado != "") cargo += ", "+unidadAgregado;
					
					if (cargo.length > 39) {
						var cargoMuestra = cargo.substr(0,37) + " ...";
						var mostrarEtiqueta = " title='"+cargo+"'";
					} else {
						var cargoMuestra = cargo;
						var mostrarEtiqueta = "";
					}
									
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='38%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+cargoMuestra+"</div></td>";
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
	
	var codigoFuncionario	= eliminarBlancos(document.getElementById("textCodigoFuncionario").value.toUpperCase());
	
	if (codigoFuncionario == ""){
		alert("DEBE INDICAR EL CODIGO DE FUNCIONARIO ...... 	     ");
		document.getElementById("textCodigoFuncionario").value="";
		document.getElementById("textCodigoFuncionario").focus();
		return false;
	}
	
	var regExCodigoFun = /^[0-9]{6,6}[A-Z]{1,1}$/;
	var codigoValido = codigoFuncionario.match(regExCodigoFun);
	
	if (!codigoValido){
		alert("EL CODIGO DE FUNCIONARIO INGRESADO NO TIENE UNA ESTRUCTURA VALIDA...... 	     ");
		document.getElementById("textCodigoFuncionario").focus();
		return false;
	}
	
	document.getElementById("btnBuscarFuncionario").value = "BUSCANDO ...";
	document.getElementById("btnBuscarFuncionario").disabled = "true";
	leedatosFuncionario(codigoFuncionario, 1);
}

function buscaDatosFuncionario2(){
	var codigoFuncionario	= eliminarBlancos(document.getElementById("textCodigoFuncionario").value);
	if (codigoFuncionario != "") leedatosFuncionario(codigoFuncionario, 1);	
}


var idAsignaCargoFichaPersonal;
var idAsignaGradoFichaPersonal;
var idAsignaFichaPersonal; 
function leedatosFuncionario(codigoFuncionario, tipo){
	
	//alert(tipo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
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
        var dias  	              = ""; //Agregado 30-06-2015
        var rut = "";
								
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo	 		  		= xml.getElementsByTagName('codigo')[i].text;
					apellidoPaterno	  		= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellifoMaterno   		= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre 	  		= xml.getElementsByTagName('nombre')[i].text;
					segundoNombre 	  		= xml.getElementsByTagName('nombre2')[i].text;
					escalafon		  		= xml.getElementsByTagName('codigoEscalafon')[i].text;
					grado		 	  		= xml.getElementsByTagName('codigoGrado')[i].text;
					cargo		 	  		= xml.getElementsByTagName('codigoCargo')[i].text;
					desCargo				= xml.getElementsByTagName('cargo')[i].text;
					cuadranteCargo		 	= xml.getElementsByTagName('codigoCuadranteCargo')[i].text;
					unidadFuncionario 		= xml.getElementsByTagName('codigoUnidad')[i].text;
					descUnidadFuncionario 	= xml.getElementsByTagName('unidad')[i].text;
					cargoFechaDesde 		= xml.getElementsByTagName('fechaCargo')[i].text;
					codigoUnidadAgregado 	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado 		= xml.getElementsByTagName('unidadAgregado')[i].text;
					unidadUsuario 			= document.getElementById("unidadUsuario").value;
          dias 	            	= xml.getElementsByTagName('dia')[i].text; //Agregado 30-06-2015
          rut	 		  		      = xml.getElementsByTagName('rut')[i].text;
					
					if (cuadranteCargo == "") cuadranteCargo = 0;
					
					//alert(cargoFechaDesde);					
					if (cargo == "") cargo = 0;
					document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
					
					//alert(document.getElementById("fotoFuncionario").src);  
					
					document.getElementById("idFuncionario").value				= codigo;
					document.getElementById("textCodigoFuncionario").value		= codigo;
					document.getElementById("textApellidoPaterno").value 		= apellidoPaterno;
					document.getElementById("textApellidoMaterno").value 		= apellifoMaterno;
					document.getElementById("textPrimerNombre").value 	 		= primerNombre;
					document.getElementById("textSegundoNombre").value 	 		= segundoNombre;
					document.getElementById("codigoUnidadAgregado").value 	 	= codigoUnidadAgregado;
					document.getElementById("textUnidadAgregado").value 	 	= desUnidadAgregado;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					document.getElementById("codCuadranteBaseDatos").value 		= cuadranteCargo;
    	    document.getElementById("textCantDias").value 	        	= dias; //Agregado 30-06-2015
					document.getElementById("textCantDias2").value 	        	= dias; //Agregado 30-06-2015
					document.getElementById("textRutFuncionario").value			  = rut;
					
					
					//alert(desCargo);
					
					if (tipo == 0) {
						document.getElementById("ultimaFecha").value = cargoFechaDesde;
						if (cargoFechaDesde != "--") var muestraFechaCargo = cargoFechaDesde;
						else var muestraFechaCargo = "NO REGISTRA CARGOS EN EL SISTEMA";
						document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA CARGO ACTUAL : " + muestraFechaCargo;
					} else {
						document.getElementById("ultimaFecha").value = cargoFechaDesde;
						if (cargoFechaDesde != "--") var muestraFechaCargo = cargoFechaDesde + " ("+desCargo+")";
						else var muestraFechaCargo = "NO REGISTRA CARGOS EN EL SISTEMA";
						document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + muestraFechaCargo;
					}
					
					
					
					//alert();

					if (unidadFuncionario == "") var habilitarBotones = false;
					else var habilitarBotones = true;										
					
					var valoresAsignar = "'"+escalafon+"','" + grado + "','" + cargo + "'," + habilitarBotones +",'"+cuadranteCargo+"','"+dias+"',"+tipo;   

					idAsignaFichaPersonal = setInterval("asignaValoresFichaFuncionario("+valoresAsignar+")",1000);
															
					if (tipo == "1"){
						document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
						document.getElementById("btnBuscarFuncionario").disabled = "";
						
						if (unidadUsuario == unidadFuncionario){
							alert("ESTE FUNCIONARIO YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaPersonal();
						}
						
						if (unidadUsuario != unidadFuncionario && unidadFuncionario != ""){
							alert("NO PUEDE AGREGAR A ESTE FUNCIONARIO,\nYA QUE PERTENECE A LA " +descUnidadFuncionario+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaPersonal();
						} 
					}
				}
			} else {
				var funcionarioPersonal = buscaFuncionarioPersonal(codigoFuncionario);
				//alert(funcionarioPersonal);
				if(!funcionarioPersonal){
					alert("EL FUNCIONARIO INDICADO NO SE ENCUENTRA EN LAS BASES DE DATOS          ");   
					cerrarVentanaPersonal();                                           
				}   
				document.getElementById("mensajeCargando").style.display = "none";
				document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
				document.getElementById('btnBuscarFuncionario').disabled = "";
					/*if (document.getElementById("btnBuscarFuncionario").value == "BUSCANDO ..."){
						document.getElementById("mensajeCargando").style.display = "none";    
						alert ("NO EXISTE ...");
						document.getElementById("textCodigoFuncionario").focus();
					}
					
					document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
					document.getElementById("btnBuscarFuncionario").disabled = "";*/
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


function llenaGradoFichaPersonal(grado, habilitarBotones){
	if (cargaGrados == 1) {
		clearInterval(idAsignaGradoFichaPersonal);
		//leeGrados('selGrado', escalafon, document.getElementById("selEscalafon")[document.getElementById("selEscalafon").selectedIndex].text);	
		document.getElementById("selGrado").value = grado;
		
		if (habilitarBotones){			
			document.getElementById('btnDejarDisponible').disabled = "";
			document.getElementById('btnRetiro').disabled = "";
			document.getElementById('btnBaja').disabled = "";
		}
		document.getElementById('btnGuardarOrganizacion').disabled = "";      
		document.getElementById('btnCerrarFichaFuncionario').disabled = "";  
		document.getElementById("mensajeCargando").style.display = "none";   		
	}
}

function asignaValoresFichaFuncionario(escalafon, grado, cargo, habilitarBotones, cuadranteCargo, dias, tipo){
	//if (cargaGrados == 1 && cargaCargos == 1 && cargaEscalafon == 1){
	
	//alert(tipo);
	if (cargaCargos == 1 && cargaEscalafon == 1){
		clearInterval(idAsignaFichaPersonal);
		
		//idAsignaGradoFichaPersonal = setInterval("llenaGradoFichaPersonal()",1000);
		//document.getElementById("selGrado").value 			= grado;
		if (tipo == 0) document.getElementById("selCargo").value 			= cargo;
		if (tipo == 0) document.getElementById("cargoBaseDatos").value 	= cargo;
		if (tipo == 0) document.getElementById("selCuadrante").value 		= cuadranteCargo;
        if (tipo == 0) document.getElementById("textCantDias").value 		= dias; //agregado
		document.getElementById("selEscalafon").value 		= escalafon; 
		leeGrados('selGrado', escalafon, document.getElementById("selEscalafon")[document.getElementById("selEscalafon").selectedIndex].text);	
		idAsignaGradoFichaPersonal = setInterval("llenaGradoFichaPersonal("+grado+","+habilitarBotones+")",1000);
		activaFechaNuevoCargo();
		
		//alert(habilitarBotones);
		//if (habilitarBotones){			
		//	document.getElementById('btnDejarDisponible').disabled = "";
		//	document.getElementById('btnRetiro').disabled = "";
		//	document.getElementById('btnBaja').disabled = "";
		//}
		//document.getElementById('btnGuardarOrganizacion').disabled = "";      
		//document.getElementById('btnCerrarFichaFuncionario').disabled = "";      
	}
}

function buscaFuncionarioPersonal(codigoFuncionario){

	var objHttpXMLFuncionario = new AJAXCrearObjeto();
	objHttpXMLFuncionario.open("POST","./xml/xmlFuncionarios/xmlBuscaFuncionario.php",false);
	objHttpXMLFuncionario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionario.send(encodeURI("codigoFuncionario="+codigoFuncionario));
	
	//objHttpXMLFuncionario.onreadystatechange=function()
	//{
	//	if(objHttpXMLFuncionario.readyState == 4)
	//	{       
			if (objHttpXMLFuncionario.responseText != "VACIO"){
				//alert(objHttpXMLFuncionario.responseText);	
				var xml 							= objHttpXMLFuncionario.responseXML.documentElement;
				var codigo	 				  = "";
				var rut				 			  = "";
				var apellidoPaterno		= "";
				var apellidoMaterno		= "";
				var primerNombre	 	  = "";
				var segundoNombre	 	  = "";
				var escalafon	 		 		= "";
				var grado		 		  		= "";
				
				//alert();				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					rut	 		 	= xml.getElementsByTagName('rut')[i].text;
					codigo	 		 	= xml.getElementsByTagName('codigo')[i].text;
					apellidoPaterno	 		 	= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellidoMaterno	 		 	= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre	 		 	= xml.getElementsByTagName('nombre')[i].text;
					segundoNombre	 		 	= xml.getElementsByTagName('nombre2')[i].text;
					escalafon	 		 	= xml.getElementsByTagName('codigoEscalafon')[i].text;
					grado	 		 	= xml.getElementsByTagName('codigoGrado')[i].text;					
					
					document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	 				
					//document.getElementById("idFuncionario").value					= codigo;
					document.getElementById("textCodigoFuncionario").value	= codigo;
					document.getElementById("textRutFuncionario").value			= rut;
					document.getElementById("textApellidoPaterno").value 		= apellidoPaterno;
					document.getElementById("textApellidoMaterno").value 		= apellidoMaterno;
					document.getElementById("textPrimerNombre").value 	 		= primerNombre;
					document.getElementById("textSegundoNombre").value 	 		= segundoNombre;
					
					var valoresAsignar = "'"+escalafon+"','" + grado + "','',false,'',1";   

					idAsignaFichaPersonal = setInterval("asignaValoresFichaFuncionario("+valoresAsignar+")",1000);
					//alert("true");										
					return true;
				}
			} else {
				//alert("FUNCIONARIO NO ENCONTRADO EN LA BASE DE DATOS.");
				return false;
			}
	//	}
	//}
}

function actualizarFuncionario(){
	
	var codigoFuncionario	= document.getElementById("textCodigoFuncionario").value.toUpperCase();
	var codigoEscalafon 	= document.getElementById("selEscalafon").value;
	var codigoGrado			= document.getElementById("selGrado").value;
	var apellidoPaterno		= document.getElementById("textApellidoPaterno").value.toUpperCase();
	var apellidoMaterno		= document.getElementById("textApellidoMaterno").value.toUpperCase();
	var primerNombre		= document.getElementById("textPrimerNombre").value.toUpperCase();
	var segundoNombre		= document.getElementById("textSegundoNombre").value.toUpperCase();
	var codigoCargo			= document.getElementById("selCargo").value;
	var codigoCuadrante		= document.getElementById("selCuadrante").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	
	var unidadUsuario		= document.getElementById("unidadUsuario").value;
	var fechaCargo			= document.getElementById("textFechaUltimoCargo").value;
    
    var dias			    = document.getElementById("textCantDias").value;	//Variable agregada el 28-04-2015
			
	var parametros = "";
	
	parametros += "codigoFuncionario="+codigoFuncionario+"&codigoEscalafon="+codigoEscalafon+"&codigoGrado="+codigoGrado;
	parametros += "&apellidoPaterno="+apellidoPaterno+"&apellidoMaterno="+apellidoMaterno+"&primerNombre="+primerNombre;
	parametros += "&segundoNombre="+segundoNombre+"&codigoCargo="+codigoCargo+"&unidadUsuario="+unidadUsuario+"&fechaCargo="+fechaCargo;
	parametros += "&codigoCuadrante="+codigoCuadrante+"&codigoUnidadAgregado="+codigoUnidadAgregado+"&dias="+dias;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlActualizaFuncionario.php",true);
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
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario,'','');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}


function nuevoFuncionario(){

	var codigoFuncionario	= document.getElementById("textCodigoFuncionario").value.toUpperCase();
	var codigoEscalafon 	= document.getElementById("selEscalafon").value;
	var codigoGrado			= document.getElementById("selGrado").value;
	var apellidoPaterno		= document.getElementById("textApellidoPaterno").value.toUpperCase();
	var apellidoMaterno		= document.getElementById("textApellidoMaterno").value.toUpperCase();
	var primerNombre		= document.getElementById("textPrimerNombre").value.toUpperCase();
	var segundoNombre		= document.getElementById("textSegundoNombre").value.toUpperCase();
	var codigoCargo			= document.getElementById("selCargo").value;
	var codigoCuadrante		= document.getElementById("selCuadrante").value;
	
	var unidadUsuario		= document.getElementById("unidadUsuario").value;
	var fechaCargo			= document.getElementById("textFechaUltimoCargo").value;
    var dias			    = document.getElementById("textCantDias").value;	//Variable agregada el 28-04-2015
    var rutFuncionario = document.getElementById("textRutFuncionario").value;
			
	var parametros = "";
	
	parametros += "codigoFuncionario="+codigoFuncionario+"&codigoEscalafon="+codigoEscalafon+"&codigoGrado="+codigoGrado;
	parametros += "&apellidoPaterno="+apellidoPaterno+"&apellidoMaterno="+apellidoMaterno+"&primerNombre="+primerNombre;
	parametros += "&segundoNombre="+segundoNombre+"&codigoCargo="+codigoCargo+"&unidadUsuario="+unidadUsuario+"&fechaCargo="+fechaCargo;
	parametros += "&codigoCuadrante="+codigoCuadrante+"&dias="+dias+"&rutFuncionario="+rutFuncionario;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlNuevoFuncionario.php",true);
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


function validarFichaFuncionario(){
	var codigoFuncionario	= eliminarBlancos(document.getElementById("textCodigoFuncionario").value.toUpperCase());
	var codigoEscalafon 	= document.getElementById("selEscalafon").value;
	var codigoGrado			= document.getElementById("selGrado").value;
	var apellidoPaterno		= eliminarBlancos(document.getElementById("textApellidoPaterno").value);
	var apellidoMaterno		= eliminarBlancos(document.getElementById("textApellidoMaterno").value);
	var primerNombre		= eliminarBlancos(document.getElementById("textPrimerNombre").value);
	var segundoNombre		= eliminarBlancos(document.getElementById("textSegundoNombre").value);
	var codigoCargo			= document.getElementById("selCargo").value;
	var codigoCuadrante		= document.getElementById("selCuadrante").value;
	var fechaCargo			= document.getElementById("textFechaUltimoCargo").value;
	var ultimaFechaCargo	= document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	//var fechaServicioSel	= document.getElementById("textFechaServicio").value;
	var dia			 = document.getElementById("textCantDias").value; //variable agregada
	var diasLicencia = document.getElementById("textCantDias2").value; //variable agregada

	//alert(ultimaFechaCargo);

	if (codigoFuncionario == ""){
		alert("DEBE INDICAR EL CODIGO DE FUNCIONARIO ...... 	     ");
		document.getElementById("textCodigoFuncionario").focus();
		return false;
	}
	
	var regExCodigoFun = /^[0-9]{6,6}[A-Z]{1,1}$/;
	var codigoValido = codigoFuncionario.match(regExCodigoFun);
	
	//alert(codigoValido);
	
	if (!codigoValido){
		alert("EL CODIGO DE FUNCIONARIO INGRESADO NO TIENE UNA ESTRUCTURA VALIDA...... 	     ");
		document.getElementById("textCodigoFuncionario").focus();
		return false;
	}
	
	if (codigoEscalafon == 0) {
		alert("DEBE INDICAR EL ESCALAFON DEL FUNCIONARIO ...... 	     ");
		document.getElementById("selEscalafon").focus();
		return false;
	}
	
	if (codigoGrado == 0) {
		alert("DEBE INDICAR EL GRADO DEL FUNCIONARIO ...... 	     ");
		document.getElementById("selGrado").focus();
		return false;
	}
	
	if (apellidoPaterno == "") {
		alert("DEBE INDICAR EL APELLIDO PATERNO DEL FUNCIONARIO ...... 	     ");
		document.getElementById("textApellidoPaterno").focus();
		return false;
	}	
	
	if (apellidoMaterno == "") {
		alert("DEBE INDICAR EL APELLIDO MATERNO DEL FUNCIONARIO ...... 	     ");
		document.getElementById("textApellidoMaterno").focus();
		return false;
	}	
	
	if (primerNombre == "") {
		alert("DEBE INDICAR EL PRIMER NOMBRE DEL FUNCIONARIO ...... 	     ");
		document.getElementById("textPrimerNombre").focus();
		return false;
	}	
	
	if (codigoCargo == 0) {
		alert("DEBE INDICAR EL CARGO DEL FUNCIONARIO ...... 	     ");
		document.getElementById("selCargo").focus();
		return false;
	}
	
	
	if ((codigoCargo == 180 || codigoCargo == 310) && document.getElementById("tienePlanCuadrante").value == 1){
		if (codigoCuadrante == 0) {
			alert("DEBE INDICAR EL CUADRANTE DEL FUNCIONARIO ...... 	     ");
			document.getElementById("selCuadrante").focus();
			return false;
		}
	}
	
	if ((codigoCargo == 3000 || document.getElementById("selCargo").value == 3100 || document.getElementById("selCargo").value == 3001
			|| document.getElementById("selCargo").value == 3002 || document.getElementById("selCargo").value == 3003 || document.getElementById("selCargo").value == 3004
			|| document.getElementById("selCargo").value == 3005) && codigoUnidadAgregado == ""){
		alert("DEBE INDICAR UNIDAD A LA QUE EL FUNCIONARIO SE FUE AGREGADO...... 	     ");
		return false;
	}
	
        //Control para que no cambien o modifiquen dias
	if((codigoCargo == 7010 && diasLicencia != "") || (codigoCargo != 7010 && diasLicencia != "")){
       //alert("Fecha ingresada: "+fechaCargo);
       //alert("Fecha sistema: "+ultimaFechaCargo);
       //Suma de dias de licencia
	   var fechaSuma = sumaFecha(diasLicencia,ultimaFechaCargo);
       //alert("Suma Final :"+fechaSuma);
       //Fin suma
       
       //Cambio de formato de fecha para fecha nueva ingresada
        var fechaNueva =fechaCargo; 
        var sep = fechaNueva.indexOf('/') != -1 ? '/' : '-'; 
        var aFechaNueva = fechaNueva.split(sep);
        var nuevaFecha = aFechaNueva[2]+'/'+aFechaNueva[1]+'/'+aFechaNueva[0];
        //alert("Fecha formato nuevo 1: "+nuevaFecha);
       //Fin cambio de formato 1
        
        //Cambio de formato de fecha para fecha calculada
        var fechaCalculo = fechaSuma; 
        var sep = fechaCalculo.indexOf('/') != -1 ? '/' : '-'; 
        var aFechaCalculo = fechaCalculo.split(sep);
        var calculoFecha = aFechaCalculo[2]+'/'+aFechaCalculo[1]+'/'+aFechaCalculo[0];
        //alert("Fecha formato nuevo 2: "+calculoFecha);
        //Fin cambio de formato 2
        
        //Creacion objetos fecha javascript
        var fecha1 = new Date(nuevaFecha); 
        //alert("Fecha 1: "+fecha1);
        var fecha2 = new Date(calculoFecha); 
        //alert("Fecha 2: "+fecha2);
        //Fin objetos   
       if(Date.parse(fecha1) < Date.parse(fecha2)){
         alert("LA FECHA PARA EL NUEVO CARGO NO PUEDE SER INFERIOR A LA CANTIDAD DE DIAS DE LICENCIA INGRESADOS ("+diasLicencia+").\nLOS CAMBIOS PUEDEN SER REALIZADOS A PARTIR DEL: "+fechaSuma);
         document.getElementById("textFechaUltimoCargo").focus();
         return false;
       }
	}
    //Fin nuevo control
    
    //Nueva validacion agregada
	if (codigoCargo == 7010 && dia == ""){
        alert("DEBE INDICAR LA CANTIDAD DE DIAS ...... 	     ");
		document.getElementById("textCantDias").focus();
		return false;
	}else if(codigoCargo == 7010 && dia == 0){
		   alert("LA CANTIDAD DE DIAS DEBE SER MAYOR A CERO ...... 	     ");
		document.getElementById("textCantDias").focus();
		return false;
		}else if(codigoCargo == 7010 && fechaCargo == ""){
	       alert("DEBE INDICAR FECHA DEL MOVIMIENTO ...... 	     ");
		return false;
		}
//Fin validacion
	
	if (document.getElementById("selCargo").value != document.getElementById("cargoBaseDatos").value ||
		document.getElementById("selCuadrante").value != document.getElementById("codCuadranteBaseDatos").value ||
		document.getElementById("codigoUnidadAgregado").value != document.getElementById("codUnidadAgregadoBaseDatos").value||
        document.getElementById("textCantDias").value != document.getElementById("textCantDias2").value){
	//if (fechaCargo != ""){	
		if (fechaCargo == ""){
			alert("DEBE INDICAR FECHA DEL MOVIMIENTO ...... 	     ");
			return false;
		}
		
		var comparaFechaLimite = comparaFecha(fechaLimite,fechaCargo)
		//alert(comparaFechaLimite);
		if (unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
		}
		
		var fechaMayor = comparaFecha(ultimaFechaCargo,fechaCargo);
		//alert(fechaMayor);
		if (fechaMayor == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaCargo);
			return false;
		}
		
		//**************************************
     //Llamo a la nueva funcion --inicio
        var cantidadServicio = controlCargoFuncionario(codigoFuncionario,fechaCargo,'01-01-3000');
        //alert(cantidadServicio);  
        if(cantidadServicio == 1){
            return false;
        }   
      //fin  
     //************************************     
		
		
		
		
	}
	
	return true;
}


function guardarFichaFuncionario(){
	desactivarBotones();
	var validaOk = validarFichaFuncionario();
	//alert(document.getElementById("idFuncionario").value);
	
	var codigoFuncionario = document.getElementById("idFuncionario").value;
	//alert(validaOk);
	if (validaOk){
		if (codigoFuncionario != "") {
			var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTE FUNCIONARIO EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj){
				actualizarFuncionario();
			} else {
				activarBotones();
				return false;
			}
		} else {
			var msj=confirm("ATENCIÓN :\nSE INGRESARÁN LOS DATOS DE ESTE FUNCIONARIO EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) {
				nuevoFuncionario();
			} else {
				activarBotones();
				return false;
			}
		}
	} else {
		activarBotones();
	}
}



function activaVentnaIngresoFecha(boton){
	
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";	
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este Funcionario :"
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Retiro de este Funcionario :"
	if (boton == 3) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo la Baja de este Funcionario :"
}


function desactivaVentnaIngresoFecha(){
	
	activarBotones();
	document.getElementById("cubreVentanaPersonal").style.display = "none";
	document.getElementById("ventanaIngresoFecha").style.display  = "none";	
}

function aceptaFechaVentaIngresoFecha(){
	
	var ultimaFechaCargo = document.getElementById("ultimaFecha").value;
	var tipo = document.getElementById("textTipo").value;
	var fecha = document.getElementById("textFechaVentanaFecha").value;
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	if (fecha == ""){
		alert("DEBE INDICAR UNA FECHA ....");
		return false;
	}
	
	
	var comparaFechaLimite = comparaFecha(fechaLimite,fecha)
		//alert(comparaFechaLimite);
	if (unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
	}
	
		
	var fechaMayor = comparaFecha(ultimaFechaCargo,fecha);
		//alert(fechaMayor);
	if (fechaMayor == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaCargo);
		return false;
	}
	
	var codigoFuncionario	= document.getElementById("textCodigoFuncionario").value;
	//**************************************
     //Llamo a la nueva funcion --inicio
        var cantidadServicio = controlCargoFuncionario(codigoFuncionario,fecha,'01-01-3000');
        //alert(cantidadServicio);  
        if(cantidadServicio == 1){
            return false;
        }   
      //fin  
     //************************************ 
	
	
	document.getElementById("ventanaIngresoFecha").style.display  = "none";	
	document.getElementById("cubreVentanaPersonal").style.display = "none"; 
	if (tipo == 1) liberaFuncionario();
	if (tipo == 2) retiroFuncionario();   
	if (tipo == 3) bajaFuncionario();
	
	//var codigoFuncionario	= document.getElementById("textCodigoFuncionario").value;
	eliminarUsuario(codigoFuncionario);
}


function liberaFuncionario(){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	
	var msj=confirm("SACARÁ ESTE FUNCIONARIO DE LA OFERTA DE SU UNIDAD.                                       \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		//var validaOk = validarFichaFuncionario();
		var validaOk = true;
		if (validaOk){
			var codigoFuncionario	= document.getElementById("textCodigoFuncionario").value;
			parametros += "codigoFuncionario="+codigoFuncionario;
			parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
			
			//alert(parametros);
			
			var objHttpXMLFuncionarios = new AJAXCrearObjeto();
			objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlLiberaFuncionario.php",true);
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
								 top.leeFuncionarios(unidadUsuario, '', '');
								 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal();",1000);
								 alert('EL FUNCIONARIO FUE DEJADO DISPONIBLE PARA OTRA UNIDAD ......        ');
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
						}
					}
				}
			}
		}
	} else {
		activarBotones();
	}
}    


function bajaFuncionario_old(){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	
	var validaOk = validarFichaFuncionario();
	if (validaOk){
		
		var codigoFuncionario	= document.getElementById("textCodigoFuncionario").value;
		var codigoEscalafon 	= document.getElementById("selEscalafon").value;
		var codigoGrado			= document.getElementById("selGrado").value;
		var apellidoPaterno		= document.getElementById("textApellidoPaterno").value;
		var apellidoMaterno		= document.getElementById("textApellidoMaterno").value;
		var primerNombre		= document.getElementById("textPrimerNombre").value;
		var segundoNombre		= document.getElementById("textSegundoNombre").value;
		var codigoCargo			= document.getElementById("selCargo").value;
				
		var parametros = "";
		
		parametros += "codigoFuncionario="+codigoFuncionario+"&codigoEscalafon="+codigoEscalafon+"&codigoGrado="+codigoGrado;
		parametros += "&apellidoPaterno="+apellidoPaterno+"&apellidoMaterno="+apellidoMaterno+"&primerNombre="+primerNombre;
		parametros += "&segundoNombre="+segundoNombre+"&codigoCargo="+codigoCargo+"&codigoUnidad="+unidadUsuario;
		
		//alert(parametros);
		
		var objHttpXMLFuncionarios = new AJAXCrearObjeto();
		objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlBajaFuncionario.php",true);
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
}

function bajaFuncionario(){
	var msj=confirm("LO SACARÁ DE LA OFERTA PARA ESTA Y TODAS LAS UNIDADES DE CARABINEROS, POR BAJA.        \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var unidadUsuario = document.getElementById("unidadUsuario").value;
		var codigoFuncionario = document.getElementById("textCodigoFuncionario").value;
		var parametros 		  = "";
			
		parametros += "codigoFuncionario="+codigoFuncionario+"&codigoUnidad="+unidadUsuario;
		parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value; 
			
		//alert(parametros);
			
		var objHttpXMLFuncionarios = new AJAXCrearObjeto();
		objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlBajaFuncionario.php",true);
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
}


function retiroFuncionario(){
	var msj=confirm("LO SACARÁ DE LA OFERTA PARA ESTA Y TODAS LAS UNIDADES DE CARABINEROS, POR RETIRO VOLUNTARIO.        \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var unidadUsuario = document.getElementById("unidadUsuario").value;
		var codigoFuncionario = document.getElementById("textCodigoFuncionario").value;
		var parametros 		  = "";
			
		parametros += "codigoFuncionario="+codigoFuncionario+"&codigoUnidad="+unidadUsuario;
		parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value; 	
		//alert(parametros);
			
		var objHttpXMLFuncionarios = new AJAXCrearObjeto();
		objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlRetiroFuncionario.php",true);
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
}


function cerrarVentanaPersonal(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		 top.cerrarVentana();
	}
}

function activaFechaNuevoCargo(){
	//alert(document.getElementById("selEstado").value);
	//alert(document.getElementById("estadoBaseDatos").value);
   var dias=document.getElementById("textCantDias2").value; //Nueva variable
   
	if (document.getElementById("selCargo").value != document.getElementById("cargoBaseDatos").value){
		if ((document.getElementById("selCargo").value == 180 || document.getElementById("selCargo").value == 310) && document.getElementById("tienePlanCuadrante").value == 1){
			//document.getElementById("cuadranteCargo").style.display= "";
			document.getElementById("labCuadrante").disabled= "";
			document.getElementById("selCuadrante").disabled= "";
			document.getElementById("selCuadrante").style.backgroundColor = "";
		} else {
			//document.getElementById("cuadranteCargo").style.display= "none";
			document.getElementById("labCuadrante").disabled= "true";
			document.getElementById("selCuadrante").disabled= "true";
			document.getElementById("selCuadrante").style.backgroundColor = "#E6E6E6";
			document.getElementById("selCuadrante").value= 0;
		}
		
		if (document.getElementById("selCargo").value == 3000 || document.getElementById("selCargo").value == 3100 || document.getElementById("selCargo").value == 3001
			|| document.getElementById("selCargo").value == 3002 || document.getElementById("selCargo").value == 3003 || document.getElementById("selCargo").value == 3004
			|| document.getElementById("selCargo").value == 3005 || document.getElementById("selCargo").value == 6000){
			//document.getElementById("divUnidadAgregado").style.display= "";
			//document.getElementById("cuadranteCargo").style.display= "none";
			document.getElementById("labUnidadAgregado").disabled= "";
			document.getElementById("btnUnidades").disabled= "";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "";
			document.getElementById("textUnidadAgregado").disabled= ""
			if (document.getElementById("codUnidadAgregadoBaseDatos").value != ""){
				document.getElementById("codigoUnidadAgregado").value 	 	= document.getElementById("codUnidadAgregadoBaseDatos").value;
				document.getElementById("textUnidadAgregado").value 	 	= document.getElementById("desUnidadAgregadoBaseDatos").value;
			}
		} else {
			//document.getElementById("divUnidadAgregado").style.display= "none";
			//document.getElementById("cuadranteCargo").style.display= "";
			document.getElementById("labUnidadAgregado").disabled= "";
			document.getElementById("labUnidadAgregado").disabled= "true";
			document.getElementById("btnUnidades").disabled= "true";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "#E6E6E6";
			document.getElementById("textUnidadAgregado").value= "";
			document.getElementById("textUnidadAgregado").disabled= "true"
			document.getElementById("codigoUnidadAgregado").value= "";
		}
		
		
		document.getElementById("labFechaCargo").disabled= "";
		document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "visible";
		document.getElementById("textFechaUltimoCargo").style.backgroundColor = "";
		document.getElementById("textFechaUltimoCargo").disabled= ""
	} else {
		if ((document.getElementById("selCargo").value == 180  || document.getElementById("selCargo").value == 310) && document.getElementById("tienePlanCuadrante").value == 1){
			document.getElementById("labCuadrante").disabled= "";
			document.getElementById("selCuadrante").disabled= "";
			document.getElementById("selCuadrante").style.backgroundColor = "";
		} else {
			document.getElementById("labCuadrante").disabled= "true";
			document.getElementById("selCuadrante").disabled= "true";
			document.getElementById("selCuadrante").style.backgroundColor = "#E6E6E6";
			document.getElementById("selCuadrante").value= 0;
		}
		
        //Nueva condicion agregada 30-06-2015
 	  if (document.getElementById("selCargo").value == 7010 && document.getElementById("textCantDias").value != 0){
  	        document.getElementById("textCantDias").disabled= "";
			document.getElementById("textCantDias").style.backgroundColor = "";
			document.getElementById("labFechaCargo1").disabled= "";
			document.getElementById("labFechaCargo1").style.backgroundColor = "";
			document.getElementById("labFechaCargo").innerHTML = "(*) TIPO DE LICENCIA&nbsp;:&nbsp;";
		} else {
            document.getElementById("textCantDias").disabled= "true";
			document.getElementById("textCantDias").style.backgroundColor = "#E6E6E6";
			document.getElementById("textCantDias").value= dias;
			document.getElementById("labFechaCargo1").disabled= "true";
			document.getElementById("labFechaCargo").innerHTML = "(*) FECHA MOVIMIENTO&nbsp;:&nbsp;";	
		}
     //Fin condicion agregada
        
		if (document.getElementById("selCargo").value == 3000 || document.getElementById("selCargo").value == 3100 || document.getElementById("selCargo").value == 3001
			|| document.getElementById("selCargo").value == 3002 || document.getElementById("selCargo").value == 3003 || document.getElementById("selCargo").value == 3004
			|| document.getElementById("selCargo").value == 3005 || document.getElementById("selCargo").value == 6000){
			document.getElementById("labUnidadAgregado").disabled= "";
			document.getElementById("btnUnidades").disabled= "";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "";
			document.getElementById("textUnidadAgregado").disabled= "";
			
			if (document.getElementById("codUnidadAgregadoBaseDatos").value != ""){
				document.getElementById("codigoUnidadAgregado").value 	 	= document.getElementById("codUnidadAgregadoBaseDatos").value;
				document.getElementById("textUnidadAgregado").value 	 	= document.getElementById("desUnidadAgregadoBaseDatos").value;
			}
		} else {
			document.getElementById("labUnidadAgregado").disabled= "true";
			document.getElementById("btnUnidades").disabled= "true";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "#E6E6E6";
			document.getElementById("textUnidadAgregado").value= "";
			document.getElementById("textUnidadAgregado").disabled= "true";
		}
		
		document.getElementById("labFechaCargo").disabled = "true";
		document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "hidden";
		document.getElementById("textFechaUltimoCargo").value = "";
		document.getElementById("textFechaUltimoCargo").style.backgroundColor = "#E6E6E6";
		document.getElementById("textFechaUltimoCargo").disabled= "true";
				
	}
}

//INICIO NUEVA FUNCION 30-06-20105
function activaLicencia(){
if(document.getElementById("selCargo").value == 7010){
	    document.getElementById("labFechaCargo1").disabled = "";
		document.getElementById("textCantDias").style.backgroundColor = "";
		document.getElementById("textCantDias").disabled= "";
		document.getElementById("labFechaCargo").innerHTML = "(*) TIPO DE LICENCIA&nbsp;:&nbsp;";	
        document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "visible";
 }else{
	    document.getElementById("labFechaCargo1").disabled = "true";
		document.getElementById("textCantDias").style.backgroundColor = "#E6E6E6";
		document.getElementById("textCantDias").disabled= "true";	
		document.getElementById("labFechaCargo").innerHTML = "(*) FECHA MOVIMIENTO&nbsp;:&nbsp;";
		document.getElementById("textCantDias").value= "";
	}		
}
//FIN NUEVA FUNCION


function modificaCudranteFuncionario(){
	
	if (document.getElementById("codCuadranteBaseDatos").value != document.getElementById("selCuadrante").value){
		document.getElementById("labFechaCargo").disabled= "";
		document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "visible";
		document.getElementById("textFechaUltimoCargo").style.backgroundColor = "";
	} else {
		document.getElementById("labFechaCargo").disabled = "true";
		document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "hidden";
		document.getElementById("textFechaUltimoCargo").value = "";
		document.getElementById("textFechaUltimoCargo").style.backgroundColor = "#E6E6E6";
	}
}

function desactivarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "true";
	document.getElementById("btnRetiro").disabled = "true";
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardarOrganizacion").disabled = "true";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "true";
	
}

function activarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "";
	document.getElementById("btnRetiro").disabled = "";
	document.getElementById("btnBaja").disabled = "";
	document.getElementById("btnGuardarOrganizacion").disabled = "";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "";
	
}


function leeFuncionariosPorGrado(unidad, tipoUnidad, escalafon, grado, desGrado, inicio){
	
	//alert("unidad : "+unidad+ "; tipoUnidad : "+tipoUnidad+"; desGrado : "+desGrado+"; inicio : "+inicio);
	//var fecha1 = document.getElementById("textBuscar").value;
	//alert();
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	var contenidoPaso = div.innerHTML;
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";
	document.getElementById("totalPersonal").innerHTML 	= "-";
	
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlConsultaFuncionarios.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&tipoUnidad="+tipoUnidad+"&escalafon="+escalafon+"&grado="+grado+"&desGrado="+desGrado+"&inicio="+inicio));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 			 	= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigoUnidad		= "";
				var descripcionUnidad	= "";
				var codigoEscalafon	 	= "";
				var codigoGrado	 		= "";
				var descripcionGrado 	= "";
				var cantidadPersonal 	= "";
																		
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				var sumCantidadPersonal = 0;
								
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('funcionarios').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigoUnidad	 	= xml.getElementsByTagName('codUnidad ')[i].text;
					descripcionUnidad	= xml.getElementsByTagName('desUnidad ')[i].text;
					codigoEscalafon	 	= xml.getElementsByTagName('codEscalafon')[i].text;
					codigoGrado			= xml.getElementsByTagName('codGrado')[i].text;
					descripcionGrado	= xml.getElementsByTagName('desGrado')[i].text;
					cantidadPersonal	= xml.getElementsByTagName('cantidadFuncionarios')[i].text;
										
					sumCantidadPersonal += cantidadPersonal*1;
															
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					//alert("codigoUnidad "+codigoUnidad);
					
					if (codigoUnidad == "") codigoUnidad = unidad;
					//alert(tipoUnidad);
					if (tipoUnidad == "nacional") var unidadHijo = "zona";					
					if (tipoUnidad == "zona") var unidadHijo = "prefectura";					
					if (tipoUnidad == "prefectura") var unidadHijo = "comisaria";
					if (tipoUnidad == "comisaria") var unidadHijo = "destacamento";
					
					inicio = 1;
					//alert(correlativo);
					
					//alert(unidadHijo);
					//alert(inicio);
					//?unidad="+codigoUnidad+"&grado="+descripcionGrado"
					if (typeof (unidadHijo) == "undefined")var dblClick = "javascript:abrirVentana('LISTADO PERSONAL ...', '995', '500','muestraListaPersonal.php?unidad="+codigoUnidad+"&grado="+descripcionGrado+"', '','','0','0')";
					else var dblClick = "leeFuncionariosPorGrado('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+descripcionGrado+"','"+inicio+"')";
					
					//if (unidadHijo != "destacamento") var dblClick = "leeFuncionariosPorGrado('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+descripcionGrado+"','"+inicio+"')";
					//else var dblClick = "";
					
										
					//if (correlativo == "") var dblClick = "leeServiciosAgregados('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+inicio+"')";
					//if (correlativo != "") var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					//var dblClick = "";
					//alert();     
					if (descripcionUnidad == "") descripcionUnidad = "NIVEL NACIONAL";
									
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
					listadoServicios += "<td width='45%'><div id='valorColumna'>"+descripcionGrado.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='20%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadPersonal,0,',','.')+"</div></td>";
					listadoServicios += "</tr>";
					//alert(listadoServicios);
				}
				listadoServicios += "</table>";
				
								
				//alert(listadoServicios);
				//alert();
				div.innerHTML = listadoServicios;
				document.getElementById("totalPersonal").innerHTML = formato_numero(sumCantidadPersonal,0,',','.');
				//document.getElementById("totalVehiculos").innerHTML = formato_numero(sumCantidadVehiculos,0,',','.');
				
				cargaListadoServicios = 1;
			} else {
				div.innerHTML = contenidoPaso;    
				eval("abrirVentana('LISTADO PERSONAL ...', '995', '500','muestraListaPersonal.php?unidad="+unidad+"&grado="+desGrado+"', '','','0','0')");
				//div.innerHTML = "";
				//alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
				//cargaListadoServicios = 1;
			}
		}
	}
}


function leeFuncionariosPorGrado2(unidad, tipoUnidad, tipoUnidadPadre, escalafon, grado, desGrado, inicio){
	
	//alert("unidad : "+unidad+ "; tipoUnidad : "+tipoUnidad+"; desGrado : "+desGrado+"; inicio : "+inicio);
	//var fecha1 = document.getElementById("textBuscar").value;
	//alert();
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	var contenidoPaso = div.innerHTML;
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";
	document.getElementById("totalPersonal").innerHTML 	= "-";
	
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlConsultaFuncionarios2.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&tipoUnidad="+tipoUnidad+"&tipoUnidadPadre="+tipoUnidadPadre+"&escalafon="+escalafon+"&grado="+grado+"&desGrado="+desGrado+"&inicio="+inicio));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 			 			= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigoUnidad				= "";
				var descripcionUnidad			= "";
				var codigoEscalafon	 			= "";
				var codigoGrado	 				= "";
				var descripcionGrado 			= "";
				var cantidadPersonal 			= "";
				var cantidadPersonalAgregado 	= "";
																		
				var sw 				 			= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 			= "";
				var lineaSinResaltar 			= "";
				var listadoServicios 			= "";
				var sumCantidadPersonal 		= 0;
				var sumCantidadPersonalAgregado	= 0;
												
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('funcionarios').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigoUnidad	 			= xml.getElementsByTagName('codUnidad ')[i].text;
					descripcionUnidad			= xml.getElementsByTagName('desUnidad ')[i].text;
					codigoEscalafon	 			= xml.getElementsByTagName('codEscalafon')[i].text;
					codigoGrado					= xml.getElementsByTagName('codGrado')[i].text;
					descripcionGrado			= xml.getElementsByTagName('desGrado')[i].text;
					cantidadPersonal			= xml.getElementsByTagName('cantidadFuncionarios')[i].text;
					cantidadPersonalAgregado	= xml.getElementsByTagName('cantidadFuncionariosAgregados')[i].text;
										
					sumCantidadPersonal += cantidadPersonal*1;
					sumCantidadPersonalAgregado += cantidadPersonalAgregado*1;
															
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					//alert("codigoUnidad "+codigoUnidad);
					
					if (codigoUnidad == "") codigoUnidad = unidad;
					//alert(tipoUnidad);
					if (tipoUnidad == "nacional") var unidadHijo = "superZona";	
					if (tipoUnidad == "superZona") var unidadHijo = "zona";				
					if (tipoUnidad == "zona") var unidadHijo = "prefectura";					
					if (tipoUnidad == "prefectura") var unidadHijo = "comisaria";
					if (tipoUnidad == "comisaria") var unidadHijo = "destacamento";
					
					inicio = 1;
					//alert(correlativo);
					
					//alert(unidadHijo);
					//alert(inicio);
					//?unidad="+codigoUnidad+"&grado="+descripcionGrado"
					if (typeof (unidadHijo) == "undefined")var dblClick = "javascript:abrirVentana('LISTADO PERSONAL ...', '995', '500','muestraListaPersonal.php?unidad="+codigoUnidad+"&grado="+descripcionGrado+"', '','','0','0')";
					else var dblClick = "leeFuncionariosPorGrado2('"+codigoUnidad+"','"+unidadHijo+"','"+tipoUnidad+"','"+codigoEscalafon+"','"+codigoGrado+"','"+descripcionGrado+"','"+inicio+"')";
					
					//if (unidadHijo != "destacamento") var dblClick = "leeFuncionariosPorGrado('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+descripcionGrado+"','"+inicio+"')";
					//else var dblClick = "";
					
										
					//if (correlativo == "") var dblClick = "leeServiciosAgregados('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+inicio+"')";
					//if (correlativo != "") var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					//var dblClick = "";
					//alert();     
					if (descripcionUnidad == "") descripcionUnidad = "NIVEL NACIONAL";
									
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
					listadoServicios += "<td width='25%'><div id='valorColumna'>"+descripcionGrado.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='20%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadPersonal,0,',','.')+"</div></td>";
					listadoServicios += "<td width='20%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadPersonalAgregado,0,',','.')+"</div></td>";
					listadoServicios += "</tr>";
					//alert(listadoServicios);
				}
				listadoServicios += "</table>";
				
								
				//alert(listadoServicios);
				//alert();
				div.innerHTML = listadoServicios;
				document.getElementById("totalPersonal").innerHTML = formato_numero(sumCantidadPersonal,0,',','.');
				document.getElementById("totalPersonalAgregado").innerHTML = formato_numero(sumCantidadPersonalAgregado,0,',','.');
				
				cargaListadoServicios = 1;
			} else {
				div.innerHTML = contenidoPaso;    
				eval("abrirVentana('LISTADO PERSONAL ...', '995', '500','muestraListaPersonal.php?unidad="+unidad+"&grado="+desGrado+"', '','','0','0')");
				//div.innerHTML = "";
				//alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
				//cargaListadoServicios = 1;
			}
		}
	}
}


function muestraListaFuncionarios(unidad, escalafon, grado){
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("kk");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";
	
	var campoOrden = "nombre";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlListaFuncionarios.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&escalafon="+escalafon+"&grado="+grado+"&campo="+campoOrden));  
	
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
				var codigoCargo	 		= "";
				var unidadAgregado		= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				listadoFuncionarios = "<table width='98%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					grado		 	 = xml.getElementsByTagName('grado')[i].text;
					cargo		 	 = xml.getElementsByTagName('cargo')[i].text;
					codigoCargo	 	 = xml.getElementsByTagName('codigoCargo')[i].text;
					unidadAgregado 	 = xml.getElementsByTagName('unidadAgregado')[i].text;
										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada2')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
										
					var nroLinea = i + 1;
					//var dblClick = "javascript:abrirVentana('FUNCIONARIO', '800', '315','fichaPersonal.php?codigoFuncionario="+codigo+"','"+nroLinea+"','','5','5')";
					var dblClick = "";
				
					//alert(dblClick);
					
					if (codigoCargo == 3000 || codigoCargo == 3100 || document.getElementById("selCargo").value == 3001
						|| document.getElementById("selCargo").value == 3002 || document.getElementById("selCargo").value == 3003 || document.getElementById("selCargo").value == 3004
						|| document.getElementById("selCargo").value == 3005) cargo = cargo + " ("+unidadAgregado+")";
								
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='45%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
					listadoFuncionarios+= "<td width='21%' align='left'><div id='valorColumna'>"+cargo+"</div></td>";
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


function activaBuscaUnidadAgregado(){
	desactivarBotones();
	
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}


//Nueva funcion para funcionario con servicio asignado
function controlCargoFuncionario(funcionario,fecha1,fecha2){ 
    
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
        	
        	mensaje += "NO PUEDE MODIFICAR PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
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


//Nueva funcion 2 -no finalizada-
function controlValidacionServicio (unidadServicios, fechaServicios,fecha2){
    var mensaje="";
	//alert(unidadServicios + " - " + fechaServicios);
	var objHttpXMLFechaValidacion = new AJAXCrearObjeto();
			
	objHttpXMLFechaValidacion.open("POST","./xml/xmlServicios/xmlControlValidacion.php",false);
	objHttpXMLFechaValidacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFechaValidacion.send(encodeURI("unidadServicios="+unidadServicios+"&fechaServicios="+fechaServicios+"&fecha2="+fecha2));
	//alert(objHttpXMLFechaValidacion.responseText);	   
	var xml = objHttpXMLFechaValidacion.responseXML.documentElement;   
	//return xml.getElementsByTagName('fechaValidacion')[0].text;  
    
       if (objHttpXMLFechaValidacion.responseText != "VACIO"){
        
        mensaje += "NO PUEDE MODIFICAR PORQUE TIENE LOS SIGUIENTES DIAS VALIDADOS:\n\n";
        if (xml.getElementsByTagName('fechaServicio').length > 10) var cantidaDiasMostrar = 10;
        else var cantidadDiasMostrar = xml.getElementsByTagName('fechaServicio').length;
         for(var i=0;i<cantidaDiasMostrar.length;i++){
        	var fecha 		       = xml.getElementsByTagName('fechaServicio')[i].text; 
		} 
      	mensaje += "- FECHA: "+fecha;
		alert(mensaje);
        return 2;
	  }  
     
}
//fin funcion 2

//Nueva funcion agregada: 30-06-2015
//Controla que el usuario escriba solo numeros en un campo de texto
function validaNumeros(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
//FUNCION PARA ACTIVAR CASILLA DE TEXTO
function textoClic(){
 
  document.getElementById("labFechaCargo").innerHTML = "(*) TIPO DE LICENCIA &nbsp;:&nbsp;";	
  document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "visible";
  document.getElementById("textFechaUltimoCargo").disabled= "false";
  document.getElementById("labFechaCargo").disabled= "";
  document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "visible";
  document.getElementById("textFechaUltimoCargo").style.backgroundColor = "";
  document.getElementById("textFechaUltimoCargo").disabled= ""
  
}
//FIN

//Permite sumar fechas
sumaFecha = function(d, fecha)
{
 var Fecha = new Date();
 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
 //var sFecha = fecha || (Fecha.getFullYear() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getDate());
 var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
 var aFecha = sFecha.split(sep);
 var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
 fecha= new Date(fecha);
 fecha.setDate(fecha.getDate()+parseInt(d));
 var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 mes = (mes < 10) ? ("0" + mes) : mes;
 dia = (dia < 10) ? ("0" + dia) : dia;
 var fechaFinal = dia+sep+mes+sep+anno;
 //var fechaFinal = anno+sep+mes+sep+dia;
 return (fechaFinal);
 }
 //Fin