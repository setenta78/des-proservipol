<?php
	require_once 'connect.php';
	
	header("Content-type: text/xml");
	
	mysqli_set_charset($conn, "utf8");
		
	//$sql = "SELECT * FROM member";
	
	/*
	$sql = "SELECT 	VEH_CODIGO,
									TVEH_CODIGO,
									PREC_CODIGO,
									VEH_BCU,
									VEH_SAP,
									UNI_CODIGO,
									MVEH_CODIGO,
									MODVEH_CODIGO,
									VEH_PATENTE,
									VEH_NUMEROINSITUCIONAL,
									VEH_CODIGOANTERIOR,
									ANNO_FABRICACION,
									VALIDA_ANNO_FABRICACION
					FROM VEHICULO 
					INNER JOIN 
					LIMIT 10";
	*/				
					
	$sql = "SELECT 	
						VEHICULO.VEH_CODIGO,
						VEHICULO.TVEH_CODIGO,
						VEHICULO.PREC_CODIGO,
						PROCEDENCIA_RECURSO.PREC_DESCRIPCION,
						VEHICULO.VEH_BCU,
						VEHICULO.VEH_SAP,
						VEHICULO.UNI_CODIGO,
						UNIDAD.UNI_DESCRIPCION,
						VEHICULO.MVEH_CODIGO,
						MARCA_VEHICULO.MVEH_DESCRIPCION,
						VEHICULO.MODVEH_CODIGO,
						MODELO_VEHICULO.MODVEH_DESCRIPCION,
						VEHICULO.VEH_PATENTE,
						VEHICULO.VEH_NUMEROINSITUCIONAL,
						VEHICULO.VEH_CODIGOANTERIOR,
						VEHICULO.ANNO_FABRICACION,
						VEHICULO.VALIDA_ANNO_FABRICACION
					FROM VEHICULO 
					LEFT JOIN PROCEDENCIA_RECURSO ON (VEHICULO.PREC_CODIGO = PROCEDENCIA_RECURSO.PREC_CODIGO)
					LEFT JOIN MARCA_VEHICULO ON (VEHICULO.MVEH_CODIGO = MARCA_VEHICULO.MVEH_CODIGO)
					LEFT JOIN MODELO_VEHICULO ON (VEHICULO.MODVEH_CODIGO = MODELO_VEHICULO.MODVEH_CODIGO AND MODELO_VEHICULO.MVEH_CODIGO = VEHICULO.MVEH_CODIGO)
					LEFT JOIN UNIDAD ON (VEHICULO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					LIMIT 10000";					
	
	if(!$result = mysqli_query($conn, $sql)) die();

	$xml = '<vehiculos>';
	while($row = mysqli_fetch_array($result)){
	   $xml .="<vehiculo>".
	   							/*
	   			        "<firstname>".strtoupper($row['VEH_CODIGO'])."</firstname>".
	   			        "<lastname>".strtoupper($row['TVEH_CODIGO'])."</lastname>".
	   			        */
	   			        
	   			        
	   			        "<codigo>".strtoupper($row['VEH_CODIGO'])."</codigo>".
	   			        "<codigoTipo>".strtoupper($row['TVEH_CODIGO'])."</codigoTipo>".
	   			        "<codigoProcedencia>".strtoupper($row['PREC_CODIGO'])."</codigoProcedencia>".
	   			        "<procedencia>".strtoupper($row['PREC_DESCRIPCION'])."</procedencia>".
	   			        "<bcu>".strtoupper($row['VEH_BCU'])."</bcu>".
	   			        "<sap>".strtoupper($row['VEH_SAP'])."</sap>".
	   			        "<codigoUnidad>".strtoupper($row['UNI_CODIGO'])."</codigoUnidad>".
	   			        "<unidad>".strtoupper($row['UNI_DESCRIPCION'])."</unidad>".
	   			        "<codigoMarca>".strtoupper($row['MVEH_CODIGO'])."</codigoMarca>".
	   			        "<marca>".strtoupper($row['MVEH_DESCRIPCION'])."</marca>".
	   			        "<codigoModelo>".strtoupper($row['MODVEH_CODIGO'])."</codigoModelo>".
	   			        "<modelo>".strtoupper($row['MODVEH_DESCRIPCION'])."</modelo>".
	   			        "<patente>".strtoupper($row['VEH_PATENTE'])."</patente>".
	   			        "<numeroInstitucional>".strtoupper($row['VEH_NUMEROINSITUCIONAL'])."</numeroInstitucional>".
	   			        "<codigoAnterior>".strtoupper($row['VEH_CODIGOANTERIOR'])."</codigoAnterior>".	
	   			        "<yearFabricacion>".strtoupper($row['ANNO_FABRICACION'])."</yearFabricacion>".  
	   			        "<validaYearFabricacion>".strtoupper($row['VALIDA_ANNO_FABRICACION'])."</validaYearFabricacion>". 
	   			         			        
	   			  "</vehiculo>";      
	}	
	$xml .= '</vehiculos>';

	echo $xml;							
	


/*
VEH_CODIGO
TVEH_CODIGO
PREC_CODIGO
VEH_BCU
VEH_SAP
UNI_CODIGO
MVEH_CODIGO
MODVEH_CODIGO
VEH_PATENTE
VEH_NUMEROINSITUCIONAL
VEH_CODIGOANTERIOR
ANNO_FABRICACION
VALIDA_ANNO_FABRICACION
*/

?>