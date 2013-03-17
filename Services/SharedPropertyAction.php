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
		return ("
			ext user : get the TER username
			ext user myname : set the TER username
			ext version : get the version
			ext version xx.xx.xx: set the extension version xx.xx.xx
			ext status : get the status 
			ext status alpha : set the status to alpha
			ext description : get the description
			ext description 'my text here' : set the description 
	");
	}

	public function help() {
		return ("TODO");
	}
}

?>

