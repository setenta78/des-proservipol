var cargaCargos;

function leeCargos(nombreObjeto){
	var tipoUnidad = document.getElementById("tipoUnidad").value; //Variable agregada el 14-09-2015
	cargaCargos = 0;
	//alert(tipoUnidad);
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;		
	
	var objHttpXMLCargo = new AJAXCrearObjeto();
			
	objHttpXMLCargo.open("POST","./xml/xmlFuncionarios/xmlCargos.php",true);
	objHttpXMLCargo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCargo.send(encodeURI("tipoUnidad="+tipoUnidad)); //Parametro Agregado el 14-09-2015
	objHttpXMLCargo.onreadystatechange=function()
	{
		if(objHttpXMLCargo.readyState == 4)
		{       
			if (objHttpXMLCargo.responseText != "VACIO"){
	
				//alert(objHttpXMLCargo.responseText);		
				//alert(tipoUnidad);	
				var xml 			= objHttpXMLCargo.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";

				document.getElementById(nombreObjeto).length = null;
				
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;								
				
				for(i=0;i<xml.getElementsByTagName('cargo').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].firstChild.data;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].firstChild.data;
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaCargos = 1;
			}
		}
	}
} 