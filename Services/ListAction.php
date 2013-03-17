<?php namespace Ext;

class ListAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'list, show, info';

	public function go() {
		if(!$this->isContextValid()) {
			$this->error('You are not in an extension.');
		} else if ($this->countCommands() == 0) {
			print_r($this->getContextProperties());
		} else {
			$this->showSpecialHelp();
		}
	}

	public function usage() {
		return ("ext list");
	}

	public function help() {
		return ("ext list => list all properties of ext_emconf.php");
	}
}

?>

