<?
##################################
# Name Class     Conexion.class.php
# Dependence     Config.inc.php 
# Created For    Paolo Viera 
# Date           08-10-1997
# Update         15-03-2001
#
#
#Codigos de Errores
#         "COD2510" = Error de Conexion
#         "COD2530" = Error de Seleccion de Base de Datos
#         "COD2550" = Error de Query
###################################

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

class Conexion
{
	var $link_id;

//-----------------------------FUNCION DE CONEXION
	function conecta()
	{
		
		//echo "EL HOST :".HOST_P."<BR>EL USER :".DB_USER_P."<BR>LA CLAVE :".DB_PASS_P."<BR>LA DB :   ".DB_P;
		//exit;
		//-----------------------------Conectamos
		$CONECT = @mysql_connect(HOST_P,DB_USER_P,DB_PASS_P);		
		//-----------------------------
			//-----------------------------
			//Nuevo intento de Conexion
			
			while ($CONECT != 1 and $i < 8)
			{
	 			$CONECT = mysql_connect(HOST_P, DB_USER_P, DB_PASS_P);
				$i++;
			}
			
		//-----------------------------
		//-----------------------------Controlamos si hubo conexion
		
		
		if (!$CONECT) {
			//echo "fail";
			//exit;
    	$this->msgError("COD2510",$this->ErrorMsgServer());
			exit;
		}else {
			//echo "successful"; 
			//exit;
			$this->link_id = $CONECT;
		}

		//-----------------------------Selecion de Base de Datos

		mysql_select_db (DB_P);
		$db=@mysql_select_db(DB_P,$CONECT);


		//-----------------------------Controlamos si hubo seleccion de Base de Datos
		if (!$db) { 
			$this->msgError("COD2530",$this->ErrorMsgServer());
			exit;
		}else return $CONECT;
		//-----------------------------
	}
	
	
	
	
	
	
	

			## Execute SQL statemente ##
			function execstmt($conn,$query) 
			{
					//echo $conn."   -   ".$query;
					//exit;
					
			    $result=mysql_query($query,$conn);
			    if (!$result) { 
					echo "El query $query es invalido". mysql_error();
					$this->msgError("COD2550",$this->ErrorMsgServer());
					exit;
			    }
			    return $result;
			}
			
			
			
			
			
			
			
			function myrows($result)
			{
				return mysql_fetch_array($result);
			}







//-----------------------------ETAPA DE MENSAJES DE ERRORES
//-----------------------------Buscamos template de Error

	function msgError($tipoError,$MsgServer)
	{
			//-----------------------------Llamada a template
			include("./inc/template/errores/".$tipoError."error.php");
		//-----------------------------Llamada a funcion de envio de email con errores
		if(MSGEMAILERROR == 1)
		{
			 $MsgErrorWebMatesr = $this->EmailMsgError($tipoError,$MsgServer);
					/* subject */
						$subject = "Error Grave en Sitio ".SITIOWEB;
					
				/* message */
				$message = '
				<html>
				<head>
				 <title>Error Grave en ('.SITIOWEB.')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</title>
				</head>
				<body>
					<p>ATENCION :</p>
				<table>
				 <tr>
					<TD ALIGN="CENTER">
					<FONT FACE="VERDANA,SANS-SERIF" SIZE="3" COLOR="#003399">
						<B>
						'.$MsgErrorWebMatesr.'
						</B>
					</FONT>
					</TD>	

				 </tr>
					 <tr>
					  <td><font face="verdana,sans-serif" size=2 color=#000000><b>Soluciona de Forma inmediata este problema o comuniquese con el creado de la aplicacion</b></font></td>
					 </tr>
				</table>
				</body>
				</html>
				';

				/* To send HTML mail, you can set the Content-type header. */
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";					
				/* additional headers */
			$headers .= "From: ".FFROM;
			$headers .= "X-Priority: 1\n"; //1 UrgentMessage, 3 Normal
			$headers .= CC;
			$headers .= BCC;
			$headers .= "Return-Path: <mail@server.com>\n";

				/* y un nuevo email */
				//echo "EL TOO (".TOO.")<BR>".$subject."<BR><BR>".$message."<BR>".$headers;

			$sendemail = mail(TOO, $subject, $message, $headers);
			if(!$sendemail)
			{
				echo "<font color=red>Error Grave: No se pudo enviar el mensaje de error a nuestro operadores, comuniquese con nuestra oficina.</font>";
			}
		}
	}


//-----------------------------Envio de Errores por Via email
	function EmailMsgError($tipoError,$MsgServer)
	{
		return $this->MsgTextoError($MsgServer);
	}




//-----------------------------Texto de errores para el envio al cliente y al Administrador (webmaster)
		function MsgTextoError($MsgServer)
		{
					$msgEmailError = "Señor Webmaster Se ha Producido el siguiente Error de Conexion:<br>";
					$msgEmailError .= $MsgServer;
			RETURN $msgEmailError;
		}

	// captura e indica cuando se ha producido error en MySQL
	function ErrorMsgServer()
	{
		if (mysql_errno() != 0)
		{
			$errorCapturado = mysql_errno() ." : ".mysql_error();
				//echo $errorCapturado."<br>este mensaje esta en la clase de conexion en la funcion ErrorMsgServer";
			RETURN $errorCapturado;	
		}else RETURN(0);
	}

//-----------------------------FUNCION DE DESCONEXION
	function desconecta()
	{
		$DESCONN= @mysql_close($this->link_id);
	}
	
	
	
	
	
	
	

}// end class
?>