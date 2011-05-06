<div id="reg_content_user">
<? if (is_null($step) || $step==1): ?>
<span class="smallercopy_nav"><span class="smallercopy_nav_sel">1</span> | 2 </span>
		<div class="bodycopy_reg">Sign up</div>
              <?  echo $ajax->form(null,'post',array('model'=>'User','action'=>'register/1','update'=> 'reg_content_user'));?>
				<?php //echo $form->create('User', array('action' => 'register')); ?>
                  
                  <div class="smallercopy_reg">Email Address</div>
 				  <div class='smallercopy_err' style='color:red'><?php echo $form->input('email', array('class'=>'big_mobile_signup', 'title'=>'Please enter a valid email address',  'label'=>false)); ?></div>
                  <div class="smallercopy_reg">Screen Name</div>
                  <div class='smallercopy_err' style='color:red;'><?php echo $form->input('screen_name', array('label'=>false, 'class'=>'big_mobile_signup' )); ?></div>
			      <div class="smallercopy_reg">Password</div>
 				  <div class='smallercopy_err' style='color:red'><?php echo $form->input('new_password', array('type' => 'password', 'label'=>false, 'class'=>'big_mobile_signup', 'title'=>'Enter a password greater than 6 characters')); ?></div>
                  <div class="smallercopy_reg">Re-type Password</div>
                  <div class='smallercopy_err' style='color:red'><?php echo $form->input('confirm_password', array('label'=>false, 'type' => 'password', 'class'=>'big_mobile_signup', 'title'=>'Enter the same password for confirmation')); ?></div>
                  <div class="smallercopy_reg">
                    <div class="smallercopy_reg">
                  <? echo '<div class="smallercopy_err" style="color:red">'.$form->error('User.accept').'</div>'; ?>
                      <?php echo $form->checkbox('User.accept', array('class'=>'required validate-one-required', 'title'=>'Please agree to terms and conditions'));?>Please read our <?php echo $html->link('Terms of Use', array('controller'=>'pages', 'action'=>'terms')); ?> and our <?php echo $html->link('Privacy Policy', array('controller'=>'pages', 'action'=>'privacy')); ?> before accepting.
                      </div>
                      
                      <div class="smallercopy_reg" style="text-align:center;">
                      <input type="hidden" name="data[User][step]" value="1" />
    				 <? echo $form->submit('Create');?>
 	   				<?php echo $form->end(); ?>        
					</div>       
<? elseif ($step==2): ?>

        <span class="smallercopy_nav">1 | <span class="smallercopy_nav_selected">2</span> 
        <br />
        
       Please sign in with one of your social networks (you'll be able to add more later)
        
<div class="left-layer51"></div>     <div class="left-layer52">
<?  if(empty($_Auth['User']['facebook_access_key'])):
				echo $html->link($html->image("signin_facebook.gif", array('alt'=>'Login With FB', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'reg/facebook'), array('escape'=>false));?>	
        <? else: ?>
		<? echo "Facebook Connected"; ?> 
        <? endif; ?>
                </div>
<div class="left-layer51"></div>     <div class="left-layer52">
<?  if(empty($_Auth['User']['twitter_access_key'])):
			   echo  $html->link($html->image("signin_twitter.gif", array('alt'=>'Login With Twitter', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'reg/twitter'),array('escape'=>false));     
  ?>    <? else: ?>
		<? echo "Twitter Connected"; ?> 
        <? endif; ?>
		            </div>
 <div class="left-layer51"></div> <div class="left-layer52">
<?  if(empty($_Auth['User']['linkedin_access_key'])):
			   echo $html->link($html->image("signin_linkedin.png", array('alt'=>'Login With linkedin', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'reg/linkedin'),array('escape'=>false));     
  ?>    <? else: ?>
		<? echo "Linkedin Connected"; ?> 
        <? endif; ?>
	                </div>
 <div class="left-layer51"></div> <div class="left-layer52">
 <?  if(empty($_Auth['User']['foursquare_access_token'])):
			        echo $html->link($html->image("signin_foursquare.png", array('alt'=>'Login With Foursquare', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'reg/foursquare'),array('escape'=>false));     
  ?>    <? else: ?>
		<? echo "foursquare Connected"; ?> 
        <? endif; ?>
	                </div>
 <div class="left-layer51"></div> <div class="left-layer52">
 <?  if(empty($_Auth['User']['netflix_access_key'])):
	 echo $html->link($html->image("signin_netflix.png", array('alt'=>'Login With Netflix', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'reg/netflix'),array('escape'=>false));             
  ?>    <? else: ?>
		<? echo "netflix Connected"; ?> 
        <? endif; ?>
                </div>
<div class="left-layer51"></div>  <div class="left-layer52">
 <?  if(empty($_Auth['User']['meetup_access_key'])):
	echo $html->link($html->image("signin_meetup.png", array('alt'=>'Login With Meetup', 'width'=>'152', 'height'=>'21', 'border'=>'0')),array('controller'=>'users', 'action'=>'reg/meetup'),array('escape'=>false)); 
	  ?>    <? else: ?>
		<? echo "meetup Connected"; ?> 
        <? endif; ?>

</div>
<?  			 echo $html->link('Continue',array('controller'=>'users', 'action'=>'register/4'),array('escape'=>false));             
	?>	
  
  
<? elseif($step==3): ?>  
  <? var_dump($master); ?>
                    

<? endif; ?>

             </div>      
</div>


