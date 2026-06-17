<?
	include("../inc/config.inc.php");
	
	if ($opcion == 1) $textoOpcion = "vistaConfirmacion.php";
	if ($opcion == 2) $textoOpcion = "vistaConfirmacion.php";
	
		$textoObservaciones = "EL JEFE DEL SERVICIO DEBERA REALIZAR EL RELEVO AL PUNTO FIJO DEL C.D.E. EN FORMA ROTATIVA A LO MENOS DE DOS HORAS CON PERSONAL DEL PATRULLAJE, DEBIENDO ADEMAS EFECTUAR VIGILANCIA ESPECIAL A VIVIENDAS FISCALES, VIGILANCIA ESPECIAL EN LA PASARELA UBICADA EN HUERFANOS EN FORMA EFECTIVA, ADEMAS MANTENIENDO VIGILANCIA ESPECIAL Y EFECTIVA EN CORREOS DE CHILE, ESTO CON LA FINALIDAD DE EVITAR COMETANSE ILICITOS EN CONTRA REFERIDA ENTIDAD."
?> 
<html>
<head>
<title>Ficha Servicio ....</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/verdeStyle.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../js/documento.js"></script>
<script language="javascript" src="../js/funciones.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="autofocus()" bgcolor="#d0d0d0">
<form action="documento.php" method="POST" name="MyForm">
 
