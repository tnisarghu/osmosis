<?php
class ChoiceConsideration extends ScormAppModel {

	var $name = 'ChoiceConsideration';
	var $validate = null;
	function __construct() {
	parent::__construct();
		$this->validate = array(
			'preventActivation' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.choiseconsideration.preventactivation.boolean', true),
					'required' => false
				)
			),
			'constrainChoice' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.choiseconsideration.constrainchoice.boolean', true),
					'required' => false
				)
			)
		);
	}
}
?>