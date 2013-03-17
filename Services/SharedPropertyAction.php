<?php namespace Ext;

class SharedPropertyAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $argumentsToServeFor = 'user, version, status, description';

	public function handleArgument() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		$key = $this->getCalledArgument();
		switch($this->countArguments()) {
			case 0:
				$helper->printProperty($key);
				return TRUE;
				break;
			case 1:
				$helper->setProperty($key, $this->getArgument(0));
				return TRUE;
				break;
		}
	}

	public function usage() {
		return ("TODO");
	}

	public function help() {
		return ("TODO");
	}
}

?>

