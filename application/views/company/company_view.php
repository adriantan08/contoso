<html>
<head>
	<title>Company View</title>
	
</head>
<body>
	
	
	
	<div style="position:relative; left:3%;" id="companies" ng-app='app' ng-controller="ctrl" data-ng-init="initcompanies()">
		<button id="refresh" ng-click="initcompanies()">Refresh</button>
		<table class="myTable" style="max-width:500px;">
		<tr ng-repeat ="result in resultStore">
			<td >{{result}}</td>
		</tr>
		</table>
	
	</div>
	
	<script src="<?php echo base_url();?>js/jquery-2.1.3.min.js"></script>
	

	
	<script src="<?php echo base_url();?>js/angular.min.js"></script>
	
	<script>
	//Fires an http get on Template Factory API to get holidays
	//Yep, angular is overkill in this case, but i'm just trying it out. 
	angular
	.module('app', [])
	.controller('ctrl', function($scope, $http, companyDB){
		$scope.initcompanies = function(){
				companyDB.get().then(function (e){
					$scope.resultStore = e.data;
			});
		
		
		}
	})
	.factory('companyDB', function($http){
		return {
			get:function(){
				var url = '<?php echo base_url();?>company/companylist';
				return $http.get(url);
			}
		}
	})
	


	</script>
	
</body>
</html>