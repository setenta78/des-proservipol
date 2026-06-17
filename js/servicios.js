var cargaListadoServicios;
var idCargaListadoServicios;
function leeServicios(unidad, fecha1, fecha2, servicios){
	cargaListadoServicios = 0;
	if (fecha1 == "") var fecha1 = document.getElementById("textBuscar").value;
	if (fecha2 == "") fecha2 = fecha1;
	var fechaLimite = document.getElementById("textFechaLimite").value;
	var unidadBloqueda = document.getElementById("textUnidadBloqueada").value;
	var tipoUnidad = document.getElementById("tipoUnidad").value;
	var uniGope = unidad;
	var comparaFechaLimite = comparaFecha(fecha1, fechaLimite);
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlListaServicios.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicios="+servicios));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//console.log(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml 			 					= objHttpXMLServicios.responseXML.documentElement;
				var correlativo					= "";
				var fecha	 		 					= "";
				var TipoServicio	 			= "";
				var tipoExtraordinario	= "";
				var horaInicio		 			= "";
				var horaTermino		 			= "";
				var descServicio				= "";
				var claseServicio				= "";
				var sw 				 					= 0;
				var fondoLinea		 			= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoServicios 		= "";
				var fechaValidacion			= "";
				var codServicio					= "";
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				indice = 0;
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					
					if(tipoUnidad==30 || tipoUnidad==120){
						
						if (sw==0) {fondoLinea = "linea1";sw =1;}
						else {fondoLinea = "linea2";sw=0;}
						
						fecha				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
						correlativo			= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
						codServicio			= (xml.getElementsByTagName('codServicio')[i].text||xml.getElementsByTagName('codServicio')[i].textContent||"");
						tipoServicio		= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
						tipoExtraordinario	= (xml.getElementsByTagName('desServicioExtraordinario')[i].text||xml.getElementsByTagName('desServicioExtraordinario')[i].textContent||"");
						horaInicio			= (xml.getElementsByTagName('horaInicio')[i].text||xml.getElementsByTagName('horaInicio')[i].textContent||"");
						horaTermino			= (xml.getElementsByTagName('horaTermino')[i].text||xml.getElementsByTagName('horaTermino')[i].textContent||"");
						claseServicio		= (xml.getElementsByTagName('claseServicio')[i].text||xml.getElementsByTagName('claseServicio')[i].textContent||"");
						fechaValidacion		= (xml.getElementsByTagName('fechaValidacion')[i].text||xml.getElementsByTagName('fechaValidacion')[i].textContent||"");
						resaltarLinea		= "cambiarClase(this, 'lineaMarcada')";
						lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
						
						var dblClick	= "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '550','fichaServicioEspecializadas.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
						var color = "";
						
						if(codServicio != 130&&codServicio != 722&&codServicio != 723&&codServicio != 724&&codServicio != 725&&codServicio != 726&&codServicio != 727&&codServicio != 728&&codServicio != 633&&codServicio != 632&&codServicio != 170&&codServicio != 180&&codServicio != 162&&codServicio != 718&&codServicio != 630&&codServicio != 631 &&codServicio != 713 &&codServicio != 799){
							
							if (fechaValidacion != "" || (unidadBloqueda == 1 && comparaFechaLimite == 2)) var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '550','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
							else var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '550','fichaServicioEspecializadas.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
							
							if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
							
							if (claseServicio == "N" && codServicio != 892) var horario = "-------";
							else var horario = horaInicio+" - "+horaTermino;
							indice++;
							listadoServicios += "<tr id='trNro"+indice+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
							listadoServicios += "<td width='5%' align='center'><div id='valorColumna'><font color="+color+">"+indice+"</div></td>";
							listadoServicios += "<td width='15%' align='center'><div id='valorColumna'><font color="+color+">"+fecha+"</div></td>";
							listadoServicios += "<td width='55%'><div id='valorColumna'><font color="+color+">"+tipoServicio.toUpperCase()+"</div></td>";
							listadoServicios += "<td width='25%' align='center'><div id='valorColumna'><font color="+color+">"+horario+"</div></td>";
							listadoServicios += "</tr>";
						}
					}else if(tipoUnidad==160 && uniGope==0){
						
						if (sw==0) {fondoLinea = "linea1";sw =1;}
						else {fondoLinea = "linea2";sw=0;}
						
						fecha				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
						correlativo			= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
						codServicio			= (xml.getElementsByTagName('codServicio')[i].text||xml.getElementsByTagName('codServicio')[i].textContent||"");
						tipoServicio		= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
						tipoExtraordinario	= (xml.getElementsByTagName('desServicioExtraordinario')[i].text||xml.getElementsByTagName('desServicioExtraordinario')[i].textContent||"");
						horaInicio			= (xml.getElementsByTagName('horaInicio')[i].text||xml.getElementsByTagName('horaInicio')[i].textContent||"");
						horaTermino			= (xml.getElementsByTagName('horaTermino')[i].text||xml.getElementsByTagName('horaTermino')[i].textContent||"");
						claseServicio		= (xml.getElementsByTagName('claseServicio')[i].text||xml.getElementsByTagName('claseServicio')[i].textContent||"");
						fechaValidacion		= (xml.getElementsByTagName('fechaValidacion')[i].text||xml.getElementsByTagName('fechaValidacion')[i].textContent||"");
						resaltarLinea		= "cambiarClase(this, 'lineaMarcada')";
						lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
						
						var dblClick	= "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '550','fichaServicioEspecializadasGope.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
						var color 		= "";
						
						if(codServicio != 130&&codServicio != 722&&codServicio != 723&&codServicio != 724&&codServicio != 725&&codServicio != 726&&codServicio != 727&&codServicio != 728&&codServicio != 633&&codServicio != 632&&codServicio != 170&&codServicio != 180&&codServicio != 162&&codServicio != 718&&codServicio != 630&&codServicio != 631 &&codServicio != 713 &&codServicio != 799){
							
							if (fechaValidacion != "" || (unidadBloqueda == 1 && comparaFechaLimite == 2)) var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '550','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
							else var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '550','fichaServicioEspecializadasGope.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
							
							if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
							
							if (claseServicio == "N" && codServicio != 892) var horario = "-------";
							else var horario = horaInicio+" - "+horaTermino;
							indice++;
							listadoServicios += "<tr id='trNro"+indice+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
							listadoServicios += "<td width='5%' align='center'><div id='valorColumna'><font color="+color+">"+indice+"</div></td>";
							listadoServicios += "<td width='15%' align='center'><div id='valorColumna'><font color="+color+">"+fecha+"</div></td>";
							listadoServicios += "<td width='55%'><div id='valorColumna'><font color="+color+">"+tipoServicio.toUpperCase()+"</div></td>";
							listadoServicios += "<td width='25%' align='center'><div id='valorColumna'><font color="+color+">"+horario+"</div></td>";
							listadoServicios += "</tr>";
						}
				}else{
						if (sw==0) {fondoLinea = "linea1";sw =1;}
						else {fondoLinea = "linea2";sw=0;}
						
						fecha				= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
						correlativo			= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
						codServicio			= (xml.getElementsByTagName('codServicio')[i].text||xml.getElementsByTagName('codServicio')[i].textContent||"");
						tipoServicio		= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
						tipoExtraordinario	= (xml.getElementsByTagName('desServicioExtraordinario')[i].text||xml.getElementsByTagName('desServicioExtraordinario')[i].textContent||"");
						horaInicio			= (xml.getElementsByTagName('horaInicio')[i].text||xml.getElementsByTagName('horaInicio')[i].textContent||"");
						horaTermino			= (xml.getElementsByTagName('horaTermino')[i].text||xml.getElementsByTagName('horaTermino')[i].textContent||"");
						claseServicio		= (xml.getElementsByTagName('claseServicio')[i].text||xml.getElementsByTagName('claseServicio')[i].textContent||"");
						fechaValidacion		= (xml.getElementsByTagName('fechaValidacion')[i].text||xml.getElementsByTagName('fechaValidacion')[i].textContent||"");
						resaltarLinea		= "cambiarClase(this, 'lineaMarcada')";
						lineaSinResaltar	= "cambiarClase(this, '"+fondoLinea+"')";
						
						var dblClick 	 = "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '550','fichaServicioCuadrante.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
						var color = "";
						
						if(codServicio != 130&&codServicio != 722&&codServicio != 723&&codServicio != 724&&codServicio != 725&&codServicio != 726&&codServicio != 727&&codServicio != 728&&codServicio != 633&&codServicio != 632&&codServicio != 170&&codServicio != 180&&codServicio != 162&&codServicio != 718&&codServicio != 630&&codServicio != 631 &&codServicio != 713 &&codServicio != 799){
							
							if (fechaValidacion != "" || (unidadBloqueda == 1 && comparaFechaLimite == 2)) var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+unidad+"&correlativo="+correlativo+"', '','','0','0')";
							else var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '970', '550','fichaServicioCuadrante.php?unidad="+unidad+"&correlativo="+correlativo+"', 'trNro"+i+"','','5','5')";
							
							if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
							
							if (claseServicio == "N" && codServicio != 892) var horario = "-------";
							else var horario = horaInicio+" - "+horaTermino;
							indice++;
							listadoServicios += "<tr id='trNro"+indice+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
							listadoServicios += "<td width='5%' align='center'><div id='valorColumna'><font color="+color+">"+indice+"</div></td>";
							listadoServicios += "<td width='15%' align='center'><div id='valorColumna'><font color="+color+">"+fecha+"</div></td>";
							listadoServicios += "<td width='55%'><div id='valorColumna'><font color="+color+">"+tipoServicio.toUpperCase()+"</div></td>";
							listadoServicios += "<td width='25%' align='center'><div id='valorColumna'><font color="+color+">"+horario+"</div></td>";
							listadoServicios += "</tr>";
						}
					}
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

