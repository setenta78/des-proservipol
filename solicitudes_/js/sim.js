var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionarios(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando SIMCCAR ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlSim/xmlListaFuncionarios.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));  
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var serie	 			= "";
				var tarjeta		= "";
				var imei		= "";
				
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('serie')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('tarjeta')[i].text;
					imei		 	 = xml.getElementsByTagName('imei')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					codUnidadAgregado	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
				  desUnidadAgregado	= xml.getElementsByTagName('desUnidadAgregado')[i].text;
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('SIMCCAR', '790', '340','fichaSimccar.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
				if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
						if(estado=="REPARACION SIN DEVOLUCION"){
					var color="red";   
        }else if(estado=="REPARACION CON DEVOLUCION"){
        	var color="blue";
        	}else{
        		var color="";
        		}
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='38%'><font color="+color+"><div id='valorColumna'>"+tarjeta+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
				//mensajeUsuario();
			}
		}
	}
}

var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionariosAgregados(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando SIMCCAR Agregados ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlSim/xmlListaSimccarAgregados.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));  
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var serie	 			= "";
				var tarjeta		= "";
				var imei		= "";
				
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('serie')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('tarjeta')[i].text;
					imei		 	 = xml.getElementsByTagName('imei')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					codUnidadAgregado	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
				  desUnidadAgregado	= xml.getElementsByTagName('desUnidadAgregado')[i].text;
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('SIMCCAR', '790', '340','fichaSimccar.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
				if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='38%'><div id='valorColumna'>"+tarjeta+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
				//mensajeUsuario();
			}
		}
	}
}

