<?
//  session_start();
//	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");

	require("../baseDatos/dbHojaRuta.class.php");
	require("../objetos/hojaRuta.class.php");
	require("../baseDatos/dbAnotaciones.class.php");
	require("../objetos/anotacion.class.php");


  $unidad               = $_POST['unidad'];
  $correlativoServicio  = $_POST['correlativoServicio'];
  $horaInicioReal       = $_POST['horaInicioReal'];
  $horaTerminoReal      = $_POST['horaTerminoReal'];
  $numeroMedio          = $_POST['numeroMedio'];

  $arregloAnotaciones   = explode(",",$_POST['arregloAnotaciones']);

  //$arregloAnotaciones   = $_POST['arregloAnotaciones'];
  //echo  $arregloAnotaciones;

  //$prueba = $arregloAnotaciones[7].":".$arregloAnotaciones[8];
  //echo $prueba;


      $objdbHojaRuta = new dbHojaRuta;

      $hojaRuta = new hojaRuta;
      $hojaRuta->setUnidad($unidad);
      $hojaRuta->setCorrelativoServicio($correlativoServicio);
      $hojaRuta->setHoraInicioReal($horaInicioReal);
      $hojaRuta->setHoraTerminoReal($horaTerminoReal);
      $hojaRuta->setNumeroMedio($numeroMedio);


      $objdbHojaRuta->deleteHojaRuta($hojaRuta);
      $objdbHojaRuta->deleteHojaRutaAnotaciones($hojaRuta);


      $objdbHojaRuta->insertHojaRuta($hojaRuta);


      $objdbAnotaciones = new dbAnotaciones;

      $contAnotaciones = 1;

       for($i = 0, $size = sizeof($arregloAnotaciones)-1; $i < $size; $i=$i+7)
       {
            $anotacion = new anotacion;
            //$anotacion->setIdAnotacion($i+1);
            $anotacion->setIdAnotacion($contAnotaciones);
            $anotacion->setFactor($arregloAnotaciones[$i]);
            $anotacion->setHoraInicio($arregloAnotaciones[$i+1].":".$arregloAnotaciones[$i+2]);
            $anotacion->setHoraTermino($arregloAnotaciones[$i+3].":".$arregloAnotaciones[$i+4]);
            $anotacion->setCuadrante($arregloAnotaciones[$i+5]);
            $anotacion->setOtraUnidad($arregloAnotaciones[$i+6]);
            $anotacion->setHojaRuta($hojaRuta);

            $objdbAnotaciones->insertAnotacion($anotacion);
            
            $contAnotaciones=$contAnotaciones+1;
       }

?>







