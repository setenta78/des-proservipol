<?php
session_start();

//$unidadUsuario      = $_GET['unidadUsuario'];
//$descUnidadUsuario  = $_GET['descUnidadUsuario'];

$unidadUsuario      = 20;
$descUnidadUsuario  = "DIR.NAC.SEGUR.Y ORDEN PUBLICO";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css" rel="stylesheet" type="text/css">


<script language="javascript" src="./js/funcionesListaUnidades.js"></script>
<script language="javascript" src="./js/creaObjeto.js"></script>


<script language="javascript">

var unidadUsuario     = '<?php echo $unidadUsuario; ?>';
var descUnidadUsuario = '<?php echo $descUnidadUsuario; ?>';
var padreActual       = unidadUsuario;

</script>


</head>




<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" scroll="no">

<!--
<div id="fondo" style="visibility: hidden;">
<div id="cargando">
<img src='./imagenes/loading2.gif'> CARGANDO ...
</div>
</div>
-->




<div style="width:94%;">
<div id="marcoLevantado">


	<div id="cuadro">
	
	<table cellpadding="0" cellspacing="0" width="100%">

    <td width="3%"></td>

		<tr style="padding: 4px 0px 8px 0px">

			<td width="94%">

          <table cellpadding="0" cellspacing="0" width="100%">


              <tr style="padding: 0px 0px 8px 0px">
              
              <td width="4%"></td>

              <td width="46%" align="left"><label id="labelSeleccion">SELECCIONE REPARTICION :</label></td>
              
              <td width="4%"></td>

              <td width="46%" align="left">SELECCIONE MODULO(S) :</td>

              </tr>


              <tr style="padding: 0px 0px 6px 0px">

              <td></td>
              <td>
                  <select name="listaArbolUnidad" id="listaArbolUnidad" size="16" class='campoSelectMultiple' ondblclick="leeArbolUnidad(this.value)">
                  <option value='<?php echo $unidadUsuario; ?>'><?php echo $descUnidadUsuario; ?></option>
                  </select>
              </td>
              <td></td>
              
              <td valign="top" align="left">
                  <input name="checkPROSERVIPOL" type="checkbox" id="checkPROSERVIPOL" >PROSERVIPOL</br></br>
                  <input name="checkRRCC" type="checkbox" id="checkRRCC" disabled>RR.CC.
              </td>

              </tr>

          
          </table>

			</td>

    <td width="3%"></td>

		</tr>





	</table>

	</div>

	<table cellpadding="0" cellspacing="0" width="100%">
		<tr style="padding: 5px 0px 0px 0px">
			<td style="font-size:8px;" align="right">HAGA DOBLE CLIK EN REPARTICIONES HASTA ENCONTRAR LA UNIDAD DESEADA.  POSTERIORMENTE INDIQUE MODULO(S) Y SELECCIONE ACEPTAR</td>
		</tr>

	</table>
 
</div>




<table width="105%">
<tr> 
	  <td width="15%"></td>
	  <td width="15%"></td>
	  <td width="15%"></td>
   	  <td width="15%">&nbsp;</td>

      <td width="20%"><input id="btnGuardarFicha" type="button" id="btn100" value="ACEPTAR" onClick="validaUnidad();"></td>
      
      <td width="20%"><input id="btnCerrarFicha" type="button" id="btn100" value="CANCELAR" onClick="cerrarVentana();"></td>
</tr>
</table>
</div>


</body>
</html>
<?php

?>