var cargaDatosServicio;
function leeDatosServicio(unidad, correlativo, vista){
	var permisoRegistrar	= document.getElementById("permisoRegistrar").value;
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
	//console.log("codigoUnidad="+unidad+"&correlativo="+correlativo);
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&correlativo="+correlativo));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//console.log(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//console.log(objHttpXMLServicios.responseText);
				var xml = objHttpXMLServicios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
					var identificacionServicio = xml.getElementsByTagName('identificacionServicio')[i];
					var mediosDeVigilancia 	   = xml.getElementsByTagName('mediosDeVigilancia')[i];
					if(!vista){
						listaHoras('selHoraTermino',0,0);
						document.getElementById("selHoraTermino").disabled = "";
					}
					leeIdentificacionServicio(identificacionServicio, vista);
					if (vista) vistaMediosDeVigilancia(mediosDeVigilancia);
					else {
						if (mediosDeVigilancia != null){
							leeMediosDeVigilancia(mediosDeVigilancia);
							llenaArregloFuncionariosAccesorios(mediosDeVigilancia);
							(tipoServicioDestinado.includes(selServicio.value)||grupoServicioDestinado.includes(selServicio.value.substr(0,1))) ? llenaArregloMediosDeVigilancia2(mediosDeVigilancia) : llenaArregloMediosDeVigilancia(mediosDeVigilancia);
						}
						document.getElementById("mensajeCargando").style.display = "none";
						
						if (document.getElementById("correlativoServicio").value != ""){
							document.getElementById("selTipoServicio").disabled = "true";
							document.getElementById("selHoraInicio").disabled = "true";
							document.getElementById("selHoraTermino").disabled = "true";
							document.getElementById("idFechaServicio").disabled = "true";
						}
						
						document.getElementById("btnSiguiente").disabled = "";
						document.getElementById("btnCerrar").disabled = "";
						if(permisoRegistrar) document.getElementById("btnEliminar").disabled = "";
					}
				}
			}
			cargaDatosServicio = 1;
		}
	}
}

var idAsignaServExtFichaServicio; 
var idAsignaServFichaServicio; 
function leeIdentificacionServicio(identificacionServicio, vista){
	
	var codigoServicio		= (identificacionServicio.getElementsByTagName('codServicio')[0].text||identificacionServicio.getElementsByTagName('codServicio')[0].textContent||"");
	var tipoServicio		= (identificacionServicio.getElementsByTagName('tipoServicio')[0].text||identificacionServicio.getElementsByTagName('tipoServicio')[0].textContent||"");
	var descripcionServicio	= (identificacionServicio.getElementsByTagName('desServicio')[0].text||identificacionServicio.getElementsByTagName('desServicio')[0].textContent||"");
	var codExtraordinario	= (identificacionServicio.getElementsByTagName('codServicioExtraordinario')[0].text||identificacionServicio.getElementsByTagName('codServicioExtraordinario')[0].textContent||"");
	var extraordinario		= (identificacionServicio.getElementsByTagName('desServicioExtraordinario')[0].text||identificacionServicio.getElementsByTagName('desServicioExtraordinario')[0].textContent||"");
	var otroExtraordinario	= (identificacionServicio.getElementsByTagName('desOtroServicioExtraordinario')[0].text||identificacionServicio.getElementsByTagName('desOtroServicioExtraordinario')[0].textContent||"");
	var descripcionServicio	= (identificacionServicio.getElementsByTagName('desServicio')[0].text||identificacionServicio.getElementsByTagName('desServicio')[0].textContent||"");
	var descripcionUnidad	= (identificacionServicio.getElementsByTagName('desUnidad')[0].text||identificacionServicio.getElementsByTagName('desUnidad')[0].textContent||"");
	var fechaCompleta		= (identificacionServicio.getElementsByTagName('fechaCompleta')[0].text||identificacionServicio.getElementsByTagName('fechaCompleta')[0].textContent||"");
	var fecha				= (identificacionServicio.getElementsByTagName('fecha')[0].text||identificacionServicio.getElementsByTagName('fecha')[0].textContent||"");
	var horaInicio			= (identificacionServicio.getElementsByTagName('horaInicio')[0].text||identificacionServicio.getElementsByTagName('horaInicio')[0].textContent||"");
	var horaTermino			= (identificacionServicio.getElementsByTagName('horaTermino')[0].text||identificacionServicio.getElementsByTagName('horaTermino')[0].textContent||"");
	var observaciones		= (identificacionServicio.getElementsByTagName('observaciones')[0].text||identificacionServicio.getElementsByTagName('observaciones')[0].textContent||"");
	var codDestino			= (identificacionServicio.getElementsByTagName('codUnidadDestino')[0].text||identificacionServicio.getElementsByTagName('codUnidadDestino')[0].textContent||"");
	var descDestino			= (identificacionServicio.getElementsByTagName('descUnidadDestino')[0].text||identificacionServicio.getElementsByTagName('descUnidadDestino')[0].textContent||"");
	
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
		vistaServicio += "	<td width='18%'align='right'>T\u00E9rmino&nbsp;:&nbsp;</td>";
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
		
		if(codDestino){
			vistaServicio += "<tr>";
			vistaServicio += "	<td width='18%' align='right'>Destinado a&nbsp;:&nbsp;</td>";
			vistaServicio += "	<td width='82%' colspan='3' class='dato'>"+descDestino+"</td>";
			vistaServicio += "</tr>";
		}

		vistaServicio += "</table>";
		document.getElementById("identificacionServicio").innerHTML	= vistaServicio;
		document.getElementById("observaciones").innerHTML			= observaciones;
		document.getElementById("tipoServicio").value				= tipoServicio;
		
	} else {
		document.getElementById("textOtroExtraordinario").value		= otroExtraordinario;
		document.getElementById("textFechaServicio").value			= fecha;
		document.getElementById("selHoraInicio").value				= horaInicio;
		document.getElementById("selHoraTermino").value				= horaTermino;
		document.getElementById("textObservaciones").value			= observaciones;
		document.getElementById("unidadServicioDestino").value		= codDestino;
		document.getElementById("unidadServicioDestinoDesc").value	= descDestino;
		
		if(tipoServicio=="N"||codigoServicio==607){
			habilitarCheckFuncionariosDisponibles(false);
		}
		else{
			habilitarCheckFuncionariosDisponibles(true);
		}
		
		var valorCodigoServicio = tipoServicio+codigoServicio;
		//if (codigoServicio != 1100){
		if (codigoServicio != 1100 && codigoServicio != 1200 && codigoServicio != 1300){
			var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
			document.getElementById('selServicio').options[0] = datosOpcion;
		} else {
			//var valorCodigoServicio = "E"+codExtraordinario;
			var valorCodigoServicio = ((codigoServicio == 1200) ? "E" : (codigoServicio == 1300) ? "X" : "E")+codExtraordinario;
			var datosOpcion = new Option(extraordinario, valorCodigoServicio, "", "");
			document.getElementById('selServicio').options[0] = datosOpcion;
		}
    
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
    
    if(codigoServicio == 632 || codigoServicio == 720){
    	var datosOpcion = new Option("ACOGIDO A MEDICINA PREVENTIVA",0, "", "");
      document.getElementById('selServicio').options[0] = datosOpcion;
      var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
      document.getElementById('selLicencia').options[0] = datosOpcion;
      document.getElementById("selServicio").disabled = true;
      document.getElementById("selLicencia").style.backgroundColor = "";
      document.getElementById("selLicencia").disabled = false;
    }
    
    if(codigoServicio == 717 || codigoServicio == 721){
    	var datosOpcion = new Option("LICENCIA MEDICA",0, "", "");
      document.getElementById('selServicio').options[0] = datosOpcion;
      var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
      document.getElementById('selLicencia').options[0] = datosOpcion;
      document.getElementById("selServicio").disabled = true;
      document.getElementById("selLicencia").style.backgroundColor = "";
    	document.getElementById("selLicencia").disabled = false;
    }
		
    if(codigoServicio == 162 || codigoServicio == 170 || codigoServicio == 180 || codigoServicio == 631 || codigoServicio == 719){
	  	var datosOpcion = new Option("LICENCIAS VINCULADAS A LA MATERNIDAD",0, "", "");
      document.getElementById('selServicio').options[0] = datosOpcion;
      var datosOpcion = new Option(descripcionServicio, valorCodigoServicio, "", "");
      document.getElementById('selLicencia').options[0] = datosOpcion;
      document.getElementById("selServicio").disabled = true;
    	document.getElementById("selLicencia").style.backgroundColor = "";
    	document.getElementById("selLicencia").disabled = false;
    }
		
		idAsignaServFichaServicio = setInterval("asignaValFichaServicio('"+valorCodigoServicio+"','"+descripcionServicio+"')",1000);
		if (codExtraordinario != ""){
			idAsignaServExtFichaServicio = setInterval("asignaValExtFichaServicio("+codExtraordinario+")",1000);
		}
		
		if (otroExtraordinario != ""){
			document.getElementById("textOtroExtraordinario").style.backgroundColor = "";
			document.getElementById("textOtroExtraordinario").disabled = false;
		}
	}
}

