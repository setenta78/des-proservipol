<?include("session.php")?>
<?php
$unidad=$_SESSION["USUARIO_CODIGOUNIDAD"];
//$unidad='460';
?>
<html>
<head>
<!-- AJAX -->
<script type="text/javascript" src="./hojaDeRuta/js/creaObjeto.js"></script>

<!-- Funciones -->
<script type="text/javascript" src="./hojaDeRuta/js/funcionesServicio.js"></script>
<script type="text/javascript" src="./hojaDeRuta/js/leeXmlListaServicios.js"></script>


<!-- CSS -->
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./hojaDeRuta/css/hojaDeRuta.css" rel="stylesheet" type="text/css">

<!-- Calendario -->
<script language="javascript" src="./hojaDeRuta/calendario/popcalendar.js"></script>

<!-- Popup Prototype -->
<script type="text/javascript" src="./hojaDeRuta/ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./hojaDeRuta/ventana/js/window.js"> </script>
<script type="text/javascript" src="./hojaDeRuta/ventana/js/effects.js"> </script>
<script type="text/javascript" src="./hojaDeRuta/ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./hojaDeRuta/ventana/js/debug.js"> </script>
<link href="./hojaDeRuta/ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./hojaDeRuta/ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./hojaDeRuta/ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
</head>
<body>
	<?include("header.php")?>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">
		<div id="titulo">Servicios</div>
		<div id="subtitulo">En esta lista se encuentran los Servicios que se encuentran registrados.</div>
		<div style="height:25px"></div>


      <table width="98.3%">
      <tr>
        
        <td align="right" width="90%">
            FECHA&nbsp;:&nbsp;
            <input id="textFechaBuscaHoja" type="text" class="campoTexto2" size="30" readonly>
            
            <a href="#" onclick="popUpCalendar(textFechaBuscaHoja, textFechaBuscaHoja,'dd-mm-yyyy',textFechaBuscaHoja);"><img src="./hojaDeRuta/calendario/images/icono_verde.gif" border="0"></a>
            &nbsp;
        </td>
        
        <td align="right" width="10%">
            <input class="Boton_100" type="button" id="btnBuscaHoja" value="BUSCAR" onclick="buscaFechaServicios('<?php echo $unidad; ?>');">
        </td>
      </tr>
      </table>


		<table width="98.3%"><tr class="linea" ><td></td></tr></table>
			
		<div id="listado">
			<div id="cabeceraGrilla">

              <table cellspacing="1" cellpadding="1" width="100%">
                <tr> 
                  <td id="nombreColumna" width="5%" align="center">No.</td>
                  <td id="nombreColumna" width="15%" align="center">FECHA</td>
                  <td id="nombreColumna" width="30%" align="center">SERVICIO</td>
                  <td id="nombreColumna" width="30%" align="center">EXTRAORDINARIO</td>
                  <td id="nombreColumna" width="20%" align="center">HORARIO</td>
                </tr>
             </table>


		   </div>
		   
		   
      <div id="listadoHojaRuta"></div>

</div>


<table width="98.3%"><tr class="linea" ><td></td></tr></table>


		<div style="height:10px"></div>

		<div id="titulo">Medios de Vigilancia</div>
		<div id="subtitulo">En esta lista se encuentran los Medios de Vigilancia que se encuentran registrados para el Servicio seleccionado.</div>
	
		<div style="height:10px"></div>
		<table width="98.3%"><tr class="linea" ><td></td></tr></table>

		
		
		<div id="listado">
			<div id="cabeceraGrilla">


              <table cellspacing="1" cellpadding="1" width="100%">
                <tr> 
                  <td id="nombreColumna" width="5%" align="center">No.</td>
                  <td id="nombreColumna" width="15%" align="center">SERVICIO</td>
                  <td id="nombreColumna" width="20%" align="center">FACTOR</td>
                  <td id="nombreColumna" width="20%" align="center">VEHICULOS</td>
                  <td id="nombreColumna" width="40%" align="center">FUNCIONARIOS</td>
                </tr>
             </table>


		   </div>
      <div id="listadoMedioVigilancia"></div>

    </div>
		<table width="98.3%"><tr class="linea" ><td></td></tr></table>

</div>
</body>
</html>