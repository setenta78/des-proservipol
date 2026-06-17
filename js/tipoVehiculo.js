var cargaTipoVehiculo;

function leeTipoVehiculos(nombreObjeto){
	cargaTipoVehiculo = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	
	var objHttpXMLTipo = new AJAXCrearObjeto();
	objHttpXMLTipo.open("POST","./xml/xmlVehiculos/xmlTipoVehiculo.php",true);
	objHttpXMLTipo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipo.send(encodeURI());
	objHttpXMLTipo.onreadystatechange=function(){
		if(objHttpXMLTipo.readyState == 4){
			if (objHttpXMLTipo.responseText != "VACIO"){
				//alert(objHttpXMLTipo.responseText);
				var xml 			= objHttpXMLTipo.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";

				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				
				for(i=0;i<xml.getElementsByTagName('tipo').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion 	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaTipoVehiculo = 1;
			}
		}
	}
}