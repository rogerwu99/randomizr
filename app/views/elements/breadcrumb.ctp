<? if ($page == 'dashboard'): ?>
	<div class="breadcrumbs">Home &gt;</div>
<? elseif ($page == 'Edit Hotspot'): ?>
	<div class="breadcrumbs"><?php echo $html->link('Home', '/'); ?> &gt; <?php echo $html->link($title, array('controller'=>'hotspots', 'action'=>'show_vid', 'id'=>$id)); ?>  &gt; <?= $page ?></div>
<? elseif ($page == 'Contact Us'): ?>
	<?php if($_Auth['Access']['Beta']==1): ?>
		<div class="breadcrumbs"><?php echo $html->link('Home', '/'); ?> &gt; <?= $page ?></div>
	<? else: ?>
		<div class="breadcrumbs"><?php echo $html->link('Home', '/'); ?> &gt; <?= $page ?></div>
	<? endif; ?>
<? elseif ($page == 'Preview Video' || $page == 'Make Hotspots'): ?>
	<div class="breadcrumbs"><?php echo $html->link('Home', '/'); ?> &gt; <? echo $html->link('My Videos', array('controller'=>'beta','action'=>'my_videos')); ?> &gt; <?= $page ?></div>
<? else: ?>
<div class="breadcrumbs"><?php echo $html->link('Home', '/'); ?> &gt; <?= $page ?></div>
<? endif; ?>
