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
$route['default_controller'] = 'admin@Index/index';
$route['mobile-index'] = 'admin@MobileIndex/index';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = "admin/Login/index";
$route['logout'] = "admin/Login/logout";
$route['account-manage'] = "admin/Index/account_manage";
$route['recharge'] = "admin/Index/recharge";
$route['recharge-list/(:num)'] = "admin/Index/recharge_list";
$route['player-manage'] = "admin/Index/player_manage";
$route['proxy-recharge'] = "admin/Index/proxy_recharge";

$route['proxy-recharge-list/(:num)'] = "admin/Index/proxy_recharge_list";

$route['modify-passwd'] = "admin/Index/modify_passwd";

$route['add-proxy-page'] = "admin/Index/add_proxy_page";
$route['add-proxy'] = "admin/Index/add_proxy";
$route['proxy-manage'] = "admin/Index/proxy_manage";

$route['proxy-list/(:num)'] = "admin/Index/proxy_list";
$route['proxy-status'] = "admin/Index/proxy_status";


$route['mobile-login'] = "admin/MobileLogin/index";
$route['mobile-index'] = "admin/MobileIndex/index";


$route['mobile-player-recharge'] = "admin/MobileIndex/player_recharge";
$route['mobile-recharge-list'] = "admin/MobileIndex/recharge_list";
$route['mobile-proxy-recharge'] = "admin/MobileIndex/proxy_recharge";
$route['mobile-proxy-recharge-list'] = "admin/MobileIndex/proxy_recharge_list";
$route['mobile-proxy-manage-list'] = "admin/MobileIndex/proxy_manage_list";
$route['mobile-account-manage'] = "admin/MobileIndex/account_manage";
$route['mobile-add-proxy'] = "admin/MobileIndex/add_proxy";


$route['mobile-logout'] = "admin/MobileLogin/logout";