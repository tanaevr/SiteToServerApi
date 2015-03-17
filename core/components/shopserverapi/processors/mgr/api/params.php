<?php
$output = '';
$func_name = $this->getProperty('name');
$func = array();
// $func['имя функции на сервере'] = array('массив данных');

// Получение списка акций
$func['get_actions'] = array();
$func['get_category'] = array();
$func['get_ingredients'] = array();
$func['get_products'] = array();

// Пользователь

// получение 4-значного кода в качестве пароля
$func['get_user_code'] = array(
	'phone' => '', // номер телефона пользователя куда будет отправлена смс с кодом доступа
	'send_sms' => 1
	);

$func['get_auth'] = array(
	'phone' => '',
	'password' => ''
	);

$func['get_user_orders'] = array(
	'phone' => '',
	'timestamp_start' => '',
	'timestamp_end' => ''
	);

$func['get_user_profile'] = array(
	'phone' => '79522713326',
	);

$func['get_user_data'] = array(
	'phone' => '79522713326',
	);

$func['set_newpass'] = array(
	'phone' => '79522713326',
	'password' => '0000'
	);


$func['send_order'] = array(
	'phone' => '',
	'name' => '', 
	'card' => '',
	'note' => '',
	'address' => '',
	'note_address' => '',
	'data' => '',
	'time' => '',
	'pay' => '',
	'products' => array(),
	'summa' => '',
	'sdacha' => '',
	'count_persone' => '',
	'urgency' => 1,
	'bonus' => 0,
	'referal_phone' => ''
	);



$output = $func[$func_name];
$output['func'] = $func_name;
$output['test'] = $this->getProperty('test');
$output = array_merge($output, $this->getProperty('property'));


return  json_encode($output);