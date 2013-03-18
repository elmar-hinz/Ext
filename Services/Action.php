<?php namespace Ext;

abstract class Action implements ActionService {

	static protected $parentActionToServeFor = NULL;
	static protected $argumentsToServeFor = '';

	protected $container = NULL;
	private $arguments = array();
	private $calledArgument = '';

	public abstract function usage();
	public abstract function help();

	public function __construct(\Cool\Container $container) { 
		$this->container = $container; 
	}
	public function setCalledArgument($argument) { $this->calledArgument = $argument; } 
	public function getCalledArgument() { return $this->calledArgument; } 
	public function countArguments() { return count($this->arguments); }
	public function setArguments($arguments) { $this->arguments = $arguments; } 
	public function getArguments() { return $this->arguments; }
	public function getArgument($index) { 
		if(isset($this->arguments[$index])) return $this->arguments[$index];
	}
	public static function canServe($argumentSet) {
		$parentMatches = get_class($argumentSet['parent']) == static::$parentActionToServeFor;
		$myArguments = array_map('trim', explode(',', static::$argumentsToServeFor));
		if($parentMatches) foreach($myArguments as $myArgument) 
			if($myArgument == $argumentSet['argument']) return TRUE;
		return FALSE;
	}

	public function go() {
		// print_r($this->getArguments());
		if($this instanceOf ExtensionContextSensitivity && !$this->isContextValid()) {
				$this->exitError('You are not in an extension.');
		}
		if(!$this->handleArgument()) {
			$this->showSpecialHelp();
		}
	}

	public abstract function handleArgument(); 

	public function handleSubArgument() {
		$arguments = $this->getArguments();
		$subArgument = array_shift($arguments);
		try {
			$argumentSet = array('parent' => $this, 'argument' => $subArgument);
			$service = $this->container->getService('Ext\Action', $argumentSet); 
			$service->setCalledArgument($subArgument);
			$service->setArguments($arguments);
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
		print $this->help();	
	}

	public function exitError($msg) {
		exit('ERROR: ' . $msg . chr(10));
	}

	///////////////////////////////////////////////////
	// Law of demeter: decouple access to my friends //
	//                                               //        
	// Also simplyfies unit testing.                 //
	///////////////////////////////////////////////////

	public function getExtensionPath() { 
		return $this->context->getExtensionPath();
	}

	public function getExtensionKey() { 
		return $this->context->getExtensionKey();
	}

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
