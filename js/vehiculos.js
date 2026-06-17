var cargaListadoVehiculos;
var idCargaListadoVehiculos;
var idAsignaSelectFichaVehiculo;
var sinPosponer = true;

function leeVehiculos(unidad, campo, sentido){
	cargaListadoVehiculos = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	if(document.getElementById('contieneHijos') !== null){
		var contieneHijos = document.getElementById("contieneHijos").value;
	}
	else{
		var contieneHijos = 0;
	}
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoVehiculos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
	//alert("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido);
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculos.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLVehiculos.onreadystatechange=function(){
		//console.log(objHttpXMLVehiculos.responseText);
		if(objHttpXMLVehiculos.readyState == 4)	{
			//console.log(objHttpXMLVehiculos.responseText);
			if(objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml					= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo				= "";
				var tipoVehiculo		= "";
				var marca				= "";
				var modelo				= "";
				var marcaModelo			= "";
				var patente				= "";
				var nroInstitucional	= "";
				var estado				= "";
				var codigoEquipo		= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var seccion				= "";
				var tarjetaCombustible	= "";
				var sw					= 0;
				var fondoLinea			= "";
				var resaltarLinea		= "";
				var lineaSinResaltar	= "";
				var listadoVehiculos	= "";

				listadoVehiculos = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					codigo				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipoVehiculo		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					marca				= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					modelo				= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					marcaModelo			= marca + " " + modelo;
					patente				= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
					nroInstitucional	= (xml.getElementsByTagName('numeroInstitucional')[i].text||xml.getElementsByTagName('numeroInstitucional')[i].textContent||"");
					estado				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					codigoEquipo		= (xml.getElementsByTagName('codigoEquipo')[i].text||xml.getElementsByTagName('codigoEquipo')[i].textContent||"--");
					sap					= (xml.getElementsByTagName('sap')[i].text||xml.getElementsByTagName('sap')[i].textContent||"--");
					codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
					seccion				= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					seccion				= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					tarjetaCombustible	= (xml.getElementsByTagName('tarjetaCombustible')[i].text||xml.getElementsByTagName('tarjetaCombustible')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";

					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('VEHICULO ...', '800', '400','fichaVehiculo.php?codigoVehiculo="+codigo+"&subMenu=Dotacion','"+nroLinea+"','','5','5')";
					
					if(desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if(estado.length > 40){
						var estadoMuestra = estado.substr(0,38) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else{
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(estado=='REPARACION' || estado=='REPARACION MAYOR' || estado=='REPARACION MENOR' || estado=='MANTENCION PROGRAMADA'){
						var color="blue";
					}else if(estado =='ACTIVO SIN REGULARIZAR' || estado=='PROCESO DE BAJA'){
						var color="red";
					}else{
						var color="";
					}

					var etiquetaTarjetaCombustible = "";
					if(tarjetaCombustible != ""){
						etiquetaTarjetaCombustible = "<img src='./img/tarjetaAzul.png' width='28px' height='20px' >";
					}

					if(contieneHijos == 1){
						listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoVehiculos += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoVehiculos += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
						listadoVehiculos += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+marcaModelo+"</div></td>";
						listadoVehiculos += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+patente+"</div></td>";
						listadoVehiculos += "<td width='10%' align='left'><font color="+color+"><div id='valorColumna'>"+codigoEquipo+"</div></td>";
						listadoVehiculos += "<td width='12%' align='left'><font color="+color+"><div id='valorColumna'>"+seccion+"</div></td>";
						listadoVehiculos += "<td width='18%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoVehiculos += "<td width='8%' align='center'><font color="+color+">"+etiquetaTarjetaCombustible+"</div></td>";
						listadoVehiculos += "</tr>";
					}else{
						listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoVehiculos += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoVehiculos += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
						listadoVehiculos += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+marcaModelo+"</div></td>";
						listadoVehiculos += "<td width='12%'><font color="+color+"><div id='valorColumna'>"+patente+"</div></td>";
						listadoVehiculos += "<td width='12%' align='left'><font color="+color+"><div id='valorColumna'>"+codigoEquipo+"</div></td>";
						listadoVehiculos += "<td width='24%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoVehiculos += "<td width='8%' align='center'><font color="+color+">"+etiquetaTarjetaCombustible+"</div></td>";
						listadoVehiculos += "</tr>";
					}
				}
				listadoVehiculos += "</table>";
				div.innerHTML = listadoVehiculos;
				cargaListadoVehiculos = 1;
			}
		}
	}
}

function leeVehiculosA(unidad, campo, sentido){
	cargaListadoVehiculos = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoVehiculos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculosAgregados.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLVehiculos.onreadystatechange=function(){
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4){
			//console.log(objHttpXMLVehiculos.responseText);
			if(objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml					= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo				= "";
				var tipoVehiculo		= "";
				var marca				= "";
				var modelo				= "";
				var marcaModelo			= "";
				var patente				= "";
				var nroInstitucional	= "";
				var estado				= "";
				var codigoEquipo		= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var seccion				= "";
				var tarjetaCombustible	= "";
				var sw					= 0;
				var fondoLinea			= "";
				var resaltarLinea		= "";
				var lineaSinResaltar	= "";
				var listadoVehiculos	= "";
				
				listadoVehiculos = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipoVehiculo		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					marca				= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					modelo				= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					marcaModelo			= marca + " " + modelo;
					patente				= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
					nroInstitucional	= (xml.getElementsByTagName('numeroInstitucional')[i].text||xml.getElementsByTagName('numeroInstitucional')[i].textContent||"");
					estado				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					codigoEquipo		= (xml.getElementsByTagName('codigoEquipo')[i].text||xml.getElementsByTagName('codigoEquipo')[i].textContent||"");
					codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
					seccion				= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					unidadAgregado		= (xml.getElementsByTagName('unidadAgregado')[i].text||xml.getElementsByTagName('unidadAgregado')[i].textContent||"");
					tarjetaCombustible	= (xml.getElementsByTagName('tarjetaCombustible')[i].text||xml.getElementsByTagName('tarjetaCombustible')[i].textContent||"");
					
					resaltarLinea		= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('VEHICULO ...', '800', '400','fichaVehiculo.php?codigoVehiculo="+codigo+"&subMenu=Agregado','"+nroLinea+"','','5','5')";
					
					if (estado.length > 40) {
						var estadoMuestra = estado.substr(0,38) + " ...";
					} else {
						var estadoMuestra = estado;
					}
					
					if (unidadAgregado != "") estadoMuestra += ", "+unidadAgregado;
					
					var etiquetaTarjetaCombustible = "";
					if(tarjetaCombustible != ""){
						etiquetaTarjetaCombustible = "<img src='./img/tarjetaAzul.png' width='28px' height='20px'>";
					}

					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='20%' align='left'><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
					listadoVehiculos += "<td width='20%' align='left'><div id='valorColumna'>"+marcaModelo+"</div></td>";
					listadoVehiculos += "<td width='12%'><div id='valorColumna'>"+patente+"</div></td>";
					listadoVehiculos += "<td width='12%' align='left'><div id='valorColumna'>"+codigoEquipo+"</div></td>";
					listadoVehiculos += "<td width='24%' align='left'><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoVehiculos += "<td width='8%' align='center'><div id='valorColumna'>"+etiquetaTarjetaCombustible+"</div></td>";	
					listadoVehiculos += "</tr>";
				}
				listadoVehiculos += "</table>";
				div.innerHTML = listadoVehiculos;
				cargaListadoVehiculos = 1;
			}
		}
	}
}

function leeVehiculosControlEstado(unidad){
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculos.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&campo=&sentido="));
	objHttpXMLVehiculos.onreadystatechange=function(){
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4){
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml					= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo				= "";
				var tipoVehiculo		= "";
				var marca				= "";
				var modelo				= "";
				var marcaModelo			= "";
				var patente				= "";
				var nroInstitucional	= "";
				var estado				= "";
				var codigoEquipo		= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var estadoAntiguo		= 0;
				
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipoVehiculo		= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					marca				= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					modelo				= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					marcaModelo			= marca + " " + modelo;
					patente				= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
					nroInstitucional	= (xml.getElementsByTagName('numeroInstitucional')[i].text||xml.getElementsByTagName('numeroInstitucional')[i].textContent||"");
					estado				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					codigoEquipo		= (xml.getElementsByTagName('codigoEquipo')[i].text||xml.getElementsByTagName('codigoEquipo')[i].textContent||"");
					codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
					if (estado == "MANTENCION" || estado == "REPARACION") estadoAntiguo++;
				}
				
				if (estadoAntiguo > 0) {
					var mensajeEstados = "";
					mensajeEstados += "ATENCI\u00D3N :\n\n";
					mensajeEstados += "TIENE VEH\u00CDCULOS CON ESTADO \"MANTENCI\u00D3N\" Y/O \"REPARACI\u00D3N\" A LOS QUE DEBE ACTUALIZAR EL ESTADO EN QUE SE ENCUENTRAN SEGUN ULTIMAS INSTRUCCIONES :\n\n";
					mensajeEstados += "1. MANTENCI\u00D3N PROGRAMADA.\n";
					mensajeEstados += "2. REPARACI\u00D3N MENOR.\n";
					mensajeEstados += "3. REPARACI\u00D3N MAYOR.\n";
					mensajeEstados += "4. EVALUACI\u00D3N DE FALLA.\n";
					mensajeEstados += "5. TRAMITE ADMINISTRATIVO.\n    (EVAL. COTIZACIONES/ESPERA REPUESTOS)\n\n";
					mensajeEstados += "LA FECHA DE ACTUALIZACION DEBE SER DESDE EL 1 DE AGOSTO HACIA ADELANTE\n\n";
					mensajeEstados += "CONSULTAS REALIZARLAS AL CORREO: correo.proservipol@carabineros.cl.";
					alert(mensajeEstados);
					self.location.href='vehiculos.php';
				}
			}
		}
	}
}

