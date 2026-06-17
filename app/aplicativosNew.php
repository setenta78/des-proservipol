<?php
require_once("class/class.php");
date_default_timezone_set('America/Santiago');

if (isset($_SESSION["session_video_14"])) {
    $codigo = $_SESSION["session_video_14"];
    $grado  = $_SESSION["session_video_15"];
    $nombre = $_SESSION["session_video_16"];
    $tipo = $_SESSION["session_video_17"];
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menú Sistema Interno - Carabineros de Chile</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <div class="w-64 bg-green-800 shadow-lg">
                <div class="p-4 flex justify-center bg-green-900">
                    <img src="img/carabineros.png" alt="Carabineros de Chile" class="w-24 h-24">
                </div>

                <div class="p-4 text-white font-bold text-xl text-center">
                    INTERNAL APP
                </div>
                <span class="text-[11px] text-white flex justify-center">Bienvenid@: <?php echo $grado . "</br>" . $nombre . "</br>" . date("d/m/Y"); ?></span>

                <ul class="mt-4 text-white">
                    <!-- Menú Items con AJAX para cargar el contenido -->
                    <li class="p-2 hover:bg-green-700 cursor-pointer">
                        <a href="vehiculos/index.php" class="flex items-center space-x-2 ajax-link">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.5 20.5h13M4 8l7.5 7.5L19 8" />
                            </svg>
                            <span>Ingreso Vehículos</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700 cursor-pointer">
                        <a href="cambio_fecha.php" class="flex items-center space-x-2 ajax-link">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25" />
                            </svg>
                            <span>Cambio Fecha</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                            </svg>
                            <span>Licencias Médicas</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4 4m0 0l4-4m-4 4V4" />
                            </svg>
                            <span>Permisos</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Desvalidador</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v10m8-10v10" />
                            </svg>
                            <span>Reintegrados</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l4 4 4-4m0-6l-4 4-4-4" />
                            </svg>
                            <span>Movimientos</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            <span>Listado Servicios</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Ingreso Armas</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 2.21 1.79 4 4 4s4-1.79 4-4-1.79-4-4-4-4 1.79-4 4zm-7 4l4 4-4-4m0-4l4-4-4 4z" />
                            </svg>
                            <span>Ingreso Animales</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="#" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-1a2 2 0 012-2h4a2 2 0 012 2v1h1a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v2m-6 2h6" />
                            </svg>
                            <span>Solicitudes</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700">
                        <a href="videocamaras/index.php" class="flex items-center space-x-2 ajax-link">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                            </svg>
                            <span>Integración SAP</span>
                        </a>
                    </li>

                    <li class="p-2 hover:bg-green-700 cursor-pointer">
                        <a href="salir.php" class="flex items-center space-x-2">
                            <svg class="w-6 h-6 text-green-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            <span>SALIR</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Content -->
            <div class="flex-1 p-6 bg-gray-100" id="content-area">
                <h1 class="text-2xl font-bold text-green-900">Bienvenido al Sistema Interno</h1>
                <p class="mt-4 text-gray-600">Seleccione una opción del menú para comenzar.</p>
            </div>
        </div>

        <script>
            // Cargar contenido con AJAX sin recargar la página completa
            $(document).ready(function() {
                $('.ajax-link').on('click', function(e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    $('#content-area').load(url);
                });
            });
        </script>
    </body>

    </html>


<?php
} else {
    echo "
	<script type='text/javascript'>
	alert('DEBE INICIAR SESIÓN PARA ACCEDER A ESTE CONTENIDO');
	window.location='index.php';
	</script>
	";
}
?>