<div style="position:absolute; left: 10px; width:98%; text-align:center; align:center">
	<table><tr><td></td></tr></table>
 	
 	<table width="100%">
 	<tr>
 		<td>
	    
			
			
			<table width="100%" cellspacing="1" cellpadding="1">
			<tr> 
  				<td class="textoNegrilla" width="100%"  align="left" colspan="2">Identificacion del Servicio</td>
			</tr>
			<tr> 
  				<td bgcolor="#000000"></td>
			</tr>
			<tr><td height="3"></td></tr>
			</table>
			
			
	    	<table style="width:100%" cellpadding="1" cellspacing="1">
	    	<tr> 
	    	    <td width="18%" align="right">Servicio&nbsp;:&nbsp;</td>
	    		<td width="32%" class="dato">
	    			<table>
	    			<tr>
	    				<td class="textoNegrilla">Primer Turno</td>
	    			</tr>
	    			</table>
	    		</td>
	    		<td width="18%" align="right">Inicio&nbsp;:&nbsp;</td>
	    		<td width="32%" class="dato">
	    			<table>
	    			<tr>
	    				<td class="textoNegrilla">07:30 Hrs. del 10/Enero/2008</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td align="right">Tipo Servicio&nbsp;:&nbsp;</td>
	    		<td class="dato">
	    			<table>
	    			<tr>
	    				<td class="textoNegrilla">Extracuartel</td>
	    			</tr>
	    			</table>
	    		</td>
	    	    <td align="right">Término&nbsp;:&nbsp;</td>
	    	    <td class="dato">
	    		   	<table>
	    			<tr>
	    				<td class="textoNegrilla">15:00 Hrs. del 10/Enero/2008</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">Vehículo&nbsp;:&nbsp;</td>
	    		<td colspan="3" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Radiopatrula (RP 1234)</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">Interno&nbsp;:&nbsp;</td>
	    		<td colspan="3" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Cabo 2do. APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">Cantidad Medios&nbsp;:&nbsp;</td>
	    		<td colspan="3" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">2</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	</table>
	    	<table cellspacing="0" cellpadding="0">
    		<tr> 
     			<td height="1"></td>
	 		</tr>
			</table>
	    </td>
	</tr>
	</table>
	
	<div class="linea"></div>

	
	<!--
	<table width="100%" cellspacing="1" cellpadding="1">
			<tr> 
  				<td class="textoNegrilla" width="100%"  align="left" colspan="2">Medio de Vigilancia Número 1 - Recursos Humanos y Logísticos Asignados</td>
			</tr>
			<tr> 
  				<td bgcolor="#000000"></td>
			</tr>
			<tr><td height="3"></td></tr>
			</table>
	
			<table style="width:100%" cellpadding="1" cellspacing="1">
	    	<tr> 
	    	    <td class="label">Jefe Medio Vigilancia&nbsp;:&nbsp;</td>
	    		<td colspan="3" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Teniente APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td width="18%" align="right">Factor&nbsp;:&nbsp;</td>
	    		<td width="32%" class="dato">
	    			<table>
	    			<tr>
	    				<td class="textoNegrilla">Ordenes Judiciales</td>
	    			</tr>
	    			</table>
	    		</td>
	    		<td width="18%" align="right">Cuadrante&nbsp;:&nbsp;</td>
	    		<td width="32%" class="dato">
	    			<table>
	    			<tr>
	    				<td class="textoNegrilla">1</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	</table>
	    	<table style="width:100%" cellpadding="1" cellspacing="1">
	    	<tr> 
	    	    <td class="label" width="18%">Personal Asigando&nbsp;:&nbsp;</td>
	    		<td width="82%" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Teniente APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">&nbsp;</td>
	    		<td class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Sargento APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">&nbsp;</td>
	    		<td class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Cabo 2do. APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">&nbsp;</td>
	    		<td class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Carabinero APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	</table>
	
			<table style="width:100%" cellpadding="1" cellspacing="1">
	    	<tr> 
	    	    <td class="label" width="18%">Vehiculos&nbsp;:&nbsp;</td>
	    		<td width="82%" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Retén Móvil Z 2815</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label" width="18%">&nbsp;</td>
	    		<td width="82%" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Moto Todo Terreno M 3363</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	</table>
	    	
	    	<table width="100%" cellspacing="1" cellpadding="1">
			<tr><td height="10"></td></tr>
			</table>

		<table width="100%" cellspacing="1" cellpadding="1">
			<tr> 
  				<td class="textoNegrilla" width="100%"  align="left" colspan="2">Medio de Vigilancia Número 2 - Recursos Humanos y Logísticos Asignados</td>
			</tr>
			<tr> 
  				<td bgcolor="#000000"></td>
			</tr>
			<tr><td height="3"></td></tr>
			</table>
	
			<table style="width:100%" cellpadding="1" cellspacing="1">
	    	<tr> 
	    	    <td class="label">Jefe Medio Vigilancia&nbsp;:&nbsp;</td>
	    		<td colspan="3" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Teniente APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td width="18%" align="right">Factor&nbsp;:&nbsp;</td>
	    		<td width="32%" class="dato">
	    			<table>
	    			<tr>
	    				<td class="textoNegrilla">Procedimientos</td>
	    			</tr>
	    			</table>
	    		</td>
	    		<td width="18%" align="right">Cuadrante&nbsp;:&nbsp;</td>
	    		<td width="32%" class="dato">
	    			<table>
	    			<tr>
	    				<td class="textoNegrilla">1</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	</table>
	    	<table style="width:100%" cellpadding="1" cellspacing="1">
	    	<tr> 
	    	    <td class="label" width="18%">Personal Asigando&nbsp;:&nbsp;</td>
	    		<td width="82%" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Teniente APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">&nbsp;</td>
	    		<td class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Sargento APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">&nbsp;</td>
	    		<td class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Cabo 2do. APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label">&nbsp;</td>
	    		<td class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Carabinero APaterno AMaterno, Nombres</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	</table>
	
			<table style="width:100%" cellpadding="1" cellspacing="1">
	    	<tr> 
	    	    <td class="label" width="18%">Vehiculos&nbsp;:&nbsp;</td>
	    		<td width="82%" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Retén Móvil Z 2815</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	<tr> 
	    	    <td class="label" width="18%">&nbsp;</td>
	    		<td width="82%" class="dato">
	    			<table style="width:100%">
	    			<tr>
	    				<td class="textoNegrilla">Moto Todo Terreno M 3363</td>
	    			</tr>
	    			</table>
	    		</td>
	    	</tr>
	    	</table>

