<?

$ruta 			= $_POST['rutArchi'];

//echo $nombre;
//copy($_FILES['archivo']['tmp_name'], './archivos/licencias/'.$_FILES['archivo']['name']);
if(copy($_FILES['archivo']['tmp_name'], 'archivos_fallas/'.$ruta)){
	//echo "Archivo subido al Servidor...";
	echo "<script>";
	echo "window.open('','_parent','');\n";
	echo "alert('ARCHIVO SUBIDO AL SERVIDOR ...');\n";
	echo "window.close()";
	echo "</script>";
	//echo $nombre;
}else{
	//echo "Error!!";
	echo "alert('ERROR ...');\n";
	}
?>