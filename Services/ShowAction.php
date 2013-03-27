<?php namespace Ext;

class ShowAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $argumentsToServeFor = 'show, info';

	public function handleArgument() {
		if ($this->countArguments() == 0) {
			print_r($this->getContextProperties());
			return TRUE;
		} 
		return FALSE;
	}

	public function usage() {
		return ("
			ext show: show settings (alias info)
		");
	}

	public function help() {
		return ("ext show => list all properties of ext_emconf.php");
	}

}

?>

