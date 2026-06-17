var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

function buscaDatosFichaLicencia(){
	
	var codFuncionario		= eliminarBlancos(document.getElementById("codFuncionario").value.toUpperCase());
	var CodColor					= eliminarBlancos(document.getElementById("txtcolor").value.toUpperCase());
	var codFolio					= eliminarBlancos(document.getElementById("txtfolio").value.toUpperCase());
	
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
					
					document.getElementById("fotoFuncionario").src								= "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";						
					document.getElementById("idFuncionario").value								= codigo;					
					document.getElementById("txtrut").value												= rut;
					document.getElementById("txtape1").value 											= apellidoPaterno;
					document.getElementById("txtape2").value 											= apellifoMaterno;
					document.getElementById("txtnom").value 	 										= primerNombre+" "+segundoNombre;
					document.getElementById("txtfec1").value 		 									= fechaO;
					document.getElementById("txtfec2").value 	 										= fechaI;
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
					
					if(document.getElementById('cboLicencia').value==4){
						document.getElementById("seccion3a").style.display="block";
					}
				
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

/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

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
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var nombre	 			= "";
				var tipoLicencia	 		= "";
				var tipoArchivo		= "NO EXISTEN ARCHIVOS ASOCIADOS ...";
				var mostrarEtiqueta = "";
				
						
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
					tipoLicencia	 	 = xml.getElementsByTagName('tipoLicencia')[i].text;

										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					//var dblClick = "javascript:abrirVentana('FUNCIONARIO', '800', '333','fichaPersonal.php?codigoFuncionario="+codigo+"','"+nroLinea+"','','5','5')";
				
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
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='38%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><div id='valorColumna'>"+tipoLicencia+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+tipoArchivo+"</div></td>";
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
            //         dias 	            	= xml.getElementsByTagName('dia')[i].text; //Agregado 30-06-2015
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
					//document.getElementById("txtrut").value		= rut;
					document.getElementById("txtape1").value 		= apellidoPaterno;
					document.getElementById("txtape2").value 		= apellifoMaterno;
					document.getElementById("txtnom").value 	 		= primerNombre+" "+segundoNombre;
					//document.getElementById("textSegundoNombre").value 	 		= segundoNombre;
					//document.getElementById("codigoUnidadAgregado").value 	 	= codigoUnidadAgregado;
					//document.getElementById("textUnidadAgregado").value 	 	= desUnidadAgregado;
					//document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					//document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					//document.getElementById("codCuadranteBaseDatos").value 		= cuadranteCargo;
    	    //document.getElementById("textCantDias").value 	        	= dias; //Agregado 30-06-2015
					//document.getElementById("textCantDias2").value 	        	= dias; //Agregado 30-06-2015
					
					
					//alert(desCargo);
					
					//if (tipo == 0) {
					//	document.getElementById("ultimaFecha").value = cargoFechaDesde;
					//	if (cargoFechaDesde != "--") var muestraFechaCargo = cargoFechaDesde;
					//	else var muestraFechaCargo = "NO REGISTRA CARGOS EN EL SISTEMA";
					//	document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA CARGO ACTUAL : " + muestraFechaCargo;
					//} else {
					//	document.getElementById("ultimaFecha").value = cargoFechaDesde;
					//	if (cargoFechaDesde != "--") var muestraFechaCargo = cargoFechaDesde + " ("+desCargo+")";
					//	else var muestraFechaCargo = "NO REGISTRA CARGOS EN EL SISTEMA";
					//	document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + muestraFechaCargo;
					//}
					
					
					
					//alert();

					if (unidadFuncionario != "") var habilitarBotones = false;
					else var habilitarBotones = true;										
					
					//var valoresAsignar = "'"+escalafon+"','" + grado + "','" + cargo + "'," + habilitarBotones +",'"+cuadranteCargo+"','"+dias+"',"+tipo;   

					//idAsignaFichaPersonal = setInterval("asignaValoresFichaFuncionario("+valoresAsignar+")",1000);
															
					if (tipo == "1"){
						document.getElementById("btnBuscarFuncionario").value = "BUSCAR";
						document.getElementById("btnBuscarFuncionario").disabled = "";
						document.getElementById("mensajeCargando").style.display = "none"; 
						
						//if (unidadUsuario == unidadFuncionario){
						//	alert("ESTE FUNCIONARIO YA PERTENECE A ESTA UNIDAD ...          ");
						//	cerrarVentanaPersonal();
						//}
						
						//if (unidadUsuario != unidadFuncionario && unidadFuncionario != ""){
						//	alert("NO PUEDE AGREGAR A ESTE FUNCIONARIO,\nYA QUE PERTENECE A LA " +descUnidadFuncionario+ ", Y AUN NO HA SIDO DESPACHADO ... ");
						//	cerrarVentanaPersonal();
						//} 
					}
				}
			} else {
					if (document.getElementById("btnBuscarFuncionario").value == "BUSCANDO ..."){
						document.getElementById("mensajeCargando").style.display = "none";    
						alert ("NO EXISTE ...");
						document.getElementById("textCodigoFuncionario").focus();
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
  var fechaReal = document.getElementById("IpFuncionario").value;
  
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
	
	var parametros = "";
	
	//parametros += "codigoFuncionario="+codigoFuncionario+"&codigoEscalafon="+codigoEscalafon+"&codigoGrado="+codigoGrado;
	//parametros += "&apellidoPaterno="+apellidoPaterno+"&apellidoMaterno="+apellidoMaterno+"&primerNombre="+primerNombre;
	//parametros += "&segundoNombre="+segundoNombre+"&codigoCargo="+codigoCargo+"&unidadUsuario="+unidadUsuario+"&fechaCargo="+fechaCargo;
	//parametros += "&codigoCuadrante="+codigoCuadrante+"&dias="+dias;
	
	//parametros += "codigoFuncionario="+codigoFuncionario+"&apellidoPaterno="+apellidoPaterno+"&apellidoMaterno="+apellidoMaterno+"&primerNombre="+primerNombre;
	//parametros += "&unidadUsuario="+unidadUsuario;
	
	parametros += "rut="+rutsinchar+"&color="+color+"&folio="+folio+"&fecha1="+fecha1+"&fecha2="+fecha2+"&dias="+dias;
	parametros += "&rutHijo="+rutHijo+"&fecha3="+fecha3+"&tipoLicencia="+tipoLicencia+"&recuperacion="+recuperacion;
	parametros += "&invalidez="+invalidez+"&tipoReposo="+tipoReposo+"&lugarReposo="+lugarReposo+"&rutProfesional="+rutProfesional;
	parametros += "&especialidad="+especialidad+"&tipoProfesional="+tipoProfesional+"&atencion="+atencion+"&ip="+ip+"&unidadFuncionario="+unidadFuncionario+"&archivo="+archivo+"&fechaReal="+fechaReal;
	
	
	alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlNuevaLicencia.php",true);
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

function guardarFichaFuncionario(){
	//desactivarBotones();
	//var validaOk = validarFichaFuncionario();
	//alert(document.getElementById("idFuncionario").value);
	
	
	/* Dar formato a las fechas y sumar los días */
	
	var codigoFuncionario = document.getElementById("idFuncionario").value;	
	var fechaInicio = document.getElementById("txtfec2").value;
	var dias = document.getElementById("txtdias").value;
	var arrayAux = fechaInicio.split("-");
	var fechaTF = arrayAux[2] +"/"+ arrayAux[1] +"/"+ arrayAux[0];
	var fechaTFDate = new Date(fechaTF);
	
	dias = parseInt(dias);
	fechaTFDate.setDate(fechaTFDate.getDate() + dias);
	
	var dia = fechaTFDate.getDate();
	var mes = (fechaTFDate.getMonth()+1);
	var ano = fechaTFDate.getYear();
	if(dia.toString().length==1)dia="0"+dia.toString();
	if(mes.toString().length==1)mes="0"+mes.toString();
	var fechaTermino = dia+"-"+ mes +"-"+ano;
	
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
      if(controlValidacionServicio(codigoFuncionario,fechaInicio,fechaTermino)) return false;
      
			var msj=confirm("ATENCIÓN :\nSE INGRESARÁN LOS DATOS DE ESTE FUNCIONARIO EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) {
				nuevoFuncionario();
			} else {
				activarBotones();
				return false;
			}
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
	if(valor==4){
		document.getElementById("seccion3a").style.display="block";
		}
	else{
		document.getElementById("seccion3a").style.display="none";
		}
}

/*Función que habilita el ingreso de la especialidad del medico, si es que se elije dicha opción*/
function especialidad(objeto){
	var valor = objeto.value;
	if(valor==1){
		document.getElementById("seccion5a").style.display="block";
		document.getElementById("seccion5aa").style.display="block";
		}
	else{
		document.getElementById("seccion5a").style.display="none";
		document.getElementById("seccion5aa").style.display="none";
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
			alert('El Rut Ingreso es Invalido');
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
	var extension 							= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toLowerCase(); 	
	var extensiones_permitidas 	= new Array(".jpg", ".jpeg", ".pdf");
	var noaceptada  						= true;
	var rutsinchar							= document.getElementById("txtrut").value;
	var folioColor 							= document.getElementById("txtcolor").value+" "+document.getElementById("txtfolio").value;
	
	for (var i = 0; i < extensiones_permitidas.length; i++) {
    if (extensiones_permitidas[i] == extension) {
     	noaceptada = false;
    }
  } 
  
  if(noaceptada){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO JPG, JPEG O PDF");
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
	
	
	
	if (rut == "") {
		alert("DEBE INDICAR RUT ...... 	     ");
		document.getElementById("txtrut").focus();
		return false;
	}

	if (color.length!=1) {
		alert("DEBE INDICAR EL COLOR DE LA LICENCIA CON UNA LETRA ...... 	     ");
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
	
	if (fechaRep == 0) {
		alert("DEBE INDICAR LA FECHA DE REPOSO  ...... 	     ");
		document.getElementById("txtfec2").focus();
		return false;
	}
	
	if (dias == 0) {
		alert("DEBE INGRESAR LA CANTIDAD DE DIAS DE LA LICENCIA  ...... 	     ");
		document.getElementById("txtdias").focus();
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

function controlLicenciaFuncionario(color,folio,rut){ 
    
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlLicenciaMedica/xmlListaLicenciaPorFuncionario.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("color="+color+"&folio="+folio+"&rut="+rut));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('licencia')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
         	
        	mensaje += "NO PUEDE INGRESAR LA LICENCIA PORQUE YA EXISTE:\n\n";
        if (xml.getElementsByTagName('licencia').length >= 1) var cantidadServiciosMostar = 1;
        else var cantidadServiciosMostar = xml.getElementsByTagName('licencia').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	var color 		         = xml.getElementsByTagName('color')[i].text;
		        var folio 	         = xml.getElementsByTagName('folio')[i].text;
		        var rut 	         	= xml.getElementsByTagName('rut')[i].text;
		               
		        	mensaje += (i+1) +". " + color+" - LICENCIA "+folio.toUpperCase()+"\n   ("+rut.toUpperCase()+").\n";
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

function verificaExisteServicio(){
	
	var unidad 	 = document.getElementById("unidadServicio").value;
	var fecha1 	 = document.getElementById("textFechaServicio").value;
	var fecha2	 = fecha1;
	//var servicio = document.getElementById("selServicio").value;
	
	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
    	
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