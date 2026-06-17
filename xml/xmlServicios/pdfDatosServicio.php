<?
//	header ('content-type: text/xml');
	include("../configuracionBD4.php");
	require("../../baseDatos/dbServicios.class.php");
	require("../../objetos/servicio.class.php");
	require("../../objetos/unidad.class.php");
	require("../../objetos/tipoServicio.class.php");
	require("../../objetos/tipoServicioExtraordinario.class.php");
	require("../../objetos/escalafon.class.php");
	require("../../objetos/grado.class.php");
	require("../../objetos/funcionario.class.php");
	require("../../objetos/medioVigilancia.class.php");
	require("../../objetos/tipoVehiculo.class.php");
	require("../../objetos/vehiculo.class.php");
	require("../../objetos/cuadrante.class.php");
	require("../../objetos/tipoAccesorio.class.php");
	require("../../objetos/tipoArma.class.php");
	require("../../objetos/arma.class.php");
	require("../../objetos/tipoAnimal.class.php");
	require("../../objetos/fechaHora.class.php");
	require("../../objetos/factor.class.php");
	require("../../objetos/animal.class.php");
	require("../../objetos/camara.class.php");

//--- CONTENIDO COMUN INICIO PDF
	include ('../imprimible/class.ezpdf.php');
	$pdf =new Cezpdf();
	$pdf->selectFont('../imprimible/fonts/Helvetica.afm');

	$pdf->ezSetMargins(30,30,70,30);

	$pdf->ezText("<b>CARABINEROS DE CHILE</b>",10);
	$pdf->ezText("<b>PROSERVIPOL V3.5</b>",10);
	$pdf->ezText("<b>DETALLE SERVICIO</b>",10);
	$pdf->ezText("",10);
