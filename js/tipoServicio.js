var cargaTipoServicio;
var cargaGrupoServicio;

function leeTipoServicios(nombreObjeto, multiseleccion, especialidad, grupo){
	cargaTipoServicio = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var codUnidad = document.getElementById("unidadUsuario").value;
	var objHttpXMLTipoServicio = new AJAXCrearObjeto();
	objHttpXMLTipoServicio.open("POST","./xml/xmlServicios/xmlTipoServicio.php",true);
	objHttpXMLTipoServicio.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("especialidad="+especialidad+"&grupo="+grupo+"&codUnidad="+codUnidad);
	objHttpXMLTipoServicio.send(encodeURI("especialidad="+especialidad+"&grupo="+grupo+"&codUnidad="+codUnidad));
	//alert(objHttpXMLTipoServicio.responseText);
	objHttpXMLTipoServicio.onreadystatechange=function(){
		if(objHttpXMLTipoServicio.readyState == 4){
			//console.log(objHttpXMLTipoServicio.responseText);
			if (objHttpXMLTipoServicio.responseText != "VACIO"){
				var xml 				= objHttpXMLTipoServicio.responseXML.documentElement;
				var codigo 			= "";
				var descripcion	= "";
				var tipo				= "";
				document.getElementById(nombreObjeto).length = null;
				if(!multiseleccion){
					var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
					document.getElementById(nombreObjeto).options[0] = datosOpcion;
				}
				for(i=0;i<xml.getElementsByTagName('tipoServicio').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					tipo 				= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					codigo			= tipo + codigo;
					var datosOpcion = new Option(descripcion, codigo, "", "");
					if (!multiseleccion) var puntero = i+1;
					else var puntero = i;
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				}
				cargaTipoServicio = 1;
			}
		}
	}
}

function leeTipoServiciosN(nombreObjeto, grupo){
	cargaTipoServicio = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var codUnidad = document.getElementById("unidadUsuario").value;
	var objHttpXMLTipoServicio = new AJAXCrearObjeto();
	objHttpXMLTipoServicio.open("POST","./xml/xmlServicios/xmlTipoServicioN.php",true);
	objHttpXMLTipoServicio.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("grupo="+grupo+"&codUnidad="+codUnidad);
	objHttpXMLTipoServicio.send(encodeURI("grupo="+grupo+"&codUnidad="+codUnidad));
	objHttpXMLTipoServicio.onreadystatechange=function(){
		if(objHttpXMLTipoServicio.readyState == 4){
			//console.log(objHttpXMLTipoServicio.responseText);
			if (objHttpXMLTipoServicio.responseText != "VACIO"){
				var xml			= objHttpXMLTipoServicio.responseXML.documentElement;
				var codigo		= "";
				var descripcion	= "";
				var tipo		= "";
				document.getElementById(nombreObjeto).length = null;
				datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('tipoServicio').length;i++){
					codigo		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					tipo		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					codigo		= tipo + codigo;
					datosOpcion	= new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaTipoServicio = 1;
			}
		}
	}
}

function leeGrupoServicios(tipoUnidad,especialidadUnidad){
	cargaGrupoServicio = 0;
	document.getElementById('selTipoServicio').length = null;
	var codUnidad = document.getElementById("unidadUsuario").value;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById('selTipoServicio').options[0] = datosOpcion;
	if(tipoUnidad==0 && especialidadUnidad==0){
		document.getElementById('selTipoServicio').length = null;
		var listaDefault = ['SELECCIONE UNA OPCION ... ','OPERATIVOS','EXTRAORDINARIOS DENTRO DEL AREA JURISDICCIONAL','EXTRAORDINARIOS FUERA DEL AREA JURISDICCIONAL','INTRACUARTEL FIJO','INTRACUARTEL VARIABLE','SERVICIO EN EL SECTOR DE OTRO CUARTEL','ACTIVIDAD O SERVICIO FUERA DEL CUARTEL','SIN SERVICIO','COLACI\u00D3N/DESCANSO'];
		for(i=0;i<listaDefault.length;i++){
			datosOpcion = new Option(listaDefault[i], i, "", "");
			document.getElementById('selTipoServicio').options[i] = datosOpcion;
		}
		cargaGrupoServicio = 1;
		seleccionTipoServicio();
		return;
	}
	var objHttpXMLGrupoServicio = new AJAXCrearObjeto();
	objHttpXMLGrupoServicio.open("POST","./xml/xmlServicios/xmlGrupoServicio.php",true);
	objHttpXMLGrupoServicio.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("codUnidad="+codUnidad);
	objHttpXMLGrupoServicio.send(encodeURI("codUnidad="+codUnidad));
	objHttpXMLGrupoServicio.onreadystatechange=function(){
		if(objHttpXMLGrupoServicio.readyState == 4){
			//console.log(objHttpXMLGrupoServicio.responseText);
			if (objHttpXMLGrupoServicio.responseText != "VACIO"){
				var xml			= objHttpXMLGrupoServicio.responseXML.documentElement;
				var codigo		= "";
				var descripcion	= "";
				document.getElementById('selTipoServicio').length = null;
				datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById('selTipoServicio').options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('grupoServicio').length;i++){
					codigo		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById('selTipoServicio').options[i+1] = datosOpcion;
				}
				cargaGrupoServicio = 1;
				seleccionTipoServicio();
			}
		}
	}
}
