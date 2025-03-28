var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            redirectTo: '/home'
        })
        .when('/home', {
            templateUrl: 'pages/home/home.html',
            controller: 'HomeController'
        })
        .when('/about', {
            templateUrl: 'pages/about/about.html',
            controller: 'AboutController'
        })
        .when('/reviews', {
            templateUrl: 'pages/reviews/reviews.html',
            controller: 'ReviewsController'
        })
        .when('/services', {
            templateUrl: 'pages/services/services.html',
            controller: 'ServicesController'
        })
        .when('/signin', {
            templateUrl: 'pages/signin/signin.html',
            controller: 'SignInController'
        })
        .when('/signup', {
            templateUrl: 'pages/signup/signup.html',
            controller: 'SignUpController'
        })
        .otherwise({
            redirectTo: '/home' // Default route
        });
});