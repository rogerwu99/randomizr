  <div class="content1">
        <br />	
	<?php $recent_pops = $this->requestAction('pops/most_recent/8'); ?>
			<?php if (count($recent_pops) > 0): ?>
			<div id="container">
									<?php //var_dump($recent_pops); ?>
			<?php
        			foreach($recent_pops as $pop):
			?>
	        		
				<div id="row">
				<div id="left">&nbsp;&nbsp;&nbsp;</div>	
				<div id="middle">
					 <?php echo $html->image($pop['Pop']['pic_url'], array('alt' => 'Pic', 'width' => 50, 'height' => 50, 'class' => 'top'));?>
                       		
                		</div>
				<div id="middle">&nbsp;&nbsp;&nbsp;</div>
				<div id="right" class="smallercopy"><?php echo $html->link($pop['Pop']['content'], array('controller'=>'pops', 'action'=>'view', 'id'=>$pop['Pop']['url'])); ?>
				</div>
				<div id="right">&nbsp;&nbsp;&nbsp;</div>
				</div>
     				<br />
			<?
        			endforeach;
			?>
			</div>
			<?php else: ?>
               			<div class="bodycopy">
                       			<strong>There are no posts!</strong>
	   			</div>
			<?php endif; ?>
		          </div>
	