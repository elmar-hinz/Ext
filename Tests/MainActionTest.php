<?php namespace Ext;

class MainActionTest extends \PHPUnit_Framework_Testcase {

	private $container;
	private $sut;
	private $actionClassReflector;
	private $actionObjectReflector;

	public function setUp() {
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();
		$this->sut = $this->getMockBuilder('\Ext\MainAction')->disableOriginalConstructor()
		->setMethods(array('handleSubArgument'))->getMock();
	}

	/**
	* @test
	*/
	function action_can_be_created() {
		$this->assertInstanceOf('Ext\MainAction', $this->sut);
		$this->assertInstanceOf('Ext\Action', $this->sut);
	}

	/**
	* @test
	*/
	function handleArgument_calls_handleSubArgument() {
		$this->sut->expects($this->once())->method('handleSubArgument')
		->will($this->returnValue(TRUE));
		$this->assertTrue($this->sut->handleArgument());
	}

}

?>

