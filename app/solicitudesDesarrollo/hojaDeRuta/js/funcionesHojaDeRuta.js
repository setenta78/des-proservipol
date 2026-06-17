function ocultarFondo(){
  document.getElementById('fondo').style.visibility = "visible";
}

function mostrarFondo(){
  document.getElementById('fondo').style.visibility = "hidden";
}




function cambiarClase(objeto, clase){
	objeto.className = clase;
}

function cerrarVentana(){
top.cerrarVentana();
}


var arregloAnotaciones = new Array();
var idAnotaciones = 0;

var indiceAnotacion = -1;


function limpiaAnotacion(){

document.getElementById("textHoraInicioAnotacion").value="";
document.getElementById("textMinutoInicioAnotacion").value="";
document.getElementById("textHoraTerminoAnotacion").value="";
document.getElementById("textMinutoTerminoAnotacion").value="";
document.getElementById("cuadranteAnotacion").value="";

document.getElementById("selFactorAnotacion").value = 0;
document.getElementById("selFactorAnotacion").focus();


  document.getElementById("BotonEliminarAnotacion").disabled    = true;
  indiceAnotacion = -1;

document.getElementById("textLabelOtraUnidad").innerHTML= "";
document.getElementById("labelOtraUnidad").disabled=true;
document.getElementById("BotonMuestraArbolUnidad").disabled = true;

padreActual=0;
nombreOtraUnidad="";
otroCuadrante=0;
descripcionOtroCuadrante="";

}



function guardaAnotacion(){


var factorAnotacion = document.getElementById("selFactorAnotacion").value;

var horaInicioAnotacion = document.getElementById("textHoraInicioAnotacion").value;
var minutoInicioAnotacion = document.getElementById("textMinutoInicioAnotacion").value;

var horaTerminoAnotacion = document.getElementById("textHoraTerminoAnotacion").value;
var minutoTerminoAnotacion = document.getElementById("textMinutoTerminoAnotacion").value;

var cuadranteAnotacion = document.getElementById("cuadranteAnotacion").value;


if (factorAnotacion == 0)
{
  alert("Debe indicar FACTOR");
  document.getElementById("selFactorAnotacion").focus();
}


else if (!validaHoraDividida(horaInicioAnotacion,minutoInicioAnotacion))
{
  alert("Debe ingresar HORA INICIO válida hh:mm (00:00 - 23:59)");
  document.getElementById("textHoraInicioAnotacion").value="";
  document.getElementById("textMinutoInicioAnotacion").value="";
  document.getElementById("textHoraInicioAnotacion").focus();
}


else if (!validaHoraDividida(horaTerminoAnotacion,minutoTerminoAnotacion))
{
  alert("Debe ingresar HORA TERMINO válida hh:mm (00:00 - 23:59)");
  document.getElementById("textHoraTerminoAnotacion").value="";
  document.getElementById("textMinutoTerminoAnotacion").value="";
  document.getElementById("textHoraTerminoAnotacion").focus();
}


else if (cuadranteAnotacion==0)
{
  alert("Debe seleccionar CUADRANTE");
  document.getElementById("cuadranteAnotacion").focus();
}


else if (cuadranteAnotacion==-1 && otroCuadrante==0)
{
  alert("Debe ingresar OTRA UNIDAD");
  document.getElementById("BotonMuestraArbolUnidad").focus();
}

else
{

var descripcionfactorAnotacion    = document.getElementById("selFactorAnotacion").options[document.getElementById("selFactorAnotacion").selectedIndex].text;
var descripcionCuadranteAnotacion = document.getElementById("cuadranteAnotacion").options[document.getElementById("cuadranteAnotacion").selectedIndex].text;



  if(cuadranteAnotacion==-1)
  {
          if(otroCuadrante==-2)
          {  
              if(indiceAnotacion > -1)
              {
                arregloAnotaciones[indiceAnotacion] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,"NULL",padreActual,descripcionfactorAnotacion,document.getElementById("textLabelOtraUnidad").innerHTML,1);
              }

              else
              {
                arregloAnotaciones[arregloAnotaciones.length] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,"NULL",padreActual,descripcionfactorAnotacion,document.getElementById("textLabelOtraUnidad").innerHTML,1);
              }
          } 

          else
          {  
              if(indiceAnotacion > -1)
              {
                arregloAnotaciones[indiceAnotacion] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,otroCuadrante,padreActual,descripcionfactorAnotacion,document.getElementById("textLabelOtraUnidad").innerHTML,1);
              }

              else
              {
                arregloAnotaciones[arregloAnotaciones.length] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,otroCuadrante,padreActual,descripcionfactorAnotacion,document.getElementById("textLabelOtraUnidad").innerHTML,1);
              }
          } 
  }


  else if(cuadranteAnotacion==-2)
  {

          if(indiceAnotacion > -1)
          {
            arregloAnotaciones[indiceAnotacion] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,"NULL","NULL",descripcionfactorAnotacion,descripcionCuadranteAnotacion,0);
          }

          else
          {
            arregloAnotaciones[arregloAnotaciones.length] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,"NULL","NULL",descripcionfactorAnotacion,descripcionCuadranteAnotacion,0);
          }
  }



  else
  {
          if(indiceAnotacion > -1)
          {
            arregloAnotaciones[indiceAnotacion] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,cuadranteAnotacion,"NULL",descripcionfactorAnotacion,"CUADRANTE "+descripcionCuadranteAnotacion,0);
          }

          else
          {
            arregloAnotaciones[arregloAnotaciones.length] = new Array(factorAnotacion,horaInicioAnotacion,minutoInicioAnotacion,horaTerminoAnotacion,minutoTerminoAnotacion,cuadranteAnotacion,"NULL",descripcionfactorAnotacion,"CUADRANTE "+descripcionCuadranteAnotacion,0);
          }
  }



  limpiaAnotacion();
  //alert(arregloAnotaciones[arregloAnotaciones.length-1]);
  
  indiceAnotacion = -1;
  
  document.getElementById("BotonEliminarAnotacion").disabled    = true;

  muestraAnotaciones();



}

}


