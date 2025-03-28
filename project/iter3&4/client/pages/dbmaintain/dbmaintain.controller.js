app.controller("DbMaintainController", function ($scope, $http) {
    $scope.tables = ["item", "trip", "truck", "users", "shopping", "stores", "inventory"];
    $scope.selectedTable = "";
    $scope.records = []; 
    $scope.newRecord = {}; 
    $scope.formFields = [];
    $scope.errorMessage = "";
    $scope.successMessage = "";

    // Fetch records for the selected table
    $scope.fetchRecords = function () {
        if (!$scope.selectedTable) return;

        $http.get('http://localhost:8000/crud.php', { params: { action: 'select', table: $scope.selectedTable } })
            .then(function (response) {
                if (response.data.status === "success") {
                    $scope.records = response.data.data;
                    $scope.errorMessage = "";
                } else {
                    $scope.records = [];
                    $scope.errorMessage = response.data.message;
                }
            })
            .catch(function (error) {
                console.error("Error fetching records:", error);
                $scope.errorMessage = "Error fetching records.";
            });
    };

    $scope.updateFormFields = function () {
        if (!$scope.selectedTable) {
            $scope.formFields = [];
            return;
        }
    
        $http.get('http://localhost:8000/crud.php', { params: { action: 'select', table: $scope.selectedTable } })
            .then(function (response) {
                if (response.data.status === "success" && response.data.data.length > 0) {
                    $scope.formFields = Object.keys(response.data.data[0]);
                    $scope.newRecord = {};
                } else {
                    $scope.formFields = [];
                }
            })
            .catch(function (error) {
                console.error("Error fetching form fields:", error);
                $scope.formFields = [];
            });
    };

    $scope.insertRecord = function () {
        const payload = {
            action: "insert",
            table: $scope.selectedTable,
            fields: $scope.newRecord
        };

        console.log("Inserting record:", payload);

        $http.post('http://localhost:8000/crud.php', payload)
            .then(function (response) {
                if (response.data.status === "success") {
                    $scope.successMessage = response.data.message;
                    $scope.newRecord = {}; 
                    $scope.fetchRecords(); 
                } else {
                    $scope.errorMessage = response.data.message;
                }
            })
            .catch(function (error) {
                console.error("Error inserting record:", error);
                $scope.errorMessage = "Error inserting record.";
            });
    };

    $scope.deleteRecord = function (record) {
        const payload = {
            action: "delete",
            table: $scope.selectedTable,
            record: record
        };
    
        console.log("Deleting record:", payload);
    
        $http.post('http://localhost:8000/crud.php', payload)
            .then(function (response) {
                console.log("Delete response:", response.data);
                if (response.data.status === "success") {
                    $scope.successMessage = response.data.message;
                    $scope.fetchRecords(); // Refresh the table after deletion
                } else {
                    $scope.errorMessage = response.data.message;
                }
            })
            .catch(function (error) {
                console.error("Error deleting record:", error);
                $scope.errorMessage = "Error deleting record.";
            });
    };

    $scope.editingCell = {};

    $scope.enableEdit = function (record, key) {
        $scope.editingCell = { record, key };
    };

    $scope.isEditing = function (record, key) {
        return $scope.editingCell.record === record && $scope.editingCell.key === key;
    };

    $scope.updateRecord = function (record, key) {
        const payload = {
            action: "update",
            table: $scope.selectedTable,
            record: record,
            column: key, 
            value: record[key]
        };
    
        console.log("Updating record with payload:", payload);
    
        $http.post('http://localhost:8000/crud.php', payload, {
            headers: { 'Content-Type': 'application/json' }
        })
            .then(function (response) {
                console.log("Update response:", response.data);
                if (response.data.status === "success") {
                    $scope.successMessage = response.data.message;
                } else {
                    $scope.errorMessage = response.data.message;
                }
            })
            .catch(function (error) {
                console.error("Error updating record:", error);
                $scope.errorMessage = "Error updating record.";
            })
            .finally(function () {
                $scope.editingCell = {};
            });
    };

    $scope.$watch("selectedTable", function () {
        $scope.fetchRecords();
        $scope.updateFormFields();
    });
});

app.filter('capitalize', function () {
    return function (input) {
        if (!input) return '';
        return input.charAt(0).toUpperCase() + input.slice(1).toLowerCase();
    };
});