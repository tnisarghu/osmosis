<div class="members form">
<?php echo $form->create('Member');?>
	<fieldset>
 		<legend><?php __('Add Member');?></legend>
	<?php
		echo $form->input('institution_id');
		echo $form->input('full_name');
		echo $form->input('email');
		echo $form->input('phone');
		echo $form->input('country');
		echo $form->input('city');
		echo $form->input('age');
		echo $form->input('sex');
		echo $form->input('role_id');
		echo $form->input('username');
		echo $form->input('password');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Members', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Roles', true), array('controller'=> 'roles', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Role', true), array('controller'=> 'roles', 'action'=>'add')); ?> </li>
	</ul>
</div>
