<?
include("config.env.php");
$enviorment = new L4;

define("HOST" , $enviorment->getHost());
define("DB_USER" , $enviorment->getUser());
define("DB_PASS" , $enviorment->getPass());
define("DB" , $enviorment->getDB());
