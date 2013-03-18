<?php namespace Ext; 

interface ActionService extends \Cool\Service {
	public function usage();
	public function help();
	public function exitError($msg);
	public function setCalledArgument($argument);
	public function getCalledArgument();
	public function setArguments($arguments);
	public function getArguments();
	public function getArgument($index);
	public function countArguments();
	public function go();
	public function handleArgument();
	public function handleSubArgument();

	// Law of demeter: context interface
	public function getExtensionPath();
	public function getExtensionKey();
	public function isContextValid();
	public function getContextProperty($key);
	public function setContextProperty($key, $values);
	public function getContextProperties();

} 

?>
