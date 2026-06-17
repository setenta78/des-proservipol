var unidadConsulta;
var padreConsulta;
var moduloConsulta;


function actualizarTamanoLista2(idObjeto){
	
	//alert(document.getElementById(idObjeto).style.height);
	if (/MSIE 6.0/i.test(navigator.userAgent)) var valorRestar = 340;
	else var valorRestar = 300;
	
	var tamanoPantalla 	= window.document.body.parentNode.offsetHeight;
	var altura 			= tamanoPantalla - valorRestar;
				
	document.getElementById(idObjeto).style.height= altura+"px";
}


function abrirVentana(pagina){

		var win = new Window({
                className	  : "mac_os_x", 
							  title		    : 'USUARIO ...', 
							  width		    : '800',
							  height	    : '326', 
							  top		      : '5',
							  left		    : '5',
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
    	win.show(); 
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


function cambiarClase(objeto, clase){
	objeto.className = clase;
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



function actualizarListarUsuarios()
{
    listarUsuarios(unidadConsulta,padreConsulta,moduloConsulta);
}

function limpiarLista()
{
    document.getElementById("labelUnidad").innerHTML      = "&nbsp;";
    document.getElementById("listadoUsuarios").innerHTML  = "";
}


function listarUsuarios(unidad,padre,modulo)
{

  unidadConsulta      = unidad;
  padreConsulta       = padre;
  moduloConsulta      = modulo;

  //alert("unidad:"+unidad+"|padre:"+padre+"|modulo:"+modulo)

	var div	= document.getElementById("listadoUsuarios");

	div.innerHTML="<br><img src='./moduloUsuarios/imagenes/loading2.gif'> CARGANDO ...";

	var objHttpXMLFuncionarios = new AJAXCrearObjeto();
		
	objHttpXMLFuncionarios.open("POST","./moduloUsuarios/xml/xmlUsuarios.php",true);

	objHttpXMLFuncionarios.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

	objHttpXMLFuncionarios.send("unidad="+unidad+"&padre="+padre+"&modulo="+modulo);

		
	objHttpXMLFuncionarios.onreadystatechange=function()
	{
		if(objHttpXMLFuncionarios.readyState == 4)
		{       
        if (objHttpXMLFuncionarios.responseText != "VACIO"){
				
				var xml                   = objHttpXMLFuncionarios.responseXML.documentElement;
				//var xml                   = objHttpXMLFuncionarios.responseText;
        //alert(xml);

        var codigo                =  "";
        var descGrado             =  "";
        var apellidoPaterno       =  "";
        var apellifoMaterno       =  "";
        var primerNombre          =  "";
        var usuarioModulo         =  "";
        var usuarioFechaDesde1    =  "";
        var usuarioTipo1          =  "";



				var listadoUsuariosUnidad = "";
				
				var sw 				 = 0;
				var fondoLinea		 = "";
				var resaltarLinea 	 = "";
				var lineaSinResaltar = "";

				
				listadoUsuariosUnidad = "<table width='100%' cellspacing='1' cellpadding='1'>";


				for(i=0;i<xml.getElementsByTagName('funcionario').length;i++)
				{


					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					
					codigo	 		  		    = xml.getElementsByTagName('codigo')[i].text;
					descGrado		 	  		  = xml.getElementsByTagName('descGrado')[i].text;
					apellidoPaterno	  		= xml.getElementsByTagName('apellidoPaterno')[i].text;
					apellifoMaterno   		= xml.getElementsByTagName('apellidoMaterno')[i].text;
					primerNombre 	  		  = xml.getElementsByTagName('nombre')[i].text;
          usuarioModulo         = xml.getElementsByTagName('usuarioModulo')[i].text;
					usuarioFechaDesde1 		= xml.getElementsByTagName('usuarioFechaDesde1')[i].text;
					usuarioTipo1          = xml.getElementsByTagName('usuarioTipo1')[i].text;


					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";


					listadoUsuariosUnidad += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:abrirVentana('./moduloUsuarios/fichaFuncionario.php?codigo="+codigo+"')\">";

					listadoUsuariosUnidad += "<td width='5%' align='center'><div id='valorColumna'>"+(i+1)+"</div></td>";
					listadoUsuariosUnidad += "<td width='9%' align='center'><div id='valorColumna'>"+codigo+"</div></td>";
					listadoUsuariosUnidad += "<td width='13%' align='center'><div id='valorColumna'>"+descGrado+"</div></td>";
					listadoUsuariosUnidad += "<td width='23%' align='center'><div id='valorColumna'>"+primerNombre+" "+apellidoPaterno+" "+apellifoMaterno+"</div></td>";
					listadoUsuariosUnidad += "<td width='15%' align='center'><div id='valorColumna'>"+usuarioModulo+"</div></td>";
					listadoUsuariosUnidad += "<td width='23%' align='center'><div id='valorColumna'>"+usuarioTipo1+"</div></td>";
					listadoUsuariosUnidad += "<td width='12%' align='center'><div id='valorColumna'>"+usuarioFechaDesde1+"</div></td>";

					listadoUsuariosUnidad += "</tr>";


				}


				listadoUsuariosUnidad += "</table>";
				div.innerHTML= listadoUsuariosUnidad;

								
    }


    else{

    alert("NO EXISTEN USUARIO PARA LA CONSULTA REALIZADA");

    div.innerHTML="";
    
    }

	
			

		}
	}


}



























