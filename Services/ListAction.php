<?php namespace Ext;

class ListAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'list, show, info';

	public function go() {
		print_r($this->context->getProperties());
	}

	public function usage() {
		return ("ext list");
	}

	public function help() {
		return ("ext list => list all properties of ext_emconf.php");
	}
}

?>

