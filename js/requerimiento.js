var cargaListaSolicitudesEnTramite;
var idCargaListadoFuncionarios;
function cargaListaSolicitudesEnTramite(unidad){
	cargaListaSolicitudesEnTramite = 0;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaRequerimientos.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml					= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo				= "";
				var serie				= "";
				var tarjeta				= "";
				var imei				= "";
				var fecha				= "";
				var ide					= "";
				var diferencia			= "";
				var implicado			= "";
				var codMov				= "";
				var correlativo			= "";
				var LinkMovimiento		= "";
				var estado				= ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var sw					= 0;
				var fondoLinea			= "";
				var resaltarLinea		= "";
				var lineaSinResaltar	= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie				= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta				= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei				= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					ide					= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia			= (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					implicado			= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					codMov				= (xml.getElementsByTagName('codMov')[i].text||xml.getElementsByTagName('codMov')[i].textContent||"");
					correlativo			= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					resaltarLinea		= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudUnidad.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(codMov==60 || codMov==70 || codMov==80){
						var estadoNuevo="EN TRAMITE";
					}else{
						var estadoNuevo=estado;
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";
			}else if(estado=="REPARACION CON DEVOLUCION"){
				var color="blue";
			}else{
				var color="";
			}
			
			if(ide=='NULL NULL') var ide = "";
			if(ide=='NULL') var ide = "";
			
			var contador=correlativo-1;
			if(contador==0) contador=1;
			
			if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
			if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='20%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios	+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios	+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+contador+"</div></td>";
					listadoFuncionarios	+= "<td width='18%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estadoNuevo+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListaSolicitudesEnTramite = 1;
			var cantidadServicio = controlTemporizador(unidad);
			if(cantidadServicio == 1){
				var temporizador ="";
			} else{
					var temporizador ="";
				}
			}
		}
	}
}

var cargaListaSolicitudesCerradas;
function cargaListaSolicitudesCerradas(unidad){
	cargaListaSolicitudesCerradas = 0;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaRequerimientosCerradas.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 								= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var serie	 							= "";
				var tarjeta							= "";
				var imei								= "";
				var fecha   						= "";
				var ide   							= "";
				var diferencia 					= "";
				var implicado 					=	"";
				var codMov							=	"";
				var correlativo 				=	"";
				var LinkMovimiento			=	"";
				var estado      				= "";
				var codUnidadAgregado		= "";
				var desUnidadAgregado		= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 	= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 	= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
				  ide     	 	= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
				  diferencia  = (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
				  implicado	 	= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
				  codMov 	 		= (xml.getElementsByTagName('codMov')[i].text||xml.getElementsByTagName('codMov')[i].textContent||"");
				  correlativo	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudUnidad.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(codMov==60 || codMov==70 || codMov==80){
						var estadoNuevo="EN TRAMITE";
					}else{
						var estadoNuevo=estado;
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";
        	}else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}else{
        		var color="";
        	}
        	
        	if(ide=='NULL NULL')var ide = "";
        	if(ide=='NULL')var ide = "";
        	
        	var contador=correlativo-1;
        	if(contador==0)contador=1;
        		
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='20%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+contador+"</div></td>";
					listadoFuncionarios+= "<td width='18%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estadoNuevo+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListaSolicitudesCerradas = 1;
        var cantidadServicio = controlTemporizador(unidad);
        if(cantidadServicio == 1){
     			var temporizador ="";
        } else{
        	var temporizador ="";
        }
			}
		}
	}
}

var cargaListadoFuncionarios2;
var idCargaListadoFuncionarios2;
var idAsignaSelectFichaVehiculo2;
function leeFuncionarios2(unidad, campo, sentido){
	cargaListadoFuncionarios2 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientos.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 								= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var serie	 							= "";
				var tarjeta							= "";
				var imei								= "";
				var fecha   						= "";
				var unidad 							=	"";
				var ide   							= "";
				var diferencia   				= "";
				var implicado 					= "";
				var correlativo 				=	"";
				var linkMovimiento			=	"";
				var link2								=	"";
				var estado      				= "";
				var codUnidadAgregado		= "";
				var desUnidadAgregado		= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 	= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 	= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					ide     	 	= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia  = (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					implicado	 	= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					correlativo	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";   
        	}else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}else{
        		var color="";
        	}
        	
        	if(ide=='NULL NULL')var ide = "";
        	if(ide=='NULL')var ide = "";
        	if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        	if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        	if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        	
					var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios2 = 1;
			}
		}
	}
}

var cargaListadoFuncionarios21;
var idCargaListadoFuncionarios21;
var idAsignaSelectFichaVehiculo21;
function leeFuncionarios21(unidad, campo, sentido){
	cargaListadoFuncionarios21 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientosDerivadas.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
			//alert(objHttpXMLFuncionarios.responseText);
				var xml 								= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var serie	 							= "";
				var tarjeta							= "";
				var imei								= "";
				var fecha   						= "";
				var unidad 							=	"";
				var ide   							= "";
				var diferencia   				= "";
				var implicado 					= "";
				var correlativo 				=	"";
				var linkMovimiento			=	"";
				var link2								=	"";
				var estado      				= "";
				var codUnidadAgregado		= "";
				var desUnidadAgregado		= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 					= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 					= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 				= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 				= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					ide     	 				= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia    	 	= (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					implicado	 	 			= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					correlativo 	 		= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";
        	}else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}else{
        		var color="";
        	}
        	
        	if(ide=='NULL NULL')var ide = "";
        	if(ide=='NULL')var ide = "";
        	if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        	
        	var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios	+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios	+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios	+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios21 = 1;  
			}
		}
	}
}

var cargaListadoFuncionarios24;
var idCargaListadoFuncionarios24;
var idAsignaSelectFichaVehiculo24;
function leeFuncionarios24(unidad, campo, sentido){
	cargaListadoFuncionarios24 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientosCerradas.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 								= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var serie	 							= "";
				var tarjeta							= "";
				var imei								= "";
				var fecha   						= "";
				var unidad 							=	"";
				var ide   							= "";
				var diferencia   				= "";
				var implicado 					= "";
				var correlativo 				=	"";
				var linkMovimiento			=	"";
				var link2								=	"";
				var estado      				= ""; 
				var codUnidadAgregado		= "";
				var desUnidadAgregado		= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 	= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 	= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					ide     	 	= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia  = (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					implicado	 	= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					correlativo	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";   
        	}else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}else{
        		var color="";
        	}
        		
        	if(ide=='NULL NULL')	var ide = "";
        	if(ide=='NULL')	var ide = "";
        	if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        	
        	var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios24 = 1;
			}
		}
	}
}

var cargaListadoFuncionarios3;
var idCargaListadoFuncionarios3;
function leeFuncionarios3(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios3 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaIngenieroRequerimientos.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	console.log("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario);
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 								= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var serie	 							= "";
				var tarjeta							= "";
				var imei								= "";
				var fecha   						= "";
				var unidad 							=	"";
				var implicado 					=	"";
				var deriva 							=	"";
				var ide   							= "";
				var diferencia					=	"";
				var correlativo					=	"";
				var estado      				= ""; 
				var codUnidadAgregado		= "";
				var desUnidadAgregado		= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 					= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 					= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 				= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 				= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					implicado	 	 			= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					ide     	 				= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia    	 	= (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					correlativo 	 		= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					deriva 	         	= (xml.getElementsByTagName('deriva')[i].text||xml.getElementsByTagName('deriva')[i].textContent||"");
					
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";
        	}else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}else{
        		var color="";
        	}
        	
        	if(ide=='NULL NULL')var ide = "";
        	if(ide=='NULL')var ide = "";
        	if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        	if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        	
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios3 = 1;
			}
		}
	}
}

var cargaListadoFuncionarios26;
var idCargaListadoFuncionarios26;
function leeFuncionarios26(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios26 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaIngenieroRequerimientosCerradas.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));  
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 								= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var serie	 							= "";
				var tarjeta							= "";
				var imei								= "";
				var fecha   						= "";
				var unidad 							=	"";
				var implicado 					=	"";
				var deriva 							=	"";
				var ide   							= "";
				var diferencia					=	"";
				var correlativo					=	"";
				var estado      				= "";
				var codUnidadAgregado		= "";
				var desUnidadAgregado		= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoFuncionarios	= "";
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 	= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 	= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					implicado	 	= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					ide     	 	= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia  = (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					correlativo	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					deriva 	    = (xml.getElementsByTagName('deriva')[i].text||xml.getElementsByTagName('deriva')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";
        	}else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}else{
        		var color="";
        	}
        	
        	if(ide=='NULL NULL')var ide = "";
        	if(ide=='NULL')var ide = "";
        	
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios	+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios	+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios	+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios26 = 1;
			}
		}
	}
}

var cargaListadoFuncionarios4;
var idCargaListadoFuncionarios4;
function leeFuncionarios4(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios4 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaOpuRequerimientos.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 								= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var serie	 							= "";
				var tarjeta							= "";
				var imei								= "";
				var fecha   						= "";
				var unidad 							=	"";
				var implicado 					=	"";
				var deriva 							=	"";
				var ide   							= "";
				var correlativo					=	"";
				var estado      				= "";
				var codUnidadAgregado		= "";
				var desUnidadAgregado		= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 	= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 	= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					implicado	 	= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					ide     	 	= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					correlativo	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					deriva 	    = (xml.getElementsByTagName('deriva')[i].text||xml.getElementsByTagName('deriva')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					if(desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";
        	}	else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}	else	{
        		var color="";
        	}
        	
        	if(ide=='NULL NULL')var ide = "";
        	if(ide=='NULL')var ide = "";
        	if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        	if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        	
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='38%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios4 = 1;
			}
		}
	}
}

