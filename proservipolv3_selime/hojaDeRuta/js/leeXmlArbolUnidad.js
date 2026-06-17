var arregloListaOtroCuadrante = new Array();


var enCuadrante=0;

var padreActual=0;
var nombreOtraUnidad="";

var otroCuadrante=0;
var descripcionOtroCuadrante="";



function muestraOtroCuadrante(valorOtroCuadrante){

  if(valorOtroCuadrante==-1)
  {
      document.getElementById("labelOtraUnidad").disabled = false;
      document.getElementById("BotonMuestraArbolUnidad").disabled = false;
      //document.getElementById("textLabelOtraUnidad").innerHTML= "";
  }
  
  
  else
  {
      document.getElementById("labelOtraUnidad").disabled=true;
      document.getElementById("BotonMuestraArbolUnidad").disabled = true;
      document.getElementById("textLabelOtraUnidad").innerHTML= "";
  }


}


function muestraArbolUnidad(codigoSeleccion){

    ocultarFondo();
    document.getElementById("layerArbolUnidad").style.visibility = "visible";
    //document.getElementById("textLabelOtraUnidad").innerHTML= "";

/*
enCuadrante=0;

padreActual=0;
nombreOtraUnidad="";
otroCuadrante=0;
descripcionOtroCuadrante="";
*/
    
    leeArbolUnidadArriba(codigoSeleccion);
    
}

function cancelarArbolUnidad(){

    mostrarFondo();
    document.getElementById("layerArbolUnidad").style.visibility = "hidden";
}



function validarArbolUnidad(codigoSeleccion){

    document.getElementById("layerArbolUnidad").style.visibility = "hidden";
    mostrarFondo();

    otroCuadrante=codigoSeleccion;

    document.getElementById("textLabelOtraUnidad").innerHTML= nombreOtraUnidad+"</br>"+descripcionOtroCuadrante;
    
}




function leeArbolUnidad(codigoSeleccion){

    if(codigoSeleccion=='0')
    {   nombreOtraUnidad="";
        descripcionOtroCuadrante="";
        leeArbolUnidadArriba(padreActual);
    }

    else if(codigoSeleccion!='-1' && enCuadrante=='0')
    {
        nombreOtraUnidad = document.getElementById("listaArbolUnidad").options[document.getElementById("listaArbolUnidad").selectedIndex].text;
        leeArbolUnidadAbajo(codigoSeleccion);
    }

    else if(codigoSeleccion!='-1' && enCuadrante=='1')
    {   
        descripcionOtroCuadrante = document.getElementById("listaArbolUnidad").options[document.getElementById("listaArbolUnidad").selectedIndex].text;
        validarArbolUnidad(codigoSeleccion);
    }

}




