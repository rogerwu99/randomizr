<?php App::import('Sanitize'); ?>
<klickable id="<?php echo $video['Video']['id']; ?>"
	title="<?php $title = Sanitize::clean($video['Video']['title'], array('unicode'=>true));
	echo $title;
	?>"
	description="<?php $description = Sanitize::clean($video['Video']['description'], array('unicode'=>true));
	echo $description;
	?>"
	name="<?php $title = Sanitize::clean($video['Video']['name'], array('unicode'=>true));
	echo $name;
	?>"
  <?  if($yt['flag']==1) { $url = $yt['url']; } else { $url = $video['Video']['url']; } ?>
	url="<?php 
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
	?>"
	>
	<?php foreach($video['Hotspot'] as $hotspot): ?>
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
		<hotspot id="<?php echo $hotspot['id']; ?>" 
			name="<?php echo  Sanitize::clean($hotspot['name'], array('unicode'=>true)); ?>" 
			description="<?php echo Sanitize::clean($hotspot['description'], array('unicode'=>true)); ?>" 
			url="<?php echo $hotspot['url']; ?>"  
			image_url="<?php echo Sanitize::clean($hotspot['HotspotThumb']['filename'], array('unicode'=>true)); ?>"
		>
			<?php foreach($hotspot['Keyframe'] as $frame): ?>
			<keyframe  id="<?php echo $frame['id']; ?>" 
			name= "<?php echo Sanitize::clean($frame['name']); ?>" 
			status= "<?php echo Sanitize::clean($frame['status']); ?>" 
			video_time= "<?php echo Sanitize::clean($frame['video_time']); ?>" 
			x="<?php echo round($frame['x'], 2); ?>" 
			y="<?php echo round($frame['y'], 2); ?>" 
			width="<?php echo round($frame['width'], 2); ?>" 
			height="<?php echo round($frame['height'], 2); ?>"
			/>
			<?php endforeach; ?>
		</hotspot>
	<?php endforeach; ?>
</klickable>