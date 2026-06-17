<?include("session.php")?>
<?include("tiempo.php")?>
<?php
$codigoPerfil = $_SESSION['USUARIO_CODIGOPERFIL'];
if($codigoPerfil==50 || $codigoPerfil==60 || $codigoPerfil==40)
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title>PROSERVIPOL - Programación de Servicios Policiales ...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/menuPrincipal.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="./controlIngresoDatos/css/controlDatos.css">
<script language="javascript" SRC="./controlIngresoDatos/js/creaObjeto.js"></script>
<script language="javascript" SRC="./controlIngresoDatos/js/funcionesIngresoDatos.js"></script>
</head>

<body onload="actualizarTamanoLista2('listado2');actualizarTamanoLista2('listado3');" onresize="actualizarTamanoLista2('listado2');actualizarTamanoLista2('listado3');">
  <?include("header.php")?>
<div style="margin-left:10px; margin-right:10px; margin-top:10px;">

		<div id="titulo">Control Ingreso de Datos</div>
		<div id="subtitulo">Unidades que no han ingresado registros.</div>
		<div style="height:25px"></div>
		
		

      <table width="100%">


      <tr>

        <td align="left" width="19%" id='textFecha'>
            &nbsp;
        </td>
        
        <td align="right" width="4%">CONSULTA&nbsp;:&nbsp;</td>
        
        
        <td Width="12%">
            <select class="campoSelect" id="selTabla" name="selTabla">
               <option value="0"></option>
               <option value="ProservipolSinServicios">UNIDADES SIN SERVICIOS</option>
               <!--<option value="RRCCSinReuniones">UNIDADES SIN REUNIONES</option>-->
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
               <option value="2012">2012</option>
               <option value="2013">2013</option>
               <option value="2014">2014</option>
               <option value="2015">2015</option>
               <option value="2016">2016</option>
               <option value="2017">2017</option>
               <option value="2018">2018</option>
            </select>
        </td>


        <td width="4%"></td>


        <td width="10%">
            <input class="Boton_100" type="button" id="btnCargaDatos" value="CONSULTAR" onclick="verificaIngresoDatos(selMes.value,selAnno.value,selTabla.value);">
        </td>


      </tr>


     </table>












      <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" width="60%" id='textSubMenu'>
&nbsp;

        </td>


        <td align="right" width="25%" id='horaSubMenu'>
&nbsp;

        </td>

        <td align="right" width="5%" id='horaSubMenu'>
          <form name="excelForm" id="excelForm" method="post">
            <input type="hidden" name="horaForm" id="horaForm">
            <input type="hidden" name="mesForm" id="mesForm">
            <input type="hidden" name="annoForm" id="annoForm">
            <input type="hidden" name="arregloUnidadesForm" id="arregloUnidadesForm">
            <input type="image" name="btnExcelDatos" id="btnExcelDatos" src="./controlIngresoDatos/img/excel4.gif" style="visibility:hidden">
          </form>		
        </td>

      </tr>
      </table>



		<div style="height:2px"></div>
		<table width="100%"><tr class="linea" ><td></td></tr></table>
		<div style="height:2px"></div>



<div id='layerIngresoServicios' style="position:absolute; visibility:visible">

		<div id="listado2">
			<div id="cabeceraGrilla2">


              <table cellspacing="1" cellpadding="1" width="100%">
                <tr> 
                  <td id="nombreColumna" width="20%" align="center">SISTEMA</td>
                  <td id="nombreColumna" width="20%" align="center">FECHA</td>
                  <td id="nombreColumna" width="30%" align="center">CANT. UNIDADES</td>
                  <td id="nombreColumna" width="30%" align="center">&nbsp;</td>
                </tr>
             </table>


		   </div>
      <div id="listadoIngresoServicios"></div>

    </div>
		<div style="height:2px"></div>
		<table width="98.3%"><tr class="linea"><td></td></tr></table>


</div>





<div id='layerUnidadesIngresoServicios' style="position:absolute; visibility:hidden">

		<div id="listado3">
			<div id="cabeceraGrilla2">


              <table cellspacing="1" cellpadding="1" width="100%">
                <tr> 
                  <td id="nombreColumna" width="25%" align="center">ZONA</td>
                  <td id="nombreColumna" width="25%" align="center">PREFECTURA</td>

                  <td id="nombreColumna" width="50%" align="center">UNIDAD/DESTACAMENTO</td>
                  
<!--                  <td id="nombreColumna" width="25%" align="center">COMISARIA</td>
                  <td id="nombreColumna" width="25%" align="center">UNIDAD</td>
-->
                  
                </tr>
             </table>


		   </div>
      <div id="listadoUnidadesIngresoServicios"></div>

    </div>
		<div style="height:2px"></div>
		<table width="98.3%"><tr class="linea"><td></td></tr></table>
</div>



</div>
</body>
</html>

<?php
}
else
{
  header("location: index.php");
}
?>