function leedatosDioscar(codigo,serieSimccar,tipo){

	//alert(codigoUnidad);
	//alert(mes);
	//alert();
	//alert(codigo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlSim/xmlDatosDioscar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigo="+codigo+"&serieSimccar="+serieSimccar)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
			  //alert(objHttpXMLFuncionarios.responseText);		
				var xml 				  = objHttpXMLFuncionarios.responseXML.documentElement;
				var unidad	 			  = "";
				var codigo	  = "";
				var serie  = "";
				var tarjeta 	  = "";
				var imei 	  = "";
				var codigoUnidadAgregado  = "";
        var desUnidadAgregado  	  = "";
        var fechaEstado			  = "";
				var estado				  = "";
				var origen ="";
				var verifica ="";
				var unidadVehiculo ="";
				var descUnidadVehiculo	  = "";
				
				var marca ="";
				var modelo ="";
				var anno ="";

        
        
				
								
				for(i=0;i<xml.getElementsByTagName('dioscar').length;i++){

			 unidad	 			 = xml.getElementsByTagName('unidad')[i].text;
			 codigo	 = xml.getElementsByTagName('codigo')[i].text;
			 serie = xml.getElementsByTagName('serie')[i].text;
			 tarjeta 	 = xml.getElementsByTagName('tarjeta')[i].text;
      imei 	 = xml.getElementsByTagName('imei')[i].text;
			 estado 	 = xml.getElementsByTagName('estado')[i].text;
	 fechaEstado 	 = xml.getElementsByTagName('fechaEstado')[i].text;
			 origen	 = xml.getElementsByTagName('origen')[i].text;
				 verifica 	 = xml.getElementsByTagName('verifica')[i].text;
				 unidadVehiculo	 			 = xml.getElementsByTagName('unidad')[i].text;
					  codigoUnidadAgregado 	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
          desUnidadAgregado 		= xml.getElementsByTagName('desUnidadAgregado')[i].text;
       descUnidadVehiculo 		= xml.getElementsByTagName('descUnidad')[i].text;   
        
        marca 	 = xml.getElementsByTagName('marca')[i].text;
        modelo 	 = xml.getElementsByTagName('modelo')[i].text;
        anno 	 = xml.getElementsByTagName('anno')[i].text;



					//document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
	if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					
					//alert(descUnidadVehiculo);
					document.getElementById("textNumeroBCU").readOnly 		     = "true";	
					document.getElementById("textNumeroBCU").value	=serie;
					document.getElementById("textNombre").value	=tarjeta;
				  document.getElementById("textRaza").value	=imei;
					document.getElementById("ultimaFecha").value	=fechaEstado;
					//document.getElementById("selTipoAnimal").value	=bandas;
					document.getElementById("idVehiculo").value	=codigo;
						document.getElementById("codigoOculto").value	=codigo;
						document.getElementById("verificaOculto").value	=verifica;
											document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
								
								document.getElementById("textFechaNacimiento").value	=marca;	
								document.getElementById("selTipoAnimal").value	=modelo;
								document.getElementById("selColor").value	=anno;		
											
											
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					if(origen == ""){
					document.getElementById("selOrigen").value =0;
				}else{
					document.getElementById("selOrigen").value	=origen;
					}
				

					
			 if(document.getElementById("verificaOculto").value == "SI"){
				    	 document.getElementById("verificar").checked="true"; 
				    	 document.getElementById("verificar").disabled="true"; 
				    	 document.getElementById("labConfirmar").disabled=""; 
				    	 document.getElementById("labConfirmar").innerHTML = "VERIFICADO"; 
				    	 document.getElementById("selOrigen").disabled = ""; 
				}else{
				    	 document.getElementById("verificar").checked=""; 
				    	 document.getElementById("verificar").disabled=""; 
				    	 document.getElementById("verificar").disabled=""; 
				
				}
					
				//alert();
							if (unidad == "") var habilitarBotones = false;
					else var habilitarBotones = true;

					
         document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;			
         
				 var valoresAsignar = "'" + estado + "'," + habilitarBotones;    

					idAsignaSelectFichaVehiculo = setInterval("asignaValores("+valoresAsignar+")",500); 
					
										if (tipo == "1"){
						document.getElementById("btnBuscarSimccar").value = "BUSCAR";
						document.getElementById("btnBuscarSimccar").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadVehiculo){
							alert("ESTE SIMCCAR YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaPersonal();
						}
						
						if (unidadUsuario != unidadVehiculo && unidadVehiculo != ""){
							alert("NO PUEDE AGREGAR ESTE SIMCCAR,\nYA QUE PERTENECE A LA " +descUnidadVehiculo+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaPersonal();
						} 
					}
	}
	//document.getElementById("mensajeCargando").style.display = "none";
}else {	
				if (document.getElementById("btnBuscarSimccar").value == "BUSCANDO ..."){   
					document.getElementById("mensajeCargando").style.display = "none";
					alert ("NO EXISTE ...");
					document.getElementById("textNumeroBCU").focus();
					document.getElementById('btnBuscarSimccar').disabled = "";
					document.getElementById("textNumeroBCU").value = "";
				}
				document.getElementById("btnBuscarSimccar").value = "BUSCAR";
				//document.getElementById("btnBuscarSimccar").disabled = "";
		}
  }
 }
}

function asignaValores(estado, habilitarBotones){
	//alert("asignaficha");
	if (cargaEstadosRecurso == 1 ){
		clearInterval(idAsignaSelectFichaVehiculo);
			//alert("asignaficha2");
		
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value 			= estado;
		document.getElementById("estadoBaseDatos").value 	= estado;
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden"; 

		
		activaFechaNuevoEstado();
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
			document.getElementById('btnBaja').disabled = "true";
		} else {
			//alert("acax");
			document.getElementById("labFechaEstado").disabled= "";
			document.getElementById("textFechaNuevoEstado").disabled= "";
			document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
			document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
			document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden"; 
		}
		
		document.getElementById('btnGuardarOrganizacion').disabled = "";
		document.getElementById('btnCerrarFichaFuncionario').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none"; 
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden"; 
		
	}
}

function buscaDatosSimccar(){
	
	var serieSimccar	= eliminarBlancos(document.getElementById("textNumeroBCU").value);
	if (serieSimccar == ""){
		alert("DEBE INDICAR EL NUMERO DE SERIE DEL SIMCCAR ...... 	     ");
		document.getElementById("textNumeroBCU").value="";
		document.getElementById("textNumeroBCU").focus();
		return false;
	} else {
		document.getElementById("btnBuscarSimccar").value = "BUSCANDO ...";
		document.getElementById("btnBuscarSimccar").disabled = "true";
		buscaDatosSimccar2();	
	}
}

