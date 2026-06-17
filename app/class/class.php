<?php
// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión
//session_start();

// Incluir la clase de conexión a la base de datos
require_once("class_conexion.php");

class Trabajo {
    private $servicio;

    public function __construct() {
        $this->servicio = array();
    }

    // Método para formatear RUT
    public function formateo_rut($rut_param) {
        $parte4 = substr($rut_param, -1); // Número verificador
        $parte3 = substr($rut_param, -4, 3); // Últimos 3 dígitos
        $parte2 = substr($rut_param, -7, 3); // Tres dígitos anteriores
        $parte1 = substr($rut_param, 0, -7); // Resto del RUT
        return $parte1 . "." . $parte2 . "." . $parte3 . "-" . $parte4;
    }

    // Método para realizar el login
    public function login() {
        // Capturar y validar los valores enviados por POST
        $user = isset($_POST["rut_funcionario"]) ? trim($_POST["rut_funcionario"]) : '';
        $pass = isset($_POST["clave_intranet"]) ? trim($_POST["clave_intranet"]) : '';

        if (empty($user) || empty($pass)) {
            die("Error: RUT y contraseña son obligatorios.");
        }

        // Obtener la conexión a la base de datos desde class_conexion.php
        $con = Conectar::con();

        // Consulta preparada para evitar SQL Injection
        $stmt = $con->prepare("
            SELECT 
                FUNCIONARIO.GRA_CODIGO,
                GRADO.GRA_DESCRIPCION,
                USUARIO.UNI_CODIGO,
                USUARIO.US_LOGIN,
                UNIDAD.UNI_DESCRIPCION,
                CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
                USUARIO.TUS_CODIGO,
                USUARIO.US_FECHACREACION,
                TIPO_USUARIO.TUS_DESCRIPCION,
                UNIDAD1.UNI_CODIGO AS COD_UNIDADPADRE,
                UNIDAD1.UNI_DESCRIPCION AS DES_UNIDADPADRE,
                UNIDAD.UNI_BLOQUEO,
                UNIDAD.UNI_TIPOUNIDAD
            FROM USUARIO
            JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
            JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
            JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
            JOIN UNIDAD ON (USUARIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
            LEFT JOIN UNIDAD UNIDAD1 ON (UNIDAD.UNI_PADRE = UNIDAD1.UNI_CODIGO)
            WHERE 
                USUARIO.US_LOGIN = ? AND USUARIO.US_PASSWORD = ? AND USUARIO.TUS_CODIGO IN (?, ?)
        ");

        if (!$stmt) {
            die("Error en la consulta preparada: " . $con->error);
        }

        // Vincular parámetros
        $tipoUsuario1 = 90;
        $tipoUsuario2 = 100;
        $user = strtoupper($user);

        $stmt->bind_param("ssii", $user, $pass, $tipoUsuario1, $tipoUsuario2);

        // Ejecutar la consulta
        $stmt->execute();

        // Vincular variables para almacenar los resultados
        $stmt->bind_result(
            $gra_codigo,
            $gra_descripcion,
            $uni_codigo,
            $us_login,
            $uni_descripcion,
            $nombre_completo,
            $tus_codigo,
            $us_fechacreacion,
            $tus_descripcion,
            $cod_unidadpadre,
            $des_unidadpadre,
            $uni_bloqueo,
            $uni_tipounidad
        );

        // Verificar si hay resultados
        if (!$stmt->fetch()) {
            echo "Credenciales incorrectas o autorización denegada.<br>";
        } else {
            // Procesar los resultados
            $_SESSION["session_video_14"] = $us_login;
            $_SESSION["session_video_15"] = $gra_descripcion;
            $_SESSION["session_video_16"] = $nombre_completo;
            $_SESSION["session_video_17"] = $tus_codigo;

            // Redirigir al usuario a la página principal
            header("Location: aplicativos.php");
            exit();
        }

        // Cerrar la consulta y la conexión
        $stmt->close();
        $con->close();
    }
}
?>