<?
include("../../xml/configuracionBD4.php");
include ('./../imprimible.class/class.ezpdf.php');

$codUnidad	 = $_GET["codUnidad"];
$desUnidad   = $_GET["desUnidad"];
$mes		 = $_GET["mes"];
$anno		 = $_GET["anno"];

function addFecha($mes, $anno){
    switch($mes){
        case 1:
            $mesAdd = "ENERO";
            break;
        case 2:
            $mesAdd = "FEBRERO";
            break;
        case 3:
            $mesAdd = "MARZO";
            break;
        case 4:
            $mesAdd = "ABRIL";
            break;
        case 5:
            $mesAdd = "MAYO";
            break;
        case 6:
            $mesAdd = "JUNIO";
            break;
        case 7:
            $mesAdd = "JULIO";
            break;
        case 8:
            $mesAdd = "AGOSTO";
            break;
        case 9:
            $mesAdd = "SEPTIEMBRE";
            break;
        case 10:
            $mesAdd = "OCTUBRE";
            break;
        case 11:
            $mesAdd = "NOVIEMBRE";
            break;
        case 12:
            $mesAdd = "DICIEMBRE";
            break;
    }
    return 'MES DE '.$mesAdd.' DEL '.$anno;
}

$dataHeader[0] = array(
    'first'     => '<b>UNIDAD</b>',
    'second'    => $desUnidad
);

$dataHeader[1] = array(
    'first'     => '<b>FECHA INFORME</b>',
    'second'    => date('d-m-Y H:i:s')
);

$dataHeader[2] = array(
    'first'     => utf8_decode('<b>PERIODO DE VALIDACIÓN Y DESVALIDACIÓN</b>'),
    'second'    => addFecha($mes, $anno)
);

$optionTableHeader = array(
    'fontSize'      => 7,
    'showHeadings'  => 0,
    'shaded'        => 0,
    'showLines'     => 2,
    'rowGap'        => 3,
    'width'         => 525,
    'cols'          => array('first' => array('width' => 205))
);

