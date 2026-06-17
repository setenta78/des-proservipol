var cargaListadoAnimales;
var idCargaListadoAnimales;
var idAsignaSelectFichaAnimal;

function leeAnimales(unidad, campo, sentido){
	leeCaballos(unidad, campo, sentido);
	leePerros(unidad, campo, sentido);
}

function leeCaballos(unidad, campo, sentido){
	cargaListadoAnimales = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	
	if(document.getElementById('contieneHijos') !== null) var contieneHijos = document.getElementById("contieneHijos").value;
	else var contieneHijos = 0;
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoCaballos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Caballos ......</td>";
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlListaCaballos.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLAnimales.onreadystatechange=function(){
		//alert(objHttpXMLAnimales.readyState);
		if(objHttpXMLAnimales.readyState == 4){ 
			//alert(objHttpXMLAnimales.responseText);
			if (objHttpXMLAnimales.responseText != "VACIO"){
				//alert(objHttpXMLAnimales.responseText);
				var xml 				= objHttpXMLAnimales.responseXML.documentElement;
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var unidad	 		= "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var razaColor		= "";
				var pelaje			= "";
				var sexo			  = "";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var razaColor = "";
				var tipoAnimal ="";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoAnimales	= "";
				var seccion		= "";
				
				listadoAnimales = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('animal').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	   				= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					bcu	 		   				= (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
					unidad	   				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					fecha	 		 				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					raza							= (xml.getElementsByTagName('raza')[i].text||xml.getElementsByTagName('raza')[i].textContent||"");;
					color							= (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");;
					razaColor  				= raza + " " + color;
					pelaje	   				= (xml.getElementsByTagName('pelaje')[i].text||xml.getElementsByTagName('pelaje')[i].textContent||"");
					sexo	 		 				= (xml.getElementsByTagName('sexo')[i].text||xml.getElementsByTagName('sexo')[i].textContent||"");
				  estado	 	 				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
				  codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
				  desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
				  tipoAnimal 		 		= (xml.getElementsByTagName('tipoAnimal')[i].text||xml.getElementsByTagName('tipoAnimal')[i].textContent||"");
				  seccion		 		 		= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ANIMAL ...', '800', '375','fichaAnimal.php?codigoAnimal="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(tipoAnimal=="CABALLO"){
						var color1="maroon";
        	}else if(tipoAnimal=="PERRO POLICIAL"){
        		var color1="navy";
        	}else{
        		var color1="orange";
        	}
          
					if(contieneHijos == 1){
						listadoAnimales += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoAnimales += "<td width='4%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoAnimales += "<td width='10%' align='left'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
						listadoAnimales += "<td width='25%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
						listadoAnimales += "<td width='15%'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
						listadoAnimales += "<td width='13%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
						listadoAnimales += "<td width='15%' align='left'><font color="+color1+"><div id='valorColumna'>"+seccion+"</div></td>";
						listadoAnimales += "<td width='18%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoAnimales += "</tr>";
					}
					else{
						listadoAnimales += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoAnimales += "<td width='4%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoAnimales += "<td width='10%' align='left'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
						listadoAnimales += "<td width='33%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
						listadoAnimales += "<td width='20%'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
						listadoAnimales += "<td width='18%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
						listadoAnimales += "<td width='15%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoAnimales += "</tr>";
					}
				}
				if(xml.getElementsByTagName('animal').length==0){
					document.getElementById("tituloTipoAnimal").style.display = "none";
					document.getElementById("tipoAnimal").style.display = "none";
				}
				else{
					document.getElementById("tituloTipoAnimal").style.display = "block";
					document.getElementById("tipoAnimal").style.display = "block";
				}
				listadoAnimales += "</table>";
				div.innerHTML = listadoAnimales;
				cargaListadoAnimales = 1;
			}
		}
	}
}

function leePerros(unidad, campo, sentido){
	cargaListadoAnimales = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	
	if(document.getElementById('contieneHijos') !== null) var contieneHijos = document.getElementById("contieneHijos").value;
	else var contieneHijos = 0;
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoPerros");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Perros ......</td>";
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlListaPerros.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLAnimales.onreadystatechange=function(){
		//alert(objHttpXMLAnimales.readyState);
		if(objHttpXMLAnimales.readyState == 4){
			//alert(objHttpXMLAnimales.responseText);
			if (objHttpXMLAnimales.responseText != "VACIO"){
				//alert(objHttpXMLAnimales.responseText);
				var xml 				= objHttpXMLAnimales.responseXML.documentElement;
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var unidad	 		= "";
				var fecha	      = "";
				var razaColor		= "";
				var raza				= "";
				var color				= "";
				var pelaje			= "";
				var sexo			  = "";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var razaColor = "";
				var tipoAnimal ="";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoAnimales	= "";
				var seccion		= "";
				
				listadoAnimales = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('animal').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	   				= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					bcu	 		   				= (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
					unidad	   				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					fecha	 		 				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					raza							= (xml.getElementsByTagName('raza')[i].text||xml.getElementsByTagName('raza')[i].textContent||"");
					color							= (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");
					razaColor  				= raza + " " + color;
					pelaje	  			 	= (xml.getElementsByTagName('pelaje')[i].text||xml.getElementsByTagName('pelaje')[i].textContent||"");
					sexo	 		 				= (xml.getElementsByTagName('sexo')[i].text||xml.getElementsByTagName('sexo')[i].textContent||"");
				  estado	 	 				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
				  codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
				  desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
				  tipoAnimal 		 		= (xml.getElementsByTagName('tipoAnimal')[i].text||xml.getElementsByTagName('tipoAnimal')[i].textContent||"");
					seccion		 		 		= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
				  
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ANIMAL ...', '800', '375','fichaAnimal.php?codigoAnimal="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(tipoAnimal=="CABALLO"){
						var color1="maroon";   
					}else if(tipoAnimal=="PERRO POLICIAL"){
        		var color1="navy";
        	}else{
        		var color1="orange";
        	}
        	
					if(contieneHijos == 1){
						listadoAnimales += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoAnimales += "<td width='4%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoAnimales += "<td width='10%' align='left'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
						listadoAnimales += "<td width='25%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
						listadoAnimales += "<td width='15%'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
						listadoAnimales += "<td width='13%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
						listadoAnimales += "<td width='15%' align='left'><font color="+color1+"><div id='valorColumna'>"+seccion+"</div></td>";
						listadoAnimales += "<td width='18%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoAnimales += "</tr>";
					}
					else{
						listadoAnimales += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoAnimales += "<td width='4%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoAnimales += "<td width='10%' align='left'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
						listadoAnimales += "<td width='33%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
						listadoAnimales += "<td width='20%'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
						listadoAnimales += "<td width='18%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
						listadoAnimales += "<td width='15%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoAnimales += "</tr>";
					}
				}
				if(xml.getElementsByTagName('animal').length==0){
					document.getElementById("tituloTipoAnimal").style.display = "none";
					document.getElementById("tipoAnimal").style.display = "none";
				}
				else{
					document.getElementById("tituloTipoAnimal").style.display = "block";
					document.getElementById("tipoAnimal").style.display = "block";
				}
			}
			listadoAnimales += "</table>";
			div.innerHTML = listadoAnimales;
			cargaListadoAnimales = 1;
		}
	}
}

