var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionarios(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	//var fechat = document.getElementById("fechat").value;
	//alert(fechat);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaRequerimientos.php",true);
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
				var fecha   = "";
				var ide   = "";
				var diferencia = "";
				var implicado ="";
				var codMov="";
				var correlativo ="";
				var LinkMovimiento="";
			
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
				  ide     	 = xml.getElementsByTagName('ide')[i].text;
				  diferencia    	 = xml.getElementsByTagName('dif')[i].text;
				  implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
				  codMov 	 = xml.getElementsByTagName('codMov')[i].text;
				  correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '830', '630','fichaSolicitudUnidad.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
				if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(codMov==60 || codMov==70 || codMov==80)
					{
						var estadoNuevo="EN TRAMITE";
						}else{
							var estadoNuevo=estado;
							}
					
						if(estado=="REPARACION SIN DEVOLUCION"){
					var color="red";   
        }else if(estado=="REPARACION CON DEVOLUCION"){
        	var color="blue";
        	}else{
        		var color="";
        		}
        		
        		if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		//alert(fecha);
        		//if(estado==10) var estadoMuestra="ENVIADA";
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
        		
        		//if(correlativo==2)
        		var contador=correlativo-1;
        		if(contador==0)contador=1;
        		//alert(contador);
        		
        	  if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        		if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        		
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='20%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					//listadoFuncionarios += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+ide+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+contador+"</div></td>";
					listadoFuncionarios+= "<td width='18%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estadoNuevo+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
				

				//var cantidadServicio = controlTemporizador(unidad);
			//var temporizador = actualizaTemporizador(unidad);
					//**************************************
     //Llamo a la nueva funcion --inicio
 
        var cantidadServicio = controlTemporizador(unidad);
        //alert(cantidadServicio);  
        if(cantidadServicio == 1){
     var temporizador ="";
        //var temporizador = actualizaTemporizador(unidad);
            //return false;
        } else{
        	var temporizador ="";
        	}  
      //fin  
     //************************************     
				
			}
		}
	}
}

var cargaListadoFuncionarios25;
var idCargaListadoFuncionarios25;

function leeFuncionarios25(unidad, campo, sentido){
	cargaListadoFuncionarios25 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
	//var fechat = document.getElementById("fechat").value;
	//alert(fechat);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaRequerimientosCerradas.php",true);
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
				var fecha   = "";
				var ide   = "";
				var diferencia = "";
				var implicado ="";
				var codMov="";
				var correlativo ="";
				var LinkMovimiento="";
			
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
				  ide     	 = xml.getElementsByTagName('ide')[i].text;
				  diferencia    	 = xml.getElementsByTagName('dif')[i].text;
				  implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
				  codMov 	 = xml.getElementsByTagName('codMov')[i].text;
				  correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudUnidad.php?codigoUnidad="+unidad+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
				if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(codMov==60 || codMov==70 || codMov==80)
					{
						var estadoNuevo="EN TRAMITE";
						}else{
							var estadoNuevo=estado;
							}
					
						if(estado=="REPARACION SIN DEVOLUCION"){
					var color="red";   
        }else if(estado=="REPARACION CON DEVOLUCION"){
        	var color="blue";
        	}else{
        		var color="";
        		}
        		
        		if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		//alert(fecha);
        		//if(estado==10) var estadoMuestra="ENVIADA";
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
        		
        		//if(correlativo==2)
        		var contador=correlativo-1;
        		if(contador==0)contador=1;
        		//alert(contador);
        		
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='20%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					//listadoFuncionarios += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+ide+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+contador+"</div></td>";
					listadoFuncionarios+= "<td width='18%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estadoNuevo+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios25 = 1;
				

				//var cantidadServicio = controlTemporizador(unidad);
			//var temporizador = actualizaTemporizador(unidad);
					//**************************************
     //Llamo a la nueva funcion --inicio
 
        var cantidadServicio = controlTemporizador(unidad);
        //alert(cantidadServicio);  
        if(cantidadServicio == 1){
     var temporizador ="";
        //var temporizador = actualizaTemporizador(unidad);
            //return false;
        } else{
        	var temporizador ="";
        	}  
      //fin  
     //************************************     
				
			}
		}
	}
}

var cargaListadoFuncionarios2;
var idCargaListadoFuncionarios2;
var idAsignaSelectFichaVehiculo2;

function leeFuncionarios2(unidad, campo, sentido){
	cargaListadoFuncionarios2 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);
  //alert(nombreBuscar);
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientos.php",true);
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
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				var movimientoCodigo ="";
				var depto ="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					movimientoCodigo 	 = xml.getElementsByTagName('tipoMovimiento')[i].text;
					depto 	 = xml.getElementsByTagName('seccionDepto')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		
        		if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        		if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        		
        		if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var estado="EN TRAMITE";
        		
        	 //alert(estado);
        
        		//alert(movimientoCodigo);
        		
        		//alert(depto);
        		
        		if(depto==20 && movimientoCodigo==100){
        			
        			var estado2="EN TRAMITE"
        			
        		}else{
        			var estado2=implicado;
        			} 
        		
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
        		
        		//alert(fecha);
        		
        	//linkMovimiento = '<a href="fichaMovimientos.php?rutFuncionario='+codigo+'&codColor='+codigo+'&codFolio='+codigo+'" target="_blank"> <img src="img/busqueda.png" width=15 height=15 ></a>';
        	//link2='<a href="#" onclick="javascript:abrirVentana("DATOS MOVIMIENTOS ...", "720", "575","fichaMovimientos.php")">Movimientos</a>';
          //link2='<a href='javascript:popup('pagina.html')'>abrir</a>';
          //var link2 = "onClick='javascript:abrirVentana('DATOS MOVIMIENTOS ...', '720', '575','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5'); return false;'>Movimiento";
					//var link2="javascript:abrirVentana('DATOS SOLICITUD ...', '720', '575','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+estado2+"</div></td>";
					//listadoFuncionarios+= "<td width='5%' align='center'"+mostrarEtiqueta+"><font color="+color+" id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onClick=\""+link2+"\"><div id='valorColumna'>"+imagen+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios2 = 1;
				//mensajeUsuario();
			//var correlativo	=	controlTemporizador2();
       //alert(correlativo);
     //alert();
     //controlTemporizador2();
         //Llamo a la nueva funcion --inicio
 
        //var cantidadServicio2 = controlTemporizador2();
        //alert(cantidadServicio);  
        //if(cantidadServicio2 == 1){
   
        //var temporizador2 = actualizaTemporizador2(unidad);
            //return false;
        //} else{
        //	var temporizador2 ="";
        //	}  
      //fin  
			}
		}
	}
}

var cargaListadoFuncionarios21;
var idCargaListadoFuncionarios21;
var idAsignaSelectFichaVehiculo21;

function leeFuncionarios21(unidad, campo, sentido){
	cargaListadoFuncionarios21 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientosDerivadas.php",true);
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
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		
        		
        		
        		
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
        		
        		//alert(fecha);
        		
        	//linkMovimiento = '<a href="fichaMovimientos.php?rutFuncionario='+codigo+'&codColor='+codigo+'&codFolio='+codigo+'" target="_blank"> <img src="img/busqueda.png" width=15 height=15 ></a>';
        	//link2='<a href="#" onclick="javascript:abrirVentana("DATOS MOVIMIENTOS ...", "720", "575","fichaMovimientos.php")">Movimientos</a>';
          //link2='<a href='javascript:popup('pagina.html')'>abrir</a>';
          //var link2 = "onClick='javascript:abrirVentana('DATOS MOVIMIENTOS ...', '720', '575','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5'); return false;'>Movimiento";
					//var link2="javascript:abrirVentana('DATOS SOLICITUD ...', '720', '575','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					//listadoFuncionarios+= "<td width='5%' align='center'"+mostrarEtiqueta+"><font color="+color+" id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onClick=\""+link2+"\"><div id='valorColumna'>"+imagen+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios21 = 1;
				//mensajeUsuario();
			//var correlativo	=	controlTemporizador2();
       //alert(correlativo);
     //alert();
     //controlTemporizador2();
         //Llamo a la nueva funcion --inicio
 
        //var cantidadServicio2 = controlTemporizador2();
        //alert(cantidadServicio);  
        //if(cantidadServicio2 == 1){
   
        //var temporizador2 = actualizaTemporizador2(unidad);
            //return false;
        //} else{
        //	var temporizador2 ="";
        //	}  
      //fin  
			}
		}
	}
}

var cargaListadoFuncionarios24;
var idCargaListadoFuncionarios24;
var idAsignaSelectFichaVehiculo24;

function leeFuncionarios24(unidad, campo, sentido){
	cargaListadoFuncionarios24 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientosCerradas.php",true);
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
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		
        		
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
        		
        		//alert(fecha);
        		
        	//linkMovimiento = '<a href="fichaMovimientos.php?rutFuncionario='+codigo+'&codColor='+codigo+'&codFolio='+codigo+'" target="_blank"> <img src="img/busqueda.png" width=15 height=15 ></a>';
        	//link2='<a href="#" onclick="javascript:abrirVentana("DATOS MOVIMIENTOS ...", "720", "575","fichaMovimientos.php")">Movimientos</a>';
          //link2='<a href='javascript:popup('pagina.html')'>abrir</a>';
          //var link2 = "onClick='javascript:abrirVentana('DATOS MOVIMIENTOS ...', '720', '575','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5'); return false;'>Movimiento";
					//var link2="javascript:abrirVentana('DATOS SOLICITUD ...', '720', '575','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					//listadoFuncionarios+= "<td width='5%' align='center'"+mostrarEtiqueta+"><font color="+color+" id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onClick=\""+link2+"\"><div id='valorColumna'>"+imagen+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios24 = 1;
				//mensajeUsuario();
			//var correlativo	=	controlTemporizador2();
       //alert(correlativo);
     //alert();
     //controlTemporizador2();
         //Llamo a la nueva funcion --inicio
 
        //var cantidadServicio2 = controlTemporizador2();
        //alert(cantidadServicio);  
        //if(cantidadServicio2 == 1){
   
        //var temporizador2 = actualizaTemporizador2(unidad);
            //return false;
        //} else{
        //	var temporizador2 ="";
        //	}  
      //fin  
			}
		}
	}
}

var cargaListadoFuncionarios3;
var idCargaListadoFuncionarios3;
function leeFuncionarios3(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios3 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaIngenieroRequerimientos.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario);
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));  
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{   
			
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var serie	 			= "";
				var tarjeta		= "";
				var imei		= "";
				var fecha   = "";
				var unidad ="";
				var implicado ="";
				var deriva ="";
				var ide   = "";
				var diferencia="";
				var correlativo="";
				var codUnidad="";
				
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//console.log(xml.getElementsByTagName('requerimiento').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					codUnidad	 	 = xml.getElementsByTagName('codUnidad')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					deriva 	         = xml.getElementsByTagName('deriva')[i].text;
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '1500', '900','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					//console.log(estado);
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        		if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        		
        		//if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+codUnidad+" - "+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					//listadoFuncionarios += "<td width='10%' align='left'><font color="+color+"><div id='valorColumna'>"+ide+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios3 = 1;
			}
		}
	}
}

var cargaListadoFuncionarios26;
var idCargaListadoFuncionarios26;

function leeFuncionarios26(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios26 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaIngenieroRequerimientosCerradas.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));  
	
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
				var fecha   = "";
				var unidad ="";
				var implicado ="";
				var deriva ="";
				var ide   = "";
				var diferencia="";
				var correlativo="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					deriva 	         = xml.getElementsByTagName('deriva')[i].text;
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		//if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					//listadoFuncionarios += "<td width='10%' align='left'><font color="+color+"><div id='valorColumna'>"+ide+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='4%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios26 = 1;
				//mensajeUsuario();
			}
		}
	}
}

var cargaListadoFuncionarios4;
var idCargaListadoFuncionarios4;

function leeFuncionarios4(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios4 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaOpuRequerimientos.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));  
	
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
				var fecha   = "";
				var unidad ="";
				var implicado ="";
				var deriva ="";
				var ide   = "";
				var correlativo="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					deriva 	         = xml.getElementsByTagName('deriva')[i].text;
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        		if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        		
        		//if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='38%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					//listadoFuncionarios += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+ide+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios4 = 1;
				//mensajeUsuario();
			}
		}
	}
}

var cargaListadoFuncionarios27;
var idCargaListadoFuncionarios27;

function leeFuncionarios27(unidad, campo, sentido, usuario){
	cargaListadoFuncionarios27 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaOpuRequerimientosCerradas.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&nombreBuscar="+nombreBuscar+"&campo="+campo+"&sentido="+sentido+"&usuario="+usuario));  
	
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
				var fecha   = "";
				var unidad ="";
				var implicado ="";
				var deriva ="";
				var ide   = "";
				var correlativo="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					deriva 	         = xml.getElementsByTagName('deriva')[i].text;
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		//if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
						
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='38%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					//listadoFuncionarios += "<td width='20%' align='left'><font color="+color+"><div id='valorColumna'>"+ide+"</div></td>";
					listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios27 = 1;
				//mensajeUsuario();
			}
		}
	}
}

var cargaListadoFuncionarios28;
var idCargaListadoFuncionarios28;
var idAsignaSelectFichaVehiculo28;

function leeFuncionarios28(unidad, campo, sentido){
	cargaListadoFuncionarios28 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaAntecedentesFaltantes.php",true);
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
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        		
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
        		
        		//alert(fecha);
        		
        	//linkMovimiento = '<a href="fichaMovimientos.php?rutFuncionario='+codigo+'&codColor='+codigo+'&codFolio='+codigo+'" target="_blank"> <img src="img/busqueda.png" width=15 height=15 ></a>';
        	//link2='<a href="#" onclick="javascript:abrirVentana("DATOS MOVIMIENTOS ...", "720", "575","fichaMovimientos.php")">Movimientos</a>';
          //link2='<a href='javascript:popup('pagina.html')'>abrir</a>';
          //var link2 = "onClick='javascript:abrirVentana('DATOS MOVIMIENTOS ...', '720', '575','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5'); return false;'>Movimiento";
					//var link2="javascript:abrirVentana('DATOS SOLICITUD ...', '720', '575','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					//listadoFuncionarios+= "<td width='5%' align='center'"+mostrarEtiqueta+"><font color="+color+" id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onClick=\""+link2+"\"><div id='valorColumna'>"+imagen+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios28 = 1;
				//mensajeUsuario();
			//var correlativo	=	controlTemporizador2();
       //alert(correlativo);
     //alert();
     //controlTemporizador2();
         //Llamo a la nueva funcion --inicio
 
        //var cantidadServicio2 = controlTemporizador2();
        //alert(cantidadServicio);  
        //if(cantidadServicio2 == 1){
   
        //var temporizador2 = actualizaTemporizador2(unidad);
            //return false;
        //} else{
        //	var temporizador2 ="";
        //	}  
      //fin  
			}
		}
	}
}

