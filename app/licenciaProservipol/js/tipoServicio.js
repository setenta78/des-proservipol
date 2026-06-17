var cargaTipoServicio;

function leeTipoServicios(nombreObjeto, multiseleccion, especialidad, grupo){
	cargaTipoServicio = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;		
	
	//alert(grupo);
	
	var objHttpXMLTipoServicio = new AJAXCrearObjeto();
			
	objHttpXMLTipoServicio.open("POST","./xml/xmlServicios/xmlTipoServicio.php",true);
	objHttpXMLTipoServicio.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipoServicio.send(encodeURI("especialidad="+especialidad+"&grupo="+grupo));
	objHttpXMLTipoServicio.onreadystatechange=function()
	{
		if(objHttpXMLTipoServicio.readyState == 4)
		{       
			if (objHttpXMLTipoServicio.responseText != "VACIO"){
	
				//alert(objHttpXMLTipoServicio.responseText);		
				var xml 			= objHttpXMLTipoServicio.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				var tipo			= "";

				document.getElementById(nombreObjeto).length = null;
				if (!multiseleccion){
					var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
					document.getElementById(nombreObjeto).options[0] = datosOpcion;								
				}
				
				for(i=0;i<xml.getElementsByTagName('tipoServicio').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].text;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].text;
					tipo 			= xml.getElementsByTagName('tipo')[i].text;
					
					codigo			= tipo + codigo;
					var datosOpcion = new Option(descripcion, codigo, "", "");
					//alert(i);
					if (!multiseleccion) var puntero = i+1;
					else var puntero = i;
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
					//alert(puntero);
				}
				
				cargaTipoServicio = 1;
			}
		}
	}
} 