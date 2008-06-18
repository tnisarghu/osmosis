<div id="locker-actions">
	<div class="create-folder action">
		<?php
			echo $form->create('LockerFolder',array('url' => array('controller' => 'folders')));
			echo $form->input('name', array('div' => false, 'label' => __('Add Folder:', true)));
			echo $form->input('parent_id',array('type' => 'hidden', 'value' => $folder_id));
			echo $form->end(__('Create Folder', true));
		?>
	</div>
	<div class="upload-file action">
		<?php
			echo $form->create('LockerDocument',array('type' => 'file', 'url' => array('controller' => 'documents')));
			echo $form->input('file',array('type' => 'file', 'label' => __('Upload File:', true)));
			echo $form->input('folder_id', array('type' => 'hidden', 'value' => $folder_id));
			echo $form->end(__('Upload File', true));
		?>
	</div>
</div>