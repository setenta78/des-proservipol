function leeDatosServicios(codigoPerfil,codigoUsuario,unidadUsuario,unidad,fecha, descripcionUnidad){
	leeEstadoServicios(codigoPerfil,codigoUsuario,unidadUsuario,unidad,fecha, descripcionUnidad)
	leeResumenServicios(unidad,fecha)
	leeServicios(unidad,fecha,"","")
}

function leeEstadoServicios(codigoPerfil,codigoUsuario,unidadUsuario,unidad,fecha, descripcionUnidad){
	var codPadre=document.getElementById("codPadre").value;
	var tipoUnidad=document.getElementById("tipoUnidad").value;
	var tipoUnidadPadre=document.getElementById("tipoUnidadPadre").value;
	var objHttpXMLValidacionServicios = new AJAXCrearObjeto();
	objHttpXMLValidacionServicios.open("POST","./xml/xmlValidacionServicios.php",true);
	objHttpXMLValidacionServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLValidacionServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha="+fecha));
	objHttpXMLValidacionServicios.onreadystatechange=function(){
		if(objHttpXMLValidacionServicios.readyState == 4)	{
			infoValidacion = descripcionUnidad+" - <b>"+fecha+"</b> ";
			//alert(objHttpXMLValidacionServicios.responseText);
			if (objHttpXMLValidacionServicios.responseText != "VACIO"){
				var xml = objHttpXMLValidacionServicios.responseXML.documentElement;
				grado           = (xml.getElementsByTagName('grado')[0].text||xml.getElementsByTagName('grado')[0].textContent||"");
				nombre          = (xml.getElementsByTagName('nombre')[0].text||xml.getElementsByTagName('nombre')[0].textContent||"");
				apellidoPaterno = (xml.getElementsByTagName('apellidoPaterno')[0].text||xml.getElementsByTagName('apellidoPaterno')[0].textContent||"");
				apellidoMaterno = (xml.getElementsByTagName('apellidoMaterno')[0].text||xml.getElementsByTagName('apellidoMaterno')[0].textContent||"");
				
				infoValidacion += "VALIDADOS POR "+grado+" "+nombre+" "+apellidoPaterno+" "+apellidoMaterno;
				if((codigoPerfil==70 || codigoPerfil==80 || codigoPerfil==100) && unidadUsuario==codPadre){
					document.getElementById("btnDesValidar").disabled = false;
				}
			}
			else{
				infoValidacion += "SERVICIOS SIN VALIDAR";
				 if((codigoPerfil == 70 || codigoPerfil == 80 || codigoPerfil==100) && unidadUsuario==codPadre ){
				  document.getElementById("btnValidar").disabled = false;
				}else if(codigoPerfil==70){
					buscaDatosFuncionario(codigoUsuario,unidad);
				}
			}
			document.getElementById("datosValidacion").innerHTML = infoValidacion;
		}
	}
}

function buscaDatosFuncionario(codigoUsuario,unidadUsuario){
	var objHttpXMLDatosFuncionario = new AJAXCrearObjeto();
	objHttpXMLDatosFuncionario.open("POST","../xml/xmlFuncionarios/xmlDatosFuncionario.php",true);
	objHttpXMLDatosFuncionario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLDatosFuncionario.send(encodeURI("codigoFuncionario="+codigoUsuario));
	objHttpXMLDatosFuncionario.onreadystatechange=function(){
		if(objHttpXMLDatosFuncionario.readyState == 4){
			if (objHttpXMLDatosFuncionario.responseText != "VACIO"){
				var xml = objHttpXMLDatosFuncionario.responseXML.documentElement;
				var unidadFuncionario	= (xml.getElementsByTagName('codigoUnidad')[0].text||xml.getElementsByTagName('codigoUnidad')[0].textContent||"");
				var cargoFuncionario  = (xml.getElementsByTagName('codigoCargo')[0].text||xml.getElementsByTagName('codigoCargo')[0].textContent||"");
				var unidadAgregadoFuncionario = xml.getElementsByTagName('codigoUnidadAgregado')[0].text;
				if (cargoFuncionario != 3000) var unidadValidar = unidadFuncionario
				else var unidadValidar = unidadAgregadoFuncionario
				
				if(unidadUsuario == unidadValidar){
					document.getElementById("btnValidar").disabled = false;
					document.getElementById("btnDesValidar").disabled = false;
				}
			}
			else{
				alert("PROBLEMAS CON EL CODIGO DE USUARIO.");
			}
		}
	}
}

