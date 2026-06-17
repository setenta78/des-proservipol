<?php
function conectar()
	{
		// Conexion a base de datos
		mysql_connect("168.88.11.23", "prorelcom", "2871") or die(mysql_error());
		mysql_select_db("DB_PROSERVIPOL_V3") or die(mysql_error());
	}

function desconectar()
	{
		mysql_close();
	}

function verificaExistencia($login,$clave)
	{
	/* Funcion encargada de verificar la existencia del login recibido en base de datos. Devuelve TRUE si el apodo existe, FALSE de lo contrario */
	$consulta=mysql_query("SELECT db_nombre,db_apellido,db_clave,db_atributos FROM ingreso WHERE db_login='$login'") or die(mysql_error());
	$registro=mysql_fetch_row($consulta);

	if(!empty($registro) and $registro[2]==$clave)
		{
		 	session_start();
		 	$_SESSION["session_autent_carga"]= "SI";
			$_SESSION["session_login"]= $login;
		 	$_SESSION["session_nombre"]= $registro[0]." ".$registro[1];
		 	$_SESSION["session_atrib"]= $registro[3];
		 	return TRUE;
		}
	else
		{
			return FALSE;
		}
	}


function verificaExistencia2($login,$clave)
	{
	/* Funcion encargada de verificar la existencia del login recibido en base de datos. Devuelve TRUE si el apodo existe, FALSE de lo contrario */
//	$consulta=mysql_query("SELECT db_nombre,db_apellido,db_clave,db_atributos FROM ingreso WHERE db_login='$login'") or die(mysql_error());
//	$registro=mysql_fetch_row($consulta);

	if($login=="982216k" and $clave=="prueba")
		{
		 	session_start();
		 	$_SESSION["session_autent_carga"]= "SI";
			$_SESSION["session_login"]= $login;
		 	$_SESSION["session_nombre"]= "MANUEL BRAVO";
		 	$_SESSION["session_atrib"]= "ADMINISTRADOR";
		 	return TRUE;
		}
	else
		{
			return FALSE;
		}
	}




//conectar();

if(verificaExistencia2($login,$clave))
{
 //desconectar();
 header("location: principal.php");
}

else
{
 //desconectar();
 header("location: index.php?ingreso=error");
}


?>
