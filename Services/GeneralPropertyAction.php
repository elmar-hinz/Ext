<?php namespace Ext;

class GeneralPropertyAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $argumentsToServeFor = 'property, get, set';

	public function handleArgument() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		switch($this->countArguments()) {
			case 1:
				if($this->getCalledArgument() == 'set') return FALSE;
				$helper->printProperty($this->getArgument(0));
				return TRUE;
				break;
			case 2:
				if($this->getCalledArgument() == 'get') return FALSE;
				$helper->setProperty($this->getArgument(0), $this->getArgument(1));
				return TRUE;
				break;
			default:
				return FALSE;
		}
	}

	public function usage() {
		return ("
			ext property mykey : get a property (alias get)
			ext property mykey myvalue : set a property (alias set)
		");
	}

	public function help() {
		return ("TODO");
	}
}

?>

