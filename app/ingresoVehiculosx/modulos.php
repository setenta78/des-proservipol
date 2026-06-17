<?php
session_start();
if ($_SESSION["session_autent_ingreso"] == "SI")
{?>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Aplicaciones Chris</title>
<link rel="stylesheet" type="text/css" href="style/animacion.css">
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
<?php
echo "<div class='texto3'>";
echo "<br>";
$fecha=date("d/m/Y");
echo "<b>"." Bienvenid@: ".$_SESSION["session_nombre"]."</b>";
echo "<br>";
echo "<b>"." La fecha de hoy es: "."</b>".$fecha;
echo "<br>";
echo "<br>";
echo "</div>";
?>
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
	
	<div align="center" class="salir" >
	<a class="icono" href="salir.php"  title="Salir" ><img src="img/salir.png" width="60" height="60" alt="Salir" border="0" /><br>Salir</a>
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
<?php
} else{ header("location: index.php?ingreso=error2"); }
?>
<script>
			var NoClick1 = true;
			var buton = document.querySelector('.inicio');
			
			buton.addEventListener('click', function() {
				if(NoClick1){
					document.querySelector('.principal').classList.toggle('move');
					document.querySelector('.personal').classList.toggle('move');
					document.querySelector('.vehiculos').classList.toggle('move');
					document.querySelector('.salir').classList.toggle('move');
					document.getElementById('inicio').className = 'desactivado';
					NoClick1 = false;
				}
				else{
					NoClick1 = true;
					document.querySelector('.personal').classList.toggle('movein');
					document.querySelector('.vehiculos').classList.toggle('movein');
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
					document.querySelector('.salir').className = 'salir';
				}
			};
			
</script>