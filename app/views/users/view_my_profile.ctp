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
<? //if (!is_null($top_interests) || (!empty($top_interests))): ?>
<!--You are influenced by:<br />
<? //for ($counter=0;$counter<5;$counter++){
	//echo (string)($counter+1).' '.$top_interests[$counter]; 
	?><br />--><?
//}
	?>
<? //endif; ?>
<? /*
	$control_yi = $your_interests[0]->value;
		$length=5;
		$count=0;
			for ($counter = 0; $counter<$length;$counter++){
				if ($your_interests[$counter]->category!='staff-picks'){
//					echo 'Category  :' .  $your_interests[$counter]->category;
					$value = sprintf('%01.2f',$your_interests[$counter]->value / $control_yi);
	//				echo 'Value of Match : '.$value;
		//			echo '<br>';
					$cats[$count]=$your_interests[$counter]->category;
					$id[$count++]=$value;
					
				}
				else $length++;
			}
	*/	?>
<?  // echo '<img src=\'pchart/'. $id[0].'/'. $id[1] .'/' .$id[2].'/'.$id[3].'/'.$id[4].'/'.$cats[0].'/'.$cats[1].'/'.$cats[2].'/'.$cats[3].'/'.$cats[4].'/Influences/\' />';  ?>
                <? // if (!is_null($top_you) || (!empty($top_you))) : ?>    
<!--
You are seen as :<br />-->
<? //for ($counter=0;$counter<5;$counter++){
//	echo (string)($counter+1).' '.$top_you[$counter]; 
	?><br /><?
//}
	?>
<? // endif; ?>
<?
	/*		$control_am = $aboutme[0]->value;
		$length=5;
		$count=0;
	//		echo 'About Me<br>';
			for ($counter = 0; $counter<$length;$counter++){
				if ($aboutme[$counter]->category!='staff-picks'){
		//			echo 'Category  :' .  $aboutme[$counter]->category;
					$value = sprintf('%01.2f',$aboutme[$counter]->value / $control_am);
			//		echo 'Value of Match : '.$value;
				//	echo '<br>';
				$cats[$count]=$aboutme[$counter]->category;
				$id[$count++]=$value;
				}
				else $length++;
			}
*/
?>
<? //   echo '<img src=\'pchart/'. $id[0].'/'. $id[1] .'/' .$id[2].'/'.$id[3].'/'.$id[4].'/'.$cats[0].'/'.$cats[1].'/'.$cats[2].'/'.$cats[3].'/'.$cats[4].'/You/\' />';  ?>


<? //if (!is_null($top_movies) || (!empty($top_movies))) : ?>    
<!--Your Top 5 Movie Genres:<br />
<? //for ($counter=0;$counter<5;$counter++){
	//echo (string)($counter+1).' '.$top_movies[$counter]; 
	?><br /><?
//}
	?>
   <? //endif ;?>
    <? //if (!is_null($top_categories) || (!empty($top_categories))) : ?>    

You like to go to:<br />
<? //for ($counter=0;$counter<5;$counter++){
	//echo (string)($counter+1).' '.$top_categories[$counter]; 
	?><br />--><?
//}
	?>   <? //endif ;?>
    <? //if (!is_null($top_locations) || (!empty($top_locations))) : ?>    

<!--You frequent:<br />
<? //for ($counter=0;$counter<5;$counter++){
	//echo (string)($counter+1).' '.$top_locations[$counter]; 
	?><br /><?
//}
	?>
    <? //endif; ?>
    <? //echo var_dump($friends); ?>
    -->
See <? echo $html->link('friends',array('controller'=>'users','action'=>'view_my_friends/50')); ?>    
</div>
</div>
	
</div>

<div style="float:right;">
	        <div id="fade" class="black_overlay"></div>
            <? //echo $this->element('feedback',array("user_type" => "User")); ?>     
		</div>    
        </div>