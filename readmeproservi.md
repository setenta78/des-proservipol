# Documentación del Proyecto Proservipol - Implementación del Login y Avances

Este documento detalla los pasos realizados para implementar y solucionar el login en el sistema Proservipol, alojado en `http://des-proservipol.carabineros.cl/`, desde el 1 de julio de 2025 hasta el 4 de julio de 2025. También incluye los códigos actuales que funcionan, un plan para mejoras futuras, y documenta el estado actual con un error de sintaxis en `proteccion.php`.

## Contexto Inicial
- **Fecha de Inicio**: 10:40 AM -04, martes 1 de julio de 2025.
- **Entorno**: Servidor Red Hat 4, PHP 5.1.2, MySQL 5.0.77, sin internet público, usando cURL nativo, solo HTTP.
- **Servidor de Aplicación**: `des-proservipol.carabineros.cl` (IP 172.21.200.145).
- **Servidor de Base de Datos**: IP 172.21.111.67 (host de `proservipol_test`).
- **Credenciales Iniciales**: DB_USER = `dquezada`, DB_PASS = `Dennis2025#$`, DB = `proservipol_test`.
- **API**: `autentificaticapi.carabineros.cl` (IP 172.21.242.69).
- **Objetivo**: Implementar un login funcional con la API Autentificatic y conectar con la base de datos.

## Pasos Realizados

### 1. Diagnóstico Inicial (1 de julio de 2025, 10:40 AM -04)
- **Problema**: Fallo en la conectividad con la API (`Couldn't resolve host 'autentificaticapi.carabineros.cl'`) y problemas de acceso a la base de datos (`Access denied for user 'cgonzalez'@'172.21.200.145'`).
- **Acciones**:
  - Verificación de puertos abiertos con `netstat -tuln` y `telnet 172.21.111.67 3306`.
  - Creación de `check_ports.php` para probar conectividad con `fsockopen`.
  - Identificación de la falta de resolución DNS y bloqueo ICMP (100% packet loss en `ping 172.21.111.67`, pero conexión exitosa en `telnet`).

### 2. Resolución de Conectividad de Red (1 de julio de 2025, 11:05 AM -04)
- **Problema**: No se resolvía `autentificaticapi.carabineros.cl`.
- **Acciones**:
  - Actualización de `/etc/hosts` con `172.21.242.69 autentificaticapi.carabineros.cl`.
  - Prueba con `test_curl.php`, que mostró un código 302 (redirección a `/api/auth/login`).
  - Ajuste de `test_curl.php` con `CURLOPT_FOLLOWLOCATION` para manejar redirecciones.

### 3. Corrección de Errores en PHP (1 de julio de 2025, 11:11 AM -04)
- **Problema**: Error `Fatal error: Call to undefined function json_decode()` en `login.php` y `Parse error` en `config.env.php`.
- **Acciones**:
  - Identificación de la incompatibilidad de `json_decode()` en PHP 5.1.2.
  - Uso de `Services_JSON.php` como alternativa, ajustando la ruta de inclusión.
  - Corrección de sintaxis en `config.env.php` (de `var $DB_PASS = "Dennis2025" . "#$";` a `var $DB_PASS = "Dennis2025#$";`).

### 4. Conexión a la Base de Datos (1 de julio de 2025, 05:13 PM -04)
- **Problema**: Error de autenticación a `proservipol_test` con usuario `cgonzalez`.
- **Acciones**:
  - Creación de `test_db.php` para probar la conexión.
  - Ajuste de `Conexion.class.php` para usar constantes de `configV4.inc.php`.
  - Coordinación con TI para otorgar permisos a `dquezada@172.21.200.145`.

### 5. Implementación del Login (4 de julio de 2025, 08:55 AM -04)
- **Problema**: Error 400 ("No tiene acceso a esta plataforma") tras autenticación exitosa.
- **Acciones**:
  - Ajuste de `login.php` para enviar datos con Axios en `x-www-form-urlencoded`.
  - Creación de `save_token.php` para guardar el `access_token` en la sesión.
  - Corrección de la ruta de `Services_JSON.php` a `inc/Services_JSON.php`.
  - Eliminación de la contraseña en el login para hacer match con `US_LOGIN` (código de funcionario).

### 6. Estado Actual (4 de julio de 2025, 11:30 AM -04)
- **Éxito**: Login redirige a `http://des-proservipol.carabineros.cl/unidades.php?login=true`.
- **Problema**: `Parse error: syntax error, unexpected '[' in /systema/web/des-proservipol/proteccion.php on line 17`.
- **Acciones Pendientes**:
  - Corregir el error en `proteccion.php`.
  - Documentar el código actual.

## Códigos Funcionantes Actuales

