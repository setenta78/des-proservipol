<?php
/**
 * SISTEMA MATRIZ - PROSERVIPOL
 * Página de Inicio de Sesión - Versión 5.0 (Refactorizada)
 * @compatibility PHP 5.1.2 + MySQL 5.0.77
 * @author Denis Quezada Lemus - Arquitecto de Soluciones
 * @date 2025
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Redirigir si ya está autenticado
if (isset($_SESSION['access_token'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Iniciar Sesión - PROSERVIPOL</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="../img/logo.png">
    
    <!-- Estilos -->
    <link rel="stylesheet" href="../css/login.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <!-- ========== FORMULARIO DE LOGIN (Lado Izquierdo) ========== -->
        <div class="login-form">
            <!-- Logo -->
            <div class="logo">
                <img src="../img/logobanner.png" alt="Carabineros de Chile">
            </div>
            
            <!-- Título -->
            <h1 class="title">PROSERVIPOL</h1>
            <p class="subtitle">
                Para iniciar sesión, se necesita ingresar con su cuenta de <strong>AUTENTIFICATIC</strong>
            </p>

            <!-- Formulario -->
            <form id="form_login" method="POST" autocomplete="off">
                <!-- Campo RUT -->
                <div class="input-group">
                    <label for="rut_funcionario">
                        <i class="fas fa-id-card"></i> RUT
                    </label>
                    <input 
                        type="text" 
                        id="rut_funcionario" 
                        name="rut_funcionario" 
                        placeholder="Ingresa tu RUT sin guiones ni puntos" 
                        required
                        maxlength="9"
                    >
                </div>

                <!-- Campo Contraseña -->
                <div class="input-group">
                    <label for="password">
                        <i class="fas fa-lock"></i> Contraseña
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Ingresa tu contraseña" 
                        required
                    >
                </div>

                <!-- Botón de Login -->
                <button type="button" id="btn-login" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>

                <!-- Enlaces -->
                <div class="links">
                    <a href="http://autentificatic.carabineros.cl/password/reset" target="_blank">
                        <i class="fas fa-key"></i> Recuperar contraseña
                    </a>
                    <a href="http://autentificatic.carabineros.cl/register" target="_blank">
                        <i class="fas fa-user-plus"></i> Regístrate
                    </a>
                </div>
            </form>

            <!-- ========== FOOTER CON TARJETAS ========== -->
            <div class="login-footer">
                <div class="footer-info">
                    <p class="footer-title">
                        Desarrollado por el Departamento Control de Gestión y Sistemas de Información
                    </p>
                    <p class="footer-text">
                        I.P. Mesa de Ayuda:
                    </p>
                    <p class="footer-text">
                        20828 - 20843 - 20844
                    </p>
                    <p class="footer-text">
                        © 2025 Carabineros de Chile
                    </p>
                </div>

                <!-- Grid de 4 Tarjetas -->
                <div class="footer-cards">
                    <!-- 1. Manuales y Consultas -->
                    <a href="../manuales.php" 
                       target="_blank" 
                       class="footer-card">
                        <div class="card-icon icon-orange">
                            <i class="fas fa-book"></i>
                        </div>
                        <span class="card-text">Manuales y<br>Consultas</span>
                    </a>

                    <!-- 2. Curso Proservipol -->
                    <a href="http://capacitacioncontroldegestion.carabineros.cl/" 
                       target="_blank" 
                       class="footer-card">
                        <div class="card-icon icon-blue">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <span class="card-text">Curso<br>Proservipol</span>
                    </a>

                    <!-- 3. Sistema Control de Gestión -->
                    <a href="http://controldegestion.carabineros.cl/" 
                       target="_blank" 
                       class="footer-card">
                        <div class="card-icon icon-purple">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <span class="card-text">Sistema Control<br>de Gestión</span>
                    </a>

                    <!-- 4. Validar Certificado -->
                    <a href="../validarCertificado.php" 
                       target="_blank" 
                       class="footer-card">
                        <div class="card-icon icon-green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span class="card-text">Validar<br>Certificado</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- ========== IMAGEN DE FONDO (Lado Derecho) ========== -->
        <div class="login-image"></div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/login_refactored.js"></script>
</body>
</html>
