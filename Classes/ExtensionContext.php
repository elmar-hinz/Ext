<?php namespace Ext;

class ExtensionContext implements \Cool\Singleton {

	private $container = NULL;
	private $worker = NULL;
	private $extensionPath = FALSE;
	private $extensionKey = FALSE;
	private $properties = array();

	public function __construct(\Cool\Container $container) {
		$this->container = $container;
		$this->worker = $this->container->getService('Ext\WorkerService');
		$this->findExtension();
		if($this->isValid()) $this->loadEmconf();
	}
	
	public function __destruct() {
		if($this->isValid()) $this->storeEmconf();
	}
	
	public function isValid() { 
		return (bool) $this->getExtensionPath();
	}

	public function getExtensionPath() { 
		return $this->extensionPath;
	}

	public function getExtensionKey() { 
		return $this->extensionKey;
	}

	public function setProperty($key, $value) { 
		$this->properties[$key] = $value;
	}

	public function getProperty($key) { 
		if(isset($this->properties[$key])) 
			return $this->properties[$key];
		else 
			return '';
	}

	public function getProperties() { 
		return $this->properties;
	}

	// protected

	protected function findExtension() { 
		$this->extensionPath = $this->worker->findPathOfCurrentExtension();
		$this->extensionKey = $this->worker->getKeyFromExtensionPath($this->getExtensionPath());
	}

	protected function loadEmconf() {
		$this->properties = $this->worker->readExtEmConf($this->getExtensionPath());
	}

	protected function storeEmconf() {
		$this->worker->updateExtEmConf($this->getExtensionPath(), $this->extensionKey, $this->getProperties());
	}

}

?>

