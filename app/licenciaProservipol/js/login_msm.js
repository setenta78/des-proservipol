	
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
    	}
	}