function buscaDatosSimccar2(){

		//var unidad= document.getElementById("unidadUsuario").value;

	//alert(unidad);

	var serieSimccar	= eliminarBlancos(document.getElementById("textNumeroBCU").value);
	//alert(serieSimccar);
	if (serieSimccar != "") leedatosDioscar('',serieSimccar,1);	
	//cerrarVentanaPersonal();
//	if (serieSimccar != "") leeDatosArmaPorSerie(serieSimccar);
}

function leedatosDioscar2(codigo,serieSimccar,tipo){

	//alert(codigoUnidad);
	//alert(mes);
	//alert();
	//alert(codigo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlSim/xmlDatosDioscar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigo="+codigo+"&serieSimccar="+serieSimccar)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
			  //alert(objHttpXMLFuncionarios.responseText);		
				var xml 				  = objHttpXMLFuncionarios.responseXML.documentElement;
				var unidad	 			  = "";
				var codigo	  = "";
				var serie  = "";
				var tarjeta 	  = "";
				var imei 	  = "";
				var codigoUnidadAgregado  = "";
        var desUnidadAgregado  	  = "";
        var fechaEstado			  = "";
				var estado				  = "";
				var origen ="";
				var verifica ="";
				var unidadVehiculo ="";
				var descUnidadVehiculo	  = "";
				
		    var marca ="";
				var modelo ="";
				var anno ="";

        
        
				
								
				for(i=0;i<xml.getElementsByTagName('dioscar').length;i++){

				 unidad	 			      = xml.getElementsByTagName('unidad')[i].text;
				 codigo	              = xml.getElementsByTagName('codigo')[i].text;
				 serie                = xml.getElementsByTagName('serie')[i].text;
				 tarjeta 	            = xml.getElementsByTagName('tarjeta')[i].text;
         imei 	              = xml.getElementsByTagName('imei')[i].text;
				 estado 	            = xml.getElementsByTagName('estado')[i].text;
		     fechaEstado 	        = xml.getElementsByTagName('fechaEstado')[i].text;
				 origen	              = xml.getElementsByTagName('origen')[i].text;
				 verifica 	          = xml.getElementsByTagName('verifica')[i].text;
				 unidadVehiculo	      = xml.getElementsByTagName('unidad')[i].text;
				 codigoUnidadAgregado = xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
         desUnidadAgregado 		= xml.getElementsByTagName('desUnidadAgregado')[i].text;
         descUnidadVehiculo 	= xml.getElementsByTagName('descUnidad')[i].text;   
        marca 	 = xml.getElementsByTagName('marca')[i].text;
        modelo 	 = xml.getElementsByTagName('modelo')[i].text;
        anno 	 = xml.getElementsByTagName('anno')[i].text;


					//document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
	if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					
					//alert(descUnidadVehiculo);
					//document.getElementById("textNumeroBCU").readOnly 		     = "true";	
					document.getElementById("textNumeroBCU2").value	=serie;
					document.getElementById("textNombre2").value	=tarjeta;
				  document.getElementById("textRaza2").value	=imei;
					//document.getElementById("textFechaNacimiento").value	=mes;
					//document.getElementById("selTipoAnimal").value	=bandas;
					document.getElementById("idVehiculo").value	=codigo;
						document.getElementById("verificaOculto").value	=verifica;
											document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					
						document.getElementById("textFechaNacimiento2").value	=marca;	
					
	document.getElementById("ultimaFecha2").value	=fechaEstado;	
								document.getElementById("selTipoAnimal2").value	=modelo;
								document.getElementById("selColor2").value	=anno;	
					if(origen == ""){
					document.getElementById("selOrigen2").value =0;
				}else{
					document.getElementById("selOrigen2").value	=origen;
					}
				

					
			 if(document.getElementById("verificaOculto").value == "SI"){
				    	 document.getElementById("verificar").checked="true"; 
				    	 document.getElementById("verificar").disabled="true"; 
				    	 document.getElementById("labConfirmar").disabled=""; 
				    	 document.getElementById("labConfirmar").innerHTML = "VERIFICADO"; 
				    	 document.getElementById("selOrigen").disabled = "true"; 
				}else{
				    	 document.getElementById("verificar").checked=""; 
				    	 document.getElementById("verificar").disabled=""; 
				    	 document.getElementById("verificar").disabled=""; 
				
				}
					
				//alert();
							if (unidad == "") var habilitarBotones = false;
					else var habilitarBotones = true;

					
         document.getElementById("labFechaCargoDesde2").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;			
         
				 var valoresAsignar = "'" + estado + "'," + habilitarBotones;    

					idAsignaSelectFichaVehiculo2 = setInterval("asignaValores2("+valoresAsignar+")",500); 
					//alert(tipo);
										if (tipo == "1"){
						document.getElementById("btnBuscarSimccar2").value = "BUSCAR";
						document.getElementById("btnBuscarSimccar2").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadVehiculo){
							alert("ESTE SIMCCAR YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaPersonal();
						}
						//alert(unidadUsuario);
						//alert(unidadVehiculo);
						if (unidadUsuario != unidadVehiculo && unidadVehiculo != ""){
							alert("NO PUEDE UTILIZAR COMO REEMPLAZO ESTE SIMCCAR,\nYA QUE PERTENECE A LA " +descUnidadVehiculo+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaPersonal();
						} 
					}
	}
	//document.getElementById("mensajeCargando").style.display = "none";
}else {	
				if (document.getElementById("btnBuscarSimccar2").value == "BUSCANDO ..."){   
					document.getElementById("mensajeCargando").style.display = "none";
					alert ("NO EXISTE ...");
					//document.getElementById("textNumeroBCU2").focus();
					cerrarVentanaPersonal();
				}
				document.getElementById("btnBuscarSimccar2").value = "BUSCAR";
				//document.getElementById("btnBuscarSimccar").disabled = "";
		}
  }
 }
}