var cargaListadoFuncionarios29;
var idCargaListadoFuncionarios29;
var idAsignaSelectFichaVehiculo29;

function leeFuncionarios29(unidad, campo, sentido){
	cargaListadoFuncionarios29 = 0;
	var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalMesAnterior.php",true);
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
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				
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
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('DATOS SOLICITUD ...', '800', '600','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
				
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
        		
        			if(ide=='NULL NULL')var ide = "";
        		if(ide=='NULL')var ide = "";
        		
        		if(estado=="ENVIADA") var estadoMuestra="RECIBIDA";
        		if(estado=="EN TRAMITE: REQUIERE ANTECEDENTES FALTANTES") var color="red";
        		if(estado=="EN TRAMITE: ENVIA ANTECEDENTES FALTANTES") var color="blue";
        		
        		
        		//	if(tarjeta==10) var tarjeta="PROBLEMA SISTEMA"; 
        		//	if(tarjeta==20) var tarjeta="PROBLEMA DE CONEXION"; 
        		//	if(tarjeta==30) var tarjeta="PROBLEMA DE VALIDACION"; 
        			
        		//	if(serie==10) var serie="SISTEMA"; 
        		//	if(serie==20) var serie="DESVALIDACION"; 
        		//	if(serie==30) var serie="LICENCIA"; 
        		//	if(serie==632) var serie="OTROS"; 
        		
        		//alert(fecha);
        		
        	//linkMovimiento = '<a href="fichaMovimientos.php?rutFuncionario='+codigo+'&codColor='+codigo+'&codFolio='+codigo+'" target="_blank"> <img src="img/busqueda.png" width=15 height=15 ></a>';
        	//link2='<a href="#" onclick="javascript:abrirVentana("DATOS MOVIMIENTOS ...", "720", "575","fichaMovimientos.php")">Movimientos</a>';
          //link2='<a href='javascript:popup('pagina.html')'>abrir</a>';
          //var link2 = "onClick='javascript:abrirVentana('DATOS MOVIMIENTOS ...', '720', '575','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5'); return false;'>Movimiento";
					//var link2="javascript:abrirVentana('DATOS SOLICITUD ...', '720', '575','fichaSolicitudProceso.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					var imagen="<img src='img/busqueda.png' width='25' height='25'>";
					var link2 = "javascript:abrirVentana('DATOS MOVIMIENTOS ...', '790', '635','fichaMovimientos.php?codigoUnidad="+tarjeta+"&codigo="+codigo+"','"+nroLinea+"','','5','5')";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><font color="+color+"><div id='valorColumna'>"+unidad1+"</div></td>";
					listadoFuncionarios += "<td width='8%' align='center'><font color="+color+"><div id='valorColumna'>"+serie+"</div></td>";
					listadoFuncionarios += "<td width='10%'><font color="+color+"><div id='valorColumna'>"+imei+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='4%' align='left'><font color="+color+"><div id='valorColumna'>"+fecha+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+diferencia+"</div></td>";
					listadoFuncionarios+= "<td width='3%' align='center'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+correlativo+"</div></td>";
					listadoFuncionarios+= "<td width='10%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					//listadoFuncionarios+= "<td width='5%' align='center'"+mostrarEtiqueta+"><font color="+color+" id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onClick=\""+link2+"\"><div id='valorColumna'>"+imagen+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios29 = 1;
				//mensajeUsuario();
			//var correlativo	=	controlTemporizador2();
       //alert(correlativo);
     //alert();
     //controlTemporizador2();
         //Llamo a la nueva funcion --inicio
 
        //var cantidadServicio2 = controlTemporizador2();
        //alert(cantidadServicio);  
        //if(cantidadServicio2 == 1){
   
        //var temporizador2 = actualizaTemporizador2(unidad);
            //return false;
        //} else{
        //	var temporizador2 ="";
        //	}  
      //fin  
			}
		}
	}
}

function leedatosUsuario(unidad,usuario){

	//alert(unidad);
	//alert(usuario);
	//alert();
	//alert(codigo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlVista.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&usuario="+usuario)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
			  //alert(objHttpXMLFuncionarios.responseText);		
				var xml 				  = objHttpXMLFuncionarios.responseXML.documentElement;
				var unidad	 			= "";
				var zona	        = "";
				var prefectura    = "";
				var comisaria 	  = "";
				var destacamento 	= "";
				var funcionario	  = "";
				var nombre 	      = "";
				var tipo 	        = "";
				var grado         = "";
										
			for(i=0;i<xml.getElementsByTagName('vista').length;i++){

			 unidad	 		   	 = xml.getElementsByTagName('unidad')[i].text;
			 zona	           = xml.getElementsByTagName('zona')[i].text;
			 prefectura      = xml.getElementsByTagName('prefectura')[i].text;
			 comisaria 	     = xml.getElementsByTagName('comisaria')[i].text;
       destacamento    = xml.getElementsByTagName('destacamento')[i].text;
       funcionario     = xml.getElementsByTagName('funcionario')[i].text;
       nombre          = xml.getElementsByTagName('nombre')[i].text;
       tipo            = xml.getElementsByTagName('tipo')[i].text;
       grado           = xml.getElementsByTagName('grado')[i].text;

			
					//document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
	//if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					
					//alert(descUnidadVehiculo);
					//document.getElementById("textNumeroBCU").readOnly 		     = "true";	
					//document.getElementById("textNumeroBCU").value	=serie;
					
					document.getElementById("unidadUsuario").value	=unidad;
				  //document.getElementById("zona").value	=zona;
					//document.getElementById("pref").value	=prefectura;
					//document.getElementById("com").value	=comisaria;
					//document.getElementById("dest").value	=destacamento;
					document.getElementById("codFun").value	=funcionario;
					document.getElementById("nom").value	=nombre;
					document.getElementById("perfil").value	=tipo;
					document.getElementById("grado").value	=grado;
																												
	document.getElementById("mensajeCargando").style.display = "none";
}
   }
  }
 }
}

function leedatosSolicitudUnidad(unidad,solicitud,usuario){

	//alert(unidad);
	//alert(usuario);
	//alert(solicitud);
	//alert();
	//alert(codigo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlDatoUsuarioSolicitud.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&solicitud="+solicitud+"&usuario="+usuario)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
			  //alert(objHttpXMLFuncionarios.responseText);		
				var xml 				      = objHttpXMLFuncionarios.responseXML.documentElement;
				
				var codigo            = "";
				var unidad            = "";
				var tipoRequerimiento = "";
				var problema          = "";
				var observacion       = ""; 
				var fechaInicio       = "";
				var fechaTermino      = "";
				var estado            = "";
				var zona	            = "";
				var prefectura        = "";
				var comisaria 	      = "";
				var destacamento 	    = "";
				var funcionario	      = "";
				var nombre 	          = "";
				var tipo 	            = "";
				var grado             = "";
				var obs               = "";
				var ide1              = "";
				var ide2              = "";
				var texto             = "";
				var mov               = "";
				
										
			for(i=0;i<xml.getElementsByTagName('dato').length;i++){
				
				
				

			 zona	           = xml.getElementsByTagName('zona')[i].text;
			 prefectura      = xml.getElementsByTagName('prefectura')[i].text;
			 comisaria 	     = xml.getElementsByTagName('comisaria')[i].text;
       destacamento    = xml.getElementsByTagName('destacamento')[i].text;
       funcionario     = xml.getElementsByTagName('funcionario')[i].text;
       nombre          = xml.getElementsByTagName('nombre')[i].text;
       tipo            = xml.getElementsByTagName('tipo')[i].text;
       grado           = xml.getElementsByTagName('grado')[i].text;

			 
			 
			 //codigo            = xml.getElementsByTagName('codigo')[i].text;
			 //unidad            = xml.getElementsByTagName('unidad')[i].text;
			 
			 tipoRequerimiento = xml.getElementsByTagName('subproblema')[i].text;
			 problema          = xml.getElementsByTagName('problema')[i].text;
			 obs               = xml.getElementsByTagName('obs')[i].text;
			 ide1              = xml.getElementsByTagName('ide1')[i].text;
			 ide2              = xml.getElementsByTagName('ide2')[i].text;
			 texto              = xml.getElementsByTagName('text')[i].text;
			 mov              = xml.getElementsByTagName('mov')[i].text;

       if(ide1=="NULL") var ide1="";
       if(ide2=="NULL") var ide2="";
       //alert(mov);
       
       if(mov==20 || mov==30 || mov==40 || mov==50 || mov==100){
				desactivarBotones2();
				}
				
        document.getElementById("movimiento").value	=mov;

					//document.getElementById("unidadUsuario").value	=unidad;
				  //document.getElementById("zona").value	=zona;
					//document.getElementById("pref").value	=prefectura;
					//document.getElementById("com").value	=comisaria;
					//document.getElementById("dest").value	=destacamento;
					document.getElementById("codFun").value	=funcionario;
					document.getElementById("nom").value	=nombre;
					document.getElementById("perfil").value	=tipo;
					document.getElementById("grado").value	=grado;
					
					//if(mov==10){
					document.getElementById("obs1").value	=texto.toUpperCase();
				  //}
					document.getElementById("textUnidad").value = ide1;
					document.getElementById("textDia").value = ide2;
					
					document.getElementById("textUnidad2").value=ide1;
					document.getElementById("textServicio").value=ide2;
					
					document.getElementById("textFunc").value=ide1;
					document.getElementById("textRut").value=ide2;
					
					document.getElementById("textFunc2").value= ide1;    
          document.getElementById("textDia2").value= ide2;     
          document.getElementById("textFunc3").value = ide1;   
          document.getElementById("textRut2").value= ide2;     
          document.getElementById("textFunc4").value= ide1;    
          document.getElementById("textRut3").value= ide2;     
          document.getElementById("textFunc5").value= ide1;    
          document.getElementById("textNombre").value= ide2;   
          document.getElementById("textFunc6").value = ide1;   
          document.getElementById("textUnidad3").value	= ide2;
          document.getElementById("textFunc7").value= ide1;    
          document.getElementById("textUsu").value= ide2;  
          
          document.getElementById("textFunc8").value= ide1;    
          document.getElementById("textFunc9").value  = ide1;  
          document.getElementById("textFunc10").value  = ide1; 
          document.getElementById("textFolio").value = ide2;   
          document.getElementById("textFunc11").value  = ide1; 
          document.getElementById("textFolio2").value= ide2;   
          document.getElementById("textBcu").value  = ide1;    
          document.getElementById("textTipoAni").value	= ide2;
          document.getElementById("textBcu2").value= ide1;     
          document.getElementById("textDia3").value= ide1;     
          document.getElementById("textBcu3").value	= ide2;    
          document.getElementById("textBcu4").value	= ide2;    
          document.getElementById("textBcu5").value  = ide1;   
          document.getElementById("textPatente").value	= ide2;
          document.getElementById("textBcu6").value= ide1;     
          document.getElementById("textDia4").value= ide2;     
          document.getElementById("textBcu7").value= ide1;     
          document.getElementById("textPatente2").value= ide2; 
          document.getElementById("textPatente3").value= ide1; 
          document.getElementById("textBcu8").value	= ide2;    
          document.getElementById("textSerie").value	 = ide1; 
          document.getElementById("textTarjeta").value	= ide2;
          document.getElementById("textSerie2").value= ide1;   
          document.getElementById("textDia5").value= ide2;     
          document.getElementById("textSerie3").value = ide1;  
          document.getElementById("textSerie4").value= ide2;   
          document.getElementById("textSerie5").value = ide1;  
          document.getElementById("textModelo").value= ide2;   
          document.getElementById("textSerie6").value= ide1;   
          document.getElementById("textDia6").value= ide2;     
          document.getElementById("textSerie7").value = ide1;  
          document.getElementById("textSerie8").value = ide2;  
          document.getElementById("textDescUni").value= ide1;  
          document.getElementById("textDescUni2").value= ide2; 
          document.getElementById("textUnidad4").value  = ide1;   
					
					//VARIABLES

 				//FIN
 
 				//document.getElementById("cboSubProblema").value = tipoRequerimiento;
 				//document.getElementById("cboProblema").value = problema;
 				document.getElementById("obs").value = texto;
 				//document.getElementById("resp").value = texto;
					
					var valoresAsignar = "'" + tipoRequerimiento + "','" + problema+"',"+mov;    

					leeSubproblemas(problema,'cboSubProblema');
					leeMovimiento2('cboMovimiento','10');
					idAsignaSelectFichaVehiculo3 = setInterval("asignaValores3("+valoresAsignar+")",200); 
					
																												

	        
	        //hijomenor();
						//var movimiento=hijomenor777(mov);
	//validarEstados();
																												
	document.getElementById("mensajeCargando").style.display = "none";
}
   }
  }
 }
}

function asignaValores3(tipoRequerimiento,problema,mov){
	if (cargaSubproblema == 1 && cargaProblema == 1 && cargaMovimiento == 1){
		clearInterval(idAsignaSelectFichaVehiculo3);
		
		document.getElementById("cboSubProblema").value 	= tipoRequerimiento;
		document.getElementById("cboProblema").value 	= problema;
		document.getElementById("cboMovimiento").value 	= mov;
    
    hijomenor();
    hijomenor777();
		
		//alert(tipoRequerimiento);

		//alert();
		//if (estado == "") estado = 0;
		//document.getElementById("selEstado").value 			= estado;
		//document.getElementById("estadoBaseDatos").value 	= estado;
		
		//if (codigoFallaVehiculo == "") codigoFallaVehiculo = 0;
    //document.getElementById("selTipoFalla").value=codigoFallaVehiculo;
    //document.getElementById("codFallaBaseDatos").value=codigoFallaVehiculo;
    //alert(codigoFallaVehiculo);
		
		//document.getElementById("selLugarReparacion").value  = codigoLugarReparacion;
		//document.getElementById("codLugarReparacionBaseDatos").value = codigoLugarReparacion;
		
 }
}

