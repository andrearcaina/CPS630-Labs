app.controller('SignInController', function($scope, $http, $location, $timeout) {
    $scope.formData = {};
    $scope.errorMessage = "";
    $scope.successMessage = "";

    $scope.submitForm = function() {
        $scope.formData.signin = 1;

        $http.post('http://localhost:8000/auth.php', $scope.formData, { withCredentials: true }).then(function(response) {
            if (response.data.status === "success") {
                $scope.successMessage = response.data.message;
                $scope.errorMessage = "";
        
                $location.path('/home');
        
                $timeout(function() {
                    window.location.reload();
                }, 0);

            } else {
                $scope.errorMessage = response.data.message;
                $scope.successMessage = "";
            }
        }, function(error) {
            console.error("Error during login:", error);
            $scope.errorMessage = "An error occurred. Please try again later.";
        });
    };
});