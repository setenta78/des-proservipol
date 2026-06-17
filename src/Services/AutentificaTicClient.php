<?php
/**
 * SISTEMA MATRIZ - PROSERVIPOL
 * Cliente HTTP para API AutentificaTIC
 * @author Denis Quezada Lemus - Arquitecto de Soluciones
 * @compatibility PHP 5.1.2
 * @date 2025
 * 
 * Centraliza TODAS las llamadas a la API externa AutentificaTIC,
 * eliminando dependencias directas desde JavaScript y mejorando seguridad.
 */

class AutentificaTicClient {
    
    /**
     * URL base de la API AutentificaTIC
     * @var string
     */
    var $api_url = 'http://autentificaticapi.carabineros.cl';
    
    /**
     * Timeout para conexiones cURL (segundos)
     * @var int
     */
    var $timeout = 30;
    
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
     * Constructor - Compatible PHP 5.1.2
     */
    function AutentificaTicClient() {
        // Verificar que cURL esté disponible
        if (!function_exists('curl_init')) {
            $this->error_code = E_ERROR;
            $this->error_message = 'cURL no está disponible en este servidor';
            return false;
        }
    }
    
    /**
     * Realiza login contra API AutentificaTIC
     * @param string $rut - RUT del funcionario (sin puntos ni guión)
     * @param string $password - Contraseña
     * @return array|false - Array con datos de usuario y token, o false si falla
     */
    function login($rut, $password) {
        $endpoint = $this->api_url . '/api/auth/login';
        
        $params = array(
            'rut' => $rut,
            'password' => $password
        );
        
        $response = $this->_makeRequest('POST', $endpoint, $params);
        
        if ($response === false) {
            return false;
        }
        
        // Validar respuesta
        if (isset($response['success']) && $response['success'] === true) {
            return array(
                'access_token' => isset($response['access_token']) ? $response['access_token'] : '',
                'user' => isset($response['user']) ? $response['user'] : array(),
                'expires_at' => isset($response['expires_at']) ? $response['expires_at'] : ''
            );
        } else {
            $this->error_message = isset($response['message']) ? $response['message'] : 'Credenciales inválidas';
            return false;
        }
    }
    
    /**
     * Valida un token de acceso contra API AutentificaTIC
     * @param string $token - Token de acceso a validar
     * @return array|false - Datos del usuario si es válido, false si no
     */
    function validateToken($token) {
        $endpoint = $this->api_url . '/api/auth/validate-token';
        
        $params = array(
            'access_token' => $token
        );
        
        $response = $this->_makeRequest('POST', $endpoint, $params);
        
        if ($response === false) {
            return false;
        }
        
        if (isset($response['valid']) && $response['valid'] === true) {
            return array(
                'user' => isset($response['user']) ? $response['user'] : array(),
                'expires_at' => isset($response['expires_at']) ? $response['expires_at'] : ''
            );
        } else {
            $this->error_message = 'Token inválido o expirado';
            return false;
        }
    }
    
    /**
     * Obtiene información detallada de un usuario por token
     * @param string $token - Token de acceso
     * @return array|false - Datos completos del usuario
     */
    function getUserInfo($token) {
        $endpoint = $this->api_url . '/api/auth/user';
        
        $headers = array(
            'Authorization: Bearer ' . $token
        );
        
        $response = $this->_makeRequest('GET', $endpoint, array(), $headers);
        
        if ($response === false) {
            return false;
        }
        
        return $response;
    }
    
    /**
     * Método interno para realizar peticiones HTTP con cURL
     * @param string $method - GET, POST, PUT, DELETE
     * @param string $url - URL completa del endpoint
     * @param array $params - Parámetros para enviar
     * @param array $headers - Headers adicionales
     * @return array|false - Respuesta decodificada como JSON o false
     */
    function &_makeRequest($method, $url, &$params = array(), &$headers = array()) {
        $ch = curl_init();
        
        if (!$ch) {
            $this->error_code = E_ERROR;
            $this->error_message = 'No se pudo inicializar cURL';
            $false = false;
            return $false;
        }
        
        // Configurar cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        
        // Headers por defecto
        $default_headers = array(
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        // Merge headers
        $all_headers = array_merge($default_headers, $headers);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $all_headers);
        
        // Configurar según método
        $method = strtoupper($method);
        
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if (!empty($params)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            }
        } elseif ($method == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            if (!empty($params)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            }
        } elseif ($method == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
        
        // Ejecutar petición
        $response = curl_exec($ch);
        
        // Verificar errores
        if ($response === false) {
            $this->error_code = curl_errno($ch);
            $this->error_message = curl_error($ch);
            curl_close($ch);
            $false = false;
            return $false;
        }
        
        // Obtener código HTTP
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Decodificar JSON
        $decoded = null;
        if (function_exists('json_decode')) {
            $decoded = json_decode($response, true);
        } else {
            // Fallback para PHP sin json_decode (usar Services_JSON)
            require_once dirname(__FILE__) . '/../inc/Services_JSON.php';
            $json = new Services_JSON();
            $decoded = $json->decode($response);
        }
        
        // Validar respuesta
        if ($http_code >= 400) {
            $this->error_code = $http_code;
            $this->error_message = isset($decoded['message']) ? $decoded['message'] : 'Error HTTP ' . $http_code;
            $false = false;
            return $false;
        }
        
        return $decoded;
    }
    
    /**
     * Obtiene el último código de error
     * @return int
     */
    function getErrorCode() {
        return $this->error_code;
    }
    
    /**
     * Obtiene el último mensaje de error
     * @return string
     */
    function getErrorMessage() {
        return $this->error_message;
    }
    
    /**
     * Limpia el estado de error
     */
    function clearError() {
        $this->error_code = 0;
        $this->error_message = '';
    }
}
?>