var cargaListadoFuncionarios27;
var idCargaListadoFuncionarios27;
function leeFuncionarios27(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios27 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaOpuRequerimientosCerradas.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 							= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 					= "";
				var serie	 						= "";
				var tarjeta						= "";
				var imei							= "";
				var fecha   					= "";
				var unidad 						="";
				var implicado 				="";
				var deriva 						="";
				var ide   						= "";
				var correlativo				="";
				var estado      			= ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var sw 				 				= 0;
				var fondoLinea		 		= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 	= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 	= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					implicado	 	= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					ide     	 	= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					correlativo	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					deriva 	    = (xml.getElementsByTagName('deriva')[i].text||xml.getElementsByTagName('deriva')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '820','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if(estado.length > 29){
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=="REPARACION SIN DEVOLUCION"){
						var color="red";   
        	}else if(estado=="REPARACION CON DEVOLUCION"){
        		var color="blue";
        	}else{
        		var color="";
        	}
        	
					if(ide=='NULL NULL')var ide = "";
					if(ide=='NULL')var ide = "";
        	
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='38%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios27 = 1;
			}
		}
	}
}

function leedatosUsuario(unidad,usuario){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlVista.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&usuario="+usuario));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
			  //alert(objHttpXMLFuncionarios.responseText);
				var xml 			= objHttpXMLFuncionarios.responseXML.documentElement;
				var unidad	 		= "";
				var destacamento 	= "";
				var funcionario	 	= "";
				var nombre 	     	= "";
				var tipo			= "";
				var grado			= "";
				
				for(i=0;i<xml.getElementsByTagName('vista').length;i++){
					
					unidad			= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					destacamento	= (xml.getElementsByTagName('destacamento')[i].text||xml.getElementsByTagName('destacamento')[i].textContent||"");
					funcionario		= (xml.getElementsByTagName('funcionario')[i].text||xml.getElementsByTagName('funcionario')[i].textContent||"");
					nombre			= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					tipo			= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					grado			= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					
					document.getElementById("unidadUsuario").value	=unidad;
					document.getElementById("codFun").value	=funcionario;
					document.getElementById("nom").value	=nombre;
					document.getElementById("perfil").value	=tipo;
					document.getElementById("grado").value	=grado;
					document.getElementById("mensajeCargando").style.display = "none";
				}
			}
		}
	}
}

function leedatosSolicitudUnidad(unidad,solicitud,usuario,tipoUnidad){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlDatoUsuarioSolicitud.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("unidad="+unidad+"&solicitud="+solicitud+"&usuario="+usuario+"&tipoUnidad="+tipoUnidad);
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&solicitud="+solicitud));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
			  //alert(objHttpXMLFuncionarios.responseText);
				var xml 				      = objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo            = "";
				var unidad            = "";
				var tipoRequerimiento = "";
				var problema          = "";
				var observacion       = ""; 
				var fechaInicio       = "";
				var fechaTermino      = "";
				var estado            = "";
				var zona	            = "";
				var prefectura        = "";
				var comisaria 	      = "";
				var destacamento 	    = "";
				var funcionario	      = "";
				var nombre 	          = "";
				var tipo 	            = "";
				var grado             = "";
				var obs               = "";
				var ide1              = "";
				var ide2              = "";
				var texto             = "";
				var mov               = "";
				var secciones         = "";
									
				for(i=0;i<xml.getElementsByTagName('dato').length;i++){
				
				//zona	           	= (xml.getElementsByTagName('zona')[i].text||xml.getElementsByTagName('zona')[i].textContent||"");
				//prefectura      	= (xml.getElementsByTagName('prefectura')[i].text||xml.getElementsByTagName('prefectura')[i].textContent||"");
				//comisaria 	     	= (xml.getElementsByTagName('comisaria')[i].text||xml.getElementsByTagName('comisaria')[i].textContent||"");
				//destacamento    	= (xml.getElementsByTagName('destacamento')[i].text||xml.getElementsByTagName('destacamento')[i].textContent||"");
				funcionario     	= (xml.getElementsByTagName('funcionario')[i].text||xml.getElementsByTagName('funcionario')[i].textContent||"");
				nombre          	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
				tipo            	= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
				grado           	= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
				tipoRequerimiento = (xml.getElementsByTagName('subproblema')[i].text||xml.getElementsByTagName('subproblema')[i].textContent||"");
				problema          = (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
				obs               = (xml.getElementsByTagName('obs')[i].text||xml.getElementsByTagName('obs')[i].textContent||"");
				ide1              = (xml.getElementsByTagName('ide1')[i].text||xml.getElementsByTagName('ide1')[i].textContent||"");
				ide2              = (xml.getElementsByTagName('ide2')[i].text||xml.getElementsByTagName('ide2')[i].textContent||"");
				texto             = (xml.getElementsByTagName('text')[i].text||xml.getElementsByTagName('text')[i].textContent||"");
				mov              	= (xml.getElementsByTagName('mov')[i].text||xml.getElementsByTagName('mov')[i].textContent||"");
				secciones        	= (xml.getElementsByTagName('secciones')[i].text||xml.getElementsByTagName('secciones')[i].textContent||"");
				
       	if(ide1=="NULL") var ide1="";
       	if(ide2=="NULL") var ide2="";
       	
       	if(mov==20 || mov==30 || mov==40 || mov==50 || mov==100){
       		document.getElementById("obs1").disabled = "true";
					desactivarBotones2();
				}
        
        document.getElementById("movimiento").value	=mov;
        
        if(mov==70 || mov==80){
        	document.getElementById("btnGuardarOrganizacion2").disabled = "true";
        	document.getElementById("obs1").disabled = "true";
        }
        
        if(mov==20 || mov==90 || mov==100){
        	document.getElementById("obs1").disabled = "true";
        }
        
        if(mov==20){
        	document.getElementById("textTipoUsuario").disabled = "true";
          document.getElementById("tipoDeUsuario").disabled = "true";
          document.getElementById("selTipoServicio").disabled = "true";
          document.getElementById("textDia2").disabled = "true";
          document.getElementById("selServicio").disabled = "true";
        }
        
        document.getElementById("codFun").value	=funcionario;
				document.getElementById("nom").value	=nombre;
				document.getElementById("perfil").value	=tipo;
				document.getElementById("grado").value	=grado;
				document.getElementById("secciones").value	=secciones;
				document.getElementById("obs1").value	=texto.toUpperCase();
				document.getElementById("valor2").value=tipoRequerimiento;
				document.getElementById("id1").value=ide1;
				document.getElementById("id2").value=ide2;
				document.getElementById("textTipoUsuario").value=ide1;
				document.getElementById("tipoDeUsuario").value 	= ide2;
				document.getElementById("textDia2").value=ide1;
				
				if(tipoRequerimiento==190 || tipoRequerimiento==200 || tipoRequerimiento==370) document.getElementById("id2").style.visibility = 'hidden';
				
				var descUnidad=document.getElementById("descUnidad").value;
				if(tipoRequerimiento==370) document.getElementById("id1").value = descUnidad;

				if(mov!=10){
					document.getElementById("id1").disabled = true;
					document.getElementById("id2").disabled = true;
				}
 				document.getElementById("obs").value = texto;	
				var valoresAsignar = "'" + tipoRequerimiento + "','" + problema+"',"+mov;
				leeSubproblemas(problema,'cboSubProblema');
				leeMovimiento2('cboMovimiento','10');
				idAsignaSelectFichaVehiculo3 = setInterval("asignaValores3("+valoresAsignar+")",200);
				document.getElementById("mensajeCargando").style.display = "none";
				}
			}
		}
	}
}

function asignaValores3(tipoRequerimiento,problema,mov){
	if (cargaSubproblema == 1 && cargaProblema == 1 && cargaMovimiento == 1){
		clearInterval(idAsignaSelectFichaVehiculo3);
		document.getElementById("cboSubProblema").value 	= tipoRequerimiento;
		document.getElementById("cboProblema").value 	= problema;
		document.getElementById("cboMovimiento").value 	= mov;
		
	  if((mov==10 && problema==10)||(mov==10 && problema==20)){ 		 
			hijomenor346();
		}else{
	   	hijomenor777();
    	identificador();
 			hijomenor3466();
  		hijomenor347();
  		hijomenor666();
		}
		
		if(mov==20){
			document.getElementById("idFec").style.display="none";
		}	
	}
}