function leeResumenServicios(unidad,fecha){
	var objHttpXMLResumenServicios = new AJAXCrearObjeto();
	objHttpXMLResumenServicios.open("POST","./baseDatos/dbResumenServicios.php",true);
	objHttpXMLResumenServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLResumenServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha="+fecha));
	objHttpXMLResumenServicios.onreadystatechange=function(){
		//alert(objHttpXMLResumenServicios.readyState);
		if(objHttpXMLResumenServicios.readyState == 4){
			//alert(objHttpXMLResumenServicios.responseText);
      if (objHttpXMLResumenServicios.responseText != "VACIO"){
      	document.getElementById("layerResumenServicio").innerHTML=objHttpXMLResumenServicios.responseText;
			}
		}
	}
}

function leeServicios(unidad,fecha1,fecha2,servicios){
	if (fecha2 == "") fecha2 = fecha1;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","../xml/xmlServicios/xmlListaServiciosCantidades.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha1="+fecha1+"&fecha2="+fecha2+"&servicios="+servicios));
	objHttpXMLServicios.onreadystatechange=function(){
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				var xml 			 						= objHttpXMLServicios.responseXML.documentElement;
				var correlativo						= "";
				var fecha	 		 						= "";
				var tipoServicio	 				= "";
				var tipoExtraordinario		= "";
				var horaInicio		 				= "";
				var horaTermino		 				= "";
				var descServicio					= "";
				var claseServicio					= "";
				var cantidadFuncionarios	= "";
				var cantidadVehiculos     = "";
		    var listadoCargaDatos 		= "";
		    var sw 				 						= 0;
		    var fondoLinea		 				= "";
		    var resaltarLinea 	 			= "";
		    var lineaSinResaltar 			= "";
        listadoCargaDatos 				= "";
        sw 				 								= 0;
        fondoLinea		 						= "";
        resaltarLinea 	 					= "";
        lineaSinResaltar 					= "";
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
          if (sw==0) {fondoLinea = "linea1";sw =1}
          else {fondoLinea = "linea2";sw=0}
					
          resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
          lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
          
					correlativo	 					= (xml.getElementsByTagName('correlativoServicio')[i].text||xml.getElementsByTagName('correlativoServicio')[i].textContent||"");
					tipoServicio	 				= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
					tipoExtraordinario		= (xml.getElementsByTagName('desServicioExtraordinario')[i].text||xml.getElementsByTagName('desServicioExtraordinario')[i].textContent||"");
					horaInicio		 				= (xml.getElementsByTagName('horaInicio')[i].text||xml.getElementsByTagName('horaInicio')[i].textContent||"");
					horaTermino		 				= (xml.getElementsByTagName('horaTermino')[i].text||xml.getElementsByTagName('horaTermino')[i].textContent||"");
					claseServicio					= (xml.getElementsByTagName('claseServicio')[i].text||xml.getElementsByTagName('claseServicio')[i].textContent||"");
					cantidadFuncionarios	= (xml.getElementsByTagName('cantidadFuncionarios')[i].text||xml.getElementsByTagName('cantidadFuncionarios')[i].textContent||"");
					cantidadVehiculos			= (xml.getElementsByTagName('cantidadVehiculos')[i].text||xml.getElementsByTagName('cantidadVehiculos')[i].textContent||"");
					fecha									= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
					
					if (tipoExtraordinario != "") tipoServicio += " ("+tipoExtraordinario+")";
					if (claseServicio == "N") var horario = "-------";
					else var horario = horaInicio+" - "+horaTermino;
					
          listadoCargaDatos += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:leeDatosServicioCertificado('"+unidad+"','"+correlativo+"')\">";
          listadoCargaDatos += "<td width='5%'  align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
          listadoCargaDatos += "<td width='60%'  align='left'><div id='valorColumna'>&nbsp;&nbsp;"+tipoServicio.toUpperCase()+"</div></td>";
          listadoCargaDatos += "<td width='15%'  align='center'><div id='valorColumna'>("+horario+")</div></td>";
          listadoCargaDatos += "<td width='10%' align='center'><div id='valorColumna'>"+cantidadFuncionarios+"</div></td>";
          listadoCargaDatos += "<td width='10%' align='center'><div id='valorColumna'>"+cantidadVehiculos+"</div></td>";
          listadoCargaDatos += "</tr>";
				}
				ExcesoColacion(unidad,fecha);
				if(unidad!=11910) ExcesoHorasServicio(unidad,fecha);
				DeficitHorasServicio(unidad,fecha);
				document.getElementById("listadoServicios").innerHTML= "<table width='100%' cellspacing='1' cellpadding='1'>"+listadoCargaDatos+"</table>";
			} 
			else {
				alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.");
				top.cerrarVentana();
			}
		}
	}
}

