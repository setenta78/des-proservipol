var cargaMarcaCamara;

function leeMarcaCamara(nombreObjeto){
	cargaMarcaCamara = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLMarca = new AJAXCrearObjeto();
	objHttpXMLMarca.open("POST","./xml/xmlCamaras/xmlMarcaCamaras.php",true);
	objHttpXMLMarca.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLMarca.send(encodeURI());
	objHttpXMLMarca.onreadystatechange=function(){
		if(objHttpXMLMarca.readyState == 4){
			//console.log(objHttpXMLMarca.responseText);
			if (objHttpXMLMarca.responseText != "VACIO"){
				var xml 			= objHttpXMLMarca.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('marca').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaMarcaCamara = 1;
			}
		}
	}
}