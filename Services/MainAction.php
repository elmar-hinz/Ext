<?php namespace Ext;

class MainAction extends Action {

	public function handleArgument() {
		return $this->handleSubArgument();
	}

	public function usage() {
		print("ext help");
	}

	public function help() {
		print("more help on ext help");
	}
}

?>

