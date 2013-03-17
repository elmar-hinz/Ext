<?php namespace Ext;

class ActionTest extends \PHPUnit_Framework_Testcase {

	private $container;
	private $action;
	private $actionClassReflector;
	private $actionObjectReflector;

	public function setUp() {

		// load
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();

		// container
		$this->container = $this->getMockBuilder('\Cool\Container')
		->disableOriginalConstructor()->getMock();

		// action
		$this->action = $this->getMockBuilder('\Ext\Action')
		->setConstructorArgs(array($this->container))
		->setMethods(array('handleCommand', 'usage', 'help'))->getMock();
		$this->action->expects($this->any())->method('go');

		// action reflector
		$this->actionObjectReflector = new \ReflectionObject($this->action);
		$this->actionClassReflector = new \ReflectionClass('\Ext\Action');
	}

	/**
	* @test
	*/
	function action_can_be_constructed() {
		$this->assertInstanceOf('Ext\Action', $this->action);
		$this->assertInstanceOf('\Cool\Service', $this->action);
	}

	/**
	* @test
	*/
	function setCalledCommand_and_getCalledCommand_works() {
		$command = 'test';
		$this->action->setCalledCommand($command);
		$this->assertEquals($command, $this->action->getCalledCommand());
	}

	/**
	* @test
	*/
	function setCommands_and_getCommands_works() {
		$myCommands = array('some', 'command', 'do');
		$this->action->setCommands($myCommands);
		$this->assertSame($myCommands, $this->action->getCommands());
	}

	/**
	* @test
	*/
	function getCommand_by_index_works() {
		$myCommands = array('some', 'command', 'do');
		$this->action->setCommands($myCommands);
		$this->assertSame('some', $this->action->getCommand(0));
		$this->assertSame('command', $this->action->getCommand(1));
	}

	/**
	* @test
	*/
	function countCommands_works() {
		$myCommands = array('some', 'command', 'do');
		$this->action->setCommands($myCommands);
		$this->assertEquals(3, $this->action->countCommands());
	}

	/**
	* @test
	*/
	function canServe_works() {
		$class = new \ReflectionClass('Ext\Action');
		$p = $class->getProperty('parentActionToServeFor');
		$p->setAccessible(TRUE);
		$p->setValue('ParentAction');
		$p = $class->getProperty('commandsToServeFor');
		$p->setAccessible(TRUE);
		$p->setValue('show, list');
		$parent= $this->getMockForAbstractClass('\Ext\Action', array(), 'ParentAction', FALSE);
		$commandSet = array('parent' => $parent, 'command' => 'show'); 
		$this->assertTrue($class->getMethod('canServe')->invoke(NULL, $commandSet));
		$commandSet = array('parent' => $parent, 'command' => 'list'); 
		$this->assertTrue($class->getMethod('canServe')->invoke(NULL, $commandSet));
		$commandSet = array('parent' => $parent, 'command' => 'invalid'); 
		$this->assertFalse($class->getMethod('canServe')->invoke(NULL, $commandSet));
	}

	/**
	* @test
	*/
	function go_works() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function go_detects_ExtensionConext_for_ExtensionContextSensitivity_Objects() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function go_doesnt_detect_ExtensionConext_for_Non_ExtensionContextSensitivity_Objects() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function handleSubcommand_works() {
		// expectations of the child action service
		$childAction = $this->getMockBuilder('\Ext\Action')
		->setConstructorArgs(array($this->container))->getMock();
		$childAction->expects($this->once())->method('go');
		$childAction->expects($this->once())->method('setCommands')
		->with($this->equalTo(array('subsubcommand')));

		// expectations of the queried container
		$expectedCommandSet = array('parent' => $this->action, 'command' => 'subcommand');
		$this->container->expects($this->once())->method('getService')
		->with($this->equalTo('Ext\Action'), $this->equalTo($expectedCommandSet))
		->will($this->returnValue($childAction));

		// run test
		$this->action->setCommands(array('subcommand', 'subsubcommand'));
		$m = $this->actionObjectReflector->getMethod('handleSubcommand');
		$m->setAccessible(TRUE);
		$m->invoke($this->action);
	}

	/**
	* @test
	*/
	function showSpecialHelp_works() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function showGeneralHelp_works() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function exitError_works() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function getContextProperty_works() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function setContextProperty_works() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function getContextProperties_works() {
		$this->markTestIncomplete();
	}

	/**
	* @test
	*/
	function isContextValid_works() {
		$this->markTestIncomplete();
	}

}

?>
