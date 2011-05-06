<?php if(!empty($_Auth['User'])): ?>
	<span class="bodycopy">
	<span class="sidebar5" id="logged_in">
	<span class="sidebar_desktop_adjustment">
		<?php 
			if ($_Auth['User']['path']!=''):  
				echo $html->image($_Auth['User']['path'], array('alt' => 'Pic', 'width' => 50, 'height' => 50, 'class' => 'top', 'align'=>'left'));
			endif; 
		?>
			<? if ($this->params['action']=='view_my_profile'){
					echo $_Auth['User']['name'];
				}
				else {	
					echo $html->link($_Auth['User']['name'], array('controller'=>'users','action'=>'view_my_profile')); 
				}
				?>
                <strong> | </strong>
                <? if ($this->params['action']=='edit'){
					echo 'Settings';
				}
				else {	
					echo $html->link('Settings', array('controller'=>'users', 'action'=>'edit'));
				}
				?>	
				
				<strong>|</strong>
			<?php echo $html->link('Sign Out', array('controller'=>'users', 'action'=>'logout')); ?>
		<? endif; ?>		
	</span>
	
	</span>
    
	</span>
<div class="clear"></div>
