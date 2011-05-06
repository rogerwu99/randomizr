	<div id="closable">
		<? echo $message; ?>
		<span class="smallercopy_nav"><br />Confirmation Code:<? echo time(); ?>dI<? echo $distance; ?>aI<? echo $lat; ?>oI<? echo $long; ?>oaI<? echo $lat_center; ?>ool<? echo $long_center; ?></span>
	</div>
    <div id="venue_info">
		
    	<? if (!empty($results)): ?>
        	
        	You can receive : <? echo $results['Reward']['description']; ?>
            <br />for : <? echo $results['Reward']['threshold']; ?> points
            <br />at : <? echo $results['Merchant'][0]['name']; ?>
            <br />This was redeemed at <span id='time'><? echo date("H:i:s",$time); ?></span> and expires in 2 hours!
<span id="countbox"></span>
  </div>
        <? else: ?>
        	<? echo "Ther was an error in processing your reward, please contact us with the above"; ?>
        <? endif; ?>    
