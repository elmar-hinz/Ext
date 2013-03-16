<?php namespace Ext;

class GeneralPropertyAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'property, get, set';

	public function go() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		if(!$helper->validateContext()) return;
		switch($this->countCommands()) {
			case 1:
				if($this->getCalledCommand() != 'set')
					$helper->printProperty($this->getCommand(0));
				else 
					$this->showSpecialHelp();
				break;
			case 2:
				if($this->getCalledCommand() != 'get')
					$helper->setProperty(
						$this->getCommand(0),
						$this->getCommand(1));
				else 
					$this->showSpecialHelp();
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

