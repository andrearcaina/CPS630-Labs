app.controller("HomeController", function ($scope, $http, $timeout) {
    $scope.items = [];
    $scope.filters = {
        'price-min': 0,
        'price-max': 3000,
        os: '',
        brand: ''
    };
    $scope.errorMessage = '';

    $scope.initSlider = function () {
        $timeout(function () {
            $("#price-range").slider({
                range: true,
                min: 0,
                max: 3000,
                values: [$scope.filters['price-min'], $scope.filters['price-max']],
                slide: function (event, ui) {
                    $timeout(function () {
                        $scope.filters['price-min'] = ui.values[0];
                        $scope.filters['price-max'] = ui.values[1];
                    });
                }
            });
        }, 0);
    };

    $scope.fetchItems = function (filters = {}) {
        console.log('Fetching items with filters:', filters);

        const PARAMS = {};
        if (filters['price-min']) PARAMS['price-min'] = filters['price-min'];
        if (filters['price-max']) PARAMS['price-max'] = filters['price-max'];
        if (filters.os) PARAMS.os = filters.os;
        if (filters.brand) PARAMS.brand = filters.brand;

        $http.get('http://localhost:8000/items.php', { params: PARAMS })
            .then(function (response) {
                $scope.items = response.data;

                if ($scope.items.length === 0) {
                    $scope.errorMessage = 'No items found.';
                } else {
                    $scope.errorMessage = '';
                }

                $timeout(function () {
                    $scope.makeItemsDraggable();
                }, 0);
            })
            .catch(function (error) {
                console.error('Error fetching items', error);
                $scope.errorMessage = 'Error fetching items. Please try again later.';
            });
    };

    $scope.applyFilters = function () {
        $scope.fetchItems($scope.filters);
    };

    $scope.makeItemsDraggable = function () {
        $(".card").draggable({
            revert: "invalid",
            cursor: "move",
            helper: "clone"
        });
    };

    $scope.initSlider();
    $scope.fetchItems();
});