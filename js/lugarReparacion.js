var cargaLugaresDeReparacion;
function leeLugaresDeReparacion(nombreObjeto){
	cargaLugaresDeReparacion = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLLugarReparacion = new AJAXCrearObjeto();
	objHttpXMLLugarReparacion.open("POST","./xml/xmlVehiculos/xmlLugarReparacion.php",true);
	objHttpXMLLugarReparacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLLugarReparacion.send(encodeURI());
	objHttpXMLLugarReparacion.onreadystatechange=function(){
		if(objHttpXMLLugarReparacion.readyState == 4){
			if (objHttpXMLLugarReparacion.responseText != "VACIO"){
				//alert(objHttpXMLLugarReparacion.responseText);
				var xml 				= objHttpXMLLugarReparacion.responseXML.documentElement;
				var codigo 			= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('lugarReparacion').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
			 		var puntero = i+1;
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				}
				cargaLugaresDeReparacion = 1;
			}
		}
	}
}