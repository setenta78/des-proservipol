function realizarConsulta(){
	var parametrosOk = validaParametrosDeConsulta();
	if (parametrosOk){
		var tipoSeleccionado = checkRaddio(document.getElementsByName("rbTipoConculta"));
		if (tipoSeleccionado == 1) listaServiciosPorFuncionario();
		if (tipoSeleccionado == 2) listaServiciosPorVehiculo();
		if (tipoSeleccionado == 4) listaServiciosPorArma();
	}
}

function validaParametrosDeConsulta(){
	var fechaDesde = document.getElementById("textFechaDesde").value;
	var fechaHasta = document.getElementById("textFechaHasta").value;
	var selFiltro  = document.getElementById("selFiltroBusqueda").value;
	
	if (fechaDesde == ""){
		alert("DEBE INDICAR FECHA DE INICIO DE LA CONSULTA ...... 	     ");
		document.getElementById("textFechaDesde").focus();
		return false;
	}
	
	if (fechaHasta == ""){
		alert("DEBE INDICAR FECHA DE TERMINO DE LA CONSULTA ...... 	     ");
		document.getElementById("textFechaHasta").focus();
		return false;
	}
	
	
	var fechaMayor = comparaFecha(fechaDesde,fechaHasta);
	if (fechaMayor == 1){
		alert("LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE TERMINO ....  ");
		return false;
	}
	
	if (selFiltro == 0){
		alert("DEBE INDICAR FILTRO DE BUSQUEDA ...... 	     ");
		document.getElementById("selFiltroBusqueda").focus();
		return false;
	}
	return true;
}

function checkRaddio(id){
	var x = 0;
	var value = null;
	while(x<id.length){
		if(id[x].checked)value = id[x].value;
		x++;
	}
	return value == null ? "No hay seleccion" : value;
}

function listaServiciosPorFuncionario(){
	cargaListadoServicios = 0;
	var divCabecera	= document.getElementById("cabeceraGrilla");
	var cabecera 	= "";
	cabecera += "<table cellspacing='1' cellpadding='1' width='100%'>";
	cabecera += "<tr>";
	cabecera += "<td id='nombreColumna' width='5%'  align='center'>No.</td>";
	cabecera += "<td id='nombreColumna' width='15%' align='center'>FECHA</td>";
	cabecera += "<td id='nombreColumna' width='35%' align='center'>SERVICIO</td>";
	cabecera += "<td id='nombreColumna' width='25%' align='center'>HORARIO</td>";
	cabecera += "<td id='nombreColumna' width='20%' align='center'>UNIDAD</td>";
	cabecera += "</tr>";
	cabecera += "</table>";
	divCabecera.innerHTML = cabecera;
	var fecha1 			  = document.getElementById("textFechaDesde").value;
	var fecha2 			  = document.getElementById("textFechaHasta").value;
	var codigoFuncionario = document.getElementById("selFiltroBusqueda").value;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServiciosPorFuncionario.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoFuncionario="+codigoFuncionario+"&fecha1="+fecha1+"&fecha2="+fecha2));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml 			 	= objHttpXMLServicios.responseXML.documentElement;
				var correlativo			= "";
				var fecha	 		 	= "";
				var tipoServicio	 	= "";
				var tipoExtraordinario	= "";
				var horaInicio		 	= "";
				var horaTermino		 	= "";
				var unidad				= "";
				var unidadDesc			= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					fecha	 		 	= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					correlativo	 		= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
					tipoServicio	 	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
					tipoExtraordinario	= (xml.getElementsByTagName('desServicioExtraordinario')[i].text||xml.getElementsByTagName('desServicioExtraordinario')[i].textContent||"");
					horaInicio		 	= (xml.getElementsByTagName('horaInicio')[i].text||xml.getElementsByTagName('horaInicio')[i].textContent||"");
					horaTermino		 	= (xml.getElementsByTagName('horaTermino')[i].text||xml.getElementsByTagName('horaTermino')[i].textContent||"");
					unidad	 			= (xml.getElementsByTagName('codUnidad')[i].text||xml.getElementsByTagName('codUnidad')[i].textContent||"");
					unidadDesc 			= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");

					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
					if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
					
					var horario = horaInicio+" - "+horaTermino;
				
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='15%' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoServicios += "<td width='35%'><div id='valorColumna'>"+tipoServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='25%' align='center'><div id='valorColumna'>"+horario+"</div></td>";
					listadoServicios += "<td width='20%' align='center'><div id='valorColumna'>"+unidadDesc+"</div></td>";
					listadoServicios += "</tr>";
				}
				listadoServicios += "</table>";
				div.innerHTML = listadoServicios;
				cargaListadoServicios = 1;
			} else {
				div.innerHTML = "";
				alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
				cargaListadoServicios = 1;
			}
		}
	}
}

