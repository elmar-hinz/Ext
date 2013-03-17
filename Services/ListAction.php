<?php namespace Ext;

class ListAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $argumentsToServeFor = 'list, show, info';

	public function handleArgument() {
		if ($this->countArguments() == 0) {
			print_r($this->getContextProperties());
			return TRUE;
		} 
		return FALSE;
	}

	public function usage() {
		return ("
			ext list : list settings (alias show, info)
		");
	}

	public function help() {
		return ("ext list => list all properties of ext_emconf.php");
	}

}

?>

