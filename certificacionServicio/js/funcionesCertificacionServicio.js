function cambiarClase(objeto, clase){
	objeto.className = clase;
}

function actualizarTamanoLista2(idObjeto){
	if (/MSIE 7.0/i.test(navigator.userAgent)) var altura = window.document.body.parentNode.offsetHeight - 320;
	else var altura = window.innerHeight - 320;
	document.getElementById(idObjeto).style.height= altura+"px";
}

function cerrarAplicacion(){
	var caduca=new Date(); 
	window.location.replace("logout.php");
}

function abrirVentana(titulo, ancho, alto, pagina, nroLinea, estado, posX, posY){
	var win = new Window({
		className	  : "mac_os_x", 
		title		  	: titulo, 
		width		  	: ancho, 
		height	  	: alto, 
		top		  		: posX,
		left		  	: posY,
		minimizable : false, 
		maximizable : false,
		closable	  : false,
		draggable	  : true,
		resizable	  : false,
		url		  		: pagina
	});
	win.show(estado);
}

function cerrarVentana(){
	Windows.closeAll();
	return true;
}

function buscaUnidades(codigoPadre){
	document.getElementById("selUnidad").disabled=true;
	document.getElementById("selMes").disabled=true;
	document.getElementById("selAnno").disabled=true;
	document.getElementById("selUnidad").options[0] = new Option("CARGANDO ...","0","","");
	var objHttpXMLCargaDatos = new AJAXCrearObjeto();
	objHttpXMLCargaDatos.open("POST","./xml/xmlUnidades/xmlUnidades.php",true);
	objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCargaDatos.send("codigoUnidad="+codigoPadre);
	objHttpXMLCargaDatos.onreadystatechange=function(){
		if(objHttpXMLCargaDatos.readyState == 4){
			//alert(objHttpXMLCargaDatos.responseText);
			if (objHttpXMLCargaDatos.responseText != "VACIO"){
				//alert(objHttpXMLCargaDatos.responseText);		
				var xml	= objHttpXMLCargaDatos.responseXML.documentElement;
				var codigoUnidad;
				var descripcionUnidad;
				for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++){
					codigoUnidad      = (xml.getElementsByTagName('codigoUnidad')[i].text||xml.getElementsByTagName('codigoUnidad')[i].textContent||"");
					descripcionUnidad = (xml.getElementsByTagName('descripcionUnidad')[i].text||xml.getElementsByTagName('descripcionUnidad')[i].textContent||"");
					document.getElementById("selUnidad").options[i] = new Option(descripcionUnidad,codigoUnidad,"","");
				}
				document.getElementById("selUnidad").disabled=false;
				document.getElementById("selMes").disabled=false;
				document.getElementById("selAnno").disabled=false;
			}
			else{
				alert("PROBLEMAS CON LA BASE DE DATOS.  CODIGO UNIDAD.");
			}
		}
	}
}

function verificaIngresoDatos(mes,anno,unidad){
	if (unidad==0){
		alert("DEBE SELECCIONAR UNIDAD.");
		document.getElementById("selUnidad").focus();
	}
	else if (mes==0){
		alert("DEBE SELECCIONAR MES.");
		document.getElementById("selMes").focus();
	}
	else if(anno==0){
		alert("DEBE SELECCINAR A�O.");
		document.getElementById("selAnno").focus();
	}
	else{
		iniciaCargaDatos(mes,anno,unidad);
	}
}

