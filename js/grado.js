var cargaGrados;
var cargaEscalafon;

function leeEscalafon(nombreObjeto){
	cargaEscalafon = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLEscalafon = new AJAXCrearObjeto();
	objHttpXMLEscalafon.open("POST","./xml/xmlFuncionarios/xmlEscalafones.php",true);
	objHttpXMLEscalafon.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEscalafon.send(encodeURI());
	objHttpXMLEscalafon.onreadystatechange=function(){
		if(objHttpXMLEscalafon.readyState == 4){       
			if (objHttpXMLEscalafon.responseText != "VACIO"){
				//alert(objHttpXMLEscalafon.responseText);
				var xml 			= objHttpXMLEscalafon.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('escalafon').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent);
					descripcion 	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent);
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaEscalafon = 1;
			}
		}
	}
}

function leeGrados(nombreObjeto, escalafonCodigo, escalafonDescripcion){
	cargaGrados = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("Cargando Datos ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;	
	var objHttpXMLGrados = new AJAXCrearObjeto();
	objHttpXMLGrados.open("POST","./xml/xmlFuncionarios/xmlGrados.php",true);
	objHttpXMLGrados.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLGrados.send(encodeURI("escalafonCodigo="+escalafonCodigo+"&escalafonDescripcion="+escalafonDescripcion));
	objHttpXMLGrados.onreadystatechange=function(){
		if(objHttpXMLGrados.readyState == 4){
			//alert(objHttpXMLGrados.responseText);
			if (objHttpXMLGrados.responseText != "VACIO"){
				//alert(objHttpXMLGrados.responseText);		
				var xml			= objHttpXMLGrados.responseXML.documentElement;
				var codigo		= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('grado').length;i++){
					codigo 		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent);
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent);
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaGrados = 1;
			}
		}
	}
}