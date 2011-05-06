<div class="clear"></div>
<div id="leftcolumn_user" class="bodycopy">
	You are about to redeem <? echo $results['Reward']['description']; ?>
    
    for <? echo $results['Reward']['threshold']; ?>
	<? if ($results['Reward']['threshold']<2) : ?>
     point
     <? else: ?>
     points
     <? endif; ?>
    <br />
	from 
	<? echo $results['Merchant'][0]['name']; ?>
    <? echo $html->image('/img/uploads/'.$results['Merchant'][0]['path'],array('alt'=>'Logo','width'=>75,'height'=>75)); ?>
    <br />
    Exit this application and scan the QR code at the location in which you want to redeem!
	
</div>
        
        