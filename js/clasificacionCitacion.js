var cargaClasificacionCitacion;

function leeClasificacionCitacion(nombreObjeto){
	cargaClasificacionCitacion = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLClasificacionCitacion = new AJAXCrearObjeto();
	objHttpXMLClasificacionCitacion.open("POST","./xml/xmlClasificacionCitacion/xmlClasificacionCitacion.php",true);
	objHttpXMLClasificacionCitacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLClasificacionCitacion.send(encodeURI());
	objHttpXMLClasificacionCitacion.onreadystatechange=function(){
		if(objHttpXMLClasificacionCitacion.readyState == 4){
			//console.log(objHttpXMLClasificacionCitacion.responseText);
			if (objHttpXMLClasificacionCitacion.responseText != "VACIO"){
				//console.log(objHttpXMLClasificacionCitacion.responseText);
				var xml 		= objHttpXMLClasificacionCitacion.responseXML.documentElement;
				var codigo 		= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('clasificacionCitacion').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion 	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaClasificacionCitacion = 1;
			}
		}
	}
}

function leeClasificacionCitacionAgregado(){
	cargaClasificacionCitacion = 1;
}