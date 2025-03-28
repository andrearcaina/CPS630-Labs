app.controller('SignUpController', function($scope, $http, $location) {
    $scope.formData = {};
    $scope.errorMessage = "";
    $scope.successMessage = "";

    $scope.submitForm = function() {
        $scope.formData.signup = 1;

        $http.post('http://localhost:8000/auth.php', $scope.formData, { withCredentials: true }).then(function(response) {
            if (response.data.status === "success") {
                $scope.successMessage = response.data.message;
                $scope.errorMessage = "";

                $location.path('/signin');
            } else {
                $scope.errorMessage = response.data.message;
                $scope.successMessage = "";
            }
        }, function(error) {
            console.error("Error during signup:", error);
            $scope.errorMessage = "An error occurred. Please try again later.";
        });
    };
});