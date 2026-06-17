



document.write('<script src="src/controllers/controllerPanel1.js?version=1.003"></script>');




var app = angular.module("appModulo", ['ui.router', 'ngValidate', 'ngProgress', 'ui.bootstrap', 'AxelSoft', 'ngSanitize']);

app.config(function($stateProvider, $urlRouterProvider){
		
		$stateProvider
			
			.state('panel1',{
				url: '/panel1',
				templateUrl: 'src/views/panel1.html?version=1.003',
				//templateUrl: 'production/index.html',
				controller: 'controllerPanel1'
			})
			
			
		
		$urlRouterProvider.otherwise('panel1');
})


app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});


app.value('arreglos', {
	zonas 				:'',
	prefecturas 		:'',
	comisarias 			:'',
	destacamentos 		:'',
	especialidades 		:''
});