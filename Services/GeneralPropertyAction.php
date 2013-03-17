<?php namespace Ext;

class GeneralPropertyAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'property, get, set';

	public function handleCommand() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		switch($this->countCommands()) {
			case 1:
				if($this->getCalledCommand() == 'set') return FALSE;
				$helper->printProperty($this->getCommand(0));
				return TRUE;
				break;
			case 2:
				if($this->getCalledCommand() == 'get') return FALSE;
				$helper->setProperty($this->getCommand(0), $this->getCommand(1));
				return TRUE;
				break;
			default:
				return FALSE;
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