$sql = "SELECT 
            IF(D.FECHA_SERVICIOS,D.FECHA_SERVICIOS,M.FECHA) FECHA_SERVICIOS,
            IF(ISNULL(D.ACCION),'SIN VALIDAR',D.ACCION) ACCION,
            IF(ISNULL(D.FECHA),'',D.FECHA) FECHA,
            IF(ISNULL(D.HORA),'',D.HORA) HORA,
            IF(ISNULL(D.USUARIO),'',D.USUARIO) USUARIO,
            IF(ISNULL(D.MOTIVO),'',D.MOTIVO) MOTIVO
            FROM MARCELO_FECHA M
            LEFT JOIN 
            (SELECT 
                C.FECHA_SERVICIOS,
                'VALIDA' ACCION,
                C.FECHA_CERTIFICADO FECHA,
                IF(C.HORA_CERTIFICADO='00:00:00','23:59:59',C.HORA_CERTIFICADO) HORA,
                CONCAT(IF(G.GRA_CODIGO=0,' ',G.GRA_DESCRIPCION),' ',F.FUN_APELLIDOPATERNO,' ',F.FUN_APELLIDOMATERNO,', ',F.FUN_NOMBRE,' ',F.FUN_NOMBRE2) USUARIO,
                '' MOTIVO
            FROM SERVICIOS_CERTIFICADO C
            JOIN FUNCIONARIO F ON F.FUN_CODIGO = C.FUN_CODIGO
            JOIN GRADO G ON G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO
            WHERE C.UNI_CODIGO = {$codUnidad}
            AND MONTH(C.FECHA_SERVICIOS) = {$mes}
            AND YEAR(C.FECHA_SERVICIOS) = {$anno}
            UNION
            SELECT
                C.FECHA_SERVICIOS,
                'DESVALIDA' ACCION,
                C.FECHA_DESVALIDACION FECHA,
                C.HORA_DESVALIDACION HORA,
                CONCAT(IF(G.GRA_CODIGO=0,' ',G.GRA_DESCRIPCION),' ',F.FUN_APELLIDOPATERNO,' ',F.FUN_APELLIDOMATERNO,', ',F.FUN_NOMBRE,' ',F.FUN_NOMBRE2) USUARIO,
                T.TDESVALIDACION_DESCRIPCION MOTIVO
            FROM SERVICIOS_DESVALIDADOS C
            JOIN FUNCIONARIO F ON F.FUN_CODIGO = C.FUN_CODIGO
            JOIN GRADO G ON G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO
            JOIN TIPO_DESVALIDACION T ON T.TDESVALIDACION_CODIGO = C.TDESVALIDACION_CODIGO
            WHERE C.UNI_CODIGO = {$codUnidad}
            AND MONTH(C.FECHA_SERVICIOS) = {$mes}
            AND YEAR(C.FECHA_SERVICIOS) = {$anno}
            UNION
            SELECT
                C.FECHA_SERVICIOS,
                'VALIDA' ACCION,
                C.FECHA_CERTIFICADO FECHA,
                IF(C.HORA_CERTIFICACION='00:00:00',C.HORA_DESVALIDACION,C.HORA_CERTIFICACION) HORA,
                CONCAT(IF(G.GRA_CODIGO=0,' ',G.GRA_DESCRIPCION),' ',F.FUN_APELLIDOPATERNO,' ',F.FUN_APELLIDOMATERNO,', ',F.FUN_NOMBRE,' ',F.FUN_NOMBRE2) USUARIO,
                '' MOTIVO
            FROM SERVICIOS_DESVALIDADOS C
            JOIN FUNCIONARIO F ON F.FUN_CODIGO = C.FUN_CODIGO_CERTIFICADO
            JOIN GRADO G ON G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO
            JOIN TIPO_DESVALIDACION T ON T.TDESVALIDACION_CODIGO = C.TDESVALIDACION_CODIGO
            WHERE C.UNI_CODIGO = {$codUnidad}
            AND MONTH(C.FECHA_SERVICIOS) = {$mes}
            AND YEAR(C.FECHA_SERVICIOS) = {$anno}) D ON D.FECHA_SERVICIOS = M.FECHA
            WHERE YEAR(M.FECHA) = {$anno} AND MONTH(M.FECHA) = {$mes}
            ORDER BY FECHA_SERVICIOS, CAST(CONCAT(D.FECHA,' ',D.HORA) AS DATETIME) ASC, ACCION DESC";

//echo $sql;
$CONECT = @mysql_connect(HOST,DB_USER,DB_PASS);
mysql_select_db(DB);
$result = mysql_query($sql,$CONECT);
$j = -1;
$FECHASERVICIO = '';
while($myrow = mysql_fetch_array($result)){
    if($myrow[FECHA_SERVICIOS]<>$FECHASERVICIO){
        $i = 0;
        $j++;
    }
    
    $fechaPaso 		= explode("-",$myrow[FECHA_SERVICIOS]);
    $fechaMostrar   = $fechaPaso[2] . "-" . $fechaPaso[1] . "-" . $fechaPaso[0];

    $fechaPaso2 		= explode("-",$myrow[FECHA]);
    $fechaMostrar2   = $fechaPaso2[2] . "-" . $fechaPaso2[1] . "-" . $fechaPaso2[0];
    
    $data[$j][$i] = array(
                    '<b>FECHA SERVICIOS</b>'        => $fechaMostrar,
                    '<b>ACCIÓN</b>'                 => $myrow[ACCION],
                    '<b>FECHA</b>'			        => $fechaMostrar2.' '.$myrow[HORA],
                    '<b>USUARIO</b>'		        => $myrow[USUARIO],
                    '<b>MOTIVO DESVALIDACIÓN</b>'	=> $myrow[MOTIVO]
                );
    $FECHASERVICIO = $myrow[FECHA_SERVICIOS];
    $i++;
}

$optionTableFirst = array(
    'fontSize'          => 7,
    'showHeadings'      => 1,
    'rowGap'            => 3,
    'shaded'            => 2,
    'shadeCol'          => array(0.941,0.9647,0.9373),
    'shadeCol2'         => array(0.882,0.9295,0.8705),
    'shadeHeadingCol'   => array(0.5,0.5,0.5),
    'width'             => 525,
    'cols'              => array('<b>FECHA SERVICIOS</b>'       => array('width' => 75),
                                 '<b>ACCIÓN</b>'                => array('width' => 55),
                                 '<b>FECHA</b>'                 => array('width' => 75),
                                 '<b>USUARIO</b>'               => array('width' => 175))
);