function leedatosSolicitud(unidad,codigo){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlDatoSolicitud.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&codigo="+codigo));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
			  //alert(objHttpXMLFuncionarios.responseText);		
				var xml 				      = objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo            = "";
				var unidad            = "";
				var tipoRequerimiento = "";
				var problema          = "";
				var observacion       = ""; 
				var fechaInicio       = "";
				var fechaTermino      = "";
				var estado            = "";
				var zona	            = "";
				var prefectura        = "";
				var comisaria 	      = "";
				var destacamento 	    = "";
				var funcionario	      = "";
				var nombre 	          = "";
				var tipo 	            = "";
				var grado             = "";
				var usuario           = "";
				var texto 						="";
				var ide1              = "";
				var ide2              = "";
										
				for(i=0;i<xml.getElementsByTagName('solicitud').length;i++){
					
					codigo            = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					unidad            = (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					tipoRequerimiento = (xml.getElementsByTagName('subproblema')[i].text||xml.getElementsByTagName('subproblema')[i].textContent||"");
					problema          = (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					observacion       = (xml.getElementsByTagName('observacion')[i].text||xml.getElementsByTagName('observacion')[i].textContent||"");
					usuario           = (xml.getElementsByTagName('usuario')[i].text||xml.getElementsByTagName('usuario')[i].textContent||"");
					nombre            = (xml.getElementsByTagName('nombreCompleto')[i].text||xml.getElementsByTagName('nombreCompleto')[i].textContent||"");
					tipo              = (xml.getElementsByTagName('tipoMovimiento')[i].text||xml.getElementsByTagName('tipoMovimiento')[i].textContent||"");
					grado             = (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					texto             = (xml.getElementsByTagName('text')[i].text||xml.getElementsByTagName('text')[i].textContent||"");
					ide1              = (xml.getElementsByTagName('ide1')[i].text||xml.getElementsByTagName('ide1')[i].textContent||"");
					ide2              = (xml.getElementsByTagName('ide2')[i].text||xml.getElementsByTagName('ide2')[i].textContent||"");
					
					document.getElementById("codFun").value	=usuario;
					document.getElementById("nom").value	=nombre;
					document.getElementById("grado").value	=grado;
					document.getElementById("obs").value = texto;
					
					if(ide1=="NULL") var ide1="";
       		if(ide2=="NULL") var ide2="";
       
       		if(tipo==30 || tipo==40 || tipo==50){
						desactivarBotones2();
					}
					
					document.getElementById("codFun").value	=usuario;
					document.getElementById("nom").value	=nombre;
					document.getElementById("grado").value	=grado;
					document.getElementById("obs1").value	=texto.toUpperCase();
					document.getElementById("textUnidad").value = ide1;
					document.getElementById("textDia").value = ide2;
					document.getElementById("textUnidad2").value=ide1;
					document.getElementById("textServicio").value=ide2;
					document.getElementById("textFunc").value=ide1;
					document.getElementById("textRut").value=ide2;
					document.getElementById("textFunc2").value= ide1;    
          document.getElementById("textDia2").value= ide2;     
          document.getElementById("textFunc3").value = ide1;   
          document.getElementById("textRut2").value= ide2;     
          document.getElementById("textFunc4").value= ide1;    
          document.getElementById("textRut3").value= ide2;     
          document.getElementById("textFunc5").value= ide1;    
          document.getElementById("textNombre").value= ide2;   
          document.getElementById("textFunc6").value = ide1;   
          document.getElementById("textUnidad3").value	= ide2;
          document.getElementById("textFunc7").value= ide1;    
          document.getElementById("textUsu").value= ide2;  
          document.getElementById("textFunc8").value= ide1;
          document.getElementById("textFunc9").value  = ide1;
          document.getElementById("textFunc10").value  = ide1;
          document.getElementById("textFolio").value = ide2;
          document.getElementById("textFunc11").value  = ide1;
          document.getElementById("textFolio2").value= ide2;
          document.getElementById("textBcu").value  = ide1;
          document.getElementById("textTipoAni").value	= ide2;
          document.getElementById("textBcu2").value= ide1;
          document.getElementById("textDia3").value= ide1;
          document.getElementById("textBcu3").value	= ide2;
          document.getElementById("textBcu4").value	= ide2;
          document.getElementById("textBcu5").value  = ide1;
          document.getElementById("textPatente").value	= ide2;
          document.getElementById("textBcu6").value= ide1;
          document.getElementById("textDia4").value= ide2;
          document.getElementById("textBcu7").value= ide1;
          document.getElementById("textPatente2").value= ide2; 
          document.getElementById("textPatente3").value= ide1;
          document.getElementById("textBcu8").value	= ide2;
          document.getElementById("textSerie").value	 = ide1;
          document.getElementById("textTarjeta").value	= ide2;
          document.getElementById("textSerie2").value= ide1;
          document.getElementById("textDia5").value= ide2;
          document.getElementById("textSerie3").value = ide1;
          document.getElementById("textSerie4").value= ide2;
          document.getElementById("textSerie5").value = ide1;
          document.getElementById("textModelo").value= ide2;
          document.getElementById("textSerie6").value= ide1;
          document.getElementById("textDia6").value= ide2;
          document.getElementById("textSerie7").value = ide1;
          document.getElementById("textSerie8").value = ide2;
          document.getElementById("textDescUni").value= ide1;
          document.getElementById("textDescUni2").value= ide2;
          document.getElementById("textUnidad4").value  = ide1;
        document.getElementById("codigoMovimiento").value = tipo;
				
				var valoresAsignar = "'" + tipoRequerimiento + "','" + problema + "',"+ tipo;
				leeSubproblemas(problema,'cboSubProblema');
				idAsignaSelectFichaVehiculo2 = setInterval("asignaValores("+valoresAsignar+")",200);
				document.getElementById("mensajeCargando").style.display = "none";
				}
			}
		}
	}
}

function asignaValores(tipoRequerimiento,problema,tipo){
	if (cargaSubproblema == 1 && cargaProblema == 1 && cargaMovimiento == 1){
		clearInterval(idAsignaSelectFichaVehiculo2);
		document.getElementById("cboSubProblema").value	= tipoRequerimiento;
		document.getElementById("cboProblema").value 		= problema;
		document.getElementById("cboMovimiento").value 	= tipo;
		hijomenor();
		hijomenor2();	
	}
}

function leedatosMovimiento(unidad,codigo){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	//div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlDatoMovimiento.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&codigo="+codigo));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
			 // alert(objHttpXMLFuncionarios.responseText);		
				var xml 				      	= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo            	= "";
				var unidad            	= "";
				var tipoRequerimiento 	= "";
				var problema          	= "";
				var observacion       	= "";
				var fechaInicio       	= "";
				var fechaTermino      	= "";
				var estado            	= "";
				var zona	            	= "";
				var prefectura        	= "";
				var comisaria 	      	= "";
				var destacamento 	    	= "";
				var funcionario	      	= "";
				var nombre 	          	= "";
				var tipo 	            	= "";
				var grado             	= "";
				var usuario           	= "";
				var texto 							=	"";
				var ide1              	= "";
				var ide2              	= "";
				var listadoFuncionarios	= "";
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				for(i=0;i<xml.getElementsByTagName('solicitud').length;i++){
					codigo            = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					unidad            = (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					tipoRequerimiento = (xml.getElementsByTagName('subproblema')[i].text||xml.getElementsByTagName('subproblema')[i].textContent||"");
					problema          = (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					observacion       = (xml.getElementsByTagName('observacion')[i].text||xml.getElementsByTagName('observacion')[i].textContent||"");
					usuario           = (xml.getElementsByTagName('usuario')[i].text||xml.getElementsByTagName('usuario')[i].textContent||"");
		      nombre            = (xml.getElementsByTagName('nombreCompleto')[i].text||xml.getElementsByTagName('nombreCompleto')[i].textContent||"");
		      tipo              = (xml.getElementsByTagName('tipoMovimiento')[i].text||xml.getElementsByTagName('tipoMovimiento')[i].textContent||"");
		      grado             = (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
		      texto             = (xml.getElementsByTagName('text')[i].text||xml.getElementsByTagName('text')[i].textContent||"");
		      ide1              = (xml.getElementsByTagName('ide1')[i].text||xml.getElementsByTagName('ide1')[i].textContent||"");
					ide2              = (xml.getElementsByTagName('ide2')[i].text||xml.getElementsByTagName('ide2')[i].textContent||"");
					
					var nroLinea = i + 1;
					listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
					listadoFuncionarios += "<tr id='"+nroLinea+"'>";
					listadoFuncionarios += "<td width='4%' align='center'><textarea name='resp' id='resp' rows='4' cols='50'>"+texto+"</textarea></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
   		}
  	}
 	}
}

function leeFuncionarios22(unidad,codigo){
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Movimientos ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientos2.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&codigo="+codigo));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var serie	 			= "";
				var tarjeta		= "";
				var imei		= "";
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				var texto="";
				var archivo="";
				var linkArchivo ="";
				var fechaArchivo ="";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1' border='0'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 			= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 			= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 		= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 		= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 		= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 		= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					ide     	 		= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia    = (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					implicado	 	 	= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					correlativo 	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					texto 	 			= (xml.getElementsByTagName('text')[i].text||xml.getElementsByTagName('text')[i].textContent||"");
					fInicio 			= (xml.getElementsByTagName('fInicio')[i].text||xml.getElementsByTagName('fInicio')[i].textContent||"");
					archivo 	 		= (xml.getElementsByTagName('archivo')[i].text||xml.getElementsByTagName('archivo')[i].textContent||"");
					fechaArchivo	= (xml.getElementsByTagName('fechaArchivo')[i].text||xml.getElementsByTagName('fechaArchivo')[i].textContent||"");
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
				 	linkArchivo		= '<a href="./archivos_solicitud/'+archivo+'" target="_blank" title='+"No:"+codigo+'> <img src="img/carpeta.png" width=15 height=15> </a>';
				 	var tex ="vxcxcvxc";
		      listadoFuncionarios += "<tr id='"+nroLinea+"'>";
          listadoFuncionarios += "<td width='4%' align=''><b>REGISTRO GENERADO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='estado' size='70' readonly='yes' value='"+implicado+"' style='background: #E6E6E6' style='color: grey'/></td>";
          listadoFuncionarios += "</tr>";
	        listadoFuncionarios += "<tr id='"+nroLinea+"'>";
          listadoFuncionarios += "<td width='4%' align=''><b>ESTADO DE LA SOLICITUD:</b>&nbsp;<input type='text' id='estado2' size='70' readonly='yes' value='"+estado+"' style='background: #E6E6E6' style='color: grey'/></td>";
					listadoFuncionarios += "</tr>";
					listadoFuncionarios += "<tr id='"+nroLinea+"'>";
					listadoFuncionarios += "<td width='4%' align=''><textarea name='resp1' id='resp1' rows='4' cols='50' style='background: #E6E6E6' style='color: grey' readonly>"+texto+"</textarea></td>";
					listadoFuncionarios += "</tr>";
					
					if(archivo!=""){
						listadoFuncionarios += "<tr>";
						listadoFuncionarios+= "<td width='4%' align='left'><b>ADJUNTO:</b>&nbsp;"+linkArchivo+" <b>SUBIDO</b> "+implicado+" <b>FECHA: </b>"+fechaArchivo+"</td>";
						listadoFuncionarios += "</tr>";
					}
				
					listadoFuncionarios += "<tr>";
					listadoFuncionarios += "<td width='4%' align=''><b>FECHA DE REGISTRO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='estado' size='12' readonly='yes' value='"+fInicio+"' style='background: #E6E6E6' style='color: grey'/></td>";
					listadoFuncionarios += "</tr>";
					listadoFuncionarios += "<tr>";
					listadoFuncionarios +="<td width='4%' align=''><hr size='1px' color='grey'/></td>";
					listadoFuncionarios += "</tr>";
				}
				
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
			}
		}
	}
}

