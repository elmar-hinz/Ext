<?php namespace Ext;

abstract class Action implements \Cool\Service {

	protected $container;
	protected $arguments;
	protected static $parentAction = '';
	protected static $command = '';

	public function __construct(\Cool\Container $container) {
		$this->container = $container;
	}

	public static function canServe($commandSet) {
		return (get_class($commandSet['parent']) == self::$parentAction 
		&& $commandSet['command'] == self::$command);
	}

	public function setArguments($arguments) {
		$this->arguments = $arguments;
	}

	public function getArguments() {
		return $this->arguments;
	}

	public abstract function go();

	public function handleSubcommand() {
		$arguments = $this->arguments;
		$command = array_shift($arguments);
		$commandSet = array('parent' => $this, 'command' => $command);
		$service = $this->container->getService('Ext\Action', $commandSet); 
		$service->setArguments($arguments);
		$service->go();
	}

}
	

?>

