<?
$ruta 			= $_POST['rutArchi'];
$extension	=	$_POST['extension'];
$nombre 		= $ruta.$extension;

if(copy($_FILES['archivo']['tmp_name'], 'archivos_licencia/'.$nombre)){
	echo "<script>";
	echo "window.open('','_parent','');\n";
	echo "alert('ARCHIVO SUBIDO AL SERVIDOR ...');\n";
	echo "window.close()";
	echo "</script>";
}else{
	echo "alert('ERROR ...');\n";
}
?>