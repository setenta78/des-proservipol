<?php include("version.php");?>
<?php include("proteccion.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<meta name="author" content="Depto. Control de Gestión" />
	<title>PROSERVIPOL - Programación de Servicios Policiales</title>
	<link rel="stylesheet" type="text/css" href="css/estiloValidarCertificado.css?v=<?echo version?>" />
	<link type="image/x-icon" rel="shortcut icon" href="images/favicon.ico" />
    <script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
</head>
<body style="background-color:#f5fbf3;" >
	<div class="header" style="text-align: center;">
		<img id="imgLogo" name="imgLogo" alt="logo" height="90" src="images/logoDepartamento.png" width="90" />
		<h1 id="tituloLogo" name="tituloLogo">Validar Certificado de Curso Proservipol</h1>
	</div></br></br></br>
	<div class="content"><br>
		<div id="formularioBusqueda">
			</br>
			<span id="labelTextRegistro">Codigo Validación :</span></br></br>
			<input type="text" id="textCodVerificacion" name="textCodVerificacion" placeholder="Ingrese Codigo de Validación" autocomplete="off" /></br></br></br>
			<input class="btn" type="button" id="btnBuscar" name="btnBuscar" value="Buscar" />
		</div>
        <img id="cargando" src='./images/load.gif' style="position:absolute;height:200px;top:30px;left:560px;display:none;">
        <div id="respuestaCertificado"></div>
	</div>
</body>
</html>
<script type="text/javascript" src="./js/validaCertificado.js?v=<?echo version?>"></script>