function muestraAnotaciones(){

var div	= document.getElementById("listadoAnotacion");
div.innerHTML = "";

//div.innerHTML="<img src='../../imagenes/loading2.gif'> Cargando ...";


        var listaAnotaciones = "";


				var sw 				 = 0;
				var fondoLinea		 = "";
				var resaltarLinea 	 = "";
				var lineaSinResaltar = "";

				
				listaAnotaciones = "<table width='100%' cellspacing='1' cellpadding='1'>";


				for(i=0;i<arregloAnotaciones.length;i++)
				{


          var contadorAnotacion=i+1;

					if (sw==0) {fondoLinea = "linea1";sw =1}
					else {fondoLinea = "linea2";sw=0}
					

					resaltarLinea 	 = "cambiarClase(this, 'lineaMarcada')";
					lineaSinResaltar = "cambiarClase(this, '"+fondoLinea+"')";


					listaAnotaciones += "<tr OnMouseOver=\""+resaltarLinea+"\" OnMouseOut=\""+lineaSinResaltar+"\" class='"+fondoLinea+"' ondblclick=\"javascript:modificaAnotacion('"+i+"')\">";

					listaAnotaciones += "<td width='5%' align='center'><div id='valorColumna'>"+contadorAnotacion+"</div></td>";
					listaAnotaciones += "<td width='25%' align='center'><div id='valorColumna'>"+arregloAnotaciones[i][7]+"</div></td>";
					
					listaAnotaciones += "<td width='15%' align='center'><div id='valorColumna'>"+arregloAnotaciones[i][1]+" : "+arregloAnotaciones[i][2]+"</div></td>";
					listaAnotaciones += "<td width='15%' align='center'><div id='valorColumna'>"+arregloAnotaciones[i][3]+" : "+arregloAnotaciones[i][4]+"</div></td>";
					listaAnotaciones += "<td width='40%' align='center'><div id='valorColumna'>"+arregloAnotaciones[i][8]+"</div></td>";

					listaAnotaciones += "</tr>";


				}


				listaAnotaciones += "</table>";
				div.innerHTML= listaAnotaciones;

}