function asignaValExtFichaServicio(valor){
	if(cargaTipoServicioExtraordinario == 1){
		clearInterval(idAsignaServExtFichaServicio);
		document.getElementById("selTipoExtraordinario").value 	= valor;
		document.getElementById("labDescripcion").disabled	= false;
		document.getElementById("selTipoExtraordinario").disabled = false;
	}
}

function asignaValFichaServicio(valor, descripcionServicio){
	if(cargaTipoServicio == 1){
		clearInterval(idAsignaServFichaServicio);
		document.getElementById("selServicio").value = valor;
		seleccionServicio();
	  if(valor == "N161" || valor == "N162" || valor== "N170" || valor == "N180" || valor == "N628" || valor == "N629" || valor == "N630" || valor == "N631" || valor == "N632" || valor == "N633" || valor == "N717" || valor == "N719" || valor == "N720" || valor == "N721"){
		clearInterval(idAsignaServFichaServicio);
		document.getElementById("selServicio").value = valor;
		seleccionServicio();
	    document.getElementById("selLicencia").value = valor;
	    document.getElementById("selLicencia").disabled = false;
	    document.getElementById("selLicencia").style.backgroundColor = "";
	    listaLicencias('selServicio');
	  }
	}
}

function leeMediosDeVigilancia(mediosDeVigilancia){
	for(var i=0;i<mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;i++){
		var funcionarios = mediosDeVigilancia.getElementsByTagName('funcionarios')[i];
		leeFuncionarios(funcionarios);
		var vehiculo = mediosDeVigilancia.getElementsByTagName('vehiculo')[i];
		leeAnimalesServicio(vehiculo);
		leeVehiculosServicio(vehiculo);
	}
}

