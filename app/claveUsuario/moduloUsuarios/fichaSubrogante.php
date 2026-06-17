<?php



$codigoListaUsuarios      = $_GET['codigo'];

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


<link href="./css/aplicacion.css" rel="stylesheet" type="text/css">
<link href="./css/fichaPersonal.css" rel="stylesheet" type="text/css">


<script language="javascript" src="./js/funcionesFichaSubrogante.js?v.2"></script>

<script language="javascript" src="./js/creaObjeto.js"></script>

<script type="text/javascript" src="./js/unidades.js"></script>

</head>




<body style="margin-top:10; margin-left:10; background-color:#d0d0d0" scroll="no" onload="buscaDatosFuncionarioListaUsuarios('<?php echo $codigoListaUsuarios; ?>');">

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
	<table cellpadding="1" cellspacing="0" width="100%">
		<tr>
			<td width="30%" align="right">CODIGO (SIN GUION)&nbsp;:&nbsp;</td>
			<td width="15%"><input id="textCodigoFuncionario" type="text" maxlength="7"></td>
			
			 <td width="15%"><input name="btnBuscarFuncionario" type="button" id="btn100" value="BUSCAR" onClick="buscaDatosFuncionario()"></td>
			<td width="40%"></td>
		</tr>
	</table>
	</div>
	<div id="cuadro">
	<table cellpadding="0" cellspacing="0" width="100%">

		<tr style="padding: 2px 0px 4px 0px">

			<td width="30%" align="right">GRADO&nbsp;:&nbsp;</td>
			
			<td width="70%"><label id="labelGrado"></label></td>

		</tr>

		<tr style="padding: 0px 0px 4px 0px">
			<td align="right">APELLIDO PATERNO&nbsp;:&nbsp;</td>
			<td><label id="labelApellidoPaterno"></label></td>
		</tr>

		<tr style="padding: 0px 0px 4px 0px">
			<td align="right">APELLIDO MATERNO&nbsp;:&nbsp;</td>
			<td><label id="labelApellidoMaterno"></label></td>
		</tr>

		<tr style="padding: 0px 0px 4px 0px">
			<td align="right">NOMBRES&nbsp;:&nbsp;</td>
			<td><label id="labelNombres"></label></td>
		</tr>

		<tr style="padding: 0px 0px 4px 0px">
			<td align="right">UNIDAD&nbsp;:&nbsp;</td>
			<td><label id="labelUnidad"></label></td>
		</tr>


	</table>

	</div>



<!--
			<select id="selTipoUsuario">
			
               <option value="0"></option>
               <option value="nacional">NACIONAL</option>
               <option value="zona">ZONA</option>
               <option value="prefectura">PREFECTURA</option>

               <option value="titular">TITULAR</option>
               <option value="suplente">SUPLENTE</option>

               <option value="fiscalizador">FISCALIZADOR</option>


			
			</select>
