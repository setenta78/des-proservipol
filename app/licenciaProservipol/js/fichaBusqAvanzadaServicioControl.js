function moverParametro(objetoDesde, objetoHasta){
	moverDatos(objetoDesde, objetoHasta);
	ordenar(document.getElementById(objetoHasta));
	//habilitarBotonesAgregarQuitar();
	
}


function inicializarConsultaAvanzadaServico(tipoConsulta, especialidad){
	
	//alert(tipoConsulta);
	if (tipoConsulta == 1){
		document.getElementById("tituloDisponible").innerHTML = "TIPOS DE SERVICIOS";
		document.getElementById("tituloAsignado").innerHTML = "SERVICIOS SELECCIONADOS";
		leeTipoServicios('disponibles',true, especialidad);
	}	
}

function abrirGeneradorDeConsulta(){
	
	//var objeto = document.rbTipoConculta;
	//alert(objeto.length);
	//for (i=0;i<document.getElementById("rbTipoConculta").length;i++){ 
    //   if (document.getElementById("rbTipoConculta")[i].checked) 
    //      break; 
    //} 
	tipoConsulta = 1;
	
	abrirVentana('GENERA CONSULTA ... ', '850', '350','fichaGeneraConsulta.php?tipoConsulta='+tipoConsulta, '','','5','5');
}


function busquedaAvanzadaServicios(){
	
	var tipoBusqueda = "";	
	if (document.getElementById("divBusquedaServicioPorUnidad").style.display == "") tipoBusqueda = "porUnidad"; 
	if (document.getElementById("divBusquedaServicioPorFuncionario").style.display == "") tipoBusqueda = "porFuncionario"; 
	
	
	if (tipoBusqueda == "porFuncionario"){
		var okValidacion = validarParametrosConsultaServicios();
		//var okValidacion = true;
		if (okValidacion){
			var fechaInicio  		 = document.getElementById("textFechaServicio1").value;
			var fechaTermino 		 = document.getElementById("textFechaServicio2").value;
			var arregloTipoServicios = new Array();
			var codigoFuncionario	 = document.getElementById("textCodigoFuncionario").value;
			
			var cantidadTiposServicio = document.getElementById("asignado").length;
			
			for (var i=0; i<cantidadTiposServicio;i++){
				//alert(document.getElementById("asignado")[i].value);
				var servicio = document.getElementById("asignado")[i].value.substr(1,document.getElementById("asignado")[i].value.length);
				//alert(servicio);
				arregloTipoServicios[i] = servicio;
			}
			
			var mostrar = "";
			mostrar += "fecha Inicio     = " + fechaInicio  + "		\n";
			mostrar += "fecha Termino    = " + fechaTermino + "		\n";
			mostrar += "funcionario  	 = " + codigoFuncionario + "		\n";
			mostrar += "Servicios        = " + arregloTipoServicios + "\n";
				
			top.document.getElementById("cabeceraGrilla").innerHTML = encabezadosPorFuncionario();
			top.document.getElementById("totalesGrilla").innerHTML  = totalesPorFuncionario();
			//top.document.getElementById("textBuscar").value = "";
			leeDescripcionFuncionario(codigoFuncionario);
			leeServiciosPorFuncionario(codigoFuncionario, fechaInicio, fechaTermino, arregloTipoServicios);
			//top.leeServicios(codigoUnidad, fechaInicio, fechaTermino, arregloTipoServicios);
			top.cerrarVentana();
		}
	}
	
	
	if (tipoBusqueda == "porUnidad"){
		
		//alert("ES POR UNIDAD");
		
		//document.getElementById("unidadSeleccionada")[0].value.substr(1,document.getElementById("asignado")[i].value.length)
		
		var okValidacion = validarParametrosConsultaServiciosPorUnidad(); 
		if (okValidacion){
			var datosUnidad = document.getElementById("unidadSeleccionada")[0].value.split("&");
			
			var unidad = datosUnidad[0];
			var tipoUnidad = datosUnidad[1];
			var fecha1 = document.getElementById("textFechaServicioPorUnidad1").value;	
					
			//alert (unidad + " / " + fecha1);
			
			//top.leeServiciosAgregados(unidad, 'sinHijo', fecha1, '', '0', '0');
			
			top.document.getElementById("tituloGrilla").innerHTML = "SERVICIOS CORRESPONDIENTES AL " + fecha1;
			top.leeServiciosAgregados2(unidad, tipoUnidad, tipoUnidad, fecha1, '', '0', '0')
			top.cerrarVentana();
		}
	}
	
}

