<?php namespace Ext;

abstract class Action implements ActionService {

	static protected $parentActionToServeFor = NULL;
	static protected $commandToServeFor = NULL;

	protected $container = NULL;
	private $parentObject = NULL;
	private $commands = array();

	public abstract function usage();
	public abstract function help();
	public abstract function go();

	public function __construct(\Cool\Container $container) { $this->container = $container; }
	public function setCommands($commands) { $this->commands = $commands; } 
	public function getCommands() { return $this->commands; }

	// Deliberately not part of ActionService interface
	// Maybe have a dedicated ContainerAccess interface
	public function getContainer() { return $this->container; }

	public static function canServe($commandSet) {
		return get_class($commandSet['parent']) == static::$parentActionToServeFor 
		&& $commandSet['command'] == static::$commandToServeFor;
	}

	public function handleSubcommand() {
		$commands = $this->commands;
		$command = array_shift($commands);
		try {
			$commandSet = array('parent' => $this, 'command' => $command);
			$service = $this->container->getService('Ext\Action', $commandSet); 
			$service->setCommands($commands);
			$service->go();
		} catch(\Exception $e) {
			$this->showSpecialHelp();
		}
	}

	public function showGeneralHelp() {
		print "ext help";
	}


	public function showSpecialHelp() {
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
	

?>

