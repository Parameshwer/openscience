var app = angular.module('openScienceApp', 
    [
        'ngAnimate',
        'ui.grid',
        'ui.grid.moveColumns',
        'ui.grid.selection',
        'ui.grid.resizeColumns',
        'ngSanitize',
        'ui.bootstrap',
        'ui.grid.edit',
        'ui.router',
        'ui.grid.pagination'
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
            templateUrl:base_url+'public/angular-templates/MainCategories.html'            
        })
        .state("admin.Journals", {
            title: 'Journals',
            url: "/Journals",            
            templateUrl:base_url+'public/angular-templates/Journals.html'            
        })        
              
});
