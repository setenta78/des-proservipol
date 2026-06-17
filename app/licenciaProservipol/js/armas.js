var cargaListadoArmas;
var idCargaListadoArmas;

function leeArmas(unidad){
	//alert();
	cargaListadoArmas = 0;
	var armaBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var contieneHijos = document.getElementById("contieneHijos").value; //Variable agregada el 05-05-2015

	var objHttpXMLArmas = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoArmas");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Armas ......</td>";
    
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlListaArmas.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("codigoUnidad="+unidad+"&armaBuscar="+armaBuscar)); 
	
	objHttpXMLArmas.onreadystatechange=function()
	{
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4)
		{       
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);		
				var xml 				= objHttpXMLArmas.responseXML.documentElement;
				var codigo				= "";
				var tipo				= "";
				var marca 				= "";
				var modelo 				= "";
				var nroSerie			= "";
				var estado				= "";
   	            var seccion				= ""; //Variable agregada el 05-05-2015
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoArmas		= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";				
				
				
				listadoArmas = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					tipo	 		 = xml.getElementsByTagName('tipo')[i].text;
					marca	 	 	 = xml.getElementsByTagName('marca')[i].text;
					modelo	 		 = xml.getElementsByTagName('modelo')[i].text;
					nroSerie 		 = xml.getElementsByTagName('numeroSerie')[i].text;
					estado	 		 = xml.getElementsByTagName('estado')[i].text;
					codUnidadAgregado = xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado = xml.getElementsByTagName('desUnidadAgregado')[i].text;
                    seccion	 		 = xml.getElementsByTagName('seccion')[i].text; //Variable agregada el 05-05-2015
                    
                    //Control agregado el 28-04-2015
                    if(contieneHijos == 1){
                        var alto=280;
                    }else{
                       var alto=290; 
                    }
										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ARMA ...', '800','"+alto+"','fichaArma.php?codigoArma="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
                    //Condicion agregada el 05-05-2105
		            if(contieneHijos == 1){
				   	listadoArmas += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoArmas += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoArmas += "<td width='23%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
					listadoArmas += "<td width='30%' align='left'><div id='valorColumna'>"+marca+" "+modelo+"</div></td>";
					listadoArmas += "<td width='15%' align='center'><div id='valorColumna'>"+nroSerie+"</div></td>";
					//listadoArmas += "<td width='15%' align='left'><div id='valorColumna'></div></td>";
					listadoArmas+= "<td width='15%' align='left'><div id='valorColumna'>"+seccion+"</div></td>"; //añadido
					listadoArmas+= "<td width='19%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoArmas += "</tr>";
				   }else{
					listadoArmas += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoArmas += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoArmas += "<td width='23%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
					listadoArmas += "<td width='38%' align='left'><div id='valorColumna'>"+marca+" "+modelo+"</div></td>";
					listadoArmas += "<td width='15%' align='center'><div id='valorColumna'>"+nroSerie+"</div></td>";
					//listadoArmas += "<td width='15%' align='left'><div id='valorColumna'></div></td>";
					listadoArmas+= "<td width='19%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoArmas += "</tr>";
				}
           }
				listadoArmas += "</table>";
				//alert(listadoArmas);
				div.innerHTML = listadoArmas;
				cargaListadoArmas = 1;
			}
		}
	}
}

/* Agregadas */

