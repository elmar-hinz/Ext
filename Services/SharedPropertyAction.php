<?php namespace Ext;

class SharedPropertyAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'user, version, status, description';

	public function go() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		if(!$helper->validateContext()) return;
		$key = $this->getCalledCommand();
		switch($this->countCommands()) {
			case 0:
				$helper->printProperty($key);
				break;
			case 1:
				$helper->setProperty($key, $this->getCommand(0));
				break;
			default:
				$this->showSpecialHelp();
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

