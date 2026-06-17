var cargaListadoVehiculos;
var idCargaListadoVehiculos;
var idAsignaSelectFichaVehiculo;

function leeVehiculos(unidad){
	cargaListadoVehiculos = 0;
	var vehiculoBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoVehiculos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
    
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculos.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&vehiculoBuscar="+vehiculoBuscar)); 
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{       
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			= "";
				var tipoVehiculo		= "";
				var marcaModelo 		= "";
				var patente		 		= "";
				var nroInstitucional	= "";
				var estado				= "";
				var bcu					= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoVehiculos	= "";
				
				
				listadoVehiculos = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 		  = xml.getElementsByTagName('codigo')[i].text;
					tipoVehiculo	  = xml.getElementsByTagName('tipo')[i].text;
					marcaModelo	 	  = xml.getElementsByTagName('marca')[i].text + " " + xml.getElementsByTagName('modelo')[i].text;
					patente	 		  = xml.getElementsByTagName('patente')[i].text;
					nroInstitucional  = xml.getElementsByTagName('numeroInstitucional')[i].text;
					estado	 		  = xml.getElementsByTagName('estado')[i].text;
					bcu	 		 	  = xml.getElementsByTagName('bcu')[i].text;
					codUnidadAgregado = xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado = xml.getElementsByTagName('desUnidadAgregado')[i].text;
										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('VEHICULO ...', '800', '375','fichaVehiculo.php?codigoVehiculo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
				
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><div id='valorColumna'>"+marcaModelo+"</div></td>";
					listadoVehiculos += "<td width='15%'><div id='valorColumna'>"+patente+"</div></td>";
					listadoVehiculos += "<td width='15%' align='left'><div id='valorColumna'>"+bcu+"</div></td>";
					//listadoVehiculos+= "<td width='19%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos+= "<td width='19%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoVehiculos += "</tr>";
				}
				listadoVehiculos += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoVehiculos;
				cargaListadoVehiculos = 1;
			}
		}
	}
}

/* Agregadas */

function leeVehiculosA(unidad){
	cargaListadoVehiculos = 0;
	var vehiculoBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
    var contieneHijos = document.getElementById("contieneHijos").value; //Variable agregada el 05-05-2015

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoVehiculos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
    
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculosAgregados.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&vehiculoBuscar="+vehiculoBuscar)); 
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{       
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			= "";
				var tipoVehiculo		= "";
				var marcaModelo 		= "";
				var patente		 		= "";
				var nroInstitucional	= "";
				var estado				= "";
				var bcu					= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
        var seccion         	= ""; //Variable agregada el 05-05-2015
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoVehiculos	= "";
				
				
				listadoVehiculos = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 		  = xml.getElementsByTagName('codigo')[i].text;
					tipoVehiculo	  = xml.getElementsByTagName('tipo')[i].text;
					marcaModelo	 	  = xml.getElementsByTagName('marca')[i].text + " " + xml.getElementsByTagName('modelo')[i].text;
					patente	 		  = xml.getElementsByTagName('patente')[i].text;
					nroInstitucional  = xml.getElementsByTagName('numeroInstitucional')[i].text;
					estado	 		  = xml.getElementsByTagName('estado')[i].text;
					bcu	 		 	  = xml.getElementsByTagName('bcu')[i].text;
					codUnidadAgregado = xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado = xml.getElementsByTagName('desUnidadAgregado')[i].text;

					unidadAgregado	= xml.getElementsByTagName('unidadAgregado')[i].text;
							
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
                    
                     //Control agregado el 28-04-2015
                    if(contieneHijos == 1){
                        var alto=360;
                    }else{
                       var alto=350; 
                    }
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('VEHICULO ...', '800', '"+alto+"','fichaVehiculo.php?codigoVehiculo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					//if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
				//Condicion agregada el 05-05-2015
				if(contieneHijos == 1){
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='18%' align='left'><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
					listadoVehiculos += "<td width='14%' align='left'><div id='valorColumna'>"+marcaModelo+"</div></td>";
					listadoVehiculos += "<td width='14%'><div id='valorColumna'>"+patente+"</div></td>";
					listadoVehiculos += "<td width='14%' align='left'><div id='valorColumna'>"+bcu+"</div></td>";
					//listadoVehiculos += "<td width='10%' align='left'><div id='valorColumna'>"+seccion+"</div></td>";
					//listadoVehiculos+= "<td width='19%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos+= "<td width='19%' align='center'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoVehiculos+= "<td width='18%' align='left'><div id='valorColumna'>"+unidadAgregado+"</div></td>";
					listadoVehiculos += "</tr>";
					}else{
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='18%' align='left'><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
					listadoVehiculos += "<td width='14%' align='left'><div id='valorColumna'>"+marcaModelo+"</div></td>";
					listadoVehiculos += "<td width='14%'><div id='valorColumna'>"+patente+"</div></td>";
					listadoVehiculos += "<td width='14%' align='left'><div id='valorColumna'>"+bcu+"</div></td>";
					//listadoVehiculos+= "<td width='19%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos+= "<td width='18%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoVehiculos+= "<td width='18%' align='left'><div id='valorColumna'>"+unidadAgregado+"</div></td>";
					listadoVehiculos += "</tr>";
				}
             }
				listadoVehiculos += "</table>";
				//alert(listadoFuncionarios);
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
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad)); 
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{       
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			= "";
				var tipoVehiculo		= "";
				var marcaModelo 		= "";
				var patente		 		= "";
				var nroInstitucional	= "";
				var estado				= "";
				var bcu					= "";
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var estadoAntiguo = 0;
									
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
															
					codigo	 		  = xml.getElementsByTagName('codigo')[i].text;
					tipoVehiculo	  = xml.getElementsByTagName('tipo')[i].text;
					marcaModelo	 	  = xml.getElementsByTagName('marca')[i].text + " " + xml.getElementsByTagName('modelo')[i].text;
					patente	 		  = xml.getElementsByTagName('patente')[i].text;
					nroInstitucional  = xml.getElementsByTagName('numeroInstitucional')[i].text;
					estado	 		  = xml.getElementsByTagName('estado')[i].text;
					bcu	 		 	  = xml.getElementsByTagName('bcu')[i].text;
					codUnidadAgregado = xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado = xml.getElementsByTagName('desUnidadAgregado')[i].text;
					
					if (estado == "MANTENCION" || estado == "REPARACION") estadoAntiguo++;
				}
				
				if (estadoAntiguo > 0) {
					
					var mensajeEstados = "";
					
					mensajeEstados += "ATENCION :\n\n";
					mensajeEstados += "TIENE VEHICULOS CON ESTADO \"MANTENCION\" Y/O \"REPARACION\" A LOS QUE DEBE ACTUALIZAR EL ESTADO EN QUE SE ENCUENTRAN SEGUN ULTIMAS INSTRUCCIONES :\n\n";
					mensajeEstados += "1. MANTENCION PROGRAMADA.\n";
					mensajeEstados += "2. REPARACION MENOR.\n";
					mensajeEstados += "3. REPARACION MAYOR.\n";
					mensajeEstados += "4. EVALUACION DE FALLA.\n";
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
	if (multiple == false ){		
		var datosOpcion = new Option("SELECCIONE VEHICULO ... ", 0, "", "");
		document.getElementById(nombreObjeto).options[0] = datosOpcion;
	}

	var objHttpXMLVehiculos = new AJAXCrearObjeto();		    
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculos.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad)); 
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{       
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			= "";
				var tipoVehiculo		= "";
				var patente		 		= "";
							
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					tipoVehiculo	 = xml.getElementsByTagName('tipo')[i].text;
					patente	 		 = xml.getElementsByTagName('patente')[i].text;
				
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
	
	var bcuVehiculo	= eliminarBlancos(document.getElementById("textNumeroBCU").value);
	//alert(bcuVehiculo.length);
	if (bcuVehiculo.length < 11){
		alert("EL CODIGO BCU DEBE ESTAR COMPUESTO DE 11 CARACTERES.      ");
		document.getElementById("textNumeroBCU").focus();
		return false;
	}
	
	if (bcuVehiculo == ""){
		alert("DEBE INDICAR EL NUMERO BCU DEL VEHICULO ...... 	     ");
		document.getElementById("textNumeroBCU").value="";
		document.getElementById("textNumeroBCU").focus();
		return false;
	} else {
		document.getElementById("btnBuscarVehiculo").value = "BUSCANDO ...";
		document.getElementById("btnBuscarVehiculo").disabled = "true";
		leeDatosVehiculo('',bcuVehiculo, 1);	
	}
}


