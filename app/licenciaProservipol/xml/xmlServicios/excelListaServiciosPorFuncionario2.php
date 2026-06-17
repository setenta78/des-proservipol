<?php
 
    mysql_connect("168.88.11.26","proservipolv3","carta77");
    mysql_select_db("DB_PROSERVIPOL_V3");
    
 
 $fechaHoy=date("d-m-Y");
 $unidad=$_GET["unidad"];
 
	$consulta = mysql_query("
SELECT 
				  FUNCIONARIO.FUN_CODIGO AS CODIGO,
				  GRADO.GRA_DESCRIPCION AS GRADO,
				  CONCAT_WS(' ',FUNCIONARIO.FUN_NOMBRE, FUNCIONARIO.FUN_NOMBRE2,FUNCIONARIO.FUN_APELLIDOPATERNO, FUNCIONARIO.FUN_APELLIDOMATERNO) AS NOMBRE,
				  CARGO.CAR_CODIGO,
				  CARGO.CAR_DESCRIPCION AS CARGO,
				  CARGO_FUNCIONARIO.UNI_AGREGADO AS COD_UNIDAD_AGREGADO,
				  UNIDAD.UNI_DESCRIPCION AS DES_UNIDAD_AGREGADO,
				  CARGO_FUNCIONARIO.CUADRANTE_CODIGO,
				  CUADRANTE.CUA_ABREVIATURA,
          CARGO_FUNCIONARIO.SEC_CODIGO,
				  TIPO_SECCION.SEC_DESCRIPCION,
				  UNIDAD1.UNI_DESCRIPCION AS UNIDAD_ORIGEN
				FROM
				  GRADO
				  INNER JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO)
				  AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				  LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				  LEFT OUTER JOIN CARGO ON (CARGO_FUNCIONARIO.CAR_CODIGO = CARGO.CAR_CODIGO)
				  LEFT OUTER JOIN UNIDAD ON (CARGO_FUNCIONARIO.UNI_AGREGADO = UNIDAD.UNI_CODIGO)
  				LEFT OUTER JOIN UNIDAD_CUADRANTE ON (CARGO_FUNCIONARIO.CUADRANTE_CODIGO = UNIDAD_CUADRANTE.CUADRANTE_CODIGO)
  				LEFT OUTER JOIN CUADRANTE ON (UNIDAD_CUADRANTE.CUA_CODIGO = CUADRANTE.CUA_CODIGO)
          LEFT OUTER JOIN TIPO_SECCION ON (TIPO_SECCION.SEC_CODIGO = CARGO_FUNCIONARIO.SEC_CODIGO)
          LEFT OUTER JOIN UNIDAD UNIDAD1 ON (CARGO_FUNCIONARIO.UNI_CODIGO = UNIDAD1.UNI_CODIGO)
				WHERE
				  FUNCIONARIO.UNI_CODIGO = ".$unidad." AND CARGO_FUNCIONARIO.FECHA_HASTA IS NULL");
 
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

		$tituloReporte = "LISTA DE FUNCIONARIOS";
		$titulosColumnas = array('CODIGO', 'GRADO','NOMBRE','CARGO','UNIDAD AGREGADO');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:E1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
            		->setCellValue('E3',  $titulosColumnas[4]);
            		
		
		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = mysql_fetch_array($consulta)) {
			$unidadDesc=$fila['UNIDAD_ORIGEN'];
			
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['CODIGO'])
        		    ->setCellValue('B'.$i,  $fila['GRADO'])		 
        		    ->setCellValue('C'.$i,  $fila['NOMBRE'])		    
        		    ->setCellValue('D'.$i,  $fila['CARGO'])
        		    ->setCellValue('E'.$i,  $fila['DES_UNIDAD_AGREGADO']);
            	
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
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:E".($i-1));
				
		for($i = 'A'; $i <= 'E'; $i++){
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
    header('Content-Disposition: attachment;filename="LISTA_FUNCIONARIOS_'.$unidadDesc.' ('.$fechaHoy.')'.'.xls"');
    header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>