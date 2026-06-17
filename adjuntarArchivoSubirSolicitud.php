<?

$ruta 			= $_POST['rutArchi'];
$extension	=	$_POST['extension'];
/*
$rut 				= str_replace(".","",$rut);
$rut 				= str_replace("-","",$rut);
*/
$nombre 		= $ruta.$extension;

//echo $nombre;
//copy($_FILES['archivo']['tmp_name'], '../archivos_licencia/'.$_FILES['archivo']['name']);
//copy($_FILES['archivo']['tmp_name'], './archivos_licencia/'.$nombre);

//$_FILES['archivo']['tmp_name'], './archivos_licencia/'.$_FILES['archivo']['name'];
//$_FILES['archivo']['tmp_name'], './archivos_licencia/'.$_FILES['archivo']['name'];   

//$_FILES['archivo']['tmp_name'], './archivos_licencia/';   
       
//echo "<script>
//window.open('','_parent','');
//window.close();
//</script>";



if(copy($_FILES['archivo']['tmp_name'], 'archivos_solicitud/'.$nombre)){
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