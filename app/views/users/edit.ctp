
<div id="leftcolumn_user" class="bodycopy">
<? echo $html->link('1', '#',array('onclick'=>'change(\'1\');return false;')); ?>
<? echo $html->link('2', '#',array('onclick'=>'change(\'2\');return false;')); ?>
<? echo $html->link('3', '#',array('onclick'=>'change(\'3\');return false;')); ?>
<? echo $html->link('4', '#',array('onclick'=>'change(\'4\');return false;')); ?>
<? //if (is_null($step) || $step==1): ?>
     <div id='step_1'>
     <div class="base-layer">
                 	<h4 class="table-caption">&nbsp;&nbsp;&nbsp;EDIT USER INFORMATION </h4>
                	   <div class="table-profile-edit-settings-for-user">
                    	<div class="left-layer41">
                    	<? echo $form->create('User', array('action'=>'edit')); ?>
						First Name:</div>
                        <div class="left-layer41">
						<?php echo $form->input('first_name', array('error' => array('required' => 'Name is required'), 'label' => false, 'class' => 'big_mobile_1','value'=>$user['Userprofile']['first_name'])); ?>
                        </div>
                    	<div class="left-layer41">
                    	Last Name:</div>
                        <div class="left-layer41">
						<?php echo $form->input('last_name', array('error' => array('required' => 'Name is required'), 'label' => false, 'class' => 'big_mobile_1','value'=>$user['Userprofile']['last_name'])); ?>
                        </div>
                        	<div class="left-layer41">Birthday</div>	

						<div class="left-layer41"><? echo $form->select('smonth', $months, array('selected'=>date('M',strtotime($user['Userprofile']['birthday']))));?>
	    <? echo $form->select('sdate', $dates,array('selected'=>date('j',strtotime($user['Userprofile']['birthday']))-1));?>
	    <? echo $form->select('syear', $years,array('selected'=>date('y',strtotime($user['Userprofile']['birthday']))));?>
	</div>
     <div class="left-layer41">
                       Gender

                      </div>
                      <? 
				  $gender = array('male'=>'Male','female'=>'Female');
					  $attributes = array('legend'=>false,'value'=>$user['Userprofile']['gender']);
					   ?>
					   <div class="left-layer41"><? echo $form->radio('sex',$gender,$attributes); 
 
	 ?>
                       </div>
       	<div class="left-layer41">Relationship</div>	

						<div class="left-layer41"><? echo $form->select('relationship', $relationship, array('selected'=>$user['Userprofile']['relationship']));?>
</div>
       	<div class="left-layer41">Religion</div>	

						<div class="left-layer41"><?php echo $form->input('religion', array('label' => false, 'class' => 'big_mobile_1','value'=>$user['Userprofile']['religion'])); ?>
                        
</div>       	<div class="left-layer41">Politics</div>	

						<div class="left-layer41"><?php echo $form->input('politics', array('label' => false, 'class' => 'big_mobile_1','value'=>$user['Userprofile']['political'])); ?>
</div>
       	<div class="left-layer41">Hometown</div>	

						<div class="left-layer41"><?php echo $form->input('last_name', array('error' => array('required' => 'Name is required'), 'label' => false, 'class' => 'big_mobile_1','value'=>$user['Userprofile']['hometown'])); ?>
                        
</div>


                    	
                        
                        
                        <div class="left-layer41">
                        Password:</div>
                        <div class="left-layer41">
						<?php echo $form->input('new_password', array('type' => 'password', 'label'=>false, 'class'=>'big_mobile_1', 'title'=>'Enter a password greater than 6 characters')); ?>
                        </div>
                    	<div class="left-layer41">
                        Confirm Password:</div>
						<div class="left-layer41">
						<?php echo $form->input('confirm_password', array('label'=>false, 'type' => 'password', 'class'=>'big_mobile_1', 'title'=>'Enter the same password for confirmation')); ?>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="left-layer41">
                    	<? echo $form->create('User', array('action'=>'edit')); ?>
						Screen Name:</div>
                        <div class="left-layer41">
						<?php echo $form->input('screen_name', array('error' => array('required' => 'Name is required'), 'label' => false, 'class' => 'big_mobile_1','value'=>$user['User']['screen_name'])); ?>
                        </div>
                    	<div class="left-layer41">Meeting Price</div><div class="left-layer41">&nbsp;</div>	
    
                        <div class="left-layer42">	
                    	<?php echo $form->submit('SAVE!', array('div'=>false)); ?>
                             <? echo $html->link('Cancel','/users/view_my_profile'); ?>
                        <?php echo $form->end(); ?>
                   
						</div>
                    </div>  
                   </div> 
                   </div>
