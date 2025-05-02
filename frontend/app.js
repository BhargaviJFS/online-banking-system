var app = angular.module('bankApp', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider
        .when('/login', {
            templateUrl: 'templates/login.html',
            controller: 'AuthController'
        })
        .when('/register', {
            templateUrl: 'templates/register.html',
            controller: 'AuthController'
        })
        .when('/forgot', {
            templateUrl: 'templates/forgot.html',
            controller: 'AuthController'
        })
        .when('/dashboard', {
            templateUrl: 'templates/dashboard.html',
            controller: 'DashboardController'
        })
        .when('/balance', {
            templateUrl: 'templates/balance.html',
            controller: 'BalanceController'
        })
        .when('/transfer', {
            templateUrl: 'templates/transfer.html',
            controller: 'TransferController'
        })
        .when('/transactions', {
            templateUrl: 'templates/transactions.html',
            controller: 'TransactionsController'
        })
        .when('/account', {
            templateUrl: 'templates/account.html',
            controller: 'AccountController'
        })
        .when('/profile', {
            templateUrl: 'templates/profile.html',
            controller: 'ProfileController'
        })
        .when('/reset/:token', {
            templateUrl: 'templates/reset_password.html',
            controller: 'ResetPasswordController'
        })
        .otherwise({
            redirectTo: '/login'
        });
});
