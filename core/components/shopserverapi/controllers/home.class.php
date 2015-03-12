<?php

/**
 * The home manager controller for shopServerApi.
 *
 */
class shopServerApiHomeManagerController extends shopServerApiMainController {
	/* @var shopServerApi $shopServerApi */
	public $shopServerApi;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('shopserverapi');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->shopServerApi->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->shopServerApi->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->shopServerApi->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->shopServerApi->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->shopServerApi->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->shopServerApi->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->shopServerApi->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "shopserverapi-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->shopServerApi->config['templatesPath'] . 'home.tpl';
	}
}