function buscaDatosVehiculo2(){
	var patenteVehiculo	= eliminarBlancos(document.getElementById("textPatente").value);
	if (patenteVehiculo != "") leeDatosVehiculo('',patenteVehiculo, 1);
}


function buscaVehiculoL3(){
	var codigoVehiculo = document.getElementById("textNumeroBCU").value;
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlBuscaVehiculoL3.php",false);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoVehiculo="+codigoVehiculo)); 
	
	//objHttpXMLVehiculos.onreadystatechange=function()
	//{
	//	if(objHttpXMLVehiculos.readyState == 4)
	//	{       
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);	
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var tipoVehiculo		= "";
				var marca 				= "";
				var modelo				= "";
				var patente		 		= "";
				var nroInstitucional	= "";
				var procedencia			= "";
				var numeroBCU			= "";
				var fabricacion		    	= "";
				
				//alert();				
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					patente	 		 	= xml.getElementsByTagName('patente')[i].text;
					nroInstitucional 	= xml.getElementsByTagName('numeroInstitucional')[i].text;
					numeroBCU 			= xml.getElementsByTagName('numeroBCU')[i].text;
					fabricacion 			= xml.getElementsByTagName('fabricacion')[i].text;
					
					document.getElementById("textNumeroBCU").readOnly = "true";					
					document.getElementById("textPatente").value = patente;
					document.getElementById("textNumeroInstitucional").value = nroInstitucional;
					document.getElementById("textNumeroBCU").value = numeroBCU;
					document.getElementById("textAnnoFab").value = fabricacion;
					
					if(document.getElementById("validaAnnoOculto").value == ""){
				    	 document.getElementById("textAnnoFab").readOnly 	= "";	
				    	 document.getElementById("validaAnnoFab").checked=""; 
				    	 document.getElementById("validaAnnoFab").disabled=""; 
				    	 document.getElementById("labConfirmar").disabled=""; 
				    	 document.getElementById("labConfirmar").innerHTML = "CONFIRMAR"; 
				}
					
					
					//alert("true");										
					return true;
				}
			} else {
				//alert("VEHICULO NO ENCONTRADO EN LA BASE DE DATOS.");
				return false;
			}
	//	}
	//}
}



