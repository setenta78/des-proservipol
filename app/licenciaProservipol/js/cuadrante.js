var cargaCuadrantes;
//Funcion agregada el 21-04-2015
function leeCuadrantesConHijos(codigoUnidad, listado, nombreObjeto, multiple){
var unidadUsuario = document.getElementById("unidadUsuario").value;
var tipoUnidad = document.getElementById("tipoUnidad").value;
var contieneHijos = document.getElementById("contieneHijos").value;
var unidadUsuario = document.getElementById("unidadUsuario").value;
	var correlativo = document.getElementById("correlativo").value;

	cargaCuadrantes = 0;

	//alert(listado);
	if (listado == true) {var div = document.getElementById("listadoCuadrantes");}
	var objHttpXMLCuadrante = new AJAXCrearObjeto();	
	objHttpXMLCuadrante.open("POST","./xml/xmlCuadrantes/xmlListaCuadrantesEspecializadas.php",true);
	objHttpXMLCuadrante.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCuadrante.send(encodeURI("codigoUnidad="+codigoUnidad+"&tipoUnidad="+ tipoUnidad+"&unidadUsuario="+unidadUsuario+"&correlativo="+correlativo)); //añadir
	objHttpXMLCuadrante.onreadystatechange=function()
	{
		if(objHttpXMLCuadrante.readyState == 4)
		{       
		 //alert(objHttpXMLCuadrante.responseText);
			if (objHttpXMLCuadrante.responseText != "VACIO"){
	
			//	alert(objHttpXMLCuadrante.responseText);		
				
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
				//alert(listado);
				if (listado == true) {listadoCuadrantes = "<table width='100%' cellspacing='1' cellpadding='1'>";}
				else {//document.getElementById(nombreObjeto).length = null;
				}
				
				//alert(multiple);
				//if (multiple == true) document.getElementById(nombreObjeto).length = null;    
					
				for(i=0;i<xml.getElementsByTagName('cuadrante').length;i++){			
					
					unidadAbuelo 	= xml.getElementsByTagName('unidadPadre')[i].text;
					codigo 			= xml.getElementsByTagName('codigo')[i].text;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].text + " (" + xml.getElementsByTagName('unidadDescripcion')[i].text +")";
					abreviatura 	= xml.getElementsByTagName('abreviatura')[i].text;
					 
				
					if (codigo!="") codigo += "C";		
                 if (multiple ){ 
		         unidadAbuelo += "A";	
               
               
						var datosOpcion = new Option("..",unidadAbuelo,"", "");
						document.getElementById(nombreObjeto).options[0] = datosOpcion;		
                       			 //alert(unidadAbuelo);
					    
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
							//listadoCuadrantes += "<td width='10%'><div id='valorColumna'></div></td>";
							listadoCuadrantes += "</tr>";
						}
					} else {
						var puntero;
						//if (!multiple) puntero = i+1;
						//else puntero = i;
						puntero = i+1;
						//alert(puntero);
						
						if (!multiple && descripcion != "OTRO CUADRANTE"){ 
						  //alert(codigo);
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
						
						if (multiple && descripcion != "OTRO CUADRANTE"){ 
						  //alert(codigo);
							var datosOpcion = new Option(descripcion, codigo, "", "");
							document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
						}
								
					}
					
				}
				if (listado == true){
					listadoCuadrantes += "</table>";
					div.innerHTML = listadoCuadrantes;
				} else {
					//var datosOpcion = new Option("OTRO", 0, "", "");
					//document.getElementById(nombreObjeto).options[puntero+1] = datosOpcion;
				}
				cargaCuadrantes = 1
				//linea añadida
				return true;
			}else{
			//linea añadida
		
				return false;
				
			}
		}
	}
} 

function leeCuadrantes(codigoUnidad, listado, nombreObjeto, multiple){
	cargaCuadrantes = 0;
	
	if (listado == false){
		document.getElementById(nombreObjeto).length = null;
		if (multiple == false ){		
			var datosOpcion = new Option("SELECCIONE OPCION ... ", 0, "", "");
			document.getElementById(nombreObjeto).options[0] = datosOpcion;
		}		
	}

	
	//alert(listado);
	if (listado == true) {var div = document.getElementById("listadoCuadrantes");}
	var objHttpXMLCuadrante = new AJAXCrearObjeto();	
	objHttpXMLCuadrante.open("POST","./xml/xmlCuadrantes/xmlListaCuadrantes.php",true);
	objHttpXMLCuadrante.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCuadrante.send(encodeURI("codigoUnidad="+codigoUnidad));
	objHttpXMLCuadrante.onreadystatechange=function()
	{
		if(objHttpXMLCuadrante.readyState == 4)
		{       
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
				//alert(listado);
				if (listado == true) {listadoCuadrantes = "<table width='100%' cellspacing='1' cellpadding='1'>";}
				else {//document.getElementById(nombreObjeto).length = null;
				}
				
				//alert(multiple);
				//if (multiple == true) document.getElementById(nombreObjeto).length = null;    
				
				for(i=0;i<xml.getElementsByTagName('cuadrante').length;i++){
					codigo 			= xml.getElementsByTagName('codigo')[i].text;
					descripcion 	= xml.getElementsByTagName('descripcion')[i].text;
					abreviatura 	= xml.getElementsByTagName('abreviatura')[i].text;
					
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
							//listadoCuadrantes += "<td width='10%'><div id='valorColumna'></div></td>";
							listadoCuadrantes += "</tr>";
						}
					} else {
						var puntero;
						if (!multiple) puntero = i+1;
						else puntero = i;
						//alert(puntero);
						
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
				} else {
					//var datosOpcion = new Option("OTRO", 0, "", "");
					//document.getElementById(nombreObjeto).options[puntero+1] = datosOpcion;
				}
				cargaCuadrantes = 1;
			}
		}
	}
} 