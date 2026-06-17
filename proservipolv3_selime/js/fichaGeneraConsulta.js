function moverParametro(objetoDesde, objetoHasta){
	moverDatos(objetoDesde, objetoHasta);
	ordenar(document.getElementById(objetoHasta));
	//habilitarBotonesAgregarQuitar();
	
}


function inicializarGenerador(tipoConsulta, especialidad){
	
	//alert(tipoConsulta);
	if (tipoConsulta == 1){
		document.getElementById("tituloDisponible").innerHTML = "TIPOS DE SERVICIOS";
		document.getElementById("tituloAsignado").innerHTML = "SERVICIOS SELECCIONADOS";
		leeTipoServicios('disponibles',true,especialidad);
	}	
}

function abrirGeneradorDeConsulta(){
	
	//var objeto = document.rbTipoConculta;
	//alert(objeto.length);
	//for (i=0;i<document.getElementById("rbTipoConculta").length;i++){ 
    //   if (document.getElementById("rbTipoConculta")[i].checked) 
    //      break; 
    //} 
	tipoConsulta = 1;
	
	abrirVentana('GENERA CONSULTA ... ', '850', '350','fichaGeneraConsulta.php?tipoConsulta='+tipoConsulta, '','','5','5');
}


function buscarServicios(codigoUnidad){
	var okValidacion = validarParametrosConsultaServicios();
	if (okValidacion){
		var fechaInicio  = document.getElementById("textFechaServicio1").value;
		var fechaTermino = document.getElementById("textFechaServicio2").value;
		var arregloTipoServicios = new Array();
		
		var cantidadTiposServicio = document.getElementById("asignado").length;
		
		for (var i=0; i<cantidadTiposServicio;i++){
			//alert(document.getElementById("asignado")[i].value);
			var servicio = document.getElementById("asignado")[i].value.substr(1,document.getElementById("asignado")[i].value.length);
			//alert(servicio);
			arregloTipoServicios[i] = servicio;
		}
		
		top.document.getElementById("textBuscar").value = "";
		
		top.leeServicios(codigoUnidad, fechaInicio, fechaTermino, arregloTipoServicios);
		top.cerrarVentana();
	}
}

function validarParametrosConsultaServicios(){
	
	var fechaInicio  = document.getElementById("textFechaServicio1").value;
	var fechaTermino = document.getElementById("textFechaServicio2").value;
	if (fechaInicio == ""){
		alert("DEBE INDICAR FECHA DE INICIO DE LA BUSQUEDA.    ");
		return false;
	}
	
	if (fechaTermino == ""){
		alert("DEBE INDICAR FECHA DE TERMINO DE LA BUSQUEDA.    ");
		return false;
	}
	
	if (fechaInicio > fechaTermino){
		alert("LA FECHA DE INICIO NO PUEDE SER MAYOR QUE FECHA DE TERMINO.    ");
		return false;
	}
	
	return true;
	
}