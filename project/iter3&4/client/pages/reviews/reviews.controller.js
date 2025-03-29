app.controller("ReviewsController", function ($scope, $http, $rootScope) {
    $scope.reviews = [];
    $scope.errorMessage = '';

    $scope.fetchReviews = function() {
        $http.get('http://localhost:8000/reviews.php')
            .then(function(response) {
                $scope.reviews = response.data;

                if ($scope.reviews.length === 0) {
                    $scope.errorMessage = 'No reviews found.';
                } else {
                    $scope.errorMessage = '';
                }
            })
            .catch(function (error) {
                console.error('Error fetching reviews', error);
                $scope.errorMessage = 'Errore fetching reviews. Please try again later.';
            })
    };

    $scope.fetchReviews();

    $rootScope.$on('reviewUpdated', function() {
        $scope.fetchReviews()
    })
})

app.controller("ReviewFormController", function ($scope, $http, $rootScope) {
    $scope.formData = {};
    $scope.errorMessage = "";
    $scope.successMessage = "";


    // Function to request notification permission if not already granted
    function requestNotificationPermission() {
        if (Notification.permission !== "granted") {
            Notification.requestPermission().then(function(permission) {
                if (permission === "granted") {
                    console.log("Notification permission granted");
                } else {
                    console.log("Notification permission denied");
                }
            });
        }
    }

    // Function to display notification
    function showNotification(message) {
        if (Notification.permission === "granted") {
            new Notification(message);
        }
    }

    $scope.submitForm = function() {
        $http.post('http://localhost:8000/reviews.php', $scope.formData, { withCredentials: true})
            .then(function(response) {
                if (response.data.status === "success") {
                    $scope.successMessage = response.data.message;
                    $scope.errorMessage = '';

                    showNotification($scope.successMessage);

                    $rootScope.$broadcast('reviewUpdated');

                } else {
                    $scope.errorMessage = response.data.message;
                    $scope.successMessage = "";
                }
            })
            .catch(function (error) {
                console.error("Error creating review:", error);
                $scope.errorMessage = "An error ocurred creating review. Please try again later."
            })
    }

    requestNotificationPermission();
})