<div class="posts form">
<?php echo $form->create('Post');?>
	<fieldset>
 		<legend><?php __('Edit Post');?></legend>
	<?php
		echo $form->input('title', array('class' => 'post-title'));
		echo $form->input('body', array('label' => array('class' => 'hidden')));
		echo $form->hidden('blog_id');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<?php echo $this->element('ui/editor'); ?>