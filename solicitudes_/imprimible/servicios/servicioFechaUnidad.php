<?

//	header ('content-type: text/xml');
	include("../../xml/configuracionBD2.php");
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
	require("../../objetos/caballos.class.php");

//--- CONTENIDO COMUN INICIO PDF
include ('./../imprimible.class/class.ezpdf.php');
$pdf =new Cezpdf();
$pdf->selectFont('./../imprimible.class/fonts/Helvetica.afm');

$pdf->ezSetMargins(30,30,70,30);
$pdf->ezImage("../../img/logo_carabineros.jpg", 0, 80, 'none', 'left');
$pdf->ezText("<b>CARABINEROS DE CHILE</b>",10);
$pdf->ezText("<b>PROSERVIPOL V3.0</b>",10);
$pdf->ezText("",10);
//------------------------------


	$unidad 		= $_GET['codigoUnidad'];
	$fecha1 		= $_GET['fecha1'];
	$fecha2			= $_GET['fecha2'];
	$tipoServicios	= $_GET['servicios'];
	
	$fechaMostrar = $fecha1;
	
	//$unidad = 2235;
	//$fecha1 = "29-09-2016";
	//$fecha2 = "11-01-2010";
	
	if ($fecha2 == "") $fecha2 = $fecha1;
	
	$fechaPaso 		= explode("-",$fecha1);
   	$fechaBuscar1   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];
   	
   	$fechaPaso 		= explode("-",$fecha2);
   	$fechaBuscar2   = $fechaPaso[2] . $fechaPaso[1] . $fechaPaso[0];



		$sql = "
SELECT 
  GRADO.GRA_DESCRIPCION,
  FUNCIONARIO.FUN_NOMBRE,
  FUNCIONARIO.FUN_APELLIDOPATERNO,
  FUNCIONARIO.FUN_APELLIDOMATERNO

FROM
  SERVICIOS_CERTIFICADO
  INNER JOIN FUNCIONARIO ON (SERVICIOS_CERTIFICADO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
  INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO AND FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)

WHERE
SERVICIOS_CERTIFICADO.FECHA_SERVICIOS='".$fechaBuscar1."' AND
SERVICIOS_CERTIFICADO.UNI_CODIGO='".$unidad."'
;";

//echo $sql1;

$gradoValidador="";
$nombreValidador="";

    $CONECT = @mysql_connect(HOST,DB_USER,DB_PASS);
		mysql_select_db(DB);

		$result = mysql_query($sql,$CONECT);

 
    if($myrow = mysql_fetch_array($result))
    {
        $gradoValidador=$myrow[GRA_DESCRIPCION];
        $nombreValidador=$myrow[FUN_NOMBRE]." ".$myrow[FUN_APELLIDOPATERNO]." ".$myrow[FUN_APELLIDOMATERNO];
        
        $pdf->ezText("<b>CERTIFICADO SERVICIOS</b>",10,array('justification'=>'center'));
    }

    else
    {   $pdf->setColor(255,0,0);
        $pdf->ezText("<b>SERVICIOS NO VALIDADOS</b>",10,array('justification'=>'center'));
        $pdf->setColor(0,0,0);
    }

$pdf->ezText("",10);









	
	$objServiciosTotal = new dbServicios;
	$objServiciosTotal->listaServiciosUnidad($unidad, $fechaBuscar1, $fechaBuscar2, $tipoServicios, &$serviciosTotal);
	$cantidad = count($serviciosTotal);


$filasEncabezado[]=array("<b>Unidad</b>","<b>:</b>","<b>".$serviciosTotal[0]->getUnidad()->getDescripcionUnidad()."</b>");
$filasEncabezado[]=array("<b>Fecha Servicios</b>","<b>:</b>","<b>".$fechaMostrar."</b>");
$filasEncabezado[]=array("<b>Fecha de Impresión</b>","<b>:</b>","<b>".date("d-m-Y \a \l\a\s H:i:s")."</b>");


$pdf->ezTable($filasEncabezado,'','',array('colGap'=>2,'fontSize'=>8,'width'=>510,'showHeadings'=>0,'shaded'=>0,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>1,'cols'=>array(array('width'=>90),array('width'=>10))));
unset($filasEncabezado);



