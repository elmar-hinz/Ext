<?php namespace Ext;

class PropertyActionHelperTest extends \PHPUnit_Framework_Testcase {

	private $sut;
	private $action;
	private $context;

	public function setUp() {
		// loading
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();

		// action expectations 
		$this->action = $this->getMockBuilder('\Ext\Action')
		->disableOriginalConstructor()->getMock();

		// system under test
		$this->sut = new \Ext\PropertyActionHelper();
		$this->sut->injectAction($this->action);
	}

	/**
	* @test
	*/
	public function helper_can_be_constructed() {
		$this->assertInstanceOf('\Ext\PropertyActionHelper', $this->sut);
	}

	/**
	* @test
	*/
	public function context_can_be_validated_to_true() {
		$this->action->expects($this->once())->method('isContextValid')
		->will($this->returnValue(TRUE));
		$this->assertTrue($this->sut->validateContext());
	}

	/**
	* @test
	*/
	public function context_can_be_validated_to_false() {
		$this->action->expects($this->once())->method('isContextValid')
		->will($this->returnValue(FALSE));
		$this->action->expects($this->once())->method('error')
		->with($this->equalTo('You are not in an extension.'));
		$this->assertFalse($this->sut->validateContext());
	}

	/**
	* @test
	*/
	public function setProperty_works() {
		$key = 'key'; $value = 'value';
		$this->action->expects($this->once())->method('setContextProperty')
		->with($this->equalTo($key), $this->equalTo($value));
		$this->sut->setProperty($key, $value);
	}

	/**
	* @test
	*/
	public function printProperty_works() {
		$key = 'key'; 
		$value = 'value';
		$this->action->expects($this->once())->method('getContextProperty')
		->with($this->equalTo($key))->will($this->returnValue($value));
		ob_start();
		$this->sut->printProperty($key);
		$this->assertEquals($value . chr(10), ob_get_clean());
	}

}

?>
