<?php
date_default_timezone_set("America/Santiago");
//echo "hola";
$codigo = $_GET["cod"];
$fecha1 = $_GET["f1"];
$fecha2 = $_GET["f2"];
//echo $codigo;


   
    mysql_connect("172.21.100.41","saguilera","4577");
    mysql_query("SET NAMES 'utf8'");
	  mysql_select_db("DB_PROSERVIPOL_V3");

	$consulta = mysql_query("SELECT 
  VISTA_ARBOL_UNIDADES_NACIONAL.ZONA_DESCRIPCION AS ZONA,
  VISTA_ARBOL_UNIDADES_NACIONAL.PREFECTURA_DESCRIPCION AS PREFECTURA,
  VISTA_ARBOL_UNIDADES_NACIONAL.DEPENDIENTE_DESCRIPCION AS COMISARIA,
  VISTA_ARBOL_UNIDADES_NACIONAL.UNI_DESCRIPCION AS DESTACAMENTO,
  VISTA_ARBOL_UNIDADES_NACIONAL.UNI_CODIGO AS UNIDAD_PROSERVIPOL,
  FUNCIONARIO.FUN_CODIGO AS CODIGO,
  FUNCIONARIO.FUN_RUT AS RUT,
  GRADO.GRA_DESCRIPCION AS GRADO,
  CONCAT_WS(' ', FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO, FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2) AS NOMBRE_COMPLETO,
  SERVICIO.FECHA,
  SERVICIO.CORRELATIVO_SERVICIO AS ID_SERVICIO,
  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS SERVICIO_REALIZADO,
  TIPO_SERVICIO.TSERV_CODIGO AS TIPO_SERVICIO,
  SERVICIO.HORA_INICIO AS HRA_INICIO,
  SERVICIO.HORA_TERMINO AS HRA_TERMINO
FROM
  SERVICIO
  INNER JOIN FUNCIONARIO_SERVICIO ON (SERVICIO.UNI_CODIGO = FUNCIONARIO_SERVICIO.UNI_CODIGO)
  AND (SERVICIO.CORRELATIVO_SERVICIO = FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO)
  INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO)
  AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
  LEFT JOIN VISTA_ARBOL_UNIDADES_NACIONAL ON (SERVICIO.UNI_CODIGO = VISTA_ARBOL_UNIDADES_NACIONAL.UNI_CODIGO)
  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
WHERE
  FUNCIONARIO.FUN_CODIGO = '".$codigo."' AND SERVICIO.FECHA BETWEEN '".$fecha1."' AND '".$fecha2."'
ORDER BY
  SERVICIO.FECHA");
 

	if(mysql_num_rows($consulta) > 0 ){
						
		date_default_timezone_set('America/Santiago');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'libreria\PHPExcel\PHPExcel.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
							 ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de alumnos")
							 ->setKeywords("reporte alumnos carreras")
							 ->setCategory("Reporte excel");

		$tituloReporte = "LISTADO DE SERVICIOS";
		$titulosColumnas = array('ZONA','PREFECTURA','COMISARIA','DESTACAMENTO','ID_UNIDAD','CODIGO','RUT','GRADO','NOMBRE','FECHA','ID_SERVICIO','SERVICIO_REALIZADO','TIPO_SERVICIO','HRA_INICIO','HRA_TERMINO');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:O1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
				      	->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A2',  $titulosColumnas[0])
		            ->setCellValue('B2',  $titulosColumnas[1])
        		    ->setCellValue('C2',  $titulosColumnas[2])
            		->setCellValue('D2',  $titulosColumnas[3])
            		->setCellValue('E2',  $titulosColumnas[4])
            		->setCellValue('F2',  $titulosColumnas[5])
        		    ->setCellValue('G2',  $titulosColumnas[6])
            		->setCellValue('H2',  $titulosColumnas[7])
            		->setCellValue('I2',  $titulosColumnas[8])
            		->setCellValue('J2',  $titulosColumnas[9]) 
                ->setCellValue('K2',  $titulosColumnas[10]) 
                ->setCellValue('L2',  $titulosColumnas[11]) 
                ->setCellValue('M2',  $titulosColumnas[12]) 
                ->setCellValue('N2',  $titulosColumnas[13]) 
                ->setCellValue('O2',  $titulosColumnas[14]);
            		            		            		                           				                    		    
		//Se agregan los datos de los alumnos
		$i = 3;                 		
		while ($fila = mysql_fetch_array($consulta)) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['ZONA'])
		            ->setCellValue('B'.$i,  $fila['PREFECTURA'])
        		    ->setCellValue('C'.$i,  $fila['COMISARIA'])
            		->setCellValue('D'.$i,  $fila['DESTACAMENTO'])
            		->setCellValue('E'.$i,  $fila['UNIDAD_PROSERVIPOL'])
            		->setCellValue('F'.$i,  $fila['CODIGO'])
            		->setCellValue('G'.$i,  $fila['RUT'])
            		->setCellValue('H'.$i,  $fila['GRADO'])
            		->setCellValue('I'.$i,  $fila['NOMBRE_COMPLETO'])
            		->setCellValue('J'.$i,  $fila['FECHA'])
            		->setCellValue('K'.$i,  $fila['ID_SERVICIO'])
            		->setCellValue('L'.$i,  $fila['SERVICIO_REALIZADO'])
            		->setCellValue('M'.$i,  $fila['TIPO_SERVICIO'])
            		->setCellValue('N'.$i,  $fila['HRA_INICIO'])
            		->setCellValue('O'.$i,  $fila['HRA_TERMINO']);
            		            		            		                      	
					$i++;
		}
		
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size'   =>     12,
	            	'color'     => array(
    	            	'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => '669966')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,  
                'size' =>10,                        
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => '669966'
        		),
        		'endcolor'   => array(
            		'argb' => '669966'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                    'color' => array(
                        'rgb' => '000000'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_NONE ,
                    'color' => array(
                        'rgb' => '000000'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Verdana',  
               	'size' =>10,             
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'F2F2F2')
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => '3a2a47'
                   	)
               	)             
           	)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A2:O2')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:E".($i-1));
				
		for($i = 'A'; $i <= 'O'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(FALSE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Servicios');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
     //$nombre="Funcionarios";
     $fecha=date("d-m-Y H_i_s"); 
     $salida="(".$codigo.") ".$fecha;
     
		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$salida.'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>