for($contador=0;$contador<$cantidad;$contador++)
{
unset($mediosVigilancia);
unset($servicio);
unset($tieneHojaRuta);
  $correlativo=$serviciosTotal[$contador]->getCorrelativo();
  $objServicios = new dbServicios;
	$objServicios->buscaDatosServicio($unidad, $correlativo, &$servicio);
	//$objServicios->buscaFuncionariosAsignados($unidad, $correlativo, &$funcionarios);
	$objServicios->buscaMedioVigilancia($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaCuadrantesAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaAccesoriosAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaArmasAsignadas($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaAnimalesAsignados($unidad, $correlativo, &$mediosVigilancia);
	$objServicios->buscaHojaDeRuta($unidad, $correlativo, &$tieneHojaRuta);
	//$objServicios->buscadestinosAsignados($unidad, $correlativo, &$mediosVigilancia); //Llamada a clase agregada el 22-04-2015
	
	$cantidadFuncionarios = count($funcionarios);
	$cantidadMediosVigilancia = count($mediosVigilancia);
	
	//echo "cantidadMediosVigilancia " . $cantidadMediosVigilancia;

	//echo "<\?xml version=\"1.0\" encoding=\"ISO-8859-1\"?\>";
  //echo "<root>";
   		
   		$tipoServicioPdf = $servicio->getTipoServicio()->getTipo();
   		
   		
   		//echo "<servicio>";

$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$filasEncabezado[]=array("<b>Servicio</b>","<b>:</b>","<b>".$servicio->getTipoServicio()->getDescripcion()."</b>");

if($servicio->getServicioExtraordinario()->getDescripcion()!="")
{
$filasEncabezado[]=array("<b>Servicio Extraordinario</b>","<b>:</b>","<b>".$servicio->getServicioExtraordinario()->getDescripcion()."</b>");
}

if($servicio->getDescripcionServicioOtroExtraordinario()!="")
{
$filasEncabezado[]=array("<b>Otro Extraordinario</b>","<b>:</b>","<b>".$servicio->getDescripcionServicioOtroExtraordinario()."</b>");
}


$filasEncabezado[]=array("<b>Inicio</b>","<b>:</b>","<b>".$servicio->getHoraInicio()."</b>");
$filasEncabezado[]=array("<b>Término</b>","<b>:</b>","<b>".$servicio->getHoraTermino()."</b>");



$pdf->ezTable($filasEncabezado,'','',array('colGap'=>2,'shadeCol'=>array(0.8,0.8,0.8),'shadeCol2'=>array(0.8,0.8,0.8),'fontSize'=>8,'width'=>510,'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>1,'cols'=>array(array('width'=>90),array('width'=>10))));
$pdf->ezText("",10);
unset($filasEncabezado);

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

          if($tipoServicioPdf=="O")
          {
            $pdf->ezText("<b>Medio de Vigilancia Nro. ".$mediosVigilancia[$i]->getNumeroMedio()."</b>",8);
          }


          if($codigoVehiculo!=0)
          {
              $filasVehiculo[]=array("<b>Vehículo</b>","<b>:</b>",$tipoVehiculo." (".$patenteVehiculo.")","<b>Kilometraje Inicial</b>","<b>:</b>",number_format($mediosVigilancia[$i]->getKmInicial(),0,'','.')." KMS.");
              $filasVehiculo[]=array("<b>Kilómetros Recorridos</b>","<b>:</b>",number_format($mediosVigilancia[$i]->getKmFinal()-$mediosVigilancia[$i]->getKmInicial(),0,'','.')." KMS.","<b>Kilometraje Final</b>","<b>:</b>",number_format($mediosVigilancia[$i]->getKmFinal(),0,'','.')." KMS.");
              $pdf->ezTable($filasVehiculo,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510,
              'cols'=>array(array('width'=>90),array('width'=>10),'',array('width'=>75),array('width'=>10),array('width'=>130))));
              unset($filasVehiculo); 
          }



          //if($tipoServicioPdf=="O")
          //{
          //  $filasMedio[]=array("<b>Factor</b>","<b>:</b>",$mediosVigilancia[$i]->getFactor()->getDescripcion());
          //}

//   				echo "<funcionarios>";

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


	   			for ($j=0; $j<$mediosVigilancia[$i]->getCantidadDeFuncionarios(); $j++){

          if($j==0)
          {

              if($mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas()==0)
              {
                  $filasFuncionario[]=array
                  (
                      "<b>Personal</b>","<b>:</b>",
                      strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno())." ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno()).", ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getPNombre())." - ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion())." (".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario().")",
                      ""
                  );
              
              }
              
              else
              {

                  for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas(); $k++)
                  {
                      if($k==0)
                      {
                          $filasFuncionario[]=array
                          (
                              "<b>Personal</b>","<b>:</b>",
                              strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno())." ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno()).", ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getPNombre())." - ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion())." (".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario().")",
                              $mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getTipo()->getDescripcion()." (".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getNumeroSerie()).")"
                          );
                      }
                      
                      else
                      {
                          $filasFuncionario[]=array
                          (
                              "","",
                              "",
                              $mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getTipo()->getDescripcion()." (".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getNumeroSerie()).")"
                          );
                      
                      }

                  }
              }

          }

          
          else
          {

              if($mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas()==0)
              {
                  $filasFuncionario[]=array
                  (
                      "","",
                      strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno())." ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno()).", ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getPNombre())." - ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion())." (".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario().")",
                      ""
                  );
              
              }
              
              else
              {
                  for ($k=0; $k<$mediosVigilancia[$i]->getFuncionarios($j)->getCantidadArmas(); $k++)
                  {
                      if($k==0)
                      {
                          $filasFuncionario[]=array
                          (
                              "","",
                              strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoPaterno())." ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getApellidoMaterno()).", ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getPNombre())." - ".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getGrado()->getDescripcion())." (".$mediosVigilancia[$i]->getFuncionarios($j)->getCodigoFuncionario().")",
                              $mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getTipo()->getDescripcion()." (".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getNumeroSerie()).")"
                          );
                      }
                      
                      else
                      {
                          $filasFuncionario[]=array
                          (
                              "","",
                              "",
                              $mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getTipo()->getDescripcion()." (".strtoupper($mediosVigilancia[$i]->getFuncionarios($j)->getArmas($k)->getNumeroSerie()).")"
                          );
                      
                      }
                  }
              }
          }

	   				
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

   $cuadrantesMedio = "";

	   			for ($j=0; $j<$mediosVigilancia[$i]->getCantidadDeCuadrantes(); $j++){
          
              if($j==0)
              {
                  //$cuadrantesMedio=$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion();
                   $cuadrantesMedio=$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion()." (".$mediosVigilancia[$i]->getCuadrantes($j)->getDescUni().")";  
                   //$unidadServicio=$mediosVigilancia[$i]->getCuadrantes($j)->getDescUni();   
              }

              else
              {
                  //$cuadrantesMedio=$cuadrantesMedio.", ".$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion();
                  $cuadrantesMedio=$cuadrantesMedio.", ".$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion()." (".$mediosVigilancia[$i]->getCuadrantes($j)->getDescUni().")";     
              }

	   			}


         $unidadServicio = "";

	   			//for ($j=0; $j<$mediosVigilancia[$i]->getCantidadDeUnidades(); $j++){
          
          //    if($j==0)
          //    {
                  //$cuadrantesMedio=$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion();
                  //$cuadrantesMedio=$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion()." (".$mediosVigilancia[$i]->getCuadrantes($j)->getDescUni().")";
          //        $unidadServicio=$mediosVigilancia[$i]->getUnidades($j)->getDescripcionUnidad();   
          //    }

          //    else
          //    {
                  //$cuadrantesMedio=$cuadrantesMedio.", ".$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion();
                   //$cuadrantesMedio=$cuadrantesMedio.", ".$mediosVigilancia[$i]->getCuadrantes($j)->getDescripcion()." (".$mediosVigilancia[$i]->getCuadrantes($j)->getDescUni().")";
          //         $unidadServicio=$unidadServicio.", ".$mediosVigilancia[$i]->getUnidades($j)->getDescripcionUnidad();   
          //    }

	   			//}

          if($tipoServicioPdf=="O")
          {
            $filasMedio[]=array("<b>Cuadrante(s)</b>","<b>:</b>",$cuadrantesMedio);
            $filasMedio[]=array("<b>Unidad Servicio</b>","<b>:</b>",$unidadServicio); 
          }