function asignaValores2(estado, habilitarBotones){
	if (cargaEstadosRecurso == 1 ){
		clearInterval(idAsignaSelectFichaVehiculo2);
		
		if (estado == "") estado = 0;
		document.getElementById("selEstado2").value 			= estado;
		document.getElementById("estadoBaseDatos2").value 	= estado;
		

		
		activaFechaNuevoEstado2();
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
			document.getElementById('btnBaja').disabled = "true";
		} else {
			document.getElementById("labFechaEstado2").disabled= "";
			document.getElementById("textFechaNuevoEstado2").disabled= "";
			document.getElementById("imagenCalendarioFichaVehiculo2").style.visibility = "visible"; 
			document.getElementById("textFechaNuevoEstado2").style.backgroundColor = "";
		}
		document.getElementById("imagenCalendarioFichaVehiculo2").style.visibility = "hidden"; 
		document.getElementById('btnGuardarOrganizacion').disabled = "";
		document.getElementById('btnCerrarFichaFuncionario').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none"; 
		
	}
}

function buscaDatosSimccarExt(){
	
	var serieSimccar	= eliminarBlancos(document.getElementById("textNumeroBCU2").value);
	if (serieSimccar == ""){
		alert("DEBE INDICAR EL NUMERO DE SERIE DEL SIMCCAR DE REEMPLAZO ...... 	     ");
		document.getElementById("textNumeroBCU2").value="";
		document.getElementById("textNumeroBCU2").focus();
		return false;
	} else {
		document.getElementById("btnBuscarSimccar2").value = "BUSCANDO ...";
		document.getElementById("btnBuscarSimccar2").disabled = "true";
		leedatosDioscar2('',serieSimccar,1);		
	}
}




