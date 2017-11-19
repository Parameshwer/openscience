var app = angular.module('openScienceApp',['ngRoute']);
app.config(['$routeProvider', function($routeProvider){
	console.log($routeProvider);
	$routeProvider.when('/',{
		title: 'Open Science Publications Login',
		templateUrl: 'partials/login.html'
	}).when('/Dashboard', {
		title: 'Open Science Publications Dashboard',
		templateUrl: 'partials/dashboard.html'
	}).when('/CreateMainCategory', {
		title: 'Create Main Category',
		templateUrl: 'partials/main-category.html'
	}).when('/CreateJournal', {
		title: 'Create Journal',
		templateUrl: 'partials/create-journal.html'
	}).when('/CreateJournalPost', {
		title: 'Create Journal Post',
		templateUrl: 'partials/journal-post.html'
	}).when('/AllPosts', {
		title: 'All Posts',
		templateUrl: 'partials/all-posts.html'
	}).otherwise({
		redirectTo: '/dsdsds'
	});
}]);
