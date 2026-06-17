var cargaSelHora;

function listaHoras(nombreObjeto, inicioH, inicioM){
	cargaSelHora = 0;
	//alert(nombreObjeto+" - "+cargaSelHora);
	var i,j;
	var hora = "", minutos = "";
	var horaDesplegar;
	var puntero = 0;
	//document.getElementById(nombreObjeto).length = null;
	if(inicioH==0){
		var datosOpcion = new Option("...", 0, "", "");
		document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
		puntero++;
	}
	
	for (i=inicioH;i<=23;i++){ 
		for (j=inicioM;j<=59;j=j+15){
			
			if (i<10) hora = "0";
			if (i==-1){
				i=0;
				j=0;
			}
			
			hora = hora + i;
			
			if (j<10) minutos = "0";
			minutos = minutos + j;
			
			horaDesplegar = hora + ":" + minutos;
			
			var datosOpcion = new Option(horaDesplegar, horaDesplegar, "", "");
			document.getElementById(nombreObjeto).options[puntero] = datosOpcion;
			
			hora = "";
			minutos  = "";
			puntero++;
			
			if(i==23&&j==45&&puntero!=97){
				i = i*1-24;
				j = j*1-60;
			}
			else if(puntero==97){
				i = 24;
				j = 60;
			}
		}
		inicioM = 0;
	}
	cargaSelHora = 1;
	//alert(nombreObjeto+" - "+cargaSelHora);
}

function horaMayor(hora1, hora2){
	if (hora1 > hora2) alert("hora1 > hora2");
	if (hora2 > hora1) alert("hora2 > hora1");
	if (hora1 == hora2) alert("hora1 == hora2");
}

function fechaCompleta(fecha){
	//alert(fecha);
	var meses = new Array('ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE', 'NOVIEMBRE','DICIEMBRE');
	var fechaPaso = fecha.split("-");
	return fechaPaso[0] + " DE " + meses[fechaPaso[1]-1] + " DEL " + fechaPaso[2];
}

function formato(fecha, formato){
	var fechaPaso = fecha.split("-");
	if (formato == "YY-MM-DD") return fechaPaso[0] + "-" + fechaPaso[1] + "-" + fechaPaso[2];
}

function getAnno(fecha){
	var fechaPaso = fecha.split("-");
   return fechaPaso[2];
}

function getMes(fecha){
	var fechaPaso = fecha.split("-");
    return fechaPaso[1];
}

function getDia(fecha){
	var fechaPaso = fecha.split("-");
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

function cantidadDeDiasEntre(fecha1, fecha2){
	//var dia1 = getDia(fecha1);
	//var mes1 = getDia(fecha1);
	//var 
	//fecha2 = formato(fecha2, "YY-MM-DD");
	//fecha1 = formato(fecha1, "YY-MM-DD");
	
	var auxFecha1 = new Date(getAnno(fecha1),getMes(fecha1)-1,getDia(fecha1));   
	var auxFecha2 = new Date(getAnno(fecha2),getMes(fecha2)-1,getDia(fecha2));   
	
	var diasDif = auxFecha2.getTime() - auxFecha1.getTime();
	var dias = Math.round(diasDif/(1000 * 60 * 60 * 24));
	return dias;

}