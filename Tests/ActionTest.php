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
		->setMethods(array('handleArgument', 'usage', 'help'))->getMock();
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
	function setCalledArgument_and_getCalledArgument_works() {
		$argument = 'test';
		$this->action->setCalledArgument($argument);
		$this->assertEquals($argument, $this->action->getCalledArgument());
	}

	/**
	* @test
	*/
	function setArguments_and_getArguments_works() {
		$myArguments = array('some', 'argument', 'do');
		$this->action->setArguments($myArguments);
		$this->assertSame($myArguments, $this->action->getArguments());
	}

	/**
	* @test
	*/
	function getArgument_by_index_works() {
		$myArguments = array('some', 'argument', 'do');
		$this->action->setArguments($myArguments);
		$this->assertSame('some', $this->action->getArgument(0));
		$this->assertSame('argument', $this->action->getArgument(1));
	}

	/**
	* @test
	*/
	function countArguments_works() {
		$myArguments = array('some', 'argument', 'do');
		$this->action->setArguments($myArguments);
		$this->assertEquals(3, $this->action->countArguments());
	}

	/**
	* @test
	*/
	function canServe_works() {
		$class = new \ReflectionClass('Ext\Action');
		$p = $class->getProperty('parentActionToServeFor');
		$p->setAccessible(TRUE);
		$p->setValue('ParentAction');
		$p = $class->getProperty('argumentsToServeFor');
		$p->setAccessible(TRUE);
		$p->setValue('show, list');
		$parent= $this->getMockForAbstractClass('\Ext\Action', array(), 'ParentAction', FALSE);
		$argumentSet = array('parent' => $parent, 'argument' => 'show'); 
		$this->assertTrue($class->getMethod('canServe')->invoke(NULL, $argumentSet));
		$argumentSet = array('parent' => $parent, 'argument' => 'list'); 
		$this->assertTrue($class->getMethod('canServe')->invoke(NULL, $argumentSet));
		$argumentSet = array('parent' => $parent, 'argument' => 'invalid'); 
		$this->assertFalse($class->getMethod('canServe')->invoke(NULL, $argumentSet));
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
	function handleSubArgument_works() {
		// expectations of the child action service
		$childAction = $this->getMockBuilder('\Ext\Action')
		->setConstructorArgs(array($this->container))->getMock();
		$childAction->expects($this->once())->method('go');
		$childAction->expects($this->once())->method('setArguments')
		->with($this->equalTo(array('subSubArgument')));

		// expectations of the queried container
		$expectedArgumentSet = array('parent' => $this->action, 'argument' => 'subArgument');
		$this->container->expects($this->once())->method('getService')
		->with($this->equalTo('Ext\Action'), $this->equalTo($expectedArgumentSet))
		->will($this->returnValue($childAction));

		// run test
		$this->action->setArguments(array('subArgument', 'subSubArgument'));
		$m = $this->actionObjectReflector->getMethod('handleSubArgument');
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
