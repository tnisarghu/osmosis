<?php

loadComponent('Zip');

class ZipComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	var $temp_dir = null;
	
	function setUp() {
		$this->temp_dir = ROOT . DS . APP_DIR . DS . 'tmp' . DS . 'tests' . DS . 'zip' . DS;
		$this->TestObject = new ZipComponent();
		$this->TestObject->startup($dummy);
	}

	/**
	 * Deletes all files created.
	 */
	function tearDown() {
		//shell_exec('rm -rf ' . $this->temp_dir );
		unset($this->TestObject);
	}
	
	/**
	 * Creates the temporary directory to wich the test generates the zip files
	 */
	function _createTempDir() {
		$out = shell_exec('mkdir ' . $this->temp_dir);
		if (!is_dir($this->temp_dir))
			die('Your tmp directory is NOT writable.');
	}
	
	/**
	 * Creates a test zip file and adds a file to it, changing its name.
	 */
	function _createDummyZip() {
		$this->_createTempDir();
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		shell_exec('echo test > ' . $this->temp_dir . 'test.txt');
		$this->TestObject->addFile($this->temp_dir . 'test.txt', 'other_name.txt');
		$this->TestObject->close();
		file_exists($this->temp_dir . 'prueba.zip');
		shell_exec('rm -f ' . $this->temp_dir . 'test.txt');
		$this->assertTrue(file_exists($this->temp_dir . 'prueba.zip'));
	}
	
	/**
	 * Unzips the dummy zip file to a unexistant directory.
	 * Test for the creation of the directory and de extracion of the file.
	 */
	function _unzipDummyZip() {
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		$this->TestObject->extract($this->temp_dir . 'unexistant_path');
		$this->TestObject->close();
		$this->assertTrue(is_dir($this->temp_dir . 'unexistant_path'));
		$this->assertTrue(file_exists($this->temp_dir. 'unexistant_path' . DS . 'other_name.txt'));
		
	}
	
	/**
	 * Test creating a zip file, adding a file and then extracting it to an unexistant directory.
	 */
	function testArchiveExtract() {
		$this->_createDummyZip();
		$this->_unzipDummyZip();
		
	
	}
	
	/**
	 * Test creating a zip file, adding a file on the go and its content and then extracting it to an unexistant directory.
	 

	function testAddByContent(){
		$this->TestObject->begin($this->temp_dir . 'prueba.zip');
		$this->TestObject->addByContent('another_file.txt', 'Hello World');
		var_dump($this->TestObject->extract($this->temp_dir . 'another_unexistant_path'));
		$this->TestObject->close();
		$this->assertTrue(is_dir($this->temp_dir . 'another_unexistant_path'));
		$this->assertTrue(file_exists($this->temp_dir. 'another_unexistant_path' . DS . 'other_name.txt'));	
		$this->assertTrue(file_exists($this->temp_dir. 'another_unexistant_path' . DS . 'another_file.txt'));
	}
*/
}	
?>