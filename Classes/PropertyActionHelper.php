<?php namespace Ext;

/**
* Strategie pattern?
*/
class PropertyActionHelper {

	private $action;
	private $context;

	public function injectAction(\Ext\Action $action) {
		$this->action = $action;
		$this->context = $this->action->getContext();
	}

	public function validateContext() {
		if(!$this->context->isValid()) {
			$this->action->error('You are not in an extension.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function setProperty($key, $value) {
		$this->context->setProperty($key, $value);
		$this->printProperty($key);
	}

	public function printProperty($key) {
		print $this->context->getProperty($key) . chr(10);
	}

}

?>
