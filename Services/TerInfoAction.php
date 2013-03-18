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
				$worker = $this->container->getService('Ext\WorkerService');
				return $worker->getExtensionInfoFromTer($key, $value);
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

