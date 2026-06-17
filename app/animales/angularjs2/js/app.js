var app = angular.module("myModule", []);


			  
				  
app.controller("myController", function($scope, $http, $timeout){
	
	
	
	
					

					/*
					document.getElementById('bloquea').style.display = 'block';
					document.body.setAttribute("style","overflow: hidden;")					
					*/
					
					
					/*
					$scope.loading = function(panel){
						document.getElementById('bloquea').style.display = 'block';
						document.body.setAttribute("style","overflow: hidden;");
						
						//funcionesGlobales.loading($scope, panel)
					}
					*/
					
					
					
					/*
					$http.get('select.php').then(function(response){
						console.log("response...  " + response);

						$scope.members = response.data;
					});
					*/
					
					
					
					
					
					
					$scope.loadData = function(){
						
					$scope.loader = true;
						
						$http.get("select.php",
						{
							//$scope.loading();
							
							transformResponse: function (cnv) 
							{
							var x2js = new X2JS();
							var aftCnv = x2js.xml_str2json(cnv);
							return aftCnv;
							}
						})
						.success(function (response) {
							console.log(response);
							$scope.vehiculos = response.vehiculos.vehiculo;
							$scope.loader = false;
						});
						
						
						
					}
					
					
					
					
					

					
					
					
					
					
					
			



					
					
					
					
					$scope.insertData = function(){
						$http.post("insert.php", {firstname: $scope.firstname, lastname: $scope.lastname})
						.then(function(){
							$scope.message = "Successfully Submit!";
							$scope.messageStatus = "alert alert-info";
							$scope.msgBox = true;
							$scope.firstname = "";
							$scope.lastname = "";
							$timeout(function(){
								$scope.msgBox = false;
							}, 1000);
							$scope.selectData();
						});	
					}
					
					$scope.selectData = function(){
						$http.get('select.php').then(function(response){
							$scope.members = response.data;
						});
					}
						
					$scope.deleteData = function(mem_id){
						$http.post("delete.php", {mem_id: mem_id})
						.then(function(){
							$scope.message = "Successfully Deleted";
							$scope.messageStatus = "alert alert-danger";
							$scope.msgBox = true;
							$timeout(function(){
								$scope.msgBox = false;
							}, 1000);
							$scope.selectData();
						});
					}
					
					$scope.btnInsert = true;
					
					$scope.updateData = function(mem_id){
						$scope.btnUpdate = false;
						$scope.btnInsert = true;
						$http.post("update.php", {mem_id: $scope.mem_id, firstname: $scope.firstname, lastname: $scope.lastname})
						.then(function(response){	
							$scope.firstname = "";
							$scope.lastname = "";
							$scope.message = "Successfully Updated";
							$scope.messageStatus = "alert alert-success";
							$scope.msgBox = true;
							$timeout(function(){
								$scope.msgBox = false;
							}, 1000);
							$scope.selectData();
						});
					}
					
					$scope.updateBtn = function(mem_id, firstname, lastname){
						$scope.btnInsert = false;
						$scope.btnUpdate = true;
						$scope.firstname = firstname;
						$scope.lastname = lastname;
						$scope.mem_id = mem_id;
					}
});


