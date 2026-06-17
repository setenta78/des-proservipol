function cambiarClase(objeto, clase){
	objeto.className = clase;
}

function actualizarTamanoLista2(idObjeto){
	
	//alert(document.getElementById(idObjeto).style.height);
	if (/MSIE 6.0/i.test(navigator.userAgent)) var valorRestar = 340;
	else var valorRestar = 300;
	
	var tamanoPantalla 	= window.document.body.parentNode.offsetHeight;
	var altura 			= tamanoPantalla - valorRestar;
				
	document.getElementById(idObjeto).style.height= altura+"px";
}


function cerrarAplicacion(){
		var caduca=new Date(); 
		//setCookie('USUARIO_NOMBRE','',caduca);          
		//alert();
		//setCookie('USUARIO_CODIGOFUNCIONARIO','',caduca);
		//setCookie('USUARIO_DESCRIPCIONUNIDAD','',caduca);
		//
		////window.document.write = "unset($_COOKIE['USUARIO_UNIDAD'])";
		//alert();
		window.location.replace("logout.php");
}


function abrirVentana(titulo, ancho, alto, pagina, nroLinea, estado, posX, posY){
		
		var win = new Window({className	  : "mac_os_x", 
							  title		  : titulo, 
							  width		  : ancho, 
							  height	  : alto, 
							  top		  : posX,
							  left		  : posY,
							  minimizable : false, 
							  maximizable : false,
							  closable	  : false,
							  draggable	  : true,
							  resizable	  : false,
							  url		  : pagina}); 

		//showEffect  : Effect.Appear, 							  
		//hideEffect  : Effect.Fade,							  
							  
    	//win.getContent().update("<h1>Listado con Todos los Indicadores </h1>");
    	//win.getContent().innerHTML = "../descripcionIndicadores.php"}); 
    	//win.showCenter(estado);    
    	//win.showCenter(true);    
    	//win.showModal();
    	win.show(estado); 
    	//win.setStatusBar('Cargando ... '); 
    	
    	//var oldClase = document.getElementById(nroLinea).className;
		//if (nroLinea != "") {
		//	document.getElementById(nroLinea).className  = "lineaDatos1Click";
		//	document.getElementById(nroLinea).onmouseout = "";
		//}
}



function cerrarVentana(){
	Windows.closeAll();
	return true;
}



function buscaUnidades(codigoPadre)
{

      document.getElementById("btnCargaDatos").disabled=true;
      document.getElementById("selUnidad").disabled=true;
      document.getElementById("selMes").disabled=true;
      document.getElementById("selAnno").disabled=true;


      document.getElementById("selUnidad").options[0] = new Option("CARGANDO ...","0","","");

      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./xml/xmlUnidades/xmlUnidades.php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("codigoUnidad="+codigoPadre);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {
        	if (objHttpXMLCargaDatos.responseText != "VACIO")
        	{
            var xml 			 = objHttpXMLCargaDatos.responseXML.documentElement;
            //var xml 			 = objHttpXMLCargaDatos.responseText;
            //alert(xml);

            var codigoUnidad;
            var descripcionUnidad;

            for(i=0;i<xml.getElementsByTagName('codigoUnidad').length;i++)
            {
              codigoUnidad      = xml.getElementsByTagName('codigoUnidad')[i].text;
              descripcionUnidad = xml.getElementsByTagName('descripcionUnidad')[i].text;
              document.getElementById("selUnidad").options[i] = new Option(descripcionUnidad,codigoUnidad,"","");
            }
            
            document.getElementById("btnCargaDatos").disabled=false;
            document.getElementById("selUnidad").disabled=false;
            document.getElementById("selMes").disabled=false;
            document.getElementById("selAnno").disabled=false;
            
          }
          else
          {
          				alert("PROBLEMAS CON LA BASE DE DATOS.  CODIGO UNIDAD.");
          }


        }
        
      }

}



