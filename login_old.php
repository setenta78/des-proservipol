<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Iniciar sesión para manejar errores
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>AUTENTIFICTIC</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <meta name="theme-color" content="#3c763d;">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Carga Axios -->
</head>
<body class="bg-login">
    <div class="margintop-login">
        <div class="carabineros">
            <div style="width: 100%; text-align: center;">
                <img src="assets/images/carabineros.png" width="70" height="auto">
            </div>
            <div style="line-height: 32px; width: 100%; float: right; text-align: center;">
                <h1 class="title-name-app">Sistema de Programación de Servicios Policiales</h1>
                <h5 class="subtitle-name-app">Departamento de Control de Gestión y Sistemas de Información</h5>
            </div>
        </div>
        <div style="clear:both"></div>
        <div class="login-page background-black-06">
            <div class="autentificatic-sello text-center">
                <a href="http://autentificaticapi.carabineros.cl/assets/documents/procedimiento_de_seguridad.pdf" target="_blank">
                    <img src="http://autentificaticapi.carabineros.cl/assets/images/autentificatic.png" width="280" height="auto" style="padding-top: 6px;">
                </a>
            </div>
            <div class="text-center">
                <a href="#popup"><img src="assets/images/info.png" width="60" height="auto"></a>
            </div>
            <div class="input-size">
                <form id="form_login" method="POST">
                    <div class="input-group form-group">
                        <input name="rut_funcionario" id="rut_funcionario" type="text" class="input-style" size="10" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="label-input"><i class="fa fa-user"></i> RUT (sin puntos ni guión)</label>
                    </div>
                    <div class="input-group form-group">
                        <input name="password" id="password" type="password" class="input-style" size="20" required>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="label-input"><i class="fa fa-lock"></i> Contraseña</label>
                    </div>
                    <div class="text-center">
                        <button type="button" id="btn-login" class="btn-login">Iniciar Sesión</button>
                    </div>
					<div class="text-center">
				  		<p style="margin-bottom: 0px;"><strong>Proservipol V3.9.0</strong></p>
				  	</div>
                </form>
            </div>
        </div>
		<!-- Información adicional más pequeña y centrada -->
			<div class="text-center information-bottom" style="font-size: 14px; line-height: 1.6;">
				<div class="title-by">Desarrollado por el Departamento de Control de Gestión y Sistemas de Información © 2025</div>
				<div class="title-deskhelp">Horarios de Atención de la Mesa de Ayuda</div>
				<div class="title-deskhelp">Lunes a Jueves 09:00 - 13:00 Y 15:00 - 18:00</div>
				<div class="title-deskhelp">Viernes 09:00 - 13:00 Y 14:30 - 17:30</div>
				<div class="title-deskhelp">Mesa de Ayuda: 20844 Suboficial Mayor Wilfredo Garcia</div>
				<div class="title-deskhelp">Mesa de Ayuda: 20828 C.P.R. Guillermo Canio</div>
				<div class="title-deskhelp">Mesa de Ayuda: 20843 C.P.R. Andrea Fuentes</div>
			</div>
			<div class="logos-bottom">
				<img src="http://intranetv2.carabineros.cl/DescargasTIC/aniversario.png" width="70" height="auto" style="float: left; padding-top: 4px;">
				<img src="assets/images/logo_depto_transparente.png" width="70" height="auto" style="float: right;">
				<!--<img src="http://intranetv2.carabineros.cl/DescargasTIC/sello-TIC.png" width="70" height="auto" style="float: right;"> -->
			</div>

			<div class="text-center slogan"><img src="http://intranetv2.carabineros.cl/DescargasTIC/slogan.png" style="padding-top: 20px;"></div>
    </div>
    <div id="popup" class="overlay">
		<div id="popupBody">
			<h3>
				<img src="assets/images/logo_depto_transparente.png" width="50" height="auto" style="float: left; margin-right: 15px; margin-top: -10px;"> 
				Sistema de Programación de Servicios Policiales
			</h3>
				<a id="cerrar" href="#">×</a>
				<div class="popupContent">
					<p style="text-align: justify;">El Sistema de Programación de Servicios Policiales (PROSERVIPOL V 3.9), es una herramienta de captura,
						almacenamiento y monitoreo de datos relacionados con los servicios que desarrollan diariamente los estamentos
						institucionales a lo largo del país, y que permite obtener una visión permanentemente actualizada de su realidad
						diaria, como asimismo el comportamiento histórico de los datos ingresados.
					</p>
				</div>
		</div>
	</div>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script>
        document.getElementById('btn-login').addEventListener('click', function() {
            const rut = document.getElementById('rut_funcionario').value;
            const password = document.getElementById('password').value;

            if (!rut || !password) {
                alert('Por favor, ingrese RUT y contraseña.');
                return;
            }

            const loadingMsg = document.createElement('div');
            loadingMsg.innerHTML = 'Autenticando...';
            loadingMsg.style.position = 'fixed';
            loadingMsg.style.top = '50%';
            loadingMsg.style.left = '50%';
            loadingMsg.style.transform = 'translate(-50%, -50%)';
            loadingMsg.style.background = '#fff';
            loadingMsg.style.padding = '10px';
            loadingMsg.style.border = '1px solid #ccc';
            document.body.appendChild(loadingMsg);

            axios.post('http://autentificaticapi.carabineros.cl/api/auth/login', {
                rut: rut,
                password: password
            }, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Origin': 'http://des-proservipol.carabineros.cl'
                },
                transformRequest: [(data, headers) => {
                    const params = new URLSearchParams();
                    for (let key in data) {
                        params.append(key, data[key]);
                    }
                    console.log('Datos enviados:', params.toString());
                    return params.toString();
                }]
            })
            .then(response => {
                console.log('Respuesta de /api/auth/login Headers:', response.config.headers);
                console.log('Respuesta de /api/auth/login:', response.data);
                if (response.status === 200 && response.data.success.access_token) {
                    const access_token = response.data.success.access_token;
                    const expires_at = response.data.success.expires_at;
                    const token_type = response.data.success.token_type;

                    // Enviar el token al servidor para guardar en sesión
                    return axios.post('save_token.php', {
                        access_token: access_token,
                        expires_at: expires_at,
                        token_type: token_type
                    }, {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    });
                } else {
                    throw new Error('Autenticación fallida: ' + JSON.stringify(response.data.errors));
                }
            })
            .then(response => {
                console.log('Respuesta de save_token.php:', response.data);
                if (response.status === 200 && response.data.success) {
                    return axios.get('http://autentificaticapi.carabineros.cl/api/auth/user', {
                        headers: {
                            'Authorization': 'Bearer ' + response.data.access_token,
                            'Accept': 'application/json',
                            'Origin': 'http://des-proservipol.carabineros.cl'
                        }
                    });
                } else {
                    throw new Error('Error al guardar el token: ' + JSON.stringify(response.data));
                }
            })
            .then(response => {
                console.log('Respuesta de /api/auth/user:', response.data);
                if (response.status === 200 && response.data.success.user.codigo_funcionario) {
                    const codigo_funcionario = response.data.success.user.codigo_funcionario;
                    const form = document.getElementById('form_login');
                    form.action = 'valida.php';

                    const userInput = document.createElement('input');
                    userInput.type = 'hidden';
                    userInput.name = 'textUsuario';
                    userInput.value = codigo_funcionario;

                    const claveInput = document.createElement('input');
                    claveInput.type = 'hidden';
                    claveInput.name = 'textClave';
                    claveInput.value = 'dummy';

                    form.appendChild(userInput);
                    form.appendChild(claveInput);
                    form.submit();
                } else {
                    throw new Error('No se encontró código de funcionario: ' + JSON.stringify(response.data));
                }
            })
            .catch(error => {
                console.error('Error detallado:', error.response ? error.response.data : error.message);
                document.body.removeChild(loadingMsg);
                alert('Error al iniciar sesión: ' + (error.response ? error.response.data.errors.rut || error.response.data.message : 'Error desconocido. Consulta la consola para más detalles.'));
            })
            .finally(() => {
                document.body.removeChild(loadingMsg);
            });
        });
    </script>
</body>
</html>