<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller']   = 'welcome';
$route['404_override']         = 'welcome';
$route['translate_uri_dashes'] = FALSE;

$route['([a-zA-Z0-9_-]+)'] = 'portal/index/table/$1';
$route['([a-zA-Z0-9_-]+)/(:num)'] = 'portal/index/table/$1/id/$2';