-->

			<table width="100%" cellspacing="1" cellpadding="1">
			<tr> 
  				<td class="textoNegrilla" width="30%"  align="left">Medio de Vigilancia Nro. 1</td>
  				<td class="textoNegrilla" width="20%"  align="right"></td>
  				<td class="textoNegrilla" width="1%"></td>
  				<td class="textoNegrilla" width="30%" align="left">Medio de Vigilancia Nro. 2</td>
  				<td class="textoNegrilla" width="19%"  align="right"></td>
			</tr>
			<tr> 
  				<td width="49%"  align="left" colspan="2" bgcolor="#000000"></td>
  				<td width="2%"></td>
  				<td width="49%" align="left" colspan="2" bgcolor="#000000"></td>
			</tr>
			<tr><td colspan="5" height="3"></td></tr>
			</table>
			
			
			<table width="100%" cellspacing="1" cellpadding="1">
			<tr height="18"> 
  				<td width="18%"  align="right">Jefe Medio&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;Tte. APaterno AMaterno, Nombres</td>
  				<td width="18%"  align="right">Jefe Medio&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;SubTte. APaterno AMaterno, Nombres</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Factor&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;Ordenes Judiciales</td>
  				<td width="18%"  align="right">Factor&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;Prevención</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Cuadrante&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;1</td>
  				<td width="18%"  align="right">Cuadrante&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;1</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">&nbsp;</td>
  				<td width="32%" align="left">&nbsp;</td>
  				<td width="18%"  align="right">Cuartel Movil&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			</table>
	
	<!--
	<table width="100%">
 	<tr>
 		<td>
	    	
			
			<table width="100%" cellspacing="1" cellpadding="1">
			<tr> 
  				<td class="textoNegrilla" width="30%"  align="left">Resumen Recursos Humanos (16) y Animales (1)</td>
  				<td class="textoNegrilla" width="20%"  align="right">
  				<a href="" OnMouseOver="cambiarClase(this, 'linkMarcado')"  OnMouseOut="cambiarClase(this, 'link')" class="link">Ver Detalle</a> (+)
  				</td>
  				<td class="textoNegrilla" width="1%"></td>
  				<td class="textoNegrilla" width="30%" align="left">Resumen Vehiculos (8)</td>
  				<td class="textoNegrilla" width="19%"  align="right">Ver Detalle (+)</td>
			</tr>
			<tr> 
  				<td width="49%"  align="left" colspan="2" bgcolor="#000000"></td>
  				<td width="2%"></td>
  				<td width="49%" align="left" colspan="2" bgcolor="#000000"></td>
			</tr>
			<tr><td colspan="5" height="3"></td></tr>
			</table>
			
			
			<table width="100%" cellspacing="1" cellpadding="1">
			<tr height="18"> 
  				<td width="18%"  align="right">Infantería&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;8</td>
  				<td width="18%"  align="right">Furgones&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Motorizados&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;8</td>
  				<td width="18%"  align="right">Radiopatrullas&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Perro Policial&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;1</td>
  				<td width="18%"  align="right">Motos Todo Terreno&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">&nbsp;</td>
  				<td width="32%" align="left">&nbsp;</td>
  				<td width="18%"  align="right">Cuartel Movil&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			</table>
			<br>
			<table width="100%" cellspacing="1" cellpadding="1">
			<tr> 
  				<td class="textoNegrilla" width="30%"  align="left">Resumen Armamento (18) y Municiones (6)</td>
  				<td class="textoNegrilla" width="20%"  align="right">Ver Detalle (+)</td>
  				<td class="textoNegrilla" width="1%"></td>
  				<td class="textoNegrilla" width="30%" align="left">Resumen Radios (2) y Accesorios (8)</td>
  				<td class="textoNegrilla" width="19%"  align="right">Ver Detalle (+)</td>
			</tr>
			<tr> 
  				<td width="49%"  align="left" colspan="2" bgcolor="#000000"></td>
  				<td width="2%"></td>
  				<td width="49%" align="left" colspan="2" bgcolor="#000000"></td>
			</tr>
			<tr><td colspan="5" height="3"></td></tr>
			</table>
			
			<table width="100%" cellspacing="1" cellpadding="1">
			<tr height="18"> 
  				<td width="18%"  align="right">Pistolas&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;8</td>
  				<td width="18%"  align="right">Portatiles&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Revolveres&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;8</td>
  				<td width="18%"  align="right">Esposas de Seguridad&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">UZI&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
  				<td width="18%"  align="right">Chalecos Antibalas&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Cartuchos Calibre 38&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
  				<td width="18%"  align="right">Bastones&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Municion Calibre 9 MM&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
  				<td width="18%"  align="right">Terciado&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
			</tr>
			<tr height="18"> 
  				<td width="18%"  align="right">Municion UZI&nbsp;:&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;2</td>
  				<td width="18%"  align="right">&nbsp;</td>
  				<td width="32%" align="left" class="dato">&nbsp;</td>
			</tr>
			</table>
		-->	
			<div class="linea"></div>
			
			<table align="center" width="100%">
		    <tr> 
		      <td width="20%">
		      	<input type="button" name="btnCerrar" value="ELIMINAR" OnMouseOver="cambiarClase(this, 'Boton_Resaltado')"  OnMouseOut="cambiarClase(this, 'Boton_100')" class="Boton_100" onclick="alert()">
		      </td>
		      <td width="20%">
		      	<input type="button" name="btnCerrar" value="MODIFICAR" OnMouseOver="cambiarClase(this, 'Boton_Resaltado')"  OnMouseOut="cambiarClase(this, 'Boton_100')" class="Boton_100" onclick="alert()">
		      </td>
			  <td width="20%">
			  	<input type="button" name="btnCerrar" value="IMPRIMIR" OnMouseOver="cambiarClase(this, 'Boton_Resaltado')"  OnMouseOut="cambiarClase(this, 'Boton_100')" class="Boton_100" onclick="alert()">
			  </td>
			  <td width="20%">&nbsp;</td>
			  <td width="20%">
			  	<input type="button" name="btnCerrar" value="CERRAR" OnMouseOver="cambiarClase(this, 'Boton_Resaltado')"  OnMouseOut="cambiarClase(this, 'Boton_100')" class="Boton_100" onclick="parent.close()">
			  </td>
		    </tr>
			</table>
			
	<!--		
	    	
	    </td>
	</tr>
	</table>
	-->
	<!--
	<table><tr class="linea"><td></td></tr></table>
	
	<table cellpadding="1" cellspacing="1">
	<tr> 
	   <td>
			<table style="width:100%" class="tableTituloTabla">
			<tr> 
			     <td>&nbsp;PERSONAL ASIGNADO&nbsp;:&nbsp;</td>
			</tr>
			</table>
			<table style="width:100%" cellspacing="1" cellpadding="3">
			<tr>
			  <td class="tableTituloTabla" width="42px" align="center">&nbsp; NRO.</td>																																																						
			  <td class="tableTituloTabla" width="132px">&nbsp; GRADO</td>          																																																						
			  <td class="tableTituloTabla" width="263px">&nbsp; APELLIDOS Y NOMBRES</td>																																																									  
			  <td class="tableTituloTabla" width="132px">&nbsp; FACCION</td>        										
			  <td class="tableTituloTabla" width="132px">&nbsp;MEDIO</td>           																																																						
			  <td class="tableTituloTabla" width="132px">&nbsp;FACTOR</td>          																																																						
			  <td class="tableTituloTabla">&nbsp;&nbsp;&nbsp;CUDTE.</td>																																																						
			</tr>
			</table>
			
			<table style="width:100%" cellpadding="0" cellspacing="0">
			<tr> 
			    <td>
			    <iframe height="350" src="<?echo $textoOpcion?>" name="dsfsdfsd" scrolling="yes"></iframe>	
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

	<table><tr><td class="linea"></td></tr></table>

	<table class="tablaLevantada" cellpadding="1" cellspacing="1">
	<tr> 
	   <td>
			<table style="width:100%" class="tableTituloTabla">
			<tr> 
			     <td>&nbsp;OBSERVACIONES PARA EL SERVICIO&nbsp;:&nbsp;</td>
			</tr>
			</table>
			
			<table style="width:100%" cellpadding="0" cellspacing="0">
			<tr> 
			    <td>
				<textarea class="textArea" name="textarea" class="Texto_100" rows="6"><?echo $textoObservaciones?></textarea>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	
	<table><tr><td class="linea"></td></tr></table>
	-->
  </div>
</form>
</body>
</html>