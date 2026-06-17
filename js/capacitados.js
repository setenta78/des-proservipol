var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionarios(unidad, campo, sentido){
	cargaListadoFuncionarios = 0;
	var codPerfilUsuario = document.getElementById("textPerfilUsuario").value;
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";
	objHttpXMLFuncionarios.open("POST","./xml/xmlCapacitados/xmlListaFuncionarios.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad+"&campo="+campo+"&sentido="+sentido));
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//console.log(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml 							= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 						= "";
				var apellidoPaterno	 				= "";
				var apellidoMaterno	 				= "";
				var nombre2	 						= "";
				var nombre	 						= "";
				var nombreCompleto					= "";
				var grado		 					= "";
				var codigoCargo						= "";
				var cargo		 					= "";
				var codPerfil						= "";
				var descPerfil						= "";
				var unidadAgregado					= "";
				var fechaCargo						= "";
				var fechaCapacitacion				= "";
				var versionProservipol				= "";
				var notaProservipol					= "";
				var certificado						= "";
				var fechaPerfil						= "";
				
				var sw 				 				= 0;
				var fondoLinea		 				= "";
				var resaltarLinea 	 				= "";
				var lineaSinResaltar 				= "";
				var listadoFuncionarios				= "";
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				//alert(xml.getElementsByTagName('funcionario').length);
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 		 	 = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent);
					apellidoPaterno 	 = (xml.getElementsByTagName('apellidoPaterno')[i].text||xml.getElementsByTagName('apellidoPaterno')[i].textContent||"");
					apellidoMaterno		 = (xml.getElementsByTagName('apellidoMaterno')[i].text||xml.getElementsByTagName('apellidoMaterno')[i].textContent||"");
					nombre				 = (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					nombre2				 = (xml.getElementsByTagName('nombre2')[i].text||xml.getElementsByTagName('nombre2')[i].textContent||"");
					nombreCompleto		 = (apellidoPaterno+" "+apellidoMaterno+", "+nombre+" "+nombre2);
					grado		 	 	 = (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					codigoCargo			 = (xml.getElementsByTagName('codigoCargo')[i].text||xml.getElementsByTagName('codigoCargo')[i].textContent||"");
					cargo		 	 	 = (xml.getElementsByTagName('cargo')[i].text||xml.getElementsByTagName('cargo')[i].textContent||"");
					fechaCargo 			 = (xml.getElementsByTagName('cargoFecha')[i].text||xml.getElementsByTagName('cargoFecha')[i].textContent||"");
					codPerfil	 		 = (xml.getElementsByTagName('codigoPerfil')[i].text||xml.getElementsByTagName('codigoPerfil')[i].textContent||"");
					descPerfil 			 = (xml.getElementsByTagName('descripcionPerfil')[i].text||xml.getElementsByTagName('descripcionPerfil')[i].textContent||"");
					unidadAgregado	 	 = (xml.getElementsByTagName('unidadAgregado')[i].text||xml.getElementsByTagName('unidadAgregado')[i].textContent||"");
					CodUnidadAgregado	 = (xml.getElementsByTagName('CodUnidadAgregado')[i].text||xml.getElementsByTagName('CodUnidadAgregado')[i].textContent||"");
					fechaCapacitacion	 = (xml.getElementsByTagName('fechaCapacitacion')[i].text||xml.getElementsByTagName('fechaCapacitacion')[i].textContent||"");
					versionProservipol	 = (xml.getElementsByTagName('versionProservipol')[i].text||xml.getElementsByTagName('versionProservipol')[i].textContent||"");
					notaProservipol 	 = (xml.getElementsByTagName('notaProservipol')[i].text||xml.getElementsByTagName('notaProservipol')[i].textContent||"");
					codVerificacion 	 = (xml.getElementsByTagName('codVerificacion')[i].text||xml.getElementsByTagName('codVerificacion')[i].textContent||"");
					fechaPerfil			 = (xml.getElementsByTagName('fechaPerfil')[i].text||xml.getElementsByTagName('fechaPerfil')[i].textContent||"");
					
					certificado			 = (codVerificacion) ? '<a href="./imprimible/capacitacion/certificadoAprobacion.php?codVerificacion='+codVerificacion+'" target="_blank">  <img src="img/certificado.png" width=20 height=20 > </a>' : '<img src="img/rechazado.png" width=20 height=20 >';
					
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
					if(codPerfilUsuario==80||codPerfilUsuario==90){
						var dblClick = "abrirVentanaAsignacionClave('"+codigo+"','"+nombreCompleto+"','"+grado+"','"+versionProservipol+"','"+fechaCapacitacion+"','"+codPerfil+"','"+descPerfil+"','"+codigoCargo+"','"+fechaCargo+"','"+CodUnidadAgregado+"')";
					}
					else{
						var dblClick = "";
					}
					
					if (unidadAgregado != "") cargo += ", "+unidadAgregado;
					
					if (cargo.length > 39) {
						var cargoMuestra = cargo.substr(0,37) + " ...";
						var mostrarEtiqueta = " title='"+cargo+"'";
					} else {
						var cargoMuestra = cargo;
						var mostrarEtiqueta = "";
					}
					
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
					listadoFuncionarios += "<td width='3%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='7%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='16%'><div id='valorColumna'>"+nombreCompleto+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
					listadoFuncionarios += "<td width='14%' align='left'"+mostrarEtiqueta+"><div id='valorColumna'>"+cargoMuestra+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+fechaCapacitacion+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+versionProservipol+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><div id='valorColumna'>"+notaProservipol+"</div></td>";
					listadoFuncionarios += "<td width='7%' align='center'><div id='valorColumna'>"+descPerfil+"</div></td>";
					listadoFuncionarios += "<td width='9%' align='center'><div id='valorColumna'>"+fechaPerfil+"</div></td>";
					listadoFuncionarios += "<td width='5%' align='center'><div id='valorColumna'>"+certificado+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;
			}
		}
	}
}

