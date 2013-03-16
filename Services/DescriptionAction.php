<?php namespace Ext;

class DescriptionAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandToServeFor = 'description';

	public function go() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		$helper->go(static::$commandToServeFor);
	}

	public function usage() {
		return ("ext description\next description 'your text'");
	}

	public function help() {
		return ("
ext description => get the description
ext description 'your text' => set the description
		");
	}
}

?>