function modificaAnotacion(indice){

limpiaAnotacion();
document.getElementById("textHoraInicioAnotacion").value    = arregloAnotaciones[indice][1];
document.getElementById("textMinutoInicioAnotacion").value  = arregloAnotaciones[indice][2];
document.getElementById("textHoraTerminoAnotacion").value   = arregloAnotaciones[indice][3];
document.getElementById("textMinutoTerminoAnotacion").value = arregloAnotaciones[indice][4];

document.getElementById("selFactorAnotacion").value         = arregloAnotaciones[indice][0];
document.getElementById("selFactorAnotacion").focus();


    if(arregloAnotaciones[indice][9] == 0)
    {
        if(arregloAnotaciones[indice][5]=="NULL")
        {
            document.getElementById("cuadranteAnotacion").value = -2;
        }
        
        else
        {
            document.getElementById("cuadranteAnotacion").value = arregloAnotaciones[indice][5];
        }


    }

    else
    {
        document.getElementById("cuadranteAnotacion").value     = -1;

        document.getElementById("labelOtraUnidad").disabled = false;
        document.getElementById("BotonMuestraArbolUnidad").disabled = false;

        document.getElementById("textLabelOtraUnidad").innerHTML = arregloAnotaciones[indice][8];


        if(arregloAnotaciones[indice][5]=="NULL")
        {
            otroCuadrante=-2;
        }
        
        else
        {
            otroCuadrante=arregloAnotaciones[indice][5];        
        }

        
        padreActual=arregloAnotaciones[indice][6];
    }



indiceAnotacion = indice;

document.getElementById("BotonEliminarAnotacion").disabled    = false;


}





function eliminaAnotacion(){

  document.getElementById("BotonEliminarAnotacion").disabled    = true;
  arregloAnotaciones.splice(indiceAnotacion,1);


  indiceAnotacion = -1;
  limpiaAnotacion();
  
  muestraAnotaciones();

}





function finalizarHojaRuta(unidad,correlativoServicio,numeroMedio){


    if(confirm("Ha seleccionado finalizar la creación de la Hoja de Ruta.  ¿Desea Continuar?"))
    {
    
    if(validaHojaRuta())
    {   
        ocultarFondo();
        var horaInicioReal = document.getElementById("textHoraInicioReal").value;
        var horaTerminoReal = document.getElementById("textHoraTerminoReal").value;


        //document.getElementById("layerAnotaciones").disabled = true;        
        document.getElementById("btnFinalizar").disabled = true;        
        //document.getElementById("btnCerrar").disabled = true;        

        for(i=0;i<arregloAnotaciones.length;i++)
        {
            arregloAnotaciones[i].splice(7,3);
        }
        
        
       //alert(imprimeArreglo(arregloAnotaciones));
        
        


        var objHttpXMLHojaRuta = new AJAXCrearObjeto();

        objHttpXMLHojaRuta.open("POST","./xml/xmlNuevaHojaRuta.php",true);
        objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

        objHttpXMLHojaRuta.send("unidad="+unidad
                                +"&correlativoServicio="+correlativoServicio
                                +"&numeroMedio="+numeroMedio
                                +"&horaInicioReal="+horaInicioReal
                                +"&horaTerminoReal="+horaTerminoReal
                                +"&arregloAnotaciones="+arregloAnotaciones
                                );


        objHttpXMLHojaRuta.onreadystatechange=function()
        {
          if(objHttpXMLHojaRuta.readyState == 4)
          {
              var resultadoHojaRuta = objHttpXMLHojaRuta.responseText;
              alert("Los datos han sido ingresados.");

              cerrarVentana();
          }
        }

    }
    }
}

