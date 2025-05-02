app.controller('AuthController', function($scope, $http, $location) {
    $scope.user = {};

    $scope.login = function() {
        $http.post('../backend/login.php', $scope.user)
            .then(function(response) {
                if (response.data.success) {
                    localStorage.setItem('user_id', response.data.user_id);
                    localStorage.setItem('name', response.data.name);
                    $location.path('/dashboard');
                } else {
                    $scope.error = response.data.message;
                }
            });
    };

    $scope.register = function() {
        $http.post('../backend/register.php', $scope.user)
            .then(function(response) {
                if (response.data.success) {
                    $location.path('/login');
                } else {
                    $scope.error = response.data.message;
                }
            });
    };

    $scope.forgotPassword = function() {
        $http.post('../backend/forgot_password.php', $scope.user)
            .then(function(response) {
                if (response.data.success) {
                    $scope.info = response.data.message + " (Demo link: " + response.data.reset_link + ")";
                } else {
                    $scope.error = response.data.message;
                }
            });
    };
});
