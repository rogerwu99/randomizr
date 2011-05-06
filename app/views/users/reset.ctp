		<div class="title">
			<h1>Please enter your email</h1>
		</div>
		<div class="body">
			<div class="content1">
                        	<? $session->flash(); ?>
                  	</div>
			<br />
			<?php echo $form->create('User', array('action' => 'reset')); ?>
			<div class="bodycopy">Email: </div>
			<div><?php echo $form->input('email', array('label'=>false, 'class'=>'required bodycopy', 'style'=>'width:217px')); ?></div>
			<div class="clear"></div>
			<br />
			<?php $this->requestAction('users/recaptcha'); ?>
			<br />
			<?php echo $form->submit('submit_button.jpg', array('width'=>'82px', 'height'=>'38px'));?>
			<?php echo $form->end(); ?>
		</div>