function listaVehiculos(unidad, nombreObjeto, multiple, campo, sentido){
	cargaListadoVehiculos = 0;
	document.getElementById(nombreObjeto).length = null;
	if(multiple == false ){
		var datosOpcion = new Option("SELECCIONE VEHICULO ... ", 0, "", "");
		document.getElementById(nombreObjeto).options[0] = datosOpcion;
	}
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculosConsulta.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&campo=&sentido="));
	objHttpXMLVehiculos.onreadystatechange=function(){
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4){
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo			= "";
				var tipoVehiculo	= "";
				var patente			= "";
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipoVehiculo	= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					patente			= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");

					var descripcion = tipoVehiculo + " ("+patente+")";
					var puntero;
					if (!multiple) puntero = i+1;
					else puntero = i;
					
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				}
				cargaListadoVehiculos = 1;
			}
		}
	}
}

function buscaDatosVehiculo(){
	let CodigoEquipoVehiculo = eliminarBlancos(document.getElementById("textCodigoEquipo").value);
	if (CodigoEquipoVehiculo === ""){
		alert("DEBE INDICAR EL CODIGO DE EQUIPO DEL VEH\u00CDCULO ......      ");
		document.getElementById("textCodigoEquipo").value="";
		document.getElementById("textCodigoEquipo").focus();
		return false;
	} else {
		document.getElementById("btnBuscarVehiculo").value = "BUSCANDO ...";
		document.getElementById("btnBuscarVehiculo").disabled = "true";
		leeDatosVehiculo('',CodigoEquipoVehiculo, 1);
	}
}

function leeDatosVehiculo(codigoVehiculo, codigoEquipoVehiculo, tipo){
	
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlDatosVehiculo.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoVehiculo="+codigoVehiculo+"&codigoEquipo="+codigoEquipoVehiculo));
	objHttpXMLVehiculos.onreadystatechange=function(){
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4){
			//console.log(objHttpXMLVehiculos.responseText);
			if(objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml						= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo					= "";
				var tipoVehiculo			= "";
				var tipoDescripcion			= "";
				var marca					= "";
				var modelo					= "";
				var patente					= "";
				var nroInstitucional		= "";
				var estado					= "";
				var estadoDescripcion		= "";
				var procedencia				= "";
				var unidadVehiculo			= "";
				var descUnidadVehiculo		= "";
				var clasificacionCitacion	= "";
				var codigoEquipo			= "";
				var fechaEstado				= "";
				var codigoUnidadAgregado	= "";
				var desUnidadAgregado		= "";
				var codigoLugarReparacion	= "";
				var seccion					= "";
				var descSeccion				= "";
				var annoFabricacion			= "";
				var tarjetaCombustible		= "";

				if(xml.getElementsByTagName('vehiculo').length == 1){
					codigo					= (xml.getElementsByTagName('codigo')[0].text||xml.getElementsByTagName('codigo')[0].textContent||"");
					tipoVehiculo			= (xml.getElementsByTagName('tipo')[0].text||xml.getElementsByTagName('tipo')[0].textContent||"");
					tipoDescripcion			= (xml.getElementsByTagName('tipoDescripcion')[0].text||xml.getElementsByTagName('tipoDescripcion')[0].textContent||"");
					marca					= (xml.getElementsByTagName('marca')[0].text||xml.getElementsByTagName('marca')[0].textContent||"");
					modelo					= (xml.getElementsByTagName('modelo')[0].text||xml.getElementsByTagName('modelo')[0].textContent||"");
					patente					= (xml.getElementsByTagName('patente')[0].text||xml.getElementsByTagName('patente')[0].textContent||"");
					nroInstitucional		= (xml.getElementsByTagName('numeroInstitucional')[0].text||xml.getElementsByTagName('numeroInstitucional')[0].textContent||"");
					estado					= (xml.getElementsByTagName('estado')[0].text||xml.getElementsByTagName('estado')[0].textContent||"");
					estadoDescripcion		= (xml.getElementsByTagName('estadoDescripcion')[0].text||xml.getElementsByTagName('estadoDescripcion')[0].textContent||"");
					procedencia				= (xml.getElementsByTagName('procedencia')[0].text||xml.getElementsByTagName('procedencia')[0].textContent||"");
					unidadVehiculo			= (xml.getElementsByTagName('unidad')[0].text||xml.getElementsByTagName('unidad')[0].textContent||"");
					descUnidadVehiculo		= (xml.getElementsByTagName('descUnidad')[0].text||xml.getElementsByTagName('descUnidad')[0].textContent||"");
					clasificacionCitacion	= (xml.getElementsByTagName('clasificacionCitacion')[0].text||xml.getElementsByTagName('clasificacionCitacion')[0].textContent||"");
					codigoEquipo			= (xml.getElementsByTagName('codigoEquipo')[0].text||xml.getElementsByTagName('codigoEquipo')[0].textContent||"");
					fechaEstado				= (xml.getElementsByTagName('fechaEstado')[0].text||xml.getElementsByTagName('fechaEstado')[0].textContent||"");
					codigoUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[0].text||xml.getElementsByTagName('codigoUnidadAgregado')[0].textContent||"");
					desUnidadAgregado		= (xml.getElementsByTagName('desUnidadAgregado')[0].text||xml.getElementsByTagName('desUnidadAgregado')[0].textContent||"");
					codigoLugarReparacion	= (xml.getElementsByTagName('codigoLugarReparacion')[0].text||xml.getElementsByTagName('codigoLugarReparacion')[0].textContent||"");
					seccion					= (xml.getElementsByTagName('seccion')[0].text||xml.getElementsByTagName('seccion')[0].textContent||"");
					descSeccion				= (xml.getElementsByTagName('descSeccion')[0].text||xml.getElementsByTagName('descSeccion')[0].textContent||"");
					annoFabricacion			= (xml.getElementsByTagName('annoFabricacion')[0].text||xml.getElementsByTagName('annoFabricacion')[0].textContent||"");
					tarjetaCombustible		= (xml.getElementsByTagName('tarjetaCombustible')[0].text||xml.getElementsByTagName('tarjetaCombustible')[0].textContent||"");
					
					if(codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					if(annoFabricacion  == "") annoFabricacion  = "0000";
					
					document.getElementById("textCodigoEquipo").readOnly		= "true";
					document.getElementById("idVehiculo").value					= codigo;
					document.getElementById("textPatente").value				= patente;
					document.getElementById("textNumeroInstitucional").value	= nroInstitucional;
					document.getElementById("textCodigoEquipo").value			= codigoEquipo;
					document.getElementById("ultimaFecha").value				= fechaEstado;
					
					document.getElementById("codigoUnidadAgregado").value		= codigoUnidadAgregado;
					document.getElementById("textUnidadAgregado").value			= desUnidadAgregado;
					document.getElementById("codUnidadAgregadoBaseDatos").value	= codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value	= desUnidadAgregado;
					document.getElementById("textAnnoFab").value				= annoFabricacion;
					
					document.getElementById("textAnnoFab").readOnly		= "true";
					
					if (estado == 100){
						alert("EL VEH\u00CDCULO FUE DADO DE BAJA ...          ");
						cerrarVentanaFicha();
						return false;
					}
					
					if (tipo == 0 && (estado == 20 || estado == 30)) {
						if (estado == 20) var estadoMensaje = "MANTENCION";
						if (estado == 30) var estadoMensaje = "REPARACION";
						alert("ESTE VEH\u00CDCULO SE ENCUENTRA EN ESTADO \""+estadoMensaje+ "\", DEBE ACTUALIZAR EL ESTADO EN QUE SE ENCUENTRA SEGUN ULTIMAS INSTRUCCIONES :\n\n1. MANTECI\u00D3N PROGRAMADA.\n2. REPARACI\u00D3N MENOR.\n3. REPARACI\u00D3N MAYOR.\n4. EVALUACI\u00D3N DE FALLA.\n5. TRAMITE ADMINISTRATIVO.\n    (EVAL. COTIZACIONES/ESPERA REPUESTOS)");
						estado = 0;
					}
					
					if(document.getElementById("correlativo").value=="") capturaCorrelativo();
					
					if(unidadVehiculo == "") var habilitarBotones = false;
					else var habilitarBotones = true;
					
					if(tarjetaCombustible != ""){
						nroTarjertaDIV.innerHTML = tarjetaCombustible;
						nroTarjeta.style.display='block';
						btnSubirTarjeta.style.display='none';
					}

					document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA \u00DALTIMO MOVIMIENTO : " + fechaEstado;
					var valoresAsignar = "'" + procedencia + "','" + tipoVehiculo + "','" + marca + "','" + modelo + "','" + estado + "','" + codigoLugarReparacion + "','" + seccion + "', '" + clasificacionCitacion+ "', " + habilitarBotones;
					leeModeloVehiculos(marca, 'selModelo');
					idAsignaSelectFichaVehiculo = setInterval("asignaValores("+valoresAsignar+")",500);
					if(tipo == "1"){
						document.getElementById("btnBuscarVehiculo").value = "BUSCAR";
						document.getElementById("btnBuscarVehiculo").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if(unidadUsuario == unidadVehiculo){
							alert("ESTE VEH\u00CDCULO YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaFicha();
						}
						
						if(unidadUsuario != unidadVehiculo && unidadVehiculo != ""){
							alert("NO PUEDE AGREGAR ESTE VEH\u00CDCULO,\nYA QUE PERTENECE A LA " +descUnidadVehiculo+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaFicha();
						}
					}
				}
				else{
					activarVentanaListaVehiculos(xml);
				}
			}
			else{
				alert("EL VEH\u00CDCULO CON EL CODIGO EQUIPO INDICADO, NO SE ENCUENTRA EN LAS BASES DE DATOS          ");
				cerrarVentanaFicha();
			}
			document.getElementById("mensajeCargando").style.display = "none";
		}
	}
}

function activarVentanaListaVehiculos(xml){
	document.getElementById("divListaVehiculos").style.display = "block";
	document.getElementById("cubreVentana").style.display = "block";
	var listaVehiculos			= "";
	var codigo					= "";
	var tipoDescripcion			= "";
	var patente					= "";
	var estadoDescripcion		= "";
	listaVehiculos += "<table width='100%' cellspacing='1' cellpadding='1'>";
	for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
		codigo					= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
		tipoDescripcion			= (xml.getElementsByTagName('tipoDescripcion')[i].text||xml.getElementsByTagName('tipoDescripcion')[i].textContent||"");
		patente					= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
		estadoDescripcion		= (xml.getElementsByTagName('estadoDescripcion')[i].text||xml.getElementsByTagName('estadoDescripcion')[i].textContent||"");

		listaVehiculos	+= "<tr id='trNro"+i+"'>";
		listaVehiculos	+= "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</td>";
		listaVehiculos	+= "<td width='25%' align='center'>"+patente+"</td>";
		listaVehiculos	+= "<td width='25%' align='center'>"+tipoDescripcion+"</td>";
		listaVehiculos	+= "<td width='25%' align='center'>"+estadoDescripcion+"</td>";
		listaVehiculos	+= "<td width='20%'align='right'><input type='radio' id='radioVeh' name='radioVeh' value='"+codigo+"' onclick='document.getElementById(\"btnRadioVeh\").disabled = false' /></td>";
		listaVehiculos	+= "</tr>";
	}
	listaVehiculos += "<tr><td colspan='5'>&nbsp;</td></tr>";
	listaVehiculos += "<tr><td></td><td align='center' colspan='3'><input type='button' value='Aceptar' id='btnRadioVeh' onclick='aceptarListaVehiculos()' disabled></td>";
	listaVehiculos += "<td><input type='button' value='Cancelar' onclick='cerrarListaVehiculos()'></td></tr>";
	listaVehiculos += "</table>";
	document.getElementById("divListaVehiculos").innerHTML = listaVehiculos;
}

