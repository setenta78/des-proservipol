<? include("../version.php"); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <meta name="author" content="Depto. Control de Gestión" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PROSERVIPOL - Programación de Servicios Policiales</title>
    <link rel="stylesheet" type="text/css" href="estiloFormularioRegistro.css?v=<? echo version ?>" />
    <script type="text/javascript" src="formularioRegistro.js?v=<? echo version ?>"></script>
    <link type="image/x-icon" rel="shortcut icon" href="../images/favicon.ico" />
</head>
<body>
    <div class="header">
        <img alt="logo" height="80" src="../images/logo_depto_transparente.png" width="80" style="border:none;" />
    </div>

    <div id="mostrarMatriculados" class="mostrarMatriculados"></div>

    <div class="content">
        <h1>FORMULARIO DE INSCRIPCIÓN CAPACITACIÓN 2026</h1>
        <h1>CURSO DE PROSERVIPOL</h1>

        <div class="info-container">
            <h3 class="info-text">
                (+) Fecha Inscripción: Lunes 16 de Marzo de 2026 a las 10:00 hrs hasta el Viernes 27 de Marzo de 2026 a las 23:59 hrs.
            </h3>
            <h3 class="info-text">
                (+) Fecha Inicio del Curso: Lunes 06 de Abril de 2026 a las 09:00 hrs.
            </h3>
            <h3 class="info-text">
                (+) Fecha Término del Curso: Viernes 17 de Abril de 2026 a las 23:59 hrs.
            </h3>
            <h1 id="mensajeCuposLlenos" class="alert-message"></h1>
            <h3 class="info-text important">
                IMPORTANTE: <br>
                Una vez abierto el curso podrá rendir el Examen con nota cualquier día, siempre y cuando haya completado sus lecciones, <br>
                es decir tendrá desde el Lunes 06 de Abril hasta el Viernes 17 de Abril de 2026 a las 23:59 hrs. para terminar el proceso.
            </h3>
        </div>

        <div id="formularioBusqueda">
            <span id="labelTextRegistro">Código Funcionario:</span><br><br>
            <input type="text" id="textCodFuncionarioBusqueda" name="textCodFuncionarioBusqueda"
                   placeholder="Ingrese Código Funcionario" maxlength="10" autocomplete="off" disabled />
            <br><br><br>
            <input class="btn" type="button" id="btnBuscar" onclick="buscarFuncionario()" value="Buscar" disabled />
        </div>

        <div id="formularioRegistro">
            <form method="post" action="" id="formularioMatricula" name="formularioMatricula" accept-charset="utf-8">
                <br><br><br>
                <table width="100%">
                    <tr>
                        <td align="right" width="35%">
                            <span id="labelText">Código Funcionario:</span>
                        </td>
                        <td align="left" width="65%">
                            <input type="hidden" id="rut" name="rut" />
                            <input type="text" id="textCodFuncionario" name="textCodFuncionario"
                                   class="textFormulario" placeholder="Ingrese Código Funcionario" maxlength="10" readonly />
                        </td>
                    </tr>
                    <tr><td height="15px"></td></tr>
                    <tr>
                        <td align="right"><span id="labelText">Primer Nombre:</span></td>
                        <td align="left"><input class="textFormulario" type="text" id="textNombre1" name="textNombre1" readonly /></td>
                    </tr>
                    <tr><td height="15px"></td></tr>
                    <tr>
                        <td align="right"><span id="labelText">Segundo Nombre:</span></td>
                        <td align="left"><input class="textFormulario" type="text" id="textNombre2" name="textNombre2" readonly /></td>
                    </tr>
                    <tr><td height="15px"></td></tr>
                    <tr>
                        <td align="right"><span id="labelText">Primer Apellido:</span></td>
                        <td align="left"><input class="textFormulario" type="text" id="textApellido1" name="textApellido1" readonly /></td>
                    </tr>
                    <tr><td height="15px"></td></tr>
                    <tr>
                        <td align="right"><span id="labelText">Segundo Apellido:</span></td>
                        <td align="left"><input class="textFormulario" type="text" id="textApellido2" name="textApellido2" readonly /></td>
                    </tr>
                    <tr><td height="15px"></td></tr>
                    <tr>
                        <td align="right"><span id="labelText">Grado:</span></td>
                        <td align="left">
                            <input type="hidden" id="codEscalafon" name="codEscalafon" />
                            <input type="hidden" id="codGrado" name="codGrado" />
                            <input class="textFormulario" type="text" id="textGrado" name="textGrado" readonly />
                        </td>
                    </tr>
                    <tr><td height="15px"></td></tr>
                    <tr>
                        <td align="right"><span id="labelText">Tipo Curso:</span></td>
                        <td align="left">
                            <input class="textFormulario" type="text" id="tipoCurso" name="tipoCurso"
                                   value="CURSO ONLINE PROSERVIPOL ABRIL 2026" readonly />
                        </td>
                    </tr>
                    <input type="hidden" id="textDotacion" name="textDotacion">
                    <input type="hidden" id="textReparticionD" name="textReparticionD" />
                    <input type="hidden" id="textReparticionA" name="textReparticionA" />
                    <input type="hidden" id="textEmail" name="textEmail" />
                </table>
                <br><br>
                <input class="btn" type="button" id="btnVolver" onclick="volver()" value="Volver" />
                <input class="btn" type="button" id="btnRegistrar" onclick="matricular()" value="Quiero Matricularme" disabled />
                <br><br>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <img alt="logo" height="80" src="../images/i_logo.png" width="65" />
            <h3>
                SUB CONTRALORÍA GENERAL DE CARABINEROS<br>
                Departamento Control de Gestión y Sistemas de Información<br>
                2026
            </h3>
        </div>
    </footer>
</body>
</html>

<script>
    const fecha = new Date();
    const fechaInicio = new Date(2026, 2, 10, 0, 0, 0);   // HOY 10/03/2026 00:00 (pruebas)
    const fechaLimite = new Date(2026, 2, 10, 23, 59, 59); // HOY 10/03/2026 23:59 (pruebas)

    if (fecha >= fechaInicio && fecha <= fechaLimite) {
        btnBuscar.disabled = false;
        btnRegistrar.disabled = false;
        textCodFuncionarioBusqueda.disabled = false;
        document.getElementById('labelTextRegistro').textContent = "Código Funcionario:";
        document.getElementById('labelTextRegistro').style.color = "";
        document.getElementById('labelTextRegistro').style.fontWeight = "";
    } else {
        // ...
    }

    mostrarCantidadMatriculados();
    ejecutarMostrar();
</script>