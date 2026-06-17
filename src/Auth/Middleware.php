<?php
/**
 * SISTEMA MATRIZ - PROSERVIPOL
 * Middleware Unificado de Autenticación
 * @author Denis Quezada Lemus - Arquitecto de Soluciones
 * @compatibility PHP 5.1.2
 * @date 2025
 * 
 * Fusiona las lógicas de middleware_auth.php y proteccion.php en un único punto
 * robusto de validación de sesiones y autenticación.
 */

class Middleware {
    
    /**
     * Instancia del cliente AutentificaTIC
     * @var AutentificaTicClient
     */
    var $api_client;
    
    /**
     * Enlace a base de datos local
     * @var resource
     */
    var $db_link;
    
    /**
     * Código de error actual
     * @var int
     */
    var $error_code = 0;
    
    /**
     * Mensaje de error actual
     * @var string
     */
    var $error_message = '';
    
    /**
     * Constructor - Inicializa dependencias
     */
    function Middleware() {
        // Iniciar sesión si no está iniciada
        if (session_id() == '') {
            session_start();
        }
        
        // Cargar cliente API
        require_once dirname(__FILE__) . '/Services/AutentificaTicClient.php';
        $this->api_client = new AutentificaTicClient();
        
        // Cargar configuración de BD
        require_once dirname(__FILE__) . '/../inc/config.env.php';
    }
    
    /**
     * Verifica si el usuario está autenticado
     * @return boolean - true si está autenticado, false si no
     */
    function isAuthenticated() {
        // Verificar token en sesión
        if (!isset($_SESSION['access_token'])) {
            $this->error_message = 'Token de acceso no encontrado';
            return false;
        }
        
        // Verificar expiración del token
        if (isset($_SESSION['expires_at']) && !empty($_SESSION['expires_at'])) {
            $expires_timestamp = is_numeric($_SESSION['expires_at']) 
                ? $_SESSION['expires_at'] 
                : strtotime($_SESSION['expires_at']);
            
            if (time() > $expires_timestamp) {
                $this->error_message = 'Token de acceso expirado';
                $this->logout();
                return false;
            }
        }
        
        // Verificar código de funcionario
        $codigoFuncionario = isset($_SESSION['USUARIO_CODIGOFUNCIONARIO']) 
            ? $_SESSION['USUARIO_CODIGOFUNCIONARIO'] 
            : '';
        
        if (empty($codigoFuncionario)) {
            $this->error_message = 'Código de funcionario no encontrado';
            $this->logout();
            return false;
        }
        
        return true;
    }
    
    /**
     * Valida la sesión contra API externa y BD local
     * @param boolean $check_api - Si true, valida también contra API AutentificaTIC
     * @return boolean - true si es válido, false si no
     */
    function validateSession($check_api = false) {
        if (!$this->isAuthenticated()) {
            return false;
        }
        
        $token = $_SESSION['access_token'];
        $codigoFuncionario = $_SESSION['USUARIO_CODIGOFUNCIONARIO'];
        
        // Validación opcional contra API (más lento pero más seguro)
        if ($check_api) {
            $user_info = $this->api_client->validateToken($token);
            
            if ($user_info === false) {
                $this->error_message = 'Token inválido según API AutentificaTIC: ' . $this->api_client->getErrorMessage();
                $this->logout();
                return false;
            }
        }
        
        // Validar en BD local que el usuario esté activo
        if (!$this->_validateUserInDB($codigoFuncionario)) {
            $this->logout();
            return false;
        }
        
        return true;
    }
    
