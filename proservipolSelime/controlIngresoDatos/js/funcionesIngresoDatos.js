var arregloUnidades;


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








				var listadoCargaDatos = "";
				var sw 				 = 0;
				var fondoLinea		 = "";
				var resaltarLinea 	 = "";
				var lineaSinResaltar = "";

				var textoLayerIngresoServicios = "";

function verificaIngresoDatos(mes,anno,tabla)
{

    document.getElementById("textFecha").innerHTML="&nbsp;";
    document.getElementById("textSubMenu").innerHTML="&nbsp;";

    if (tabla==0)
    {
        alert("Debe seleccionar Consulta");
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

        //document.getElementById("CerrarSesion").disabled=true;


        document.getElementById("selTabla").disabled=true;
        document.getElementById("selMes").disabled=true;
        document.getElementById("selAnno").disabled=true;


        document.getElementById("layerIngresoServicios").style.visibility = "visible";

        document.getElementById("layerUnidadesIngresoServicios").style.visibility = "hidden";
        
        document.getElementById("btnExcelDatos").style.visibility="hidden";

        document.getElementById("horaSubMenu").innerHTML="&nbsp;";

        document.getElementById("mesForm").value=mes;
        document.getElementById("annoForm").value=anno;



        document.getElementById("textFecha").innerHTML="<img src='./controlIngresoDatos/img/loading1.gif'> CARGANDO ...";

				listadoCargaDatos = "";
				sw 				 = 0;
				fondoLinea		 = "";
				resaltarLinea 	 = "";
				lineaSinResaltar = "";

        document.getElementById("listadoIngresoServicios").innerHTML="&nbsp;";
        
        arregloUnidades = new Array();



        if(tabla=="ProservipolSinServicios")
        {
        textoLayerIngresoServicios = "<b>CANTIDAD UNIDADES SIN INGRESO DE SERVICIOS : "+document.getElementById("selMes").options[document.getElementById("selMes").selectedIndex].text+" DE "+document.getElementById("selAnno").value+"</b>";

        document.getElementById("selTabla").value=0;
        document.getElementById("selMes").value=0;
        document.getElementById("selAnno").value=0;

        document.getElementById("textSubMenu").innerHTML = textoLayerIngresoServicios;

        iniciaCargaDatos(01,mes,anno,tabla,daysInMonth(mes,anno));

        }


        else if(tabla=="RRCCSinReuniones")
        {
        textoLayerIngresoServicios = "<b>CANTIDAD UNIDADES SIN INGRESO DE REUNIONES : "+document.getElementById("selMes").options[document.getElementById("selMes").selectedIndex].text+" DE "+document.getElementById("selAnno").value+"</b>";

        document.getElementById("selTabla").value=0;
        document.getElementById("selMes").value=0;
        document.getElementById("selAnno").value=0;

        document.getElementById("textSubMenu").innerHTML = textoLayerIngresoServicios;

        iniciaCargaDatosRRCC(mes,anno,tabla);

        }

    }
}





function iniciaCargaDatos(dia,mes,anno,tabla,diasMes)
{
      arregloUnidades[dia-1]     = new Array();

      var div=document.getElementById("listadoIngresoServicios");

      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./controlIngresoDatos/baseDatos/dbControlDatos"+tabla+".php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("dia="+dia+"&mes="+mes+"&anno="+anno);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {       
            var xml 			 = objHttpXMLCargaDatos.responseXML.documentElement;
            //alert(xml);


            if (sw==0) {fondoLinea = "linea1";sw =1}
            else {fondoLinea = "linea2";sw=0}

            resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
            lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";

            var codigoUnidad  = "";


            if(dia==01)
            {
                var hora  = "";
                hora = xml.getElementsByTagName('hora')[0].text;
                
                document.getElementById("horaForm").value=hora;
                document.getElementById("horaSubMenu").innerHTML="<b>FECHA INFORME : "+hora+"</b>";
            }

            for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
            {

              codigoUnidad      = xml.getElementsByTagName('codigoUnidad')[i].text;

              arregloUnidades[dia-1][i] = codigoUnidad;

            }


            listadoCargaDatos += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:muestraUnidadesSinIngreso('"+dia+"','"+mes+"','"+anno+"')\">";

            listadoCargaDatos += "<td width='20%'  align='center'><div id='valorColumna'>PROSERVIPOL</div></td>";
            listadoCargaDatos += "<td width='20%'  align='center'><div id='valorColumna'>"+dia+"-"+mes+"-"+anno+"</div></td>";
            listadoCargaDatos += "<td width='30%' align='center'><div id='valorColumna'>"+arregloUnidades[dia-1].length+"</div></td>";
            listadoCargaDatos += "<td width='30%' align='center'><div id='valorColumna'>&nbsp;</div></td>";
            listadoCargaDatos += "</tr>";        

            div.innerHTML= "<table width='100%' cellspacing='1' cellpadding='1'>"+listadoCargaDatos+"</table>";


            if(dia<diasMes)
            //if(dia<03)
            {
                iniciaCargaDatos(dia+1,mes,anno,tabla,diasMes)
            }
            
            else
            {

                document.getElementById("textFecha").innerHTML="&nbsp;";

                document.getElementById("btnCargaDatos").disabled=false;
                //document.getElementById("CerrarSesion").disabled=false;
                document.getElementById("selTabla").disabled=false;
                document.getElementById("selMes").disabled=false;
                document.getElementById("selAnno").disabled=false;
                
                
                
                document.getElementById("arregloUnidadesForm").value=php_serialize(arregloUnidades);

                document.getElementById("excelForm").action="./controlIngresoDatos/baseDatos/excelProservipolUnidadesSinServicios.php";

                document.getElementById("btnExcelDatos").style.visibility="visible";
                
            }
            
       
        }
        
      }

}