function leeFuncionarios23(unidad,codigo){
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios2");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Movimientos ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientos3.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&codigo="+codigo));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var serie	 			= "";
				var tarjeta		= "";
				var imei		= "";
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				var texto="";
				var archivo="";
				var linkArchivo ="";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1' border='0'>";
        listadoFuncionarios += "<tr>";
				listadoFuncionarios += "<td>ARCHIVOS ADJUNTOS</td>";
				listadoFuncionarios += "</tr>";
				
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					fecha	 	 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					tarjeta	 	 	= (xml.getElementsByTagName('problema')[i].text||xml.getElementsByTagName('problema')[i].textContent||"");
					imei		 	 	= (xml.getElementsByTagName('fechaInicio')[i].text||xml.getElementsByTagName('fechaInicio')[i].textContent||"");
					estado	 	 	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad1	 	 	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					ide     	 	= (xml.getElementsByTagName('ide')[i].text||xml.getElementsByTagName('ide')[i].textContent||"");
					diferencia	= (xml.getElementsByTagName('dif')[i].text||xml.getElementsByTagName('dif')[i].textContent||"");
					implicado		= (xml.getElementsByTagName('implicado')[i].text||xml.getElementsByTagName('implicado')[i].textContent||"");
					correlativo	= (xml.getElementsByTagName('corr')[i].text||xml.getElementsByTagName('corr')[i].textContent||"");
					texto 	 		= (xml.getElementsByTagName('text')[i].text||xml.getElementsByTagName('text')[i].textContent||"");
					fInicio 	 	= (xml.getElementsByTagName('fInicio')[i].text||xml.getElementsByTagName('fInicio')[i].textContent||"");
					archivo 	 	= (xml.getElementsByTagName('archivo')[i].text||xml.getElementsByTagName('archivo')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					var nroLinea = i + 1;
					if(archivo!=""){
					  linkArchivo		= '<a href="./archivos_solicitud/'+archivo+'" target="_blank" title='+"No:"+codigo+'> <img src="img/carpeta.png" width=15 height=15> </a>';
			  		listadoFuncionarios += "<tr id='"+nroLinea+"'>";
	          listadoFuncionarios+= "<td width='4%' align='left'><div id='valorColumna'>"+correlativo+" "+linkArchivo+"</td>";
						listadoFuncionarios += "</tr>";
   				}
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
			}
		}
	}
}

function nuevoDioscar(){
	var codigo         	= document.getElementById("codigo").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
	var problema	  = document.getElementById("cboProblema").value;
	var subProblema  = document.getElementById("cboSubProblema").value;
	var observ        	= document.getElementById("obs").value;
  var fechaSolicitud 	= document.getElementById("fSolicitud").value;
  var id1 	= document.getElementById("ident1").innerHTML;
  var id2 	= document.getElementById("ident2").innerHTML;
  var idEtiServ1	= document.getElementById("idEtiServ1").innerHTML;
  var idEtiServ2	= document.getElementById("idEtiServ2").innerHTML;
  var id3 	= document.getElementById("ident3").innerHTML;
  var id4 	= document.getElementById("ident4").innerHTML;
  var idUnidad      = document.getElementById("textUnidad").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2       = document.getElementById("textDia2").value;
  var textTipoUsuario = document.getElementById("textTipoUsuario").value;
  var opcionServ  			= document.getElementById("selServicio").value;
  
  if(opcionServ!=""){
  	var opcionServicio = document.getElementById('selServicio').options[document.getElementById('selServicio').selectedIndex].text;
	}else{
		var opcionServicio="";
	}
  
  var tipoUsuario 			= document.getElementById("tipoDeUsuario").value;
	if(subProblema==190 || subProblema==200 || subProblema==370) document.getElementById("textDia").value="NULL";

	var parametros = "";
	parametros += "unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo;
	parametros +="&problema="+problema+"&subProblema="+subProblema;
	parametros +="&observ="+observ+"&fechaSolicitud="+fechaSolicitud;
  parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&opcionServicio="+opcionServicio+"&idFecha2="+idFecha2;
  parametros +="&tipoUsuario="+tipoUsuario+"&textTipoUsuario="+textTipoUsuario+"&id1="+id1+"&id2="+id2+"&idEtiServ1="+idEtiServ1+"&idEtiServ2="+idEtiServ2+"&id3="+id3+"&id4="+id4;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlNuevoDioscar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 //cargaListaSolicitudesEnTramite(unidadUsuario);
						 top.cerrarVentana();
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod);
				}
			}
		}
	}
}

function nuevoDioscar2(){
	var codigo         	= document.getElementById("codigo").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
	var problema	  = document.getElementById("cboProblema").value;
	var subProblema  = document.getElementById("cboSubProblema").value;
	var observ        	= document.getElementById("obs").value;
  var fechaSolicitud 	= document.getElementById("fSolicitud").value;
  var idUnidad      = document.getElementById("textUnidad").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2       = document.getElementById("textDia2").value;
  var opcionServ  			= document.getElementById("selServicio").value;
  
  if(subProblema==190 || subProblema==200 || subProblema==370) document.getElementById("textDia").value="NULL";
  
  if(opcionServ!=""){
  	var opcionServicio = document.getElementById('selServicio').options[document.getElementById('selServicio').selectedIndex].text;
	}else{
		var opcionServicio="";
	}
	
	var tipoUsuario 			= document.getElementById("tipoDeUsuario").value;
  var textTipoUsuario = document.getElementById("textTipoUsuario").value;
	var id1 	= document.getElementById("ident1").innerHTML;
  var id2 	= document.getElementById("ident2").innerHTML;
  var idEtiServ1	= document.getElementById("idEtiServ1").innerHTML;
  var idEtiServ2	= document.getElementById("idEtiServ2").innerHTML;
  var id3 	= document.getElementById("ident3").innerHTML;
  var id4 	= document.getElementById("ident4").innerHTML;
  
  if(id1=="</LAB>") id1=id3;
  if(id2=="</LAB>") id2=id4;
	
	var parametros = "";
	parametros += "unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo;
	parametros +="&problema="+problema+"&subProblema="+subProblema;
	parametros +="&observ="+observ+"&fechaSolicitud="+fechaSolicitud;
  parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&opcionServicio="+opcionServicio+"&idFecha2="+idFecha2+"&id1="+id1+"&id2="+id2+"&idEtiServ1="+idEtiServ1+"&idEtiServ2="+idEtiServ2+"&id3="+id3+"&id4="+id4+"&tipoUsuario="+tipoUsuario+"&textTipoUsuario="+textTipoUsuario;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlNuevoDioscar2.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod);
				}
			}
		}
	}
}

function guardarFichaCaballo(codigoVehiculo){
	document.getElementById('btnGuardarOrganizacion2').disabled = "true";
	var validaOk = validarFichaFuncionario();
	var validaIdOk = validarFichaIdentificador();
	var codigoVehiculo = document.getElementById("codigoSolicitud").value;
	
	if (validaOk && validaIdOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaDioscar(codigoVehiculo);
		}
		else {
			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS MAS IMPORTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoDioscar();
		}
	}
}

