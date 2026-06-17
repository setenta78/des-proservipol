<?

Class dbComunas extends conexion
{			
	function listarComunas($region, $comunas){
			
		$sql = "SELECT 
  				COMUNA.COM_CODIGO,
  				COMUNA.COM_DESCRIPCION
				FROM
  				COMUNA ORDER BY COMUNA.COM_DESCRIPCION";
  		
  		//echo $sql;
										
		$result = $this->execstmt($this->Conecta(DB_HOST_SERVICIOS,DB_USER_SERVICIOS,DB_PASS_SERVICIOS,DB_DB_SERVICIOS),$sql);
		mysql_close();
		$i = 0;
		while($myrow = mysql_fetch_array($result)) {
			$comuna = new comuna;
			$comuna->setCodigoComuna($myrow["COM_CODIGO"]);
			$comuna->setDescripcionComuna($myrow["COM_DESCRIPCION"]);
					
			$comunas[$i] = $comuna;				
			$i++;
		}
	}
	
	
	
		
}//end class   
?>