<?php
require_once("clase_conexion.php");

class Trabajo
{
	private $resultados;
	private $certificado;
	
	public function __construct()
	{
		$this->servicio=array();
	}
public function get_servicio()
    {
		
	//print_r($_POST);
        $sql="SELECT *
              FROM
              TIPO_SERVICIO";
             $res=mysql_query($sql,Conectar::con());

        while ($row = mysql_fetch_array($res)){
            
	    $this->servicio[]=$row;	
		echo "<tr>";
		echo "<td>CODIGO</td>";
 	    echo "<td>".$row["TSERV_CODIGO"]."</td>";
        echo "</tr>";
	    echo "<tr>";
		echo "<td>DESCRIPCION</td>";
       	echo "<td>".$row["TSERV_DESCRIPCION"]."</td>";
        echo "</tr>";
		echo "<tr>";
		echo "<td>TIPO</td>";
 	    echo "<td>".$row["TSERV_TIPO"]."</td>";
        echo "</tr>";
	    echo "</table>";
		echo "<br>";
	   return $this->servcio;
      }			
  }
}
?> 