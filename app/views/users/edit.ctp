
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

						<div class="left-layer41">
						<?php echo $form->input('religion', array('label' => false, 'class' => 'big_mobile_1','value'=>$user['Userprofile']['religion'])); ?>
                        <? //echo $user['Userprofile']['religion']; ?><!-- Edit -->
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
						
						if ($counter > 0){
							if ($interest[$counter]['category']!=$interest[$counter-1]['category']){
								echo '<b><i>'.$interest[$counter]['category'].'</i></b><br>';
							}
						
						}
						else {
							echo '<b><i>'.$interest[$counter]['category'].'</i></b><br>';					
						}
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
                        <? //if (!empty($aspirations)): ?>
                        <? // hide this for now ?>
                        <? if (false): ?>
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
                        <? if (!empty($work)): 
						 for ($counter=0;$counter<sizeof($work);$counter++){
						$title_name = 'edit_work_title_'.$counter;
						$company_name = 'edit_work_company_'.$counter;
						$industry_name = 'edit_work_industry_'.$counter;
						$whole_entry = 'delete_work_'.$counter;
						?>
        <div id='<? echo $whole_entry; ?>' style="border:1px solid orange;">
	                        
                        <span id='<? echo $title_name; ?>'>Title: <? echo $work[$counter]["title"]; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'title'), array('update'=>$title_name));?></span><br />
                        <span id='<? echo $company_name; ?>'>Company: <? echo $work[$counter]["employer"]['name']; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'company'), array('update'=>$company_name));?></span><br />
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
	                        
                        <span id='<? echo $degree_name; ?>'>Degree: <? echo $schools[$counter]["degree"]['name']; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'degree','School'), array('update'=>$degree_name));?></span><br />
                        <span id='<? echo $school_name; ?>'>School: <? echo $schools[$counter]["school"]['name']; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'school','School'), array('update'=>$school_name));?></span><br />
                        <span id='<? echo $major_name; ?>'>Major: <? echo $schools[$counter]["concentration"]['name']; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$counter,'major','School'), array('update'=>$major_name));?></span><br />
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
        <? echo $html->link('Refresh Data', array('controller'=>'users','action'=>'getOAuth','facebook')); ?>

         <? echo $html->link('(Use as Pic)', array('controller'=>'users','action'=>'edit_pic','facebook')); ?>
         
         <!--	<br><br>   -->
				
		<?php endif;?>	
    </div>
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
				

    

	
	
