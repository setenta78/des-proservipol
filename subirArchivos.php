<?
session_start();
($_SESSION['USUARIO_USERNAME']!="007174T") ? header("location:index.php") : null;
?>
<html>
<head>
<title>SITIO PARA SUBIR ARCHIVO AL SERVIDOR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<form name="formSubeArchivo" action="adjuntarArchivoSubirAdmin.php" method="post" enctype="multipart/form-data" target="frameSubirArchivo">
	<input type="text" id="direccion" name="direccion" value="" >
	<input type="file" size="20" name="archivo" id="archivo">
	<input type="submit" value="SUBIR" id="btnSubir" name="btnSubir" >
</form>
</body>
</html>