var cargaListadoServicios;
var idCargaListadoServicios;
function leeServicios(unidad, fecha1, fecha2, servicios){
	cargaListadoServicios = 0;
	
	//alert(fecha1);
	//alert(fecha2);
	//alert(servicios);
	//alert();
	if (fecha1 == "") var fecha1 = document.getElementById("textBuscar").value;
	if (fecha2 == "") fecha2 = fecha1;
	
	var fechaLimite = document.getElementById("textFechaLimite").value; 
	var unidadBloqueda = document.getElementById("textUnidadBloqueada").value; 
	
	//alert(unidadBloqueda);
	
	var comparaFechaLimite = comparaFecha(fecha1, fechaLimite);
	//alert(comparaFechaLimite);
	
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";

	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServicios.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicios="+servicios));  
	
	objHttpXMLServicios.onreadystatechange=function()
	{
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{       
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml 			 	= objHttpXMLServicios.responseXML.documentElement;
				//var unidad			= "";
				var correlativo			= "";
				var fecha	 		 	= "";
				var TipoServicio	 	= "";
				var tipoExtraordinario	= "";
				var horaInicio		 	= "";
				var horaTermino		 	= "";
				var descServicio		= "";
				var claseServicio		= "";
										
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				var fechaValidacion		= "";     
				
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					fecha	 		 	= xml.getElementsByTagName('fecha')[i].text;
					correlativo	 		= xml.getElementsByTagName('correlativoServicio')[i].text;
					tipoServicio	 	= xml.getElementsByTagName('desServicio')[i].text;
					tipoExtraordinario	= xml.getElementsByTagName('desServicioExtraordinario')[i].text;
					horaInicio		 	= xml.getElementsByTagName('horaInicio')[i].text;
					horaTermino		 	= xml.getElementsByTagName('horaTermino')[i].text;
					claseServicio		= xml.getElementsByTagName('claseServicio')[i].text;
					fechaValidacion		= xml.getElementsByTagName('fechaValidacion')[i].text;
										
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '460','fichaServicioCuadrante.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
					//var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
					//var dblClick = "";
					
					//comparaFechaLimite = 1;
					
					//alert(unidadBloqueda + " - " + comparaFechaLimite);
					
					//if (unidadBloqueda == 1 && comparaFechaLimite == 2) var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
					if (fechaValidacion != "" || (unidadBloqueda == 1 && comparaFechaLimite == 2)) var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
					else var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '460','fichaServicioCuadrante.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
					
					if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
					
					//if (claseServicio == "N") var horario = "8 HORAS";
					if (claseServicio == "N") var horario = "-------";
					else var horario = horaInicio+" - "+horaTermino;
				
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='15%' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoServicios += "<td width='55%'><div id='valorColumna'>"+tipoServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='25%' align='center'><div id='valorColumna'>"+horario+"</div></td>";
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


var cargaDatosServicio;
function leeDatosServicio(unidad, correlativo, vista){
	
	cargaDatosServicio = 0;
	if (!vista) {
		document.getElementById("mensajeCargando").style.display = "";
		document.getElementById("mensajeCargando").style.left = "170px";
		document.getElementById("mensajeCargando").style.top  = "120px";
		
		document.getElementById("correlativoServicio").value = correlativo;
		document.getElementById("unidadServicio").value 	 = unidad;
		document.getElementById("btnSiguiente").disabled	 = true;
		document.getElementById("btnCerrar").disabled 		 = true;
	}
	
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlDatosServicio.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&correlativo="+correlativo)); 
	
	objHttpXMLServicios.onreadystatechange=function()
	{
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{       
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml = objHttpXMLServicios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					var identificacionServicio = xml.getElementsByTagName('identificacionServicio')[i];
					var mediosDeVigilancia 	   = xml.getElementsByTagName('mediosDeVigilancia')[i];
					//alert(mediosDeVigilancia);
					leeIdentificacionServicio(identificacionServicio, vista);
					
						if (vista) vistaMediosDeVigilancia(mediosDeVigilancia);
						else {
							if (mediosDeVigilancia != null){
								
								leeMediosDeVigilancia(mediosDeVigilancia);
								
								llenaArregloMediosDeVigilancia(mediosDeVigilancia);
								llenaArregloFuncionariosAccesorios(mediosDeVigilancia);
							}
							
							document.getElementById("mensajeCargando").style.display = "none";
							if (document.getElementById("hojaDeRuta").value == 1) alert("ESTE SERVICIO TIENE HOJA DE RUTA ASOCIADA. POR LO QUE NO PODRA SER MODIFICADO O ELIMINADO ...        \nSI DESEA MODIFICAR O ELIMINAR, DEBE PRIMERO ELIMINAR LA HOJA DE RUTA.     ");
							
							
							if (document.getElementById("correlativoServicio").value != ""){
								document.getElementById("selTipoServicio").disabled = "true";
							}
							
							
							
							document.getElementById("btnSiguiente").disabled = "";
							document.getElementById("btnCerrar").disabled = "";
							if (document.getElementById("hojaDeRuta").value == 0) document.getElementById("btnEliminar").disabled = "";
							
							//seleccionServicio();
					
						}
				}
			}
			cargaDatosServicio = 1;
			//seleccionServicio();
			//seleccionTipoExtraordinario();
		}
	}
}


var idAsignaServExtFichaServicio; 
var idAsignaServFichaServicio; 
function leeIdentificacionServicio(identificacionServicio, vista){
	
	var codigoServicio 		= identificacionServicio.getElementsByTagName('codServicio')[0].text;
	var tipoServicio 		= identificacionServicio.getElementsByTagName('tipoServicio')[0].text;
	var descripcionServicio	= identificacionServicio.getElementsByTagName('desServicio')[0].text;
	var codExtraordinario	= identificacionServicio.getElementsByTagName('codServicioExtraordinario')[0].text;
	var extraordinario		= identificacionServicio.getElementsByTagName('desServicioExtraordinario')[0].text;
	var otroExtraordinario	= identificacionServicio.getElementsByTagName('desOtroServicioExtraordinario')[0].text;
	var descripcionServicio	= identificacionServicio.getElementsByTagName('desServicio')[0].text;
	
	var descripcionUnidad	= identificacionServicio.getElementsByTagName('desUnidad')[0].text;
	var fechaCompleta 		= identificacionServicio.getElementsByTagName('fechaCompleta')[0].text;
	var fecha 				= identificacionServicio.getElementsByTagName('fecha')[0].text;
	var horaInicio 			= identificacionServicio.getElementsByTagName('horaInicio')[0].text;
	var horaTermino 		= identificacionServicio.getElementsByTagName('horaTermino')[0].text;
	var observaciones 		= identificacionServicio.getElementsByTagName('observaciones')[0].text;
	
	var existeHojaRuta 		= identificacionServicio.getElementsByTagName('existeHojaRuta')[0].text;
	
	//alert(codigoServicio);
	//alert(codExtraordinario);
	
	if (vista){
		var vistaServicio = "";
		vistaServicio += "<table width='100%' cellspacing='1' cellpadding='1'>";
		vistaServicio += "<tr>";
		vistaServicio += "	<td width='18%' align='right'>Unidad&nbsp;:&nbsp;</td>";
		vistaServicio += "	<td width='82%' colspan='3' class='dato'>"+descripcionUnidad+"</td>";
		vistaServicio += "</tr>";
		vistaServicio += "<tr>";
		vistaServicio += "	<td width='18%' align='right'>Servicio&nbsp;:&nbsp;</td>";
		vistaServicio += "	<td width='32%' align='left' class='dato'>"+descripcionServicio+ "</td>";
		vistaServicio += "	<td width='18%'align='right'>Inicio&nbsp;:&nbsp;</td>";
		vistaServicio += "	<td width='32%' align='left' class='dato'>"+horaInicio+" Hrs.</td>";
		vistaServicio += "<tr>";
		vistaServicio += "	<td width='18%' align='right'>Fecha Servicio&nbsp;:&nbsp;</td>";
		vistaServicio += "	<td width='32%' align='left' class='dato'>"+fechaCompleta+ "</td>";
		vistaServicio += "	<td width='18%'align='right'>Término&nbsp;:&nbsp;</td>";
		vistaServicio += "	<td width='32%' align='left' class='dato'>"+horaTermino+" Hrs.</td>";
		vistaServicio += "</tr>";
		
		if (extraordinario != "") {
			vistaServicio += "<tr>";
			vistaServicio += "	<td width='18%' align='right'>ServicioExtraordinario&nbsp;:&nbsp;</td>";
			vistaServicio += "	<td width='82%' colspan='3' class='dato'>"+extraordinario+"</td>";
			vistaServicio += "</tr>";
		}
		
		if (otroExtraordinario != "") {
			vistaServicio += "<tr>";
			vistaServicio += "	<td width='18%' align='right'>Otro Extraordinario&nbsp;:&nbsp;</td>";
			vistaServicio += "	<td width='82%' colspan='3' class='dato'>"+otroExtraordinario+"</td>";
			vistaServicio += "</tr>";
		}

		vistaServicio += "</table>";
		document.getElementById("identificacionServicio").innerHTML 	= vistaServicio;
		document.getElementById("observaciones").innerHTML 	= observaciones;
		document.getElementById("tipoServicio").value = tipoServicio;

	} else {
		//alert(codExtraordinario);
		//document.getElementById("selServicio").value 			= tipoServicio + codigoServicio;
		document.getElementById("textOtroExtraordinario").value = otroExtraordinario;
		document.getElementById("textFechaServicio").value 		= fecha;
		document.getElementById("selHoraInicio").value 			= horaInicio;
		document.getElementById("selHoraTermino").value 		= horaTermino;
		document.getElementById("textObservaciones").value 		= observaciones;
		
		document.getElementById("hojaDeRuta").value				= existeHojaRuta;
		
		
		var valorCodigoServicio = tipoServicio+codigoServicio;			
		if (codigoServicio != 1100){
			var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
			document.getElementById('selServicio').options[0] = datosOpcion;
		} else {
			var valorCodigoServicio = "E"+codExtraordinario;	
			var datosOpcion = new Option(extraordinario, valorCodigoServicio, "", "");
			document.getElementById('selServicio').options[0] = datosOpcion;
		}	
		
        //Nuevas condicones agregadas 30-06-2015
        if(codigoServicio == 628 || codigoServicio == 629 || codigoServicio == 630){
	       var datosOpcion = new Option("LICENCIAS VINCULADAS AL DESEMPENO LABORAL",0, "", "");
           document.getElementById('selServicio').options[0] = datosOpcion;

           var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
           document.getElementById('selLicencia').options[0] = datosOpcion; 
           document.getElementById("selServicio").disabled = true;
           document.getElementById("selLicencia").style.backgroundColor = "";
           document.getElementById("selLicencia").disabled = false; 
           }
           
        if(codigoServicio == 633){
	       var datosOpcion = new Option("ENFERMEDAD O ACCIDENTE COMÚN",0, "", "");
           document.getElementById('selServicio').options[0] = datosOpcion;

           var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
           document.getElementById('selLicencia').options[0] = datosOpcion; 
           document.getElementById("selServicio").disabled = true;
           document.getElementById("selLicencia").style.backgroundColor = "";
           document.getElementById("selLicencia").disabled = false; 
           }
           
          if(codigoServicio == 632){
	       var datosOpcion = new Option("ACOGIDO A MEDICINA PREVENTIVA",0, "", "");
           document.getElementById('selServicio').options[0] = datosOpcion;

           var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
           document.getElementById('selLicencia').options[0] = datosOpcion; 
           document.getElementById("selServicio").disabled = true;
           document.getElementById("selLicencia").style.backgroundColor = "";
           document.getElementById("selLicencia").disabled = false; 
           }


      if(codigoServicio == 162 || codigoServicio == 170 || codigoServicio == 180 || codigoServicio == 631){
	       var datosOpcion = new Option("lICENCIAS VINCULADAS A LA MATERNIDAD",0, "", "");
           document.getElementById('selServicio').options[0] = datosOpcion;

           var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
           document.getElementById('selLicencia').options[0] = datosOpcion; 
           document.getElementById("selServicio").disabled = true;
           document.getElementById("selLicencia").style.backgroundColor = "";
           document.getElementById("selLicencia").disabled = false; 
           }
		//Fin nuevas condiciones
		
		//alert(valorCodigoServicio);	
		idAsignaServFichaServicio = setInterval("asignaValFichaServicio('"+valorCodigoServicio+"','"+descripcionServicio+"')",1000);
		
		if (codExtraordinario != ""){
			//document.getElementById("selTipoExtraordinario").disabled = false;
			//document.getElementById("labDescripcion").disabled	= false;
			
			idAsignaServExtFichaServicio = setInterval("asignaValExtFichaServicio("+codExtraordinario+")",1000);
		}
		
		if (otroExtraordinario != ""){
			document.getElementById("textOtroExtraordinario").style.backgroundColor = "";
			document.getElementById("textOtroExtraordinario").disabled = false;
		}
		//alert(codExtraordinario);
		//document.getElementById("selTipoExtraordinario").value = codExtraordinario;
		
		
	}
}

function asignaValExtFichaServicio(valor){
	if (cargaTipoServicioExtraordinario == 1) {
		clearInterval(idAsignaServExtFichaServicio);
		document.getElementById("selTipoExtraordinario").value 	= valor;
		document.getElementById("labDescripcion").disabled	= false;
		document.getElementById("selTipoExtraordinario").disabled = false;
	}
}

function asignaValFichaServicio(valor, descripcionServicio){
	if (cargaTipoServicio == 1) {
		clearInterval(idAsignaServFichaServicio);
		document.getElementById("selServicio").value = valor;

		seleccionServicio();
        
        //Nuevo codigo agregado 30-06-2015
        //document.getElementById("selLicencia").value = valor;   
        //document.getElementById("selLicencia").disabled = false; 
        //document.getElementById("selLicencia").style.backgroundColor = "";
        //Seleccionlicencia();
        //listaLicencias('selServicio');
        //Fin nuevo codigo 
        
        //Correccion aqui 
if(valor == "N161" || valor == "N162" || valor== "N170" || valor == "N180" || valor == "N628" || valor == "N629" || valor == "N630" || valor == "N631" || valor == "N632" || valor == "N633"){
        clearInterval(idAsignaServFichaServicio);
        document.getElementById("selServicio").value = valor;
		seleccionServicio();
        document.getElementById("selLicencia").value = valor;   
        document.getElementById("selLicencia").disabled = false; 
        document.getElementById("selLicencia").style.backgroundColor = "";
        //Seleccionlicencia();
        listaLicencias('selServicio');
        //alert(valor);
        }
//Fin correccion        
      	
	}
}


function leeMediosDeVigilancia(mediosDeVigilancia){
	
	//alert("medios " + mediosDeVigilancia.getElementsByTagName('medioVigilancia').length);
	//if (vista) document.getElementById("cantidadMedios").innerHTML 	= mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;
	
	for(var i=0;i<mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;i++){
		var funcionarios = mediosDeVigilancia.getElementsByTagName('funcionarios')[i];
		leeFuncionarios(funcionarios);
		var vehiculo = mediosDeVigilancia.getElementsByTagName('vehiculo')[i];
		//alert(vehiculo);
		leeVehiculosServicio(vehiculo);
	}
}


function vistaMediosDeVigilancia(mediosDeVigilancia){
	//document.getElementById("cantidadMedios").innerHTML = mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;
	var vistaMedios = "<br>";
	for(var i=0;i<mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;i++){
		vistaMedios += "<table width='100%' cellspacing='1' cellpadding='1'>";
		vistaMedios += "<tr>";
		if (document.getElementById("tipoServicio").value == "O") vistaMedios += "<td class='textoNegrilla' width='30%'  align='left'>Medio de Vigilancia Nro. "+(i+1)+"</td>";
		else vistaMedios += "<td class='textoNegrilla' width='30%'  align='left'>Personal</td>";
		vistaMedios += "<td class='textoNegrilla' width='70%'  align='right'></td>";
		vistaMedios += "</tr>";
		vistaMedios += "<tr>";
		vistaMedios += "<td width='100%'  align='left' bgcolor='#000000'></td>";
		vistaMedios += "</tr>";
		vistaMedios += "<tr><td height='3'></td></tr>";
		vistaMedios += "</table>";
			
		var vehiculo 		= mediosDeVigilancia.getElementsByTagName('vehiculo')[i];
		var factor 			= mediosDeVigilancia.getElementsByTagName('descripcionFactor')[i].text;
		var codigoVehiculo 	= vehiculo.getElementsByTagName('codigoVehiculo')[0].text;
		var patenteVehiculo	= vehiculo.getElementsByTagName('patenteVehiculo')[0].text;
		var tipoVehiculo	= vehiculo.getElementsByTagName('tipoVehiculo')[0].text;
		var kmInicial		= vehiculo.getElementsByTagName('kmInicial')[0].text;
		var kmFinal			= vehiculo.getElementsByTagName('kmFinal')[0].text;
				
		var descripcionVehiculo	= tipoVehiculo + " (" + patenteVehiculo + ")";
		vistaMedios += "<table width='100%' cellspacing='1' cellpadding='1'>";
		if (codigoVehiculo != 0){
			
			vistaMedios += "<tr>";
			vistaMedios += "	<td width='18%' align='right'>Vehículo&nbsp;:&nbsp;</td>";
			vistaMedios += "	<td width='32%' align='left' class='dato'>"+descripcionVehiculo+"</td>";
			vistaMedios += "	<td width='18%' align='right'>Kilometraje Inicial&nbsp;:&nbsp;</td>";
			vistaMedios += "	<td width='32%' align='left' class='dato'>"+formato_numero(kmInicial,0,',','.')+" KMS.</td>";
			vistaMedios += "</tr>";
			vistaMedios += "<tr>";
			vistaMedios += "	<td align='right'>Kilometros Recorridos&nbsp;:&nbsp;</td>";
			vistaMedios += "	<td align='left' class='dato'>"+(kmFinal-kmInicial) + " KMS.</td>";
			vistaMedios += "	<td align='right'>Kilometraje Final&nbsp;:&nbsp;</td>";
			vistaMedios += "	<td align='left' class='dato'>"+formato_numero(kmFinal,0,',','.')+" KMS.</td>";
			vistaMedios += "</tr>";
			//vistaMedios += "</table>";
		}
		var contFuncionarios = 0;
		//vistaMedios += "<table width='100%' cellspacing='1' cellpadding='1'>";
		var funcionarios = mediosDeVigilancia.getElementsByTagName('funcionarios')[i];
		for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
			var codigoFuncionario 	= funcionarios.getElementsByTagName('codigoFuncionario')[j].text;
			var apellidoPaterno 	= funcionarios.getElementsByTagName('apellidoPaterno')[j].text;
			var apellidoMaterno 	= funcionarios.getElementsByTagName('apellidoMaterno')[j].text;
			var primerNombre 		= funcionarios.getElementsByTagName('primerNombre')[j].text;
			var grado 				= funcionarios.getElementsByTagName('grado')[j].text;
			
			var descripcion			= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " - " + grado + " (" + codigoFuncionario +")";
			
			
			var armas = funcionarios.getElementsByTagName('armas')[j];
			//alert (codigoFuncionario + " -- > " + armas.getElementsByTagName('arma').length);
			
			if (armas.getElementsByTagName('arma').length > 0 ){
				for(var k=0;k<armas.getElementsByTagName('arma').length;k++){
					var etiqueta = "";
					//var tipoArma	= funcionarios.getElementsByTagName('tipoArma')[k].text;
					//var codArma		= funcionarios.getElementsByTagName('codigoArma')[k].text;
					
					var tipoArma	= armas.getElementsByTagName('tipoArma')[k].text;
					var codArma		= armas.getElementsByTagName('numeroSerie')[k].text;
					
					
					//alert (codigoFuncionario + " -- > " + tipoArma);
					
					var descripcionArma = tipoArma + " (NUMERO : "+codArma+")";
					
					if (contFuncionarios==0) etiqueta = "Personal&nbsp;:&nbsp;";
					if (k>0) descripcion = "";
					vistaMedios += "<tr>";
					vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
					vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'>"+descripcion+"</td>";
					vistaMedios += "<td width='32%' align='left' class='dato'>"+descripcionArma+"</td>";
					vistaMedios += "</tr>";
					contFuncionarios++;
					//alert(vistaMedios);
				}
			} else {
					var etiqueta = "";
					if (contFuncionarios==0) etiqueta = "Personal&nbsp;:&nbsp;";
					
					vistaMedios += "<tr>";
					vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
					vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'>"+descripcion+"</td>";
					vistaMedios += "<td width='32%' align='left' class='dato'></td>";
					vistaMedios += "</tr>";
					contFuncionarios++;
			}
		}
		//vistaMedios += "</table>";
		
		
		if (document.getElementById("tipoServicio").value == "O"){
		
			var descripcionCuadrantes = "";		
			cuadrantes = mediosDeVigilancia.getElementsByTagName('cuadrantes')[i];
			for (var j=0; j<cuadrantes.getElementsByTagName('cuadrante').length; j++){
				var cuadrante = cuadrantes.getElementsByTagName('descripcionCuadrante')[j].text;
				descripcionCuadrantes += cuadrante + ", ";
			}
			
			if (cuadrantes.getElementsByTagName('cuadrante').length > 0){
				var largoString = descripcionCuadrantes.length;
				descripcionCuadrantes = descripcionCuadrantes.substring(0, (largoString-2));
			}
			
			
			//descripcionCuadrantes = descripcionCuadrantes.substring(0,descripcionCuadrantes.length - 2);
			//vistaMedios += "<table width='100%' cellspacing='1' cellpadding='1'>";
			vistaMedios += "<tr>";
			vistaMedios += "<td width='18%' align='right'>Cuadrante(s)&nbsp;:&nbsp;</td>";
			vistaMedios += "<td width='82%' colspan='3' align='left' class='dato'>"+descripcionCuadrantes+"</td>";
			vistaMedios += "</tr>";
			vistaMedios += "<tr>";
			vistaMedios += "<td width='18%' align='right'>Factor&nbsp;:&nbsp;</td>";
			vistaMedios += "<td width='82%' colspan='3' align='left' class='dato'>"+factor+"</td>";
			vistaMedios += "</tr>";
			vistaMedios += "</table>";
		}
		
		
		
	}
	
	document.getElementById("mediosDeVigilancia").innerHTML 	= vistaMedios;
}