function leeArbolUnidadAbajo(codigoPadre){

  padreActual=codigoPadre;

  limpiarSelect('listaArbolUnidad');

  document.getElementById("listaArbolUnidad").options[0] = new Option('CARGANDO ...','-1',"","");

	var objHttpXMLHojaRuta = new AJAXCrearObjeto();

	objHttpXMLHojaRuta.open("POST","./xml/xmlPasarelaArbolUnidad.php",true);
	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLHojaRuta.send("codigoPadre="+codigoPadre);

		
	objHttpXMLHojaRuta.onreadystatechange=function()
	{
		if(objHttpXMLHojaRuta.readyState == 4)
		{       
			if (objHttpXMLHojaRuta.responseText != "VACIO"){


				var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);

				var unidad        = "";
				var padre         = "";
				var descripcion   = "";
				var planCuadrante = "";

        document.getElementById("listaArbolUnidad").options[0] = new Option('OTRA UNIDAD','0',"","");			   	


				for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
				{
					unidad        = xml.getElementsByTagName('unidad')[i].text;
					padre         = xml.getElementsByTagName('padre')[i].text;
					descripcion   = xml.getElementsByTagName('descripcion')[i].text;
					planCuadrante = xml.getElementsByTagName('planCuadrante')[i].text;
	   	
			   	
			   	document.getElementById("listaArbolUnidad").options[i+1] = new Option(descripcion,unidad,"","");

				}

			}

    else{

    
                var objHttpXMLCuadrante = new AJAXCrearObjeto();

                objHttpXMLCuadrante.open("POST","./xml/xmlPasarelaListaCuadrantes.php",true);
                objHttpXMLCuadrante.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                objHttpXMLCuadrante.send("codigoUnidad="+codigoPadre);


                objHttpXMLCuadrante.onreadystatechange=function()
                {
                  if(objHttpXMLCuadrante.readyState == 4)
                  {
                    //var xml 			 = objHttpXMLCuadrante.responseText;
                    //alert(xml);

                    enCuadrante=1;

                      var xml 			 = objHttpXMLCuadrante.responseXML.documentElement;

//                  if (objHttpXMLCuadrante.responseText != "VACIO")

                    if (xml.getElementsByTagName('cuadrante').length>0)
                    {

                      //var xml 			 = objHttpXMLCuadrante.responseText;
                      //alert(xml);

                      var codigo      = "";
                      var descripcion = "";
                      var abreviatura = "";

                      document.getElementById("listaArbolUnidad").options[0] = new Option('OTRA UNIDAD','0',"","");

                      for(i=0;i<xml.getElementsByTagName('cuadrante').length;i++)
                      {
                        codigo        = xml.getElementsByTagName('codigo')[i].text;
                        descripcion   = xml.getElementsByTagName('descripcion')[i].text;
                        abreviatura   = xml.getElementsByTagName('abreviatura')[i].text;


                        //alert(codigo);
                        if(abreviatura!='OTRO')
                        {
                            document.getElementById("listaArbolUnidad").options[i+1] = new Option(descripcion,codigo,"","");
                        }
                      }

                    }


                    else{

                      document.getElementById("listaArbolUnidad").options[0] = new Option('OTRA UNIDAD','0',"","");
                      document.getElementById("listaArbolUnidad").options[1] = new Option('SIN PCSP','-2',"","");
                      //alert("No existen cuadrantes para esta unidad");
                      //div.innerHTML="";
                
                    }

			
	}
	}


   
    }

			
	}
	}
}




function leeArbolUnidadArriba(codigoUnidad){


  limpiarSelect('listaArbolUnidad');

  document.getElementById("listaArbolUnidad").options[0] = new Option('CARGANDO ...','-1',"","");
  enCuadrante=0;


	var objHttpXMLHojaRuta = new AJAXCrearObjeto();

	objHttpXMLHojaRuta.open("POST","./xml/xmlPasarelaArbolUnidadArriba.php",true);
	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLHojaRuta.send("codigoUnidad="+codigoUnidad);

		
	objHttpXMLHojaRuta.onreadystatechange=function()
	{
		if(objHttpXMLHojaRuta.readyState == 4)
		{       
			if (objHttpXMLHojaRuta.responseText != "VACIO"){


				var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);


				var unidad        = "";
				var padre         = "";
				var descripcion   = "";
				var planCuadrante = "";


          document.getElementById("listaArbolUnidad").options[0] = new Option('OTRA UNIDAD','0',"","");			   	

				for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
				{
					unidad        = xml.getElementsByTagName('unidad')[i].text;
					padre         = xml.getElementsByTagName('padre')[i].text;
					descripcion   = xml.getElementsByTagName('descripcion')[i].text;
					planCuadrante = xml.getElementsByTagName('planCuadrante')[i].text;
			   	
			   	document.getElementById("listaArbolUnidad").options[i+1] = new Option(descripcion,unidad,"","");
				}

          padreActual=padre;

			}

    else{
    
    //alert("No existe nodo");
    //div.innerHTML="";
    
    }

			
	}
	}
}




 function limpiarSelect(idSelect) {

    var select = document.getElementById(idSelect);

    while (select.options.length > 0) {
    
        select.options[0]=null;
    }
  }



