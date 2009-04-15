<div class="discussions form">
<?php echo $form->create('Discussion',array('url' => array('topic_id' => $this->data['Discussion']['topic_id'])));?>
	<fieldset>
 		<legend><?php __d('forum','New Discussion');?></legend>
	<?php
		echo $form->input('topic_id', array('type' => 'hidden'));
		echo $form->input('title', array('size'=>'75'));
		echo $form->input('content');
	?>
	<div class="checkbox">
		<?php echo $form->input('sticky', array('label' => __d('forum','Keep this discussion on top', true))); ?>
	</div>
	</fieldset>
<?php echo $form->end(__d('forum','Create Discussion', true));?>
</div>
<?php
	echo $this->element('ui/editor');
?>