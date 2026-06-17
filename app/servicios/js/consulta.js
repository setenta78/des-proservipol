function consultaServicio()
{
	//alert(codigo+'  '+fecha1+'  '+fecha2);
	
	var codigo = eliminarBlancos(document.getElementById("texto2").value.toUpperCase());
	var fecha1 = document.getElementById("dateArrival1").value;
  var fecha2 = document.getElementById("dateArrival2").value;
  	
  var divPagina	= document.getElementById("contenidoPagina");
  divPagina.innerHTML="<br><br><center><img src='./img/load.gif'>  CARGANDO ...</center>";

  var objHttpXMLCargaDatos = new AJAXCrearObjeto();

  objHttpXMLCargaDatos.open("POST","./proceso/consultaServicio.php",true);
  
  objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

   //objHttpXMLCargaDatos.send("anno="+anno);
  
   objHttpXMLCargaDatos.send(encodeURI("codigo="+codigo+"&fecha1="+fecha1+"&fecha2="+fecha2));
   
   //alert("A\u00F1o: "+anno);
   //alert("Mes: "+mes);

   
  objHttpXMLCargaDatos.onreadystatechange=function()
  {
  	
    if(objHttpXMLCargaDatos.readyState == 4)
    {
    	//alert(objHttpXMLCargaDatos.responseText);
  
      if (objHttpXMLCargaDatos.responseText != "ERROR")
      {
        var xml 			 = objHttpXMLCargaDatos.responseText;
        divPagina.innerHTML=xml;
      
      }

      else
      {
        alert("PROBLEMAS CON LA BASE DE DATOS.");
        divPagina.innerHTML="";
      }
    }
  }
}

function insertBusqueda(){
  var usuario = document.getElementById("usuario").value;
  var tipo    = document.getElementById("tipo").value;
	var codigo  = eliminarBlancos(document.getElementById("texto2").value.toUpperCase());
	var fecha1  = document.getElementById("dateArrival1").value;
  var fecha2  = document.getElementById("dateArrival2").value;
  
  var divPagina	= document.getElementById("contenidoPagina");
  divPagina.innerHTML="<br><br><center><img src='./img/load.gif'>  CARGANDO ...</center>";

  var objHttpXMLCargaDatos = new AJAXCrearObjeto();

  objHttpXMLCargaDatos.open("POST","./proceso/insertBusqueda.php",false);
  
  objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

  objHttpXMLCargaDatos.send("usuario="+usuario+"&tipo="+tipo+"&codigo="+codigo+"&fecha1="+fecha1+"&fecha2="+fecha2);
  
  //objHttpXMLCargaDatos.onreadystatechange=function()
  //{
  	//alert(objHttpXMLCargaDatos.responseText);
    //if(objHttpXMLCargaDatos.readyState == 4)
    //{
    	//alert(objHttpXMLCargaDatos.responseText);
      if (objHttpXMLCargaDatos.responseText != "ERROR")
      {
        var xml 			 = objHttpXMLCargaDatos.responseText;
        divPagina.innerHTML=xml;
     
		
      }

      else
      {
        alert("PROBLEMAS CON LA BASE DE DATOS.");
        divPagina.innerHTML="";
      }
    //}
  //}
}

function validarConsulta(){
	var codigo = document.getElementById("texto2").value.toUpperCase();
	var fecha1 = document.getElementById("dateArrival1").value;
  var fecha2 = document.getElementById("dateArrival2").value;
  
  var regExCodigoFun = /^[0-9]{6,6}[A-Z]{1,1}$/;
	var codigoValido = codigo.match(regExCodigoFun);
	
		if (codigo == ""){
		alert("DEBE INDICAR EL CODIGO DE FUNCIONARIO ...... 	     ");
		document.getElementById("texto2").focus();
		return false;
	}
	
	if(fecha1 == ""){
		alert("DEBE INDICAR LA FECHA DESDE ...... 	     ");
		document.getElementById("dateArrival1").focus();
		return false;
	
 }
 	if (fecha2 == ""){
		alert("DEBE INDICAR LA FECHA HASTA ...... 	     ");
		document.getElementById("dateArrival2").focus();
		return false;
	}
	
	if (!codigoValido){
		alert("EL CODIGO DE FUNCIONARIO INGRESADO NO TIENE UNA ESTRUCTURA VALIDA...... 	     ");
		document.getElementById("texto2").focus();
		return false;
	}
	
	var fechaMayor = comparaFecha(fecha1,fecha2);
	if (fechaMayor == 1){
		alert("LA FECHA DESDE NO PUEDE SER MAYOR QUE LA FECHA HASTA ....  ");
		return false;
	}
	
  return true;
}