function leedatosSolicitud(unidad,codigo){

	//alert(unidad);
	//alert(usuario);
	//alert();
	//alert(codigo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlDatoSolicitud.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&codigo="+codigo)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
			  //alert(objHttpXMLFuncionarios.responseText);		
				var xml 				      = objHttpXMLFuncionarios.responseXML.documentElement;
				
				var codigo            = "";
				var unidad            = "";
				var tipoRequerimiento = "";
				var problema          = "";
				var observacion       = ""; 
				var fechaInicio       = "";
				var fechaTermino      = "";
				var estado            = "";
				var zona	            = "";
				var prefectura        = "";
				var comisaria 	      = "";
				var destacamento 	    = "";
				var funcionario	      = "";
				var nombre 	          = "";
				var tipo 	            = "";
				var grado             = "";
				var usuario           = "";
				var texto ="";
				var ide1              = "";
				var ide2              = "";
				var secciones         ="";
				
				var lblNroSolicitud		= "";
				var lblCodigoUnidad		= "";
				var lblNombreUnidad		= "";
				var lblPass		= "";
										
			for(i=0;i<xml.getElementsByTagName('solicitud').length;i++){
				
				
				//alert("1");
				
				lblNroSolicitud    	= xml.getElementsByTagName('codigo')[i].text;
				
				lblCodigoUnidad    				= xml.getElementsByTagName('unidad')[i].text;
				lblNombreUnidad						= xml.getElementsByTagName('nombreUnidad')[i].text;
				lblPass										= xml.getElementsByTagName('passUsuario')[i].text;
				

			 codigo            = xml.getElementsByTagName('codigo')[i].text;
			 unidad            = xml.getElementsByTagName('unidad')[i].text;
			 tipoRequerimiento = xml.getElementsByTagName('subproblema')[i].text;
			 problema          = xml.getElementsByTagName('problema')[i].text;
			 observacion       = xml.getElementsByTagName('observacion')[i].text;
			 //fechaInicio       = xml.getElementsByTagName('fecha')[i].text;
		   //fechaTermino      = xml.getElementsByTagName('fechaTermino')[i].text;
			 //estado            = xml.getElementsByTagName('tipoMovimiento')[i].text;
			 //zona	             = xml.getElementsByTagName('zona')[i].text;
			 //prefectura        = xml.getElementsByTagName('prefectura')[i].text;
			 //comisaria 	       = xml.getElementsByTagName('comisaria')[i].text;
       //destacamento      = xml.getElementsByTagName('destacamento')[i].text;
       usuario            = xml.getElementsByTagName('usuario')[i].text;
       nombre            = xml.getElementsByTagName('nombreCompleto')[i].text;
       tipo              = xml.getElementsByTagName('tipoMovimiento')[i].text;
       grado             = xml.getElementsByTagName('grado')[i].text;
       texto              = xml.getElementsByTagName('text')[i].text;
       ide1              = xml.getElementsByTagName('ide1')[i].text;
			 ide2              = xml.getElementsByTagName('ide2')[i].text;
			 secciones         = xml.getElementsByTagName('secciones')[i].text;

			
					//document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
	//if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					
					//alert(descUnidadVehiculo);
					//document.getElementById("textNumeroBCU").readOnly 		     = "true";	
					//document.getElementById("textNumeroBCU").value	=serie;
					
					//document.getElementById("unidadUsuario").value	=unidadUsuario;
					
					//if(problema==10) var requerimientoSolictado="PROBLEMA SISTEMA"; 
					
					
				  //document.getElementById("zona").value	=zona;
					//document.getElementById("pref").value	=prefectura;
					//document.getElementById("com").value	=comisaria;
					//document.getElementById("dest").value	=destacamento; 
					document.getElementById("codFun").value	=usuario;
					document.getElementById("nom").value	=nombre;
					//document.getElementById("perfil").value	=tipo;
					document.getElementById("grado").value	=grado;
					document.getElementById("obs").value = texto;
					document.getElementById("secciones").value = secciones;
					
					//document.getElementById("cboSubProblema").value = tipoRequerimiento;
					//document.getElementById("cboProblema").value = problema;
					//document.getElementById("cboMovimiento").value = tipo;
					
					//leeSubproblemas(problema,'cboSubProblema');
					
					document.getElementById("lblNroSolicitud").value	=lblNroSolicitud;
					document.getElementById("lblCodigoUnidad").value	=lblCodigoUnidad;
					document.getElementById("lblNombreUnidad").value	=lblNombreUnidad;
					
					document.getElementById("lblPass").value	=lblPass;
					
					 if(ide1=="NULL") var ide1="";
       if(ide2=="NULL") var ide2="";
       
       	if(tipo==30 || tipo==40 || tipo==50){
       		document.getElementById("cboMovimiento").disabled = "true";
		desactivarBotones2();
		}
		
		     	if(tipo==90){
       		document.getElementById("cboMovimiento").disabled = "true";
       		document.getElementById("btnGuardarOrganizacion").disabled = "true";
	
		}
		
		var seccion =document.getElementById("seccion").value;
				     	if((seccion==10 && tipo== 70)||(seccion==10 && tipo== 80)){
       		document.getElementById("cboMovimiento").disabled = "true";
       		document.getElementById("resp").disabled = "true";
       				desactivarBotones2();
	
		}
		
	  if(secciones==20 && tipo==100 && seccion!=20){
       		document.getElementById("cboMovimiento").disabled = "true";
       		document.getElementById("btnGuardarOrganizacion").disabled = "true";
	
		}
		//alert(seccion);
		//alert(secciones);
		//alert(tipo);
		
		


					document.getElementById("codFun").value	=usuario;
					document.getElementById("nom").value	=nombre;
					//document.getElementById("perfil").value	=tipo;
					document.getElementById("grado").value	=grado;
					
					document.getElementById("obs1").value	=texto.toUpperCase();
					
					document.getElementById("textUnidad").value = ide1;
					document.getElementById("textDia").value = ide2;
					
					document.getElementById("textUnidad2").value=ide1;
					document.getElementById("textServicio").value=ide2;
					
					document.getElementById("textFunc").value=ide1;
					document.getElementById("textRut").value=ide2;
					
					document.getElementById("textFunc2").value= ide1;    
          document.getElementById("textDia2").value= ide2;     
          document.getElementById("textFunc3").value = ide1;   
          document.getElementById("textRut2").value= ide2;     
          document.getElementById("textFunc4").value= ide1;    
          document.getElementById("textRut3").value= ide2;     
          document.getElementById("textFunc5").value= ide1;    
          document.getElementById("textNombre").value= ide2;   
          document.getElementById("textFunc6").value = ide1;   
          document.getElementById("textUnidad3").value	= ide2;
          document.getElementById("textFunc7").value= ide1;    
          document.getElementById("textUsu").value= ide2;  
          
          document.getElementById("textFunc8").value= ide1;    
          document.getElementById("textFunc9").value  = ide1;  
          document.getElementById("textFunc10").value  = ide1; 
          document.getElementById("textFolio").value = ide2;   
          document.getElementById("textFunc11").value  = ide1; 
          document.getElementById("textFolio2").value= ide2;   
          document.getElementById("textBcu").value  = ide1;    
          document.getElementById("textTipoAni").value	= ide2;
          document.getElementById("textBcu2").value= ide1;     
          document.getElementById("textDia3").value= ide1;     
          document.getElementById("textBcu3").value	= ide2;    
          document.getElementById("textBcu4").value	= ide2;    
          document.getElementById("textBcu5").value  = ide1;   
          document.getElementById("textPatente").value	= ide2;
          document.getElementById("textBcu6").value= ide1;     
          document.getElementById("textDia4").value= ide2;     
          document.getElementById("textBcu7").value= ide1;     
          document.getElementById("textPatente2").value= ide2; 
          document.getElementById("textPatente3").value= ide1; 
          document.getElementById("textBcu8").value	= ide2;    
          document.getElementById("textSerie").value	 = ide1; 
          document.getElementById("textTarjeta").value	= ide2;
          document.getElementById("textSerie2").value= ide1;   
          document.getElementById("textDia5").value= ide2;     
          document.getElementById("textSerie3").value = ide1;  
          document.getElementById("textSerie4").value= ide2;   
          document.getElementById("textSerie5").value = ide1;  
          document.getElementById("textModelo").value= ide2;   
          document.getElementById("textSerie6").value= ide1;   
          document.getElementById("textDia6").value= ide2;     
          document.getElementById("textSerie7").value = ide1;  
          document.getElementById("textSerie8").value = ide2;  
          document.getElementById("textDescUni").value= ide1;  
          document.getElementById("textDescUni2").value= ide2; 
          document.getElementById("textUnidad4").value  = ide1;   
					
          document.getElementById("codigoMovimiento").value = tipo;   
          
          document.getElementById("imagenCalendarioFichaFuncionario").style.display="none";      
         
					
					var valoresAsignar = "'" + tipoRequerimiento + "','" + problema + "',"+ tipo;    

					leeSubproblemas(problema,'cboSubProblema');
					idAsignaSelectFichaVehiculo2 = setInterval("asignaValores("+valoresAsignar+")",200); 
					
			//document.getElementById("obs").style.backgroundColor = "#E6E6E6";
																												
	document.getElementById("mensajeCargando").style.display = "none";
	//alert(tipo);

}
   }
  }
 }
}

function asignaValores(tipoRequerimiento,problema,tipo){
	if (cargaSubproblema == 1 && cargaProblema == 1 && cargaMovimiento == 1){
		clearInterval(idAsignaSelectFichaVehiculo2);
		
		document.getElementById("cboSubProblema").value 	= tipoRequerimiento;
		document.getElementById("cboProblema").value 	= problema;
		document.getElementById("cboMovimiento").value 			= tipo;
		
		hijomenor();
		hijomenor2();
		
		//alert(tipoRequerimiento);

		//alert();
		//if (estado == "") estado = 0;
		//document.getElementById("selEstado").value 			= estado;
		//document.getElementById("estadoBaseDatos").value 	= estado;
		
		//if (codigoFallaVehiculo == "") codigoFallaVehiculo = 0;
    //document.getElementById("selTipoFalla").value=codigoFallaVehiculo;
    //document.getElementById("codFallaBaseDatos").value=codigoFallaVehiculo;
    //alert(codigoFallaVehiculo);
		
		//document.getElementById("selLugarReparacion").value  = codigoLugarReparacion;
		//document.getElementById("codLugarReparacionBaseDatos").value = codigoLugarReparacion;
		
 }
}

function leedatosMovimiento(unidad,codigo){

	//alert(unidad);
	//alert(usuario);
	//alert();
	//alert(codigo);
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	//div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando solicitudes ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlDatoMovimiento.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("unidad="+unidad+"&codigo="+codigo)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
			 // alert(objHttpXMLFuncionarios.responseText);		
				var xml 				      = objHttpXMLFuncionarios.responseXML.documentElement;
				
				var codigo            = "";
				var unidad            = "";
				var tipoRequerimiento = "";
				var problema          = "";
				var observacion       = ""; 
				var fechaInicio       = "";
				var fechaTermino      = "";
				var estado            = "";
				var zona	            = "";
				var prefectura        = "";
				var comisaria 	      = "";
				var destacamento 	    = "";
				var funcionario	      = "";
				var nombre 	          = "";
				var tipo 	            = "";
				var grado             = "";
				var usuario           = "";
				var texto ="";
				var ide1              = "";
				var ide2              = "";
				var listadoFuncionarios	= "";
							listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";						
			for(i=0;i<xml.getElementsByTagName('solicitud').length;i++){

			 codigo            = xml.getElementsByTagName('codigo')[i].text;
			 unidad            = xml.getElementsByTagName('unidad')[i].text;
			 tipoRequerimiento = xml.getElementsByTagName('subproblema')[i].text;
			 problema          = xml.getElementsByTagName('problema')[i].text;
			 observacion       = xml.getElementsByTagName('observacion')[i].text;
			 //fechaInicio       = xml.getElementsByTagName('fecha')[i].text;
		   //fechaTermino      = xml.getElementsByTagName('fechaTermino')[i].text;
			 //estado            = xml.getElementsByTagName('tipoMovimiento')[i].text;
			 //zona	             = xml.getElementsByTagName('zona')[i].text;
			 //prefectura        = xml.getElementsByTagName('prefectura')[i].text;
			 //comisaria 	       = xml.getElementsByTagName('comisaria')[i].text;
       //destacamento      = xml.getElementsByTagName('destacamento')[i].text;
       usuario            = xml.getElementsByTagName('usuario')[i].text;
       nombre            = xml.getElementsByTagName('nombreCompleto')[i].text;
       tipo              = xml.getElementsByTagName('tipoMovimiento')[i].text;
       grado             = xml.getElementsByTagName('grado')[i].text;
       texto              = xml.getElementsByTagName('text')[i].text;
       ide1              = xml.getElementsByTagName('ide1')[i].text;
			 ide2              = xml.getElementsByTagName('ide2')[i].text;
//alert(tipo);
			
					//document.getElementById("fotoFuncionario").src = "http://fototipcar.carabineros.cl/fototipcar/"+codigo+".jpg";	
	//if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					
					//alert(descUnidadVehiculo);
					//document.getElementById("textNumeroBCU").readOnly 		     = "true";	
					//document.getElementById("textNumeroBCU").value	=serie;
					
					//document.getElementById("unidadUsuario").value	=unidadUsuario;
					
					//if(problema==10) var requerimientoSolictado="PROBLEMA SISTEMA"; 
					
					
				  //document.getElementById("zona").value	=zona;
					//document.getElementById("pref").value	=prefectura;
					//document.getElementById("com").value	=comisaria;
					//document.getElementById("dest").value	=destacamento; 
					//document.getElementById("codFun").value	=usuario;
					//document.getElementById("nom").value	=nombre;
					//document.getElementById("perfil").value	=tipo;
					//document.getElementById("grado").value	=grado;
					//document.getElementById("resp").value = texto;
					
					//listadoFuncionarios+= "<td width='28%' align='left'"+mostrarEtiqueta+"><font color="+color+"><div id='valorColumna'>"+implicado+"</div></td>";
					//listadoFuncionarios+= "<textarea name='resp' id='resp' rows='4' cols='50'>"+texto+"</textarea>";
					var nroLinea = i + 1;
						listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
	listadoFuncionarios += "<tr id='"+nroLinea+"'>";
	listadoFuncionarios += "<td width='4%' align='center'><textarea name='resp' id='resp' rows='4' cols='50'>"+texto+"</textarea></td>";

	listadoFuncionarios += "</tr>";
					//document.getElementById("cboSubProblema").value = tipoRequerimiento;
					//document.getElementById("cboProblema").value = problema;
					//document.getElementById("cboMovimiento").value = tipo;
					
					//leeSubproblemas(problema,'cboSubProblema');
					

					
          //document.getElementById("codigoMovimiento").value = tipo;              
					
					//var valoresAsignar = "'" + tipoRequerimiento + "','" + problema + "',"+ tipo;    

					//leeSubproblemas(problema,'cboSubProblema');
					//idAsignaSelectFichaVehiculo2 = setInterval("asignaValores("+valoresAsignar+")",200); 
					
			
																												
	//document.getElementById("mensajeCargando").style.display = "none";
}
listadoFuncionarios += "</table>";
		div.innerHTML = listadoFuncionarios;
   }
  }
 }
}

