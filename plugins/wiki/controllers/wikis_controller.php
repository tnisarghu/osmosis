<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
class WikisController extends WikiAppController {

	var $name = 'Wikis';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Wiki->recursive = 0;
		$this->set('wikis', $this->paginate());
	}

	function view($id = null) {
		if (!$id && !isset($this->params['named']['course_id'])) {
			$this->Session->setFlash(__('Invalid Wiki',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!$id)
			$this->set('wiki', $this->Wiki->findByCourseId($this->params['named']['course_id']));
		else
			$this->set('wiki', $this->Wiki->read(null, $id));
	}

	function add() { 
		if (!empty($this->data)) {
			$this->Wiki->create();
			if ($this->Wiki->save($this->data)) {
				$this->Session->setFlash(__('The Wiki has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Wiki could not be saved. Please, try again',true), 'default', array('class' => 'error'));
			}
		}
		$courses = @$this->Wiki->Course->generateList();
		$this->set(compact('courses'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Wiki',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Wiki->save($this->data)) {
				$this->Session->setFlash(__('The Wiki has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Wiki could not be saved. Please, try again',true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Wiki->read(null, $id);
		}
		$courses = @$this->Wiki->Course->generateList();
		$this->set(compact('courses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Wiki',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Wiki->del($id)) {
			$this->Session->setFlash(__('Wiki deleted',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>