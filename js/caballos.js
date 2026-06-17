var cargaListadoVehiculos;
var idCargaListadoVehiculos;
var idAsignaSelectFichaVehiculo;

function leeCaballos(unidad){
	cargaListadoVehiculos = 0;
	var vehiculoBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoVehiculos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Caballos ......</td>";
    
	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlListaCaballos.php",true);
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
				
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var unidad	 		= "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var pelaje			= "";
				var sexo			  = "";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var razaColor = "";
				var tipoAnimal =""; 
				
				
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoVehiculos	= "";
				
				
				listadoVehiculos = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('caballo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					nombre	   = xml.getElementsByTagName('nombre')[i].text;
					bcu	 		   = xml.getElementsByTagName('bcu')[i].text;
					unidad	   = xml.getElementsByTagName('unidad')[i].text;
					fecha	 		 = xml.getElementsByTagName('fecha')[i].text;
					razaColor  = xml.getElementsByTagName('raza')[i].text + " " + xml.getElementsByTagName('color')[i].text;
					pelaje	   = xml.getElementsByTagName('pelaje')[i].text;
					sexo	 		 = xml.getElementsByTagName('sexo')[i].text;
				  estado	 	 = xml.getElementsByTagName('estado')[i].text;
				  codUnidadAgregado	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
				  desUnidadAgregado	= xml.getElementsByTagName('desUnidadAgregado')[i].text;
				  tipoAnimal 		 		= xml.getElementsByTagName('tipoAnimal')[i].text;

				
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('CABALLO ...', '800', '360','fichaCaballo.php?codigoVehiculo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					

					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(tipoAnimal=="CABALLO"){
					var color1="maroon";   
        }else if(tipoAnimal=="PERRO POLICIAL"){
        	var color1="navy";
        	}else{
        		var color1="orange";
        		}
          //var estado = "SIN ASIGNAR";    
															
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='5%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
					listadoVehiculos += "<td width='15%'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
					listadoVehiculos += "<td width='15%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
					//listadoVehiculos+= "<td width='19%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos+= "<td width='19%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
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

function leePerros(unidad){
	cargaListadoVehiculos = 0;
	var vehiculoBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoPerros");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Perros ......</td>";
    
	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlListaPerros.php",true);
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
				
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var unidad	 		= "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var pelaje			= "";
				var sexo			  = "";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var razaColor = "";
				var tipoAnimal =""; 
				
				
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoVehiculos	= "";
				
				
				listadoVehiculos = "<table width='98.3%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('caballo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					nombre	   = xml.getElementsByTagName('nombre')[i].text;
					bcu	 		   = xml.getElementsByTagName('bcu')[i].text;
					unidad	   = xml.getElementsByTagName('unidad')[i].text;
					fecha	 		 = xml.getElementsByTagName('fecha')[i].text;
					razaColor  = xml.getElementsByTagName('raza')[i].text + " " + xml.getElementsByTagName('color')[i].text;
					pelaje	   = xml.getElementsByTagName('pelaje')[i].text;
					sexo	 		 = xml.getElementsByTagName('sexo')[i].text;
				  estado	 	 = xml.getElementsByTagName('estado')[i].text;
				  codUnidadAgregado	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
				  desUnidadAgregado	= xml.getElementsByTagName('desUnidadAgregado')[i].text;
				  tipoAnimal 		 		= xml.getElementsByTagName('tipoAnimal')[i].text;

				
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('CABALLO ...', '800', '360','fichaCaballo.php?codigoVehiculo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					

					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
					
					if(tipoAnimal=="CABALLO"){
					var color1="maroon";   
        }else if(tipoAnimal=="PERRO POLICIAL"){
        	var color1="navy";
        	}else{
        		var color1="orange";
        		}
          //var estado = "SIN ASIGNAR";    
															
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='5%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
					listadoVehiculos += "<td width='15%'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
					listadoVehiculos += "<td width='15%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
					//listadoVehiculos+= "<td width='19%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos+= "<td width='19%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
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

function leeCaballosAgregados(unidad){
	cargaListadoVehiculos = 0;
	var vehiculoBuscar = eliminarBlancos(document.getElementById("textBuscar").value);

	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoVehiculos");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Caballos ......</td>";
    
	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlListaCaballosAgregados.php",true);
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
				
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var unidad	 		= "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var pelaje			= "";
				var sexo			  = "";
				var estado      = ""; 
				var codUnidadAgregado	= "";
				var desUnidadAgregado	= "";
				var razaColor = "";
				
				
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoVehiculos	= "";
				
				
				listadoVehiculos = "<table width='100%' cellspacing='1' cellpadding='1'>";
				for(i=0;i<xml.getElementsByTagName('caballo').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
										
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					nombre	   = xml.getElementsByTagName('nombre')[i].text;
					bcu	 		   = xml.getElementsByTagName('bcu')[i].text;
					unidad	   = xml.getElementsByTagName('unidad')[i].text;
					fecha	 		 = xml.getElementsByTagName('fecha')[i].text;
					razaColor  = xml.getElementsByTagName('raza')[i].text + " " + xml.getElementsByTagName('color')[i].text;
					pelaje	   = xml.getElementsByTagName('pelaje')[i].text;
					sexo	 		 = xml.getElementsByTagName('sexo')[i].text;
				  estado	 	 = xml.getElementsByTagName('estado')[i].text;
				  codUnidadAgregado	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
				  desUnidadAgregado	= xml.getElementsByTagName('desUnidadAgregado')[i].text;
				  tipoAnimal 		 		= xml.getElementsByTagName('tipoAnimal')[i].text;

				
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					var dblClick = "javascript:abrirVentana('CABALLO ...', '800', '330','fichaCaballo.php?codigoVehiculo="+codigo+"','"+nroLinea+"','','5','5')";
				
					//alert(dblClick);
					
					if (desUnidadAgregado != "") estado += ", "+desUnidadAgregado;
					
					if (estado.length > 29) {
						var estadoMuestra = estado.substr(0,27) + " ...";
						var mostrarEtiqueta = " title='"+estado+"'";
					} else {
						var estadoMuestra = estado;
						var mostrarEtiqueta = "";
					}
          var color1="";   
          //var estado = "SIN ASIGNAR";    
															
					listadoVehiculos += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoVehiculos += "<td width='5%' align='center'><font color="+color1+"><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><font color="+color1+"><div id='valorColumna'>"+nombre+"</div></td>";
					listadoVehiculos += "<td width='23%' align='left'><font color="+color1+"><div id='valorColumna'>"+razaColor+"</div></td>";
					listadoVehiculos += "<td width='15%'><font color="+color1+"><div id='valorColumna'>"+tipoAnimal+"</div></td>";
					listadoVehiculos += "<td width='15%' align='left'><font color="+color1+"><div id='valorColumna'>"+bcu+"</div></td>";
					//listadoVehiculos+= "<td width='19%' align='left'><div id='valorColumna'>"+estado+"</div></td>";
					listadoVehiculos+= "<td width='19%' align='left'"+mostrarEtiqueta+"><font color="+color1+"><div id='valorColumna'>"+estadoMuestra+"</div></td>";
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

function buscaDatosCaballo(){
	
	var bcuVehiculo	= eliminarBlancos(document.getElementById("textNumeroBCU").value);
	//alert(bcuVehiculo.length);
	//alert(bcuVehiculo);
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
		//alert();
	 leeDatosCaballo('',bcuVehiculo,1);	
	}
}

function buscaCaballoL4(){
	//alert();
	var codigoVehiculo = document.getElementById("textNumeroBCU").value;
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlBuscaCaballoL4.php",false);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI("codigoVehiculo="+codigoVehiculo)); 
	
	//objHttpXMLVehiculos.onreadystatechange=function()
	//{
	//	if(objHttpXMLVehiculos.readyState == 4)
	//	{       
			if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);	
				var xml 				= objHttpXMLVehiculos.responseXML.documentElement;
				var bcu		      = "";
				var nombre 			= "";
				var fecha				= "";
				var raza        = "";
				var codTipo     = "";
				var sexo        = ""; 
				var codSexo     = ""; 
				var pelaje      = "";
				var codPelaje   = ""; 
				var color       = "";
				var codColor    = "";
				
				
				//alert();				
				for(i=0;i<xml.getElementsByTagName('caballo').length;i++){
					
					bcu	 		   = xml.getElementsByTagName('bcu')[i].text;
					nombre	   = xml.getElementsByTagName('nombre')[i].text;
					fecha	 		 = xml.getElementsByTagName('fecha')[i].text;
					raza	 		 = xml.getElementsByTagName('raza')[i].text;
					sexo	 		 = xml.getElementsByTagName('sexo')[i].text;
					pelaje     = xml.getElementsByTagName('pelaje')[i].text;
					color      = xml.getElementsByTagName('color')[i].text;
					
					if(raza=="MESTIZO" || raza=="FINA SANGRE INGLES" || raza=="HOLSTEINER"	
             || raza=="HOLSTEINER X F.S.C." || raza=="ARABE" || raza=="HOLSTEINER X MESTIZO"	
             || raza=="MESTIZO 1/4 MILLA" || raza=="FINA SANGRE INGLES X MESTIZO"	
             || raza=="HACKNEY" || raza=="CHILENO" || raza=="PONY SHETLAND"	
             || raza=="ARABE X MESTIZO"){
             	codTipo=10;
            
             	}else if(raza=="LABRADOR" || raza=="OVEJERO ALEMAN" || raza=="SCHNAUZER GIGANTE"	
                       || raza=="DOBERMAN PINSCHER"	|| raza=="COCKER SPANIEL" || raza=="DALMATA"	|| raza=="BRACO ALEMAN"	
                       || raza=="SETTER IRLANDES_"	|| raza=="PASTOR CANADIENSE" || raza=="SAN BERNARDO" || raza=="PASTOR BELGA"	
                       || raza=="FILA BRASILENO" || raza=="KOMONDOR" || raza=="WEIMARANE" || raza=="GOLDEN RETRIEVER"	
                       || raza=="GOLDADOR"){
             		codTipo=40;
             		}
             	
             	
       if(sexo==1){
       	codSexo=10;
       	}else if(sexo==2){
       		codSexo=20;
       	}
       	if(pelaje==1){
       		codPelaje=10;
       	}else if(pelaje==2){
       		codPelaje=20;
       	}else if(pelaje==3){
       		codPelaje=30;
       		}
       	
       	if(color == 02 || color == 28){
       		codColor=10;
       		}else if(color == 03){
       		codColor=20;	
       		}else if(color == 04){
       		codColor=30;	
       		}else if(color == 05){
       		codColor=40;	
       		}else if(color == 06){
       		codColor=50;	
       		}else if(color == 07){
       		codColor=60;	
       		}else if(color == 08){
       		codColor=70;	
       		}else if(color == 09){
       		codColor=80;	
       		}else if(color == 10){
       		codColor=90;	
       		}else if(color == 01){
       		codColor=100;	
       		}else if(color == 11){
       		codColor=110;	
       		}else if(color == 12){
       		codColor=120;	
       		}else if(color == 13){
       		codColor=130;	
       		}else if(color == 14){
       		codColor=140;	
       		}else if(color == 15){
       		codColor=150;	
       		}else if(color == 16){
       		codColor=160;	
       		}else if(color == 17){
       		codColor=170;	
       		}else if(color == 18){
       		codColor=180;	
       		}else if(color == 19){
       		codColor=190;	
       		}else if(color == 20){
       		codColor=200;	
       		}else if(color == 21){
       		codColor=210;	
       		}else if(color == 22){
       		codColor=220;	
       		}else if(color == 23){
       		codColor=230;	
       		}else if(color == 24){
       		codColor=240;	
       		}else if(color == 25){
       		codColor=250;	
       		}else if(color == 26 || color == 27){
       		codColor=260;	
       		}else{
       		codColor=0;
       			}
       		
					
					
					document.getElementById("textNumeroBCU").readOnly = "true";					
					document.getElementById("textNombre").value    = nombre;
					document.getElementById("textNumeroBCU").value = bcu;
					document.getElementById("textFechaNacimiento").value = fecha;
					document.getElementById("textRaza").value = raza;
					
					document.getElementById("selTipoAnimal").value = codTipo;
					document.getElementById("selSexo").value = codSexo;
					document.getElementById("selPelaje").value = codPelaje;
					document.getElementById("selColor").value = codColor;
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

function leeDatosCaballo(codigoVehiculo, bcuVehiculo, tipo){

	//alert();
	
	document.getElementById("mensajeCargando").style.display = "";
	document.getElementById("mensajeCargando").style.left = "100px";
	document.getElementById("mensajeCargando").style.top  = "120px";
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlDatosCaballos.php",true);
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
				var xml 			  = objHttpXMLVehiculos.responseXML.documentElement;
				var codigo	 	  = "";
				var nombre		  = "";
				var bcu 		    = "";
				var fecha	      = "";
				var raza				= "";
				var color				= "";
				var pelaje			= "";
				var sexo			  = "";
				var fechaEstado			  = "";
				var estado				  = "";
				var unidadVehiculo		  = "";
				var descUnidadVehiculo	  = "";
        var fechaEstado			  = "";
        var codigoUnidadAgregado  = "";
        var desUnidadAgregado  	  = "";
        var tipoAnimal 	  = "";
        var  tipoAnimalDescripcion = "";
        var  verifica = "";

				
				//alert();				
				for(i=0;i<xml.getElementsByTagName('caballo').length;i++){
					codigo	 	 = xml.getElementsByTagName('codigo')[i].text;
					nombre	   = xml.getElementsByTagName('nombre')[i].text;
					bcu	 		   = xml.getElementsByTagName('bcu')[i].text;
					unidad	   = xml.getElementsByTagName('unidad')[i].text;
					fecha	 		 = xml.getElementsByTagName('fecha')[i].text;
					raza	     = xml.getElementsByTagName('raza')[i].text;
					color 		 = xml.getElementsByTagName('color')[i].text;
					pelaje	   = xml.getElementsByTagName('pelaje')[i].text;
					sexo	 		 = xml.getElementsByTagName('sexo')[i].text;
					unidadVehiculo 	 		= xml.getElementsByTagName('unidad')[i].text;
					descUnidadVehiculo 		= xml.getElementsByTagName('descUnidad')[i].text;
	        fechaEstado 			= xml.getElementsByTagName('fechaEstado')[i].text;
          codigoUnidadAgregado 	= xml.getElementsByTagName('codigoUnidadAgregado')[i].text;
          desUnidadAgregado 		= xml.getElementsByTagName('desUnidadAgregado')[i].text;
          estado	 		 		= xml.getElementsByTagName('estado')[i].text;
          tipoAnimal 		 		= xml.getElementsByTagName('tipoAnimal')[i].text;
          tipoAnimalDescripcion 		 		= xml.getElementsByTagName('tipoAnimalDescripcion')[i].text;
          verifica		 		= xml.getElementsByTagName('verifica')[i].text;


					
					if (codigoUnidadAgregado == 0) codigoUnidadAgregado = "";
					if(sexo=='MACHO'){
						sexoValue = 10;
					}
					else{
						sexoValue = 20;
					}
					
					//alert(descUnidadVehiculo);
					document.getElementById("textNumeroBCU").readOnly 		     = "true";			
					document.getElementById("idVehiculo").value 			         = codigo;
					document.getElementById("textNombre").value 			         = nombre;
					document.getElementById("textFechaNacimiento").value       = fecha;
					document.getElementById("textNumeroBCU").value 			       = bcu;
					document.getElementById("textRaza").value 			           = raza;				
					document.getElementById("selColor").value 	 	             = color;
					document.getElementById("selPelaje").value 	             	= pelaje;
					document.getElementById("selSexo").value                   = sexoValue;
					document.getElementById("ultimaFecha").value 			    = fechaEstado;
					document.getElementById("codigoUnidadAgregado").value 	 	= codigoUnidadAgregado;
					document.getElementById("textUnidadAgregado").value 	 	= desUnidadAgregado;
					document.getElementById("codUnidadAgregadoBaseDatos").value = codigoUnidadAgregado;
					document.getElementById("desUnidadAgregadoBaseDatos").value = desUnidadAgregado;
				  document.getElementById("selTipoAnimal").value                   = tipoAnimal;
				  document.getElementById("verificaOculto").value                   = verifica;
				  
				 if(document.getElementById("verificaOculto").value == "SI"){
				    	 document.getElementById("verificar").checked="true"; 
				    	 document.getElementById("verificar").disabled="true"; 
				    	 document.getElementById("labConfirmar").disabled=""; 
				    	 document.getElementById("labConfirmar").innerHTML = "VERIFICADO"; 
				}else{
				    	 document.getElementById("verificar").checked=""; 
				    	 document.getElementById("verificar").disabled=""; 
				    	 document.getElementById("verificar").disabled=""; 
				
				}
					
					if (unidad == "") var habilitarBotones = false;
					else var habilitarBotones = true;

					
         document.getElementById("labFechaCargoDesde").innerHTML = "FECHA DESDE QUE REGISTRA ULTIMO MOVIMIENTO : " + fechaEstado;			
         
				 var valoresAsignar = "'" + estado + "'," + habilitarBotones;    

					idAsignaSelectFichaVehiculo = setInterval("asignaValores("+valoresAsignar+")",500); 
	
					//alert(tipo);
					if (tipo == "1"){
						document.getElementById("btnBuscarVehiculo").value = "BUSCAR";
						document.getElementById("btnBuscarVehiculo").disabled = "";
						
						var unidadUsuario = document.getElementById("unidadUsuario").value;
						if (unidadUsuario == unidadVehiculo){
							alert("ESTE ANIMAL YA PERTENECE A ESTA UNIDAD ...          ");
							cerrarVentanaVehiculo();
						}
						
						if (unidadUsuario != unidadVehiculo && unidadVehiculo != ""){
							alert("NO PUEDE AGREGAR ESTE ANIMAL,\nYA QUE PERTENECE A LA " +descUnidadVehiculo+ ", Y AUN NO HA SIDO DESPACHADO ... ");
							cerrarVentanaVehiculo();
						} 
	
						//if(document.getElementById("verificaOculto").value == "NO"){
						//	alert("DEBE VERIFICAR EL ESTADO");
						//	cerrarVentanaVehiculo();
						//	}
						
						//if (unidadVehiculo == ""){
						//	alert(unidadVehiculo);
						//	document.getElementById("labFechaEstado").disabled= "";
						//	document.getElementById("textFechaNuevoEstado").disabled= "";
						//	document.getElementById("imagenCalendarioFichaVehiculo").style.visibility = "visible"; 
						//	document.getElementById("textFechaNuevoEstado").style.backgroundColor = "";
						//}
					}



					

/*-----------------------------------------------------------------------------------------------------------------*/			


		
/*-----------------------------------------------------------------------------------------------------------------*/
				}
				
		}else {
			//alert();
				var caballoL4 = buscaCaballoL4();
				//alert(caballoL4);
				if(!caballoL4){
					alert("EL CABALLO CON EL BCU INDICADO, NO SE ENCUENTRA EN LAS BASES DE DATOS          ");   
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

function asignaValores(estado, habilitarBotones){
	if (cargaEstadosRecurso == 1 ){
		clearInterval(idAsignaSelectFichaVehiculo);
		
		if (estado == "") estado = 0;
		document.getElementById("selEstado").value 			= estado;
		document.getElementById("estadoBaseDatos").value 	= estado;
		

		
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
	document.getElementById("btnBaja").disabled = "";
	document.getElementById("btnGuardarOrganizacion").disabled = "";
	document.getElementById("btnCerrarFichaFuncionario").disabled = "";
}

function activaBuscaUnidadAgregado(){
	desactivarBotones();
	
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaSeleccionaUnidad").style.display = "";
}


function activaVentanaIngresoFecha(boton){
	desactivarBotones();
	document.getElementById("textTipo").value = boton;
	document.getElementById("cubreVentanaPersonal").style.display = "";
	document.getElementById("ventanaIngresoFecha").style.display  = "";	
	document.getElementById("textFechaVentanaFecha").value = "";
	if (boton == 1) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectivo el Traslado de este Animal :"
	if (boton == 2) document.getElementById("textTipoMovimentoVentanaFecha").innerHTML = "Indique fecha en que se hace efectiva la Baja de este Animal :"
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
	var msj=confirm("SACARA ESTE ANIMAL DE LA OFERTA DE LA UNIDAD.                                       \n\u00BFDESEA CONTINUAR?...");
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
			objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlLiberaAnimal.php",true);
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
								alert('EL ANIMAL FUE DEJADO DISPONIBLE PARA OTRA UNIDAD ......        ');
								top.leeCaballos(unidadUsuario);
								top.leePerros(unidadUsuario);
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
	var msj=confirm("SACARA ESTE ANIMAL DE LA OFERTA DE ESTA Y TODAS LAS UNIDADES.                   \n\u00BFDESEA CONTINUAR?...");
	if (msj){
		desactivarBotones();
		var parametros = "";
		
		parametros += "codigoVehiculo="+codigoVehiculo;
		parametros += "&fechaMovimiento="+document.getElementById("textFechaVentanaFecha").value;
		
		//alert("baja ---> " + parametros);
		
		var objHttpXMLVehiculos = new AJAXCrearObjeto();
		objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlBajaAnimal.php",true);
		objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		objHttpXMLVehiculos.send(encodeURI(parametros));
		
		objHttpXMLVehiculos.onreadystatechange=function()
		{
			if(objHttpXMLVehiculos.readyState == 4)
			{       
				if (objHttpXMLVehiculos.responseText != "VACIO"){
					alert(objHttpXMLVehiculos.responseText);
					var xml = objHttpXMLVehiculos.responseXML.documentElement;
					for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
						var codigo = xml.getElementsByTagName('resultado')[i].text;
						if (codigo == 1){
							alert('EL ANIMAL FUE DADO DE BAJA ......        ');
							top.leeCaballos(unidadUsuario);
							top.leePerros(unidadUsuario);
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

function guardarFichaCaballo(codigoVehiculo){
	desactivarBotones();
	var validaOk = validarFichaVehiculo();
	
	var codigoVehiculo = document.getElementById("idVehiculo").value;
	if (validaOk){
		if (codigoVehiculo != "") {
			var msj=confirm("ATENCION :\nSE MODIFICARAN LOS DATOS DE ESTE ANIMAL EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) actualizarCaballo(codigoVehiculo);
			//else return false;
			else activarBotones();
		}
		else {
			var msj=confirm("ATENCION :\nSE INGRESARAN LOS DATOS DE ESTE ANIMAL EN LA BASE DE DATOS.          \n\u00BFDESEA CONTINUAR?");
			if (msj) nuevoCaballo();
			//else return false;
			else activarBotones();
		}
	} else {
		activarBotones();
	}
}

function actualizarCaballo(codigoVehiculo){
	
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	
	
	
	//var tipoVehiculo		= document.getElementById("selTipoVehiculo").value;
	
	var estado				= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
	
	var numeroBCU			= document.getElementById("textNumeroBCU").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value; 
	
	var nombre      = document.getElementById("textNombre").value;
	var raza				= document.getElementById("textRaza").value;
	var color				= document.getElementById("selColor").value;
	var pelaje			= document.getElementById("selPelaje").value;
	var tipoAnimal       = document.getElementById("selTipoAnimal").value;
  var verificar = document.getElementById("verificar").value;
	var verificaOculto = document.getElementById("verificaOculto").value;
	
	//alert();			
	var parametros = "";
	
	//parametros += "patente="+patente+"&numeroInstitucional="+numeroInstitucional+"&procedencia="+procedencia;
	//parametros += "&tipoVehiculo="+tipoVehiculo+"&marca="+marca+"&modelo="+modelo;
	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado+"&codigoVehiculo="+codigoVehiculo;
	parametros += "&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado;
	parametros += "&raza="+raza+"&color="+color+"&pelaje="+pelaje+"&nombre="+nombre+"&tipoAnimal="+tipoAnimal;
	parametros += "&verificar="+verificar+"&verificaOculto="+verificaOculto;
	
	//parametros += "&numeroDocumento="+numeroDocumento+"&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado;
	//parametros += "&lugarReparacion="+lugarReparacion;
	//alert(parametros);
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	//objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlActualizaCaballo.php",true);
	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlActualizaCaballo.php",true);
	objHttpXMLVehiculos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLVehiculos.send(encodeURI(parametros));
	
	objHttpXMLVehiculos.onreadystatechange=function()
	{
		if(objHttpXMLVehiculos.readyState == 4)
		{       //alert(objHttpXMLVehiculos.responseText);
				if (objHttpXMLVehiculos.responseText != "VACIO"){
				//alert(objHttpXMLVehiculos.responseText);
				var xml = objHttpXMLVehiculos.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = xml.getElementsByTagName('resultado')[i].text;
					if (codigo == 1){
						 alert('LOS DATOS FUERON INGRESADOS CON EXITO A LA BASE DE DATOS ......        ');
						 document.getElementById("estadoBaseDatos").value = estado;
						// activaFechaNuevoEstado();
						 top.leeCaballos(unidadUsuario);
						 top.leePerros(unidadUsuario);
						 idCargaListadoVehiculos = setInterval("cerrarVentanaVehiculo()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}

}

function nuevoCaballo(){	
	
	var unidadUsuario 		= document.getElementById("unidadUsuario").value;
	var estado				= document.getElementById("selEstado").value;
	var fechaNuevoEstado	= document.getElementById("textFechaNuevoEstado").value;
	
	var numeroBCU			= document.getElementById("textNumeroBCU").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value; 
	
	var nombre      = document.getElementById("textNombre").value;
	var raza				= document.getElementById("textRaza").value;
	var color				= document.getElementById("selColor").value;
	var pelaje			= document.getElementById("selPelaje").value;
	var nacimiento  = document.getElementById("textFechaNacimiento").value;
	var sexo        = document.getElementById("selSexo").value;
	var tipoAnimal       = document.getElementById("selTipoAnimal").value;
	var verificar = document.getElementById("verificar").value;
	var verificaOculto = document.getElementById("verificaOculto").value;
	
	//alert();			
	var parametros = "";
	

	parametros += "&estado="+estado+"&fechaNuevoEstado="+fechaNuevoEstado;
	parametros += "&numeroBCU="+numeroBCU+"&codigoUnidadAgregado="+codigoUnidadAgregado+"&sexo="+sexo;
	parametros += "&raza="+raza+"&color="+color+"&pelaje="+pelaje+"&nombre="+nombre+"&nacimiento="+nacimiento+"&tipoAnimal="+tipoAnimal;
	parametros += "&verificar="+verificar+"&verificaOculto="+verificaOculto;
			

	
	//alert(parametros);
	
	var objHttpXMLVehiculos = new AJAXCrearObjeto();
	objHttpXMLVehiculos.open("POST","./xml/xmlCaballos/xmlNuevoCaballo.php",true);
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
						 top.leeCaballos(unidadUsuario);
						 top.leePerros(unidadUsuario);
						 idCargaListadoVehiculos = setInterval("cerrarVentanaVehiculo()",1000);
					}
					else alert('LOS DATOS NO FUERON INGRESADOS A LA BASE DE DATOS ....		\nCODIGO RECIBIDO : ' + codigo)
				}
			}
		}
	}
}

function validarFichaVehiculo(){

	
	//var tipoVehiculo		 = document.getElementById("selTipoVehiculo").value;
	

	var estado				 = document.getElementById("selEstado").value;
	var fechaEstado			 = document.getElementById("textFechaNuevoEstado").value;
	
	var ultimaFechaEstado	 = document.getElementById("ultimaFecha").value;
	var codigoUnidadAgregado = document.getElementById("codigoUnidadAgregado").value;

	
	var fechaLimite 		= top.document.getElementById("textFechaLimite").value;
	var unidadBloqueada		= top.document.getElementById("textUnidadBloqueada").value;
	
	var color				 = document.getElementById("selColor").value;
	var pelaje				 = document.getElementById("selPelaje").value;
	var sexo				 = document.getElementById("selSexo").value;
	var animal				 = document.getElementById("selTipoAnimal").value;
	
	var codigoVehiculo = document.getElementById("idVehiculo").value; 
	
	var verificaOculto = document.getElementById("verificaOculto").value;
	
		var validaCheck = document.getElementById("verificar");
	
	//alert(lugarReparacion);
	//false;
	


	
	
	
	//if (tipoVehiculo == 0) {
	//	alert("DEBE INDICAR EL TIPO DE VEHICULO ...... 	     ");
	//	document.getElementById("selTipoVehiculo").focus();
	//	return false;
	//}	
	

	
	
	if (estado == 0) {
		alert("DEBE INDICAR EL ESTADO DEL ANIMAL ...... 	     ");
		document.getElementById("selEstado").focus();
		return false;
	}
	
		//if (color == 0) {
		//alert("DEBE INDICAR EL COLOR DEL ANIMAL ...... 	     ");
		//document.getElementById("selColor").focus();
		//return false;
	//}
	
		//if (pelaje == 0) {
		//alert("DEBE INDICAR EL PELAJE DEL ANIMAL ...... 	     ");
		//document.getElementById("selPelaje").focus();
		//return false;
	//}
	
		//if (sexo == 0) {
		//alert("DEBE INDICAR EL SEXO DEL ANIMAL ...... 	     ");
		//document.getElementById("selSexo").focus();
		//return false;
	//}
	
		if (animal == 0) {
		alert("DEBE INDICAR EL TIPO DE ANIMAL ...... 	     ");
		document.getElementById("selTipoAnimal").focus();
		return false;
	}
	
			if (!validaCheck.checked) {
	alert("DEBE VERIFICAR EL ESTADO DEL ANIMAL ...... 	     ");

		return false;	
	}

	
	//alert (document.getElementById("selEstado").value + " != " + document.getElementById("estadoBaseDatos").value);
	//alert (document.getElementById("codigoUnidadAgregado").value + "!=" + document.getElementById("codUnidadAgregadoBaseDatos").value);
	//alert (document.getElementById("selLugarReparacion").value + "!=" + document.getElementById("codLugarReparacionBaseDatos").value);
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value ||
		document.getElementById("codigoUnidadAgregado").value != document.getElementById("codUnidadAgregadoBaseDatos").value){
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
		if (fechaMayor == 1){
			alert("LA FECHA NO PUEDE SER INFERIOR AL " + ultimaFechaEstado);
			return false;
		}
		
		
		if (estado == 3000 && codigoUnidadAgregado == ""){
			alert("DEBE INDICAR UNIDAD A LA QUE EL VEHICULO SE FUE AGREGADO...... 	     ");
			return false;
		}
	}
	
	if(codigoVehiculo !="" && verificaOculto == "SI"){

	     var cantidadServicio = controlEstadoAnimal(codigoVehiculo,fechaEstado,'01-01-3000');
        //alert(cantidadServicio);  
        if(cantidadServicio == 1){
            return false;
        }  
	}
	//alert("ok");
	return true;
}

function activaFechaNuevoEstado(){
	//alert(document.getElementById("selEstado").value);
	//alert(document.getElementById("estadoBaseDatos").value);
	if (document.getElementById("selEstado").value != document.getElementById("estadoBaseDatos").value){
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

function controlEstadoAnimal(codigoVehiculo,fecha1,fecha2){ 
    
    var mensaje="";
    var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	 objHttpXMLFuncionarios.open("POST","./xml/xmlServicios/xmlListaServiciosPorAnimales.php",false);
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
