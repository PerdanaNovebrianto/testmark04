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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/user'] = "user";
$route['admin/user/add'] = "user/add";
$route['admin/user/ActionAdd'] = "user/actionAdd";
$route['admin/user/delete/(:any)'] = "user/deleteUser/$1";
$route['admin/user/update/(:any)'] = "user/fetchSingle/$1";
$route['admin/user/ActionUpdate'] = "user/actionUpdate";

$route['admin/info'] = "info";
$route['admin/info/add'] = "info/add";
$route['admin/info/ActionAdd'] = "info/actionAdd";
$route['admin/info/delete/(:any)'] = "info/deleteInfo/$1";
$route['admin/info/update/(:any)'] = "info/fetchSingle/$1";
$route['admin/info/ActionUpdate'] = "info/actionUpdate/$1";

$route['admin/tips'] = "tips";
$route['admin/tips/add'] = "tips/add";
$route['admin/tips/ActionAdd'] = "tips/actionAdd";
$route['admin/tips/delete/(:any)'] = "tips/deleteTips/$1";
$route['admin/tips/update/(:any)'] = "tips/fetchSingle/$1";
$route['admin/tips/ActionUpdate'] = "tips/actionUpdate/$1";

$route['auth/login'] = "auth/loginUser";
$route['auth/actionRegister'] = "auth/actionRegisters";

$route['admin/chat'] = "chat";
$route['admin/chat/history'] = "chat/history";

$route['api/check_email'] = "api/check_email";
$route['api/login'] = "api/login";
$route['api/forgot_password'] = "api/forgot_password";
$route['api/register'] = "api/register";
$route['api/register_oauth'] = "api/register_oauth";
$route['api/update'] = "api/update_user";
$route['api/info'] = "api/info";
$route['api/info/(:any)'] = "api/detail_info/$1";
$route['api/tips'] = "api/tips";
$route['api/tips/(:any)'] = "api/detail_tips/$1";