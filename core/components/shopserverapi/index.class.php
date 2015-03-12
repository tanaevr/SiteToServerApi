<?php

/**
 * Class shopServerApiMainController
 */
abstract class shopServerApiMainController extends modExtraManagerController {
	/** @var shopServerApi $shopServerApi */
	public $shopServerApi;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('shopserverapi_core_path', null, $this->modx->getOption('core_path') . 'components/shopserverapi/');
		require_once $corePath . 'model/shopserverapi/shopserverapi.class.php';

		$this->shopServerApi = new shopServerApi($this->modx);
		$this->addCss($this->shopServerApi->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->shopServerApi->config['jsUrl'] . 'mgr/shopserverapi.js');
		$this->addHtml('
		<script type="text/javascript">
			shopServerApi.config = ' . $this->modx->toJSON($this->shopServerApi->config) . ';
			shopServerApi.config.connector_url = "' . $this->shopServerApi->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('shopserverapi:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends shopServerApiMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}
