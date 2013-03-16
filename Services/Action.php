<?php namespace Ext;

abstract class Action implements ActionService {

	protected static $expectedParentAction = '';
	protected static $command = '';
	protected $container = NULL;
	private $parentObject = NULL;
	private $commands = array();

	public abstract function usage();

	public abstract function help();

	public function __construct(\Cool\Container $container) {
		$this->container = $container;
	}

	public static function canServe($commandSet) {
		return (get_class($commandSet['parent']) == self::$expectedParentAction
		&& $commandSet['command'] == self::$command);
	}

	public function setParentAction(ActionService $parent) {
		$this->parentObject = $parent;	
	}

	public function getParentAction() {
		return $this->parentObject;	
	}

	public function hasParentAction() {
		return (bool) $this->parentObject;
	}

	public function setCommands($commands) {
		$this->commands = $commands;
	}

	public function getCommands() {
		return $this->commands;
	}

	public abstract function go();

	protected function handleSubcommand() {
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


}
	

?>

