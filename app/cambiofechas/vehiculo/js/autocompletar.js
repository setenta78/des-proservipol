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
					listado += "<td width='10%' align='center' id='nombreColumna'>Codigo Equipo</td>";
					listado += "<td width='30%' align='center' id='nombreColumna'>Tipo</td>";
					listado += "<td width='20%' align='center' id='nombreColumna'>Modelo</td>";
					listado += "<td width='28%' align='center' id='nombreColumna'>Unidad</td>";
				listado += "</tr>";
				for(i=0;i<largo;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					if(i<20){
						codigo	 		 = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
						patente	 		 = (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
						bcu			 		 = (xml.getElementsByTagName('bcu')[i].text||xml.getElementsByTagName('bcu')[i].textContent||"");
						tipo		 		 = (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
						modelo	 		 = (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
						unidad	 		 = (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
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

function Solicitud_Fecha(Codigo){
	var objHttpXML = new AJAXCrearObjeto();
	var div	= document.getElementById("listaFechas");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando ......</td>";
	objHttpXML.open("POST","./xml/xmlListaFechas.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("codigo="+Codigo));
	objHttpXML.onreadystatechange=function(){
		if(objHttpXML.readyState == 4){
			if (objHttpXML.responseText != "VACIO"){
				var xml 				= objHttpXML.responseXML.documentElement;
  			var correlativo	= "";
				var estado			= "";
				var unidad			= "";
				var fechaD			= "";
				var fechaH			= "";
				var sw 				 	= 0;
				var fondoLinea				= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listado						= "";
				var largo = xml.getElementsByTagName('fechas').length;
				listado = "<table width='100%' cellspacing='1' cellpadding='1'>";
				listado += "<tr>";
					listado += "<td width='8%' align='center' id='nombreColumna'>Correlativo</div></td>";
					listado += "<td width='25%' align='center' id='nombreColumna'>Estado</div></td>";
					listado += "<td width='26%' align='center' id='nombreColumna'>Unidad</div></td>";
					listado += "<td width='17%' align='center' id='nombreColumna'>Fecha Desde</div></td>";
					listado += "<td width='17%' align='center' id='nombreColumna'>Fecha Hasta</div></td>";
					listado += "<td width='10%' align='center' id='nombreColumna'></div></td>";
				listado += "</tr>";
				for(i=0;i<largo;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					codigo	 		 = (xml.getElementsByTagName('codigo_fecha')[i].text||xml.getElementsByTagName('codigo_fecha')[i].textContent||"");
					correlativo	 = (xml.getElementsByTagName('correlativo')[i].text||xml.getElementsByTagName('correlativo')[i].textContent||"");
					estado	 		 = (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidad	 		 = (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					fechaD	 		 = (xml.getElementsByTagName('fechaD')[i].text||xml.getElementsByTagName('fechaD')[i].textContent||"");
					fechaH	 		 = (xml.getElementsByTagName('fechaH')[i].text||xml.getElementsByTagName('fechaH')[i].textContent||"");
					bloqueado		 = (xml.getElementsByTagName('bloqueado')[i].text||xml.getElementsByTagName('bloqueado')[i].textContent||"");
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					var nroLinea = i + 1;
					var botonEliminar = (bloqueado==1) ? "" : "<input type='button' value='Eliminar ⇓' onclick=\"eliminarRegistro('"+codigo+"','"+fechaD+"','"+correlativo+"')\" />";
					listado += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' >";
						listado += "<td width='8%' align='center'><div id='valorColumna'>"+correlativo+"</div></td>";
						listado += "<td width='25%' align='center'><div id='valorColumna'>"+estado+"</div></td>";
						listado += "<td width='26%' align='center'><div id='valorColumna'>"+unidad+"</div></td>";
						listado += "<td width='17%' align='center'><div id='valorColumna'>"+fechaD+"</div></td>";
						listado += "<td width='17%' align='center'><div id='valorColumna'>"+fechaH+"</div></td>";
						listado += "<td width='10%' align='center'><div id='valorColumna'>"+botonEliminar+"</div></td>";
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
		Solicitud_Fecha(Codigo);
}

function cambiarClase(objeto, clase){
	objeto.className = clase;
}