function leeArmasA(unidad){
	//alert();
	cargaListadoArmas = 0;
	var armaBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var contieneHijos = document.getElementById("contieneHijos").value; //Variable agregada el 05-05-2015

	var objHttpXMLArmas = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoArmas");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Armas ......</td>";
    
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlListaArmasAgregadas.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("codigoUnidad="+unidad+"&armaBuscar="+armaBuscar)); 
	
	objHttpXMLArmas.onreadystatechange=function()
	{
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4)
		{       
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);		
				var xml 				= objHttpXMLArmas.responseXML.documentElement;
				var codigo				= "";
				var tipo				= "";
				var marca 				= "";
				var modelo 				= "";
				var nroSerie			= "";
				var estado				= "";
   	            var seccion				= ""; //Variable agregada el 05-05-2015
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoArmas		= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";				
				
				
				listadoArmas = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					tipo	 		 = xml.getElementsByTagName('tipo')[i].text;
					marca	 	 	 = xml.getElementsByTagName('marca')[i].text;
					modelo	 		 = xml.getElementsByTagName('modelo')[i].text;
					nroSerie 		 = xml.getElementsByTagName('numeroSerie')[i].text;
					estado	 		 = xml.getElementsByTagName('estado')[i].text;
					codUnidadAgregado = xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado = xml.getElementsByTagName('desUnidadAgregado')[i].text;
          seccion	 		 = xml.getElementsByTagName('seccion')[i].text;
          unidadAgregado	= xml.getElementsByTagName('unidadAgregado')[i].text;
                    
                    //Control agregado el 28-04-2015
                    if(contieneHijos == 1){
                        var alto=280;
                    }else{
                       var alto=290; 
                    }
										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ARMA ...', '800','"+alto+"','fichaArma.php?codigoArma="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					//if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
                    //Condicion agregada el 05-05-2105
		            if(contieneHijos == 1){
				   	listadoArmas += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoArmas += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoArmas += "<td width='18%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
					listadoArmas += "<td width='28%' align='left'><div id='valorColumna'>"+marca+" "+modelo+"</div></td>";
					listadoArmas += "<td width='14%' align='center'><div id='valorColumna'>"+nroSerie+"</div></td>";
					//listadoArmas += "<td width='15%' align='left'><div id='valorColumna'></div></td>";
					//listadoArmas+= "<td width='10%' align='left'><div id='valorColumna'>"+seccion+"</div></td>"; //añadido
					listadoArmas+= "<td width='19%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoArmas+= "<td width='18%' align='left'><div id='valorColumna'>"+unidadAgregado+"</div></td>";
					listadoArmas += "</tr>";
				   }else{
					listadoArmas += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoArmas += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoArmas += "<td width='18%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
					listadoArmas += "<td width='28%' align='left'><div id='valorColumna'>"+marca+" "+modelo+"</div></td>";
					listadoArmas += "<td width='14%' align='center'><div id='valorColumna'>"+nroSerie+"</div></td>";
					//listadoArmas += "<td width='15%' align='left'><div id='valorColumna'></div></td>";
					listadoArmas+= "<td width='19%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoArmas+= "<td width='18%' align='left'><div id='valorColumna'>"+unidadAgregado+"</div></td>";
					listadoArmas += "</tr>";
				}
           }
				listadoArmas += "</table>";
				//alert(listadoArmas);
				div.innerHTML = listadoArmas;
				cargaListadoArmas = 1;
			}
		}
	}
}

/*------------------------------------------------------------------------------------------------------------*/

function buscaDatosArma(){
	
	var serieArma	= eliminarBlancos(document.getElementById("textSerieArma").value);
	if (serieArma == ""){
		alert("DEBE INDICAR EL NUMERO DE SERIE DEL ARMA ...... 	     ");
		document.getElementById("textSerieArma").value="";
		document.getElementById("textSerieArma").focus();
		return false;
	} else {
		document.getElementById("btnBuscarArma").value = "BUSCANDO ...";
		document.getElementById("btnBuscarArma").disabled = "true";
		buscaDatosArma2();	
	}
}

function buscaDatosArma2(){
	
	var serieArma	= eliminarBlancos(document.getElementById("textSerieArma").value);
	//if (serieArma != "") leeDatosArma(serieArma, 1);
	if (serieArma != "") leeDatosArmaPorSerie(serieArma);
}

function leeDatosArmaPorSerie(serieArma){
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlDatosArmaPorSerie.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("serieArma="+serieArma)); 
	
	objHttpXMLArmas.onreadystatechange=function()
	{
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4)
		{       
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				
				//alert(objHttpXMLArmas.responseText);		
				var xml 				= objHttpXMLArmas.responseXML.documentElement;
				var codigo	 			= "";
				
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					
					leeDatosArma(codigo, 1)
				}
			} else {	
				//alert(document.getElementById("btnBuscarArma").value);
				if (document.getElementById("btnBuscarArma").value == "BUSCANDO ..."){   
					alert ("NO EXISTE ...");
					document.getElementById("textSerieArma").focus();
				}
				document.getElementById("btnBuscarArma").value = "BUSCAR";
				//document.getElementById("btnBuscarVehiculo").disabled = "";
			}
		}
	}
}





