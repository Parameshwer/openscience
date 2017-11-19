var app = angular.module('openScienceApp', [
    'ui.router',    
    'textAngular',
    'ngSanitize',
    'ui.grid',
    'ui.grid.pagination',
    'ui.grid.autoResize'
]);

var base_url = "http://localhost/openscience/";

 app.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when("", "/admin");

    $stateProvider
        .state("admin", {
            url: "/admin",
            abstract: true,
            templateUrl: base_url+'public/angular-templates/admin_home.html',
        })
        .state("admin.Dashboard", {
            title: 'Dashboard',
            url: "/Dashboard",
            controller: 'dashboardController',
            templateUrl: base_url+'public/angular-templates/dashboard_info.html',
            controllerAs: 'dashboardCtrl'
        })
        .state("admin.MainCategories", {
            title: 'MainCategories',
            url: "/MainCategories",
            controller: 'maincategoryController',
            templateUrl:base_url+'public/angular-templates/MainCategories.html',
            controllerAs: 'MaincategoryCtrl'
        })
              
});
