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

<!--Lineas añadidas.-->
<script src="./cuadroDialogo/js/mootools.js" type="text/javascript"></script>
<script src="./cuadroDialogo/js/sexyalertbox.packed.js" type="text/javascript"></script>
<script src="./cuadroDialogo/cuadroDialogo.js" type="text/javascript"></script>
<script src="./cuadroDialogo/js/cierreMes.js" type="text/javascript"></script>
<link rel="stylesheet" href="./cuadroDialogo/css/sexyalertbox.css" type="text/css" media="all"/>
<link rel="stylesheet" href="./cuadroDialogo/css/global.css" type="text/css" media="all"/>
<link rel="stylesheet" href="./cuadroDialogo/css/imagen.css" type="text/css" media="all"/>
<!--Fin lineas añadidas.-->

<!--Lineas añadidas.-->
<script type="text/javascript" src="./js/evaluarTaller.js"></script>
<link href="./css/tallerRevision.css" rel="stylesheet" type="text/css"></link>
<!--Fin lineas añadidas.-->



</head>


<body id="bodyLogin" onLoad="javascript:actualizarTamanoLogin(); errorClave('<?echo $_GET['ctrl']?>');" onresize="javascript:actualizarTamanoLogin()">
	<!--<div id="capacitacion">
		<img src="./cuadroDialogo/img/2015.png" width="521px" height="444px" alt="¡¡Felices fiestas!!">
	</div>-->	
<div id="tableLogin">
	<div id="loginIngresaContrasena">
<div id="loginImagen">
			
		</div>
		<div id="loginIzquierda">
			<img src="./img/logo-trans.png" width="190px" height="223px" bgcolor= "#ffffff">
		</div>
		
	
		<div id="loginDerecha">

 <div id="loginCalendar">
 <script  type="text/javascript">
  // Mostrar calendario
  document.write(cal);
  </script>
  <div id="divMessage" style="text-align: justify; width:175px; height:80px; font-size: 12px; font-family: Arial; color:#000000;">
   <script  type="text/javascript">
  // Mostrar calendario
  document.write(msj);
  </script>
  </div>
 </div>
		<div>
			<form method="post" action="valida.php" id="form1" name="form1">
			<div id="loginNombreSistema">GESTIÓN Y PROGRAMACIÓN DE LOS<BR> SERVICIOS POLICIALES.<BR>PROSERVIPOL V. 3.0</div>
			<div id="loginNombreUsuario">
				<div id="loginLabel">USUARIO : </div>
				<div id="loginText"><input id="loginText" type="text" name="textUsuario" onkeypress="javascript:enter(event,this)" maxlength="10"></div>
			</div>
			<div id="loginClaveUsuario">
				<div id="loginLabel">CLAVE : </div>
				<div id="loginText"><input id="loginText" type="password" name="textClave" onkeypress="javascript:enter(event,this)" maxlength="10"></div>
			</div>
			<div id="loginEntrar">
				<div id="loginLabel">&nbsp;</div>
				<div id="loginText"><input id="loginBoton" type="button" name="btnEntrar" value="ENTRAR" onclick="javascript:validarContrasena()"><br><br>(Ingrese Nombre de usuario y contraseña)</div>
			</div>
			</form>
		</div>
	</div>
