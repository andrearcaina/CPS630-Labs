// step 1
// var app = angular.module('myApp', []);

// step 4
var app = angular.module('myApp', ['ngRoute']);

// step 6
app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl : 'pages/home.html',
            controller : 'HomeController'
        })
        .when('/aboutus', {
            templateUrl : 'pages/aboutus.html',
            controller : 'AboutusController'
        })
        .when('/reviews', {
            templateUrl : 'pages/reviews.html',
            controller : 'ReviewsController'
        })
        .otherwise({redirectTo: '/'});
});

// step 2
app.controller('HomeController', function($scope) {
    $scope.message = 'Hello from HomeController';
});

// step 7
app.controller('AboutusController', function($scope) {
    $scope.message = 'Hello from AboutusController';
});
    app.controller('ReviewsController', function($scope) {
    $scope.message = 'Hello from ReviewsController';
});