$optionTable1 = array(
    'fontSize'          => 7,
    'showHeadings'      => 0,
    'rowGap'            => 3,
    'shaded'            => 2,
    'shadeCol'          => array(0.941,0.9647,0.9373),
    'shadeCol2'         => array(0.882,0.9295,0.8705),
    'shadeHeadingCol'   => array(0.5,0.5,0.5),
    'width'             => 525,
    'cols'              => array('<b>FECHA SERVICIOS</b>'       => array('width' => 75),
                                 '<b>ACCIÓN</b>'                => array('width' => 55),
                                 '<b>FECHA</b>'                 => array('width' => 75),
                                 '<b>USUARIO</b>'               => array('width' => 175))
);

$optionTable2 = array(
    'fontSize'          => 7,
    'showHeadings'      => 0,
    'rowGap'            => 3,
    'shaded'            => 2,
    'shadeCol'         => array(0.882,0.9295,0.8705),
    'shadeCol2'          => array(0.941,0.9647,0.9373),
    'shadeHeadingCol'   => array(0.5,0.5,0.5),
    'width'             => 525,
    'cols'              => array('<b>FECHA SERVICIOS</b>'       => array('width' => 75),
                                 '<b>ACCIÓN</b>'                => array('width' => 55),
                                 '<b>FECHA</b>'                 => array('width' => 75),
                                 '<b>USUARIO</b>'               => array('width' => 175))
);

$pdf =new Cezpdf();
$pdf->selectFont('./../imprimible.class/fonts/Helvetica.afm');

$pdf->ezSetMargins(30,30,70,30);
$pdf->ezText("CARABINEROS DE CHILE",7,array('left'=> 60));
$pdf->ezText("PROGRAMACIÓN DE SERVICIOS POLICIALES - PROSERVIPOL",7,array('left'=> 60));
$pdf->ezText("",10);
$pdf->ezText("INFORME DE VALIDACIONES Y DESVALIDACIONES",9,array('left'=> 125));
$pdf->ezText("DE REGISTROS DE SERVICIOS POLICIALES",9,array('left'=> 145));
$pdf->ezSetDy(35);
$pdf->ezImage("../../img/logo_carabineros.jpg", 0, 50, 'none', 'left');
$pdf->ezSetDy(-6);
$pdf->setColor(0.75, 0.888, 0.702);
$pdf->rectangle(58.5, 676.5, 525, 19);
$pdf->filledrectangle(59, 677, 523.8, 18);
$pdf->setColor(0.882,0.9295,0.8705);
$pdf->filledrectangle(58.5, 631, 205, 42);
$pdf->setColor(0.941,0.9647,0.9373);
$pdf->filledrectangle(263, 631, 320, 42);
$pdf->setColor(0.1,0.1,0.1);
$pdf->ezText("<b>DATOS INFORME</b>",9,array('left'=> -5,'justification' => 'left'));
$pdf->ezText("",6);
$pdf->ezTable($dataHeader, '','',$optionTableHeader);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->setColor(0.75, 0.888, 0.702);
$pdf->rectangle(58.5, 594, 525, 19);
$pdf->filledrectangle(59, 594.5, 523.8, 18);
$pdf->filledrectangle(59, 575.5, 523.8, 16);
$pdf->setColor(0.1,0.1,0.1);
$pdf->ezText("<b>VALIDACIONES Y DESVALIDACIONES</b>",9,array('left'=> -5,'justification' => 'left'));
$pdf->ezText("",7);
$x = 0;
foreach($data AS $tablaDatos){
    $optionTable = ($x%2>0) ? $optionTable2 : $optionTable1;
    $pdf->ezTable($tablaDatos, '','',($x===0) ? $optionTableFirst : $optionTable);
    $x += count($tablaDatos);
}
$pdf->ezStream();
