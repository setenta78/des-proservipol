<?

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include_once("../tools.php");
include_once("../db/dbResumenModuloValidacion.Class.php");
include_once("request.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=UTF-8');

$params = rules();
$objDBResumenModuloValidacion = new dbResumenModuloValidacion;

echo _json_encode(($params["code"]<>"412") ? $objDBResumenModuloValidacion->resumnenDotacionAgregadaALaUnidad($params['codigoUnidad'], $params['fecha']) : $params);