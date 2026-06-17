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

//--- CONTENIDO COMUN INICIO PDF
include ('../imprimible/class.ezpdf.php');
$pdf =new Cezpdf();
$pdf->selectFont('../imprimible/fonts/Helvetica.afm');

$pdf->ezSetMargins(30,30,100,50);

$pdf->ezText("<b>CARABINEROS DE CHILE</b>",10);
$pdf->ezText("<b>PROSERVIPOL V3.0</b>",10);
$pdf->ezText("<b>DETALLE SERVICIO</b>",10);
$pdf->ezText("",10);
//------------------------------
		
	$unidad 	 = $_POST['codigoUnidad'];
	$correlativo = $_POST['correlativo'];
	
	$unidad 	 = 10;
	$correlativo = 4477;
		
	$objServicios = new dbServicios;
	$objServicios->buscaDatosServicio($unidad, $correlativo, &$servicio);
	//$objServicios->buscaFuncionariosAsignados($unidad, $correlativo, &$funcionarios);
	$objServicios->buscaMedioVigilancia($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaCuadrantesAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaAccesoriosAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaArmasAsignadas($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaAnimalesAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaHojaDeRuta($unidad, $correlativo, &$tieneHojaRuta);
	
	$cantidadFuncionarios = count($funcionarios);
	$cantidadMediosVigilancia = count($mediosVigilancia);
	//echo "cantidadMediosVigilancia " . $cantidadMediosVigilancia;

	//echo "<\?xml version=\"1.0\" encoding=\"ISO-8859-1\"?\>";
  //echo "<root>";
   	
   		$fechaPaso 		= explode("-",$servicio->getFecha());
   		$fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];
   		
   		$objFecha = new fechaHora;
   		$fechaCompleta = $objFecha->formatoFechaCompleta($servicio->getFecha());
   		
   		//echo "<servicio>";

$filasEncabezado[]=array("Unidad",":",$servicio->getUnidad()->getDescripcionUnidad());
$filasEncabezado[]=array("Servicio",":",$servicio->getTipoServicio()->getDescripcion());
$filasEncabezado[]=array("Fecha Servicio",":",$fechaMostrar);
$filasEncabezado[]=array("Inicio",":",$servicio->getHoraInicio());
$filasEncabezado[]=array("Término",":",$servicio->getHoraTermino());
$pdf->ezTable($filasEncabezado,'','',array('fontSize'=>8,'showHeadings'=>0,'shaded'=>0,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>1));
$pdf->ezText("",10);


/*
   		echo "<identificacionServicio>";
   		echo "<codUnidad>".$servicio->getUnidad()->getCodigoUnidad()."</codUnidad>";
   		echo "<desUnidad>".$servicio->getUnidad()->getDescripcionUnidad()."</desUnidad>";
   		echo "<fecha>".$fechaMostrar."</fecha>";
   		echo "<fechaCompleta>".$fechaCompleta."</fechaCompleta>";
   		echo "<codServicio>".$servicio->getTipoServicio()->getCodigo()."</codServicio>";
   		echo "<desServicio>".$servicio->getTipoServicio()->getDescripcion()."</desServicio>";
   		echo "<tipoServicio>".$servicio->getTipoServicio()->getTipo()."</tipoServicio>";
   		echo "<codServicioExtraordinario>".$servicio->getServicioExtraordinario()->getCodigo()."</codServicioExtraordinario>";
   		echo "<desServicioExtraordinario>".$servicio->getServicioExtraordinario()->getDescripcion()."</desServicioExtraordinario>";
   		echo "<desOtroServicioExtraordinario>".$servicio->getDescripcionServicioOtroExtraordinario()."</desOtroServicioExtraordinario>";
   		echo "<horaInicio>".$servicio->getHoraInicio()."</horaInicio>";
   		echo "<horaTermino>".$servicio->getHoraTermino()."</horaTermino>";
   		echo "<observaciones>".$servicio->getObservaciones()."</observaciones>";
   		echo "<existeHojaRuta>".$tieneHojaRuta."</existeHojaRuta>";
   		echo "</identificacionServicio>";
*/


$filasObservaciones[]=array("<b>".$servicio->getObservaciones()."</b>");


   		if ($mediosVigilancia != ""){

   			//echo "<mediosDeVigilancia>";


  			
   			for ($i=0; $i<$cantidadMediosVigilancia; $i++){
   			
   				if ($mediosVigilancia[$i]->getVehiculo()->getCodigoVehiculo() == "") {
   					$codigoVehiculo 	= 0;
   					$patenteVehiculo 	= "INFANTERIA";
   					$tipoVehiculo 		= "SIN VEHICULO";
   				}
   				else {
   					$codigoVehiculo 	= $mediosVigilancia[$i]->getVehiculo()->getCodigoVehiculo();
   					$patenteVehiculo 	= $mediosVigilancia[$i]->getVehiculo()->getPatente();
   					$tipoVehiculo 		= $mediosVigilancia[$i]->getVehiculo()->getTipoVehiculo()->getDescripcion();
   				}


  				
//   				echo "<medioVigilancia>";
//   				echo "<numeroMedio>".$mediosVigilancia[$i]->getNumeroMedio()."</numeroMedio>";
//   				echo "<codigoFactor>".$mediosVigilancia[$i]->getFactor()->getCodigo()."</codigoFactor>";
//   				echo "<descripcionFactor>".$mediosVigilancia[$i]->getFactor()->getDescripcion()."</descripcionFactor>";

//   				echo "<vehiculo>";
//   				echo "<codigoVehiculo>".$codigoVehiculo."</codigoVehiculo>";
//   				echo "<patenteVehiculo>".$patenteVehiculo."</patenteVehiculo>";
//   				echo "<tipoVehiculo>".$tipoVehiculo."</tipoVehiculo>";
//   				echo "<kmInicial>".$mediosVigilancia[$i]->getKmInicial()."</kmInicial>";
//   				echo "<kmFinal>".$mediosVigilancia[$i]->getKmFinal()."</kmFinal>";
//   				echo "</vehiculo>";


          $pdf->ezText("<b>Medio de Vigilancia Nro. ".$mediosVigilancia[$i]->getNumeroMedio()."</b>",8);

          if($codigoVehiculo!=0)
          {
              $filasVehiculo[]=array("Vehículo",":","<b>".$tipoVehiculo." (".$patenteVehiculo.")</b>","Kilometraje Inicial",":","<b>".$mediosVigilancia[$i]->getKmInicial()." KMS.</b>");
              $filasVehiculo[]=array("Kilómetros Recorridos",":","<b>".$mediosVigilancia[$i]->getKmFinal()-$mediosVigilancia[$i]->getKmInicial()." KMS.</b>","Kilometraje Final",":",$mediosVigilancia[$i]->getKmFinal()." KMS.");
              $pdf->ezTable($filasVehiculo,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>460,
              'cols'=>array(array('width'=>90),array('width'=>10),'',array('width'=>70),array('width'=>10),array('width'=>110))));
              unset($filasVehiculo); 
          }




          $filasMedio[]=array("Factor",":",'<b>'.$mediosVigilancia[$i]->getFactor()->getDescripcion().'</b>');
          $filasMedio[]=array("Cuadrante(s)",":","<b>contenido</b>");


//   				echo "<funcionarios>";

	   			for ($j=0; $j<$mediosVigilancia[$i]->getCantidadDeFuncionarios(); $j++){

/*
	   				echo "<funcionario>";
	   				echo "<identificacionFuncionario>";
	   				echo "<codigoFuncionario>".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario()."</codigoFuncionario>";
	   				echo "<apellidoPaterno>".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno()."</apellidoPaterno>";
   					echo "<apellidoMaterno>".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno()."</apellidoMaterno>";
   					echo "<primerNombre>".$mediosVigilancia[$i]->getFuncionarios($j)->getPNombre()."</primerNombre>";
   					echo "<grado>".$mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion()."</grado>";
   					echo "</identificacionFuncionario>";
*/


          if($j==0)
          {
              $filasFuncionario[]=array
              (
                  "Personal",":",
                  "<b>".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno()." ".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno().", ".$mediosVigilancia[$i]->getFuncionarios($j)->getPNombre()." - ".$mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion()." (".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario().")</b>",
                  "<b>armamento</b>"
              );
          }
          
          else
          {
              $filasFuncionario[]=array
              (
                  "","",
                  "<b>".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno()." ".$mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno().", ".$mediosVigilancia[$i]->getFuncionarios($j)->getPNombre()." - ".$mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion()." (".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario().")</b>",
                  "<b>armamento<b>"
              );
          }




/*   					
   					echo "<accesorios>";
   					for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadAccesorios(); $k++){
			   			echo "<accesorio>";
			   			echo "<codigoAccesorio>".$mediosVigilancia[$i]->getFuncionarios($j)->getAccesorios($k)->getCodigo()."</codigoAccesorio>";
			   			echo "<descripcionAccesorio>".$mediosVigilancia[$i]->getFuncionarios($j)->getAccesorios($k)->getDescripcion()."</descripcionAccesorio>";
	   					echo "</accesorio>";	
	   				}
	   				echo "</accesorios>";
*/	   				
//////////////////////////////////////////////////////////////////////////////////////////////////
/*

	   				echo "<armas>";
	   				for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas(); $k++){
			   			echo "<arma>";
			   			echo "<codigoArma>".$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getCodigo()."</codigoArma>";
			   			echo "<tipoArma>".$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getTipo()->getDescripcion()."</tipoArma>";
			   			echo "<numeroSerie>".$mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getNumeroSerie()."</numeroSerie>";
	   					echo "</arma>";	
	   				}
	   				echo "</armas>";
*/
//////////////////////////////////////////////////////////////////////////////////////////////////


/*	   				
	   				echo "<animales>";
	   				for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadAnimales(); $k++){
			   			echo "<animal>";
			   			echo "<codigoAnimal>".$mediosVigilancia[$i]->getFuncionarios($j)->getAnimales($k)->getCodigo()."</codigoAnimal>";
			   			echo "<descripcionAnimal>".$mediosVigilancia[$i]->getFuncionarios($j)->getAnimales($k)->getDescripcion()."</descripcionAnimal>";
	   					echo "</animal>";	
	   				}
   					echo "</animales>";
*/

//	   				echo "</funcionario>";
	   				
	   			}
		


//	   			echo "</funcionarios>";


/*
	   			echo "<cuadrantes>";

	   			for ($j=0; $j<$mediosVigilancia[$i]->getCantidadDeCuadrantes(); $j++){
	   				echo "<cuadrante>";
	   				echo "<codigoCuadrante>".$mediosVigilancia[$i]->getCuadrantes($j)->getCodigo()."</codigoCuadrante>";
	   				echo "<descripcionCuadrante>".$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion()."</descripcionCuadrante>";
   					echo "</cuadrante>";
	   			}
	   			echo "</cuadrantes>";

*/


$pdf->ezTable($filasFuncionario,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>460
,'cols'=>array(array('width'=>90),array('width'=>10),'',array('width'=>110))
));


$pdf->ezTable($filasMedio,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>460
,'cols'=>array(array('width'=>90),array('width'=>10))
));





$pdf->ezText("",10);


unset($filasVehiculo);
unset($filasFuncionario); 
unset($filasMedio); 



//   				echo "</medioVigilancia>";
   			}
//   			echo "</mediosDeVigilancia>";



   		}

$pdf->ezText("<b>Observaciones</b>",8);
$pdf->ezTable($filasObservaciones,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>460));
unset($filasObservaciones);

//   		echo "</servicio>";
// 	echo "</root>";



//--- CONTENIDO COMUN FINAL PDF
$pdf->ezStream();
//----------------------------- 

?>