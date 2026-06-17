<?php
session_start();
if ($_SESSION["session_autent_carga"] == "SI") 
{?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>CARGA DE DATOS SIICGE</title>


<link rel="stylesheet" type="text/css" href="./css/principal.css">
<link rel="stylesheet" type="text/css" href="./css/controlDatos.css">

<script language="javascript" SRC="./js/creaObjeto.js"></script>
<script language="javascript" SRC="./js/funcionesCargaDatos.js"></script>

</head>


<body>

<div class='barra_superior'>
    <div class="derecha">
        <form name="salir" method="post" action="logout.php">
        <input type="submit" name="CerrarSesion" id="CerrarSesion" value="CERRAR SESION" class="Boton_">
        </form>
    </div>


    <?php
    echo "<b>CARGA DE DATOS SIICGE<br><br>".strtoupper($_SESSION["session_nombre"])." (".strtoupper($_SESSION["session_login"]).") (".strtoupper($_SESSION["session_atrib"]).")</b>";
    ?>
</div>


<div class='barra_menu'>

      <table width="100%" cellpadding="0" cellspacing="0">


      <tr>

        <td align="left" width="19%" id='textFecha'>
            &nbsp;
        </td>
        
        <td align="right" width="4%">TABLA&nbsp;:&nbsp;</td>
        
        
        <td Width="12%">
            <select class="campoSelect" id="selTabla" name="selTabla">
               <option value="0"></option>
               <option value="Servicios">PROSERVIPOL - SERVICIOS</option>
               <option value="Personal">PROSERVIPOL - PERSONAL</option>
               <option value="Vehiculos">PROSERVIPOL - VEHICULOS</option>
               <option value="Organizaciones">RELAC COMUN - ORGANIZACIONES</option>
               <option value="Reuniones">RELAC COMUN - REUNIONES</option>
            </select>
        </td>
        
        <td align="right" width="4%">MES&nbsp;:&nbsp;</td>
 
        <td width="6%">
            <select class="campoSelect" id="selMes" name="selMes">
               <option value="0"></option>
               <option value="1">ENERO</option>
               <option value="2">FEBRERO</option>
               <option value="3">MARZO</option>
               <option value="4">ABRIL</option>
               <option value="5">MAYO</option>
               <option value="6">JUNIO</option>
               <option value="7">JULIO</option>
               <option value="8">AGOSTO</option>
               <option value="9">SEPTIEMBRE</option>
               <option value="10">OCTUBRE</option>
               <option value="11">NOVIEMBRE</option>
               <option value="12">DICIEMBRE</option>
            </select>
        </td>


        <td align="right" width="4%">AÑO&nbsp;:&nbsp;</td>

        <td width="3%">
            <select class="campoSelect" id="selAnno" name="selAnno">
               <option value="0"></option>
               <option value="2010">2010</option>
               <option value="2011">2011</option>
            </select>
        </td>


        <td width="4%"></td>


        <td width="10%">
            <input class="Boton_100" type="button" id="btnCargaDatos" value="CARGAR DATOS" onclick="verificaIngresoDatos(selMes.value,selAnno.value,selTabla.value);">
        </td>


      </tr>

      <tr>

        <td width="19%"></td>
        <td width="4%"></td>
        <td Width="12%"></td>
        <td width="4%"></td>
        <td width="6%"></td>
        <td width="4%"></td>
        <td width="3%"></td>
        <td width="4%"></td>
        <td width="10%">&nbsp;</td>


      </tr>

      <tr>

        <td width="19%"></td>
        <td width="4%"></td>
        <td Width="12%"></td>
        <td width="4%"></td>
        <td width="6%"></td>
        <td width="4%"></td>
        <td width="3%"></td>
        <td width="4%"></td>


        <td width="10%">
            <input class="Boton_100" type="button" id="btnEstadoDatos" value="ESTADO CARGA" onclick="verificaEstadoDatos(selMes.value,selAnno.value);">
        </td>


      </tr>



      </table>


</div>





<div class='barra_submenu'>

      <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" width="100%" id='textSubMenu'>
            &nbsp;
        </td>
        
      </tr>
      </table>

</div>















</body>
</html>


<?php
} else{ header("location: index.php?ingreso=error2"); }
?>
