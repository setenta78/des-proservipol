<?php
 
    mysql_connect("168.88.11.26","proservipolv3","carta77");
    mysql_select_db("DB_PROSERVIPOL_V3");
    
  $fecha1 		= $_GET["f1"];
	$fecha2			= $_GET["f2"];

  $fechaPaso 		= explode("-",$fecha1);
  $fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
  $fechaPaso 		= explode("-",$fecha2);
  $fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
 //echo $fechaBuscar2;
 
 $funcionario=$_GET["func"];

	$consulta = mysql_query("
      SELECT 
					 SERVICIO.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  SERVICIO.CORRELATIVO_SERVICIO,
					  SERVICIO.TSERV_CODIGO,
					  FUNCIONARIO_SERVICIO.FUN_CODIGO AS COD_FUNC,
					  GRADO.GRA_DESCRIPCION AS GRADO,
					  CONCAT_WS(' ',FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2,FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO) AS NOMBRE_COMPLETO,
					  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS SERVICIO,
					  SERVICIO.TEXT_CODIGO,
					  TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION,
					  SERVICIO.FECHA,
					  SERVICIO.HORA_INICIO,
					  SERVICIO.HORA_TERMINO
					FROM
	  FUNCIONARIO_SERVICIO
					  INNER JOIN SERVICIO ON (FUNCIONARIO_SERVICIO.UNI_CODIGO = SERVICIO.UNI_CODIGO)
					  AND (FUNCIONARIO_SERVICIO.CORRELATIVO_SERVICIO = SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN FUNCIONARIO ON (FUNCIONARIO_SERVICIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
					  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
            INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					WHERE
					  FUNCIONARIO_SERVICIO.FUN_CODIGO = '".$_GET["func"]."' AND 
					  SERVICIO.FECHA BETWEEN '".$fechaBuscar1."' AND '".$fechaBuscar2."'
					  ");
 
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

		$tituloReporte = "LISTA DE SERVICIOS REALIZADOS";
		$titulosColumnas = array('UNIDAD', 'FUNCIONARIO','GRADO','NOMBRE','FECHA', 'SERVICIO', 'INICIO','TERMINO');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:H1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
            		->setCellValue('E3',  $titulosColumnas[4])
            		->setCellValue('F3',  $titulosColumnas[5])
            		->setCellValue('G3',  $titulosColumnas[6])
            		->setCellValue('H3',  $titulosColumnas[7]);
		
		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = mysql_fetch_array($consulta)) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['UNI_DESCRIPCION'])
        		    ->setCellValue('B'.$i,  $fila['COD_FUNC'])		 
        		    ->setCellValue('C'.$i,  $fila['GRADO'])		    
        		    ->setCellValue('D'.$i,  $fila['NOMBRE_COMPLETO'])
		            ->setCellValue('E'.$i,  $fila['FECHA'])		    
        		    ->setCellValue('F'.$i,  $fila['SERVICIO'])
            		->setCellValue('G'.$i, utf8_encode($fila['HORA_INICIO']))
            		->setCellValue('H'.$i, utf8_encode($fila['HORA_TERMINO']));
            	
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
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:H3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:H".($i-1));
				
		for($i = 'A'; $i <= 'H'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Detalle Servicios');

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
    header('Content-Disposition: attachment;filename="Detalle Servicios '.'('.$funcionario.')'.'.xls"');
    header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>