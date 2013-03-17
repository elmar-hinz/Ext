<?php namespace Ext;

class ListActionTest extends \PHPUnit_Framework_Testcase {

	private $sut;

	public function setUp() {
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();
		$this->sut = $this->getMockBuilder('\Ext\ListAction')->disableOriginalConstructor()
		->setMethods(array('getContextProperties', 'countCommands'))->getMock();
	}

	/**
	* @test
	*/
	public function action_can_be_constructed() {
		$this->assertInstanceOf('\Ext\ListAction', $this->sut);
		$this->assertInstanceOf('\Ext\ExtensionContextSensitivity', $this->sut);
	}

	/**
	* @test
	*/
	public function handleCommand_prints_context_properties() {
		$properties = array ('hello' => 'world');
		$this->sut->expects($this->once())->method('countCommands')
		->will($this->returnValue(0));
		$this->sut->expects($this->once())->method('getContextProperties')
		->will($this->returnValue($properties));
		ob_start();
		$this->sut->handleCommand();
		$out = ob_get_clean();
		$this->assertEquals(1, substr_count($out,'Array'));
		$this->assertEquals(1, substr_count($out,'hello'));
		$this->assertEquals(1, substr_count($out,'world'));
	}

}

?>

