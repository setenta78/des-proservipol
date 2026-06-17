<?
Class dbMensaje extends Conexion{
	
	function mensajesActuales($mensajes){
		
		$sql = "SELECT 
					M.TITULO,
					M.CONTENIDO_FORMATEADO,
					M.TIEMPO,
					M.UNIDAD_VISIBLE
				FROM MENSAJE M
				WHERE M.FECHA_INICIO <= DATE(NOW())
				AND M.FECHA_TERMINO >= DATE(NOW())";
	    	
		//echo $sql;
		$result = $this->execstmt($this->Conecta(),$sql);
		mysql_close();
		$i=0;
		while($myrow = mysql_fetch_array($result)){
			$mensaje = new mensaje;
			$mensaje->setTitulo($myrow["TITULO"]);
			$mensaje->setContenido($myrow["CONTENIDO_FORMATEADO"]);
			$mensaje->setTiempo($myrow["TIEMPO"]);
			$mensaje->setUnidades($myrow["UNIDAD_VISIBLE"]);
			
			$mensajes[$i] = $mensaje;
			$i++;
	 	}
	}
	
}
?>