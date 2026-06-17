<?
include("config.env.php"); 

//$enviorment = new development;
$enviorment = new production;

define("HOST" , $enviorment->getHost());
define("DB_USER" , $enviorment->getUser());
define("DB_PASS" , $enviorment->getPass());
define("DB" , $enviorment->getDB());
