function cambiarClase(objeto, clase){
	objeto.className = clase;
}

    var estado="";

function verificaIngresoDatos(mes,anno,tabla)
{

    document.getElementById("textFecha").innerHTML="&nbsp;";
    document.getElementById("textSubMenu").innerHTML="&nbsp;";

    if (tabla==0)
    {
        alert("Debe seleccionar Tabla");
        document.getElementById("selTabla").focus();
    }


    else if (mes==0)
    {
        alert("Debe seleccionar Mes");
        document.getElementById("selMes").focus();
    }

    else if(anno==0)
    {
        alert("Debe seleccionar Año");
        document.getElementById("selAnno").focus();
    }

    else
    {
        document.getElementById("btnCargaDatos").disabled=true;
        document.getElementById("btnEstadoDatos").disabled=true;
        document.getElementById("CerrarSesion").disabled=true;

        document.getElementById("selTabla").disabled=true;
        document.getElementById("selMes").disabled=true;
        document.getElementById("selAnno").disabled=true;

        document.getElementById("textFecha").innerHTML = "<b>"+document.getElementById("selMes").options[document.getElementById("selMes").selectedIndex].text+" DE "+document.getElementById("selAnno").value+" : "+tabla.toUpperCase()+"</b>";

        document.getElementById("selTabla").value=0;
        document.getElementById("selMes").value=0;
        document.getElementById("selAnno").value=0;

        estado="";


        if(tabla=="Organizaciones" || tabla=="Reuniones")
        {
          iniciaCargaDatos2(mes,anno,tabla);
        }
        
        else
        {
          iniciaCargaDatos(01,mes,anno,tabla,daysInMonth(mes,anno));
        }

    }
}


function iniciaCargaDatos(dia,mes,anno,tabla,diasMes)
{

      var div=document.getElementById("textSubMenu");
  
      div.innerHTML="<img src='./img/loading1.gif'> CARGANDO ..."+estado;
  
      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./baseDatos/dbCargaDatos"+tabla+".php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("dia="+dia+"&mes="+mes+"&anno="+anno);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {       
          if (objHttpXMLCargaDatos.responseText != "")
          {
            var xml 			 = objHttpXMLCargaDatos.responseText;
            //alert(xml);

            estado="</br>"+xml+estado;

            if(dia<diasMes)
            //if(dia<03)
            {
                iniciaCargaDatos(dia+1,mes,anno,tabla,diasMes)
            }
            
            else
            {
                //div.innerHTML="<img src='./img/red_fox.gif'></br>TERMINADO"+estado;
                div.innerHTML="TERMINADO"+estado;
                document.getElementById("btnCargaDatos").disabled=false;
                document.getElementById("btnEstadoDatos").disabled=false;
                document.getElementById("CerrarSesion").disabled=false;
                document.getElementById("selTabla").disabled=false;
                document.getElementById("selMes").disabled=false;
                document.getElementById("selAnno").disabled=false;
            }
            
          }

          else
          {
              alert("Problemas con la base de datos");
              div.innerHTML="";
          }

        }
        
      }
}




function iniciaCargaDatos2(mes,anno,tabla)
{

      var div=document.getElementById("textSubMenu");
  
      div.innerHTML="<img src='./img/loading1.gif'> CARGANDO ..."+estado;
  
      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./baseDatos/dbCargaDatos"+tabla+".php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("mes="+mes+"&anno="+anno);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {       
          if (objHttpXMLCargaDatos.responseText != "")
          {
            var xml 			 = objHttpXMLCargaDatos.responseText;
            //alert(xml);

            estado="</br>"+xml+estado;

                //div.innerHTML="<img src='./img/red_fox.gif'></br>TERMINADO"+estado;
                div.innerHTML="TERMINADO"+estado;
                document.getElementById("btnCargaDatos").disabled=false;
                document.getElementById("btnEstadoDatos").disabled=false;
                document.getElementById("CerrarSesion").disabled=false;
                document.getElementById("selTabla").disabled=false;
                document.getElementById("selMes").disabled=false;
                document.getElementById("selAnno").disabled=false;
            
          }

          else
          {
              alert("Problemas con la base de datos");
              //div.innerHTML="";
          }

        }
        
      }
}




function verificaEstadoDatos(mes,anno)
{

    document.getElementById("textFecha").innerHTML="&nbsp;";
    document.getElementById("textSubMenu").innerHTML="&nbsp;";

    if (mes==0)
    {
        alert("Debe seleccionar Mes");
        document.getElementById("selMes").focus();
    }

    else if(anno==0)
    {
        alert("Debe seleccionar Año");
        document.getElementById("selAnno").focus();
    }

    else
    {
        document.getElementById("btnCargaDatos").disabled=true;
        document.getElementById("btnEstadoDatos").disabled=true;
        document.getElementById("CerrarSesion").disabled=true;

        document.getElementById("selTabla").disabled=true;
        document.getElementById("selMes").disabled=true;
        document.getElementById("selAnno").disabled=true;

        document.getElementById("textFecha").innerHTML = "<b>"+document.getElementById("selMes").options[document.getElementById("selMes").selectedIndex].text+" DE "+document.getElementById("selAnno").value+" : ESTADO CARGA</b>";

        document.getElementById("selTabla").value=0;
        document.getElementById("selMes").value=0;
        document.getElementById("selAnno").value=0;

        estado="";


        iniciaEstadoDatos(mes,anno);
    }
}




function iniciaEstadoDatos(mes,anno)
{
      var div=document.getElementById("textSubMenu");
  
      div.innerHTML="<img src='./img/loading1.gif'> CARGANDO ..."+estado;
  
      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./baseDatos/dbEstadoDatos.php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("mes="+mes+"&anno="+anno);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {       
          if (objHttpXMLCargaDatos.responseText != "")
          {
            var xml 			 = objHttpXMLCargaDatos.responseText;
            //alert(xml);

                estado="</br>"+xml+estado;

                div.innerHTML="TERMINADO"+estado;
                document.getElementById("btnCargaDatos").disabled=false;
                document.getElementById("btnEstadoDatos").disabled=false;
                document.getElementById("CerrarSesion").disabled=false;
                document.getElementById("selTabla").disabled=false;
                document.getElementById("selMes").disabled=false;
                document.getElementById("selAnno").disabled=false;
            
          }

          else
          {
              alert("Problemas con la base de datos");
              //div.innerHTML="";
          }

        }
        
      }
}



function daysInMonth(monthNum,yearNum )
{
	if( monthNum==undefined && yearNum==undefined )
	{
		now = new Date();
		monthNum = now.getMonth()+1;
		yearNum = now.getFullYear();
	}

	else if( monthNum || yearNum || monthNum=="" || yearNum == "" )
	{
		now = new Date();
		if( monthNum==undefined || monthNum=="" )
			monthNum = now.getMonth()+1;
		if( yearNum==undefined || yearNum=="" )
			yearNum = now.getFullYear();
	}

	monthNum = Number(monthNum);
	yearNum = Number(yearNum);
	
	if( isNaN(monthNum) || isNaN(yearNum) || monthNum%1!=0 || yearNum%1!=0 || monthNum<1 || monthNum>12 ){
		return false;
	}

	var d = new Date(yearNum, monthNum, 0);
	return d.getDate();
}



