<?include("version.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="author" content="Depto. Control de Gestión" />
	<link rel="icon" type="image/png" href="images/logoDepartamentoP.png" />
	<title>PROSERVIPOL - Programación de Servicios Policiales.</title>
  <script type="text/javascript" src="./js/creaObjeto.js"></script>
  <script type="text/javascript" src="./js/login.js"> </script>
	<link rel="stylesheet" type="text/css" href="css/New_estiloIndex.css" />
 	<script src="./cuadroDialogo/js/mootools.js" type="text/javascript"></script>
 	<script src="./cuadroDialogo/js/sexyalertbox.packed.js" type="text/javascript"></script>
 	<script src="./cuadroDialogo/cuadroDialogo.js" type="text/javascript"></script>
 	<link rel="stylesheet" href="./cuadroDialogo/css/sexyalertbox.css" type="text/css" media="all"/>
 	<link rel="stylesheet" href="./cuadroDialogo/css/imagen.css" type="text/css" media="all"/>
	<link type="image/x-icon" rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
	<div class="header"></div>
	<div class="logo"></div>
	<div class="bannerImg2"></div>
	<div class="bannerTitle"></div>
	<div class="backHeader">
	<marquee>
	<font face="Verdana" size="3" color="white"><strong>IMPORTANTE:</strong> EL CIERRE DE LOS REGISTROS DE LOS SERVICIOS DE SEPTIEMBRE SE REALIZARÁ EL DIA LUNES 04 DE OCTUBRE A LAS 17:00 HRS.</font>
	</marquee>
	</div>
	<div class="content">
	<div class="links">
		<div class="bannerManuales"><a href="manuales.php" target="_blank"><img alt="Manuales" height="115" src="images/btn4.fw.png" width="100" style="border:none;" /></a></div>
		<div class="bannerCapacitacion"><a href="http://capacitacioncontroldegestion.carabineros.cl/" target="_blank"><img alt="Capacitación" height="115" src="images/btn2.fw.png" width="100" style="border:none;" /></a></div>
		<div class="bannerSiicge"><a href="http://controldegestion.carabineros.cl/" target="_blank"><img alt="Sistema Control de Gestión" height="115" src="images/btn1.fw.png" width="100" style="border:none;" /></a></div>
	</div>
	<div id="login">
	<form method="post" action="valida.php" id="form1" name="form1">
		<h2>SISTEMA <br/>
			PROSERVIPOL V3.9
		</h2>
		<img alt="" height="50" src="images/pro1.fw.png" width="50" />
		<div>
			<span id="txtForm">Usuario :</span> 
			<input name="textUsuario" type="text" class="login-campos" id="textUsuario" placeholder="ingrese usuario" onkeypress="javascript:enter(event,this)" maxlength="10" />
		</div>
		<br/>
		<div>
			<span id="txtForm">   Clave&nbsp;&nbsp;&nbsp; :</span>
			<input name="textClave" type="password" class="login-campos" id="textClave" placeholder="ingrese clave" onkeypress="javascript:enter(event,this)" maxlength="10"  />
		</div>
		<br/>
		<div>
			<input name="btnEntrar" type="button" class="menu2" id="loginBoton" onclick="javascript:validarContrasena()" value="Ingresar" />
		</div>
	</form>
	</div>
	</div>
</body>
<footer>
	<div class="footer">
		<div class="footerBrowser">
			<p>Sitio soportado por los siguientes navegadores web</p><br>
			<img class="footerBrowserIcon" src="./img/explorer.png" height="30px" width="30px" />
			<img class="footerBrowserIcon" src="./img/edge.png" height="30px" width="30px" />
			<img class="footerBrowserIcon" src="./img/chrome.png" height="30px" width="30px" />
			<img class="footerBrowserIcon" src="./img/firefox.png" height="30px" width="30px" />
			<img class="footerBrowserIcon" src="./img/safari.png" height="30px" width="30px" />
			<img class="footerBrowserIcon" src="./img/opera.png" height="30px" width="30px" />
		</div>
		<p class="footerText">
			Versión 3.9.<?echo version?><br/><br/>
			CONTRALORIA GENERAL DE CARABINEROS<br/>
			Departamento Control de Gestión y Sistemas de Información<br/>
			2021
		</p>
	</div>
</footer>
</html>