function encabezadosPorFuncionario(){
	var encabezado= "";
	
	encabezado += "<table cellspacing='1' cellpadding='1' width='100%'>";
	encabezado += "<tr>";
	encabezado += "<td id='nombreColumna' width='5%'  align='center'>No.</td>";
	encabezado += "<td id='nombreColumna' width='10%' align='center'>FECHA</td>";
	encabezado += "<td id='nombreColumna' width='30%' align='center'>UNIDAD</td>";
	encabezado += "<td id='nombreColumna' width='45%' align='center'>SERVICIO</td>";
	encabezado += "<td id='nombreColumna' width='10%' align='center'>HORARIO</td>";
	//encabezado += "<td id='nombreColumna' width='10%' align='center'>HORAS</td>";
	encabezado += "</tr>";
	encabezado += "</table>";
	
	return encabezado;
}

function totalesPorFuncionario(){
	var totales = "";
	
	totales += "<table cellspacing='1' cellpadding='1' width='100%'>";
	totales += "<tr>";
	totales += "<td id='totalesColumna'>&nbsp;</td>"; 
	//totales += "<td id='totalesColumna' width='88.03%' align='right'>TOTAL DE HORAS&nbsp;:&nbsp;&nbsp;&nbsp;</td>";
	//totales += "<td id='totalesColumna' width='11.97%' align='center'><div id='totalPorFuncionario'>-</div></td>";
	totales += "</tr>";
	totales += "</table>";
	
	return totales;
}



function validarParametrosConsultaServicios(){
	
	var fechaInicio    = document.getElementById("textFechaServicio1").value;
	var fechaTermino   = document.getElementById("textFechaServicio2").value;
	var codFuncionario = eliminarBlancos(document.getElementById("textCodigoFuncionario").value);
	
	if (fechaInicio == ""){
		alert("DEBE INDICAR FECHA DE INICIO DE LA BUSQUEDA.    ");
		return false;
	}
	
	if (fechaTermino == ""){
		alert("DEBE INDICAR FECHA DE TERMINO DE LA BUSQUEDA.    ");
		return false;
	}
	
	
	var resultado = comparaFecha(fechaInicio, fechaTermino);
		
	if (resultado == 1){
		alert("LA FECHA DE INICIO NO PUEDE SER MAYOR QUE LA FECHA DE TERMINO.    ");
		return false;
	}
	
	if (codFuncionario == ""){
		alert("DEBE INGRESAR EL CODIGO DEL FUNCIONARIO A CONSULTAR.    ");
		document.getElementById("textCodigoFuncionario").focus();
		document.getElementById("textCodigoFuncionario").value = "";
		return false;
	}
	
	return true;
	
	
}


function validarParametrosConsultaServiciosPorUnidad(){
	
	var fecha  		  = document.getElementById("textFechaServicioPorUnidad1").value;
	var cantUnidades = document.getElementById("unidadSeleccionada").length;
	
	if (fecha == ""){
		alert("DEBE INDICAR LA FECHA QUE DESEA VER.    ");
		return false;
	}
	
	if (cantUnidades == 0){
		alert("DEBE SELECCIONAR UNA UNIDAD.    ");
		return false;
	}
	
	return true;
}



