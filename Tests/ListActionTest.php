<?php namespace Ext;

class ListActionTest extends \PHPUnit_Framework_Testcase {

	private $sut;

	public function setUp() {
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();
		$this->sut = $this->getMockBuilder('\Ext\ListAction')->disableOriginalConstructor()
		->setMethods(array('isContextValid', 'error', 'getContextProperties', 'countCommands', 'showSpecialHelp'))->getMock();
	}

	/**
	* @test
	*/
	public function action_can_be_constructed() {
		$this->assertInstanceOf('\Ext\ListAction', $this->sut);
	}

	/**
	* @test
	*/
	public function go_with_invalid_context_calls_error() {
		$this->sut->expects($this->once())->method('isContextValid')
		->will($this->returnValue(FALSE));
		$this->sut->expects($this->once())->method('error')
		->with('You are not in an extension.');
		$this->sut->go();
	}

	/**
	* @test
	*/
	public function go_prints_context_properties() {
		$properties = array ('hello' => 'world');
		$this->sut->expects($this->once())->method('isContextValid')
		->will($this->returnValue(TRUE));
		$this->sut->expects($this->once())->method('countCommands')
		->will($this->returnValue(0));
		$this->sut->expects($this->once())->method('getContextProperties')
		->will($this->returnValue($properties));
		ob_start();
		$this->sut->go();
		$out = ob_get_clean();
		$this->assertEquals(1, substr_count($out,'Array'));
		$this->assertEquals(1, substr_count($out,'hello'));
		$this->assertEquals(1, substr_count($out,'world'));
	}

	/**
	* @test
	*/
	public function go_shows_special_help() {
		$this->sut->expects($this->once())->method('isContextValid')
		->will($this->returnValue(TRUE));
		$this->sut->expects($this->once())->method('countCommands')
		->will($this->returnValue(1));
		$this->sut->expects($this->once())->method('showSpecialHelp');
		$this->sut->go();
	}

}

?>

