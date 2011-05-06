<div id="leftcolumn_user" class="bodycopy">
 <div class="base-layer">
 <h4 class="table-caption-mobile">&nbsp;&nbsp;&nbsp;MY SPOTS <? echo $html->link('(Back)', array('controller'=>'users','action'=>'view_my_profile')); ?></h4>
                   
        			<div class="table-row-head-mobile">&nbsp;
        				<div class="left-layer71">Name</div>
 				        <div class="left-layer94">Address</div>
				        <div class="left-layer92">Zip</div>
				        <div class="left-edit-layer22">&nbsp;</div>
        				<div class="right-layer11">&nbsp;</div>
        			</div>
				   	<?php //echo $html->link('My Spots', array('controller'=>'users', 'action'=>'my_spots')); ?></legend>
  
        			<div class="table-top-mobile">
           				
 			       	<? $even = true; ?>
                    <? if (empty($loc_array)): ?>
                        You have no visits yet!
                    <? endif; ?>
	
					<?php 
						foreach ($loc_array as $key=>$value){
			   			if ($loc_array[$key]['Location']['deleted']==0):
						$div_name = 'locdiv_'.$loc_array[$key]['Location']['id']; ?>
 					<div id="<? echo $div_name; ?>">
        			<? $class_name = ($even) ? 'table-row-even' : 'table-row-odd'; ?>
            		<div class="<? echo $class_name; ?>">&nbsp;
              			<div class="left-layer71"><? echo $mer_array[$key]['Merchant']['name'];?> : <? echo $loc_array[$key]['Location']['description']; ?></div>
			  			<div class="left-layer94"><? echo $loc_array[$key]['Location']['address']; ?></div>
			  			<div class="left-layer92"><? echo $loc_array[$key]['Location']['zip']; ?></div>
                        <div class="left-layer72">All Time Visits: &nbsp;
                        <? 	for ($j=0;$j<$loc_array[$key]['Location']['visits'];$j++){
								echo $html->image('star.png',array('alt'=>'star','width'=>20,'height'=>20,'class'=>'top'));
							}
						?>
                        </div>
	    				
     				</div>
    				</div>
	 				<div class="space-line"></div>
					<? 	$even=!$even; 	
						endif;
					}?> 
                   	</div> 
					</div></div>