function cambiaOrdenLista(columna, atributo, sentido, unidad){
	var nuevoSentido = "";  
	if (sentido == "desc") nuevoSentido = "asc"; 
	if (sentido == "asc")  nuevoSentido = "desc";
	cambiarClase(columna,'nombreColumna_Click');
	leeFuncionarios(unidad, atributo, sentido);
	
	switch(atributo){
		case "grado": 
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColGrado").innerHTML  = "GRADO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colGrado").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "nombre":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColNombre").innerHTML = "NOMBRE&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNombre").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
			
		case "codigo":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColCodigo").innerHTML = "CODIGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCodigo").onmousedown  = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "cargo":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColCargo").innerHTML  = "CARGO&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCargo").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "fecha":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColFecha").innerHTML  = "FECHA CAPACITACI&Oacute;N&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFecha").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "version":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML  = "VERSI&Oacute;N PROSERVIPOL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colVersion").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "nota":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColNota").innerHTML  = "NOTA PROSERVIPOL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colNota").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		
		case "capacitado":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColFechaPerfil").innerHTML = "FECHA ASIGNACI&Oacute;N";
			document.getElementById("labColCapacitado").innerHTML  = "PERFIL&nbsp;<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colCapacitado").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
		case "fechaPerfil":
			document.getElementById("labColGrado").innerHTML  = "GRADO";
			document.getElementById("labColNombre").innerHTML = "NOMBRE";
			document.getElementById("labColCodigo").innerHTML = "CODIGO";
			document.getElementById("labColCargo").innerHTML = "CARGO";
			document.getElementById("labColFecha").innerHTML = "FECHA CAPACITACI&Oacute;N";
			document.getElementById("labColVersion").innerHTML = "VERSI&Oacute;N PROSERVIPOL";
			document.getElementById("labColNota").innerHTML = "NOTA PROSERVIPOL";
			document.getElementById("labColCapacitado").innerHTML = "PERFIL";
			document.getElementById("labColFechaPerfil").innerHTML  = "FECHA ASIGNACI&Oacute;N<img src='./img/"+sentido+"_order.gif'>";
			document.getElementById("colFechaPerfil").onmousedown   = function(){cambiaOrdenLista(columna, atributo, nuevoSentido, unidad)};
			break;
	}
	idCargaListadoFuncionarios = setInterval("tituloColumnaNormal("+columna.id+")",500);
}

