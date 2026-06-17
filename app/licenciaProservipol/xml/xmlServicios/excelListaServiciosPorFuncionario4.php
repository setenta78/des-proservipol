<?php
 
    mysql_connect("168.88.11.26","proservipolv3","carta77");
    mysql_select_db("DB_PROSERVIPOL_V3");
    
 
 $fechaHoy=date("d-m-Y");
 $unidad=$_GET["unidad"];
 
	$consulta = mysql_query("
SELECT 
					  ARMA.ARM_CODIGO,
					  ARMA.MODARM_CODIGO,
					  UCASE(MODELO_ARMA.MODARM_DESCRIPCION) AS MODELO,
					  MODELO_ARMA.MARM_CODIGO,
					  UCASE(MARCA_ARMA.MARM_DESCRIPCION) AS MARCA,
					  ARMA.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  ARMA.TARM_CODIGO,
					  TIPO_ARMA.TARM_DESCRIPCION,
					  UCASE(ARMA.ARM_NUMEROSERIE) AS SERIE,
					  ESTADO.EST_CODIGO,
					  ESTADO.EST_DESCRIPCION,
					  ESTADO_ARMA.UNI_AGREGADO,
  					UNIDAD_AGREGADO.UNI_DESCRIPCION,
            TIPO_SECCION.SEC_DESCRIPCION,
            UNIDAD1.UNI_DESCRIPCION AS UNIDAD_ORIGEN
					FROM
					  ARMA
					  INNER JOIN MODELO_ARMA ON (ARMA.MODARM_CODIGO = MODELO_ARMA.MODARM_CODIGO)
					  INNER JOIN MARCA_ARMA ON (MODELO_ARMA.MARM_CODIGO = MARCA_ARMA.MARM_CODIGO)
					  INNER JOIN UNIDAD ON (ARMA.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN TIPO_ARMA ON (ARMA.TARM_CODIGO = TIPO_ARMA.TARM_CODIGO)
					  LEFT OUTER JOIN ESTADO_ARMA ON (ARMA.ARM_CODIGO = ESTADO_ARMA.ARM_CODIGO)
					  LEFT OUTER JOIN ESTADO ON (ESTADO_ARMA.EST_CODIGO = ESTADO.EST_CODIGO)
					  LEFT OUTER JOIN UNIDAD AS UNIDAD_AGREGADO ON (ESTADO_ARMA.UNI_AGREGADO = UNIDAD_AGREGADO.UNI_CODIGO)
            LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = ESTADO_ARMA.SEC_CODIGO)
            LEFT OUTER JOIN UNIDAD UNIDAD1 ON (ESTADO_ARMA.UNI_CODIGO = UNIDAD1.UNI_CODIGO)
					WHERE
					  ARMA.UNI_CODIGO = ".$unidad." AND 
					  ESTADO_ARMA.FECHA_HASTA IS NULL");
 
//echo $consulta;
	if(mysql_num_rows($consulta) > 0 ){
						
		date_default_timezone_set('America/Santiago');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
		require_once 'PHPExcel/PHPExcel.php';
		//require_once 'PHPExcel/PHPExcel/Writer/Excel2007.php';

		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Proservipol V3") //Autor
							 ->setLastModifiedBy("Proservipol V3") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte Excel con PHP y MySQL")
							 ->setSubject("Reporte Excel con PHP y MySQL")
							 ->setDescription("Reporte de Servicios")
							 ->setKeywords("Reporte Funcionario Servicio")
							 ->setCategory("Reporte excel");

		$tituloReporte = "LISTA DE ARMAS";
		$titulosColumnas = array('TIPO ARMA', 'MARCA','MODELO','SERIE','ESTADO','UNIDAD AGREGADO');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:F1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
            		->setCellValue('E3',  $titulosColumnas[4])
            		->setCellValue('F3',  $titulosColumnas[5]);
            		
		
		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = mysql_fetch_array($consulta)) {
			$unidadDesc=$fila['UNIDAD_ORIGEN'];
			
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['TARM_DESCRIPCION'])
        		    ->setCellValue('B'.$i,  $fila['MARCA'])		 
        		    ->setCellValue('C'.$i,  $fila['MODELO'])		    
        		    ->setCellValue('D'.$i,  $fila['SERIE'])
        		    ->setCellValue('E'.$i,  $fila['EST_DESCRIPCION'])
        		    ->setCellValue('F'.$i,  $fila['UNI_DESCRIPCION']);
            	
					$i++;
		}
		
		$estiloTituloReporte = array(
        	'font' => array(
	        	'name'      => 'Verdana',
    	        'bold'      => true,
        	    'italic'    => false,
                'strike'    => false,
               	'size' =>13,
	            	//'color'     => array(
    	          //  	'rgb' => 'FFFFFF'
        	      // 	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
			
				//'color'	=> array('argb' => 'FFFFFF')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE              
               )
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			//'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,
                	'size' =>11,                          
               // 'color'     => array(
               //     'rgb' => 'FFFFFF'
               // )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        	//	'startcolor' => array(
          //  		'rgb' => '669966'
        	//	),
        	//	'endcolor'   => array(
          //  		'argb' => '669966'
        	//	)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                   // 'color' => array(
                   //     'rgb' => '000000'
                   // )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                  //  'color' => array(
                  //      'rgb' => '000000'
                  //  )
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
				//'color'		=> array('argb' => 'F2F2F2')
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
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:F".($i-1));
				
		for($i = 'A'; $i <= 'F'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle($unidadDesc);

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Disposition: attachment;filename="Detalle Servicios '.'('.$funcionario.')'.'.xlsx"');
		//header('Cache-Control: max-age=0');
		
		
		
		header("Content-Type:   application/vnd.ms-excel");
    //header('Content-Disposition: attachment;filename="Reporte.xls"');
    header('Content-Disposition: attachment;filename="LISTA_ARMAS_'.$unidadDesc.' ('.$fechaHoy.')'.'.xls"');
    header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>