function leeFuncionarios(funcionarios){

	//alert(funcionarios.getElementsByTagName('funcionario').length);
	for(var i=0;i<funcionarios.getElementsByTagName('funcionario').length;i++){
		var codigoFuncionario 	= funcionarios.getElementsByTagName('codigoFuncionario')[i].text;
		var apellidoPaterno 	= funcionarios.getElementsByTagName('apellidoPaterno')[i].text;
		var apellidoMaterno 	= funcionarios.getElementsByTagName('apellidoMaterno')[i].text;
		var primerNombre 		= funcionarios.getElementsByTagName('primerNombre')[i].text;
		var grado 				= funcionarios.getElementsByTagName('grado')[i].text;
		
		var descripcion			= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
		
		var datosOpcion = new Option(descripcion, codigoFuncionario, "", "");
		document.getElementById('personalAsignado').options[document.getElementById('personalAsignado').length] = datosOpcion;      
	}
	ordenar(document.getElementById('personalAsignado'));
}


function leeVehiculosServicio(vehiculo){

	//alert(vehiculo);
	var codigoVehiculo 	= vehiculo.getElementsByTagName('codigoVehiculo')[i].text;
	var patenteVehiculo	= vehiculo.getElementsByTagName('patenteVehiculo')[i].text;
	var tipoVehiculo	= vehiculo.getElementsByTagName('tipoVehiculo')[i].text;
	//var factor			= vehiculo.getElementsByTagName('codigoFactor')[i].text;
				
	var descripcion		= tipoVehiculo + " (" + patenteVehiculo + ")";
	
	
	if (codigoVehiculo != 0){	
		var datosOpcion = new Option(descripcion, codigoVehiculo, "", "");
		document.getElementById('vehiculosAsignados').options[document.getElementById('vehiculosAsignados').length] = datosOpcion;
	}
	
	//document.getElementById('factorMV').value = factor; 
}


