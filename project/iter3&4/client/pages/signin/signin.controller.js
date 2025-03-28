app.controller("SignInController", function ($scope, $http) {
    // Initialize the form data
    $scope.formData = {
        signin: '',
        email: '',
        password: '',
    };
    // Submit function
    $scope.submitForm = function () {
        $http.post('http://localhost:8000/auth.php', $scope.formData)
            .then(function (response) {
                if (response.data.redirect) {
                    window.location.href = response.data.redirect;
                } else {
                    $scope.responseMessage = response.data.message;
                }
            })
            .catch(function(error) {
                $scope.responseMessage = "Error submitting Form";
                console.error('Error', error);
            })
    }
})