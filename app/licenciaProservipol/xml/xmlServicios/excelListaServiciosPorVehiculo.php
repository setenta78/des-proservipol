<?php
 
    mysql_connect("168.88.11.26","proservipolv3","carta77");
    mysql_select_db("DB_PROSERVIPOL_V3");
    
  $fecha1 		= $_GET["f1"];
	$fecha2			= $_GET["f2"];

  $fechaPaso 		= explode("-",$fecha1);
  $fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
  $fechaPaso 		= explode("-",$fecha2);
  $fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
  
  $fechaHoy=date("d-m-Y");
   	
 //echo $fechaBuscar2;
 
 $vehiculo=$_GET["veh"];

	$consulta = mysql_query("			  
					  SELECT 
					  SERVICIO.UNI_CODIGO,
					  UNIDAD.UNI_DESCRIPCION,
					  SERVICIO.CORRELATIVO_SERVICIO,
					  SERVICIO.TSERV_CODIGO,
					  UCASE(TIPO_SERVICIO.TSERV_DESCRIPCION) AS SERV_DESCRIPCION,
					  SERVICIO.TEXT_CODIGO,
					  UCASE(TIPO_EXTRAORDINARIO.TEXT_DESCRIPCION) AS SERV_EXTRA,
					  SERVICIO.FECHA,
					  VEHICULO.VEH_BCU,
					  VEHICULO.VEH_PATENTE,
					  MARCA_VEHICULO.MVEH_DESCRIPCION AS MARCA,
					  VEHICULO_SERVICIO.KM_INICIAL,
					  VEHICULO_SERVICIO.KM_FINAL
					FROM
					  SERVICIO
					  INNER JOIN VEHICULO_SERVICIO ON (SERVICIO.UNI_CODIGO = VEHICULO_SERVICIO.UNI_CODIGO)
					  AND (SERVICIO.CORRELATIVO_SERVICIO = VEHICULO_SERVICIO.CORRELATIVO_SERVICIO)
					  INNER JOIN TIPO_SERVICIO ON (SERVICIO.TSERV_CODIGO = TIPO_SERVICIO.TSERV_CODIGO)
					  LEFT OUTER JOIN TIPO_EXTRAORDINARIO ON (SERVICIO.TEXT_CODIGO = TIPO_EXTRAORDINARIO.TEXT_CODIGO)
					  INNER JOIN UNIDAD ON (SERVICIO.UNI_CODIGO = UNIDAD.UNI_CODIGO)
					  INNER JOIN VEHICULO ON (VEHICULO_SERVICIO.VEH_CODIGO = VEHICULO.VEH_CODIGO)
					  INNER JOIN MARCA_VEHICULO ON(VEHICULO.MVEH_CODIGO = MARCA_VEHICULO.MVEH_CODIGO)
					WHERE
					  VEHICULO_SERVICIO.VEH_CODIGO = ".$_GET["veh"]." AND 
					  SERVICIO.FECHA BETWEEN '".$fechaBuscar1."' AND '".$fechaBuscar2."' 
					  ORDER BY SERVICIO.FECHA DESC
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
							 ->setKeywords("Reporte Vehiculo Servicio")
							 ->setCategory("Reporte excel");

		$tituloReporte = "LISTA DE SERVICIOS REALIZADOS";
		$titulosColumnas = array('UNIDAD', 'BCU','PATENTE','MARCA','FECHA', 'SERVICIO', 'KM INICIAL','KM FINAL');
		
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
        		    ->setCellValue('B'.$i,  $fila['VEH_BCU'])		 
        		    ->setCellValue('C'.$i,  $fila['VEH_PATENTE'])		    
        		    ->setCellValue('D'.$i,  $fila['MARCA'])
		            ->setCellValue('E'.$i,  $fila['FECHA'])		    
        		    ->setCellValue('F'.$i,  $fila['SERV_DESCRIPCION'])
            		->setCellValue('G'.$i, utf8_encode($fila['KM_INICIAL']))
            		->setCellValue('H'.$i, utf8_encode($fila['KM_FINAL']));
            	
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
    header('Content-Disposition: attachment;filename="Detalle Servicios '.'('.$fechaHoy.')'.'.xls"');
    header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>