function llenaArregloMediosDeVigilancia(mediosDeVigilancia){
	
	for(var i=0;i<mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;i++){
		var medioDeVigilancia = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
		var codigoFactor	  = mediosDeVigilancia.getElementsByTagName('codigoFactor')[i].text;
		
		var vehiculo 		  = medioDeVigilancia.getElementsByTagName('vehiculo')[0];
		var codigoVehiculo 	  = vehiculo.getElementsByTagName('codigoVehiculo')[0].text;
		var patenteVehiculo	  = vehiculo.getElementsByTagName('patenteVehiculo')[0].text;
		var tipoVehiculo	  = vehiculo.getElementsByTagName('tipoVehiculo')[0].text;
		var kmInicial		  = vehiculo.getElementsByTagName('kmInicial')[0].text;
		var kmFinal			  = vehiculo.getElementsByTagName('kmFinal')[0].text;
	
		var descripcion		  = tipoVehiculo + " (" + patenteVehiculo + ")";
		//alert(descripcion); 	    
		document.getElementById('vehiculosServicio').length = null;
		var datosOpcion = new Option(descripcion, codigoVehiculo, "", "");
		document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').length] = datosOpcion;
		
		//alert(document.getElementById('vehiculosServicio').length);
		
		document.getElementById('textKmInicial').value 	= kmInicial;
		document.getElementById('textKmFinal').value 	= kmFinal;
		
		if (codigoFactor == "") codigoFactor = 0;
		document.getElementById('factorMV').value 		= codigoFactor;
		
		funcionarios = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
		for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
			var codigoFuncionario 	= funcionarios.getElementsByTagName('codigoFuncionario')[j].text;
			var apellidoPaterno 	= funcionarios.getElementsByTagName('apellidoPaterno')[j].text;
			var apellidoMaterno 	= funcionarios.getElementsByTagName('apellidoMaterno')[j].text;
			var primerNombre 		= funcionarios.getElementsByTagName('primerNombre')[j].text;
			var grado 				= funcionarios.getElementsByTagName('grado')[j].text;
						
			var descripcionFuncionario = apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
			
			var datosOpcion = new Option(descripcionFuncionario, codigoFuncionario, "", "");
			document.getElementById('personalServicioMedio').options[document.getElementById('personalServicioMedio').length] = datosOpcion;      
		}
		
		
		cuadrantes = mediosDeVigilancia.getElementsByTagName('cuadrantes')[i];
		for (var j=0; j<cuadrantes.getElementsByTagName('cuadrante').length; j++){
			
			var codigoCuadrante = cuadrantes.getElementsByTagName('codigoCuadrante')[j].text;
			for (var k=0; k<document.getElementById('cuadrantesMV').length; k++){
				//document.getElementById('cuadrantesMV').options[j].selected = false;
				if (document.getElementById('cuadrantesMV').options[k].value == codigoCuadrante)
					document.getElementById('cuadrantesMV').options[k].selected = true;
			}
		}
		
		agregaMedioVigilancia(1);
	}
}