//------------------------------
	
	$unidad 	 = $_GET['unidad'];
	$correlativo = $_GET['correlativo'];
	
	$objServicios = new dbServicios;
	$objServicios->buscaDatosServicio($unidad, $correlativo, &$servicio);
	$objServicios->buscaMedioVigilancia($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaCuadrantesAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaAccesoriosAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaArmasAsignadas($unidad, $correlativo, &$mediosVigilancia);
	//$objServicios->buscaAnimalesAsignados($unidad, $correlativo, &$mediosVigilancia);
	//$objServicios->buscaHojaDeRuta($unidad, $correlativo, &$tieneHojaRuta);
	$objServicios->buscaAnimalAsignado($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaCamarasAsignadas($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscadestinosAsignados($unidad, $correlativo, &$mediosVigilancia);
	
	$cantidadFuncionarios = count($funcionarios);
	$cantidadMediosVigilancia = count($mediosVigilancia);

	$fechaPaso 		= explode("-",$servicio->getFecha());
	$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
	
	$objFecha = new fechaHora;
	$fechaCompleta = $objFecha->formatoFechaCompleta($servicio->getFecha());
	//echo "<servicio>";

	$filasEncabezado[]=array("<b>Unidad</b>","<b>:</b>",$servicio->getUnidad()->getDescripcionUnidad());
	$filasEncabezado[]=array("<b>Servicio</b>","<b>:</b>",$servicio->getTipoServicio()->getDescripcion());
	$filasEncabezado[]=array("<b>Fecha Servicio</b>","<b>:</b>",$fechaMostrar);
	$filasEncabezado[]=array("<b>Inicio</b>","<b>:</b>",$servicio->getHoraInicio());
	$filasEncabezado[]=array("<b>Termino</b>","<b>:</b>",$servicio->getHoraTermino());
	$filasEncabezado[]=array("<b>Fecha de Impresion</b>","<b>:</b>",date("d-m-Y \a \l\a\s H:i:s"));

	$pdf->ezTable($filasEncabezado,'','',array('colGap'=>2,'fontSize'=>8,'width'=>510,'showHeadings'=>0,'shaded'=>0,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>1,'cols'=>array(array('width'=>90),array('width'=>10))));
	$pdf->ezText("",10);

	$filasObservaciones[]=array($servicio->getObservaciones());

   	if($mediosVigilancia != ""){
   		for ($i=0; $i<$cantidadMediosVigilancia; $i++){
   			if ($mediosVigilancia[$i]->getVehiculo()->getCodigoVehiculo() == ""){
				$codigoVehiculo 	= 0;
				$patenteVehiculo 	= "INFANTERIA";
				$tipoVehiculo 		= "SIN VEHICULO";
			}
   			else {
				$codigoVehiculo 	= $mediosVigilancia[$i]->getVehiculo()->getCodigoVehiculo();
				$patenteVehiculo 	= $mediosVigilancia[$i]->getVehiculo()->getPatente();
				$tipoVehiculo 		= $mediosVigilancia[$i]->getVehiculo()->getTipoVehiculo()->getDescripcion();
   			}
			$pdf->ezText("<b>Medio de Vigilancia Nro. ".$mediosVigilancia[$i]->getNumeroMedio()."</b>",8);
			
			if($codigoVehiculo!=0){
				$filasVehiculo[]=array("<b>Vehiculo</b>","<b>:</b>",$tipoVehiculo." (".$patenteVehiculo.")","<b>Kilometraje Inicial</b>","<b>:</b>",number_format($mediosVigilancia[$i]->getKmInicial(),0,'','.')." KMS.");
				$filasVehiculo[]=array("<b>Kilometros Recorridos</b>","<b>:</b>",number_format($mediosVigilancia[$i]->getKmFinal()-$mediosVigilancia[$i]->getKmInicial(),0,'','.')." KMS.","<b>Kilometraje Final</b>","<b>:</b>",number_format($mediosVigilancia[$i]->getKmFinal(),0,'','.')." KMS.");
				$pdf->ezTable($filasVehiculo,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510,
				'cols'=>array(array('width'=>90),array('width'=>10),'',array('width'=>75),array('width'=>10),array('width'=>130))));
				unset($filasVehiculo); 
			}
			
          	$filasMedio[]=array("<b>Factor</b>","<b>:</b>",$mediosVigilancia[$i]->getFactor()->getDescripcion());
			$contFuncionarios = 0;
	   		for($j=0; $j<$mediosVigilancia[$i]->getCantidadDeFuncionarios(); $j++){
				$descripcion = strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno())." ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno()).", ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getPNombre())." - ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion())." (".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario().")";
				if($mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas() > 0 ){
					for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas(); $k++){
						$etiqueta = "";
						if ($contFuncionarios==0) $etiqueta = "<b>Personal";
						if ($k>0) $descripcion = "";
						$filasFuncionario[] = array($etiqueta, ($etiqueta!="") ? ":</b>" : "",
												$descripcion,
												$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getTipo()->getDescripcion()." (".$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getNumeroSerie().")");
						$contFuncionarios++;
					}
				} else {
					$etiqueta = "";
					if ($contFuncionarios==0) $etiqueta = "<b>Personal";
					$filasFuncionario[] = array($etiqueta, ":</b>",
											$descripcion, "");
					$contFuncionarios++;
				}
				
				if($mediosVigilancia[$i]->getFuncionarios($j)->getCantidadCamaras() > 0){
					for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadCamaras(); $k++){
						$descripcionCamara = "<b>Camara (Nro:</b>".$mediosVigilancia[$i]->getFuncionarios($j)->getCamaras($k)->getNumeroSerie()."<b>)</b>";
						$filasFuncionario[] = array("", "", "",
												$descripcionCamara);
					}
				}
				
				if($mediosVigilancia[$i]->getFuncionarios($j)->getCantidadAccesorios() > 0){
					for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadAccesorios(); $k++){
						$descripcionAccesorio = $mediosVigilancia[$i]->getFuncionarios($j)->getAccesorios($k)->getDescripcion();
						$filasFuncionario[] = array("", "", "",
												$descripcionAccesorio);
					}
				}

				$pdf->ezTable($filasFuncionario,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510
                ,'cols'=>array(array('width'=>90),array('width'=>10),'',array('width'=>130))
                ));
				if($mediosVigilancia[$i]->getFuncionarios($j)->getAnimales()){
                    $filasAnimal[]=array("<b>Animal Asignado</b>","<b>:</b>",$mediosVigilancia[$i]->getFuncionarios($j)->getAnimales()->getCodigo()." ","<b>nombre Animal</b>","<b>:</b>",$mediosVigilancia[$i]->getFuncionarios($j)->getAnimales()->getDescripcion()." ");
                    $pdf->ezTable($filasAnimal,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510,
                    'cols'=>array(array('width'=>90),array('width'=>10),'',array('width'=>75),array('width'=>10),array('width'=>130))));
                    unset($filasAnimal);
                }
                unset($filasFuncionario);
			}

			$cuadrantesMedio = "";
			for($j=0; $j<$mediosVigilancia[$i]->getCantidadDeCuadrantes(); $j++){
				if($j==0){
					$cuadrantesMedio=$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion();
				}
				else{
					$cuadrantesMedio=$cuadrantesMedio.", ".$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion();
				}
			}

			$filasMedio[]=array("<b>Cuadrante(s)</b>","<b>:</b>",$cuadrantesMedio);
			
			$pdf->ezTable($filasMedio,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510
			,'cols'=>array(array('width'=>90),array('width'=>10))
			));

			$pdf->ezText("",10);

			unset($filasVehiculo);
			//unset($filasFuncionario); 
			unset($filasMedio); 

  		}
   	}

	$pdf->ezText("<b>Observaciones</b>",8);
	$pdf->ezTable($filasObservaciones,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510));
	unset($filasObservaciones);

//--- CONTENIDO COMUN FINAL PDF
$pdf->ezStream();
//-----------------------------
?>