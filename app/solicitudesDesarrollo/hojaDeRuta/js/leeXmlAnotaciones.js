function leeAnotacion(unidad,correlativoServicio,numeroMedio){

	var div	= document.getElementById("listadoAnotacion");
	div.innerHTML="<img src='./imagenes/loading2.gif'> CARGANDO ...";

	var objHttpXMLAnotacion = new AJAXCrearObjeto();
		
	objHttpXMLAnotacion.open("POST","./xml/xmlAnotaciones.php",false);
	objHttpXMLAnotacion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLAnotacion.send("unidad="+unidad+"&correlativoServicio="+correlativoServicio+"&numeroMedio="+numeroMedio);

		
//	objHttpXMLAnotacion.onreadystatechange=function()
//	{
//		if(objHttpXMLAnotacion.readyState == 4)
		//{       
		    //alert(objHttpXMLAnotacion.responseText);
			if (objHttpXMLAnotacion.responseText != "VACIO"){
				var xml 			 = objHttpXMLAnotacion.responseXML.documentElement;
				//var xml 			 = objHttpXMLAnotacion.responseText;
        //alert(xml);

				var horaInicioReal    = "";
				var horaTerminoReal   = "";

		 horaInicioReal    = xml.getElementsByTagName('horaInicioReal')[0].text;
        horaTerminoReal   = xml.getElementsByTagName('horaTerminoReal')[0].text;


        document.getElementById("textHoraInicioReal").value   = horaInicioReal;
        document.getElementById("textHoraTerminoReal").value  = horaTerminoReal;



        if(xml.getElementsByTagName('anotacion').length == 0)
        {
            alert("No existen anotaciones ingresadas para este medio de vigilancia");
            div.innerHTML="";
            mostrarFondo();
        }
        
        else
        {
            for(i=0;i<xml.getElementsByTagName('anotacion').length;i++){

                var xmlAnotacion = xml.getElementsByTagName('anotacion')[i];

                var factor                = xmlAnotacion.getElementsByTagName('factor')[0].text;
                var descripcionFactor     = xmlAnotacion.getElementsByTagName('descripcionFactor')[0].text;
                var horaInicio            = xmlAnotacion.getElementsByTagName('horaInicio')[0].text;
                var horaTermino           = xmlAnotacion.getElementsByTagName('horaTermino')[0].text;
                var cuadrante             = xmlAnotacion.getElementsByTagName('cuadrante')[0].text;
                var descripcionCuadrante  = xmlAnotacion.getElementsByTagName('descripcionCuadrante')[0].text;
                var otraUnidad            = xmlAnotacion.getElementsByTagName('otraUnidad')[0].text;
                var descripcionOtraUnidad = xmlAnotacion.getElementsByTagName('descripcionOtraUnidad')[0].text;


            if(cuadrante == "")
            {
                if(otraUnidad == "")
                {
                    arregloAnotaciones[i] = new Array(factor,horaInicio.substring(0,2),horaInicio.substring(3,5),horaTermino.substring(0,2),horaTermino.substring(3,5),"NULL","NULL",descripcionFactor,"SIN PCSP",0);
                }

                else
                {
                    arregloAnotaciones[i] = new Array(factor,horaInicio.substring(0,2),horaInicio.substring(3,5),horaTermino.substring(0,2),horaTermino.substring(3,5),"NULL",otraUnidad,descripcionFactor,descripcionOtraUnidad+"</br>SIN PCSP",1);
                }
               
            }


            else
            {
                if(otraUnidad == "")
                {
                    arregloAnotaciones[i] = new Array(factor,horaInicio.substring(0,2),horaInicio.substring(3,5),horaTermino.substring(0,2),horaTermino.substring(3,5),cuadrante,"NULL",descripcionFactor,descripcionCuadrante,0);
                }

                else
                {
                    arregloAnotaciones[i] = new Array(factor,horaInicio.substring(0,2),horaInicio.substring(3,5),horaTermino.substring(0,2),horaTermino.substring(3,5),cuadrante,otraUnidad,descripcionFactor,descripcionOtraUnidad+"</br>"+descripcionCuadrante,1);
                }
            }






            }

            muestraAnotaciones();
            mostrarFondo();
				}

			}

    else{

    
    //alert("No existen datos ingresados para este medio de vigilancia");

    div.innerHTML="";
    mostrarFondo();
    
    }

	
			

//		}
//	}
}



