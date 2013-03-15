<?php namespace Ext;

class MainActionTest extends \PHPUnit_Framework_Testcase {

	private $container;
	private $action;
	private $actionClassReflector;
	private $actionObjectReflector;

	public function setUp() {
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();
		$container = new \Cool\Container();
		$this->action = $container->getInstance('Ext\MainAction');
	}

	/**
	* @test
	*/
	function action_can_be_created() {
		$this->assertInstanceOf('Ext\MainAction', $this->action);
		$this->assertInstanceOf('Ext\Action', $this->action);
	}

	/**
	* @test
	*/
	function xxx() {
	}
}

?>

