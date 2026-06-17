<?include("../version.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<meta name="author" content="Depto. Control de Gestión" />
	<title>PROSERVIPOL - Programación de Servicios Policiales</title>
	<link rel="stylesheet" type="text/css" href="estiloFormularioRegistro.css?v=<?echo version?>" />
	<script type="text/javascript" src="formularioRegistro.js?v=<?echo version?>"></script>
	<link type="image/x-icon" rel="shortcut icon" href="../images/favicon.ico" />
</head>
<body style="background-color:#f5fbf3;" >
	<div class="header" style="text-align: center;">
		<img alt="logo" height="90" src="../images/logoDepartamento.png" width="90" style="border:none;" />
		
	</div></br></br></br>
	<div class="content">
		<h1>Formulario de inscripción Curso PROSERVIPOL Online 2023</h1><br>
			
			<div style="padding-left: 35%;">
				<h3 style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fecha Inscripción: Martes 07 de Marzo de 2023 hasta el Miércoles 22 de Marzo de 2023</h3>
				<h3 style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fecha Inicio del Curso: Lunes 03 de Abril de 2023</h3>
				<h3 style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fecha Termino del Curso: Martes 25 de Abril de 2023</h3>
				<h3 style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fecha Examen Final: Martes 18 de Abril al Martes 25 de Abril de 2023</h3>
			</div>
			
			<div id="formularioBusqueda">
			</br>

			<span id="labelTextRegistro">Codigo Funcionario :</span></br></br>
			<input type="text" id="textCodFuncionarioBusqueda" name="textCodFuncionarioBusqueda" placeholder="Ingrese Codigo Funcionario" maxlength="10" autocomplete="off" /></br></br></br>
			<input class="btn" type="button" id="btnBuscar" onclick="buscarFuncionario()" value="Buscar" />
			
		</div>
		<div id="formularioRegistro">
			<form method="post" action="" id="formularioMatricula" name="formularioMatricula" accept-charset="utf-8" style="position: relative; left: 15%">
				<br/><br/><br/>
				<table width="75%"><tr><td align="right" width="30%">
					<span id="labelText">Codigo Funcionario :</span>
					</td><td align="left" width="70%" margin="1%">
					<input type="hidden" id="rut" name="rut"/>
					<input type="text" id="textCodFuncionario" name="textCodFuncionario" class="textFormulario" placeholder="Ingrese Codigo Funcionario" maxlength="10" readonly />
					</td></tr>
					<tr><td height="20px"></td></tr>
					<tr><td align="right">
					<span id="labelText">Primer Nombre :</span>
					</td><td align="left">
					<input class="textFormulario" type="text" id="textNombre1" name="textNombre1" readonly/>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Segundo Nombre :</span>
					</td><td align="left">
					<input class="textFormulario" type="text" id="textNombre2" name="textNombre2" readonly/>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Primer Apellido :</span>
					</td><td align="left">
					<input class="textFormulario" type="text" id="textApellido1" name="textApellido1" readonly/>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Segundo Apellido :</span>
					</td><td align="left">
					<input class="textFormulario" type="text" id="textApellido2" name="textApellido2" readonly/>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Grado :</span>
					</td><td align="left">
					<input type="hidden" id="codEscalafon" name="codEscalafon"/>
					<input type="hidden" id="codGrado" name="codGrado"/>
					<input class="textFormulario" type="text" id="textGrado" name="textGrado" readonly/>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Dotación :</span>
					</td><td align="left">
					<input class="textFormulario" type="text" id="textDotacion" name="textDotacion" readonly/>
					</td></tr>
					<!--
					<tr><td align="right">
					<span id="labelText">Repartición Dependiente:</span>
					</td><td align="left">
					<input class="textFormulario" type="text" id="textReparticionD" name="textReparticionD" readonly/>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Alta Repartición :</span>
					</td><td align="left">
					<input class="textFormulario" type="text" id="textReparticionA" name="textReparticionA" readonly/>
					</td></tr>
					-->
					<input type="hidden" id="textReparticionD" name="textReparticionD" />
					<input type="hidden" id="textReparticionA" name="textReparticionA" />
					<tr><td height="20px"></td></tr>
					<tr><td align="right">
					<span id="labelText">Tipo Curso (*):</span>
					</td><td align="left">
					<select class="textFormulario" id="tipoCurso" name="tipoCurso" >
						<option value="">---Seleccione el curso al cual desea matricularse---</option selected>
						<option value="Titular y Suplente">Curso Proservipol Titular y Suplente</option>
						<option value="Validador y Fiscalizador">Curso Proservipol Validador y Fiscalizador</option>
					</select>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Número Celular (*):</span>
					</td><td align="left">
					<span id="labelText">+569 </span><input class="textFormularioCorto" id="numeroCelular" name="numeroCelular" autocomplete="off" placeholder="Ingrese Número Celular" type="number" max="99999999"/>
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Número IP contacto (*):</span>
					</td><td align="left">
					<input class="textFormulario" type="number" id="textIpNum" name="textIpNum" autocomplete="off" placeholder="Ingrese IP de Contacto" max="99999" />
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Email de contacto (*):</span>
					</td><td align="left">
					<input class="textFormulario" type="email" id="textEmail" name="textEmail" autocomplete="off" placeholder="Ingrese Email Funcionario" />
					</td></tr>
					<tr><td align="right">
					<span id="labelText">Repita el Email (*):</span>
					</td><td align="left">
					<input class="textFormulario" type="email" id="textEmailRepeat" name="textEmailRepeat" autocomplete="off" placeholder="Repita Email" />
					</td></tr>
					</div>
					<tr><td height="50px"></td></tr>
					<tr>
					<td></td>
					<td align="left"><input class="btn" type="button" id="btnVolver" name="btnVolver" onclick="volver()" value="Volver" />
					<input class="btn" type="button" id="btnRegistrar" name="btnRegistrar" onclick="matricular()" value="Matricular" /></td>
					</tr>
					<tr><td height="50px"></td></tr>
				</table>
			</form>
		</div>
		
	</div>
</body>
<!--
<footer>
	</br>
	<h3 style="padding-left: 100px;">SUB CONTRALORIA GENERAL DE CARABINEROS<br />
				Departamento Control de Gestión y Sistemas de Información<br />
				2023
	<br />
		</h3>	
</footer>-->
</html>
<script>

const fecha = new Date();
const fechaLimite = new Date('Apr 06 2025 00:00:00');

if(fecha>=fechaLimite){
	btnBuscar.disabled=true;
	btnRegistrar.disabled=true;
}

/*
Quien pueda ver esto, tiene el poder de cambiar el tiempo
*/

</script>