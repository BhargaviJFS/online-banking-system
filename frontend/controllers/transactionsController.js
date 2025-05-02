app.controller('TransactionsController', function($scope, $http, $location) {
    var user_id = localStorage.getItem('user_id');
    if (!user_id) {
        $location.path('/login');
        return;
    }

    $scope.transactions = [];
    $scope.error = "";

    $http.post('../backend/transactions.php', { user_id: user_id })
        .then(function(response) {
            if (response.data.success) {
                $scope.transactions = response.data.transactions;
            } else {
                $scope.error = "Could not fetch transactions.";
            }
        }, function() {
            $scope.error = "Server error.";
        });
});
