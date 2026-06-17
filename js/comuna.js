var cargaComunas;
function leeComunasListaSimple(nombreObjeto, unidad){
	cargaComunas = 0;
	var objHttpXMLComunas = new AJAXCrearObjeto();
	objHttpXMLComunas.open("POST","./xml/xmlLicenciaConducir/xmlComunas.php",true);
	objHttpXMLComunas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLComunas.send(encodeURI());
	objHttpXMLComunas.onreadystatechange=function(){
		if(objHttpXMLComunas.readyState == 4){
			if (objHttpXMLComunas.responseText != "VACIO"){
				//alert(objHttpXMLComunas.responseText);
				var xml 				= objHttpXMLComunas.responseXML.documentElement;
				var codigo 			= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('codigoComuna').length;i++){
					codigo 			= (xml.getElementsByTagName('codigoComuna')[i].text||xml.getElementsByTagName('codigoComuna')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcionComuna')[i].text||xml.getElementsByTagName('descripcionComuna')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaComunas = 1;
			}
		}
	}
}