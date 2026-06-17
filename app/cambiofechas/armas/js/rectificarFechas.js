function eliminarRegistro(codigoArma,fechaDesde,correlativo){
	if(validarServicios(codigoArma,fechaDesde)){
		if(confirm("ATENCION :\nSE ELIMINARAN TODOS LOS MOVIMIENTOS DESDE EL "+fechaDesde+" EN ADELANTE, PARA ESTA ARMA.          \n¿DESEA CONTINUAR?")) eliminarFecha(codigoArma,fechaDesde,correlativo);
		else return false;
	}
}

function validarServicios(codigoArma,fechaDesde){
	var objHttpXMLArma = new AJAXCrearObjeto();
 	objHttpXMLArma.open("POST","./xml/xmlServicios.php",false);
 	objHttpXMLArma.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 	objHttpXMLArma.send(encodeURI("codigoArma="+codigoArma+"&fechaDesde="+fechaDesde));
 	if(objHttpXMLArma.responseText != "VACIO"){
		alert("ATENCION :\nNO SE PUEDE REALIZAR NINGUN CAMBIO, YA QUE POSEE SERVICIOS ASIGNADOS A PARTIR DEL "+fechaDesde);
		return false;
	}
	return true;
}

function eliminarFecha(codigoArma,fechaDesde,correlativo){
	var objHttpXMLFecha = new AJAXCrearObjeto();
	objHttpXMLFecha.open("POST","./xml/xmlEliminarFecha.php",true);
	objHttpXMLFecha.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFecha.send(encodeURI("codigoArma="+codigoArma+"&fechaDesde="+fechaDesde+"&correlativo="+correlativo));
	objHttpXMLFecha.onreadystatechange=function(){
		if(objHttpXMLFecha.readyState == 4){
			if (objHttpXMLFecha.responseText != "VACIO"){
				var xml = objHttpXMLFecha.responseXML;
				var codigo = (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
				(codigo == 1) ? alert('LOS DATOS FUERON ELIMINADOS CON EXITO A LA BASE DE DATOS ......        ') : alert('LOS DATOS NO FUERON ELIMINADOS DE LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				Solicitud_Fecha(codigoArma);
				
			}
		}
	}
	objHttpXML.close;
}