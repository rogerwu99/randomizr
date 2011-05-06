<div style="margin-left:60px;">
	<h4>Smart Rewards for the Smart Customer</h4>
	<div class="smallercopy" style="float:right;margin-top:-35px;margin-right:-25px;">
	<? echo $html->link('Merchant Login',array('controller'=>'pages','action'=>'business')); ?>
	</div>
</div>
<div class="consumer-background" id="consumer" style="display:block;">
	<div class="lightbox_content_user" id="reg_content">
	<? if (is_null($intro)) : ?>
		<div id="reg_content_user">
       		<?	$months = array(
							"Jan"=>"Jan",
							"Feb"=>"Feb",
							"Mar"=>"Mar",
							"Apr"=>"Apr",
							"May"=>"May",
							"Jun"=>"Jun",
							"Jul"=>"Jul",
							"Aug"=>"Aug",
							"Sep"=>"Sep",
							"Oct"=>"Oct",
							"Nov"=>"Nov",
							"Dec"=>"Dec"
							);
				$dates=range(1,31);
				$years=range((int)date('Y')-13,1900);	
				?> 
				<? $session->flash(); ?>
            	<div class="bodycopy_reg">Sign up</div>
				<?php echo $form->create('User', array('action' => 'register')); ?>
                  <div class="smallercopy_reg">Name</div>
                  <div class='smallercopy_err' style='color:red'><?php echo $form->input('name', array('label'=>false, 'class'=>'required', 'style'=>'width:217px', 'value'=>$fb_user->name)); ?></div>
                  <div class="smallercopy_reg">Email Address</div>
 				  <div class='smallercopy_err' style='color:red'><?php echo $form->input('email', array('class'=>'required', 'title'=>'Please enter a valid email address', 'style'=>'width:217px', 'label'=>false, 'value'=>$fb_user->email)); ?></div>
			      <div class="smallercopy_reg">Password</div>
 				  <div class='smallercopy_err' style='color:red'><?php echo $form->input('new_password', array('type' => 'password', 'label'=>false, 'class'=>'required validate-password', 'style'=>'width:217px', 'title'=>'Enter a password greater than 6 characters')); ?></div>
                  <div class="smallercopy_reg">Re-type Password</div>
                  <div class='smallercopy_err' style='color:red'><?php echo $form->input('confirm_password', array('label'=>false, 'type' => 'password', 'class'=>'required validate-password-confirm', 'style'=>'width:217px','title'=>'Enter the same password for confirmation')); ?></div>
                  <div class="smallercopy_reg">
                  	<div class="left-layer51">Gender</div>
					<div class="left-layer52">
							<? $gender = array('1'=>'Male','2'=>'Female');
							if ($fb_user->gender=='male'){ 
								$value=1; 
							}
							else $value=2;
					  $attributes = array('legend'=>false,'value'=>1);
					   ?>
					<? echo $form->radio('sex',$gender,$attributes);  ?>
                    </div>
                    <div class="left-layer51">Birthday</div>	
					<div class="left-layer52">
						<? echo $form->select('smonth', $months, array('selected'=>date('M',strtotime($fb_user->birthday)))); ?>
	    				<? echo $form->select('sdate', $dates,  array('selected'=>intval(date('j',strtotime($fb_user->birthday)))-1));?>
	    				<? echo $form->select('syear', $years,  array('selected'=>intval(date('Y'))-13-intval(date('Y',strtotime($fb_user->birthday))))); ?>
					</div>
                    </div>
                  <div class="smallercopy_reg"><br />
                  <? echo '<div class="smallercopy_err" style="color:red">'.$form->error('User.accept').'</div>'; ?>
                      <?php echo $form->checkbox('User.accept', array('class'=>'required validate-one-required', 'title'=>'Please agree to terms and conditions'));?>Please read our <?php echo $html->link('Terms of Use', array('controller'=>'pages', 'action'=>'terms')); ?> and our <?php echo $html->link('Privacy Policy', array('controller'=>'pages', 'action'=>'privacy')); ?> before accepting.
                      </div>
                  <div class="smallercopy_reg" style="text-align:center;"><br />
                  	<input type="hidden" name="data[User][fb_uid]" value="<? echo $fb_user->id; ?>">		
    				<?php echo $ajax->submit('Create my Account!', array('url'=>array('controller'=>'users','action'=>'register'),'update'=>'reg_content_user'));?>
 	   				<?php echo $form->end(); ?>        
				  </div>
             </div>  
             <? else: ?>
             Thanks for signing up to Bantana!  Earning rewards has never been easier!  
    No more carrying around all of your loyalty cards...three easy steps..
    <ol>
    <li> Look for our QR Code near the register.  </li>
    <li> Scan it with your phone.</li>
    <li> You'll be immediately at the Bantana application to see how far away you are from rewards!  </li>
    </ol>
	<? echo $html->link('Go to my account!',array('controller'=>'users','action'=>'view_my_profile')); ?>
<? endif; ?>

</div>
</div>
<div class="clear"></div>