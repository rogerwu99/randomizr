<span id='<? echo $div_name; ?>'>
<?php  
if ($editing):
	echo $ajax->form(null,'post',array('model'=>'User','action'=>'edit_work','update'=> $div_name)); 
	echo $form->input('val',array('type'=>'text','label'=>false,'value'=>$value)); 
?>	<span><? 	echo $form->submit('Change'); ?></span>
    <? echo $form->end(); ?>
	<span><?	echo $html->link('Cancel',array('controller'=>'users','action'=>'edit'),array(),'Are you sure you want to abandon changes?', false); ?> 	
	</span>
<? else: ?>
 <span><? echo $key; ?></span>&nbsp;<span><? echo $ajax->link('Edit',array('controller'=>'users','action'=>'edit_work',$id,$key), array('update'=>$div_name));?></span><span><? echo $ajax->link('Delete',array('controller'=>'users','action'=>'edit_work',$counter), array('update'=>$div_name));?></span></span><br />
 <? endif; ?>
 </span>