function leeFuncionarios22(unidad,codigo){
	//cargaListadoFuncionarios2 = 0;
	//var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Movimientos ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientos2.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&codigo="+codigo));  
	
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
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				var texto="";
				var archivo="";
				var linkArchivo ="";
				var fechaArchivo ="";
				
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1' border='0'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					texto 	 = xml.getElementsByTagName('text')[i].text;
					fInicio 	 = xml.getElementsByTagName('fInicio')[i].text;
					archivo 	 = xml.getElementsByTagName('archivo')[i].text;
					fechaArchivo 	 = xml.getElementsByTagName('fechaArchivo')[i].text;
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;

				 linkArchivo		= '<a href="http://proservipol.carabineros.cl/archivos_solicitud/'+archivo+'" target="_blank" title='+"No:"+codigo+'> <img src="img/carpeta.png" width=15 height=15> </a>';
				 var tex ="vxcxcvxc";

		      listadoFuncionarios += "<tr id='"+nroLinea+"'>";
          //listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
          listadoFuncionarios += "<td width='4%' align=''><b>REGISTRO GENERADO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='estado' size='70' readonly='yes' value='"+implicado+"' style='background: #E6E6E6' style='color: grey'/></td>";
          //listadoFuncionarios += "<td width='4%' align=''><input type='text' id='estado' size='8' readonly='yes' value='"+correlativo+"'/></td>";
					listadoFuncionarios += "</tr>";
   
	        listadoFuncionarios += "<tr id='"+nroLinea+"'>";
          //listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
          listadoFuncionarios += "<td width='4%' align=''><b>ESTADO DE LA SOLICITUD:</b>&nbsp;<input type='text' id='estado2' size='70' readonly='yes' value='"+estado+"' style='background: #E6E6E6' style='color: grey'/></td>";
					listadoFuncionarios += "</tr>";
					
					listadoFuncionarios += "<tr id='"+nroLinea+"'>";
					//listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";

					listadoFuncionarios += "<td width='4%' align=''><textarea name='resp1' id='resp1' rows='4' cols='50' style='background: #E6E6E6' style='color: grey' readonly>"+texto+"</textarea></td>";
					
					listadoFuncionarios += "</tr>";
					
					if(archivo!=""){
					listadoFuncionarios += "<tr>";
					listadoFuncionarios+= "<td width='4%' align='left'><b>ADJUNTO:</b>&nbsp;"+linkArchivo+" <b>SUBIDO</b> "+implicado+" <b>FECHA: </b>"+fechaArchivo+"</td>";
					listadoFuncionarios += "</tr>";
				}
				
					listadoFuncionarios += "<tr>";
					listadoFuncionarios += "<td width='4%' align=''><b>FECHA DE REGISTRO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='estado' size='12' readonly='yes' value='"+fInicio+"' style='background: #E6E6E6' style='color: grey'/></td>";
					listadoFuncionarios += "</tr>";
					
	
					listadoFuncionarios += "<tr>";
					listadoFuncionarios +="<td width='4%' align=''><hr size='1px' color='grey'/></td>";
					listadoFuncionarios += "</tr>";
				}
				
				listadoFuncionarios += "</table>";

				div.innerHTML = listadoFuncionarios;

			
			}
		}
	}
}

function leeFuncionarios23(unidad,codigo){
	//cargaListadoFuncionarios2 = 0;
	//var nombreBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios2");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Movimientos ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTotalRequerimientos3.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&codigo="+codigo));  
	
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
				var fecha   = "";
				var unidad ="";
				var ide   = "";
				var diferencia   = "";
				var implicado = "";
				var correlativo ="";
				var linkMovimiento="";
				var link2="";
				var texto="";
				var archivo="";
				var linkArchivo ="";
				
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1' border='0'>";
        
        //alert(archivo);
        //if(archivo!=""){
        listadoFuncionarios += "<tr>";
				listadoFuncionarios += "<td>ARCHIVOS ADJUNTOS</td>";
				listadoFuncionarios += "</tr>";
			//}
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('requerimiento').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					//codigo	 		 = xml.getElementsByTagName('codigo')[i].text;
					//nombre	 		 = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + ", " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					serie	 	 = xml.getElementsByTagName('tipo')[i].text;
					fecha	 	 = xml.getElementsByTagName('fecha')[i].text;
					tarjeta	 	 = xml.getElementsByTagName('problema')[i].text;
					imei		 	 = xml.getElementsByTagName('fechaInicio')[i].text;
					estado	 	 = xml.getElementsByTagName('estado')[i].text;
					unidad1	 	 = xml.getElementsByTagName('unidad')[i].text;
					ide     	 = xml.getElementsByTagName('ide')[i].text;
					diferencia    	 = xml.getElementsByTagName('dif')[i].text;
					implicado	 	 = xml.getElementsByTagName('implicado')[i].text;
					correlativo 	 = xml.getElementsByTagName('corr')[i].text;
					texto 	 = xml.getElementsByTagName('text')[i].text;
					fInicio 	 = xml.getElementsByTagName('fInicio')[i].text;
					archivo 	 = xml.getElementsByTagName('archivo')[i].text;
					
								
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					
					var nroLinea = i + 1;
					

if(archivo!=""){
				  linkArchivo		= '<a href="./archivos_solicitud/'+archivo+'" target="_blank" title='+"No:"+codigo+'> <img src="img/carpeta.png" width=15 height=15> </a>';
		  
				
		      listadoFuncionarios += "<tr id='"+nroLinea+"'>";
          //listadoFuncionarios += "<td width='4%' align='center'><font color="+color+"><div id='valorColumna'>"+(i+1)+"</div></td>";
          listadoFuncionarios+= "<td width='4%' align='left'><div id='valorColumna'>"+correlativo+" "+linkArchivo+"</td>";
					listadoFuncionarios += "</tr>";
   }
	        
				}
				
				listadoFuncionarios += "</table>";

				div.innerHTML = listadoFuncionarios;

			
			}
		}
	}
}

function nuevoDioscar(){
	
	var codigo         	= document.getElementById("codigo").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
	
	var problema	  = document.getElementById("cboProblema").value;
	var subProblema  = document.getElementById("cboSubProblema").value;

	var observ        	= document.getElementById("obs").value;
  var fechaSolicitud 	= document.getElementById("fSolicitud").value;
  //var respuesta		      = document.getElementById("resp").value;
  
  //var id1 	= document.getElementById("").value;
  //var id2 	= document.getElementById("").value;
  
  //var eti1 	= document.getElementById("").value;
  //var eti2 	= document.getElementById("").value;
  
  //var estadoSolicitud = 10;
  //var funDeribado     = "";  
  
  var idUnidad      = document.getElementById("textUnidad").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2       = document.getElementById("textDia2").value;
  var textTipoUsuario = document.getElementById("textTipoUsuario").value;
  //var textTipoAnimal = document.getElementById("textTipoAnimal").value;
  
  var opcionServ  			= document.getElementById("selServicio").value;
  
  if(opcionServ!=""){
  
  var opcionServicio = document.getElementById('selServicio').options[document.getElementById('selServicio').selectedIndex].text;
  
}else{
	var opcionServicio="";
	}
  
   var tipoUsuario 			= document.getElementById("tipoDeUsuario").value;
   //alert(tipoDeUsuario);
   //var tipoAnimal  			= document.getElementById("tipoDeAnimal").value;
   //alert(tipoDeAnimal);
  
  //alert(opcionServicio);
  
  //var idUnidad      = document.getElementById("textUnidad").value;
  //var idUnidad2      = document.getElementById("textUnidad2").value;
  //var idUnidad3      = document.getElementById("textUnidad3").value;
  //var idUnidad4      = document.getElementById("textUnidad4").value;
  //var idFecha       = document.getElementById("textDia").value;
  //var idFecha2      = document.getElementById("textDia2").value;
  //var idFecha3      = document.getElementById("textDia3").value;
  //var idFecha4      = document.getElementById("textDia4").value;
  //var idFecha5      = document.getElementById("textDia5").value;
  //var idFecha6      = document.getElementById("textDia6").value;
  //var idServicio    = document.getElementById("textServicio").value;
  //var idFuncionario = document.getElementById("textFunc").value;
  //var idRut         = document.getElementById("textRut").value;
  //var idNombre      = document.getElementById("textNombre").value;
  //var idUsuario     = document.getElementById("textUsu").value;
  //var idFolio       = document.getElementById("textFolio").value;
  //var idBCU         = document.getElementById("textBcu").value;
  //var idBCU2         = document.getElementById("textBcu2").value;
  //var idBCU3         = document.getElementById("textBcu3").value;
  //var idBCU4         = document.getElementById("textBcu4").value;
  //var idBCU5         = document.getElementById("textBcu5").value;
  //var idBCU6         = document.getElementById("textBcu6").value;
  //var idBCU7         = document.getElementById("textBcu7").value;
  //var idBCU8         = document.getElementById("textBcu8").value;
  //var idTipoAnimal  = document.getElementById("textTipoAni").value;
  //var idBCU2        = document.getElementById("textBcu2").value;
  //var idPatente     = document.getElementById("textPatente").value;
  //var idSerie       = document.getElementById("textSerie").value;
  //var idTarjeta     = document.getElementById("textTarjeta").value;
  //var idSerie2      = document.getElementById("textSerie2").value;
  //var idSerie3      = document.getElementById("textSerie3").value;
  //var idSerie4      = document.getElementById("textSerie4").value;
  //var idSerie5      = document.getElementById("textSerie5").value;
  //var idSerie6      = document.getElementById("textSerie6").value;
  //var idSerie7      = document.getElementById("textSerie7").value;
  //var idSerie8      = document.getElementById("textSerie8").value;
  //var idModelo      = document.getElementById("textModelo").value;
  //var idDescUnidad  = document.getElementById("textDescUni").value;
  //var idDescUnidad2 = document.getElementById("textDescUni2").value;
  //var idFuncionario2 = document.getElementById("textFunc2").value;
  //var idFuncionario3 = document.getElementById("textFunc3").value;
  //var idRut2         = document.getElementById("textRut2").value;
  //var idFuncionario4 = document.getElementById("textFunc4").value;
  //var idRut3         = document.getElementById("textRut3").value;
  //var idFuncionario5 = document.getElementById("textFunc5").value;
  //var idFuncionario6 = document.getElementById("textFunc6").value;
  //var idFuncionario7 = document.getElementById("textFunc7").value;
  //var idFuncionario8 = document.getElementById("textFunc8").value;
  //var idFuncionario9 = document.getElementById("textFunc9").value;
  //var idFuncionario10 = document.getElementById("textFunc10").value;
  //var idFuncionario11 = document.getElementById("textFunc11").value;
  //var idFolio2       = document.getElementById("textFolio2").value;
  //var idPatente2     = document.getElementById("textPatente2").value;
  //var idPatente3     = document.getElementById("textPatente3").value;


			
	var parametros = "";
	
	parametros += "unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo;
	parametros +="&problema="+problema+"&subProblema="+subProblema;
	parametros +="&observ="+observ+"&fechaSolicitud="+fechaSolicitud;
  parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&opcionServicio="+opcionServicio+"&idFecha2="+idFecha2;
  parametros +="&tipoUsuario="+tipoUsuario+"&textTipoUsuario="+textTipoUsuario;
  //parametros +="&tipoUsuario="+tipoUsuario+"&tipoAnimal="+tipoAnimal+"&textTipoUsuario="+textTipoUsuario+"&textTipoAnimal="+textTipoAnimal;
	
	//parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&idServicio="+idServicio+"&idFuncionario="+idFuncionario+"&idRut="+idRut;
	//parametros +="&idNombre="+idNombre+"&idUsuario="+idUsuario+"&idFolio="+idFolio+"&idBCU="+idBCU+"&idTipoAnimal="+idTipoAnimal;
	//parametros +="&idBCU2="+idBCU2+"&idPatente="+idPatente+"&idSerie="+idSerie+"&idTarjeta="+idTarjeta+"&idSerie2="+idSerie2;
	//parametros +="&idModelo="+idModelo+"&idDescUnidad="+idDescUnidad+"&idDescUnidad2="+idDescUnidad2;
	//parametros +="&idFecha2="+idFecha2+"&idFecha3="+idFecha3+"&idFecha4="+idFecha4+"&idFecha5="+idFecha5+"&idFecha6="+idFecha6+"&idUnidad2="+idUnidad2; 
	//
	//parametros +="&idFuncionario2="+idFuncionario2+"&idFuncionario3="+idFuncionario3+"&idRut2="+idRut2+"&idFuncionario4="+idFuncionario4+"&idRut3="+idRut3+"&idFuncionario5="+idFuncionario5;  
	//
	//parametros +="&idFuncionario6="+idFuncionario6+"&idUnidad3="+idUnidad3+"&idFuncionario7="+idFuncionario7+"&idFuncionario8="+idFuncionario8+"&idFuncionario9="+idFuncionario9+"&idFuncionario10="+idFuncionario10;  
	//
	//parametros +="&idFuncionario11="+idFuncionario11+"&idFolio2="+idFolio2+"&idBCU2="+idBCU2+"&idBCU3="+idBCU3+"&idBCU4="+idBCU4+"&idBCU5="+idBCU5+"&idBCU6="+idBCU6+"&idPatente2="+idPatente2+"&idBCU7="+idBCU7; 
	//
	//parametros +="&idPatente3="+idPatente3+"&idBCU8="+idBCU8+"&idSerie3="+idSerie3+"&idSerie4="+idSerie4+"&idSerie5="+idSerie5+"&idSerie6="+idSerie6+"&idSerie7="+idSerie7+"&idSerie8="+idSerie8+"&idUnidad4="+idUnidad4;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlNuevoDioscar.php",true);
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
					var cod = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod)
				}
			}
		}
	}
}