function actualizaDioscar(codigoVehiculo){
	var codigo         	= document.getElementById("codigoSolicitud").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
  var respuesta		      = document.getElementById("resp").value;
  var secciones            = document.getElementById("secciones").value;
	var subProblema  = document.getElementById("cboSubProblema").value;
	var observ        	= document.getElementById("obs").value;
	var observ1        	= document.getElementById("obs1").value;
	var archivo            = document.getElementById("rutArchi").value;
	var id1        	= document.getElementById("id1").value;
  var id2        	= document.getElementById("id2").value;
	if(archivo!="")var tipoMovi=100; else var tipoMovi=20;
	
  var tipoUsuario 			= document.getElementById("tipoDeUsuario").value;
  var textTipoUsuario = document.getElementById("textTipoUsuario").value;
  
  if(tipoUsuario!=0) id2=tipoUsuario;
  
  if(tipoUsuario!="") id1=textTipoUsuario;
	
  if(subProblema==190 || subProblema==200 || subProblema==370) id2="NULL";
	
	var parametros = "";
  var movimiento = document.getElementById("cboMovimiento").value;
  
  if(movimiento==100) observ1=respuesta;
 	
  var idFecha2      = document.getElementById("textDia2").value;
  var opcionServ  	= document.getElementById("selServicio").value;
  
  if(opcionServ!=""){
  	var opcionServicio = document.getElementById('selServicio').options[document.getElementById('selServicio').selectedIndex].text;
	}else{
		var opcionServicio="";
	}
	
	if(idFecha2 !="") id1=idFecha2;
  if(opcionServicio!=0 || opcionServicio!="") id2=opcionServicio;
	
	var parametros = "";
	parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&codigoUsuario="+codigoUsuario+"&respuesta="+respuesta+"&archivo="+archivo+"&tipoMovi="+tipoMovi+"&secciones="+secciones;
	parametros += "&unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo+"&movimiento="+movimiento+"&observ="+observ+"&observ1="+observ1;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaSolicitud.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod);
				}
			}
		}
	}
}

function actualizaDioscar2(codigoVehiculo){
	var codigo         	= document.getElementById("codigoSolicitud").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
  var respuesta		      = document.getElementById("resp").value;
  var id1        			= "";
  var id2        			= "";
	var observ        	= document.getElementById("obs").value;
	var parametros 			= "";
	var idUnidad      = document.getElementById("textUnidad").value;
  var idUnidad2      = document.getElementById("textUnidad2").value;
  var idUnidad3      = document.getElementById("textUnidad3").value;
  var idUnidad4      = document.getElementById("textUnidad4").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2      = document.getElementById("textDia2").value;
  var idFecha3      = document.getElementById("textDia3").value;
  var idFecha4      = document.getElementById("textDia4").value;
  var idFecha5      = document.getElementById("textDia5").value;
  var idFecha6      = document.getElementById("textDia6").value;
  var idServicio    = document.getElementById("textServicio").value;
  var idFuncionario = document.getElementById("textFunc").value;
  var idRut         = document.getElementById("textRut").value;
  var idNombre      = document.getElementById("textNombre").value;
  var idUsuario     = document.getElementById("textUsu").value;
  var idFolio       = document.getElementById("textFolio").value;
  var idBCU         = document.getElementById("textBcu").value;
  var idBCU2         = document.getElementById("textBcu2").value;
  var idBCU3         = document.getElementById("textBcu3").value;
  var idBCU4         = document.getElementById("textBcu4").value;
  var idBCU5         = document.getElementById("textBcu5").value;
  var idBCU6         = document.getElementById("textBcu6").value;
  var idBCU7         = document.getElementById("textBcu7").value;
  var idBCU8         = document.getElementById("textBcu8").value;
  var idTipoAnimal  = document.getElementById("textTipoAni").value;
  var idBCU2        = document.getElementById("textBcu2").value;
  var idPatente     = document.getElementById("textPatente").value;
  var idSerie       = document.getElementById("textSerie").value;
  var idTarjeta     = document.getElementById("textTarjeta").value;
  var idSerie2      = document.getElementById("textSerie2").value;
  var idSerie3      = document.getElementById("textSerie3").value;
  var idSerie4      = document.getElementById("textSerie4").value;
  var idSerie5      = document.getElementById("textSerie5").value;
  var idSerie6      = document.getElementById("textSerie6").value;
  var idSerie7      = document.getElementById("textSerie7").value;
  var idSerie8      = document.getElementById("textSerie8").value;
  var idModelo      = document.getElementById("textModelo").value;
  var idDescUnidad  = document.getElementById("textDescUni").value;
  var idDescUnidad2 = document.getElementById("textDescUni2").value;
  var idFuncionario2 = document.getElementById("textFunc2").value;
  var idFuncionario3 = document.getElementById("textFunc3").value;
  var idRut2         = document.getElementById("textRut2").value;
  var idFuncionario4 = document.getElementById("textFunc4").value;
  var idRut3         = document.getElementById("textRut3").value;
  var idFuncionario5 = document.getElementById("textFunc5").value;
  var idFuncionario6 = document.getElementById("textFunc6").value;
  var idFuncionario7 = document.getElementById("textFunc7").value;
  var idFuncionario8 = document.getElementById("textFunc8").value;
  var idFuncionario9 = document.getElementById("textFunc9").value;
  var idFuncionario10 = document.getElementById("textFunc10").value;
  var idFuncionario11 = document.getElementById("textFunc11").value;
  var idFolio2       = document.getElementById("textFolio2").value;
  var idPatente2     = document.getElementById("textPatente2").value;
  var idPatente3     = document.getElementById("textPatente3").value;
  var movimiento = document.getElementById("cboMovimiento").value;
	var parametros = "";
	parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&codigoUsuario="+codigoUsuario+"&respuesta="+respuesta;
	parametros += "&unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo+"&movimiento="+movimiento+"&observ="+observ;
	parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&idServicio="+idServicio+"&idFuncionario="+idFuncionario+"&idRut="+idRut;
	parametros +="&idNombre="+idNombre+"&idUsuario="+idUsuario+"&idFolio="+idFolio+"&idBCU="+idBCU+"&idTipoAnimal="+idTipoAnimal;
	parametros +="&idBCU2="+idBCU2+"&idPatente="+idPatente+"&idSerie="+idSerie+"&idTarjeta="+idTarjeta+"&idSerie2="+idSerie2;
	parametros +="&idModelo="+idModelo+"&idDescUnidad="+idDescUnidad+"&idDescUnidad2="+idDescUnidad2;
	parametros +="&idFecha2="+idFecha2+"&idFecha3="+idFecha3+"&idFecha4="+idFecha4+"&idFecha5="+idFecha5+"&idFecha6="+idFecha6+"&idUnidad2="+idUnidad2; 
	parametros +="&idFuncionario2="+idFuncionario2+"&idFuncionario3="+idFuncionario3+"&idRut2="+idRut2+"&idFuncionario4="+idFuncionario4+"&idRut3="+idRut3+"&idFuncionario5="+idFuncionario5;
	parametros +="&idFuncionario6="+idFuncionario6+"&idUnidad3="+idUnidad3+"&idFuncionario7="+idFuncionario7+"&idFuncionario8="+idFuncionario8+"&idFuncionario9="+idFuncionario9+"&idFuncionario10="+idFuncionario10;  
	parametros +="&idFuncionario11="+idFuncionario11+"&idFolio2="+idFolio2+"&idBCU2="+idBCU2+"&idBCU3="+idBCU3+"&idBCU4="+idBCU4+"&idBCU5="+idBCU5+"&idBCU6="+idBCU6+"&idPatente2="+idPatente2+"&idBCU7="+idBCU7; 
	parametros +="&idPatente3="+idPatente3+"&idBCU8="+idBCU8+"&idSerie3="+idSerie3+"&idSerie4="+idSerie4+"&idSerie5="+idSerie5+"&idSerie6="+idSerie6+"&idSerie7="+idSerie7+"&idSerie8="+idSerie8+"&idUnidad4="+idUnidad4;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaSolicitud2.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod);
				}
			}
		}
	}
}

function nuevoEstadoDioscar(){
	var codigo         	  = document.getElementById("codigoSolicitud").value;
	var movimiento	      = document.getElementById("cboMovimiento").value;
	var respuesta		      = document.getElementById("resp").value;
  var fechaMovimiento 	= document.getElementById("fechaMovimiento").value;
  var usuario	          = document.getElementById("usuario").value;
  var fechaTermino	    = document.getElementById("fechaTermino").value;
  var codigoMovimiento	= document.getElementById("codigoMovimiento").value;
  var archivo           = document.getElementById("rutArchi").value;
  
  if(movimiento==70){ 
  	var secciones=20;  
	}else if(movimiento==80){
		var secciones=30; 
	}
		
	if(codigoMovimiento==70){ 
  	var secciones=20;  
	}else if(codigoMovimiento==80){
		var secciones=30; 
	}
	var parametros = "";
	parametros += "codigo="+codigo+"&movimiento="+movimiento+"&respuesta="+respuesta+"&secciones="+secciones+"&archivo="+archivo;
	parametros +="&fechaMovimiento="+fechaMovimiento+"&usuario="+usuario+"&fechaTermino="+fechaTermino+"&codigoMovimiento="+codigoMovimiento;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlNuevoEstadoDioscar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios2(unidadUsuario, '', '');
						 idCargaListadoFuncionarios2 = setInterval("cerrarVentanaPersonal2()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod);
				}
			}
		}
	}
}

function actualizaTemporizador(unidad){
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaTemporizador.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (cod == 1){
						 alert('LAS SOLICITUDES SIN IDENTIFICADOR HAN SIDO ELIMINADAS ......        ');
						 top.leeFuncionarios(unidad, '', '');
						 idCargaListadoFuncionarios = setInterval(500);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod);
				}
			}
		}
	}
}

function actualizaTemporizador2(unidad){
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaTemporizador2.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI());
	objHttpXMLFuncionarios.onreadystatechange=function(){
		if(objHttpXMLFuncionarios.readyState == 4){
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (cod == 1){
						 alert('LAS SOLICITUDES HAN SIDO MODIFICADAS ......        ');
						 top.leeFuncionarios2(unidad, '', '');
						 idCargaListadoFuncionarios2 = setInterval(500);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod);
				}
			}
		}
	}
}

function guardarFichaCaballo2(){
	var validaOk = validarFichaFuncionario();
	if (validaOk){
		var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \nDESEA CONTINUAR?");
		if (msj) nuevoEstadoDioscar();
	}
}

