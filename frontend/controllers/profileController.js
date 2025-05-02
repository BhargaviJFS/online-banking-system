app.controller('ProfileController', function($scope, $http, $location) {
    var user_id = localStorage.getItem('user_id');
    if (!user_id) {
        $location.path('/login');
        return;
    }

    $scope.profile = {};
    $scope.success = "";
    $scope.error = "";

    $http.post('../backend/profile.php', { user_id: user_id })
        .then(function(response) {
            if (response.data.success) {
                $scope.profile = response.data.profile;
            } else {
                $scope.error = "Failed to load profile.";
            }
        }, function() {
            $scope.error = "Server error loading profile.";
        });

    $scope.updateProfile = function() {
        var data = {
            user_id: user_id,
            name: $scope.profile.name,
            email: $scope.profile.email,
            update: true
        };
        $http.post('../backend/profile.php', data)
            .then(function(response) {
                if (response.data.success) {
                    $scope.success = "Profile updated successfully.";
                    $scope.error = "";
                } else {
                    $scope.error = response.data.message || "Update failed.";
                    $scope.success = "";
                }
            }, function() {
                $scope.error = "Server error updating profile.";
                $scope.success = "";
            });
    };
});
