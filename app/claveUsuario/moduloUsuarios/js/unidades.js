
function listaUnidades(unidadActual, unidadPadre, nombreObjeto){
	//alert("unidadActual = " + unidadActual);
	//alert("unidadPadre = " + unidadPadre);
	
	var textoUnidadPadre = unidadPadre;
	var largoTextoUnidadPadre = textoUnidadPadre.length;
	var marca = textoUnidadPadre.substr(largoTextoUnidadPadre-1,1);
	if (marca == "X") unidadPadre = textoUnidadPadre.substr(0,largoTextoUnidadPadre-1);
	//alert("unidadPadre = " + unidadPadre);
	
	
	var objHttpXMLUnidades = new AJAXCrearObjeto();
	objHttpXMLUnidades.open("POST","./xml/xmlUnidades.php",true);
	objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUnidades.send(encodeURI("codigoUnidad="+unidadPadre));
	
	objHttpXMLUnidades.onreadystatechange=function(){
		if(objHttpXMLUnidades.readyState == 4){       
			//alert(objHttpXMLUnidades.responseText);
			if (objHttpXMLUnidades.responseText != "VACIO"){
				document.getElementById(nombreObjeto).length = null;
				var xml = objHttpXMLUnidades.responseXML.documentElement;
				//var unidades = new Array();
				var puntero = 0;
				
				if (unidadPadre != 20){
					var codigoAbuelo = xml.getElementsByTagName('codigoAbuelo')[0].text;
					var datosOpcion = new Option("..", codigoAbuelo, "", "");
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
					puntero++;
				}
				
				for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
					//var unidad = new Array(2);
					var codigoUnidad 	  = xml.getElementsByTagName('codigoUnidad')[i].text;
					var descripcionUnidad = xml.getElementsByTagName('descripcionUnidad')[i].text;
					var seleccionable 	  = xml.getElementsByTagName('seleccionable')[i].text;
					
					//if (seleccionable == 0) descripcionUnidad += "(X)";
					if (seleccionable == 0) codigoUnidad += "X";		
															
					//alert(codigoUnidad+" == "+ unidadActual);
					if (codigoUnidad != unidadActual){
						var datosOpcion = new Option(descripcionUnidad, codigoUnidad, "", "");
						document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						puntero++;
					}
				}
				return true;
			} else {
				return false;
			}
		}
	}
}

function buscaUnidadPadre(unidad){
	var objHttpXMLUnidades = new AJAXCrearObjeto();
	objHttpXMLUnidades.open("POST","./xml/xmlUnidades/xmlUnidadPadre.php",true);
	objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUnidades.send(encodeURI("unidad="+unidad));
	
	objHttpXMLUnidades.onreadystatechange=function(){
		if(objHttpXMLUnidades.readyState == 4){       
			//alert(objHttpXMLUnidades.responseText);
			if (objHttpXMLUnidades.responseText != "VACIO"){
				var xml = objHttpXMLUnidades.responseXML.documentElement;
				var unidades = new array();
				for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
					var codigoUnidad = xml.getElementsByTagName('codigoUnidad')[i].text;
					var descripcionUnidad = xml.getElementsByTagName('descripcionUnidad')[i].text;
					
					unidad[0]   = codigoUnidad;
					unidad[1]   = descripcionUnidad;
					
					unidades[i] = unidad;
				}
				return unidades;
			} else {
				return false;
			}
				
		}
	}
}


function listaUnidades2(nombreObjeto){
	var unidadPadre = 2540;
	//document.getElementById(nombreObjeto).length = null;
	//var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	//document.getElementById(nombreObjeto).options[0] = datosOpcion;
	
	var unidades = buscaUnidades(unidadPadre);
	alert(unidades);
}

function seleccionaUnidad(unidadActual, nombreObjeto){
	//alert(nombreObjeto);
	var valor = document.getElementById(nombreObjeto).value; 
	//alert(valor);
	if (valor != "") listaUnidades(unidadActual, valor, nombreObjeto);
	document.getElementById("btnAceptaUnidadAgregado").disabled ="true";
	
}

function seleccionaUnidadAgregado(objeto, objDestinoCodigo, objDestinoText){
	//alert(document.getElementById(objeto).value + " --> " +document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text);
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
  cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	//if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
	//	alert();
	//	document.getElementById("labFechaCargo").disabled= "";
	//	document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "visible";
	//	document.getElementById("textFechaUltimoCargo").style.backgroundColor = "";
	//	document.getElementById("textFechaUltimoCargo").disabled= "";
	//} else {
	//	document.getElementById("labFechaCargo").disabled = "true";
	//	document.getElementById("textFechaUltimoCargo").disabled= "true";
	//	document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "hidden";
	//	document.getElementById("textFechaUltimoCargo").value = "";
	//	document.getElementById("textFechaUltimoCargo").style.backgroundColor = "#E6E6E6";
	//}
	//alert("Error ...");
	activarBotones();
	document.getElementById("cubreVentanaPersonal").style.display = "none";
}


function seleccionaUnidadAgregadoVehiculo(objeto, objDestinoCodigo, objDestinoText){
	//alert(document.getElementById(objeto).value + " --> " +document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text);
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
		//alert();
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
	} else {
		document.getElementById("labFechaEstado").disabled = "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
	}
	
	activarBotones();
	document.getElementById("cubreVentanaPersonal").style.display = "none";
}