function iniciaCargaDatosRRCC(mes,anno,tabla)
{
      arregloUnidades[0]     = new Array();
      
      var div=document.getElementById("listadoIngresoServicios");

      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./controlIngresoDatos/baseDatos/dbControlDatos"+tabla+".php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("mes="+mes+"&anno="+anno);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {       

            var xml 			 = objHttpXMLCargaDatos.responseXML.documentElement;
            //alert(xml);


            if (sw==0) {fondoLinea = "linea1";sw =1}
            else {fondoLinea = "linea2";sw=0}

            resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
            lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";

            var codigoUnidad  = "";

            var hora  = "";

            hora = xml.getElementsByTagName('hora')[0].text;

            document.getElementById("horaForm").value=hora;
            document.getElementById("horaSubMenu").innerHTML="<b>FECHA INFORME : "+hora+"</b>";



            for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
            {

              codigoUnidad      = xml.getElementsByTagName('codigoUnidad')[i].text;
              arregloUnidades[0][i] = codigoUnidad;
            }


          listadoCargaDatos += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:muestraUnidadesSinIngresoRRCC('"+mes+"','"+anno+"')\">";

          listadoCargaDatos += "<td width='20%'  align='center'><div id='valorColumna'>RRCC</div></td>";
          listadoCargaDatos += "<td width='20%'  align='center'><div id='valorColumna'>"+mes+"-"+anno+"</div></td>";
          listadoCargaDatos += "<td width='30%' align='center'><div id='valorColumna'>"+arregloUnidades[0].length+"</div></td>";
          listadoCargaDatos += "<td width='30%' align='center'><div id='valorColumna'>&nbsp;</div></td>";
          listadoCargaDatos += "</tr>";          

          div.innerHTML= "<table width='100%' cellspacing='1' cellpadding='1'>"+listadoCargaDatos+"</table>";


                document.getElementById("textFecha").innerHTML="&nbsp;";

                document.getElementById("btnCargaDatos").disabled=false;
                //document.getElementById("CerrarSesion").disabled=false;
                document.getElementById("selTabla").disabled=false;
                document.getElementById("selMes").disabled=false;
                document.getElementById("selAnno").disabled=false;

                
                document.getElementById("arregloUnidadesForm").value=php_serialize(arregloUnidades);

                document.getElementById("excelForm").action="./controlIngresoDatos/baseDatos/excelRRCCUnidadesSinReuniones.php";

                document.getElementById("btnExcelDatos").style.visibility="visible";

        }
        
      }
}



