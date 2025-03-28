app.controller('SignInController', function($scope, $http, $location, $rootScope) {
    $scope.formData = {};
    $scope.errorMessage = "";
    $scope.successMessage = "";

    $scope.submitForm = function() {
        $scope.formData.signin = 1;

        $http.post('http://localhost:8000/auth.php', $scope.formData, { withCredentials: true })
            .then(function(response) {
                if (response.data.status === "success") {
                    $scope.successMessage = response.data.message;
                    $scope.errorMessage = "";
            
                    $rootScope.$broadcast('sessionUpdated');

                    $http.get('http://localhost:8000/session.php', { withCredentials: true })
                        .then(function(sessionResponse) {
                            const sessionData = sessionResponse.data;

                            if (sessionData.isAdmin) {
                                $location.path('/dbmaintain');
                            } else {
                                $location.path('/home');
                            }
                        });
                } else {
                    $scope.errorMessage = response.data.message;
                    $scope.successMessage = "";
                }
            })
            .catch(
                function(error) {
                    console.error("Error during login:", error);
                    $scope.errorMessage = "An error occurred. Please try again later.";
                }
            );
    };
});