function leeDatosServicioCertificado(unidad,correlativo){
  cambiaLayer("layerDetalleServicio");
	document.getElementById("identificacionServicio").innerHTML="<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Cargando ......</td></tr></table>";
	document.getElementById("mediosDeVigilancia").innerHTML="";
	document.getElementById("observaciones").innerHTML="";
	var paginaImprimirActual = "../imprimible/servicios/servicioUnidad.php?codigoUnidad="+unidad+"&correlativo="+correlativo;
	var botonImprimirServicioActual = "<input type=\"button\" id=\"btnImprimir\" name=\"btnImprimir\" value=\"CREAR PDF SERVICIO ACTUAL\" class=\"Boton_100\" onclick=\"window.open('"+paginaImprimirActual+"')\">";
	document.getElementById("imprimirServicioActual").innerHTML = botonImprimirServicioActual;
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","../xml/xmlServicios/xmlDatosServicio.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&correlativo="+correlativo));
	objHttpXMLServicios.onreadystatechange=function(){
		if(objHttpXMLServicios.readyState == 4){
			if (objHttpXMLServicios.responseText != "VACIO"){
			//alert(objHttpXMLServicios.responseText);
				
				var xml = objHttpXMLServicios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('servicio').length;i++){
				var identificacionServicio = xml.getElementsByTagName('identificacionServicio')[i];
				var mediosDeVigilancia 	   = xml.getElementsByTagName('mediosDeVigilancia')[i];
         
          leeIdentificacionServicio(identificacionServicio); 
          vistaMediosDeVigilancia(mediosDeVigilancia);   
                
				}
			}
		}
	}
}

