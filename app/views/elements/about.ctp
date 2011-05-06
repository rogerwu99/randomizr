<div class="msg_head">
	<div class="fat_head  pink">
	</div>
	<h3>About</h3>
	<div class="little_head pink"></div>
</div>
<div class="msg_body">
		<?php $content = $this->requestAction('static_pages/get_page/about'); ?>
		<?php //pr($about); ?>
		<div class="body">
			<?php echo html_entity_decode($text->truncate($content[0]['StaticPage']['body'], 300, '...', false, false)); ?>
			<?php echo $html->link('More', '/pages/about'); ?>
		</div>
	<div class="little_head pink"></div>
</div>