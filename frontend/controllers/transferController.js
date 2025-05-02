app.controller('TransferController', function($scope, $http, $location) {
    var user_id = localStorage.getItem('user_id');
    if (!user_id) {
        $location.path('/login');
        return;
    }

    $scope.transfer = {};
    $scope.success = "";
    $scope.error = "";

    $scope.submitTransfer = function() {
        var data = {
            user_id: user_id,
            to_account: $scope.transfer.to_account,
            amount: $scope.transfer.amount
        };
        $http.post('../backend/transfer.php', data)
            .then(function(response) {
                if (response.data.success) {
                    $scope.success = "Transfer successful!";
                    $scope.error = "";
                    $scope.transfer = {};
                } else {
                    $scope.error = response.data.message;
                    $scope.success = "";
                }
            }, function() {
                $scope.error = "Server error during transfer.";
                $scope.success = "";
            });
    };
});
