var cargaSubproblema;
function leeSubproblemas(marca, nombreObjeto){
	cargaSubproblema = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLModelo = new AJAXCrearObjeto();
	objHttpXMLModelo.open("POST","./xml/xmlRequerimientos/xmlListaSubproblema.php",true);
	objHttpXMLModelo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLModelo.send(encodeURI("marca="+marca));
	objHttpXMLModelo.onreadystatechange=function(){
		if(objHttpXMLModelo.readyState == 4){
			if (objHttpXMLModelo.responseText != "VACIO"){
				//alert(objHttpXMLModelo.responseText);
				var xml 				= objHttpXMLModelo.responseXML.documentElement;
				var codigo 			= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;	
				for(i=0;i<xml.getElementsByTagName('subproblema').length;i++){
					codigo 			= (xml.getElementsByTagName('codigoModelo')[i].text||xml.getElementsByTagName('codigoModelo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcionModelo')[i].text||xml.getElementsByTagName('descripcionModelo')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaSubproblema = 1;
			}
		}
	}
}