function seleccionaUnidadAgregadoArma(objeto, objDestinoCodigo, objDestinoText){
	//alert(document.getElementById(objeto).value + " --> " +document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text);
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
		//alert();
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaArma").style.visibility = "visible";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
	} else {
		document.getElementById("labFechaEstado").disabled = "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaArma").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
	}
	
	activarBotones();
	document.getElementById("cubreVentanaPersonal").style.display = "none";
}



function cerrarVentanaBuscaUnidad(nombreObjeto){
	document.getElementById(nombreObjeto).style.display = "none";
	document.getElementById("cubreVentanaPersonal").style.display = "none";
	activarBotones();
}

function habiltarAceptarUnidadAgregado(objeto){
	//alert(document.getElementById(objeto).value);
	var texto  = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	var codigo = document.getElementById(objeto).value;
	var largoTexto = codigo.length;
	var inicio = largoTexto - 1;
	var marca = codigo.substr(inicio,largoTexto);
	if (marca == "X" || texto == "..") document.getElementById("btnAceptaUnidadAgregado").disabled ="true";
	else document.getElementById("btnAceptaUnidadAgregado").disabled ="";
}



function listaUnidadesSeleccion(unidadPadre, nombreObjeto){
	
	//alert("unidadPadre = " + unidadPadre);
	
	//var textoUnidadPadre = unidadPadre;
	//var largoTextoUnidadPadre = textoUnidadPadre.length;
	//var marca = textoUnidadPadre.substr(largoTextoUnidadPadre-1,1);
	//if (marca == "X") unidadPadre = textoUnidadPadre.substr(0,largoTextoUnidadPadre-1);
	//alert("unidadPadre = " + unidadPadre);
	
	var objHttpXMLUnidades = new AJAXCrearObjeto();
	objHttpXMLUnidades.open("POST","./xml/xmlUnidades/xmlUnidades.php",false);
	objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUnidades.send(encodeURI("codigoUnidad="+unidadPadre));
	
	//objHttpXMLUnidades.onreadystatechange=function(){
	//	if(objHttpXMLUnidades.readyState == 4){       
			//alert(objHttpXMLUnidades.responseText);
			if (objHttpXMLUnidades.responseText != "VACIO"){
				var xml = objHttpXMLUnidades.responseXML.documentElement;
			
				var listadoUnidades = new Array();
				var puntero = 0;
				
				//if (unidadPadre != ""){
				//	var datosUnidad = new Array();
				//	datosUnidad[0] = codigoAbuelo;
				//	datosUnidad[1] = "..";
				//	datosUnidad[2] = "";
				//	
				//	listadoUnidades[puntero] = datosUnidad;
				//	puntero++;
				//}
				          
				//alert(xml.getElementsByTagName('codigoUnidad').length);
				for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
					//var unidad = new Array(2);                                            
					var codigoAbuelo 	  = xml.getElementsByTagName('codigoAbuelo')[0].text;
					var codigoPadre 	  = xml.getElementsByTagName('codigoPadre')[0].text;
					var codigoUnidad 	  = xml.getElementsByTagName('codigoUnidad')[i].text;
					var descripcionUnidad = xml.getElementsByTagName('descripcionUnidad')[i].text;
					var tipoUnidad 	  	  = xml.getElementsByTagName('descripcionTipoUnidad')[i].text;

					var datosUnidad = new Array(); 
					datosUnidad[0] = codigoUnidad;
					datosUnidad[1] = descripcionUnidad;
					datosUnidad[2] = tipoUnidad;
					datosUnidad[3] = codigoPadre; 
					datosUnidad[4] = codigoAbuelo; 
					
					//alert("aqui");
					
					listadoUnidades[puntero] = datosUnidad;
					puntero++;
				}
				return listadoUnidades;
			} else {
				return false;
			}
		//}
	//}
}


function buscaListaUnidades(unidadPadre, nombreObjeto, unidadUsuario){

	if (unidadPadre == "") unidadPadre = 20;
	var listaUnidades = listaUnidadesSeleccion(unidadPadre);  
	//alert(listaUnidadesSeleccion(unidadPadre));
	if (listaUnidades){
		document.getElementById(nombreObjeto).length = null;
		var puntero = 0;
		
		for(i=0;i<listaUnidades.length;i++){
			//var unidad = new Array(2);
			var datosUnidad = new Array();
			var datosUnidad = listaUnidades[i];
			
			
			if (puntero == 0 && unidadUsuario !=  datosUnidad[3]){
				var datosOpcion = new Option("..", datosUnidad[4], "", "");
				document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				puntero++;
			} 
			

			//alert(datosUnidad);
			var codigoUnidad 	  = datosUnidad[0];
			var descripcionUnidad = datosUnidad[1];
			var tipo 	  		  = datosUnidad[2];
			
			var codigoUnidadObjeto = codigoUnidad + "&" + tipo;
			
			if (descripcionUnidad != 'OTRA REPARTICION'){
				var datosOpcion = new Option(descripcionUnidad, codigoUnidadObjeto, "", "");
				document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				puntero++;		
			}
		}
	}
}