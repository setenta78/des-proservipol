var cargaVistaServicio;

function buscaServicio(unidad, fecha, servicio){
	cargaVistaServicio = 0;
	
	divListaFuncionariosAsignados = document.getElementById("listadoPersonalRealizoServicio");
	divListaFuncionariosAsignados.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;CARGANDO PERSONAL ASIGNADO ......</td>";	
	
	divListaVehiculosAsignados = document.getElementById("listadoVehiculosRealizoServicio");
	divListaVehiculosAsignados.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;CARGANDO VEHICULOS ASIGNADOS ......</td>";	
	
	divListaArmasAsignadas = document.getElementById("listadoArmamentoServicio");
	divListaArmasAsignadas.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;CARGANDO ARMAS ASIGNADAS ......</td>";	
	
	divListaAnimalesAsignados = document.getElementById("listadoAnimalesServicio");
	divListaAnimalesAsignados.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;CARGANDO ANIMALES ASIGNADOS ......</td>";	
	
	divListaAccesoriosAsignados = document.getElementById("listadoAccesoriosServicio");
	divListaAccesoriosAsignados.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;CARGANDO ACCESORIOS ASIGNADOS ......</td>";	
	
	var objHttpXMLServicios = new AJAXCrearObjeto();
	objHttpXMLServicios.open("POST","./xml/xmlServicios/xmlVistaServicio.php",true);
	objHttpXMLServicios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLServicios.send(encodeURI("unidad="+unidad+"&fecha="+fecha+"&servicio="+servicio));
	objHttpXMLServicios.onreadystatechange=function()
	{
		if(objHttpXMLServicios.readyState == 4)
		{       
			//alert(objHttpXMLServicios.responseText);		
			var xml = objHttpXMLServicios.responseXML.documentElement;	
			var nombreServicio = xml.getElementsByTagName('nombreServicio')[0].text;
			var fechaServicio = xml.getElementsByTagName('fecha')[0].text;
			var unidadServicio = xml.getElementsByTagName('nombreUnidad')[0].text;
			
			document.getElementById("especificaServicio").innerHTML = nombreServicio+" DEL "+fechaServicio + " CORRESPONDIENTE A LA " + unidadServicio;					
			
			if (xml.getElementsByTagName('funcionariosAsignados').length>0){
				var funcionariosAsignados 	= xml.getElementsByTagName('funcionariosAsignados')[0];
				listarFuncionariosAsignados(funcionariosAsignados, divListaFuncionariosAsignados);
			}
			
			if (xml.getElementsByTagName('vehiculosAsignados').length>0){
				var vehiculosAsignados 		= xml.getElementsByTagName('vehiculosAsignados')[0];
				listarVehiculosAsignados(vehiculosAsignados, divListaVehiculosAsignados)
			} else {
				document.getElementById("vehiculos").style.visibility = "hidden";
				document.getElementById("vehiculos").style.position = "absolute";  
			}
			
			if (xml.getElementsByTagName('armasAsignadas').length>0){
				var armasAsignadas	= xml.getElementsByTagName('armasAsignadas')[0];
				listarArmasAsignadas(armasAsignadas, divListaArmasAsignadas)
			} else {
				document.getElementById("armamento").style.visibility = "hidden";
				document.getElementById("armamento").style.position = "absolute";  
			}
			
			//alert(xml.getElementsByTagName('animalesAsignados').length);
			if (xml.getElementsByTagName('animalesAsignados').length>0){
				var animalesAsignados	= xml.getElementsByTagName('animalesAsignados')[0];
				listarAnimalesAsignados(animalesAsignados, divListaAnimalesAsignados);
			} else {
				document.getElementById("animales").style.visibility = "hidden";
				document.getElementById("animales").style.position = "absolute";  
			}

			if (xml.getElementsByTagName('accesoriosAsignados').length>0){
				var accesoriosAsignados	= xml.getElementsByTagName('accesoriosAsignados')[0];
				listarAccesoriosAsignados(accesoriosAsignados, divListaAccesoriosAsignados)
			} else {
				document.getElementById("accesorios").style.visibility = "hidden";
				document.getElementById("accesorios").style.position = "absolute";  
			}
			

			cargaVistaServicio = 1;
		}
	}
} 


