<? if ($mail_sent):  ?>
<script type="text/javascript">
document.getElementById('fade').style.display='block';
</script>
<? echo "Thank you for your feedback!"; ?>
<a href = "javascript:void(0)" onclick = "document.getElementById('feedback_div').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
<? $mail_sent=false; ?>
<? else: ?>
<a href = "javascript:void(0)" onclick = "document.getElementById('feedback_div').style.display='block';document.getElementById('fade').style.display='block'">Feedback?</a>
<? endif; ?>
<div id="feedback_div" class="white_content" style="text-align:center">
<span class="bodycopy" style="text-align:center" ><? if ($user_type == 'Merchant'):
 		echo 'Merchant';
		else: 
		 echo 'Customer'; 
		endif;
		 ?>
         Feedback Center 
</span><br />
<div class="smallercopy1"  style="text-align:center">We're here to help you with anything.<Br />  
Help us make your experience better or tell us what you like!</div>
<?php echo $form->create('Feedback'); ?>
	<?php echo $form->input('description',array('type'=>'textarea','label'=>false)); ?>
    <? if ($user_type == 'Merchant'):
 		echo $ajax->submit('Send',array('url'=>array('controller'=>'merchants','action'=>'merchant_feedback'),'update'=>'feedback_div'));
		else: 
		echo $ajax->submit('Send',array('url'=>array('controller'=>'users','action'=>'user_feedback'),'update'=>'feedback_div'));
		endif;
		 ?>
<? echo $form->end(); ?>      
	<a href = "javascript:void(0)" onclick = "document.getElementById('feedback_div').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
	
</div>
