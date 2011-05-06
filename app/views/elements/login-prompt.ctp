	<div class="sidebar5" id="consumer" style="display:block;">
<?php 
if ($c == 'Pages'){
	$page = $a['pass'][0]; 
}
else if ($c == 'Merchants'){
$page = 'business';
}

else {
$page = 'home';
}

	?>
<?  if ($page == 'home'): ?>
<div style="float:right;">	
	<? if (!Configure::read('mobile')): ?>
    <div id="logging_in" style="display:block">
	<span class="bodycopy">
    
			<? echo $form->create('User',array('controller'=>'users','action'=>'login')); ?>
			 
             Email:
             
			<? echo $form->input('Auth.username', array('div'=>false,'label'=>false, 'class'=>'big_mobile')); ?>
			Password:
	             <? 	echo $form->input('Auth.password', array('div'=>false,'type' => 'password', 'label'=>false,  'class'=>'big_mobile')); ?>
			<?	echo $form->submit('Sign In!', array('name'=>'submit', 'div'=>false));
				echo $form->end();
			?>	
			
  </span>  
	<span class="fb_button"><?		echo $html->link($html->image("signin_facebook.gif", array('alt'=>'Login With FB', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'facebookLogin'), array('escape'=>false));	
	?>
	<?	//echo $html->link('Sign up','/users/register'); ?>
	</span>
    </div>
	<? else: ?>
     <div id="login_prompt"><? echo $html->link("Sign In", "#", array('onClick'=>'Effect.SlideDown(\'logging_in\'); Effect.SlideUp(\'login_prompt\');Effect.SlideUp(\'reg_content\');Effect.SlideUp(\'branding\');return false;')); ?></div>
      <div id="logging_in" style="display:none">
	<span class="bodycopy">
    
			<? echo $form->create('User',array('controller'=>'users','action'=>'login')); ?>
			 
      <span style="float:right">       Email:
             
			<? echo $form->input('Auth.username', array('div'=>false,'label'=>false, 'class'=>'big_mobile')); ?></span><br />
			<span style="float:right">Password:
	             <? 	echo $form->input('Auth.password', array('div'=>false,'type' => 'password', 'label'=>false,  'class'=>'big_mobile')); ?><br />
			</span><br />
			<span style="float:right"><?	echo $form->submit('Sign In!', array('name'=>'submit', 'div'=>false));
				echo $form->end();
			?>	</span><br />
		
  </span>  
  
	<span class="fb_button">    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?		echo $html->link($html->image("signin_facebook.gif", array('alt'=>'Login With FB', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'facebookLogin'), array('escape'=>false));	
	?>
    <span style="float:left;"><? echo $html->link("Create an Account", "#", array('onClick'=>'Effect.SlideUp(\'logging_in\'); Effect.SlideDown(\'login_prompt\');Effect.SlideDown(\'reg_content\');Effect.SlideDown(\'branding\');return false;')); ?></span>
	<?	//echo $html->link('Sign up','/users/register'); ?>
	</span>
             
	
    </div>
    <? endif; ?>
	</div>
 <?  elseif ($page == 'business'): ?>   
    
   <div style="float:right;">
	<?	//echo $html->link('Sign up','/merchants/register'); ?>
	<!-- | -->
	<?	//echo $html->link('Log In','#',array('onClick'=>'Effect.SlideDown(\'logging_in\'); return false;', 'class'=>'bodyblue')); ?>
    
    
    <div id="logging_in" style="display:block">
	<span class="bodycopy">
		<?php 
			//echo $form->create('Auth',array('url'=>substr($this->here,strlen($this->base)))); 
			echo $form->create('Merchant',array('controller'=>'merchants','action'=>'login')); 
    	 	?>
			Email: <? echo $form->input('Auth.username', array('div'=>false, 'error'=>false,'label'=>false, 'style'=>'width:100px')); ?>
			Password:<? echo $form->input('Auth.password', array('div'=>false,'error'=>false,'type' => 'password', 'label'=>false, 'style'=>'width:100px'));?>
			<? 
			echo $form->submit('Sign In!', array('div'=>false,'name'=>'submit'));
			echo $form->end();
		?>
	</span>
		
    </div>

    
	</div>
    
    
    <? endif; ?>
    
    
</div>
