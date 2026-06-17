<?php
/**
 * SISTEMA DE APLICACIONES DE PROSERVIPOL
 * Guardar Token de Autentificatic - Versión 5.1 CON BITÁCORA
 * @compatibility PHP 5.1.2 + MySQL 5.0.77
 * @date 2026
 * @author Denis Quezada Lemus
 * 
 * CAMBIOS: Se agregó registro automático en BITACORA_USUARIO al iniciar sesión
 */

session_start();
header('Content-Type: application/json; charset=UTF-8');

// Incluir Services_JSON (compatible con PHP 5.1.2)
require_once 'inc/Services_JSON.php';
$json = new Services_JSON();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // ========== PASO 1: OBTENER DATOS DEL POST ==========
    $access_token = isset($_POST['access_token']) ? $_POST['access_token'] : '';
    $expires_at = isset($_POST['expires_at']) ? $_POST['expires_at'] : '';
    $token_type = isset($_POST['token_type']) ? $_POST['token_type'] : '';
    $codigo_funcionario = isset($_POST['codigo_funcionario']) ? $_POST['codigo_funcionario'] : '';
    
    // Validar datos obligatorios
    if (empty($access_token) || empty($expires_at) || empty($token_type) || empty($codigo_funcionario)) {
        echo $json->encode(array('success' => false, 'message' => 'Datos incompletos'));
        exit;
    }
    
    // ========== PASO 2: CONECTAR A LA BASE DE DATOS ==========
    require_once 'queries/config.php';
    
    // Obtener IP del usuario
    $ip_usuario = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    $ip_segura = mysql_real_escape_string($ip_usuario, $link);
    
    // ========== PASO 3: CONSULTA COMPLETA DE DATOS DEL USUARIO ==========
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
        TIPO_USUARIO.CONSULTAR_PERFIL,
        USUARIO.US_ACTIVO
    FROM USUARIO
    JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
    JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
    JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) 
        AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
    JOIN UNIDAD ON (USUARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
    LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
    LEFT JOIN CARGO_FUNCIONARIO ON (USUARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
        AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL
    JOIN CONFIG_SYS ON CONFIG_SYS.ACTIVO = 1
    WHERE USUARIO.US_LOGIN = '$codigo_funcionario'
        AND USUARIO.FUN_CODIGO = '$codigo_funcionario'
    LIMIT 1";
    
    $result = mysql_query($sql, $link);
    
    if (!$result) {
        error_log("Error en consulta SQL: " . mysql_error($link));
        echo $json->encode(array('success' => false, 'message' => 'Error en consulta: ' . mysql_error($link)));
        exit;
    }
    
    $row = mysql_fetch_array($result);
    
    // ========== PASO 4: VALIDACIONES CRÍTICAS ==========
    
    // Validar que el usuario existe
    if (!$row) {
        echo $json->encode(array('success' => false, 'message' => 'Usuario no registrado en Proservipol'));
        exit;
    }
    
    // Validar que el usuario está activo
    if ($row['US_ACTIVO'] != 1) {
        echo $json->encode(array('success' => false, 'message' => 'Usuario inactivo'));
        exit;
    }
    
    // Validar perfiles permitidos (todos los perfiles del sistema)
    $tus_codigo = (int)$row['TUS_CODIGO'];
    $perfiles_permitidos = array(10, 20, 30, 40, 45, 50, 55, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 300, 310);
    
    if (!in_array($tus_codigo, $perfiles_permitidos)) {
        echo $json->encode(array('success' => false, 'message' => 'Perfil no autorizado'));
        exit;
    }
    
    // ========== PASO 4.5: REGISTRAR EN BITÁCORA (NUEVO) ==========
    $fun_codigo_safe = mysql_real_escape_string($codigo_funcionario, $link);
    $uni_codigo_safe = (int)$row['UNI_CODIGO'];
    $tus_codigo_safe = (int)$row['TUS_CODIGO'];
    $fecha_actual = date('Y-m-d H:i:s');
    
    $sql_bitacora = "INSERT INTO BITACORA_USUARIO (
        FUN_CODIGO, 
        UNI_CODIGO, 
        US_FECHAHORA_INICIO, 
        US_DIRECCION_IP, 
        TUS_CODIGO, 
        US_EVENTO
    ) VALUES (
        '$fun_codigo_safe',
        $uni_codigo_safe,
        '$fecha_actual',
        '$ip_segura',
        $tus_codigo_safe,
        'INGRESO AL SISTEMA'
    )";
    
    $res_bitacora = mysql_query($sql_bitacora, $link);
    
    if (!$res_bitacora) {
        // Si falla la bitácora, solo logueamos el error pero NO impedimos el login
        error_log("ERROR al registrar bitácora para usuario $codigo_funcionario: " . mysql_error($link));
    } else {
        error_log("Bitácora registrada exitosamente para usuario $codigo_funcionario desde IP $ip_usuario");
    }
    
    // ========== PASO 5: CONSTRUIR NOMBRE COMPLETO ==========
    $nombre_completo = trim($row['FUN_NOMBRE'] . ' ' . 
                            $row['FUN_APELLIDOPATERNO'] . ' ' . 
                            $row['FUN_APELLIDOMATERNO']);
    
    // ========== PASO 6: ESTABLECER TODAS LAS VARIABLES DE SESIÓN ==========
    
    // Variables de autenticación (Autentificatic)
    $_SESSION['access_token'] = $access_token;
    $_SESSION['expires_at'] = $expires_at;
    $_SESSION['token_type'] = $token_type;
    $_SESSION['HORA_INICIO'] = date("Y/m/d H:i:s");
    
    // Variables del usuario actual (USUARIO_*)
    $_SESSION['USUARIO_CODIGOFUNCIONARIO'] = $codigo_funcionario;
    $_SESSION['USUARIO_USERNAME'] = $codigo_funcionario; // Para compatibilidad con session.php
    $_SESSION['USUARIO_GRADO'] = $row['GRA_DESCRIPCION'];
    $_SESSION['USUARIO_NOMBRE'] = $nombre_completo;
    $_SESSION['USUARIO_CODIGOPERFIL'] = $tus_codigo;
    $_SESSION['USUARIO_PERFIL'] = $row['TUS_DESCRIPCION'];
    $_SESSION['USUARIO_CODIGOUNIDAD'] = $row['UNI_CODIGO'];
    $_SESSION['USUARIO_TIPOUNIDAD'] = $row['UNI_TIPOUNIDAD'];
    $_SESSION['USUARIO_DESCRIPCIONUNIDAD'] = $row['UNI_DESCRIPCION'];
    $_SESSION['USUARIO_UNIDADBLOQUEO'] = $row['UNI_BLOQUEO'];
    $_SESSION['USUARIO_UNIDADESPECIALIDAD_OLD'] = $row['UNI_ESPECIALIDAD'];
    $_SESSION['USUARIO_CODIGOPADREUNIDAD'] = $row['COD_UNIDADPADRE'];
    $_SESSION['USUARIO_TIPO_UNIDAD'] = $row['TIPO_UNIDAD'];
    
    // Variables del usuario origen (USUARIO_*_ORIGEN) - Inicialmente iguales al usuario actual
    $_SESSION['USUARIO_CODIGOFUNCIONARIO_ORIGEN'] = $codigo_funcionario;
    $_SESSION['USUARIO_GRADO_ORIGEN'] = $row['GRA_DESCRIPCION'];
    $_SESSION['USUARIO_NOMBRE_ORIGEN'] = $nombre_completo;
    $_SESSION['USUARIO_CODIGOPERFIL_ORIGEN'] = $tus_codigo;
    $_SESSION['USUARIO_PERFIL_ORIGEN'] = $row['TUS_DESCRIPCION'];
    $_SESSION['USUARIO_CODIGOUNIDAD_ORIGEN'] = $row['UNI_CODIGO'];
    $_SESSION['USUARIO_TIPOUNIDAD_ORIGEN'] = $row['UNI_TIPOUNIDAD'];
    $_SESSION['USUARIO_DESCRIPCIONUNIDAD_ORIGEN'] = $row['UNI_DESCRIPCION'];
    $_SESSION['USUARIO_TIPO_UNIDAD_ORIGEN'] = $row['TIPO_UNIDAD'];
    $_SESSION['USUARIO_CODIGOPADREUNIDAD_ORIGEN'] = $row['COD_UNIDADPADRE'];
    
    // Variables de configuración
    $_SESSION['FECHA_LIMITE'] = $row['FECHA_LIMITE'];
    
    // Variables de permisos
    $_SESSION['PERMISO_VALIDAR'] = $row['VALIDAR'];
    $_SESSION['PERMISO_REGISTRAR'] = $row['REGISTRAR'];
    $_SESSION['PERMISO_CONSULTAR_UNIDAD'] = $row['CONSULTAR_UNIDAD'];
    $_SESSION['PERMISO_CONSULTAR_PERFIL'] = $row['CONSULTAR_PERFIL'];
    
    // Log de éxito con todas las variables
    error_log(" Usuario autenticado exitosamente: $codigo_funcionario");
    error_log("   - Perfil: " . $row['TUS_DESCRIPCION'] . " ($tus_codigo)");
    error_log("   - Unidad: " . $row['UNI_DESCRIPCION'] . " (" . $row['UNI_CODIGO'] . ")");
    error_log("   - Grado: " . $row['GRA_DESCRIPCION']);
    error_log("   - Nombre: $nombre_completo");
    error_log("   - Permisos: Validar=" . $row['VALIDAR'] . 
              ", Registrar=" . $row['REGISTRAR'] . 
              ", ConsultarUnidad=" . $row['CONSULTAR_UNIDAD'] . 
              ", ConsultarPerfil=" . $row['CONSULTAR_PERFIL']);
    
    // Cerrar conexión
    mysql_close($link);
    
    // Respuesta exitosa
    echo $json->encode(array('success' => true));
    
} else {
    echo $json->encode(array('success' => false, 'message' => 'Método no permitido'));
}
?>