function eliminarRegistro(codigoFuncionario,fechaDesde,correlativo){
	if(validarServicios(codigoFuncionario,fechaDesde)){
		if (confirm("ATENCION :\nSE ELIMINARAN TODOS LOS MOVIMIENTOS DESDE EL "+fechaDesde+" EN ADELANTE, PARA ESTE FUNCIONARIO.          \n¿DESEA CONTINUAR?")) eliminarFecha(codigoFuncionario,fechaDesde,correlativo);
		else return false;
	}
}

function validarServicios(codigoFuncionario,fechaDesde){
  var objHttpXMLFuncionarios = new AJAXCrearObjeto();
 	objHttpXMLFuncionarios.open("POST","./xml/xmlServicios.php",false);
 	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
 	objHttpXMLFuncionarios.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fechaDesde="+fechaDesde));
 	if(objHttpXMLFuncionarios.responseText != "VACIO"){
		alert("ATENCION :\nNO SE PUEDE REALIZAR NINGUN CAMBIO, YA QUE POSEE SERVICIOS ASIGNADOS A PARTIR DEL "+fechaDesde);
		return false;
	}
	return true;
}

function eliminarFecha(codigoFuncionario,fechaDesde,correlativo){
	var objHttpXMLFecha = new AJAXCrearObjeto();
	objHttpXMLFecha.open("POST","./xml/xmlEliminarFecha.php",true);
	objHttpXMLFecha.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFecha.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fechaDesde="+fechaDesde+"&correlativo="+correlativo));
	objHttpXMLFecha.onreadystatechange=function(){
		if(objHttpXMLFecha.readyState == 4){
			if(objHttpXMLFecha.responseText != "VACIO"){
				var xml = objHttpXMLFecha.responseXML;
				var codigo = (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
				(codigo == 1) ? alert('LOS DATOS FUERON ELIMINADOS CON EXITO A LA BASE DE DATOS ......        ') : alert('LOS DATOS NO FUERON ELIMINADOS DE LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				Solicitud_Fecha(codigoFuncionario);
				
			}
		}
	}
	objHttpXML.close;
}
