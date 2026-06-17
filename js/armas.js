var cargaListadoArmas;
var idCargaListadoArmas;

function leeArmas(unidad, campo, sentido){
	cargaListadoArmas = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	
	if(document.getElementById("contieneHijos")!=null) var contieneHijos = document.getElementById("contieneHijos").value;
	else var contieneHijos = 0;
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoArmas");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Armas ......</td>";
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlListaArmas.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	
	objHttpXMLArmas.onreadystatechange=function(){
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4){
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml 					= objHttpXMLArmas.responseXML.documentElement;
				var codigo				= "";
				var tipo					= "";
				var marca 				= "";
				var modelo 				= "";
				var nroSerie			= "";
				var estado				= "";
   	    var seccion				= "";
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
					
					codigo	 		 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipo							= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					marca	 	 		 			= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					modelo	 					= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					nroSerie 		 			= (xml.getElementsByTagName('numeroSerie')[i].text||xml.getElementsByTagName('numeroSerie')[i].textContent||"");
					estado	 		 			= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					codUnidadAgregado = (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					desUnidadAgregado = (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
          seccion	 		 			= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					
          if(contieneHijos == 1){
              var alto=280;
          }else{
             var alto=290; 
          }
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ARMA ...', '800','"+alto+"','fichaArma.php?codigoArma="+codigo+"','"+nroLinea+"','','5','5')";
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
		      
		      if(contieneHijos == 1){
					  listadoArmas += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoArmas += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoArmas += "<td width='20%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
						listadoArmas += "<td width='20%' align='left'><div id='valorColumna'>"+marca+" "+modelo+"</div></td>";
						listadoArmas += "<td width='15%' align='center'><div id='valorColumna'>"+nroSerie+"</div></td>";
						listadoArmas+= "<td width='20%' align='left'><div id='valorColumna'>"+seccion+"</div></td>";
						listadoArmas+= "<td width='20%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoArmas += "</tr>";
				  }
				  else{			
						listadoArmas += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						listadoArmas += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
						listadoArmas += "<td width='20%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
						listadoArmas += "<td width='25%' align='left'><div id='valorColumna'>"+marca+" "+modelo+"</div></td>";
						listadoArmas += "<td width='20%' align='center'><div id='valorColumna'>"+nroSerie+"</div></td>";
						listadoArmas+= "<td width='30%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
						listadoArmas += "</tr>";
					}
				}
				listadoArmas += "</table>";
				div.innerHTML = listadoArmas;
				cargaListadoArmas = 1;
			}
		}
	}
}

function leeArmasA(unidad, campo, sentido){
	cargaListadoArmas = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	var contieneHijos = document.getElementById("contieneHijos").value;
	var objHttpXMLArmas = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoArmas");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Armas ......</td>";
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlListaArmasAgregadas.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLArmas.onreadystatechange=function(){
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4){
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
   	    var seccion				= "";
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
					
					codigo	 		 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipo	 		 				= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					marca	 	 	 				= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					modelo	 		 			= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					nroSerie 		 			= (xml.getElementsByTagName('numeroSerie')[i].text||xml.getElementsByTagName('numeroSerie')[i].textContent||"");
					estado	 		 			= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					codUnidadAgregado = (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					desUnidadAgregado = (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
          seccion	 		 			= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
          unidadAgregado		= (xml.getElementsByTagName('unidadAgregado')[i].text||xml.getElementsByTagName('unidadAgregado')[i].textContent||"");
          
          if(contieneHijos == 1){
              var alto=280;
          }else{
             var alto=290; 
          }
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('ARMA ...', '800','"+alto+"','fichaArma.php?codigoArma="+codigo+"&subSeccion=Agregado','"+nroLinea+"','','5','5')";
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
          
					if (unidadAgregado != "") estadoMuestra += ", "+unidadAgregado;
		      
					listadoArmas += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoArmas += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoArmas += "<td width='21%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
					listadoArmas += "<td width='22%' align='left'><div id='valorColumna'>"+marca+" "+modelo+"</div></td>";
					listadoArmas += "<td width='22%' align='center'><div id='valorColumna'>"+nroSerie+"</div></td>";
					listadoArmas += "<td width='30%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
					listadoArmas += "</tr>";
					
        }
				listadoArmas += "</table>";
				div.innerHTML = listadoArmas;
				cargaListadoArmas = 1;
			}
		}
	}
}