<? //elseif ($step==2): ?>
	<div id='step_2' style='display:none;'>      
                <div class="base-layer">
<? if (!empty($interest)): 
?>
                         <div class="table-profile-interest-settings-for-user">
        <?             echo $form->create('User', array('action'=>'edit_interest/1')); ?>
			          <? for ($counter=0;$counter<sizeof($interest);$counter++){
						$name = 'delete_'.$counter;
						
                      ?>
                        <? echo $interest[$counter]["name"]; ?></span>&nbsp;<span><? //echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_interest',$counter), array('update'=>$div_name));?></span><span><?php echo $form->checkbox($name, array('value' => $counter));?>Delete</span><br />
						<?
					}
					
					?> <div class="left-layer42">	
                    	<?php echo $form->submit('SAVE!', array('div'=>false)); ?>
                             <? echo $html->link('Cancel','/users/view_my_profile'); ?>
                        <?php echo $form->end(); ?>
                   
						</div></div>
                        <? endif; ?>
                        <? //var_dump($aspirations); ?>
                        <? if (!empty($aspirations)): ?>
                         <div class="table-profile-interest-settings-for-user">
        <?           //  echo $form->create('User', array('action'=>'edit_interest/2')); ?>
			          <? foreach ($aspirations as $key=>$value){
						$name = 'delete_'.$key;
						  $div_name = 'Interest_'.$key;
						?>
        				<span id="<? echo $div_name; ?>">
						
                        
                        <span><? echo $key; ?></span>&nbsp;<span><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_interest',$key), array('update'=>$div_name));?></span><span><?php echo $form->checkbox($name, array('value' => $key));?>Delete</span></span><br />
						<?
					}
					
					?> <div class="left-layer42">	
                    	<?php echo $form->submit('SAVE!', array('div'=>false)); ?>
                             <? echo $html->link('Cancel','/users/view_my_profile'); ?>
                        <?php echo $form->end(); ?>
                   
						</div>
                        
                        
                        
                        </div><? endif; ?>
                        
                        </div>
    </div>                    
                <div id="step_3" style='display:none;'>                      
        <div class="base-layer">
	        
                                                <div class="table-profile-interest-settings-for-user">
					
                           <? //var_dump($work); ?>
                        <? if (!empty($work)): ?>
                        
	<?             //echo $form->create('User', array('action'=>'edit_interests/3')); ?>
			          <? for ($counter=0;$counter<sizeof($work);$counter++){
						$title_name = 'edit_work_title_'.$counter;
						$company_name = 'edit_work_company_'.$counter;
						$industry_name = 'edit_work_industry_'.$counter;
						$whole_entry = 'delete_work_'.$counter;
						?>
        <div id='<? echo $whole_entry; ?>' style="border:1px solid orange;">
	                        
                        <span id='<? echo $title_name; ?>'>Title: <? echo $work[$counter]["title"]; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'title'), array('update'=>$title_name));?></span><br />
                        <span id='<? echo $company_name; ?>'>Company: <? echo $work[$counter]["company"]; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'company'), array('update'=>$company_name));?></span><br />
                        <span id='<? echo $industry_name; ?>'>Industry: <? echo $work[$counter]["industry"]; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'industry'), array('update'=>$industry_name));?></span><br />
                        &nbsp;<span><? echo $ajax->link('Delete',array('controller'=>'users','action'=>'edit_work',$counter,'delete','Work'), array('update'=>$whole_entry));?></span><br />
	</div>					<?
					}
	?>				<span id='add_entry'>
		<?	echo  $ajax->link('Add Work',array('controller'=>'users','action'=>'add_work','Work'),array('update'=>'add_entry')); ?>
        </span>
					 </div>
                       
                        
                        
                        
                        <? endif; ?>                          <div class="table-profile-interest-settings-for-user">

                           <? //var_dump($schools); ?>
                        <? if (!empty($schools)): ?>
                        
        <?           //  echo $form->create('User', array('action'=>'edit_interests/3')); ?>
			          <? for ($counter=0;$counter<sizeof($schools);$counter++){
						$degree_name = 'edit_school_degree_'.$counter;
						$school_name = 'edit_school_school_'.$counter;
						$major_name = 'edit_school_major_'.$counter;
						$whole_entry = 'delete_school_'.$counter;
						?>
                        
				
					
	        <div id='<? echo $whole_entry; ?>' style="border:1px solid orange;">
	                        
                        <span id='<? echo $degree_name; ?>'>Degree: <? echo $schools[$counter]["degree"]; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'degree','School'), array('update'=>$degree_name));?></span><br />
                        <span id='<? echo $school_name; ?>'>School: <? echo $schools[$counter]["school"]; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'school','School'), array('update'=>$school_name));?></span><br />
                        <span id='<? echo $major_name; ?>'>Major: <? echo $schools[$counter]["major"]; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'major','School'), array('update'=>$major_name));?></span><br />
                        &nbsp;<span><? echo $ajax->link('Delete',array('controller'=>'users','action'=>'edit_work',$counter,'delete','School'), array('update'=>$whole_entry));?></span><br />
	</div>					<?
					}
				?> 
					
						<span id='add_school_entry'>
		<?	echo  $ajax->link('Add School',array('controller'=>'users','action'=>'add_work','School'),array('update'=>'add_school_entry')); ?>
        </span>
					
					
					
					
					</div>
                       
                        
                        
                        
                        <? endif; ?>
                        
                        
                        
                        
                        
                        
                        </div>
                        
                        
                        </div>
                        
                      