function aceptarListaVehiculos(){
	var codigoVeh = document.querySelector('input[name="radioVeh"]:checked').value;
	document.getElementById("divListaVehiculos").style.display = "none";
	document.getElementById("cubreVentana").style.display = "none";
	leeDatosVehiculo(codigoVeh,'','1');
}

function cerrarListaVehiculos(){
	document.getElementById("divListaVehiculos").style.display = "none";
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("textCodigoEquipo").value = "";
	document.getElementById("btnBuscarVehiculo").value = "BUSCAR";
	document.getElementById("btnBuscarVehiculo").disabled = "";
}

function asignaValores(procedencia, tipoVehiculo, marca, modelo, estado, codigoLugarReparacion, seccion, clasificacionCitacion, habilitarBotones){
	if(cargaProcedenciaVehiculo == 1 && cargaTipoVehiculo == 1 && cargaMarcaVehiculos == 1 && cargaModelosVehiculos == 1 && cargaEstadosRecurso == 1 && cargaLugaresDeReparacion == 1 && cargaClasificacionCitacion == 1){
		
		clearInterval(idAsignaSelectFichaVehiculo);
		document.getElementById("selProcedencia").value		= procedencia;
		document.getElementById("selTipoVehiculo").value	= tipoVehiculo;
		document.getElementById("selMarca").value			= marca;
		document.getElementById("selModelo").value			= modelo;
		document.getElementById("selSeccion").value			= seccion;
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value			= estado;
		document.getElementById("estadoBaseDatos").value	= estado;
		
		if(estado == 3000) document.getElementById('filaSeccion').style.visibility = 'hidden';
		
		if (seccion == "") seccion = 0;
		
		if(document.getElementById("selSeccion") !== null){
			document.getElementById("selSeccion").value			= seccion;
			document.getElementById("seccionBaseDatos").value	= seccion;
		}

		document.getElementById("selLugarReparacion").value = codigoLugarReparacion;
		document.getElementById("codLugarReparacionBaseDatos").value = codigoLugarReparacion;
		document.getElementById("selClasificacionCitacion").value = clasificacionCitacion;
		document.getElementById("codClasificacionCitacionBaseDatos").value = clasificacionCitacion;
		activaFechaNuevoEstado();
		
		if(habilitarBotones){
			activarBotones();
		} else{
			document.getElementById("labFechaEstado").disabled= "";
			document.getElementById("textFechaNuevoEstado").disabled= "";
			document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible";
			document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		}
		document.getElementById("mensajeCargando").style.display = "none";
	}
}