function buscaDatosArma(){	
	var serieArma	= eliminarBlancos(document.getElementById("textSerieArma").value);
	if (serieArma == ""){
		alert("DEBE INDICAR EL NUMERO DE SERIE DEL ARMA ...... 	     ");
		document.getElementById("textSerieArma").value="";
		document.getElementById("textSerieArma").focus();
		return false;
	} else {
		document.getElementById("btnBuscarArma").value = "BUSCANDO ...";
		buscaDatosArma2();	
	}
}

function buscaDatosArma2(){
	var serieArma	= eliminarBlancos(document.getElementById("textSerieArma").value);
	if (serieArma != "") leeDatosArmaPorSerie(serieArma);
}

function leeDatosArmaPorSerie(serieArma){
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlDatosArmaPorSerie.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("serieArma="+serieArma));	
	objHttpXMLArmas.onreadystatechange=function(){
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4){
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml 			= objHttpXMLArmas.responseXML.documentElement;
				var codigo	 	= "";
				
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					codigo	 		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					leeDatosArma(codigo, 1);
				}
			} 
			else {				
				var msj=confirm("EL ARMA NO EXISTE, VERIFIQUE EL FORMATO DE INGRESO O COMUNIQUESE CON MESA DE AYUDA PARA INGRESAR EL ARMA.  \n\u00BFDESEA CONTINUAR? ");
				document.getElementById("textSerieArma").value = "";
				document.getElementById("textSerieArma").focus();
				document.getElementById("btnBuscarArma").value = "BUSCAR";
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
	objHttpXMLArmas.onreadystatechange=function()	{
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4)	{
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml 									= objHttpXMLArmas.responseXML.documentElement;
				var codigo	 							= "";
				var tipo									= "";
				var marca 								= "";
				var modelo								= "";
				var nroSerie							= "";
				var estado								= "";
				var unidadArma						= "";
				var descUnidadArma				= "";
				var fechaEstado						= "";
				var armaBCU								= "";
				var codigoUnidadAgregado  = "";
				var desUnidadAgregado  	  = "";
				var seccion  	          	= "";
				var descSeccion  	      	= "";
				
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					codigo	 		 					= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					tipo	 		 						= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					marca	 	 	 						= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					modelo			 					= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					nroSerie 		 					= (xml.getElementsByTagName('numeroSerie')[i].text||xml.getElementsByTagName('numeroSerie')[i].textContent||"");
					estado	 		 					= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
					unidadArma	 	 				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					descUnidadArma	 			= (xml.getElementsByTagName('descUnidad')[i].text||xml.getElementsByTagName('descUnidad')[i].textContent||"");
					fechaEstado	 	 				= (xml.getElementsByTagName('fechaEstado')[i].text||xml.getElementsByTagName('fechaEstado')[i].textContent||"");
					armaBCU	 	 	 					= (xml.getElementsByTagName('numeroBCU')[i].text||xml.getElementsByTagName('numeroBCU')[i].textContent||"");
					codigoUnidadAgregado 	= (xml.getElementsByTagName('codigoUnidadAgregado')[i].text||xml.getElementsByTagName('codigoUnidadAgregado')[i].textContent||"");
					desUnidadAgregado 		= (xml.getElementsByTagName('desUnidadAgregado')[i].text||xml.getElementsByTagName('desUnidadAgregado')[i].textContent||"");
					seccion 		 					= (xml.getElementsByTagName('seccion')[i].text||xml.getElementsByTagName('seccion')[i].textContent||"");
					descSeccion 		 			= (xml.getElementsByTagName('descSeccion')[i].text||xml.getElementsByTagName('descSeccion')[i].textContent||"");
					
					document.getElementById("textSerieArma").value 			 				= nroSerie;
					document.getElementById("idArma").value 				 						= codigo;
					document.getElementById("ultimaFecha").value 			 					= fechaEstado;
					document.getElementById("codigoUnidadAgregado").value 	 		= codigoUnidadAgregado;
					document.getElementById("textUnidadAgregado").value 	 			= desUnidadAgregado;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
					
					if(typeof document.getElementById("seccionBaseDatos")!="undefined"){
						document.getElementById("seccionBaseDatos").value 	= seccion;
						document.getElementById("selSeccion").value 		= seccion;
					}
					
					document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;
					
					if (unidadArma == "") var habilitarBotones = false;
					else var habilitarBotones = true;
					
					var valoresAsignar = "'" + tipo + "','" + marca + "','" + modelo + "','" + estado + "','" + seccion + "'," + habilitarBotones;
					
					leeModeloArmas(marca, 'selModelo');
					idAsignaSelectFichaArma = setInterval("asignaValores("+valoresAsignar+")",1000);
					
					if (tipoBusqueda == "1"){
						document.getElementById("btnBuscarArma").value = "BUSCAR";
						document.getElementById("btnBuscarArma").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadArma){
							alert("ESTA ARMA YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaFichaArmas();
						}
						
						if (unidadUsuario != unidadArma && unidadArma != ""){
							alert("NO PUEDE AGREGAR ESTA ARMA,\nYA QUE PERTENECE A LA " +descUnidadArma+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaFichaArmas();
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
				document.getElementById("btnBuscarArma").disabled = "";
			}
		}
	}
}

function asignaValores(tipo,marca,modelo,estado, seccion, habilitarBotones){
	var permisoRegistrar = document.getElementById("permisoRegistrar").value;
	if (cargaTipoArma == 1 && cargaMarcaArma == 1 && cargaModelosArmas == 1 && cargaEstadosRecurso == 1){
		clearInterval(idAsignaSelectFichaArma);
		document.getElementById("selTipoArma").value 		= tipo;
		document.getElementById("selMarca").value 			= marca;
		document.getElementById("selModelo").value 			= modelo;
		if(typeof document.getElementById("selSeccion")!=""){
      document.getElementById("selSeccion").value 	= seccion;
		}
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value 			= estado;
		document.getElementById("estadoBaseDatos").value 	= estado;
    
    if (seccion == "") seccion = 0;
    if(typeof document.getElementById("selSeccion")!=""){
			document.getElementById("selSeccion").value 		= seccion;
			document.getElementById("seccionBaseDatos").value 	= seccion;
		}
		
		if(permisoRegistrar) document.getElementById('btnGuardar').disabled = "";
		else habilitarBotones = false;
		
		activaFechaNuevoEstado();
		
		if (habilitarBotones){
			document.getElementById('btnDejarDisponible').disabled = "";
			document.getElementById('btnBaja').disabled = "";
		}
		
		document.getElementById('btnCerrar').disabled = "";
		document.getElementById("mensajeCargando").style.display = "none";
	}
	if(subSeccion.value=="Agregado"){
		btnDejarDisponible.disabled = true;
		btnBaja.disabled = true;
		btnGuardar.disabled = true;
		btnUnidades.disabled = true;
		selEstado.disabled = true;
	}
}

function validarFichaArma(){
	var codigo				= eliminarBlancos(document.getElementById("textSerieArma").value);
	var tipoArma			= document.getElementById("selTipoArma").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaEstado			= document.getElementById("textFechaNuevoEstado").value;
	var ultimaFechaEstado	= document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
	var seccion				= document.getElementById("selSeccion").value;
	var tipoUnidad	        = document.getElementById("tipoUnidad").value;
	var contieneHijos       = document.getElementById("contieneHijos").value;
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	if (codigo == "") {
		alert("DEBE INDICAR EL NUMERO DE SERIA DEL ARMA ...... 	     ");
		document.getElementById("textSerieArma").focus();
		return false;
	}
	
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
	
	if (estado == 0) {
		alert("DEBE INDICAR EL ESTADO DEL ARMA ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	
	if (fechaEstado == ""){
		alert("DEBE INDICAR FECHA DEL NUEVO ESTADO ...... 	     ");
		return false;
	}
	
	var cantidadServicio = controlEstadoArma();
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		activarBotones();
		return false;
	}
	
	var comparaFechaLimite = comparaFecha(fechaLimite,fechaEstado)
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
		alert("DEBE INDICAR UNIDAD A LA QUE EL ARMA SE FUE AGREGADA...... 	     ");
		return false;
	}
	
  if(document.body.contains(document.getElementById("seccionBaseDatos"))){
		if (seccion == 0 && contieneHijos==1) {		alert("DEBE INDICAR LA SECCION ...... 	     ");
			document.getElementById("selSeccion").focus();
			return false;
		}
	}
	return true;
}

function guardarFichaArma(){
	var estadoDB	= document.getElementById("estadoBaseDatos").value;
	var estadoNew	= document.getElementById("selEstado").value;
	if(estadoDB==estadoNew) return false;
	desactivarBotones();
	
	var validaOk = validarFichaArma();
	var codigoArma = document.getElementById("idArma").value;
	if (validaOk){
		if (codigoArma != "") {
			var msj=confirm("ATENCI�N :\nSE MODIFICAR�N LOS DATOS DE ESTA ARMA EN LA BASE DE DATOS.          \n�DESEA CONTINUAR?");
			if (msj) actualizarArma(codigoArma);
			else{
				activarBotones();
				return false;
				}
		}
		else {
			var msj=confirm("ATENCI�N :\nSE INGRESAR�N LOS DATOS DE ESTA ARMA EN LA BASE DE DATOS.          \n�DESEA CONTINUAR?");
			if (msj) nuevaArma();
			else{
				activarBotones();
				return false;
			}
		}
	} else {
		activarBotones();
	}
}

function actualizarArma(codigoArma){
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var numeroSerie			= eliminarBlancos(document.getElementById("textSerieArma").value);
	var tipoArma			= document.getElementById("selTipoArma").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaEstado			= document.getElementById("textFechaNuevoEstado").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
  var seccion				= document.getElementById("selSeccion").value;
  
	var parametros = "";
	parametros += "codigo="+codigoArma+"&numeroSerie="+numeroSerie+"&seccion="+seccion;
	parametros += "&tipoArma="+tipoArma+"&marca="+marca+"&modelo="+modelo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaEstado+"&unidad="+unidadUsuario+"&armaBCU=&codigoUnidadAgregado="+codigoUnidadAgregado;
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlActualizaArma.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI(parametros));
	objHttpXMLArmas.onreadystatechange=function(){
		if(objHttpXMLArmas.readyState == 4){
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml = objHttpXMLArmas.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 document.getElementById("estadoBaseDatos").value = estado;
						 activaFechaNuevoEstado();
						 top.leeArmas(unidadUsuario,'','');
						 idCargaListadoArmas = setInterval("cerrarVentanaFichaArmas()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function nuevaArma(){
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var numeroSerie			= eliminarBlancos(document.getElementById("textSerieArma").value);
	var tipoArma			= document.getElementById("selTipoArma").value;
	var marca				= document.getElementById("selMarca").value;
	var modelo				= document.getElementById("selModelo").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaEstado			= document.getElementById("textFechaNuevoEstado").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;
  var seccion		     	= document.getElementById("selSeccion").value;
	
	var parametros = "";
	parametros += "numeroSerie="+numeroSerie;
	parametros += "&tipoArma="+tipoArma+"&marca="+marca+"&modelo="+modelo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaEstado+"&unidad="+unidadUsuario+"&armaBCU=&codigoUnidadAgregado="+codigoUnidadAgregado;
  parametros += "seccion="+seccion;
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlNuevaArma.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI(parametros));
	objHttpXMLArmas.onreadystatechange=function(){
		if(objHttpXMLArmas.readyState == 4){
			//alert(objHttpXMLArmas.responseText);
			if (objHttpXMLArmas.responseText != "VACIO"){
				var xml = objHttpXMLArmas.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						top.leeArmas(unidadUsuario,'','');
						idCargaListadoArmas = setInterval("cerrarVentanaFichaArmas()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function cerrarVentanaFichaArmas(){
	if (top.cargaListadoArmas == 1){
		top.document.getElementById("cubreFondo").style.display = "none";
		clearInterval(idCargaListadoArmas);
		top.Windows.closeAll();
	}
}

function liberaArma(){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var msj=confirm("SACAR� ESTA ARMA DE LA OFERTA DE LA UNIDAD.                                       \n�DESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var codigoArma = eliminarBlancos(document.getElementById("idArma").value);
  	var seccion		 = document.getElementById("selSeccion").value;
  	
		var parametros = "";
		parametros += "codigoArma="+codigoArma;
		parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
		parametros += "&seccion="+seccion;
		
		var objHttpXMLArmas = new AJAXCrearObjeto();
		objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlLiberaArma.php",true);
		objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLArmas.send(encodeURI(parametros));
		objHttpXMLArmas.onreadystatechange=function(){
			if(objHttpXMLArmas.readyState == 4){
				if (objHttpXMLArmas.responseText != "VACIO"){
					//alert(objHttpXMLArmas.responseText);
					var xml = objHttpXMLArmas.responseXML.documentElement;
					for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
						if (codigo == 1){
							alert('EL ARMA FUE DEJADA DISPONIBLE PARA OTRA UNIDAD ......        ');
							top.leeArmas(unidadUsuario,'','');
						 	idCargaListadoArmas = setInterval("cerrarVentanaFichaArmas()",1000);
						}
						else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
					}
				}
			}
		}
	}
	else{
		activarBotones();
	}
}

function bajaArma(){
	var unidadUsuario = document.getElementById("unidadUsuario").value;
	var seccion		 = document.getElementById("selSeccion").value;
	
	desactivarBotones();
	var codigoArma = eliminarBlancos(document.getElementById("idArma").value)
	var parametros = "";
	parametros += "codigoArma="+codigoArma;
	parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
	parametros += "&seccion="+seccion;
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlBajaArma.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI(parametros));
	objHttpXMLArmas.onreadystatechange=function()	{
		if(objHttpXMLArmas.readyState == 4)	{
			if (objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml = objHttpXMLArmas.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('EL ARMA FUE DADA DE BAJA ......        ');
						top.leeArmas(unidadUsuario,'','');
					 	idCargaListadoArmas = setInterval("cerrarVentanaFichaArmas()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function activaFechaNuevoEstado(){
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value || (document.getElementById("selSeccion").value != document.getElementById("seccionBaseDatos").value)){
		document.getElementById("labFechaEstado").disabled= "";
		document.getElementById("imagenCalendarioFichaArma").style.visibility = "visible"; 
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
		document.getElementById("imagenCalendarioFichaArma").style.visibility = "hidden";
		document.getElementById("textFechaNuevoEstado").value = "";
		document.getElementById("textFechaNuevoEstado").style.backgroundColor = "#E6E6E6";
		
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
	}
}

function desactivarBotones(){
	document.getElementById("btnDejarDisponible").disabled = "true";
	document.getElementById("btnBaja").disabled = "true";
	document.getElementById("btnGuardar").disabled = "true";
	document.getElementById("btnCerrar").disabled = "true";
}

function activarBotones(){
	var permisoRegistrar = document.getElementById("permisoRegistrar").value;
	if(permisoRegistrar) {
		document.getElementById("btnDejarDisponible").disabled = "";
		document.getElementById("btnBaja").disabled = "";
		document.getElementById("btnGuardar").disabled = "";
	}
	document.getElementById("btnCerrar").disabled = "";
}

function activaBuscaUnidadAgregado(){
	desactivarBotones();
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}

function activaVentanaIngresoFecha(boton){
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";	
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este Armamento :"
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo la Baja de este Armamento :"
}

function desactivaVentanaIngresoFecha(){
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("ventanaIngresoFecha").style.display  = "none";
}

function aceptaFechaVentanaIngresoFecha(){
	var ultimaFecha = document.getElementById("ultimaFecha").value;
	var tipo = document.getElementById("textTipo").value;
	var fecha = document.getElementById("textFechaVentanaFecha").value;
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	if (fecha == ""){
		alert("DEBE INDICAR UNA FECHA ....");
		return false;
	}
	
	var comparaFechaLimite = comparaFecha(fechaLimite,fecha);
	if (unidadBloqueada == 1 && comparaFechaLimite == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR A LA FECHA DE BLOQUEO, QUE CORRESPONDE AL " + fechaLimite);
		return false;
	}
	
	var fechaMayor = comparaFecha(ultimaFecha,fecha);
	if (fechaMayor == 1){
		alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFecha);
		return false;
	}
	
	document.getElementById("textFechaNuevoEstado").value = fecha;
	var cantidadServicio = controlEstadoArma();
	if(cantidadServicio!=""){
		alert(cantidadServicio);
		activarBotones();
		return false;
	}
	
	document.getElementById("ventanaIngresoFecha").style.display  = "none";
	document.getElementById("cubreVentana").style.display = "none";
	
	if (tipo == 1) liberaArma();
	if (tipo == 2) activaVentanaIngresoContrasena();
}

function validarBaja(){
	var valida = "";
	var msj=confirm("SACAR� ESTA ARMA DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n�DESEA CONTINUAR?...");
	if (msj){
		activaVentanaIngresoContrasena();
	} else {
		activarBotones();
	}
}

function activaVentanaIngresoContrasena(){
	desactivarBotones();
	document.getElementById("cubreVentana").style.display = "";
	document.getElementById("ventanaIngresoContrasena").style.display  = "";
	document.getElementById("textTituloContrasena").innerHTML = "INGRESE SU CONTRASE�A PARA VALIDAR LA BAJA DEL ARMAMENTO:";
}

function validaContrasena(){
	var codigoArma = document.getElementById("idArma").value;
	var valida = document.getElementById("textContrasena").value;
	var contrasena = document.getElementById("contrasena").value;
	
	if(valida == ""){
		document.getElementById("textContrasena").focus();
		alert("DEBE INGRESAR SU CLAVE DE USUARIO PROSERVIPOL");
		return false;
	}
	if (valida == contrasena){
		bajaArma(codigoArma);
	}
	else{
		document.getElementById("textTituloContrasena").innerHTML = "CONTRASE�A ERRONEA, VUELVA A INGRESAR SU CONTRASE�A PARA VALIDAR LA BAJA EL ARMAMENTO:";
		document.getElementById("textContrasena").value = "";
	}
}

function desactivaVentanaIngresoContrasena(){
	activarBotones();
	document.getElementById("cubreVentana").style.display = "none";
	document.getElementById("ventanaIngresoContrasena").style.display  = "none";
}

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";
	if (sentido == "desc") nuevoSentido = "asc";
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	
	if(document.getElementById("labColUnidad")!=null){
		leeArmasA(unidad, atributo, sentido);
	}
	else{
		leeArmas(unidad, atributo, sentido);
	}
	
	switch(atributo){
		case "tipo":
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColTipo").innerHTML  = "TIPO ARMA&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colTipo").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "marca":
			document.getElementById("labColTipo").innerHTML = "TIPO ARMA";
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colMarca").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "serie":
			document.getElementById("labColTipo").innerHTML = "TIPO ARMA";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colSerie").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "seccion":
			document.getElementById("labColTipo").innerHTML = "TIPO ARMA";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML  = "SECCION&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colSeccion").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML = "ESTADO";
			}
			break;
			
		case "estado":
			document.getElementById("labColTipo").innerHTML = "TIPO ARMA";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			if(document.getElementById("labColUnidad")!=null){
				document.getElementById("labColUnidad").innerHTML = "UNIDAD ORIGEN";
			}
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
			}
			if(document.getElementById("labColEstado")!=null){
				document.getElementById("labColEstado").innerHTML  = "ESTADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
				document.getElementById("colEstado").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			}
			break;
			
		case "unidad":
			document.getElementById("labColTipo").innerHTML = "TIPO ARMA";
			document.getElementById("labColMarca").innerHTML = "MARCA/MODELO";
			document.getElementById("labColSerie").innerHTML = "NRO. SERIE";
			if(document.getElementById("labColSeccion")!=null){
				document.getElementById("labColSeccion").innerHTML = "SECCION";
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
	idCargaListadoArmas = setInterval("tituloColumnaNormal("+columna.id+")",500);
}

function tituloColumnaNormal(columna){
	if (cargaListadoArmas == 1){
		clearInterval(idCargaListadoArmas);
		cambiarClase(columna,'nombreColumna');
	}
}

function controlEstadoArma(){
	var fecha1	= document.getElementById("textFechaNuevoEstado").value;
	var idArma  = document.getElementById("idArma").value;
	var fecha2 	= '01-01-3000';
	var mensaje	= "";
	if(idArma=='') idArma = 0;
	var objHttpXMLArma = new AJAXCrearObjeto();
	objHttpXMLArma.open("POST","./xml/xmlServicios/xmlListaServiciosPorArmas.php",false);
	objHttpXMLArma.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArma.send(encodeURI("codigoArma="+idArma+"&fecha1="+fecha1+"&fecha2="+fecha2));
	//alert(objHttpXMLArma.responseText);
	if (objHttpXMLArma.responseText != "VACIO"){
		var xml = objHttpXMLArma.responseXML.documentElement;
		mensaje += "NO PUEDE CAMBIAR DE ESTADO, PORQUE TIENE LOS SIGUIENTES SERVICIOS ASIGNADOS:\n\n";
		if (xml.getElementsByTagName('servicio').length > 10) var cantidadServiciosMostar = 10;
		else var cantidadServiciosMostar = xml.getElementsByTagName('servicio').length;
		CantServicios = cantidadServiciosMostar;
		for(var i=0;i<cantidadServiciosMostar;i++){
			var fecha 		= (xml.getElementsByTagName('fecha')[i].text||xml.getElementsByTagName('fecha')[i].textContent||"");
			var servicio	= (xml.getElementsByTagName('desServicio')[i].text||xml.getElementsByTagName('desServicio')[i].textContent||"");
			var unidad 	  = (xml.getElementsByTagName('desUnidad')[i].text||xml.getElementsByTagName('desUnidad')[i].textContent||"");
			mensaje += (i+1) +". " + fecha+" - SERVICIO "+servicio.toUpperCase()+"\n   ("+unidad.toUpperCase()+").\n";
		}
		if (cantidadServiciosMostar < xml.getElementsByTagName('servicio').length) mensaje += "...";
	}
	return mensaje;
}

function listaArmas(unidad, nombreObjeto, multiple, campo, sentido){
	cargaListadoArmas = 0;
	
	document.getElementById(nombreObjeto).length = null;
	if (multiple == false ){
		var datosOpcion = new Option("SELECCIONE ARMA ... ", 0, "", "");
		document.getElementById(nombreObjeto).options[0] = datosOpcion;
	}
	
	var objHttpXMLArmas = new AJAXCrearObjeto();
	objHttpXMLArmas.open("POST","./xml/xmlArmas/xmlListaArmasConsulta.php",true);
	objHttpXMLArmas.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLArmas.send(encodeURI("codigoUnidad="+unidad+"&campo="+campo+"&sentido="+sentido));
	
	objHttpXMLArmas.onreadystatechange=function(){
		//alert(objHttpXMLArmas.readyState);
		if(objHttpXMLArmas.readyState == 4){
			//alert(objHttpXMLArmas.responseText);
			if(objHttpXMLArmas.responseText != "VACIO"){
				//alert(objHttpXMLArmas.responseText);
				var xml 				= objHttpXMLArmas.responseXML.documentElement;
				var codigo	 			= "";
				var nSerie	 			= "";
				var modelo	 			= "";
				var marca	 			= "";
				
				var sw 				 	= 0;
				var fondoLinea			= "";
				var resaltarLinea 		= "";
				var lineaSinResaltar	= "";
				
				for(i=0;i<xml.getElementsByTagName('arma').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nSerie	= (xml.getElementsByTagName('numeroSerie')[i].text||xml.getElementsByTagName('numeroSerie')[i].textContent||"");
					modelo	= (xml.getElementsByTagName('modelo')[i].text||xml.getElementsByTagName('modelo')[i].textContent||"");
					marca	= (xml.getElementsByTagName('marca')[i].text||xml.getElementsByTagName('marca')[i].textContent||"");
					tipo	= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					
					var description = tipo+" - "+marca+" "+modelo+" - "+nSerie;
					
					var puntero;
					if (!multiple) puntero = i+1;
					else puntero = i;
						
					var datosOpcion = new Option(description, codigo, "", "");
					document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
				}
				cargaListadoArmas = 1;
			}
		}
	}
}
