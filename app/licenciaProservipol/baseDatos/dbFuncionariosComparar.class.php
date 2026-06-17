<?
Class dbFuncionarios extends Conexion
{
	
	function listaTotalFuncionarios($Unidad, $funcionarios, $error){


		$sql = "SELECT 
				  UNIDAD_PERSONAL.UNI_PERSONAL
				  FROM
				  UNIDAD_PERSONAL
				WHERE
				  UNIDAD_PERSONAL.UNI_CODIGO = ".$Unidad."";

				$result = $this->execstmt($this->Conecta(),$sql);
				mysql_close();

$listaUnidades="";

  if($myrow = mysql_fetch_array($result))
  {
    $listaUnidades="'".$myrow["UNI_PERSONAL"]."'";
  }

  while($myrow = mysql_fetch_array($result))
  {
    $listaUnidades=$listaUnidades.",'".$myrow["UNI_PERSONAL"]."'";
  }

//SI NO EXISTE RELACION EN TABLA UNIDAD_PERSONAL ERROR UNIDAD
if($listaUnidades=="")
{
    $error="UNIDAD";
}


else
{
    $error="";

//echo $sql;

    $sql = "
        SELECT
        pesbasi.PEFBCOD AS CODIGO,
        tescalafongrado.GRADO_DESCRIPCION AS GRADO,
        pesbasi.PEFBNOM AS NOMBRE
        
        FROM pesbasi
        INNER JOIN tescalafongrado ON (pesbasi.PEFBESC=tescalafongrado.ESCALAFON_CODIGO AND pesbasi.PEFBGRA=tescalafongrado.GRADO_CODIGO)
        
        WHERE (PEFBACT = 0 OR PEFBACT = 29 OR PEFBACT = 32)

        AND PEFBREP IN (".$listaUnidades.")

        ORDER BY pesbasi.PEFBESC ASC, pesbasi.PEFBGRA ASC, pesbasi.PEFBCOD ASC";

//echo $sql_p;

//CATCH DEL ERROR DE CONEXION CON BASE DE DATOS DE PERONSLA
if(!@mysql_connect(HOST_P,DB_USER_P,DB_PASS_P))
{
    $error="CONEXION";
}

else
{

    $CONECT = @mysql_connect(HOST_P,DB_USER_P,DB_PASS_P);
    mysql_select_db(DB_P);

    $arregloFuncionarios;

		$result = mysql_query($sql,$CONECT);
		mysql_close();

    while($myrow = mysql_fetch_array($result))
    {
      $arregloFuncionarios[$myrow['CODIGO']]['CODIGO'] = $myrow['CODIGO'];
      $arregloFuncionarios[$myrow['CODIGO']]['GRADO'] = $myrow['GRADO'];
      $arregloFuncionarios[$myrow['CODIGO']]['NOMBRE'] = $myrow['NOMBRE'];
    }


//ERROR SI NO ENCUENTRA FUNCIONARIOS EN BASE DE DATOS PERSONAL, ES PROBABLE QUE SE CAMBIO CODIGO
if(count($arregloFuncionarios)==0)
{
    $error="RELACION";
}

else
{

//print_r($arregloFuncionarios);


		$FechaHoy = date("Y-m-d");
		
		$sql = "SELECT 
				  FUNCIONARIO.FUN_CODIGO,
				  GRADO.GRA_DESCRIPCION,
				  CARGO_FUNCIONARIO.CAR_CODIGO,
				  FUNCIONARIO.FUN_APELLIDOPATERNO,
				  FUNCIONARIO.FUN_APELLIDOMATERNO,
				  FUNCIONARIO.FUN_NOMBRE,
				  FUNCIONARIO.FUN_NOMBRE2,
				  FUNCIONARIO.UNI_CODIGO
				  
				  FROM
				  GRADO
				  INNER JOIN FUNCIONARIO ON (GRADO.ESC_CODIGO = FUNCIONARIO.ESC_CODIGO)
				  AND (GRADO.GRA_CODIGO = FUNCIONARIO.GRA_CODIGO)
				  LEFT OUTER JOIN CARGO_FUNCIONARIO ON (FUNCIONARIO.FUN_CODIGO = CARGO_FUNCIONARIO.FUN_CODIGO)
				WHERE
				  CARGO_FUNCIONARIO.UNI_CODIGO = ".$Unidad." AND
				  CARGO_FUNCIONARIO.CORRELATIVO_CARGOFUNCIONARIO=(SELECT MAX(CORRELATIVO_CARGOFUNCIONARIO) FROM CARGO_FUNCIONARIO WHERE FUNCIONARIO.FUN_CODIGO=CARGO_FUNCIONARIO.FUN_CODIGO)";				  


		$sql .= " ORDER BY FUNCIONARIO.ESC_CODIGO ASC, FUNCIONARIO.GRA_CODIGO ASC, FUNCIONARIO.FUN_CODIGO ASC";
								
				//echo $sql;
				
				$i=0;
				$result = $this->execstmt($this->Conecta(),$sql);
				mysql_close();
				while($myrow = mysql_fetch_array($result))
				{

					
					$cargo = $myrow["CAR_CODIGO"];
					$gradoDesc = $myrow["GRA_DESCRIPCION"];
		

					if(!isset($arregloFuncionarios[$myrow['FUN_CODIGO']]) && ($cargo != 1000 && $cargo !=2000 && $cargo != 3500 && $cargo != 5000) && ($gradoDesc !="ASPTE. OFICIAL" && $gradoDesc !="SUBTENIENTE" && $gradoDesc !="SUBTTE. E.F." && $gradoDesc !="SUBTTE. I"))
					{
            $gradoJerarquico = new grado;
            $gradoJerarquico->setDescripcion(STRTOUPPER($myrow["GRA_DESCRIPCION"]));
            
            $persona = new funcionario;
            $persona->setCodigoFuncionario(STRTOUPPER($myrow["FUN_CODIGO"]));
            $persona->setApellidoPaterno(STRTOUPPER($myrow["FUN_APELLIDOPATERNO"]));
            $persona->setApellidoMaterno(STRTOUPPER($myrow["FUN_APELLIDOMATERNO"]));
            $persona->setPNombre(STRTOUPPER($myrow["FUN_NOMBRE"]));
            $persona->setSNombre(STRTOUPPER($myrow["FUN_NOMBRE2"]));
            $persona->setGrado($gradoJerarquico);
            $persona->setObservacion("SEGÚN LOS REGISTROS DEL DEPTO. P.7. EL FUNCIONARIO NO PERTENECE A ESTA UNIDAD.");

            $funcionarios[$i] = $persona;
            $i++;
					}
					
					else
					{
            unset($arregloFuncionarios[$myrow['FUN_CODIGO']]);
					}
				}
//print_r($arregloFuncionarios);

        foreach ($arregloFuncionarios as $valor)
        {
    

     
            $gradoJerarquico = new grado;
            $gradoJerarquico->setDescripcion(STRTOUPPER($valor['GRADO']));
            
            $persona = new funcionario;
            $persona->setCodigoFuncionario(STRTOUPPER($valor['CODIGO']));
            $persona->setApellidoPaterno(STRTOUPPER($valor['NOMBRE']));
           
            $persona->setApellidoMaterno('');
            $persona->setPNombre('');
            $persona->setSNombre('');
            $persona->setGrado($gradoJerarquico);
            $persona->setObservacion("SEGÚN LOS REGISTROS DEL DEPTO. P.7. EL FUNCIONARIO DEBE SER INGRESADO A ESTA UNIDAD.");

            $funcionarios[$i] = $persona;
            $i++;
         
        }
        //echo "<br><br>";		
				//print_r($arregloFuncionarios);

}//FIN ELSE CATCH ERROR CONEXION BASE DE DATOS DE PERSONAL
}//FIN ELSE NO ENCUENTRA FUNCIONARIOS EN BASE DE DATOS DE PERSONAL ERROR RELACION
}//FIN ELSE EXISTE RELACION EN UNIDAD_PERSONAL ERROR UNIDAD
}//FIN FUNCION
			
}//end class   
?>