<?php
require_once("class/class.php");
?>
<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=detalle.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASIGNACIONES PENDIENTES</title>
<script src="js/autocompletar.js" type="text/javascript" language="javascript"></script>
<script src="js/funciones.js" type="text/javascript" language="javascript"></script>
<script src="js/popcalendar.js" type="text/javascript" language="javascript"></script>
<link rel="stylesheet" href="css/autocompletar.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/estilos.css" type="text/css" media="all" />
</head>
<body>
<div id="pagina">
<div class="texto3">
<?php 
?>

<div id="delete">
<form name="form" method="post" action="" onsubmit="validate(this);">
<?php
//if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
//{
	//print_r($_POST);

		$obj=new Trabajo();
    $desv=$obj->get_certificado2();
	//exit;
//}

?>
</form>
</div>
</div>
</div>
</body>
</html>
