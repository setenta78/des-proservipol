var cargaCuadrantes;
function leeCuadrantes(codigoUnidad, listado, nombreObjeto, multiple){
	cargaCuadrantes = 0;
	
	if (listado == false){
		document.getElementById(nombreObjeto).length = null;
		if (multiple == false ){		
			var datosOpcion = new Option("SELECCIONE OPCION ... ", 0, "", "");
			document.getElementById(nombreObjeto).options[0] = datosOpcion;
		}		
	}
	
	if (listado == true) {var div = document.getElementById("listadoCuadrantes");}
	var objHttpXMLCuadrante = new AJAXCrearObjeto();	
	objHttpXMLCuadrante.open("POST","./xml/xmlCuadrantes/xmlListaCuadrantes.php",true);
	objHttpXMLCuadrante.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCuadrante.send(encodeURI("codigoUnidad="+codigoUnidad));
	objHttpXMLCuadrante.onreadystatechange=function(){
		if(objHttpXMLCuadrante.readyState == 4){       
			if (objHttpXMLCuadrante.responseText != "VACIO"){
				//alert(objHttpXMLCuadrante.responseText);
				var xml 				= objHttpXMLCuadrante.responseXML.documentElement;
				var codigo 				= "";
				var descripcion			= "";
				var abreviatura			= "";
				var listadoCuadrantes 	= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				
				if (listado == true) {listadoCuadrantes = "<table width='100%' cellspacing='1' cellpadding='1'>";}
				for(i=0;i<xml.getElementsByTagName('cuadrante').length;i++){
					codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					abreviatura = (xml.getElementsByTagName('abreviatura')[i].text||xml.getElementsByTagName('abreviatura')[i].textContent||"");
					
					if (listado == true){
						if (sw==0) {fondoLinea = "linea1";sw =1}
						else {fondoLinea = "linea2";sw=0}
						
						resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
						lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
						
						var nroLinea = i + 1;
						if (descripcion != "OTRO CUADRANTE"){
							listadoCuadrantes += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
							listadoCuadrantes += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
							listadoCuadrantes += "<td width='25%' align='left'><div id='valorColumna'>"+descripcion+"</div></td>";
							listadoCuadrantes += "<td width='70%' align='left'><div id='valorColumna'></div></td>";
							listadoCuadrantes += "</tr>";
						}
					} else {
						var puntero;
						if (!multiple) puntero = i+1;
						else puntero = i;
						
						if (!multiple && descripcion != "OTRO CUADRANTE"){ 
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
						
						if (multiple){ 
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
						
					}
				}
				if (listado == true){
					listadoCuadrantes += "</table>";
					div.innerHTML = listadoCuadrantes;
				}
				cargaCuadrantes = 1;
			}
		}
	}
} 

function leeCuadrantesConHijos(codigoUnidad, listado, nombreObjeto, multiple){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var tipoUnidad = document.getElementById("tipoUnidad").value;
	var contieneHijos = document.getElementById("contieneHijos").value;
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var correlativo = document.getElementById("correlativo").value;
	cargaCuadrantes = 0;
	
	if (listado == true) {var div = document.getElementById("listadoCuadrantes");}
	var objHttpXMLCuadrante = new AJAXCrearObjeto();
	objHttpXMLCuadrante.open("POST","./xml/xmlCuadrantes/xmlListaCuadrantesEspecializadas.php",true);
	objHttpXMLCuadrante.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCuadrante.send(encodeURI("codigoUnidad="+codigoUnidad+"&tipoUnidad="+ tipoUnidad+"&unidadUsuario="+unidadUsuario+"&correlativo="+correlativo));
	objHttpXMLCuadrante.onreadystatechange=function(){
		//console.log(objHttpXMLCuadrante.responseText);
		if(objHttpXMLCuadrante.readyState == 4){
			if (objHttpXMLCuadrante.responseText != "VACIO"){
				if (listado == false){
					document.getElementById(nombreObjeto).length = null;
					if (multiple == false ){		
						var datosOpcion = new Option("SELECCIONE OPCION ... ", 0, "", "");
						document.getElementById(nombreObjeto).options[0] = datosOpcion;
					}
				}
				var xml 							= objHttpXMLCuadrante.responseXML.documentElement;
				var codigo 						= "";
				var descripcion				= "";
				var abreviatura				= "";
				var listadoCuadrantes = "";
				var unidadAbuelo			= "";
				var sw 				 				= 0;
				var fondoLinea		 		= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				
				if (listado == true) {listadoCuadrantes = "<table width='100%' cellspacing='1' cellpadding='1'>";}
				for(i=0;i<xml.getElementsByTagName('cuadrante').length;i++){	
					unidadAbuelo 	= (xml.getElementsByTagName('unidadPadre')[i].text||xml.getElementsByTagName('unidadPadre')[i].textContent||"");
					codigo 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descCuadrante	=	(xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					unidadDesc		=	(xml.getElementsByTagName('unidadDescripcion')[i].text||xml.getElementsByTagName('unidadDescripcion')[i].textContent||"");
					descripcion 	= descCuadrante + " (" + unidadDesc + ")";
					abreviatura 	= (xml.getElementsByTagName('abreviatura')[i].text||xml.getElementsByTagName('abreviatura')[i].textContent||"");
					
					if (codigo!="") codigo += "C";
          if (multiple ){
		      	unidadAbuelo += "A";
						var datosOpcion = new Option("..",unidadAbuelo,"", "");
						document.getElementById(nombreObjeto).options[0] = datosOpcion;
					}
					
					if (listado == true){
						if (sw==0) {fondoLinea = "linea1";sw =1}
						else {fondoLinea = "linea2";sw=0}
						
						resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
						lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
						var nroLinea = i + 1;
						
						if (descripcion != "OTRO CUADRANTE"){
							listadoCuadrantes += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
							listadoCuadrantes += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
							listadoCuadrantes += "<td width='25%' align='left'><div id='valorColumna'>"+descripcion+"</div></td>";
							listadoCuadrantes += "<td width='70%' align='left'><div id='valorColumna'></div></td>";
							listadoCuadrantes += "</tr>";
						}
					} else {
						var puntero;
						puntero = i+1;
						
						if (!multiple && descripcion != "OTRO CUADRANTE"){
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
						
						if (multiple && descripcion != "OTRO CUADRANTE"){
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
					}
				}
				if (listado == true){
					listadoCuadrantes += "</table>";
					div.innerHTML = listadoCuadrantes;
				}
				cargaCuadrantes = 1;
				return true;
			}else{
				return false;
			}
		}
	}
}

function leeCuadrantesGope(codigoUnidad, listado, nombreObjeto, multiple){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var tipoUnidad = document.getElementById("tipoUnidad").value;
	var contieneHijos = document.getElementById("contieneHijos").value;
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var correlativo = document.getElementById("correlativo").value;
	cargaCuadrantes = 0;
	if (listado == true) {var div = document.getElementById("listadoCuadrantes");}
	
	var objHttpXMLCuadrante = new AJAXCrearObjeto();	
	objHttpXMLCuadrante.open("POST","./xml/xmlCuadrantes/xmlListaCuadrantesGope.php",true);
	objHttpXMLCuadrante.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCuadrante.send(encodeURI("codigoUnidad="+codigoUnidad));
	objHttpXMLCuadrante.onreadystatechange=function(){
		if(objHttpXMLCuadrante.readyState == 4){
		 //alert(objHttpXMLCuadrante.responseText);
			if (objHttpXMLCuadrante.responseText != "VACIO"){
				//alert(objHttpXMLCuadrante.responseText);
				if (listado == false){
					document.getElementById(nombreObjeto).length = null;
					if (multiple == false ){		
						var datosOpcion = new Option("SELECCIONE OPCION ... ", 0, "", "");
						document.getElementById(nombreObjeto).options[0] = datosOpcion;
					}		
				}
				
				var xml 				= objHttpXMLCuadrante.responseXML.documentElement;
				var codigo 				= "";
				var descripcion			= "";
				var abreviatura			= "";
				var listadoCuadrantes 	= "";
				var unidadAbuelo		= "";
				
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				if (listado == true) {listadoCuadrantes = "<table width='100%' cellspacing='1' cellpadding='1'>";}
				
				for(i=0;i<xml.getElementsByTagName('cuadrante').length;i++){			
					unidadAbuelo 	= (xml.getElementsByTagName('unidadPadre')[i].text||xml.getElementsByTagName('unidadPadre')[i].textContent||"");
					codigo 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					descCuadrante	=	(xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					unidadDesc		=	(xml.getElementsByTagName('unidadDescripcion')[i].text||xml.getElementsByTagName('unidadDescripcion')[i].textContent||"");
					descripcion 	= descCuadrante + " (" + unidadDesc + ")";
					abreviatura 	= (xml.getElementsByTagName('abreviatura')[i].text||xml.getElementsByTagName('abreviatura')[i].textContent||"");
					
					if (codigo!="") codigo += "C";
          	if (multiple ){
          		unidadAbuelo += "A";
							var datosOpcion = new Option("..",unidadAbuelo,"", "");
							document.getElementById(nombreObjeto).options[0] = datosOpcion;
						}
					
					if (listado == true){
						if (sw==0) {fondoLinea = "linea1";sw =1}
						else {fondoLinea = "linea2";sw=0}
						
						resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
						lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
						
						var nroLinea = i + 1;
						
						if (descripcion != "OTRO CUADRANTE"){
							listadoCuadrantes += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
							listadoCuadrantes += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
							listadoCuadrantes += "<td width='25%' align='left'><div id='valorColumna'>"+descripcion+"</div></td>";
							listadoCuadrantes += "<td width='70%' align='left'><div id='valorColumna'></div></td>";
							listadoCuadrantes += "</tr>";
						}
					} else {
						var puntero;
						puntero = i+1;
						
						if (!multiple && descripcion != "OTRO CUADRANTE"){
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
						
						if (multiple && descripcion != "OTRO CUADRANTE"){
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
					}
				}
				if (listado == true){
					listadoCuadrantes += "</table>";
					div.innerHTML = listadoCuadrantes;
				}
				cargaCuadrantes = 1;
				return true;
			}else{
				return false;
			}
		}
	}
}