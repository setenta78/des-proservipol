<?
include("../../xml/configuracionBD4.php");
include ('./../imprimible.class/class.ezpdf.php');

$rut				= $_GET["rutFuncionario"];
$codActividad		= $_GET["codActividad"];
$usuarioProservipol	= $_GET["usuarioProservipol"];

$sql = "SELECT 
            G.GRA_DESCRIPCION GRADO_FUN,
            F.FUN_APELLIDOPATERNO APP_FUN,
            F.FUN_APELLIDOMATERNO APM_FUN,
            F.FUN_NOMBRE2 NOM2_FUN,
            F.FUN_NOMBRE NOM_FUN,
            T.TSERV_DESCRIPCION SERV,
            A.FECHA_INICIO FECHAI,
            A.FECHA_REGISTRO FECHAR,
            TIMESTAMPDIFF(DAY, A.FECHA_INICIO, A.FECHA_TERMINO)+1 DIAS,
            G2.GRA_DESCRIPCION GRADO_US,
            F2.FUN_APELLIDOPATERNO APP_US,
            F2.FUN_APELLIDOMATERNO APM_US,
            F2.FUN_NOMBRE2 NOM2_US,
            F2.FUN_NOMBRE NOM_US,
            U.UNI_DESCRIPCION UNIDAD
        FROM ACTIVIDAD_FUERA_CUARTEL A 
        JOIN FUNCIONARIO F ON (F.FUN_RUT = A.FUN_RUT)
        JOIN TIPO_SERVICIO T ON (T.TSERV_CODIGO = A.TIPO_ACTIVIDAD)
        JOIN GRADO G ON (G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO)
        JOIN UNIDAD U ON (U.UNI_CODIGO = A.UNI_CODIGO)
        JOIN FUNCIONARIO F2 ON (F2.FUN_CODIGO = '{$usuarioProservipol}')
        JOIN GRADO G2 ON (G2.ESC_CODIGO = F2.ESC_CODIGO AND G2.GRA_CODIGO = F2.GRA_CODIGO)
       	WHERE A.COD_ACTIVIDAD_FUERA_CUARTEL = '{$codActividad}' AND A.FUN_RUT = '{$rut}'";
//echo $sql;
$CONECT = @mysql_connect(HOST,DB_USER,DB_PASS);
mysql_select_db(DB);
$result = mysql_query($sql,$CONECT);
if($myrow = mysql_fetch_array($result)){
  $nombre				= $myrow[APP_FUN]." ".$myrow[APM_FUN].", ".$myrow[NOM_FUN]." ".$myrow[NOM2_FUN];
  $grado 				= $myrow[GRADO_FUN];
  $uniDescripcion 		= $myrow[UNIDAD];
  $dias					= $myrow[DIAS];
  $fechaRegistroF		= $myrow[FECHAR];
  $tipoActividad		= $myrow[SERV];
  $fechaInicioF			= $myrow[FECHAI];
  $UsuarioProservipol	= $myrow[APP_US]." ".$myrow[APM_US].", ".$myrow[NOM_US]." ".$myrow[NOM2_US];
  $GradoProservipol		= $myrow[GRADO_US];
}

function addFecha($fecha){
    $fechaPaso	= explode("-",$fecha);
    switch($fechaPaso[1]){
        case 1:
            $mes = "Enero";
            break;
        case 2:
            $mes = "Febrero";
            break;
        case 3:
            $mes = "Marzo";
            break;
        case 4:
            $mes = "Abril";
            break;
        case 5:
            $mes = "Mayo";
            break;
        case 6:
            $mes = "Junio";
            break;
        case 7:
            $mes = "Julio";
            break;
        case 8:
            $mes = "Agosto";
            break;
        case 9:
            $mes = "Septiembre";
            break;
        case 10:
            $mes = "Octubre";
            break;
        case 11:
            $mes = "Noviembre";
            break;
        case 12:
            $mes = "Diciembre";
            break;
    }
    return $fechaPaso[2]." de ".$mes." del ".$fechaPaso[0];    
}

$fechaRegistro 	= addFecha($fechaRegistroF);
$fechaInicio 	= addFecha($fechaInicioF);

$pdf =new Cezpdf();
$pdf->selectFont('./../imprimible.class/fonts/Helvetica.afm');

$pdf->ezSetMargins(30,30,70,30);
$pdf->ezImage("../../img/logo_carabineros.jpg", 0, 80, 'none', 'left');

$pdf->ezText("<b>CARABINEROS DE CHILE</b>",10);
$pdf->ezText("<b>PROSERVIPOL V3.9</b>",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);

$pdf->setColor(0.8,0.8,0.8);
$pdf->filledrectangle(65,580, 520, 50);
$pdf->filledrectangle(65,380, 520, 100);
$pdf->setColor(0,0,0);

$pdf->ezSetMargins(30,30,90,30);
$pdf->ezText("<b>CONSTANCIA DE RECEPCIÓN DE LA ACTIVIDAD FUERA DEL CUARTEL PARA EL REGISTRO EN PROSERVIPOL</b>",10,array('justification'=>'left'));
$pdf->ezSetMargins(30,30,70,30);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("Con fecha {$fechaRegistro}, en el Cuartel Policial {$uniDescripcion} se ha recibido copia de la actividad fuera del cuartel correspondiente al Sr(a) {$grado} {$nombre}.",10,array('justification'=>'left'));
$pdf->ezText("",10);
$pdf->ezText("La actividad fuera del cuartel en comento corresponde a \"{$tipoActividad}\" y fue emitida con fecha de inicio desde el día {$fechaInicio} por un total de {$dias} días.",10,array('justification'=>'left'));
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezSetMargins(30,30,90,30);
$pdf->ezText("<b>IMPORTANTE</b>",10,array('justification'=>'left'));
$pdf->ezText("",10);
$pdf->ezText("<b>Este procedimiento sólo regula el registro de la actividad en el SISTEMA PROSERVIPOL y su relación con los servicios. No reemplaza los plazos, procedimiento habitual y/o exigencias legales que involucra la generación y documentación de la actividad propiamente tal.</b>",10,array('justification'=>'left'));
$pdf->ezSetMargins(30,30,70,30);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("Copia de la actividad recibida por: {$GradoProservipol} {$UsuarioProservipol} ",9,array('justification'=>'left'));
$pdf->ezStream();
//----------------------------- 
?>