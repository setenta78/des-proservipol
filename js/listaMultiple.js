function verCantidad(nombreObjeto){
	opcionSeleccionada = eval("document.forms[0]."+nombreObjeto+".selectedIndex");
	valorTexto = eval("document.forms[0]."+nombreObjeto+".options[opcionSeleccionada].text");
	alert(valorTexto);
}

function moverDatos(nombreObjetoDesde, nombreObjetoHasta, todos){
	//var x = eval("document." + nombreObjetoDesde);
	//var y = eval("document." + nombreObjetoHasta);
	
	var x = document.getElementById(nombreObjetoDesde);
	var y = document.getElementById(nombreObjetoHasta);
	
	var k=0;
	var z=0;
	var datoArray	= new Array();
	var valorArray 	= new Array();
	
	for (var i=0;i<y.length;i++){
		datoArray[k]	= y.options[i].text;
		valorArray[k] 	= y.options[i].value;
		k++;
	}
	
	mensaje = "ATENCION :\n\n";
	repetidas = 0;
	for (var i=0;i<x.length; i++){
		existe = 0;
		if (x.options[i].selected == true || todos){
			for (var j=0; j<datoArray.length;j++){
				//alert(i + " - " + j + " - "+ x.options[i].text + " - "+ datoArray[j]);
				if (x.options[i].text == datoArray[j]){
					existe = 1;
					repetidas = 1;
					mensaje = mensaje + x.options[i].text + "			\n";
				}
			}
			
			if (existe == 0){
				datoArray[k]	= x.options[i].text;
				valorArray[k]	= x.options[i].value;
				k++;
			}
		}
	}
	
	for (var i=0; i<datoArray.length;i++){
		y.options[i] 		= new Option(datoArray[i]);
		y.options[i].value 	= valorArray[i];
	}	
	
	quitarDatos(nombreObjetoDesde);
	
	if (repetidas == 1){
		mensaje = mensaje + "\nYA SE ENCUENTRA (N) SELECCIONADA (S) ... ";
		alert(mensaje);
	}
	
	//alert(x.length);
	//if (x.length == 0) x.style.backgroundColor = "#D4D4D4";
	//else x.style.backgroundColor = "";
	//
	//if (y.length == 0) x.style.backgroundColor = "#D4D4D4";
	//else y.style.backgroundColor = "";
}


function quitarDatos(nombreObjeto){
	var i;
	//var y = eval("document.forms[0]." + nombreObjeto);
	var y = document.getElementById(nombreObjeto);
	for (i=y.length-1;i>=0;i--){
		if (y.options[i].selected == true){
			y.options[i]=null;
		}
	}
}


function seleccionaUnidadLista(nombreObjetoDesde, nombreObjetoHasta, todos){
	moverDatos(nombreObjetoDesde, nombreObjetoHasta, todos);
	//alert(document.getElementById('unidadSeleccionada').length);
	if (document.getElementById('unidadSeleccionada').length == 0){
		document.getElementById("btn100_selUnidad").disabled = false;
		document.getElementById("btn100_noSelUnidad").disabled = true;
	} else {
		document.getElementById("btn100_selUnidad").disabled = true;
		document.getElementById("btn100_noSelUnidad").disabled = false;
	}



}


function aceptarSeleccion(){
	
	seleccion = "UNIDADES :\n\n";
	
	var y = eval("document.forms[0].unidadesSeleccionadas");
	for (var i=0;i<y.length;i++){
		seleccion	= seleccion + y.options[i].text + "           \n";
	}
	
	seleccion = seleccion + "\nGRUPOS :\n\n";
	
	
	var g = eval("document.forms[0].gruposSeleccionados");
	
	for (var j=0;j<g.length;j++){
		seleccion = seleccion + g.options[j].text + "           \n";
	}
	
	alert(seleccion);
}