function tituloColumnaNormal(columna){
	if (cargaListadoFuncionarios == 1){
		clearInterval(idCargaListadoFuncionarios);
		cambiarClase(columna,'nombreColumna');
	}
}

function abrirVentanaAsignacionClave(codFuncionario,nombre,grado,version,fecha,codPerfil,descPerfil,codCargo,fechaCargo,unidadAgregado){
	var titulo = "ADMINISTRADOR DE CLAVES DE ACCESO";
	var ancho  = 700;
	var alto   = 250;
	var pagina = "fichaAsignacionClave.php";
	var estado = "true";
	var posX   = 180;
	var posY   = 360;
	var parametros = "codFuncionario="+codFuncionario+"&nombre="+nombre+"&grado="+grado+"&version="+version+"&fecha="+fecha+"&codPerfil="+codPerfil+"&descPerfil="+descPerfil+"&codCargo="+codCargo+"&fechaCargo="+fechaCargo+"&unidadAgregado="+unidadAgregado;
	pagina = pagina+"?"+parametros;
	abrirVentana(titulo, ancho, alto, pagina, '', estado, posX, posY);
}

function cambiarPerfil(tipo){
	var mensaje = "";
	var boton 	= "";
	var fecha		= document.getElementById("txtfecha").value;
	var perfil 	= document.getElementById("selPerfil").value;
	var fechaCargo	 = document.getElementById("textFechaCargo").value;
	var perfilActual = document.getElementById("textPerfilActual").value;
	var agregado = document.getElementById("unidadAgregado").value;
	var titulares = document.getElementById("titulares").value;

	if(titulares>=1&&perfil==10&&tipo!='borrar'){
		alert("NO PUEDE TENER M\u00C1S DE UN USUARIO TITULAR");
		return false;
	}
	
	var parts = fecha.split("-");
  	var fechaD = new Date(parts[2], parts[1]-1, parts[0]);
	parts = fechaCargo.split("-");
  	var fechaCargoD = new Date(parts[2], parts[1]-1, parts[0]);
	
/*---- AL PRESIONAR BORRAR PERFIL ----*/
	if(tipo=="borrar"){
		mensaje = "SE PROCEDER\u00C1 A ELIMINAR EL PERFIL DEL USUARIO, POR LO QUE ESTE YA NO PODRA INGRESAR AL SISTEMA PROSERVIPOL<br>\u00BFDESEA CONTINUAR?";
		boton = "borrarPerfil()";
	}
/*---- AL PRESIONAR CAMBIAR PERFIL ----*/
	/*---- USUARIOS SIN ELEGIR EL TIPO DE PERFIL O EL MISMO ----*/
	else if(tipo=="cambiar"&&perfilActual==perfil){
		document.getElementById("selPerfil").focus();
		alert("DEBE ELEGIR EL TIPO DE PERFIL QUE ASIGNAR\u00C1 AL FUNCIONARIO");
		return false;
	}
	/*---- USUARIOS AGREGADOS NO PUEDEN TENER PERFIL TITULAR ----*/
	else if(tipo=="cambiar"&&perfilActual==0&&perfil==10&&agregado!=''){
		document.getElementById("selPerfil").focus();
		alert("LOS FUNCIONARIOS AGREGADOS NO PUEDEN POSEER PERFIL DE USUARIO TITULAR");
		return false;
	}
	/*---- NUEVO USUARIO CON PERFIL TITULAR ----*/
	else if(tipo=="cambiar"&&perfilActual==0&&perfil==10){
		mensaje = "SE PROCEDER\u00C1 A CREAR EL PERFIL DEL USUARIO, QUEDANDO ESTE FUNCIONARIO COMO CARGO DE ENCARGADO DE PROSERVIPOL<br>\u00BFDESEA CONTINUAR?";
		boton = "asignarPerfil()";
	}
	/*---- NUEVO USUARIO CON PERFIL SUPLENTE ----*/
	else if(tipo=="cambiar"&&perfilActual==0&&perfil==20){
		mensaje = "SE PROCEDER\u00C1 A CREAR EL PERFIL DEL USUARIO, QUEDANDO ESTE FUNCIONARIO COMO SUPLENTE<br>\u00BFDESEA CONTINUAR?";
		boton = "asignarPerfil()";
	}
	/*---- USUARIO CON PERFIL Y SIN ELEGIR PERFIL ----*/
	else if(tipo=="cambiar"&&perfil==0){
		document.getElementById("selPerfil").focus();
		alert("DEBE ELEGIR EL TIPO DE PERFIL QUE ASIGNAR\u00C1 AL FUNCIONARIO");
		return false;
	}
	/*---- USUARIO CON PERFIL TITULAR QUE CAMBIA A SUPLENTE ----*/
	else if(tipo=="cambiar"&&perfilActual==10){
		mensaje = "SE PROCEDER\u00C1 A CAMBIAR EL PERFIL DEL USUARIO, QUEDANDO ESTE FUNCIONARIO COMO SUPLENTE<br>\u00BFDESEA CONTINUAR?";
		boton = "asignarPerfil()";
	}
	/*---- USUARIO CON PERFIL SUPLENTE QUE CAMBIA A TITULAR ----*/
	else if(tipo=="cambiar"&&perfilActual==20){
		mensaje = "SE PROCEDER\u00C1 A CAMBIAR EL PERFIL DEL USUARIO, QUEDANDO ESTE FUNCIONARIO COMO CARGO DE ENCARGADO DE PROSERVIPOL<br>\u00BFDESEA CONTINUAR?";
		boton = "asignarPerfil()";
	}
	
	if(fecha==""&&(perfil==10||perfilActual==10)){
		document.getElementById("txtfecha").focus();
		alert("INDIQUE LA FECHA DE ASIGNACI\u00D3N");
		return false;
	}
	
	if(fechaD<fechaCargoD){
		document.getElementById("txtfecha").focus();
		alert("LA FECHA DE LA ASIGNACI\u00D3N NO PUEDE SER MENOR A LA FECHA DEL CARGO ACTUAL EL FUNCIONARIO");
		return false;
	}
	
	document.getElementById("btnAceptar").innerHTML 				= "<input type='button' id='btn100' value='ACEPTAR' onClick='"+boton+"'>";
	document.getElementById("txtMensaje").innerHTML					= mensaje;
	document.getElementById("cubreVentana").style.display 	 		= "";
	document.getElementById("ventanaCambiaPerfil").style.display	= "";
	document.getElementById("usuarioBotonModificar").disabled 		= "true";
	document.getElementById("usuarioBotonBorrar").disabled 			= "true";
	document.getElementById("usuarioBotonCerrar").disabled 			= "true";
}