function vistaMediosDeVigilancia(mediosDeVigilancia){
	var tipoUnidad = document.getElementById("tipoUnidad").value;
	if(tipoUnidad==30 || tipoUnidad==120){
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
			var factor 			= (mediosDeVigilancia.getElementsByTagName('descripcionFactor')[i].text||mediosDeVigilancia.getElementsByTagName('descripcionFactor')[i].textContent||"");
			var codigoVehiculo 	= (vehiculo.getElementsByTagName('codigoVehiculo')[0].text||vehiculo.getElementsByTagName('codigoVehiculo')[0].textContent||"");
			var patenteVehiculo	= (vehiculo.getElementsByTagName('patenteVehiculo')[0].text||vehiculo.getElementsByTagName('patenteVehiculo')[0].textContent||"");
			var tipoVehiculo	= (vehiculo.getElementsByTagName('tipoVehiculo')[0].text||vehiculo.getElementsByTagName('tipoVehiculo')[0].textContent||"");
			var kmInicial		= (vehiculo.getElementsByTagName('kmInicial')[0].text||vehiculo.getElementsByTagName('kmInicial')[0].textContent||"");
			var kmFinal			= (vehiculo.getElementsByTagName('kmFinal')[0].text||vehiculo.getElementsByTagName('kmFinal')[0].textContent||"");
			var codigoAnimal	= (vehiculo.getElementsByTagName('codigoAnimal')[0].text||vehiculo.getElementsByTagName('codigoAnimal')[0].textContent||"");
			var tipoAnimal		= (vehiculo.getElementsByTagName('tipoAnimal')[0].text||vehiculo.getElementsByTagName('tipoAnimal')[0].textContent||"");
			var nombreAnimal	= (vehiculo.getElementsByTagName('nombreAnimal')[0].text||vehiculo.getElementsByTagName('nombreAnimal')[0].textContent||"");
			
			var descripcionVehiculo	= tipoVehiculo + " (" + patenteVehiculo + ")";
			vistaMedios += "<table width='100%' cellspacing='1' cellpadding='1'>";
			if (codigoVehiculo != 0){
				vistaMedios += "<tr>";
				vistaMedios += "	<td width='18%' align='right'>Veh\u00EDculo&nbsp;:&nbsp;</td>";
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
			}
			var contFuncionarios = 0;
			var funcionarios = mediosDeVigilancia.getElementsByTagName('funcionarios')[i];
			for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
				var codigoFuncionario	= (funcionarios.getElementsByTagName('codigoFuncionario')[j].text||funcionarios.getElementsByTagName('codigoFuncionario')[j].textContent||"");
				var apellidoPaterno 	= (funcionarios.getElementsByTagName('apellidoPaterno')[j].text||funcionarios.getElementsByTagName('apellidoPaterno')[j].textContent||"");
				var apellidoMaterno 	= (funcionarios.getElementsByTagName('apellidoMaterno')[j].text||funcionarios.getElementsByTagName('apellidoMaterno')[j].textContent||"");
				var primerNombre 		= (funcionarios.getElementsByTagName('primerNombre')[j].text||funcionarios.getElementsByTagName('primerNombre')[j].textContent||"");
				var grado 				= (funcionarios.getElementsByTagName('grado')[j].text||funcionarios.getElementsByTagName('grado')[j].textContent||"");
				var descripcion			= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " - " + grado + " (" + codigoFuncionario +")";
				var armas 				= funcionarios.getElementsByTagName('armas')[j];
				var accesorios 			= funcionarios.getElementsByTagName('accesorios')[j];
				var camaras 			= funcionarios.getElementsByTagName('camaras')[j];
				
				if (armas.getElementsByTagName('arma').length > 0 ){
					for(var k=0;k<armas.getElementsByTagName('arma').length;k++){
						var etiqueta = "";
						var tipoArma	= (armas.getElementsByTagName('tipoArma')[k].text||armas.getElementsByTagName('tipoArma')[k].textContent||"");
						var codArma		= (armas.getElementsByTagName('numeroSerie')[k].text||armas.getElementsByTagName('numeroSerie')[k].textContent||"");
						var descripcionArma = tipoArma + " (NUMERO : "+codArma+")";
						if (contFuncionarios==0) etiqueta = "Personal&nbsp;:&nbsp;";
						if (k>0) descripcion = "";
						vistaMedios += "<tr>";
						vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
						vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'>"+descripcion+"</td>";
						vistaMedios += "<td width='32%' align='left' class='dato'>"+descripcionArma+"</td>";
						vistaMedios += "</tr>";
						contFuncionarios++;
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
				
				if (camaras.getElementsByTagName('camara').length > 0 ){
					for(var k=0;k<camaras.getElementsByTagName('camara').length;k++){
						var etiqueta = "";
						var numeroSerieCamara	= (camaras.getElementsByTagName('numeroSerie')[k].text||camaras.getElementsByTagName('numeroSerie')[k].textContent||"");
						var modeloCamara		= (camaras.getElementsByTagName('modeloCamara')[k].text||camaras.getElementsByTagName('modeloCamara')[k].textContent||"");
						var descripcionCamara = "CAMARA " + modeloCamara + " (NUMERO : "+numeroSerieCamara+")";
						vistaMedios += "<tr>";
						vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
						vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'></td>";
						vistaMedios += "<td width='32%' align='left' class='dato'>"+descripcionCamara+"</td>";
						vistaMedios += "</tr>";
					}
				}

				if (accesorios.getElementsByTagName('accesorio').length > 0 ){
					for(var k=0;k<accesorios.getElementsByTagName('accesorio').length;k++){
						var etiqueta = "";
						var descripcionAccesorio = (accesorios.getElementsByTagName('descripcionAccesorio')[k].text||accesorios.getElementsByTagName('descripcionAccesorio')[k].textContent||"");
						vistaMedios += "<tr>";
						vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
						vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'></td>";
						vistaMedios += "<td width='32%' align='left' class='dato'>"+descripcionAccesorio+"</td>";
						vistaMedios += "</tr>";
						
					}
				}

			}
			
			if (codigoAnimal != 0){
				vistaMedios += "<tr>";
				vistaMedios += "	<td width='18%' align='right'>Animal Asignado&nbsp;:&nbsp;</td>";
				vistaMedios += "	<td width='32%' align='left' class='dato'>"+tipoAnimal+"</td>";
				vistaMedios += "	<td width='18%' align='right'>Nombre Animal&nbsp;:&nbsp;</td>";
				vistaMedios += "	<td width='32%' align='left' class='dato'>"+nombreAnimal+"</td>";
				vistaMedios += "</tr>";
			}

			if (document.getElementById("tipoServicio").value == "O"){
				var descripcionCuadrantes = "";
				cuadrantes = mediosDeVigilancia.getElementsByTagName('destino')[i];
				
				for (var j=0; j<cuadrantes.getElementsByTagName('destino').length; j++){
					var cuadrante = (cuadrantes.getElementsByTagName('descripcionDestino')[j].text||cuadrantes.getElementsByTagName('descripcionDestino')[j].textContent||"");
					descripcionCuadrantes += cuadrante + ", ";
				}
				
				if (cuadrantes.getElementsByTagName('destino').length > 0){
					var largoString = descripcionCuadrantes.length;
					descripcionCuadrantes = descripcionCuadrantes.substring(0, (largoString-2));
				}
				
				vistaMedios += "<table width='100%' cellspacing='1' cellpadding='1'>";
				vistaMedios += "<tr>";
				vistaMedios += "<td width='18%' align='right'>Destino(s)&nbsp;:&nbsp;</td>";
				vistaMedios += "<td width='82%' colspan='3' align='left' class='dato'>r"+descripcionCuadrantes+"</td>";
				vistaMedios += "</tr>";
				vistaMedios += "<tr>";
				vistaMedios += "<td width='18%' align='right'>Factor&nbsp;:&nbsp;</td>";
				vistaMedios += "<td width='82%' colspan='3' align='left' class='dato'></td>";
				vistaMedios += "</tr>";
				vistaMedios += "</table>";
			}
		}
		document.getElementById("mediosDeVigilancia").innerHTML 	= vistaMedios;
	}else{
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
			var factor 			= (mediosDeVigilancia.getElementsByTagName('descripcionFactor')[i].text||mediosDeVigilancia.getElementsByTagName('descripcionFactor')[i].textContent||"");
			var codigoVehiculo 	= (vehiculo.getElementsByTagName('codigoVehiculo')[0].text||vehiculo.getElementsByTagName('codigoVehiculo')[0].textContent||"");
			var patenteVehiculo	= (vehiculo.getElementsByTagName('patenteVehiculo')[0].text||vehiculo.getElementsByTagName('patenteVehiculo')[0].textContent||"");
			var tipoVehiculo	= (vehiculo.getElementsByTagName('tipoVehiculo')[0].text||vehiculo.getElementsByTagName('tipoVehiculo')[0].textContent||"");
			var kmInicial		= (vehiculo.getElementsByTagName('kmInicial')[0].text||vehiculo.getElementsByTagName('kmInicial')[0].textContent||"");
			var kmFinal			= (vehiculo.getElementsByTagName('kmFinal')[0].text||vehiculo.getElementsByTagName('kmFinal')[0].textContent||"");
			var codigoAnimal	= (vehiculo.getElementsByTagName('codigoAnimal')[0].text||vehiculo.getElementsByTagName('codigoAnimal')[0].textContent||"");
			var tipoAnimal		= (vehiculo.getElementsByTagName('tipoAnimal')[0].text||vehiculo.getElementsByTagName('tipoAnimal')[0].textContent||"");
			var nombreAnimal	= (vehiculo.getElementsByTagName('nombreAnimal')[0].text||vehiculo.getElementsByTagName('nombreAnimal')[0].textContent||"");
			
			var descripcionVehiculo	= tipoVehiculo + " (" + patenteVehiculo + ")";
			vistaMedios += "<table width='100%' cellspacing='1' cellpadding='1'>";
			if (codigoVehiculo != 0){
				vistaMedios += "<tr>";
				vistaMedios += "	<td width='18%' align='right'>Veh\u00EDculo&nbsp;:&nbsp;</td>";
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
			}

			var contFuncionarios = 0;
			var funcionarios = mediosDeVigilancia.getElementsByTagName('funcionarios')[i];
			
			for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
				var codigoFuncionario = (funcionarios.getElementsByTagName('codigoFuncionario')[j].text||funcionarios.getElementsByTagName('codigoFuncionario')[j].textContent||"");
				var apellidoPaterno 	= (funcionarios.getElementsByTagName('apellidoPaterno')[j].text||funcionarios.getElementsByTagName('apellidoPaterno')[j].textContent||"");
				var apellidoMaterno 	= (funcionarios.getElementsByTagName('apellidoMaterno')[j].text||funcionarios.getElementsByTagName('apellidoMaterno')[j].textContent||"");
				var primerNombre 		= (funcionarios.getElementsByTagName('primerNombre')[j].text||funcionarios.getElementsByTagName('primerNombre')[j].textContent||"");
				var grado 				= (funcionarios.getElementsByTagName('grado')[j].text||funcionarios.getElementsByTagName('grado')[j].textContent||"");
				var descripcion			= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " - " + grado + " (" + codigoFuncionario +")";
				var armas 				= funcionarios.getElementsByTagName('armas')[j];
				var accesorios 			= funcionarios.getElementsByTagName('accesorios')[j];
				var camaras 			= funcionarios.getElementsByTagName('camaras')[j];
				
				if (armas.getElementsByTagName('arma').length > 0 ){
					for(var k=0;k<armas.getElementsByTagName('arma').length;k++){
						var etiqueta	= "";
						var tipoArma	= (armas.getElementsByTagName('tipoArma')[k].text||armas.getElementsByTagName('tipoArma')[k].textContent||"");
						var codArma		= (armas.getElementsByTagName('numeroSerie')[k].text||armas.getElementsByTagName('numeroSerie')[k].textContent||"");
						var descripcionArma = tipoArma + " (NUMERO : "+codArma+")";
						
						if (contFuncionarios==0) etiqueta = "Personal&nbsp;:&nbsp;";
						if (k>0) descripcion = "";
						
						vistaMedios += "<tr>";
						vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
						vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'>"+descripcion+"</td>";
						vistaMedios += "<td width='32%' align='left' class='dato'>"+descripcionArma+"</td>";
						vistaMedios += "</tr>";
						contFuncionarios++;
					}
				} else {
					var etiqueta = "";
					if(contFuncionarios==0) etiqueta = "Personal&nbsp;:&nbsp;";
					
					vistaMedios += "<tr>";
					vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
					vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'>"+descripcion+"</td>";
					vistaMedios += "<td width='32%' align='left' class='dato'></td>";
					vistaMedios += "</tr>";
					contFuncionarios++;
				}

				if (camaras.getElementsByTagName('camara').length > 0 ){
					for(var k=0;k<camaras.getElementsByTagName('camara').length;k++){
						var etiqueta = "";
						var numeroSerieCamara	= (camaras.getElementsByTagName('numeroSerieCamara')[k].text||camaras.getElementsByTagName('numeroSerieCamara')[k].textContent||"");
						var modeloCamara		= (camaras.getElementsByTagName('modeloCamara')[k].text||camaras.getElementsByTagName('modeloCamara')[k].textContent||"");
						var descripcionCamara = "CAMARA " + modeloCamara + " (NUMERO : "+numeroSerieCamara+")";
						vistaMedios += "<tr>";
						vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
						vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'></td>";
						vistaMedios += "<td width='32%' align='left' class='dato'>"+descripcionCamara+"</td>";
						vistaMedios += "</tr>";
					}
				}

				if (accesorios.getElementsByTagName('accesorio').length > 0 ){
					for(var k=0;k<accesorios.getElementsByTagName('accesorio').length;k++){
						var etiqueta = "";
						var descripcionAccesorio = (accesorios.getElementsByTagName('descripcionAccesorio')[k].text||accesorios.getElementsByTagName('descripcionAccesorio')[k].textContent||"");
						vistaMedios += "<tr>";
						vistaMedios += "<td width='18%' align='right'>"+etiqueta+"</td>";
						vistaMedios += "<td width='50%' colspan='2' align='left' class='dato'></td>";
						vistaMedios += "<td width='32%' align='left' class='dato'>"+descripcionAccesorio+"</td>";
						vistaMedios += "</tr>";
						
					}
				}

			}

			if (codigoAnimal != 0){
				vistaMedios += "<tr>";
				vistaMedios += "	<td width='18%' align='right'>Animal Asignado&nbsp;:&nbsp;</td>";
				vistaMedios += "	<td width='32%' align='left' class='dato'>"+tipoAnimal+"</td>";
				vistaMedios += "	<td width='18%' align='right'>Nombre Animal&nbsp;:&nbsp;</td>";
				vistaMedios += "	<td width='32%' align='left' class='dato'>"+nombreAnimal+"</td>";
				vistaMedios += "</tr>";
			}

			if (document.getElementById("tipoServicio").value == "O"){
				var descripcionCuadrantes = "";
				cuadrantes = mediosDeVigilancia.getElementsByTagName('cuadrantes')[i];
				for (var j=0; j<cuadrantes.getElementsByTagName('cuadrante').length; j++){
					var cuadrante = (cuadrantes.getElementsByTagName('descripcionCuadrante')[j].text||cuadrantes.getElementsByTagName('descripcionCuadrante')[j].textContent||"");
					descripcionCuadrantes += cuadrante + ", ";
				}
				
				if (cuadrantes.getElementsByTagName('cuadrante').length > 0){
					var largoString = descripcionCuadrantes.length;
					descripcionCuadrantes = descripcionCuadrantes.substring(0, (largoString-2));
				}
				
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
}

function leeFuncionarios(funcionarios){
	for(var i=0;i<funcionarios.getElementsByTagName('funcionario').length;i++){
		var codigoFuncionario = (funcionarios.getElementsByTagName('codigoFuncionario')[i].text||funcionarios.getElementsByTagName('codigoFuncionario')[i].textContent||"");
		var apellidoPaterno 	= (funcionarios.getElementsByTagName('apellidoPaterno')[i].text||funcionarios.getElementsByTagName('apellidoPaterno')[i].textContent||"");
		var apellidoMaterno 	= (funcionarios.getElementsByTagName('apellidoMaterno')[i].text||funcionarios.getElementsByTagName('apellidoMaterno')[i].textContent||"");
		var primerNombre 			= (funcionarios.getElementsByTagName('primerNombre')[i].text||funcionarios.getElementsByTagName('primerNombre')[i].textContent||"");
		var grado 						= (funcionarios.getElementsByTagName('grado')[i].text||funcionarios.getElementsByTagName('grado')[i].textContent||"");
		var descripcion				= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
		var datosOpcion = new Option(descripcion, codigoFuncionario, "", "");
		document.getElementById('personalAsignado').options[document.getElementById('personalAsignado').length] = datosOpcion;
	}
	ordenar(document.getElementById('personalAsignado'));
}

function leeVehiculosServicio(vehiculo){
	var codigoVehiculo 	= (vehiculo.getElementsByTagName('codigoVehiculo')[i].text||vehiculo.getElementsByTagName('codigoVehiculo')[i].textContent||"");
	var patenteVehiculo	= (vehiculo.getElementsByTagName('patenteVehiculo')[i].text||vehiculo.getElementsByTagName('patenteVehiculo')[i].textContent||"");
	var tipoVehiculo		= (vehiculo.getElementsByTagName('tipoVehiculo')[i].text||vehiculo.getElementsByTagName('tipoVehiculo')[i].textContent||"");
	var descripcion			= tipoVehiculo + " (" + patenteVehiculo + ")";
	if (codigoVehiculo != 0){	
		var datosOpcion = new Option(descripcion, codigoVehiculo, "", "");
		document.getElementById('vehiculosAsignados').options[document.getElementById('vehiculosAsignados').length] = datosOpcion;
	}
}

function leeAnimalesServicio(animal){
	var codigoAnimal	= (animal.getElementsByTagName('codigoAnimal')[i].text||animal.getElementsByTagName('codigoAnimal')[i].textContent||"");
	var nombreAnimal	= (animal.getElementsByTagName('nombreAnimal')[i].text||animal.getElementsByTagName('nombreAnimal')[i].textContent||"");
	var tipoAnimal		= (animal.getElementsByTagName('tipoAnimal')[i].text||animal.getElementsByTagName('tipoAnimal')[i].textContent||"");
	var descripcion		= tipoAnimal + " (" + nombreAnimal + ")";
	if (codigoAnimal != 0){
		var datosOpcion = new Option(descripcion, codigoAnimal, "", "");
		document.getElementById('animalesAsignados').options[document.getElementById('animalesAsignados').length] = datosOpcion;
	}
}

function leeSimccarServicio(simccar){
	var codigoSimccar = (simccar.getElementsByTagName('codigoSimccar')[i].text||simccar.getElementsByTagName('codigoSimccar')[i].textContent||"");
	var serieSimccar  = (simccar.getElementsByTagName('numeroSerie')[i].text||simccar.getElementsByTagName('numeroSerie')[i].textContent||"");
	var Tsimccar="SIMCCAR";
	var descripcion	= Tsimccar + " (" + serieSimccar + ")";
	var datosOpcion = new Option(descripcion, codigoSimccar, "", "");
	document.getElementById('simccarAsignados').options[document.getElementById('simccarAsignados').length] = datosOpcion;
}

function llenaArregloMediosDeVigilancia(mediosDeVigilancia){
	var tipoUnidad = document.getElementById("tipoUnidad").value;
	var unidadGope =  document.getElementById("unidadGope").value;
	if((tipoUnidad == 30 || tipoUnidad==120)||(tipoUnidad==160 && unidadGope==0)){
	  for(var i=0;i<mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;i++){
			var medioDeVigilancia = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
			var codigoFactor	  	= (mediosDeVigilancia.getElementsByTagName('codigoFactor')[i].text||mediosDeVigilancia.getElementsByTagName('codigoFactor')[i].textContent||"");
			var vehiculo 		  		= medioDeVigilancia.getElementsByTagName('vehiculo')[0];
			var codigoVehiculo 	  = (vehiculo.getElementsByTagName('codigoVehiculo')[0].text||vehiculo.getElementsByTagName('codigoVehiculo')[0].textContent||"");
			var patenteVehiculo	  = (vehiculo.getElementsByTagName('patenteVehiculo')[0].text||vehiculo.getElementsByTagName('patenteVehiculo')[0].textContent||"");
			var tipoVehiculo	  	= (vehiculo.getElementsByTagName('tipoVehiculo')[0].text||vehiculo.getElementsByTagName('tipoVehiculo')[0].textContent||"");
			var kmInicial		  		= (vehiculo.getElementsByTagName('kmInicial')[0].text||vehiculo.getElementsByTagName('kmInicial')[0].textContent||"");
			var kmFinal			  		= (vehiculo.getElementsByTagName('kmFinal')[0].text||vehiculo.getElementsByTagName('kmFinal')[0].textContent||"");
			var descripcion		  	= tipoVehiculo + " (" + patenteVehiculo + ")";
			var codigoAnimal 			= (vehiculo.getElementsByTagName('codigoAnimal')[0].text||vehiculo.getElementsByTagName('codigoAnimal')[0].textContent||"");
			var nombreAnimal			= (vehiculo.getElementsByTagName('nombreAnimal')[0].text||vehiculo.getElementsByTagName('nombreAnimal')[0].textContent||"");
			var tipoAnimal	 			= (vehiculo.getElementsByTagName('tipoAnimal')[0].text||vehiculo.getElementsByTagName('tipoAnimal')[0].textContent||"");
			
			document.getElementById('vehiculosServicio').length = null;
			var datosOpcion = new Option(descripcion, codigoVehiculo, "", "");
			document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').length] = datosOpcion;
			
			var descAnimal = tipoAnimal + " (" + nombreAnimal + ")";
			document.getElementById('animalServicio').length = null;
			var datosOpcion2 = new Option(descAnimal, codigoAnimal, "", "");
			document.getElementById('animalServicio').options[document.getElementById('animalServicio').length] = datosOpcion2;
			
			document.getElementById('textKmInicial').value 	= kmInicial;
			document.getElementById('textKmFinal').value 	= kmFinal;
			
			funcionarios = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
			for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
				var codigoFuncionario	= (funcionarios.getElementsByTagName('codigoFuncionario')[j].text||funcionarios.getElementsByTagName('codigoFuncionario')[j].textContent||"");
				var apellidoPaterno 	= (funcionarios.getElementsByTagName('apellidoPaterno')[j].text||funcionarios.getElementsByTagName('apellidoPaterno')[j].textContent||"");
				var apellidoMaterno 	= (funcionarios.getElementsByTagName('apellidoMaterno')[j].text||funcionarios.getElementsByTagName('apellidoMaterno')[j].textContent||"");
				var primerNombre 			= (funcionarios.getElementsByTagName('primerNombre')[j].text||funcionarios.getElementsByTagName('primerNombre')[j].textContent||"");
				var grado 						= (funcionarios.getElementsByTagName('grado')[j].text||funcionarios.getElementsByTagName('grado')[j].textContent||"");
				var descripcionFuncionario = apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
				var datosOpcion = new Option(descripcionFuncionario, codigoFuncionario, "", "");
				document.getElementById('personalServicioMedio').options[document.getElementById('personalServicioMedio').length] = datosOpcion;
			}
			
			destinos = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
			for(var j=0;j<destinos.getElementsByTagName('destino').length;j++){
				var codigoDestino 			= (destinos.getElementsByTagName('codigoDestino')[j].text||destinos.getElementsByTagName('codigoDestino')[j].textContent||"");
				var descripcionDestino 	= (destinos.getElementsByTagName('descripcionDestino')[j].text||destinos.getElementsByTagName('descripcionDestino')[j].textContent||"");
				var datosOpcion = new Option(descripcionDestino, codigoDestino, "", "");
				document.getElementById('destinosSeleccionados').options[document.getElementById('destinosSeleccionados').length] = datosOpcion;
			}
			cuadrantes = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
			for(var j=0;j<cuadrantes.getElementsByTagName('cuadrante').length;j++){
				var codigoCuadrante 			= (cuadrantes.getElementsByTagName('codigoCuadrante')[j].text||cuadrantes.getElementsByTagName('codigoCuadrante')[j].textContent||"");
	      var descripcionCuadrante 	= (cuadrantes.getElementsByTagName('descripcionCuadrante')[j].text||cuadrantes.getElementsByTagName('descripcionCuadrante')[j].textContent||"");
	      var unidadDescripcion 		= (cuadrantes.getElementsByTagName('descUni')[j].text||cuadrantes.getElementsByTagName('descUni')[j].textContent||"");
				var cuadranteDesc 				= descripcionCuadrante+" ("+unidadDescripcion+")";
	      var codigoCuadrante2 			= codigoCuadrante+"C";
				var datosOpcion = new Option(cuadranteDesc, codigoCuadrante2, "", "");
				document.getElementById('destinosSeleccionados').options[document.getElementById('destinosSeleccionados').length] = datosOpcion;
			}
			agregaMedioVigilancia(1);
	 	}
	}else{
		for(var i=0;i<mediosDeVigilancia.getElementsByTagName('medioVigilancia').length;i++){
			var medioDeVigilancia = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
			var codigoFactor	  	= (mediosDeVigilancia.getElementsByTagName('codigoFactor')[i].text||mediosDeVigilancia.getElementsByTagName('codigoFactor')[i].textContent||"");
			var vehiculo 		  		= medioDeVigilancia.getElementsByTagName('vehiculo')[0];
			var codigoVehiculo 	  = (vehiculo.getElementsByTagName('codigoVehiculo')[0].text||vehiculo.getElementsByTagName('codigoVehiculo')[0].textContent||"");
			var patenteVehiculo	  = (vehiculo.getElementsByTagName('patenteVehiculo')[0].text||vehiculo.getElementsByTagName('patenteVehiculo')[0].textContent||"");
			var tipoVehiculo	  	= (vehiculo.getElementsByTagName('tipoVehiculo')[0].text||vehiculo.getElementsByTagName('tipoVehiculo')[0].textContent||"");
			var kmInicial		  		= (vehiculo.getElementsByTagName('kmInicial')[0].text||vehiculo.getElementsByTagName('kmInicial')[0].textContent||"");
			var kmFinal			  		= (vehiculo.getElementsByTagName('kmFinal')[0].text||vehiculo.getElementsByTagName('kmFinal')[0].textContent||"");
			var codigoAnimal 			= (vehiculo.getElementsByTagName('codigoAnimal')[0].text||vehiculo.getElementsByTagName('codigoAnimal')[0].textContent||"");
			var nombreAnimal			= (vehiculo.getElementsByTagName('nombreAnimal')[0].text||vehiculo.getElementsByTagName('nombreAnimal')[0].textContent||"");
			var tipoAnimal	 			= (vehiculo.getElementsByTagName('tipoAnimal')[0].text||vehiculo.getElementsByTagName('tipoAnimal')[0].textContent||"");
			var descripcion		  	= tipoVehiculo + " (" + patenteVehiculo + ")";
			document.getElementById('vehiculosServicio').length = null;
			var datosOpcion = new Option(descripcion, codigoVehiculo, "", "");
			document.getElementById('vehiculosServicio').options[document.getElementById('vehiculosServicio').length] = datosOpcion;
			var descAnimal = tipoAnimal + " (" + nombreAnimal + ")";
			document.getElementById('animalServicio').length = null;
			var datosOpcion2 = new Option(descAnimal, codigoAnimal, "", "");
			document.getElementById('animalServicio').options[document.getElementById('animalServicio').length] = datosOpcion2;
			document.getElementById('textKmInicial').value	= kmInicial;
			document.getElementById('textKmFinal').value	= kmFinal;
			if (codigoFactor == "") codigoFactor = 0;
			document.getElementById('factorMV').value	= codigoFactor;
			funcionarios = mediosDeVigilancia.getElementsByTagName('medioVigilancia')[i];
			for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
				var codigoFuncionario	= (funcionarios.getElementsByTagName('codigoFuncionario')[j].text||funcionarios.getElementsByTagName('codigoFuncionario')[j].textContent||"");
				var apellidoPaterno 	= (funcionarios.getElementsByTagName('apellidoPaterno')[j].text||funcionarios.getElementsByTagName('apellidoPaterno')[j].textContent||"");
				var apellidoMaterno 	= (funcionarios.getElementsByTagName('apellidoMaterno')[j].text||funcionarios.getElementsByTagName('apellidoMaterno')[j].textContent||"");
				var primerNombre 			= (funcionarios.getElementsByTagName('primerNombre')[j].text||funcionarios.getElementsByTagName('primerNombre')[j].textContent||"");
				var grado 						= (funcionarios.getElementsByTagName('grado')[j].text||funcionarios.getElementsByTagName('grado')[j].textContent||"");
				var descripcionFuncionario = apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
				var datosOpcion = new Option(descripcionFuncionario, codigoFuncionario, "", "");
				document.getElementById('personalServicioMedio').options[document.getElementById('personalServicioMedio').length] = datosOpcion;
			}
			cuadrantes = mediosDeVigilancia.getElementsByTagName('cuadrantes')[i];
			for(var j=0; j<cuadrantes.getElementsByTagName('cuadrante').length; j++){
				var codigoCuadrante = (cuadrantes.getElementsByTagName('codigoCuadrante')[j].text||cuadrantes.getElementsByTagName('codigoCuadrante')[j].textContent||"");
				for(var k=0; k<document.getElementById('cuadrantesMV').length; k++){
					if(document.getElementById('cuadrantesMV').options[k].value == codigoCuadrante)	document.getElementById('cuadrantesMV').options[k].selected = true;
				}
			}
			agregaMedioVigilancia(1);
		}
	}
}

