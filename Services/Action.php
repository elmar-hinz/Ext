<?php namespace Ext;

abstract class Action implements ActionService {

	static protected $parentActionToServeFor = NULL;
	static protected $commandsToServeFor = '';

	protected $container = NULL;
	private $commands = array();
	private $calledCommand = '';

	public abstract function usage();
	public abstract function help();

	public function __construct(\Cool\Container $container) { 
		$this->container = $container; 
	}
	public function setCalledCommand($command) { $this->calledCommand = $command; } 
	public function getCalledCommand() { return $this->calledCommand; } 
	public function countCommands() { return count($this->commands); }
	public function setCommands($commands) { $this->commands = $commands; } 
	public function getCommands() { return $this->commands; }
	public function getCommand($index) { 
		if(isset($this->commands[$index])) return $this->commands[$index];
	}
	public static function canServe($commandSet) {
		$parentMatches = get_class($commandSet['parent']) == static::$parentActionToServeFor;
		$myCommands = array_map('trim', explode(',', static::$commandsToServeFor));
		if($parentMatches) foreach($myCommands as $myCommand) 
			if($myCommand == $commandSet['command']) return TRUE;
		return FALSE;
	}

	public function go() {
		if($this instanceOf ExtensionContextSensitivity && !$this->isContextValid()) {
				$this->exitError('You are not in an extension.');
		}
		if(!$this->handleCommand()) {
			$this->showSpecialHelp();
		}
	}

	public abstract function handleCommand(); 

	public function handleSubcommand() {
		$commands = $this->getCommands();
		$subCommand = array_shift($commands);
		try {
			$commandSet = array('parent' => $this, 'command' => $subCommand);
			$service = $this->container->getService('Ext\Action', $commandSet); 
			$service->setCalledCommand($subCommand);
			$service->setCommands($commands);
			$service->go();
			return TRUE;
		} catch(\Exception $e) {
			return FALSE;
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

	public function exitError($msg) {
		exit('ERROR: ' . $msg . chr(10));
	}

	///////////////////////////////////////////////////
	// Law of demeter: decouple access to my friends //
	//                                               //        
	// Also simplyfies unit testing.                 //
	///////////////////////////////////////////////////

	private function getContext() { 
		return $this->context = $this->container->getInstance('Ext\ExtensionContext');
	}

	public function getContextProperty($key) { 
		return $this->getContext()->getProperty($key);
	}

	public function setContextProperty($key, $value) { 
		return $this->getContext()->setProperty($key, $value);
	}

	public function getContextProperties() { 
		return $this->getContext()->getProperties();
	}

	public function isContextValid() {
		return $this->getContext()->isValid();
	}

}

?>