</div>
<br>
<br>
<div id="iconos">
<table align="center">
<tr align="center">
<td><img src="./cuadroDialogo/img/iconoManual.png" width="60px" height="60px" alt="Manual"/></td>
<td><img src="./cuadroDialogo/img/question.png" width="55px" height="55px" alt="Preguntas"/></td>
<td><img src="./cuadroDialogo/img/logo_depto_ctrl.png" width="55px" height="60px" alt="Instructivos"/></td>
<td><img src="./cuadroDialogo/img/capacitacion.png" width="70px" height="50px" alt="Capacitaci&oacute;n"/></td>
</tr>
<tr align="center">
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="manuales.php" style="color:009900" title="Manual">Manual de usuario</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="preguntas.php" style="color:009900" title="Preguntas">Preguntas frecuentes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="instructivos.php" style="color:009900" title="Instructivos">Instructivos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="construccion.php" style="color:009900" title="Capacitaci&oacute;n">Capacitaci&oacute;n</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
</div>	
<div id="loginEspacioManual"></div>
<!--<<div id="loginEspacioInferior">Optimizado para Internet Explorer 7 o Superior y una resolución de pantalla de 1280 X 1024</div>-->
<div id="loginEspacioInferior"><br>@Desarrollado por el Departamento Control de Gesti&oacute;n - Inspectoria General.
<br><br>Optimizado para Internet Explorer 7 o superior&nbsp;<img src="./cuadroDialogo/img/internet-explorer-icono.png" width="25px" height="25px" align="middle" alt="Internet Explorer"/>&nbsp;y una resolución de pantalla de 1280 x 1024 
</div>
<!--<<div id="loginEspacioInferior">Sistema Optimizado para una resolución de 1280 X 1024 y Windows Explorer 6.0 o superior</div>-->		
<!--<<div id="loginMenu">
	<!--<<div id="loginHref"><a href='manualesInstrucciones.php' target='_blank'>Instrucciones y Manuales Sistema Proservipol</a></div>-->
	<!--<div id="loginHref"><a href='./manuales/manualUsuarioProservipolV3.pdf' target='_blank'>Manual de Usuario Proservipol v.3.0</a> | <a href="./manuales/preguntasFrecuentes.pdf" target='_blank'>Preguntas y Respuestas Frecuentes</a> | <a href='./manuales/guiaValidacionServicios.pdf' target='_blank'>Guía Validación de Servicios</a> | <a href="./manuales/INSTRUCTIVO AJUSTES PROSERVIPOL 01072013.pdf">INSTRUCTIVO AJUSTES PROSERVIPOL 01072013.pdf</a> | <a href="./manuales/procedimientoRegistroColaciones.pdf">REGISTRO DE COLACIONES</a></div>-->
	<!--<<div id="loginInspectoria">Carabineros de Chile</div>-->
</div>
<!----  -->
	<div class="modal-wrapper" id="popup">
    <div class="popup-contenedor">
       <h2>ATENCIÓN!!</h2>
       	<div id="popup-contenedor"></div>
       	<a class="popup-cerrar" onclick="cerrarResultados();">X</a>
    SE EXTIENDE EL PLAZO PARA REALIZACIÓN DEL CURSO HASTA EL LUNES 27 A LAS 13:00 HORAS. <br><br>
    EL FIN DE SEMANA NO SE RESPONDERÁ EL MAIL NI EL FORO. <br><br>
    SI PRESENTA INCONVENIENTES PARA ABRIR EL ARCHIVO DEL TALLER ES PORQUE SU OFFICE NO ES COMPATIBLE, INTENTE DESCARGARLO DE UN  COMPUTADOR MÁS MODERNO E IMPRIMIRLO.<br><br>
		EL TALLER SÓLO SE PUEDE REALIZAR DESDE INTERNET EXPLORER. <br><br>
		RECUERDE QUE SU CLAVE DE ACCESO SON LOS 4 PRIMEROS DÍGITOS DE SU RUT. <br><br>
		DEBE REALIZAR EL TALLER EN EL ORDEN QUE SE INDICA, SI NO PUEDE HACER UN EJERCICIO REALICE EL SIGUIENTE. <br><br><br>
<button class="btnPractica" align="center" onclick="cerrarResultados();">Cerrar informativo</button>
       	<br>
    </div>
	</div>
<!--   -->
</body>
</html>

<script language="javascript">

/* pop up taller */
//mostrar();

function enter(even,elem){
	tecla=(elem) ? event.keyCode : even.which;
	if(tecla==13){
		if(elem.name=="textClave"){
			validarContrasena();
		}
		else{
			document.getElementById('textClave').focus();
		}
  }
}

</script>