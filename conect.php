<?

define ("HOST_P" , "168.88.11.21"); 			// SERVIDOR
define ("DB_USER_P" , "proservipol2016");	// USUARIO BASE DE DATOS
define ("DB_PASS_P" , "proservipol2016");	// PASSWORD BASE DE DATOS
define ("DB_P" , "DB_Personal");					// BASE DE DATOS

echo "Conectando a la Base de Personal...";

$CONECT = @mysql_connect(HOST_P,DB_USER_P,DB_PASS_P);		

if (!$CONECT) {
	echo "fail";
	exit;
}else {
	echo "successful"; 
	exit;
}

?>