<?php
require_once("class/class.php");
if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	//print_r($_POST);
	$objLogin=new Trabajo();
	$objLogin->login();
	exit;	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PROSERVIPOL V3.9</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<meta name="theme-color" content="#3c763d;">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">	
</head>


<body class="bg-login">
	<div class="margintop-login">
  
	    <div class="carabineros">
		    <div  style="line-height: 32px; width: 85%; float: right; text-align: left;">
		        <h1 class="title-name-app">PROSERVIPOL V3.9</h1>
		        <h5 class="subtitle-name-app">DEPTO. CONTROL DE GESTIÓN Y SIST. DE INFORMACIÓN</h5>
		    </div>
		    <div  style="width: 30%">
		        <img src="assets/images/carabineros.png" width="70" height="auto">
		    </div>
	    </div>
		<div style="clear:both"></div>
	    <div class="login-page"  class="background-black-06">
	   		<div class="autentificatic-sello text-center">
	   			<!--<a href="http://autentificaticapi.carabineros.cl/assets/documents/procedimiento_de_seguridad.pdf" target="_blank">-->
	   			<!--<img src="http://autentificaticapi.carabineros.cl/assets/images/autentificatic.png" width="280" height="auto" style="padding-top: 6px;">-->
	   			</a>
	   		</div>
	   			<div  class="text-center">
			        <a href="#popup"><img src="assets/images/info.png" width="60" height="auto"></a>
			    </div>
		    <div class="input-size">		    	 
		        <form id="form_login" action="index.php" method="post" autocomplete="off">
		         	<div class="input-group form-group">
		          		<input name="rut_funcionario" id="rut_funcionario" type="text" class="input-style" size="10" onChange="validaCodigo(this);" style="text-transform:uppercase;" required>
		          		<span class="highlight"></span>
			            <span class="bar"></span>
			                 <label class="label-input"><i class="fa fa-user"></i> Código de funcionario (Sin guión)</label>
		              	<div class="invalid-feedback">
	                    	<span id="rut_error"></span>
	                  	</div>		                             
		          	</div>
			        <div class="input-group form-group">
			        	<input name="clave_intranet" id="clave_intranet" type="password" class="input-style" size="20" required>
			            <span class="highlight"></span>
			            <span class="bar"></span>
			             <label class="label-input"><i class="fa fa-lock"></i> Contraseña</label>
			            <div class="invalid-feedback">
		                	<span id="password_error"></span>
		                </div>	             
			          </div>		        

		         	<div style="float: left;">
		         		<!--<a href="http://autentificatic.carabineros.cl/password/reset" style="width: 50%" >Recuperar contrase🺯a>-->
		         	</div>

		         	<div style="float: right;">
		         		<!--<a href="http://autentificatic.carabineros.cl/register" style="width: 50%">Registrate en autentificatic</a>-->
		         	</div>

		         	<div style="clear: both; padding-bottom: 15px;"></div>

		          	<div class="text-center">
				    	<button type="submit" class="btn-login">Iniciar Sesion</button>
				    	<input type="hidden" name="grabar" value="si"/>
				  	</div>
				  	<div class="text-center">
				  		<p style="margin-bottom: 0px;"><strong>Consultas Proservipol  V3.9</strong></p>
				  	</div>
				</form>		       
		   	</div>
		</div>

	  	<div class="text-center information-bottom">
		  <div class="title-by">Desarrollado por el Depto. Control de Gestión Sistemas de Información (DCGSI) © 2019</div>	
		  <div class="title-deskhelp">MESA DE AYUDA: 20828, 20831, 20843, 20844</div>
		</div>	    

		<div class="logos-bottom">
			<img src="http://intranetv2.carabineros.cl/DescargasTIC/aniversario.png" width="70" height="auto"  style="padding-top: 20px; text-align:center;">
			<!--<img src="http://intranetv2.carabineros.cl/DescargasTIC/sello-TIC.png" width="70" height="auto" style="float: right;">-->
		</div>

		<div class="text-center slogan"><img src="http://intranetv2.carabineros.cl/DescargasTIC/slogan.png" style="padding-top: 20px;"></div>

	</div>

	 <div id="popup" class="overlay">
        <div id="popupBody">
            <h2>Objetivo del sistema</h2>
            <a id="cerrar" href="#">&times;</a>
            <div class="popupContent">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>


	<script type="text/javascript" src="assets/js/main.js"></script>
	

</body>
</html>