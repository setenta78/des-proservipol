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
  RUT<input id="rut" value="" type="text" /><br>
  FOLIO<input id="nsol" value="" type="text" /><br>
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
      //axios.get('http://apisp7.carabineros.cl/api/login?name=PROSERVIPOL&password=PG305Fxq', { },
	  axios.get('http://apisp7.desarrollo.carabineros.cl/api/login?name=PROSERVIPOL&password=PG305Fxq', { },
		{
			headers: { 
				'Access-Control-Allow-Origin': '*'}
		})
        .then(function(res) {
          if(res.status==200) {
			console.log(res);
			token = res.data.token_de_acceso;
            mensaje.innerHTML = res.data.token_de_acceso;
          }
        })
        .catch(function(err) {
          console.log(err);
          mensaje.innerHTML = err.response.status+" "+err.response.data.error;
        })
        .then(function() {
          loading.style.display = 'none';
        });
    });
	
	var botonBuscar = document.getElementById('buscar');
    botonBuscar.addEventListener('click', function() {
	  loading.style.display = 'block';
      axios.post('http://apisp7.desarrollo.carabineros.cl/api/SolicitudFerperFuncionario', {
			'name': 'PROSERVIPOL',
			'RutFunc': rut.value,
			'nroSolicitud': nsol.value
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