<div id="leftcolumn_user" class="bodycopy">
 <div class="base-layer">
<h4 class="table-caption-mobile">&nbsp;&nbsp;&nbsp;MY REWARDS <? echo $html->link('(Back)', array('controller'=>'users','action'=>'view_my_profile')); ?></h4>
                   
        			 <div class="table-row-head-mobile">&nbsp;
        				<span class="left-layer81">Location</span>
				        <span class="left-layer84">Reward</span>
 				        <div class="left-layer85">Points</div>
 				        <div class="left-layer83">Date Redeemed</div>
                        <div class="left-layer82"></div>
 			        </div>
				   	<?php //echo $html->link('My Spots', array('controller'=>'users', 'action'=>'my_spots')); ?></legend>
  
        			<div class="table-top-mobile">
           			<? $even = true; ?>
                    <? if (empty($redemptions)): ?>
                        You have no visits yet!
                    <? endif; ?>
					<?php 
//						var_dump($rewards);
						foreach ($rewards as $key=>$value){
			  				$class_name = ($even) ? 'table-row-even' : 'table-row-odd'; ?>
            				<div class="<? echo $class_name; ?>">&nbsp;
              					<div class="left-layer81"><? echo $rewards[$key]->merchant.':'.$rewards[$key]->location_des;?>: <? echo date('m/d/y',strtotime($rewards[$key]->redeem_date)); ?></div>
			  				</div>
                            <? 	$even=!$even; ?>
                            <? $class_name = ($even) ? 'table-row-even' : 'table-row-odd'; ?>
            				<div class="<? echo $class_name; ?>">&nbsp;
              				
                            	<div class="left-layer84">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $rewards[$key]->description; ?>: <? echo $rewards[$key]->threshold; ?></div>
			  				</div>
                            <div>	<div class="left-layer85"><? echo $rewards[$key]->threshold; ?></div>
                        		<div class="left-layer83"><? echo date('m/d/y',strtotime($rewards[$key]->redeem_date)); ?></div>
                                <div class="left-layer82"><? echo $rewards[$key]->location.','.$rewards[$key]->zip; ?></div>
                        	</div>
	    				<div class="space-line"></div>
					<? 	$even=!$even; ?>
					<?	}?> 
                   	</div> 
					<br /><br />
                    </div>
                    </div>
 				    