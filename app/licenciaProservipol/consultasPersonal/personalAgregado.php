<?php
session_start();
if ($_SESSION["session_autent_p2"] == "SI")
{?>




<html>
<head>
<title>CONSULTAS PROSERVIPOL</title>

<!-- CSS -->
<link href="./personalAgregado/css/default.css" rel="stylesheet" type="text/css">


<!-- Popup Prototype -->
</head>



<body>

<div class='barra_superior'>
    <div class="derecha">
        <form name="salir" method="post" action="logout.php">
        <input type="submit" name="CerrarSesion" id="CerrarSesion" value="SALIR" class="Boton_">
        </form>
    </div>


    <?php
    echo "<b>CONSULTAS PROSERVIPOL<br><br>".strtoupper($_SESSION["session_nombre"])." (".strtoupper($_SESSION["session_login"]).") (".strtoupper($_SESSION["session_atrib"]).")</b>";
    ?>
</div>







<div style="margin-left:10px; margin-right:10px; margin-top:25px;">

		<div id="titulo">Agregados</div>

		<div id="subtitulo">Descargue el archivo siguiente con la información del día actual.</div>

		<div style="height:25px"></div>


        <form name="formExcel" action="./personalAgregado/baseDatos/excelPersonalAgregado.php" method="post" >

          <table width="98.3%" cellpadding="0" cellspacing="0">
          <tr>
              <td width="5%"></td>
              <td width="25%"><input class="Boton_100" type="submit" id="btnexcelPersonalAgregado" value="DESCARGAR ARCHIVO"></td>
              <td width="70%"></td>
          </tr>
          </table>



        </form>
        </td>




		<div style="height:50px"></div>
		<table width="98.5%"><tr class="linea" ><td></td></tr></table>
		
		<div style="height:25px"></div>


		<div id="titulo">Destino Funcionarios SECOM</div>

		<div id="subtitulo">Seleccione y suba el archivo deseado y posteriormente ejecutelo.</div>


		<div style="height:25px"></div>



		<div id="ventanaArchivo">

          <form action="./personalSecom/baseDatos/archivoPersonalSecom.php" method="post" enctype="multipart/form-data" name="form1">
          <table width="98.3%" cellpadding="0" cellspacing="0">
          <tr>
            
            <td align="left" width="25%">
              ARCHIVO&nbsp;:&nbsp;<input name="archivo" type="file" id="archivo">
            </td>


            <td width="2%">&nbsp;</td>

            <td width="25%">
              <input name="boton" class="Boton_100" type="submit" id="boton" value="ENVIAR">
            </td>

          <td width="48%">
          </tr>
          </table>

          </form>

		</div>
		


<?php
if($errorArchivo=="0")
{
?>

  <script type="text/javascript">
    //alert("ARCHIVO SUBIDO CON EXITO");
  </script>

		<div id="ventanaEjecutar">

          <table width="98.3%" cellpadding="0" cellspacing="0">
          <tr>
            
            <td align="left" width="25%">

        <form name="formEjecutar" action="./personalSecom/baseDatos/ejecutarPersonalSecom.php" method="post" >
            <input name="btnEjecutar" type="submit" class="Boton_100" id="btnEjecutar" value="EJECUTAR ARCHIVO">
        </form>


            </td>

          <td width="75%"></td>
          </tr>
          
          </table>

		</div>

<?php
  }
  else if($errorArchivo=="1")
  {
?>
  <script type="text/javascript">
    alert("PROBLEMAS AL SUBIR EL ARCHIVO. INTENTE NUEVAMENTE");
  </script>

<?php
}
?>
		

			<div style="height:2px"></div>
			<table width="98.5%"><tr class="linea"><td></td></tr></table>
			<div style="height:2px"></div>



</div>









</body>
</html>









<?php
} else{ header("location: index.php?ingreso=error2"); }
?>