function cerrarCambiarPerfil(){
	document.getElementById("cubreVentana").style.display 	 			= "none";
	document.getElementById("ventanaCambiaPerfil").style.display	= "none";
	document.getElementById("usuarioBotonModificar").disabled 		= "";
	document.getElementById("usuarioBotonBorrar").disabled 				= "";
	document.getElementById("usuarioBotonCerrar").disabled 			 	= "";
}

function validaCambiarPerfil(){
	document.getElementById("ventanaCambiaPerfil").style.display 				= "none";
	document.getElementById("ventanaValidaCambioPerfil").style.display 	= "";
}

function cerrarValidaCambiarPerfil(){
	document.getElementById("cubreVentana").style.display 	 						= "none";
	document.getElementById("ventanaValidaCambioPerfil").style.display	= "none";
	document.getElementById("usuarioBotonModificar").disabled 					= "";
	document.getElementById("usuarioBotonBorrar").disabled 							= "";
	document.getElementById("usuarioBotonCerrar").disabled 			 				= "";
}

function borrarPerfil(){
	var contrasena		= document.getElementById("contrasena").value;
	var claveIngresada	= document.getElementById("textClave").value;
	if(contrasena==claveIngresada){
		borrarUsuario();
	}
	else{
		alert("CONTRASE�A INCORRECTA");
		document.getElementById("textClave").value = "";
		document.getElementById("textClave").focus();
	}
}

