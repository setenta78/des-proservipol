function listaUnidadesGope(unidadActual, unidadPadre, nombreObjeto){
	if(unidadPadre!=""){
		var cuadrantesMV = document.getElementById("cuadrantesMV").value;
		var tipoUnidad = document.getElementById("tipoUnidad").value;
		var unidadUsuario = document.getElementById("unidadUsuario").value;
		var correlativo = document.getElementById("correlativo").value;
		var textoUnidadPadre = unidadPadre;
		var largoTextoUnidadPadre = textoUnidadPadre.length;
		var marca = textoUnidadPadre.substr(largoTextoUnidadPadre-1,1);
		if (marca == "X" || marca == "A") unidadPadre = textoUnidadPadre.substr(0,largoTextoUnidadPadre-1);
		var textoUnidadCuadrante = unidadPadre;
		var largoTextoUnidadCuadrante = textoUnidadCuadrante.length;
		var marcaCuadrante = textoUnidadCuadrante.substr(largoTextoUnidadCuadrante-1,1);
		if (marcaCuadrante != "C") {
			var objHttpXMLUnidades = new AJAXCrearObjeto();
			objHttpXMLUnidades.open("POST","./xml/xmlUnidades/xmlUnidades.php",true);
			objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpXMLUnidades.send(encodeURI("codigoUnidad="+unidadPadre));
			objHttpXMLUnidades.onreadystatechange=function(){
				if(objHttpXMLUnidades.readyState == 4){       
					//console.log(objHttpXMLUnidades.responseText);
					if (objHttpXMLUnidades.responseText != "VACIO"){
						document.getElementById(nombreObjeto).length = null;
						var xml = objHttpXMLUnidades.responseXML.documentElement;
						var puntero = 0;
						if (cuadrantesMV != "" && unidadPadre != unidadActual){
							var codigoAbuelo = (xml.getElementsByTagName('codigoAbuelo')[0].text||xml.getElementsByTagName('codigoAbuelo')[0].textContent||"");
							var datosOpcion = new Option("..", codigoAbuelo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
							puntero++;
						}
						
						for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
							var codigoUnidad 	  = (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
							var descripcionUnidad = (xml.getElementsByTagName('descripcionUnidad')[i].text||xml.getElementsByTagName('descripcionUnidad')[i].textContent||"");
							var planCuadrante	  = (xml.getElementsByTagName('planCuadrante')[i].text||xml.getElementsByTagName('planCuadrante')[i].textContent||"");
							var seleccionable 	  = (xml.getElementsByTagName('seleccionable')[i].text||xml.getElementsByTagName('seleccionable')[i].textContent||"");
							
							if (seleccionable == 0 || planCuadrante == 1) codigoUnidad += "X";
							
							if (codigoUnidad != unidadActual){
								var datosOpcion = new Option(descripcionUnidad, codigoUnidad, "", "");
								document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
								puntero++;
							}
						}
						return true;
					} else {
						leeCuadrantesGope(unidadPadre,false,'cuadrantesMV', true);	
					}
				}
			}		
		}
	}else{
		return false;
	}
}

function listaUnidadesEspecializadas(unidadActual, unidadPadre, nombreObjeto){
	if(unidadPadre!=""){
		var cuadrantesMV = document.getElementById("cuadrantesMV").value;
		var tipoUnidad = document.getElementById("tipoUnidad").value;
		var unidadUsuario = document.getElementById("unidadUsuario").value;
		var correlativo = document.getElementById("correlativo").value;
		var textoUnidadPadre = unidadPadre;
		var largoTextoUnidadPadre = textoUnidadPadre.length;
		var marca = textoUnidadPadre.substr(largoTextoUnidadPadre-1,1);
		if (marca == "X" || marca == "A") unidadPadre = textoUnidadPadre.substr(0,largoTextoUnidadPadre-1);
		var textoUnidadCuadrante = unidadPadre;
		var largoTextoUnidadCuadrante = textoUnidadCuadrante.length;
		var marcaCuadrante = textoUnidadCuadrante.substr(largoTextoUnidadCuadrante-1,1);			
		if (marcaCuadrante != "C") {
			var objHttpXMLUnidades = new AJAXCrearObjeto();
			objHttpXMLUnidades.open("POST","./xml/xmlUnidades/xmlUnidadesEspecializadas.php",true);
			objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpXMLUnidades.send(encodeURI("codigoUnidad="+unidadPadre+"&tipoUnidad="+tipoUnidad+"&unidadUsuario="+unidadUsuario+"&correlativo="+correlativo));
			objHttpXMLUnidades.onreadystatechange=function(){
				if(objHttpXMLUnidades.readyState == 4){       
					//alert(objHttpXMLUnidades.responseText);
					if (objHttpXMLUnidades.responseText != "VACIO"){
						document.getElementById(nombreObjeto).length = null;
						var xml = objHttpXMLUnidades.responseXML.documentElement;
						var puntero = 0;
						if (cuadrantesMV != "" && unidadPadre != unidadActual){
							var codigoAbuelo = (xml.getElementsByTagName('codigoAbuelo')[0].text||xml.getElementsByTagName('codigoAbuelo')[0].textContent||"");
							var datosOpcion = new Option("..", codigoAbuelo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
							puntero++;
						}
						
						for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
						
							var codigoUnidad 	  = (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
							var descripcionUnidad = (xml.getElementsByTagName('descripcionUnidad')[i].text||xml.getElementsByTagName('descripcionUnidad')[i].textContent||"");
							var planCuadrante	  = (xml.getElementsByTagName('planCuadrante')[i].text||xml.getElementsByTagName('planCuadrante')[i].textContent||"");
							var seleccionable 	  = (xml.getElementsByTagName('seleccionable')[i].text||xml.getElementsByTagName('seleccionable')[i].textContent||"");
							
							if (seleccionable == 0 || planCuadrante == 1) codigoUnidad += "X";	       	
							
							if (codigoUnidad != unidadActual){
								var datosOpcion = new Option(descripcionUnidad, codigoUnidad, "", "");
								document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
								puntero++;
							}
						}
						return true;
					} else {
						leeCuadrantesConHijos(unidadPadre,false,'cuadrantesMV', true);
					}
				}
			}
		}
	}else{
		return false;
	}
}

function listaUnidades(unidadActual, unidadPadre, nombreObjeto){
	var textoUnidadPadre = unidadPadre;
	var largoTextoUnidadPadre = textoUnidadPadre.length;
	var marca = textoUnidadPadre.substr(largoTextoUnidadPadre-1,1);
	if (marca == "X") unidadPadre = textoUnidadPadre.substr(0,largoTextoUnidadPadre-1);
	
	var objHttpXMLUnidades = new AJAXCrearObjeto();
	objHttpXMLUnidades.open("POST","./xml/xmlUnidades/xmlUnidades.php",true);
	objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUnidades.send(encodeURI("codigoUnidad="+unidadPadre));
	
	objHttpXMLUnidades.onreadystatechange=function(){
		if(objHttpXMLUnidades.readyState == 4){       
			//alert(objHttpXMLUnidades.responseText);
			if (objHttpXMLUnidades.responseText != "VACIO"){
				document.getElementById(nombreObjeto).length = null;
				var xml = objHttpXMLUnidades.responseXML.documentElement;
				var puntero = 0;
				
				if (unidadPadre != ""){
					var codigoAbuelo = (xml.getElementsByTagName('codigoAbuelo')[0].text||xml.getElementsByTagName('codigoAbuelo')[0].textContent||"");
					var datosOpcion = new Option("..", codigoAbuelo, "", "");
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
					puntero++;
				}
				
				for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
					var codigoUnidad 	  = (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					var descripcionUnidad = (xml.getElementsByTagName('descripcionUnidad')[i].text||xml.getElementsByTagName('descripcionUnidad')[i].textContent||"");
					var seleccionable 	  = (xml.getElementsByTagName('seleccionable')[i].text||xml.getElementsByTagName('seleccionable')[i].textContent||"");
					
					if (seleccionable == 0) codigoUnidad += "X";
						var datosOpcion = new Option(descripcionUnidad, codigoUnidad, "", "");
						document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						puntero++;
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
					var codigoUnidad = (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					var descripcionUnidad = (xml.getElementsByTagName('descripcionUnidad')[i].text||xml.getElementsByTagName('descripcionUnidad')[i].textContent||"");
					
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
	var unidades = buscaUnidades(unidadPadre);
}

function seleccionaUnidad(unidadActual, nombreObjeto){
	var valor = document.getElementById(nombreObjeto).value;
	if (valor != "") listaUnidades(unidadActual, valor, nombreObjeto);
	document.getElementById("btnAceptaUnidadAgregado").disabled = "true";
}

function seleccionaUnidadAgregado(objeto, objDestinoCodigo, objDestinoText){
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
		document.getElementById("labFechaCargo").disabled= "";
		document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "visible";
		document.getElementById("textFechaUltimoCargo").style.backgroundColor = "";
		document.getElementById("textFechaUltimoCargo").disabled= "";
	} else {
		document.getElementById("labFechaCargo").disabled = "true";
		document.getElementById("textFechaUltimoCargo").disabled= "true";
		document.getElementById("imagenCalendarioFichaFuncionario").style.visibility = "hidden";
		document.getElementById("textFechaUltimoCargo").value = "";
		document.getElementById("textFechaUltimoCargo").style.backgroundColor = "#E6E6E6";
	}
	
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
}

function seleccionaUnidadAgregadoVehiculo(objeto, objDestinoCodigo, objDestinoText){
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
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
	document.getElementById("cubreVentana").style.display = "none";
}

function seleccionaUnidadAgregadoArma(objeto, objDestinoCodigo, objDestinoText){
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
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
	document.getElementById("cubreVentana").style.display = "none";
}

function cerrarVentanaBuscaUnidad(nombreObjeto){
	document.getElementById(nombreObjeto).style.display = "none";
	document.getElementById("cubreVentana").style.display = "none";
	if(document.getElementById("selCuadrante")) document.getElementById("selCuadrante").disabled = "true";
	activarBotones();
}

function seleccionaUnidadAgregadoAnimal(objeto, objDestinoCodigo, objDestinoText){
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaAnimal").style.visibility = "visible";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
	} else {
		document.getElementById("labFechaEstado").disabled = "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaAnimal").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
	}
	
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
}

function seleccionaUnidadAgregadoSimccar(objeto, objDestinoCodigo, objDestinoText){
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	if (document.getElementById(objeto).value != document.getElementById('codUnidadAgregadoBaseDatos').value){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "visible";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
	} else {
		document.getElementById("labFechaEstado").disabled = "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
	}
	
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
}

function habiltarAceptarUnidadAgregado(objeto){
	if(document.getElementById(objeto).value!=""){
		var unidadUsuario=document.getElementById("unidadUsuario").value;

		var texto  = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
		var codigo = document.getElementById(objeto).value;
		var largoTexto = codigo.length;
		var inicio = largoTexto - 1;
		var marca = codigo.substr(inicio,largoTexto);
		if (marca == "X" || texto == ".." || (codigo==unidadUsuario)) document.getElementById("btnAceptaUnidadAgregado").disabled ="true";
		else document.getElementById("btnAceptaUnidadAgregado").disabled ="";
	}
}

function listaUnidadesSeleccion(unidadPadre, nombreObjeto){
	var objHttpXMLUnidades = new AJAXCrearObjeto();
	objHttpXMLUnidades.open("POST","./xml/xmlUnidades/xmlUnidades.php",false);
	objHttpXMLUnidades.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUnidades.send(encodeURI("codigoUnidad="+unidadPadre));
			if (objHttpXMLUnidades.responseText != "VACIO"){
				var xml = objHttpXMLUnidades.responseXML.documentElement;
				var listadoUnidades = new Array();
				var puntero = 0;
				for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
					var codigoAbuelo 	  = (xml.getElementsByTagName('codigoAbuelo')[0].text||xml.getElementsByTagName('codigoAbuelo')[0].textContent||"");
					var codigoPadre 	  = (xml.getElementsByTagName('codigoPadre')[0].text||xml.getElementsByTagName('codigoPadre')[0].textContent||"");
					var codigoUnidad 	  = (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					xml.getElementsByTagName('codigoUnidad')[i].text;
					var descripcionUnidad = (xml.getElementsByTagName('descripcionUnidad')[i].text||xml.getElementsByTagName('descripcionUnidad')[i].textContent||"");
					var tipoUnidad 	  	  = (xml.getElementsByTagName('descripcionTipoUnidad')[i].text||xml.getElementsByTagName('descripcionTipoUnidad')[i].textContent||"");
					
					var datosUnidad = new Array();
					datosUnidad[0] = codigoUnidad;
					datosUnidad[1] = descripcionUnidad;
					datosUnidad[2] = tipoUnidad;
					datosUnidad[3] = codigoPadre;
					datosUnidad[4] = codigoAbuelo;
					
					listadoUnidades[puntero] = datosUnidad;
					puntero++;
				}
				return listadoUnidades;
			} else {
				return false;
			}
}

function buscaListaUnidades(unidadPadre, nombreObjeto, unidadUsuario){

	if (unidadPadre == "") unidadPadre = 20;
	var listaUnidades = listaUnidadesSeleccion(unidadPadre);
	if (listaUnidades){
		document.getElementById(nombreObjeto).length = null;
		var puntero = 0;
		
		for(i=0;i<listaUnidades.length;i++){
			var datosUnidad = new Array();
			var datosUnidad = listaUnidades[i];
			
			if (puntero == 0 && unidadUsuario !=  datosUnidad[3]){
				var datosOpcion = new Option("..", datosUnidad[4], "", "");
				document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				puntero++;
			} 
			
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

function seleccionaUnidadAgregadoCamara(objeto, objDestinoCodigo, objDestinoText){
	document.getElementById(objDestinoCodigo).value = document.getElementById(objeto).value;
	document.getElementById(objDestinoText).value   = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
	cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad');
	
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
}