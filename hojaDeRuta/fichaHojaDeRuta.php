<?php

$unidad               = $_GET['unidad'];
$correlativoServicio  = $_GET['correlativoServicio'];
$numeroMedio          = $_GET['numeroMedio'];
$fecha                = $_GET['fecha'];
$horaInicio           = $_GET['horaInicio'];
$horaTermino          = $_GET['horaTermino'];
$desServicio          = $_GET['desServicio'];
$descripcionFactor    = $_GET['descripcionFactor'];
$listadoVehiculo      = $_GET['listadoVehiculo'];
$listadoFuncionario   = $_GET['listadoFuncionario'];

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!-- CSS -->
<link href="./css/fichaHojaDeRuta.css" rel="stylesheet" type="text/css">


<!-- Funciones -->
<script language="javascript" src="./js/funcionesHojaDeRuta.js"></script>
<script language="javascript" src="./js/leeXmlListaFactorDemanda.js"></script>
<script language="javascript" src="./js/leeXmlListaCuadrantes.js"></script>
<script language="javascript" src="./js/leeXmlAnotaciones.js"></script>
<script language="javascript" src="./js/leeXmlArbolUnidad.js"></script>
<script language="javascript" src="./js/creaObjeto.js"></script>

</head>




<body topmargin="7" bgcolor="#d0d0d0">

<div id="fondo" style="visibility: visible;">
<div id="cargando">
<img src='./imagenes/loading2.gif'> CARGANDO ...
</div>
</div>





<!-- Popup select Otra Unidad -->

<div id="layerArbolUnidad" style="position:absolute; z-index:1; visibility: hidden; left: 315px; top: 85px; background-color: #d0d0d0; padding: 2px;">

      <table align="center" cellpadding="5" class="tablaLevantada" cellspacing="0">

      <tr>
          <td align="center">
              <b>OTRA UNIDAD</b>
          </td>
      </tr>

      <tr>
          <td width="300px">
              <select name="listaArbolUnidad" id="listaArbolUnidad" size="15" class='campoSelectMultiple' ondblclick="leeArbolUnidad(this.value)"></select> 
          </td>
      </tr>

      <tr>
          <td colspan="2" align="center" height="40" valign="bottom">
              <input class="Boton_" type="button" name="Btn_Agregar" value="Aceptar" onclick="leeArbolUnidad(listaArbolUnidad.value)">&nbsp;
              <input class="Boton_" type="button" name="Btn_Agregar" value="Cancelar" onclick="cancelarArbolUnidad()">
          </td>
      </tr>

      </table>

</div>

<!-- Fin Popup select Otra Unidad -->









<form action="" method="POST" name="MyForm">