var idAsignaSelectFichaArma;
function leeDatosArma(codigoArma, tipoBusqueda){
	
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "90px";
	

	
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlDatosArma.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("codigoArma="+codigoArma)); 
	
	objHttpXMLArmas.onreadystatechange=function()
	{
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4)
		{       
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				
				//alert(objHttpXMLArmas.responseText);		
				var xml 				= objHttpXMLArmas.responseXML.documentElement;
				var codigo	 			= "";
				var tipo				= "";
				var marca 				= "";
				var modelo				= "";
				var nroSerie			= "";
				var estado				= "";
				var unidadArma			= "";
				var descUnidadArma		= "";
				var fechaEstado			= "";
				var armaBCU				= "";
				var codigoUnidadAgregado  = "";
				var desUnidadAgregado  	  = "";
                var seccion  	          = ""; //Variable agregada al 05-05-2015
                var descSeccion  	      = ""; //Variable agregada al 05-05-2015
				
				//alert();				
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					tipo	 		 = xml.getElementsByTagName('tipo')[i].text;
					marca	 	 	 = xml.getElementsByTagName('marca')[i].text;
					modelo			 = xml.getElementsByTagName('modelo')[i].text;
					nroSerie 		 = xml.getElementsByTagName('numeroSerie')[i].text;
					estado	 		 = xml.getElementsByTagName('estado')[i].text;
					unidadArma	 	 = xml.getElementsByTagName('unidad')[i].text;  
					descUnidadArma	 = xml.getElementsByTagName('descUnidad')[i].text;
					fechaEstado	 	 = xml.getElementsByTagName('fechaEstado')[i].text;
					armaBCU	 	 	 = xml.getElementsByTagName('numeroBCU')[i].text;
					codigoUnidadAgregado 	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado 		= xml.getElementsByTagName('desUnidadAgregado')[i].text;
                    seccion 		 = xml.getElementsByTagName('seccion')[i].text; //Variable agregada el 05-05-2015
                    descSeccion 		 = xml.getElementsByTagName('descSeccion')[i].text; //Variable agregada el 05-05-2015
					//alert(descSeccion);
					document.getElementById("textSerieArma").value 			 = nroSerie;
					document.getElementById("idArma").value 				 = codigo;
					//document.getElementById("textNumeroInstitucional").value = "";
					//document.getElementById("textBCU").value 				 = "";
					document.getElementById("ultimaFecha").value 			 = fechaEstado;
					
					document.getElementById("codigoUnidadAgregado").value 	 	= codigoUnidadAgregado;
					document.getElementById("textUnidadAgregado").value 	 	= desUnidadAgregado;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					
                    document.getElementById("seccionBaseDatos").value 	    	= seccion;
					
					//document.getElementById("selProcedencia").value = procedencia;
					//document.getElementById("selTipoVehiculo").value = tipoVehiculo;
					//document.getElementById("selMarca").value = marca;
					//document.getElementById("selModelo").value = modelo;		
					//document.getElementById("selEstado").value = estado;	
					
					document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;	
					
					if (unidadArma == "") var habilitarBotones = false;
					else var habilitarBotones = true;
					
                    //Variable agregada seccio el 05-05-2015
					var valoresAsignar = "'" + tipo + "','" + marca + "','" + modelo + "','" + estado + "','" + seccion + "'," + habilitarBotones;
                    	//alert(valoresAsignar);  
					leeModeloArmas(marca, 'selModelo');
					idAsignaSelectFichaArma = setInterval("asignaValores("+valoresAsignar+")",1000); 
					
					if (tipoBusqueda == "1"){
						document.getElementById("btnBuscarArma").value = "BUSCAR";
						document.getElementById("btnBuscarArma").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadArma){
							alert("ESTA ARMA YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaArmas();
						}
						
						if (unidadUsuario != unidadArma && unidadArma != ""){
							alert("NO PUEDE AGREGAR ESTA ARMA,\nYA QUE PERTENECE A LA " +descUnidadArma+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaArmas();
						} 
						
						
						
					}
				}
			} else {	
				if (document.getElementById("btnBuscarArma").value == "BUSCANDO ..."){   
					document.getElementById("mensajeCargando").style.display = "none";
					alert ("NO EXISTE ...");
					document.getElementById("textSerieArma").focus();
				}
				document.getElementById("btnBuscarArma").value = "BUSCAR";
				document.getElementById("btnBuscarVehiculo").disabled = "";
			}
		}
	}
}

