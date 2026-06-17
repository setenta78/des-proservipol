var cargaMovimiento;
function leeMovimiento2(nombreObjeto, tipo){
	cargaMovimiento = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLEstado = new AJAXCrearObjeto();
	objHttpXMLEstado.open("POST","./xml/xmlRequerimientos/xmlListaMovimiento.php",true);
	objHttpXMLEstado.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstado.send(encodeURI("tipo="+tipo));
	objHttpXMLEstado.onreadystatechange=function(){
		if(objHttpXMLEstado.readyState == 4){
			if (objHttpXMLEstado.responseText != "VACIO"){
				//alert(objHttpXMLEstado.responseText);
				var xml 				= objHttpXMLEstado.responseXML.documentElement;
				var codigo 			= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('movimiento').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaMovimiento = 1;
			}
		}
	}
}