function leeIdentificacionServicio(identificacionServicio){
	var codigoServicio 			= (identificacionServicio.getElementsByTagName('codServicio')[0].text||identificacionServicio.getElementsByTagName('codServicio')[0].textContent||"");
	var tipoServicio 				= (identificacionServicio.getElementsByTagName('tipoServicio')[0].text||identificacionServicio.getElementsByTagName('tipoServicio')[0].textContent||"");
	var descripcionServicio	= (identificacionServicio.getElementsByTagName('desServicio')[0].text||identificacionServicio.getElementsByTagName('desServicio')[0].textContent||"");
	var codExtraordinario		= (identificacionServicio.getElementsByTagName('codServicioExtraordinario')[0].text||identificacionServicio.getElementsByTagName('codServicioExtraordinario')[0].textContent||"");
	var extraordinario			= (identificacionServicio.getElementsByTagName('desServicioExtraordinario')[0].text||identificacionServicio.getElementsByTagName('desServicioExtraordinario')[0].textContent||"");
	var otroExtraordinario	= (identificacionServicio.getElementsByTagName('desOtroServicioExtraordinario')[0].text||identificacionServicio.getElementsByTagName('desOtroServicioExtraordinario')[0].textContent||"");
	var descripcionServicio	= (identificacionServicio.getElementsByTagName('desServicio')[0].text||identificacionServicio.getElementsByTagName('desServicio')[0].textContent||"");
	var descripcionUnidad		= (identificacionServicio.getElementsByTagName('desUnidad')[0].text||identificacionServicio.getElementsByTagName('desUnidad')[0].textContent||"");
	var fechaCompleta 			= (identificacionServicio.getElementsByTagName('fechaCompleta')[0].text||identificacionServicio.getElementsByTagName('fechaCompleta')[0].textContent||"");
	var fecha 							= (identificacionServicio.getElementsByTagName('fecha')[0].text||identificacionServicio.getElementsByTagName('fecha')[0].textContent||"");
	var horaInicio 					= (identificacionServicio.getElementsByTagName('horaInicio')[0].text||identificacionServicio.getElementsByTagName('horaInicio')[0].textContent||"");
	var horaTermino 				= (identificacionServicio.getElementsByTagName('horaTermino')[0].text||identificacionServicio.getElementsByTagName('horaTermino')[0].textContent||"");
	var observaciones 			= (identificacionServicio.getElementsByTagName('observaciones')[0].text||identificacionServicio.getElementsByTagName('observaciones')[0].textContent||"");
	var vistaServicio = "";
	vistaServicio += "<table width='100%' cellspacing='1' cellpadding='1'>";
	vistaServicio += "<tr><td class='textoNegrilla' width='100%'  align='left' colspan='2'>Identificación del Servicio</td></tr>";
	vistaServicio += "<tr><td bgcolor='#000000'></td></tr><tr><td height='3'></td></tr></table>";
	vistaServicio += "<div style='width:100%'>";
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
	vistaServicio += "</div>";
	document.getElementById("identificacionServicio").innerHTML 	= vistaServicio;
  var vistaObservaciones = "";
  
  if(observaciones!=""){
    vistaObservaciones += "<table width='100%' cellspacing='1' cellpadding='1'>";
    vistaObservaciones += "<tr><td class='textoNegrilla' width='100%'  align='left' colspan='2'>Observaciones</td></tr>";
    vistaObservaciones += "<tr><td bgcolor='#000000'></td></tr><tr><td height='3'></td></tr></table>";
    vistaObservaciones += "<table width='100%' cellspacing='1' cellpadding='1'>";
    vistaObservaciones += "<tr><td class='dato' width='100%'  align='left' colspan='2'>"+observaciones+"</td></tr></table>";
  }
  
  document.getElementById("observaciones").innerHTML=vistaObservaciones;
	document.getElementById("tipoServicio").value = tipoServicio;
}

