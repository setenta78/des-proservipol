var listaAccesorios = new Array();
var cargaTipoAccesorio;

function leeTipoAccesorio(nombreObjeto){
	cargaTipoAccesorio = 0;
	var objHttpXMLTipo = new AJAXCrearObjeto();
	objHttpXMLTipo.open("POST","./xml/xmlAccesorios/xmlTipoAccesorio.php",true);
	objHttpXMLTipo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipo.send(encodeURI());
	objHttpXMLTipo.onreadystatechange=function(){
		if(objHttpXMLTipo.readyState == 4){
			if (objHttpXMLTipo.responseText != "VACIO"){
				//alert(objHttpXMLTipo.responseText);
				var xml 			= objHttpXMLTipo.responseXML.documentElement;
				var codigo 			= "";
				var descripcion		= "";
				listaAccesorios = new Array();
				for(i=0;i<xml.getElementsByTagName('tipoAccesorio').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion 	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var tipoAccesorio = new Array(codigo,descripcion);
					listaAccesorios.push(tipoAccesorio);
				}
				cargaTipoAccesorio = 1;
				ordenarAccesorio(nombreObjeto);
			}
		}
	}
}

function ordenarAccesorio(nombreObjeto){
	document.getElementById(nombreObjeto).length = null;
	for(i=0;i<listaAccesorios.length;i++){
		let ingresar	= true;
		let option		= document.createElement("option");
		option.text		= listaAccesorios[i][1];
		option.value	= "O"+listaAccesorios[i][0];
		for(j=0;j<document.getElementById('personalServicioAccesorio').length;j++){
			if(document.getElementById('personalServicioAccesorio').options[j].value == ("O"+listaAccesorios[i][0])) ingresar = false;
		}
		if(ingresar) document.getElementById(nombreObjeto).add(option);
	}
}

function cambiarFiltroAccesorio(activar,desactivar){
	document.getElementById(activar).disabled = true;
	document.getElementById(desactivar).disabled = false;
	(activar=='rank') ? ordenarAccesorio('accesoriosDisponibles') : ordenar(document.getElementById('accesoriosDisponibles'));
}
