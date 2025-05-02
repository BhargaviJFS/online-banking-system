app.controller('DashboardController', function($scope, $http, $location) {
    var user_id = localStorage.getItem('user_id');
    if (!user_id) {
        $location.path('/login');
        return;
    }

    $scope.dashboard = {};
    $scope.error = "";

    $http.post('../backend/dashboard.php', { user_id: user_id })
        .then(function(response) {
            if (response.data.success) {
                $scope.dashboard.user = response.data.user;
                $scope.dashboard.account = response.data.account;
                $scope.dashboard.transactions = response.data.transactions;
            } else {
                $scope.error = "Failed to load dashboard data.";
            }
        }, function() {
            $scope.error = "Server error loading dashboard.";
        });

    $scope.logout = function() {
        localStorage.clear();
        $location.path('/login');
    };
});
