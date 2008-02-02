<?php
class QuizzesController extends QuizAppController {

	var $name = 'Quizzes';
	var $helpers = array('Html', 'Form' );

	/**
	 * question_types: used on the list of available question types
	 */	
	var $question_types = null;
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->question_types = array(
			__('Choice Question', true),
			__('Cloze Question', true),
			__('Matching Question', true),
			__('Ordering Question', true),
			__('Text Question', true)
		);
		$this->set('question_types', $this->question_types);
	}
	
	function index() {
		$this->Quiz->recursive = 0;
		$this->set('quizzes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Quiz.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('quiz', $this->Quiz->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Quiz->create();
			if ($this->Quiz->save($this->data)) {
				$this->Session->setFlash(__('The Quiz has been saved',true));
				$this->redirect(array('action'=>'edit', $this->Quiz->getLastInsertId()), null, true);
			} else {
				$this->Session->setFlash(__('The Quiz could not be saved. Please, try again.',true));
			}
		}
/*		$associationQuestions = $this->Quiz->AssociationQuestion->find('list');
		$choiceQuestions = $this->Quiz->ChoiceQuestion->find('list');
		$clozeQuestions = $this->Quiz->ClozeQuestion->find('list');
		$matchingQuestions = $this->Quiz->MatchingQuestion->find('list');
		$orderingQuestions = $this->Quiz->OrderingQuestion->find('list');
		$textQuestions = $this->Quiz->TextQuestion->find('list');
		$this->set(compact('associationQuestions', 'choiceQuestions', 'clozeQuestions', 'matchingQuestions', 'orderingQuestions', 'textQuestions'));
		*/
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Quiz',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Quiz->save($this->data)) {
				$this->Session->setFlash(__('The Quiz has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Quiz could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Quiz->read(null, $id);
		}
		/*
		$associationQuestions = $this->Quiz->AssociationQuestion->find('list');
		$choiceQuestions = $this->Quiz->ChoiceQuestion->find('list');
		$clozeQuestions = $this->Quiz->ClozeQuestion->find('list');
		$matchingQuestions = $this->Quiz->MatchingQuestion->find('list');
		$orderingQuestions = $this->Quiz->OrderingQuestion->find('list');
		$textQuestions = $this->Quiz->TextQuestion->find('list');
		$this->set(compact('associationQuestions','choiceQuestions','clozeQuestions','matchingQuestions','orderingQuestions','textQuestions'));*/
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Quiz',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Quiz->del($id)) {
			$this->Session->setFlash(__('Quiz #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	function rename($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Quiz',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Quiz->save($this->data)) {
				$this->Session->setFlash(__('The Quiz has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Quiz could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Quiz->read(null, $id);
		}
	}
}
?>