function listarFuncionariosAsignados(funcionariosAsignados, div){
	var listadoFuncionariosAsignados, sw, fondoLinea, resaltarLinea, lineaSinResaltar;
	var codigo, apellidoPaterno, apellidoMaterno, nombre, grado;
	var nombreCompleto; 
	
	listadoFuncionariosAsignados = "<table width='100%' cellspacing='1' cellpadding='1'>";
	for(i=0;i<funcionariosAsignados.getElementsByTagName('funcionario').length;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}
										
		codigo	 		= funcionariosAsignados.getElementsByTagName('codigo')[i].text;
		apellidoPaterno	= funcionariosAsignados.getElementsByTagName('apellidoPaterno')[i].text;
		apellidoMaterno	= funcionariosAsignados.getElementsByTagName('apellidoMaterno')[i].text;
		nombre		 	= funcionariosAsignados.getElementsByTagName('nombre')[i].text;
		grado	 		= funcionariosAsignados.getElementsByTagName('grado')[i].text;

		nombreCompleto	= apellidoPaterno + " " + apellidoMaterno + ", " + nombre;
							
		resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
		lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
				
		listadoFuncionariosAsignados += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
		listadoFuncionariosAsignados += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
		listadoFuncionariosAsignados += "<td width='35%'><div id='valorColumna'>"+nombreCompleto+"</div></td>";
		listadoFuncionariosAsignados += "<td width='24%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
		listadoFuncionariosAsignados += "<td width='36%' align='left'><div id='valorColumna'>"+codigo+"</div></td>";
		listadoFuncionariosAsignados += "</tr>";
	}
	listadoFuncionariosAsignados += "</table>";
	div.innerHTML = listadoFuncionariosAsignados;
}


function listarVehiculosAsignados(vehiculosAsignados, div){
	var listadoVehiculosAsignados, sw, fondoLinea, resaltarLinea, lineaSinResaltar;
	var tipo, patente, kmInicial, kmFinal, totalKms, combustible;
		
	listadoVehiculosAsignados = "<table width='100%' cellspacing='1' cellpadding='1'>";
	for(i=0;i<vehiculosAsignados.getElementsByTagName('vehiculo').length;i++){
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}
										
		tipo	 	= vehiculosAsignados.getElementsByTagName('tipo')[i].text;
		patente		= vehiculosAsignados.getElementsByTagName('patente')[i].text;
		kmInicial	= vehiculosAsignados.getElementsByTagName('kmInicial')[i].text;
		kmFinal		= vehiculosAsignados.getElementsByTagName('kmFinal')[i].text;
		totalKms	= vehiculosAsignados.getElementsByTagName('totalKms')[i].text;
		combustible	= vehiculosAsignados.getElementsByTagName('combustible')[i].text;
						
		resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
		lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
				
		listadoVehiculosAsignados += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
		listadoVehiculosAsignados += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
		listadoVehiculosAsignados += "<td width='35%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
		listadoVehiculosAsignados += "<td width='12%' align='center'><div id='valorColumna'>"+patente+"</div></td>";
		listadoVehiculosAsignados += "<td width='12%' align='right'><div id='valorColumna'>"+kmInicial+"</div></td>";
		listadoVehiculosAsignados += "<td width='12%' align='right'><div id='valorColumna'>"+kmFinal+"</div></td>";
		listadoVehiculosAsignados += "<td width='12%' align='right'><div id='valorColumna'>"+totalKms+"</div></td>";
		listadoVehiculosAsignados += "<td width='12%' align='right'><div id='valorColumna'>"+combustible+" Lts.</div></td>";
		listadoVehiculosAsignados += "</tr>";
	}
	listadoVehiculosAsignados += "</table>";
	div.innerHTML = listadoVehiculosAsignados;
}


