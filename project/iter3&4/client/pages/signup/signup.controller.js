app.controller("SignUpController", function ($scope, $http) {
    // Initialize the form data
    $scope.formData = {
        signup: '',
        fname: '',
        lname: '',
        dob: '',
        email: '',
        password: '',
        telno: '',
        address: '',
        city: '',
        postalcode: '',
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