<?
$codigoFuncionario = $_POST['codigoFuncionarioPaso'];
$tipoSubir = $_POST['tipoSubir'];

//copy($_FILES['archivo']['tmp_name'], 'archivos/'.$_FILES['archivo']['name']);           
copy($_FILES['archivo']['tmp_name'], 'archivos/'.$_POST['nombreArchivoAdjuntoFormateado']);

//header("location: fichaPersonalLicenciaConducir.php?codigoFuncionario=".$codigoFuncionarioPaso."&subio=1&nombreArvhio=".$_FILES['archivo']['name']."&tipoSubir=".$tipoSubir);

//include("./configuracionBD2.php"); 
//require("./baseDatos/dbLicenciaConducir.class.php");
//$objFuncionariosLicenciasConducir = new dbLicenciaConducir;
//$objFuncionariosLicenciasConducir->insertArchivoSubido($codigoFuncionario, 'SEMEP', $_FILES['archivo']['name']);



?>
