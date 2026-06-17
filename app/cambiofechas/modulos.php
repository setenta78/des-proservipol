<?php
include("../class/class.php");

//require_once("solicitudesDesarrollo/js/valida.php");

//Incluimos el archivo con la función o simplemente pegamos la función
//require('fechaTexto.php');
if (isset($_SESSION["session_video_14"])) {
	$codigo = $_SESSION["session_video_14"];
	$grado  = $_SESSION["session_video_15"];
	$nombre = $_SESSION["session_video_16"];

	$tipo = $_SESSION["session_video_17"];

	$datos  = "(" . $grado . ")" . " - " . $nombre;
	//echo $codigo." ".$user." ".$descripcion
	//La fecha que queremos pasar a castellano

	//$miFecha = date('l jS \of F Y h:i:s A'); // date("d-m-Y h:m:s");

?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Aplicaciones Chris</title>
<link rel="stylesheet" type="text/css" href="style/animacion.css">
<link rel="stylesheet" href="../css/estilos.css" type="text/css" />
</head>
<body>
</div>
<div id="logo" class="texto">
<table class="texto" border="0">
<tr>
<td><img src="img/logo_depto.jpg" alt="Logo Departamento" align="middle"></td>
<td align="center">CARABINEROS DE CHILE<br>INSPECTORIA GENERAL<br>DEPTO. CONTROL DE GESTIÓN</td>
</tr>
</table>
</div>
		<div class="texto3">
			<?php
			$fecha = date("d/m/Y");
			echo "<table border='0'>";
			echo "<tr>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
			echo "</table>";
			echo "<b>" . " &nbsp;&nbsp;&nbsp;Bienvenid@" . "</b>" . ": " . $datos;
			echo "<br>";
			echo "&nbsp;&nbsp;&nbsp; VOLVER <a href='http://proservipol.carabineros.cl/app/aplicativos.php'><img src='../img/icono_volver.jpg' border='0'  width='30' align='middle' alt='Salir'/></a>";
			echo "<br>";
			?>
		</div>
<div id="pagina">
<div class="principal">
	
	<div align="center" class="personal">
		<a class="icono" href="personal/index.php"  title="Corrección Fechas Personal" >
			<img src="img/consulta.gif" width="80" height="80"/>
			<br>Personal</a>
	</div>
	
	<div align="center" class="vehiculos">
		<a class="icono" href="vehiculo/index.php"  title="Corrección Fechas Vehiculos" >
			<img src="img/consulta.gif" width="80" height="80"/>
			<br>Vehiculos</a>
	</div>
	
	<div align="center" class="armas">
		<a class="icono" href="armas/index.php"  title="Corrección Fechas Armas" >
			<img src="img/consulta.gif" width="80" height="80"/>
			<br>Armas</a>
	</div>
	
	<div align="center" class="salir" >
	<a class="icono" href="http://proservipol.carabineros.cl/app/aplicativos.php"  title="Salir" ><img src="img/salir.png" width="60" height="60" alt="Salir" border="0" /><br>Salir</a>
	</div>
	
</div>

<div align="center" class="inicio">
<a class="icono" id="inicio" ><img src="img/funcionarios.png" width="90" height="90" alt="Inicio" align="center"/><br>Rectificación<br>de Fechas</a>
</div>

</body>
<footer>
<div class="texto">
@Desarrollos Chris.
</div>
</footer>
</html>
<script>
			var NoClick1 = true;
			var buton = document.querySelector('.inicio');
			
			buton.addEventListener('click', function() {
				if(NoClick1){
					document.querySelector('.principal').classList.toggle('move');
					document.querySelector('.personal').classList.toggle('move');
					document.querySelector('.vehiculos').classList.toggle('move');
					document.querySelector('.armas').classList.toggle('move');
					document.querySelector('.salir').classList.toggle('move');
					document.getElementById('inicio').className = 'desactivado';
					NoClick1 = false;
				}
				else{
					NoClick1 = true;
					document.querySelector('.personal').classList.toggle('movein');
					document.querySelector('.vehiculos').classList.toggle('movein');
					document.querySelector('.armas').classList.toggle('movein');
					document.querySelector('.salir').classList.toggle('movein');
					document.getElementById('inicio').className = 'icono';
				}
			});
			
			document.querySelector('.salir').addEventListener('transitionend', onTransitionEnd, false);

			function onTransitionEnd() {
				if(NoClick1){
					document.querySelector('.principal').className = 'principal';
					document.querySelector('.personal').className = 'personal';
					document.querySelector('.vehiculos').className = 'vehiculos';
					document.querySelector('.armas').className = 'armas';
					document.querySelector('.salir').className = 'salir';
				}
			};
			
</script>

<?php
} else {
	echo "
	<script type='text/javascript'>
	alert('DEBE INICIAR SESI\u00D3N PARA ACCEDER A ESTE CONTENIDO');
	window.location='http://proservipol.carabineros.cl/app/';
	</script>
	";
}
?>