function listarArmasAsignadas(armasAsignadas, div){
	var listadoArmasAsignadas, sw, fondoLinea, resaltarLinea, lineaSinResaltar;
	var tipo, numero, apellidoPaterno, apellidoMaterno, nombre, nombreCompleto;
	
	listadoArmasAsignadas = "<table width='100%' cellspacing='1' cellpadding='1'>";
	for(i=0;i<armasAsignadas.getElementsByTagName('arma').length;i++){
			
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}
										
		tipo	 		 = armasAsignadas.getElementsByTagName('tipo')[i].text;
		numero			 = armasAsignadas.getElementsByTagName('numero')[i].text;
		apellidoPaterno	 = armasAsignadas.getElementsByTagName('apellidoPaterno')[i].text;
		apellidoMaterno	 = armasAsignadas.getElementsByTagName('apellidoMaterno')[i].text;
		nombre			 = armasAsignadas.getElementsByTagName('nombre')[i].text;
		                
		nombreCompleto	 = apellidoPaterno + " " + apellidoMaterno + ", " + nombre;
						
		resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
		lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
				
		listadoArmasAsignadas += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
		listadoArmasAsignadas += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
		listadoArmasAsignadas += "<td width='35%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
		listadoArmasAsignadas += "<td width='24%' align='center'><div id='valorColumna'>"+numero+"</div></td>";
		listadoArmasAsignadas += "<td width='36%' align='left'><div id='valorColumna'>"+nombreCompleto+"</div></td>";
		listadoArmasAsignadas += "</tr>";
	}
	listadoArmasAsignadas += "</table>"; 
	div.innerHTML = listadoArmasAsignadas;
}


function listarAnimalesAsignados(animalesAsignados, div){
	var listadoAnimalesAsignados, sw, fondoLinea, resaltarLinea, lineaSinResaltar;
	var tipo, cantidad;
	
	listadoAnimalesAsignados = "<table width='100%' cellspacing='1' cellpadding='1'>";
	for(i=0;i<animalesAsignados.getElementsByTagName('animal').length;i++){
			
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}
										
		tipo	 		 = animalesAsignados.getElementsByTagName('tipo')[i].text;
		cantidad		 = animalesAsignados.getElementsByTagName('cantidad')[i].text;
								
		resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
		lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
				
		listadoAnimalesAsignados += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
		listadoAnimalesAsignados += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
		listadoAnimalesAsignados += "<td width='35%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
		listadoAnimalesAsignados += "<td width='24%' align='center'><div id='valorColumna'>"+cantidad+"</div></td>";
		listadoAnimalesAsignados += "<td width='36%' align='center'><div id='valorColumna'></div></td>";
		listadoAnimalesAsignados += "</tr>";
	}
	listadoAnimalesAsignados += "</table>"; 
	div.innerHTML = listadoAnimalesAsignados;
}


function listarAccesoriosAsignados(accesoriosAsignados, div){
	var listadoAccesoriosAsignados, sw, fondoLinea, resaltarLinea, lineaSinResaltar;
	var tipo, cantidad;
	
	listadoAccesoriosAsignados = "<table width='100%' cellspacing='1' cellpadding='1'>";
	for(i=0;i<accesoriosAsignados.getElementsByTagName('accesorio').length;i++){
			
		if (sw==0) {fondoLinea = "linea1";sw =1}
		else {fondoLinea = "linea2";sw=0}
										
		tipo	 		 = accesoriosAsignados.getElementsByTagName('tipo')[i].text;
		cantidad		 = accesoriosAsignados.getElementsByTagName('cantidad')[i].text;
								
		resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
		lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
				
		listadoAccesoriosAsignados += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
		listadoAccesoriosAsignados += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
		listadoAccesoriosAsignados += "<td width='35%' align='left'><div id='valorColumna'>"+tipo+"</div></td>";
		listadoAccesoriosAsignados += "<td width='24%' align='center'><div id='valorColumna'>"+cantidad+"</div></td>";
		listadoAccesoriosAsignados += "<td width='36%' align='center'><div id='valorColumna'></div></td>";
		listadoAccesoriosAsignados += "</tr>";
	}
	listadoAccesoriosAsignados += "</table>"; 
	div.innerHTML = listadoAccesoriosAsignados;
}