function nuevoDioscar2(){
	
	var codigo         	= document.getElementById("codigo").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
	
	var problema	  = document.getElementById("cboProblema").value;
	var subProblema  = document.getElementById("cboSubProblema").value;

	var observ        	= document.getElementById("obs").value;
  var fechaSolicitud 	= document.getElementById("fSolicitud").value;
  //var respuesta		      = document.getElementById("resp").value;
  
  //var id1 	= document.getElementById("").value;
  //var id2 	= document.getElementById("").value;
  
  //var eti1 	= document.getElementById("").value;
  //var eti2 	= document.getElementById("").value;
  
  //var estadoSolicitud = 10;
  //var funDeribado     = "";  
  
  var idUnidad      = document.getElementById("textUnidad").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2       = document.getElementById("textDia2").value;
   var opcionServ  			= document.getElementById("selServicio").value;
  
  //var opcionServicio = document.getElementById('selServicio').options[document.getElementById('selServicio').selectedIndex].text;
  
  if(opcionServ!=""){
  
  var opcionServicio = document.getElementById('selServicio').options[document.getElementById('selServicio').selectedIndex].text;
  
}else{
	var opcionServicio="";
	}
  
  //var idUnidad      = document.getElementById("textUnidad").value;
  //var idUnidad2      = document.getElementById("textUnidad2").value;
  //var idUnidad3      = document.getElementById("textUnidad3").value;
  //var idUnidad4      = document.getElementById("textUnidad4").value;
  //var idFecha       = document.getElementById("textDia").value;
  //var idFecha2      = document.getElementById("textDia2").value;
  //var idFecha3      = document.getElementById("textDia3").value;
  //var idFecha4      = document.getElementById("textDia4").value;
  //var idFecha5      = document.getElementById("textDia5").value;
  //var idFecha6      = document.getElementById("textDia6").value;
  //var idServicio    = document.getElementById("textServicio").value;
  //var idFuncionario = document.getElementById("textFunc").value;
  //var idRut         = document.getElementById("textRut").value;
  //var idNombre      = document.getElementById("textNombre").value;
  //var idUsuario     = document.getElementById("textUsu").value;
  //var idFolio       = document.getElementById("textFolio").value;
  //var idBCU         = document.getElementById("textBcu").value;
  //var idBCU2         = document.getElementById("textBcu2").value;
  //var idBCU3         = document.getElementById("textBcu3").value;
  //var idBCU4         = document.getElementById("textBcu4").value;
  //var idBCU5         = document.getElementById("textBcu5").value;
  //var idBCU6         = document.getElementById("textBcu6").value;
  //var idBCU7         = document.getElementById("textBcu7").value;
  //var idBCU8         = document.getElementById("textBcu8").value;
  //var idTipoAnimal  = document.getElementById("textTipoAni").value;
  //var idBCU2        = document.getElementById("textBcu2").value;
  //var idPatente     = document.getElementById("textPatente").value;
  //var idSerie       = document.getElementById("textSerie").value;
  //var idTarjeta     = document.getElementById("textTarjeta").value;
  //var idSerie2      = document.getElementById("textSerie2").value;
  //var idSerie3      = document.getElementById("textSerie3").value;
  //var idSerie4      = document.getElementById("textSerie4").value;
  //var idSerie5      = document.getElementById("textSerie5").value;
  //var idSerie6      = document.getElementById("textSerie6").value;
  //var idSerie7      = document.getElementById("textSerie7").value;
  //var idSerie8      = document.getElementById("textSerie8").value;
  //var idModelo      = document.getElementById("textModelo").value;
  //var idDescUnidad  = document.getElementById("textDescUni").value;
  //var idDescUnidad2 = document.getElementById("textDescUni2").value;
  //var idFuncionario2 = document.getElementById("textFunc2").value;
  //var idFuncionario3 = document.getElementById("textFunc3").value;
  //var idRut2         = document.getElementById("textRut2").value;
  //var idFuncionario4 = document.getElementById("textFunc4").value;
  //var idRut3         = document.getElementById("textRut3").value;
  //var idFuncionario5 = document.getElementById("textFunc5").value;
  //var idFuncionario6 = document.getElementById("textFunc6").value;
  //var idFuncionario7 = document.getElementById("textFunc7").value;
  //var idFuncionario8 = document.getElementById("textFunc8").value;
  //var idFuncionario9 = document.getElementById("textFunc9").value;
  //var idFuncionario10 = document.getElementById("textFunc10").value;
  //var idFuncionario11 = document.getElementById("textFunc11").value;
  //var idFolio2       = document.getElementById("textFolio2").value;
  //var idPatente2     = document.getElementById("textPatente2").value;
  //var idPatente3     = document.getElementById("textPatente3").value;


			
	var parametros = "";
	
	parametros += "unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo;
	parametros +="&problema="+problema+"&subProblema="+subProblema;
	parametros +="&observ="+observ+"&fechaSolicitud="+fechaSolicitud;
  parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&opcionServicio="+opcionServicio+"&idFecha2="+idFecha2;
	
	//parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&idServicio="+idServicio+"&idFuncionario="+idFuncionario+"&idRut="+idRut;
	//parametros +="&idNombre="+idNombre+"&idUsuario="+idUsuario+"&idFolio="+idFolio+"&idBCU="+idBCU+"&idTipoAnimal="+idTipoAnimal;
	//parametros +="&idBCU2="+idBCU2+"&idPatente="+idPatente+"&idSerie="+idSerie+"&idTarjeta="+idTarjeta+"&idSerie2="+idSerie2;
	//parametros +="&idModelo="+idModelo+"&idDescUnidad="+idDescUnidad+"&idDescUnidad2="+idDescUnidad2;
	//parametros +="&idFecha2="+idFecha2+"&idFecha3="+idFecha3+"&idFecha4="+idFecha4+"&idFecha5="+idFecha5+"&idFecha6="+idFecha6+"&idUnidad2="+idUnidad2; 
	//
	//parametros +="&idFuncionario2="+idFuncionario2+"&idFuncionario3="+idFuncionario3+"&idRut2="+idRut2+"&idFuncionario4="+idFuncionario4+"&idRut3="+idRut3+"&idFuncionario5="+idFuncionario5;  
	//
	//parametros +="&idFuncionario6="+idFuncionario6+"&idUnidad3="+idUnidad3+"&idFuncionario7="+idFuncionario7+"&idFuncionario8="+idFuncionario8+"&idFuncionario9="+idFuncionario9+"&idFuncionario10="+idFuncionario10;  
	//
	//parametros +="&idFuncionario11="+idFuncionario11+"&idFolio2="+idFolio2+"&idBCU2="+idBCU2+"&idBCU3="+idBCU3+"&idBCU4="+idBCU4+"&idBCU5="+idBCU5+"&idBCU6="+idBCU6+"&idPatente2="+idPatente2+"&idBCU7="+idBCU7; 
	//
	//parametros +="&idPatente3="+idPatente3+"&idBCU8="+idBCU8+"&idSerie3="+idSerie3+"&idSerie4="+idSerie4+"&idSerie5="+idSerie5+"&idSerie6="+idSerie6+"&idSerie7="+idSerie7+"&idSerie8="+idSerie8+"&idUnidad4="+idUnidad4;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlNuevoDioscar2.php",true);
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
					var cod = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod)
				}
			}
		}
	}
}



function guardarFichaCaballo(codigoVehiculo){
	//desactivarBotones();
	var validaOk = validarFichaFuncionario();
	
	var codigoVehiculo = document.getElementById("codigoSolicitud").value;
		//alert(codigoVehiculo);
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaDioscar(codigoVehiculo);
			//else return false;
			//else activarBotones();
		}
		else {
			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS MAS IMPORTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoDioscar();
			//else return false;
			//else activarBotones();
		}
	} //else {
		//activarBotones();
	//}
}



function actualizaDioscar(codigoVehiculo){
	
	var codigo         	= document.getElementById("codigoSolicitud").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
  var respuesta		      = document.getElementById("resp").value;
	
	//var problema	  = document.getElementById("cboProblema").value;
	//var subProblema  = document.getElementById("cboSubProblema").value;
  var id1        	= "";
  var id2        	= "";
	var observ        	= document.getElementById("obs").value;
	var archivo            = document.getElementById("rutArchi").value;
  //var fechaSolicitud 	= document.getElementById("fSolicitud").value;
  
  //var id1 	= document.getElementById("").value;
  //var id2 	= document.getElementById("").value;
  
  //var eti1 	= document.getElementById("").value;
  //var eti2 	= document.getElementById("").value;
  
  //var estadoSolicitud = 10;
  //var funDeribado     = "";  

			
	var parametros = "";
	
	//parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&codigoUsuario="+codigoUsuario+"&respuesta="+respuesta;
	
	//parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&observ="+observ+"&codigoUsuario="+codigoUsuario;
	//parametros +="&problema="+problema+"&subProblema="+subProblema;
	//parametros +="&observ="+observ+"&fechaSolicitud="+fechaSolicitud;
	
	    var idUnidad      = document.getElementById("textUnidad").value;
  var idUnidad2      = document.getElementById("textUnidad2").value;
  var idUnidad3      = document.getElementById("textUnidad3").value;
  var idUnidad4      = document.getElementById("textUnidad4").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2      = document.getElementById("textDia2").value;
  var idFecha3      = document.getElementById("textDia3").value;
  var idFecha4      = document.getElementById("textDia4").value;
  var idFecha5      = document.getElementById("textDia5").value;
  var idFecha6      = document.getElementById("textDia6").value;
  var idServicio    = document.getElementById("textServicio").value;
  var idFuncionario = document.getElementById("textFunc").value;
  var idRut         = document.getElementById("textRut").value;
  var idNombre      = document.getElementById("textNombre").value;
  var idUsuario     = document.getElementById("textUsu").value;
  var idFolio       = document.getElementById("textFolio").value;
  var idBCU         = document.getElementById("textBcu").value;
  var idBCU2         = document.getElementById("textBcu2").value;
  var idBCU3         = document.getElementById("textBcu3").value;
  var idBCU4         = document.getElementById("textBcu4").value;
  var idBCU5         = document.getElementById("textBcu5").value;
  var idBCU6         = document.getElementById("textBcu6").value;
  var idBCU7         = document.getElementById("textBcu7").value;
  var idBCU8         = document.getElementById("textBcu8").value;
  var idTipoAnimal  = document.getElementById("textTipoAni").value;
  var idBCU2        = document.getElementById("textBcu2").value;
  var idPatente     = document.getElementById("textPatente").value;
  var idSerie       = document.getElementById("textSerie").value;
  var idTarjeta     = document.getElementById("textTarjeta").value;
  var idSerie2      = document.getElementById("textSerie2").value;
  var idSerie3      = document.getElementById("textSerie3").value;
  var idSerie4      = document.getElementById("textSerie4").value;
  var idSerie5      = document.getElementById("textSerie5").value;
  var idSerie6      = document.getElementById("textSerie6").value;
  var idSerie7      = document.getElementById("textSerie7").value;
  var idSerie8      = document.getElementById("textSerie8").value;
  var idModelo      = document.getElementById("textModelo").value;
  var idDescUnidad  = document.getElementById("textDescUni").value;
  var idDescUnidad2 = document.getElementById("textDescUni2").value;
  var idFuncionario2 = document.getElementById("textFunc2").value;
  var idFuncionario3 = document.getElementById("textFunc3").value;
  var idRut2         = document.getElementById("textRut2").value;
  var idFuncionario4 = document.getElementById("textFunc4").value;
  var idRut3         = document.getElementById("textRut3").value;
  var idFuncionario5 = document.getElementById("textFunc5").value;
  var idFuncionario6 = document.getElementById("textFunc6").value;
  var idFuncionario7 = document.getElementById("textFunc7").value;
  var idFuncionario8 = document.getElementById("textFunc8").value;
  var idFuncionario9 = document.getElementById("textFunc9").value;
  var idFuncionario10 = document.getElementById("textFunc10").value;
  var idFuncionario11 = document.getElementById("textFunc11").value;
  var idFolio2       = document.getElementById("textFolio2").value;
  var idPatente2     = document.getElementById("textPatente2").value;
  var idPatente3     = document.getElementById("textPatente3").value;
  
  var movimiento = document.getElementById("cboMovimiento").value;


			
	var parametros = "";
	
	parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&codigoUsuario="+codigoUsuario+"&respuesta="+respuesta+"&archivo="+archivo;
	parametros += "&unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo+"&movimiento="+movimiento+"&observ="+observ;

	//parametros +="&problema="+problema+"&subProblema="+subProblema;
	//parametros +="&observ="+observ;
	
	parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&idServicio="+idServicio+"&idFuncionario="+idFuncionario+"&idRut="+idRut;
	parametros +="&idNombre="+idNombre+"&idUsuario="+idUsuario+"&idFolio="+idFolio+"&idBCU="+idBCU+"&idTipoAnimal="+idTipoAnimal;
	parametros +="&idBCU2="+idBCU2+"&idPatente="+idPatente+"&idSerie="+idSerie+"&idTarjeta="+idTarjeta+"&idSerie2="+idSerie2;
	parametros +="&idModelo="+idModelo+"&idDescUnidad="+idDescUnidad+"&idDescUnidad2="+idDescUnidad2;
	parametros +="&idFecha2="+idFecha2+"&idFecha3="+idFecha3+"&idFecha4="+idFecha4+"&idFecha5="+idFecha5+"&idFecha6="+idFecha6+"&idUnidad2="+idUnidad2; 
	
	parametros +="&idFuncionario2="+idFuncionario2+"&idFuncionario3="+idFuncionario3+"&idRut2="+idRut2+"&idFuncionario4="+idFuncionario4+"&idRut3="+idRut3+"&idFuncionario5="+idFuncionario5;  
	
	parametros +="&idFuncionario6="+idFuncionario6+"&idUnidad3="+idUnidad3+"&idFuncionario7="+idFuncionario7+"&idFuncionario8="+idFuncionario8+"&idFuncionario9="+idFuncionario9+"&idFuncionario10="+idFuncionario10;  
	
	parametros +="&idFuncionario11="+idFuncionario11+"&idFolio2="+idFolio2+"&idBCU2="+idBCU2+"&idBCU3="+idBCU3+"&idBCU4="+idBCU4+"&idBCU5="+idBCU5+"&idBCU6="+idBCU6+"&idPatente2="+idPatente2+"&idBCU7="+idBCU7; 
	
	parametros +="&idPatente3="+idPatente3+"&idBCU8="+idBCU8+"&idSerie3="+idSerie3+"&idSerie4="+idSerie4+"&idSerie5="+idSerie5+"&idSerie6="+idSerie6+"&idSerie7="+idSerie7+"&idSerie8="+idSerie8+"&idUnidad4="+idUnidad4;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaSolicitud.php",true);
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
					var cod = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod)
				}
			}
		}
	}
}

