function abrirVentanaUsuario(){
	var titulo = "USUARIO (MODIFICA CONTRASE&Ntilde;A)";
	var ancho  = 700;
	var alto   = 240;
	var pagina = "fichaUsuario.php";
	var estado = "true";
	var posX   = 120;
	var posY   = 15;
	var parametros = "";
	abrirVentana(titulo, ancho, alto, pagina, '', estado, posX, posY);
}

function cambiarContrasena(){
	document.getElementById("ventanaCambiaContrasena").style.display = "";
	document.getElementById("ventanaCambiaDatos").style.display = "none";
	document.getElementById("usuarioBotonModificar").disabled 		 = "true";
	document.getElementById("usuarioBotonCerrar").disabled 			 = "true";
	document.getElementById("textClaveActual").value 			 	 = "";
	document.getElementById("textClaveNueva").value 			 	 = "";
	document.getElementById("textClaveNueva2").value 			 	 = "";
	document.getElementById("textClaveActual").focus();
}

function cerrarCambiarContrasena(){
	document.getElementById("ventanaCambiaContrasena").style.display = "none";
	document.getElementById("ventanaCambiaDatos").style.display = "";
	document.getElementById("usuarioBotonModificar").disabled 		 = "";
	document.getElementById("usuarioBotonCerrar").disabled 			 = "";
}

function aceptarCambiarContrasena(codigoFuncionario){
	var actualizaOk = true;
	var claveActual = eliminarBlancos(document.getElementById("textClaveActual").value);
	var nuevaClave  = eliminarBlancos(document.getElementById("textClaveNueva").value);
	var datosOk = validarCambiarContrasena(codigoFuncionario);
	if (datosOk) actualizarClaveUsuario(codigoFuncionario, claveActual, nuevaClave);
}

function validarCambiarContrasena(codigoFuncionario){
	var claveActual = eliminarBlancos(document.getElementById("textClaveActual").value);
	var nuevaClave  = eliminarBlancos(document.getElementById("textClaveNueva").value);
	var nuevaClave2 = eliminarBlancos(document.getElementById("textClaveNueva2").value);
	
	if (claveActual == ""){
		alert("DEBE INGRESAR CLAVE ACTUAL .... ");
		document.getElementById("textClaveActual").focus();
		return false;
	}
	
	var claveUsuario = obtieneClaveUsuario(codigoFuncionario);
	
	if (claveActual != claveUsuario){
		alert("LA CLAVE ACTUAL INGRESADA NO CORRESPONDE A LA CLAVE DE ESTE USUARIO.       ");
		document.getElementById("textClaveActual").value = "";
		document.getElementById("textClaveActual").focus();
		return false;
	}
	
	if (nuevaClave == ""){
		alert("DEBE INGRESAR CLAVE NUEVA .... ");
		document.getElementById("textClaveNueva").focus();
		return false;
	}
	
	if (nuevaClave2 == ""){
		alert("DEBE REINGRESAR CLAVE NUEVA .... ");
		document.getElementById("textClaveNueva2").focus();
		return false;
	}
	
	if (nuevaClave2 != nuevaClave){
		alert("LA CLAVE REINGRESADA DEBE COINCIDIR CON LA CLAVE NUEVA .... ");
		document.getElementById("textClaveNueva2").focus();
		return false;
	}
	return true;
}

function obtieneClaveUsuario(codigoFuncionario){
	var parametros = "codigoUsuario="+codigoFuncionario;
	var objHttpXMLUsuario = new AJAXCrearObjeto();
	objHttpXMLUsuario.open("POST","./xml/xmlUsuarios/xmlObtieneClaveUsuario.php",false);
	objHttpXMLUsuario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUsuario.send(encodeURI(parametros));
	//alert(objHttpXMLUsuario.responseXML.documentElement);     
	var xml = objHttpXMLUsuario.responseXML.documentElement;
	var clave = (xml.getElementsByTagName('claveUsuario')[0].text||xml.getElementsByTagName('claveUsuario')[0].textContent||"");
	return clave
}

function actualizarClaveUsuario(codigoFuncionario, claveActual, nuevaClave){
	var parametros = "claveActual="+claveActual+"&nuevaClave="+nuevaClave+"&codigoUsuario="+codigoFuncionario;
	var objHttpXMLUsuario = new AJAXCrearObjeto();
	objHttpXMLUsuario.open("POST","./xml/xmlUsuarios/xmlActualizaClaveUsuario.php",true);
	objHttpXMLUsuario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUsuario.send(encodeURI(parametros));
	objHttpXMLUsuario.onreadystatechange=function(){
		if(objHttpXMLUsuario.readyState == 4){
				//alert(objHttpXMLUsuario.responseText);
				if (objHttpXMLUsuario.responseText != "VACIO"){
				var xml = objHttpXMLUsuario.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LA CONTRASE&Ntilde;A FUE ACTUALIZADA CON EXITO EN LA BASE DE DATOS.	\nLA APLICACION SE CERRARA PARA NUEVA CONTRASE&Ntilde;A.');
						top.cerrarAplicacion();
					}
					else {
						alert('LA CONTRASE&Ntilde;A NO PUDO SER ACTUALIZADA EN LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
						return false;
					}
				}
			}
		}
	}
}

function eliminarUsuario(codigoUsuario){
	var parametros =  "codigoUsuario="+codigoUsuario;
	var objHttpXMLUsuario = new AJAXCrearObjeto();
	objHttpXMLUsuario.open("POST","./xml/xmlUsuarios/xmlEliminaUsuario.php",true);
	objHttpXMLUsuario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUsuario.send(encodeURI(parametros));
	objHttpXMLUsuario.onreadystatechange=function(){
		if(objHttpXMLUsuario.readyState == 4){
			if (objHttpXMLUsuario.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml = objHttpXMLUsuario.responseXML.documentElement;
				for(var i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
				}
			}
		}
	}
}

function cambiarUsuario(codigoUsuario){
	window.location = ("cambioUsuario.php?codigoUsuario="+codigoUsuario);
}
