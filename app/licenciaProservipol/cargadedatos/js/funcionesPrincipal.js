function cambiarClase(objeto, clase){
	objeto.className = clase;
}


function verificaIngresoDatos(mes,anno,opcion)
{

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

        document.getElementById("textFecha").innerHTML = "<b>"+document.getElementById("selMes").options[document.getElementById("selMes").selectedIndex].text+" DE "+document.getElementById("selAnno").value+"</b>";

        document.getElementById("selMes").value=0;
        document.getElementById("selAnno").value=0;

        document.getElementById("textSubMenu").innerHTML="";


        if(opcion=='carga')
        {
            document.getElementById("textSubMenu").innerHTML="";
            iniciaCargaDatos(mes,anno);
        }
        
        else if(opcion=='rango')
        {
        }
    }
}
