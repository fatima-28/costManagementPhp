<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['all'] = 'welcome/index';

//Payment Type

 $route['addtype'] = 'PaymentTypeController/add';
 $route['ptstore'] = 'PaymentTypeController/store';
 $route['gettypes'] = 'PaymentTypeController/getAll';


//Currency

 $route['addcurrency'] = 'CurrencyController/add';
 $route['cstore'] = 'CurrencyController/store';
 $route['getcurrency'] = 'CurrencyController/getAll';
 
//Payment

 $route['addpayment'] = 'PaymentController/add';
 $route['pstore'] = 'PaymentController/store';
 $route['getpayments'] = 'PaymentController/getAll';
 $route['filterdata'] = 'PaymentController/filterData';
 
 




