<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="./css/Cambio_Fecha.css?v=1.2" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/autocompletar.js?v=1.2"> </script>
<script type="text/javascript" src="./js/rectificarFechas.js?v=1.2"> </script>
<script type="text/javascript" src="./js/creaObjeto.js?v=1.2"></script>
<script type="text/javascript" src="./ventana/js/prototype.js"> </script>
<script type="text/javascript" src="./ventana/js/window.js"> </script>
<script type="text/javascript" src="./ventana/js/effects.js"> </script>
<script type="text/javascript" src="./ventana/js/window_effects.js"> </script>
<script type="text/javascript" src="./ventana/js/debug.js"> </script>
<link href="./ventana/css/default.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/debug.css" 	rel="stylesheet" type="text/css"></link>
<link href="./ventana/css/mac_os_x.css" rel="stylesheet" type="text/css"></link>
<title>Cambios en Fechas de ingreso</title>
</head>
<body>
<input type="hidden" value="" id="fechaLimite" name="fechaLimite"/>
<div id="pagina">
<div id="logo" class="texto">
<table class="texto" border="0">
<tr>
<td><img src="img/logo_depto.jpg" alt="Logo Departamento" align="middle"></td>
<td align="center">CARABINEROS DE CHILE<br>INSPECTORIA GENERAL<br>DEPTO. CONTROL DE GESTION</td>
</tr>
</table>
</div>
<div class="texto2">
<br><b> Bienvenid@</b><br><br><b> La fecha de hoy es: </b><? echo date('d-m-Y'); ?><br><br></div>
<div id="form" class="texto2">
<fieldset style="width:60%; height:80px; border:3px groove:#ccc;">
<legend style="font-weight:bold;font-family:Verdana;font-size: 12px;color:#00000;">BUSCAR FUNCIONARIO</legend>
<br>
<table border="0">
<tr>
<td>&nbsp;Codigo Funcionario (SIN GUION) </td>
<td>:&nbsp;<input type="text" id="textCodigoFuncionario" name="texto" class="campos" size="10" value="" maxlength="7" onkeyup="autocompletar('lista','listaFechas',this.value);" /></td>
</tr>
</table>
</fieldset>
<fieldset style="width:60%; border:1px groove:#fff;">
<div class="autocompleta" id="lista">
</div>
</fieldset>
<br />
<fieldset style="width:60%; border:1px groove:#fff;">
<div id="listaFechas">
</div>
</fieldset>
<br /><br />
<a class="icono" href="../modulos.php"  title="Volver modulos" ><img src='img/icono_volver.jpg' width='55' height='55' border='0' align='middle' alt='Volver'/></a>
</div>
</div>
</body>