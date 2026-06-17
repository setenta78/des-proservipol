<?php
session_start();
date_default_timezone_set("America/Santiago");
class Conectar2
{
	public static function con2()
	{
	$con2=mysql_connect("10.25.28.71","proservipol","cdg@user");
	//$con=mysql_connect("168.88.11.26","saguilera","4577");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("bd_proservipolv3_2014-2018");
	return $con2;
	}
    
	//public static function con()
	//{
	//$con=mysql_connect("168.88.11.26","msanma","marchelo");
	//mysql_query("SET NAMES 'utf8'");
	//mysql_select_db("DB_PROSERVIPOL_V3");
	//return $con;
	//}
		
}

?>