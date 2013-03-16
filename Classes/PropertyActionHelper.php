<?php namespace Ext;

/**
* Strategie pattern
*/
class PropertyActionHelper {

	private $action;
	protected $container;

	public function injectAction(\Ext\Action $action) {
		$this->action = $action;
	}

	public function go($propertyName) {
		if(count($this->action->getCommands()) == 0) {
			$context = $this->action->getContainer()->getInstance('Ext\ExtensionContext');
			if($context->isValid())
				print $context->getProperty($propertyName) . chr(10);
			else 
				print 'You are not in an extension.' . chr(10);
		} else {
			$this->action->showSpecialHelp();
		}
	}
}

?>

