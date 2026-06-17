function eliminarRegistro(codigoVehiculo,fechaDesde,correlativo){
	if(validarServicios(codigoVehiculo,fechaDesde)){
		if (confirm("ATENCION :\nSE ELIMINARAN TODOS LOS MOVIMIENTOS DESDE EL "+fechaDesde+" EN ADELANTE, PARA ESTE FUNCIONARIO.          \n¿DESEA CONTINUAR?")) eliminarFecha(codigoVehiculo,fechaDesde,correlativo);
		else return false;
	}
}

function validarServicios(codigoVehiculo,fechaDesde){
  var objHttpXMLVehiculo = new AJAXCrearObjeto();
 	objHttpXMLVehiculo.open("POST","./xml/xmlServicios.php",false);
 	objHttpXMLVehiculo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 	objHttpXMLVehiculo.send(encodeURI("codigoVehiculo="+codigoVehiculo+"&fechaDesde="+fechaDesde));
 	if(objHttpXMLVehiculo.responseText != "VACIO"){
		alert("ATENCION :\nNO SE PUEDE REALIZAR NINGUN CAMBIO, YA QUE POSEE SERVICIOS ASIGNADOS A PARTIR DEL "+fechaDesde);
		return false;
	}
	return true;
}

function eliminarFecha(codigoVehiculo,fechaDesde,correlativo){
	var objHttpXMLFecha = new AJAXCrearObjeto();
	objHttpXMLFecha.open("POST","./xml/xmlEliminarFecha.php",true);
	objHttpXMLFecha.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFecha.send(encodeURI("codigoVehiculo="+codigoVehiculo+"&fechaDesde="+fechaDesde+"&correlativo="+correlativo));
	objHttpXMLFecha.onreadystatechange=function(){
		if(objHttpXMLFecha.readyState == 4){
			if (objHttpXMLFecha.responseText != "VACIO"){
				var xml = objHttpXMLFecha.responseXML;
				var codigo = (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
				(codigo == 1) ? alert('LOS DATOS FUERON ELIMINADOS CON EXITO A LA BASE DE DATOS ......        ') : alert('LOS DATOS NO FUERON ELIMINADOS DE LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				Solicitud_Fecha(codigoVehiculo);
				
			}
		}
	}
	objHttpXML.close;
}