function muestraUnidadesSinIngreso(dia,mes,anno)
{


if(document.getElementById("btnCargaDatos").disabled==false && arregloUnidades[dia-1].length>0)
{

        document.getElementById("layerIngresoServicios").style.visibility = "hidden";

        document.getElementById("layerUnidadesIngresoServicios").style.visibility = "visible";

        document.getElementById("btnCargaDatos").disabled=true;

        //document.getElementById("CerrarSesion").disabled=true;

        document.getElementById("selTabla").disabled=true;
        document.getElementById("selMes").disabled=true;
        document.getElementById("selAnno").disabled=true;

        document.getElementById("textFecha").innerHTML="<img src='./controlIngresoDatos/img/loading1.gif'> CARGANDO ...";

        document.getElementById("textSubMenu").innerHTML = "<b>UNIDADES SIN INGRESO DE SERVICIOS : "+dia+"-"+mes+"-"+anno+"</b>";

        document.getElementById("selTabla").value=0;
        document.getElementById("selMes").value=0;
        document.getElementById("selAnno").value=0;



      var div=document.getElementById("listadoUnidadesIngresoServicios");
      div.innerHTML="&nbsp;";

      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./controlIngresoDatos/baseDatos/xmlProservipolUnidadesSinServicios.php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("arregloUnidades="+arregloUnidades[dia-1]);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {       

           var xml 			 = objHttpXMLCargaDatos.responseXML.documentElement;
           //div.innerHTML 			 = objHttpXMLCargaDatos.responseText;

           //alert(xml);

          listadoCargaDatos = "";
          sw 				 = 0;
          fondoLinea		 = "";

          var nombreZona       = "";
          var nombrePrefectura = "";
          var nombreComisaria  = "";
          var nombreUnidad     = "";


          for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
          {

              if (sw==0) {fondoLinea = "linea1";sw =1}
              else {fondoLinea = "linea2";sw=0}

              nombreZona        = xml.getElementsByTagName('nombreZona')[i].text;
              nombrePrefectura  = xml.getElementsByTagName('nombrePrefectura')[i].text;
              nombreComisaria   = xml.getElementsByTagName('nombreComisaria')[i].text;
              nombreUnidad      = xml.getElementsByTagName('nombreUnidad')[i].text;


              listadoCargaDatos += "<tr class='"+fondoLinea+"'>";

              listadoCargaDatos += "<td width='25%'  align='center'><div id='valorColumna'>"+nombreZona+"</div></td>";
              listadoCargaDatos += "<td width='25%'  align='center'><div id='valorColumna'>"+nombrePrefectura+"</div></td>";

/*              listadoCargaDatos += "<td width='25%' align='center'><div id='valorColumna'>"+nombreComisaria+"</div></td>";
              listadoCargaDatos += "<td width='25%' align='center'><div id='valorColumna'>"+nombreUnidad+"</div></td>";*/

              listadoCargaDatos += "<td width='50%' align='center'><div id='valorColumna'>"+nombreUnidad+"</div></td>";
              listadoCargaDatos += "</tr>";          

          }

          div.innerHTML= "<table width='100%' cellspacing='1' cellpadding='1'>"+listadoCargaDatos+"</table>";

          //document.getElementById("textFecha").innerHTML="&nbsp;";

          document.getElementById("textFecha").innerHTML="<a onclick=\"javascript:muestraLayer('layerIngresoServicios')\"><b><< VOLVER</b></a>";

          document.getElementById("btnCargaDatos").disabled=false;
          //document.getElementById("CerrarSesion").disabled=false;
          document.getElementById("selTabla").disabled=false;
          document.getElementById("selMes").disabled=false;
          document.getElementById("selAnno").disabled=false;



        }
        
      }
}
}








