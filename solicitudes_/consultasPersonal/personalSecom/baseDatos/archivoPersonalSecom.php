<?php
session_start();
if (is_uploaded_file($HTTP_POST_FILES['archivo']['tmp_name'])) {
copy($HTTP_POST_FILES['archivo']['tmp_name'], '../archivos/personal.txt');
$subio = true;
}

if($subio)
{
  header("location: ../../personalAgregado.php?errorArchivo=0");
}

else

{
  header("location: ../../personalAgregado.php?errorArchivo=1");
}
?>