var cargaListadoSimccar;
var idcargaListadoSimccar;
function leeSimccar(unidad, campo, sentido){
	cargaListadoSimccar = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	if(document.getElementById('contieneHijos') !== null){
   	var contieneHijos = document.getElementById("contieneHijos").value;
	}
	else{
		var contieneHijos = 0;
	}
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoSimccar");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando SIMCCAR ......</td>";
	objHttpxmlSimccar.open("POST","./xml/xmlSimccar/xmlListaSimccar.php",true);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpxmlSimccar.onreadystatechange=function(){
		//alert(objHttpxmlSimccar.readyState);
		if(objHttpxmlSimccar.readyState == 4){
			//alert(objHttpxmlSimccar.responseText);
			if (objHttpxmlSimccar.responseText != "VACIO"){
				//alert(objHttpxmlSimccar.responseText);
				var xml 		= objHttpxmlSimccar.responseXML.documentElement;
				var codigo	= "";
				var serie	 	= "";
				var tarjeta	= "";
				var imei		= "";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var seccion				= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoSimccar	= "";
				listadoSimccar = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('simccar').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 					= (xml.getElementsByTagName('serie')[i].text||xml.getElementsByTagName('serie')[i].textContent||"");
					tarjeta	 					= (xml.getElementsByTagName('tarjeta')[i].text||xml.getElementsByTagName('tarjeta')[i].textContent||"");
					imei		 	 				= (xml.getElementsByTagName('imei')[i].text||xml.getElementsByTagName('imei')[i].textContent||"");
					estado	 	 				= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
				  desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
					seccion	 		 			= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('SIMCCAR', '790', '355','fichaSimccar.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 39) {
						var estadoMuestra = estado.substr(0,37) + " ...";
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
					
					if(contieneHijos == 1){
						listadoSimccar += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoSimccar += "<td width='4%' align='center'><div id='valorColumna'><font color="+color+">"+(i+1)+"</div></td>";
						listadoSimccar += "<td width='15%' align='center'><div id='valorColumna'><font color="+color+">"+serie+"</div></td>";
						listadoSimccar += "<td width='25%'><div id='valorColumna'><font color="+color+">"+tarjeta+"</div></td>";
						listadoSimccar += "<td width='18%' align='left'><div id='valorColumna'><font color="+color+">"+imei+"</div></td>";
						listadoSimccar += "<td width='18%' align='left'><div id='valorColumna'><font color="+color+">"+seccion+"</div></td>";
						listadoSimccar += "<td width='20%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'><font color="+color+">"+estadoMuestra+"</div></td>";
						listadoSimccar += "</tr>";
					}else{
						listadoSimccar += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoSimccar += "<td width='4%' align='center'><div id='valorColumna'><font color="+color+">"+(i+1)+"</div></td>";
						listadoSimccar += "<td width='20%' align='center'><div id='valorColumna'><font color="+color+">"+serie+"</div></td>";
						listadoSimccar += "<td width='25%'><div id='valorColumna'><font color="+color+">"+tarjeta+"</div></td>";
						listadoSimccar += "<td width='25%' align='left'><div id='valorColumna'><font color="+color+">"+imei+"</div></td>";
						listadoSimccar += "<td width='26%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'><font color="+color+">"+estadoMuestra+"</div></td>";
						listadoSimccar += "</tr>";
					}
				}
				listadoSimccar += "</table>";
				div.innerHTML = listadoSimccar;
				cargaListadoSimccar = 1;
			}
		}
	}
}