//function llenaArregloFuncionariosAccesorios(mediosDeVigilancia){
//	
//	for(var i=0;i<mediosDeVigilancia.getElementsByTagName('funcionarios').length;i++){
//		var funcionarios = mediosDeVigilancia.getElementsByTagName('funcionarios')[i];
//		//alert(funcionarios.getElementsByTagName('funcionario').length);
//		for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
//			var codigoFuncionario 	= funcionarios.getElementsByTagName('codigoFuncionario')[j].text;
//			var apellidoPaterno 	= funcionarios.getElementsByTagName('apellidoPaterno')[j].text;
//			var apellidoMaterno 	= funcionarios.getElementsByTagName('apellidoMaterno')[j].text;
//			var primerNombre 		= funcionarios.getElementsByTagName('primerNombre')[j].text;
//			var grado 				= funcionarios.getElementsByTagName('grado')[j].text;
//			
//			//var descripcion			= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre;
//			var descripcion			= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
//			
//			var datosOpcion = new Option(descripcion, codigoFuncionario, "", "");
//			document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').length] = datosOpcion;      
//			
//			var armas = funcionarios.getElementsByTagName('armas')[j];
//			//alert ("ARMAS " + armas.getElementsByTagName('arma').length);
//			for (var k=0; k<armas.getElementsByTagName('arma').length; k++){
//				var codigoArma = "P" + armas.getElementsByTagName('codigoArma')[k].text;
//				var descripcionArma = armas.getElementsByTagName('tipoArma')[k].text;
//				var numeroSerie = armas.getElementsByTagName('numeroSerie')[k].text;
//				
//				descripcionArma += " (N./S. : " + numeroSerie + ")";
//				
//				var datosOpcion = new Option(descripcionArma, codigoArma, "", "");
//				document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;   
//			}
//			
//			var animales = funcionarios.getElementsByTagName('animales')[j];
//			for (var k=0; k<animales.getElementsByTagName('animal').length; k++){
//				var codigoAnimal = "A" + funcionarios.getElementsByTagName('codigoAnimal')[k].text;
//				var descripcionAnimal = funcionarios.getElementsByTagName('descripcionAnimal')[k].text;
//				
//				var datosOpcion = new Option(descripcionAnimal, codigoAnimal, "", "");
//				document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;   
//			}
//			
//			var accesorios = funcionarios.getElementsByTagName('accesorios')[j];
//			for (var k=0; k<accesorios.getElementsByTagName('accesorio').length; k++){
//				var codigoAccesorio = "O" + funcionarios.getElementsByTagName('codigoAccesorio')[k].text;
//				var descripcionAccesorio = funcionarios.getElementsByTagName('descripcionAccesorio')[k].text;
//				
//				var datosOpcion = new Option(descripcionAccesorio, codigoAccesorio, "", "");
//				document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;   
//			}
//			
//			agregaFuncionarioAccesorios();
//		}
//			
//		//alert();
//		//agregaFuncionarioAccesorios();
//    
//	}
//	
//}
//

