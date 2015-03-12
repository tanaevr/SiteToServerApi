<?php

if ($object->xpdo) {
	/** @var modX $modx */
	$modx =& $object->xpdo;

	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			$modelPath = $modx->getOption('shopserverapi_core_path', null, $modx->getOption('core_path') . 'components/shopserverapi/') . 'model/';
			$modx->addPackage('shopserverapi', $modelPath);

			$manager = $modx->getManager();
			$objects = array(
				//'shopServerApiItem',
			);
			foreach ($objects as $tmp) {
				$manager->createObjectContainer($tmp);
			}
			break;

		case xPDOTransport::ACTION_UPGRADE:
			break;

		case xPDOTransport::ACTION_UNINSTALL:
			break;
	}
}
return true;
