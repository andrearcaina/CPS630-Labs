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
            templateUrl: 'pages/about/about.html'
        })
        .when('/reviews', {
            templateUrl: 'pages/reviews/reviews.html',
            controller: 'ReviewsController'
        })
        .when('/services', {
            templateUrl: 'pages/services/services.html'
        })
        .when('/signin', {
            templateUrl: 'pages/signin/signin.html',
            controller: 'SignInController'
        })
        .when('/signup', {
            templateUrl: 'pages/signup/signup.html',
            controller: 'SignUpController'
        })
        .when('/dbmaintain', {
            templateUrl: 'pages/dbmaintain/dbmaintain.html',
            controller: 'DbMaintainController'
        })
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

app.controller('LogoutController', function($scope, $http, $location, $rootScope) {
    $http.post('http://localhost:8000/logout.php', {}, { withCredentials: true })
        .then(function(response) {
            console.log(response);

            $rootScope.$broadcast('sessionUpdated');
            
            $location.path('/home');
        })
        .catch(function(error) {
            console.error('Error logging out:', error);
        });
});

app.controller('SessionController', function($scope, $http, $rootScope) {
    $scope.loggedIn = false;
    $scope.admin = false;
    $scope.session = {};

    $scope.fetchSession = function() {
        $http.get('http://localhost:8000/session.php', { withCredentials: true })
            .then(function(response) {
                $scope.session = response.data;
                $scope.loggedIn = $scope.session.loggedIn;
                $scope.admin = $scope.session.isAdmin;

                $rootScope.session = $scope.session;

                if ($scope.loggedIn) {
                    console.log("User is logged in:", $scope.session);
                } else {
                    console.log("User is not logged in.");
                }
            })
            .catch(function(error) {
                console.error('Error fetching session data:', error);
                $scope.loggedIn = false;
                $scope.admin = false;
            });
    };

    // initial session fetch
    $scope.fetchSession();

    // listen for session updates based on login/logout
    $rootScope.$on('sessionUpdated', function() {
        $scope.fetchSession();
    });
});