<?php namespace Ext;

class InstallAction extends Action {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $commandsToServeFor = 'install';

	public function handleCommand() {
		return FALSE; 
	}

	public function usage() {
		return ("TODO");
	}

	public function help() {
		return $this->activeHelp($this->examineEnvironment());
	}

	protected function examineEnvironment() {
			$checks = '/etc/profile, ~/.bash_profile, ~/.bash_login,  ~/.profile, ~/.bashrc';
			$checks = str_replace('~', $_SERVER['HOME'], $checks);
			$suggestions = array_filter(array_map('realpath', 
				array_map('trim', explode(',',$checks))), 'file_exists');
			$path = realpath(__DIR__.'/../bin/ext');
			return array( $path, $suggestions);
	}

	protected function activeHelp($set) {
		list($executable, $suggestions) = $set;
		$suggestionString = '';
		foreach($suggestions as $suggestion) $suggestionString .= "\t\t* ".$suggestion.chr(10);
		return "

	There are two ways to install ext
	=================================
		
		1.) Create an alias pointing to it.	
		2.) Put it into your PATH.

	I suggest the alias.

	You can do this manually or automatically (at your risk).

	Automatic installation
	======================

	TODO

	Manual installation
	===================

	The path to the executable:

	$executable

	To create a temporary alias type (or copy):

	alias ext='$executable'

	To make it permanent put it into the appropriate shell 
	configuration scripts. It depends on your system. 

	Suggestions (if any): 

$suggestionString

	Mind to restart the shell or source the file.


	Have fun!

	" . chr(10);
	}

}

?>