function llenaArregloFuncionariosAccesorios(mediosDeVigilancia){
	for(var i=0;i<mediosDeVigilancia.getElementsByTagName('funcionario').length;i++){
		
		//OBTIENE LOS DATOS PERSONALES DEL FUNCIONARIO.
		var funcionario = mediosDeVigilancia.getElementsByTagName('funcionario')[i];
		var codigoFuncionario 	= funcionario.getElementsByTagName('codigoFuncionario')[0].text;
		var apellidoPaterno 	= funcionario.getElementsByTagName('apellidoPaterno')[0].text;
		var apellidoMaterno 	= funcionario.getElementsByTagName('apellidoMaterno')[0].text;
		var primerNombre 		= funcionario.getElementsByTagName('primerNombre')[0].text;
		var grado 				= funcionario.getElementsByTagName('grado')[0].text;
			
		var descripcion			= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
			
		var datosOpcion = new Option(descripcion, codigoFuncionario, "", "");
		document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').length] = datosOpcion;      
				
		//OBTIENE LOS DATOS DE LOS ACCESORIOS UTILIZADOS POR EL FUNCIONARIO.
		var accesorios = funcionario.getElementsByTagName('accesorios')[0];
		for (var k=0; k<accesorios.getElementsByTagName('accesorio').length; k++){
			var accesorio 			 = accesorios.getElementsByTagName('accesorio')[k];
			var codigoAccesorio 	 = "O" + accesorio.getElementsByTagName('codigoAccesorio')[0].text;
			var descripcionAccesorio = accesorio.getElementsByTagName('descripcionAccesorio')[0].text;
								
			var datosOpcion = new Option(descripcionAccesorio, codigoAccesorio, "", "");
			document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;   
		}
		
		//OBTIENE LOS DATOS DE LAS ARMAS UTILIZADAS POR EL FUNCIONARIO;
		var armas = funcionario.getElementsByTagName('armas')[0];
		for (var k=0; k<armas.getElementsByTagName('arma').length; k++){
			var arma			= armas.getElementsByTagName('arma')[k];
			var codigoArma 		= "P" + arma.getElementsByTagName('codigoArma')[0].text;
			var descripcionArma = arma.getElementsByTagName('tipoArma')[0].text;
			var numeroSerie 	= arma.getElementsByTagName('numeroSerie')[0].text;
						
			descripcionArma += " (N./S. : " + numeroSerie + ")";
			
			var datosOpcion = new Option(descripcionArma, codigoArma, "", "");
			document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;   
		}
		
		
		//OBTIENE LOS DATOS DE LOS ANIMALES UTILIZADOS POR EL FUNCIONARIO
		var animales = funcionario.getElementsByTagName('animales')[0];
		for (var k=0; k<animales.getElementsByTagName('animal').length; k++){
			var animal			  = animales.getElementsByTagName('animal')[k];
			var codigoAnimal 	  = "A" + animal.getElementsByTagName('codigoAnimal')[0].text;
			var descripcionAnimal = animal.getElementsByTagName('descripcionAnimal')[0].text;
									
			var datosOpcion = new Option(descripcionAnimal, codigoAnimal, "", "");
			document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;   
		}
		
		//AGREGA ACCESORIOS AL ARREGLO
		agregaFuncionarioAccesorios();
	}
}


