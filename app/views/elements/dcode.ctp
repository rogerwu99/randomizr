		<div  style="font-size:10px;float:right;margin-top:-90px;">
<span><?	echo $form->create('DC');
			echo $form->input('DC.text', array('type'=>'text','label'=>'Discount Code? ')); 				
			?><span class="error" style="color:#F00">
				  	<? if ($error) { echo $error; }
	?></span>
<span style="float:right;">		 <? echo $ajax->submit('Apply', array('url'=> array('controller'=>'merchants', 'action'=>'code'), 'update' => 'jsplan'));
echo $form->end();	
?></span>
</span>
	</div>