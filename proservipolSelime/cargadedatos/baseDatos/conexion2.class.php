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

class Conexion2
{
	var $link_id;

//-----------------------------FUNCION DE CONEXION
	function conecta($HOST,$DB_USER,$DB_PASS,$DB)
	{
		//echo "EL HOST :".$HOST."<BR>EL USER :".$DB_USER."<BR>LA CLAVE :".$DB_PASS."<BR>LA DB :   ".$DB;
		//-----------------------------Conectamos
		$CONECT = mssql_connect($HOST,$DB_USER,$DB_PASS);		
		//-----------------------------
			//-----------------------------
			//Nuevo intento de Conexion
			while ($CONECT != 1 and $i < 8)
			{
	 			$CONECT = mssql_connect($HOST,$DB_USER,$DB_PASS);
				$i++;
			}

		//-----------------------------
		//-----------------------------Controlamos si hubo conexion
		
		
		if (!$CONECT) {
    			//$this->msgError("COD2510",$this->ErrorMsgServer());
			exit;
		}else $this->link_id = $CONECT;


		//-----------------------------Selecion de Base de Datos

		mssql_select_db ($DB);
		$db=mssql_select_db($DB,$CONECT);


		//-----------------------------Controlamos si hubo seleccion de Base de Datos
		if (!$db) { 
			//$this->msgError("COD2530",$this->ErrorMsgServer());
			exit;
		}else return $CONECT;
		//-----------------------------
	}

			## Execute SQL statemente ##
			function execstmt($conn,$query) 
			{
			    $result=mssql_query($query,$conn);
			    if (!$result) { 
				//	echo "El query $query es invalido". mysql_error();
				//	$this->msgError("COD2550",$this->ErrorMsgServer());
				//	exit;
					$result = mssql_error();
			    }
			    return $result;
			}
			function myrows($result)
			{
				return mssql_fetch_array($result);
			}

//-----------------------------FUNCION DE DESCONEXION
	function desconecta()
	{
		$DESCONN= @mssql_close($this->link_id);
	}

}// end class
?>