function eliminaHojaRuta(unidad,correlativoServicio,numeroMedio){


    if(confirm("Ha seleccionado eliminar la Hoja de Ruta para este Medio de Vigilancia.  ¿Desea Continuar?"))
    {
        ocultarFondo();
        document.getElementById("btnFinalizar").disabled = true;        

        var objHttpXMLHojaRuta = new AJAXCrearObjeto();

        objHttpXMLHojaRuta.open("POST","./xml/xmlEliminaHojaRuta.php",true);
        objHttpXMLHojaRuta.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

        objHttpXMLHojaRuta.send("unidad="+unidad
                                +"&correlativoServicio="+correlativoServicio
                                +"&numeroMedio="+numeroMedio
                                );


        objHttpXMLHojaRuta.onreadystatechange=function()
        {
          if(objHttpXMLHojaRuta.readyState == 4)
          {
              var resultadoHojaRuta = objHttpXMLHojaRuta.responseText;
              alert("Los datos han sido eliminados.");

              cerrarVentana();
          }
        }

    }
}

function validaHojaRuta(){

        if(arregloAnotaciones.length==0)
        {
            alert("No existen anotaciones ingresadas.\n\nSi desea borrar todos los registros, seleccione ELIMINAR en la parte inferior.");
            return false;
        }


        if(!validaHora(document.getElementById("textHoraInicioReal").value))
        {
            alert("Debe ingresar Hora de Inicio Real válida hh:mm (00:00 - 23:59)");
            document.getElementById("textHoraInicioReal").value="";
            document.getElementById("textHoraInicioReal").focus();
            
            return false;
        }

        
        else if(!validaHora(document.getElementById("textHoraTerminoReal").value))
        {
            alert("Debe ingresar Hora de Término Real válida hh:mm (00:00 - 23:59)");
            document.getElementById("textHoraTerminoReal").value="";
            document.getElementById("textHoraTerminoReal").focus();
            
            return false;
        }


        else if(document.getElementById("textHoraInicioAnotacion").value != "" || document.getElementById("textMinutoInicioAnotacion").value != "" || document.getElementById("textHoraTerminoAnotacion").value != "" || document.getElementById("textMinutoTerminoAnotacion").value != "" || document.getElementById("cuadranteAnotacion").value         != 0 || document.getElementById("selFactorAnotacion").value != 0)
        {
            if(confirm("Existes datos sin guardar en el formulario.  ¿Desea continuar?"))
            {
                return true;
            }
            
            else
            {
                return false;
            }
        }
        
        else
        {
          return true;
        }
}




function validaHora(hora)
{
    var regExHora = /^[0-9]{2,2}\:[0-9]{2,2}$/;

    if(hora.match(regExHora))
    {
        var h  =  parseInt(hora.substring(0,2));
        var m  =  parseInt(hora.substring(3,5));
        
        if(h>=00 && h <=23 && m>=00 && m<=59)
        {
            return true;
        }
        
        else
        {
            return false;
        }
    }
    
    else
    {
      return false;
    }
}


function validaHoraDividida(h,m)
{
    var regExHora = /^[0-9]{2,2}$/;

    if(h.match(regExHora) && m.match(regExHora))
    {
        if(h>=00 && h <=23 && m>=00 && m<=59)
        {
            return true;
        }
        
        else
        {
            return false;
        }
    }
    
    else
    {
      return false;
    }
}



function imprimeArreglo(arreglo){

var aux="";

    for(t=0;t<arreglo.length;t++)
    {
        for(y=0;y<arreglo[t].length;y++)
        {

              aux += arreglo[t][y] +" - ";
        }
        
        aux += "\n";

    }
    return aux;
}



