var arregloTipoUnidad = new Array();

function cerrarVentana(){
top.cerrarVentana();
}

function leeArbolUnidad(codigoSeleccion){
 
    if(codigoSeleccion != "")
    {
        document.getElementById("listaArbolUnidad").disabled = true;
        document.getElementById("labelSeleccion").innerHTML = "CARGANDO ...";
        document.getElementById("btnGuardarFicha").disabled = true;

        if(codigoSeleccion == '0' && unidadUsuario != padreActual)
        {   
            leeArbolUnidadArriba(padreActual);
        }

        else if(codigoSeleccion == '0' && unidadUsuario == padreActual)
        {   
            limpiarSelect('listaArbolUnidad');
            document.getElementById("listaArbolUnidad").options[0] = new Option(descUnidadUsuario,unidadUsuario,"","");
            document.getElementById("listaArbolUnidad").disabled = false;
            document.getElementById("labelSeleccion").innerHTML = "SELECCIONE REPARTICION :";
            document.getElementById("btnGuardarFicha").disabled = false;
            
        }

        else
        {
            leeArbolUnidadAbajo(codigoSeleccion);
        }
    }
}




function leeArbolUnidadAbajo(codigoPadre){

	var objHttpXMLHojaRuta = new AJAXCrearObjeto();

	objHttpXMLHojaRuta.open("POST","./xml/xmlArbolUnidad.php",true);
	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLHojaRuta.send("codigoPadre="+codigoPadre);

		
	objHttpXMLHojaRuta.onreadystatechange=function()
	{
		if(objHttpXMLHojaRuta.readyState == 4)
		{       
			if (objHttpXMLHojaRuta.responseText != "VACIO"){

        padreActual=codigoPadre;
        limpiarSelect('listaArbolUnidad');

				var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);

				var unidad        = "";
				var padre         = "";
				var descripcion   = "";
				var tipoUnidad    = "";
        arregloTipoUnidad = new Array();

        document.getElementById("listaArbolUnidad").options[0] = new Option('..','0',"","");

				for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
				{
					unidad        = xml.getElementsByTagName('unidad')[i].text;
					padre         = xml.getElementsByTagName('padre')[i].text;
					descripcion   = xml.getElementsByTagName('descripcion')[i].text;
					tipoUnidad    = xml.getElementsByTagName('tipoUnidad')[i].text;
			   	
			   	document.getElementById("listaArbolUnidad").options[i+1] = new Option(descripcion,unidad,"","");
			   	arregloTipoUnidad[i+1] = tipoUnidad;

				}

        document.getElementById("listaArbolUnidad").disabled = false;
        document.getElementById("labelSeleccion").innerHTML = "SELECCIONE REPARTICION :";
        document.getElementById("btnGuardarFicha").disabled = false;
			}

    else{

        alert("NO EXISTEN UNIDADES DEPENDIENTES");
        document.getElementById("listaArbolUnidad").disabled = false;
        document.getElementById("labelSeleccion").innerHTML = "SELECCIONE REPARTICION :";
        document.getElementById("btnGuardarFicha").disabled = false;
    }

			
	}
	}
}



function leeArbolUnidadArriba(codigoUnidad){


	var objHttpXMLHojaRuta = new AJAXCrearObjeto();

	objHttpXMLHojaRuta.open("POST","./xml/xmlArbolUnidadArriba.php",true);
	objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLHojaRuta.send("codigoUnidad="+codigoUnidad);

		
	objHttpXMLHojaRuta.onreadystatechange=function()
	{
		if(objHttpXMLHojaRuta.readyState == 4)
		{       
			if (objHttpXMLHojaRuta.responseText != "VACIO"){

        limpiarSelect('listaArbolUnidad');

				var xml 			 = objHttpXMLHojaRuta.responseXML.documentElement;

				//var xml 			 = objHttpXMLHojaRuta.responseText;
        //alert(xml);


				var unidad        = "";
				var padre         = "";
				var descripcion   = "";
				var tipoUnidad    = "";
				arregloTipoUnidad = new Array();

        document.getElementById("listaArbolUnidad").options[0] = new Option('..','0',"","");			   	


				for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
				{
					unidad        = xml.getElementsByTagName('unidad')[i].text;
					padre         = xml.getElementsByTagName('padre')[i].text;
					descripcion   = xml.getElementsByTagName('descripcion')[i].text;
					tipoUnidad    = xml.getElementsByTagName('tipoUnidad')[i].text;
			   	
			   	document.getElementById("listaArbolUnidad").options[i+1] = new Option(descripcion,unidad,"","");
          arregloTipoUnidad[i+1] = tipoUnidad;
				}

          padreActual=padre;

        document.getElementById("listaArbolUnidad").disabled = false;
        document.getElementById("labelSeleccion").innerHTML = "SELECCIONE REPARTICION :";
        document.getElementById("btnGuardarFicha").disabled = false;

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




function validaUnidad(){

    if(document.getElementById("listaArbolUnidad").value == 0)
    {
        alert("SELECCIONE REPARTICION");
    }

    else if(!document.getElementById("checkPROSERVIPOL").checked && !document.getElementById("checkRRCC").checked)
    {
        alert("SELECCIONE MODULO(S)");
    }


    else if(arregloTipoUnidad[document.getElementById("listaArbolUnidad").selectedIndex] == 40)
    {
        alert("SELECCIONE UNIDAD");
        leeArbolUnidad(document.getElementById("listaArbolUnidad").value);
    }

    else
    {

        if(document.getElementById("checkPROSERVIPOL").checked && document.getElementById("checkRRCC").checked)
        {

            if(arregloTipoUnidad[document.getElementById("listaArbolUnidad").selectedIndex] == 50)
            {
                top.listarUsuarios(document.getElementById("listaArbolUnidad").value,padreActual,"ALL");
            }
            
            else
            {
                top.listarUsuarios(document.getElementById("listaArbolUnidad").value,"","ALL");            
            }       

            top.document.getElementById("labelUnidad").innerHTML = "PROSERVIPOL - RRCC : "+document.getElementById("listaArbolUnidad").options[document.getElementById("listaArbolUnidad").selectedIndex].text;

        }

        else if(document.getElementById("checkPROSERVIPOL").checked)
        {
            if(arregloTipoUnidad[document.getElementById("listaArbolUnidad").selectedIndex] == 50)
            {
                top.listarUsuarios(document.getElementById("listaArbolUnidad").value,padreActual,"PROSERVIPOL");
            }
            
            else
            {
                top.listarUsuarios(document.getElementById("listaArbolUnidad").value,"","PROSERVIPOL");            
            }

            top.document.getElementById("labelUnidad").innerHTML = "PROSERVIPOL : "+document.getElementById("listaArbolUnidad").options[document.getElementById("listaArbolUnidad").selectedIndex].text;

        }
        
        else if(document.getElementById("checkRRCC").checked)
        {
            top.listarUsuarios(document.getElementById("listaArbolUnidad").value,"","RRCC");

            top.document.getElementById("labelUnidad").innerHTML = "RRCC : "+document.getElementById("listaArbolUnidad").options[document.getElementById("listaArbolUnidad").selectedIndex].text;

        }

        cerrarVentana();

    }

}

/*
function deshabilitaCheck(valorCheck){

    document.getElementById("check"+valorCheck).checked = false;

}
*/


