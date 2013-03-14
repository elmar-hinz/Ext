<?php namespace Ext;

abstract class AbstractAction {

	private $container;

	public function __construct(\Cool\Container $container) {
		$this->container = $container;
	}

	public abstract function go();
}
	

?>

