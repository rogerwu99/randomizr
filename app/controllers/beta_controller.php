<?php
App::import('Vendor', 'simplegeo', array('file' => 'SimpleGeo.php'));
class BetaController extends AppController 
{
    var $name = 'Beta';
    var $uses = array('User', 'Mail','Reward','Location','Merchant','Punch','Punchcards','Redemption'); 
    var $helpers = array('Html', 'Form', 'Javascript', 'Xml', 'Crumb', 'Ajax');
    var $components = array('Utils', 'Email', 'RequestHandler');
   
    function index($id=null)
    {
	 	if (is_null($id)){
			if(is_null($this->Auth->getUserId())){
         		Controller::render('/deny');
        	}
			else {
				//echo 'no id, logged in';
				$this->User->recursive = -1;
		   		$user = $this->Auth->getUserInfo();
				$this->set(compact('user'));
				$this->redirect(array('action'=>'view_my_profile'));
	 		}
		}
		
		else {
			$this->Session->write('hash_value',$id);
			if(is_null($this->Auth->getUserId())){
		//		echo 'yes id, not logged in';
         		
				$this->redirect(array('/'));
			
				// create a login screen for mobile only
			}
			else {
				//echo $id;
				//echo 'yes id, yes logged in';
			
				//do the lat long check
				// redirect you back to another function
				
				$client = new Services_SimpleGeo('ZJNHYqVpyus8vEwG357mRa8Eh7gwq4WN','yzgWLLsY8QqAB3c2bDhNSCSbDDERaV8E');
				$ip=$_SERVER['REMOTE_ADDR'];
				if ($ip=='::1') {
					$results = $client->getContextFromIPAddress();
				}
				else {
					$results = $client->getContextFromIPAddress($ip);
				}
				$url = "http://where.yahooapis.com/geocode?q=".$results->query->latitude.",".$results->query->longitude."&gflags=R&flags=J&appid=cENXMi4g";
				$address = json_decode(file_get_contents($url));
				$full_address = $address->ResultSet->Results[0]->line1." ".$address->ResultSet->Results[0]->line2;
				$this->set('simplegeo_address',$full_address);
				$this->set('simplegeo_lat',$results->query->latitude);
				$this->set('simplegeo_long',$results->query->longitude);
				$this->Session->write('my_lat',$results->query->latitude);
				$this->Session->write('my_long',$results->query->longitude);
				$this->Session->write('my_address',$full_address);
				$stuff = $this->Session->read('redeem');
				echo ($stuff);
				if ($this->Session->check('redeem')){
						// did you want to redeem?
						// assume you do
				
					$this->set('redeem',true);
					$db_results1 = $this->Reward->find('first',array('conditions'=>array('Reward.id'=>$this->Session->read('redeem'))));
					if (empty($db_results1)){
						echo 'There was an error';
					}
					else {
						$this->set('results',$db_results1);
					}
								
				}
				else {
					//echo 'no redeem';
					$this->set('redeem',false);
				}
			
			}
			
		}
	}
    function send()
	{
		$results = $this->params['url'];
		$lat=$results['latitude'];
		$long=$results['longitude'];
		
		$id = $this->Session->read('hash_value');
		$picture_name = 'QRCode_'.$id.'.png';
		$db_results = $this->Location->find('first',array('conditions'=>array('Location.qr_path'=>$picture_name)));
		
		
		if (!empty($db_results)){
			$earth_radius = 6371;
			$lat_center = $db_results['Location']['lat'];
			$long_center = $db_results['Location']['long'];
			$delta_lat = deg2rad($lat - $lat_center);
			$delta_long = deg2rad($long - $long_center);
			$a = sin($delta_lat/2) * sin($delta_lat/2) + cos(deg2rad($lat)) * cos(deg2rad($lat_center)) * sin($delta_long/2) * sin($delta_long/2);
			$c = 2 * atan2(sqrt($a),sqrt(1-$a));
			$distance = $earth_radius * $c;
			$this->set('distance',sprintf("%.4f",$distance));
			$this->set('lat',sprintf("%.4f",$lat));
			$this->set('long',sprintf("%.4f",$long));
			$this->set('lat_center',sprintf("%.4f",$lat_center));
			$this->set('long_center',sprintf("%.4f",$long_center));
			$db_results2 = $this->Merchant->find('first',array('conditions'=>array('Merchant.id'=>$db_results['Location']['merchant_id'])));
			if ($distance <= 0.5){
				
				$db_results1 = $this->Punchcards->find('first',array('conditions'=>array('Punchcards.user_id'=>$this->Auth->getUserId(),
																						 'Punchcards.location_id'=>$db_results['Location']['id']
																						 )));
				$legal = false;
				if (!empty($db_results1)){
					
		//			echo	date('d',strtotime($db_results1['Punchcards']['current_punch_at'])).' current punch';
					if (date('d',strtotime($db_results1['Punchcards']['current_punch_at']))==date('d')){
						
						
						// right here i should parse by # of visits / 24 hours
						
	//					echo $db_results['Location']['max_visits']. ' max visit'; 
					
						if ($db_results['Location']['max_visits']>1){
							//query the punch table and find all of today's visits
							$db_results5=$this->Punch->find('all',array('conditions'=>array('Punch.user_id'=>$this->Auth->getUserId(),
																							'Punch.location_id'=>$db_results['Location']['id']),
																		'order'=>array('Punch.created DESC')));
							$total_visits_today = 0;
							$too_close = false;
//						echo date('d',strtotime($db_results5[$key]['Punch']['created']));
							foreach ($db_results5 as $key=>$value){
								if (date('d',strtotime($db_results5[$key]['Punch']['created']))==date('d')){
									$total_visits_today++;
			//						echo abs(date('H')-date('H',strtotime($db_results5[$key]['Punch']['created']))).' abs';
	
									if(abs(date('H')-date('H',strtotime($db_results5[$key]['Punch']['created'])))<(24/$db_results['Location']['max_visits'])) {
				//						echo abs(date('H')-date('H',strtotime($db_results5[$key]['Punch']['created']))).' abs';
					//					echo 'in here';
										$too_close = true;
										break;							
									}
								}
								else {
									break;
								}
							}
							if ($db_results['Location']['max_visits'] > $total_visits_today){
								$legal=true;
							}
						}
						else {
							$legal = true;
						}
					}
					else {
						$legal = true;
					}
				}
				else {
					$legal=true;
				}
				if ($legal && !$too_close){		
					$this->Punch->create();
					$this->data['Punch']['user_id']=$this->Auth->getUserId();
					$this->data['Punch']['location_id']=$db_results['Location']['id'];
					$this->data['Punch']['merchant_id']=$db_results2['Merchant']['id'];
					$this->Punch->save($this->data);
					$this->set('message','Your visit has been successfully recorded!');
					$this->set('num_punches',$db_results1['Punchcards']['current_punch']+1); //+1 because we are reading the DB prior to writing it
			
				}
				else {
					$this->set('num_punches',$db_results1['Punchcards']['current_punch']); 
					$this->set('message','This location only allows a maximum number of visits each day, come back tomorrow!');
				}
			}
			
			else { // too far away
				$this->set('message','There was an error, please contact us with the codes below (#200)');
			}
			
			//var_dump($db_results2);
			$this->set('merchant',$db_results2['Merchant']['name']);
			$this->set('name',$db_results['Location']['description']);
			$this->set('address',$db_results['Location']['address']);
			$this->set('too_close',$too_close);
			
		}
		else { // venue doesn't exist
			$this->set('message','There was an error, please contact us with the codes below (#100)');
		}
	}
	function redeem($id=null)
	{
		if(is_null($this->Auth->getUserId())){
        	Controller::render('/deny');
        }
		else {
			$user = $this->Auth->getUserInfo();
			$db_results1 = $this->Reward->find('first',array('conditions'=>array('Reward.id'=>$id)));
			if (empty($db_results1)){
				echo 'There was an error';
			}
			else {
				
				// LETS MAKE SURE THAT YOU CAN REALLY REDEEM
				
				
				
				$this->set(compact('user'));
				$this->set('results',$db_results1);
				$this->Session->write('redeem',$id);
			}
//		var_dump($db_results1);
	//	$this->redirect('/');
		}
	}
	function grab()
	{
		$results = $this->params['url'];
		$lat=$results['latitude'];
		$long=$results['longitude'];
		$id = $this->Session->read('hash_value');
		$picture_name = 'QRCode_'.$id.'.png';
		$db_results = $this->Location->find('first',array('conditions'=>array('Location.qr_path'=>$picture_name)));
		$legal = false;
		
		if (!empty($db_results)){
			$earth_radius = 6371;
			$lat_center = $db_results['Location']['lat'];
			$long_center = $db_results['Location']['long'];
			$delta_lat = deg2rad($lat - $lat_center);
			$delta_long = deg2rad($long - $long_center);
			$a = sin($delta_lat/2) * sin($delta_lat/2) + cos(deg2rad($lat)) * cos(deg2rad($lat_center)) * sin($delta_long/2) * sin($delta_long/2);
			$c = 2 * atan2(sqrt($a),sqrt(1-$a));
			$distance = $earth_radius * $c;
			$this->set('distance',sprintf("%.4f",$distance));
			$this->set('lat',sprintf("%.4f",$lat));
			$this->set('long',sprintf("%.4f",$long));
			$this->set('lat_center',sprintf("%.4f",$lat_center));
			$this->set('long_center',sprintf("%.4f",$long_center));
			
			$db_results2 = $this->Merchant->find('first',array('conditions'=>array('Merchant.id'=>$db_results['Location']['merchant_id'])));
			$db_results4 = $this->Reward->find('first',array('conditions'=>array('Reward.id'=>$this->Session->read('redeem'))));
			
			if ($distance <= 0.5){
				$user = $this->Auth->getUserInfo();
				$visit_tally = 0;
				// ONE MORE CHECK TO MAKE SURE YOU CAN REALLY REDEEM
				$db_results3=$this->Punchcards->find('all',array('conditions'=>array('Punchcards.user_id'=>$user['id'])));
				if (!empty($db_results3)) {
					foreach ($db_results3 as $key=>$value){
						
						// all we care about is THIS merchant
						$loc = $this->Location->find('first',array('conditions'=>array('Location.id'=>$db_results3[$key]['Punchcards']['location_id'])));
						$mer = $this->Merchant->find('first',array('conditions'=>array('Merchant.id'=>$loc['Location']['merchant_id'])));
						
						if ($mer['Merchant']['id'] == $db_results2['Merchant']['id']){
							$visit_tally += $db_results3[$key]['Punchcards']['current_punch'];
							$visit_tally -= $db_results3[$key]['Punchcards']['last_redemption'];
							
						}
					}
					if ($db_results4['Reward']['threshold']<=$visit_tally){
						// this is good!
						
						$this->Redemption->create();
						$this->data['Redemption']['user_id']=$this->Auth->getUserId();
						$this->data['Redemption']['reward_id']=$db_results4['Reward']['id'];
						$this->data['Redemption']['location_id']=$loc['Location']['id'];
						$this->data['Redemption']['threshold']=$db_results4['Reward']['threshold'];
						$this->data['Redemption']['merchant_id']=$db_results2['Merchant']['id'];
						$this->Redemption->save($this->data);
						echo 'Reward ID '.$this->Redemption->id;
						$legal = true;
						$this->set('message','Congratulations, please show your screen to the cashier');
					
					}
					else {
						$this->set('message', 'there was an error - you do not have enough points');
					}
				}
				else {
					$this->set('message', 'there was an error - you do not have any visits');
				}
			}
			else { // too far away
				$this->set('message','There was an error, please contact us with the codes below (#200)');
			}
		}
		else { // venue doesn't exist
			$this->set('message','There was an error, please contact us with the codes below (#100)');
		}
		
		if ($legal){
			// debit the visits from the account
			
			$this->set('time',time());	
			$this->set('results',$db_results4);
		}
		$this->Session->delete('redeem');
		
	}
}
?>
