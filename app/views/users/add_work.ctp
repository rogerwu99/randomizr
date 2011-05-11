<span id='<? echo $div_name; ?>'>
<?php  
if ($editing):
?>
Record saved!

<!-- we can do a quick $key check to determine if we display a dropdown or a text field -->







    <? else: ?>
    <? echo $ajax->form(null,'post',array('model'=>'User','action'=>'add_work','update'=>$div_name));?>
<input type="hidden" name="data[User][type]" value="<? echo $type; ?>" /> 
	<? echo ucwords($first).': '; ?>
 	<? echo $form->input($first,array('type'=>'text','label'=>false, 'div'=>false)); 
	 ?>
	 <br />
         <? echo ucwords($second).': '; ?>
 	<? echo $form->input($second,array('type'=>'text','label'=>false, 'div'=>false)); 
	 ?><br /><? echo ucwords($third).': '; ?>
 	<? echo $form->input($third,array('type'=>'text','label'=>false,'div'=>false)); 
	 ?><? 	echo $form->submit('Add', array('div'=>false)); ?>

        <? echo $form->end(); ?>

    
 <? endif; ?>
 </span>