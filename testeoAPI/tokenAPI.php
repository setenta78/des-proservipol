<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
  #loading {
    display: none;
  }
  </style>
  <script src="..\axios\dist\axios.js"></script>
</head>
<body>
  <input id="folio" value="" type="text" />
  <button id="login">Login</button> 
  <button id="buscar">Buscar</button>
  <div id="mensaje"></div>
  <div id="loading">cargando...</div>
  <div id="dataText"></div>
  
<script>
var loading = document.getElementById('loading');
var mensaje = document.getElementById('mensaje');
var dataText = document.getElementById('dataText');
var token	= '';
	
    var botonLogin = document.getElementById('login');
    botonLogin.addEventListener('click', function() {
      loading.style.display = 'block';
	
      axios.post('https://api-cil.hoscar.cl/api/v1/login', {
        usuario: 'proservipol',
        clave: '49epRYJrTzse'
	
	/*
      axios.post('https://dev-api-cil.hoscar.cl/api/v1/login', {
        usuario	: 'develop',
        clave	: 'h@KS940fw9Jj'
	*/
		},
		{
			headers: { 
				'Access-Control-Allow-Origin': '*'}
		})
        .then(function(res) {
          if(res.status==200) {
			console.log(res);
			token = res.data.access_token;
            mensaje.innerHTML = res.data.access_token;
          }
        })
        .catch(function(err) {
          console.log(err);
          mensaje.innerHTML = res.data.status+" "+res.data.statusText;
        })
        .then(function() {
          loading.style.display = 'none';
        });
    });
	
	var botonBuscar = document.getElementById('buscar');
    botonBuscar.addEventListener('click', function() {
	  loading.style.display = 'block';
      axios.post('https://api-cil.hoscar.cl/api/v1/licByFolio', {
			'folio': folio.value
		},
		{
			headers: { 
				'Content-type': 'application/json',
				'Authorization': 'Bearer '+token }
		}
		)
		.then(function(res) {
			console.log(res.data);
			let dataLicencia = (Array.isArray(res.data.licencia)) ? res.data.licencia[0] : res.data.licencia;
			console.log(dataLicencia);
			mensaje.innerHTML = res.data.msg;
			var DatosLicenciaHTML = "";
			DatosLicenciaHTML = "<br><b>FOLIO:</b> "+dataLicencia.FOLIO;
			DatosLicenciaHTML += "<br><b>RUT:</b> "+dataLicencia.RUT_FUNC;
			DatosLicenciaHTML += "<br><b>FECHA EMISION:</b> "+dataLicencia.FECHA_EMISION;
			DatosLicenciaHTML += "<br><b>FECHA INICIO:</b> "+dataLicencia.FECHA_INICIO_REPOSO;
			DatosLicenciaHTML += "<br><b>FECHA TERMINO:</b> "+dataLicencia.FECHA_FIN_REPOSO;
			DatosLicenciaHTML += "<br><b>DIAS:</b> "+dataLicencia.DIAS;
			DatosLicenciaHTML += "<br><b>RUT HIJO:</b> "+dataLicencia.RUT_HIJO_FUNC;
			DatosLicenciaHTML += "<br><b>FECHA NACIMIENTO HIJO:</b> "+dataLicencia.HIJO_FECHA_NAC;
			DatosLicenciaHTML += "<br><b>ID TIPO LICENCIA:</b> "+dataLicencia.TLIC_ID;
			DatosLicenciaHTML += "<br><b>TIPO LICENCIA:</b> "+dataLicencia.TIPO_LICENCIA;
			DatosLicenciaHTML += "<br><b>RECUPERABILIDAD:</b> "+dataLicencia.RECUPERABILIDAD;
			DatosLicenciaHTML += "<br><b>TRAMITE INVALIDEZ:</b> "+dataLicencia.TRAMITE_INVALIDEZ;
			DatosLicenciaHTML += "<br><b>ID TIPO REPOSO:</b> "+dataLicencia.TREP_ID;
			DatosLicenciaHTML += "<br><b>TIPO REPOSO:</b> "+dataLicencia.TREP_DESCRIPCION;
			DatosLicenciaHTML += "<br><b>ID LUGAR REPOSO:</b> "+dataLicencia.LREP_ID;
			DatosLicenciaHTML += "<br><b>LUGAR REPOSO:</b> "+dataLicencia.LREP_DESCRIPCION;
			DatosLicenciaHTML += "<br><b>RUT PROFESIONAL:</b> "+dataLicencia.RUT_PROF;
			DatosLicenciaHTML += "<br><b>ID TIPO PROFESIONAL:</b> "+dataLicencia.TPROF_ID;
			DatosLicenciaHTML += "<br><b>TIPO PROFESIONAL:</b> "+dataLicencia.TPROF_DESCRIPCION;
			DatosLicenciaHTML += "<br><b>ID ESPECIALIDAD:</b> "+dataLicencia.PESP_ID;
			DatosLicenciaHTML += "<br><b>ESPECIALIDAD:</b> "+dataLicencia.PESP_DESCRIPCION;
			DatosLicenciaHTML += "<br><b>TIPO ATENCION:</b> "+dataLicencia.TIPO_ATENCION;
			DatosLicenciaHTML += "<br><b>FORMATO:</b> "+dataLicencia.FORMATO;
			dataText.innerHTML = DatosLicenciaHTML;
        })
        .catch(function(err) {
			console.log(err);
			dataText.innerHTML = err;
        })
        .then(function() {
          loading.style.display = 'none';
        });
    });
	
</script>
</body>
</html>