function leeDatosVehiculo(codigoVehiculo, bcuVehiculo, tipo){
	
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlDatosVehiculo.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoVehiculo="+codigoVehiculo+"&bcuVehiculo="+bcuVehiculo)); 
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{       
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 				  = objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			  = "";
				var tipoVehiculo		  = "";
				var marca 				  = "";
				var modelo				  = "";
				var patente		 		  = "";
				var nroInstitucional	  = "";
				var estado				  = "";
				var procedencia			  = "";
				var unidadVehiculo		  = "";
				var descUnidadVehiculo	  = "";
				var numeroBCU			  = "";
				var fechaEstado			  = "";
				var codigoUnidadAgregado  = "";
				var desUnidadAgregado  	  = "";
				var codigoLugarReparacion = "";
				var codigoFallaVehiculo   = "";
				var annoFabricacion   = "";
        var validaAnno="";
				
				//alert();				
				for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
					codigo	 		 		= xml.getElementsByTagName('codigo')[i].text;
					tipoVehiculo	 		= xml.getElementsByTagName('tipo')[i].text;
					marca	 	 	 		= xml.getElementsByTagName('marca')[i].text;
					modelo			 		= xml.getElementsByTagName('modelo')[i].text;
					patente	 		 		= xml.getElementsByTagName('patente')[i].text;
					nroInstitucional 		= xml.getElementsByTagName('numeroInstitucional')[i].text;
					estado	 		 		= xml.getElementsByTagName('estado')[i].text;
					procedencia		 		= xml.getElementsByTagName('procedencia')[i].text;
					unidadVehiculo 	 		= xml.getElementsByTagName('unidad')[i].text;
					descUnidadVehiculo 		= xml.getElementsByTagName('descUnidad')[i].text;
					numeroBCU 				= xml.getElementsByTagName('numeroBCU')[i].text;
					fechaEstado 			= xml.getElementsByTagName('fechaEstado')[i].text;
					codigoUnidadAgregado 	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
					desUnidadAgregado 		= xml.getElementsByTagName('desUnidadAgregado')[i].text;
					codigoLugarReparacion 	= xml.getElementsByTagName('codigoLugarReparacion')[i].text;
					codigoFallaVehiculo     = xml.getElementsByTagName('codigoFallaVehiculo')[i].text;
					annoFabricacion    = xml.getElementsByTagName('annoFabricacion')[i].text;
          validaAnno = xml.getElementsByTagName('validaAnno')[i].text;
					
					if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					
					if (annoFabricacion  == "") annoFabricacion  = "0000";
					
					//alert(descUnidadVehiculo);
					document.getElementById("textNumeroBCU").readOnly 		    = "true";			
					document.getElementById("idVehiculo").value 			    = codigo;
					document.getElementById("textPatente").value 			    = patente;
					document.getElementById("textNumeroInstitucional").value    = nroInstitucional;
					document.getElementById("textNumeroBCU").value 			    = numeroBCU;
					document.getElementById("ultimaFecha").value 			    = fechaEstado;
					
					document.getElementById("codigoUnidadAgregado").value 	 	= codigoUnidadAgregado;
					document.getElementById("textUnidadAgregado").value 	 	= desUnidadAgregado;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					document.getElementById("textAnnoFab").value 	 	= annoFabricacion;
				  document.getElementById("validaAnnoOculto").value 	 	= validaAnno;
				  
				 if(document.getElementById("validaAnnoOculto").value == 1){
				    	 document.getElementById("textAnnoFab").readOnly 	= "true";	
				    	 document.getElementById("validaAnnoFab").checked="true"; 
				    	 document.getElementById("validaAnnoFab").disabled="true"; 
				    	 document.getElementById("labConfirmar").disabled=""; 
				    	 document.getElementById("labConfirmar").innerHTML = "CONFIRMADO"; 
				}else{
				    		document.getElementById("textAnnoFab").readOnly 	= "";	
				    	 document.getElementById("validaAnnoFab").checked=""; 
				    	 document.getElementById("validaAnnoFab").disabled=""; 
				    	 document.getElementById("labConfirmar").disabled=""; 
				
				}
					
					
					if (tipo == 0 && (estado == 20 || estado == 30)) {
						if (estado == 20) var estadoMensaje = "MANTENCION";
						if (estado == 30) var estadoMensaje = "REPARACION";
						alert("ESTE VEHICULO SE ENCUENTRA EN ESTADO \""+estadoMensaje+ "\", DEBE ACTUALIZAR EL ESTADO EN QUE SE ENCUENTRA SEGUN ULTIMAS INSTRUCCIONES :\n\n1. MANTECION PROGRAMADA.\n2. REPARACION MENOR.\n3. REPARACION MAYOR.\n4. EVALUACION DE FALLA.\n5. TRAMITE ADMINISTRATIVO.\n    (EVAL. COTIZACIONES/ESPERA REPUESTOS)");
						estado = 0;
						//document.getElementById("selLugarReparacion").focus()
					}
					
					
					//document.getElementById("selProcedencia").value = procedencia;
					//document.getElementById("selTipoVehiculo").value = tipoVehiculo;
					//document.getElementById("selMarca").value = marca;
					//document.getElementById("selModelo").value = modelo;		
					//document.getElementById("selEstado").value = estado;		
					
					//alert(unidadVehiculo);
					if (unidadVehiculo == "") var habilitarBotones = false;
					else var habilitarBotones = true;
					
					document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;					
										
										
					var valoresAsignar = "'" + procedencia + "','" + tipoVehiculo + "','" + marca + "','" + modelo + "','" + estado + "','" + codigoLugarReparacion + "','" + codigoFallaVehiculo + "'," + habilitarBotones;    
					leeModeloVehiculos(marca, 'selModelo');
					idAsignaSelectFichaVehiculo = setInterval("asignaValores("+valoresAsignar+")",500); 
					
					if (tipo == "1"){
						document.getElementById("btnBuscarVehiculo").value = "BUSCAR";
						document.getElementById("btnBuscarVehiculo").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadVehiculo){
							alert("ESTE VEHICULO YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaVehiculo();
						}
						
						if (unidadUsuario != unidadVehiculo && unidadVehiculo != ""){
							alert("NO PUEDE AGREGAR ESTE VEHICULO,\nYA QUE PERTENECE A LA " +descUnidadVehiculo+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaVehiculo();
						} 
						
						//if (unidadVehiculo == ""){
						//	alert(unidadVehiculo);
						//	document.getElementById("labFechaEstado").disabled= "";
						//	document.getElementById("textFechaNuevoEstado").disabled= "";
						//	document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
						//	document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
						//}
					}
				}
			} else {
				var vehiculoL3 = buscaVehiculoL3();
				//alert(vehiculoL3);
				if(!vehiculoL3){
					alert("EL VEHICULO CON EL BCU INDICADO, NO SE ENCUENTRA EN LAS BASES DE DATOS          ");   
					cerrarVentanaVehiculo();                                           

				}   
				document.getElementById("mensajeCargando").style.display = "none";
				//if (document.getElementById("btnBuscarVehiculo").value == "BUSCANDO ..."){   
				//	document.getElementById("mensajeCargando").style.display = "none"; 
				//	alert ("NO EXISTE ...");
				//	document.getElementById("textPatente").focus();
				//}
				document.getElementById("btnBuscarVehiculo").value = "BUSCAR";
				document.getElementById('btnGuardarOrganizacion').disabled = "";
				//document.getElementById("btnBuscarVehiculo").disabled = "";
				//document.getElementById("idVehiculo").value = "";
			}
		}
	}
}


