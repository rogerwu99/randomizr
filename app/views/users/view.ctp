<div class="clear"></div>
<div class="users view">
<? if (!$exists): ?>

That user does not exist.


<? else: ?>
<? if ($own_profile): ?>
<div>
You are looking at how your profile looks to others.
</div>
<? else: ?>
You are looking at the profile of <? echo $screen_name; ?> 


<? endif; ?>
<? if (!$own_profile): ?>
<div>
<? echo $html->link('Compare', array('controller'=>'users','action'=>'compare',$screen_name)); ?>
</div>

<? endif; ?>

<? echo $html->image($pic, array('alt'=>'Profile Pic', 'width'=>'50', 'height'=>'50', 'border'=>'0')); ?> 
<div class="lightbox_content_user_block_2">
<? echo $user['Userprofile']['first_name'].' '.$user['Userprofile']['last_name'].'\'s DNA Summary' ?>
<? 	if($user['Userprofile']['gender']=='male'): 
		$gender_span = 'male_icon';
	else:
		$gender_span = 'female_icon'; 
	endif;
?>
<div>
<div class="<? echo $gender_span; ?>"></div>
<div align='right' style="margin-left:40px; margin-top:-55px;"><? echo 'Status: '.($user['Userprofile']['relationship']).'<br>'; ?>
<? echo 'Sign: '.$zodiac.'<br>'; ?>

<? echo 'Politics: '.($user['Userprofile']['political']).'<br>'; ?>
<? echo 'Religion: '.($user['Userprofile']['religion']).'<br>'; ?>
<? echo 'Hometown: '.($user['Userprofile']['hometown']).'<br>'; ?>
	
<? $degree_string = ''; ?>
<? $degree_string .= ($bach_degree) ? 'BS' : '' ; ?>
<? $degree_string .=($master_degree) ? '/ MS' : ''; ?>
<? $degree_string .= ($doctor_degree) ? '/ PhD' : ''; ?>
<? echo 'Education: '.$degree_string.'<br>'; ?>
<? echo 'Studied: '; ?>
<? $limit = sizeof($areas_of_focus); ?>
<? for ($counter=0;$counter<$limit;$counter++){ 
	 echo array_shift($areas_of_focus).' '; 
}?>
<br />
<? echo 'Institution: '; ?>
<? $limit = sizeof($schools); ?>
<? for ($counter=0;$counter<$limit;$counter++){ 
	 echo array_shift($schools).' '; 
}?>

<br />
Currently: <? echo $titles; ?>
<br />In the:  <?  echo $industries; ?> industry.<br />
Most experience in the 
 <? echo array_shift($top_industries); ?> industry. <br />

Others see you as:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo '<b>'.(string)($counter+1).' </b> '.$top_you[$counter].' '; 
	?><?
}
	?>


<br /><br />
Influences:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo '<b>'.(string)($counter+1).'</b> '.$top_interests[$counter].' '; 
	?><?
}

	?>
<br />Your Top 5 Movie Genres:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo '<b>'.(string)($counter+1).'</b> '.$top_movies[$counter].' '; 
	?><?
}
	?>
<br />Top Places you go to:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo '<b>'.(string)($counter+1).' </b> '.$top_categories[$counter].' '; 
	?><?
}
	?>
Top Locations:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo '<b>'.(string)($counter+1).' </b>'.$top_locations[$counter].' '; 
	?><?
}
	?>
<? endif; ?>
</div>	



</div>
</div>
</div>

