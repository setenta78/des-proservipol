<? include("version.php"); ?>
<? include("mensajeCierre.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://w3.org/1999/xhtml">

<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="author" content="Depto. Control de Gestión" />
	<link rel="icon" type="image/png" href="images/logoDepartamentoP.png" />
	<title>PROSERVIPOL - Programación de Servicios Policiales.</title>
	<script type="text/javascript" src="./js/creaObjeto.js?v=<?echo version?>"></script>
	<script type="text/javascript" src="./js/login.js?v=<?echo version?>"> </script>
	<link rel="stylesheet" type="text/css" href="css/New_estiloIndex.css" />
	<script src="./cuadroDialogo/js/mootools.js" type="text/javascript"></script>
	<script src="./cuadroDialogo/js/sexyalertbox.packed.js" type="text/javascript"></script>
	<script src="./cuadroDialogo/cuadroDialogo.js?v=<?echo version?>" type="text/javascript"></script>
	<link rel="stylesheet" href="./cuadroDialogo/css/sexyalertbox.css" type="text/css" media="all" />
	<link rel="stylesheet" href="./cuadroDialogo/css/imagen.css" type="text/css" media="all" />
	<link type="image/x-icon" rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
	<div class="header"></div>
	<div class="logo"></div>
	<div class="bannerImg2"></div>
	<div class="bannerTitle"></div>
	<div class="backHeader">
		<marquee>
			<font face="Verdana" size="3" color="white"><?=$objDBMensajes->obtenerMensajeCierre();?></font>
		</marquee>
	</div>
	<div class="content">
		<div class="links">
			<div class="bannerManuales"><a href="http://proservipol.carabineros.cl/manuales.php" target="_blank"><img alt="Manuales" height="115" src="images/btn4.fw.png" width="105" style="border:none;" /></a></div>
			<!--<div class="bannerCapacitacion"><a id="titulosIconos" href="./formularioRegistro/formularioRegistro.php" target="_blank"><img alt="Matricularse" height="100" src="images/matricula.png" width="100" style="border:none;" />MATRIC&Uacute;LATE HOY</a></div>-->
			<div class="bannerCapacitacion"><a id="titulosIconos" href="http://capacitacioncontroldegestion.carabineros.cl/" target="_blank"><img alt="Plataforma de Capacitacion" height="115" src="images/pro1.fw.png" width="100" style="border:none;" /><b>Curso Proservipol</b></a></div>
			<div class="bannerSiicge"><a href="http://controldegestion.carabineros.cl/" target="_blank"><img alt="Sistema Control de Gestión" height="115" src="images/btn1.fw.png" width="105" style="border:none;" /></a></div>
			<div class="bannerValidarCertificado"><a id="titulosIconos" href="validarCertificado.php" target="_blank"><img alt="Validar Certificado" height="60" src="images/iconoValidarDoc.png" width="60" style="border:none;" />Validar Certificado</a></div>
		</div><br />
		<div id="login">
			<form method="post" action="validaAuth.php" id="form1" name="form1">
				<h2>SISTEMA <br />
					PROSERVIPOL V3.9
				</h2>
				<img alt="" height="50" src="images/pro1.fw.png" width="50" />
				<div>
					<span id="txtForm">Usuario :</span>
					<input name="textUsuario" type="text" class="login-campos" id="textUsuario" placeholder="ingrese usuario" onkeypress="javascript:enter(event,this)" maxlength="10" />
				</div>
				<br />
				<div>
					<span id="txtForm"> Clave&nbsp;&nbsp;&nbsp;:</span>
					<input name="textClave" type="password" class="login-campos" id="textClave" placeholder="ingrese clave" onkeypress="javascript:enter(event,this)" maxlength="10" />
				</div>
				<br />
				<div>
					<input name="btnEntrar" type="button" class="menu2" id="loginBoton" onclick="javascript:validarContrasena()" value="Ingresar" />
				</div>
			</form>
		</div>
	</div>

	<footer>
	<div class="footer" style="height: auto;">
		<div id="footerBrowser" class="footerBrowser">
			<p>Sitio soportado por los siguientes navegadores web</p><br>
			<img id="footerBrowserIcon" class="footerBrowserIcon" src="img/explorer.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" class="footerBrowserIcon" src="img/edge.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" class="footerBrowserIcon" src="img/chrome.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" class="footerBrowserIcon" src="img/firefox.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" class="footerBrowserIcon" src="img/safari.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" class="footerBrowserIcon" src="img/opera.png" height="30px" width="30px" />
		</div>
		<p id="footerText" class="footerText">
			Versión 3.9.<? echo version ?><br /><br />
			SUB CONTRALORIA GENERAL DE CARABINEROS<br />
			Departamento Control de Gestión y Sistemas de Información<br />
			2023
		</p>
	</div>
</footer>
</body>

</html>