function leeAnimalesA(unidad, campo, sentido){
	leeCaballosAgregados(unidad, campo, sentido);
	leePerrosAgregados(unidad, campo, sentido);
}

function leeCaballosAgregados(unidad, campo, sentido){
	cargaListadoAnimales = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	
	if(document.getElementById('contieneHijos') !== null) var contieneHijos = document.getElementById("contieneHijos").value;
	else var contieneHijos = 0;
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoCaballos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Caballos ......</td>";
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlListaCaballosAgregados.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLAnimales.onreadystatechange=function(){
		//alert(objHttpXMLAnimales.readyState);
		if(objHttpXMLAnimales.readyState == 4){
			//alert(objHttpXMLAnimales.responseText);
			if (objHttpXMLAnimales.responseText != "VACIO"){
				//alert(objHttpXMLAnimales.responseText);
				var xml 				= objHttpXMLAnimales.responseXML.documentElement;
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var razaColor		= "";
				var pelaje			= "";
				var sexo			  = "";
				var estado      = "";
				var codUnidad		= "";
				var desUnidad		= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoAnimales	= "";
				var seccion		= "";
				var tipoAnimal ="";
				
				listadoAnimales = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('animal').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	   				= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					bcu	 		   				= (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
					fecha	 		 				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					raza							= (xml.getElementsByTagName('raza')[i].text||xml.getElementsByTagName('raza')[i].textContent||"");
					color							= (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");
					razaColor  				= raza + " " + color;
					sexo	 		 				= (xml.getElementsByTagName('sexo')[i].text||xml.getElementsByTagName('sexo')[i].textContent||"");
				  estado	 	 				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					pelaje	  			 	= (xml.getElementsByTagName('pelaje')[i].text||xml.getElementsByTagName('pelaje')[i].textContent||"");
					codUnidad	   			= (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					desUnidad	   			= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
					codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
				  desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
				  tipoAnimal 		 		= (xml.getElementsByTagName('tipoAnimal')[i].text||xml.getElementsByTagName('tipoAnimal')[i].textContent||"");
					seccion		 		 		= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ANIMAL ...', '800', '375','fichaAnimal.php?codigoAnimal="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
          
          if(tipoAnimal=="CABALLO"){
						var color1="maroon";
        	}else if(tipoAnimal=="PERRO POLICIAL"){
        		var color1="navy";
        	}else{
        		var color1="orange";
        	}
 					
					if (desUnidad != "") estadoMuestra += ", "+desUnidad;
 					
					listadoAnimales += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoAnimales += "<td width='4%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoAnimales += "<td width='15%'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
					listadoAnimales += "<td width='25%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
					listadoAnimales += "<td width='15%' align='left'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
					listadoAnimales += "<td width='18%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
					listadoAnimales += "<td width='23%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoAnimales += "</tr>";
				
				}
				if(xml.getElementsByTagName('animal').length==0){
					document.getElementById("tituloTipoAnimal").style.display = "none";
					document.getElementById("tipoAnimal").style.display = "none";
				}
				else{
					document.getElementById("tituloTipoAnimal").style.display = "block";
					document.getElementById("tipoAnimal").style.display = "block";
				}
				listadoAnimales += "</table>";
				div.innerHTML = listadoAnimales;
				cargaListadoAnimales = 1;
			}
		}
	}
}

function leePerrosAgregados(unidad, campo, sentido){
	cargaListadoAnimales = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	
	if(document.getElementById('contieneHijos') !== null) var contieneHijos = document.getElementById("contieneHijos").value;
	else var contieneHijos = 0;
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoPerros");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Perros ......</td>";
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlListaPerrosAgregados.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLAnimales.onreadystatechange=function(){
		//alert(objHttpXMLAnimales.readyState);
		if(objHttpXMLAnimales.readyState == 4){
			//alert(objHttpXMLAnimales.responseText);
			if (objHttpXMLAnimales.responseText != "VACIO"){
				//alert(objHttpXMLAnimales.responseText);
				var xml 				= objHttpXMLAnimales.responseXML.documentElement;
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var pelaje			= "";
				var sexo			  = "";
				var estado      = "";
				var codUnidad		= "";
				var desUnidad		= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var razaColor = "";
				var tipoAnimal ="";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoAnimales	= "";
				var seccion		= "";
				
				listadoAnimales = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('animal').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	   				= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					bcu	 		   				= (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
					fecha	 		 				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					raza							= (xml.getElementsByTagName('raza')[i].text||xml.getElementsByTagName('raza')[i].textContent||"");
					color							= (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");
					razaColor  				= raza + " " + color;
					sexo	 		 				= (xml.getElementsByTagName('sexo')[i].text||xml.getElementsByTagName('sexo')[i].textContent||"");
				  estado	 	 				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					pelaje	  			 	= (xml.getElementsByTagName('pelaje')[i].text||xml.getElementsByTagName('pelaje')[i].textContent||"");
					codUnidad	   			= (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					desUnidad					= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
					codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
				  desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
				  tipoAnimal 		 		= (xml.getElementsByTagName('tipoAnimal')[i].text||xml.getElementsByTagName('tipoAnimal')[i].textContent||"");
					seccion		 		 		= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
				  
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ANIMAL ...', '800', '375','fichaAnimal.php?codigoAnimal="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(tipoAnimal=="CABALLO"){
						var color1="maroon";
					}else if(tipoAnimal=="PERRO POLICIAL"){
        		var color1="navy";
        	}else{
        		var color1="orange";
        	}
        	
					if (desUnidad != "") estadoMuestra += ", "+desUnidad;
 					
					listadoAnimales += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoAnimales += "<td width='4%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoAnimales += "<td width='15%'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
					listadoAnimales += "<td width='25%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
					listadoAnimales += "<td width='15%' align='left'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
					listadoAnimales += "<td width='18%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
					listadoAnimales += "<td width='23%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoAnimales += "</tr>";
				}
				if(xml.getElementsByTagName('animal').length==0){
					document.getElementById("tituloTipoAnimal").style.display = "none";
					document.getElementById("tipoAnimal").style.display = "none";
				}
				else{
					document.getElementById("tituloTipoAnimal").style.display = "block";
					document.getElementById("tipoAnimal").style.display = "block";
				}
				listadoAnimales += "</table>";
				div.innerHTML = listadoAnimales;
				cargaListadoAnimales = 1;
			}
		}
	}
}

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";
	if (sentido == "desc") nuevoSentido = "asc";
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	
	if(document.getElementById("labColUnidad")!=null){
		leeAnimalesA(unidad, atributo, sentido);
	}
	else{
		leeAnimales(unidad, atributo, sentido);
	}
	
	switch(atributo){
		case "tipo":
			document.getElementById("labColNombre").innerHTML = "NOMBRE DEL ANIMAL";
			document.getElementById("labColColor").innerHTML = "RAZA/COLOR";
			document.getElementById("labColBCU").innerHTML = "NRO. BCU";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColTipo").innerHTML  = "TIPO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colTipo").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "nombre":
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColColor").innerHTML = "RAZA/COLOR";
			document.getElementById("labColBCU").innerHTML = "NRO. BCU";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColNombre").innerHTML = "NOMBRE DEL ANIMAL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "color":
			document.getElementById("labColNombre").innerHTML = "NOMBRE DEL ANIMAL";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColBCU").innerHTML = "NRO. BCU";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColColor").innerHTML = "RAZA/COLOR&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colColor").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "BCU":
			document.getElementById("labColNombre").innerHTML = "NOMBRE DEL ANIMAL";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColColor").innerHTML = "RAZA/COLOR";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColBCU").innerHTML = "NRO. BCU&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colBcu").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "seccion":
			document.getElementById("labColNombre").innerHTML = "NOMBRE DEL ANIMAL";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColColor").innerHTML = "RAZA/COLOR";
			document.getElementById("labColBCU").innerHTML = "NRO. BCU";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML  = "SECCION&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colSeccion").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			break;
			
		case "estado":
			document.getElementById("labColNombre").innerHTML = "NOMBRE DEL ANIMAL";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColColor").innerHTML = "RAZA/COLOR";
			document.getElementById("labColBCU").innerHTML = "NRO. BCU";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML  = "ESTADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colEstado").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			break;
			
		case "unidad":
			document.getElementById("labColNombre").innerHTML = "NOMBRE DEL ANIMAL";
			document.getElementById("labColTipo").innerHTML = "TIPO";
			document.getElementById("labColColor").innerHTML = "RAZA/COLOR";
			document.getElementById("labColBCU").innerHTML = "NRO. BCU";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML  = "UNIDAD ORIGEN&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colUnidad").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			break;
	}
	idCargaListadoAnimales = setInterval("tituloColumnaNormal("+columna.id+")",500);
}