function iniciaCargaDatos(mes,anno,unidad){
	document.getElementById("selUnidad").disabled=true;
	document.getElementById("selMes").disabled=true;
	document.getElementById("selAnno").disabled=true;
	var div=document.getElementById("listadoIngresoServicios");
	div.innerHTML="<img src='./certificacionServicio/img/loading1.gif'> CARGANDO ...";
	var fecha1 = document.getElementById("textBuscar").value;
	var fechaLimite = document.getElementById("textFechaLimite").value;
	var unidadBloqueda = document.getElementById("textUnidadBloqueada").value;
	var fecha2 = "02"+"-"+mes+"-"+anno;
	var comparaFechaLimite = comparaFecha(fecha2, fechaLimite);
	//alert(comparaFechaLimite);
	var objHttpXMLCargaDatos = new AJAXCrearObjeto();
	objHttpXMLCargaDatos.open("POST","./certificacionServicio/baseDatos/dbCertificacionServicio.php",true);
	objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLCargaDatos.send("mes="+mes+"&anno="+anno+"&unidad="+unidad);
	objHttpXMLCargaDatos.onreadystatechange=function(){
		if(objHttpXMLCargaDatos.readyState == 4){
			//alert(objHttpXMLCargaDatos.responseText);
			var xml 			 				= objHttpXMLCargaDatos.responseXML.documentElement;
			var listadoCargaDatos = "";
			var sw 				 				= 0;
			var fondoLinea		 		= "";
			var resaltarLinea 	  = "";
			var lineaSinResaltar  = "";
			listadoCargaDatos 		= "";
			sw 				 						= 0;
			fondoLinea		 				= "";
			resaltarLinea 	 			= "";
			lineaSinResaltar 			= "";
			descripcionUnidad 		= "";
			for(i=0;i<xml.getElementsByTagName('certificado').length;i++){
				if (sw==0) {fondoLinea = "linea1"; sw = 1;}
				else {fondoLinea = "linea2"; sw = 0;}
				
				resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
				lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
				
				fechaServicios  	= (xml.getElementsByTagName('fechaServicios')[i].text||xml.getElementsByTagName('fechaServicios')[i].textContent||"");
				estado          	= (xml.getElementsByTagName('estado')[i].text||xml.getElementsByTagName('estado')[i].textContent||"");
				grado           	= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
				codigoFuncionario  	= (xml.getElementsByTagName('codigoFuncionario')[i].text||xml.getElementsByTagName('codigoFuncionario')[i].textContent||"");
				nombre          	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
				apellidoPaterno 	= (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
				apellidoMaterno 	= (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
				fechaCertificado	= (xml.getElementsByTagName('fechaCertificado')[i].text||xml.getElementsByTagName('fechaCertificado')[i].textContent||"");
				horaCertificado		= (xml.getElementsByTagName('horaCertificado')[i].text||xml.getElementsByTagName('horaCertificado')[i].textContent||"");
				descripcionUnidad	= (xml.getElementsByTagName('descripcionUnidad')[0].text||xml.getElementsByTagName('descripcionUnidad')[0].textContent||"");
				
				nombreValidador = "";
				nombreValidador = grado+" "+nombre+" "+apellidoPaterno+" "+apellidoMaterno;
				
				if(fechaCertificado != "" && (unidadBloqueda == 1 && comparaFechaLimite == 2)){
					listadoCargaDatos += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:abrirVentana('','990','520','./certificacionServicio/fichaCertificacionServicioBloqueado.php?unidadServicios="+unidad+"&fechaServicios="+fechaServicios+"&fechaValidados="+fechaCertificado+"&horaCertificado="+horaCertificado+"&codigoFuncionario="+codigoFuncionario+"&descripcionUnidad="+descripcionUnidad+"','','','5','5')\">";
				}
				else if(fechaCertificado == "" && (unidadBloqueda == 1 && comparaFechaLimite == 2)){
					listadoCargaDatos += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:abrirVentana('','990','520','./certificacionServicio/fichaCertificacionServicioBloqueado.php?unidadServicios="+unidad+"&fechaServicios="+fechaServicios+"&fechaValidados="+fechaCertificado+"&horaCertificado="+horaCertificado+"&codigoFuncionario="+codigoFuncionario+"&descripcionUnidad="+descripcionUnidad+"','','','5','5')\">";
				}
				else{
					listadoCargaDatos += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:abrirVentana('','990','520','./certificacionServicio/fichaCertificacionServicio.php?unidadServicios="+unidad+"&fechaServicios="+fechaServicios+"&fechaValidados="+fechaCertificado+"&horaCertificado="+horaCertificado+"&codigoFuncionario="+codigoFuncionario+"&descripcionUnidad="+descripcionUnidad+"','','','5','5')\">";
				}
				
				listadoCargaDatos += "<td width='24%'  align='center'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
				listadoCargaDatos += "<td width='12%'  align='center'><div id='valorColumna'>"+fechaServicios+"</div></td>";
				listadoCargaDatos += "<td width='12%'  align='center'><div id='valorColumna'>"+estado+"</div></td>";
				listadoCargaDatos += "<td width='38%' align='center'><div id='valorColumna'>"+nombreValidador+"</div></td>";
				listadoCargaDatos += "<td width='14%' align='center'><div id='valorColumna'>"+fechaCertificado+"</div></td>";
				listadoCargaDatos += "</tr>";
			}
			div.innerHTML= "<table width='100%' cellspacing='1' cellpadding='1'>"+listadoCargaDatos+"</table>";
			document.getElementById("selMes").disabled=false;
			document.getElementById("selAnno").disabled=false;
			document.getElementById("selUnidad").disabled=false;
		}
	}
}

function abrirInforme(){
	if(new Date(selAnno.value+'/'+selMes.value+'/01') < new Date('2022/05/01')){
		alert("EL INFORME SOLO SE ENCUENTRA DISPONIBLE DESDE MAYO 2022 EN ADELANTE");
		return;
	}
	let GET = 'codUnidad='+selUnidad.value+'&mes='+selMes.value+'&anno='+selAnno.value+'&desUnidad='+selUnidad.textContent;
	window.open('./imprimible/servicios/informeValidaciones.php?'+GET, '_blank');
}
