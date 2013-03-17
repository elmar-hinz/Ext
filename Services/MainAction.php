<?php namespace Ext;

class MainAction extends Action {

	public function handleCommand() {
		return $this->handleSubcommand();
	}

	public function usage() {
		print("ext help");
	}

	public function help() {
		print("more help on ext help");
	}
}

?>

