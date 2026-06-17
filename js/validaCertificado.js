btnBuscar.addEventListener('click', () => {
    buscarCodigoVerificacion();
});

function buscarCodigoVerificacion(){
    var div	= document.getElementById("respuestaCertificado");
    respuestaCertificado.style.display = "none";
    cargando.style.display = "block";
	//div.innerHTML = "<img src='./images/load.gif' height='100px'>";
    div.innerHTML = "";
    var objHttpXMLCertificado = new AJAXCrearObjeto();
	objHttpXMLCertificado.open("POST","./xml/xmlCapacitados/xmlBuscarCertificado.php",true);
	objHttpXMLCertificado.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    //objHttpXMLCertificado.send(encodeURI("codigoFuncionario="+textCodVerificacion.value));
	objHttpXMLCertificado.send(encodeURI("codigoVerificacion="+textCodVerificacion.value));
	objHttpXMLCertificado.onreadystatechange=function(){
		//console.log(objHttpXMLCertificado.readyState);
		if(objHttpXMLCertificado.readyState == 4){
			//console.log(objHttpXMLCertificado.responseText);
			if (objHttpXMLCertificado.responseText != "VACIO"){
				//console.log(objHttpXMLCertificado.responseText);
				var xml 							= objHttpXMLCertificado.responseXML.documentElement;
				var codigo	 						= "";
				var apellidoPaterno	 				= "";
				var apellidoMaterno	 				= "";
				var nombre2	 						= "";
				var nombre	 						= "";
				var nombreCompleto					= "";
				var grado		 					= "";
				var fechaCapacitacion				= "";
				var codVerificacion					= "";
				var tipoCapacitacion				= "";
				var fechaValidez				    = "";

                if(xml.getElementsByTagName('certificado').length>0){
                    respuestaCertificado.style.display = "block";
                    respuestaCertificado.style.height = "420px";
                    cargando.style.display = "none";

					codigo	 		 	 = (xml.getElementsByTagName('codigo')[0].text||xml.getElementsByTagName('codigo')[0].textContent);
					apellidoPaterno 	 = (xml.getElementsByTagName('apellidoPaterno')[0].text||xml.getElementsByTagName('apellidoPaterno')[0].textContent||"");
					apellidoMaterno		 = (xml.getElementsByTagName('apellidoMaterno')[0].text||xml.getElementsByTagName('apellidoMaterno')[0].textContent||"");
					nombre				 = (xml.getElementsByTagName('nombre')[0].text||xml.getElementsByTagName('nombre')[0].textContent||"");
					nombre2				 = (xml.getElementsByTagName('nombre2')[0].text||xml.getElementsByTagName('nombre2')[0].textContent||"");
					nombreCompleto		 = (apellidoPaterno+" "+apellidoMaterno+", "+nombre+" "+nombre2);
					grado		 	 	 = (xml.getElementsByTagName('grado')[0].text||xml.getElementsByTagName('grado')[0].textContent||"");
					fechaCapacitacion	 = (xml.getElementsByTagName('fechaCapacitacion')[0].text||xml.getElementsByTagName('fechaCapacitacion')[0].textContent||"");
					fechaValidez	     = (xml.getElementsByTagName('fechaValidez')[0].text||xml.getElementsByTagName('fechaValidez')[0].textContent||"");
					codVerificacion 	 = (xml.getElementsByTagName('codVerificacion')[0].text||xml.getElementsByTagName('codVerificacion')[0].textContent||"");
					tipoCapacitacion 	 = (xml.getElementsByTagName('tipoCapacitacion')[0].text||xml.getElementsByTagName('tipoCapacitacion')[0].textContent||"");
                    
                    div.innerHTML = "</br><span id='labelTextRegistro'>Certificado Valido</span>";
                    div.innerHTML += "<img id='iconoValidacion' name='iconoValidacion' height='35' width='35' src='img/aprobado.png' /></br></br></br>";
                    div.innerHTML += "<span id='labelTextRegistro'>Grado :</span><p>"+grado+"</p><br>";
                    div.innerHTML += "<span id='labelTextRegistro'>Nombre :</span><p>"+nombreCompleto+"</p><br>";
                    div.innerHTML += "<span id='labelTextRegistro'>Tipo Curso :</span><p>"+tipoCapacitacion+"</p><br>";
                    div.innerHTML += "<span id='labelTextRegistro'>Fecha Aprobación :</span><p>"+fechaCapacitacion+"</p><br>";
                    div.innerHTML += "<span id='labelTextRegistro'>Valido Hasta :</span><p>"+fechaValidez+"</p><br>";
                    div.innerHTML += "<span id='labelTextRegistro'>Codigo Validación :</span><p>"+codVerificacion+"</p><br></br>";

				}
                else{
                    respuestaCertificado.style.display = "block";
                    respuestaCertificado.style.height = "85px";
                    cargando.style.display = "none";

                    div.innerHTML = "</br><span id='labelTextRegistro'>Certificado No Valido</span>";
                    div.innerHTML += "<img id='iconoValidacion' name='iconoValidacion' height='35' width='35' src='img/rechazado.png' /></br></br></br>";

                }

			}
		}
	}
}