-->



	<div id="cuadro">
	
	<table cellpadding="0" cellspacing="0" width="100%" border="0">
			

		<tr style="padding: 4px 0px 8px 0px">

			<td colspan="2">

          <table cellpadding="0" cellspacing="0" width="100%">

              <tr style="padding: 0px 0px 2px 0px">
              
              <td width="3%"></td>
              <td width="15%" align="left" style="background-color:#E6E6E6"><input name="checkPROSERVIPOL" type="checkbox" id="checkPROSERVIPOL" disabled onclick="habilitaCheck('PROSERVIPOL')"><label id="labelcheckProservipol" disabled>PROSERVIPOL</label></td>
              
              <td colspan="2" width="31%" style="background-color:#E6E6E6">
              <td width="1%" style="background-color:#E6E6E6"></td>
              </td>

              
              <td width="3%"></td>
              <td width="15%" align="left" style="background-color:#E6E6E6"><input name="checkRRCC" type="checkbox" id="checkRRCC" disabled onclick="habilitaCheck('RRCC')"><label id="labelcheckRRCC" disabled>RR.CC.</label></td>


              <td colspan="2" width="31%" style="background-color:#E6E6E6">
              </td>

              <td width="1%" style="background-color:#E6E6E6"></td>

              </tr>
              



              <tr style="padding: 0px 0px 6px 0px">
              <td></td>
              <td align="right" style="background-color:#E6E6E6"><label id="labelTipoUsuarioPROSERVIPOL" disabled>TIPO USUARIO&nbsp;:&nbsp;</label></td>
              <td colspan="2" style="background-color:#E6E6E6">
                  <select id="selTipoUsuarioPROSERVIPOL" onChange="cargaUnidadUsuario(this.value)" disabled>
                  </select>
              </td>
              <td style="background-color:#E6E6E6"></td>
              <td></td>
              <td align="right" style="background-color:#E6E6E6"><label id="labelTipoUsuarioRRCC" disabled>TIPO USUARIO&nbsp;:&nbsp;</label></td>
              <td colspan="2" style="background-color:#E6E6E6">
                  <select id="selTipoUsuarioRRCC" disabled>
                  </select>
              </td>
              <td style="background-color:#E6E6E6"></td>
              </tr>



              <tr style="padding: 0px 0px 2px 0px">
              <td></td>
              <td align="right" style="background-color:#E6E6E6"><label id="labelFechaUsuarioPROSERVIPOL" disabled>FECHA&nbsp;:&nbsp;</label></td>
              <td colspan="2" style="background-color:#E6E6E6">
              <label id="textFechaUsuarioPROSERVIPOL" disabled></label>
              </td>
              <td style="background-color:#E6E6E6"></td>
              <td></td>
              <td align="right" style="background-color:#E6E6E6"><label id="labelFechaUsuarioRRCC" disabled>FECHA&nbsp;:&nbsp;</label></td>
              <td colspan="2" style="background-color:#E6E6E6">
              <label id="textFechaUsuarioRRCC" disabled></label>
              </td>
              <td style="background-color:#E6E6E6"></td>
              </tr>




              <tr style="padding: 0px 0px 4px 0px">
              <td></td>

              <td style="background-color:#E6E6E6"></td>
              
              <td width="15%" style="background-color:#E6E6E6"></td>
              
              <td width="16%" style="background-color:#E6E6E6">
                <input id="btnRestablecerPROSERVIPOL" type="button" value="RESTABLECER" onClick="restablecerContrasena('PROSERVIPOL')" disabled>
              </td>
              <td style="background-color:#E6E6E6"></td>
              <td></td>

              <td style="background-color:#E6E6E6"></td>
              
              <td width="15%" style="background-color:#E6E6E6"></td>

              <td width="16%" style="background-color:#E6E6E6">
                <input id="btnRestablecerRRCC" type="button" value="RESTABLECER" onClick="restablecerContrasena('RRCC')" disabled>
              </td>
              <td style="background-color:#E6E6E6"></td>
              </tr>




              
          </table>







			</td>

    <td></td>

		</tr>

		<tr style="padding: 0px 0px 2px 0px">

			<td width="10%" align="right">
			<label id="labelUnidadUsuario" disabled="yes">UNIDAD DESTINO&nbsp;:&nbsp;</label></td>

			<td width="37%">
	  <input id="textUnidadAgregado" type="text" readonly="yes" disabled="true" style="background-color:#E6E6E6"><input id="codigoUnidadAgregado" type="hidden"></td>

			<td width="3%">&nbsp;<input name="btnUnidades" type="button" id="btn100" value="..." disabled="yes" onclick="activaBuscaUnidadAgregado()"></td>

		</tr>



	</table>
	<div id="cubreVentanaPersonal" style="display:none;">
<table width="100%"><tr><td align="right" width="35%"></td></table>
</div>
	<div id="ventanaSeleccionaUnidad" style="display:none;">
		<div id="usuarioCuadro">
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
				<select id="selectUnidad" size="8" onDblClick="seleccionaUnidad('20',this.id);" onClick="habiltarAceptarUnidadAgregado(this.id)"></select>
				</td>
			</tr>
			</table>
		</div>
		<table width="100%">
		<tr> 
			  <td width="20%"></td>
		   	  <td width="20%">&nbsp;</td>
		   	  <td width="20%">&nbsp;</td>
		      <td width="20%"><input type="button" id="btn100" name="btnAceptaUnidadAgregado" value="ACEPTAR" disabled="yes" onClick="seleccionaUnidadAgregado('selectUnidad','codigoUnidadAgregado','textUnidadAgregado')"></td>        
		      <td width="20%"><input type="button" id="btn100" value="CANCELAR" onClick="cerrarVentanaBuscaUnidad('ventanaSeleccionaUnidad')"></td>
		</tr>
		</table>
</div>

	</div>

	<table cellpadding="0" cellspacing="0" width="100%">
		<tr style="padding: 5px 0px 0px 0px">
			<td style="font-size:8px;" align="right">MODIFIQUE EL USUARIO SUBROGANTE Y POSTERIORMENTE SELECCIONE GUARDAR</td>
		</tr>

	</table>
 
</div>




<table width="105%">
<tr> 
      <td width="40%"></td>

      <td width="20%"><input id="btnLimpiarFicha" type="button" id="btn100" value="LIMPIAR" onClick="limpiaFichaTotal();"></td>

      <td width="20%"><input id="btnGuardarFicha" type="button" id="btn100" value="GUARDAR SUBROGANTE" onClick="guardaContrasena();"></td>
      
      <td width="20%"><input id="btnCerrarFicha" type="button" id="btn100" value="CANCELAR" onClick="top.cerrarVentana();"></td>
</tr>
</table>

</div>


</body>
</html>
<?
	//if ($codigoListaUsuarios != ""){
		echo "<script>";
		echo "listaUnidades('20','20','selectUnidad');\n";
		echo "</script>";
	//} 
?>

<?php

?>