<div id="leftcolumn_user" class="bodycopy">
 <div class="base-layer">
<h4 class="table-caption-mobile">&nbsp;&nbsp;&nbsp;ACTIVE REWARDS <? echo $html->link('(Back)', array('controller'=>'users','action'=>'view_my_profile')); ?></h4>
                    <div class="table-row-head-mobile">&nbsp;
        				<div class="left-layer22">Pts</div>
                        <div class="left-layer24">Reward</div>
				        
 				        <div class="left-layer22a">Start</div>
        				<div class="left-layer22a">End</div>
 				        <div class="left-edit-layer22">&nbsp;</div>
 				        <div class="right-layer11">&nbsp;</div>
 			        </div>
                  <?php //echo $html->link('My Rewards', array('controller'=>'users', 'action'=>'my_rewards')); ?>
                  <? //var_dump($mer_array_no_dupes); ?>
	    			<div class="table-top-mobile">
        				<? $odd = true; ?>
                        <? if (empty($mer_array_no_dupes)): ?>
                        You have no rewards yet!
                        <? endif; ?>
				        <?php foreach ($mer_array_no_dupes as $key=>$value){ ?>
						<div class='table-row-odd'>&nbsp;
                        <?	echo 'Active Points at: '.$mer_array_no_dupes[$key]['Merchant']['name'].'   ';
							for ($i=0;$i<sizeof($num_points);$i++){
								if ($num_points[$i]->merchant_id==$mer_array_no_dupes[$key]['Merchant']['id']){
									for ($j=0;$j<$num_points[$i]->number;$j++){
										echo $html->image('star.png',array('alt'=>'star','width'=>20,'height'=>20,'class'=>'top'));
									}
									break;
								}
							}
						?>	
						</div>	
						<?	foreach ($mer_array_no_dupes[$key]['Reward'] as $key1=>$value1){
							if ($mer_array_no_dupes[$key]['Reward'][$key1]['deleted']==0):
							$div_name = 'rewdiv_'.$mer_array_no_dupes[$key]['Reward'][$key1]['id'];
						?>
        				<div id="<? echo $div_name; ?>">
        				<? $class_name = ($odd) ? 'table-row-even' : 'table-row-odd'; ?>
            			<div class="<? echo $class_name; ?>">&nbsp;
                        	<? $val = ($mer_array_no_dupes[$key]['Reward'][$key1]['threshold'] < 10) ? '&nbsp;&nbsp;'.$mer_array_no_dupes[$key]['Reward'][$key1]['threshold'] : $mer_array_no_dupes[$key]['Reward'][$key1]['threshold']; ?>
			            	<div class="left-layer22"><? echo $val; ?></div>
							<div class="left-layer24">&nbsp;&nbsp;<? echo $mer_array_no_dupes[$key]['Reward'][$key1]['description']; ?></div>
							<div class="left-layer22a"><? echo date('m/d/y',strtotime($mer_array_no_dupes[$key]['Reward'][$key1]['start_date'])); ?></div>
                			<? $end_date = (is_null($mer_array_no_dupes[$key]['end_date'])) ? 'none' : date('m/d/y',strtotime($mer_array_no_dupes[$key]['Reward'][$key1]['end_date'])); ?>
							<div class="left-layer22a"><? echo $end_date; ?></div>
                            <div class="left-edit-layer22">
								<? 	if ($num_points[$i]->number>=$mer_array_no_dupes[$key]['Reward'][$key1]['threshold']):
										echo $html->link('Redeem',array('controller'=>'beta','action'=>'redeem',$mer_array_no_dupes[$key]['Reward'][$key1]['id']));
									endif;				
								
								?>
                            </div>	
   							</div>
       					</div>
       					<div class="space-line"></div>
						<?	$odd = !$odd;
							endif;
						}
						}?>
    				</div><br />
                    </div>
                    </div>
 				    