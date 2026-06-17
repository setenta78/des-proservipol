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

    <!-- HEADER -->
	<div class="header">
		<img alt="logo" height="55" src="../images/logo_depto_transparente.png" width="55" style="border:none;" />
		<div class="header-text">
			<span class="header-title">Departamento de Control de Gestión y Sistemas de Información</span>
			<span class="header-subtitle">SUB CONTRALORÍA GENERAL DE CARABINEROS</span>
		</div>
	</div>

    <!-- CONTADOR -->
    <div id="mostrarMatriculados" class="mostrarMatriculados"></div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="content">

        <p style="font-size:0.85rem; font-weight:600; color:#888; text-transform:uppercase; letter-spacing:1.5px; margin-bottom:4px;">
            Sistema PROSERVIPOL
        </p>
        <h1>FORMULARIO DE INSCRIPCIÓN</h1>
        <h1 style="font-size:1.6rem; color:#07672B;">CAPACITACIÓN 2026 — CURSO PROSERVIPOL</h1>
        <div class="divider"></div>

        <!-- INFO FECHAS -->
        <div class="info-container">
            <div class="info-card">
                <p class="info-text">
                    <span class="info-icon">📅</span>
                    <strong>Período de Inscripción:</strong> Lunes 16 de marzo de 2026 a las 10:00 hrs. hasta el viernes 27 de marzo de 2026 a las 23:59 hrs.
                </p>
            </div>
            <div class="info-card">
                <p class="info-text">
                    <span class="info-icon">🟢</span>
                    <strong>Inicio del Curso:</strong> Lunes 06 de abril de 2026 a las 09:00 hrs.
                </p>
            </div>
            <div class="info-card">
                <p class="info-text">
                    <span class="info-icon">🔴</span>
                    <strong>Término del Curso:</strong> Viernes 17 de abril de 2026 a las 23:59 hrs.
                </p>
            </div>
            <div class="important-card">
			<div class="important-title">⚠️ IMPORTANTE</div>
					<p class="info-text">
						Una vez abierto el curso, tendrá desde el <strong>lunes 06 de abril</strong> hasta el 
						<strong>viernes 17 de abril de 2026 a las 23:59 hrs.</strong> para completar el proceso.<br><br>
						El curso está dividido en <strong>módulos secuenciales</strong>: para avanzar al siguiente módulo 
						deberá <strong>completar las lecciones y aprobar el examen</strong> del módulo anterior con un 
						mínimo de <strong>60%</strong>. No es posible saltarse módulos.<br><br>
						Una vez aprobados todos los módulos, podrá rendir la <strong>Prueba Final</strong> del curso, 
						la cual también requiere un mínimo de <strong>60%</strong> para aprobar y obtener su certificación.
					</p>
			</div>


            <h2 id="mensajeCuposLlenos" class="alert-message"></h2>
        </div>

        <!-- FORMULARIO BÚSQUEDA -->
        <div id="formularioBusqueda">
            <div class="search-title">🔍 Ingrese su código para inscribirse</div>
            <label id="labelTextRegistro" for="textCodFuncionarioBusqueda">Código de Funcionario</label>
            <input type="text" id="textCodFuncionarioBusqueda" name="textCodFuncionarioBusqueda"
                   placeholder="Ej: 946537" maxlength="10" autocomplete="off" disabled />
            <div class="btn-group" style="margin-top:0;">
                <button class="btn btn-primary" type="button" id="btnBuscar" onclick="buscarFuncionario()" disabled>
                    Buscar Funcionario
                </button>
            </div>
        </div>

        <!-- FORMULARIO REGISTRO -->
        <div id="formularioRegistro">
            <div class="form-title">📋 Datos del Funcionario</div>
            <form method="post" action="" id="formularioMatricula" name="formularioMatricula" accept-charset="utf-8">
                <input type="hidden" id="rut" name="rut" />
                <input type="hidden" id="textDotacion" name="textDotacion" />
                <input type="hidden" id="textReparticionD" name="textReparticionD" />
                <input type="hidden" id="textReparticionA" name="textReparticionA" />
                <input type="hidden" id="textEmail" name="textEmail" />

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Código Funcionario</label>
                        <input type="text" id="textCodFuncionario" name="textCodFuncionario"
                               class="textFormulario" placeholder="Código" maxlength="10" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Grado</label>
                        <input type="hidden" id="codEscalafon" name="codEscalafon" />
                        <input type="hidden" id="codGrado" name="codGrado" />
                        <input class="textFormulario" type="text" id="textGrado" name="textGrado" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Primer Nombre</label>
                        <input class="textFormulario" type="text" id="textNombre1" name="textNombre1" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Segundo Nombre</label>
                        <input class="textFormulario" type="text" id="textNombre2" name="textNombre2" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Primer Apellido</label>
                        <input class="textFormulario" type="text" id="textApellido1" name="textApellido1" readonly />
                    </div>
                    <div class="form-group">
                        <label class="form-label">Segundo Apellido</label>
                        <input class="textFormulario" type="text" id="textApellido2" name="textApellido2" readonly />
                    </div>
                    <div class="form-group full-width">
                        <label class="form-label">Curso</label>
                        <input class="textFormulario" type="text" id="tipoCurso" name="tipoCurso"
                               value="CURSO ONLINE PROSERVIPOL ABRIL 2026" readonly />
                    </div>
                </div>

                <div class="btn-group">
                    <button class="btn btn-secondary" type="button" id="btnVolver" onclick="volver()">
                        ← Volver
                    </button>
                    <button class="btn btn-primary" type="button" id="btnRegistrar" onclick="matricular()" disabled>
                        ✅ Quiero Matricularme
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- FOOTER -->
    <footer>
        <div class="footer-content">
            <img alt="logo" height="70" src="../images/i_logo.png" width="56" />
            <h3>
                <strong>SUB CONTRALORÍA GENERAL DE CARABINEROS</strong>
                Departamento Control de Gestión y Sistemas de Información — 2026
            </h3>
        </div>
    </footer>

</body>
</html>