### `login.php`
```php
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-login">
    <div class="margintop-login">
        <div class="carabineros">
            <div style="width: 100%; text-align: center;">
                <img src="assets/images/carabineros.png" width="70" height="auto">
            </div>
            <div style="line-height: 32px; width: 70%; float: right; text-align: left;">
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
                </form>
            </div>
        </div>
    </div>
    <div id="popup" class="overlay">
        <div id="popupBody">
            <h2>Objetivo del sistema</h2>
            <a id="cerrar" href="#">×</a>
            <div class="popupContent">
                <p>RECUERDE: SI SU REQUERIMIENTO NO PUEDE SER RESUELTO VIA TELEFÓNICA DEBE INGRESAR AL MÓDULO DE SOLICITUDES.</p>
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
```
### `save_token.php`
```php
<?php
session_start();
header('Content-Type: application/json');

// Ajustar la ruta al directorio inc/ dentro de systema\web\des-proservipol\
require_once 'inc/Services_JSON.php';

$json = new Services_JSON();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : '';
    $expires_at = isset($_POST['expires_at']) ? $_POST['expires_at'] : '';
    $token_type = isset($_POST['token_type']) ? $_POST['token_type'] : '';

    if ($access_token && $expires_at && $token_type) {
        $_SESSION['access_token'] = $access_token;
        $_SESSION['expires_at'] = $expires_at;
        $_SESSION['token_type'] = $token_type;
        echo $json->encode(array('success' => true, 'access_token' => $access_token));
    } else {
        echo $json->encode(array('success' => false, 'message' => 'Datos incompletos'));
    }
} else {
    echo $json->encode(array('success' => false, 'message' => 'Método no permitido'));
}
?>
```
### `valida.php`
```php
<?php
session_start();
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
require("./objetos/usuario.class.php");
require("./objetos/perfil.class.php");
require("./objetos/funcionario.class.php");
require("./objetos/unidad.class.php");
require("./objetos/escalafon.class.php");
require("./objetos/grado.class.php");

$userName = $_POST['textUsuario'];
$clave = 'dummy';
$aplicacion = 10;
$ip = $_SERVER['REMOTE_ADDR'];
$fecha_hra_inicio = date("Y/m/d H:i:s");

$msjCargo = "ATENCION :\\n\\nEL USUARIO NO REGISTRA EL CARGO DE ENCARGADO DE PROSERVIPOL, SE SOLICITA REGULARIZAR ESTA SITUACION A LA BREVEDAD \\nCONSULTAS REALIZARLAS AL CORREO: correo.proservipol@carabineros.cl.";
$msjAUsuarios = "ATENCION!! \\n\\nAL MOMENTO DE SOLICITAR ALGUN REQUERIMIENTO VIA CORREO ELECTRÓNICO PARA LA SOLUCIÓN DE PROBLEMAS CON EL SISTEMA PROSERVIPOL V3.9, USTED DEBERÁ INCLUIR LOS SIGUIENTES DATOS: \\n\\n1.- PARA HABILITAR FUNCIONARIOS REINTEGRADOS: DEBE INDICAR EL CÓDIGO DEL FUNCIONARIO.\\n\\n2.- PARA HABILITACIÓN DE VEHICULOS: DEBE INDICAR EL CÓDIGO B.C.U.\\n\\n3.- PARA HABILITACIÓN DE ARMAS: DEBE INDICAR EL NÚMERO DE SERIE DEL ARMAMENTO.\\n CONSULTAS REALIZARLAS A : correo.proservipol@carabineros.cl.";

$objDBUsuarios = new dbUsuarios;
$usuario = new usuario();
$usuario->setUserName($userName);
$usuario->setClave($clave);

$objDBUsuarios->validaUsuario($userName, $usuario);

if (is_object($usuario)) {
    $userName = $usuario->getUserName();
    if ($userName != $_POST['textUsuario']) {
        error_log("Usuario no coincide: Esperado " . $_POST['textUsuario'] . ", Obtenido " . $userName);
        echo "<script>self.location.href='index.php?ctrl=1';</script>";
        exit;
    }

    $codigoFuncionario = $usuario->getFuncionario()->getCodigoFuncionario();
    $gradoUsuario = $usuario->getFuncionario()->getGrado()->getDescripcion();
    $nombreUsuario = $usuario->getFuncionario()->getNombreCompleto();

    $gradoUsuarioPadre = $usuario->getFuncionario()->getGrado()->getDescripcion();
    $nombreUsuarioPadre = $usuario->getFuncionario()->getNombreCompleto();
    $codigoFuncPadre = $usuario->getFuncionario()->getCodigoFuncionario();
    $codigoUnidadUsuario = $usuario->getUnidad()->getCodigoUnidad();
    $descUnidadUsuario = $usuario->getUnidad()->getDescripcionUnidad();
    $tienePlanCuadrante = $usuario->getUnidad()->getTienePlanCuadrante();
    $codigoPerfil = $usuario->getPerfil()->getCodigoPerfil();
    $perfil = $usuario->getPerfil()->getDescripcionPerfil();
    $codigoUnidadPadre = $usuario->getUnidad()->getPadreUnidad()->getCodigoUnidad();
    $unidadBloqueo = $usuario->getUnidad()->getBloqueada();
    $unidadEspecialidad = $usuario->getUnidad()->getEspecialidad();
    $unidadEspecialidadO = $usuario->getUnidad()->getEspecialidadOld();
    $tipoUnidad = $usuario->getUnidad()->getTipoUnidad();
    $contieneHijos = $usuario->getUnidad()->getContieneHijos();
    $cargo = $usuario->getFuncionario()->getCargo();
    $UnidadTipo = $usuario->getUnidad()->getUnidadTipo();
    $tipoUnidadNew = $usuario->getUnidad()->getTipoUnidadNew();
    $especialidadUnidadNew = $usuario->getUnidad()->getEspecialidadUnidadNew();
    $tipoUnidadPadre = $usuario->getUnidad()->getTipoUnidadPadre()->getTipoUnidad();
    $fechaLimite = $usuario->getFechaLimite();
    $permisoValidar = $usuario->getPerfil()->getPermisoValidar();
    $permisoRegistrar = $usuario->getPerfil()->getPermisoRegistrar();
    $permisoConsultarUnidad = $usuario->getPerfil()->getPermisoConsultarUnidad();
    $permisoConsultarPerfil = $usuario->getPerfil()->getPermisoConsultarPerfil();

    $arr1 = array('CF1','CF2','CF3');
    $arr2 = array('CUAD1','CUAD2');
    $arr3 = array('DF1','DF2','DF3');
    $array1 = array('1','VEH','KM_INICIAL','KM_FINAL',$arr1,$arr2,$arr3);
    $array2 = array('1','VEH','KM_INICIAL','KM_FINAL',$arr1,$arr2,$arr3);
    $arrFinla = array($array1, $array1);

    $_SESSION['USUARIO_USERNAME'] = $userName;
    $_SESSION['USUARIO_CLAVE'] = $clave;
    $_SESSION['USUARIO_FECHALIMITE'] = $fechaHoy;
    $_SESSION['DIRECCION_IP'] = $ip;
    $_SESSION['HORA_INICIO'] = $fecha_hra_inicio;

    $_SESSION['USUARIO_CODIGOFUNCIONARIO'] = $codigoFuncionario;
    $_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'] = $codigoFuncionario;

    $_SESSION['USUARIO_GRADO'] = $gradoUsuario;
    $_SESSION['USUARIO_GRADO_ORIGEN'] = $gradoUsuario;

    $_SESSION['USUARIO_NOMBRE'] = $nombreUsuario;
    $_SESSION['USUARIO_NOMBRE_ORIGEN'] = $nombreUsuario;

    $_SESSION['USUARIO_CODIGOPERFIL'] = $codigoPerfil;
    $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'] = $codigoPerfil;

    $_SESSION['USUARIO_PERFIL'] = $perfil;
    $_SESSION['USUARIO_PERFIL_ORIGEN'] = $perfil;

    $_SESSION['USUARIO_CODIGOUNIDAD'] = $codigoUnidadUsuario;
    $_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN'] = $codigoUnidadUsuario;

    $_SESSION['USUARIO_TIPOUNIDAD'] = $tipoUnidad;
    $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'] = $tipoUnidad;

    $_SESSION['USUARIO_DESCRIPCIONUNIDAD'] = $descUnidadUsuario;
    $_SESSION['USUARIO_DESCRIPCIONUNIDAD_ORIGEN'] = $descUnidadUsuario;

    $_SESSION['USUARIO_CODIGOPADREUNIDAD'] = $codigoUnidadPadre;
    $_SESSION['USUARIO_CODIGOPADREUNIDAD_ORIGEN'] = $codigoUnidadPadre;

    $_SESSION['USUARIO_CONTIENEHIJOS'] = $contieneHijos;
    $_SESSION['USUARIO_CONTIENEHIJOS_ORIGEN'] = $contieneHijos;

    $_SESSION['USUARIO_UNIDADPLANCUADRANTE'] = $tienePlanCuadrante;
    $_SESSION['USUARIO_UNIDADPLANCUADRANTE_ORIGEN'] = $tienePlanCuadrante;

    $_SESSION['USUARIO_UNIDADBLOQUEO'] = $unidadBloqueo;
    $_SESSION['USUARIO_UNIDADBLOQUEO_ORIGEN'] = $unidadBloqueo;

    $_SESSION['USUARIO_UNIDADESPECIALIDAD'] = $unidadEspecialidad;
    $_SESSION['USUARIO_UNIDADESPECIALIDAD_ORIGEN'] = $unidadEspecialidad;

    $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD'] = $unidadEspecialidadO;
    $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD_ORIGEN'] = $unidadEspecialidadO;

    $_SESSION['USUARIO_UNIDADTIPO'] = $UnidadTipo;
    $_SESSION['USUARIO_UNIDADTIPO_ORIGEN'] = $UnidadTipo;

    $_SESSION['USUARIO_TIPO_UNIDAD'] = $tipoUnidadNew;
    $_SESSION['USUARIO_TIPO_UNIDAD_ORIGEN'] = $tipoUnidadNew;
    $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD'] = $especialidadUnidadNew;
    $_SESSION['USUARIO_ESPECIALIDAD_UNIDAD_ORIGEN'] = $especialidadUnidadNew;

    $_SESSION['FECHA_LIMITE'] = date("d-m-Y", strtotime($fechaLimite));

    $_SESSION['PERMISO_VALIDAR'] = $permisoValidar;
    $_SESSION['PERMISO_REGISTRAR'] = $permisoRegistrar;
    $_SESSION['PERMISO_CONSULTAR_UNIDAD'] = $permisoConsultarUnidad;
    $_SESSION['PERMISO_CONSULTAR_PERFIL'] = $permisoConsultarPerfil;

    $objDBUsuarios = new dbUsuarios;
    $objDBUsuarios->insertBitacoraUsuario($codigoFuncionario, $codigoUnidadUsuario, $fecha_hra_inicio, $ip, $codigoPerfil);

    if (($permisoConsultarUnidad && !$permisoValidar) || $permisoConsultarPerfil) {
        $paginaInicio = "unidades.php?login=true";
    } else {
        if ($permisoValidar) {
            $paginaInicio = "certificacionServicio.php?login=true";
        } else if ($permisoRegistrar && ($tipoUnidad == 30 || $tipoUnidad == 120)) {
            $paginaInicio = "serviciosUnidadesEspecializadas.php?login=true";
        } else if ($permisoRegistrar) {
            $paginaInicio = "servicios.php?login=true";
        }
    }

    header("Location: " . $paginaInicio);
    exit;
} else {
    error_log("Validación de usuario falló para: " . $userName);
    echo "<script>";
    echo "sessionStorage.removeItem('access_token');";
    echo "sessionStorage.removeItem('expires_at');";
    echo "sessionStorage.removeItem('token_type');";
    echo "self.location.href='index.php?ctrl=1';";
    echo "</script>";
}
?>
```
### `proteccion.php`
```php
<?php
session_start();

if (!isset($_SESSION['access_token']) || time() > strtotime($_SESSION['expires_at'])) {
    error_log("Sesión inválida o expirada en " . date('Y-m-d H:i:s') . ": " . print_r($_SESSION, true));
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

function validarToken($token) {
    $url = "http://autentificaticapi.carabineros.cl/api/auth/validate-token";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $token,
        'Accept: application/json'
    ));

    $response = curl_exec($ch);
    if ($response === false) {
        error_log("Error en cURL para validar token: " . curl_error($ch));
    }
    curl_close($ch);

    require_once './inc/Services_JSON.php';
    $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
    $result = $json->decode($response);

    if (is_object($result) && !isset($result->success)) {
        error_log("Token inválido: " . $response);
        return false;
    }
    return true;
}

$token = $_SESSION['access_token'];
if (!validarToken($token)) {
    error_log("Validación de token falló para usuario: " . (isset($_SESSION['codigo_funcionario']) ? $_SESSION['codigo_funcionario'] : 'Desconocido'));
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
```
### `validar_token.php`
```php
<?php
session_start();

function validateToken() {
    if (!isset($_SESSION['access_token'])) {
        echo "<script>alert('Sesión no iniciada'); self.location.href='index.php?ctrl=1';</script>";
        exit;
    }

    $url = "http://autentificaticapi.carabineros.cl/api/auth/validate-token";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $_SESSION['access_token'],
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    require("./inc/Services_JSON.php");
    $json = new Services_JSON();
    $result = $json->decode($response);

    if ($http_code != 200 || !isset($result->success)) {
        echo "<script>alert('Token no válido'); self.location.href='index.php?ctrl=1';</script>";
        exit;
    }
}
?>
```
### `tiempo.php`
```php
<?php 
include("session.php");
include("./inc/configV4.inc.php");
include("./baseDatos/Conexion.class.php");
require("./baseDatos/dbUsuarios.class.php");
require("./objetos/usuario.class.php");
require("./objetos/perfil.class.php");
require("./objetos/funcionario.class.php");
require("./objetos/unidad.class.php");

$codigoFuncionarioUsuarioT = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$unidadUsuarioT = $_SESSION['USUARIO_CODIGOUNIDAD'];
$fecha_hra_inicioT = $_SESSION['HORA_INICIO'];
$hora_actualT = date("Y/m/d H:i:s");
$codigoPerfilT = $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];

$tiempo_transcurridoT = ceil((strtotime($hora_actualT) - strtotime($fecha_hra_inicioT)));
$eventoT = "CIERRE DE SESION: INACTIVIDAD";

if ($tiempo_transcurridoT >= 900 && $codigoPerfilT != 90 && $codigoPerfilT != 100 && $codigoPerfilT != 180) {
    $objDBUsuarios = new dbUsuarios;
    $objDBUsuarios->modificaBitacoraUsuario($codigoFuncionarioUsuarioT, $unidadUsuarioT, $fecha_hra_inicioT, $hora_actualT, $codigoPerfilT, $eventoT);
    session_start();
    session_unset();
    session_destroy();
    echo '<script type="text/javascript">alert("SU SESION HA EXPIRADO POR INACTIVIDAD ' . $codigoFuncionarioUsuarioT . ', PARA CONTINUAR DEBE INICIAR SESION NUEVAMENTE.");window.location.href="index.php";</script>';
} else {
    $_SESSION['HORA_INICIO'] = $fecha_hra_inicioT;
}
?>
```
### `unidades.php`
```php
<?php
include("version.php");
include("session.php");
include("tiempo.php");
include("proteccion.php");
$perfil = $_SESSION['USUARIO_PERFIL'];
session_start();
$nombreUsuario = $_SESSION['USUARIO_NOMBRE'];
$gradoUsuario = $_SESSION['USUARIO_GRADO'];
$codigoFuncionario = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="./css/arbolUnidad.css?v=<?echo version?>" rel="stylesheet" type="text/css" />
<link href="./css/aplicacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="./js/crearArbolFiscalizador.js?v=<?echo version?>"> </script>
<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/aplicacion.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./js/usuario.js?v=<?echo version?>"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<?include("header.php");?>
</head>
<body onload="actualizarTamanoLista('listado');" onresize="actualizarTamanoLista('listado');">
	<div id="cubreFondo" style="display:none;"></div>
	<input id="unidadOrigen" type="hidden" readonly="yes" value="<?echo $codOrigen?>">
	<input id="codigoPerfilOrigen" type="hidden" readonly="yes" value="<?echo $codigoPerfilOrigen?>">
	<? if($permisoConsultarPerfil){ ?>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;" >
		<div style="height:10px"></div>
		<table><tr>
		<td width="120px"><div id="titulo">Entrar como:</div></td>
		<td width="150px"><input id="codFuncionario" type="text" maxlength="7" value="" /></td>
		<td width="150px"><input type="button" value="Entrar" onclick="cambiarUsuario(document.getElementById('codFuncionario').value)" /></td>
		</tr></table>
		<div style="height:10px"></div>
		<table width="100%"><tr class="linea"><td></td></tr></table>
	</div>
	<? } ?>
	<? if($permisoConsultarUnidad){ ?>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;" >
		<div style="height:10px"></div>
		<table><tr>
		<td width="120px"><div id="titulo">Buscar Unidad:</div></td>
		<td width="150px"><input id="textUnidad" type="text" style="text-transform:uppercase" onKeyup="buscarUnidad(this.value)" /></td>
		</tr></table>
		<div style="height:10px"></div>
		<table width="100%"><tr class="linea"><td></td></tr></table>
	</div>
	<? } ?>
	<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div style="height:2px"></div>
		<div id="listado">
			<div class="arbol" id="arbol" >
				<div id="TipoBase" onclick="cambiar('<? echo $codOrigen; ?>')" onmouseover="cambiarClase(this,'resaltar')" OnMouseOut="cambiarClase(this,'arbol')">
				<img src='img/base.gif' /><a><? if($codOrigen==20){echo "NIVEL NACIONAL ";}else{echo $desOrigen;} ?></a></div>
				<div id="NodosBase"></div>
			</div>
			<div style="height:2px"></div>
			</div>
	</div>
	<table width="100%"><tr class="linea"><td></td></tr></table>
<? include("modal-popup.php"); ?>
<div style="position: absolute; top: 10px; left: 10px; color: black;">
    CARABINEROS DE CHILE - CONTRALORIA GRAL. DE CARABINEROS<br>
    <?php echo "$codigoFuncionario - $gradoUsuario $nombreUsuario (PERFIL: $perfil)"; ?>
</div>
</body>
</html>
<script type="text/javascript" >
	if(<? echo $tipoCuartelOrigen; ?>==120) CrearPrimerArbol(<? echo "'".$codigoUnidadPadre."','".$codigoPerfilOrigen."'"; ?>);
	else CrearPrimerArbol(<? echo "'".$codOrigen."','".$codigoPerfilOrigen."'"; ?>);
</script>
```
### `logout.php`
```php
<?php
session_start();
$token = $_SESSION['jwtToken'];

if ($token) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://des-proservipol.carabineros.cl/api/auth/logout');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    curl_exec($ch);
    curl_close($ch);
}

session_destroy();
header('Location: login.php');
?>
```
### `header.php`
```php
<?
$codigoFuncionarioUsuario	= $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
$gradoUsuario				= $_SESSION['USUARIO_GRADO'];
$nombreCompletoUsuario		= $_SESSION['USUARIO_NOMBRE'];
$codigoPerfil				= $_SESSION['USUARIO_CODIGOPERFIL'];
$perfil						= $_SESSION['USUARIO_PERFIL'];
$unidadUsuario				= $_SESSION['USUARIO_CODIGOUNIDAD'];
$tipoUnidad					= $_SESSION['USUARIO_TIPOUNIDAD'];
$descripcionUnidadUsuario	= $_SESSION['USUARIO_DESCRIPCIONUNIDAD'];
$unidadBloqueada			= $_SESSION['USUARIO_UNIDADBLOQUEO'];
$unidadEspecialidad			= $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD'];

$codigoUnidadPadre			= $_SESSION['USUARIO_CODIGOPADREUNIDAD'];
$tipoCuartel				= $_SESSION['USUARIO_TIPO_UNIDAD'];
$tipoCuartelOrigen			= $_SESSION['USUARIO_TIPO_UNIDAD_ORIGEN'];

$codigoFunUsuarioOrigen		= $_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'];
$gradoUsuarioOrigen			= $_SESSION['USUARIO_GRADO_ORIGEN'];
$nombreCompletoUsuarioOrigen= $_SESSION['USUARIO_NOMBRE_ORIGEN'];
$codigoPerfilOrigen			= $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'];
$descripcionPerfilUsuario	= $_SESSION['USUARIO_PERFIL_ORIGEN'];
$codOrigen					= $_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN'];
$tipoUnidadOrigen			= $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'];
$desOrigen					= $_SESSION['USUARIO_DESCRIPCIONUNIDAD_ORIGEN'];
$tipoUnidadOrigen			= $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'];
$codigoUnidadPadreOrigen	= $_SESSION['USUARIO_CODIGOPADREUNIDAD_ORIGEN'];

$fechaLimite				= $_SESSION['FECHA_LIMITE'];
$fecha_hra_inicio			= $_SESSION['HORA_INICIO'];
$textoNombreUsuario			= $codigoFuncionarioUsuario." - ".$gradoUsuario." ".$nombreCompletoUsuario." (PERFIL: " .$perfil. ")";
$textoNombreUsuarioOrigen 	= $codigoFunUsuarioOrigen." - ".$gradoUsuarioOrigen." ".$nombreCompletoUsuarioOrigen." (PERFIL: ".$descripcionPerfilUsuario.")";
$anchoIzquierda				= "53%";
$contraloria				= "CONTRALORIA GRAL. DE CARABINEROS";
$departamento				= "DEPTO. CONTROL DE GESTI&Oacute;N Y SIST. DE INFORMACI&Oacute;N";

$permisoValidar = $_SESSION['PERMISO_VALIDAR'];
$permisoRegistrar = $_SESSION['PERMISO_REGISTRAR'];
$permisoConsultarUnidad = $_SESSION['PERMISO_CONSULTAR_UNIDAD'];
$permisoConsultarPerfil = $_SESSION['PERMISO_CONSULTAR_PERFIL'];

if($codigoPerfil==90){
	$descripcionFiscalizador = $departamento;
	$descripcionFiscalizador .= ($unidadUsuario==20) ? "" : " - ".$descripcionUnidadUsuario;
}
elseif($codigoPerfil==100 || $codigoPerfil==150){
	$descripcionFiscalizador = $contraloria;
	$descripcionFiscalizador .= ($unidadUsuario==20) ? "" : " - ".$descripcionUnidadUsuario;
}
else{
	$descripcionFiscalizador = $descripcionUnidadUsuario;
}

?>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
<link href="./css/menuNavegacion.css?v=<?echo version?>" rel="stylesheet" type="text/css">
<div id="banner">
	<div class="logo"><img src="images/logoDepartamentoP.png" width="75px" height="75px" /></div>
	<div class="bannerTitle"><img src="images/banner_titulo.png" width="320px" height="50px" /></div>
</div>
<div class="backHeader"></div>
<div id="usuario">
	<div id="nombreUnidad">CARABINEROS DE CHILE - <? echo $descripcionFiscalizador; ?> </div>
	<div id="linea1"></div>
	<div id="nombreUsuario"><? echo ($codigoFuncionarioUsuario!=$codigoFunUsuarioOrigen) ? $textoNombreUsuarioOrigen." || " : ""; ?> <? echo $textoNombreUsuario; ?></div>
</div>
<nav class="nav">
	<button class="menu-toggle"><i class="fa fa-bars"></i></button>
	<ul class="nav-main-menu">
		<? if(!(($permisoConsultarUnidad || $permisoConsultarPerfil) && ($unidadUsuario==20))){ ?>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Validar</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='capacitados.php';" ><a href="capacitados.php">Usuarios Proservipol</a></li>
				<li onclick="window.location='certificacionServicio.php';" ><a href="certificacionServicio.php">Validar</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Servicios</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<? if($tipoUnidad == 30 || $tipoUnidad == 120){ ?>
					<li onclick="window.location='serviciosUnidadesEspecializadas.php';" ><a href="serviciosUnidadesEspecializadas.php">Servicios</a></li>
				<? }else { ?>
					<li onclick="window.location='servicios.php';" ><a href="servicios.php">Servicios</a></li>
				<? } ?>
				<li onclick="window.location='actividadFueraCuartel.php';"><a href="actividadFueraCuartel.php">Comisi&oacute;n de Servicio</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Personal</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='personal.php';" ><a href="personal.php">Personal Unidad</a></li>
				<li onclick="window.location='personal.php?subSeccion=agregado';" ><a href="personal.php?subSeccion=agregados">Personal Agregado al Cuartel</a></li>
				<li onclick="window.location='personal.php?subSeccion=destinados';" ><a href="personal.php?subSeccion=destinados">Personal Destinado a Servicios en este Cuartel</a></li>
				<li onclick="window.location='licenciasDeConducir.php';" ><a href="licenciasDeConducir.php">Licencias de Conducir</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Licencias y Permisos</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='ferper.php';" ><a href="ferper.php">FERPER</a></li>
				<li onclick="window.location='licenciasMedicas.php';" ><a href="licenciasMedicas.php">Licencias Medicas</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Recursos Log&iacute;sticos</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>Veh&iacute;culos</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location='vehiculos.php';" ><a href="vehiculos.php">Veh&iacute;culos</a></li>
						<li onclick="window.location='vehiculos.php?subSeccion=agregados';" ><a href="vehiculos.php?subSeccion=agregados">Veh&iacute;culos agregados</a></li>
					</ul>
				</li>
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>Armas</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location='armas.php';" ><a href="armas.php">Armas</a></li>
						<li onclick="window.location='armas.php?subSeccion=agregado';" ><a href="armas.php?subSeccion=agregados">Armas agregadas</a></li>
					</ul>
				</li>
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>C&aacute;maras Corporales</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location='camarasCorporales.php';" ><a href="camarasCorporales.php">C&aacute;maras Corporales</a></li>
						<li onclick="window.location='camarasCorporales.php?subSeccion=agregados';" ><a href="camarasCorporales.php?subSeccion=agregados">C&aacute;maras Corporales agregadas</a></li>
					</ul>
				</li>
				<li class="sub-dropdown">
					<a href="#" class="dropdown-link"><span>Animales</span> <i class="fa fa-chevron-right"></i></a>
					<ul class="sub-dropdown-content">
						<li onclick="window.location='animales.php';" ><a href="animales.php">Animales</a></li>
						<li onclick="window.location='animales.php?subSeccion=agregado';" ><a href="animales.php?subSeccion=agregados">Animales agregados</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Solicitudes</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='solicitudes.php';" ><a href="solicitudes.php">En tramite</a></li>
				<li onclick="window.location='solicitudesUnidadCerradas.php';" ><a href="solicitudesUnidadCerradas.php">Cerradas</a></li>
			</ul>
		</li>
		<? }
		if($codigoPerfilOrigen==90 || ($permisoConsultarUnidad || $permisoConsultarPerfil)){ ?>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Mesa de Ayuda</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="aparece_arbol();" ><a href="#" onclick="aparece_arbol();">Fiscalizaci&oacute;n</a></li>
				<? if($codigoPerfilOrigen==90){ ?>
				<li onclick="window.location='claveUsuario.php';" ><a href="claveUsuario.php">Gesti&oacute;n Usuario</a></li>
				<? } ?>
				<? if($codigoPerfilOrigen==90){ ?>
				<li onclick="window.location='certificadoCurso.php';" ><a href="certificadoCurso.php">Certificado Curso</a></li>
				<? } ?>
			</ul>
		</li>
		<? } ?>
		<li class="dropdown">
			<a href="#" class="nav-link"><span>Configuraci&oacute;n</span> <i class="fa fa-chevron-down"></i></a>
			<ul class="dropdown-content">
				<li onclick="window.location='consultas.php';" ><a href="consultas.php">Consultas</a></li>
				<li onclick="window.location='configuracion.php';" ><a href="configuracion.php">Cuadrantes</a></li>
				<li onclick="abrirVentanaUsuario();" ><a href="javascript:abrirVentanaUsuario()">Modifica Clave</a></li>
				<li onclick="cerrarAplicacion();" ><a href="javascript:cerrarAplicacion()">Cerrar</a></li>
			</ul>
		</li>
	</ul>
</nav>
<script>
	function aparece_arbol(){
		window.location="unidades.php";
	}
</script>
```
### `version.php`
```php
<?
define("version", "20250430-1730");
?>
```
### `dbUsuarios.class.php.php`
```php
<?
Class dbUsuarios extends Conexion {
    function validaUsuario($login, &$usuario) {
        $sql = "SELECT 
                    FUNCIONARIO.ESC_CODIGO,
                    FUNCIONARIO.GRA_CODIGO,
                    GRADO.GRA_DESCRIPCION,
                    USUARIO.UNI_CODIGO,
                    UNIDAD.UNI_DESCRIPCION,
                    UNIDAD.UNI_PLANCUADRANTE,
                    USUARIO.FUN_CODIGO,
                    FUNCIONARIO.FUN_APELLIDOPATERNO,
                    FUNCIONARIO.FUN_APELLIDOMATERNO,
                    FUNCIONARIO.FUN_NOMBRE,
                    USUARIO.TUS_CODIGO,
                    USUARIO.US_FECHACREACION,
                    TIPO_USUARIO.TUS_DESCRIPCION,
                    UNIDAD1.UNI_CODIGO AS COD_UNIDADPADRE,
                    UNIDAD1.UNI_DESCRIPCION AS DES_UNIDADPADRE,
                    UNIDAD1.UNI_TIPOUNIDAD AS TIPO_UNIDADPADRE,
                    UNIDAD.UNI_BLOQUEO,
                    UNIDAD.UNI_TIPOUNIDAD,
                    UNIDAD.UNI_CONTIENEHIJOS,
                    UNIDAD.UNI_CODIGO_ESPECIALIDAD,
                    UNIDAD.UNI_ESPECIALIDAD,
                    UNIDAD.UNI_ACTIVO,
                    IFNULL(UNIDAD.TCU_CODIGO, 0) TIPO_UNIDAD,
                    IFNULL(UNIDAD.TESPC_CODIGO, 0) ESPECIALIDAD_UNIDAD,
                    CARGO_FUNCIONARIO.CAR_CODIGO,
                    IFNULL(UNIDAD.TUNI_CODIGO, 0) TUNI_CODIGO,
                    CONFIG_SYS.FECHA_LIMITE,
                    TIPO_USUARIO.VALIDAR,
                    TIPO_USUARIO.REGISTRAR,
                    TIPO_USUARIO.CONSULTAR_UNIDAD,
                    TIPO_USUARIO.CONSULTAR_PERFIL
                FROM USUARIO
                JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
                JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
                JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
                JOIN UNIDAD ON (USUARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
                LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
                LEFT JOIN CARGO_FUNCIONARIO ON (USUARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
                JOIN CONFIG_SYS ON CONFIG_SYS.ACTIVO = 1
                WHERE USUARIO.US_LOGIN = '{$login}' AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL";
        
        $result = $this->execstmt($this->Conecta(), $sql);
        mysql_close();
        if (mysql_num_rows($result) > 0) {
            $myrow = mysql_fetch_array($result);
            
            $escalafon = new escalafon;
            $escalafon->setCodigo($myrow["ESC_CODIGO"]);
            $escalafon->setDescripcion("");
            
            $grado = new grado;
            $grado->setEscalafon($escalafon);
            $grado->setCodigo($myrow["GRA_CODIGO"]);
            $grado->setDescripcion($myrow["GRA_DESCRIPCION"]);
            
            $unidadPadre = new unidad;
            $unidadPadre->setCodigoUnidad($myrow["COD_UNIDADPADRE"]);
            $unidadPadre->setDescripcionUnidad($myrow["DES_UNIDADPADRE"]);
            $unidadPadre->setTipoUnidad($myrow["TIPO_UNIDADPADRE"]);
            
            $unidad = new unidad;
            $unidad->setCodigoUnidad($myrow["UNI_CODIGO"]);
            $unidad->setPadreUnidad($unidadPadre);
            $unidad->setDescripcionUnidad($myrow["UNI_DESCRIPCION"]);
            $unidad->setTienePlanCuadrante($myrow["UNI_PLANCUADRANTE"]);
            $unidad->setBloqueada($myrow["UNI_BLOQUEO"]);
            $unidad->setEspecialidad($myrow["UNI_CODIGO_ESPECIALIDAD"]);
            $unidad->setEspecialidadOld($myrow["UNI_ESPECIALIDAD"]);
            $unidad->setTipoUnidad($myrow["UNI_TIPOUNIDAD"]);
            $unidad->setContieneHijos($myrow["UNI_CONTIENEHIJOS"]);
            $unidad->setUnidadTipo($myrow["TUNI_CODIGO"]);
            $unidad->setTipoUnidadPadre($unidadPadre);
            $unidad->setTipoUnidadNew($myrow["TIPO_UNIDAD"]);
            $unidad->setEspecialidadUnidadNew($myrow["ESPECIALIDAD_UNIDAD"]);
            
            $funcionario = new funcionario;
            $funcionario->setCodigoFuncionario($myrow["FUN_CODIGO"]);
            $funcionario->setApellidoPaterno($myrow["FUN_APELLIDOPATERNO"]);
            $funcionario->setApellidoMaterno($myrow["FUN_APELLIDOMATERNO"]);
            $funcionario->setPNombre($myrow["FUN_NOMBRE"]);
            $funcionario->setGrado($grado);
            $funcionario->setCargo($myrow["CAR_CODIGO"]);
            
            $perfil = new perfil;
            $perfil->setCodigoPerfil($myrow["TUS_CODIGO"]);
            $perfil->setDescripcionPerfil($myrow["TUS_DESCRIPCION"]);
            $perfil->setPermisoValidar($myrow["VALIDAR"]);
            $perfil->setPermisoRegistrar($myrow["REGISTRAR"]);
            $perfil->setPermisoConsultarUnidad($myrow["CONSULTAR_UNIDAD"]);
            $perfil->setPermisoConsultarPerfil($myrow["CONSULTAR_PERFIL"]);
            
            $usuario = new usuario;
            $usuario->setUnidad($unidad);
            $usuario->setFuncionario($funcionario);
            $usuario->setUserName($login);
            $usuario->setClave($password);
            $usuario->setPerfil($perfil);
            $usuario->setFechaLimite($myrow["FECHA_LIMITE"]);
            $usuario->setPermisoActualizar("");
        }
    }

    function insertBitacoraUsuario($userID, $unidad, $hra_inicio, $ip, $perfil) {
        // Código original sin cambios
    }

    function modificaBitacoraUsuario($userID, $unidad, $hra_inicio, $hra_termino, $perfil, $evento) {
        // Código original sin cambios
    }
}
?>
```
### `Conexion.class.php`
```php
<?
class Conexion {
    var $host = HOST;
    var $user = DB_USER;
    var $pass = DB_PASS;
    var $db = DB;
    var $link_id;

    function conecta() {
        $CONECT = @mysql_connect($this->host, $this->user, $this->pass);
        if (!$CONECT) {
            $this->msgError("COD2510", $this->ErrorMsgServer());
            exit;
        } else {
            $this->link_id = $CONECT;
        }
        $db = @mysql_select_db($this->db, $CONECT);
        if (!$db) {
            $this->msgError("COD2530", $this->ErrorMsgServer());
            exit;
        } else {
            return $CONECT;
        }
    }

    function execstmt($conn, $query) {
        $result = mysql_query($query, $conn);
        if (!$result) {
            echo "El query $query es inválido: " . mysql_error();
            $this->msgError("COD2550", $this->ErrorMsgServer());
            exit;
        }
        return $result;
    }

    function myrows($result) {
        return mysql_fetch_array($result);
    }

    function msgError($tipoError, $MsgServer) {
        include("./inc/template/errores/" . $tipoError . "error.php");
        if (MSGEMAILERROR == 1) {
            $MsgErrorWebMatesr = $this->EmailMsgError($tipoError, $MsgServer);
            $subject = "Error Grave en Sitio " . SITIOWEB;
            $message = '
            <html>
            <head>
                <title>Error Grave en (' . SITIOWEB . ')</title>
            </head>
            <body>
                <p>ATENCION :</p>
                <table>
                    <tr>
                        <td align="center">
                            <font face="verdana,sans-serif" size="3" color="#003399">
                                <b>' . $MsgErrorWebMatesr . '</b>
                            </font>
                        </td>
                    </tr>
                    <tr>
                        <td><font face="verdana,sans-serif" size="2" color="#000000"><b>Soluciona de forma inmediata este problema o comuníquese con el creador de la aplicación</b></font></td>
                    </tr>
                </table>
            </body>
            </html>
            ';
            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= "From: " . FFROM;
            $headers .= "X-Priority: 1\n";
            $headers .= CC;
            $headers .= BCC;
            $headers .= "Return-Path: <mail@server.com>\n";
            $sendemail = mail(TOO, $subject, $message, $headers);
            if (!$sendemail) {
                echo "<font color=red>Error Grave: No se pudo enviar el mensaje de error a nuestros operadores, comuníquese con nuestra oficina.</font>";
            }
        }
    }

    function EmailMsgError($tipoError, $MsgServer) {
        return $this->MsgTextoError($MsgServer);
    }

    function MsgTextoError($MsgServer) {
        $msgEmailError = "Señor Webmaster Se ha Producido el siguiente Error de Conexión:<br>";
        $msgEmailError .= $MsgServer;
        return $msgEmailError;
    }

    function ErrorMsgServer() {
        if (mysql_errno() != 0) {
            $errorCapturado = mysql_errno() . " : " . mysql_error();
            return $errorCapturado;
        } else {
            return 0;
        }
    }

    function desconecta() {
        $DESCONN = @mysql_close($this->link_id);
    }
}
?>
```
### `configV4.inc.php`
```php
<?
include("config.env.php");
$enviorment = new production;
define("HOST" , $enviorment->getHost());
define("DB_USER" , $enviorment->getUser());
define("DB_PASS" , $enviorment->getPass());
define("DB" , $enviorment->getDB());
?>
```
### `config.env.php`
```php
<?
class development {
    var $HOST     = "10.25.28.93";
    var $DB_USER  = "root";
    var $DB_PASS  = "0000";
    var $DB       = "DB_PROSERVIPOL_V3";

    public function getHost() {
        return $this->HOST;
    }

    public function getUser() {
        return $this->DB_USER;
    }

    public function getPass()
```