function actualizaDioscar2(codigoVehiculo){
	
	var codigo         	= document.getElementById("codigoSolicitud").value;
  var unidadUsuario		= document.getElementById("unidadUsuario").value;
  var codigoUsuario		= document.getElementById("usuario").value;
  var respuesta		      = document.getElementById("resp").value;
	
	//var problema	  = document.getElementById("cboProblema").value;
	//var subProblema  = document.getElementById("cboSubProblema").value;
  var id1        	= "";
  var id2        	= "";
	var observ        	= document.getElementById("obs").value;
  //var fechaSolicitud 	= document.getElementById("fSolicitud").value;
  
  //var id1 	= document.getElementById("").value;
  //var id2 	= document.getElementById("").value;
  
  //var eti1 	= document.getElementById("").value;
  //var eti2 	= document.getElementById("").value;
  
  //var estadoSolicitud = 10;
  //var funDeribado     = "";  

			
	var parametros = "";
	
	//parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&codigoUsuario="+codigoUsuario+"&respuesta="+respuesta;
	
	//parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&observ="+observ+"&codigoUsuario="+codigoUsuario;
	//parametros +="&problema="+problema+"&subProblema="+subProblema;
	//parametros +="&observ="+observ+"&fechaSolicitud="+fechaSolicitud;
	
	    var idUnidad      = document.getElementById("textUnidad").value;
  var idUnidad2      = document.getElementById("textUnidad2").value;
  var idUnidad3      = document.getElementById("textUnidad3").value;
  var idUnidad4      = document.getElementById("textUnidad4").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2      = document.getElementById("textDia2").value;
  var idFecha3      = document.getElementById("textDia3").value;
  var idFecha4      = document.getElementById("textDia4").value;
  var idFecha5      = document.getElementById("textDia5").value;
  var idFecha6      = document.getElementById("textDia6").value;
  var idServicio    = document.getElementById("textServicio").value;
  var idFuncionario = document.getElementById("textFunc").value;
  var idRut         = document.getElementById("textRut").value;
  var idNombre      = document.getElementById("textNombre").value;
  var idUsuario     = document.getElementById("textUsu").value;
  var idFolio       = document.getElementById("textFolio").value;
  var idBCU         = document.getElementById("textBcu").value;
  var idBCU2         = document.getElementById("textBcu2").value;
  var idBCU3         = document.getElementById("textBcu3").value;
  var idBCU4         = document.getElementById("textBcu4").value;
  var idBCU5         = document.getElementById("textBcu5").value;
  var idBCU6         = document.getElementById("textBcu6").value;
  var idBCU7         = document.getElementById("textBcu7").value;
  var idBCU8         = document.getElementById("textBcu8").value;
  var idTipoAnimal  = document.getElementById("textTipoAni").value;
  var idBCU2        = document.getElementById("textBcu2").value;
  var idPatente     = document.getElementById("textPatente").value;
  var idSerie       = document.getElementById("textSerie").value;
  var idTarjeta     = document.getElementById("textTarjeta").value;
  var idSerie2      = document.getElementById("textSerie2").value;
  var idSerie3      = document.getElementById("textSerie3").value;
  var idSerie4      = document.getElementById("textSerie4").value;
  var idSerie5      = document.getElementById("textSerie5").value;
  var idSerie6      = document.getElementById("textSerie6").value;
  var idSerie7      = document.getElementById("textSerie7").value;
  var idSerie8      = document.getElementById("textSerie8").value;
  var idModelo      = document.getElementById("textModelo").value;
  var idDescUnidad  = document.getElementById("textDescUni").value;
  var idDescUnidad2 = document.getElementById("textDescUni2").value;
  var idFuncionario2 = document.getElementById("textFunc2").value;
  var idFuncionario3 = document.getElementById("textFunc3").value;
  var idRut2         = document.getElementById("textRut2").value;
  var idFuncionario4 = document.getElementById("textFunc4").value;
  var idRut3         = document.getElementById("textRut3").value;
  var idFuncionario5 = document.getElementById("textFunc5").value;
  var idFuncionario6 = document.getElementById("textFunc6").value;
  var idFuncionario7 = document.getElementById("textFunc7").value;
  var idFuncionario8 = document.getElementById("textFunc8").value;
  var idFuncionario9 = document.getElementById("textFunc9").value;
  var idFuncionario10 = document.getElementById("textFunc10").value;
  var idFuncionario11 = document.getElementById("textFunc11").value;
  var idFolio2       = document.getElementById("textFolio2").value;
  var idPatente2     = document.getElementById("textPatente2").value;
  var idPatente3     = document.getElementById("textPatente3").value;
  
  var movimiento = document.getElementById("cboMovimiento").value;


			
	var parametros = "";
	
	parametros += "codigo="+codigo+"&id1="+id1+"&id2="+id2+"&codigoUsuario="+codigoUsuario+"&respuesta="+respuesta;
	parametros += "&unidadUsuario="+unidadUsuario+"&codigoUsuario="+codigoUsuario+"&codigo="+codigo+"&movimiento="+movimiento+"&observ="+observ;

	//parametros +="&problema="+problema+"&subProblema="+subProblema;
	//parametros +="&observ="+observ;
	
	parametros +="&idUnidad="+idUnidad+"&idFecha="+idFecha+"&idServicio="+idServicio+"&idFuncionario="+idFuncionario+"&idRut="+idRut;
	parametros +="&idNombre="+idNombre+"&idUsuario="+idUsuario+"&idFolio="+idFolio+"&idBCU="+idBCU+"&idTipoAnimal="+idTipoAnimal;
	parametros +="&idBCU2="+idBCU2+"&idPatente="+idPatente+"&idSerie="+idSerie+"&idTarjeta="+idTarjeta+"&idSerie2="+idSerie2;
	parametros +="&idModelo="+idModelo+"&idDescUnidad="+idDescUnidad+"&idDescUnidad2="+idDescUnidad2;
	parametros +="&idFecha2="+idFecha2+"&idFecha3="+idFecha3+"&idFecha4="+idFecha4+"&idFecha5="+idFecha5+"&idFecha6="+idFecha6+"&idUnidad2="+idUnidad2; 
	
	parametros +="&idFuncionario2="+idFuncionario2+"&idFuncionario3="+idFuncionario3+"&idRut2="+idRut2+"&idFuncionario4="+idFuncionario4+"&idRut3="+idRut3+"&idFuncionario5="+idFuncionario5;  
	
	parametros +="&idFuncionario6="+idFuncionario6+"&idUnidad3="+idUnidad3+"&idFuncionario7="+idFuncionario7+"&idFuncionario8="+idFuncionario8+"&idFuncionario9="+idFuncionario9+"&idFuncionario10="+idFuncionario10;  
	
	parametros +="&idFuncionario11="+idFuncionario11+"&idFolio2="+idFolio2+"&idBCU2="+idBCU2+"&idBCU3="+idBCU3+"&idBCU4="+idBCU4+"&idBCU5="+idBCU5+"&idBCU6="+idBCU6+"&idPatente2="+idPatente2+"&idBCU7="+idBCU7; 
	
	parametros +="&idPatente3="+idPatente3+"&idBCU8="+idBCU8+"&idSerie3="+idSerie3+"&idSerie4="+idSerie4+"&idSerie5="+idSerie5+"&idSerie6="+idSerie6+"&idSerie7="+idSerie7+"&idSerie8="+idSerie8+"&idUnidad4="+idUnidad4;
	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaSolicitud2.php",true);
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
					var cod = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 top.leeFuncionarios(unidadUsuario, '', '');
						 idCargaListadoFuncionarios = setInterval("cerrarVentanaPersonal()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod)
				}
			}
		}
	}
}

function nuevoEstadoDioscar(){
	
	var codigo         	  = document.getElementById("codigoSolicitud").value;
	var movimiento	      = document.getElementById("cboMovimiento").value;
	var respuesta		      = document.getElementById("resp").value;
  var fechaMovimiento 	= document.getElementById("fechaMovimiento").value;
  //var ingeniero		      = document.getElementById("cboIngenieros").value;
  var usuario	          = document.getElementById("usuario").value;
  //var secciones		      = document.getElementById("cboSecciones").value;
  var fechaTermino	    = document.getElementById("fechaTermino").value;
  var codigoMovimiento	    = document.getElementById("codigoMovimiento").value;
  var archivo            = document.getElementById("rutArchi").value;
  var secciones           = document.getElementById("secciones").value;
  var seccionAnterior           = document.getElementById("secciones").value;

  
  //alert(seccionAnterior);
  
  //var id1 	= document.getElementById("").value;
  //var id2 	= document.getElementById("").value;
  
  //var eti1 	= document.getElementById("").value;
  //var eti2 	= document.getElementById("").value;
  
  //var estadoSolicitud = 10;
  //var funDeribado     = "";
  
  if(movimiento==70){ 
    secciones=20;  
}else if(movimiento==80){
	 secciones=30; 
	}
		
		  if(codigoMovimiento==70){ 
    secciones=20;  
}else if(codigoMovimiento==80){
	 secciones=30; 
	}
	

			
	var parametros = "";
	
	parametros += "codigo="+codigo+"&movimiento="+movimiento+"&respuesta="+respuesta+"&secciones="+secciones+"&archivo="+archivo;
	parametros +="&fechaMovimiento="+fechaMovimiento+"&usuario="+usuario+"&fechaTermino="+fechaTermino+"&codigoMovimiento="+codigoMovimiento;
	//parametros +="&observ="+observ+"&fechaSolicitud="+fechaSolicitud;

	
	//alert(parametros);
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlNuevoEstadoDioscar.php",true);
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
					var cod = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (cod == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 //alert(seccionAnterior);
						 if(seccionAnterior==0){
						 top.leeFuncionarios2(unidadUsuario, '', '');
						 idCargaListadoFuncionarios2 = setInterval("cerrarVentanaPersonal2()",1000);
						}else if(seccionAnterior==20){
							top.leeFuncionarios3(unidadUsuario, '', '');
						 idCargaListadoFuncionarios3 = setInterval("cerrarVentanaPersonal3()",1000);
							}else if(seccionAnterior==30){
							top.leeFuncionarios4(unidadUsuario, '', '');
						 idCargaListadoFuncionarios4 = setInterval("cerrarVentanaPersonal4()",1000);
							}
						 //top.leeFuncionarios3(unidadUsuario, '', '');
						 //idCargaListadoFuncionarios3 = setInterval("cerrarVentanaPersonal3()",1000);
						 //top.leeFuncionarios4(unidadUsuario, '', '');
						 //idCargaListadoFuncionarios4 = setInterval("cerrarVentanaPersonal4()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod)
				}
			}
		}
	}
}

function actualizaTemporizador(unidad){
		
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaTemporizador.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad));
	//alert(unidad)
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (cod == 1){
						 alert('LAS SOLICITUDES SIN IDENTIFICADOR HAN SIDO ELIMINADAS ......        ');
						 top.leeFuncionarios(unidad, '', '');
						 idCargaListadoFuncionarios = setInterval(500);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod)
				}
			}
		}
	}
}

function actualizaTemporizador2(unidad){
		
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlActualizaTemporizador2.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI());
	//alert(unidad)
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
				if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var cod = xml.getElementsByTagName('resultado')[i].firstChild.data;
					if (cod == 1){
						 alert('LAS SOLICITUDES HAN SIDO MODIFICADAS ......        ');
						 top.leeFuncionarios2(unidad, '', '');
						 idCargaListadoFuncionarios2 = setInterval(500);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + cod)
				}
			}
		}
	}
}

function guardarFichaCaballo2(){
	//desactivarBotones();
	var validaOk = validarFichaFuncionario();
	
	if (validaOk){

			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \nDESEA CONTINUAR?");
			if (msj) nuevoEstadoDioscar();
			//else return false;
			//else activarBotones();
	
	//} else {
	//	activarBotones();
	}
}

function guardarFichaCaballo3(){
	//desactivarBotones();
	var validaOk = validarFichaFuncionario();
	var validaIdOk = validarFichaIdentificador();
	if (validaOk){

			var msj=confirm("ATENCION :\nSE INGRESARAN LOS ANTECEDENTES FALTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \nDESEA CONTINUAR?");
			if (msj) nuevoDioscar();
			//else return false;
			//else activarBotones();
	
	//} else {
	//	activarBotones();
	}
}

function guardarFichaCaballo6(codigoVehiculo){
	//desactivarBotones();
	var validaOk = validarFichaFuncionario();
	var validaIdOk = validarFichaIdentificador();
	
	var codigoVehiculo = document.getElementById("codigoSolicitud").value;
		//alert(codigoVehiculo);
	if (validaOk & validaIdOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaDioscar(codigoVehiculo);
			//else return false;
			//else activarBotones();
		}
		else {
			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS MAS IMPORTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoDioscar();
			//else return false;
			//else activarBotones();
		}
	} //else {
		//activarBotones();
	//}
}

