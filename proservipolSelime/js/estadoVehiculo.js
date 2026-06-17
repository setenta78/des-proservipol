var cargaEstadosVehiculo;

function leeEstadosVehiculos(nombreObjeto){
	cargaEstadosVehiculo = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;		
	
	var objHttpXMLEstado = new AJAXCrearObjeto();
			
	objHttpXMLEstado.open("POST","./xml/xmlVehiculos/xmlEstadoVehiculo.php",true);
	objHttpXMLEstado.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstado.send(encodeURI());
	objHttpXMLEstado.onreadystatechange=function()
	{
		if(objHttpXMLEstado.readyState == 4)
		{       
			if (objHttpXMLEstado.responseText != "VACIO"){
	
				//alert(objHttpXMLEstado.responseText);		
				var xml 			= objHttpXMLEstado.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";

				document.getElementById(nombreObjeto).length = null;
				
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 1000, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;								
				
				for(i=0;i<xml.getElementsByTagName('estado').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].text;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].text;
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaEstadosVehiculo = 1;
			}
		}
	}
} 