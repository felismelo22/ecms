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
/*admin*/
$route['admin']                         = 'admin';
$route['admin/user_edit/(:any)']        = 'admin/user_edit/$1';
$route['admin/content_category/(:any)'] = 'admin/content_category/$1';


/*user*/
$route['user']                  = 'user';
$route['user/list_edit/(:any)'] = 'user/list_edit/$1';
$route['user/list/(:any)']      = 'user/list/$1';
$route['user/check_exist']      = 'user/check_exist';

/*content*/
$route['content/cat']             = 'content/content_cat';
$route['content/cat_list/(:any)'] = 'content/cat_list/$1';
$route['content/cat_edit/(:any)'] = 'content/cat_edit/$1';

/*crud*/
$route['crud/list_edit/(:any)'] = 'crud/list_edit/$1';

/*default*/
$route['default_controller']      = 'home';
// $route['404_override']         = '';
// $route['translate_uri_dashes'] = FALSE;
