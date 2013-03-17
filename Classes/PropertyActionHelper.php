<?php namespace Ext;

/**
* Strategie pattern?
*/
class PropertyActionHelper {

	private $action;

	public function injectAction(\Ext\Action $action) {
		$this->action = $action;
	}

	public function validateContext() {
		if(!$this->action->isContextValid()) {
			$this->action->error('You are not in an extension.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function setProperty($key, $value) {
		$this->action->setContextProperty($key, $value);
		$this->printProperty($key);
	}

	public function printProperty($key) {
		print $this->action->getContextProperty($key) . chr(10);
	}

}

?>
