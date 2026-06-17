<?
include("inc/configV4.inc.php");
include("baseDatos/Conexion.class.php");

Class dbMensajes extends Conexion {

    function obtenerMensajeCierre(){
        $sql = "SELECT 
                    YEAR(C.FECHA_PROXIMO_CIERRE) ANNO,
                    MONTH(C.FECHA_PROXIMO_CIERRE)-1 MES,
                    DAYOFWEEK(C.FECHA_PROXIMO_CIERRE)-1 DIA_D,
                    DAY(C.FECHA_PROXIMO_CIERRE) DIA_C,
                    MONTH(C.FECHA_CIERRE)-1 MES_C,
                    YEAR(C.FECHA_CIERRE) ANNO_C
                FROM CONFIG_SYS C
                WHERE C.ACTIVO = 1";
        
        $day= array("DOMINGO","LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO");
        $month= array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
        $mensaje = "";
        $result = $this->execstmt($this->Conecta(),$sql);
        mysql_close();
        if(mysql_num_rows($result) > 0){
            $myrow = mysql_fetch_array($result);

            $annoActual = $myrow["ANNO"];
            $mesActual = $month[$myrow["MES"]];
            $dia = $myrow["DIA_C"];
            $diaDescripcion = $day[$myrow["DIA_D"]];

            $annoCierre = $myrow["ANNO_C"];
            $mesCierre = $month[$myrow["MES_C"]];
            
            $mensaje = "<strong>IMPORTANTE: </strong>EL CIERRE DE LOS REGISTROS DEL MES DE {$mesCierre} {$annoCierre} SE REALIZARÁ EL DIA {$diaDescripcion} {$dia} DE {$mesActual} {$annoActual} A LAS 17:00 HRS.";
        }
        return $mensaje;
    }
}

$objDBMensajes = new dbMensajes;