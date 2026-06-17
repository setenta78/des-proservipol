//alert("LA SOLICITUD DE DESBLOQUEO DEL SISTEMA PROSERVIPOL V3.0 ES A TRAVES DE DOCUMENTO ELECTRONICO DIRIGIDO A LA INSPECTORIA GENERAL.\r\n\r\nEL DESBLOQUEO SERA DE LUNES A JUEVES DE LA SEMANA SIGUIENTE A LA RECEPCION DEL DOCUMENTO\r\n\r\nDUDAS Y/O CONSULTAS A LA IP:20845 CAPITAN GONZALEZ.");


	function actualizarTamanoLogin(){
		//alert(/MSIE 6.0/i.test(navigator.userAgent));
		if (/MSIE 6.0/i.test(navigator.userAgent)) var valorRestar = 460;
		else var valorRestar = 380;
				
		var tamanoPantalla 	= window.document.body.parentNode.offsetHeight;
		var disponible 		= tamanoPantalla - valorRestar;
		var tamanoNuevo 	= (disponible/2) + 19;
		var tamanoNuevo2 	= (disponible/2) - 20;
		
		document.getElementById('loginIngresaContrasena').style.padding= tamanoNuevo+"px 0px 0px";
		document.getElementById('loginEspacioInferior').style.padding= "30px 0px "+tamanoNuevo2+"px 0px";
		document.getElementById('loginEspacioManual').style.padding= "20px 0px 0px 0px";

	}

/*	
	function actualizarTamanoLogin(){
		//alert(/MSIE 6.0/i.test(navigator.userAgent));
		if (/MSIE 6.0/i.test(navigator.userAgent)) var valorRestar = 460;
		else var valorRestar = 380;
				
		var tamanoPantalla 	= window.document.body.parentNode.offsetHeight;
		var disponible 		= tamanoPantalla - valorRestar;
		var tamanoNuevo 	= disponible/2;
		var tamanoNuevo2 	= disponible/2;
		
		document.getElementById('loginIngresaContrasena').style.padding= tamanoNuevo+"px 0px 0px";
		document.getElementById('loginEspacioInferior').style.padding= "72px 0px "+tamanoNuevo2+"px 0px";
	}
*/	
	
	function validarContrasena(){
		var nombreUsuario 		= document.getElementById('textUsuario').value;
		var contrasenaUsuario 	= document.getElementById('textClave').value;
		
		nombreUsuario 	  = allTrim(nombreUsuario);
		contrasenaUsuario = allTrim(contrasenaUsuario);
		
		if (nombreUsuario.length == 0){
			alert("El nombre de Usuario Ingresado no es Válido ... Digitelo Nuevamente.        ");
			document.getElementById('textUsuario').value = "";
			document.getElementById('textUsuario').focus();
			return false;
		}
		
		if (contrasenaUsuario.length == 0){
			alert("No ha ingresado la constraseña... Digitela.        ");
			document.getElementById('textClave').value = "";
			document.getElementById('textClave').focus();
			return false;
		}
		
		//alert("nombreUsuario = "+nombreUsuario+", contrasenaUsuario = "+contrasenaUsuario);
		document.forms[0].submit();
		//buscaUsuario(nombreUsuario, contrasenaUsuario);
		
	}

	function buscaUsuario(userName, contrasenna){
		setXmlUsuario(userName, contrasenna);
	}
	
	function lTrim(sStr){
     while (sStr.charAt(0) == " ") 
      sStr = sStr.substr(1, sStr.length - 1);
     return sStr;
    }
 
    function rTrim(sStr){
     while (sStr.charAt(sStr.length - 1) == " ") 
      sStr = sStr.substr(0, sStr.length - 1);
     return sStr;
    }
 
    function allTrim(sStr){
     return rTrim(lTrim(sStr));
    }
    
    
    function errorClave(existeError){
    	if (existeError == 1){
    		alert("EL NOMBRE DE USUARIO Y/O CLAVE INGRESADA NO CORRESPONDE.	\nINTENTELO NUEVAMENTE.");
    	} else {
    		mensajeInicial();
    	}
	}
	
	function mensajeInicial(){
		var mensajeInicial = "";
		var mensajeInicial2 = "";
		var mensajeInicial3 = "";
		
		mensajeInicial += "HORARIOS DE ATENCION :\n\n";
		mensajeInicial += "Para soporte y asistencia técnica Sistema Proservipol v3\n";
		mensajeInicial += "de Lunes a Viernes.\n\n";
		mensajeInicial += "Horarios de 08:30 a 13:00 Hrs. y de 14:30 a 18:00 Hrs.\n";
		mensajeInicial += "llamar a los siguientes anexos de la mesa de ayuda:\n\n";  
		mensajeInicial += "Mesa de ayuda 1: 20828\n";
		mensajeInicial += "Mesa de ayuda 2: 20844\n";
		mensajeInicial += "Mesa de ayuda 3: 20836\n";
		mensajeInicial += "\n\n";
		//mensajeInicial += "Realizarlas al siguiente IP: 20842";
		//mensajeInicial += "\n\n";
		mensajeInicial += "CONSULTAS REALIZARLAS A : correo.proservipol@carabineros.cl.";
		
		//mensajeInicial2 += "ATENCION :\n\n";
		//mensajeInicial2 += "AJUSTES PROSERVIPOL 01 DE JULIO: DESCARGUE INSTRUCTIVO \"INSTRUCTIVO AJUSTES PROSERVIPOL 01072013.pdf\" Y ACTUALICE AGREGADOS VIGENTES AL DÍA DE HOY, ";
		//mensajeInicial2 += "AL CUAL SE PUEDE ACCEDER EN LA PANTALLA DE INGRESO AL SISTEMA.";  
		//mensajeInicial2 += "\n\n";
		//mensajeInicial2 += "ESTE DOCUMENTO DEBE SER REVISADO POR TODAS LOS PERFILES DEL CUARTEL."; 
		//mensajeInicial2 += "\n";
		//mensajeInicial2 += "\n";
		//mensajeInicial2 += "SE RECUERDA QUE LAS SOLICITUDES SE DEBEN REALIZAR A : correo.proservipol@carabineros.cl.";


		mensajeInicial2 += "ATENCION :\n\n";
		mensajeInicial2 += "RESPECTO A LA NOTIFICACION ENVIADA VIA MAIL, SE ACLARA A LOS CUARTELES QUE APARECEN CON UN VALOR EN LA CASILLA ";
		mensajeInicial2 += "(1) \"AGREGADOS A REPARTICIONES SIN PROSERVIPOL\", QUE DEBEN REVISAR SI LA CLASIFICACION UTILIZADA ES CORRECTA. ";
		mensajeInicial2 += "EL DATO ENVIADO CORRESPONDE AL TOTAL DE REGISTROS Y ES SOLO REFERENCIAL Y NO INDICA LA NECESARIA EXISTENCIA DE UN ERROR.";
		mensajeInicial2 += "\n";
		mensajeInicial2 += "\n";
		mensajeInicial2 += "CONSULTAS REALIZARLAS A : correo.proservipol@carabineros.cl.";
		
		
		
		
    	//alert(mensajeInicial);
    	//alert(mensajeInicial2);
    	//alert(mensajeInicial3); 
    }
