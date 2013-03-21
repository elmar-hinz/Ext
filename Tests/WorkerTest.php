<?php namespace Ext;

class WorkerTest extends \PHPUnit_Framework_Testcase {

	private $sut;
	private $testRoot = '/tmp/worker';
	private $extensionKey= 'test_extension';
	private $extensionRoot = '/tmp/worker/test_extension';
	private $deepInExtension = '/tmp/worker/test_extension/deep/in/it';
	private $outsideOfExtension = '/tmp/worker/outside_of_extension';
	private $pathToEmConf = '/tmp/worker/test_extension/ext_emconf.php';

	public function setUp() {
		// setup sut
		require_once(__DIR__.'/../../Cool/Classes/LoadTestHelper.php');
		\Cool\LoadTestHelper::loadAll();
		$this->sut = new Worker();
		// setup context 
		mkdir($this->deepInExtension, 0700, TRUE);
		mkdir($this->outsideOfExtension, 0700, TRUE);
		touch($this->pathToEmConf);
		assert(file_exists($this->pathToEmConf));
	}

	public function tearDown() {
		assert(file_exists($this->testRoot));
		exec('rm -rf '.$this->testRoot);
		assert(!file_exists($this->testRoot));
	}

	/**
	* @test
	*/
	public function dirname_returns_parent_path() {
		$this->assertEquals('/one/two', dirname('/one/two/three'));
	}

	/**
	* @test
	*/
	public function dirname_returns_root_for_root() {
		$root = dirname('/');
		$this->assertEquals($root, dirname($root));
	}

	/**
	* @test
	*/
	public function worker_can_be_created() {
		$this->assertInstanceOf('Ext\Worker', $this->sut);
		$this->assertInstanceOf('Ext\WorkerService', $this->sut);
	}

	/**
	* @test
	*/
	public function findPathOfCurrentExtension_returns_false_outside_of_extension() {
		chdir($this->outsideOfExtension);
		// mac os prepends /private to /tmp
		$this->assertStringEndsWith($this->outsideOfExtension, getcwd());
		$this->assertFalse($this->sut->findPathOfCurrentExtension());
	}

	/**
	* @test
	*/
	public function getKeyFromExtensionPath_works() {
		$this->assertEquals($this->extensionKey, 
		$this->sut->getKeyFromExtensionPath($this->extensionRoot));
	}

	/**
	* @test
	*/
	public function findPathOfCurrentExtension_returns_path_inside_of_extension() {
		chdir($this->deepInExtension);
		// mac os prepends /private to /tmp
		$this->assertStringEndsWith($this->deepInExtension, getcwd());
		$this->assertStringEndsWith($this->extensionRoot, $this->sut->findPathOfCurrentExtension());
	}

	/**
	* @test
	*/
	public function read_and_write_to_emconf_is_roundtrip_able() {
		$data = array( 'username' => 't3elmar', 'author' => 'Elmar Hinz',);
		$this->sut->updateExtEmconf($this->extensionRoot, 'test_extension', $data);
		$read = $this->sut->readExtEmConf($this->extensionRoot);
		$this->assertEquals($data, $read);
	}

}

?>
