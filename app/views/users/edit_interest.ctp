<?php  
if ($editing):
 echo $ajax->form(null,'post',array('model'=>'User','action'=>'edit_interest','update'=> $div_name)); ?>
 	<input type='hidden' name='data[User][id]' value='<? echo $id; ?>' />
	<div class="left-layer15"><?php echo $form->input('key',array('type'=>'text','label'=>false,'value'=>$id)); ?></div>
	<span style="left-layer15"><? 	echo $form->submit('Change'); ?></span>
    <? echo $form->end(); ?>
	<span style="left-layer15"><?	echo $html->link('Cancel',array('controller'=>'users','action'=>'edit'),array(),'Are you sure you want to abandon changes?', false); 	
		echo $form->end(); 
	?></span>
<? else: ?>
<? $name = 'delete_'.$key;
	  $div_name = 'Interest_'.$key;
						?>
        				<span id="<? echo $div_name; ?>">
 <span><? echo $key; ?></span>&nbsp;<span><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_interest',$key), array('update'=>$div_name));?></span><span><?php echo $form->checkbox($name, array('value' => $key));?>Delete</span></span><br />
 <? endif; ?>