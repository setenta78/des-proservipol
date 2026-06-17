var cargaFallaVehiculo;

function leeFallaVehiculo(nombreObjeto){
	cargaFallaVehiculo = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;		
	
	//alert(grupo);
	
	var objHttpXMLFallaVehiculo = new AJAXCrearObjeto();
			
	objHttpXMLFallaVehiculo.open("POST","./xml/xmlVehiculos/xmlFallaVehiculo.php",true);
	objHttpXMLFallaVehiculo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFallaVehiculo.send(encodeURI());
	objHttpXMLFallaVehiculo.onreadystatechange=function(){
		if(objHttpXMLFallaVehiculo.readyState == 4)	{       
			if (objHttpXMLFallaVehiculo.responseText != "VACIO"){
	
				//alert(objHttpXMLFallaVehiculo.responseText);		
				var xml 			= objHttpXMLFallaVehiculo.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				
				document.getElementById(nombreObjeto).length = null;
				
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;	
				
				var datosOpcion = new Option("NO INDICA FALLA", 1, "", "");
				document.getElementById(nombreObjeto).options[1] = datosOpcion;		
				
				for(i=0;i<xml.getElementsByTagName('falla').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].text;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].text;
										
					var datosOpcion = new Option(descripcion, codigo, "", "");
					//alert(i);
			 		var puntero = i+2;
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
					//alert(puntero);
				}
				
				cargaFallaVehiculo = 1;
			}
		}
	}
} 