function llenaArregloFuncionariosAccesorios(mediosDeVigilancia){
	for(var i=0;i<mediosDeVigilancia.getElementsByTagName('funcionario').length;i++){
		var funcionario = mediosDeVigilancia.getElementsByTagName('funcionario')[i];
		var codigoFuncionario	= (funcionario.getElementsByTagName('codigoFuncionario')[0].text||funcionario.getElementsByTagName('codigoFuncionario')[0].textContent||"");
		var apellidoPaterno 	= (funcionario.getElementsByTagName('apellidoPaterno')[0].text||funcionario.getElementsByTagName('apellidoPaterno')[0].textContent||"");
		var apellidoMaterno 	= (funcionario.getElementsByTagName('apellidoMaterno')[0].text||funcionario.getElementsByTagName('apellidoMaterno')[0].textContent||"");
		var primerNombre 			= (funcionario.getElementsByTagName('primerNombre')[0].text||funcionario.getElementsByTagName('primerNombre')[0].textContent||"");
		var grado 						= (funcionario.getElementsByTagName('grado')[0].text||funcionario.getElementsByTagName('grado')[0].textContent||"");
		var descripcion				= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " (" + grado + ")";
		var datosOpcion = new Option(descripcion, codigoFuncionario, "", "");
		document.getElementById('personalServicio2').options[document.getElementById('personalServicio2').length] = datosOpcion;
		
		var accesorios = funcionario.getElementsByTagName('accesorios')[0];
		for (var k=0; k<accesorios.getElementsByTagName('accesorio').length; k++){
			var accesorio 			 			= accesorios.getElementsByTagName('accesorio')[k];
			var codigoAccesorio 	 		= "O"+(accesorio.getElementsByTagName('codigoAccesorio')[0].text||accesorio.getElementsByTagName('codigoAccesorio')[0].textContent||"");
			var descripcionAccesorio 	= (accesorio.getElementsByTagName('descripcionAccesorio')[0].text||accesorio.getElementsByTagName('descripcionAccesorio')[0].textContent||"");
			var datosOpcion = new Option(descripcionAccesorio, codigoAccesorio, "", "");
			document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;
		}
		
		var armas = funcionario.getElementsByTagName('armas')[0];
		for (var k=0; k<armas.getElementsByTagName('arma').length; k++){
			var arma						= armas.getElementsByTagName('arma')[k];
			var codigoArma 			= "P"+(arma.getElementsByTagName('codigoArma')[0].text||arma.getElementsByTagName('codigoArma')[0].textContent||"");
			var descripcionArma = (arma.getElementsByTagName('tipoArma')[0].text||arma.getElementsByTagName('tipoArma')[0].textContent||"");
			var numeroSerie 		= (arma.getElementsByTagName('numeroSerie')[0].text||arma.getElementsByTagName('numeroSerie')[0].textContent||"");
			descripcionArma += " (N./S. : " + numeroSerie + ")";
			var datosOpcion = new Option(descripcionArma, codigoArma, "", "");
			document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;
		}
		
		var animales = funcionario.getElementsByTagName('animales')[0];
		for (var k=0; k<animales.getElementsByTagName('animal').length; k++){
			var animal			  		= animales.getElementsByTagName('animal')[k];
			var codigoAnimal 	  	= "A"+(animal.getElementsByTagName('codigoAnimal')[0].text||animal.getElementsByTagName('codigoAnimal')[0].textContent||"");
			var descripcionAnimal = (animal.getElementsByTagName('descripcionAnimal')[0].text||animal.getElementsByTagName('descripcionAnimal')[0].textContent||"");
			var datosOpcion = new Option(descripcionAnimal, codigoAnimal, "", "");
			document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;
		}
		
		var camaras = funcionario.getElementsByTagName('camaras')[0];
		for (var k=0; k<camaras.getElementsByTagName('camara').length; k++){
			var camara			= camaras.getElementsByTagName('camara')[k];
			var codigoCamara	= "C"+(camara.getElementsByTagName('codigoCamara')[0].text||camara.getElementsByTagName('codigoCamara')[0].textContent||"");
			var modeloCamara	= (camara.getElementsByTagName('modeloCamara')[0].text||camara.getElementsByTagName('modeloCamara')[0].textContent||"");
			var numeroSerie		= (camara.getElementsByTagName('numeroSerieCamara')[0].text||camara.getElementsByTagName('numeroSerieCamara')[0].textContent||"");
			modeloCamara		+= " (N./S. : " + numeroSerie + ")";
			var datosOpcion = new Option(modeloCamara, codigoCamara, "", "");
			document.getElementById('personalServicioAccesorio').options[document.getElementById('personalServicioAccesorio').length] = datosOpcion;
		}

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
	encabezado += "<td id='nombreColumna' width='10%' align='center'>VEH\u00CDCULOS</td>";
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
	var fecha1 = document.getElementById("textBuscar").value;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	top.document.getElementById("tituloGrilla").innerHTML = "";
	document.getElementById("cabeceraGrilla").innerHTML = encabezadosPorServicio();
	document.getElementById("totalesGrilla").innerHTML  = totalesPorServicio();
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	document.getElementById("totalPersonal").innerHTML 	= "-";
	document.getElementById("totalVehiculos").innerHTML = "-";
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlControlServicios.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&codigoServicio="+servicio+"&tipoUnidad="+tipoUnidad+"&inicio="+inicio));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml 			 						= objHttpXMLServicios.responseXML.documentElement;
				var codigoUnidad					= "";
				var descripcionUnidad			= "";
				var codigoServicio	 			= "";
				var correlativo	 					= "";
				var descripcionServicio 	= "";
				var cantidadPersonal 			= "";
				var cantidadVehiculo 			= "";
				var sw 				 						= 0;
				var fondoLinea		 				= "";
				var resaltarLinea 	 			=	"";
				var lineaSinResaltar 			= "";
				var listadoServicios 			= "";
				var sumCantidadPersonal 	= 0;
				var sumCantidadVehiculos	= 0;
				
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('servicioIngresado').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigoUnidad	 				= (xml.getElementsByTagName('codUnidad')[i].text||xml.getElementsByTagName('codUnidad')[i].textContent||"");
					descripcionUnidad			= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
					codigoServicio	 			= (xml.getElementsByTagName('codServicio')[i].text||xml.getElementsByTagName('codServicio')[i].textContent||"");
					descripcionServicio		= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
					correlativo	 					= (xml.getElementsByTagName('correlativo')[i].text||xml.getElementsByTagName('correlativo')[i].textContent||"");
					cantidadPersonal			= (xml.getElementsByTagName('cantidadFuncionarios')[i].text||xml.getElementsByTagName('cantidadFuncionarios')[i].textContent||"");
					cantidadVehiculo			= (xml.getElementsByTagName('cantidadVehiculos')[i].text||xml.getElementsByTagName('cantidadVehiculos')[i].textContent||"");
					sumCantidadPersonal 	+= cantidadPersonal*1;
					sumCantidadVehiculos 	+= cantidadVehiculo*1;
					resaltarLinea 	 			= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 			= "cambiarClase(this, '"+fondoLinea+"')";
					
					if (tipoUnidad == "nacional") var unidadHijo = "zona";
					if (tipoUnidad == "zona") var unidadHijo = "prefectura";
					if (tipoUnidad == "prefectura") var unidadHijo = "comisaria";
					if (tipoUnidad == "comisaria") var unidadHijo = "destacamento";
					
					inicio = 1;
					if (correlativo == "") var dblClick = "leeServiciosAgregados('"+codigoUnidad+"','"+unidadHijo+"','"+fecha1+"','"+codigoServicio+"','"+inicio+"','0')";
					if (correlativo != "") var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					
					if (descripcionUnidad == "") descripcionUnidad = "NIVEL NACIONAL";
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
					listadoServicios += "<td width='45%'><div id='valorColumna'>"+descripcionServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadPersonal,0,',','.')+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadVehiculo,0,',','.')+"</div></td>";
					listadoServicios += "</tr>";
				}
				listadoServicios += "</table>";
				
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
			}
		}
	}
}