$pdf->ezTable($filasFuncionario,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510
,'cols'=>array(array('width'=>90),array('width'=>10),'',array('width'=>130))
));


          if($tipoServicioPdf=="O")
          {

$pdf->ezTable($filasMedio,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510
,'cols'=>array(array('width'=>90),array('width'=>10))
));
          }




$pdf->ezText("",10);


unset($filasVehiculo);
unset($filasFuncionario);
unset($filasMedio);




//   				echo "</medioVigilancia>";
   			}
//   			echo "</mediosDeVigilancia>";



   		}

if($servicio->getObservaciones()!="")
{
$filasObservaciones[]=array($servicio->getObservaciones());
$pdf->ezText("<b>Observaciones</b>",8);
$pdf->ezTable($filasObservaciones,'','',array('colGap'=>2,'shadeCol'=>array(0.9,0.9,0.9),'shadeCol2'=>array(0.9,0.9,0.9),'showHeadings'=>0,'shaded'=>2,'showLines'=>0,'xPos'=>'left','xOrientation'=>'right','rowGap' =>2,'fontSize'=>8,'width'=>510));
unset($filasObservaciones);
}






//   		echo "</servicio>";
// 	echo "</root>";

}


    if($gradoValidador != "" && $nombreValidador != "")
    {
        $pdf->ezText("",20);
        $pdf->ezText("<b>SERVICIOS VALIDADOS POR</b>",10);
        $pdf->ezText("",20);
        $pdf->ezText("<b>".$nombreValidador."</b>",10,array('justification'=>'center'));
        $pdf->ezText("<b>".$gradoValidador." DE CARABINEROS</b>",10,array('justification'=>'center'));
    }

    else
    {
        $pdf->ezText("",20);
        $pdf->setColor(255,0,0);
        $pdf->ezText("<b>SERVICIOS NO VALIDADOS</b>",10,array('justification'=>'center'));
        $pdf->setColor(0,0,0);
    }

ob_end_clean();
//--- CONTENIDO COMUN FINAL PDF
$pdf->ezStream();
//----------------------------- 

?>