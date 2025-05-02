app.controller('AccountController', function($scope, $http, $location) {
    var user_id = localStorage.getItem('user_id');
    if (!user_id) {
        $location.path('/login');
        return;
    }

    $scope.account = {};
    $scope.error = "";

    $http.post('../backend/account.php', { user_id: user_id })
        .then(function(response) {
            if (response.data.success) {
                $scope.account = response.data.account;
            } else {
                $scope.error = "Could not fetch account details.";
            }
        }, function() {
            $scope.error = "Server error.";
        });
});
