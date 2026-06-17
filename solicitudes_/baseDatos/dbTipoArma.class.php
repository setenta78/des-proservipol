<?
// INICIO DE FUNCIONES

Class dbTipoArma extends Conexion
{			
	function listaTipoArma($tipoArmas){
		 
		$sql = "SELECT 
		 		logisticos.Log_Id, 
		 		logisticos.Log_Descripcion 
		 		FROM 
		 		logisticos
		 		WHERE logisticos.Log_Tipo ='P'";
		 		
		 $sql = "SELECT 
  				TIPO_ARMA.TARM_CODIGO AS COD_TIPOARMA,
  				TIPO_ARMA.TARM_DESCRIPCION AS DES_TIPOARMA
				FROM
  				TIPO_ARMA";
		
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result)){
		 	$tipo = new tipoArma;
		 	$tipo->setCodigo(STRTOUPPER($myrow["COD_TIPOARMA"]));
		 	$tipo->setDescripcion(STRTOUPPER($myrow["DES_TIPOARMA"]));
		 			 	
		 	$tipoArmas[$i] = $tipo;
		 	$i++;
		 }
	}
	
}//end class   
?>