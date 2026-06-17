<?
Class dbUsuarios
{			
	
		function buscaFuncionarios($unidadFuncionario, $funcionarios, $codigoPadre, $modulo){
				
$i=0;

if($modulo == "ALL" || $modulo == "PROSERVIPOL")
{
      $CONECT1 = @mysql_connect(DB_HOST_1,DB_USER_1,DB_PASS_1);
      mysql_select_db(DB_DB_1);


	    $sql1 = "
      SELECT 
        USUARIO.FUN_CODIGO,
        FUNCIONARIO.FUN_APELLIDOPATERNO,
        FUNCIONARIO.FUN_APELLIDOMATERNO,
        FUNCIONARIO.FUN_NOMBRE,
        GRADO.GRA_DESCRIPCION,
        DATE_FORMAT(USUARIO.US_FECHACREACION,'%d-%m-%Y') AS US_FECHACREACION_1,
        TIPO_USUARIO.TUS_DESCRIPCION

      FROM
        USUARIO
        INNER JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
        INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
        INNER JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
          
      WHERE
        USUARIO.UNI_CODIGO = '".$unidadFuncionario."'";

	    	//echo $sql1;



        $result1 = mysql_query($sql1,$CONECT1);



        while($myrow1 = mysql_fetch_array($result1)){

					$funcionario = new usuario;
					$funcionario->setCodigoFuncionario(STRTOUPPER($myrow1["FUN_CODIGO"]));
					$funcionario->setApellidoPaterno(STRTOUPPER($myrow1["FUN_APELLIDOPATERNO"]));
					$funcionario->setApellidoMaterno(STRTOUPPER($myrow1["FUN_APELLIDOMATERNO"]));
					$funcionario->setPNombre(STRTOUPPER($myrow1["FUN_NOMBRE"]));

          $funcionario->setGradoDescripcion(STRTOUPPER($myrow1["GRA_DESCRIPCION"]));

          $funcionario->setUsuarioModulo("PROSERVIPOL");

          $funcionario->setUsuarioFechaDesde1($myrow1["US_FECHACREACION_1"]);
          $funcionario->setUsuarioTipo1($myrow1["TUS_DESCRIPCION"]);

					$funcionarios[$i] = $funcionario;					
					$i++;
				}


    if($codigoPadre != "")
    {

	    $sql1 = "
      SELECT 
        USUARIO.FUN_CODIGO,
        FUNCIONARIO.FUN_APELLIDOPATERNO,
        FUNCIONARIO.FUN_APELLIDOMATERNO,
        FUNCIONARIO.FUN_NOMBRE,
        GRADO.GRA_DESCRIPCION,
        DATE_FORMAT(USUARIO.US_FECHACREACION,'%d-%m-%Y') AS US_FECHACREACION_1,
        TIPO_USUARIO.TUS_DESCRIPCION

      FROM
        USUARIO
        INNER JOIN FUNCIONARIO ON (USUARIO.FUN_CODIGO = FUNCIONARIO.FUN_CODIGO)
        INNER JOIN GRADO ON (FUNCIONARIO.ESC_CODIGO = GRADO.ESC_CODIGO) AND (FUNCIONARIO.GRA_CODIGO = GRADO.GRA_CODIGO)
        INNER JOIN TIPO_USUARIO ON (USUARIO.TUS_CODIGO = TIPO_USUARIO.TUS_CODIGO)
          
      WHERE
        USUARIO.UNI_CODIGO = '".$codigoPadre."'";

	    	//echo $sql1;


        $result1 = mysql_query($sql1,$CONECT1);


        while($myrow1 = mysql_fetch_array($result1)){

					$funcionario = new usuario;
					$funcionario->setCodigoFuncionario(STRTOUPPER($myrow1["FUN_CODIGO"]));
					$funcionario->setApellidoPaterno(STRTOUPPER($myrow1["FUN_APELLIDOPATERNO"]));
					$funcionario->setApellidoMaterno(STRTOUPPER($myrow1["FUN_APELLIDOMATERNO"]));
					$funcionario->setPNombre(STRTOUPPER($myrow1["FUN_NOMBRE"]));

          $funcionario->setGradoDescripcion(STRTOUPPER($myrow1["GRA_DESCRIPCION"]));

          $funcionario->setUsuarioModulo("PROSERVIPOL");

          $funcionario->setUsuarioFechaDesde1($myrow1["US_FECHACREACION_1"]);
          $funcionario->setUsuarioTipo1($myrow1["TUS_DESCRIPCION"]);

					$funcionarios[$i] = $funcionario;					
					$i++;
				}




    }

		mysql_close();


}


if($modulo == "ALL" || $modulo == "RRCC")
{
      $CONECT1 = @mysql_connect(DB_HOST_2,DB_USER_2,DB_PASS_2);
      mysql_select_db(DB_DB_2);


	    $sql1 = "
      SELECT 
        USUARIO.FUN_CODIGO,
        FUNCIONARIOS.FUN_APATERNO AS FUN_APELLIDOPATERNO,
        FUNCIONARIOS.FUN_AMATERNO AS FUN_APELLIDOMATERNO,
        FUNCIONARIOS.FUN_NOMBRE1 AS FUN_NOMBRE,
        GRADO.GRA_DESCRIPCION,
        DATE_FORMAT(USUARIO.US_FECHACREACION,'%d-%m-%Y') AS US_FECHACREACION_1

      FROM
        USUARIO
        INNER JOIN FUNCIONARIOS ON (USUARIO.FUN_CODIGO = FUNCIONARIOS.FUN_CODIGO)
        INNER JOIN GRADO ON (FUNCIONARIOS.ESC_GRADO = GRADO.ESC_CODIGO) AND (FUNCIONARIOS.GRA_CODIGO = GRADO.GRA_CODIGO)
          
      WHERE
        USUARIO.UNI_CODIGO = '".$unidadFuncionario."'";

	    	//echo $sql1;



        $result1 = mysql_query($sql1,$CONECT1);



        while($myrow1 = mysql_fetch_array($result1)){

					$funcionario = new usuario;
					$funcionario->setCodigoFuncionario(STRTOUPPER($myrow1["FUN_CODIGO"]));
					$funcionario->setApellidoPaterno(STRTOUPPER($myrow1["FUN_APELLIDOPATERNO"]));
					$funcionario->setApellidoMaterno(STRTOUPPER($myrow1["FUN_APELLIDOMATERNO"]));
					$funcionario->setPNombre(STRTOUPPER($myrow1["FUN_NOMBRE"]));

          $funcionario->setGradoDescripcion(STRTOUPPER($myrow1["GRA_DESCRIPCION"]));

          $funcionario->setUsuarioModulo("RRCC");

          $funcionario->setUsuarioFechaDesde1($myrow1["US_FECHACREACION_1"]);
          $funcionario->setUsuarioTipo1("USUARIO");

					$funcionarios[$i] = $funcionario;					
					$i++;
				}
//echo "este es el error:".mysql_error();


		mysql_close();


}







}

}//end class   
?>