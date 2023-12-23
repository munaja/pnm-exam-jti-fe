<?php

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['auth/using-google'] = 'auth/gOAuth';
$route['api/phone-number']['post'] = 'api/phonenumber';
$route['api/phone-number/(:num)']['patch'] = 'api/phonenumber/$1';
$route['api/phone-number/(:num)']['delete'] = 'api/phonenumber/$1';
$route['api/phone-number']['get'] = 'api/phonenumber';
$route['api/phone-number/(:num)']['get'] = 'api/phonenumber/detail/$1';
$route['api/phone-number/gen-random']['get'] = 'api/phonenumber/genrandom';
