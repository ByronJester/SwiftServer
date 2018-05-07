<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 		= 'AccountSetupWeb/index';
$route['404_override'] 					= '';
$route['translate_uri_dashes'] 	= FALSE;
$route[''] 											= 'AccountSetupMobile/register';
$route[''] 											= 'AccountSetupMobile/login';
$route[''] 											= 'AccountSetupMobile/getNames';
$route[''] 											= 'UserStatusMobile/postStatus';
$route[''] 											= 'UserStatusMobile/getNewsFeedData';
