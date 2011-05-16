<div id="leftcolumn_user" class="bodycopy" style="overflow:auto;">
     				
    <br /><br /><br /><br /><br />
<div class="lightbox_content_user_block_1">
<div align="left" style="width:500px;"><? echo $html->image($user['User']['path'], array('width'=>50,'height'=>50)); 
 echo $user['Userprofile']['first_name'].' '.$user['Userprofile']['last_name'];

		//echo $user['Userprofile']['gender'];
		//echo $user['Userprofile']['relationship'];
		//echo $user['Userprofile']['religion'];
		
	?>
    <br />
<?
?>
</div>
<div align="right" style="width:500px;"><? echo $html->image('https://graph.facebook.com/'.$remote_user->id.'/picture', array('width'=>50,'height'=>50));
	echo $remote_user->name;
		//echo $remote_user->birthday;
		//echo $remote_user->gender;
		//echo $remote_user->relationship_status;
		//echo $remote_user->political;
		//echo $remote_user->religion;

    ?>
    <br />
    <? if (!empty($user['Userprofile']['relationship']) && (!empty($remote_user->relationship_status))){
		similar_text($user['Userprofile']['relationship'],$remote_user->relationship_status,$percent);
		if ($percent > 50) echo 'You are both '.$user['Userprofile']['relationship']; 
	}
	?>
    <? if (!empty($user['Userprofile']['political']) && (!empty($remote_user->political))){
		similar_text($user['Userprofile']['political'],$remote_user->political,$percent);
		if ($percent > 50) echo 'You are both '.$user['Userprofile']['political']; 
	}
	?>
    <? if (!empty($user['Userprofile']['religion']) && (!empty($remote_user->religion))){
		similar_text($user['Userprofile']['religion'],$remote_user->religion,$percent);
		if ($percent > 50) echo 'You are both '.$user['Userprofile']['religion']; 
	}
	?>
    
    <? if (!empty($user['Userprofile']['birthday']) && (!empty($remote_user->birthday))){
    	 echo 'Sign Compare: ';
	echo $user_sign. ' vs '. $other_user_sign;
?><br /><?
	echo 'Birthday Compare: ';
	if ($days>0) echo $days.' days ';
	if ($months>0) echo $months. ' months ';
	if ($years>0) echo $years. ' years';
	?><br />
<?	}
	?><?
	if (!empty($user['Userprofile']['hometown']) && (!empty($remote_user->hometown->name))){
		echo 'Hometown Compare: ';
		if ($d_miles != 0){
			echo 'Distance from '.$user['Userprofile']['hometown'].' to '.$remote_user->hometown->name.' is about '.sprintf('%20d',$d_miles).' miles';
		}
		else {
			echo 'You are both from the same hometown!';
		}
	?> <br />
<?	}
	if (!empty($user['Userprofile']['location']) && (!empty($remote_user->location->name))){
		echo 'Location Compare: ';
		if ($l_miles != 0){
			echo 'Distance from '.$user['Userprofile']['location'].' to '.$remote_user->location->name.' is about '.sprintf('%20d',$l_miles).' miles';	}
		else {
			echo 'You both live in the same town!';
		}
	}
		 
	
?>
</div><?
?>	<? 
	if (!empty($intersect)) {
		echo 'Common Likes: <br>';
		for ($counter=0;$counter<sizeof($intersect);$counter++){
			echo $intersect[$counter]->name.' ';
			echo '('.$intersect[$counter]->category.')<br>';
		}
	}
	if (!empty($work_matches)) {
		var_dump($work_matches);
	}
if (!empty($school_matches)) {
		echo 'Common Schools: <br>';
		for ($counter = 0;$counter<sizeof($school_matches);$counter++){
			if ($school_matches[$counter]->type == 'school'){
				echo 'You both attended: ';		
			}
			if ($school_matches[$counter]->type == 'concentration'){
				echo 'You both studied: ';
			}
			if ($school_matches[$counter]->type == 'degree'){
				echo 'You both earned: ';
			}
			echo $school_matches[$counter]->value->name;
			echo '<br>';
		}
	}
	
		?>
		
		
		
		
    

</div>

<div style="float:right;">
	        <div id="fade" class="black_overlay"></div>
            <? //echo $this->element('feedback',array("user_type" => "User")); ?>     
		</div>    
        </div>