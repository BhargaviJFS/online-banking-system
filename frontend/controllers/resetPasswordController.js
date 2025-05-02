app.controller('ResetPasswordController', function($scope, $http, $location, $routeParams) {
    $scope.reset = {};
    $scope.success = "";
    $scope.error = "";

    $scope.submitReset = function() {
        var data = {
            token: $routeParams.token,
            password: $scope.reset.password
        };
        $http.post('../backend/reset_password.php', data)
            .then(function(response) {
                if (response.data.success) {
                    $scope.success = "Password reset successful. Please log in.";
                    $scope.error = "";
                } else {
                    $scope.error = response.data.message || "Reset failed.";
                    $scope.success = "";
                }
            }, function() {
                $scope.error = "Server error.";
                $scope.success = "";
            });
    };
});
