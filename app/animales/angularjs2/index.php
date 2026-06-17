<!DOCTYPE html>
<html lang="es">
<head>

<!--<script src="js/jquery-2.1.3.min.js"></script>-->
<script src="js/angular.min.js"></script>
<script src="js/xml2json.js"></script>
<script src="js/app.js"></script>



<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/custom.js"></script>


<!--
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
-->

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">



<!--
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
-->
	
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>





<style>
	table th {
	  text-align: center;
	}
	
	.loader {
	    background-color: rgba(250, 250, 250, 0.5);
	
	    /* FireFox */
	    z-index: 1000;
	    height: 100%;
	    width: 110%;
	    background-repeat: no-repeat;
	    background-position: center;
	    background-image: url(http://i.stack.imgur.com/K8MeK.gif);
	    position: absolute;
	    top: 0px;
	    left: -13px;
	}
	
	.loader span{
	position: relative;
	top: 61%;
	left: 47%;
	}
	
</style>



</head>


		
<body data-ng-init="loadData()" ng-app="myModule" ng-controller="myController">
	
	<div class="container">
	
	
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  		<a class="navbar-brand" href="" style="font-weight: bold;" >MANTENEDOR DE REGISTROS</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>
	</nav>
	
	
	<div class="row">	
	  
			<div class="col-md-12 well">
				
				<h3 class="text-primary">Ingreso, edicion y baja de vehiculos</h3>
				<hr style="border-top:1px dotted #ccc;">
				
				<form>
					<div class="form-inline">
						<!--
						<label>Firstname</label>
						<input type="text" class="form-control" ng-model="firstname" id="firstname"/>
						<label>Lastname</label>
						<input type="text" class="form-control" ng-model="lastname" id="lastname"/>
						-->
						
						<!--<button type="button" class="btn btn-success" ng-show="btnInsert" ng-click="insertData()"><span class="glyphicon glyphicon-save"></span> Ingresar Nuevo Vehiculo</button>-->
						
						<!--
						<button type="button" class="btn btn-warning form-control" ng-show="btnUpdate" ng-click="updateData()"><span class="glyphicon glyphicon-edit"></span> Update</button>
						-->
						
						<!--
						<button type="button" class="btn btn-success" ng-show="btnInsert" ng-click="">
							<span class=""></span> Ingresar Nuevo Vehiculo
							<span class="fas fa-plus-square">Ingresar Nuevo Vehiculo</span>
							<i class="icon-plus-sign"></i> Ingresar Nuevo Vehiculo
						</button>
						-->
						
						<a href="#addnew" class="btn btn-success" data-toggle="modal">
							<span class="fa fa-plus"></span> Ingresar Nuevo Vehiculo
						</a>
						
						<br /><br />
						<div ng-model="message" ng-show="msgBox" class="{{messageStatus}}">{{message}}</div>
					</div>
				</form>
				
				<br />
				
				<!--
				<div class="progress">
				  <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				-->
				
				
				<div id="darkLayer" class="loader ng-hide" ng-show="loader"></div>
				
				<!--<table class="table table-responsive table-bordered alert-warning">-->
				<table class="table table-bordered table-striped" style="margin-top:20px;">
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Tipo Vehiculo</th>
							<th>Procedencia</th>
							<th>BCU</th>
							<th>SAP</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>Patente</th>
							<th>Nro. Institucional</th>
							<th>Ano</th>
							<th>Unidad</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="vehiculo in vehiculos">
							
							<td>{{vehiculo.codigo}}</td>
							<td>{{vehiculo.codigo}}</td>
							<td>{{vehiculo.procedencia}}</td>
							<td>{{vehiculo.bcu}}</td>
							<td>{{vehiculo.sap}}</td>
							<td>{{vehiculo.marca}}</td>
							<td>{{vehiculo.modelo}}</td>
							<td>{{vehiculo.patente}}</td>
							<td>{{vehiculo.numeroInstitucional}}</td>
							<td>{{vehiculo.yearFabricacion}}</td>
							<td>{{vehiculo.unidad}}</td>
							
							<td>
								<center>
									
									<!--
									<button type="button" ng-click="" class="btn btn-warning">
										<span class="fa fa-align-justify"></span>
									</button>
									-->
									
									<a href="#edit" class="btn btn-warning" data-toggle="modal">
										<span class="fa fa-align-justify"></span>
									</a>
									
									
									
									<!--<button type="button" ng-click="updateBtn(member.mem_id, member.firstname, member.lastname)" class="btn btn-warning"><span class="glyphicon glyphicon-align-justify"></span></button>-->
									<!--<button type="button" ng-click="deleteData(member.mem_id);" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>-->
								</center>
							</td>
						</tr>
					</tbody>
				</table>		
			</div>
		</div>
	</div>
<?php include('add_modal.php'); ?>
<?php include('edit_delete_modal.php'); ?>	
</body>	
</html>