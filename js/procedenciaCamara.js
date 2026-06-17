var cargaProcedenciaCamara;

function leeProcedenciaCamara(nombreObjeto){
	cargaProcedenciaCamara = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLProcedencia = new AJAXCrearObjeto();
	objHttpXMLProcedencia.open("POST","./xml/xmlCamaras/xmlProcedenciaCamaras.php",true);
	objHttpXMLProcedencia.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLProcedencia.send(encodeURI());
	objHttpXMLProcedencia.onreadystatechange=function(){
		if(objHttpXMLProcedencia.readyState == 4){
			//console.log(objHttpXMLProcedencia.responseText);
			if (objHttpXMLProcedencia.responseText != "VACIO"){
				var xml 			= objHttpXMLProcedencia.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('procedencia').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].firstChild.data;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].firstChild.data;
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaProcedenciaCamara = 1;
			}
		}
	}
}