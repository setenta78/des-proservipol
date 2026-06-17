
function evaluarTallerPractica(funcionario){

	var objHttpXMLTaller = new AJAXCrearObjeto();
	var parametros = "codigoFuncionanario="+funcionario;
	var div	= document.getElementById("popup-contenedor");
  //alert(parametros);
	objHttpXMLTaller.open("POST","./xml/xmlTaller/xmlTallerPractica.php",true);
	objHttpXMLTaller.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTaller.send(encodeURI(parametros)); 
	
	objHttpXMLTaller.onreadystatechange=function()
	{
		//alert(objHttpXMLTaller.readyState);
		if(objHttpXMLTaller.readyState == 4)
		{       
			//alert(objHttpXMLTaller.responseText);
			if (objHttpXMLTaller.responseText != "VACIO"){
				//alert(objHttpXMLTaller.responseText);		
				var xml 						= objHttpXMLTaller.responseXML.documentElement;
				var codFuncionario	= "";
				var act1						= "";
				var act2						= "";
				var	act3						= "";
				var	act4						= "";
				var	act5						= "";
				var	act1Desc				= "";
				var	act2Desc				= "";
				var	act3Desc				= "";
				var	act4Desc				= "";
				var	act5Desc				= "";
				var	actTotal				= "";
				var contenido				= "";
									
				for(i=0;i<xml.getElementsByTagName('taller').length;i++){
					codFuncionario	  = xml.getElementsByTagName('codigoFuncionario')[i].text;
					act1						  = xml.getElementsByTagName('actividad1')[i].text;
					act2						  = xml.getElementsByTagName('actividad2')[i].text;
					act3						  = xml.getElementsByTagName('actividad3')[i].text;
					act4						  = xml.getElementsByTagName('actividad4')[i].text;
					act5						  = xml.getElementsByTagName('actividad5')[i].text;
					act1Desc				  = xml.getElementsByTagName('actividad1Desc')[i].text;
					act2Desc				  = xml.getElementsByTagName('actividad2Desc')[i].text;
					act3Desc				  = xml.getElementsByTagName('actividad3Desc')[i].text;
					act4Desc				  = xml.getElementsByTagName('actividad4Desc')[i].text;
					act5Desc				  = xml.getElementsByTagName('actividad5Desc')[i].text;
					actTotal				  = xml.getElementsByTagName('actividadTotal')[i].text;
					
					puntaje = (actTotal*100)/5;
					
					contenido = "<table width='100%' cellspacing='4' cellpadding='4' >";
					contenido += "<tr>";
					contenido	+= "<td width='20%'> Actividad 1</td>";
					contenido	+= "<td align='center' width='10%'>"+act1+"</td>";
					contenido	+= "<td width='70%'>"+act1Desc+"</td>";
					contenido += "</tr>";
					contenido += "<tr>";
					contenido	+= "<td> Actividad 2</td>";
					contenido	+= "<td align='center' >"+act2+"</td>";
					contenido	+= "<td>"+act2Desc+"</td>";
					contenido += "</tr>";
					contenido += "<tr>";
					contenido	+= "<td> Actividad 3</td>";
					contenido	+= "<td align='center' >"+act3+"</td>";
					contenido	+= "<td>"+act3Desc+"</td>";
					contenido += "</tr>";
					contenido += "<tr>";
					contenido	+= "<td> Actividad 4</td>";
					contenido	+= "<td align='center' >"+act4+"</td>";
					contenido	+= "<td>"+act4Desc+"</td>";
					contenido += "</tr>";
					contenido += "<tr>";
					contenido	+= "<td> Actividad 5</td>";
					contenido	+= "<td align='center' >"+act5+"</td>";
					contenido	+= "<td>"+act5Desc+"</td>";
					contenido += "</tr>";
					contenido += "<tr>";
					contenido	+= "<td> Total </td>";
					contenido	+= "<td align='center' >"+actTotal+"</td>";
					contenido	+= "<td>"+puntaje+"%</td>";
					contenido += "</tr>";
					contenido += "</table><br>";
					
					div.innerHTML = contenido;
				}
				
			}
		}
	}
}

function eliminarPractica(funcionario){

	var objHttpXMLTaller = new AJAXCrearObjeto();
	var parametros = "codigoFuncionanario="+funcionario;
  //alert(parametros);
	objHttpXMLTaller.open("POST","./xml/xmlTaller/xmlBorrarTallerPractica.php",true);
	objHttpXMLTaller.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTaller.send(encodeURI(parametros)); 
	
	objHttpXMLTaller.onreadystatechange=function()
	{
		//alert(objHttpXMLTaller.readyState);
		if(objHttpXMLTaller.readyState == 4)
		{       
			//alert(objHttpXMLTaller.responseText);
			if (objHttpXMLTaller.responseText != "VACIO"){
				//alert(objHttpXMLTaller.responseText);		
				var xml 						= objHttpXMLTaller.responseXML.documentElement;
									
				for(i=0;i<xml.getElementsByTagName('taller').length;i++){
					
					var codigo = xml.getElementsByTagName('resultado')[i].text;
					if (codigo != 1){
						alert('NO SE PUDIERON ELIMINAR LOS REGISTROS ....		\nCODIGO RECIBIDO : ' + codigo);
						return 0;
					}
					return 1;
					
				}
				
			}
		}
	}
}

function mostrarResultados(funcionario){
	evaluarTallerPractica(funcionario);
	document.getElementById('popup').className='modal-wrapperTarget';
}

function cerrarResultados(){
	document.getElementById('popup').className='modal-wrapper';
}

function borrarResultados(funcionario){
	var borrar = confirm('Se borrarán todos los datos ingresados, y podrá realizar nuevamente ésta práctica  ¿Realmente desea continuar?');
	if(borrar){
		var resultado = eliminarPractica(funcionario);
		alert("Se borraron los datos ingresados, puede volver a realizar la práctica");
		cerrarResultados();
	}
	else{
		cerrarResultados();
	}
}

function mostrar(){
	document.getElementById('popup').className='modal-wrapperTarget2';
}