function guardarFichaVehiculo(codigoVehiculo){
	desactivarBotones();
	var validaOk = validarFichaVehiculo();
	var codigoVehiculo = document.getElementById("idVehiculo").value;
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCI\u00D3N :\nSE MODIFICAR\u00C1N LOS DATOS DE ESTE VEH\u00CDCULO EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizarVehiculo(codigoVehiculo);
			else activarBotones();
		}
		else {
			var msj=confirm("ATENCI\u00D3N :\nSE INGRESAR\u00C1N LOS DATOS DE ESTE VEH\u00CDCULO EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoVehiculo();
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}

function actualizarVehiculo(codigoVehiculo){
	
	var unidadUsuario			= document.getElementById("unidadUsuario").value;
	var patente					= eliminarBlancos(document.getElementById("textPatente").value);
	var numeroInstitucional		= eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var procedencia				= document.getElementById("selProcedencia").value;
	var tipoVehiculo			= document.getElementById("selTipoVehiculo").value;
	var marca					= document.getElementById("selMarca").value;
	var modelo					= document.getElementById("selModelo").value;
	var estado					= document.getElementById("selEstado").value;
	var fechaNuevoEstado		= document.getElementById("textFechaNuevoEstado").value;
	var numeroDocumento			= document.getElementById("textDocumentoNuevoEstado").value;
	var codigoEquipo			= document.getElementById("textCodigoEquipo").value;
	var codigoUnidadAgregado	= document.getElementById("codigoUnidadAgregado").value;
	var lugarReparacion			= document.getElementById("selLugarReparacion").value;
  	var seccion					= document.getElementById("selSeccion").value;
	var clasificacionCitacion	= document.getElementById("selClasificacionCitacion").value;
	var anno = document.getElementById("textAnnoFab").value;
	var valida = 1;
	var validaOculto = document.getElementById("validaAnnoOculto").value;
	
	var parametros = "";
	parametros += "patente="+patente+"&numeroInstitucional="+numeroInstitucional+"&procedencia="+procedencia;
	parametros += "&tipoVehiculo="+tipoVehiculo+"&marca="+marca+"&modelo="+modelo+"&seccion="+seccion+"&clasificacionCitacion="+clasificacionCitacion;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado+"&codigoVehiculo="+codigoVehiculo;
	parametros += "&numeroDocumento="+numeroDocumento+"&codigoEquipo="+codigoEquipo+"&codigoUnidadAgregado="+codigoUnidadAgregado;
	parametros += "&lugarReparacion="+lugarReparacion+"&anno="+anno+"&valida="+valida+"&validaOculto="+validaOculto;
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlActualizaVehiculo.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));
	objHttpXMLVehiculos.onreadystatechange=function(){
		if(objHttpXMLVehiculos.readyState == 4){
				if(objHttpXMLVehiculos.responseText != "VACIO"){
				//console.log(objHttpXMLVehiculos.responseText);
				var xml = objHttpXMLVehiculos.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if(codigo == 1){
						alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						document.getElementById("estadoBaseDatos").value = estado;
						// activaFechaNuevoEstado();
						idCargaListadoVehiculos = setInterval("cerrarVentanaFicha()",1000);
						top.leeVehiculos(unidadUsuario,'','');
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
	guardarFallas();
}

function cerrarVentanaFicha(){
	if (top.cargaListadoVehiculos == 1){
		clearInterval(idCargaListadoVehiculos);
		top.document.getElementById("cubreFondo").style.display = "none";
		top.Windows.closeAll();
	}
}

function activaVentanaIngresoFecha(boton){
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este Vehiculo :";
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo la Baja de este Vehiculo :";
}

function desactivaVentanaIngresoFecha(){
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("ventanaIngresoFecha").style.display  = "none";
}

function aceptaFechaVentanaIngresoFecha(){
	
	var ultimaFechaCargo = document.getElementById("ultimaFecha").value;
	var tipo = document.getElementById("textTipo").value;
	var fecha = document.getElementById("textFechaVentanaFecha").value;
	
	var fechaLimite 	= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada	= top.document.getElementById("textUnidadBloqueada").value;
	
	if(fecha == ""){
		alert("DEBE INDICAR UNA FECHA ....");
		return false;
	}
	
	var comparaFechaLimite = comparaFecha(fechaLimite,fecha);
	if(unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
	}
		
	var fechaMayor = comparaFecha(ultimaFechaCargo,fecha);
	if(fechaMayor == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaCargo);
		return false;
	}
	
	var cantidadServicio = controlEstadoVehiculo(fecha);
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		return false;
	}
	
	document.getElementById("ventanaIngresoFecha").style.display  = "none";
	document.getElementById("cubreVentana").style.display = "none"; 
	
	if(tipo == 1) liberaVehiculo(document.getElementById("idVehiculo").value);
	if(tipo == 2) validarBaja();
	
}

function liberaVehiculo(codigoVehiculo){
	
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACAR\u00C1 ESTE VEH\u00CDCULO DE LA OFERTA DE LA UNIDAD.                                       \n\u00BFDESEA CONTINUAR?...");
	if(msj){
		desactivarBotones();
		var parametros = "";
		var validaOk = true;
		if(validaOk){
			parametros += "codigoVehiculo="+codigoVehiculo;
			parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
			var objHttpXMLVehiculos = new AJAXCrearObjeto();
			objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlLiberaVehiculo.php",true);
			objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpXMLVehiculos.send(encodeURI(parametros));
			objHttpXMLVehiculos.onreadystatechange=function(){
				if(objHttpXMLVehiculos.readyState == 4){       
					if(objHttpXMLVehiculos.responseText != "VACIO"){
						//console.log(objHttpXMLVehiculos.responseText);
						var xml = objHttpXMLVehiculos.responseXML.documentElement;
						for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
							var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
							if(codigo == 1){
								alert('EL VEHICULO FUE DEJADO DISPONIBLE PARA OTRA UNIDAD ......        ');
								top.leeVehiculos(unidadUsuario,'','');
							 	idCargaListadoVehiculos = setInterval("cerrarVentanaFicha()",1000);
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
						}
					}
				}
			}
		}
	guardarFallas();
	} else {
		activarBotones();
	}
}

function validarBaja(){
	var msj=confirm("SACAR\u00C1 ESTE VEH\u00CDCULO DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n\u00BFDESEA CONTINUAR?...");
	if(msj){
		activaVentanaIngresoContrasena();
	} else {
		activarBotones();
	}
}

function activaVentanaIngresoContrasena(){
	desactivarBotones();
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaIngresoContrasena").style.display  = "";
	document.getElementById("ventanaIngresoContrasena").style.zIndex  = "200";
	document.getElementById("textTituloContrasena").innerHTML = "INGRESE SU CONTRASE\u00D1A PARA VALIDAR LA BAJA DEL VEH\u00CDCULO:";
}

function validaContrasena(){
	var codigoVehiculo = document.getElementById("idVehiculo").value;
	var valida = document.getElementById("textContrasena").value;
	var contrasena = document.getElementById("contrasena").value;
	
	if(valida == ""){
		document.getElementById("textContrasena").focus();
		alert("DEBE INGRESAR SU CLAVE DE USUARIO PROSERVIPOL");
		return false;
	}
	if (valida == contrasena){
		bajaVehiculo(codigoVehiculo);
	}
	else{
		document.getElementById("textTituloContrasena").innerHTML = "CONTRASE\u00D1A ERRONEA, VUELVA A INGRESAR SU CONTRASE\u00D1A PARA VALIDAR LA BAJA DEL VEH\u00CDCULO:";
		document.getElementById("textContrasena").value = "";
	}
}

function desactivaVentanaIngresoContrasena(){
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("ventanaIngresoContrasena").style.display  = "none";
}

function bajaVehiculo(codigoVehiculo){
	
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	desactivarBotones();
	
	var parametros = "";
	parametros += "codigoVehiculo="+codigoVehiculo;
	parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlBajaVehiculo.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));
	objHttpXMLVehiculos.onreadystatechange=function(){
		if(objHttpXMLVehiculos.readyState == 4){
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml = objHttpXMLVehiculos.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('EL VEH\u00CDCULO FUE DADO DE BAJA ......        ');
						top.leeVehiculos(unidadUsuario,'','');
						idCargaListadoVehiculos = setInterval("cerrarVentanaFicha()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
	guardarFallas();
}

function validarFichaVehiculo(){
	var patente				 	= eliminarBlancos(document.getElementById("textPatente").value);
	var numeroInstitucional		= eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var procedencia				= document.getElementById("selProcedencia").value;
	var tipoVehiculo			= document.getElementById("selTipoVehiculo").value;
	var marca					= document.getElementById("selMarca").value;
	var modelo					= document.getElementById("selModelo").value;
	var estado					= document.getElementById("selEstado").value;
	var fechaEstado				= document.getElementById("textFechaNuevoEstado").value;
	var numeroDocumento			= eliminarBlancos(document.getElementById("textDocumentoNuevoEstado").value);
	var ultimaFechaEstado		= document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado	= document.getElementById("codigoUnidadAgregado").value;
	var lugarReparacion			= document.getElementById("selLugarReparacion").value;
	var fechaLimite				= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada			= top.document.getElementById("textUnidadBloqueada").value;
	var codigoVehiculo			= document.getElementById("idVehiculo").value;
	var clasificacionCitacion	= document.getElementById("selClasificacionCitacion").value;

	var validaAnnoOculto = document.getElementById("validaAnnoOculto").value;
	var annoFabricacion = document.getElementById("textAnnoFab").value;
	var date = new Date();
	var anno = (date.getFullYear()+1);
	
	if (patente == "") {
		alert("DEBE INDICAR LA PATENTE DEL VEH\u00CDCULO ...... 	     ");
		document.getElementById("textPatente").focus();
		return false;
	}
	
	if (numeroInstitucional == "") {
		alert("DEBE INDICAR EL N\u00DAMERO INSTITUCIONAL DEL VEH\u00CDCULO ...... 	     ");
		document.getElementById("textNumeroInstitucional").focus();
		return false;
	}
	
	if (procedencia == 0) {
		alert("DEBE INDICAR LA PROCEDENCIA DEL VEH\u00CDCULO ...... 	     ");
		document.getElementById("selProcedencia").focus();
		return false;
	}
	
	if (tipoVehiculo == 0) {
		alert("DEBE INDICAR EL TIPO DE VEH\u00CDCULO ...... 	     ");
		document.getElementById("selTipoVehiculo").focus();
		return false;
	}	
	
	if (marca == 0) {
		alert("DEBE INDICAR LA MARCA DEL VEH\u00CDCULO ...... 	     ");
		document.getElementById("selMarca").focus();
		return false;
	}	
	
	if (modelo == 0) {
		alert("DEBE INDICAR EL MODELO DEL VEH\u00CDCULO ...... 	     ");
		document.getElementById("selModelo").focus();
		return false;
	}	
	
	if (estado == 0) {
		alert("DEBE INDICAR EL ESTADO DEL VEH\u00CDCULO ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	
 	if (annoFabricacion < 1950 || annoFabricacion > anno) {
		alert("EL A\u00D1O DEBE SER UNA CIFRA ENTRE 1950 Y EL A\u00D1O ACTUAL +1 ...... 	     ");
		document.getElementById("textAnnoFab").focus();
		return false;
	}

	if(validaAnnoOculto==0){
		if (annoFabricacion == "" || annoFabricacion == 0) {
			alert("DEBE INDICAR EL A\u00D1O DE FABRICACI\u00D3N DEL VEH\u00CDCULO ...... 	     ");
			document.getElementById("textAnnoFab").focus();
			return false;
		}
	}	
	
	if ((estado == 21 || estado == 31 || estado == 32 || estado == 70) && lugarReparacion == 0){
		alert("DEBE INDICAR LUGAR DE LA MANTENCI\u00D3N O REPARACI\u00D3N.    ");
		document.getElementById("selLugarReparacion").focus();
		return false;
	}
	
	if((estado == 21 || estado == 31 || estado == 32 || estado == 70 || estado == 80) && clasificacionCitacion == 0){
		alert("DEBE INDICAR LA CAUSA DE NO DISPONIBILIDAD.    ");
		document.getElementById("selClasificacionCitacion").focus();
		return false;
	}

	if (document.getElementById("selLugarReparacion").value == 0) document.getElementById("selLugarReparacion").value = "";
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ||
		document.getElementById("codigoUnidadAgregado").value != document.getElementById("codUnidadAgregadoBaseDatos").value ||
		document.getElementById("selLugarReparacion").value != document.getElementById("codLugarReparacionBaseDatos").value){
		
		if (fechaEstado == ""  && document.getElementById("selEstado").value == ""){
			alert("DEBE INDICAR FECHA DEL NUEVO ESTADO ...... 	     ");
			return false;
		}else if(fechaEstado == "" && document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ){
				alert("DEBE INDICAR FECHA DEL NUEVO ESTADO ...... 	     ");
			return false;
		}
		
		if (estado == 30 && numeroDocumento == ""){
			alert("DEBE INDICAR DOCUMENTO EN QUE SE SOLICITA REPARACI\u00D3N.    ");
			document.getElementById("textDocumentoNuevoEstado").focus();
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
		
		if(codigoVehiculo!=""){
			var cantidadServicio = controlEstadoVehiculo(fechaEstado);
			if(cantidadServicio!=""){
				alert(cantidadServicio);
				return false;
			}
		}
		if (estado == 3000 && codigoUnidadAgregado == ""){
			alert("DEBE INDICAR UNIDAD A LA QUE EL VEH\u00CDCULO SE FUE AGREGADO...... 	     ");
			return false;
		}
	}
	return true;
}

function verHistoriaVehiculo(codigoVehiculo){
	var pagina = "vistaHistoriaVehiculo.php?codigoVehiculo="+codigoVehiculo;
	top.abrirVentana('HISTORIA VEH\u00CDCULO ... ', '750', '400', pagina, '', 'true', '100', '230');
}

function activaFechaNuevoEstado(){
	var subMenu = document.getElementById("subMenu").value;
	
	if(document.getElementById("selSeccion") !== null){
		var Seccion = document.getElementById("selSeccion").value;
		var SeccionDB = document.getElementById("seccionBaseDatos").value;
	}
	else{
		var Seccion = 0;
		var SeccionDB = '';
	}
	
	if(document.getElementById("subMenu").value!='Agregado') document.getElementById("btnGuardar").disabled = "";
	
	if ((document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value) || (Seccion != SeccionDB)){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		if (document.getElementById("selEstado").value == 30){
			document.getElementById("labDocumentoEstado").disabled= "";
			document.getElementById("textDocumentoNuevoEstado").disabled= "";
			document.getElementById("textDocumentoNuevoEstado").style.backgroundColor = "";
		} else {
			document.getElementById("textDocumentoNuevoEstado").value= "";
			document.getElementById("labDocumentoEstado").disabled= "true";
			document.getElementById("textDocumentoNuevoEstado").disabled= "true";
			document.getElementById("textDocumentoNuevoEstado").style.backgroundColor = "#E6E6E6";
		}
		
		if (document.getElementById("selEstado").value == 21 || document.getElementById("selEstado").value == 31 || document.getElementById("selEstado").value == 32 || document.getElementById("selEstado").value == 70){
			document.getElementById("selLugarReparacion").value = 0;
			document.getElementById("labLugarReparacion").disabled= "";
			document.getElementById("selLugarReparacion").disabled= "";
			document.getElementById("selLugarReparacion").style.backgroundColor = "";
		} else {
			document.getElementById("selLugarReparacion").value= "0";
			document.getElementById("selLugarReparacion").disabled= "true";
			document.getElementById("labLugarReparacion").disabled= "true";
			document.getElementById("selLugarReparacion").style.backgroundColor = "#E6E6E6";
		}
		
		if (document.getElementById("selEstado").value == 21 || document.getElementById("selEstado").value == 31 || document.getElementById("selEstado").value == 32 || document.getElementById("selEstado").value == 70 || document.getElementById("selEstado").value == 80){
			document.getElementById("selClasificacionCitacion").value = 0;
			document.getElementById("selClasificacionCitacion").disabled= "";
			document.getElementById("labClasificacionCitacion").disabled= "";
			document.getElementById("selClasificacionCitacion").style.backgroundColor = "";
		} else {
			document.getElementById("selClasificacionCitacion").value= "0";
			document.getElementById("selClasificacionCitacion").disabled= "true";
			document.getElementById("labClasificacionCitacion").disabled= "true";
			document.getElementById("selClasificacionCitacion").style.backgroundColor = "#E6E6E6";
		}
		
		if(subMenu == 'Dotacion' && document.getElementById("selEstado").value == 3000){
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
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
		
		document.getElementById("labDocumentoEstado").disabled = true;
		document.getElementById("textDocumentoNuevoEstado").value = "";
		document.getElementById("textDocumentoNuevoEstado").disabled = true;
		document.getElementById("textDocumentoNuevoEstado").style.backgroundColor = "#E6E6E6";
		
		if (document.getElementById("selEstado").value == 21 || document.getElementById("selEstado").value == 31 || document.getElementById("selEstado").value == 32  || document.getElementById("selEstado").value == 70){
			
			document.getElementById("labLugarReparacion").disabled= "";
			
			document.getElementById("selLugarReparacion").disabled= "";
			document.getElementById("selLugarReparacion").value = document.getElementById("codLugarReparacionBaseDatos").value;
			document.getElementById("selLugarReparacion").style.backgroundColor = "";
		} else {
			document.getElementById("selLugarReparacion").value= "0";
			document.getElementById("selLugarReparacion").disabled= "true";
			document.getElementById("labLugarReparacion").disabled= "true";
			document.getElementById("selLugarReparacion").style.backgroundColor = "#E6E6E6";
		}
		
		if (document.getElementById("selEstado").value == 21 || document.getElementById("selEstado").value == 31 || document.getElementById("selEstado").value == 32 || document.getElementById("selEstado").value == 70 || document.getElementById("selEstado").value == 80){
			document.getElementById("selClasificacionCitacion").disabled= "";
			document.getElementById("labClasificacionCitacion").disabled= "";
			document.getElementById("selClasificacionCitacion").style.backgroundColor = "";
		} else {
			document.getElementById("selClasificacionCitacion").disabled= "true";
			document.getElementById("labClasificacionCitacion").disabled= "true";
			document.getElementById("selClasificacionCitacion").style.backgroundColor = "#E6E6E6";
		}
		
		if(subMenu == 'Dotacion' && document.getElementById("selEstado").value == 3000){
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

function habilitarCambioLugarReparacion(){
	if ((document.getElementById("selLugarReparacion").value != document.getElementById("codLugarReparacionBaseDatos").value) || document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
	} else {
		document.getElementById("labFechaEstado").disabled= "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
	}
}

function leeHistoricoEstados(vehiculoId){
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoHistoricoVehiculo");
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlVehiculoEstadoHistorico.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("vehiculoId="+vehiculoId));
	objHttpXMLVehiculos.onreadystatechange=function()	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4){  
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var fecha	 			= "";
				var unidad				= "";
				var estado 				= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoHistorico	= "";
				
				listadoHistorico = "<table cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('estadoHistorico').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					fecha				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					unidad				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					estado				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					resaltarLinea		= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
					var nroLinea = i + 1;
					
					listadoHistorico += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
					listadoHistorico += "<td width='140px' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoHistorico += "<td width='253px' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoHistorico += "<td width='292px' align='left'><div id='valorColumna'>"+unidad+"</div></td>";
					listadoHistorico += "</tr>";
				}
				listadoHistorico += "</table>";
				div.innerHTML = listadoHistorico;
			}
		}
	}
}

function desactivarBotones(){
	if(sinPosponer)	document.getElementById("btnDejarDisponible").disabled = "true";
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardar").disabled = "true";
	document.getElementById("btnCerrarFicha").disabled = "true";
}

function activarBotones(){
	var permisoRegistrar = document.getElementById("permisoRegistrar").value;
	var subMenu = document.getElementById("subMenu").value;
	if(permisoRegistrar && subMenu == 'Dotacion') {
		if(sinPosponer) document.getElementById("btnDejarDisponible").disabled = "";
		document.getElementById("btnBaja").disabled = "";
		document.getElementById("btnGuardar").disabled = "";
	}
	document.getElementById("btnCerrarFicha").disabled = "";
}

function muestraListaVehiculos(unidad, tipoVehiculo){
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("kk");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculos.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&tipoVehiculo="+tipoVehiculo));
	objHttpXMLVehiculos.onreadystatechange=function(){
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)	{
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			= "";
				var tipoVehiculo		= "";
				var patente		 		= "";
				var codigoEquipo		= "";
				var estado	 			= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoVehiculos	= "";
				
				listadoVehiculos = "<table width='98%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipoVehiculo	= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					patente			= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
					codigoEquipo	= (xml.getElementsByTagName('codigoEquipo')[i].text||xml.getElementsByTagName('codigoEquipo')[i].textContent||"");
					estado			= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada2')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "";
					
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='41%'><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
					listadoVehiculos += "<td width='10%'><div id='valorColumna'>"+patente+"</div></td>";
					listadoVehiculos += "<td width='21%' align='left'><div id='valorColumna'>"+codigoEquipo+"</div></td>";
					listadoVehiculos+= "<td width='23%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos += "</tr>";
				}
				listadoVehiculos += "</table>";
				div.innerHTML = listadoVehiculos;
			}
		}
	}
}

