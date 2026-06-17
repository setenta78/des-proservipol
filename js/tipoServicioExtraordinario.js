var cargaTipoServicioExtraordinario;
function leeTipoServiciosExtraordinarios(nombreObjeto, especialidad, tipo){
	cargaTipoServicioExtraordinario = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var codUnidad = document.getElementById("unidadUsuario").value;
	var objHttpXMLTipoServicio = new AJAXCrearObjeto();
	objHttpXMLTipoServicio.open("POST","./xml/xmlServicios/xmlTipoServicioExtraordinario.php",true);
	objHttpXMLTipoServicio.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipoServicio.send(encodeURI("especialidad="+especialidad+"&codUnidad="+codUnidad));
	objHttpXMLTipoServicio.onreadystatechange=function(){
		if(objHttpXMLTipoServicio.readyState == 4){
			if (objHttpXMLTipoServicio.responseText != "VACIO"){
				var xml 		= objHttpXMLTipoServicio.responseXML.documentElement;
				var codigo 		= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('tipoServicioExtraordinario').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					codigo			= tipo + codigo;
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaTipoServicioExtraordinario = 1;
			}
		}
	}
}

function leeTipoServiciosExtraordinariosN(nombreObjeto, tipo){
	cargaTipoServicioExtraordinario = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var codUnidad = document.getElementById("unidadUsuario").value;
	var objHttpXMLTipoServicio = new AJAXCrearObjeto();
	objHttpXMLTipoServicio.open("POST","./xml/xmlServicios/xmlTipoServicioExtraordinarioN.php",true);
	objHttpXMLTipoServicio.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipoServicio.send(encodeURI("&codUnidad="+codUnidad));
	objHttpXMLTipoServicio.onreadystatechange=function(){
		if(objHttpXMLTipoServicio.readyState == 4){
			if (objHttpXMLTipoServicio.responseText != "VACIO"){
				var xml 		= objHttpXMLTipoServicio.responseXML.documentElement;
				var codigo 		= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('tipoServicioExtraordinario').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					codigo			= tipo + codigo;
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaTipoServicioExtraordinario = 1;
			}
		}
	}
}