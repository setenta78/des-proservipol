var arregloListaCuadrante = new Array();

function leeCuadrante(codigoUnidad){

	var objHttpXMLHojaRuta = new AJAXCrearObjeto();

	objHttpXMLHojaRuta.open("POST","./xml/xmlPasarelaListaCuadrantes.php",false);
	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLHojaRuta.send("codigoUnidad="+codigoUnidad);


		
//	objHttpXMLHojaRuta.onreadystatechange=function()
//	{
//		if(objHttpXMLHojaRuta.readyState == 4)
	//{       

			var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;

			if (xml.getElementsByTagName('cuadrante').length>0){

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);

				var codigo      = "";
				var descripcion = "";
				var abreviatura = "";

        document.getElementById("cuadranteAnotacion").options[0] = new Option('Seleccione ...','0',"","");

				for(i=0;i<xml.getElementsByTagName('cuadrante').length;i++)
				{
					codigo        = xml.getElementsByTagName('codigo')[i].text;
					descripcion   = xml.getElementsByTagName('descripcion')[i].text;
					abreviatura   = xml.getElementsByTagName('abreviatura')[i].text;
			   	
			   	if(abreviatura!='OTRO')
			   	{
              document.getElementById("cuadranteAnotacion").options[i+1] = new Option(abreviatura,codigo,"","");
          }
			   	//arregloListaCuadrante[arregloListaCuadrante.length]= new Array(codigo,abreviatura);
			   	
				}

          document.getElementById("cuadranteAnotacion").options[document.getElementById("cuadranteAnotacion").options.length] = new Option('OTRO','-1',"","");

			   	//arregloListaCuadrante[arregloListaCuadrante.length]= new Array(1000,"OTRO");

			}

    else{
        document.getElementById("cuadranteAnotacion").options[0] = new Option('Seleccione ...','0',"","");    
        document.getElementById("cuadranteAnotacion").options[1] = new Option('SIN PCSP','-2',"","");    
        document.getElementById("cuadranteAnotacion").options[2] = new Option('OTRO','-1',"","");    

        //arregloListaCuadrante[arregloListaCuadrante.length]= new Array(1000,"OTRO");
        //arregloListaCuadrante[arregloListaCuadrante.length]= new Array(1001,"SIN PCSP");

    //alert("No existen cuadrantes para esta unidad");
    //div.innerHTML="";
    
    }

			
//	}
//	}
}




















