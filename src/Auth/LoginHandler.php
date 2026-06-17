<?php
/**
 * SISTEMA MATRIZ - PROSERVIPOL
 * Manejador de Login Server-Side
 * @author Denis Quezada Lemus - Arquitecto de Soluciones
 * @compatibility PHP 5.1.2
 * @date 2025
 * 
 * Procesa peticiones POST de login desde el frontend, eliminando
 * la necesidad de llamadas directas a API externa desde JavaScript.
 */

// Incluir dependencias
require_once dirname(__FILE__) . '/Middleware.php';

// Configurar respuesta JSON
header('Content-Type: application/json');

// Solo permitir método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array(
        'success' => false,
        'error' => 'Método no permitido',
        'code' => 405
    ));
    exit;
}

// Obtener datos del formulario
$rut = isset($_POST['rut_funcionario']) ? trim($_POST['rut_funcionario']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Validar campos requeridos
if (empty($rut) || empty($password)) {
    echo json_encode(array(
        'success' => false,
        'error' => 'Por favor, ingrese RUT y contraseña.',
        'code' => 400
    ));
    exit;
}

// Limpiar RUT (quitar puntos y guión)
$rut_limpio = str_replace('.', '', $rut);
$rut_limpio = str_replace('-', '', $rut_limpio);
$rut_limpio = strtoupper($rut_limpio);

// Validar formato de RUT (7-8 dígitos + dígito verificador)
if (!preg_match('/^[0-9]{7,8}[0-9K]$/', $rut_limpio)) {
    echo json_encode(array(
        'success' => false,
        'error' => 'El RUT ingresado no es válido. Verifique el dígito verificador.',
        'code' => 400
    ));
    exit;
}

// Crear instancia del middleware
$middleware = new Middleware();

// Procesar login
$login_success = $middleware->processLogin($rut_limpio, $password);

if ($login_success) {
    // Login exitoso
    echo json_encode(array(
        'success' => true,
        'message' => 'Inicio de sesión exitoso',
        'redirect' => 'index.php',
        'data' => array(
            'codigo_funcionario' => $_SESSION['USUARIO_CODIGOFUNCIONARIO']
        )
    ));
} else {
    // Login fallido
    $error_message = $middleware->error_message;
    $error_code = $middleware->error_code;
    
    // Mapear errores a mensajes amigables
    $friendly_error = _mapErrorToFriendlyMessage($error_message, $error_code);
    
    echo json_encode(array(
        'success' => false,
        'error' => $friendly_error,
        'code' => $error_code,
        'debug' => $error_message // Solo en desarrollo
    ));
}

/**
 * Mapea errores técnicos a mensajes amigables para el usuario
 * @param string $error_message - Mensaje de error original
 * @param int $error_code - Código de error
 * @return string - Mensaje amigable
 */
function _mapErrorToFriendlyMessage($error_message, $error_code) {
    // Errores de autenticación
    if (strpos(strtolower($error_message), 'credenciales') !== false) {
        return 'Las credenciales no son válidas. Verifique su RUT y contraseña.';
    }
    
    if (strpos(strtolower($error_message), 'inactivo') !== false) {
        return 'Su cuenta no está activa. Contacte al administrador.';
    }
    
    if (strpos(strtolower($error_message), 'no existe') !== false) {
        return 'Usuario no registrado en sistema local.';
    }
    
    // Errores de conexión
    if ($error_code == CURLE_COULDNT_CONNECT || 
        strpos(strtolower($error_message), 'conexión') !== false ||
        strpos(strtolower($error_message), 'conexion') !== false) {
        return 'Error de conexión con el servicio de autenticación. Intente nuevamente.';
    }
    
    if ($error_code == CURLE_OPERATION_TIMEDOUT) {
        return 'La conexión ha tardado demasiado. Verifique su red e intente nuevamente.';
    }
    
    // Errores de BD
    if (strpos(strtolower($error_message), 'base de datos') !== false) {
        return 'Error de conexión a la base de datos. Contacte al administrador.';
    }
    
    // Error por defecto
    return 'Error al iniciar sesión. Intente nuevamente más tarde.';
}
?>
