<?php namespace Ext;

class ExtensionContextTest extends \PHPUnit_Framework_Testcase {

	private $sut;
	private $woker;
	private $container;
	private $extensionKey = 'testKey';
	private $extensionPath = 'testPath/testKey';
	private $extensionData = array('key1' => 'value1');

	public function setUp() {
		// loading
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();

		// worker expectations need for all tests
		$this->worker= $this->getMockBuilder('\Ext\Worker')->getMock();

		// -> method: findPathOfCurrentExtension
		$this->worker->expects($this->any())
		->method('findPathOfCurrentExtension')
		->will($this->returnValue($this->extensionPath));

		// -> method: getKeyFromExtensionPath
		$this->worker->expects($this->any())
		->method('getKeyFromExtensionPath')
		->will($this->returnValue($this->extensionKey))
		->with($this->equalTo($this->extensionPath));

		// container expectations
		$this->container = $this->getMockBuilder('\Cool\Container')
		->disableOriginalConstructor()->setMethods(array('getService'))->getMock();
		$this->container->expects($this->any())->method('getService')
		->will($this->returnValue($this->worker));
		$this->sut = new ExtensionContext($this->container);
	}
	
	/**
	* @test
	*/
	public function ExtensionContext_can_be_constructed() {
		$this->assertInstanceOf('\Ext\ExtensionContext', $this->sut);
	}

	/**
	* @test
	*/
	public function ExtensionContext_is_a_singleton() {
		$this->assertInstanceOf('\Cool\Singleton', $this->sut);
	}

	/**
	* @test
	*/
	public function findExtension_sets_extensionPath() {
		$this->assertEquals($this->extensionPath, $this->sut->getExtensionPath());
	}

	/**
	* @test
	*/
	public function findExtension_sets_extensionKey() {
		$this->assertEquals($this->extensionKey, $this->sut->getExtensionKey());
	}

	/**
	* @test
	*/
	public function properties_are_read_during_construction() {
		$this->worker->expects($this->any())->method('readEmConf')
		->will($this->returnValue($this->extensionData))
		->with($this->equalTo($this->extensionPath));
		$this->sut = new ExtensionContext($this->container);
		$this->assertEquals($this->extensionData, $this->sut->getProperties());
	}

	/**
	* @test
	*/
	public function properties_set_and_get() {
		$this->sut->setProperty('hello', 'world');
		$this->assertEquals('world', $this->sut->getProperty('hello'));
	}

	/**
	* @test
	*/
	public function properties_return_empty_string_for_invalid_keys() {
		$this->assertEquals('', $this->sut->getProperty('invalid'));
	}

	/**
	* @test
	*/
	public function properties_are_written_during_destruction() {
		$this->worker->expects($this->any())->method('readEmConf')
		->will($this->returnValue($this->extensionData));
		$this->worker->expects($this->once())->method('writeEmConf')
		->with(
			$this->equalTo($this->extensionPath),
			$this->equalTo($this->extensionKey),
			$this->equalTo($this->extensionData)
		);
		new ExtensionContext($this->container);
	}

}

?>


