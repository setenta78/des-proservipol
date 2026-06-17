function cambiarClase(objeto, clase){
	objeto.className = clase;
}



function buscaFechaServicios(unidad){

  var fechaHojaRuta=document.getElementById("textFechaBuscaHoja").value;

  if(fechaHojaRuta=="")
  {
    alert("Debe seleccionar una fecha de inicio.");
  }

  else
  { 
    document.getElementById("textFechaBuscaHoja").value="";
    leeServicios(fechaHojaRuta,unidad);
  }

}


var cargaListadoHojaRuta        = 0;
var cargaListadoMedioVigilancia = 0;


function leeServicios(textoFecha,codigoUnidad){


	if(cargaListadoHojaRuta = 1)
	{
      document.getElementById("listadoHojaRuta").innerHTML="";
      document.getElementById("listadoMedioVigilancia").innerHTML="";
      cargaListadoHojaRuta        = 0;
      cargaListadoMedioVigilancia = 0;
	}


	var objHttpXMLHojaRuta = new AJAXCrearObjeto();

	var div	= document.getElementById("listadoHojaRuta");
	div.innerHTML="<div id='cargando'><img src='./hojaDeRuta/imagenes/loading2.gif'> CARGANDO ...</div>";

	objHttpXMLHojaRuta.open("POST","./hojaDeRuta/xml/xmlPasarelaListaServicios.php",true);

	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


	objHttpXMLHojaRuta.send("codigoUnidad="+codigoUnidad+"&fecha1="+textoFecha);


		
	objHttpXMLHojaRuta.onreadystatechange=function()
	{
		if(objHttpXMLHojaRuta.readyState == 4)
		{       
			if (objHttpXMLHojaRuta.responseText != "VACIO"){


				var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);


				var codUnidad                 = "";
				var correlativoServicio       = "";
				var fecha                     = "";
				var desServicio               = "";
				var desServicioExtraordinario = "";
				var horaInicio                = "";
				var horaTermino               = "";


				var listadoHojaRuta = "";
				
				var sw 				 = 0;
				var fondoLinea		 = "";
				var resaltarLinea 	 = "";
				var lineaSinResaltar = "";


				
				listadoHojaRuta = "<table width='100%' cellspacing='1' cellpadding='1'>";


        var contadorServicio  = 0;

				for(i=0;i<xml.getElementsByTagName('codUnidad').length;i++)
				{

        var claseServicio=xml.getElementsByTagName('claseServicio')[i].text;

        if(claseServicio=="O" || claseServicio=="F")
        {

          contadorServicio=contadorServicio+1;

					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codUnidad 		 	        = xml.getElementsByTagName('codUnidad')[i].text;
					correlativoServicio		    = xml.getElementsByTagName('correlativoServicio')[i].text;
					fecha	                    = xml.getElementsByTagName('fecha')[i].text;
					desServicio	 	            = xml.getElementsByTagName('desServicio')[i].text;
					desServicioExtraordinario   = xml.getElementsByTagName('desServicioExtraordinario')[i].text;
					horaInicio	                = xml.getElementsByTagName('horaInicio')[i].text;
					horaTermino	                = xml.getElementsByTagName('horaTermino')[i].text;


					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";

					

					listadoHojaRuta += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:leeMedioVigilancia('"+codUnidad+"','"+correlativoServicio+"')\">";

					listadoHojaRuta += "<td width='5%' align='center'><div id='valorColumna'>"+contadorServicio+"</div></td>";
					listadoHojaRuta += "<td width='15%' align='center'><div id='valorColumna'>"+fecha+"</div></td>";
					listadoHojaRuta += "<td width='30%'><div id='valorColumna'>"+desServicio.toUpperCase()+"</div></td>";
					listadoHojaRuta += "<td width='30%'><div id='valorColumna'>"+desServicioExtraordinario.toUpperCase()+"</div></td>";
					listadoHojaRuta += "<td width='20%' align='center'><div id='valorColumna'>"+horaInicio+" - "+horaTermino+"</div></td>";

					listadoHojaRuta += "</tr>";


        }
				}


				listadoHojaRuta += "</table>";
				div.innerHTML= listadoHojaRuta;
				cargaListadoHojaRuta = 1;



			}

    else{

    
    alert("No existen servicios ingresados para el "+textoFecha);
    div.innerHTML="";
    
    
    }

			
			

		}
	}
}




