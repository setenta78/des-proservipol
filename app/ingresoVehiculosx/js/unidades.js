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
				
				if (unidadPadre != ""){
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
					//if (codigoUnidad != unidadActual){
						var datosOpcion = new Option(descripcionUnidad, codigoUnidad, "", "");
						document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						puntero++;
					//}
				}
				return true;
			} else {
				return false;
			}
		}
	}
}

function habiltarAceptarUnidad(objeto){
	//alert(document.getElementById(objeto).value);
	if(document.getElementById(objeto).value!=""){
		var texto  = document.getElementById(objeto)[document.getElementById(objeto).selectedIndex].text;
		var codigo = document.getElementById(objeto).value;
		var largoTexto = codigo.length;
		var inicio = largoTexto - 1;
		var marca = codigo.substr(inicio,largoTexto);
	}
}

function seleccionaUnidad(unidadActual, nombreObjeto){
	//alert(nombreObjeto);
	var valor = document.getElementById(nombreObjeto).value; 
	//alert(valor);
	if (valor != "") listaUnidades(unidadActual, valor, nombreObjeto);
}
