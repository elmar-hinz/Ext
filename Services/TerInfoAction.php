<?php namespace Ext;

class TerInfoAction extends Action {

	static protected $parentActionToServeFor = 'Ext\TerAction';
	static protected $argumentsToServeFor = 'info';

	public function handleArgument() {
		$value = NULL;
		switch($this->countArguments()) {
			case 2:
				$value = $this->getArgument(1);
			case 1:
				$key = $this->getArgument(0);
				require_once(__DIR__.'/../../Typo3ExtensionUtils/lib/etobi/extensionUtils/Controller/TerController.php');
				$terController = new \etobi\extensionUtils\Controller\TerController();
				$terController->infoAction($key, $value);
				return TRUE;
				break;
		}
	}

	public function usage() {
		return "
			ext ter info ext_key: get extension info
			ext ter info ext_key xx.xx.xx: get extension info for version xx.xx.xx
		";
	}

	public function help() {
		return 'TODO';
	}
	

}

?>

