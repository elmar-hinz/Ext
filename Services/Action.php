<?php namespace Ext;

abstract class Action implements \Cool\Service {

	protected $container;
	protected $commands;
	protected static $parentAction = '';
	protected static $command = '';

	public function __construct(\Cool\Container $container) {
		$this->container = $container;
	}

	public static function canServe($commandSet) {
		return (get_class($commandSet['parent']) == self::$parentAction 
		&& $commandSet['command'] == self::$command);
	}

	public function setCommands($commands) {
		$this->commands = $commands;
	}

	public function getCommands() {
		return $this->commands;
	}

	public abstract function go();

	public function handleSubcommand() {
		$commands = $this->commands;
		$command = array_shift($commands);
		try {
			$commandSet = array('parent' => $this, 'command' => $command);
			$service = $this->container->getService('Ext\Action', $commandSet); 
			$service->setCommands($commands);
			$service->go();
		} catch(\Exception $e) {
			print "Usage:\n";
			print "======\n\n";
			print $this->usage();	
			print "\n\n";
			print "Help:\n";
			print "======\n\n";
			print $this->help();	
			print "\n\n";
		}
	}

	public abstract function usage();

	public abstract function help();

}
	

?>

