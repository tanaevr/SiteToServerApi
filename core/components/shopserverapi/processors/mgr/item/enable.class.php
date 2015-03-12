<?php

/**
 * Enable an Item
 */
class shopServerApiItemEnableProcessor extends modObjectProcessor {
	public $objectType = 'shopServerApiItem';
	public $classKey = 'shopServerApiItem';
	public $languageTopics = array('shopserverapi');
	//public $permission = 'save';


	/**
	 * @return array|string
	 */
	public function process() {
		if (!$this->checkPermissions()) {
			return $this->failure($this->modx->lexicon('access_denied'));
		}

		$ids = $this->modx->fromJSON($this->getProperty('ids'));
		if (empty($ids)) {
			return $this->failure($this->modx->lexicon('shopserverapi_item_err_ns'));
		}

		foreach ($ids as $id) {
			/** @var shopServerApiItem $object */
			if (!$object = $this->modx->getObject($this->classKey, $id)) {
				return $this->failure($this->modx->lexicon('shopserverapi_item_err_nf'));
			}

			$object->set('active', true);
			$object->save();
		}

		return $this->success();
	}

}

return 'shopServerApiItemEnableProcessor';
