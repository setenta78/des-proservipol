var JerarquiaBase = 0;
function CrearPrimerArbol(codPadre,perfil){
	var objHttpXML = new AJAXCrearObjeto();
	var div	= document.getElementById("NodosBase");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando ......</td>";
	objHttpXML.open("POST","./xml/xmlArbol/xmlPrimerArbol.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("codPadre="+codPadre+"&perfil="+perfil));
	objHttpXML.onreadystatechange=function(){
		if(objHttpXML.readyState == 4){
			if (objHttpXML.responseText != "VACIO"){
				//alert(objHttpXML.responseText);		
				var xml 		= objHttpXML.responseXML;
				var codigo	= "";
				var nombre		= "";
				var codigoPadre	=	"";
				var jerarquia	= "";
				var especialidad	= "";
			  var cuadrante = "";
				var listado		= "";
				var largo = xml.getElementsByTagName('unidad').length;
				var onClickImg = "";
				var onClickNodo = "";
				var mouse = "onmouseover=\"cambiarClase(this,'resaltar')\" OnMouseOut=\"cambiarClase(this,'nodo')\"";
				var img = "";
				var reg = "";
				for(i=0;i<largo;i++){
					reg = "";
					codigo	 		 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	 		 	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					codigoPadre	 	= (xml.getElementsByTagName('codigoPadre')[i].text||xml.getElementsByTagName('codigoPadre')[i].textContent||"");
					tipo	 				= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					jerarquia	 		= (xml.getElementsByTagName('jerarquia')[i].text||xml.getElementsByTagName('jerarquia')[i].textContent||"");
					especialidad	= (xml.getElementsByTagName('especialidad')[i].text||xml.getElementsByTagName('especialidad')[i].textContent||"");
					cuadrante			= (xml.getElementsByTagName('cuadrante')[i].text||xml.getElementsByTagName('cuadrante')[i].textContent||"");
					
					for(j=0;j<jerarquia;j++){
						if(i+1==largo){
							img = "bottom";
							reg += "0";
						}
						else{
							reg += "1";
						}
					}
					
					if(tipo==0){
						onClickImg = "";
					}
					else{
						onClickImg = "cambiar('"+codigoPadre+"','"+codigo+"','"+nombre+"','"+tipo+"','"+especialidad+"','"+cuadrante+"')";
					}
					onClickNodo = "seleccion('"+codigo+"','"+jerarquia+"','"+reg+"','"+perfil+"')";
					listado += "<div class='nodo' id='"+codigo+"' "+mouse+" >";
					if(tipo==0||tipo==30||tipo==20||tipo==120){
						listado += "<a onClick=\""+onClickNodo+"\">";
						listado += "<img src='img/plus"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img id='Img"+codigo+"' src='img/folder.gif' padding='5' />"+nombre+"</a>";
						listado += "</div><div id='Nodos"+codigo+"' style='DISPLAY: none'>";
					}
					else if(tipo==60  && jerarquia==5){
						listado += "<a>";
						listado += "<img src='img/join"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img src='img/page.gif' />"+nombre+"</a>";
					}					
					else if((tipo==60  && especialidad != 10) && (tipo==60  && especialidad != 31)){
					  listado += "<a onClick=\""+onClickNodo+"\">";
						listado += "<img src='img/plus"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img id='Img"+codigo+"' src='img/folder.gif' padding='5' />"+nombre+"</a></div><div id='Nodos"+codigo+"' style='DISPLAY: none'>";
					}
					else{
						listado += "<a>";
						listado += "<img src='img/join"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img src='img/page.gif' />"+nombre+"</a>";
					}
					listado += "</div>";
				}
				div.innerHTML = listado;
				JerarquiaBase = jerarquia;
			}
			else{
				div.innerHTML = "";
			}
		}
	}
}

function CrearArbol(codPadre,jerarquia,reg,perfil){
	var objHttpXML = new AJAXCrearObjeto();
	var listado		= "";
	var div	= document.getElementById("Nodos"+codPadre);
	var img = document.getElementById("Img"+codPadre);
	var but = "";
	img.src = "img/folderopen.gif";
	img = document.getElementById("nod"+codPadre);
	if((reg.slice(reg.length-1,reg.length))=="0") but = "bottom";
	img.src = "img/minus"+but+".gif";	
	objHttpXML.open("POST","./xml/xmlArbol/xmlArbol.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("codPadre="+codPadre+"&jerarquia="+jerarquia+"&perfil="+perfil));
	objHttpXML.onreadystatechange=function(){
	if(objHttpXML.readyState == 4){
		if (objHttpXML.responseText != "VACIO"){
			//alert(objHttpXML.responseText);
			var xml 		= objHttpXML.responseXML;
			var codigo	= "";
			var nombre		= "";
			var codigoPadre	=	"";
			var jerarquia	= "";
			var especialidad	= "";
			var cuadrante	= "";
			var listado		= "";
			var largo = xml.getElementsByTagName('unidad').length;
			var onClickImg = "";
			var onClickNodo = "";
			var mouse = "";
			var img = "";
			var nreg = reg;
			for(i=0;i<largo;i++){
					var nreg = reg;
					codigo	 		 	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
					nombre	 		 	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
					codigoPadre	 	= (xml.getElementsByTagName('codigoPadre')[i].text||xml.getElementsByTagName('codigoPadre')[i].textContent||"");
					tipo	 				= (xml.getElementsByTagName('tipo')[i].text||xml.getElementsByTagName('tipo')[i].textContent||"");
					jerarquia	 		= (xml.getElementsByTagName('jerarquia')[i].text||xml.getElementsByTagName('jerarquia')[i].textContent||"");
					especialidad	= (xml.getElementsByTagName('especialidad')[i].text||xml.getElementsByTagName('especialidad')[i].textContent||"");
					cuadrante			= (xml.getElementsByTagName('cuadrante')[i].text||xml.getElementsByTagName('cuadrante')[i].textContent||"");
					mouse = "onmouseover=\"cambiarClase(this,'resaltar')\" OnMouseOut=\"cambiarClase(this,'nodo')\"";
					if(i+1==largo){
						img = "bottom";
						nreg += "0";
					}
					else{
						nreg += "1";
					}
					onClickNodo = "seleccion('"+codigo+"','"+jerarquia+"','"+nreg+"','"+perfil+"')";
					if(tipo==0){
						onClickImg = "";
					}	
					else{
						onClickImg = "cambiar('"+codigoPadre+"','"+codigo+"','"+nombre+"','"+tipo+"','"+especialidad+"','"+cuadrante+"')";
					}
					listado += "<div class='nodo' id='"+codigo+"' "+mouse+" >";
					listado += rellenar(jerarquia,nreg);
					
					if(tipo==0||tipo==30||tipo==120||tipo==40){				
						listado += "<a onClick=\""+onClickNodo+"\">";
						listado += "<img src='img/plus"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img id='Img"+codigo+"' src='img/folder.gif' padding='5' />"+nombre+"</a></div><div id='Nodos"+codigo+"' style='DISPLAY: none'>";
					}
					else if(tipo==60  && jerarquia==5){
						listado += "<a>";
						listado += "<img src='img/join"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img src='img/page.gif' />"+nombre+"</a>";
					}					
					else if((tipo==60  && especialidad != 10) && (tipo==60  && especialidad != 31)){
					  listado += "<a onClick=\""+onClickNodo+"\">";
						listado += "<img src='img/plus"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img id='Img"+codigo+"' src='img/folder.gif' padding='5' />"+nombre+"</a></div><div id='Nodos"+codigo+"' style='DISPLAY: none'>";
					}
					else{
						listado += "<a>";
						listado += "<img src='img/join"+img+".gif' id='nod"+codigo+"' /></a>";
						listado += "<a onClick=\""+onClickImg+"\"><img src='img/page.gif' />"+nombre+"</a>";
					}
					listado += "</div>";
			}
			div.innerHTML = listado;
		}
		else{
			document.getElementById("Nodos"+codPadre).style.display="none";
			}
		}
	}
}

function cerrrarNodo(objeto,reg){
	var but = "";
	if((reg.slice(reg.length-1,reg.length))=="0") but="bottom";
	document.getElementById("Nodos"+objeto).innerHTML = "";
	document.getElementById("Nodos"+objeto).style.display="none";
	document.getElementById("Img"+objeto).src = "img/folder.gif";
	document.getElementById("nod"+objeto).src = "img/plus"+but+".gif";
}

function seleccion(codPadre, jerarquia,reg,perfil){
	if(document.getElementById("Nodos"+codPadre).innerHTML==""){
		document.getElementById("Nodos"+codPadre).style.display="block";
		if(jerarquia==0){
			CrearPrimerArbol(reg,perfil);
		}
		else{
			CrearArbol(codPadre,jerarquia,reg,perfil);
		}
	}
	else{
		cerrrarNodo(codPadre,reg);
	}
}

function rellenar(jerarquia,reg){
	var lista = "";
	for(j=JerarquiaBase;j<jerarquia;j++){
		if(reg.slice(j-1,j)=="0"){
			lista += "<img src='img/empty.gif' />";
		}
		else{
			lista += "<img src='img/line.gif' />";
		}
	}
	return lista;
}

function cambiarClase(objeto, clase){
	objeto.className = clase;
}

function cambiar(padre,unidad,nombre,cod,especialidad,cuadrante){
	window.location = ("cambioUnidadL3.php?padre="+padre+"&unidad="+unidad+"&nombre="+nombre+"&CodPerfil="+cod+"&especialidad="+especialidad+"&cuadrante="+cuadrante);
}

function cambiaPrimer(padre,unidad,nombre,especialidad,cuadrante){
	var objHttpXML = new AJAXCrearObjeto();
	var tipo = "";
	objHttpXML.open("POST","./xml/xmlArbol/xmlTipoUnidad.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("codUnidad="+unidad));
	objHttpXML.onreadystatechange=function(){
		if(objHttpXML.readyState == 4){  
			if (objHttpXML.responseText != "VACIO"){
				var xml = objHttpXML.responseXML;
				tipo		= (xml.getElementsByTagName('tipoUnidad')[i].text||xml.getElementsByTagName('tipoUnidad')[i].textContent||"");
				window.location = ("cambioUnidad.php?padre="+padre+"&unidad="+unidad+"&nombre="+nombre+"&CodPerfil="+tipo+"&especialidad="+especialidad+"&cuadrante="+cuadrante);			
			}
		}
	}
}