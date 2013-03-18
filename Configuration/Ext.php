<?php

class Ext {

	static public function main($argv) {
		date_default_timezone_set('UTC');
		$moduleBase = __DIR__.'/../..';
		require_once($moduleBase.'/Cool/Classes/AutoLoader.php');
		require_once($moduleBase.'/Typo3ExtensionUtils/lib/autoload.php');
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
