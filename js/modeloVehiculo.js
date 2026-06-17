var cargaModelosVehiculos;

function leeModeloVehiculos(marca, nombreObjeto){
	cargaModelosVehiculos = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	
	var objHttpXMLModelo = new AJAXCrearObjeto();
	objHttpXMLModelo.open("POST","./xml/xmlVehiculos/xmlModeloVehiculo.php",true);
	objHttpXMLModelo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLModelo.send(encodeURI("marca="+marca));
	objHttpXMLModelo.onreadystatechange=function(){
		if(objHttpXMLModelo.readyState == 4){
			if (objHttpXMLModelo.responseText != "VACIO"){
				//alert(objHttpXMLModelo.responseText);
				var xml 			= objHttpXMLModelo.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				document.getElementById(nombreObjeto).length = null;
				
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;	
				
				var datosOpcion = new Option("NO INDICA MODELO", 1, "", "");
				document.getElementById(nombreObjeto).options[1] = datosOpcion;
				
				for(i=0;i<xml.getElementsByTagName('modelo').length;i++){
					codigo 			= (xml.getElementsByTagName('codigoModelo')[i].text||xml.getElementsByTagName('codigoModelo')[i].textContent||"");
					descripcion 	= (xml.getElementsByTagName('descripcionModelo')[i].text||xml.getElementsByTagName('descripcionModelo')[i].textContent||"");
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+2] = datosOpcion;
				}
				cargaModelosVehiculos = 1;
			}
		}
	}
}