<?php namespace Ext;

class MainActionTest extends \PHPUnit_Framework_Testcase {

	private $action;

	public function setUp() {
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();
		$container = new \Cool\Container();
		$this->action = $container->instantiate('Ext\MainAction');
	}

	/**
	* @test
	*/
	function action_can_be_created() {
		$this->assertInstanceOf('Ext\MainAction', $this->action);
		$this->assertInstanceOf('Ext\AbstractAction', $this->action);
	}

	/**
	* @test
	*/
	function xxx() {
	}
}

?>

