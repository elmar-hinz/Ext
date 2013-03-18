<?php namespace Ext;

class UplaodAction extends Action implements ExtensionContextSensitivity {

	static protected $parentActionToServeFor = 'Ext\MainAction';
	static protected $argumentsToServeFor = 'upload';

	public function handleArgument() {
		switch($this->countArguments()) {
			case 2:
				$this->setContextProperty('uploadComment', $this->getArgument(1));
			case 1:	
				$username = $this->getContextProperty('user');
				if(!$username) $this->exitError('No user set to ext_emconf.php.');
				$password= $this->getArgument(0);
				$extensionKey = $this->getExtensionKey();
				$extensionPath = $this->getExtensionPath();
				$uploadComment = $this->getContextProperty('uploadComment');
				if(!$uploadComment) 
					$this->exitError('No upload comment given or set to ext_emconf.php.');
				$worker = $this->container->getService('Ext\WorkerService');
				return $worker->uploadExtensionToTer($username,$password,$extensionKey,
					$extensionPath,$uploadComment);
				break;
		}
	}

	public function usage() {
		return "
			ext upload password : upload extension 
			ext upload password 'upload comment': upload extension with new comment
		";
	}

	public function help() {
		return 'TODO';
	}

}

?>

