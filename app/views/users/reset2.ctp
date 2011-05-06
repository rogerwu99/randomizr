<fieldset>
		<div class="title">
			<h2>Please enter your new password</h2>
		</div>
		<div class="body">
			<?php echo $form->create('User', array('action' => 'reset/'.$token)); ?>
			<?php echo $form->input('new_password', array('type' => 'password')); ?>
		    <?php echo $form->input('confirm_password', array('type' => 'password')); ?>
			<div class="clear"></div>
			<?php //$this->requestAction('users/recaptcha'); ?>
			<?php echo $form->submit(); ?>
			<?php echo $form->end(); ?>
		</div>
</fieldset>