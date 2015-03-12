<?php

$settings = array();

$tmp = array(
	'url_server' => array(
		'xtype' => 'textfield',
		'value' => true,
		'area' => 'shopserverapi_main',
	),
	'username_server' => array(
		'xtype' => 'textfield',
		'value' => true,
		'area' => 'shopserverapi_main',
	),
	'password_server' => array(
		'xtype' => 'textfield',
		'value' => true,
		'area' => 'shopserverapi_main',
	),
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'shopserverapi_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
