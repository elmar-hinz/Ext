<?php

class Ext {

	static public function main($argv) {
		$moduleBase = __DIR__.'/../..';
		require_once($moduleBase.'/Cool/Classes/AutoLoader.php');
		$loader = new \Cool\AutoLoader();
		$loader->addModuleBase($moduleBase);
		$loader->go();
		$loader = new \Cool\DedicatedDirectoriesLoader();
		$loader->addModuleBase($moduleBase);
		$loader->go();
		$container = new \Cool\Container();
		$action = $container->getInstance('Ext\MainAction');
		array_shift($argv);
		$action->setArguments($argv);
		$action->go();
	}
}

?>