function encabezadosPorServicio(){
	var encabezado= "";
	
	encabezado += "<table cellspacing='1' cellpadding='1' width='100%'>";
	encabezado += "<tr>";            
	encabezado += "<td id='nombreColumna' width='5%'  align='center'>No.</td>";
	encabezado += "<td id='nombreColumna' width='30%' align='center'>UNIDAD</td>",
	encabezado += "<td id='nombreColumna' width='45%' align='center'>SERVICIO</td>";
	encabezado += "<td id='nombreColumna' width='10%' align='center'>PERSONAL</td>";
	encabezado += "<td id='nombreColumna' width='10%' align='center'>VEHICULOS</td>";
	encabezado += "</tr>";
	encabezado += "</table>";
	
	return encabezado;
}

function totalesPorServicio(){
	var totales = "";
	
	totales += "<table cellspacing='1' cellpadding='1' width='100%'>";
	totales += "<tr>";
	totales += "<td id='totalesColumna' width='78.03%' align='right'>TOTALES&nbsp;:&nbsp;&nbsp;&nbsp;</td>";
	totales += "<td id='totalesColumna' width='10%'    align='center'><div id='totalPersonal'>-</div></td>";
	totales += "<td id='totalesColumna' width='11.97%' align='center'><div id='totalVehiculos'>-</div></td>";
	totales += "</tr>";
	totales += "</table>";
	                                                                                     
	return totales;
}


