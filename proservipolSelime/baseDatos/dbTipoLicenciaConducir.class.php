<?
// INICIO DE FUNCIONES

Class dbTipoLicenciaConducir extends Conexion
{			
	function listaTipoLicenciaConducir($tiposDeLicenciaConducir){
		 
		 $sql = "SELECT TLIC_CODIGO, TLIC_DESCRIPCION FROM TIPO_LICENCIA_CONDUCIR WHERE TLIC_ACTIVO = 1 ORDER BY TLIC_CODIGO";
	     
	     //echo $sql;
	        				
		 $result = $this->execstmt($this->Conecta(),$sql);
		 mysql_close();
		 $i=0;
		 while($myrow = mysql_fetch_array($result) ){
		 	$tipoLicenciaConducir = new tipoLicenciaConducir;
		 	$tipoLicenciaConducir->setCodigo($myrow["TLIC_CODIGO"]);
		 	$tipoLicenciaConducir->setDescripcion($myrow["TLIC_DESCRIPCION"]);
		 	
		 	$tiposDeLicenciaConducir[$i] = $tipoLicenciaConducir;
		 	$i++;
		 }
	}
}//end class   
?>