function tituloColumnaNormal(columna){
	if (cargaListadoAnimales == 1){
		clearInterval(idCargaListadoAnimales);
		cambiarClase(columna,'nombreColumna');
	}
}

function eligeTipoAnimal(){
	tipo = document.getElementById("tipoAnimal").value;
	if(document.getElementById('contieneHijos') !== null) var contieneHijos = document.getElementById("contieneHijos").value;
	else var contieneHijos = 0;
	
	if(tipo=="Caballos"){
		document.getElementById("listadoCaballos").style.display = "block";
		document.getElementById("listadoPerros").style.display = "none";
	}
	else if(tipo=="Perros"){
		document.getElementById("listadoCaballos").style.display = "none";
		document.getElementById("listadoPerros").style.display = "block";
	}
	else{
		document.getElementById("listadoCaballos").style.display = "block";
		document.getElementById("listadoPerros").style.display = "block";
	}
}

function buscaDatosAnimal(){
	var bcuAnimal	= eliminarBlancos(document.getElementById("textNumeroBCU").value);
	if (bcuAnimal.length < 11){
		alert("EL CODIGO BCU DEBE ESTAR COMPUESTO DE 11 CARACTERES.      ");
		document.getElementById("textNumeroBCU").focus();
		return false;
	}
	
	if (bcuAnimal == ""){
		alert("DEBE INDICAR EL NUMERO BCU DEL ANIMAL ...... 	     ");
		document.getElementById("textNumeroBCU").value="";
		document.getElementById("textNumeroBCU").focus();
		return false;
	} else {
		document.getElementById("btnBuscarAnimal").value = "BUSCANDO ...";
		document.getElementById("btnBuscarAnimal").disabled = "true";
	 leeDatosAnimal('',bcuAnimal,1);
	}
}

