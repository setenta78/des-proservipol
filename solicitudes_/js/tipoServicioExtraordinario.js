var cargaTipoServicioExtraordinario;

function leeTipoServiciosExtraordinarios(nombreObjeto, especialidad){
	cargaTipoServicioExtraordinario = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;		
	
	var objHttpXMLTipoServicio = new AJAXCrearObjeto();
			
	objHttpXMLTipoServicio.open("POST","./xml/xmlServicios/xmlTipoServicioExtraordinario.php",true);
	objHttpXMLTipoServicio.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipoServicio.send(encodeURI("especialidad="+especialidad));
	objHttpXMLTipoServicio.onreadystatechange=function()
	{
		if(objHttpXMLTipoServicio.readyState == 4)
		{       
			if (objHttpXMLTipoServicio.responseText != "VACIO"){
	
				//alert(objHttpXMLTipoServicio.responseText);		
				var xml 			= objHttpXMLTipoServicio.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				var tipo			= "E";

				document.getElementById(nombreObjeto).length = null;
							
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;								
				
				for(i=0;i<xml.getElementsByTagName('tipoServicioExtraordinario').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].firstChild.data;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].firstChild.data;
					
					codigo			= tipo + codigo;
					//alert(codigo);
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaTipoServicioExtraordinario = 1;
			}
		}
	}
} 