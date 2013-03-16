<?php namespace Ext;

class VersionAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandToServeFor = 'version';

	public function go() {
		$helper = $this->container->getInstance('Ext\PropertyActionHelper');
		$helper->injectAction($this);
		$helper->go(static::$commandToServeFor);
	}

	public function usage() {
		return ("ext version\next version xx.xx.xx");
	}

	public function help() {
		return ("
ext version => get the version
ext version xx.xx.xx => set the version to xx.xx.xx
		");
	}
}

?>

