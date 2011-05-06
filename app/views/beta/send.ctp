
	<div id="closable">
	<? //echo $too_close.' too'; ?>
    	<? echo $message; ?>
		<br />Confirmation Code:<? echo time(); ?>dI<? echo $distance; ?>aI<? echo $lat; ?>oI<? echo $long; ?>oaI<? echo $lat_center; ?>ool<? echo $long_center; ?>
	</div>
    <div id="venue_info">
    	<? echo	$merchant; ?><br />
    	<? echo $name; ?> <br />
    	<? echo $address; ?>
    </div>
    My Points:
		<? echo $num_punches; ?>
		<? for ($i=0;$i<$num_punches;$i++){ 
			echo $html->image('star.png',array('alt' => 'star')); 
		}
		?>