function buscaCaballoL4(){
	var codigoAnimal = document.getElementById("textNumeroBCU").value;
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlBuscaCaballoL4.php",false);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI("codigoAnimal="+codigoAnimal));
	objHttpXMLAnimales.onreadystatechange=function(){
		if(objHttpXMLAnimales.readyState == 4){
			if (objHttpXMLAnimales.responseText != "VACIO"){
				//alert(objHttpXMLAnimales.responseText);
				var xml 				= objHttpXMLAnimales.responseXML.documentElement;
				var bcu		      = "";
				var nombre 			= "";
				var fecha				= "";
				var raza        = "";
				var codTipo     = "";
				var sexo        = "";
				var codSexo     = "";
				var pelaje      = "";
				var codPelaje   = "";
				var color       = "";
				var codColor    = "";
				
				for(i=0;i<xml.getElementsByTagName('animal').length;i++){
					bcu	 		   = (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
					nombre	   = (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					fecha	 		 = (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					raza	 		 = (xml.getElementsByTagName('raza')[i].text||xml.getElementsByTagName('raza')[i].textContent||"");
					sexo	 		 = (xml.getElementsByTagName('sexo')[i].text||xml.getElementsByTagName('sexo')[i].textContent||"");
					pelaje     = (xml.getElementsByTagName('pelaje')[i].text||xml.getElementsByTagName('pelaje')[i].textContent||"");
					color      = (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");
					
					if(raza=="MESTIZO" || raza=="FINA SANGRE INGLES" || raza=="HOLSTEINER"	
						|| raza=="HOLSTEINER X F.S.C." || raza=="ARABE" || raza=="HOLSTEINER X MESTIZO"	
						|| raza=="MESTIZO 1/4 MILLA" || raza=="FINA SANGRE INGLES X MESTIZO"	
						|| raza=="HACKNEY" || raza=="CHILENO" || raza=="PONY SHETLAND"	
						|| raza=="ARABE X MESTIZO"){
					 	codTipo=10;
					}else if(raza=="LABRADOR" || raza=="OVEJERO ALEMAN" || raza=="SCHNAUZER GIGANTE"	
						|| raza=="DOBERMAN PINSCHER"	|| raza=="COCKER SPANIEL" || raza=="DALMATA"	|| raza=="BRACO ALEMAN"	
						|| raza=="SETTER IRLANDES_"	|| raza=="PASTOR CANADIENSE" || raza=="SAN BERNARDO" || raza=="PASTOR BELGA"	
						|| raza=="FILA BRASILENO" || raza=="KOMONDOR" || raza=="WEIMARANE" || raza=="GOLDEN RETRIEVER"	
						|| raza=="GOLDADOR"){
						codTipo=40;
					}
					
					if(sexo==1){
						codSexo=10;
					}else if(sexo==2){
						codSexo=20;
					}
					
					if(pelaje==1){
						codPelaje=10;
					}else if(pelaje==2){
						codPelaje=20;
					}else if(pelaje==3){
						codPelaje=30;
					}
					
					if(color == 2 || color == 28){
						codColor=10;
					}else if(color == 3){
						codColor=20;
					}else if(color == 4){
						codColor=30;
					}else if(color == 5){
						codColor=40;
					}else if(color == 6){
						codColor=50;
					}else if(color == 7){
						codColor=60;
					}else if(color == 8){
						codColor=70;
					}else if(color == 9){
						codColor=80;
					}else if(color == 10){
						codColor=90;
					}else if(color == 1){
						codColor=100;
					}else if(color == 11){
						codColor=110;
					}else if(color == 12){
						codColor=120;
					}else if(color == 13){
						codColor=130;
					}else if(color == 14){
						codColor=140;
					}else if(color == 15){
						codColor=150;
					}else if(color == 16){
						codColor=160;
					}else if(color == 17){
						codColor=170;
					}else if(color == 18){
						codColor=180;
					}else if(color == 19){
						codColor=190;
					}else if(color == 20){
						codColor=200;
					}else if(color == 21){
						codColor=210;
					}else if(color == 22){
						codColor=220;
					}else if(color == 23){
						codColor=230;
					}else if(color == 24){
						codColor=240;
					}else if(color == 25){
						codColor=250;
					}else if(color == 26 || color == 27){
						codColor=260;
					}else{
						codColor=0;
					}
					
					document.getElementById("textNumeroBCU").readOnly = "true";
					document.getElementById("textNombre").value    = nombre;
					document.getElementById("textNumeroBCU").value = bcu;
					document.getElementById("textFechaNacimiento").value = fecha;
					document.getElementById("textRaza").value = raza;
					document.getElementById("selTipoAnimal").value = codTipo;
					document.getElementById("selSexo").value = codSexo;
					document.getElementById("selPelaje").value = codPelaje;
					document.getElementById("selColor").value = codColor;
					return true;
				}
			} else {
			return false;
			}
		}
	}
}

function leeDatosAnimal(codigoAnimal, bcuAnimal, tipo){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlDatosAnimal.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI("codigoAnimal="+codigoAnimal+"&bcuAnimal="+bcuAnimal));
	objHttpXMLAnimales.onreadystatechange=function(){
		//alert(objHttpXMLAnimales.readyState);
		if(objHttpXMLAnimales.readyState == 4){
			//alert(objHttpXMLAnimales.responseText);
			if (objHttpXMLAnimales.responseText != "VACIO"){
				//alert(objHttpXMLAnimales.responseText);
				var xml 			  = objHttpXMLAnimales.responseXML.documentElement;
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var pelaje			= "";
				var sexo			  = "";
				var fechaEstado	= "";
				var estado			 					= "";
				var unidadAnimal		  		= "";
				var descUnidadAnimal	  	= "";
        var fechaEstado			  		= "";
        var codigoUnidadAgregado  = "";
        var desUnidadAgregado  	  = "";
        var tipoAnimal 	  				= "";
        var tipoAnimalDescripcion = "";
        var verifica 							= "";
        var seccion 							= "";
				
				for(i=0;i<xml.getElementsByTagName('animal').length;i++){
					codigo	 	 						= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	   						= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					bcu	 		   						= (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
					unidad	   						= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					fecha	 		 						= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					raza	     						= (xml.getElementsByTagName('raza')[i].text||xml.getElementsByTagName('raza')[i].textContent||"");
					color 		 						= (xml.getElementsByTagName('color')[i].text||xml.getElementsByTagName('color')[i].textContent||"");
					pelaje	   						= (xml.getElementsByTagName('pelaje')[i].text||xml.getElementsByTagName('pelaje')[i].textContent||"");
					sexo	 		 						= (xml.getElementsByTagName('sexo')[i].text||xml.getElementsByTagName('sexo')[i].textContent||"");
					unidadAnimal 	 				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					descUnidadAnimal 			= (xml.getElementsByTagName('descUnidad')[i].text||xml.getElementsByTagName('descUnidad')[i].textContent||"");
	        fechaEstado 					= (xml.getElementsByTagName('fechaEstado')[i].text||xml.getElementsByTagName('fechaEstado')[i].textContent||"");
          codigoUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
          desUnidadAgregado 		= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
          estado	 		 					= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
          tipoAnimal 		 				= (xml.getElementsByTagName('tipoAnimal')[i].text||xml.getElementsByTagName('tipoAnimal')[i].textContent||"");
          tipoAnimalDescripcion = (xml.getElementsByTagName('tipoAnimalDescripcion')[i].text||xml.getElementsByTagName('tipoAnimalDescripcion')[i].textContent||"");
          verifica		 					= (xml.getElementsByTagName('verifica')[i].text||xml.getElementsByTagName('verifica')[i].textContent||"");
   		    seccion 		        	= (xml.getElementsByTagName('codigoSeccion')[i].text||xml.getElementsByTagName('codigoSeccion')[i].textContent||"");
					desSeccion 		        = (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					
					if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					if(sexo=='MACHO') sexo = 10;
					else sexo = 20;
					
					if(color=="") color=1;
					if(pelaje=="") pelaje=1;
					
					document.getElementById("textNumeroBCU").readOnly 		     	= "true";
					document.getElementById("idAnimal").value 			         	 	= codigo;
					document.getElementById("textNombre").value 			         	= nombre;
					document.getElementById("textFechaNacimiento").value       	= fecha;
					document.getElementById("textNumeroBCU").value 			       	= bcu;
					document.getElementById("textRaza").value 			           	= raza;
					document.getElementById("selColor").value 	 	             	= color;
					document.getElementById("selPelaje").value 	             		= pelaje;
					document.getElementById("selSexo").value                   	= sexo;
					document.getElementById("ultimaFecha").value 			    			= fechaEstado;
					document.getElementById("codigoUnidadAgregado").value 	 		= codigoUnidadAgregado;
					document.getElementById("textUnidadAgregado").value 	 			= desUnidadAgregado;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
				  document.getElementById("selTipoAnimal").value              = tipoAnimal;
				  document.getElementById("verificaOculto").value             = verifica;
				  
					if(document.getElementById("verificaOculto").value == "SI"){
						document.getElementById("verificar").checked="true";
						document.getElementById("verificar").disabled="true";
						document.getElementById("labConfirmar").disabled="";
						document.getElementById("labConfirmar").innerHTML = "VERIFICADO";
					}else{
						document.getElementById("verificar").checked="";
						document.getElementById("verificar").disabled="";
						document.getElementById("verificar").disabled="";
					}
					
					if (unidad == "") var habilitarBotones = false;
					else var habilitarBotones = true;
					
         	document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;
				 	var valoresAsignar = "'" + estado + "','" + seccion + "'," + habilitarBotones;
					idAsignaSelectFichaAnimal = setInterval("asignaValores("+valoresAsignar+")",500);
					
					if (tipo == "1"){
						document.getElementById("btnBuscarAnimal").value = "BUSCAR";
						document.getElementById("btnBuscarAnimal").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadAnimal){
							alert("ESTE ANIMAL YA PERTENECE A ESTA UNIDAD ...          ");
							top.Windows.closeAll();
						}
						
						if (unidadUsuario != unidadAnimal && unidadAnimal != ""){
							alert("NO PUEDE AGREGAR ESTE ANIMAL,\nYA QUE PERTENECE A LA " +descUnidadAnimal+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							top.Windows.closeAll();
						}
					}
				}
		}else {
				var caballoL4 = buscaCaballoL4();
				if(!caballoL4){
					alert("EL ANIMAL CON EL BCU INDICADO, NO SE ENCUENTRA EN LAS BASES DE DATOS          ");
					top.Windows.closeAll();
				}
				document.getElementById("mensajeCargando").style.display = "none";
				document.getElementById("btnBuscarAnimal").value = "BUSCAR";
				document.getElementById('btnGuardarAnimal').disabled = "";
			}
		}
	}
}

function asignaValores(estado, seccion, habilitarBotones){
	var permisoRegistrar = document.getElementById("permisoRegistrar").value;
	if (cargaEstadosRecurso == 1 ){
		clearInterval(idAsignaSelectFichaAnimal);
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value 				= estado;
		document.getElementById("estadoBaseDatos").value 	= estado;
		if(document.getElementById('contieneHijos') !== null){
			document.getElementById("selSeccion").value 		= seccion;
			document.getElementById("seccionBaseDatos").value 		= seccion;
		}
		
		if(permisoRegistrar) document.getElementById('btnGuardarAnimal').disabled = "";
		else habilitarBotones = false;
		
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
			document.getElementById('btnBaja').disabled = "";
		} else {
			document.getElementById("labFechaEstado").disabled= "";
			document.getElementById("textFechaNuevoEstado").disabled= "";
			document.getElementById("imagenCalendarioFichaAnimal").style.visibility = "visible";
			document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		}
		document.getElementById('btnCerrarFichaAnimal').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none";
	}
}

function validaContrasena(){
	var codigoAnimal = document.getElementById("idAnimal").value;
	var valida = document.getElementById("textContrasena").value;
	var contrasena = document.getElementById("contrasena").value;
	var cantidadServicio = controlEstadoAnimal();
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		activarBotones();
		return false;
	}
	if(valida == ""){
		document.getElementById("textContrasena").focus();
		alert("DEBE INGRESAR SU CLAVE DE USUARIO PROSERVIPOL");
		return false;
	}
	if (valida == contrasena){
		bajaAnimal(codigoAnimal);
	}
	else{
		document.getElementById("textTituloContrasena").innerHTML = "CONTRASE\u00D1A ERRONEA, VUELVA A INGRESAR SU CONTRASE\u00D1A PARA VALIDAR LA BAJA DEL ANIMAL:";
		document.getElementById("textContrasena").value = "";
	}
}

function validarBaja(){
	var valida = "";
	var msj=confirm("SACAR\u00C1 ESTE ANIMAL DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n\u00BFDESEA CONTINUAR?...");
	if (msj){
		activaVentanaIngresoContrasena();
	} else {
		activarBotones();
	}
}

function activaVentanaIngresoContrasena(){
	desactivarBotones();
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaIngresoContrasena").style.display  = "";
	document.getElementById("textTituloContrasena").innerHTML = "INGRESE SU CONTRASEÑA PARA VALIDAR LA BAJA DEL ANIMAL:";
}

function desactivaVentanaIngresoContrasena(){
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("ventanaIngresoContrasena").style.display  = "none";
}

function cerrarVentanaAnimal(){
	if (top.cargaListadoAnimales == 1){
		document.getElementById("cubreFondo").style.display = "none";
		clearInterval(idcargaListadoAnimales);
		top.Windows.closeAll();
	}
}

function desactivarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "true";
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardarAnimal").disabled = "true";
	document.getElementById("btnCerrarFichaAnimal").disabled = "true";
}

function activarBotones(){
	var permisoRegistrar = document.getElementById("permisoRegistrar").value;
	if(permisoRegistrar) {
		document.getElementById("btnDejarDisponible").disabled = "";
		document.getElementById("btnBaja").disabled = "";
		document.getElementById("btnGuardarAnimal").disabled = "";
	}
	document.getElementById("btnCerrarFichaAnimal").disabled = "";
}

function activaBuscaUnidadAgregado(){
	desactivarBotones();
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}

function activaVentanaIngresoFecha(boton){
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este Animal :";
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectiva la Baja de este Animal :";
}

function desactivaVentanaIngresoFecha(){
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("ventanaIngresoFecha").style.display  = "none";
}

function aceptaFechaVentanaIngresoFecha(){
	var ultimaFechaCargo = document.getElementById("ultimaFecha").value;
	var tipo 	= document.getElementById("textTipo").value;
	var fecha = document.getElementById("textFechaVentanaFecha").value;
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada	= top.document.getElementById("textUnidadBloqueada").value;
	
	if (fecha == ""){
		alert("DEBE INDICAR UNA FECHA ....");
		return false;
	}
	
	var comparaFechaLimite = comparaFecha(fechaLimite,fecha);
	if (unidadBloqueada == 1 && comparaFechaLimite == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
		return false;
	}
	
	var fechaMayor = comparaFecha(ultimaFechaCargo,fecha);
	if (fechaMayor == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaCargo);
		return false;
	}
	
	document.getElementById("ventanaIngresoFecha").style.display  = "none";
	document.getElementById("cubreVentana").style.display = "none";
	
	if (tipo == 1) liberaAnimal(document.getElementById("idAnimal").value);
	if (tipo == 2) validarBaja();
}

function liberaAnimal(codigoAnimal){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var cantidadServicio = controlEstadoAnimal();
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		activarBotones();
		return false;
	}
	
	var msj=confirm("SACAR\u00C1 ESTE ANIMAL DE LA OFERTA DE LA UNIDAD.                                       \n\u00BFDESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		var validaOk = true;
		if (validaOk){
			parametros += "codigoAnimal="+codigoAnimal;
			parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
			var objHttpXMLAnimales = new AJAXCrearObjeto();
			objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlLiberaAnimal.php",true);
			objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpXMLAnimales.send(encodeURI(parametros));
			objHttpXMLAnimales.onreadystatechange=function(){
				if(objHttpXMLAnimales.readyState == 4){
					if (objHttpXMLAnimales.responseText != "VACIO"){
						//alert(objHttpXMLAnimales.responseText);
						var xml = objHttpXMLAnimales.responseXML.documentElement;
						for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
							var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
							if (codigo == 1){
								alert('EL ANIMAL FUE DEJADO DISPONIBLE PARA OTRA UNIDAD ......        ');
								top.leeCaballos(unidadUsuario,'','');
								top.leePerros(unidadUsuario,'','');
							 	idcargaListadoAnimales = setInterval("cerrarVentanaAnimal()",1000);
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
						}
					}
				}
			}
		}
	} else {
		activarBotones();
	}
}

