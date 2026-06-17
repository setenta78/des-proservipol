<?
include("../../xml/configuracionBD4.php");

$codVerificacion = $_GET["codVerificacion"];

function buscarMes($mes){
    switch ($mes) {
        case 1:
            $mesDesc = "Enero";
            break;
        case 2:
            $mesDesc = "Febrero";
            break;
        case 3:
            $mesDesc = "Marzo";
            break;
        case 4:
            $mesDesc = "Abril";
            break;
        case 5:
            $mesDesc = "Mayo";
            break;
        case 6:
            $mesDesc = "Junio";
            break;
        case 7:
            $mesDesc = "Julio";
            break;
        case 8:
            $mesDesc = "Agosto";
            break;
        case 9:
            $mesDesc = "Septiembre";
            break;
        case 10:
            $mesDesc = "Octubre";
            break;
        case 11:
            $mesDesc = "Noviembre";
            break;
        case 12:
            $mesDesc = "Diciembre";
            break;                                                    
    }
    return $mesDesc;
}

$sql = "SELECT 
            CONCAT(CONCAT(UPPER(SUBSTRING(F.FUN_NOMBRE,1,1)),LOWER(SUBSTRING(F.FUN_NOMBRE,2))),' ',CONCAT(UPPER(SUBSTRING(F.FUN_NOMBRE2,1,1)),LOWER(SUBSTRING(F.FUN_NOMBRE2,2))),' ',CONCAT(UPPER(SUBSTRING(F.FUN_APELLIDOPATERNO,1,1)),LOWER(SUBSTRING(F.FUN_APELLIDOPATERNO,2))),' ',CONCAT(UPPER(SUBSTRING(F.FUN_APELLIDOMATERNO,1,1)),LOWER(SUBSTRING(F.FUN_APELLIDOMATERNO,2)))) NOMBRE,
            YEAR(C.FECHA_CAPACITACION) ANNO, 
            MONTH(C.FECHA_CAPACITACION) MES,
            C.CODIGO_VERIFICACION COD_VERIFICACION,
            C.TIPO_CERTIFICADO CERTIFICADO,
            YEAR(C.FECHA_VALIDEZ) ANNO_VALIDEZ, 
            MONTH(C.FECHA_VALIDEZ) MES_VALIDEZ
        FROM FUNCIONARIO F
        JOIN CAPACITACION C ON C.FUN_CODIGO = F.FUN_CODIGO
        WHERE C.CODIGO_VERIFICACION = '{$codVerificacion}'
        AND C.ACTIVO = 1";
//echo $sql;

$CONECT = @mysql_connect(HOST,DB_USER,DB_PASS);
mysql_select_db(DB);
$result = mysql_query($sql,$CONECT);


if($myrow = mysql_fetch_array($result)){
    $nombre         = $myrow[NOMBRE];
    $anno           = $myrow[ANNO];
    $mes            = $myrow[MES];
    $cod_ver        = $myrow[COD_VERIFICACION];
    $certificado    = ($myrow[CERTIFICADO]) ? $myrow[CERTIFICADO] : '';
    $annoValidez    = $myrow[ANNO_VALIDEZ];
    $mesValidez     = $myrow[MES_VALIDEZ];
    
    $mesCertDesc = buscarMes($mes);
    $mesValDesc = buscarMes($mesValidez);
    
    switch($certificado) {
        case 'CertificadoCurso2024':
            include('certificado2024.php');
        break;
        case 'CertificadoCurso2025':
            include('certificado2025.php');
        break;
        default:
            include('sinCertificado.php');
        break;
    }

}
else{
    include('sinCertificado.php');
}
?>