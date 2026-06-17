var codigo	=	"";
var nombre	= "";
var grado		= "";

function Solicitud_Funcionario(Cadena){
	var objHttpXML = new AJAXCrearObjeto();
	var Btexto = Cadena;
	var div	= document.getElementById("lista");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando ......</td>";
	objHttpXML.open("POST","./xml/xmlListaFuncionarios.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("codigo="+Btexto)); 
	objHttpXML.onreadystatechange=function(){
		if(objHttpXML.readyState == 4){
			if (objHttpXML.responseText != "VACIO"){
				var xml 							= objHttpXML.responseXML.documentElement;
				var unidad						= "";
				var sw 				 				= 0;
				var fondoLinea		 		= "";
				var resaltarLinea 		= "";
				var lineaSinResaltar 	= "";
				var listado						= "";
				var largo = xml.getElementsByTagName('funcionario').length;
				listado = "<table width='100%' cellspacing='1' cellpadding='1'>";
				listado += "<tr>";
					listado += "<td width='4%' align='center' id='nombreColumna'>No.</td>";
					listado += "<td width='10%' align='center' id='nombreColumna'>Codigo Funcionario</td>";
					listado += "<td width='28%' align='center' id='nombreColumna'>Nombre</td>";
					listado += "<td width='20%' align='center' id='nombreColumna'>Grado</td>";
					listado += "<td width='38%' align='center' id='nombreColumna'>Unidad</td>";
				listado += "</tr>";
				for(i=0;i<largo;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					if(i<20){
						codigo	= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
						nombre	= (xml.getElementsByTagName('nombre')[i].text||xml.getElementsByTagName('nombre')[i].textContent||"");
						grado		= (xml.getElementsByTagName('grado')[i].text||xml.getElementsByTagName('grado')[i].textContent||"");
						unidad	= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");		
						resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
						lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";							
						var nroLinea = i + 1;
						var dblClick = "javascript:mostarFechas('listaFechas','textCodigoFuncionario','"+codigo+"')";							
						listado += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' onDblClick=\""+dblClick+"\">";
						if(largo>1){
							listado += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
						}
						else{
							listado += "<td width='4%' align='center'><div id='valorColumna'></div></td>";
						}
						listado += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
						listado += "<td width='38%' align='center'><div id='valorColumna'>"+nombre+"</div></td>";
						listado += "<td width='20%' align='center'><div id='valorColumna'>"+grado+"</div></td>";
						listado += "<td width='28%' align='center'><div id='valorColumna'>"+unidad+"</div></td>";
						listado += "</tr>";
					}
					else{
						listado += "<tr><td width='4%' align='center'><div id='valorColumna'>.......</div></td>";
						listado += "<td width='10%' align='center'><div id='valorColumna'>.......</div></td>";
						listado += "<td width='28%' align='center'><div id='valorColumna'>.......</div></td>";
						listado += "<td width='20%' align='center'><div id='valorColumna'>.......</div></td>";
						listado += "<td width='38%' align='center'><div id='valorColumna'>.......</div></td>";
						listado += "</tr>";
					}
				}
				listado += "</table>";
				div.innerHTML = listado;
			}
		}
	}
}

function Solicitud_Fecha(Codigo){
	var objHttpXML = new AJAXCrearObjeto();
	var div	= document.getElementById("listaFechas");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando ......</td>";
	objHttpXML.open("POST","./xml/xmlListaFechas.php",true);
	objHttpXML.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXML.send(encodeURI("codigo="+Codigo));
	objHttpXML.onreadystatechange=function(){
		if(objHttpXML.readyState == 4){
			if (objHttpXML.responseText != "VACIO"){
				var xml 				= objHttpXML.responseXML.documentElement;
  			var correlativo	= "";
				var cargo				= "";
				var unidad			= "";
				var fechaD			= "";
				var fechaH			= "";
				var sw 				 				= 0;
				var fondoLinea		 		= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar	= "";
				var listado						= "";
				var largo 						= xml.getElementsByTagName('fechas').length;
				listado = "<table width='100%' cellspacing='1' cellpadding='1'>";
				listado += "<tr>";
					listado += "<td width='5%' align='center' id='nombreColumna'>Correlativo</div></td>";
					listado += "<td width='25%' align='center' id='nombreColumna'>Cargo</div></td>";
					listado += "<td width='26%' align='center' id='nombreColumna'>Unidad</div></td>";
					listado += "<td width='17%' align='center' id='nombreColumna'>Fecha Desde</div></td>";
					listado += "<td width='17%' align='center' id='nombreColumna'>Fecha Hasta</div></td>";
					listado += "<td width='10%' align='center' id='nombreColumna'></div></td>";
				listado += "</tr>";
				for(i=0;i<largo;i++){
					codigo	 		 	= (xml.getElementsByTagName('codigo_fecha')[i].text||xml.getElementsByTagName('codigo_fecha')[i].textContent||"");
					correlativo	  = (xml.getElementsByTagName('correlativo')[i].text||xml.getElementsByTagName('correlativo')[i].textContent||"");
					cargo					= (xml.getElementsByTagName('cargo')[i].text||xml.getElementsByTagName('cargo')[i].textContent||"");
					unidad				= (xml.getElementsByTagName('unidad')[i].text||xml.getElementsByTagName('unidad')[i].textContent||"");
					fechaD	 		 	= (xml.getElementsByTagName('fechaD')[i].text||xml.getElementsByTagName('fechaD')[i].textContent||"");
					fechaH	 		 	= (xml.getElementsByTagName('fechaH')[i].text||xml.getElementsByTagName('fechaH')[i].textContent||"");
					bloqueado		 	= (xml.getElementsByTagName('bloqueado')[i].text||xml.getElementsByTagName('bloqueado')[i].textContent||"");
					if(sw==0){
						fondoLinea = (bloqueado==1) ? "lineaDesactivada1" : "linea1";
						sw =1;
					}
					else {
						fondoLinea = (bloqueado==1) ? "lineaDesactivada2" : "linea2";
						sw=0;
					}
					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					var nroLinea = i + 1;
					var botonEliminar = (bloqueado==1) ? "" : "<input type='button' value='Eliminar ⇓' onclick=\"eliminarRegistro('"+codigo+"','"+fechaD+"','"+correlativo+"')\" />";
					listado += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' >";
						listado += "<td width='5%' align='center'><div id='valorColumna'>"+correlativo+"</div></td>";
						listado += "<td width='25%' align='center'><div id='valorColumna'>"+cargo+"</div></td>";
						listado += "<td width='26%' align='center'><div id='valorColumna'>"+unidad+"</div></td>";
						listado += "<td width='17%' align='center'><div id='valorColumna'>"+fechaD+"</div></td>";
						listado += "<td width='17%' align='center'><div id='valorColumna'>"+fechaH+"</div></td>";
						listado += "<td width='10%' align='center'><div id='valorColumna'>"+botonEliminar+"</div></td>";
					listado += "</tr>";
				}
				listado += "</table>";
				div.innerHTML = listado;
			}
		}
	}
}

function autocompletar(idContenido,idFechas,Cadena){
	if(Cadena.length>=1)
	{
		document.getElementById(idContenido).style.display="block";
		Solicitud_Funcionario(Cadena);
	}else
		document.getElementById(idContenido).style.display="none";
		document.getElementById(idFechas).style.display="none";
}

function mostarFechas(idFechas,idValor,Codigo){
  	document.getElementById(idValor).value=Codigo;
		document.getElementById(idFechas).style.display="block";
		Solicitud_Funcionario(Codigo);
		Solicitud_Fecha(Codigo);
}

function cambiarClase(objeto, clase){
	objeto.className = clase;
}