function verificaIngresoDatos(mes,anno,unidad)
{
    if (unidad==0)
    {
        alert("DEBE SELECCIONAR UNIDAD.");
        document.getElementById("selUnidad").focus();
    }

    //alert(unidad);
    else if (mes==0)
    {
        alert("DEBE SELECCIONAR MES.");
        document.getElementById("selMes").focus();
    }

    else if(anno==0)
    {
        alert("DEBE SELECCINAR AÑO.");
        document.getElementById("selAnno").focus();
    }

    else
    {
        iniciaCargaDatos(mes,anno,unidad);
    }
    

}






function iniciaCargaDatos(mes,anno,unidad)
{
        document.getElementById("btnCargaDatos").disabled=true;
        document.getElementById("selUnidad").disabled=true;
        document.getElementById("selMes").disabled=true;
        document.getElementById("selAnno").disabled=true;

      var div=document.getElementById("listadoIngresoServicios");

      div.innerHTML="<img src='./certificacionServicio/img/loading1.gif'> CARGANDO ...";


      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./certificacionServicio/baseDatos/dbCertificacionServicio.php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("mes="+mes+"&anno="+anno+"&unidad="+unidad);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {
            var xml 			 = objHttpXMLCargaDatos.responseXML.documentElement;
            //var xml 			 = objHttpXMLCargaDatos.responseText;
            //alert(objHttpXMLCargaDatos.responseText);

    var listadoCargaDatos = "";
    var sw 				 = 0;
    var fondoLinea		 = "";
    var resaltarLinea 	 = "";
    var lineaSinResaltar = "";

            listadoCargaDatos = "";
            sw 				 = 0;
            fondoLinea		 = "";
            resaltarLinea 	 = "";
            lineaSinResaltar = "";

            descripcionUnidad = "";

            descripcionUnidad      = xml.getElementsByTagName('descripcionUnidad')[0].text;

            for(i=0;i<xml.getElementsByTagName('certificado').length;i++)
            {
              if (sw==0) {fondoLinea = "linea1";sw =1}
              else {fondoLinea = "linea2";sw=0}

              resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
              lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";

              fechaServicios      = xml.getElementsByTagName('fechaServicios')[i].text;
              estado              = xml.getElementsByTagName('estado')[i].text;
              grado               = xml.getElementsByTagName('grado')[i].text;
              nombre              = xml.getElementsByTagName('nombre')[i].text;
              apellidoPaterno     = xml.getElementsByTagName('apellidoPaterno')[i].text;
              apellidoMaterno     = xml.getElementsByTagName('apellidoMaterno')[i].text;
              fechaCertificado    = xml.getElementsByTagName('fechaCertificado')[i].text;

              nombreValidador ="";
              
              nombreValidador = grado+" "+nombre+" "+apellidoPaterno+" "+apellidoMaterno;
              
//alert(mes);
              listadoCargaDatos += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:abrirVentana('','990','500','./certificacionServicio/fichaCertificacionServicio.php?unidadServicios="+unidad+"&fechaServicios="+fechaServicios+"&descripcionUnidad="+descripcionUnidad+"','','','5','5')\">";

              listadoCargaDatos += "<td width='24%'  align='center'><div id='valorColumna'>"+descripcionUnidad+"</div></td>";
              listadoCargaDatos += "<td width='12%'  align='center'><div id='valorColumna'>"+fechaServicios+"</div></td>";
              listadoCargaDatos += "<td width='12%'  align='center'><div id='valorColumna'>"+estado+"</div></td>";
              listadoCargaDatos += "<td width='38%' align='center'><div id='valorColumna'>"+nombreValidador+"</div></td>";
              listadoCargaDatos += "<td width='14%' align='center'><div id='valorColumna'>"+fechaCertificado+"</div></td>";
        
        
              listadoCargaDatos += "</tr>";
              
              
            }

            div.innerHTML= "<table width='100%' cellspacing='1' cellpadding='1'>"+listadoCargaDatos+"</table>";


            document.getElementById("selMes").value=0;
            document.getElementById("selAnno").value=0;

            document.getElementById("btnCargaDatos").disabled=false;

            document.getElementById("selMes").disabled=false;
            document.getElementById("selAnno").disabled=false;
            document.getElementById("selUnidad").disabled=false;
            
        }
        
      }

}







