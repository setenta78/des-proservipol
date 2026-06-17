var cargaCargos;

function leeSeccion(nombreObjeto){
	var  unidadUsuario = document.getElementById("unidadUsuario").value;
	//alert(unidadUsuario);
	cargaCargos = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;		
	
	var objHttpXMLCargo = new AJAXCrearObjeto();
			
	objHttpXMLCargo.open("POST","./xml/xmlSeccion/xmlSeccion.php",true);
	objHttpXMLCargo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCargo.send(encodeURI("unidadUsuario="+unidadUsuario));
	objHttpXMLCargo.onreadystatechange=function()
	{
		if(objHttpXMLCargo.readyState == 4)
		{       
		//alert(objHttpXMLCargo.responseText);		
			if (objHttpXMLCargo.responseText != "VACIO"){
	
				alert(objHttpXMLCargo.responseText);		
				var xml 			= objHttpXMLCargo.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";

				document.getElementById(nombreObjeto).length = null;
				
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;								
				
				for(i=0;i<xml.getElementsByTagName('seccion').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].text;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].text;
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaCargos = 1;
			}
		}
	}
} 