function guardarFichaCaballo5(codigoVehiculo){
	//desactivarBotones();
	var validaOk = validarFichaFuncionario();
	
	var codigoVehiculo = document.getElementById("codigoSolicitud").value;
		//alert(codigoVehiculo);
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizaDioscar2(codigoVehiculo);
			//else return false;
			//else activarBotones();
		}
		else {
			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS MAS IMPORTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoDioscar2();
			//else return false;
			//else activarBotones();
		}
	} //else {
		//activarBotones();
	//}
}

function guardarFichaCaballo4(){
	//desactivarBotones();
	var validaOk = validarFichaFuncionario();
	var validaIdOk = validarFichaIdentificador();
	if (validaOk && validaIdOk){

			var msj=confirm("ATENCION :\nSE INGRESARAN LOS ANTECEDENTES FALTANTES DE ESTA SOLICITUD EN LA BASE DE DATOS.          \nDESEA CONTINUAR?");
			if (msj) nuevoDioscar();
			//else return false;
			//else activarBotones();
	
	//} else {
	//	activarBotones();
	}
}

function cerrarVentanaPersonal(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);

		 top.cerrarVentana();
	}
}

function cerrarVentanaPersonal2(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios2 == 1){
		clearInterval(idCargaListadoFuncionarios2);

		 top.cerrarVentana();
	}
}

function cerrarVentanaPersonal3(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios3 == 1){
		clearInterval(idCargaListadoFuncionarios3);

		 top.cerrarVentana();
	}
}

function cerrarVentanaPersonal4(){
	//alert(top.cargaListadoReuniones);
	if (top.cargaListadoFuncionarios4 == 1){
		clearInterval(idCargaListadoFuncionarios4);

		 top.cerrarVentana();
	}
}



function validarFichaFuncionario(){
 
	var problema	= document.getElementById("cboProblema").value;
	var subproblema= document.getElementById("cboSubproblema").value;
	var observ	= document.getElementById("obs").value;
	var observ1	= document.getElementById("obs1").value;
	var movBD = document.getElementById("codigoMovimiento").value;
	var movBD2 = document.getElementById("movimiento").value;
	var movNuevo = document.getElementById("cboMovimiento").value;
	
	var resp = document.getElementById("resp").value;
	
	var archivo					= document.getElementById("archivo").value;
	var archivoLoad			= document.getElementById("archivoLoad").value;

	//alert(movBD2);
	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;

		
	if (problema == 0){
		alert("DEBE INDICAR EL PROBLEMA...... 	     ");
		document.getElementById("cboProblema").focus();
		return false;
	}
	
		if (subproblema == 0){
		alert("DEBE INDICAR EL TIPO DE PROBLEMA ...... 	     ");
		document.getElementById("cboSubProblema").focus();
		return false;
	}
	
	/*
		if (observ == ""){
		alert("DEBE INDICAR UNA OBSERVACION ...... 	     ");
		document.getElementById("obs").focus();
		return false;
	}
	*/
	
	//if (resp == "" && movBD2!=10){
	//	alert("DEBE INDICAR EL MOTIVO ...... 	     ");
	//	document.getElementById("resp").focus();
	//	return false;
	//}
	
		//if ((observ == "") & (problema != 0 && subproblema != 0)){
		//alert("DEBE INDICAR UNA OBSERVACION ...... 	     ");
		//document.getElementById("obs").focus();
		//return false;
	//}
	
	
	//if ((movBD == movNuevo) || (movBD2 == movNuevo)){
	//	alert("DEBE CAMBIAR EL ESTADO ...... 	     ");
	//	document.getElementById("cboMovimiento").focus();
	//	return false;
	//}
	
		//NUEVO CORREGIDO CONTROL PARA UNIDAD
	if(movBD != movNuevo){
	if (resp == "" && movBD2!=20){
		alert("DEBE INDICAR EL MOTIVO ...... 	     ");
		document.getElementById("resp").focus();
		return false;
	}
}

	if(movBD == movNuevo){
	//if ((movBD == movNuevo) || (movBD2 == movNuevo)){
		alert("DEBE CAMBIAR EL ESTADO ...... 	     ");
		document.getElementById("cboMovimiento").focus();
		return false;
	//}
}

	if(movNuevo==100){
	if (archivo == "") {
		alert("DEBE SUBIR EL ARCHIVO SOLICITADO ...... 	     ");
		return false;
	}
		
	if (archivoLoad == 0) {
		alert("DEBE PRESIONAR EL BOTON SUBIR PARA CARGAR EL ARCHIVO EN EL SISTEMA ...... 	     ");
		return false;
	}
}	

//FIN NUEVO CORREGIDO PARA UNIDAD
	
	return true;
}

function validarEstados(){
 
 	var movBD = document.getElementById("codigoMovimiento").value;
	var movBD2 = document.getElementById("movimiento").value;
	var movNuevo = document.getElementById("cboMovimiento").value;
	
	//alert(movBD);
	//alert(movBD2);
	//alert(movNuevo);

	if(movBD2 != 10){
	if ((movBD == movNuevo) || (movBD2 == movNuevo)){
		alert("DEBE CAMBIAR EL ESTADO ...... 	     ");
		document.getElementById("cboMovimiento").focus();
		return false;
	}
}
	return true;
}

function validarFichaIdentificador(){
 
  var idUnidad      = document.getElementById("textUnidad").value;
  var idUnidad2      = document.getElementById("textUnidad2").value;
  var idUnidad3      = document.getElementById("textUnidad3").value;
  var idFecha       = document.getElementById("textDia").value;
  var idFecha2      = document.getElementById("textDia2").value;
  var idFecha3      = document.getElementById("textDia3").value;
  var idFecha4      = document.getElementById("textDia4").value;
  var idFecha5      = document.getElementById("textDia5").value;
  var idFecha6      = document.getElementById("textDia6").value;
  var idServicio    = document.getElementById("textServicio").value;
  var idFuncionario = document.getElementById("textFunc").value;
  var idRut         = document.getElementById("textRut").value;
  var idNombre      = document.getElementById("textNombre").value;
  var idUsuario     = document.getElementById("textUsu").value;
  var idFolio       = document.getElementById("textFolio").value;
  var idBCU         = document.getElementById("textBcu").value;
  var idBCU2         = document.getElementById("textBcu2").value;
  var idBCU3         = document.getElementById("textBcu3").value;
  var idBCU4         = document.getElementById("textBcu4").value;
  var idBCU5         = document.getElementById("textBcu5").value;
  var idBCU6         = document.getElementById("textBcu6").value;
  var idBCU7         = document.getElementById("textBcu7").value;
  var idBCU8         = document.getElementById("textBcu8").value;
  var idTipoAnimal  = document.getElementById("textTipoAni").value;
  var idBCU2        = document.getElementById("textBcu2").value;
  var idPatente     = document.getElementById("textPatente").value;
  var idSerie       = document.getElementById("textSerie").value;
  var idTarjeta     = document.getElementById("textTarjeta").value;
  var idSerie2      = document.getElementById("textSerie2").value;
  var idSerie3      = document.getElementById("textSerie3").value;
  var idSerie4      = document.getElementById("textSerie4").value;
  var idSerie5      = document.getElementById("textSerie5").value;
  var idSerie6      = document.getElementById("textSerie6").value;
  var idSerie7      = document.getElementById("textSerie7").value;
  var idSerie8      = document.getElementById("textSerie8").value;
  var idModelo      = document.getElementById("textModelo").value;
  var idDescUnidad  = document.getElementById("textDescUni").value;
  var idDescUnidad2 = document.getElementById("textDescUni2").value;
  var idFuncionario2 = document.getElementById("textFunc2").value;
  var idFuncionario3 = document.getElementById("textFunc3").value;
  var idRut2         = document.getElementById("textRut2").value;
  var idFuncionario4 = document.getElementById("textFunc4").value;
  var idRut3         = document.getElementById("textRut3").value;
  var idFuncionario5 = document.getElementById("textFunc5").value;
  var idFuncionario6 = document.getElementById("textFunc6").value;
  var idFuncionario7 = document.getElementById("textFunc7").value;
  var idFuncionario8 = document.getElementById("textFunc8").value;
  var idFuncionario9 = document.getElementById("textFunc9").value;
  var idFuncionario10 = document.getElementById("textFunc10").value;
  var idFuncionario11 = document.getElementById("textFunc11").value;
  var idFolio2       = document.getElementById("textFolio2").value;
  var idPatente2     = document.getElementById("textPatente2").value;
  var idPatente3     = document.getElementById("textPatente3").value;
  
  var valor = document.getElementById("cboSubProblema").value;
  
  //alert(valor);
		
	if (valor == 100 && idFecha == ""){
		alert("DEBE INDICAR EL LA FECHA ...... 	     ");
		document.getElementById("textDia").focus();
		return false;
	}
	
		if (valor == 110  && idServicio == ""){
		alert("DEBE INDICAR EL SERVICIO ...... 	     ");
		document.getElementById("textServicio").focus();
		return false;
	}
	
		if (valor == 120 && idFuncionario == ""){
		alert("DEBE INDICAR EL FUNCIONARIO ...... 	     ");
		document.getElementById("textFunc").focus();
		return false;
	}
			
	
	return true;
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

function desactivarBotones2(){
	document.getElementById("btnGuardarOrganizacion").disabled = "true";
	document.getElementById("btnGuardarOrganizacion2").disabled = "true";

}

function hijomenor(){
	var valor = document.getElementById("cboSubProblema").value;
	//codigoSelime();
	//alert(document.getElementById("cboSubProblema").value);
	if(valor==100 || valor==390){
		document.getElementById("identificador1").style.display="block";
		}
	else{
		document.getElementById("identificador1").style.display="none";
		}
		
	if(valor==110 || valor==400 || valor==410){
		document.getElementById("identificador2").style.display="block";
		}
	else{
		document.getElementById("identificador2").style.display="none";
		}
		
	if(valor==120){
		document.getElementById("identificador3").style.display="block";
		}
	else{
		document.getElementById("identificador3").style.display="none";
		}	
		
	if(valor==130){
		document.getElementById("identificador4").style.display="block";
		}
	else{
		document.getElementById("identificador4").style.display="none";
		}	
		
		if(valor==140){
		document.getElementById("identificador5").style.display="block";
		}
	else{
		document.getElementById("identificador5").style.display="none";
		}	
		
	if(valor==150){
		document.getElementById("identificador6").style.display="block";
		}
	else{
		document.getElementById("identificador6").style.display="none";
		}		
		
	if(valor==160){
		document.getElementById("identificador7").style.display="block";
		}
	else{
		document.getElementById("identificador7").style.display="none";
		}	

	if(valor==170){
		document.getElementById("identificador8").style.display="block";
		}
	else{
		document.getElementById("identificador8").style.display="none";
		}		
		
	if(valor==180){
		document.getElementById("identificador9").style.display="block";
		}
	else{
		document.getElementById("identificador9").style.display="none";
		}	
		
	if(valor==190){
		document.getElementById("identificador10").style.display="block";
		}
	else{
		document.getElementById("identificador10").style.display="none";
		}	
	
	if(valor==200){
		document.getElementById("identificador11").style.display="block";
		}
	else{
		document.getElementById("identificador11").style.display="none";
		}		
		
	if(valor==210){
		document.getElementById("identificador12").style.display="block";
		}
	else{
		document.getElementById("identificador12").style.display="none";
		}	
	
	if(valor==220){
		document.getElementById("identificador13").style.display="block";
		}
	else{
		document.getElementById("identificador13").style.display="none";
		}	
		
	if(valor==230){
		document.getElementById("identificador14").style.display="block";
		}
	else{
		document.getElementById("identificador14").style.display="none";
		}		
		
	if(valor==240){
		document.getElementById("identificador15").style.display="block";
		}
	else{
		document.getElementById("identificador15").style.display="none";
		}	
		
	if(valor==250){
		document.getElementById("identificador16").style.display="block";
		}
	else{
		document.getElementById("identificador16").style.display="none";
		}	
		
	if(valor==260){
		document.getElementById("identificador17").style.display="block";
		}
	else{
		document.getElementById("identificador17").style.display="none";
		}		
		
	if(valor==270){
		document.getElementById("identificador18").style.display="block";
		}
	else{
		document.getElementById("identificador18").style.display="none";
		}	

	if(valor==280){
		document.getElementById("identificador19").style.display="block";
		}
	else{
		document.getElementById("identificador19").style.display="none";
		}			
		
	if(valor==290){
		document.getElementById("identificador20").style.display="block";
		}
	else{
		document.getElementById("identificador20").style.display="none";
		}		
		
	if(valor==300){
		document.getElementById("identificador21").style.display="block";
		}
	else{
		document.getElementById("identificador21").style.display="none";
		}	
		
	if(valor==310){
		document.getElementById("identificador22").style.display="block";
		}
	else{
		document.getElementById("identificador22").style.display="none";
		}		
		
	if(valor==320){
		document.getElementById("identificador23").style.display="block";
		}
	else{
		document.getElementById("identificador23").style.display="none";
		}		
		
	if(valor==330){
		document.getElementById("identificador24").style.display="block";
		}
	else{
		document.getElementById("identificador24").style.display="none";
		}		
		
	if(valor==340){
		document.getElementById("identificador25").style.display="block";
		}
	else{
		document.getElementById("identificador25").style.display="none";
		}		
	
	if(valor==350){
		document.getElementById("identificador26").style.display="block";
		}
	else{
		document.getElementById("identificador26").style.display="none";
		}	
		
	if(valor==360){
		document.getElementById("identificador27").style.display="block";
		}
	else{
		document.getElementById("identificador27").style.display="none";
		}	
		
	if(valor==370){
		document.getElementById("identificador28").style.display="block";
		}
	else{
		document.getElementById("identificador28").style.display="none";
		}	
									
}

function hijomenor2(){
	var valor = document.getElementById("cboMovimiento").value;
	//codigoSelime();
	//alert(document.getElementById("cboMovimiento").value);
	//alert(valor);
	if(valor==300){
		document.getElementById("textoRespuesta").style.display="block";
		}
	
		
	if(valor==200){
		document.getElementById("textoRespuesta").style.display="block";
		}
	
		
	if(valor==30){
		document.getElementById("textoRespuesta").style.display="block";
		}
	
		if(valor==40){
		document.getElementById("textoRespuesta").style.display="block";
		}
	
		if(valor==50){
		document.getElementById("textoRespuesta").style.display="block";
		}
		
			if(valor==60){
		document.getElementById("textoRespuesta").style.display="block";
		}
			if(valor==70){
		document.getElementById("textoRespuesta").style.display="block";
		}
		if(valor==80){
		document.getElementById("textoRespuesta").style.display="block";
		}
			if(valor==90){
		document.getElementById("textoRespuesta").style.display="block";
		}
		
			if(valor==100){
		document.getElementById("textoRespuesta").style.display="block";
		}
			
}

function hijomenor3(){
	var valor = document.getElementById("cboMovimiento").value;

	//alert(document.getElementById("codigoSelime").value);
	if(valor==900){
		document.getElementById("funcionariosDeriva").style.display="block";
		}
	else{
		document.getElementById("funcionariosDeriva").style.display="none";
		}			
}

//Nueva funcion para funcionario con servicio asignado
function controlTemporizador(unidad){ 
		
		//var arreglo = new Array();
		//var arrayCorrelativoPaso = new Array();
		
    //var fechaHoy = document.getElementById("fecha").value;
    var vacio = "";
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTemporizador.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad));  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	mensaje += "LA UNIDAD TIENE SOLICITUDES PENDIENTES Y SE HA VENCIDO EL PLAZO:\n\n";
        if (xml.getElementsByTagName('temporizador').length > 10) var cantidadServiciosMostar = 10;
        else var cantidadServiciosMostar = xml.getElementsByTagName('temporizador').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	var fecha 		         = xml.getElementsByTagName('codigo')[i].text;
		        var servicio 	         = xml.getElementsByTagName('unidad')[i].text;
		        var unidad 	         	= xml.getElementsByTagName('movimiento')[i].text;
		        //var fechaInicio	     	= xml.getElementsByTagName('fechaInicio')[i].text;
		        var subproblema           = xml.getElementsByTagName('subproblema')[i].text;
		        
		        //arrayCorrelativoPaso[0] = new Array();
		        //var arregloCorrelativos	= php_serialize(arreglo);
		               
		        mensaje += (i+1) +". " + vacio+"  TRAMITE No. "+fecha.toUpperCase()+"\n   ("+subproblema.toUpperCase()+").\n";
			}
			if (cantidadServiciosMostar < xml.getElementsByTagName('temporizador').length) mensaje += "...";
			alert(mensaje);
			//var arregloCorrelativos	= php_serialize(arreglo);
			//document.getElementById("correlativo").value=arregloCorrelativos;
			return 1;
	}else{ 
		return 0;
	}
}
//fin nueva funcion

