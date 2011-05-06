
<?php $page = strtolower($c.'_'.$a); ?>
<div class="login">
	<?php echo $this->element('login'); ?>
</div>
<div class="sidebar5"><div align="center"><? echo $html->image("sidebar_divider.jpg", array('alt'=>'div', 'width'=>'180', 'height'=>'4', 'border'=>'0')); ?></div></div>
		
<?php if($page=='beta_index' || $page=="beta_view_my_profile"): ?>
		<div class="sidebar5"><span class="bodycopy"><strong>The Latest</strong><br />
                    
		    <?php echo $this->element('twitter'); ?><br /><br />
                  </span><? echo $html->link($html->image("twitter_follow.gif", array('alt'=>'Follow Us On Twitter', 'width'=>'162', 'height'=>'35', 'border'=>'0')), 'http://twitter.com/rogerwu99', array('target'=>'_blank', 'escape'=>false)); ?></div>
		<div class="sidebar5"><div align="center"><? echo $html->image("sidebar_divider.jpg", array('alt'=>'div', 'width'=>'180', 'height'=>'4', 'border'=>'0')); ?></div></div>
		<div class="sidebar5">
                  
                    <div class="smallercopy">
                    What do you think?</div>
                  </div>
		<div class="sidebar5"><div align="center"><? echo $html->image("sidebar_divider.jpg", array('alt'=>'div', 'width'=>'180', 'height'=>'4', 'border'=>'0')); ?></div></div>
		<?php endif; ?>