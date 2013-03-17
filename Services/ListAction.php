<?php namespace Ext;

class ListAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'list, show, info';

	public function handleCommand() {
		if ($this->countCommands() == 0) {
			print_r($this->getContextProperties());
			return TRUE;
		} 
		return FALSE;
	}

	public function usage() {
		return ("ext list");
	}

	public function help() {
		return ("ext list => list all properties of ext_emconf.php");
	}

}

?>

