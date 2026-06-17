var cargaCargos;
var cargaCategoriaCargos;

function leeCargos(nombreObjeto,categoria,escalafon,grado){

	document.getElementById("selCargo").disabled= "";
	var tipoUnidad			= document.getElementById("tipoUnidad").value;
	var unidadEspecialidad	= document.getElementById("UnidadEspecialidad").value;

	var tipoUnidadNew	= document.getElementById("tipoUnidadNew").value;
	var especialidadUnidadNew	= document.getElementById("especialidadUnidadNew").value;

	cargaCargos = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLCargo = new AJAXCrearObjeto();
	objHttpXMLCargo.open("POST","./xml/xmlFuncionarios/xmlCargos.php",true);
	objHttpXMLCargo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("tipoUnidad="+tipoUnidad+"&categoria="+categoria+"&unidadEspecialidad="+unidadEspecialidad+"&escalafon="+escalafon+"&grado="+grado+"&tipoUnidadNew="+tipoUnidadNew+"&especialidadUnidadNew="+especialidadUnidadNew+"&codUnidad="+unidadUsuario.value);
	objHttpXMLCargo.send(encodeURI("tipoUnidad="+tipoUnidad+"&categoria="+categoria+"&unidadEspecialidad="+unidadEspecialidad+"&escalafon="+escalafon+"&grado="+grado+"&tipoUnidadNew="+tipoUnidadNew+"&especialidadUnidadNew="+especialidadUnidadNew+"&codUnidad="+unidadUsuario.value));
	objHttpXMLCargo.onreadystatechange=function(){
		//console.log(objHttpXMLCargo.responseText);
		if(objHttpXMLCargo.readyState == 4){
			if (objHttpXMLCargo.responseText != "VACIO"){
				var xml			= objHttpXMLCargo.responseXML.documentElement;
				var codigo		= "";
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('cargo').length;i++){
					codigo		= (xml.getElementsByTagName('codigo')[i].text||xml.getElementsByTagName('codigo')[i].textContent);
					descripcion = (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent);
					var datosOpcion = new Option(descripcion, codigo, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaCargos = 1;
			}
		}
	}
}

function leeCategoriaCargos(nombreObjeto,escalafon,grado){
	var tipoUnidad	= document.getElementById("tipoUnidad").value;
	var UnidadTipo	= document.getElementById("UnidadTipo").value;

	var tipoUnidadNew	= document.getElementById("tipoUnidadNew").value;
	var especialidadUnidadNew	= document.getElementById("especialidadUnidadNew").value;

	cargaCategoriaCargos = 0;
	document.getElementById(nombreObjeto).length = null;
	var datosOpcion = new Option("CARGANDO DATOS ... ", 0, "", "");
	document.getElementById(nombreObjeto).options[0] = datosOpcion;
	var objHttpXMLCategoriaCargo = new AJAXCrearObjeto();
	objHttpXMLCategoriaCargo.open("POST","./xml/xmlFuncionarios/xmlCategoriaCargos.php",true);
	objHttpXMLCategoriaCargo.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//console.log("tipoUnidad="+tipoUnidad+"&UnidadTipo="+UnidadTipo+"&escalafon="+escalafon+"&tipoUnidadNew="+tipoUnidadNew+"&especialidadUnidadNew="+especialidadUnidadNew);
	objHttpXMLCategoriaCargo.send(encodeURI("tipoUnidad="+tipoUnidad+"&UnidadTipo="+UnidadTipo+"&escalafon="+escalafon+"&tipoUnidadNew="+tipoUnidadNew+"&especialidadUnidadNew="+especialidadUnidadNew));
	objHttpXMLCategoriaCargo.onreadystatechange=function(){
		if(objHttpXMLCategoriaCargo.readyState == 4){
			//console.log(objHttpXMLCategoriaCargo.responseText);
			if (objHttpXMLCategoriaCargo.responseText != "VACIO"){
				var xml			= objHttpXMLCategoriaCargo.responseXML.documentElement;
				var descripcion	= "";
				document.getElementById(nombreObjeto).length = null;
				var datosOpcion = new Option("SELECCIONE UNA OPCION ... ", 0, "", "");
				document.getElementById(nombreObjeto).options[0] = datosOpcion;
				for(i=0;i<xml.getElementsByTagName('categoriaCargo').length;i++){
					descripcion 	= (xml.getElementsByTagName('descripcion')[i].text||xml.getElementsByTagName('descripcion')[i].textContent);	
					var datosOpcion = new Option(descripcion, descripcion, "", "");
					document.getElementById(nombreObjeto).options[i+1] = datosOpcion;
				}
				cargaCategoriaCargos = 1;
			}
		}
	}
}