function activaBuscaUnidadAgregado(){
	desactivarBotones();
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}

function ValidaSoloNumeros() {
 	if ((event.keyCode < 48) || (event.keyCode > 57)) event.returnValue = false;
}

function ValidaSoloNumerosK() {
	if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode != 75 && event.keyCode != 107)) event.returnValue = false;
}

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";  
	if (sentido == "desc") nuevoSentido = "asc"; 
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	
	if(document.getElementById("labColUnidad")!=null){
		leeVehiculosA(unidad, atributo, sentido);
	}
	else{
		leeVehiculos(unidad, atributo, sentido);
	}
	
	switch(atributo){
		case "tipo":
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColPatente").innerHTML = "PATENTE";
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColTipo").innerHTML  = "TIPO VEH&Iacute;ULO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colTipo").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "marca":
			document.getElementById("labColTipo").innerHTML = "TIPO VEH&Iacute;ULO";
			document.getElementById("labColPatente").innerHTML = "PATENTE";
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCI&Oacute;N";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colMarca").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "patente":
			document.getElementById("labColTipo").innerHTML = "TIPO VEH&Iacute;ULO";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCI&Oacute;N";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColPatente").innerHTML = "PATENTE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colPatente").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "codigoEquipo":
			document.getElementById("labColTipo").innerHTML = "TIPO VEH&Iacute;ULO";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColPatente").innerHTML = "PATENTE";
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCI&Oacute;N";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigoEquipo").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};

			break;
		
		case "seccion":
			document.getElementById("labColTipo").innerHTML = "TIPO VEH&Iacute;ULO";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColPatente").innerHTML = "PATENTE";
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML  = "SECCI&Oacute;N&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colSeccion").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}

			break;
			
		case "estado":
			document.getElementById("labColTipo").innerHTML = "TIPO VEH&Iacute;ULO";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColPatente").innerHTML = "PATENTE";
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCI&Oacute;N";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML  = "ESTADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colEstado").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}

			break;
			
		case "unidad":
			document.getElementById("labColTipo").innerHTML = "TIPO VEH&Iacute;ULO";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColPatente").innerHTML = "PATENTE";
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCI&Oacute;N";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML  = "UNIDAD ORIGEN&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colUnidad").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			break;

		case "nroTarjeta":
			document.getElementById("labColTipo").innerHTML = "TIPO VEH&Iacute;ULO";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColPatente").innerHTML = "PATENTE";
			document.getElementById("labColCodigoEquipo").innerHTML = "CODIGO EQUIPO";
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCI&Oacute;N";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColNroTarjeta").innerHTML = "TARJETA COMBUSTIBLE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNroTarjeta").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
	}
	idCargaListadoVehiculos = setInterval("tituloColumnaNormal("+columna.id+")",500);
}

