<?php
session_start();
date_default_timezone_set("America/Santiago");
class Conectar
{
	public static function con()
	{
		$con=mysql_connect("172.21.111.67","proservipolv3","carta77");
		//$con=mysql_connect("168.88.11.26","saguilera","4577");//
		mysql_query("SET NAMES 'utf8'");
		mysql_select_db("DB_PROSERVIPOL_V3");
	return $con;
	}
    
    //public static function con()
	//{
	//$con=mysql_connect("168.88.11.26","msanma","marchelo");
	//mysql_query("SET NAMES 'utf8'");
	//mysql_select_db("DB_PROSERVIPOL_V3");
	//return $con;
	//}
	
	//public static function con()
	//{
	//$con=mysql_connect("127.0.0.1","root","1234sa");
	//mysql_query("SET NAMES 'utf8'");
	//mysql_select_db("proservipol_dev");
	//return $con;
	//}
	
}

?>