function leeServiciosAgregados(unidad, tipoUnidad, fecha1, servicio, inicio, subir){
	
	//alert("unidad = " + unidad + "; tipoUnidad = "+ tipoUnidad + "; fecha1 = "+ fecha1 + "; servicio = " + servicio + "; inicio = " + inicio);
	
	//if (servicio != "") document.getElementById("servicio").value = servicio;
	
	//alert();
	var fecha1 = document.getElementById("textBuscar").value;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	
	//alert();
	top.document.getElementById("tituloGrilla").innerHTML = "";
	document.getElementById("cabeceraGrilla").innerHTML = encabezadosPorServicio();
	document.getElementById("totalesGrilla").innerHTML  = totalesPorServicio();
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	document.getElementById("totalPersonal").innerHTML 	= "-";
	document.getElementById("totalVehiculos").innerHTML = "-";

	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlControlServicios.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&codigoServicio="+servicio+"&tipoUnidad="+tipoUnidad+"&inicio="+inicio));       
	
	objHttpXMLServicios.onreadystatechange=function()
	{
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{       
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml 			 	= objHttpXMLServicios.responseXML.documentElement;
				var codigoUnidad		= "";
				var descripcionUnidad	= "";
				var codigoServicio	 	= "";
				var correlativo	 		= "";
				var descripcionServicio = "";
				var cantidadPersonal 	= "";
				var cantidadVehiculo 	= "";
														
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				var sumCantidadPersonal = 0;
				var sumCantidadVehiculos= 0;
				
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('servicioIngresado').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigoUnidad	 	= xml.getElementsByTagName('codUnidad ')[i].text;
					descripcionUnidad	= xml.getElementsByTagName('desUnidad ')[i].text;
					codigoServicio	 	= xml.getElementsByTagName('codServicio')[i].text;
					descripcionServicio	= xml.getElementsByTagName('desServicio')[i].text;
					correlativo	 		= xml.getElementsByTagName('correlativo')[i].text;
					cantidadPersonal	= xml.getElementsByTagName('cantidadFuncionarios')[i].text;
					cantidadVehiculo	= xml.getElementsByTagName('cantidadVehiculos')[i].text;
					
					sumCantidadPersonal += cantidadPersonal*1;
					sumCantidadVehiculos += cantidadVehiculo*1;
										
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					//alert(tipoUnidad);
					if (tipoUnidad == "nacional") var unidadHijo = "zona";					
					if (tipoUnidad == "zona") var unidadHijo = "prefectura";					
					if (tipoUnidad == "prefectura") var unidadHijo = "comisaria";
					if (tipoUnidad == "comisaria") var unidadHijo = "destacamento";
					
					inicio = 1;
					//alert(correlativo);
					
					//alert(inicio);

					if (correlativo == "") var dblClick = "leeServiciosAgregados('"+codigoUnidad+"','"+unidadHijo+"','"+fecha1+"','"+codigoServicio+"','"+inicio+"','0')";
					if (correlativo != "") var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					//var dblClick = "";
					//alert();     
					if (descripcionUnidad == "") descripcionUnidad = "NIVEL NACIONAL";
									
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
					listadoServicios += "<td width='45%'><div id='valorColumna'>"+descripcionServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadPersonal,0,',','.')+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadVehiculo,0,',','.')+"</div></td>";
					listadoServicios += "</tr>";
					//alert(listadoServicios);
				}
				listadoServicios += "</table>";
				
								
				//alert(listadoServicios);
				//alert();
				div.innerHTML = listadoServicios;
				document.getElementById("totalPersonal").innerHTML = formato_numero(sumCantidadPersonal,0,',','.');
				document.getElementById("totalVehiculos").innerHTML = formato_numero(sumCantidadVehiculos,0,',','.');
				
				cargaListadoServicios = 1;
			} else {
				if (inicio != 0) {
					eval("leeServiciosAgregados('"+unidad+"','sinHijo','"+fecha1+"','"+servicio+"','"+inicio+"','0')");
				} else {
					alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
					div.innerHTML = "";
				}
				
				//cargaListadoServicios = 1;
			}
		}
	}
}


