<?php
class TextQuestionsController extends QuizAppController {

	var $name = 'TextQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->TextQuestion->recursive = 0;
		$this->set('textQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Text Question.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('textQuestion', $this->TextQuestion->read(null, $id));
	}

	function add($quiz_id=null) {
		if (!empty($this->data)) {
			$this->TextQuestion->create();
			if($quiz_id) {
				$this->data['Quiz']['id'] = $quiz_id;
			}
			if ($this->TextQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Text Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Text Question could not be saved. Please, try again.',true));
			}
		}
		$formats = array(
			'plain' => __('No format',true),
			'pre'	=> __('Preserve original format',true),
			'html'	=> __('Enriched text',true)
			);
		$this->set(compact('formats','quiz_id'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Text Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->TextQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Text Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Text Question could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TextQuestion->read(null, $id);
		}
		$quizzes = $this->TextQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Text Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->TextQuestion->del($id)) {
			$this->Session->setFlash(__('Text Question #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
