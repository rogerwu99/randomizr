<div id="leftcolumn_user" class="bodycopy" style="overflow:auto;">
     				
    <br /><br />
<div style="height:1500px;width:700px;">
<? echo $html->image($pic, array('alt'=>'Profile Pic', 'width'=>'50', 'height'=>'50', 'border'=>'0')); ?>
<br /> 
	<? for ($counter = $start; $counter<$limit; $counter++){
	?><span class="smallercopy" style="width:200px;border:thin;"><?		echo $html->link($friends[$counter]->name,array('controller'=>'users','action'=>'fbcompare',$friends[$counter]->id));
			echo $html->image('http://graph.facebook.com/'.$friends[$counter]->id.'/picture', array('width'=>30, 'height'=>30)); ?>
            </span>		
	<?  if ($counter % 3 == 0) echo '<br>'; 
		}
	?>
    <? if ($limit==50) {
		echo '0-50';
	}
	else {
		echo $html->link('0-50',array('controller'=>'users','action'=>'view_my_friends',50));
	}?><?
    for ($page = 1; $page < (sizeof($friends) / 50); $page++) {
		$upper_bound = ($page+1) * 50; 
		$lower_bound = $upper_bound - 50;
		$string = $lower_bound.'-'.$upper_bound;
		
		if ($upper_bound == $limit){
			echo ' | '.$string; 
		}
		else {
			echo ' | '.$html->link($string,array('controller'=>'users','action'=>'view_my_friends',$upper_bound));
		}
	}
	?>
</div>
</div>
	
</div>

<div style="float:right;">
	        <div id="fade" class="black_overlay"></div>
            <? //echo $this->element('feedback',array("user_type" => "User")); ?>     
		</div>    
        </div>