//Funcion modificada el 05-05-2015
function asignaValores(tipo,marca,modelo,estado, seccion, habilitarBotones){
	if (cargaTipoArma == 1 && cargaMarcaArma == 1 && cargaModelosArmas == 1 && cargaEstadosRecurso == 1){
		clearInterval(idAsignaSelectFichaArma);
		document.getElementById("selTipoArma").value 		= tipo;
		document.getElementById("selMarca").value 			= marca;
		document.getElementById("selModelo").value 			= modelo;
        document.getElementById("selSeccion").value 		= seccion; //Variable agregada el 05-05-2015
		
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value 			= estado;
		document.getElementById("estadoBaseDatos").value 	= estado;
        
       	if (seccion == "") seccion = 0; //Condicion agregada el 05-05-2015
		document.getElementById("selSeccion").value 		= seccion;
		document.getElementById("seccionBaseDatos").value 	= seccion;
		
		activaFechaNuevoEstado();
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
			document.getElementById('btnBaja').disabled = "";
		}
		
		document.getElementById('btnGuardarOrganizacion').disabled = "";
		document.getElementById('btnCerrarFichaFuncionario').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none";
	}
}



function validarFichaArma(){
	var codigo				= eliminarBlancos(document.getElementById("textSerieArma").value);
	//var numeroInstitucional = eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var tipoArma			= document.getElementById("selTipoArma").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaEstado			= document.getElementById("textFechaNuevoEstado").value;
	var ultimaFechaEstado	= document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	var seccion				= document.getElementById("selSeccion").value; //Variable agregada el 05-05-2015
	var tipoUnidad	        = document.getElementById("tipoUnidad").value; //Variable agregada el 05-05-2015
    var contieneHijos       = document.getElementById("contieneHijos").value; //Variable agregada el 29-04-2015
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	if (codigo == "") {
		alert("DEBE INDICAR EL NUMERO DE SERIA DEL ARMA ...... 	     ");
		document.getElementById("textSerieArma").focus();
		return false;
	}
	
	//if (numeroInstitucional == "") {
	//	alert("DEBE INDICAR EL NUMERO INSTITUCIONAL DEL ARMA ...... 	     ");
	//	document.getElementById("textNumeroInstitucional").focus();
	//	return false;
	//}
	
	if (tipoArma == 0) {
		alert("DEBE INDICAR EL TIPO DE ARMA ...... 	     ");
		document.getElementById("selTipoArma").focus();
		return false;
	}	
	
	if (marca == 0) {
		alert("DEBE INDICAR LA MARCA DEL ARMA ...... 	     ");
		document.getElementById("selMarca").focus();
		return false;
	}	
	
	if (modelo == 0) {
		alert("DEBE INDICAR EL MODELO DEL ARMA ...... 	     ");
		document.getElementById("selModelo").focus();
		return false;
	}	
	
   	//Validacion agregada el 05-05-2015
	if (seccion == 0 && contieneHijos==1) {		alert("DEBE INDICAR LA SECCION ...... 	     ");
		document.getElementById("selSeccion").focus();
		return false;
	}
    
	if (estado == 0) {
		alert("DEBE INDICAR EL ESTADO DEL ARMA ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	
	//Control agregado el 05-05-2015
    //|| (document.getElementById("selSeccion").value != document.getElementById("seccionBaseDatos").value)
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value || (document.getElementById("selSeccion").value != document.getElementById("seccionBaseDatos").value)){
		if (fechaEstado == ""){
			alert("DEBE INDICAR FECHA DEL NUEVO ESTADO ...... 	     ");
			return false;
		}
		
		
		var comparaFechaLimite = comparaFecha(fechaLimite,fechaEstado)
		//alert(comparaFechaLimite);
		if (unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
		}
		
		var fechaMayor = comparaFecha(ultimaFechaEstado,fechaEstado);
		//alert(ultimaFechaEstado);       
		if (fechaMayor == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado);
			return false;
		}
		
		if (estado == 3000 && codigoUnidadAgregado == ""){
			alert("DEBE INDICAR UNIDAD A LA QUE EL ARMA SE FUE AGREGADA...... 	     ");
			return false;
		}
		
	}
	
	return true;
}


