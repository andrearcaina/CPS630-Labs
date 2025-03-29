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
                    $scope.draggable();
                }, 0);
            })
            .catch(function (error) {
                console.error('Error fetching items', error);
                $scope.errorMessage = 'Error fetching items. Please try again later.';
            });
    };

    $scope.filterItems = function () {
        $scope.fetchItems($scope.filters);
    };

    $scope.draggable = function () {
        $(".card").draggable({
            revert: "invalid",
            cursor: "move",
            helper: "clone"
        });

    $("#cart").droppable({
        accept: ".card", // Only accepts items of the class card
        drop: function(event, ui) {
            const item_id = ui.draggable.attr("data-id");
            console.log(item_id);
            //alert("Added item: " +item_id+" to the cart!"); // Temporary alert, will be replaced by API call
            $http.post('http://localhost:8000/cart.php', { item_id: item_id }, { withCredentials: true })
                .then(function(response) {
                    console.log('Item added to cart:', response.data);
                })
                .catch(function(error) {
                    console.error('Error adding item to cart:', error);
                });
        }
    });

    };

    $scope.initSlider();
    $scope.fetchItems();
});