function tituloColumnaNormal(columna){
	if (cargaListadoVehiculos == 1){
		clearInterval(idCargaListadoVehiculos);
		cambiarClase(columna,'nombreColumna');
	}
}

function posponerIngreso(){
	sinPosponer = false;
	document.getElementById('btnDejarDisponible').disabled = "disabled";
	leeEstadosVehiculosLimitado('selEstado');
	cambiaPaginaFallas();
}

function cambiaPaginaFallas(){
	var basicos  = document.getElementById("divDatosBasicos").style.visibility;
	var fallas	 = document.getElementById("divDatosFalla").style.visibility;
	if (basicos == "visible") {
		document.getElementById("divDatosBasicos").style.visibility	= "hidden";
		document.getElementById("divDatosFalla").style.visibility	= "visible";
		document.getElementById('filaSeccion').style.visibility		= 'hidden';
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden";
		selectFallasDisponibles();
	}
	else if (fallas == "visible") {
		document.getElementById("divDatosFalla").style.visibility	= "hidden";
		document.getElementById("divDatosBasicos").style.visibility	= "visible";
		document.getElementById('filaSeccion').style.visibility		= 'visible';
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible";
	}
}

function selectFallasDisponibles(){
	document.getElementById("fallasPosibles").length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById("fallasPosibles").options[0] = datosOpcion;
	var objHttpXMLFallas = new AJAXCrearObjeto();	
	objHttpXMLFallas.open("POST","./xml/xmlVehiculos/xmlListaFallasDisponibles.php",true);
	objHttpXMLFallas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFallas.send(encodeURI()); 
	objHttpXMLFallas.onreadystatechange=function(){
		//alert(objHttpXMLFallas.responseText);
		if(objHttpXMLFallas.readyState == 4){
			if (objHttpXMLFallas.responseText != "VACIO"){
				var xml		= objHttpXMLFallas.responseXML.documentElement;
				var codigo	= "";
				var nombre	= "";
				var puntero	= 0;
				for(i=0;i<xml.getElementsByTagName('falla').length;i++){
					codigo	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
					var datosOpcion = new Option(nombre, codigo, "", "");
					document.getElementById("fallasPosibles").options[puntero] = datosOpcion;
					puntero++;
				}
			} else {
				document.getElementById("fallasPosibles").length = null;
				alert("NO EXISTEN FALLAS PARA REGISTRAR.   ");
			}
			habilitarBotonesAgregarQuitar();
		}
	}
}

function asignarFalla(){
	moverDatos('fallasPosibles','fallasPresente');
	ordenar(document.getElementById('fallasPresente'));
	habilitarBotonesAgregarQuitar();
}

function desasignarFalla(){
	moverDatos('fallasPresente','fallasPosibles');
	ordenar(document.getElementById('fallasPosibles'));
	habilitarBotonesAgregarQuitar();
}

function habilitarBotonesAgregarQuitar(){
	var cantidadDisponible = document.getElementById('fallasPosibles').length;
	var cantidadAsignado   = document.getElementById('fallasPresente').length;
	
	if(cantidadDisponible == 0) document.getElementById('Btn_Agregar').disabled = "true";
	else document.getElementById('Btn_Agregar').disabled = "";
	
	if(cantidadAsignado == 0) document.getElementById('Btn_Quitar').disabled = "true";
	else document.getElementById('Btn_Quitar').disabled = "";
	
	document.getElementById('tituloFallasPosibles').innerHTML = "FALLAS POSIBLES (" + cantidadDisponible + ")";
	document.getElementById('tituloFallasPresentes').innerHTML = "FALLAS PRESENTES (" + cantidadAsignado + ")";
}

function capturaCorrelativo(){
	var codigoVehiculo 	 = document.getElementById("idVehiculo").value;
	var objHttpXMLEstado = new AJAXCrearObjeto();
	objHttpXMLEstado.open("POST","./xml/xmlVehiculos/xmlCorrelativoAnterior.php",false);
	objHttpXMLEstado.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLEstado.send(encodeURI("codigoVehiculo="+codigoVehiculo));
	//alert(objHttpXMLEstado.responseText);
	if(objHttpXMLEstado.responseText != "VACIO") {
		var xml = objHttpXMLEstado.responseXML.documentElement;
		var ultimoCorrelativo = (xml.getElementsByTagName('ultimoCorrelativo')[0].text||xml.getElementsByTagName('ultimoCorrelativo')[0].textContent||"");
		document.getElementById("correlativo").value = ultimoCorrelativo;
	}
}

function validacionFallas(){
	var rutaArchivo = document.getElementById("archivo").value;
	var cantFallas = document.getElementById('fallasPresente').length;
	var extension	= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toLowerCase();
	var extensiones_permitidas 	= new Array(".jpg", ".jpeg", ".png", ".pdf");
	var noaceptada	= true;
	
	if(cantFallas==0){
		alert("DEBE INDICAR LAS FALLAS QUE PRESENTABA EL VEH\u00CDCULO EN REPARACI\u00D3N...");
		return false;
	}
	
	if(rutaArchivo==""){
		alert("DEBE SUBIR EL DOCUMENTO EMITIDO POR LA INSTANCIA QUE REALIZ\u00D3 LA REPARACI\u00D3N...");
		return false;
	}
	
	for (var i = 0; i < extensiones_permitidas.length; i++){
		if(extensiones_permitidas[i] == extension){
			noaceptada = false;
		}
	}

	if(noaceptada){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO JPG, JPEG, PNG O PDF");
	return false;
	}

	cambiaPaginaFallas();
	return true;
}