function nuevoDioscar(){
	
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("textNumeroBCU").value;
	var mes	= document.getElementById("textNombre").value;
	var fecha =document.getElementById("textRaza").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
  var codigoVehiculo 		= document.getElementById("idVehiculo").value;
  //var codigo = document.getElementById("textNombre").value; 
	var codigo = document.getElementById("idVehiculo").value; 
	
	var origen = document.getElementById("selOrigen").value; 
	var verificaOculto = document.getElementById("verificaOculto").value; 
	var verificar = document.getElementById("verificar").value; 

			
	var parametros = "";
	
	parametros += "unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&mes="+mes;
	parametros += "&fecha="+fecha+"&codigoVehiculo="+codigoVehiculo+"&codigo="+codigo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado;
	parametros += "&origen="+origen+"&verificaOculto="+verificaOculto+"&verificar="+verificar;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlSim/xmlNuevoDioscar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function actualizaDioscar(){
	
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	
	var codigoVehiculo 		= document.getElementById("idVehiculo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
	var numeroBCU			= document.getElementById("textNumeroBCU").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value; 
	
	var tarjeta = document.getElementById("textNombre").value;
  var imei = document.getElementById("textRaza").value;
 	var marca = document.getElementById("textFechaNacimiento").value;
 	var modelo = document.getElementById("selTipoAnimal").value;
 	var anno = document.getElementById("selColor").value;
 	
	var origen = document.getElementById("selOrigen").value; 
	var verificaOculto = document.getElementById("verificaOculto").value; 
	var verificar = document.getElementById("verificar").value; 
		
		if(estado==130){
				var codigo = document.getElementById("codigoOculto").value; 
				//var reemplazo = document.getElementById("codigoOculto").value; 
			}else{
		var codigo = document.getElementById("idVehiculo").value; 

	}
			var reemplazo = document.getElementById("idVehiculo").value;
   //alert(reemplazo);

  //alert(codigoVehiculo);
  var parametros = "";
	
	parametros += "estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado+"&codigoVehiculo ="+codigoVehiculo;
	parametros += "&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado+"&codigo="+codigo;
	parametros += "&origen="+origen+"&verificaOculto="+verificaOculto+"&verificar="+verificar;
	parametros += "&tarjeta="+tarjeta+"&imei="+imei+"&marca="+marca+"&modelo="+modelo+"&anno="+anno+"&reemplazo="+reemplazo;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlSim/xmlActualizaCaballo.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function actualizaReemplazo(){
	
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	
	var codigoVehiculo 		= document.getElementById("idVehiculo").value;
	var estado2				= document.getElementById("selEstado2").value;
	var fechaNuevoEstado2	= document.getElementById("textFechaNuevoEstado2").value;
	var numeroBCU2			= document.getElementById("textNumeroBCU2").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value; 
	var codigo2 = document.getElementById("idVehiculo").value; 
	
	var origen = document.getElementById("selOrigen").value; 
	var verificaOculto = document.getElementById("verificaOculto").value; 
	var verificar = document.getElementById("verificar").value; 
	
	var tarjeta2 = document.getElementById("textNombre2").value;
  var imei2 = document.getElementById("textRaza2").value;
  var marca2 = document.getElementById("textFechaNacimiento2").value;
  var modelo2 = document.getElementById("selTipoAnimal2").value;
  var anno2 = document.getElementById("selColor2").value;

  //alert(codigoVehiculo);
  var parametros = "";
	
	parametros += "estado2="+estado2+"&fechaNuevoEstado2="+fechaNuevoEstado2+"&codigoVehiculo ="+codigoVehiculo;
	parametros += "&numeroBCU2="+numeroBCU2+"&codigoUnidadAgregado="+codigoUnidadAgregado+"&codigo2="+codigo2;
	parametros += "&origen="+origen+"&verificaOculto="+verificaOculto+"&verificar="+verificar;
	parametros += "&tarjeta2="+tarjeta2+"&imei2="+imei2+"&marca2="+marca2+"&modelo2="+modelo2+"&anno2="+anno2;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlSim/xmlReemplazaSimccar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI(parametros));
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 //idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
						 llamaFalla();
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function cerrarVentanaPersonal(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		 top.cerrarVentana();
	}
}
			
function cerrarVentanaVehiculo(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoVehiculos == 1){
		clearInterval(idCargaListadoVehiculos);
		 top.Windows.closeAll();
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
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardarOrganizacion").disabled = "";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "";
}

function activaBuscaUnidadAgregado(){
	desactivarBotones();
	
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}

function activaBuscaUnidadAgregado2(){
	desactivarBotones();
	
	document.getElementById("cubreVentanaPersonal2").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad2").style.display = "";
}

function activaVentanaIngresoFecha(boton){
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";	
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este SIMCCAR :"
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectiva la Baja de este SIMCCAR :"
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
	
	var codigoVehiculo = document.getElementById("idVehiculo").value; 
	
	var cantidadServicio = controlEstadoSimccar(codigoVehiculo,fecha,'01-01-3000');
	
	//alert(codigoVehiculo);
	
	 if(cantidadServicio == 1){
	 	//alert("DEBE INDICAR UNA FECHA ....");
    //        cerrarVentanaPersonal();
            return false;
        } 
	
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

			
	
function cerrarVentanaPersonal(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		 top.cerrarVentana();
	}
}

function validaNumeros(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function validarFichaFuncionario(){
 
	var mes	= document.getElementById("textNumeroBCU").value;
	var bandas	= document.getElementById("textNombre").value;
	var infra3	= document.getElementById("textRaza").value;
	var fisc3	= document.getElementById("textFechaNacimiento").value;
	
	var estado				 = document.getElementById("selEstado").value;
	var fechaEstado			 = document.getElementById("textFechaNuevoEstado").value;
	var ultimaFechaEstado	 = document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
		var validaCheck = document.getElementById("verificar");
			var origen = document.getElementById("selOrigen").value;
				var codigoVehiculo = document.getElementById("idVehiculo").value; 
					var verificaOculto = document.getElementById("verificaOculto").value;
var estado2				 = document.getElementById("selEstado2").value;
	var fechaEstado2			 = document.getElementById("textFechaNuevoEstado2").value;
	var estadoActual	= document.getElementById("estadoBaseDatos").value;
	var estadoActual2	= document.getElementById("estadoBaseDatos2").value;
		var ultimaFechaEstado2	 = document.getElementById("ultimaFecha2").value;

	if (estado == 0) {
		alert("DEBE INDICAR EL ESTADO DEL SIMCCAR ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	if(estado==130 && estadoActual==10){
		if (estado2 == 0) {
		alert("DEBE INDICAR EL ESTADO DEL SIMCCAR DE REEMPLAZO ...... 	     ");
		document.getElementById("selEstado2").focus();
		return false;
	}
}

//	if (mes == 0){
//		alert("DEBE INDICAR EL No. DE SERIE ...... 	     ");
//		document.getElementById("textNumeroBCU").focus();
//		return false;
//	}
	
//		if (bandas == ""){
//		alert("DEBE INDICAR el No. DE TARJETA ...... 	     ");
//		document.getElementById("textNombre").focus();
//		return false;
//	}
	
//		if (infra3 == ""){
//		alert("DEBE INDICAR EL IMEI...... 	     ");
//		document.getElementById("textRaza").focus();
//		return false;
//	}
	
//		if ((!validaCheck.checked)||(estado2!=0 && fechaEstado2!="")) {
//	alert("DEBE VERIFICAR EL ESTADO DEL SIMCCAR ...... 	     ");

//		return false;	
//	}

	
	//if(origen==0){
	//	alert("DEBE INGRESAR EL ORIGEN DEL SIMCCAR ...... 	     ");
	//	document.getElementById("selOrigen").focus();
	//return false;	

//}
//alert(fechaEstado);
if((estado!=estadoActual)&&(estado2==0 && fechaEstado2=="")){
	//if((codigoVehiculo !="" && verificaOculto == "SI")||(codigoVehiculo !="" && verificaOculto == "NO")){
	     var cantidadServicio = controlEstadoSimccar(codigoVehiculo,fechaEstado,'01-01-3000');
        //alert(cantidadServicio);  
        if(cantidadServicio == 1){
            return false;
        }  
	//}
}	
//alert(fechaEstado2);
//if(estado2!=estadoActual2){

//	     var cantidadServicio2 = controlEstadoSimccar(codigoVehiculo,fechaEstado2,'01-01-3000');
        //alert(cantidadServicio2);  
//        if(cantidadServicio2 == 1){
//            return false;
//        }  
//	}

		//if (fisc3 == ""){
		//alert("DEBE LLENAR EL CAMPO ...... 	     ");
		//document.getElementById("textFechaNacimiento").focus();
		//return false;
	//}
	
		if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ||
	document.getElementById("codigoUnidadAgregado").value != document.getElementById("codUnidadAgregadoBaseDatos").value){
	
	if(estado!=estadoActual && fechaEstado2==""){	
		if (fechaEstado == ""){
			alert("DEBE INDICAR FECHA DEL NUEVO ESTADO  ...... 	     ");
			return false;
		}
	}

	

	if(estado!=estadoActual){	
		var comparaFechaLimite = comparaFecha(fechaLimite,fechaEstado)
		//alert(comparaFechaLimite);
		if (unidadBloqueada == 1 && comparaFechaLimite == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
			return false;
		}
}		
		
if(estado!=estadoActual){		
	//alert(ultimaFechaEstado);	
	//alert(fechaEstado);
	var fechaMayor = comparaFecha(ultimaFechaEstado,fechaEstado);
	//alert(fechaMayor);
		if (fechaMayor == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado);
			return false;
		}
}	

if(estado2!=estadoActual2){		
	//alert(ultimaFechaEstado);	
	//alert(fechaEstado);
	var fechaMayor2 = comparaFecha(ultimaFechaEstado2,fechaEstado2);
	//alert(fechaMayor);
		if (fechaMayor2 == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado2);
			return false;
		}
}			
		
		
		if (estado == 3000 && codigoUnidadAgregado == ""){
			alert("DEBE INDICAR UNIDAD A LA QUE EL VEHICULO SE FUE AGREGADO...... 	     ");
			return false;
		}
	}
	

	return true;
}



function guardarFichaCaballo(codigoVehiculo){
	desactivarBotones();
	var validaOk = validarFichaFuncionario();
	
	var codigoVehiculo = document.getElementById("idVehiculo").value;
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SIMCCAR EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaDioscar();
			//else return false;
			else activarBotones();
		}
		else {
			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS DE ESTA SIMCCAR EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoDioscar();
			//else return false;
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}

function guardarFichaReemplazo(codigoVehiculo){
	desactivarBotones();
	var validaOk = validarFichaFuncionario();
	
	var codigoVehiculo = document.getElementById("idVehiculo").value;
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SIMCCAR EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaReemplazo();
			//else return false;
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}

function liberaVehiculo(codigoVehiculo){
	//alert();
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACARA ESTA SIMCCAR DE LA OFERTA DE LA UNIDAD.                                       \n\u00BFDESEA CONTINUAR?...");
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
			objHttpXMLVehiculos.open("POST","./xml/xmlSim/xmlLiberaAnimal.php",true);
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
								alert('EL SIMCCAR FUE DEJADO DISPONIBLE PARA OTRA UNIDAD ......        ');
								top.leeFuncionarios(unidadUsuario);
							 	idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
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
	var msj=confirm("SACARÁ ESTE SIMCCAR DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		
		parametros += "codigoVehiculo="+codigoVehiculo;
		parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
		
		//alert("baja ---> " + parametros);
		
		var objHttpXMLVehiculos = new AJAXCrearObjeto();
		objHttpXMLVehiculos.open("POST","./xml/xmlSim/xmlBajaAnimal.php",true);
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
							alert('EL SIMCCAR FUE DADO DE BAJA ......        ');
							top.leeFuncionarios(unidadUsuario);
						 	idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
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


function activaFechaNuevoEstado(){
	//alert(document.getElementById("selEstado").value);
	//alert(document.getElementById("estadoBaseDatos").value);
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value){
		//alert("aca");
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
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
		//alert("aca no");
		document.getElementById("labFechaEstado").disabled= "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
		
		document.getElementById("labDocumentoEstado").disabled = true;
		document.getElementById("textDocumentoNuevoEstado").value = "";
		document.getElementById("textDocumentoNuevoEstado").disabled = true;
		document.getElementById("textDocumentoNuevoEstado").style.backgroundColor = "#E6E6E6";
		

		
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
/*			
	if (document.getElementById("selEstado").value == 30 && (document.getElementById("estadoBaseDatos").value) !=30){
		alert("INDIQUE LAS FALLAS QUE PRESENTO EL VEHICULO");
		cambiaPaginaFallas();
		return false;
	}
*/		
}

function activaFechaNuevoEstado2(){
	//alert(document.getElementById("selEstado").value);
	//alert(document.getElementById("estadoBaseDatos").value);
	if (document.getElementById("selEstado2").value != document.getElementById("estadoBaseDatos2").value){
		document.getElementById("labFechaEstado2").disabled= "";
		document.getElementById("textFechaNuevoEstado2").disabled= "";
		document.getElementById("imagenCalendarioFichaVehiculo2").style.visibility = "visible"; 
		document.getElementById("textFechaNuevoEstado2").style.backgroundColor = "";

	
		//----------------------------
	} else {
		document.getElementById("labFechaEstado2").disabled= "true";
		document.getElementById("textFechaNuevoEstado2").disabled= "true";
		document.getElementById("imagenCalendarioFichaVehiculo2").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado2").value = "";
		document.getElementById("textFechaNuevoEstado2").style.backgroundColor = "#E6E6E6";
		
		document.getElementById("labDocumentoEstado2").disabled = true;
		document.getElementById("textDocumentoNuevoEstado2").value = "";
		document.getElementById("textDocumentoNuevoEstado2").disabled = true;
		document.getElementById("textDocumentoNuevoEstado2").style.backgroundColor = "#E6E6E6";
		

		

	}
/*			
	if (document.getElementById("selEstado").value == 30 && (document.getElementById("estadoBaseDatos").value) !=30){
		alert("INDIQUE LAS FALLAS QUE PRESENTO EL VEHICULO");
		cambiaPaginaFallas();
		return false;
	}
*/		
}


function controlEstadoSimccar(codigoVehiculo,fecha1,fecha2){ 
    
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlServicios/xmlListaServiciosPorSimccar.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("codigoVehiculo="+codigoVehiculo+"&fecha1="+fecha1+"&fecha2="+fecha2));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	mensaje += "NO PUEDE CAMBIAR DE ESTADO, PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
        if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
        else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	var fecha 		         = xml.getElementsByTagName('fecha')[i].text;
		         var servicio 	         = xml.getElementsByTagName('desServicio')[i].text;
		         var unidad 	         	= xml.getElementsByTagName('desUnidad')[i].text;
		               
		        	mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
			}
			if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
			alert(mensaje);
			return 1;
	}     
}

