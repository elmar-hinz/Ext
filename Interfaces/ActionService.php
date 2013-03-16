<?php namespace Ext; 

interface ActionService extends \Cool\Service {
	public function usage();
	public function help();
	public function setParentAction(ActionService $parent);
	public function getParentAction();
	public function hasParentAction();
	public function setCommands($commands);
	public function getCommands();
	public function go();	
} 

?>