function leeMedioVigilancia(codUnidad,correlativoServicio){

	if(cargaListadoMedioVigilancia = 1)
	{
      document.getElementById("listadoMedioVigilancia").innerHTML="";
      cargaListadoMedioVigilancia = 0;
	}

	var objHttpXMLHojaRuta = new AJAXCrearObjeto();
	
	var div	= document.getElementById("listadoMedioVigilancia");
	
	div.innerHTML="<div id='cargando'><img src='./hojaDeRuta/imagenes/loading2.gif'> CARGANDO ...</div>";


		
	objHttpXMLHojaRuta.open("POST","./hojaDeRuta/xml/xmlPasarelaListaMedioVigilancia.php",true);

	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	objHttpXMLHojaRuta.send("codigoUnidad="+codUnidad+"&correlativo="+correlativoServicio);


		
	objHttpXMLHojaRuta.onreadystatechange=function()
	{
		if(objHttpXMLHojaRuta.readyState == 4)
		{       
			if (objHttpXMLHojaRuta.responseText != "VACIO"){


				var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);

				var fecha                     = "";
				var desServicio               = "";
				var desServicioExtraordinario = "";
				var horaInicio                = "";
				var horaTermino               = "";
				
				//var numeroMedio               = "";
				

				var listadoHojaRuta = "";
				
				var sw 				 = 0;
				var fondoLinea		 = "";
				var resaltarLinea 	 = "";
				var lineaSinResaltar = "";

			  fecha	                      = xml.getElementsByTagName('fecha')[0].text;
        desServicio	 	              = xml.getElementsByTagName('desServicio')[0].text;
				desServicioExtraordinario   = xml.getElementsByTagName('desServicioExtraordinario')[0].text;
				horaInicio	                = xml.getElementsByTagName('horaInicio')[0].text;
				horaTermino	                = xml.getElementsByTagName('horaTermino')[0].text;


				listadoHojaRuta = "<table width='100%' cellspacing='1' cellpadding='1'>";


				for(i=0;i<xml.getElementsByTagName('medioVigilancia').length;i++){


          var xmlMedioVigilancia = xml.getElementsByTagName('medioVigilancia')[i];


					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}

					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";


          var descripcionFactor    = xmlMedioVigilancia.getElementsByTagName('descripcionFactor')[0].text;

          var numeroMedio    = xmlMedioVigilancia.getElementsByTagName('numeroMedio')[0].text;
          //numeroMedio    = 0;



          var listadoVehiculo    = "";

            for(j=0;j<xmlMedioVigilancia.getElementsByTagName('patenteVehiculo').length;j++)
            {
               
                listadoVehiculo += xmlMedioVigilancia.getElementsByTagName('tipoVehiculo')[j].text+" ";
                listadoVehiculo += " ("+xmlMedioVigilancia.getElementsByTagName('patenteVehiculo')[j].text+")</br>";
            }


          var listadoFuncionario  = "";


            for(j=0;j<xmlMedioVigilancia.getElementsByTagName('identificacionFuncionario').length;j++)
            {
               
                listadoFuncionario += xmlMedioVigilancia.getElementsByTagName('grado')[j].text+" ";
                listadoFuncionario += xmlMedioVigilancia.getElementsByTagName('apellidoPaterno')[j].text.replace(/'/g,"")+" ";
                listadoFuncionario += xmlMedioVigilancia.getElementsByTagName('apellidoMaterno')[j].text.replace(/'/g,"")+" ";
                listadoFuncionario += xmlMedioVigilancia.getElementsByTagName('primerNombre')[j].text.replace(/'/g,"")+" ";
                listadoFuncionario += " ("+xmlMedioVigilancia.getElementsByTagName('codigoFuncionario')[j].text+")</br>";
            }




					listadoHojaRuta += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:abrirVentana('./hojaDeRuta/fichaHojaDeRuta.php?unidad="+codUnidad
					+"&correlativoServicio="+correlativoServicio
					+"&numeroMedio="+numeroMedio
					+"&fecha="+fecha
					+"&horaInicio="+horaInicio
					+"&horaTermino="+horaTermino
					+"&desServicio="+desServicio
					+"&descripcionFactor="+descripcionFactor
					+"&listadoVehiculo="+listadoVehiculo
					+"&listadoFuncionario="+listadoFuncionario
					+"')\">";



					listadoHojaRuta += "<td width='5%' align='center' valign='top'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoHojaRuta += "<td width='15%' valign='top'><div id='valorColumna'>"+desServicio.toUpperCase()+"</div></td>";
					listadoHojaRuta += "<td width='20%' valign='top'><div id='valorColumna'>"+descripcionFactor.toUpperCase()+"</div></td>";
					listadoHojaRuta += "<td width='20%' valign='top'><div id='valorColumna'>"+listadoVehiculo.toUpperCase()+"</div></td>";
					listadoHojaRuta += "<td width='40%' valign='top'><div id='valorColumna'>"+listadoFuncionario.toUpperCase()+"</div></td>";


					listadoHojaRuta += "</tr>";

				}







				listadoHojaRuta += "</table>";
				div.innerHTML= listadoHojaRuta;
				cargaListadoMedioVigilancia = 1;



			}

    else{

    
    alert("No existen medios de vigilancia ingresados para este servicio");

    div.innerHTML="";

    
    }

	
			

		}
	}
}



























