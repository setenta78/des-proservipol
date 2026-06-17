var cargaListadoFuncionarios;
var idCargaListadoFuncionarios;

function leeFuncionarios(unidad){
	cargaListadoFuncionarios = 0;

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
	var div	= document.getElementById("listadoFuncionarios");
	div.innerHTML = "<table><tr><td><img src='./img/ajax_loader.gif'></td><td>&nbsp;Cargando Funcionarios ......</td>";
    
	objHttpXMLFuncionarios.open("POST","./xml/xmlFuncionarios/xmlListaFuncionariosComparar.php",true);
	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLFuncionarios.send(encodeURI("codigoUnidad="+unidad));  
	
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
			//alert(objHttpXMLFuncionarios.responseText);
			if (objHttpXMLFuncionarios.responseText != "VACIO")
			{
			
			if (objHttpXMLFuncionarios.responseText == "UNIDAD")
			{
        //alert("ERROR ASIGNACION UNIDAD.  CONTACTAR SOPORTE PROSERVIPOL.");
        //div.innerHTML = "ERROR ASIGNACION UNIDAD.  CONTACTAR SOPORTE PROSERVIPOL."
        div.innerHTML = "."
			}

			if (objHttpXMLFuncionarios.responseText == "CONEXION")
			{
        //alert("ERROR CONEXION BASE DE DATOS DE PERSONAL.  CONTACTAR SOPORTE PROSERVIPOL.");
        //div.innerHTML = "ERROR CONEXION BASE DE DATOS DE PERSONAL.  CONTACTAR SOPORTE PROSERVIPOL."
         div.innerHTML = "."
			}


			if (objHttpXMLFuncionarios.responseText == "RELACION")
			{
        //alert("ERROR ASIGNACION CODIGO UNIDAD.  CONTACTAR SOPORTE PROSERVIPOL.");
        //div.innerHTML = "ERROR ASIGNACION CODIGO UNIDAD.  CONTACTAR SOPORTE PROSERVIPOL."
         div.innerHTML = "."
			}

		
			else
			{
				//alert(objHttpXMLFuncionarios.responseText);		
				var xml 				= objHttpXMLFuncionarios.responseXML.documentElement;
				var codigo	 			= "";
				var nombre	 			= "";
				var apellidoPaterno	 			= "";
				var apellidoMaterno	 			= "";
				var grado		 		= "";
				var observacion		 		= "";
						
				var sw 				 	= 0;
				var fondoLinea		 	= "";
				var resaltarLinea 	 	= "";
				var lineaSinResaltar 	= "";
				var listadoFuncionarios	= "";
				
				
				listadoFuncionarios = "<table width='100%' cellspacing='1' cellpadding='1'>";
				
				//if(xml.getElementsByTagName('funcionario').length>10)
				//{
        //  alert("EL NUMERO DE FUNCIONARIOS QUE PRESENTAN DIFERENCIAS EN LA ASIGNACION PODRIA INDICAR QUE EXISTE ANOMALIAS EN SU DOTACIÓN.\n\nSI CONSIDERA QUE LOS DATOS DESPLEGADOS SON ERRONEOS CONTACTAR AL DEPTO. PERSONAL P7.");
				//}
				
				
				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++){
					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}

          //if(xml.getElementsByTagName('codigo')[i].hasChildNodes()) {codigo=xml.getElementsByTagName('codigo')[i].firstChild.nodeValue;}

          //nombre="";
          //if(xml.getElementsByTagName('nombre')[i].hasChildNodes()) {nombre=xml.getElementsByTagName('nombre')[i].firstChild.nodeValue;}
          //if(xml.getElementsByTagName('apellidoPaterno')[i].hasChildNodes()) {apellidoPaterno=xml.getElementsByTagName('apellidoPaterno')[i].firstChild.nodeValue;}
          //if(xml.getElementsByTagName('apellidoMaterno')[i].hasChildNodes()) {apellidoMaterno=xml.getElementsByTagName('apellidoMaterno')[i].firstChild.nodeValue;}

          //nombre=apellidoPaterno+" "+apellidoMaterno+" "+nombre;
          
          //if(xml.getElementsByTagName('grado')[i].hasChildNodes()) {grado=xml.getElementsByTagName('grado')[i].firstChild.nodeValue;}
          //if(xml.getElementsByTagName('observacion')[i].hasChildNodes()) {observacion=xml.getElementsByTagName('observacion')[i].firstChild.nodeValue;}
          
          codigo	 	    	 = xml.getElementsByTagName('codigo')[i].text;
					nombre	 		     = xml.getElementsByTagName('apellidoPaterno')[i].text + " " + xml.getElementsByTagName('apellidoMaterno')[i].text + " " + xml.getElementsByTagName('nombre')[i].text + " " + xml.getElementsByTagName('nombre2')[i].text;
					grado		 	       = xml.getElementsByTagName('grado')[i].text;
          observacion 		 = xml.getElementsByTagName('observacion')[i].text; 
										
										
					resaltarLinea 	 = "";
					lineaSinResaltar = "";

					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";
					
					var nroLinea = i + 1;
				
					listadoFuncionarios += "<tr id='"+nroLinea+"' OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"'>";
					listadoFuncionarios += "<td width='4%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoFuncionarios += "<td width='10%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoFuncionarios += "<td width='28%'><div id='valorColumna'>"+nombre+"</div></td>";
					listadoFuncionarios += "<td width='20%' align='left'><div id='valorColumna'>"+grado+"</div></td>";
					listadoFuncionarios+= "<td width='38%' align='left'><div id='valorColumna'>"+observacion+"</div></td>";
					listadoFuncionarios += "</tr>";
				}
				listadoFuncionarios += "</table>";
				//alert(listadoFuncionarios);
				div.innerHTML = listadoFuncionarios;
				cargaListadoFuncionarios = 1;


}//FIN VALIDACION UNIDAD
			}
		}
	}
}