function vistaMediosDeVigilancia(mediosDeVigilancia){
	var vistaMedios = "<div style='width:100%'><br>";
	
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
		
		var vehiculo 						= mediosDeVigilancia.getElementsByTagName('vehiculo')[i];
		var factor 							= (mediosDeVigilancia.getElementsByTagName('descripcionFactor')[i].text||mediosDeVigilancia.getElementsByTagName('descripcionFactor')[i].textContent||"");
		var codigoVehiculo 			= (vehiculo.getElementsByTagName('codigoVehiculo')[0].text||vehiculo.getElementsByTagName('codigoVehiculo')[0].textContent||"");
		var patenteVehiculo			= (vehiculo.getElementsByTagName('patenteVehiculo')[0].text||vehiculo.getElementsByTagName('patenteVehiculo')[0].textContent||"");
		var tipoVehiculo				= (vehiculo.getElementsByTagName('tipoVehiculo')[0].text||vehiculo.getElementsByTagName('tipoVehiculo')[0].textContent||"");
		var kmInicial						= (vehiculo.getElementsByTagName('kmInicial')[0].text||vehiculo.getElementsByTagName('kmInicial')[0].textContent||"");
		var kmFinal							= (vehiculo.getElementsByTagName('kmFinal')[0].text||vehiculo.getElementsByTagName('kmFinal')[0].textContent||"");
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
		}
		
		var contFuncionarios = 0;
		var funcionarios = mediosDeVigilancia.getElementsByTagName('funcionarios')[i];
		for(var j=0;j<funcionarios.getElementsByTagName('funcionario').length;j++){
			var codigoFuncionario = (funcionarios.getElementsByTagName('codigoFuncionario')[j].text||funcionarios.getElementsByTagName('codigoFuncionario')[j].textContent||"");
			var apellidoPaterno 	= (funcionarios.getElementsByTagName('apellidoPaterno')[j].text||funcionarios.getElementsByTagName('apellidoPaterno')[j].textContent||"");
			var apellidoMaterno 	= (funcionarios.getElementsByTagName('apellidoMaterno')[j].text||funcionarios.getElementsByTagName('apellidoMaterno')[j].textContent||"");
			var primerNombre 			= (funcionarios.getElementsByTagName('primerNombre')[j].text||funcionarios.getElementsByTagName('primerNombre')[j].textContent||"");
			var grado 						= (funcionarios.getElementsByTagName('grado')[j].text||funcionarios.getElementsByTagName('grado')[j].textContent||"");
			var descripcion				= apellidoPaterno + " " + apellidoMaterno + ", " + primerNombre + " - " + grado + " (" + codigoFuncionario +")";
			var armas 						= funcionarios.getElementsByTagName('armas')[j];
			
			if (armas.getElementsByTagName('arma').length > 0 ){
				for(var k=0;k<armas.getElementsByTagName('arma').length;k++){
					var etiqueta = "";
					var tipoArma = (armas.getElementsByTagName('tipoArma')[k].text||armas.getElementsByTagName('tipoArma')[k].textContent||"");
					var codArma	 = (armas.getElementsByTagName('numeroSerie')[k].text||armas.getElementsByTagName('numeroSerie')[k].textContent||"");
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
			} 
			else {
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
	vistaMedios += "</div>";
  document.getElementById("mediosDeVigilancia").innerHTML 	= vistaMedios;
  
}

function validaServicios(unidad,fecha,usuario){
	var sinServicios = document.getElementById("totalSinServicio").value;
	var asignacionesNoValidas = document.getElementById("totalAusenciasNoValidas").value;
	var funcionariosConProblemas = document.getElementById("funcionariosConProblemas").value;
	var colacionesNoValidas = document.getElementById("colacionesNoValidas").value;
	var existeSoloAgregado = document.getElementById("existeSoloAgregado").value;
	
	if (sinServicios > 0){
		alert("UD NO PUEDE VALIDAR PORQUE AUN EXISTEN FUNCIONARIOS SIN SERVICIOS ASIGNADOS ..... ");
		return false;
	}
	
	if (asignacionesNoValidas > 0){
		alert("UD NO PUEDE VALIDAR PORQUE EN EL RUBRO \"PERSONAL CON MAS DE UNA ASIGNACION\" EXISTEN ASIGNACIONES NO VALIDAS ..... \n\n"+funcionariosConProblemas);
		return false;
	}
	
	if (colacionesNoValidas > 0){
		alert("UD NO PUEDE VALIDAR PORQUE EN EL RUBRO \"PERSONAL CON MAS DE UNA ASIGNACION\" EXISTEN COLACION A FUNCIONARIOS CON MAS DE UNA ASIGNACION ..... \n\n");
		return false;
	}
	
	if (existeSoloAgregado > 0){
		alert("UD NO PUEDE VALIDAR PORQUE TIENE PERSONAL AL CUAL NO LE HA ACTUALIZADO EL CARGO AGREGADO SEGUN ULTIMAS INSTRUCCIONES ..... \n\n");
		return false;
	}
	
	if(confirm("SE VALIDARAN LOS SERVICIOS DE LA FECHA INDICADA.  POSTERIORMENTE NO PODRA REALIZAR MODIFICACIONES.  ¿DESEA CONTINUAR?")){
		document.getElementById("btnValidar").disabled = true;
		document.getElementById("btnImprimir").disabled = true;
		document.getElementById("btnCerrar").disabled = true;
		document.getElementById("layerResumenServicio").innerHTML="<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Guardando ...</td></tr></table>";
		document.getElementById("layerListadoServicio").innerHTML="<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Guardando ...</td></tr></table>";
		document.getElementById("layerDetalleServicio").innerHTML="<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Guardando ...</td></tr></table>";
		var objHttpXMLCargaDatos = new AJAXCrearObjeto();
		objHttpXMLCargaDatos.open("POST","./xml/xmlValidaServicios.php",true);
		objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLCargaDatos.send("unidad="+unidad+"&fecha="+fecha+"&codFuncionario="+usuario);
		objHttpXMLCargaDatos.onreadystatechange=function(){
			if(objHttpXMLCargaDatos.readyState == 4){
				//alert(objHttpXMLCargaDatos.responseText);
				var xml = objHttpXMLCargaDatos.responseXML.documentElement;
				var codigo = (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
				(codigo) ? alert("LOS SERVICIOS HAN SIDO VALIDADOS CON EXITO.") : alert("OCURRIO UN PROBLEMA AL VALIDAR LOS SERVICIOS.");
				top.iniciaCargaDatos(fecha.substring(3,5),fecha.substring(6,10),unidad);
				top.cerrarVentana();
			}
		}
	}
}

function desvalidaServicios(unidad, fecha){
	var codFuncionario = document.getElementById("codFuncionario").value;
	var ip = document.getElementById("ip").value;
	if(confirm("SE DESVALIDARÁN LOS SERVICIOS DE LA FECHA INDICADA.  ¿DESEA CONTINUAR?")){
		document.getElementById("btnValidar").disabled = true;
		document.getElementById("btnImprimir").disabled = true;
		document.getElementById("btnCerrar").disabled = true;
		document.getElementById("btnDesValidar").disabled = true;
		document.getElementById("layerResumenServicio").innerHTML="<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Guardando ...</td></tr></table>";
		document.getElementById("layerListadoServicio").innerHTML="<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Guardando ...</td></tr></table>";
		document.getElementById("layerDetalleServicio").innerHTML="<table><tr><td><img src='../img/ajax_loader.gif'></td><td>&nbsp;Guardando ...</td></tr></table>";
		var objHttpXMLCargaDatos = new AJAXCrearObjeto();
		objHttpXMLCargaDatos.open("POST","./xml/xmlDesvalidaServicios.php",true);
		objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLCargaDatos.send("unidad="+unidad+"&fecha="+fecha+"&codFuncionario="+codFuncionario+"&ip="+ip);
		objHttpXMLCargaDatos.onreadystatechange=function(){
			if(objHttpXMLCargaDatos.readyState == 4){
				//alert(objHttpXMLCargaDatos.responseText);
				var xml = objHttpXMLCargaDatos.responseXML.documentElement;
				var codigo = (xml.getElementsByTagName('resultado')[0].text||xml.getElementsByTagName('resultado')[0].textContent||"");
				(codigo) ? alert("LOS SERVICIOS HAN SIDO DESVALIDADO CON EXITO.") : alert("OCURRIO UN PROBLEMAS AL DESVALIDAR LOS SERVICIOS.");
				top.iniciaCargaDatos(fecha.substring(3,5),fecha.substring(6,10),unidad);
				top.cerrarVentana();
			}
		}
	}
}

function cambiarClase(objeto, clase){
	objeto.className = clase;
}

function cambiaLayer(nombreLayer){
	document.getElementById("listado2").scrollTop=0;
	document.getElementById("layerResumenServicio").style.visibility = "hidden";
	document.getElementById("layerListadoServicio").style.visibility = "hidden";
	document.getElementById("layerDetalleServicio").style.visibility = "hidden";
	document.getElementById("identificacionServicio").innerHTML="";
	document.getElementById("mediosDeVigilancia").innerHTML="";
	document.getElementById("observaciones").innerHTML=""; 
	document.getElementById(nombreLayer).style.visibility = "visible";
	if (nombreLayer == "layerListadoServicio") document.getElementById("imprimirServicioActual").innerHTML="";
}

function noValidar(){
	alert("USTED NO PUEDE VALIDAR LOS SERVICIOS FUERA DE PLAZO ...");
	top.cerrarVentana();
}

function noDesvalidar(){
	alert("USTED NO PUEDE DESVALIDAR EL SERVICIO ...");
	top.cerrarVentana();
}

function ExcesoColacion(unidad,fecha){
	var funcionarios = "";
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","../xml/xmlServicios/xmlDatosColacion.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha="+fecha));
	objHttpXMLServicios.onreadystatechange=function(){
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				var xml = objHttpXMLServicios.responseXML.documentElement;
				var cantidad = 0;
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					var codFuncionario = (xml.getElementsByTagName('codigoFuncionario')[i].text||xml.getElementsByTagName('codigoFuncionario')[i].textContent||"")
					var NomFuncionario = (xml.getElementsByTagName('nombreFuncionario')[i].text||xml.getElementsByTagName('nombreFuncionario')[i].textContent||"");
					funcionarios += codFuncionario+" / "+NomFuncionario+"\n";
					cantidad++;
				}
				if(cantidad > 0){
					alert("LOS SIGUIENTES FUNCIONARIOS PRESENTAN EXCESO DE HORAS DE COLACION EN RELACIÓN CON LOS SERVICIOS REALIZADOS ESTE DÍA: \n\n"+funcionarios);
					top.cerrarVentana();
				}
			}
		}
	}
}