function listaServiciosPorVehiculo(){
	cargaListadoServicios = 0;
	var divCabecera	= document.getElementById("cabeceraGrilla");
	var cabecera 	= "";
	cabecera += "<table cellspacing='1' cellpadding='1' width='100%'>";
	cabecera += "<tr>";
	cabecera += "<td id='nombreColumna' width='5%'  align='center'>No.</td>";
	cabecera += "<td id='nombreColumna' width='12%' align='center'>FECHA</td>";
	cabecera += "<td id='nombreColumna' width='20%' align='center'>SERVICIO</td>";
	cabecera += "<td id='nombreColumna' width='10%' align='center'>HORARIO</td>";
	cabecera += "<td id='nombreColumna' width='11%' align='center'>KM. INICIAL</td>";
	cabecera += "<td id='nombreColumna' width='11%' align='center'>KM. FINAL</td>";
	cabecera += "<td id='nombreColumna' width='11%' align='center'>RECORRIDO</td>";
	cabecera += "<td id='nombreColumna' width='20%' align='center'>UNIDAD</td>";
	cabecera += "</tr>";
	cabecera += "</table>";
	
	divCabecera.innerHTML = cabecera;
	var fecha1 			  = document.getElementById("textFechaDesde").value;
	var fecha2 			  = document.getElementById("textFechaHasta").value;
	var codigoVehiculo 	  = document.getElementById("selFiltroBusqueda").value;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServiciosPorVehiculo.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoVehiculo="+codigoVehiculo+"&fecha1="+fecha1+"&fecha2="+fecha2));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//console.log(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml 			 	= objHttpXMLServicios.responseXML.documentElement;
				var correlativo			= "";
				var fecha	 		 	= "";
				var tipoServicio	 	= "";
				var tipoExtraordinario	= "";
				var horaInicio			= "";
				var horaTermino			= "";
				var kmInicial		 	= "";
				var kmFinal		 		= "";
				var unidad				= "";
				var desUnidad			= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					fecha	 		 	= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					correlativo	 		= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
					tipoServicio	 	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
					tipoExtraordinario	= (xml.getElementsByTagName('desServicioExtraordinario')[i].text||xml.getElementsByTagName('desServicioExtraordinario')[i].textContent||"");
					horaInicio		 	= (xml.getElementsByTagName('horaInicio')[i].text||xml.getElementsByTagName('horaInicio')[i].textContent||"");
					horaTermino		 	= (xml.getElementsByTagName('horaTermino')[i].text||xml.getElementsByTagName('horaTermino')[i].textContent||"");
					kmInicial		 	= (xml.getElementsByTagName('kmInicial')[i].text||xml.getElementsByTagName('kmInicial')[i].textContent||"");
					kmFinal		 	    = (xml.getElementsByTagName('kmFinal')[i].text||xml.getElementsByTagName('kmFinal')[i].textContent||"");
					unidad	 			= (xml.getElementsByTagName('codUnidad')[i].text||xml.getElementsByTagName('codUnidad')[i].textContent||"");
					desUnidad	 		= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
					
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
					
					if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
					
					var horario = horaInicio+" - "+horaTermino;

					var kilometros = (kmFinal*1 - kmInicial*1);
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='12%' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoServicios += "<td width='20%'><div id='valorColumna'>"+tipoServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='10%'><div id='valorColumna'>"+horario+"</div></td>";
					listadoServicios += "<td width='11%' align='center'><div id='valorColumna'>"+formato_numero(kmInicial,0,',','.')+"</div></td>";
					listadoServicios += "<td width='11%' align='center'><div id='valorColumna'>"+formato_numero(kmFinal,0,',','.')+"</div></td>";
					listadoServicios += "<td width='11%' align='right' style='padding:0px 5px 0px 0px;'><div id='valorColumna'>"+formato_numero(kilometros,0,',','.')+" KMS.</div></td>";
					listadoServicios += "<td width='20%' align='center'><div id='valorColumna'>"+desUnidad+"</div></td>";
					listadoServicios += "</tr>";
				}
				listadoServicios += "</table>";
				div.innerHTML = listadoServicios;
				cargaListadoServicios = 1;
			} else {
				div.innerHTML = "";
				alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
				cargaListadoServicios = 1;
			}
		}
	}
}

