<div id="leftcolumn_user" class="bodycopy" style="overflow:auto;">
     				
    <br /><br />
<div style="height:1500px;width:700px;">
<? echo $html->image($pic, array('alt'=>'Profile Pic', 'width'=>'80', 'height'=>'80', 'border'=>'0')); ?> 
<? //pr($your_genres); ?><br />
<? echo $html->link('View Public Profile', array('controller'=>'users','action'=>'view',$_Auth['User']['screen_name'])); ?><!--	<br><br>   -->
<div class="lightbox_content_user_block_1">
<? echo($_Auth['User']['name']);
	echo $_Auth['User']['screen_name'];
 ?>


<div align="right">
<? if($bach_degree): ?>
You have a bachelors degree.
<? endif; ?>
<? if($master_degree): ?>
You have a masters degree.
<? endif; ?>
<br />
<? if (!is_null($areas_of_focus)): ?>
Your studied: 
<? for ($counter=0;$counter<sizeof($areas_of_focus);$counter++){ 
	 echo array_shift($areas_of_focus).' '; 
}?>
<? endif; ?>
<Br />

<? if (!is_null($schools)): ?>
You went to: 

<? for ($counter=0;$counter<sizeof($schools);$counter++){ 
	 echo array_shift($schools).' '; 
}?>
<? endif; ?>

<br />
<? if (!is_null($titles)): ?>
You are currently <? echo $titles; ?>
 and work in the  <?  echo $industries; ?> industry.<br />
<? endif; ?>
<? if (!is_null($top_industries)): ?>
 You have the most experience in the 
 <? echo array_shift($top_industries); ?> industry. <br />
<? endif; ?>
<? if (!is_null($top_interests) || (!empty($top_interests))): ?>
You are influenced by:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo (string)($counter+1).' '.$top_interests[$counter]; 
	?><br /><?
}
	?>
<? endif; ?>
<? if (!is_null($top_movies) || (!empty($top_movies))) : ?>    
Your Top 5 Movie Genres:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo (string)($counter+1).' '.$top_movies[$counter]; 
	?><br /><?
}
	?>
   <? endif ;?>
    <? if (!is_null($top_categories) || (!empty($top_categories))) : ?>    

You like to go to:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo (string)($counter+1).' '.$top_categories[$counter]; 
	?><br /><?
}
	?>   <? endif ;?>
    <? if (!is_null($top_locations) || (!empty($top_locations))) : ?>    

You frequent:<br />
<? for ($counter=0;$counter<5;$counter++){
	echo (string)($counter+1).' '.$top_locations[$counter]; 
	?><br /><?
}
	?>
    <? endif; ?>
        <? if (!is_null($top_you) || (!empty($top_you))) : ?>    

You are seen as :<br />
<? for ($counter=0;$counter<5;$counter++){
	echo (string)($counter+1).' '.$top_you[$counter]; 
	?><br /><?
}
	?>
<? endif; ?>
</div>
</div>
	
</div>

<div style="float:right;">
	        <div id="fade" class="black_overlay"></div>
            <? //echo $this->element('feedback',array("user_type" => "User")); ?>     
		</div>    
        </div>