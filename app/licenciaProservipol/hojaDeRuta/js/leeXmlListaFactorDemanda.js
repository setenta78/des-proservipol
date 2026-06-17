//var arregloListaFactorDemanda = new Array();


function leeFactorDemanda(){

	var objHttpXMLHojaRuta = new AJAXCrearObjeto();

	objHttpXMLHojaRuta.open("POST","./xml/xmlPasarelaListaFactorDemanda.php",false);
	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLHojaRuta.send();

		
//	objHttpXMLHojaRuta.onreadystatechange=function()
//	{
//		if(objHttpXMLHojaRuta.readyState == 4)
//		{       

			var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;
			if (xml.getElementsByTagName('factor').length > 0){

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);


				var codigo      = "";
				var descripcion = "";
				var abreviatura = "";

        document.getElementById("selFactorAnotacion").options[0] = new Option('Seleccione Factor ...','0',"","");

				for(i=0;i<xml.getElementsByTagName('factor').length;i++)
				{
					codigo        = xml.getElementsByTagName('codigo')[i].text;
					descripcion   = xml.getElementsByTagName('descripcion')[i].text;
					abreviatura   = xml.getElementsByTagName('abreviatura')[i].text;
			   	
			   	document.getElementById("selFactorAnotacion").options[i+1] = new Option(descripcion,codigo,"","");
			    //arregloListaFactorDemanda[arregloListaFactorDemanda.length]= new Array(codigo,descripcion);
				}

			}

    else{
    
    alert("Problema al cargar factores de la demanda.");
    //div.innerHTML="";
    
    }

			
//	}
//	}
}




