function leeServiciosAgregados2(unidad, tipoUnidad, tipoUnidadPadre, fecha1, servicio, inicio, subir){
	if (fecha1 == "") fecha1 = document.getElementById("textBuscar").value;
	else document.getElementById("textBuscar").value = fecha1;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	document.getElementById("cabeceraGrilla").innerHTML = encabezadosPorServicio();
	document.getElementById("totalesGrilla").innerHTML  = totalesPorServicio();
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Servicios ......</td>";
	document.getElementById("totalPersonal").innerHTML 	= "-";
	document.getElementById("totalVehiculos").innerHTML = "-";
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlControlServicios2.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&codigoServicio="+servicio+"&tipoUnidad="+tipoUnidad+"&tipoUnidadPadre="+tipoUnidadPadre+"&inicio="+inicio));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml 			 		= objHttpXMLServicios.responseXML.documentElement;
				var codigoUnidad			= "";
				var descripcionUnidad		= "";
				var codigoServicio	 		= "";
				var correlativo	 			= "";
				var descripcionServicio 	= "";
				var cantidadPersonal 		= "";
				var cantidadVehiculo 		= "";
				var sw 				 		= 0;
				var fondoLinea		 		= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoServicios 		= "";
				var sumCantidadPersonal 	= 0;
				var sumCantidadVehiculos	= 0;
				
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('servicioIngresado').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigoUnidad	 			= (xml.getElementsByTagName('codUnidad')[i].text||xml.getElementsByTagName('codUnidad')[i].textContent||"");
					descripcionUnidad		= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
					codigoServicio	 		= (xml.getElementsByTagName('codServicio')[i].text||xml.getElementsByTagName('codServicio')[i].textContent||"");
					descripcionServicio	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
					correlativo	 				= (xml.getElementsByTagName('correlativo')[i].text||xml.getElementsByTagName('correlativo')[i].textContent||"");
					cantidadPersonal		= (xml.getElementsByTagName('cantidadFuncionarios')[i].text||xml.getElementsByTagName('cantidadFuncionarios')[i].textContent||"");
					cantidadVehiculo		= (xml.getElementsByTagName('cantidadVehiculos')[i].text||xml.getElementsByTagName('cantidadVehiculos')[i].textContent||"");
					
					sumCantidadPersonal += cantidadPersonal*1;
					sumCantidadVehiculos += cantidadVehiculo*1;
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					if (tipoUnidad == "nacional") var unidadHijo = "superZona";
					if (tipoUnidad == "superZona") var unidadHijo = "zona";
					if (tipoUnidad == "zona") var unidadHijo = "prefectura";
					if (tipoUnidad == "prefectura") var unidadHijo = "comisaria";
					if (tipoUnidad == "comisaria") var unidadHijo = "destacamento";
					inicio = 1;
					if (correlativo == "") var dblClick = "leeServiciosAgregados2('"+codigoUnidad+"','"+unidadHijo+"','"+tipoUnidad+"','"+fecha1+"','"+codigoServicio+"','"+inicio+"','0')";
					if (correlativo != "") var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					if (descripcionUnidad == "") descripcionUnidad = "NIVEL NACIONAL";
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
					listadoServicios += "<td width='45%'><div id='valorColumna'>"+descripcionServicio.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadPersonal,0,',','.')+"</div></td>";
					listadoServicios += "<td width='10%' align='right' style='padding:0px 7px 0px 0px;'><div id='valorColumna'>"+formato_numero(cantidadVehiculo,0,',','.')+"</div></td>";
					listadoServicios += "</tr>";
				}
				listadoServicios += "</table>";
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

