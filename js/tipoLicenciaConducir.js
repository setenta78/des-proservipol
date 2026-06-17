var cargaTipoLicenciaConducir;
function listaMultipleTiposLicenciaConducir(nombreObjeto){
	cargaTipoLicenciaConducir = 0;
	var objHttpXMLTipo = new AJAXCrearObjeto();
	objHttpXMLTipo.open("POST","./xml/xmlLicenciaConducir/xmlTipoLicenciaConducir.php",true);
	objHttpXMLTipo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipo.send(encodeURI());
	objHttpXMLTipo.onreadystatechange=function(){
		//alert(objHttpXMLTipo.readyState);
		if(objHttpXMLTipo.readyState == 4){
			var xml= objHttpXMLTipo.responseXML.documentElement;
			//alert(objHttpXMLTipo.responseText);
			document.getElementById(nombreObjeto).length = null;
			var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
			document.getElementById(nombreObjeto).options[0] = datosOpcion;
			for(i=0;i<xml.getElementsByTagName('licenciaConducir').length;i++){
				codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
				descripcion 	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
				var datosOpcion = new Option(descripcion, codigo, "", "");
				document.getElementById(nombreObjeto).options[i] = datosOpcion;
			}
		}
	}
	cargaTipoLicenciaConducir = 1;
}

var cargaTiposRestriccionConducirLM;
var cargaTiposRestriccionConducirLS;
function listaMultipleTiposRestriccionConducir(nombreObjeto, tipo){
	if (tipo == "MUNICIPAL")cargaTiposRestriccionConducirLM = 0;
	if (tipo == "SEMEP")cargaTiposRestriccionConducirLS = 0;
	var objHttpXMLTipo = new AJAXCrearObjeto();
	objHttpXMLTipo.open("POST","./xml/xmlLicenciaConducir/xmlTipoRestriccionConducir.php",true);
	objHttpXMLTipo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipo.send(encodeURI("tipo="+tipo));
	objHttpXMLTipo.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLTipo.readyState == 4){
			var xml= objHttpXMLTipo.responseXML.documentElement;
			//alert(objHttpXMLTipo.responseText);
			document.getElementById(nombreObjeto).length = null;
			var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
			document.getElementById(nombreObjeto).options[0] = datosOpcion;
			for(i=0;i<xml.getElementsByTagName('restriccionConducir').length;i++){
				codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
				descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
				var datosOpcion = new Option(descripcion, codigo, "", "");
				document.getElementById(nombreObjeto).options[i] = datosOpcion;
			}
		}
	}
	if (tipo == "MUNICIPAL")cargaTiposRestriccionConducirLM = 1;
	if (tipo == "SEMEP")cargaTiposRestriccionConducirLS = 1;
}

var cargaTipoClasificacionSemep;
function listaMultipleTiposClasificacionSemep(nombreObjeto){
	cargaTipoClasificacionSemep = 0;
	var objHttpXMLTipo = new AJAXCrearObjeto();
	objHttpXMLTipo.open("POST","./xml/xmlLicenciaConducir/xmlTipoClasificacionSemep.php",true);
	objHttpXMLTipo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipo.send(encodeURI());
	objHttpXMLTipo.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLTipo.readyState == 4){
			var xml= objHttpXMLTipo.responseXML.documentElement;
			document.getElementById(nombreObjeto).length = null;
			var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
			document.getElementById(nombreObjeto).options[0] = datosOpcion;
			for(i=0;i<xml.getElementsByTagName('clasificacionSemep').length;i++){
				codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
				descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
				var datosOpcion = new Option(descripcion, codigo, "", "");
				document.getElementById(nombreObjeto).options[i] = datosOpcion;
			}
		}
	}
	cargaTipoClasificacionSemep = 1;
}

var cargaTipoEvaluacionSemep;
function listaSimpleTiposEvaluacionSemep(nombreObjeto){
	cargaTipoEvaluacionSemep = 0;
	var objHttpXMLTipo = new AJAXCrearObjeto();
	objHttpXMLTipo.open("POST","./xml/xmlLicenciaConducir/xmlTipoEvaluacionSemep.php",true);
	objHttpXMLTipo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	objHttpXMLTipo.send(encodeURI());
	objHttpXMLTipo.onreadystatechange=function(){
		//alert(objHttpXMLFuncionarios.readyState);
		if(objHttpXMLTipo.readyState == 4){
			var xml= objHttpXMLTipo.responseXML.documentElement;
			document.getElementById(nombreObjeto).length = null;
			var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
			document.getElementById(nombreObjeto).options[0] = datosOpcion;
			for(i=0;i<xml.getElementsByTagName('tipoEvaluacionSemep').length;i++){
				codigo 			= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent||"");
				descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent||"");
				var datosOpcion = new Option(descripcion, codigo, "", "");
				document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
			}
		}
	}
	cargaTipoEvaluacionSemep = 1;
}