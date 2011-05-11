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
You are comparing <? echo $user['User']['screen_name']; ?> 
with <? echo $other_user['User']['screen_name']; ?> 


<? endif; ?>

<? echo $html->image($other_user['User']['path'], array('alt'=>'Profile Pic', 'width'=>'50', 'height'=>'50', 'border'=>'0')); ?> 
<? echo $html->image($user['User']['path'], array('alt'=>'Profile Pic', 'width'=>'50', 'height'=>'50', 'border'=>'0')); ?> 
<div class="lightbox_content_user_block_2">
<? echo $user['Userprofile']['first_name'].' '.$user['Userprofile']['last_name'].' and '.$other_user['Userprofile']['first_name'].' '.$other_user['Userprofile']['last_name']; ?>
<? 	if($user['Userprofile']['gender']=='male'): 
		$gender_span = 'male_icon';
	else:
		$gender_span = 'female_icon'; 
	endif;
?>
<div>Your Match Score: <? echo $score; ?><br />
Hometown: <? echo $distance; ?><br />
Astrology: <? echo $astrology; ?> <br />
Personal Information: <? echo $personal; ?><br />
School Distance: <? echo $edu_distance; ?><Br />
Education Institution: <? echo 	$education; ?><br />
Level of Education: <? echo $bachelor; ?>
<? echo $master; ?>
<? echo $doctor; ?>



Work: <? echo $work; ?><br />
			
			
		

<? $degree_string = ''; ?>
<? $degree_string .= ($bachelor) ? 'BS' : '' ; ?>
<? $degree_string .=($master) ? '/ MS' : ''; ?>
<? $degree_string .= ($doctor) ? '/ PhD' : ''; ?>
<? echo 'Education: '.$degree_string.'<br>'; ?>
<? echo 'Studied: '; ?>
<? echo $majors; ?>


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

