<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>


	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="author" content="Depto. Control de Gestión" />
	<title>PROSERVIPOL - Programación de Servicios Policiales.</title>	
  <script type="text/javascript" src="./js/creaObjeto.js"></script>
  <script type="text/javascript" src="./js/variables.js"></script>
  <script type="text/javascript" src="./js/login.js"> </script>
	<link rel="stylesheet" type="text/css" href="css/estiloIndex.css" />
	
	<!--Lineas añadidas.-->
 <script src="./cuadroDialogo/js/mootools.js" type="text/javascript"></script>
 <script src="./cuadroDialogo/js/sexyalertbox.packed.js" type="text/javascript"></script>
 <script src="./cuadroDialogo/cuadroDialogo.js" type="text/javascript"></script>

 <link rel="stylesheet" href="./cuadroDialogo/css/sexyalertbox.css" type="text/css" media="all"/>
 <link rel="stylesheet" href="./cuadroDialogo/css/global.css" type="text/css" media="all"/>
 <link rel="stylesheet" href="./cuadroDialogo/css/imagen.css" type="text/css" media="all"/>
<!--Fin lineas añadidas.-->
	
	<style type="text/css">
	.auto-style1 {
		border-width: 0px;
	}
	</style>
</head>

<body>
	<div class="header">
		<div id="headerA"><a href="index.php">
			<img src="images/logo2017.fw.png" class="auto-style1"/></a>
		</div>
		<div id="headerB">
			<div id="menuImg">
				<a href="manuales.php">
				<img alt="" height="115" src="images/btn4.fw.png" width="100" class="auto-style1" />
				</a>
			</div>
			<!-- 
			<div id="menuImg">
				<a href="http://168.88.29.2/web/" target="_blank">
				<img alt="" height="115" src="../images/btn3.fw.png" width="100" class="auto-style1" />
				</a>
			</div>
			-->
			<div id="menuImg">
				<a href="http://capacitacioncontroldegestion.carabineros.cl/"  target="_blank">
					<img alt="" height="115" src="images/btn2.fw.png" width="100" class="auto-style1" />
				</a>
			</div>
			<div id="menuImg">
				<a href="http://controldegestion.carabineros.cl/" target="_blank">
				<img alt="" height="115" src="images/btn1.fw.png" width="100" class="auto-style1" />
				</a>
			</div>
			
		</div>
	</div>
	<div class="headerBajo">
		<div id="headerBajoA">
			<span lang="es-cl" id="back">  </span>
		</div>
		<div id="headerBajoB"></div>
	</div>
	<div class="content">
	<marquee><font face="Verdana" size="3" color="red">Próximo cierre correspondiente al mes de <strong>Mayo de 2017</strong> está programado para el día  <strong>Martes 06 de Junio</strong> a las 18:00 hrs.</font></marquee>
		<div id="login">		
			<form method="post" action="valida.php" id="form1" name="form1">
				<h2>SISTEMA <br/> 				
					PROSERVIPOL V3.0
				</h2>
				<img alt="" height="50" src="images/pro1.fw.png" width="50" />
				<div>
					<span id="txtForm">Usuario :</span> 
					<input name="textUsuario" type="text" class="login-campos" id="textUsuario" placeholder="ingrese usuario" onkeypress="javascript:enter(event,this)" maxlength="10" />
				</div>
				<br/>
				<div>
					<span id="txtForm">   Clave... :</span>
					<input name="textClave" type="password" class="login-campos" id="textClave" placeholder="ingrese clave" onkeypress="javascript:enter(event,this)" maxlength="10"  />
				</div>
				<br/>
				<div>
					<!--<input name="btnEntrar" type="button" class="menu2" id="loginBoton" onclick="javascript:validarContrasena()" value="Ingresar" />-->
					<input name="btnEntrar" type="button" class="menu2" id="loginBoton" onclick="javascript:validarContrasena()" value="Ingresar" />
				</div>
			</form>
		</div>
				
	</div>
	<div class="footer2">
		<p id="footerText">INSPECTORIA GENERAL DE CARABINEROS<br/>
		Departamento Control de Gestión y Sistemas de Información<br/>
		2017</p>
	</div>
</body>

</html>