function muestraUnidadesSinIngresoRRCC(mes,anno)
{
if(document.getElementById("btnCargaDatos").disabled==false && arregloUnidades[0].length>0)
{

        document.getElementById("layerIngresoServicios").style.visibility = "hidden";

        document.getElementById("layerUnidadesIngresoServicios").style.visibility = "visible";

        document.getElementById("btnCargaDatos").disabled=true;

        //document.getElementById("CerrarSesion").disabled=true;

        document.getElementById("selTabla").disabled=true;
        document.getElementById("selMes").disabled=true;
        document.getElementById("selAnno").disabled=true;

        document.getElementById("textFecha").innerHTML="<img src='./controlIngresoDatos/img/loading1.gif'> CARGANDO ...";

        document.getElementById("textSubMenu").innerHTML = "<b>UNIDADES SIN INGRESO DE REUNIONES : "+mes+"-"+anno+"</b>";

        document.getElementById("selTabla").value=0;
        document.getElementById("selMes").value=0;
        document.getElementById("selAnno").value=0;



      var div=document.getElementById("listadoUnidadesIngresoServicios");
      div.innerHTML="&nbsp;";

      var objHttpXMLCargaDatos = new AJAXCrearObjeto();
      
      objHttpXMLCargaDatos.open("POST","./controlIngresoDatos/baseDatos/xmlRRCCUnidadesSinReuniones.php",true);

      objHttpXMLCargaDatos.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
      objHttpXMLCargaDatos.send("arregloUnidades="+arregloUnidades[0]);

      objHttpXMLCargaDatos.onreadystatechange=function()
      {
        if(objHttpXMLCargaDatos.readyState == 4)
        {       
            var xml 			 = objHttpXMLCargaDatos.responseXML.documentElement;
            //var xml 			 = objHttpXMLCargaDatos.responseText;

            //alert(xml);

          listadoCargaDatos = "";
          sw 				 = 0;
          fondoLinea		 = "";

				var nombreZona       = "";
				var nombrePrefectura = "";
				var nombreComisaria  = "";
				var nombreUnidad     = "";


				for(i=0;i<xml.getElementsByTagName('unidad').length;i++)
				{

          if (sw==0) {fondoLinea = "linea1";sw =1}
          else {fondoLinea = "linea2";sw=0}

          nombreZona        = xml.getElementsByTagName('nombreZona')[i].text;
          nombrePrefectura  = xml.getElementsByTagName('nombrePrefectura')[i].text;
          nombreComisaria   = xml.getElementsByTagName('nombreComisaria')[i].text;
          nombreUnidad      = xml.getElementsByTagName('nombreUnidad')[i].text;


          listadoCargaDatos += "<tr class='"+fondoLinea+"'>";

          listadoCargaDatos += "<td width='25%'  align='center'><div id='valorColumna'>"+nombreZona+"</div></td>";
          listadoCargaDatos += "<td width='25%'  align='center'><div id='valorColumna'>"+nombrePrefectura+"</div></td>";
          listadoCargaDatos += "<td width='25%' align='center'><div id='valorColumna'>"+nombreComisaria+"</div></td>";
          listadoCargaDatos += "<td width='25%' align='center'><div id='valorColumna'>"+nombreUnidad+"</div></td>";
          listadoCargaDatos += "</tr>";          

        }

          div.innerHTML= "<table width='100%' cellspacing='1' cellpadding='1'>"+listadoCargaDatos+"</table>";


                //document.getElementById("textFecha").innerHTML="&nbsp;";

                document.getElementById("textFecha").innerHTML="<a onclick=\"javascript:muestraLayer('layerIngresoServicios')\"><b><< VOLVER</b></a>";

                document.getElementById("btnCargaDatos").disabled=false;
                //document.getElementById("CerrarSesion").disabled=false;
                document.getElementById("selTabla").disabled=false;
                document.getElementById("selMes").disabled=false;
                document.getElementById("selAnno").disabled=false;


        }
        
      }
}
}

function muestraLayer(nombreLayer)
{
  document.getElementById("layerIngresoServicios").style.visibility = "hidden";
  document.getElementById("layerUnidadesIngresoServicios").style.visibility = "hidden";



  document.getElementById(nombreLayer).style.visibility = "visible";
  document.getElementById("textFecha").innerHTML="&nbsp;";
  document.getElementById("textSubMenu").innerHTML=textoLayerIngresoServicios;
}


function php_serialize(obj)
{
    var string = '';

    if (typeof(obj) == 'object') {
        if (obj instanceof Array) {
            string = 'a:';
            tmpstring = '';
            var count = 0;
            //for (var key in obj) {
            //    tmpstring += php_serialize(key);
            //    tmpstring += php_serialize(obj[key]);
            //    count++;
            //}
            //count = obj.length; 
            //alert(count);
            for (var key=0; key<obj.length; key++) {
                tmpstring += php_serialize(key);
                tmpstring += php_serialize(obj[key]);
                count++;
            }
            
            string += count + ':{';
            string += tmpstring;
            string += '}';
        } else if (obj instanceof Object) {
            classname = obj.toString();

            if (classname == '[object Object]') {
                classname = 'StdClass';
            }

            string = 'O:' + classname.length + ':"' + classname + '":';
            tmpstring = '';
            count = 0;
            for (var key in obj) {
                tmpstring += php_serialize(key);
                if (obj[key]) {
                    tmpstring += php_serialize(obj[key]);
                } else {
                    tmpstring += php_serialize('');
                }
                count++;
            }
            string += count + ':{' + tmpstring + '}';
        }
    } else {
        switch (typeof(obj)) {
            case 'number':
                if (obj - Math.floor(obj) != 0) {
                    string += 'd:' + obj + ';';
                } else {
                    string += 'i:' + obj + ';';
                }
                break;
            case 'string':
                string += 's:' + obj.length + ':"' + obj + '";';
                break;
            case 'boolean':
                if (obj) {
                    string += 'b:1;';
                } else {
                    string += 'b:0;';
                }
                break;
        }
    }

    return string;
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



