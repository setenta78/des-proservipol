<?
//	header ('content-type: text/xml');
include("../../xml/configuracionBD2.php");
//--- CONTENIDO COMUN INICIO PDF
include ('./../imprimible.class/class.ezpdf.php');
/*
$rut 	 = '962372A';
$color = 'E';
$folio = '545455676';
*/

$rut			= $_GET["rutFuncionario"];
$color		= $_GET["codColor"];
$folio		= $_GET["codFolio"];

	$sql = "SELECT 
            G.GRA_DESCRIPCION GRADO_FUN,
            F.FUN_APELLIDOPATERNO APP_FUN,
				    F.FUN_APELLIDOMATERNO APM_FUN,
				    F.FUN_NOMBRE2 NOM2_FUN,
				    F.FUN_NOMBRE NOM_FUN,
				    T.TSERV_DESCRIPCION SERV,				        
				    L.FECHA_INICIO FECHAI,
				    L.NUM_DIAS DIAS,
				    L.FECHA_REGISTRO FECHAR,
				    G2.GRA_DESCRIPCION GRADO_US,
				    F2.FUN_APELLIDOPATERNO APP_US,
            F2.FUN_APELLIDOMATERNO APM_US,
				    F2.FUN_NOMBRE2 NOM2_US,
				    F2.FUN_NOMBRE NOM_US,				    
				    U.UNI_DESCRIPCION UNIDAD
		      FROM LICENCIA_MEDICA L 
		        JOIN FUNCIONARIO F ON (F.FUN_RUT = L.FUN_RUT)
		        JOIN TIPO_SERVICIO T ON (T.TSERV_CODIGO = L.TIPO_LICENCIA_MEDICA)
		        JOIN GRADO G ON (G.ESC_CODIGO = F.ESC_CODIGO AND G.GRA_CODIGO = F.GRA_CODIGO)
		        JOIN UNIDAD U ON (U.UNI_CODIGO = L.UNI_CODIGO)
		        JOIN FUNCIONARIO F2 ON (F2.FUN_CODIGO = L.FUN_CODIGO_UNIDAD)
		        JOIN GRADO G2 ON (G2.ESC_CODIGO = F2.ESC_CODIGO AND G2.GRA_CODIGO = F2.GRA_CODIGO)
         WHERE L.COLOR_LICENCIA = '".$color."'
            AND L.FOLIO_LICENCIA = '".$folio."'
            AND L.FUN_RUT = '".$rut."';";

//echo $sql;

  $CONECT = @mysql_connect(HOST,DB_USER,DB_PASS);
	mysql_select_db(DB);

	$result = mysql_query($sql,$CONECT);

  if($myrow = mysql_fetch_array($result))
  {
    $nombre								=	$myrow[APP_FUN]." ".$myrow[APM_FUN].", ".$myrow[NOM_FUN]." ".$myrow[NOM2_FUN];
    $grado 								= $myrow[GRADO_FUN];
    $uniDescripcion 			= $myrow[UNIDAD];
    $dias									= $myrow[DIAS];
    $fechaRegistroF				= $myrow[FECHAR];
    $tipoLicencia					= $myrow[SERV];
    $fechaInicioF					= $myrow[FECHAI];
    $UsuarioProservipol		=	$myrow[APP_US]." ".$myrow[APM_US].", ".$myrow[NOM_US]." ".$myrow[NOM2_US];
    $GradoProservipol			= $myrow[GRADO_US];   
  }

if($nombre==""){
	echo "Error";
}	
else{
/*
$fechaRegistroF = '12-08-2016';
$uniDescripcion = '1RA. COM. SANTIAGO';
$color = 'E';
$folio = '545455676';
$grado = 'CABO 1RO.';
$nombre = 'SANTOS LLANOS, CARLOS EDWIN';
$tipoLicencia = 'Post - Natal';
$fechaInicioF = '05-09-2016';
$dias = '3';
$GradoProservipol = 'CARABINERO';
$UsuarioProservipol = 'HENRIQUEZ CALIXTO, OSCAR';
*/

$fechaPaso 			= explode("-",$fechaRegistroF);
switch ($fechaPaso[1]) {
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
$fechaRegistro 	= $fechaPaso[2]." de ".$mes." del ".$fechaPaso[0];

$fechaPaso 			= explode("-",$fechaInicioF);
switch ($fechaPaso[1]) {
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
$fechaInicio 	= $fechaPaso[2]." de ".$mes." del ".$fechaPaso[0];

$pdf =new Cezpdf();
$pdf->selectFont('./../imprimible.class/fonts/Helvetica.afm');

$pdf->ezSetMargins(30,30,70,30);
$pdf->ezImage("../../img/logo_carabineros.jpg", 0, 80, 'none', 'left');

$pdf->ezText("<b>CARABINEROS DE CHILE</b>",10);
$pdf->ezText("<b>PROSERVIPOL V3.0</b>",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
//------------------------------

$pdf->setColor(0.8,0.8,0.8);
$pdf->filledrectangle(65,580, 520, 50);
$pdf->filledrectangle(65,390, 520, 90);
$pdf->setColor(0,0,0);

$pdf->ezSetMargins(30,30,90,30);
$pdf->ezText("<b>CONSTANCIA DE RECEPCIÓN DE LICENCIA MÉDICA PARA EL REGISTRO EN PROSERVIPOL</b>",10,array('justification'=>'left'));
$pdf->ezSetMargins(30,30,70,30);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("Con fecha ".$fechaRegistro.", en el Cuartel Policial ".$uniDescripcion." se ha recibido copia de la licencia médica color ".$color." Folio ".$folio." correspondiente al Sr(a) ".$grado." ".$nombre.".",10,array('justification'=>'left'));
$pdf->ezText("",10);
$pdf->ezText("La licencia en comento es del tipo ".$tipoLicencia." y fue emitida con fecha de reposo desde el día ".$fechaInicio." por un total de ".$dias." días.",10,array('justification'=>'left'));
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezSetMargins(30,30,90,30);
$pdf->ezText("<b>IMPORTANTE</b>",10,array('justification'=>'left'));
$pdf->ezText("",10);
$pdf->ezText("<b>Este procedimiento sólo regula el registro de licencias en el PROSERVIPOL y su relación con los servicios. No reemplaza los plazos, procedimiento habitual y/o exigencias legales que involucra la generación y presentación de licencias médicas, especialmente para funcionarios CPR.</b>",10,array('justification'=>'left'));
$pdf->ezSetMargins(30,30,70,30);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("Copia de la licencia recibida por: ".$GradoProservipol." ".$UsuarioProservipol." ",10,array('justification'=>'left'));
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("",10);
$pdf->ezText("Juntos por la naturaleza, prefiera los medios digitales al papel impreso, si no es estrictamente necesario, no imprima este documento.",7,array('justification'=>'left'));
//--- CONTENIDO COMUN FINAL PDF
$pdf->ezStream();
//----------------------------- 
}

?>