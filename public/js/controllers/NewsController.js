
var app = angular.module("myNoteApp", []);

    app.controller("NewsController", function($scope, $http) {
    $scope.news = [];
        $scope.helloTo = {};
        $scope.helloTo.title = "Filter of Blocks";

    })
