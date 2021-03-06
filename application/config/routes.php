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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['user/login'] = 'user/login';
$route['user/logout'] = 'user/logout';
$route['user/list_all'] = 'user/list_all';
$route['user/create'] = 'user/create';
$route['user/edit/(:num)'] = 'user/edit/$1';
$route['user/delete/(:num)'] = 'user/delete/$1';

$route['faculty/list_all'] = 'faculty/list_all';
$route['faculty/create'] = 'faculty/create';
$route['faculty/edit/(:num)'] = 'faculty/edit/$1';
$route['faculty/delete/(:num)'] = 'faculty/delete/$1';

$route['course/list_all'] = 'course/list_all';
$route['course/create'] = 'course/create';
$route['course/edit/(:num)'] = 'course/edit/$1';
$route['course/delete/(:num)'] = 'course/delete/$1';

$route['year/list_all'] = 'year/list_all';
$route['year/create'] = 'year/create';
$route['year/edit/(:num)'] = 'year/edit/$1';
$route['year/delete/(:num)'] = 'year/delete/$1';

$route['report/list_all'] = 'report/list_all';
$route['report/create'] = 'report/create';
$route['report/edit/(:num)'] = 'report/edit/$1';
$route['report/delete/(:num)'] = 'report/delete/$1';
$route['report/download/(:num)'] = 'report/download/$1';
$route['report/view/(:num)'] = 'report/view/$1';
$route['report/approve/(:num)'] = 'report/approve/$1';
$route['report/comment/(:num)'] = 'report/comment/$1';
