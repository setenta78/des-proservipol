<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">


<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta name="author" content="Depto. Control de Gestión" />
	<title>PROSERVIPOL - Programación de Servicios Policiales.</title>
	
	<script type="text/javascript" src="./js/videos.js"></script>
	<link rel="stylesheet" type="text/css" href="css/estiloIndex.css" />
       
  <link rel="shortcut icon" href="../favicon.ico"> 
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/style2.css" />
  <link rel="stylesheet" type="text/css" href="css/Modal.css" />
  <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css' />
  
<style type="text/css">
	.auto-style1 {
		border-width: 0px;
}
</style>

</head>

<body>
	<div class="header">
		<div id="headerA"><a href="index.php">
			<img src="images/logo2017.fw.png" class="auto-style1" /></a>
		</div>
		<div id="headerB">
			<div id="menuImg">
				<a href="manuales.php">
				<img alt="" height="115" src="images/btn4.fw.png" width="100" class="auto-style1" />
				</a>
			</div>
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
			<span lang="es-cl" id="titulo">PROGRAMACIÓN DE SERVICIOS POLICIALES</span>
		</div>

		<!--<div id="headerBajoB" class="auto-style1"></div>-->
	</div>
	<div class="content2">
		<br/>
		<!--
			 L = LUPA 
			 A = CLIP
			 F = CARPETA
			 H = PARENTESIS
			 K = ADJUNTO/ARCHIVO			 
	-->
	<div id="xColumnas">
		<ul class="ca-menu">
    	<li>
    		<a style="cursor: hand;" onClick="mostrarVideos('Ingreso_licencia','Ingreso de Licencia Médica');" >
        	<span class="ca-icon">M</span>
          <div class="ca-content">
          	<h2 class="ca-main">Licencias Médicas </h2>
            <h3 class="ca-sub">Ingreso de Licencia Médica</h3>
          </div>
        </a>
      </li>
    </ul>
    <ul class="ca-menu">
     	<li>
    		<a style="cursor: hand;" onClick="mostrarVideos('Ingreso_folio','Ingreso de Folio');" >
        	<span class="ca-icon">M</span>
          <div class="ca-content">
          	<h2 class="ca-main">Licencias Médicas </h2>
            <h3 class="ca-sub">Ingreso de Folio</h3>
          </div>
        </a>
      </li>
    </ul>
    <ul class="ca-menu">
     	<li>
    		<a style="cursor: hand;" onClick="mostrarVideos('Fo_Fr','Asignación de Fechas');" >
        	<span class="ca-icon">M</span>
          <div class="ca-content">
          	<h2 class="ca-main">Licencias Médicas </h2>
            <h3 class="ca-sub">Asignación de Fechas</h3>
          </div>
        </a>
      </li>
    </ul>
    <ul class="ca-menu">
      <li>
    		<a style="cursor: hand;" onClick="mostrarVideos('Servicio','Servicios sobrepuestos a la licencia');" >
        	<span class="ca-icon">M</span>
          <div class="ca-content">
          	<h2 class="ca-main">Licencias Médicas </h2>
            <h3 class="ca-sub">Servicios sobrepuestos a la licencia</h3>
          </div>
        </a>
      </li>
    </ul>
    <ul class="ca-menu">
      <li>
    		<a style="cursor: hand;" onClick="mostrarVideos('Recortar_licencia','Recorte de fechas en Licencias Médicas');" >
        	<span class="ca-icon">M</span>
          <div class="ca-content">
          	<h2 class="ca-main">Licencias Médicas </h2>
            <h3 class="ca-sub">Recorte de fechas en Licencias Medicas</h3>
          </div>
        </a>
      </li>
    </ul>
    <ul class="ca-menu">
      <li>
    		<a style="cursor: hand;" onClick="mostrarVideos('Anular_licencia','Anulación de Licencia Médica');" >
        	<span class="ca-icon">M</span>
          <div class="ca-content">
          	<h2 class="ca-main">Licencias Médicas </h2>
            <h3 class="ca-sub">Anulación de Licencia Médica</h3>
          </div>
        </a>
      </li>
    </ul>
	</div>

	<div class="footer">
		<p id="footerText">INSPECTORIA GENERAL DE CARABINEROS<br/>
		Departamento Control de Gestión y Sistemas de Información<br/>
		2017</p>
	</div>

<!--   Pop up Videos     -->	
	<div class="modal-wrapper" id="popup">
   	<div class="popup-contenedor"  id="popup-contenedor">
	</div>
<!--                    -->

</body>

</html>