function asignaValores(procedencia,tipoVehiculo,marca,modelo,estado, codigoLugarReparacion, codigoFallaVehiculo, habilitarBotones){
	if (cargaProcedenciaVehiculo == 1 && cargaTipoVehiculo == 1 && cargaMarcaVehiculos == 1 && cargaModelosVehiculos == 1 && cargaEstadosRecurso == 1 && cargaLugaresDeReparacion == 1 && cargaFallaVehiculo == 1){
		clearInterval(idAsignaSelectFichaVehiculo);
		document.getElementById("selProcedencia").value 	= procedencia;
		document.getElementById("selTipoVehiculo").value 	= tipoVehiculo;
		document.getElementById("selMarca").value 			= marca;
		document.getElementById("selModelo").value 			= modelo;
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value 			= estado;
		document.getElementById("estadoBaseDatos").value 	= estado;
		
		if (codigoFallaVehiculo == "") codigoFallaVehiculo = 0;
    document.getElementById("selTipoFalla").value=codigoFallaVehiculo;
    document.getElementById("codFallaBaseDatos").value=codigoFallaVehiculo;
    //alert(codigoFallaVehiculo);
		
		document.getElementById("selLugarReparacion").value  = codigoLugarReparacion;
		document.getElementById("codLugarReparacionBaseDatos").value = codigoLugarReparacion;
		
		//DEBO HABILITAR EL BOTON DE BAJA
		activaFechaNuevoEstado();
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
			document.getElementById('btnBaja').disabled = "";
		} else {
			document.getElementById("labFechaEstado").disabled= "";
			document.getElementById("textFechaNuevoEstado").disabled= "";
			document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
			document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		}
		
		document.getElementById('btnGuardarOrganizacion').disabled = "";
		document.getElementById('btnCerrarFichaFuncionario').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none"; 
		
	}
}

