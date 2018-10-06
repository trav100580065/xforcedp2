'use strict';

var app = angular.module("myApp", []);
app.controller("myFormCtrl", function($scope){
	$scope.user = {};
	$scope.wasSubmitted = false;
	$scope.submit = function() {
		
		$scope.wasSubmitted = true;
	};
});