function bajaAnimal(codigoAnimal){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	desactivarBotones();
	
	var parametros = "";
	parametros += "codigoAnimal="+codigoAnimal;
	parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlBajaAnimal.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI(parametros));
	objHttpXMLAnimales.onreadystatechange=function(){
		if(objHttpXMLAnimales.readyState == 4){
			if (objHttpXMLAnimales.responseText != "VACIO"){
				//alert(objHttpXMLAnimales.responseText);
				var xml = objHttpXMLAnimales.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('EL ANIMAL FUE DADO DE BAJA ......        ');
						top.leeCaballos(unidadUsuario,'','');
						top.leePerros(unidadUsuario,'','');
					 	idcargaListadoAnimales = setInterval("cerrarVentanaAnimal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function guardarFichaAnimal(codigoAnimal){
	desactivarBotones();
	var cantidadServicio = controlEstadoAnimal();
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		activarBotones();
		return false;
	}
	var validaOk = validarFichaAnimal();
	var codigoAnimal = document.getElementById("idAnimal").value;
	if (validaOk){
		if (codigoAnimal != "") {
			var msj=confirm("ATENCI\u00D3N :\nSE MODIFICAR\u00C1N LOS DATOS DE ESTE ANIMAL EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizarAnimal(codigoAnimal);
			else activarBotones();
		}
		else {
			var msj=confirm("ATENCI\u00D3N :\nSE INGRESAR\u00C1N LOS DATOS DE ESTE ANIMAL EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoAnimal();
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}

function actualizarAnimal(codigoAnimal){
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
	var numeroBCU			= document.getElementById("textNumeroBCU").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	var nombre      = document.getElementById("textNombre").value;
	var raza				= document.getElementById("textRaza").value;
	var color				= document.getElementById("selColor").value;
	var pelaje			= document.getElementById("selPelaje").value;
	var tipoAnimal  = document.getElementById("selTipoAnimal").value;
  var verificar = document.getElementById("verificar").value;
	var verificaOculto = document.getElementById("verificaOculto").value;
	
	if(document.getElementById('contieneHijos') !== null) var seccion				 = document.getElementById("selSeccion").value;
  else var seccion = 0;
	
	var parametros = "";
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado+"&codigoAnimal="+codigoAnimal;
	parametros += "&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado;
	parametros += "&raza="+raza+"&color="+color+"&pelaje="+pelaje+"&nombre="+nombre+"&tipoAnimal="+tipoAnimal;
	parametros += "&verificar="+verificar+"&verificaOculto="+verificaOculto+"&seccion="+seccion;
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlActualizaAnimal.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI(parametros));
	objHttpXMLAnimales.onreadystatechange=function(){
		if(objHttpXMLAnimales.readyState == 4){
		//alert(objHttpXMLAnimales.responseText);
			if (objHttpXMLAnimales.responseText != "VACIO"){
			//alert(objHttpXMLAnimales.responseText);
			var xml = objHttpXMLAnimales.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						document.getElementById("estadoBaseDatos").value = estado;
						top.leeCaballos(unidadUsuario,'','');
						top.leePerros(unidadUsuario,'','');
						idcargaListadoAnimales = setInterval("cerrarVentanaAnimal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function nuevoAnimal(){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
	var numeroBCU		= document.getElementById("textNumeroBCU").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	var nombre      = document.getElementById("textNombre").value;
	var raza				= document.getElementById("textRaza").value;
	var color				= document.getElementById("selColor").value;
	var pelaje			= document.getElementById("selPelaje").value;
	var nacimiento  = document.getElementById("textFechaNacimiento").value;
	var sexo        = document.getElementById("selSexo").value;
	var tipoAnimal  = document.getElementById("selTipoAnimal").value;
	var verificar = document.getElementById("verificar").value;
	var verificaOculto = document.getElementById("verificaOculto").value;
	
	var parametros = "";
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado;
	parametros += "&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado+"&sexo="+sexo;
	parametros += "&raza="+raza+"&color="+color+"&pelaje="+pelaje+"&nombre="+nombre+"&nacimiento="+nacimiento+"&tipoAnimal="+tipoAnimal;
	parametros += "&verificar="+verificar+"&verificaOculto="+verificaOculto;
	
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	objHttpXMLAnimales.open("POST","./xml/xmlAnimales/xmlNuevoAnimal.php",true);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI(parametros));
	objHttpXMLAnimales.onreadystatechange=function(){
		if(objHttpXMLAnimales.readyState == 4){       
			if (objHttpXMLAnimales.responseText != "VACIO"){
			//alert(objHttpXMLAnimales.responseText);
				var xml = objHttpXMLAnimales.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeCaballos(unidadUsuario,'','');
						 top.leePerros(unidadUsuario,'','');
						 idcargaListadoAnimales = setInterval("cerrarVentanaAnimal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function validarFichaAnimal(){
	var estado				 = document.getElementById("selEstado").value;
	var fechaEstado			 = document.getElementById("textFechaNuevoEstado").value;
	var ultimaFechaEstado	 = document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	var color				 = document.getElementById("selColor").value;
	var pelaje				 = document.getElementById("selPelaje").value;
	var sexo				 = document.getElementById("selSexo").value;
	var animal				 = document.getElementById("selTipoAnimal").value;
	var codigoAnimal = document.getElementById("idAnimal").value;
	var verificaOculto = document.getElementById("verificaOculto").value;
	var validaCheck = document.getElementById("verificar");
	
	if(document.getElementById("contieneHijos").value==1){
		var seccion				= document.getElementById("selSeccion").value;
		var tipoUnidad	  = document.getElementById("tipoUnidad").value;
  	var contieneHijos = document.getElementById("contieneHijos").value;
	}
	else {
		var seccion				= 0;
		var tipoUnidad	  = 0;
  	var contieneHijos = 0;
	}
	
	if (estado == 0) {
		alert("DEBE INDICAR EL ESTADO DEL ANIMAL ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	
	if (animal == 0) {
		alert("DEBE INDICAR EL TIPO DE ANIMAL ...... 	     ");
		document.getElementById("selTipoAnimal").focus();
		return false;
	}
	
	if (!validaCheck.checked) {
		alert("DEBE VERIFICAR EL ESTADO DEL ANIMAL ...... 	     ");
		return false;
	}
	
	if (seccion == 0 && contieneHijos==1) {
		alert("DEBE INDICAR LA SECCION ...... 	     ");
		document.getElementById("selSeccion").focus();
		return false;
	}
	
	if(document.getElementById("seccionBaseDatos").value!="")	var seccionBaseDatos = document.getElementById("seccionBaseDatos").value;
	else var seccionBaseDatos = "";
	
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ||
		document.getElementById("codigoUnidadAgregado").value != document.getElementById("codUnidadAgregadoBaseDatos").value ||
		seccion != seccionBaseDatos){
		if (fechaEstado == ""){
			alert("DEBE INDICAR FECHA DEL NUEVO ESTADO ...... 	     ");
			return false;
		}
		
		var comparaFechaLimite = comparaFecha(fechaLimite,fechaEstado);
		if (unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
		}
		
		var fechaMayor = comparaFecha(ultimaFechaEstado,fechaEstado);
		if (fechaMayor == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado);
			return false;
		}
		
		if (estado == 3000 && codigoUnidadAgregado == ""){
			alert("DEBE INDICAR UNIDAD A LA QUE EL ANIMAL SE FUE AGREGADO...... 	     ");
			return false;
		}
	}
	return true;
}

function activaFechaNuevoEstado(){
	
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value || (document.getElementById("selSeccion").value != document.getElementById("seccionBaseDatos").value)){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaAnimal").style.visibility = "visible"; 
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		
		if (document.getElementById("selEstado").value == 3000){
			document.getElementById("labUnidadAgregado").disabled= "";
			document.getElementById("textUnidadAgregado").disabled= "";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "";
			document.getElementById("btnUnidades").disabled= "";
		} else {
			document.getElementById("codigoUnidadAgregado").value= "";
			document.getElementById("textUnidadAgregado").value= "";
			document.getElementById("labUnidadAgregado").disabled= "true";
			document.getElementById("textUnidadAgregado").disabled= "true";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "#E6E6E6";
			document.getElementById("btnUnidades").disabled= "yes";
		}
	} else {
		document.getElementById("labFechaEstado").disabled= "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaAnimal").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
		document.getElementById("labDocumentoEstado").disabled = true;
		document.getElementById("textDocumentoNuevoEstado").value = "";
		document.getElementById("textDocumentoNuevoEstado").disabled = true;
		document.getElementById("textDocumentoNuevoEstado").style.backgroundColor = "#E6E6E6";
		
		if (document.getElementById("selEstado").value == 3000){
			document.getElementById("labUnidadAgregado").disabled= "";
			document.getElementById("textUnidadAgregado").disabled= "";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "";
			document.getElementById("btnUnidades").disabled= "";
			document.getElementById("codigoUnidadAgregado").value= document.getElementById("codUnidadAgregadoBaseDatos").value;
			document.getElementById("textUnidadAgregado").value= document.getElementById("desUnidadAgregadoBaseDatos").value;
		} else {
			document.getElementById("labUnidadAgregado").disabled= "true";
			document.getElementById("textUnidadAgregado").disabled= "true";
			document.getElementById("textUnidadAgregado").style.backgroundColor = "#E6E6E6";
			document.getElementById("btnUnidades").disabled= "yes";
			document.getElementById("codigoUnidadAgregado").value= "";
			document.getElementById("textUnidadAgregado").value= "";
		}
	}
}

function controlEstadoAnimal(){
	var fechaV = document.getElementById("textFechaVentanaFecha").value;
	var fechaE = document.getElementById("textFechaNuevoEstado").value;
  var fecha1 = "";
	
	if(fechaV == ""){
		 fecha1=fechaE;
	}else{
		 fecha1=fechaV;
	}
	
	var codigoAnimal = document.getElementById("idAnimal").value;
	var fecha2 			 = '01-01-3000';
	var mensaje			 = "";
	var objHttpXMLAnimales = new AJAXCrearObjeto();
	objHttpXMLAnimales.open("POST","./xml/xmlServicios/xmlListaServiciosPorAnimales.php",false);
	objHttpXMLAnimales.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnimales.send(encodeURI("codigoAnimal="+codigoAnimal+"&fecha1="+fecha1+"&fecha2="+fecha2));
	if (objHttpXMLAnimales.responseText != "VACIO"){
		//alert(objHttpXMLAnimales.responseText);
		var xml = objHttpXMLAnimales.responseXML.documentElement;
		mensaje += "NO PUEDE CAMBIAR DE ESTADO, PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		CantServicios = cantidadServiciosMostar;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad 	  = (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
	}
	return mensaje;
}