function listaServiciosPorArma(){
	cargaListadoServicios = 0;
	var divCabecera	= document.getElementById("cabeceraGrilla");
	var cabecera 	= "";
	cabecera += "<table cellspacing='1' cellpadding='1' width='100%'>";
	cabecera += "<tr>";
	cabecera += "<td id='nombreColumna' width='5%'  align='center'>No.</td>";
	cabecera += "<td id='nombreColumna' width='15%' align='center'>FECHA</td>";
	cabecera += "<td id='nombreColumna' width='35%' align='center'>SERVICIO</td>";
	cabecera += "<td id='nombreColumna' width='25%' align='center'>HORARIO</td>";
	cabecera += "<td id='nombreColumna' width='20%' align='center'>UNIDAD</td>";
	cabecera += "</tr>";
	cabecera += "</table>";
	
	divCabecera.innerHTML = cabecera;
	var fecha1 		= document.getElementById("textFechaDesde").value;
	var fecha2 		= document.getElementById("textFechaHasta").value;
	var codigoArma	= document.getElementById("selFiltroBusqueda").value;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServiciosPorArmas.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoArma="+codigoArma+"&fecha1="+fecha1+"&fecha2="+fecha2));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml 			 	= objHttpXMLServicios.responseXML.documentElement;
				var correlativo			= "";
				var fecha	 		 	= "";
				var tipoServicio	 	= "";
				var tipoExtraordinario	= "";
				var horaInicio		 	= "";
				var horaTermino		 	= "";
				var unidad				= "";
				var desUnidad			= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					fecha	 		 	= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					correlativo	 		= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
					tipoServicio	 	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
					tipoExtraordinario	= (xml.getElementsByTagName('desServicioExtraordinario')[i].text||xml.getElementsByTagName('desServicioExtraordinario')[i].textContent||"");
					horaInicio		 	= (xml.getElementsByTagName('horaInicio')[i].text||xml.getElementsByTagName('horaInicio')[i].textContent||"");
					horaTermino		 	= (xml.getElementsByTagName('horaTermino')[i].text||xml.getElementsByTagName('horaTermino')[i].textContent||"");
					unidad	 			= (xml.getElementsByTagName('codUnidad')[i].text||xml.getElementsByTagName('codUnidad')[i].textContent||"");
					desUnidad	 		= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
					
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
					if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
					
					var horario = horaInicio+" - "+horaTermino;
					
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='15%' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoServicios += "<td width='35%'><div id='valorColumna'>"+tipoServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='25%' align='center'><div id='valorColumna'>"+horario+"</div></td>";
					listadoServicios += "<td width='20%' align='center'><div id='valorColumna'>"+desUnidad+"</div></td>";
					listadoServicios += "</tr>";
				}
				listadoServicios += "</table>";
				div.innerHTML = listadoServicios;
				cargaListadoServicios = 1;
			} else {
				div.innerHTML = "";
				alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
				cargaListadoServicios = 1;
			}
		}
	}
}