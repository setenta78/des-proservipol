function Solicitud_Vehiculo(Cadena){

	var objHttpXML = new AJAXCrearObjeto();
	var Btexto = Cadena;
	var div	= document.getElementById("lista");
	
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando ......</td>";

	objHttpXML.open("POST","./xml/xmlListaVehiculo.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("patente="+Btexto)); 
	
	objHttpXML.onreadystatechange=function(){
	
		if(objHttpXML.readyState == 4){    
			if (objHttpXML.responseText != "VACIO"){

				var xml 				= objHttpXML.responseXML.documentElement;
				var unidad				= "";

				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listado		= "";
				var largo = xml.getElementsByTagName('vehiculo').length;
				listado = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				listado += "<tr>";

					listado += "<td width='4%' align='center' id='nombreColumna'>No.</td>";
					listado += "<td width='8%' align='center' id='nombreColumna'>Patente</td>";
					listado += "<td width='10%' align='center' id='nombreColumna'>BCU</td>";
					listado += "<td width='30%' align='center' id='nombreColumna'>Tipo</td>";
					listado += "<td width='20%' align='center' id='nombreColumna'>Modelo</td>";
					listado += "<td width='28%' align='center' id='nombreColumna'>Unidad</td>";
					
				listado += "</tr>";
				
				for(i=0;i<largo;i++){
							if (sw==0) {fondoLinea = "linea1";sw =1}
							else {fondoLinea = "linea2";sw=0}
						if(i<20){
							codigo	 		 = xml.getElementsByTagName('codigo')[i].firstChild.data;
							patente	 		 = xml.getElementsByTagName('patente')[i].firstChild.data;
							bcu			 		 = xml.getElementsByTagName('bcu')[i].firstChild.data;
							tipo		 		 = xml.getElementsByTagName('tipo')[i].firstChild.data;
							modelo	 		 = xml.getElementsByTagName('modelo')[i].firstChild.data;
							unidad	 		 = xml.getElementsByTagName('unidad')[i].firstChild.data;
												
							resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
							lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
							
							var nroLinea = i + 1;
						  var dblClick = "javascript:mostarFechas('listaFechas','textPatente','"+codigo+"','"+patente+"')";
							
							listado += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";

							if(largo>1){
							listado += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
							}
							else{
							listado += "<td width='4%' align='center'><div id='valorColumna'></div></td>";
							}
							listado += "<td width='8%' align='center'><div id='valorColumna'>"+patente+"</div></td>";
							listado += "<td width='10%' align='center'><div id='valorColumna'>"+bcu+"</div></td>";
							listado += "<td width='30%' align='center'><div id='valorColumna'>"+tipo+"</div></td>";
							listado += "<td width='20%' align='center'><div id='valorColumna'>"+modelo+"</div></td>";
							listado += "<td width='28%' align='center'><div id='valorColumna'>"+unidad+"</div></td>";
							listado += "</tr>";
						}
						else{
							listado += "<tr><td width='4%' align='center'><div id='valorColumna'>.......</div></td>";
							listado += "<td width='8%' align='center'><div id='valorColumna'>.......</div></td>";
							listado += "<td width='10%' align='center'><div id='valorColumna'>.......</div></td>";
							listado += "<td width='30%' align='center'><div id='valorColumna'>.......</div></td>";
							listado += "<td width='20%' align='center'><div id='valorColumna'>.......</div></td>";
							listado += "<td width='28%' align='center'><div id='valorColumna'>.......</div></td>";
							listado += "</tr>";
							}
					}
				listado += "</table>";
				div.innerHTML = listado;
			}
		}
	}

}

function Solicitud_Fecha(Codigo,Patente){

	var objHttpXML = new AJAXCrearObjeto();
	var BVehiculo = Codigo;
	var div	= document.getElementById("listaFechas");

	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando ......</td>";

	objHttpXML.open("POST","./xml/xmlListaFechas.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("codigo="+BVehiculo));
	
	objHttpXML.onreadystatechange=function(){
	
		if(objHttpXML.readyState == 4){
			
			if (objHttpXML.responseText != "VACIO"){
				//alert(objHttpXML.responseText);
				var xml 				= objHttpXML.responseXML.documentElement;
  			var correlativo	= "";
				var estado			= "";
				var unidad			= "";
				var fechaD			= "";
				var fechaH			= "";
				
				var sw 				 	= 0;
				var fondoLinea		= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listado		= "";
				var largo = xml.getElementsByTagName('fechas').length;
				listado = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				listado += "<tr>";
					listado += "<td width='8%' align='center' id='nombreColumna'>Correlativo</div></td>";
					listado += "<td width='25%' align='center' id='nombreColumna'>Estado</div></td>";
					listado += "<td width='30%' align='center' id='nombreColumna'>Unidad</div></td>";
					listado += "<td width='20%' align='center' id='nombreColumna'>Fecha Desde</div></td>";
					listado += "<td width='20%' align='center' id='nombreColumna'>Fecha Hasta</div></td>";
				listado += "</tr>";
				
				for(i=0;i<largo;i++){
							if (sw==0) {fondoLinea = "linea1";sw =1}
							else {fondoLinea = "linea2";sw=0}

							codigo	 		 = xml.getElementsByTagName('codigo_fecha')[i].firstChild.data;
							correlativo	 = xml.getElementsByTagName('correlativo')[i].firstChild.data;
							estado	 		 = xml.getElementsByTagName('estado')[i].firstChild.data;
							unidad	 		 = xml.getElementsByTagName('unidad')[i].firstChild.data;
							fechaD	 		 = xml.getElementsByTagName('fechaD')[i].firstChild.data;
							fechaH	 		 = xml.getElementsByTagName('fechaH')[i].firstChild.data;
							
							resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
							lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
							
							var nroLinea = i + 1;
							var dblClick = "javascript:mostrar('"+codigo+"','"+Patente+"','"+fechaD+"','"+fechaH+"')";
							
							listado += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
								listado += "<td width='8%' align='center'><div id='valorColumna'>"+correlativo+"</div></td>";
								listado += "<td width='25%' align='center'><div id='valorColumna'>"+estado+"</div></td>";
								listado += "<td width='30%' align='center'><div id='valorColumna'>"+unidad+"</div></td>";
								listado += "<td width='20%' align='center'><div id='valorColumna'>"+fechaD+"</div></td>";
								listado += "<td width='20%' align='center'><div id='valorColumna'>"+fechaH+"</div></td>";
							listado += "</tr>";

				}
				listado += "</table>";
				div.innerHTML = listado;
			}
		}
	}

}

function autocompletar(idContenido,idFechas,Cadena){
	if(Cadena.length>=1)
	{
		document.getElementById(idContenido).style.display="block";
		Solicitud_Vehiculo(Cadena);
	}else
		document.getElementById(idContenido).style.display="none";
		document.getElementById(idFechas).style.display="none";
}

function mostarFechas(idFechas,idValor,Codigo,Patente){
  	document.getElementById(idValor).value=Patente;
		document.getElementById(idFechas).style.display="block";
		Solicitud_Vehiculo(Patente);
		Solicitud_Fecha(Codigo,Patente);
}

function cambiarClase(objeto, clase){
	objeto.className = clase;
}

function mostrar(Codigo,Patente,FechaD,FechaH){
	var page = "ficha.php?codigo=".concat(Codigo).concat("&patente=").concat(Patente).concat("&fechaD=").concat(FechaD).concat("&fechaH=").concat(FechaH);
	abrirVentana("Rectificación de Fechas","600","250",page,"1","","15","15");
}

function abrirVentana(titulo, ancho, alto, pagina, nroLinea, estado, posX, posY){
		
		var win = new Window({className	  : "mac_os_x", 
							  title		  : titulo, 
							  width		  : ancho, 
							  height	  : alto, 
							  top		  : posX,
							  left		  : posY,
							  minimizable : false, 
							  maximizable : false,
							  closable	  : false,
							  draggable	  : true,
							  resizable	  : false,
							  url		  : pagina}); 
    	win.show(estado); 
}

function cerrarVentana(){
	Windows.closeAll();
	return true;
}
