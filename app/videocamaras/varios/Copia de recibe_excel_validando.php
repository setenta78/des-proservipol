<?php
    require('config.php');
    $tipo       = $_FILES['dataCamara']['type'];
    $tamanio    = $_FILES['dataCamara']['size'];
    $archivotmp = $_FILES['dataCamara']['tmp_name'];
    $lineas     = file($archivotmp);

    $i = 0;
    $valoresInsertar = [];

    foreach ($lineas as $linea) {
        $cantidad_registros = count($lineas);
        $cantidad_regist_agregados =  ($cantidad_registros - 1);

        if ($i != 0) {

            $datos = explode(";", $linea);
        
            $procedencia    = !empty($datos[0])  ? ($datos[0]) : '';
            $codEquipoSap   = !empty($datos[1])  ? ($datos[1]) : '';
            $codActivoSap   = !empty($datos[2])  ? ($datos[2]) : '';
            $nroSerie       = !empty($datos[3])  ? ($datos[3]) : '';
            $marca          = !empty($datos[4])  ? ($datos[4]) : '';
            $modelo         = !empty($datos[5])  ? ($datos[5]) : '';

        switch ($procedencia) {
            case "E": // FISCAL
                $procedencia = 10;
                break;
            case "J": //COMODATO
                $procedencia = 20;
                break;
            case "S": //ARRIENDO
                $procedencia = 80;
                break;
        }

        switch ($marca) {
            case "GOPRO":
                $marca = 10;
                break;
            case "EDESIX":
                $marca = 20;
                break;
            case "HYTERA":
                $marca = 30;
                break;
            case "AXON":
                $marca = 40;
                break;
            case "GOPRO HERO":
                $marca = 10;
                break;
        }

        switch ($modelo) {
            case "HERO 7 SILVER":
                $modelo = 10;
                break;
            case "HERO BLACK":
                $modelo = 20;
                break;
            case "VB-440-64-VF-N":
                $modelo = 30;
                break;
            case "VB-400":
                $modelo = 40;
                break;
            case "VM750D":
                $modelo = 50;
                break;
            case "BODY 2":
                $modelo = 60;
                break;
        }
    
        // Añadir valores a la lista para el insert masivo
        $valoresInsertar[] = "('$marca', '$modelo', '$procedencia', '$codActivoSap', '$codEquipoSap', '$nroSerie')";

    
    //valido que no exista
    if( !empty($codEquipoSap) ){
            $checkemail_duplicidad = ("SELECT VC_COD_EQUIPO_SAP FROM VIDEOCAMARA WHERE VC_COD_EQUIPO_SAP='".($codEquipoSap)."' ");
            $ca_dupli = mysqli_query($con, $checkemail_duplicidad);
            $cant_duplicidad = mysqli_num_rows($ca_dupli);
            }   

    //No existe Registros Duplicados
    if ( $cant_duplicidad == 0 ) { 

    $insertarData = "INSERT INTO VIDEOCAMARA( 
        MVC_COD,
        MODVC_CODIGO,
        PREC_CODIGO,
        VC_COD_ACTIVO_SAP,
        VC_COD_EQUIPO_SAP,
        VC_NRO_SERIE
    ) VALUES(
        '$marca',
        '$modelo',
        '$procedencia'
        '$codActivoSap'
        '$codEquipoSap'
        '$nroSerie'
    )";
    mysqli_query($con, $insertarData);
            
    } 
    /**Caso Contrario actualizo el o los Registros ya existentes*/
        else{
            $updateData =  ("UPDATE VIDEOCAMARA SET 
                MVC_COD             ='" .$marca. "',
                MODVC_CODIGO        ='" .$modelo. "',
                PREC_CODIGO         ='" .$procedencia. "'  
                VC_COD_ACTIVO_SAP   ='" .$codActivoSap. "',
                VC_COD_EQUIPO_SAP   ='" .$codEquipoSap. "',
                VC_NRO_SERIE        ='" .$nroSerie. "'  
                WHERE VC_COD_EQUIPO_SAP='".$codEquipoSap."'
            ");
            $result_update = mysqli_query($con, $updateData);
            } 
    }

    $i++;
    }

?>

<a href="index.php">Volver Atrás</a>