<?php namespace Ext;

abstract class Action implements ActionService {

	static protected $parentActionToServeFor = NULL;
	static protected $commandsToServeFor = '';

	protected $container = NULL;
	protected $context = NULL;
	private $parentObject = NULL;
	private $commands = array();
	private $calledCommand = '';

	public abstract function usage();
	public abstract function help();
	public abstract function go();

	public function __construct(\Cool\Container $container) { 
		$this->container = $container; 
		$this->context = $container->getInstance('Ext\ExtensionContext');
	}
	public function setCalledCommand($command) { $this->calledCommand = $command; } 
	public function getCalledCommand() { return $this->calledCommand; } 
	public function countCommands() { return count($this->commands); }
	public function setCommands($commands) { $this->commands = $commands; } 
	public function getCommands() { return $this->commands; }
	public function getCommand($index) { 
		if(isset($this->commands[$index])) return $this->commands[$index];
	}
	public function getContext() { return $this->context; }

	public static function canServe($commandSet) {
		$parentMatches = get_class($commandSet['parent']) == static::$parentActionToServeFor;
		$commands = array_map('trim', explode(',', static::$commandsToServeFor));
		if($parentMatches) foreach($commands as $command) 
			if($command == $commandSet['command']) return TRUE;
		return FALSE;
	}

	public function handleSubcommand() {
		$commands = $this->commands;
		$command = array_shift($commands);
		try {
			$commandSet = array('parent' => $this, 'command' => $command);
			$service = $this->container->getService('Ext\Action', $commandSet); 
			$service->setCalledCommand($command);
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

	public function error($msg) {
		print 'ERROR' . $msg . chr(10);
	}

}

?>