function guardarFichaArma(){
	desactivarBotones();
	var validaOk = validarFichaArma();
	
	var codigoArma = document.getElementById("idArma").value;
	if (validaOk){
		if (codigoArma != "") {
			var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTA ARMA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) actualizarArma(codigoArma);
			else return false;
		}
		else {
			var msj=confirm("ATENCIÓN :\nSE INGRESARÁN LOS DATOS DE ESTA ARMA EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) nuevaArma();
			else return false;
		}
	} else {
		activarBotones();
	}
}


function actualizarArma(codigoArma){
	
	//alert(codigoArma);
	
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var numeroSerie			= eliminarBlancos(document.getElementById("textSerieArma").value);
	//var numeroInstitucional = eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var tipoArma			= document.getElementById("selTipoArma").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaEstado			= document.getElementById("textFechaNuevoEstado").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;      
    var seccion				= document.getElementById("selSeccion").value;	//Variable agregada el 05-05-2015
	//var armaBCU				= document.getElementById("textBCU").value;
	//alert();			
	var parametros = "";
	
    //Agregado parametro seccon el 05-05-2015
	parametros += "codigo="+codigoArma+"&numeroSerie="+numeroSerie+"&seccion="+seccion;
	parametros += "&tipoArma="+tipoArma+"&marca="+marca+"&modelo="+modelo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaEstado+"&unidad="+unidadUsuario+"&armaBCU=&codigoUnidadAgregado="+codigoUnidadAgregado;     
	
	//alert(parametros);
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlActualizaArma.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI(parametros));
	
	objHttpXMLArmas.onreadystatechange=function()
	{
		if(objHttpXMLArmas.readyState == 4)
		{       
				if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml = objHttpXMLArmas.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].text;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 document.getElementById("estadoBaseDatos").value = estado;
						 activaFechaNuevoEstado();
						 top.leeArmas(unidadUsuario);
						 idCargaListadoArmas = setInterval("cerrarVentanaArmas()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}


function nuevaArma(){
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var numeroSerie			= eliminarBlancos(document.getElementById("textSerieArma").value);
	//var numeroSerie 		= eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var tipoArma			= document.getElementById("selTipoArma").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaEstado			= document.getElementById("textFechaNuevoEstado").value;
	//var armaBCU				= document.getElementById("textBCU").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
    
   	var seccion		     	= document.getElementById("selSeccion").value;
				
	var parametros = "";
	
	parametros += "numeroSerie="+numeroSerie;
	parametros += "&tipoArma="+tipoArma+"&marca="+marca+"&modelo="+modelo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaEstado+"&unidad="+unidadUsuario+"&armaBCU=&codigoUnidadAgregado="+codigoUnidadAgregado;  
    parametros += "seccion="+seccion;
	
	//alert(parametros);
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlNuevaArma.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI(parametros));
	
	objHttpXMLArmas.onreadystatechange=function()
	{
		if(objHttpXMLArmas.readyState == 4)
		{       
				//alert(objHttpXMLArmas.responseText);
				if (objHttpXMLArmas.responseText != "VACIO"){
				var xml = objHttpXMLArmas.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeArmas(unidadUsuario);
						 idCargaListadoArmas = setInterval("cerrarVentanaArmas()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function cerrarVentanaArmas(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoArmas == 1){
		clearInterval(idCargaListadoArmas);
		 top.Windows.closeAll();
	}
}


function liberaArma(){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACARÁ ESTA ARMA DE LA OFERTA DE LA UNIDAD.                                       \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		var validaOk = validarFichaArma();
		if (validaOk){
			var codigoArma = eliminarBlancos(document.getElementById("idArma").value);
			parametros += "codigoArma="+codigoArma;
			
			//alert(parametros);
			
			var objHttpXMLArmas = new AJAXCrearObjeto();
			objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlLiberaArma.php",true);
			objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpXMLArmas.send(encodeURI(parametros));
			
			objHttpXMLArmas.onreadystatechange=function()
			{
				if(objHttpXMLArmas.readyState == 4)
				{       
						if (objHttpXMLArmas.responseText != "VACIO"){
						//alert(objHttpXMLArmas.responseText);
						var xml = objHttpXMLArmas.responseXML.documentElement;
						for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
							var codigo = xml.getElementsByTagName('resultado')[i].text;
							if (codigo == 1){
								alert('EL ARMA FUE DEJADA DISPONIBLE PARA OTRA UNIDAD ......        ');
								top.leeArmas(unidadUsuario);
							 	idCargaListadoArmas = setInterval("cerrarVentanaArmas()",1000);
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
						}
					}
				}
			}
		}
	}
}


function bajaArma(){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACARÁ ESTA ARMA DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var codigoArma = eliminarBlancos(document.getElementById("idArma").value)
		var parametros = "";
		
		parametros += "codigoArma="+codigoArma;
		
		var objHttpXMLArmas = new AJAXCrearObjeto();
		objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlBajaArma.php",true);
		objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLArmas.send(encodeURI(parametros));
		
		objHttpXMLArmas.onreadystatechange=function()
		{
			if(objHttpXMLArmas.readyState == 4)
			{       
				if (objHttpXMLArmas.responseText != "VACIO"){
					//alert(objHttpXMLArmas.responseText);
					var xml = objHttpXMLArmas.responseXML.documentElement;
					for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = xml.getElementsByTagName('resultado')[i].text;
						if (codigo == 1){
							alert('EL ARMA FUE DADA DE BAJA ......        ');
							top.leeArmas(unidadUsuario);
						 	idCargaListadoArmas = setInterval("cerrarVentanaArmas()",1000);
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
					}
				}
			}
		}
	}
}


function activaFechaNuevoEstado(){
	//alert(document.getElementById("selEstado").value);
	//alert(document.getElementById("estadoBaseDatos").value);
	//alert();
    // Condicion agregada el 05-05-2015
    //|| (document.getElementById("selSeccion").value != document.getElementById("seccionBaseDatos").value)
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value || (document.getElementById("selSeccion").value != document.getElementById("seccionBaseDatos").value)){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaArma").style.visibility = "visible"; 
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		
		//PARA INGRESO UNIDAD AGREGADO
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
		//----------------------------
		
	} else {
		document.getElementById("labFechaEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaArma").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
		
		//PARA INGRESO UNIDAD AGREGADO
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
		//----------------------------
		
	}
}



var cargaListadoArmasDisponibles;
function listaArmasDisponibles(unidad, nombreObjeto){
	cargaListadoArmasDisponibles = 0;
	
	var fechaServicio = document.getElementById('textFechaServicio').value;
	
	var opcionServicio  	= document.getElementById("selServicio").value;
	var tipoServicio 		= opcionServicio.substr(0,1);
	var servicio  			= opcionServicio.substr(1,opcionServicio.length);
	var correlativo			= document.getElementById("correlativoServicio").value; 
	
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;		
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	var parametros = "codigoUnidad="+unidad+"&fechaServicio="+fechaServicio+"&tipoServicio="+servicio+"&correlativo="+correlativo;
			
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlListaArmasDisponibles.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI(parametros));
	objHttpXMLArmas.onreadystatechange=function()
	{
		if(objHttpXMLArmas.readyState == 4)
		{       
			if (objHttpXMLArmas.responseText != "VACIO"){
	
				//alert(objHttpXMLArmas.responseText);		
				var xml 			= objHttpXMLArmas.responseXML.documentElement;
				var codigo 			= "";
				var marca			= "";
				var modelo			= "";
				var numeroSerie		= "";
				var descripcion		= "";
				var tipo			= "";
						
				document.getElementById(nombreObjeto).length = null;
				
				//var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				//document.getElementById(nombreObjeto).options[0] = datosOpcion;								
				
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					codigo 	= xml.getElementsByTagName('codigo')[i].text;
					//marca 	= xml.getElementsByTagName('marca')[i].text;
					//modelo 	= xml.getElementsByTagName('modelo')[i].text;
					tipo 	= xml.getElementsByTagName('tipo')[i].text;
					numeroSerie 	= xml.getElementsByTagName('numeroSerie')[i].text;
					
					descripcion = tipo + " " + marca + " " + modelo + " (N/S. : " + numeroSerie + ")";
					var datosOpcion = new Option(descripcion, "P" + codigo, "", "");
					document.getElementById(nombreObjeto).options[i] = datosOpcion;
				}
				cargaListadoArmasDisponibles = 1;
			}
		}
	}
}



function desactivarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "true";
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardarOrganizacion").disabled = "true";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "true";
	
}

function activarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "";
	document.getElementById("btnBaja").disabled = "";
	document.getElementById("btnGuardarOrganizacion").disabled = "";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "";
	
}

function activaBuscaUnidadAgregado(){
	desactivarBotones();
	
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}
