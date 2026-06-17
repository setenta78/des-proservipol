var cargaFactorDemanda;
function leeFactoresDemanda(nombreObjeto, multiseleccion){
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLFactorDemanda = new AJAXCrearObjeto();
	objHttpXMLFactorDemanda.open("POST","./xml/xmlFactorDemanda/xmlListaFactorDemanda.php",true);
	objHttpXMLFactorDemanda.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFactorDemanda.send(encodeURI());
	objHttpXMLFactorDemanda.onreadystatechange=function(){
		if(objHttpXMLFactorDemanda.readyState == 4){
			if (objHttpXMLFactorDemanda.responseText != "VACIO"){
				//alert(objHttpXMLFactorDemanda.responseText);
				var xml 				= objHttpXMLFactorDemanda.responseXML.documentElement;
				var codigo 			= "";
				var descripcion	= "";
				var abreviatura	= "";
				document.getElementById(nombreObjeto).length = null;
				if (!multiseleccion){
					var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
					document.getElementById(nombreObjeto).options[0] = datosOpcion;
				}
				for(i=0;i<xml.getElementsByTagName('factor').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					abreviatura = (xml.getElementsByTagName('abreviatura')[i].text||xml.getElementsByTagName('abreviatura')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					if (!multiseleccion) var puntero = i+1;
					else var puntero = i;
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				}
			}
		}
	}
}