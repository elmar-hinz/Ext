<?php namespace Ext;

class UploadAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $argumentsToServeFor = 'upload';

	public function handleArgument() {
		if($this->countArguments() == 1) {
				$username = $this->getContextProperty('user');
				if(!$username) $this->exitError('No user set to ext_emconf.php.');
				$password= $this->getArgument(0);
				$extensionKey = $this->getExtensionKey();
				$extensionPath = $this->getExtensionPath();
				$uploadComment = $this->getContextProperty('comment');
				if(!$uploadComment) 
					$this->exitError('No upload comment given or set to ext_emconf.php.');
				$worker = $this->container->getService('Ext\WorkerService');
				return $worker->uploadExtensionToTer($username,$password,$extensionKey,
					$extensionPath,$uploadComment);
		} else {
			return FALSE;
		}
	}

	public function usage() {
		return "
			ext upload 'password' : upload extension 
		";
	}

	public function help() {
		return 'TODO';
	}

}

?>