function guardarFallas(){
	var cantFallas = document.getElementById('fallasPresente').length;
	var correlativo = document.getElementById('correlativo').value;
	var codigoVehiculo = document.getElementById('idVehiculo').value;
	var unidad = document.getElementById('unidadUsuario').value;
	var Falla = new Array;
	
	if(subirArchivo()){
		for(i=0;i<cantFallas;i++){
			Falla[i] = document.getElementById('fallasPresente').options[i].value;
		}
		var rutArchi = document.getElementById('rutArchi').value;
		var Fallas = php_serialize(Falla);
		var parametros = "codVehiculo="+codigoVehiculo+"&correlativo="+correlativo+"&unidad="+unidad+"&fallas="+Fallas+"&archivo="+rutArchi;
		var objHttpXMLFallas = new AJAXCrearObjeto();
		objHttpXMLFallas.open("POST","./xml/xmlVehiculos/xmlRegistraFallas.php",false);
		objHttpXMLFallas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLFallas.send(encodeURI(parametros));
		//alert(objHttpXMLFallas.responseText);
		if (objHttpXMLFallas.responseText != "VACIO"){
			var xml		= objHttpXMLFallas.responseXML.documentElement;
			var codigo	= (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
			if (codigo != 1) alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
		}
	}
}

function subirArchivo(){
	var rutaArchivo	= document.getElementById("archivo").value;
	var extension	= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toLowerCase();
	var CodigoEquipo = document.getElementById("textCodigoEquipo").value;
	var f = new Date();
	var fechaHoy = "Y" + f.getFullYear() + " M" + (f.getMonth()+1) + " D" + f.getDate() + " Hm" + f.getHours() + " " + f.getMinutes();
	var NombreArchi = CodigoEquipo+" - "+fechaHoy;
	if(rutaArchivo=="") return false;
	rutaArchivo = NombreArchi+extension;
	document.getElementById("rutArchi").value = rutaArchivo;
	document.formSubeArchivo.submit();
	return true;
}

function fallaPospuestaDatos(codigoVehiculo){
	var objHttpXMLFallas	= new AJAXCrearObjeto();
	var parametros = "codVehiculo="+codigoVehiculo;
	objHttpXMLFallas.open("POST","./xml/xmlVehiculos/xmlFallaVehiculoPendiente.php",true);
	objHttpXMLFallas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFallas.send(encodeURI(parametros));
	objHttpXMLFallas.onreadystatechange=function(){
		//alert(objHttpXMLFallas.readyState);
		if(objHttpXMLFallas.readyState == 4){
			//alert(objHttpXMLFallas.responseText);
			if (objHttpXMLFallas.responseText != "VACIO"){
				//alert(objHttpXMLFallas.responseText);
				var xml			= objHttpXMLFallas.responseXML.documentElement;
				var codigo		= "";
				var correlativo	= "";
				var fechaEstado	= "";
				document.getElementById("btnPosponer").disabled = "true";
				var mensajeEstados = "";
				mensajeEstados	+= "ATENCI\u00D3N :\n\n";
				mensajeEstados	+= "INDICAR LAS FALLAS QUE PRESENTO EL VEH\u00CDCULO.\n\n";
				codigo		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
				correlativo	= (xml.getElementsByTagName('correlativo')[i].text||xml.getElementsByTagName('correlativo')[i].textContent||"");
				fechaEstado	= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
				document.getElementById("correlativo").value = correlativo;
				alert(mensajeEstados);
				cambiaPaginaFallas();
			}
		}
	}
}

function fallaObligatoria(){
	var estado = document.getElementById("selEstado").value;
	var estadoActual = document.getElementById("estadoBaseDatos").value;
	var cantFallas = document.getElementById('fallasPresente').length;
	if(cantFallas==0 && estadoActual==1000){
		alert("DEBE INDICAR LAS FALLAS QUE PRESENTO EL VEH\u00CDCULO ANTES DE REALIZAR ESTE MOVIMIENTO.");
		cambiaPaginaFallas();
		document.getElementById("btnPosponer").disabled = "true";
		return false;
	}
	return true;
}

function llamaFalla(){
	var estado = document.getElementById("selEstado").value;
	var estadoActual = document.getElementById("estadoBaseDatos").value;
	if((estado==10 && estadoActual==31)||(estado==10 && estadoActual==32) ||(estado==10 && estadoActual==21)||(estado==10 && estadoActual==40)){
		alert("INDIQUE LAS FALLAS QUE PRESENTO EL VEH\u00CDCULO");
		cambiaPaginaFallas();
	}
}

function obligaEstado(){
  var estado = document.getElementById("selEstado").value;
	var estadoActual = document.getElementById("estadoBaseDatos").value;
	if((estadoActual==31)||(estadoActual==32) ||(estadoActual==21) ||(estadoActual==40)){
		var estado = document.getElementById("selEstado").value=1000;
	}
}

function fallaPospuesta(){
	var objHttpXMLFallas 	= new AJAXCrearObjeto();
	objHttpXMLFallas.open("POST","./xml/xmlVehiculos/xmlFallaVehiculoPendienteLista.php",true);
	objHttpXMLFallas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFallas.send(encodeURI());  
	objHttpXMLFallas.onreadystatechange=function(){
		//alert(objHttpXMLFallas.readyState);
		if(objHttpXMLFallas.readyState == 4){
			//alert(objHttpXMLFallas.responseText);
			if (objHttpXMLFallas.responseText != "VACIO"){
				//alert(objHttpXMLFallas.responseText);
				var xml		= objHttpXMLFallas.responseXML.documentElement;
				var patente	= "";
				var tipo	= "";
				var modelo	= "";
				var mensaje	= "";
				mensaje += "ATENCI\u00D3N :\n";
				mensaje += "EXISTEN VEH\u00CDCULOS PENDIENTES PARA EL INGRESO DE FALLAS, DEBE REGULARIZAR:\n\n";
				for(i=0;i<xml.getElementsByTagName('falla').length;i++){
					patente	= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
					tipo	= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					modelo	= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					mensaje	+= (i+1)+" - "+patente+" - "+tipo+" "+modelo+"\n";
				}
				alert(mensaje);
				self.location.href='vehiculos.php';
			}
		}
	}
}

function sinRegularizar(){
	var estado = document.getElementById("selEstado").value;
	var estadoActual = document.getElementById("estadoBaseDatos").value;
	if(estado==1000 && estadoActual==10){
		alert("EL ESTADO ACTIVO SIN REGULARIZAR, SOLO ES VALIDO PARA POSPONER EL INGRESO DE LAS FALLAS DE LOS VEH\u00CDCULOS ...");
		cerrarVentanaFicha();
	}
}

function controlEstadoVehiculo(fecha){ 
	var codigoVehiculo = document.getElementById("idVehiculo").value;
	var fecha2 	= '01-01-3000';
	var mensaje	=	"";
	var parametros = "codigoVehiculo="+codigoVehiculo+"&fecha1="+fecha+"&fecha2="+fecha2;
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlServicios/xmlListaServiciosPorVehiculo.php",false);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));
	//alert(objHttpXMLVehiculos.responseText);
	if (objHttpXMLVehiculos.responseText != "VACIO"){
		mensaje += "NO PUEDE CAMBIAR DE ESTADO, PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		var xml = objHttpXMLVehiculos.responseXML.documentElement;
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio 	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad 	 	= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
	}
	return mensaje;
}

var listaClasificacionCitacion	= [];
function regularizarClasificacionCitacion(){
	var permisoConsultarPerfil = document.getElementById('permisoConsultarPerfil').value;
	var objHttpXMLClasificacionCitacion	= new AJAXCrearObjeto();
	objHttpXMLClasificacionCitacion.open("POST","./xml/xmlVehiculos/xmlClasificacionCitacionVehiculos.php",true);
	objHttpXMLClasificacionCitacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLClasificacionCitacion.send(encodeURI());
	objHttpXMLClasificacionCitacion.onreadystatechange=function(){
		//alert(objHttpXMLClasificacionCitacion.readyState);
		if(objHttpXMLClasificacionCitacion.readyState == 4){
			//console.log(objHttpXMLClasificacionCitacion.responseText);
			if (objHttpXMLClasificacionCitacion.responseText != "VACIO"){
				//alert(objHttpXMLClasificacionCitacion.responseText);
				var xml			= objHttpXMLClasificacionCitacion.responseXML.documentElement;
				var codigo		= "";
				var patente 	= "";
				var tipo 		= "";
				var estado 		= "";
				var fondoLinea	= "";
				var sw 			= 0;
				var div			= '<table><tr><td>PATENTE</td><td>TIPO VEHICULO</td><td>ESTADO ACTUAL</td><td></td></tr>';
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					codigo	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					patente	= (xml.getElementsByTagName('patente')[i].text||xml.getElementsByTagName('patente')[i].textContent||"");
					tipo	= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					estado	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					div		+= '<tr class="'+fondoLinea+'"><td>'+patente+'</td><td>'+tipo+'</td><td>'+estado+'</td><td><select id="'+codigo+'" ><option value="0">SELECCIONE UNA OPCION ... </option><option value="10">MANTENCI&Oacute;N</option><option value="20">FALLA</option><option value="30">CHOQUE-COLICI&Oacute;N</option></select></td></tr>';
					listaClasificacionCitacion.push(codigo);
				}
				document.getElementById('clasificacionCitacion').className='modal-wrapperTarget';
				var click = (permisoConsultarPerfil) ? "document.getElementById(\"clasificacionCitacion\").className=\"modal-wrapper\"" : "cerrarAplicacion();";
				document.getElementById('datos-vehiculos').innerHTML = div+"</table><a class='popup-cerrar' onclick='"+click+"'>X</a>";
			}
		}
	}
}