function leeServiciosAgregados2(unidad, tipoUnidad, tipoUnidadPadre, fecha1, servicio, inicio, subir){
	
	//alert("unidad = " + unidad + "; tipoUnidad = "+ tipoUnidad + "; tipoUnidadPadre = "+ tipoUnidadPadre + "; fecha1 = "+ fecha1 + "; servicio = " + servicio + "; inicio = " + inicio);
	
	//if (servicio != "") document.getElementById("servicio").value = servicio;
	
	//alert();
	if (fecha1 == "") fecha1 = document.getElementById("textBuscar").value;
	else document.getElementById("textBuscar").value = fecha1;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	
	//alert();
	//top.document.getElementById("tituloGrilla").innerHTML = "";
	document.getElementById("cabeceraGrilla").innerHTML = encabezadosPorServicio();
	document.getElementById("totalesGrilla").innerHTML  = totalesPorServicio();
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	document.getElementById("totalPersonal").innerHTML 	= "-";
	document.getElementById("totalVehiculos").innerHTML = "-";

	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlControlServicios2.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&codigoServicio="+servicio+"&tipoUnidad="+tipoUnidad+"&tipoUnidadPadre="+tipoUnidadPadre+"&inicio="+inicio));       
	
	objHttpXMLServicios.onreadystatechange=function()
	{
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4)
		{       
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);		
				var xml 			 	= objHttpXMLServicios.responseXML.documentElement;
				var codigoUnidad		= "";
				var descripcionUnidad	= "";
				var codigoServicio	 	= "";
				var correlativo	 		= "";
				var descripcionServicio = "";
				var cantidadPersonal 	= "";
				var cantidadVehiculo 	= "";
														
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoServicios 	= "";
				var sumCantidadPersonal = 0;
				var sumCantidadVehiculos= 0;
				
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('servicioIngresado').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigoUnidad	 	= xml.getElementsByTagName('codUnidad ')[i].text;
					descripcionUnidad	= xml.getElementsByTagName('desUnidad ')[i].text;
					codigoServicio	 	= xml.getElementsByTagName('codServicio')[i].text;
					descripcionServicio	= xml.getElementsByTagName('desServicio')[i].text;
					correlativo	 		= xml.getElementsByTagName('correlativo')[i].text;
					cantidadPersonal	= xml.getElementsByTagName('cantidadFuncionarios')[i].text;
					cantidadVehiculo	= xml.getElementsByTagName('cantidadVehiculos')[i].text;
					
					sumCantidadPersonal += cantidadPersonal*1;
					sumCantidadVehiculos += cantidadVehiculo*1;
										
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					////alert(tipoUnidad);
					if (tipoUnidad == "nacional") var unidadHijo = "superZona";	
					if (tipoUnidad == "superZona") var unidadHijo = "zona";					
					if (tipoUnidad == "zona") var unidadHijo = "prefectura";					
					if (tipoUnidad == "prefectura") var unidadHijo = "comisaria";
					if (tipoUnidad == "comisaria") var unidadHijo = "destacamento";    
					
					//var unidadHijo = tipoUnidad;
					
					inicio = 1;
					//alert(correlativo);
					
					//alert(inicio);

					if (correlativo == "") var dblClick = "leeServiciosAgregados2('"+codigoUnidad+"','"+unidadHijo+"','"+tipoUnidad+"','"+fecha1+"','"+codigoServicio+"','"+inicio+"','0')";
					if (correlativo != "") var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					//var dblClick = "";
					//alert();     
					if (descripcionUnidad == "") descripcionUnidad = "NIVEL NACIONAL";
									
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
					listadoServicios += "<td width='45%'><div id='valorColumna'>"+descripcionServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadPersonal,0,',','.')+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadVehiculo,0,',','.')+"</div></td>";
					listadoServicios += "</tr>";
					//alert(listadoServicios);
				}
				listadoServicios += "</table>";
				
								
				//alert(listadoServicios);
				//alert();
				div.innerHTML = listadoServicios;
				document.getElementById("totalPersonal").innerHTML = formato_numero(sumCantidadPersonal,0,',','.');
				document.getElementById("totalVehiculos").innerHTML = formato_numero(sumCantidadVehiculos,0,',','.');
				
				cargaListadoServicios = 1;
			} else {
				if (inicio != 0) {
					eval("leeServiciosAgregados('"+unidad+"','sinHijo','"+fecha1+"','"+servicio+"','"+inicio+"','0')");
				} else {
					alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
					div.innerHTML = "";
				}
				
				//cargaListadoServicios = 1;
			}
		}
	}
}


function buscaTipoDeServiciosPorFuncionario(unidadServicio, fecha1, fecha2, tipoServicio){
	
	var objHttpXMLServiciosPorFuncionario = new AJAXCrearObjeto();
    objHttpXMLServiciosPorFuncionario.open("POST","./xml/xmlServicios/xmlListaTiposDeServiciosPorFuncionario.php",false);
	objHttpXMLServiciosPorFuncionario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServiciosPorFuncionario.send(encodeURI("unidadServicio="+unidadServicio+"&fecha1="+fecha1+"&fecha2="+fecha2+"&tipoServicio="+tipoServicio));  
	//alert(objHttpXMLServiciosPorFuncionario.responseText);	   
	
	var xml = objHttpXMLServiciosPorFuncionario.responseXML.documentElement;     
	return xml.getElementsByTagName('funcionarios')[0];          
	
	
}

function buscaServiciosJefaturaSupervisionTerrenoPorFuncionario(unidadServicio, fecha1, fecha2){
	
	var objHttpXMLServiciosPorFuncionario = new AJAXCrearObjeto();
    objHttpXMLServiciosPorFuncionario.open("POST","./xml/xmlServicios/xmlCantidadServicioJefaturaSupervicionPorFuncionario.php",false);
	objHttpXMLServiciosPorFuncionario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServiciosPorFuncionario.send(encodeURI("unidadServicio="+unidadServicio+"&fecha1="+fecha1+"&fecha2="+fecha2));  
	//alert(objHttpXMLServiciosPorFuncionario.responseText);	   
	
	var xml = objHttpXMLServiciosPorFuncionario.responseXML.documentElement;     
	return xml.getElementsByTagName('funcionarios')[0];          
	
	
}