function guardarFichaCaballo3(){
	var validaOk = validarFichaFuncionario();
	var validaIdOk = validarFichaIdentificador();
	if (validaOk){
		var msj=confirm("ATENCION :\nSE INGRESARAN LOS ANTECEDENTES FALTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \nDESEA CONTINUAR?");
		if (msj) nuevoDioscar();
	}
}

function guardarFichaCaballo6(codigoVehiculo){
	//var validaOk = validarFichaFuncionario();
	var validaIdOk = validarFichaIdentificador2();
	var codigoVehiculo = document.getElementById("codigoSolicitud").value;
	if (validaIdOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaDioscar(codigoVehiculo);
		}
		else {
			//var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS MAS IMPORTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			//if (msj) nuevoDioscar();
				 alert('PENDIENTE A OFICIALIZADA ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
		}
	}
}

function guardarFichaCaballo5(codigoVehiculo){
	var validaOk = validarFichaFuncionario();
	var codigoVehiculo = document.getElementById("codigoSolicitud").value;
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaDioscar2(codigoVehiculo);
		}
		else {
			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS MAS IMPORTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoDioscar2();
		}
	}
}

function guardarFichaCaballo4(){
	var validaOk = validarFichaFuncionario();
	var validaIdOk = validarFichaIdentificador();
	if (validaOk && validaIdOk){
		var msj=confirm("ATENCION :\nSE INGRESARAN LOS ANTECEDENTES FALTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \nDESEA CONTINUAR?");
		if (msj) nuevoDioscar();
	}
}

function cerrarVentanaPersonal(){
	if (top.cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		top.cerrarVentana();
	}
}

function cerrarVentanaPersonal2(){
	if (top.cargaListadoFuncionarios2 == 1){
		clearInterval(idCargaListadoFuncionarios2);
		top.cerrarVentana();
	}
}

function cerrarVentanaPersonal3(){
	if (top.cargaListadoFuncionarios3 == 1){
		clearInterval(idCargaListadoFuncionarios3);
		top.cerrarVentana();
	}
}

function cerrarVentanaPersonal4(){
	if (top.cargaListadoFuncionarios4 == 1){
		clearInterval(idCargaListadoFuncionarios4);
		top.cerrarVentana();
	}
}

function validarFichaFuncionario(){
	var problema	= document.getElementById("cboProblema").value;
	var subproblema= document.getElementById("cboSubProblema").value;
	var observ	= document.getElementById("obs").value;
	var movBD = document.getElementById("codigoMovimiento").value;
	var movBD2 = document.getElementById("movimiento").value;
	var movNuevo = document.getElementById("cboMovimiento").value;
	var resp = document.getElementById("resp").value;
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	if (problema == 0){
		alert("DEBE INDICAR EL PROBLEMA...... 	     ");
		document.getElementById("cboProblema").focus();
		return false;
	}
	
	if (subproblema == 0){
		alert("DEBE INDICAR EL TIPO DE PROBLEMA ...... 	     ");
		document.getElementById("cboSubProblema").focus();
		return false;
	}
	
	if (observ == ""){
		alert("DEBE INDICAR UNA OBSERVACION ...... 	     ");
		document.getElementById("obs").focus();
		return false;
	}
	
	if (resp == "" && movBD2!=10){
		alert("DEBE CAMBIAR EL ESTADO E INDICAR EL MOTIVO ...... 	     ");
		document.getElementById("resp").focus();
		return false;
	}
	return true;
}

function validarFichaFuncionario(){
	var problema	= document.getElementById("cboProblema").value;
	var subproblema =  document.getElementById("cboSubProblema").value;
	var observ	= document.getElementById("obs").value;
	var movBD = document.getElementById("codigoMovimiento").value;
	var movBD2 = document.getElementById("movimiento").value;
	var movNuevo = document.getElementById("cboMovimiento").value;
	var resp = document.getElementById("resp").value;
	var archivo					= document.getElementById("archivo").value;
	var archivoLoad			= document.getElementById("archivoLoad").value;
	//var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	//var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
		
	if (problema == 0){
		alert("DEBE INDICAR EL PROBLEMA...... 	     ");
		document.getElementById("cboProblema").focus();
		return false;
	}
	
	if (subproblema == 0){
		alert("DEBE INDICAR EL TIPO DE PROBLEMA ...... 	     ");
		document.getElementById("cboSubProblema").focus();
		return false;
	}
	
	if (observ == ""){
		alert("DEBE INDICAR UNA OBSERVACION ...... 	     ");
		document.getElementById("obs").focus();
		return false;
	}
	
	if(movBD2 != movNuevo){
		if (resp == "" && movBD2!=10){
			alert("DEBE INDICAR EL MOTIVO ...... 	     ");
			document.getElementById("resp").focus();
			return false;
		}
	}
	
	if(movBD2 == movNuevo){
		if ((movBD == movNuevo) || (movBD2 == movNuevo)){
			alert("DEBE CAMBIAR EL ESTADO ...... 	     ");
			document.getElementById("cboMovimiento").focus();
			return false;
		}
	}
	
	if(movBD2==90 && movNuevo==100){
		if (archivo == "") {
			alert("DEBE SUBIR EL ARCHIVO SOLICITADO ...... 	     ");
			return false;
		}
		
		if (archivoLoad == 0) {
			alert("DEBE PRESIONAR EL BOTON SUBIR PARA CARGAR EL ARCHIVO EN EL SISTEMA ...... 	     ");
			return false;
		}
	}	
	return true;
}

function validarEstados(){
 	var movBD = document.getElementById("codigoMovimiento").value;
	var movBD2 = document.getElementById("movimiento").value;
	var movNuevo = document.getElementById("cboMovimiento").value;
	if(movBD2 == movNuevo){
		if ((movBD == movNuevo) || (movBD2 == movNuevo)){
			alert("DEBE CAMBIAR EL ESTADO ...... 	     ");
			document.getElementById("cboMovimiento").focus();
			return false;
		}
	}
	return true;
}

function validarFichaIdentificador(){
  var valor = document.getElementById("cboSubProblema").value;  
  var idDato     = document.getElementById("textUnidad").value;
  var idDato2       = document.getElementById("textDia").value;
  var idFecha2       = document.getElementById("textDia2").value;
  var idServicio    = document.getElementById("selServicio").value;
  var usuario = document.getElementById("textTipoUsuario").value;
  var tipoUsuario = document.getElementById("tipoDeUsuario").value;
		
	if (valor == 100  && idFecha2 == ""){
		alert("DEBE INDICAR EL LA FECHA ...... 	     ");
		document.getElementById("textDia2").focus();
		return false;
	}
	
	if (valor == 100  && idServicio == 0){
		alert("DEBE INDICAR EL SERVICIO ...... 	     ");
		document.getElementById("selServicio").focus();
		return false;
	}
	
	if (valor == 390  && idFecha2 == ""){
		alert("DEBE INDICAR EL LA FECHA ...... 	     ");
		document.getElementById("textDia2").focus();
		return false;
	}
	
	if (valor == 390  && idServicio == 0){
		alert("DEBE INDICAR EL SERVICIO ...... 	     ");
		document.getElementById("selServicio").focus();
		return false;
	}
	
	if (valor == 110  && idFecha2 == ""){
		alert("DEBE INDICAR EL LA FECHA ...... 	     ");
		document.getElementById("textDia2").focus();
		return false;
	}
	
	if (valor == 110  && idServicio == 0){
		alert("DEBE INDICAR EL SERVICIO ...... 	     ");
		document.getElementById("selServicio").focus();
		return false;
	}
	
	if (valor == 400  && idFecha2 == ""){
		alert("DEBE INDICAR EL LA FECHA ...... 	     ");
		document.getElementById("textDia2").focus();
		return false;
	}
	
	if (valor == 400  && idServicio == 0){
		alert("DEBE INDICAR EL SERVICIO ...... 	     ");
		document.getElementById("selServicio").focus();
		return false;
	}
	
	if (valor == 410  && idFecha2 == ""){
		alert("DEBE INDICAR EL LA FECHA ...... 	     ");
		document.getElementById("textDia2").focus();
		return false;
	}
	
	if (valor == 410  && idServicio == 0){
		alert("DEBE INDICAR EL SERVICIO ...... 	     ");
		document.getElementById("selServicio").focus();
		return false;
	}
	
	if (valor == 120  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 120  && idDato2 == ""){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}
	
	if (valor == 130  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 130  && idDato2 == ""){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}
	
	if (valor == 140  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 140  && idDato2 == ""){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}
	
	if (valor == 150  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 150  && idDato2 == ""){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}
	
	if (valor == 160  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 160  && idDato2 == ""){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}
	
	if (valor == 170  && usuario == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 170  && tipoUsuario  == 0){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("tipoDeUsuario").focus();
		return false;
	}
	
	if (valor == 180  && usuario == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 180  && tipoUsuario  == 0){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("tipoDeUsuario").focus();
		return false;
	}
	
	if (valor == 190  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 200  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 210  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 210  && idDato2 == ""){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}		
	
	if (valor == 220  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}
	
	if (valor == 220  && idDato2 == ""){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}		
	
	if (valor == 370  && idDato == ""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("textUnidad").focus();
		return false;
	}	
	return true;
}

