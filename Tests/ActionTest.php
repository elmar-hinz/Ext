<?php namespace Ext;

class ActionTest extends \PHPUnit_Framework_Testcase {

	private $container;
	private $action;
	private $actionClassReflector;
	private $actionObjectReflector;

	public function setUp() {
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();
		$this->container = $this->getMockBuilder('\Cool\Container')->disableOriginalConstructor()->getMock();
		$this->action = $this->getMockBuilder('\Ext\Action')->setConstructorArgs(array($this->container))->setMethods(array('go', 'usage', 'help'))->getMock();
		$this->action->expects($this->any())->method('do');
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
	function setCommands_works() {
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

}

?>
