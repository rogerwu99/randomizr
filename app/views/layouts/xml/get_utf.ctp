<?php App::import('Sanitize'); ?>

<klickable id="<?php echo $video['Video']['id']; ?>"
	title="<?php $title = Sanitize::clean($video['Video']['title'], array('unicode'=>true));
	echo $title;
	?>"
	url="<?php $url = $yt['url'];
	echo $url;
	?>"
	url_valid="<?php $url_v = $yt['valid'];
	echo $url_v;
	?>"
	width="<?php $width =$video['Video']['width'];
	echo $width;
	?>"
	height="<?php $height = $video['Video']['height'];
	echo $height;
	?>
	">
	
<?php foreach($hotspots as $hotspot): ?>
<?php
	
	if(is_null($hotspot['HotspotThumb']['filename']))
		{
			$hotspot['HotspotThumb']['filename'] = 'default.gif'; 
		}
	if(($hotspot['description'])=='default')
		    {
		        $hotspot['description'] == 'Klickable';
		    }		
	if($hotspot['url']=='default')
	    {
	        $hotspot['url'] = 'http://klickable.tv';
	    }
	
?>
<hotspot id="<?php echo $hotspot['Hotspot']['id']; ?>" 
		name="<?php echo  Sanitize::clean($hotspot['Hotspot']['name'], array('unicode'=>true)); ?>" 
		thumb="<?php echo Sanitize::clean($hotspot['Hotspot']['HotspotThumb']['filename'], array('unicode'=>true)); ?>"
		description="<?php echo Sanitize::clean($hotspot['Hotspot']['description'], array('unicode'=>true)); ?>" 
		url="<?php echo $hotspot['url']; ?>"  
	/>
<?php endforeach; ?>
<?php foreach($frames as $frame): ?>
	<key id="<?php echo $frame['Frame']['id']; ?>" 
			hid= "<?php echo $frame['Frame']['hotspot_id']; ?>" 
			x="<?php echo round($frame['Frame']['x'], 2); ?>" 
			y="<?php echo round($frame['Frame']['y'], 2); ?>" 
			w="<?php echo round($frame['Frame']['width'], 2); ?>" 
			h="<?php echo round($frame['Frame']['height'], 2); ?>"
			s="<?php echo round($frame['Frame']['start'], 2)*10; ?>"
			e="<?php echo round($frame['Frame']['end'], 2)*10; ?>"
			/>
<?php endforeach; ?>

</klickable>