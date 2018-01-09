<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['home'] = 'Home';
$route['get_home_page_journals'] = 'home/get_home_page_journals';
$route['validate_credentials'] = 'login/validate_credentials';
$route['about-us'] = "about_us";
$route['submit-manuscript'] = "submit_manuscript";
$route['contact-us'] = "contact_us";
$route['latest-articles'] = "latest_articles";
$route['admin'] = 'admin';
$route['login'] = 'login/index';
$route['(:any)/(:any)'] = 'journal_pages/index/$1/$2';
$route['dashboard'] = 'admin/dashboard';
$route['get_categories'] = 'admin/get_categories';
$route['get_journals'] = 'admin/get_journals';
$route['get_journal_posts'] = 'admin/get_journal_posts';
$route['get_journal_archives'] = 'admin/get_journal_archives';
$route['get_LatestArticles'] = 'admin/get_LatestArticles';

$route['update_latest_article'] = 'admin/update_latest_article';

$route['get_new_eb_members'] = 'admin/get_new_eb_members';
$route['insert_journal'] = 'admin/insert_journal';
$route['update_journal_page'] = 'admin/update_journal_page';
$route['update_eb_member'] = 'admin/update_eb_member';
$route['get_journals_volumes'] = 'admin/get_journals_volumes';
$route['update_archive'] = 'admin/update_archive';
$route['deleteEBmember'] = 'admin/deleteEBmember';
$route['deleteJournalArchive'] = 'admin/deleteJournalArchive';




/*$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;*/