function ExcesoHorasServicio(unidad,fecha){
	var funcionarios = "";
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","../xml/xmlServicios/xmlDatosExcesoServicios.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha="+fecha));
	objHttpXMLServicios.onreadystatechange=function(){
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				var xml = objHttpXMLServicios.responseXML.documentElement;
				var cantidad = 0;
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					var codFuncionario = (xml.getElementsByTagName('codigoFuncionario')[i].text||xml.getElementsByTagName('codigoFuncionario')[i].textContent||"");
					var NomFuncionario = (xml.getElementsByTagName('nombreFuncionario')[i].text||xml.getElementsByTagName('nombreFuncionario')[i].textContent||"");
					funcionarios += codFuncionario+" / "+NomFuncionario+"\n";
					cantidad++;
				}
				if(cantidad > 0){
					alert("LOS SIGUIENTES FUNCIONARIOS PRESENTAN EXCESO DE HORAS DE SERVICIOS (+24 HRS) REALIZADOS ESTE DÍA: \n\n"+funcionarios);
					top.cerrarVentana();
				}
			}
		}
	}
}

function DeficitHorasServicio(unidad,fecha){
	var funcionarios = "";
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","../xml/xmlServicios/xmlDatosDeficitServicios.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("codigoUnidad="+unidad+"&fecha="+fecha));
	objHttpXMLServicios.onreadystatechange=function(){
		if(objHttpXMLServicios.readyState == 4){
			//alert(objHttpXMLServicios.responseText);
			if (objHttpXMLServicios.responseText != "VACIO"){
				var xml = objHttpXMLServicios.responseXML.documentElement;
				var cantidad = 0;
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					var codFuncionario = (xml.getElementsByTagName('codigoFuncionario')[i].text||xml.getElementsByTagName('codigoFuncionario')[i].textContent||"");
					var NomFuncionario = (xml.getElementsByTagName('nombreFuncionario')[i].text||xml.getElementsByTagName('nombreFuncionario')[i].textContent||"");
					funcionarios += codFuncionario+" / "+NomFuncionario+"\n";
					cantidad++;
				}
				if(cantidad > 0){
					alert("LOS SIGUIENTES FUNCIONARIOS PRESENTAN UN DEFICIT DE HORAS DE SERVICIOS (-4 HRS) REALIZADOS ESTE DÍA: \n\n"+funcionarios);
					top.cerrarVentana();
				}
			}
		}
	}
}