function buscaServiciosPorFuncionario(unidadServicio, fecha1, fecha2, tipoServicio){
	var objHttpXMLServiciosPorFuncionario = new AJAXCrearObjeto();
  objHttpXMLServiciosPorFuncionario.open("POST","./xml/xmlServicios/xmlServiciosPorFuncionario.php",false);
	objHttpXMLServiciosPorFuncionario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServiciosPorFuncionario.send(encodeURI("unidadServicio="+unidadServicio+"&fecha1="+fecha1+"&fecha2="+fecha2+"&tipoServicio="+tipoServicio));
	//alert(objHttpXMLServiciosPorFuncionario.responseText);
	if (objHttpXMLServiciosPorFuncionario.responseText != "VACIO"){
		var xml = objHttpXMLServiciosPorFuncionario.responseXML.documentElement;
		return xml;
	}
	else return "VACIO";
}

function buscaServiciosJefaturaSupervisionTerrenoPorFuncionario(unidadServicio, fecha1, fecha2, tipoServicio){
	var objHttpXMLServiciosPorFuncionario = new AJAXCrearObjeto();
  objHttpXMLServiciosPorFuncionario.open("POST","./xml/xmlServicios/xmlCantidadServicioJefaturaSupervicionPorFuncionario.php",false);
	objHttpXMLServiciosPorFuncionario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServiciosPorFuncionario.send(encodeURI("unidadServicio="+unidadServicio+"&fecha1="+fecha1+"&fecha2="+fecha2+"&tipoServicio="+tipoServicio));
	//alert(objHttpXMLServiciosPorFuncionario.responseText);
	var xml = objHttpXMLServiciosPorFuncionario.responseXML.documentElement;
	return xml.getElementsByTagName('funcionarios')[0];
}

function corrigeLicencias(unidad,FechaCierre){
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlLicenciaMedica/xmlCorrigeLicencias.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&FechaCierre="+FechaCierre));
	objHttpXMLServicios.onreadystatechange=function(){
		//alert(objHttpXMLServicios.readyState);
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				//alert(objHttpXMLServicios.responseText);
				var xml = objHttpXMLServicios.responseXML.documentElement;
			}
		}
	}
}