function aceptarClasificacionCitacion(){
	var listArray = [];
	for(i=0;i<listaClasificacionCitacion.length;i++){
		if(document.getElementById(listaClasificacionCitacion[i]).value==0){
			alert("Completar los datos de toda la lista de causas de no disponibilidad.");
			return false;
		}
		listArray.push({id: listaClasificacionCitacion[i], valor: document.getElementById(listaClasificacionCitacion[i]).value});
	}
	var listCargar = php_serialize(listArray);
	var objHttpXMLListaClasificacion = new AJAXCrearObjeto();
	objHttpXMLListaClasificacion.open("POST","./xml/xmlVehiculos/xmlCargarListaClasificacionCitacionVehiculos.php",false);
	objHttpXMLListaClasificacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLListaClasificacion.send(encodeURI("lista="+listCargar));
	//console.log(objHttpXMLListaClasificacion.responseText);
	if(objHttpXMLListaClasificacion.responseText != "VACIO"){
		var xml = objHttpXMLListaClasificacion.responseXML.documentElement;
		var codigo = (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
		if(codigo != 1) document.getElementById("clasificacionCitacion").className="modal-wrapper";
	}
}

function activaIngresoTarjeta(){
	desactivarBotones();
	textNroTarjeta.value	= "";
	textNroTarjetaDV.value	= "";
	textFechaTarjeta.value	= "";
	archivoTC.value			= "";
	bottonCargarArchivo.style.display = "block";
	bottonArchivoCargado.style.display = "none";
	PatenteDIV.innerHTML = textPatente.value;
	cubreVentana.style.display			= "";
	ventanaIngresoTarjeta.style.display	= "";
}

function activarBottonActualizarTarjetaCombustible(){
	if(confirm("Esta seguro de actualizar los datos de la tarjeta de combustible de este vehiculo")){
		nroTarjertaDIV.innerHTML = "";
		nroTarjeta.style.display = "none";
		btnSubirTarjeta.style.display = "block";
	}
}

function archivoCargado(){
	var archivoTCAux			= archivoTC.value;
	var extension				= (archivoTCAux.substring(archivoTCAux.lastIndexOf("."))).toUpperCase();
	var extensiones_permitidas	= new Array(".JPG", ".JPEG", ".PNG");
	if(!extensiones_permitidas.includes(extension)){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO JPG, JPEG O PNG");
		archivoTC.value = "";
		return false;
	}
	rutaArchivo.value = 'NT'+textNroTarjeta.value+'-'+textNroTarjetaDV.value+'CV'+idVehiculo.value+extension;
	bottonCargarArchivo.style.display = 'none';
	bottonArchivoCargado.style.display = 'block';
}

function eliminarArchivo(){
	if(confirm("Desea sustituir el archivo")){
		bottonCargarArchivo.style.display = 'block';
		bottonArchivoCargado.style.display = 'none';
		archivoTC.value='';
	}
}

function aceptarCambioTarjetaCombustible(){
	if(textNroTarjeta.value==""){ alert("Debe indicar el número de la Tarjerta de Combustible"); return};
	if(textNroTarjetaDV.value==""){ alert("Debe indicar el digito verificador de la Tarjerta de Combustible"); return};
	if(textFechaTarjeta.value==""){ alert("Debe indicar la Fecha de Inicio de uso de la Tarjeta"); return};
	if(archivoTC.value==""){ alert("Debe subir una foto de la tarjeta"); return};
	nroTarjertaDIV.innerHTML = textNroTarjeta.value+"-"+textNroTarjetaDV.value;
	if(buscarTarjetaCombustibleDuplicada()){
		textNroTarjeta.value	= '';
		textNroTarjetaDV.value	= '';
		return;
	}
	if(validarFecha()){
		textFechaTarjeta.value	= '';
		return;
	}
	if(buscarTarjetaCombustible()){
		document.formSubeArchivoTC.submit();
		guardarRegistroTarjetaCombustible();
	}
}

function buscarTarjetaCombustible(){
	var parametros = "nroTarjeta="+textNroTarjeta.value+"&nroTarjetaDV="+textNroTarjetaDV.value;
	var objHttpXMLTC = new AJAXCrearObjeto();
	objHttpXMLTC.open("POST","./xml/xmlVehiculos/xmlBuscarTarjetaCombustible.php",false);
	objHttpXMLTC.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTC.send(encodeURI(parametros));
	if (objHttpXMLTC.responseText == ""){
		//if(!confirm("EL N\u00DAMERO DE TARJETA NO SE ENCUENTRA EN LOS REGISTROS, DESEA INGRESARLA IGUALMENTE?")){
		//	return false;
		//}
		validado.value=0;
		return true;
	}
	validado.value=1;
	return true;
}

function buscarTarjetaCombustibleDuplicada(){
	var parametros = "nroTarjeta="+textNroTarjeta.value+"&nroTarjetaDV="+textNroTarjetaDV.value;
	var objHttpXMLTC = new AJAXCrearObjeto();
	objHttpXMLTC.open("POST","./xml/xmlVehiculos/xmlBuscarTarjetaCombustibleDuplicada.php",false);
	objHttpXMLTC.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTC.send(encodeURI(parametros));
	//console.log(objHttpXMLTC.responseText);
	if (objHttpXMLTC.responseText != ""){
		var xml		= objHttpXMLTC.responseXML.documentElement;
		var patente	= (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
		alert("LA TARJETA SE ENCUENTRA VINCULADA A OTRO VEHICULO , PATENTE: "+patente);
		return true;
	}
	return false;
}

function validarFecha(){
	var parametros = "codigoVehiculo="+idVehiculo.value+"&fecha="+textFechaTarjeta.value;
	var objHttpXMLTC = new AJAXCrearObjeto();
	objHttpXMLTC.open("POST","./xml/xmlVehiculos/xmlBuscarFechaTarjetaCombustible.php",false);
	objHttpXMLTC.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTC.send(encodeURI(parametros));
	if (objHttpXMLTC.responseText != ""){
		alert("LA FECHA NO PUEDE SE MENOR O IGUAL A LOS REGISTROS ANTERIORES");
		return true;
	}
	return false;
}

function guardarRegistroTarjetaCombustible(){
	var parametros = "codigoVehiculo="+idVehiculo.value+"&nroTarjeta="+textNroTarjeta.value+"&nroTarjetaDV="+textNroTarjetaDV.value+"&fecha="+textFechaTarjeta.value+"&archivo="+rutaArchivo.value+"&validado="+validado.value+"&codFuncionario="+codFuncionario.value;
	//console.log(parametros);
	var objHttpXMLTC = new AJAXCrearObjeto();
	objHttpXMLTC.open("POST","./xml/xmlVehiculos/xmlRegistraTarjetaCombustible.php",false);
	objHttpXMLTC.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTC.send(encodeURI(parametros));
	//console.log(objHttpXMLTC.responseText);
	if(objHttpXMLTC.responseText != "VACIO"){
		var xml		= objHttpXMLTC.responseXML.documentElement;
		var codigo	= (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
		if (codigo != 1){
			alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);	
			nroTarjeta.style.display='block';
			btnSubirTarjeta.style.display='none';
			cerrarVentanaBuscaUnidad('ventanaIngresoTarjeta');
			cerrarVentanaBuscaUnidad('ventanaHistorialTarjeta');
		}
		else{
			alert('LOS DATOS FUERON INGRESADOS A LA BASE DE DATOS');
			cerrarVentanaBuscaUnidad('ventanaIngresoTarjeta');
			cerrarVentanaBuscaUnidad('ventanaHistorialTarjeta');
			cerrarVentanaFicha();
			top.leeVehiculos(unidadUsuario.value,'','');
		}
	}
}

function mostrarHistorialTC(){
	cubreVentana.style.display = "";
	ventanaHistorialTarjeta.style.display='block';
	var listadoHistorialTC = "<table cellpadding='2' cellspacing='2' width='100%' >";
	listadoHistorialTC += "<tr style='font-weight: bolder;' >";
	listadoHistorialTC += "<td>Numero Tarjeta</td>";
	listadoHistorialTC += "<td>Fecha Desde</td>";
	listadoHistorialTC += "<td>Fecha Hasta</td>";
	listadoHistorialTC += "<td>Funcionario Ingresa</td>";
	listadoHistorialTC += "<td>Fecha Ingreso</td>";
	listadoHistorialTC += "<td>Ver Archivo</td>";
	listadoHistorialTC += "</tr>";

	let objHttpXMLTC = new AJAXCrearObjeto();
	objHttpXMLTC.open("POST","./xml/xmlVehiculos/xmlListaHistorialTarjetasCombustible.php",true);
	objHttpXMLTC.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTC.send(encodeURI("codigoVehiculo="+idVehiculo.value));
	objHttpXMLTC.onreadystatechange=function(){
		//console.log(objHttpXMLTC.readyState);
		if(objHttpXMLTC.readyState == 4){
			//console.log(objHttpXMLTC.responseText);
			if (objHttpXMLTC.responseText != "VACIO"){
				//console.log(objHttpXMLTC.responseText);
				let xml			= objHttpXMLTC.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('tarjetaCombustible').length;i++){
					let nTarjetaCombustible		= (xml.getElementsByTagName('nTarjetaCombustible')[i].text||xml.getElementsByTagName('nTarjetaCombustible')[i].textContent||"");
					let nTarjetaCombustibleDV	= (xml.getElementsByTagName('nTarjetaCombustibleDV')[i].text||xml.getElementsByTagName('nTarjetaCombustibleDV')[i].textContent||"");
					let fechaDesde				= (xml.getElementsByTagName('fechaDesde')[i].text||xml.getElementsByTagName('fechaDesde')[i].textContent||"");
					let fechaHasta				= (xml.getElementsByTagName('fechaHasta')[i].text||xml.getElementsByTagName('fechaHasta')[i].textContent||"");
					let funcionarioIngresa		= (xml.getElementsByTagName('funcionarioIngresa')[i].text||xml.getElementsByTagName('funcionarioIngresa')[i].textContent||"");
					let fechaIngreso			= (xml.getElementsByTagName('fechaIngreso')[i].text||xml.getElementsByTagName('fechaIngreso')[i].textContent||"");
					let archivo					= (xml.getElementsByTagName('archivo')[i].text||xml.getElementsByTagName('archivo')[i].textContent||"");
					
					//let botonBorrar = "<input type='button' id='btn100' value='BORRAR' onClick='borrarTarjeta(\""+nTarjetaCombustible+"\",\""+nTarjetaCombustibleDV+"\")' style='width:75px; background-color: #f7531f;' ></input>"
					//if(fechaHasta) botonBorrar = "";
					
					listadoHistorialTC += "<tr >";
					listadoHistorialTC += "<td >"+nTarjetaCombustible+"-"+nTarjetaCombustibleDV+"</td>";
					listadoHistorialTC += "<td >"+fechaDesde+"</td>";
					listadoHistorialTC += "<td >"+fechaHasta+"</td>";
					listadoHistorialTC += "<td >"+funcionarioIngresa+"</td>";
					listadoHistorialTC += "<td >"+fechaIngreso+"</td>";
					listadoHistorialTC += "<td ><input type='button' id='btn100' value='VER' onClick='window.open(\"archivos_TC/"+archivo+"\", \"_blank\");' style='width:75px;' ></td>";
					//listadoHistorialTC += "<td >"+botonBorrar+"</td>";
					listadoHistorialTC += "</tr>";
				}
			}
			listadoHistorialTC += "</table>";
			divListadoHistorialTC.innerHTML = listadoHistorialTC;
		}
	}
}

function borrarTarjeta(nTarjetaCombustible, nTarjetaCombustibleDV){
	if(confirm("Seguro desea eliminar la tarjeta Nro: "+nTarjetaCombustible+"-"+nTarjetaCombustibleDV)){
		var parametros = "codigoVehiculo="+idVehiculo.value+"&nroTarjeta="+nTarjetaCombustible+"&nroTarjetaDV="+nTarjetaCombustibleDV;
		//console.log(parametros);
		var objHttpXMLTC = new AJAXCrearObjeto();
		objHttpXMLTC.open("POST","./xml/xmlVehiculos/xmlEliminarTarjetaCombustible.php",false);
		objHttpXMLTC.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLTC.send(encodeURI(parametros));
		//console.log(objHttpXMLTC.responseText);
		if(objHttpXMLTC.responseText != "VACIO"){
			var xml		= objHttpXMLTC.responseXML.documentElement;
			var codigo	= (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
			if (codigo != 1){
				alert('LA TARJETA NO PUDO SER ELIMINADA ....		\nCODIGO RECIBIDO : ' + codigo);	
				nroTarjeta.style.display='block';
				btnSubirTarjeta.style.display='none';
				cerrarVentanaBuscaUnidad('ventanaIngresoTarjeta');
				cerrarVentanaBuscaUnidad('ventanaHistorialTarjeta');
			}
			else{
				alert('LA TARJETA FUE ELIMINADA');
				cerrarVentanaBuscaUnidad('ventanaIngresoTarjeta');
				cerrarVentanaBuscaUnidad('ventanaHistorialTarjeta');
				cerrarVentanaFicha();
				top.leeVehiculos(unidadUsuario.value,'','');
			}
		}
	}	
}