# Mejoras Futuras

### 1. Corrección del Error en `proteccion.php`
- **Objetivo:**: Resolver el `Parse error: syntax error, unexpected '['` en la línea 17.
- **Plan:**: Revisar el código de `proteccion.php`, identificar el uso incorrecto de corchetes, y corregirlo (e.g., reemplazar `$array[$key]` por una alternativa compatible con PHP 5.1.2 si es un array dinámico).

### 2. Mejoras de Código y Buenas Prácticas
- **Objetivo:**: Refactorizar el código para seguir estándares modernos adaptados a PHP 5.1.2 (e.g., PSR-12 básico).
- **Tareas:**: 
  - Separar la lógica de autenticación en un archivo de controlador (e.g., `authController.php`).
  - Agregar validación de entrada con funciones nativas.
  - Usar constantes para URLs y claves de sesión.

### 3. Implementación del Logout
- **Objetivo:**: Crear `logout.php` para cerrar la sesión y redirigir a `index.php`.
- **Plan:**: 
  - Actualizar `logout.php` para destruir la sesión y limpiar `$_SESSION`.
  - Añadir un enlace o botón en `unidades.php`.
  
  ### Ejemplo preliminar
```php
<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit;
?>
```
### 4. Mejoras de `unidades.php`
- **Objetivo:**: Implementar un sistema para gestionar accesos (altas y bajas) basado en la API o base de datos local.
- **Plan:**: 
  - Crear endpoints o scripts PHP (e.g., `crearUsuario.php`, `eliminarUsuario.php`).
  - Integrar con `valida.php` para validar permisos de administración.
  ### Ejemplo preliminar
```php
<?php
session_start();
require_once 'inc/Services_JSON.php';
$json = new Services_JSON();

if ($_SESSION['PERMISO_REGISTRAR']) {
    // Lógica para crear usuario
    echo $json->encode(array('success' => true));
} else {
    echo $json->encode(array('success' => false, 'message' => 'Sin permisos'));
}
?>
```