function cambiaPaginaFallas(){
 var basicos = document.getElementById("divDatosBasicos").style.visibility;
 var ficha	 = document.getElementById("divFicha2").style.visibility;
	
 if (basicos == "visible") {

 	document.getElementById("divDatosBasicos").style.visibility		= "hidden";
 	document.getElementById("divFicha2").style.visibility		= "visible";
 	document.getElementById("imagenCalendarioFichaVehiculo").style.visibility		= "hidden";
 	document.getElementById("imagenCalendarioFichaVehiculo2").style.visibility = "visible"; 

	

 	}
 else if (ficha == "visible") {

 	document.getElementById("divFicha2").style.visibility		= "hidden";
 	document.getElementById("divDatosBasicos").style.visibility		= "visible";
 	document.getElementById("imagenCalendarioFichaVehiculo").style.visibility		= "visible";
 	document.getElementById("imagenCalendarioFichaVehiculo2").style.visibility = "hidden"; 
 	

 	}
}

function llamaFalla(){
	 	var estado = document.getElementById("selEstado").value;
	 	var estadoActual = document.getElementById("estadoBaseDatos").value;
	 	
	 	//alert(estado);

					if(estado==130 && estadoActual==10){
						//alert("DEBERA BUSCAR LA SIMCCAR DE REEMPLAZO EN LA FICHA...");
						cambiaPaginaFallas();
						activarBotones();
					}else if((estado==10 && estadoActual==140)||(estado==3000 && estadoActual==140)||(estado==130 && estadoActual==140)){
						//alert("DEBERA BUSCAR LA SIMCCAR DE REEMPLAZO EN LA FICHA...");
						cambiaPaginaFallas();
						activarBotones();
					}
					
				}
				
function ValidaSoloNumerosAnno() {
 if ((event.keyCode < 48) || (event.keyCode > 57)) 
  event.returnValue = false;
}
