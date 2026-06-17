	// creacion obj. AJAX
	
	var objHttpXML   = AJAXCrearObjeto(); 
	var objHttpXML2  = AJAXCrearObjeto(); 
	var objHttpXMLUnidades  = AJAXCrearObjeto(); 
	
	function AJAXCrearObjeto(){ 
		var obj; 
		if(window.XMLHttpRequest) { // no es IE 
			obj = new XMLHttpRequest(); 
		} else { // Es IE o no tiene el objeto 
				try { 
					obj = new ActiveXObject("Microsoft.XMLHTTP"); 
				} 
				catch (e) { 
					alert('El navegador utilizado no esta soportado'); 
				} 
		} 
		return obj; 
	}