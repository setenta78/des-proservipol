<?
session_start();
($_SESSION['USUARIO_USERNAME']!="007174T") ? header("location:index.php") : null;
?>
<html>
<head>
<title>SITIO PARA SUBIR ARCHIVO AL SERVIDOR</title>
</head>
<body>
<form name="formSubeArchivo" action="adjuntarArchivoSubirAdmin.php" method="POST" enctype="multipart/form-data">
	<input type="text" id="direccion" name="direccion" value="" >
	<input type="file" name="archivo" id="archivo">
	<input type="submit" value="SUBIR ARCHIVO" id="btnSubir" name="btnSubir" >
</form>
</body>
</html>