<?php namespace Ext;

class TerAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $argumentsToServeFor = 'ter';

	public function handleArgument() {
		return $this->handleSubArgument();
	}

	public function usage() {
		return "ext ter: nothing happens ";
	}

	public function help() {
		return 'TODO';
	}
	

}

?>