function validarFichaIdentificador2(){
  var valor = document.getElementById("valor2").value;  
  var idDato     = document.getElementById("id1").value;
  var idDato2       = document.getElementById("id2").value;
  var idDato1     = document.getElementById("textTipoUsuario").value;
  var idDato21       = document.getElementById("tipoDeUsuario").value;
  var idDato11     = document.getElementById("textDia2").value;
  var idDato2111  = document.getElementById("selServicio").value;
  if(idDato2111!=""){
  	var idDato211 = document.getElementById("selServicio").options[document.getElementById("selServicio").selectedIndex].text;
  }else{
		var idDato211	=	"";
	}
	
  if(idDato11!="")idDato1=idDato11; 
  if((idDato211!="") || (idDato211!=0))idDato21=idDato211;
  
	if (idDato == "" && idDato1 ==""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("id1").focus();
		return false;
	}
	
	if (idDato2 == "" && idDato21=="SELECCIONE OPCION ..."){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("id2").focus();
		return false;
	}
	
	if (idDato == "" && idDato1 ==""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR ...... 	     ");
		document.getElementById("id1").focus();
		return false;
	}
	
	if ((idDato2 == "" && idDato21=="" && valor!=190) && (idDato2 == "" && idDato21=="" && valor!=200) && (idDato2 == "" && idDato21=="" && valor!=370)){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR ...... 	     ");
		document.getElementById("id2").focus();
		return false;
	}
	return true;
}

function validarFichaIdentificador3(){
  var valor 		= document.getElementById("valor2").value;
  var idDato1   = document.getElementById("textTipoUsuario").value;
  var idDato21	= document.getElementById("tipoDeUsuario").value;
  var idDato    = document.getElementById("id1").value;
  var idDato2		= document.getElementById("id2").value;
	
	if (idDato1 == "" && idDato==""){
		alert("DEBE INGRESAR EL 1ER. IDENTIFICADOR3 ...... 	     ");
		document.getElementById("id1").focus();
		return false;
	}
	
	if (idDato21 == 0 && idDato2=="" ){
		alert("DEBE INGRESAR EL 2DO. IDENTIFICADOR3 ...... 	     ");
		document.getElementById("id2").focus();
		return false;
	}
	return true;
}

function desactivarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "true";
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardarOrganizacion").disabled = "true";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "true";
}

function activarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "";
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardarOrganizacion").disabled = "";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "";
}

function desactivarBotones2(){
	document.getElementById("btnGuardarOrganizacion").disabled = "true";
	document.getElementById("btnGuardarOrganizacion2").disabled = "true";
}

function hijomenor(){
	var valor = document.getElementById("cboSubProblema").value;
	if(valor==100 || valor==390){
		document.getElementById("identificador1").style.display="block";
	}
	else{
		document.getElementById("identificador1").style.display="none";
	}
	
	if(valor==110 || valor==400 || valor==410){
		document.getElementById("identificador2").style.display="block";
	}
	else{
		document.getElementById("identificador2").style.display="none";
	}
	
	if(valor==120){
		document.getElementById("identificador3").style.display="block";
	}
	else{
		document.getElementById("identificador3").style.display="none";
	}
	
	if(valor==130){
		document.getElementById("identificador4").style.display="block";
	}
	else{
		document.getElementById("identificador4").style.display="none";
	}
	
	if(valor==140){
		document.getElementById("identificador5").style.display="block";
	}
	else{
		document.getElementById("identificador5").style.display="none";
	}
	
	if(valor==150){
		document.getElementById("identificador6").style.display="block";
	}
	else{
		document.getElementById("identificador6").style.display="none";
	}
	
	if(valor==160){
		document.getElementById("identificador7").style.display="block";
	}
	else{
		document.getElementById("identificador7").style.display="none";
	}
	
	if(valor==170){
		document.getElementById("identificador8").style.display="block";
		}
	else{
		document.getElementById("identificador8").style.display="none";
	}
	
	if(valor==180){
		document.getElementById("identificador9").style.display="block";
	}
	else{
		document.getElementById("identificador9").style.display="none";
	}
	
	if(valor==190){
		document.getElementById("identificador10").style.display="block";
	}
	else{
		document.getElementById("identificador10").style.display="none";
	}
	
	if(valor==200){
		document.getElementById("identificador11").style.display="block";
	}
	else{
		document.getElementById("identificador11").style.display="none";
	}
	
	if(valor==210){
		document.getElementById("identificador12").style.display="block";
	}
	else{
		document.getElementById("identificador12").style.display="none";
	}
	
	if(valor==220){
		document.getElementById("identificador13").style.display="block";
	}
	else{
		document.getElementById("identificador13").style.display="none";
	}
	
	if(valor==230){
		document.getElementById("identificador14").style.display="block";
	}
	else{
		document.getElementById("identificador14").style.display="none";
	}
	
	if(valor==240){
		document.getElementById("identificador15").style.display="block";
	}
	else{
		document.getElementById("identificador15").style.display="none";
	}
	
	if(valor==250){
		document.getElementById("identificador16").style.display="block";
	}
	else{
		document.getElementById("identificador16").style.display="none";
	}
	
	if(valor==260){
		document.getElementById("identificador17").style.display="block";
	}
	else{
		document.getElementById("identificador17").style.display="none";
	}
	
	if(valor==270){
		document.getElementById("identificador18").style.display="block";
	}
	else{
		document.getElementById("identificador18").style.display="none";
	}
	
	if(valor==280){
		document.getElementById("identificador19").style.display="block";
	}
	else{
		document.getElementById("identificador19").style.display="none";
	}
	
	if(valor==290){
		document.getElementById("identificador20").style.display="block";
	}
	else{
		document.getElementById("identificador20").style.display="none";
	}
	
	if(valor==300){
		document.getElementById("identificador21").style.display="block";
	}
	else{
		document.getElementById("identificador21").style.display="none";
	}
	
	if(valor==310){
		document.getElementById("identificador22").style.display="block";
	}
	else{
		document.getElementById("identificador22").style.display="none";
	}
	
	if(valor==320){
		document.getElementById("identificador23").style.display="block";
	}
	else{
		document.getElementById("identificador23").style.display="none";
	}
	
	if(valor==330){
		document.getElementById("identificador24").style.display="block";
	}
	else{
		document.getElementById("identificador24").style.display="none";
	}
	
	if(valor==340){
		document.getElementById("identificador25").style.display="block";
	}
	else{
		document.getElementById("identificador25").style.display="none";
	}
	
	if(valor==350){
		document.getElementById("identificador26").style.display="block";
	}
	else{
		document.getElementById("identificador26").style.display="none";
	}
	
	if(valor==360){
		document.getElementById("identificador27").style.display="block";
	}
	else{
		document.getElementById("identificador27").style.display="none";
	}
	
	if(valor==370){
		document.getElementById("identificador28").style.display="block";
	}
	else{
		document.getElementById("identificador28").style.display="none";
	}
}

function hijomenor2(){
	var valor = document.getElementById("cboMovimiento").value;
	if(valor==300 || valor==200 || valor==30 || valor==40 || valor==50 || valor==60 || valor==70 || valor==80 || valor==90 || valor==100){
		document.getElementById("textoRespuesta").style.display="block";
	}	
}

function hijomenor3(){
	var valor = document.getElementById("cboMovimiento").value;
	if(valor==900){
		document.getElementById("funcionariosDeriva").style.display="block";
	}
	else{
		document.getElementById("funcionariosDeriva").style.display="none";
	}
}

function controlTemporizador(unidad){
    var vacio = "";
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTemporizador.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad));
    //alert(objHttpXMLFuncionarios.responseText);
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	var xml = objHttpXMLFuncionarios.responseXML.documentElement;
    	mensaje += "LA UNIDAD TIENE SOLICITUDES PENDIENTES Y SE HA VENCIDO EL PLAZO:\n\n";
      if (xml.getElementsByTagName('temporizador').length > 10) var cantidadServiciosMostar = 10;
      else var cantidadServiciosMostar = xml.getElementsByTagName('temporizador').length;
	    for(var i=0;i<cantidadServiciosMostar;i++){
				var fecha 		  = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
				var servicio 	  = (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
				var unidad 	    = (xml.getElementsByTagName('movimiento')[i].text||xml.getElementsByTagName('movimiento')[i].textContent||"");
				var subproblema	= (xml.getElementsByTagName('subproblema')[i].text||xml.getElementsByTagName('subproblema')[i].textContent||"");
				mensaje += (i+1) +". " + vacio+"  TRAMITE No. "+fecha.toUpperCase()+"\n   ("+subproblema.toUpperCase()+").\n";
			}
			if (cantidadServiciosMostar < xml.getElementsByTagName('temporizador').length) mensaje += "...";
			alert(mensaje);
			return 1;
	}else{ 
		return 0;
	}
}

function controlTemporizador2(){
	  var vacio = "";
		var unidad = "";
		var arreglo = new Array();
		var arrayCorrelativoPaso = new Array();
    var mensaje	=	"";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTemporizador2.php",false);
	 	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 	objHttpXMLFuncionarios.send(encodeURI());
    //alert(objHttpXMLFuncionarios.responseText);
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	var xml = objHttpXMLFuncionarios.responseXML.documentElement;
      mensaje += "TIENE SOLICITUDES SIN REVISAR:\n\n";
      if (xml.getElementsByTagName('temporizador').length > 10) var cantidadServiciosMostar = 10;
      else var cantidadServiciosMostar = xml.getElementsByTagName('temporizador').length;
			
			for(var i=0;i<cantidadServiciosMostar;i++){
	    	var fecha 		         	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
	      var servicio 	         	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
	      var subproblema         = (xml.getElementsByTagName('subproblema')[i].text||xml.getElementsByTagName('subproblema')[i].textContent||"");
	      arrayCorrelativoPaso[0] = new Array();
	      var arregloCorrelativos	= php_serialize(arreglo);
	      mensaje += (i+1) +". " + vacio+" TRAMITE No. "+fecha.toUpperCase()+"\n   ("+subproblema.toUpperCase()+").\n";
			}
			if (cantidadServiciosMostar < xml.getElementsByTagName('temporizador').length) mensaje += "...";
			alert(mensaje);
			var arregloCorrelativos	= php_serialize(arreglo);
			document.getElementById("correlativo").value=arregloCorrelativos;
			return 1;
	}else{ 
		return 0;
	}
}

