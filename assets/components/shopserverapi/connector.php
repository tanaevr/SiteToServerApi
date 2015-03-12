<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var shopServerApi $shopServerApi */
$shopServerApi = $modx->getService('shopserverapi', 'shopServerApi', $modx->getOption('shopserverapi_core_path', null, $modx->getOption('core_path') . 'components/shopserverapi/') . 'model/shopserverapi/');
$modx->lexicon->load('shopserverapi:default');

// handle request
$corePath = $modx->getOption('shopserverapi_core_path', null, $modx->getOption('core_path') . 'components/shopserverapi/');
$path = $modx->getOption('processorsPath', $shopServerApi->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));
