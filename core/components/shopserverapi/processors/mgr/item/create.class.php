<?php

/**
 * Create an Item
 */
class shopServerApiItemCreateProcessor extends modObjectCreateProcessor {
	public $objectType = 'shopServerApiItem';
	public $classKey = 'shopServerApiItem';
	public $languageTopics = array('shopserverapi');
	//public $permission = 'create';


	/**
	 * @return bool
	 */
	public function beforeSet() {
		$name = trim($this->getProperty('name'));
		if (empty($name)) {
			$this->modx->error->addField('name', $this->modx->lexicon('shopserverapi_item_err_name'));
		}
		elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
			$this->modx->error->addField('name', $this->modx->lexicon('shopserverapi_item_err_ae'));
		}

		return parent::beforeSet();
	}

}

return 'shopServerApiItemCreateProcessor';