function leeServiciosPorFuncionario(funcionario, fecha1, fecha2, servicios){
	
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= top.document.getElementById("listadoServicios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";

	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServiciosPorFuncionario.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoFuncionario="+funcionario+"&fecha1="+fecha1+"&fecha2="+fecha2+"&codigoServicio="+servicios));  
	
	objHttpXMLServicios.onreadystatechange=function()
	{
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{       
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml 			= objHttpXMLServicios.responseXML.documentElement;
				var codigoUnidad		= "";
				var unidad			= "";
				var correlativo			= "";
				var fecha	 		= "";
				var TipoServicio	 	= "";
				var tipoExtraordinario		= "";
				var horaInicio		 	= "";
				var horaTermino		 	= "";
				var descServicio		= "";
				var claseServicio		= "";
										
				var sw 				= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}

					codigoUnidad	 	= xml.getElementsByTagName('codUnidad')[i].text;
					unidad	 		= xml.getElementsByTagName('desUnidad')[i].text;
					fecha	 		= xml.getElementsByTagName('fecha')[i].text;
					correlativo	 	= xml.getElementsByTagName('correlativoServicio')[i].text;
					tipoServicio	 	= xml.getElementsByTagName('desServicio')[i].text;
					tipoExtraordinario	= xml.getElementsByTagName('desServicioExtraordinario')[i].text;
					horaInicio		= xml.getElementsByTagName('horaInicio')[i].text;
					horaTermino		= xml.getElementsByTagName('horaTermino')[i].text;
					//claseServicio		= xml.getElementsByTagName('claseServicio')[i].text;
										
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					//var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '460','fichaServicioCuadrante.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
					//var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
					//var dblClick = "";
					var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					
					if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
					
					if (claseServicio == "N") var horario = "8 HORAS";
					else var horario = horaInicio+" - "+horaTermino;
				
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='10%' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+unidad.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='45%'><div id='valorColumna'>"+tipoServicio.toUpperCase() + "</div></td>";
					listadoServicios += "<td width='10%' align='center'><div id='valorColumna'>"+horario+"</div></td>";
					//listadoServicios += "<td width='10%' align='center'><div id='valorColumna'></div></td>";
					listadoServicios += "</tr>";
					//alert(listadoServicios);
				}
				listadoServicios += "</table>";
				
				//alert(listadoServicios);
				//alert();
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


function leeDescripcionFuncionario(funcionario){
	
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlFuncionarios/xmlDatosFuncionario.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoFuncionario="+funcionario));  
	
	objHttpXMLServicios.onreadystatechange=function()
	{
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{       
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml 			 	= objHttpXMLServicios.responseXML.documentElement;
				var grado			 	= "";
				var aPaterno			= "";
				var aMaterno 		 	= "";
				var pNombre	 			= "";
				var sNOmbre				= "";
								
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					grado	 		 	= xml.getElementsByTagName('grado')[i].text;										
					aPaterno	 		= xml.getElementsByTagName('apellidoPaterno')[i].text;
					aMaterno	 		= xml.getElementsByTagName('apellidoMaterno')[i].text;
					pNombre	 			= xml.getElementsByTagName('nombre')[i].text;
					sNOmbre				= xml.getElementsByTagName('nombre2')[i].text;
										
					var nombre = grado + " " + aPaterno + " " + aMaterno + ", " + pNombre + " (" + funcionario + ")";					
				}
				top.document.getElementById("tituloGrilla").innerHTML = nombre.toUpperCase();
			} 
		}
	}
}


function mostrarDivPorUnidad(){
	document.getElementById("divBusquedaServicioPorUnidad").style.display = "";
	document.getElementById("divBusquedaServicioPorFuncionario").style.display = "none";
}

function mostrarDivPorFuncionario(){
	document.getElementById("divBusquedaServicioPorFuncionario").style.display = "";
	document.getElementById("divBusquedaServicioPorUnidad").style.display = "none";
}