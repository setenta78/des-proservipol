<?
$ruta	= $_POST['rutaArchivo'];

echo "<script>";
if(copy($_FILES['archivoTC']['tmp_name'], 'archivos_TC/'.$ruta)){
	echo "window.open('','_parent','');\n";
	echo "alert('ARCHIVO SUBIDO AL SERVIDOR ...');\n";
	echo "window.close()";
}else{
	echo "alert('ERROR ...');\n";
	echo "window.close()";
}
echo "</script>";

?>