var cargaListadoSimccar;
var idcargaListadoSimccar;
function leeSimccarA(unidad, campo, sentido){
	cargaListadoSimccar = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoSimccar");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando SIMCCAR Agregados ......</td>";
	objHttpxmlSimccar.open("POST","./xml/xmlSimccar/xmlListaSimccarAgregados.php",true);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpxmlSimccar.onreadystatechange=function(){
		//alert(objHttpxmlSimccar.readyState);
		if(objHttpxmlSimccar.readyState == 4){
			//alert(objHttpxmlSimccar.responseText);
			if (objHttpxmlSimccar.responseText != "VACIO"){
				//alert(objHttpxmlSimccar.responseText);
				var xml 		= objHttpxmlSimccar.responseXML.documentElement;
				var codigo	= "";
				var serie	 	= "";
				var tarjeta	= "";
				var imei		= "";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoSimccar	= "";
				listadoSimccar = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('simccar').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 	 				= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie	 	 					= (xml.getElementsByTagName('serie')[i].text||xml.getElementsByTagName('serie')[i].textContent||"");
					tarjeta	 	 				= (xml.getElementsByTagName('tarjeta')[i].text||xml.getElementsByTagName('tarjeta')[i].textContent||"");
					imei		 	 				= (xml.getElementsByTagName('imei')[i].text||xml.getElementsByTagName('imei')[i].textContent||"");
					estado	 					= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					codUnidad					= (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
				  desUnidad					= (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
					codUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
				  desUnidadAgregado	= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
					resaltarLinea 	 	= "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar 	= "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('SIMCCAR', '790', '355','fichaSimccar.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidad != "") estado += ", "+desUnidad;
					
					if (estado.length > 39) {
						var estadoMuestra = estado.substr(0,37) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if (desUnidad != "") estadoMuestra += ", "+desUnidad;
					
					listadoSimccar += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoSimccar += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoSimccar += "<td width='18%' align='center'><div id='valorColumna'>"+serie+"</div></td>";
					listadoSimccar += "<td width='24%'><div id='valorColumna'>"+tarjeta+"</div></td>";
					listadoSimccar += "<td width='20%' align='left'><div id='valorColumna'>"+imei+"</div></td>";
					listadoSimccar += "<td width='34%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoSimccar += "</tr>";
				}
				listadoSimccar += "</table>";
				div.innerHTML = listadoSimccar;
				cargaListadoSimccar = 1;
			}
		}
	}
}

function leedatosSimccar(codigo,serieSimccar,tipo){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	objHttpxmlSimccar.open("POST","./xml/xmlSimccar/xmlDatosSimccar.php",true);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI("codigo="+codigo+"&serieSimccar="+serieSimccar));
	objHttpxmlSimccar.onreadystatechange=function(){
		//alert(objHttpxmlSimccar.readyState);
		if(objHttpxmlSimccar.readyState == 4){
			//alert(objHttpxmlSimccar.responseText);
			if (objHttpxmlSimccar.responseText != "VACIO"){
			  //alert(objHttpxmlSimccar.responseText);
				var xml	= objHttpxmlSimccar.responseXML.documentElement;
				var unidad	 			  			= "";
				var codigo	  						= "";
				var serie  								= "";
				var tarjeta 	  					= "";
				var imei 	  							= "";
				var codigoUnidadAgregado	= "";
        var desUnidadAgregado			= "";
        var fechaEstado			  		= "";
				var estado				  			= "";
				var origen 								= "";
				var verifica 							= "";
				var unidadSimccar 				= "";
				var descUnidadSimccar	  	= "";
        var seccion  	          	= "";
				var marca 								= "";
				var modelo 								= "";
				var anno 									= "";
				
				for(i=0;i<xml.getElementsByTagName('simccar').length;i++){
					
					unidad	 			 				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					codigo	 							= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					serie 								= (xml.getElementsByTagName('serie')[i].text||xml.getElementsByTagName('serie')[i].textContent||"");
					tarjeta 	 						= (xml.getElementsByTagName('tarjeta')[i].text||xml.getElementsByTagName('tarjeta')[i].textContent||"");
					imei 	 								= (xml.getElementsByTagName('imei')[i].text||xml.getElementsByTagName('imei')[i].textContent||"");
					estado 	 							= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					fechaEstado 	 				= (xml.getElementsByTagName('fechaEstado')[i].text||xml.getElementsByTagName('fechaEstado')[i].textContent||"");
					origen	 							= (xml.getElementsByTagName('origen')[i].text||xml.getElementsByTagName('origen')[i].textContent||"");
					verifica 	 						= (xml.getElementsByTagName('verifica')[i].text||xml.getElementsByTagName('verifica')[i].textContent||"");
					unidadSimccar	 			 	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					codigoUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					desUnidadAgregado 		= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
					descUnidadSimccar 		= (xml.getElementsByTagName('descUnidad')[i].text||xml.getElementsByTagName('descUnidad')[i].textContent||"");
          seccion 		 					= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					marca 	 							= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					modelo 	 							= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					anno 	 								= (xml.getElementsByTagName('anno')[i].text||xml.getElementsByTagName('anno')[i].textContent||"");
					
					if (estado == 140) leeEstadoSimccar('selEstado','mod3');
					
					if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					else leeEstadoSimccar('selEstado','mod2');
					
					document.getElementById("textSerie").value = serie;
					document.getElementById("textTarjeta").value = tarjeta;
					document.getElementById("textImei").value	= imei;
					document.getElementById("ultimaFecha").value = fechaEstado;
					document.getElementById("idSimccar").value = codigo;
					document.getElementById("codigoOculto").value	= codigo;
					document.getElementById("verificaOculto").value	= verifica;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("selMarca").value	= marca;	
					document.getElementById("selModelo").value = modelo;
					document.getElementById("textAnno").value	= anno;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					
					if(origen == ""){
						document.getElementById("selOrigen").value = 0;
					}else{
						document.getElementById("selOrigen").value = origen;
					}
					
					if(document.getElementById("verificaOculto").value == "SI"){
						document.getElementById("verificar").checked = "true";
						document.getElementById("verificar").disabled = "true";
						document.getElementById("labConfirmar").disabled = "";
						document.getElementById("labConfirmar").innerHTML = "VERIFICADO";
						document.getElementById("selOrigen").disabled = "";
					}else{
						document.getElementById("verificar").checked = "";
						document.getElementById("verificar").disabled = "";
						document.getElementById("verificar").disabled = "";
					}
					
					if (unidad == "") var habilitarBotones = false;
					else var habilitarBotones = true;
					
					document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;
					var valoresAsignar = "'" + estado + "','" + seccion + "'," + habilitarBotones;
					idAsignaSelectFichaSimccar = setInterval("asignaValores("+valoresAsignar+")",500);
					
					if (tipo == "1"){
						document.getElementById("btnBuscarSimccar").value = "BUSCAR";
						document.getElementById("btnBuscarSimccar").disabled = "";	
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadSimccar){
							alert("ESTE SIMCCAR YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaSimccar();
						}
						if (unidadUsuario != unidadSimccar && unidadSimccar != ""){
							alert("NO PUEDE AGREGAR ESTE SIMCCAR,\nYA QUE PERTENECE A LA " +descUnidadSimccar+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaSimccar();
						}
					}
				}
			}else {
				if (document.getElementById("btnBuscarSimccar").value == "BUSCANDO ..."){
					document.getElementById("mensajeCargando").style.display = "none";
					alert ("NO EXISTE ...");
					document.getElementById("textSerie").focus();
					document.getElementById('btnBuscarSimccar').disabled = "";
					document.getElementById("textSerie").value = "";
				}
				document.getElementById("btnBuscarSimccar").value = "BUSCAR";
			}
  	}
	}
}

function asignaValores(estado, seccion, habilitarBotones){
	var perfil = document.getElementById("perfil").value;
	if (cargaEstadosRecurso == 1 ){
		clearInterval(idAsignaSelectFichaSimccar);
		
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value 			 = estado;
		document.getElementById("estadoBaseDatos").value = estado;
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "hidden";
		
		if (seccion == "") seccion = 0;
		document.getElementById("seccionBaseDatos").value = seccion;
    document.getElementById("selSeccion").value 	    = seccion;
		
		if(perfil != 70 && perfil != 80 && perfil != 90 && perfil != 100 && perfil != 110 && perfil != 120 && perfil != 130 && perfil != 140 && perfil != 150 && perfil != 160 && perfil != 180) document.getElementById('btnGuardarSimccar').disabled = "";
		else habilitarBotones = false;
		
		activaFechaNuevoEstado();
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
		} else {
			document.getElementById("labFechaEstado").disabled = "";
			document.getElementById("textFechaNuevoEstado").disabled = "";
			document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "visible";
			document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
			document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "hidden";
		}
		document.getElementById('btnCerrarFichaSimccar').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none";
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "hidden";
	}
}

function buscaDatosSimccar(){
	var serieSimccar	= eliminarBlancos(document.getElementById("textSerie").value);
	if (serieSimccar == ""){
		alert("DEBE INDICAR EL NUMERO DE SERIE DEL SIMCCAR ...... 	     ");
		document.getElementById("textSerie").value="";
		document.getElementById("textSerie").focus();
		return false;
	} else {
		document.getElementById("btnBuscarSimccar").value = "BUSCANDO ...";
		document.getElementById("btnBuscarSimccar").disabled = "true";
		buscaDatosSimccar2();
	}
}

function buscaDatosSimccar2(){
	var serieSimccar	= eliminarBlancos(document.getElementById("textSerie").value);
	if (serieSimccar != "") leedatosSimccar('',serieSimccar,1);
}

function leedatosSimccar2(codigo,serieSimccar,tipo){
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	objHttpxmlSimccar.open("POST","./xml/xmlSimccar/xmlDatosSimccar.php",true);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI("codigo="+codigo+"&serieSimccar="+serieSimccar));
	objHttpxmlSimccar.onreadystatechange=function(){
		//alert(objHttpxmlSimccar.readyState);
		if(objHttpxmlSimccar.readyState == 4){
			//alert(objHttpxmlSimccar.responseText);
			if (objHttpxmlSimccar.responseText != "VACIO"){
			  //alert(objHttpxmlSimccar.responseText);
				var xml 				  				= objHttpxmlSimccar.responseXML.documentElement;
				var unidad	 			  			= "";
				var codigo	  						= "";
				var serie  								= "";
				var tarjeta 	  					= "";
				var imei 	  							= "";
				var codigoUnidadAgregado	= "";
        var desUnidadAgregado  	  = "";
        var fechaEstado			  		= "";
				var estado				  			= "";
				var origen 								= "";
				var verifica 							= "";
				var unidadSimccar 				= "";
				var descUnidadSimccar	  	= "";
		    var marca 								= "";
				var modelo 								= "";
				var anno 									= "";
				
				for(i=0;i<xml.getElementsByTagName('simccar').length;i++){

				 	unidad	 			      	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
				 	codigo	              = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
				 	serie                	= (xml.getElementsByTagName('serie')[i].text||xml.getElementsByTagName('serie')[i].textContent||"");
				 	tarjeta 	            = (xml.getElementsByTagName('tarjeta')[i].text||xml.getElementsByTagName('tarjeta')[i].textContent||"");
         	imei 	              	= (xml.getElementsByTagName('imei')[i].text||xml.getElementsByTagName('imei')[i].textContent||"");
				 	estado 	            	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
		     	fechaEstado 	        = (xml.getElementsByTagName('fechaEstado')[i].text||xml.getElementsByTagName('fechaEstado')[i].textContent||"");
				 	origen	              = (xml.getElementsByTagName('origen')[i].text||xml.getElementsByTagName('origen')[i].textContent||"");
				 	verifica 	          	= (xml.getElementsByTagName('verifica')[i].text||xml.getElementsByTagName('verifica')[i].textContent||"");
				 	unidadSimccar	      	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
				 	codigoUnidadAgregado	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
         	desUnidadAgregado 		= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
         	descUnidadSimccar 		= (xml.getElementsByTagName('descUnidad')[i].text||xml.getElementsByTagName('descUnidad')[i].textContent||"");
        	marca 	 							= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
        	modelo 	 							= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
        	anno 	 								= (xml.getElementsByTagName('anno')[i].text||xml.getElementsByTagName('anno')[i].textContent||"");
        	
					if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					
					document.getElementById("textSerie2").value									= serie;
					document.getElementById("textTarjeta2").value								= tarjeta;
				  document.getElementById("textImei2").value									= imei;
					document.getElementById("idSimccar").value									= codigo;
					document.getElementById("verificaOculto").value							= verifica;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					document.getElementById("selMarca2").value									= marca;
					document.getElementById("ultimaFecha2").value								= fechaEstado;
					document.getElementById("selModelo2").value									= modelo;
					document.getElementById("textAnno2").value									= anno;
					
					if(origen == ""){
						document.getElementById("selOrigen2").value = 0;
					}else{
						document.getElementById("selOrigen2").value	= origen;
					}
					
			 		if(document.getElementById("verificaOculto").value == "SI"){
				    document.getElementById("verificar").checked = "true";
				    document.getElementById("verificar").disabled = "true";
				    document.getElementById("labConfirmar").disabled = "";
				    document.getElementById("labConfirmar").innerHTML = "VERIFICADO";
				    document.getElementById("selOrigen").disabled = "true";
					}else{
				  	document.getElementById("verificar").checked = "";
				    document.getElementById("verificar").disabled = "";
				    document.getElementById("verificar").disabled = "";
					}
					
					if (unidad == "") var habilitarBotones = false;
					else var habilitarBotones = true;
					
        	document.getElementById("labFechaCargoDesde2").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;
					var valoresAsignar = "'" + estado + "'," + habilitarBotones;
					idAsignaSelectFichaSimccar2 = setInterval("asignaValores2("+valoresAsignar+")",500);
					
					if (tipo == "1"){
						document.getElementById("btnBuscarSimccar2").value = "BUSCAR";
						document.getElementById("btnBuscarSimccar2").disabled = "";
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadSimccar){
							alert("ESTE SIMCCAR YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaSimccar();
						}
						if (unidadUsuario != unidadSimccar && unidadSimccar != ""){
							alert("NO PUEDE UTILIZAR COMO REEMPLAZO ESTE SIMCCAR,\nYA QUE PERTENECE A LA " +descUnidadSimccar+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaSimccar();
						}
					}
				}
			}else {
				if (document.getElementById("btnBuscarSimccar2").value == "BUSCANDO ..."){
					document.getElementById("mensajeCargando").style.display = "none";
					alert ("NO EXISTE ...");
					cerrarVentanaSimccar();
				}
				document.getElementById("btnBuscarSimccar2").value = "BUSCAR";
			}
  	}
 	}
}

function asignaValores2(estado, habilitarBotones){
	var perfil = document.getElementById("perfil").value;
	if (cargaEstadosRecurso == 1 ){
		clearInterval(idAsignaSelectFichaSimccar2);
		
		if (estado == "") estado = 0;
		document.getElementById("selEstado2").value 			= estado;
		document.getElementById("estadoBaseDatos2").value	= estado;
		
		activaFechaNuevoEstado2();
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
		} else {
			document.getElementById("labFechaEstado2").disabled= "";
			document.getElementById("textFechaNuevoEstado2").disabled= "";
			document.getElementById("imagenCalendarioFichaSimccar2").style.visibility = "visible";
			document.getElementById("textFechaNuevoEstado2").style.backgroundColor = "";
		}
		document.getElementById("imagenCalendarioFichaSimccar2").style.visibility = "hidden";
		if(perfil != 70 && perfil != 80 && perfil != 90 && perfil != 100 && perfil != 110 && perfil != 120 && perfil != 130 && perfil != 140 && perfil != 150 && perfil != 160 && perfil != 180) document.getElementById('btnGuardarSimccar2').disabled = "";
		document.getElementById('btnCerrarFichaSimccar').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none";
	}
}

function buscaDatosSimccarExt(){
	var serieSimccar	= eliminarBlancos(document.getElementById("textSerie2").value);
	if (serieSimccar == ""){
		alert("DEBE INDICAR EL NUMERO DE SERIE DEL SIMCCAR DE REEMPLAZO ...... 	     ");
		document.getElementById("textSerie2").value="";
		document.getElementById("textSerie2").focus();
		return false;
	} else {
		document.getElementById("btnBuscarSimccar2").value = "BUSCANDO ...";
		document.getElementById("btnBuscarSimccar2").disabled = "true";
		leedatosSimccar2('',serieSimccar,1);
	}
}

function nuevoSimccar(){
  var unidadUsuario			= document.getElementById("unidadUsuario").value;
  var codigoUsuario			= document.getElementById("textSerie").value;
	var mes								= document.getElementById("textTarjeta").value;
	var fecha 						=document.getElementById("textImei").value;
	var estado						= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
  var codigoSimccar 		= document.getElementById("idSimccar").value;
	var codigo 						= document.getElementById("idSimccar").value;
	var origen 						= document.getElementById("selOrigen").value;
	var verificaOculto 		= document.getElementById("verificaOculto").value;
	var verificar 				= document.getElementById("verificar").value;
	var seccion						= document.getElementById("selSeccion").value;
	
	var parametros = "";
	parametros += "unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&mes="+mes;
	parametros += "&fecha="+fecha+"&codigoSimccar="+codigoSimccar+"&codigo="+codigo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado+"&seccion="+seccion;
	parametros += "&origen="+origen+"&verificaOculto="+verificaOculto+"&verificar="+verificar;
	
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	objHttpxmlSimccar.open("POST","./xml/xmlSimccar/xmlNuevoSimccar.php",true);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI(parametros));
	objHttpxmlSimccar.onreadystatechange=function(){
		if(objHttpxmlSimccar.readyState == 4){
			//alert(objHttpxmlSimccar.responseText);
				if (objHttpxmlSimccar.responseText != "VACIO"){
				//alert(objHttpxmlSimccar.responseText);
				var xml = objHttpxmlSimccar.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeSimccar(unidadUsuario, '', '');
						 idcargaListadoSimccar = setInterval("cerrarVentanaSimccar()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function actualizaSimccar(){
	var unidadUsuario 				= document.getElementById("unidadUsuario").value;
	var codigoSimccar 				= document.getElementById("idSimccar").value;
	var estado								= document.getElementById("selEstado").value;
	var numeroBCU							= document.getElementById("textSerie").value;
	var codigoUnidadAgregado	= document.getElementById("codigoUnidadAgregado").value;
	var tarjeta 							= document.getElementById("textTarjeta").value;
  var imei									= document.getElementById("textImei").value;
 	var marca 								= document.getElementById("selMarca").value;
 	var modelo 								= document.getElementById("selModelo").value;
 	var anno 									= document.getElementById("textAnno").value;
	var origen 								= document.getElementById("selOrigen").value;
	var verificaOculto 				= document.getElementById("verificaOculto").value;
	var verificar 						= document.getElementById("verificar").value;
	var seccion								= document.getElementById("selSeccion").value;
	
	if(estado==140){
		var codigo = document.getElementById("codigoOculto").value;
		var reemplazo = document.getElementById("idSimccar").value;
		var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado2").value;
	}else{
		var codigo = document.getElementById("idSimccar").value;
		var reemplazo = "";
		var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
	}
	
  var parametros = "";
	parametros += "estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado+"&codigoSimccar ="+codigoSimccar;
	parametros += "&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado+"&codigo="+codigo;
	parametros += "&origen="+origen+"&verificaOculto="+verificaOculto+"&verificar="+verificar+"&seccion="+seccion;
	parametros += "&tarjeta="+tarjeta+"&imei="+imei+"&marca="+marca+"&modelo="+modelo+"&anno="+anno+"&reemplazo="+reemplazo;
	
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	objHttpxmlSimccar.open("POST","./xml/xmlSimccar/xmlActualizaSimccar.php",true);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI(parametros));
	objHttpxmlSimccar.onreadystatechange=function(){
		if(objHttpxmlSimccar.readyState == 4){
			//alert(objHttpxmlSimccar.responseText);
			if (objHttpxmlSimccar.responseText != "VACIO"){
				var xml = objHttpxmlSimccar.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeSimccar(unidadUsuario, '', '');
						 idcargaListadoSimccar = setInterval("cerrarVentanaSimccar()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function actualizaReemplazo(){
	var unidadUsuario 				= document.getElementById("unidadUsuario").value;
	var codigoSimccar 				= document.getElementById("idSimccar").value;
	var estado2								= document.getElementById("selEstado2").value;
	var fechaNuevoEstado2			= document.getElementById("textFechaNuevoEstado2").value;
	var numeroBCU2						= document.getElementById("textSerie2").value;
	var codigoUnidadAgregado	= document.getElementById("codigoUnidadAgregado").value;
	var codigo2 							= document.getElementById("idSimccar").value;
	var origen 								= document.getElementById("selOrigen").value;
	var verificaOculto 				= document.getElementById("verificaOculto").value;
	var verificar 						= document.getElementById("verificar").value;
	var seccion								= document.getElementById("selSeccion2").value;
	var tarjeta2 							= document.getElementById("textTarjeta2").value;
  var imei2									= document.getElementById("textImei2").value;
  var marca2 								= document.getElementById("selMarca2").value;
  var modelo2 							= document.getElementById("selModelo2").value;
  var anno2 								= document.getElementById("textAnno2").value;
  
  var parametros = "";
	parametros += "estado2="+estado2+"&fechaNuevoEstado2="+fechaNuevoEstado2+"&codigoSimccar ="+codigoSimccar;
	parametros += "&numeroBCU2="+numeroBCU2+"&codigoUnidadAgregado="+codigoUnidadAgregado+"&codigo2="+codigo2;
	parametros += "&origen="+origen+"&verificaOculto="+verificaOculto+"&verificar="+verificar+"&seccion="+seccion;
	parametros += "&tarjeta2="+tarjeta2+"&imei2="+imei2+"&marca2="+marca2+"&modelo2="+modelo2+"&anno2="+anno2;
	
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	objHttpxmlSimccar.open("POST","./xml/xmlSimccar/xmlReemplazaSimccar.php",true);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI(parametros));
	objHttpxmlSimccar.onreadystatechange=function(){
		if(objHttpxmlSimccar.readyState == 4){
			if (objHttpxmlSimccar.responseText != "VACIO"){
				//alert(objHttpxmlSimccar.responseText);
				var xml = objHttpxmlSimccar.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (codigo == 1){
						 top.leeSimccar(unidadUsuario, '', '');
						 actualizaSimccar();
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function cerrarVentanaSimccar(){
	if (top.cargaListadoSimccars == 1){
		document.getElementById("cubreFondo").style.display = "none";
		clearInterval(idCargaListadoSimccars);
		top.Windows.closeAll();
	}
}

function desactivarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "true";
	document.getElementById("btnGuardarSimccar").disabled = "true";
	document.getElementById("btnCerrarFichaSimccar").disabled = "true";
}

function activarBotones(){
	var perfil = document.getElementById("perfil").value;
	if(perfil != 70 && perfil != 80 && perfil != 90 && perfil != 100 && perfil != 110 && perfil != 120 && perfil != 130 && perfil != 140 && perfil != 150 && perfil != 160 && perfil != 180) {
		document.getElementById("btnDejarDisponible").disabled = "";
		document.getElementById("btnGuardarSimccar").disabled = "";
	}
	document.getElementById("btnCerrarFichaSimccar").disabled = "";
}

function activaBuscaUnidadAgregado(){
	desactivarBotones();
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}

function activaBuscaUnidadAgregado2(){
	desactivarBotones();
	document.getElementById("cubreVentana2").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad2").style.display = "";
}

function activaVentanaIngresoFecha(boton){
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este SIMCCAR :";
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectiva la Baja de este SIMCCAR :";
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
	document.getElementById("textFechaNuevoEstado").value = fecha;
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	var codigoSimccar = document.getElementById("idSimccar").value;
	var cantidadServicio = controlEstadoSimccar();
	
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		return false;
	}
	
	if (fecha == ""){
		alert("DEBE INDICAR UNA FECHA ....");
		return false;
	}
	
	var comparaFechaLimite = comparaFecha(fechaLimite,fecha);
	if (unidadBloqueada == 1 && comparaFechaLimite == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
		return false;
	}
	
	var fechaMayor = comparaFecha(ultimaFechaCargo,fecha);
	if (fechaMayor == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaCargo);
		return false;
	}
	
	document.getElementById("ventanaIngresoFecha").style.display  = "none";
	document.getElementById("cubreVentana").style.display = "none";
	
	if (tipo == 1) liberaSimccar(document.getElementById("idSimccar").value);
	if (tipo == 2) bajaSimccar(document.getElementById("idSimccar").value);
}

function cerrarVentanaSimccar(){
	if (top.cargaListadoSimccar == 1){
		clearInterval(idcargaListadoSimccar);
		 top.cerrarVentana();
	}
}

function validaNumeros(e){
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==8){
  	return true;
  }
  patron =/[0-9]/;
  tecla_final = String.fromCharCode(tecla);
  return patron.test(tecla_final);
}

function validarFichaSimccar(){
	var mes										= document.getElementById("textSerie").value;
	var bandas								= document.getElementById("textTarjeta").value;
	var infra3								= document.getElementById("textImei").value;
	var fisc3									= document.getElementById("selMarca").value;
	var estado				 				= document.getElementById("selEstado").value;
	var fechaEstado			 			= document.getElementById("textFechaNuevoEstado").value;
	var ultimaFechaEstado	 		= document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado 	= document.getElementById("codigoUnidadAgregado").value;
	var fechaLimite 					= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada				= top.document.getElementById("textUnidadBloqueada").value;
	var validaCheck 					= document.getElementById("verificar");
	var origen 								= document.getElementById("selOrigen").value;
	var codigoSimccar 				= document.getElementById("idSimccar").value;
	var verificaOculto 				= document.getElementById("verificaOculto").value;
	var estado2				 				= document.getElementById("selEstado2").value;
	var fechaEstado2			 		= document.getElementById("textFechaNuevoEstado2").value;
	var estadoActual					= document.getElementById("estadoBaseDatos").value;
	var estadoActual2					= document.getElementById("estadoBaseDatos2").value;
	var ultimaFechaEstado2	 	= document.getElementById("ultimaFecha2").value;
	
	if(document.body.contains(document.getElementById("selSeccion"))){
	  var seccion				 = document.getElementById("selSeccion").value;
		var tipoUnidad	   = document.getElementById("tipoUnidad").value;
		var contieneHijos	 = document.getElementById("contieneHijos").value;
	}
	else{
		var seccion				 = 0;
		var tipoUnidad	   = 0;
		var contieneHijos	 = 0;
	}
	
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
	
	if((estado!=estadoActual)&&(estado2==0 && fechaEstado2=="")){
		var cantidadServicio = controlEstadoSimccar();
		if(cantidadServicio!=""){
			alert(cantidadServicio);
			return false;
		}
	}
	
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ||
	document.getElementById("codigoUnidadAgregado").value != document.getElementById("codUnidadAgregadoBaseDatos").value){
		
		if(estado!=estadoActual && fechaEstado2==""){
			if (fechaEstado == ""){
				alert("DEBE INDICAR FECHA DEL NUEVO ESTADO  ...... 	     ");
				return false;
			}
		}
		
		if(estado!=estadoActual){	
			var comparaFechaLimite = comparaFecha(fechaLimite,fechaEstado);
			if (unidadBloqueada == 1 && comparaFechaLimite == 1){
				alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
				return false;
			}
		}
		
		if(estado!=estadoActual){
			var fechaMayor = comparaFecha(ultimaFechaEstado,fechaEstado);
			if (fechaMayor == 1){
				alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado);
				return false;
			}
		}
		
		if(estado2!=estadoActual2){
			var fechaMayor2 = comparaFecha(ultimaFechaEstado2,fechaEstado2);
			if (fechaMayor2 == 1){
				alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado2);
				return false;
			}
		}
		
		if (estado == 3000 && codigoUnidadAgregado == ""){
			alert("DEBE INDICAR UNIDAD A LA QUE LA SIMCCAR SE FUE AGREGADO...... 	     ");
			return false;
		}
		
		if (seccion == 0 && contieneHijos==1) {
			alert("DEBE INDICAR LA SECCION ...... 	     ");
			document.getElementById("selSeccion").focus();
			return false;
		}
	}
	return true;
}

function guardarFichaSimccar(codigoSimccar){
	desactivarBotones();
	var validaOk = validarFichaSimccar();
	var codigoSimccar = document.getElementById("idSimccar").value;
	if (validaOk){
		if (codigoSimccar != "") {
			var msj=confirm("ATENCIÓN :\nSE MODIFICAR\u00c1N LOS DATOS DE ESTA SIMCCAR EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) actualizaSimccar();
			else activarBotones();
		}
		else {
			var msj=confirm("ATENCIÓN :\nSE INGRESAR\u00c1N LOS DATOS DE ESTA SIMCCAR EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) nuevoSimccar();
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}

function guardarFichaReemplazo(codigoSimccar){
	desactivarBotones();
	var validaOk = validarFichaSimccar();
	var codigoSimccar = document.getElementById("idSimccar").value;
	if (validaOk){
		if (codigoSimccar != "") {
			var msj=confirm("ATENCIÓN :\nSE MODIFICARÁN LOS DATOS DE ESTA SIMCCAR EN LA BASE DE DATOS.          \n¿DESEA CONTINUAR?");
			if (msj) actualizaReemplazo();
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}

function liberaSimccar(codigoSimccar){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACARÁ ESTA SIMCCAR DE LA OFERTA DE LA UNIDAD.                                       \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		var validaOk = validarFichaSimccar();
		
		if (validaOk){
			parametros += "codigoSimccar="+codigoSimccar;
			parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
			var objHttpxmlSimccars = new AJAXCrearObjeto();
			objHttpxmlSimccars.open("POST","./xml/xmlSimccar/xmlLiberaSimccar.php",true);
			objHttpxmlSimccars.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpxmlSimccars.send(encodeURI(parametros));
			objHttpxmlSimccars.onreadystatechange=function(){
				if(objHttpxmlSimccars.readyState == 4){
					if (objHttpxmlSimccars.responseText != "VACIO"){
						//alert(objHttpxmlSimccars.responseText);
						var xml = objHttpxmlSimccars.responseXML.documentElement;
						for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
							var codigo = xml.getElementsByTagName('resultado')[i].text;
							if (codigo == 1){
								alert('EL SIMCCAR FUE DEJADO DISPONIBLE PARA OTRA UNIDAD ......        ');
								top.leeSimccar(unidadUsuario,'','');
							 	idcargaListadoSimccar = setInterval("cerrarVentanaSimccar()",1000);
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
						}
					}
				}
			}
		}
	} else {
		activarBotones();
	}
}

function bajaSimccar(codigoSimccar){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACARÁ ESTE SIMCCAR DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n¿DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		var validaOk = validarFichaSimccar();
		if (validaOk){
			parametros += "codigoSimccar="+codigoSimccar;
			parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
			var objHttpxmlSimccars = new AJAXCrearObjeto();
			objHttpxmlSimccars.open("POST","./xml/xmlSimccar/xmlBajaSimccar.php",true);
			objHttpxmlSimccars.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objHttpxmlSimccars.send(encodeURI(parametros));
			objHttpxmlSimccars.onreadystatechange=function(){
				if(objHttpxmlSimccars.readyState == 4){
					if (objHttpxmlSimccars.responseText != "VACIO"){
						//alert(objHttpxmlSimccars.responseText);
						var xml = objHttpxmlSimccars.responseXML.documentElement;
						for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
							var codigo = xml.getElementsByTagName('resultado')[i].text;
							if (codigo == 1){
								alert('EL SIMCCAR FUE DADO DE BAJA ......        ');
								top.leeSimccar(unidadUsuario,'','');
							 	idcargaListadoSimccar = setInterval("cerrarVentanaSimccar()",1000);
							}
							else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
						}
					}
				}
			}
		}
	} else {
		activarBotones();
	}
}

function activaFechaNuevoEstado(){
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value||document.getElementById("estadoBaseDatos").value==0 || (document.getElementById("selSeccion").value != document.getElementById("seccionBaseDatos").value)){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("textFechaNuevoEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "visible";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
		
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
		
	} else {
		document.getElementById("labFechaEstado").disabled= "true";
		document.getElementById("textFechaNuevoEstado").disabled= "true";
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "hidden";
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
}

function activaFechaNuevoEstado2(){
	if (document.getElementById("selEstado2").value != document.getElementById("estadoBaseDatos2").value){
		document.getElementById("labFechaEstado2").disabled= "";
		document.getElementById("textFechaNuevoEstado2").disabled= "";
		document.getElementById("imagenCalendarioFichaSimccar2").style.visibility = "visible";
		document.getElementById("textFechaNuevoEstado2").style.backgroundColor = "";
	} else {
		document.getElementById("labFechaEstado2").disabled= "true";
		document.getElementById("textFechaNuevoEstado2").disabled= "true";
		document.getElementById("imagenCalendarioFichaSimccar2").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado2").value = "";
		document.getElementById("textFechaNuevoEstado2").style.backgroundColor = "#E6E6E6";
		document.getElementById("labDocumentoEstado2").disabled = true;
		document.getElementById("textDocumentoNuevoEstado2").value = "";
		document.getElementById("textDocumentoNuevoEstado2").disabled = true;
		document.getElementById("textDocumentoNuevoEstado2").style.backgroundColor = "#E6E6E6";
	}
}

function controlEstadoSimccar(){ 
	var fecha1			  = document.getElementById("textFechaNuevoEstado").value;
	var codigoSimccar = document.getElementById("idSimccar").value;
	var fecha2 			  = '01-01-3000';
	var mensaje			  = "";
	var objHttpxmlSimccar = new AJAXCrearObjeto();
	objHttpxmlSimccar.open("POST","./xml/xmlServicios/xmlListaServiciosPorSimccar.php",false);
	objHttpxmlSimccar.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpxmlSimccar.send(encodeURI("codigoSimccar="+codigoSimccar+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//alert(objHttpxmlSimccar.responseText); 
	if (objHttpxmlSimccar.responseText != "VACIO"){
		var xml = objHttpxmlSimccar.responseXML.documentElement;
		mensaje += "NO PUEDE CAMBIAR DE ESTADO, PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio 	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad 	  = (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
	}
	return mensaje;
}

function cambiaPaginaReemplazo(){
	var basicos = document.getElementById("divDatosBasicos").style.visibility;
	var ficha	 	= document.getElementById("divFicha2").style.visibility;
	if (basicos == "visible"){
		document.getElementById("divDatosBasicos").style.visibility = "hidden";
		document.getElementById("divFicha2").style.visibility = "visible";
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "hidden";
		document.getElementById("imagenCalendarioFichaSimccar2").style.visibility = "visible";
		document.getElementById("btnCerrarFichaSimccar2").disabled = "";
		document.getElementById("filaSeccion").style.visibility = "hidden";
	}
	else if (ficha == "visible"){
		document.getElementById("divFicha2").style.visibility = "hidden";
		document.getElementById("divDatosBasicos").style.visibility = "visible";
		document.getElementById("imagenCalendarioFichaSimccar").style.visibility = "visible";
		document.getElementById("imagenCalendarioFichaSimccar2").style.visibility = "hidden";
	}
}

function llamaReemplazo(){
	var estado = document.getElementById("selEstado").value;
	var estadoActual = document.getElementById("estadoBaseDatos").value;
	if(estado==130){
		cambiaPaginaReemplazo();
		activarBotones();
	}
}

function ValidaSoloNumerosAnno() {
	if ((event.keyCode < 48) || (event.keyCode > 57))
	event.returnValue = false;
}

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";
	if (sentido == "desc") nuevoSentido = "asc";
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	
	if(document.getElementById("labColUnidad")!=null){
		leeSimccarA(unidad, atributo, sentido);
	}
	else{
		leeSimccar(unidad, atributo, sentido);
	}
	
	switch(atributo){
		case "serie":
			document.getElementById("labColTarjeta").innerHTML = "NRO. TARJETA";
			document.getElementById("labColImei").innerHTML = "IMEI";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colSerie").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "tarjeta":
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			document.getElementById("labColImei").innerHTML = "IMEI";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			document.getElementById("labColTarjeta").innerHTML = "NRO. TARJETA&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colTarjeta").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "imei":
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			document.getElementById("labColTarjeta").innerHTML = "NRO. TARJETA";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML  = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			document.getElementById("labColImei").innerHTML = "IMEI&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colImei").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "seccion":
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			document.getElementById("labColTarjeta").innerHTML = "NRO. TARJETA";
			document.getElementById("labColImei").innerHTML = "IMEI";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML  = "SECCION&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colSeccion").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)}; 
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			break;
			
		case "estado":
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			document.getElementById("labColTarjeta").innerHTML = "NRO. TARJETA";
			document.getElementById("labColImei").innerHTML = "IMEI";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML  = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML  = "ESTADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colEstado").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			break;
			
		case "unidad":
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			document.getElementById("labColTarjeta").innerHTML = "NRO. TARJETA";
			document.getElementById("labColImei").innerHTML = "IMEI";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML  = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML  = "UNIDAD ORIGEN&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colUnidad").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			break;
	}
	idcargaListadoSimccar = setInterval("tituloColumnaNormal("+columna.id+")",500);
}

function tituloColumnaNormal(columna){
	if (cargaListadoSimccar == 1){
		clearInterval(idcargaListadoSimccar);
		cambiarClase(columna,'nombreColumna');
	}
}