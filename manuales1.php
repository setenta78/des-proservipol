<?
include("version.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <link rel="icon" type="image/png" href="images/logoDepartamentoP.png" />
    <meta name="author" content="Depto. Control de Gestión" />
    <title> MANUALES PROSERVIPOL - Programación de Servicios Policiales.</title>
    <link rel="stylesheet" type="text/css" href="css/New_estiloIndex.css" />
    <link rel="shortcut icon" href="../favicon.ico">
    <link href="./css/Modal-Manuales.css?v=<? echo version ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/demo.css" /> 
    <link rel="stylesheet" type="text/css" href="css/style2.css" />
    <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css' />
    <style type="text/css">
        .auto-style1 {
            border-width: 0px;
        }
    </style>
</head>

<body>
    <div id="bannerP">
        <div class="logoP"><a style="cursor: hand;" href="index.php"><img src="images/logoDepartamentoP.png" width="100px" height="100px" /></a></div>
        <div class="bannerTitleP"><a style="cursor: hand;" href="index.php"><img src="images/banner_titulo.png" width="380px" height="75px" /></a></div>
    </div>
    </div>
    <div class="content2">
        <br />
        <!--
		L = LUPA
		A = CLIP
		F = CARPETA
		H = PARENTESIS
		K = ADJUNTO/ARCHIVO
	-->
        <div id="xColumnas">
            <p id="xTitulo">TERMINOS GENERALES</p>
            <ul class="ca-menu">
                <li>
                    <a href="manuales/m1TerminosGenerales/01-INTRODUCCION_SISTEMA_PROSERVIPOL.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Introducción al Sistema</h2>
                            <h3 class="ca-sub">Proservipol V3.9</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m1TerminosGenerales/18-INSTRUCTIVO_SOLICITUDES_UNIDADES.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Instructivo Solicitudes</h2>
                            <h3 class="ca-sub"> Unidades</h3>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="manuales/m1TerminosGenerales/ANEXO_1_PERSONAL_DESTINADO_A_SERVICIO_EN_EL_CUARTEL.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Anexo 1: </h2>
                            <h3 class="ca-sub">Personal destinado a Servicio</h3>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="manuales/m1TerminosGenerales/03-SECCION_CONSULTAS.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Sección </h2>
                            <h3 class="ca-sub">Consultas</h3>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="manuales/m1TerminosGenerales/16-PREGUNTAS_FRECUENTES.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Preguntas</h2>
                            <h3 class="ca-sub">Frecuentes</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="document.getElementById('popup-TerminosGenerales').className='modal-wrapperTarget';">
                        <span class="ca-icon">F</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Videos</h2>
                            <h3 class="ca-sub">Terminos Generales</h3>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div id="xColumnas">
            <p id="xTitulo">RECURSOS HUMANOS</p>
            <ul class="ca-menu">
                <li>
                    <a href="manuales/m2RecursosHumanos/02-INCORPORACION_DE_PERSONAL.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Incorporación</h2>
                            <h3 class="ca-sub">De Personal</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m2RecursosHumanos/04-PROCEDIMIENTO_REGISTRO_LICENCIAS_DE_CONDUCIR_Y_SEMEP.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Procedimiento de Registro</h2>
                            <h3 class="ca-sub">Licencias de Conducir</h3>
                        </div>
                    </a>
                </li>
            </ul>
         <!--   </br> </br> </br> </br> </br>
            <p id="xTitulo">SIICGE</p>
            <ul class="ca-menu">
                <li>
                    <a href="manuales/m5Siicge/MANUAL_INTRODUCCION_A_LOS_SISTEMAS_1.0.pdf">
                        <span class="ca-icon">K</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Incorporación</h2>
                            <h3 class="ca-sub">De Personal</h3>
                        </div>
                    </a>
                </li>
            </ul>-->
        </div>

        <div id="xColumnas">
            <p id="xTitulo">RECURSOS LOGÍSTICOS</p>
            <ul class="ca-menu">
                <li>
                    <a href="manuales/m3RecursosLogisticos/06-PROCEDIMIENTO_REGISTRO_FUNCIONARIOS_CON_COLACION.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Procedimiento de Registro</h2>
                            <h3 class="ca-sub">Funcionarios con colación</h3>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="manuales/m3RecursosLogisticos/08-SECCION_VEHICULOS_INCORPORACION_Y_MANTENCION.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Sección Vehículos</h2>
                            <h3 class="ca-sub">Incorporación y Mantenión</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m3RecursosLogisticos/09-CAUSA_DE_NO_DISPONIBILIDAD_DE_VEHICULOS.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Causa de no disponibilidad</h2>
                            <h3 class="ca-sub">De Vehículos</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m3RecursosLogisticos/10-SECCION_ARMAS.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Sección</h2>
                            <h3 class="ca-sub">Armas</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m3RecursosLogisticos/17-INCORPORACION_DE_CABALLOS_A_PROSERVIPOL.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Incorporación de Caballos</h2>
                            <h3 class="ca-sub">A Proservipol</h3>
                        </div>
                    </a>
                </li>

                <li>
                    <a href="#" onclick="document.getElementById('popup-RecursosLogisticos').className='modal-wrapperTarget';">
                        <span class="ca-icon">F</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Videos</h2>
                            <h3 class="ca-sub">Recursos Logísticos</h3>
                        </div>
                    </a>
                </li>

            </ul>

        </div>
        <div id="xColumnas">
            <p id="xTitulo">SERVICIOS POLICIALES</p>
            <ul class="ca-menu">
                <li>
                    <a href="manuales/m4Servicios/05-PROCEDIMIENTO_REGISTRO_SERVICIOS.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Procedimiento de Registro</h2>
                            <h3 class="ca-sub">de Servicios Policiales</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m4Servicios/07-PROCEDIMIENTO_VALIDACION_DESVALIDACION_DE_SERVICIOS_POLICIALES.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main"> Validación y Desvalidación</h2>
                            <h3 class="ca-sub">de Servicios Policiales</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m4Servicios/11-INSTRUCTIVO_REGISTRO_LICENCIAS_MEDICAS.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Instructivo de Registro</h2>
                            <h3 class="ca-sub">de Licencias Médicas</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m4Servicios/12-INSTRUCTIVO_PERMISO_POSTNATAL_PARENTAL.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Instructivo de Permiso</h2>
                            <h3 class="ca-sub">Postnatal Parental</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m4Servicios/13-MODULO_ASPECTOS_TEORICOS_LICENCIA_MEDICA.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Aspectos Teóricos</h2>
                            <h3 class="ca-sub">Licencia Médica</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m4Servicios/14-INSTRUCTIVO_RESOLUCION_MEDICINA_PREVENTIVA.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Instructivo Resolución</h2>
                            <h3 class="ca-sub">Medicina Preventiva</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="manuales/m4Servicios/15-FERPER.pdf">
                        <span class="ca-icon">L</span>
                        <div class="ca-content">
                            <h2 class="ca-main">FERPER</h2>
                            <h3 class="ca-sub">Feriados y Permisos</h3>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="document.getElementById('popup-Servicios').className='modal-wrapperTarget';">
                        <span class="ca-icon">F</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Videos</h2>
                            <h3 class="ca-sub">Servicios Policiales</h3>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div id="xColumnas">
            <p id="xTitulo">RELACIÓN CON SIICGE</p>
            <ul class="ca-menu">
                <li>
                    <a href="manuales/m5Siicge/MANUAL_INTRODUCCION_A_LOS_SISTEMAS_1.0.pdf">
                        <span class="ca-icon">K</span>
                        <div class="ca-content">
                            <h2 class="ca-main">Incorporación de Personal</h2>
                            <h3 class="ca-sub">Relación de PROSERVIPOL con SIICGE</h3>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    </br> </br> </br></br> </br> </br>

    <div class="footer">
        <p id="footerText">
            Versión 3.9.<? echo version ?><br /><br />
            CONTRALORIA GENERAL DE CARABINEROS<br />
            Departamento Control de Gestión y Sistemas de Información<br />
            2021
        </p>
    </div>
    <div class="modal-wrapper" id="popup-TerminosGenerales">
        <div class="popup-contenedor-min">
            <div class="popup-header">
                <div class="popup-header-text">Videos Terminos Generales</div>
            </div>
            <div id="popup-contenedor-min">
                <ul class="ca-menu">
                    <li>
                        <a href="manuales/m1TerminosGenerales/Desvalidacion.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video </h2>
                                <h3 class="ca-sub">Desvalidación</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m1TerminosGenerales/ingreso_titular_com.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Ingreso titular</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m1TerminosGenerales/Recomendacion-Fechacorrecta.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Recomendación fecha Correcta</h3>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <a class="popup-cerrar" onclick="document.getElementById('popup-TerminosGenerales').className='modal-wrapper';">X</a>
        </div>
    </div>

    <div class="modal-wrapper" id="popup-RecursosLogisticos">
        <div class="popup-contenedor-min">
            <div class="popup-header">
                <div class="popup-header-text">Videos Recursos Logísticos</div>
            </div>
            <div id="popup-contenedor-min">
                <ul class="ca-menu">
                    <li>
                        <a href="manuales/m3RecursosLogisticos/Cambio_de_estado_para_el_armamento.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video </h2>
                                <h3 class="ca-sub">Cambio de estado Armamento</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m3RecursosLogisticos/Cambio_estado_vehiculo.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Cambio de estado Vehículo</h3>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <a class="popup-cerrar" onclick="document.getElementById('popup-RecursosLogisticos').className='modal-wrapper';">X</a>
        </div>
    </div>

    <div class="modal-wrapper" id="popup-Servicios">
        <div class="popup-contenedor-min">
            <div class="popup-header">
                <div class="popup-header-text">Videos Servicios Policiales</div>
            </div>
            <div id="popup-contenedor-min">
                <ul class="ca-menu">
                    <li>
                        <a href="manuales/m4Servicios/Anular_licencia.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video </h2>
                                <h3 class="ca-sub">Anulación de Licencia Médica</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m4Servicios/cambio_fecha_licenciar.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Cambio de fecha de Licencia Médica</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m4Servicios/Ingreso_folio_licencia_medica.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Ingreso de Folio de Licencia Médica</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m4Servicios/Ingreso_licencia.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Ingreso de Licencia Médica</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m4Servicios/Recortar_licencia_por_termino_anticipado.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Recortar Licencia por termino anticipado</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m4Servicios/Registro_de_Feriado_o_Permiso_Ferper.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Registro de Feriados o Permiso FERPER</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="manuales/m4Servicios/ServicioPendiente.mp4">
                            <span class="ca-icon">A</span>
                            <div class="ca-content">
                                <h2 class="ca-main">Video</h2>
                                <h3 class="ca-sub">Servicio Pendiente</h3>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <a class="popup-cerrar" onclick="document.getElementById('popup-Servicios').className='modal-wrapper';">X</a>
        </div>
    </div>


</body>

</html>