function hijomenor345(){
	var descUnidad =document.getElementById("descUnidad").value;
	var valor = document.getElementById("cboSubProblema").value;
	var valor2 = document.getElementById("valor2").value;
	if(valor==370) document.getElementById("textUnidad").value = descUnidad;
	if(valor==190 || valor==200 || valor==370) document.getElementById("textDia").style.visibility = 'hidden';
	if(valor==0)valor=valor2;
	if(valor==120 || valor==130 || valor==140 || valor==120 || valor==130 || valor==150 || valor==160 || valor==190 || valor==200
	   || valor==210 || valor==220  || valor==230 || valor==240 || valor==250 || valor==260 || valor==270 || valor==280 || valor==290 || valor==300 || valor==310 || valor==320 || valor==330
	   || valor==340 || valor==350 || valor==360 || valor==370 || valor==420 || valor==430 || valor==440 || valor==450 || valor==460 || valor==470 || valor==480 || valor==490){
		document.getElementById("ide1").style.display="block";
	}
	else{
		document.getElementById("ide1").style.display="none";
	}
}

function hijomenor3466(){
	var valor = document.getElementById("cboSubProblema").value;
	var valor2 = document.getElementById("valor2").value;
	if(valor==0)valor=valor2;
	if( valor==100 || valor==110 || valor==390 || valor==400 || valor==410 
		 || valor==120 || valor==130 || valor==140 || valor==120 || valor==130 || valor==150 || valor==160 || valor==190 || valor==200
	   || valor==210 || valor==220  || valor==230 || valor==240 || valor==250 || valor==260 || valor==270 || valor==280 || valor==290 || valor==300 || valor==310 || valor==320 || valor==330
	   || valor==340 || valor==350 || valor==360 || valor==370){
		document.getElementById("ide1").style.display="block";
	}
	else{
		document.getElementById("ide1").style.display="none";
	}
}

function hijomenor346(){
	var valor = document.getElementById("cboSubProblema").value;
	if( valor==100 || valor==110 || valor==390 || valor==400 || valor==410){
		document.getElementById("tipoServicio").style.display="block";
	}
	else{
		document.getElementById("tipoServicio").style.display="none";
	}
}

function hijomenor347(){
	var valor = document.getElementById("cboSubProblema").value;
	if( valor==170 || valor==180){
		document.getElementById("tipoUsuario").style.display="block";
	}
	else{
		document.getElementById("tipoUsuario").style.display="none";
	}
}

function hijomenor348(){
	var valor = document.getElementById("cboSubProblema").value;
	if( valor==230){
		document.getElementById("tipoAnimal").style.display="block";
	}
	else{
		document.getElementById("tipoAnimal").style.display="none";
	}
}

function hijomenor666(){
	var valor = document.getElementById("cboSubProblema").value;
	if(valor==100 || valor==130 || valor==240 || valor==270 || valor==310 || valor==340){
		document.getElementById("idFec").style.display="block";
	}
	else{
		document.getElementById("idFec").style.display="none";
	}
}

function hijomenor777(movimiento){
	var valor2 = document.getElementById("movimiento").value;
	if(valor2==90){
		document.getElementById("estado2").style.display="block";
	}
	else{
		document.getElementById("estado2").style.display="none";
	}
}

function hijomenor888(){
	var valor = document.getElementById("cboMovimiento").value;
	if(valor==100){
		document.getElementById("estado22").style.display="block";
	}
	else{
		document.getElementById("estado22").style.display="none";
	}
}

function identificador(){
	var valor = document.getElementById("cboSubProblema").value;
	if(valor==100 || valor==110 || valor==110 || valor==390 || valor==400 || valor==410){
		document.getElementById('ident1').innerHTML = 'FECHA';
		document.getElementById('ident2').innerHTML = 'TIPO SERVICIO';
	}
	
	if(valor==120){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'RUT';
	}
	
	if(valor==130){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
	}
	
	if(valor==140){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'RUT';
	}
	
	if(valor==150){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'RUT CORRECTO';
	}
	
	if(valor==160){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'NOMBRE CORRECTO';
	}
	
	if(valor==170){
		document.getElementById('ident3').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident4').innerHTML = 'TIPO DE USUARIO';
	}
	
	if(valor==180){
		document.getElementById('ident3').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident4').innerHTML = 'TIPO DE USUARIO';
	}
	
	if(valor==190){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
	}
	
	if(valor==200){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
	}
	
	if(valor==210){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'FOLIO LICENCIA';
	}
	
	if(valor==220){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'FOLIO LICENCIA';
	}
	
	if(valor==230){
		document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'TIPO ANIMAL';
	}
	
	if(valor==240){
		document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
	}
	
	if(valor==250){
		document.getElementById('ident1').innerHTML = 'B.C.U. ERRONEO';
		document.getElementById('ident2').innerHTML = 'B.C.U. CORRECTO';
	}
	
	if(valor==260){
		document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'PATENTE';
	}
	
	if(valor==270){
		document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
	}
	
	if(valor==280){
		document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'PATENTE CORRECTA';
	}
	
	if(valor==290){
			document.getElementById('ident1').innerHTML = 'PATENTE';
		document.getElementById('ident2').innerHTML = 'B.C.U. CORRECTO';
		}
		
	if(valor==300){
		document.getElementById('ident1').innerHTML = 'NRO. DE SERIE';
		document.getElementById('ident2').innerHTML = 'NRO. DE TARJETA';
	}
	
	if(valor==310){
		document.getElementById('ident1').innerHTML = 'NRO. DE SERIE';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
	}
	
	if(valor==320){
		document.getElementById('ident1').innerHTML = 'NRO. DE SERIE ERRONEO';
		document.getElementById('ident2').innerHTML = 'NRO. DE SERIE CORRECTO';
	}
	
	if(valor==330){
		document.getElementById('ident1').innerHTML = 'NRO. DE SERIE';
		document.getElementById('ident2').innerHTML = 'MODELO ARMA';
	}
	
	if(valor==340){
		document.getElementById('ident1').innerHTML = 'NRO. DE SERIE ERRONEO';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
	}
	
	if(valor==350){
		document.getElementById('ident1').innerHTML = 'NRO. DE SERIE ERRONEO';
		document.getElementById('ident2').innerHTML = 'NRO. DE SERIE CORRECTO';
	}
	
	if(valor==360){
		document.getElementById('ident1').innerHTML = 'DESCRIPCION INICIAL';
		document.getElementById('ident2').innerHTML = 'DESCRIPCION FINAL';
	}
	
	if(valor==370){
		document.getElementById('ident1').innerHTML = 'UNIDAD';
	}
	
	if(valor==420 || valor==430 || valor==440 || valor==450 || valor==460 || valor==470 || valor==480 || valor==490){
		document.getElementById('ident1').innerHTML = 'OTRO IDENTIFICADOR 1';
	  document.getElementById('ident2').innerHTML = 'OTRO IDENTIFICADOR 2';
	}
}

function adjuntarArchivo(){
	var valor = document.getElementById("cboMovimiento").value;
	if(valor==60){
		document.getElementById("adjunto").style.display="block";
		}else if(valor==70){
		document.getElementById("adjunto").style.display="block";
		}else if(valor==30){
		document.getElementById("adjunto").style.display="block";
		}else if(valor==80){
		document.getElementById("adjunto").style.display="block";
	}else if(valor==90){
		document.getElementById("adjunto").style.display="block";
		}else if(valor==100){
		document.getElementById("adjunto").style.display="block";
	}else{
		document.getElementById("adjunto").style.display="none";
	}
}

function subirArchivo(boton){
	var fecha					         	= document.getElementById("fechaArchivo").value;
	var rutaArchivo 						= document.getElementById("archivo").value;
	var arrayRutaArchivo 				= rutaArchivo.split("\\");
	var cantidadArreglo 				= arrayRutaArchivo.length;
	var nombreDelArchivo 				= arrayRutaArchivo[cantidadArreglo-1];	
	var archivoServidor					=	document.getElementById("archivoServidor").value;	
	var extension 							= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toUpperCase(); 	
	var extensiones_permitidas 	= new Array(".JPG", ".JPEG", ".PNG", ".PDF");
	var noaceptada  						= true;
	var folioColor 							= document.getElementById("usuario").value;
	
	for (var i = 0; i < extensiones_permitidas.length; i++) {
    if (extensiones_permitidas[i] == extension) {
     	noaceptada = false;
    }
  }
  
  if(noaceptada){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO JPG, JPEG, PNG O PDF");
   	return false;
  }
	
	rutaArchivo = folioColor+" "+fecha+extension;
	if(folioColor == archivoServidor){
		alert("EL DOCUMENTO YA EXISTE");
		return false;
	}
	
	document.getElementById("rutArchi").value = rutaArchivo;
	document.formSubeArchivo.submit();
	boton.disabled = true;
	document.getElementById("archivo").disabled = true;
	document.getElementById("archivoLoad").value=1;
}