function controlTemporizador2(){ 
	 
	  var vacio = "";
		var unidad = "";
		var arreglo = new Array();
		var arrayCorrelativoPaso = new Array();
		
    //var fechaHoy = document.getElementById("fecha").value;
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlRequerimientos/xmlListaTemporizador2.php",false);
	 objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	 objHttpXMLFuncionarios.send(encodeURI());  
    //alert(objHttpXMLFuncionarios.responseText); 
    var xml = objHttpXMLFuncionarios.responseXML.documentElement;
	//return xml.getElementsByTagName('servicio')[0]; 
   
    if (objHttpXMLFuncionarios.responseText != "VACIO"){
    	//alert("Tiene servicios asignados.");  
        	
        	mensaje += "TIENE SOLICITUDES SIN REVISAR:\n\n";
        if (xml.getElementsByTagName('temporizador').length > 10) var cantidadServiciosMostar = 10;
        else var cantidadServiciosMostar = xml.getElementsByTagName('temporizador').length;
	     for(var i=0;i<cantidadServiciosMostar;i++){
		      	var fecha 		         = xml.getElementsByTagName('codigo')[i].text;
		        var servicio 	         = xml.getElementsByTagName('unidad')[i].text;
		        var subproblema           = xml.getElementsByTagName('subproblema')[i].text;
		        //var unidad 	         	= xml.getElementsByTagName('movimiento')[i].text;
		        //var fechaInicio	     	= xml.getElementsByTagName('fechaInicio')[i].text;
		        //var fecha2            = comparaFecha(fechaInicio,fechaHoy);
		        
		        arrayCorrelativoPaso[0] = new Array();
		        var arregloCorrelativos	= php_serialize(arreglo);
		               
		        mensaje += (i+1) +". " + vacio+" TRAMITE No. "+fecha.toUpperCase()+"\n   ("+subproblema.toUpperCase()+").\n";
		        //alert(arregloCorrelativos);
			}
			if (cantidadServiciosMostar < xml.getElementsByTagName('temporizador').length) mensaje += "...";
			alert(mensaje);
			var arregloCorrelativos	= php_serialize(arreglo);
			document.getElementById("correlativo").value=arregloCorrelativos;
		//	alert(arregloCorrelativos);
			return 1;
	}else{ 
		return 0;
	}
}

function hijomenor345(){
	var valor = document.getElementById("cboSubProblema").value;
	//codigoSelime();
	//alert(document.getElementById("cboSubProblema").value);
	if(valor==120 || valor==130 || valor==140 || valor==120 || valor==130 || valor==150 || valor==160 || valor==190 || valor==200
	   || valor==210 || valor==220  || valor==230 || valor==240 || valor==250 || valor==260 || valor==270 || valor==280 || valor==290 || valor==300 || valor==310 || valor==320 || valor==330
	   || valor==340 || valor==350 || valor==360 || valor==370){
		document.getElementById("ide1").style.display="block";
		}
	else{
		document.getElementById("ide1").style.display="none";
		}
}

function hijomenor346(){
	var valor = document.getElementById("cboSubProblema").value;
	//codigoSelime();
	//alert(document.getElementById("cboSubProblema").value);
	if( valor==100 || valor==110 || valor==390 || valor==400 || valor==410){
		document.getElementById("tipoServicio").style.display="block";
		}
	else{
		document.getElementById("tipoServicio").style.display="none";
		}
}

function hijomenor347(){
	var valor = document.getElementById("cboSubProblema").value;
	//codigoSelime();
	//alert(document.getElementById("cboSubProblema").value);
	if( valor==170 || valor==180){
		document.getElementById("tipoUsuario").style.display="block";
		}
	else{
		document.getElementById("tipoUsuario").style.display="none";
		}
}

function hijomenor348(){
	var valor = document.getElementById("cboSubProblema").value;
	//codigoSelime();
	//alert(document.getElementById("cboSubProblema").value);
	if( valor==230){
		document.getElementById("tipoAnimal").style.display="block";
		}
	else{
		document.getElementById("tipoAnimal").style.display="none";
		}
}

function hijomenor666(){
	var valor = document.getElementById("cboSubProblema").value;
	//codigoSelime();
	//alert(document.getElementById("cboSubProblema").value);
	if(valor==100 || valor==130 || valor==240 || valor==270 || valor==310 || valor==340){
		document.getElementById("idFec").style.display="block";
		}
	else{
		document.getElementById("idFec").style.display="none";
		}
}

function hijomenor777(movimiento){
	var valor2 = document.getElementById("movimiento").value;
	//codigoSelime();
	//alert(document.getElementById("cboSubProblema").value);
	if(valor2==90){
		document.getElementById("estado2").style.display="block";
		}
	else{
		document.getElementById("estado2").style.display="none";
		}
}

function hijomenor888(){
	var valor = document.getElementById("cboMovimiento").value;

	//alert(document.getElementById("codigoSelime").value);
	if(valor==100){
		document.getElementById("estado22").style.display="block";
		}
	else{
		document.getElementById("estado22").style.display="none";
		}			
}


function identificador(){
	var valor = document.getElementById("cboSubProblema").value;
	//alert(valor);
	//alert(document.getElementById("cboSubProblema").value);
	//if(valor==100){
	//	document.getElementById('ident1').innerHTML = 'UNIDAD';
	//	document.getElementById('ident2').innerHTML = 'DIA A DESVALIDAR';
	//	}
	
	//if(valor==110){
	//		document.getElementById('ident1').innerHTML = 'UNIDAD';
	//	document.getElementById('ident2').innerHTML = 'TIPO SERVICIO';
	//	}
		//alert(valor);
	if(valor==120){
			document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'RUT';
		}
		
	if(valor==130){
			document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
		}
					
		if(valor==140){
			document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'RUT';
		}
		
	if(valor==150){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'RUT CORRECTO';
		}
		
	if(valor==160){
			document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'NOMBRE CORRECTO';
		}
		
	if(valor==170){
			document.getElementById('ident3').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident4').innerHTML = 'TIPO DE USUARIO';
		}
		
	if(valor==180){
			document.getElementById('ident3').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident4').innerHTML = 'TIPO DE USUARIO';
		}
		
	if(valor==190){
			document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		//document.getElementById('ident2').innerHTML = 'FECHA';
		}
		
	if(valor==200){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		//document.getElementById('ident2').innerHTML = 'FECHA';
		}
		
	if(valor==210){
			document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'FOLIO LICENCIA';
		}
	
	if(valor==220){
		document.getElementById('ident1').innerHTML = 'CODIGO FUNCIONARIO';
		document.getElementById('ident2').innerHTML = 'FOLIO LICENCIA';
		}
		
	if(valor==230){
			document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'TIPO ANIMAL';
		}
		
	if(valor==240){
			document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
		}
		
	if(valor==250){
			document.getElementById('ident1').innerHTML = 'B.C.U. ERRONEO';
		document.getElementById('ident2').innerHTML = 'B.C.U. CORRECTO';
		}
		
	if(valor==260){
			document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'PATENTE';
		}
		
	if(valor==270){
			document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
		}

	if(valor==280){
			document.getElementById('ident1').innerHTML = 'B.C.U.';
		document.getElementById('ident2').innerHTML = 'PATENTE CORRECTA';
		}
		
	if(valor==290){
			document.getElementById('ident1').innerHTML = 'PATENTE';
		document.getElementById('ident2').innerHTML = 'B.C.U. CORRECTO';
		}
		
	if(valor==300){
			document.getElementById('ident1').innerHTML = 'N° DE SERIE';
		document.getElementById('ident2').innerHTML = 'N° DE TARJETA';
		}
		
	if(valor==310){
			document.getElementById('ident1').innerHTML = 'N° DE SERIE';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
		}
		
	if(valor==320){
			document.getElementById('ident1').innerHTML = 'N° DE SERIE ERRONEO';
		document.getElementById('ident2').innerHTML = 'N° DE SERIE CORRECTO';
		}
		
	if(valor==330){
			document.getElementById('ident1').innerHTML = 'N° DE SERIE';
		document.getElementById('ident2').innerHTML = 'MODELO ARMA';
		}
		
	if(valor==340){
			document.getElementById('ident1').innerHTML = 'N° DE SERIE ERRONEO';
		document.getElementById('ident2').innerHTML = 'FECHA CAMBIO ESTADO';
		}
	
	if(valor==350){
			document.getElementById('ident1').innerHTML = 'N° DE SERIE ERRONEO';
		document.getElementById('ident2').innerHTML = 'N° DE SERIE CORRECTO';
		}
		
	if(valor==360){
			document.getElementById('ident1').innerHTML = 'DESCRIPCION INICIAL';
		document.getElementById('ident2').innerHTML = 'DESCRIPCION FINAL';
		}
		
	if(valor==370){
			document.getElementById('ident1').innerHTML = 'UNIDAD';
		//document.getElementById('ident2').innerHTML = 'FECHA';
		}
									
}

function adjuntarArchivo(){
	var valor = document.getElementById("cboMovimiento").value;
//alert(valor);
	if(valor==60){
		document.getElementById("adjunto").style.display="block";
		}else if(valor==70){
		document.getElementById("adjunto").style.display="block";
		}else if(valor==30){
		document.getElementById("adjunto").style.display="block";
		
		}else if(valor==80){
		document.getElementById("adjunto").style.display="block";
	}else if(valor==90){
		document.getElementById("adjunto").style.display="block";
		}else if(valor==100){
		document.getElementById("adjunto").style.display="block";
	}else{
		document.getElementById("adjunto").style.display="none";
		}				
				
}

/*Función para subir el archivo digital al servidor, con formato RUN+"-"+COLORLICENCIA+" "+FOLIOLICENCIA */
function subirArchivo(boton){
	var fecha					         	= document.getElementById("fechaArchivo").value;
	var rutaArchivo 						= document.getElementById("archivo").value;
	var arrayRutaArchivo 				= rutaArchivo.split("\\");
	var cantidadArreglo 				= arrayRutaArchivo.length;
	var nombreDelArchivo 				= arrayRutaArchivo[cantidadArreglo-1];	
	var archivoServidor					=	document.getElementById("archivoServidor").value;	
	var extension 							= (rutaArchivo.substring(rutaArchivo.lastIndexOf("."))).toUpperCase(); 	
	var extensiones_permitidas 	= new Array(".JPG", ".JPEG", ".PNG", ".PDF");
	var noaceptada  						= true;
	//var rutsinchar							= document.getElementById("txtrut").value;
	var folioColor 							= document.getElementById("usuario").value;
	
	for (var i = 0; i < extensiones_permitidas.length; i++) {
    if (extensiones_permitidas[i] == extension) {
     	noaceptada = false;
    }
  } 
  
  if(noaceptada){
		alert("EL TIPO DE ARCHIVO NO ES PERMITIDO, DEBE SER EN FORMATO JPG, JPEG, PNG O PDF");
   	return false;
  }
	
	//rutsinchar=rutsinchar.replace(".","");
	//rutsinchar=rutsinchar.replace(".","");
	//rutsinchar=rutsinchar.replace("-","");
	
	rutaArchivo = folioColor+" "+fecha+extension;
	
	if(folioColor == archivoServidor){
		alert("EL DOCUMENTO YA EXISTE");
		return false;
	}
	
	document.getElementById("rutArchi").value = rutaArchivo;	
	document.formSubeArchivo.submit();
	
	boton.disabled = true;
	document.getElementById("archivo").disabled = true;
	document.getElementById("archivoLoad").value=1;
	
}

