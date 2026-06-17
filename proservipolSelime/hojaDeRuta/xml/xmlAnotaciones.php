<?
  session_start();
	header ('content-type: text/xml');
	include("../baseDatos/config.inc.php");
	require("../baseDatos/dbHojaRuta.class.php");
	require("../baseDatos/dbAnotaciones.class.php");
	require("../objetos/anotacion.class.php");
	require("../objetos/hojaRuta.class.php");


  $unidad               = $_POST['unidad'];
  $correlativoServicio  = $_POST['correlativoServicio'];
  $numeroMedio          = $_POST['numeroMedio'];


/*
  $unidad               = '460';
  $correlativoServicio  = '2277';
  $numeroMedio          = '1';
*/
				
	$objdbHojaRuta = new dbHojaRuta;
	$objdbHojaRuta->listarHojaRuta($unidad,$correlativoServicio,$numeroMedio,&$hojaRuta, &$cantidadHojaRuta);

	$dbAnotaciones = new dbAnotaciones;
	$dbAnotaciones->listarAnotacion($unidad,$correlativoServicio,$numeroMedio,&$anotacion, &$cantidadAnotaciones);


if($cantidadHojaRuta > 0)
{
  	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
  	echo "<root>";
   	for ($i=0; $i<$cantidadHojaRuta; $i++){
      echo "<hojaRuta>";
        echo "<unidad>".$hojaRuta[$i]->getUnidad()."</unidad>";
        echo "<correlativoServicio>".$hojaRuta[$i]->getCorrelativoServicio()."</correlativoServicio>";
        echo "<numeroMedio>".$hojaRuta[$i]->getNumeroMedio()."</numeroMedio>";
        echo "<horaInicioReal>".substr($hojaRuta[$i]->getHoraInicioReal(),0,5)."</horaInicioReal>";
        echo "<horaTerminoReal>".substr($hojaRuta[$i]->getHoraTerminoReal(),0,5)."</horaTerminoReal>";
          for ($j=0; $j<$cantidadAnotaciones; $j++){
            echo "<anotacion>";
              echo "<idAnotacion>".$anotacion[$j]->getIdAnotacion()."</idAnotacion>";            
              echo "<factor>".$anotacion[$j]->getFactor()."</factor>";            
              echo "<descripcionFactor>".$anotacion[$j]->getdescripcionFactor()."</descripcionFactor>";            
              echo "<horaInicio>".substr($anotacion[$j]->getHoraInicio(),0,5)."</horaInicio>";            
              echo "<horaTermino>".substr($anotacion[$j]->getHoraTermino(),0,5)."</horaTermino>";            
              echo "<cuadrante>".$anotacion[$j]->getCuadrante()."</cuadrante>";            
              echo "<descripcionCuadrante>".$anotacion[$j]->getDescripcionCuadrante()."</descripcionCuadrante>";            
              echo "<otraUnidad>".$anotacion[$j]->getOtraUnidad()."</otraUnidad>";            
              echo "<descripcionOtraUnidad>".$anotacion[$j]->getDescripcionOtraUnidad()."</descripcionOtraUnidad>";            
            echo "</anotacion>";
          }
      echo "</hojaRuta>";
    }
	echo "</root>";
}

else
{
    echo "VACIO";
}
?>