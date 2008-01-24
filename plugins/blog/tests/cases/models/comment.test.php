<?php 

App::import('Model', 'Blog.Blog');
App::import('Model', 'Blog.Post');
App::import('Model', 'Blog.Comment');

class CommentTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('blog', 'post', 'comment');

	function setUp() {
		$this->TestObject = new Comment();
		$this->TestObject->useDbConfig = 'test';
		$this->TestObject->Post->useDbConfig = 'test';
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
	function testValidation1() {
		
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(	
			'comment' => 'Error.empty',
			'post_id' => 'Error.empty',
			'member_id' => 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testSave(){
		$data = array(
			'comment'	=> 'A comment test_suite',
			'post_id' 		=> 'post id',
			'member_id' 	=> 'member id'
		);
		$this->TestObject->save($data);
		$id = $this->TestObject->getLastInsertId();
		$result = $this->TestObject->find(array('Comment.id'=>$id));
		$this->assertEqual(3,$this->TestObject->findCount());
		
	}

	/*
	function testMe() {
		$result = $this->TestObject->findAll();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>
