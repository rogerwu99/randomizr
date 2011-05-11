<span id='<? echo $div_name; ?>'>
<?php  
if ($editing):
	echo $ajax->form(null,'post',array('model'=>'User','action'=>'edit_work','update'=> $div_name)); 
	echo ucwords($key).': ';
	echo $form->input('val',array('type'=>'text','label'=>false,'value'=>$value, 'div'=>false)); 
	
	
	
	
?>	

<input type="hidden" name="data[User][id]" value="<? echo $id; ?>" /> 
<input type="hidden" name="data[User][key]" value="<? echo $key; ?>" /> 

<input type="hidden" name="data[User][type]" value="<? echo $type; ?>" /> 



<? 	echo $form->submit('Change', array('div'=>false)); ?>


<!-- we can do a quick $key check to determine if we display a dropdown or a text field -->







    <? echo $form->end(); ?>
	<span><?	echo $html->link('Cancel',array('controller'=>'users','action'=>'edit'),array(),'Are you sure you want to abandon changes?', false); ?> 	
	</span>
    <? else: ?>
    <? echo ucwords($key).': '; ?>
 	<? echo $value; ?><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$id,$key,$type), array('update'=>$div_name));?>
    
    
 <? endif; ?>
 </span>