<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!--Copyright 2005 Macromedia, Inc. All rights reserved.-->
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<link rel="stylesheet" href="./css/login.css" type="text/css"/>
<script type="text/javascript" src="./js/creaObjeto.js"></script>
<script type="text/javascript" src="./js/variables.js"></script>
<script type="text/javascript" src="./js/login.js"> </script>
</head>
<body id="bodyLogin" onLoad="javascript:actualizarTamanoLogin(); errorClave('<?echo $_GET['ctrl']?>')" onresize="javascript:actualizarTamanoLogin()">
<div id="tableLogin">
	<div id="loginIngresaContrasena">
		<div id="loginIzquierda">
			<img src="./img/logo-trans.png" width="200px" height="233px" bgcolor= "#ffffff">
		</div>
		<div id="loginDerecha">
		<div>
			<form method="post" action="valida.php" id="form1" name="form1">
			<div id="loginNombreSistema">GESTIÓN Y PROGRAMACIÓN DE LOS<BR> SERVICIOS POLICIALES.<BR>PROSERVIPOL V. 3.0</div>
			<div id="loginNombreUsuario">
				<div id="loginLabel">USUARIO : </div>
				<div id="loginText"><input id="loginText" type="text" name="textUsuario" maxlength="10"></div>
			</div>
			<div id="loginClaveUsuario">
				<div id="loginLabel">CLAVE : </div>
				<div id="loginText"><input id="loginText" type="password" name="textClave" maxlength="10"></div>
			</div>
			<div id="loginEntrar">
				<div id="loginLabel">&nbsp;</div>
				<div id="loginText"><input id="loginBoton" type="button" name="btnEntrar" value="ENTRAR" onclick="javascript:validarContrasena()"><br><br>(Ingrese Nombre de usuario y contraseña)</div>
			</div>
			</form>
		</div>
	</div>
</div>
<div id="loginEspacioInferior">Sistema Optimizado para una resolución de 1024 X 768 y Windows Explorer 6.0 o superior</div>		
<div id="loginMenu">
	<div id="loginHref"><a href="#">Acerca de ...</a> | <a href="javascript:enviarCorreo('contacto.indicadores@carabineros.cl','Solicita Contraseña')">Solicitar Contrase&ntilde;a</a> | <a href="javascript:enviarCorreo('contacto.indicadores@carabineros.cl','Olvido de Contraseña')">¿Olvido su Contrase&ntilde;a?</a> | <a href="javascript:enviarCorreo('contacto.indicadores@carabineros.cl','Consulta')">Cont&aacute;ctenos</a></div>
	<div id="loginInspectoria">Carabineros de Chile</div>
</div>
</body>
</html>