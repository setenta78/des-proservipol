	$(document).ready(function(){
		// recuperar datos de la tabla clientes..
	   	function loadTableData(){
	       $.ajax({
	           url : "ver.php",
	           type : "POST",
	           success:function(data){
				//alert ("dentro de load");
	              $("#tableData").html(data);
	           }
	       });
	   	}
	   	loadTableData();
		$("#registro").click(function(e){
			e.preventDefault();
			var codigo = $("#FUN_CODIGO").val();
			var rut = $("#FUN_RUT").val();
			var escalafon = $("#ESC_CODIGO").val();
			var grado = $("#GRA_CODIGO").val();
			var unidad = $("#UNI_CODIGO").val();
			var apaterno = $("#FUN_APELLIDOPATERNO").val();
			var amaterno = $("#FUN_APELLIDOMATERNO").val();
			var nombre = $("#FUN_NOMBRE").val();
			var nombre2 = $("#FUN_NOMBRE2").val();

			if(codigo !=="" && rut !=="" && escalafon !=="" && grado !=="" && unidad !=="" && apaterno !=="" && amaterno !==""  && nombre !=="" && nombre2 !==""){
				$.ajax({
					url : "accion.php",
					type: "POST",
					cache: false,
					data : {codigo:codigo,rut:rut,escalafon:escalafon, grado:grado, unidad:unidad, apaterno:apaterno, amaterno:amaterno, nombre:nombre, nombre2:nombre2},
					success:function(data){
						//alert("Datos insertados correctamente");
						$("#clienteForm")[0].reset();
						loadTableData();
					},
				});
			}else{
				alert("Todos los campos son obligatorios");
			}
		});	
/*
		// Eliminar registro a MySql desde PHP usando jQuery AJAX
		$(document).on("click",".borrar-btn",function(){
			if (confirm("¿Estás seguro de eliminar esto?")) {
				var codigo = $(this).data('FUN_CODIGO');
				var element = this;
				$.ajax({
					url :"borrar.php",
					type:"POST",
					cache:false,
					data:{borrarId:codigo},
					success:function(data){
						if (data == 1) {
							$(element).closest("tr").fadeOut();
							alert("Registro de funcionario eliminado correctamente");	
						}else{
							alert("Identificación de funcionario inválida");
						}
					}
				});
			}
		});
*/
		// Edite el registro a mysqli desde php usando jquery ajax
		$(document).on("click",".editar-btn",function(){
			var codigo = $(this).data('FUN_CODIGO');
			$.ajax({
				url :"extraer.php",
				type:"POST",
				cache:false,
				data:{editarId:codigo},
				success:function(data){
					$("#editarForm").html(data);
				},
			});
		});

		// User record update to mysqli from php using jquery ajax
		$(document).on("click","#editarSubmit", function(){
			var editar_id = $("#editarId").val();
			var nombre = $("#editarNombre").val();
			var email = $("#editarEmail").val();
			var pais = $("#editarPais").val();
			var password = $("#editarPassword").val();
			
			$.ajax({
				url:"actualizar.php",
				type:"POST",
				cache:false,
				data:{editar_id:editar_id,nombre:nombre,email:email,pais:pais,password:password},
				success:function(data){
					if (data ==1) {
						alert("Registro de usuario actualizado correctamente");
						loadTableData();
					}else{
						alert("Algo salió mal");	
					}
				}
			});
		});
	});