<? //elseif ($step==3): ?>
	<div id="step_4" style='display:none;'>                      
        <div class="base-layer">
		<div class="table-profile-edit-settings-for-user">
    	<div class="left-layer41">Social Settings</div><div class="left-layer41">&nbsp;</div>	
	    <div class="left-layer41">Facebook</div><div class="left-layer41">
		<?php if(empty($_Auth['User']['facebook_access_key'])):
				echo $html->link($html->image("signin_facebook.gif", array('alt'=>'Login With FB', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'getOAuth/facebook'), array('escape'=>false));?>	
        <? else: ?>
		<? echo "Facebook Connected"; ?>
        <? echo $html->link('Refresh Data', array('controller'=>'users','action'=>'new_data','facebook')); ?>

         <? echo $html->link('(Use as Pic)', array('controller'=>'users','action'=>'edit_pic','facebook')); ?>
         
         <!--	<br><br>   -->
				
		<?php endif;?>	
    </div>
	<div class="left-layer41">Twitter</div>
		<div class="left-layer41"><!-- style="height:10px;width:700px;overflow-y:auto;">-->
		<?php if(empty($_Auth['User']['twitter_access_key'])): 
				echo $html->link($html->image("signin_twitter.gif", array('alt'=>'Login With Twitter', 'width'=>'150', 'height'=>'22', 'border'=>'0')),array('controller'=>'users', 'action'=>'getOAuth/twitter'),array('escape'=>false));?>
        <? else: ?>
        <? echo "Twitter Connected"; ?>	
                <? echo $html->link('Refresh Data', array('controller'=>'users','action'=>'new_data','twitter')); ?>

         <? echo $html->link('(Use as Pic)', array('controller'=>'users','action'=>'edit_pic','twitter')); ?><!--	<br><br>   -->
		<?php endif;?>	
    </div>
<div class="left-layer41">Linked In</div>
	<div class="left-layer41"><!-- style="height:1000px;width:1000px;overflow-y:auto;">-->
		<?php if(empty($_Auth['User']['linkedin_access_key'])): 
				echo $html->link($html->image("signin_linkedin.png", array('alt'=>'Login With Linked In', 'width'=>'152', 'height'=>'21', 'border'=>'0')),array('controller'=>'users', 'action'=>'getOAuth/linkedin'),array('escape'=>false));?>
        <? else: ?>
        <? echo "Linkedin Connected"; ?>
        <? echo $html->link('Refresh Data', array('controller'=>'users','action'=>'new_data','linkedin')); ?>
        <? echo $html->link('(Use as Pic)', array('controller'=>'users','action'=>'edit_pic','linkedin')); ?>
        <?php endif;?>	
    </div>
<div class="left-layer41">Foursquare</div>
	<div class="left-layer41"><!-- style="height:100px;width:700px;overflow-y:auto;">-->
		<?php if(empty($_Auth['User']['foursquare_access_token'])): 
				echo $html->link($html->image("signin_foursquare.png", array('alt'=>'Login With Foursquare', 'width'=>'152', 'height'=>'21', 'border'=>'0')),array('controller'=>'users', 'action'=>'getOAuth/foursquare'),array('escape'=>false));?>
        <? else: ?>
        <? echo "Foursquare Connected"; ?>
                <? echo $html->link('Refresh Data', array('controller'=>'users','action'=>'new_data','foursquare')); ?>

         <? echo $html->link('(Use as Pic)', array('controller'=>'users','action'=>'edit_pic','foursquare')); ?><!--	<br><br>   -->
		<?php endif;?>	
    </div>
<div class="left-layer41">Netflix</div>
	<div class="left-layer41"><!-- style="height:1000px;width:1000px;overflow-y:auto;">-->
		<?php if(empty($_Auth['User']['netflix_access_key'])): 
				echo $html->link($html->image("signin_netflix.png", array('alt'=>'Login With Netflix', 'width'=>'152', 'height'=>'21', 'border'=>'0')),array('controller'=>'users', 'action'=>'getOAuth/netflix'),array('escape'=>false));?>
        <? else: ?>
        <? echo "Netflix Connected"; ?>	<!--	<br><br>   -->
        <? echo $html->link('Refresh Data', array('controller'=>'users','action'=>'new_data','netflix')); ?>

		<?php endif;?>	
    </div>
<div class="left-layer41">Meetup</div>
	<div class="left-layer41"><!-- style="height:10px;width:10px;overflow-y:auto;">-->
		<?php if(empty($_Auth['User']['meetup_access_key'])): 
				echo $html->link($html->image("signin_meetup.png", array('alt'=>'Login With Meetup', 'width'=>'152', 'height'=>'21', 'border'=>'0')),array('controller'=>'users', 'action'=>'getOAuth/meetup'),array('escape'=>false));?>
        <? else: ?>
        <? echo "Meetup Connected"; ?>	
                <? echo $html->link('Refresh Data', array('controller'=>'users','action'=>'new_data','meetup')); ?>

       <? echo $html->link('(Use as Pic)', array('controller'=>'users','action'=>'edit_pic','meetup')); ?>
        <?php endif;?>	
    </div>
<div class="left-layer41">Google</div>
	<div class="left-layer41"><!-- style="height:100px;overflow-y:auto;">-->
		<?php if(empty($_Auth['User']['google_access_token'])): 
				echo $html->link($html->image("signin_google.png", array('alt'=>'Login With Google', 'width'=>'152', 'height'=>'21', 'border'=>'0')),array('controller'=>'users', 'action'=>'getOAuth/google'),array('escape'=>false));?>
        <? else: ?>
        <? echo "Google Connected"; ?>	<!--	<br><br>   -->
		<?php endif;?>	
    </div>
		
                    </div>
                      </div>	</div>
                        
     <? //endif; ?>    
   			
        <div style="float:right;">
	        <div id="fade" class="black_overlay"></div>
            <? echo $this->element('feedback',array("user_type" => "User")); ?>     
		</div>    
        </div>
        </div> 
				

    

	
	