function guardarFichaVehiculo(codigoVehiculo){
	desactivarBotones();
	var validaOk = validarFichaVehiculo();
	
	var codigoVehiculo = document.getElementById("idVehiculo").value;
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTE VEHICULO EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) actualizarVehiculo(codigoVehiculo);
			//else return false;
			else activarBotones();
		}
		else {
			var msj=confirm("ATENCIÓN :\nSE INGRESARÁN LOS DATOS DE ESTE VEHICULO EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) nuevoVehiculo();
			//else return false;
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}


function actualizarVehiculo(codigoVehiculo){
	
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var patente				= eliminarBlancos(document.getElementById("textPatente").value);
	var numeroInstitucional = eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var procedencia			= document.getElementById("selProcedencia").value;
	var tipoVehiculo		= document.getElementById("selTipoVehiculo").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
	var numeroDocumento		= document.getElementById("textDocumentoNuevoEstado").value;
	var numeroBCU			= document.getElementById("textNumeroBCU").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value; 
	var lugarReparacion 	 = document.getElementById("selLugarReparacion").value;
	var fallaVehiculo        = document.getElementById("selTipoFalla").value;
	var anno = document.getElementById("textAnnoFab").value;
	var valida = document.getElementById("validaAnnoFab").value;
	var validaOculto = document.getElementById("validaAnnoOculto").value;
	//alert();			
	var parametros = "";
	
	parametros += "patente="+patente+"&numeroInstitucional="+numeroInstitucional+"&procedencia="+procedencia;
	parametros += "&tipoVehiculo="+tipoVehiculo+"&marca="+marca+"&modelo="+modelo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado+"&codigoVehiculo="+codigoVehiculo;
	parametros += "&numeroDocumento="+numeroDocumento+"&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado;
	parametros += "&lugarReparacion="+lugarReparacion+"&fallaVehiculo="+fallaVehiculo+"&anno="+anno+"&valida="+valida+"&validaOculto="+validaOculto;
	//alert(parametros);
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlActualizaVehiculo.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		if(objHttpXMLVehiculos.readyState == 4)
		{       
				if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml = objHttpXMLVehiculos.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].text;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 document.getElementById("estadoBaseDatos").value = estado;
						// activaFechaNuevoEstado();
						 top.leeVehiculos(unidadUsuario);
						 idCargaListadoVehiculos = setInterval("cerrarVentanaVehiculo()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}


function nuevoVehiculo(){
	
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var patente				= eliminarBlancos(document.getElementById("textPatente").value);
	var numeroInstitucional = eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var procedencia			= document.getElementById("selProcedencia").value;
	var tipoVehiculo		= document.getElementById("selTipoVehiculo").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaEstado			= document.getElementById("textFechaNuevoEstado").value;
	var numeroDocumento		= document.getElementById("textDocumentoNuevoEstado").value;
	var numeroBCU			= document.getElementById("textNumeroBCU").value;
	var lugarReparacion 	= document.getElementById("selLugarReparacion").value;
	var anno = document.getElementById("textAnnoFab").value;
	var valida = document.getElementById("validaAnnoFab").value;
	var validaOculto = document.getElementById("validaAnnoOculto").value;
			
	var parametros = "";
	
	parametros += "patente="+patente+"&numeroInstitucional="+numeroInstitucional+"&procedencia="+procedencia;
	parametros += "&tipoVehiculo="+tipoVehiculo+"&marca="+marca+"&modelo="+modelo;
	parametros += "&estado="+estado+"&fechaEstado="+fechaEstado+"&numeroDocumento="+numeroDocumento+"&numeroBCU="+numeroBCU;
	parametros += "&lugarReparacion="+lugarReparacion+"&anno="+anno+"&valida="+valida+"&validaOculto="+validaOculto;
	
	//alert(parametros);
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlNuevoVehiculo.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		if(objHttpXMLVehiculos.readyState == 4)
		{       
				if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml = objHttpXMLVehiculos.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeVehiculos(unidadUsuario);
						 idCargaListadoVehiculos = setInterval("cerrarVentanaVehiculo()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}


function cerrarVentanaVehiculo(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoVehiculos == 1){
		clearInterval(idCargaListadoVehiculos);
		 top.Windows.closeAll();
	}
}


function activaVentanaIngresoFecha(boton){
	
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";	
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este Vehiculo :"
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo la Baja de este Vehiculo :"
}


function desactivaVentanaIngresoFecha(){
	
	activarBotones();
	document.getElementById("cubreVentanaPersonal").style.display = "none";
	document.getElementById("ventanaIngresoFecha").style.display  = "none";	
}


function aceptaFechaVentanaIngresoFecha(){
	
	var ultimaFechaCargo = document.getElementById("ultimaFecha").value;
	var tipo = document.getElementById("textTipo").value;
	var fecha = document.getElementById("textFechaVentanaFecha").value;
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	if (fecha == ""){
		alert("DEBE INDICAR UNA FECHA ....");
		return false;
	}
	
	
	var comparaFechaLimite = comparaFecha(fechaLimite,fecha)
		//alert(comparaFechaLimite);
	if (unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
	}
		
	var fechaMayor = comparaFecha(ultimaFechaCargo,fecha);
		//alert(fechaMayor);
	if (fechaMayor == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaCargo);
		return false;
	}
	
	
	document.getElementById("ventanaIngresoFecha").style.display  = "none";	
	document.getElementById("cubreVentanaPersonal").style.display = "none"; 
	
	
	if (tipo == 1) liberaVehiculo(document.getElementById("idVehiculo").value);
	if (tipo == 2) bajaVehiculo(document.getElementById("idVehiculo").value);
	
	
}




function liberaVehiculo(codigoVehiculo){
	
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACARÁ ESTE VEHICULO DE LA OFERTA DE LA UNIDAD.                                       \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		//var validaOk = validarFichaVehiculo();
		var validaOk = true;
		if (validaOk){
			//var codigoVehiculo	= document.getElementById("textPatente").value;
			parametros += "codigoVehiculo="+codigoVehiculo;
			parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
			
			//alert("traslado ---> " + parametros);
			
			var objHttpXMLVehiculos = new AJAXCrearObjeto();
			objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlLiberaVehiculo.php",true);
			objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpXMLVehiculos.send(encodeURI(parametros));
			
			objHttpXMLVehiculos.onreadystatechange=function()
			{
				if(objHttpXMLVehiculos.readyState == 4)
				{       
						if (objHttpXMLVehiculos.responseText != "VACIO"){
						//alert(objHttpXMLVehiculos.responseText);
						var xml = objHttpXMLVehiculos.responseXML.documentElement;
						for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
							var codigo = xml.getElementsByTagName('resultado')[i].text;
							if (codigo == 1){
								alert('EL VEHICULO FUE DEJADO DISPONIBLE PARA OTRA UNIDAD ......        ');
								top.leeVehiculos(unidadUsuario);
							 	idCargaListadoVehiculos = setInterval("cerrarVentanaVehiculo()",1000);
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
						}
					}
				}
			}
		}
	} else {
		activarBotones();
	}
}


function bajaVehiculo(codigoVehiculo){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACARÁ ESTE VEHICULO DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		
		parametros += "codigoVehiculo="+codigoVehiculo;
		parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
		
		//alert("baja ---> " + parametros);
		
		var objHttpXMLVehiculos = new AJAXCrearObjeto();
		objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlBajaVehiculo.php",true);
		objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLVehiculos.send(encodeURI(parametros));
		
		objHttpXMLVehiculos.onreadystatechange=function()
		{
			if(objHttpXMLVehiculos.readyState == 4)
			{       
				if (objHttpXMLVehiculos.responseText != "VACIO"){
					//alert(objHttpXMLVehiculos.responseText);
					var xml = objHttpXMLVehiculos.responseXML.documentElement;
					for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = xml.getElementsByTagName('resultado')[i].text;
						if (codigo == 1){
							alert('EL VEHICULO FUE DADO DE BAJA ......        ');
							top.leeVehiculos(unidadUsuario);
						 	idCargaListadoVehiculos = setInterval("cerrarVentanaVehiculo()",1000);
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
					}
				}
			}
		}
	} else {
		activarBotones();
	} 
	
	
	
}


function validarFichaVehiculo(){
	var patente				 = eliminarBlancos(document.getElementById("textPatente").value);
	var numeroInstitucional  = eliminarBlancos(document.getElementById("textNumeroInstitucional").value);
	var procedencia			 = document.getElementById("selProcedencia").value;
	var tipoVehiculo		 = document.getElementById("selTipoVehiculo").value;
	var marca				 = document.getElementById("selMarca").value;
	var modelo				 = document.getElementById("selModelo").value;
	var estado				 = document.getElementById("selEstado").value;
	var fechaEstado			 = document.getElementById("textFechaNuevoEstado").value;
	var numeroDocumento		 = eliminarBlancos(document.getElementById("textDocumentoNuevoEstado").value);
	var ultimaFechaEstado	 = document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	var lugarReparacion 	 = document.getElementById("selLugarReparacion").value;
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	var falla = document.getElementById("selTipoFalla").value;
	var estadoOculto = document.getElementById("estadoBaseDatos").value;
	var fallaOculta = document.getElementById("codFallaBaseDatos").value;
	
	var validaAnnoFab = document.getElementById("validaAnnoFab").value;
	var validaCheck = document.getElementById("validaAnnoFab");
	var validaAnnoOculto = document.getElementById("validaAnnoOculto").value;
	var annoFabricacion = document.getElementById("textAnnoFab").value;
	
	//alert(validaAnnoFab);
	//alert(lugarReparacion);
	//false;
	
	if (patente == "") {
		alert("DEBE INDICAR LA PATENTE DEL VEHICULO ...... 	     ");
		document.getElementById("textPatente").focus();
		return false;
	}
	
	if (numeroInstitucional == "") {
		alert("DEBE INDICAR EL NUMERO INSTITUCIONAL DEL VEHICULO ...... 	     ");
		document.getElementById("textNumeroInstitucional").focus();
		return false;
	}
	
	if (procedencia == 0) {
		alert("DEBE INDICAR LA PROCEDENCIA DEL VEHICULO ...... 	     ");
		document.getElementById("selProcedencia").focus();
		return false;
	}
	
	if (tipoVehiculo == 0) {
		alert("DEBE INDICAR EL TIPO DE VEHICULO ...... 	     ");
		document.getElementById("selTipoVehiculo").focus();
		return false;
	}	
	
	if (marca == 0) {
		alert("DEBE INDICAR LA MARCA DEL VEHICULO ...... 	     ");
		document.getElementById("selMarca").focus();
		return false;
	}	
	
	if (modelo == 0) {
		alert("DEBE INDICAR EL MODELO DEL VEHICULO ...... 	     ");
		document.getElementById("selModelo").focus();
		return false;
	}	
	
	if (estado == 0) {
		alert("DEBE INDICAR EL ESTADO DEL VEHICULO ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	//if(validaAnnoOculto != ""){
		
	if (!validaCheck.checked) {
	alert("DEBE VALIDAR EL AÑO DE FABRICACION DEL VEHICULO ...... 	     ");
		return false;	
	}
//}
	
 if (annoFabricacion < 1950 || annoFabricacion > 2018) {
		alert("EL AÑO DEBE SER UNA CIFRA ENTRE 1950 Y 2018 ...... 	     ");
		document.getElementById("textAnnoFab").focus();
		return false;
	}

	if(validaAnnoOculto==0){
		
	if (annoFabricacion == "" || annoFabricacion == 0) {
		alert("DEBE INDICAR EL AÑO DE FABRICACION DEL VEHICULO ...... 	     ");
		document.getElementById("textAnnoFab").focus();
		return false;

	}

}	
			//if ((estado == 10 && estadoOculto == 31 || estado == 10 && estadoOculto == 32) && falla == 0) {
		//alert("DEBE INDICAR LA FALLA DEL VEHICULO ...... 	     ");
		//document.getElementById("selEstado").focus();
		//return false;
	//}
	
	if ((estado == 31 || estado == 32) && falla == 0) {
		alert("DEBE INDICAR LA FALLA DEL VEHICULO ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	
	if (document.getElementById("selLugarReparacion").value == 0) document.getElementById("selLugarReparacion").value = "";
	if (document.getElementById("selTipoFalla").value == 0) document.getElementById("selTipoFalla").value = "";
	
	//alert (document.getElementById("selEstado").value + " != " + document.getElementById("estadoBaseDatos").value);
	//alert (document.getElementById("codigoUnidadAgregado").value + "!=" + document.getElementById("codUnidadAgregadoBaseDatos").value);
	//alert (document.getElementById("selLugarReparacion").value + "!=" + document.getElementById("codLugarReparacionBaseDatos").value);
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ||
		document.getElementById("codigoUnidadAgregado").value != document.getElementById("codUnidadAgregadoBaseDatos").value ||
		document.getElementById("selLugarReparacion").value != document.getElementById("codLugarReparacionBaseDatos").value ||
    document.getElementById("selTipoFalla").value != document.getElementById("codFallaBaseDatos").value){
	
		if (fechaEstado == ""  && document.getElementById("selEstado").value == ""){
			alert("DEBE INDICAR FECHA DEL NUEVO ESTADO ...... 	     ");
			return false;
		}else if(fechaEstado == "" && document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ){
				alert("DEBE INDICAR FECHA DEL NUEVO ESTADO ...... 	     ");
			return false;
		}
		
		if (estado == 30 && numeroDocumento == ""){
			alert("DEBE INDICAR DOCUMENTO EN QUE SE SOLICITA REPARACION.    ");
			document.getElementById("textDocumentoNuevoEstado").focus();
			return false;
		}
		
		if ((estado == 21 || estado == 31 || estado == 32 || estado == 70) && lugarReparacion == 0){
			alert("DEBE INDICAR LUGAR DE LA MANTENCION O REPARACION.    ");
			document.getElementById("selLugarReparacion").focus();
			return false;
		}
		
		var comparaFechaLimite = comparaFecha(fechaLimite,fechaEstado)
		//alert(comparaFechaLimite);
		if (unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
		}
		
		
		var fechaMayor = comparaFecha(ultimaFechaEstado,fechaEstado);
		if (fechaMayor == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado);
			return false;
		}
		
		
		if (estado == 3000 && codigoUnidadAgregado == ""){
			alert("DEBE INDICAR UNIDAD A LA QUE EL VEHICULO SE FUE AGREGADO...... 	     ");
			return false;
		}
	}
	
	//alert("ok");
	return true;
}


function verHistoriaVehiculo(codigoVehiculo){
	var pagina = "vistaHistoriaVehiculo.php?codigoVehiculo="+codigoVehiculo;
	top.abrirVentana('HISTORIA VEHICULO ... ', '750', '400', pagina, '', 'true', '100', '230');
}


function activaFechaNuevoEstado(){
	//alert(document.getElementById("selEstado").value);
	//alert(document.getElementById("estadoBaseDatos").value);
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		
		//PARA INGRESO DE DOCUMENTO
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
		//----------------------------
		
		//PARA INGRESO DE LUGAR DE REPARACION
		//alert(document.getElementById("selEstado").value);
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
		//----------------------------
		
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
		//PARA INGRESO DE FALLA DE VEHICULOS
		//alert(document.getElementById("selEstado").value);
		if (document.getElementById("selEstado").value == 31 || document.getElementById("selEstado").value == 32){
			document.getElementById("selTipoFalla").value = 0;
			document.getElementById("labTipoFalla").disabled= "";
			document.getElementById("selTipoFalla").disabled= "";
			document.getElementById("selTipoFalla").style.backgroundColor = "";
		} else {
			document.getElementById("selTipoFalla").value= "0";
			document.getElementById("selTipoFalla").disabled= "true";
			document.getElementById("labTipoFalla").disabled= "true";
			document.getElementById("selTipoFalla").style.backgroundColor = "#E6E6E6";
		}
		//----------------------------
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
		
		//PARA MOSTRAR LUGAR DE REPARACION
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
		//----------------------------
		
	 //PARA MOSTRAR FALLA
		if (document.getElementById("selEstado").value == 31 || document.getElementById("selEstado").value == 32){
			
			document.getElementById("labTipoFalla").disabled= "";
			
			document.getElementById("selTipoFalla").disabled= "";
			document.getElementById("selTipoFalla").value = document.getElementById("codFallaBaseDatos").value;
			document.getElementById("selTipoFalla").style.backgroundColor = "";
		} else {
			document.getElementById("selTipoFalla").value= "0";
			document.getElementById("selTipoFalla").disabled= "true";
			document.getElementById("labTipoFalla").disabled= "true";
			document.getElementById("selTipoFalla").style.backgroundColor = "#E6E6E6";
		}
		//----------------------------
		
		if (document.getElementById("selEstado").value == 3000){
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
	if (document.getElementById("selLugarReparacion").value != document.getElementById("codLugarReparacionBaseDatos").value){
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

function habilitarTipoFalla(){
	if (document.getElementById("selTipoFalla").value != document.getElementById("codFallaBaseDatos").value){
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
	//cargaListadoVehiculos = 0;
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoHistoricoVehiculo");
	//div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
    
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlVehiculoEstadoHistorico.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("vehiculoId="+vehiculoId)); 
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
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
										
					fecha	 		 	= xml.getElementsByTagName('fecha')[i].text;
					unidad	 		 	= xml.getElementsByTagName('unidad')[i].text;
					estado	 		 	= xml.getElementsByTagName('estado')[i].text;
											
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					//var dblClick = "javascript:abrirVentana('VEHICULO ...', '800', '270','fichaVehiculo.php?codigoVehiculo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
				
					listadoHistorico += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
					listadoHistorico += "<td width='140px' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoHistorico += "<td width='253px' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoHistorico += "<td width='292px' align='left'><div id='valorColumna'>"+unidad+"</div></td>";
					listadoHistorico += "</tr>";
				}
				listadoHistorico += "</table>";
				//alert(listadoHistorico);
				div.innerHTML = listadoHistorico;
				//cargaListadoVehiculos = 1;
			}
		}
	}
}


function leeUltimoKmVehiculo(codigoVehiculo){
	//alert(codigoVehiculo);
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlKmsVehiculo.php",false); //CONEXION SINCRONICA
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoVehiculo="+codigoVehiculo)); 
	
	var xml 		= objHttpXMLVehiculos.responseXML.documentElement;
	var codigo	 	= "";
	var kmVehiculo	= "";
	
	//alert(objHttpXMLVehiculos.responseText);						
	for(i=0;i<xml.getElementsByTagName('vehiculo').length;i++){
		codigo	   = xml.getElementsByTagName('codigo')[i].text;
		kmVehiculo = xml.getElementsByTagName('ultimoKilometraje')[i].text;
		return kmVehiculo;
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


function leeCatidadVehiculosPorTipo(unidad, tipoUnidad, tipoVehiculo, inicio){
	
	//alert("unidad : "+unidad+ "; tipoUnidad : "+tipoUnidad+"; tipoVehiculo : "+tipoVehiculo+"; inicio : "+inicio);

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoServicios");
	var contenidoPaso = div.innerHTML;
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
	document.getElementById("totalPersonal").innerHTML 	= "-";
	
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlCantidadVehiculos.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&tipoUnidad="+tipoUnidad+"&tipoVehiculo="+tipoVehiculo+"&inicio="+inicio));
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{       
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 			 		= objHttpXMLVehiculos.responseXML.documentElement;
				var codigoUnidad			= "";
				var descripcionUnidad		= "";
				var codigoTipo	 			= "";
				var descripcionTipo 		= "";
				var cantidadVehiculos 		= "";
				var cantidadActivos			= "";
				var cantidadMantencion		= "";
				var cantidadReparacion		= "";
				var cantidadProcesoBaja		= "";
				var cantidadTribunal		= "";
																		
				var sw 				 		= 0;
				var fondoLinea		 		= "";
				var resaltarLinea 	 		= "";
				var lineaSinResaltar 		= "";
				var listadoServicios 		= "";
				var sumCantidadVehiculos 	= 0;
				var sumCantidadActivos 	 	= 0;
				var sumCantidadMantencion 	= 0;
				var sumCantidadReparacion 	= 0;
				var sumCantidadPBaja 		= 0;
				var sumCantidadTribunal 	= 0;

								
				listadoServicios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('vehiculos').length;i++){
					
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigoUnidad	 	= xml.getElementsByTagName('codUnidad ')[i].text;
					descripcionUnidad	= xml.getElementsByTagName('desUnidad ')[i].text;
					codigoTipo	 		= xml.getElementsByTagName('codTipoVehiculo')[i].text;
					descripcionTipo		= xml.getElementsByTagName('desTipoVehiculo')[i].text;
					cantidadVehiculos	= xml.getElementsByTagName('cantidadVehiculos')[i].text;
					cantidadActivos		= xml.getElementsByTagName('cantidadActivos')[i].text;
					cantidadMantencion	= xml.getElementsByTagName('cantidadMantencion')[i].text;
					cantidadReparacion	= xml.getElementsByTagName('cantidadReparacion')[i].text;
					cantidadProcesoBaja	= xml.getElementsByTagName('cantidadProcesoBaja')[i].text;
					cantidadTribunal	= xml.getElementsByTagName('cantidadTribunal')[i].text;
										
					sumCantidadVehiculos 	+= cantidadVehiculos*1;
					sumCantidadActivos		+= cantidadActivos*1;
					sumCantidadMantencion	+= cantidadMantencion*1;
					sumCantidadReparacion	+= cantidadReparacion*1;
					sumCantidadPBaja 		+= cantidadProcesoBaja*1;
					sumCantidadTribunal		+= cantidadTribunal*1;
															
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					if (codigoUnidad == "") codigoUnidad = unidad;
					if (tipoUnidad == "nacional") var unidadHijo = "zona";					
					if (tipoUnidad == "zona") var unidadHijo = "prefectura";					
					if (tipoUnidad == "prefectura") var unidadHijo = "comisaria";
					if (tipoUnidad == "comisaria") var unidadHijo = "destacamento";
					
					inicio = 1;
					//if (typeof (unidadHijo) == "undefined")var dblClick = "javascript:abrirVentana('LISTADO PERSONAL ...', '995', '500','muestraListaPersonal.php?unidad="+codigoUnidad+"&grado="+descripcionGrado+"', '','','0','0')";
					//else var dblClick = "leeFuncionariosPorGrado('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+descripcionGrado+"','"+inicio+"')";
					
					//var dblClick = "leeCatidadVehiculosPorTipo('"+codigoUnidad+"','"+unidadHijo+"','"+codigoTipo+"','"+inicio+"')";
					
					//if (unidadHijo != "destacamento") var dblClick = "leeFuncionariosPorGrado('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+descripcionGrado+"','"+inicio+"')";
					//else var dblClick = "";
					
					if (typeof (unidadHijo) == "undefined")var dblClick = "javascript:abrirVentana('LISTADO VEHICULOS ...', '995', '500','muestraListaVehiculos.php?unidad="+codigoUnidad+"&tipoVehiculo="+tipoVehiculo+"', '','','0','0')";
					else var dblClick = "leeCatidadVehiculosPorTipo('"+codigoUnidad+"','"+unidadHijo+"','"+codigoTipo+"','"+inicio+"')";
															
					//if (correlativo == "") var dblClick = "leeServiciosAgregados('"+codigoUnidad+"','"+unidadHijo+"','"+codigoEscalafon+"','"+codigoGrado+"','"+inicio+"')";
					//if (correlativo != "") var dblClick = "javascript:abrirVentana('DETALLE SERVICIO ...', '995', '500','fichaServicio.php?unidad="+codigoUnidad+"&correlativo="+correlativo+"', '','','0','0')";
					//var dblClick = "";
					//alert();     
					if (descripcionUnidad == "") descripcionUnidad = "NIVEL NACIONAL";
									
					listadoServicios += "<tr id='trNro"+i+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoServicios += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoServicios += "<td width='30%'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
					listadoServicios += "<td width='23%'><div id='valorColumna'>"+descripcionTipo.toUpperCase()+"</div></td>";
					listadoServicios += "<td width='7%' align='right'><div id='valorColumna'>"+formato_numero(cantidadActivos,0,',','.')+"</div></td>";
					listadoServicios += "<td width='7%' align='right'><div id='valorColumna'>"+formato_numero(cantidadMantencion,0,',','.')+"</div></td>";
					listadoServicios += "<td width='7%' align='right'><div id='valorColumna'>"+formato_numero(cantidadReparacion,0,',','.')+"</div></td>";
					listadoServicios += "<td width='7%' align='right'><div id='valorColumna'>"+formato_numero(cantidadProcesoBaja,0,',','.')+"</div></td>";
					listadoServicios += "<td width='7%' align='right'><div id='valorColumna'>"+formato_numero(cantidadTribunal,0,',','.')+"</div></td>";
					listadoServicios += "<td width='7%' align='right'><div id='valorColumna'>"+formato_numero(cantidadVehiculos,0,',','.')+"</div></td>";
					listadoServicios += "</tr>";
					//alert(listadoServicios);
				}
				listadoServicios += "</table>";
				
								
				//alert(listadoServicios);
				//alert();
				div.innerHTML = listadoServicios;
				document.getElementById("totalPersonal").innerHTML = formato_numero(sumCantidadVehiculos,0,',','.');
				document.getElementById("totalActivos").innerHTML = formato_numero(sumCantidadActivos,0,',','.');
				document.getElementById("totalMantencion").innerHTML = formato_numero(sumCantidadMantencion,0,',','.');
				document.getElementById("totalReparacion").innerHTML = formato_numero(sumCantidadReparacion,0,',','.');
				document.getElementById("totalPBaja").innerHTML = formato_numero(sumCantidadPBaja,0,',','.');
				document.getElementById("totalTribunal").innerHTML = formato_numero(sumCantidadTribunal,0,',','.');
																
				//document.getElementById("totalVehiculos").innerHTML = formato_numero(sumCantidadVehiculos,0,',','.');
				
				cargaListadoServicios = 1;
			} else {
				div.innerHTML = contenidoPaso;    
				eval("javascript:abrirVentana('LISTADO VEHICULOS ...', '995', '500','muestraListaVehiculos.php?unidad="+unidad+"&tipoVehiculo="+tipoVehiculo+"', '','','0','0')");
				//div.innerHTML = "";
				//alert("NO EXISTEN SERVICIOS POLICIALES REGISTRADOS PARA LA FECHA INDICADA.     ");
				//cargaListadoServicios = 1;
			}
		}
	}
}

function muestraListaVehiculos(unidad, tipoVehiculo){
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("kk");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Vehiculos ......</td>";
	
	var campoOrden = "nombre";
    
	objHttpXMLVehiculos.open("POST","./xml/xmlVehiculos/xmlListaVehiculos.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoUnidad="+unidad+"&tipoVehiculo="+tipoVehiculo));  
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		//alert(objHttpXMLVehiculos.readyState);
		if(objHttpXMLVehiculos.readyState == 4)
		{       
			//alert(objHttpXMLVehiculos.responseText);
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);		
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 			= "";
				var tipoVehiculo		= "";
				var patente		 		= "";
				var bcu		 			= "";
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
										
					codigo	 		= xml.getElementsByTagName('codigo')[i].text;
					tipoVehiculo	= xml.getElementsByTagName('tipo')[i].text;
					patente		 	= xml.getElementsByTagName('patente')[i].text;
					bcu		 	 	= xml.getElementsByTagName('bcu')[i].text;
					estado	 	 	= xml.getElementsByTagName('estado')[i].text;
										
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada2')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
										
					var nroLinea = i + 1;
					//var dblClick = "javascript:abrirVentana('FUNCIONARIO', '800', '315','fichaPersonal.php?codigoFuncionario="+codigo+"','"+nroLinea+"','','5','5')";
					var dblClick = "";
				
					//alert(dblClick);
				
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='41%'><div id='valorColumna'>"+tipoVehiculo+"</div></td>";
					listadoVehiculos += "<td width='10%'><div id='valorColumna'>"+patente+"</div></td>";
					listadoVehiculos += "<td width='21%' align='left'><div id='valorColumna'>"+bcu+"</div></td>";
					listadoVehiculos+= "<td width='23%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos += "</tr>";
				}
				listadoVehiculos += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoVehiculos;
			}
		}
	}
}


function activaBuscaUnidadAgregado(){
	desactivarBotones();
	
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}

function ValidaSoloNumeros() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}