function consultaServicio2(codigo, fecha1, fecha2)
{
	var codigo = eliminarBlancos(document.getElementById("texto2").value.toUpperCase());
	var fecha1 = document.getElementById("dateArrival1").value;
  var fecha2 = document.getElementById("dateArrival2").value;
  	
  var divPagina	= document.getElementById("contenidoPagina2");
  divPagina.innerHTML="<br><br><center><img src='./img/load.gif'>  CARGANDO ...</center>";

  var objHttpXMLCargaDatos = new AJAXCrearObjeto();

  objHttpXMLCargaDatos.open("POST","./proceso/consultaServicio2.php",true);
  
  objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

   //objHttpXMLCargaDatos.send("anno="+anno);
  
   objHttpXMLCargaDatos.send(encodeURI("codigo="+codigo+"&fecha1="+fecha1+"&fecha2="+fecha2));
   
   //alert("A\u00F1o: "+anno);
   //alert("Mes: "+mes);

   
  objHttpXMLCargaDatos.onreadystatechange=function()
  {
  	
    if(objHttpXMLCargaDatos.readyState == 4)
    {
     //alert(objHttpXMLCargaDatos.responseText);
  
      if (objHttpXMLCargaDatos.responseText != "ERROR")
      {
        var xml 			 = objHttpXMLCargaDatos.responseText;
        divPagina.innerHTML=xml;
      
      }

      else
      {
        alert("PROBLEMAS CON LA BASE DE DATOS.");
        divPagina.innerHTML="";
      }
    }
  }
}

function consultarServicio(){	
	//alert(codigo+'  '+fecha1+'  '+fecha2);
	var validaOk = validarConsulta();
	if(validaOk){
		consultaServicio();
	  insertBusqueda();
	}	
}

function consultarServicio2(){	
	//alert();
	var validaOk = validarConsulta();
	if(validaOk){
		consultaServicio2();
	  //insertBusqueda();
	}	
}


function ltrim(s) {  
	return s.replace(/^\s+/, "");
}

function rtrim(s) {  
	return s.replace(/\s+$/, "");
}

function trim(s) {  
	return rtrim(ltrim(s));
}

function eliminarBlancos(texto){
	texto = trim(texto);
	if (texto.length >0)
	{
			cont = 0;
			for (i=0; i<texto.length;i++)
			{
					if (texto.charAt(i) == " ") cont++;
			}
			if (cont == texto.length) texto = "";
	}
	
	return texto;
}

function limpia(elemento)
{
elemento.value = "";
}

function verifica(elemento)
{
if(elemento.value = "")
elemento.value = "Default Value";
}

function getAnno(fecha){
	var fechaPaso = fecha.split("/");
   return fechaPaso[2];
}

function getMes(fecha){
	var fechaPaso = fecha.split("/");
    return fechaPaso[1];
}

function getDia(fecha){
	var fechaPaso = fecha.split("/");
    return fechaPaso[0];
}


function comparaFecha(fecha1, fecha2){
	
	var auxFecha1 = new Date(getAnno(fecha1),getMes(fecha1)-1,getDia(fecha1));
	var auxFecha2 = new Date(getAnno(fecha2),getMes(fecha2)-1,getDia(fecha2));
	//alert(auxFecha1 + " ---- " + auxFecha2);
	if (auxFecha1 > auxFecha2) return 1;
	if (auxFecha1 < auxFecha2) return 2;
	if (fecha1 == fecha2) return 0;
}