<div id="layerAnotaciones" style="position:absolute; visibility: visible;">


      <table border="0">
        <tr> 
          <td height="5"></td>
        </tr>
      </table>
		
		 
		 <table style="width: 100%;" cellspacing="0" cellpadding="0" border="0">
		  <tr> 
		    <td width="70%" height="365px" rowspan="2" valign="top" class="tablaLevantada" align="center">

          <div style="width:98%">


		  		<table width="100%" cellpadding="0" cellspacing="2" border="0">

				    <tr>
 				      <td colspan="3" height="20"><b>MEDIO DE VIGILANCIA</b></td>
				    </tr>

				    <tr valign="top">
 				      <td width="15%" align="right">Fecha&nbsp;:&nbsp;</td>
 				      <td width="20%" align="left"><?php echo $fecha; ?></td>

 				      <td rowspan="5" width="65%">
                  <table width="100%" cellpadding="0" cellspacing="2" border="0">
                  <tr valign="top">
                    <td width="20%" align="right">Vehículos&nbsp;:&nbsp;
                    </td>
                    <td width="80%" align="left"><?php echo $listadoVehiculo; ?>
                    </td>
                  </tr>

                  <tr valign="top">
                    <td width="20%" align="right">Funcionarios&nbsp;:&nbsp;
                    </td>
                    <td width="80%" align="left"><?php echo $listadoFuncionario; ?>
                    </td>
                  </tr>

                  </table>
 				      </td>
				    </tr>


				    <tr valign="top">
 				      <td width="15%" align="right" valign="center">Hora Inicio Real&nbsp;:&nbsp;</td>
 				      <td width="20%" align="left"><input id="textHoraInicioReal" name="textHoraInicioReal" type="text" size="7" maxlength="5" class="campoTexto2" value="<?php echo $horaInicio; ?>">&nbsp;(hh:mm)</td>
				    </tr>

				    <tr valign="top">
 				      <td width="15%" align="right" valign="center">Hora Término Real&nbsp;:&nbsp;</td>
 				      <td width="20%" align="left"><input id="textHoraTerminoReal" name="textHoraTerminoReal" type="text" size="7" maxlength="5" class="campoTexto2" value="<?php echo $horaTermino; ?>">&nbsp;(hh:mm)</td>
				    </tr>


				    <tr valign="top">
 				      <td width="15%" align="right">Servicio&nbsp;:&nbsp;</td>
 				      <td width="20%" align="left"><?php echo $desServicio; ?></td>
				    </tr>

				    <tr valign="top">
 				      <td width="15%" align="right">Factor&nbsp;:&nbsp;</td>
 				      <td width="20%" align="left"><?php echo $descripcionFactor; ?></td>
				    </tr>

			    
				    
				 </table>




		    <table width="100%"><tr height="15"><td></td></tr></table>
		    
		    
		    <table width="100%"><tr class="linea" ><td></td></tr></table>




		  		<table width="100%" cellpadding="0" cellspacing="1" border="0">



				    <tr>
                <td align="left" width="20%">FACTOR</td>
                <td align="center" width="10%">HORA INICIO</td>
                <td align="center" width="10%">HORA TERMINO</td>
                <td align="left" width="1%"></td>
                <td align="left" width="10%">CUADRANTE</td>
                <td align="left" width="1%"></td>
                <td align="left" width="17%"><label id="labelOtraUnidad" disabled>OTRA UNIDAD</label></td>
                <td align="left" width="9%"></td>
                <td align="left" width="22%">&nbsp;</td>
				    </tr>


				    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>


				    <tr>
                <td align="left">
                  <select class="campoSelect" id="selFactorAnotacion">
                      <option value="0">CARGANDO ...</option>
                  </select>
                </td>


                <td align="center">
                    <input id="textHoraInicioAnotacion" name="textHoraInicioAnotacion" type="text" size="3" maxlength="2" class="campoTexto2">
                    :
                    <input id="textMinutoInicioAnotacion" name="textMinutoInicioAnotacion" type="text" size="3" maxlength="2" class="campoTexto2">
                </td>
                
                
                <td align="center">
                    <input id="textHoraTerminoAnotacion" name="textHoraTerminoAnotacion" type="text" size="3" maxlength="2" class="campoTexto2">
                    :
                    <input id="textMinutoTerminoAnotacion" name="textMinutoTerminoAnotacion" type="text" size="3" maxlength="2" class="campoTexto2">
                </td>

                <td></td>

                <td align="left">
                
                  <select class="campoSelect" id="cuadranteAnotacion" name="cuadranteAnotacion" onChange="muestraOtroCuadrante(this.value)">
                      <option value="0">CARGANDO ...</option>
                  </select>
                
                </td>

                <td></td>

                <td align="left">
                  <label id="textLabelOtraUnidad" name="textLabelOtraUnidad"></label>
                </td>

                <td align="left">
                  <input class="Boton_100" type="button" id="BotonMuestraArbolUnidad" value="Buscar Unidad" onclick="muestraArbolUnidad('<?php echo $unidad; ?>')" disabled>
                </td>




                <td align="right">
                  
                  <input class="Boton_" type="button" id="BotonGuardarAnotacion" value="Aceptar" onclick="guardaAnotacion()">
                  &nbsp;<input class="Boton_" type="button" id="BotonCancelarAnotacion" value="Cancelar" onclick="limpiaAnotacion()">
                  &nbsp;<input class="Boton_" type="button" id="BotonEliminarAnotacion" value="Eliminar" onclick="eliminaAnotacion()" disabled>
                </td>
				    </tr>

			    
				 </table>
















		<table width="100%"><tr height="15"><td></td></tr></table>




		<table width="100%"><tr class="linea" ><td></td></tr><tr><td><b>ANOTACIONES :</b></td></tr></table>






		    <table width="100%"><tr height="5"><td></td></tr></table>

		
		<div id="listado">
			<div id="cabeceraGrilla">


              <table cellspacing="1" cellpadding="1" width="100%">
                <tr> 
                  <td id="nombreColumna" width="5%" align="center">No.</td>
                  <td id="nombreColumna" width="25%" align="center">FACTOR</td>
                  <td id="nombreColumna" width="15%" align="center">HORA INICIO</td>
                  <td id="nombreColumna" width="15%" align="center">HORA TERMINO</td>
                  <td id="nombreColumna" width="40%" align="center">CUADRANTE</td>
                </tr>
             </table>


		   </div>
      <div id="listadoAnotacion"></div>

    </div>




		    <table width="100%"><tr class="linea" ><td></td></tr></table>





</div>








<div style="width:98%">

  <table><tr><td height="10"></td></tr></table>
  
  <table style="width:100%" align="center" cellpadding="1" cellspacing="0">
  <tr> 
    <td width="20%">
      	<input type="button" id="btnCerrar" name="btnCerrar" value="CANCELAR" OnMouseOver="cambiarClase(this, 'Boton_Resaltado')"  OnMouseOut="cambiarClase(this, 'Boton_100')" class="Boton_100" onclick="cerrarVentana()">
    </td>
  	<td width="40%"></td>

  	<td width="20%">
  	    <input type="button" id="btnFinalizar" name="btnFinalizar" value="ELIMINAR" OnMouseOver="cambiarClase(this, 'Boton_Resaltado')"  OnMouseOut="cambiarClase(this, 'Boton_100')" class="Boton_100"  onclick="eliminaHojaRuta('<?php echo $unidad; ?>','<?php echo $correlativoServicio; ?>','<?php echo $numeroMedio; ?>')">
  	</td>

  	<td width="20%">
  	    <input type="button" id="btnFinalizar" name="btnFinalizar" value="GUARDAR" OnMouseOver="cambiarClase(this, 'Boton_Resaltado')"  OnMouseOut="cambiarClase(this, 'Boton_100')" class="Boton_100"  onclick="finalizarHojaRuta('<?php echo $unidad; ?>','<?php echo $correlativoServicio; ?>','<?php echo $numeroMedio; ?>')">
  	</td>
  </tr>
  </table>


</div>
 
  
  </form>






</body>
</html>


<script language="javascript">
leeFactorDemanda();
leeCuadrante('<?php echo $unidad; ?>');
leeAnotacion('<?php echo $unidad; ?>','<?php echo $correlativoServicio; ?>','<?php echo $numeroMedio; ?>');

</script>