function asignarPerfil(){
	var contrasena 		 = document.getElementById("contrasena").value;
	var claveIngresada = document.getElementById("textClave").value;
	var perfil 				 = document.getElementById("selPerfil").value;
	var perfilActual 	 = document.getElementById("textPerfilActual").value;
	if(contrasena==claveIngresada){
		if(perfilActual==0) crearUsuario();
		else modificarUsuario();
	}
	else{
		alert("CONTRASE�A INCORRECTA");
		document.getElementById("textClave").value = "";
		document.getElementById("textClave").focus();
	}
}

function borrarUsuario(){
	var codFuncionario	= document.getElementById("textcodFuncionario").value;
	var codPerfil 		= document.getElementById("selPerfil").value;
	var fecha			= document.getElementById("txtfecha").value;
	var unidadUsuario	= document.getElementById("codigoUnidad").value;
	var parametros 		= "codFuncionario="+codFuncionario+"&codPerfil="+codPerfil+"&fecha="+fecha;
	//alert(parametros);
	var objHttpXMLUsuario = new AJAXCrearObjeto();
	objHttpXMLUsuario.open("POST","./xml/xmlCapacitados/xmlBorrarUsuario.php",true);
	objHttpXMLUsuario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUsuario.send(encodeURI(parametros));
	objHttpXMLUsuario.onreadystatechange=function(){
		if(objHttpXMLUsuario.readyState == 4){
		//alert(objHttpXMLUsuario.responseText);
			if(objHttpXMLUsuario.responseText != "VACIO"){
			//alert(objHttpXMLUsuario.responseText);
			var xml = objHttpXMLUsuario.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('LA CUENTA DE USUARIO SE HA ELIMINADO ......        ');
						top.leeFuncionarios(unidadUsuario,'','');
						//idCargaListadoFuncionarios = setInterval("top.cerrarVentana('ventanaUsuario')",1000);
						top.cerrarVentana('ventanaUsuario');
					}
					else alert('NO SE HA PODIDO ELIMINAR LA CUENTA DEL USUARIO INDICADA ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function crearUsuario(){
	var codFuncionario = document.getElementById("textcodFuncionario").value;
	var codPerfil 		 = document.getElementById("selPerfil").value;
	var fecha					 = document.getElementById("txtfecha").value;
	var parametros 		 = "codFuncionario="+codFuncionario+"&codPerfil="+codPerfil+"&fecha="+fecha;
	var unidadUsuario	 = document.getElementById("codigoUnidad").value;
	//alert(parametros);
	var objHttpXMLUsuario = new AJAXCrearObjeto();
	objHttpXMLUsuario.open("POST","./xml/xmlCapacitados/xmlCrearUsuario.php",true);
	objHttpXMLUsuario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUsuario.send(encodeURI(parametros));
	objHttpXMLUsuario.onreadystatechange=function(){
		if(objHttpXMLUsuario.readyState == 4){
		//alert(objHttpXMLUsuario.responseText);
			if(objHttpXMLUsuario.responseText != "VACIO"){
			//alert(objHttpXMLUsuario.responseText);
			var xml = objHttpXMLUsuario.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if(codigo == 1){
						alert('SE HA CREADO LA CUENTA DE USUARIO INDICADA, RECUERDE PARA ACCEDER DEBE INGRESAR CODIGO FUNCIONARIO Y LOS 4 PRIMEROS DIGITOS DEL CODIGO COMO CONTRASE�A ......        ');
						top.leeFuncionarios(unidadUsuario,'','');
						//idCargaListadoFuncionarios = setInterval("top.cerrarVentana('ventanaUsuario')",1000);
						top.cerrarVentana('ventanaUsuario');
					}
					else alert('NO SE HA PODIDO CREAR LA CUENTA DE USUARIO ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function modificarUsuario(){
	var codFuncionario = document.getElementById("textcodFuncionario").value;
	var codPerfil 		 = document.getElementById("selPerfil").value;
	var fecha			 		 = document.getElementById("txtfecha").value;
	var unidadUsuario	 = document.getElementById("codigoUnidad").value;
	var parametros 		 = "codFuncionario="+codFuncionario+"&codPerfil="+codPerfil+"&fecha="+fecha;
	//alert(parametros);
	var objHttpXMLUsuario = new AJAXCrearObjeto();
	objHttpXMLUsuario.open("POST","./xml/xmlCapacitados/xmlModificarUsuario.php",true);
	objHttpXMLUsuario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUsuario.send(encodeURI(parametros));
	objHttpXMLUsuario.onreadystatechange=function(){
		if(objHttpXMLUsuario.readyState == 4){
		//alert(objHttpXMLUsuario.responseText);
			if(objHttpXMLUsuario.responseText != "VACIO"){
			//alert(objHttpXMLUsuario.responseText);
			var xml = objHttpXMLUsuario.responseXML.documentElement;
				for(i=0;i<xml.getElementsByTagName('resultado').length;i++){
					var codigo = (xml.getElementsByTagName('resultado')[i].text||xml.getElementsByTagName('resultado')[i].textContent||"");
					if (codigo == 1){
						alert('SE HA MODIFICADO EL PERFIL DEL USUARIO INDICADO ......        ');
						top.leeFuncionarios(unidadUsuario,'','');
						//idCargaListadoFuncionarios = setInterval("top.cerrarVentana('ventanaUsuario')",1000);
						top.cerrarVentana('ventanaUsuario');
					}
					else alert('NO SE HA PODIDO MODIFICAR LA CUENTA DE USUARIO INDICADA ....		\nCODIGO RECIBIDO : ' + codigo);
				}
			}
		}
	}
}

function habilitaFecha(){
	var codPerfil 	 = document.getElementById("selPerfil").value;
	var perfilActual = document.getElementById("textPerfilActual").value;
	
	if(codPerfil==10||perfilActual==10){
		document.getElementById("txtfecha").disabled = false;
		document.getElementById("idFechaServicio").disabled = false;
	}
	else{
		document.getElementById("txtfecha").disabled = true;
		document.getElementById("idFechaServicio").disabled = true;
	}
}

function maximoUsuario(){
	var unidadUsuario	 = document.getElementById("codigoUnidad").value;
	var parametros 		 = "unidadUsuario="+unidadUsuario;
	//alert(parametros);
	var objHttpXMLUsuario = new AJAXCrearObjeto();
	objHttpXMLUsuario.open("POST","./xml/xmlCapacitados/xmlCantidadUsuarios.php",true);
	objHttpXMLUsuario.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLUsuario.send(encodeURI(parametros));
	objHttpXMLUsuario.onreadystatechange=function(){
		if(objHttpXMLUsuario.readyState == 4){
		//alert(objHttpXMLUsuario.responseText);
			if(objHttpXMLUsuario.responseText != "VACIO"){
				//alert(objHttpXMLUsuario.responseText);
				var xml 		 = objHttpXMLUsuario.responseXML.documentElement;
				var titular	 = "";
				var suplente = "";
				
				for(i=0;i<xml.getElementsByTagName('usuarios').length;i++){
					titular  = (xml.getElementsByTagName('titular')[i].text||xml.getElementsByTagName('titular')[i].textContent||"");
					suplente = (xml.getElementsByTagName('suplente')[i].text||xml.getElementsByTagName('suplente')[i].textContent||"");
					
					titular  = parseInt(titular);
					suplente = parseInt(suplente);
					document.getElementById("titulares").value = titular;
					document.getElementById("suplentes").value = suplente;
				}
			}
		}
	}
}

function cargoPorDefinir(unidad){
	
	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	objHttpXMLFuncionarios.open("POST","./xml/xmlCapacitados/xmlCargoPorDefinir.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad)); 
	
	objHttpXMLFuncionarios.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4){
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO"){
				//alert(objHttpXMLFuncionarios.responseText);
				var xml = objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo = "";
				var grado  = "";
				var nombre = "";
				var ListaFuncionarios = "";
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					codigo = (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					grado  = (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
					nombre = (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					ListaFuncionarios += codigo+" - "+grado+"  "+nombre+"\n";
				}
				
				if (ListaFuncionarios != "") {
					var mensajeEstados = "EXISTEN FUNCIONARIO SIN CARGO DEFINIDO, DEBE REGULARIZAR SU SITUACI\u00D3N ANTES DE PROSEGUIR:\n\n"+ListaFuncionarios;
					alert(mensajeEstados);
					self.location.href='personal.php';
				}
			}
		}
	}
}