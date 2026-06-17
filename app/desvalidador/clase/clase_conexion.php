<?php
session_start();
date_default_timezone_set("America/Santiago");
class Conectar
{
	//public static function con()
	//{
	//$con=mysql_connect("168.88.11.26","prorelcom1","4577");
	//mysql_query("SET NAMES 'utf8'");
	//mysql_select_db("DB_PROSERVIPOL_V3");
	//return $con;
	//}
    
    //public static function con()
	//{
	//$con=mysql_connect("168.88.11.26","msanma","marchelo");
	//mysql_query("SET NAMES 'utf8'");
	//mysql_select_db("DB_PROSERVIPOL_V3");
	//return $con;
	//}
	
	public static function con()
	{
	$con=mysql_connect("localhost","root","");
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("proservipol_v3_desarrollo3");
	return $con;
	}
	
}

?>