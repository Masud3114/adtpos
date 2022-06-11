var app = angular.module("food_delivery", []);
app.controller("maya_controllar", function($scope, $http) {
	var post_data={
		ppg:			"Test Massage",
		target_date: 	$scope.del_date
	};
	$scope.ShowList=function(){
		//$scope.testMsg=post_data.ppg;
		//$http.get('fetch.php').then(function (response){
		//	console.log(response.data);
		//	$scope.testMsg=response.data.massage;
		//});
		$http({
			method: "POST",
			url: "fetch.php?ppg=test Page",
			data:post_data
		}).then(function (response){
			console.log(response.data);
			//$scope.testMsg=response.data.massage;
		});
	};
});