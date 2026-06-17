<?include("version.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="author" content="Depto. Control de Gestión" />
	<link rel="icon" type="image/png" href="images/logoDepartamentoP.png" />
	<title>PROSERVIPOL - Programaci&oacute;n de Servicios Policiales.</title>
	<script type="text/javascript" src="./js/creaObjeto.js"></script>
	<script type="text/javascript" src="./js/login.js"> </script>
	<link rel="stylesheet" type="text/css" href="css/aplicacion.css" />
	<link rel="stylesheet" type="text/css" href="css/New_estiloIndex.css" />
 	<link type="image/x-icon" rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
	<div class="header">
		<img src="./images/IsLSAE.jpg" height="100%" width="100%"/>
		<p style="position: absolute; top:75px; left:500px; font-family: Verdana, Arial,sans-serif; font-size: 64px; color: #FFF;">
		SITIO EN MANTENIMIENTO</p>
	</div>
	<div class="logo">
		<img src="./images/logoDepartamento.png" height="180px" width="180px" />
	</div>
	<div class="content">
	<div id="carga"></div>
	
	<img src="./images/pc-1.png" height="300px" width="300px" style="position: absolute; top:50px; left: 750px;"/>
	<img src="./images/load.gif" height="125px" width="125px" style="position: absolute; top:135px; left: 820px;"/>
	<img src='./images/load2.gif' height="350px" width="350px" style="position: absolute; top:250px; left: 750px;" />
	
	</div>
</body>
<footer>
	<div class="footer">
		<div id="footerBrowser">
			<p>Sitio soportado por los siguientes navegadores web</p><br>
			<img id="footerBrowserIcon" src="./img/explorer.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" src="./img/edge.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" src="./img/chrome.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" src="./img/firefox.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" src="./img/safari.png" height="30px" width="30px" />
			<img id="footerBrowserIcon" src="./img/opera.png" height="30px" width="30px" />
		</div>
		<p id="footerText">
			Versi&oacute;n 3.9.<?echo version?><br/><br/>
			CONTRALORIA GENERAL DE CARABINEROS<br/>
			Departamento Control de Gesti&oacute;n y Sistemas de Informaci&oacute;n<br/>
			2021
		</p>
	</div>
</footer>
</html>
<script>

function mostrarBrowser(){
	var marquee = "<marquee LOOP=1 direction='right' height='60px'>";
		marquee += "<img src='./img/opera.png' height='30px' width='30px' />";
		marquee += "<img src='./img/safari.png' height='30px' width='30px' />";
		marquee += "<img src='./img/firefox.png' height='30px' width='30px' />";
		marquee += "<img src='./img/chrome.png' height='30px' width='30px' />";
		marquee += "<img src='./img/edge.png' height='30px' width='30px' />";
		marquee += "<img src='./img/explorer.png' height='30px' width='30px' />";
		marquee += "<img src='./images/abeja.gif' height='50px' width='100px' />";
		marquee += "</marquee>";
	
	document.getElementById("carga").innerHTML = marquee;
}

setInterval('mostrarBrowser()',300000);

</script>