    /**
     * Procesa login con credenciales
     * @param string $rut - RUT del usuario
     * @param string $password - Contraseña
     * @return boolean - true si login exitoso, false si falla
     */
    function processLogin($rut, $password) {
        // Limpiar errores previos
        $this->api_client->clearError();
        
        // Intentar login contra API AutentificaTIC
        $result = $this->api_client->login($rut, $password);
        
        if ($result === false) {
            $this->error_code = $this->api_client->getErrorCode();
            $this->error_message = $this->api_client->getErrorMessage();
            return false;
        }
        
        // Extraer datos del usuario
        $user_data = isset($result['user']) ? $result['user'] : array();
        $access_token = isset($result['access_token']) ? $result['access_token'] : '';
        $expires_at = isset($result['expires_at']) ? $result['expires_at'] : '';
        
        // Obtener código de funcionario desde respuesta
        $codigo_funcionario = '';
        if (isset($user_data['rut'])) {
            $codigo_funcionario = $user_data['rut'];
        } elseif (isset($user_data['codigo_funcionario'])) {
            $codigo_funcionario = $user_data['codigo_funcionario'];
        } else {
            $codigo_funcionario = $rut;
        }
        
        // Validar que el usuario exista en BD local y esté activo
        if (!$this->_validateUserInDB($codigo_funcionario)) {
            $this->error_message = 'Usuario no existe o está inactivo en sistema local';
            return false;
        }
        
        // Guardar sesión
        $_SESSION['access_token'] = $access_token;
        $_SESSION['expires_at'] = $expires_at;
        $_SESSION['USUARIO_CODIGOFUNCIONARIO'] = $codigo_funcionario;
        $_SESSION['USUARIO_DATA'] = $user_data;
        $_SESSION['authenticated'] = true;
        $_SESSION['auth_time'] = time();
        
        // Log de auditoría
        error_log("Middleware: Login exitoso - RUT: $codigo_funcionario - IP: " . $this->_getClientIP());
        
        return true;
    }
    
    /**
     * Valida que un usuario exista en BD local y esté activo
     * @param string $codigo_funcionario - Código/RUT del funcionario
     * @return boolean - true si existe y está activo
     */
    function _validateUserInDB($codigo_funcionario) {
        // Conectar a BD
        $this->db_link = $this->_connectDB();
        
        if (!$this->db_link) {
            $this->error_message = 'No se pudo conectar a la base de datos';
            return false;
        }
        
        // Consulta segura (escapar caracteres)
        $codigo_escaped = mysql_real_escape_string($codigo_funcionario, $this->db_link);
        
        $sql = "SELECT US_ACTIVO, TUS_CODIGO, FUN_CODIGO 
                FROM USUARIO 
                WHERE FUN_CODIGO = '$codigo_escaped' 
                AND US_LOGIN = '$codigo_escaped'
                LIMIT 1";
        
        $result = mysql_query($sql, $this->db_link);
        
        if (!$result) {
            $this->error_message = 'Error en consulta BD: ' . mysql_error($this->db_link);
            return false;
        }
        
        $row = mysql_fetch_array($result);
        
        if (!$row || $row['US_ACTIVO'] != 1) {
            $this->error_message = 'Usuario inactivo o no registrado en sistema local';
            return false;
        }
        
        return true;
    }
    
    /**
     * Conecta a la base de datos
     * @return resource|false - Enlace a BD o false
     */
    function _connectDB() {
        // Usar ambiente de producción por defecto
        $config = new production();
        
        $host = $config->getHost();
        $user = $config->getUser();
        $pass = $config->getPass();
        $db = $config->getDB();
        
        $link = mysql_connect($host, $user, $pass);
        
        if (!$link) {
            error_log("Middleware: Error conexión BD - " . mysql_error());
            return false;
        }
        
        if (!mysql_select_db($db, $link)) {
            error_log("Middleware: Error selección BD - " . mysql_error($link));
            return false;
        }
        
        return $link;
    }
    
    /**
     * Cierra sesión (logout)
     */
    function logout() {
        // Log de auditoría
        if (isset($_SESSION['USUARIO_CODIGOFUNCIONARIO'])) {
            error_log("Middleware: Logout - Usuario: " . $_SESSION['USUARIO_CODIGOFUNCIONARIO']);
        }
        
        // Destruir sesión
        session_unset();
        session_destroy();
        
        // Regenerar ID de sesión para seguridad
        session_start();
        session_regenerate_id();
        session_destroy();
    }
    
    /**
     * Obtiene IP del cliente
     * @return string
     */
    function _getClientIP() {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
        return 'UNKNOWN';
    }
    
    /**
     * Redirige al login si no está autenticado
     * @param string $redirect_url - URL opcional de redirección
     */
    function requireAuth($redirect_url = null) {
        if (!$redirect_url) {
            $redirect_url = dirname(dirname($_SERVER['PHP_SELF'])) . '/login.php';
        }
        
        if (!$this->isAuthenticated()) {
            header('Location: ' . $redirect_url . '?error=' . urlencode($this->error_message));
            exit;
        }
        
        // Validación adicional opcional
        if (!$this->validateSession(false)) {
            header('Location: ' . $redirect_url . '?error=' . urlencode($this->error_message));
            exit;
        }
    }
}
?>
