app.controller('BalanceController', function($scope, $http, $location) {
    var user_id = localStorage.getItem('user_id');
    if (!user_id) {
        $location.path('/login');
        return;
    }

    $scope.balance = null;
    $scope.error = "";

    $http.post('../backend/account.php', { user_id: user_id })
        .then(function(response) {
            if (response.data.success) {
                $scope.balance = response.data.account.balance;
            } else {
                $scope.error = "Could not fetch balance.";
            }
        }, function() {
            $scope.error = "Server error.";
        });
});
