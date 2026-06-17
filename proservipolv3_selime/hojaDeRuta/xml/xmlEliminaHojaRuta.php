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
  $numeroMedio          = $_POST['numeroMedio'];

      $objdbHojaRuta = new dbHojaRuta;

      $hojaRuta = new hojaRuta;
      $hojaRuta->setUnidad($unidad);
      $hojaRuta->setCorrelativoServicio($correlativoServicio);
      $hojaRuta->setNumeroMedio($numeroMedio);

      $objdbHojaRuta->deleteHojaRutaAnotaciones($hojaRuta);
      $objdbHojaRuta->deleteHojaRuta($hojaRuta);
?>