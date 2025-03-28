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
        /* If the admin is signed in, redirect the home page to the dbmaintain page
        can use this in the future or use the isAdmin function in the home controller or something

        .when('/home', {
            templateUrl: 'pages/dbmaintain/dbmaintain.html',
            controller: 'DbMaintainController'
        }) 
        
        but for now use /dbmaintain
        
        */

        .when('/dbmaintain', {
            templateUrl: 'pages/dbmaintain/dbmaintain.html',
            controller: 'DbMaintainController'
        })

        // same for cart

        .when('/cart', {
            templateUrl: 'pages/cart/cart.html',
            controller: 'CartController'
        })

        .when('/logout', {
            template: '',
            controller: 'LogoutController'
        })

        .otherwise({
            redirectTo: '/home'
        });
});

app.controller('LogoutController', function($scope, $http, $location, $timeout) {
    $http.post('http://localhost:8000/logout.php', {}, { withCredentials: true })
        .then(function(response) {
            console.log(response);

            $scope.loggedIn = false;
            $scope.session = {};

            $location.path('/home');
        
            $timeout(function() {
                window.location.reload();
            }, 0);
        })
        .catch(function(error) {
            console.error('Error logging out:', error);
        });
});

app.controller('SessionController', function($scope, $http) {
    $scope.session = {};

    // Fetch session data from the backend
    $http.get('http://localhost:8000/session.php', { withCredentials: true })
        .then(function(response) {
            $scope.session = response.data;

            if ($scope.session.loggedIn) {
                $scope.loggedIn = $scope.session.loggedIn;
                console.log("User is logged in:", $scope.session);
            } else {
                console.log("User is not logged in.");
            }
        })
        .catch(function(error) {
            console.error('Error fetching session data:', error);
        });
});