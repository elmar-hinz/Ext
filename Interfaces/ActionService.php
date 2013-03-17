<?php namespace Ext; 

interface ActionService extends \Cool\Service {
	public function usage();
	public function help();
	public function error($msg);
	public function setCalledCommand($command);
	public function getCalledCommand();
	public function setCommands($commands);
	public function getCommands();
	public function getCommand($index);
	public function countCommands();
	public function go();

	// Law of demeter: context interface
	public function isContextValid();
	public function getContextProperty($key);
	public function setContextProperty($key, $values);
	public function getContextProperties();

} 

?>
