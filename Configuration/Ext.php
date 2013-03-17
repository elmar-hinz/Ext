<?php

class Ext {

	static public function main($argv) {
		$mb = __DIR__.'/../..';
		require_once($mb.'/Cool/Classes/AutoLoader.php');
		$loader = new \Cool\AutoLoader();
		$loader->addModuleBase($mb);
		$loader->go();
		$loader = new \Cool\DedicatedDirectoriesLoader();
		$loader->addModuleBase($mb);
		$loader->go();
		$container = new \Cool\Container();
		$action = $container->getInstance('Ext\MainAction');
		array_shift($argv);
		$action->setArguments($argv);
		$action->go();
	}
}

?>
