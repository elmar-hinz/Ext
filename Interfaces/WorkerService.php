<?php namespace Ext; 

interface WorkerService extends \Cool\Service {
	public function findPathOfCurrentExtension();
	public function getKeyFromExtensionPath($extensionPath);
	public function readEmConf($extensionPath);
	public function writeEmConf($extensionPath, $extKey, $data);
	public function uploadExtensionToTer($username,$password,$extensionKey,$extensionPath,$uploadComment); 
	public function getExtensionInfoFromTer($key, $value = NULL);
} 

?>
