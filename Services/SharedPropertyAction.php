<?php namespace Ext;

class SharedPropertyAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'user, version, status, description';

	public function handleCommand() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		$key = $this->getCalledCommand();
		switch($this->countCommands()) {
			case 0:
				$helper->printProperty($key);
				return TRUE;
				break;
			case 1:
				$helper->setProperty($key, $this->getCommand(0));
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

