<?php
App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'oauth_consumer.php'));
App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'OAuth.php'));
App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'OAuth2.php'));

class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Ajax');
	var $components = array('Auth', 'Email','Paypal','Session');
	var $uses = array('User', 'Mail', 'Movie', 'Interest','Place','Work','School','Userprofile','Wlookup','Twitter');

	function index()
	{
		if(is_null($this->Auth->getUserId())){
       		Controller::render('/deny');
        }
		else {
			$this->redirect(array('controller'=>'users','action'=>'view_my_profile'));
		}
	}

	function _login($username=null, $password=null)
	{
		if ($username && $password){
			$user_record_1=array();
			$user_record_1['Auth']['username']=$username;
			$user_record_1['Auth']['password']=$password;
			$this->Auth->authenticate_from_oauth($user_record_1['Auth']);
			return;		
		}
	}
	
	function login()
	{
		$this->_login($this->data['Auth']['username'],$this->Auth->hasher($this->data['Auth']['password']));
		if ($this->Session->check('hash_value')){
			$this->redirect(array('controller'=>'beta','action'=>'index',$this->Session->read('hash_value')));
		}
		else {
			$this->redirect(array('action'=>'view_my_profile'));
		}
	}
	
	function register($step=null)
	{
		if (!empty($this->data)){
			if ($this->data['User']['step']==1){
				$email = $this->data['User']['email'];
				$name=$this->data['User']['screen_name'];
				$password = $this->data['User']['new_password'];
				$confirm =$this->data['User']['confirm_password'];
				$accept = $this->data['User']['accept'];
				$this->data=array();
				$this->User->create();
				$this->data['User']['screen_name']=strtolower($name);
				$this->data['User']['email'] = (string) $email;
				$this->data['User']['new_password']=$password;
				$this->data['User']['confirm_password']=$confirm;
				$this->data['User']['accept']=$accept;
				$password = $this->data['User']['password'] = $this->Auth->hasher($password); 
				$username = $this->data['User']['username']= (string) $email;
				$this->data['User']['path']='default.png';
		
				$this->User->set($this->data);
				if ($this->User->validates()){
					$this->User->save();
					$this->_login($username,$password);
					$this->set('step',2);
				}
				else {
					$this->set('errors', $this->User->validationErrors);
					unset($this->data['User']['new_password']);
	    			unset($this->data['User']['confirm_password']);
					$this->set('step',1);
				}
			}
		}
		elseif ($step==2){
			$this->set('step',2);
		}
		elseif ($step==3){ //after fb auth
			list ($master, $fb_data, $fb_movies, $fb_user_likes) = $this->getFacebookData();
			$this->set('master',$fb_user_likes);
			$this->set('step',3);
			//,$fb_user_likes,$fb_data,$fb_movies);
		}	
		else {
			$this->set('step',1);
			$this->render();
		}
		
	}
	
	
	function logout()
	{
		$user=$this->Auth->getUserInfo();
		$this->Session->destroy();
		if(!empty($session)){
			$this->Auth->logout($url);
		}
		else {
		    $this->Auth->logout();
		}
	}
	private function createConsumer($type) {
		switch ($type) {
			case 'facebook':
				return new OAuth_Consumer('189267044425329','b127d742f40502d8a9c05b31d6acc43b');
		}
    }
	
	function getOAuth($service=NULL){
		$consumer = $this->createConsumer($service);
		$redirect_url = '';
		switch ($service){
			case 'facebook':
				$redirect_url = 'https://www.facebook.com/dialog/oauth?client_id=189267044425329&redirect_uri='.ROOT_URL.'/users/callback/facebook'.'&scope=user_about_me,user_activities,user_birthday,user_education_history,user_events,user_groups,user_hometown,user_interests,user_relationships,user_religion_politics,user_status,user_website,user_work_history,email,user_checkins,user_likes,friends_likes,friends_interests,friends_checkins,friends_activities,friends_work_history,friends_relationship_details,friends_website,friends_religion_politics,friends_relationships,friends_location,friends_relationship_details,friends_hometown,friends_education_history,friends_birthday,friends_about_me';
				break;
		}
		$this->redirect($redirect_url);
	}
	
	
	function callback($service=NULL){
		$consumer = $this->createConsumer($service);
		$requestTokenName = $service.'_request_token';
		$accessTokenName = $service.'_access_token';
		$accessKeyName = $service.'_access_key';
		$accessSecretName = $service.'_access_secret';
		$access_url = '';
		switch ($service){
			case 'facebook':
				$access_url = 'https://graph.facebook.com/oauth/access_token?client_id=189267044425329&redirect_uri='.ROOT_URL.'/users/callback/facebook&client_secret=b127d742f40502d8a9c05b31d6acc43b&code='.$this->params['url']['code'];
				break;
		}
	//	echo 'done';
		$this->User->read(null,$this->Auth->getUserId());
			$accessToken = file_get_contents($access_url);
			
			if ($service=='facebook'){
				$this->data['User']['facebook_access_key'] = $accessToken;
				$this->Session->write('facebook_access_key',$accessToken);
			}
		//	echo 'saved';
		$this->User->save($this->data);
		//$this->new_data($service);
		//echo 'pull data';
		$this->getFacebookData();
		
		$this->redirect(array('action'=>'view_my_friends/50'));

	}
	


	function getFacebookData(){
		$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
		$accessToken = $this->Session->read('facebook_access_key');
		$fb_user = json_decode(file_get_contents('https://graph.facebook.com/me?' . $accessToken));
	
		$name = preg_split('/[\f\n\r\t\v ]/',$fb_user->name);
		$last_name = '';
		$first_name = '';
		for ($counter=0;$counter<sizeof($name);$counter++){
			if($counter==(sizeof($name)-1)) {
				$last_name = $name[$counter];
			}
			else {
				$first_name .= $name[$counter];
			}
		}
		
		if (empty($user['Userprofile']['id'])){
			$this->Userprofile->create();
		}
		else {
			$this->Userprofile->read(null,$user['Userprofile']['id']);
		}
		if (sizeof($name) == 1) $this->data['Userprofile']['first_name'] = $name[0];
		else {
			$this->data['Userprofile']['first_name']=ucwords($first_name);
			$this->data['Userprofile']['last_name'] = ucwords($last_name);
		}
		$this->data['Userprofile']['hometown']= $fb_user->hometown->name;
		$this->data['Userprofile']['birthday']=date("Y-m-d H:i:s", strtotime($fb_user->birthday));
		$this->data['Userprofile']['gender']=$fb_user->gender;
		$this->data['Userprofile']['location']=$fb_user->location->name;
		$this->data['Userprofile']['relationship']=$fb_user->relationship_status;
		$this->data['Userprofile']['religion']=$fb_user->religion;
		$this->data['Userprofile']['political']=$fb_user->political;
		$this->data['Userprofile']['user_id']=$this->Auth->getUserId();
		$this->Userprofile->set($this->data);
		$this->Userprofile->save();
		$this->User->read(null,$this->Auth->getUserId());
		$this->data['User']['name']=$this->data['Userprofile']['first_name'].' '.$this->data['Userprofile']['last_name'];
		$this->User->set($this->data);
		$this->User->save();
//		echo 'Userprofile saved';
		$fb_user_likes = json_decode(file_get_contents('https://graph.facebook.com/me/likes?'.$accessToken));
		$fb_user_activities = json_decode(file_get_contents('https://graph.facebook.com/me/activities?'.$accessToken));
		$fb_user_interests = json_decode(file_get_contents('https://graph.facebook.com/me/interests?'.$accessToken));

		if (empty($user['Interest']['id'])){
			$this->Interest->create();
		}
		else {
			$this->Interest->read(null,$user['Interest']['id']);
		}
		$this->data['Interest']['likes']=json_encode($fb_user_likes->data);
		$this->data['Interest']['activities']=json_encode($fb_user_activities->data);
		$this->data['Interest']['interests']=json_encode($fb_user_interests->data);
		$this->data['Interest']['user_id']=$this->Auth->getUserId();
		$this->Interest->set($this->data);
		$this->Interest->save();
//		echo 'interests saved';
		if (empty($user['Work']['id'])){
			$this->Work->create();
		}
		else {
			$this->Work->read(null,$user['Work']['id']);
		}
		$this->data['Work']['body'] = json_encode($fb_user->work);		
		$this->Work->set($this->data);
		$this->Work->save();
	//	echo 'work saved';		
		if (empty($user['School']['id'])){
			$this->School->create();
		}
		else {
			$this->School->read(null,$user['School']['id']);
		}
		$this->data['School']['body'] = json_encode($fb_user->education);		
		$this->School->set($this->data);
		$this->School->save();
	//	echo 'school saved';

		
		$fb_user_checkins = json_decode(file_get_contents('https://graph.facebook.com/me/checkins?'.$accessToken));
		if (empty($user['Place']['id'])){
			$this->Place->create();
		}
		else {
			$this->Place->read(null,$user['Place']['id']);
		}
		$this->data['Place']['body'] = json_encode($fb_user_checkins->data);
		$this->Place->set($this->data);
		$this->Place->save();
	}

	
	
	function new_data($type){
		switch ($type){
			case 'facebook':
				$this->getFacebookData();
				break;		
		}
	}
	
	
	
	
	function friends($flag=false){
		/*if (!$flag){
			$this->Session->write('friends','true');
			$this->getOAuth('facebook');
		}
		else {*/
			$count=0;
			$friend_array = array();
			$accessToken = $this->Session->read('facebook_access_key');
			$friend_url = json_decode(file_get_contents('https://graph.facebook.com/me/friends?' . $accessToken));
		//	var_dump($friend_url);
			$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
			$control = json_decode($user['Interest']['likes']);
			for ($counter=0;$counter<sizeof($friend_url->data); $counter++){
				$likes = json_decode(file_get_contents('https://graph.facebook.com/'.$friend_url->data[$counter]->id.'/likes?'.$accessToken));
				$intersect = array();
				for ($mid_counter = 0; $mid_counter<sizeof($control);$mid_counter++){
					for($inner_counter=0;$inner_counter<sizeof($likes->data);$inner_counter++){
						if ($control[$mid_counter]->id == $likes->data[$inner_counter]->id){
							array_push($intersect,$control[$mid_counter]);
						}
					}
					
				}
				if (!empty($intersect)){
					$friend_array[$count]->person = $friend_url->data[$counter];
					$friend_array[$count]->likes = $intersect;
					$friend_array[$count]->pic = 'http://graph.facebook.com/'.$friend_url->data[$counter]->id.'/picture';

				}
			}
			//$this->redirect(array('action'=>'view_my_profile'));
			return $friend_array;
		//}
	}
	function getFriends(){
		$friend_array = array();
		//$count =0;
		$user = $this->Auth->getUserInfo(); 
		$friend_url = json_decode(file_get_contents('https://graph.facebook.com/me/friends?' . $user['facebook_access_key']));
		
			usort($friend_url->data, array(&$this, "friend_sort"));

		return $friend_url->data;
	}
	function friend_sort($a,$b){
		if ($a->name > $b->name) return 1;
		elseif($a->name == $b->name) return 0;
		else return -1;
	}
	
	function fbcompare($fb_id){
		$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));

		$remote_user = json_decode(file_get_contents('https://graph.facebook.com/'.$fb_id.'?'. $user['User']['facebook_access_key']));
		
		
		
		$remote_user_likes = json_decode(file_get_contents('https://graph.facebook.com/'.$fb_id.'/likes?'.$user['User']['facebook_access_key']));
	
			$control = json_decode($user['Interest']['likes']);
			
				$likes = json_decode(file_get_contents('https://graph.facebook.com/'.$fb_id.'/likes?'.$user['User']['facebook_access_key']));
				$intersect = array();
				for ($mid_counter = 0; $mid_counter<sizeof($control);$mid_counter++){
					for($inner_counter=0;$inner_counter<sizeof($likes->data);$inner_counter++){
						if ($control[$mid_counter]->id == $likes->data[$inner_counter]->id){
							array_push($intersect,$control[$mid_counter]);
						}
					}
					
				}
		$this->set('user',$user);
		$this->set('remote_user',$remote_user);
		$this->set('intersect',$intersect);
		
		
		
		if (!is_null($user['Userprofile']['hometown']) && !is_null($remote_user->hometown->name)){
			$url = "http://where.yahooapis.com/geocode?line2=".urlencode($user['Userprofile']['hometown'])."&flags=J&gflags=R&appid=cENXMi4g";
			$address = json_decode(file_get_contents($url));
					
			$lat_home = $address->ResultSet->Results[0]->latitude;
			$long_home = $address->ResultSet->Results[0]->longitude;
					
			$url2 = "http://where.yahooapis.com/geocode?line2=".urlencode($remote_user->hometown->name)."&flags=J&gflags=R&appid=cENXMi4g";
			$address2 = json_decode(file_get_contents($url2));
					
			$lat_away = $address2->ResultSet->Results[0]->latitude;
			$long_away = $address2->ResultSet->Results[0]->longitude;
					
			$earth_radius = 6371;
			$delta_lat = deg2rad($lat_home - $lat_away);
			$delta_long = deg2rad($long_home - $long_away);
			$a = sin($delta_lat/2) * sin($delta_lat/2) + cos(deg2rad($lat_home)) * cos(deg2rad($lat_away)) * sin($delta_long/2) * sin($delta_long/2);
			$c = 2 * atan2(sqrt($a),sqrt(1-$a));
			$distance = $earth_radius * $c;
					
			$d_miles = $distance * 0.621371192;
			$this->set('d_miles',$d_miles);
		}
		
		if (!is_null($user['Userprofile']['birthday']) && !is_null($remote_user->birthday)){
			$user_sign = $this->getSign($user['Userprofile']['birthday']);
			$other_user_sign = $this->getSign($remote_user->birthday);
			$diff = abs(strtotime($user['Userprofile']['birthday']) - strtotime($remote_user->birthday));
			$years = floor($diff / (365*60*60*24));
			$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			
			if (date('Y',strtotime($remote_user->birthday)) == date('Y') || date('Y',strtotime($user['Userprofile']['birthday'])) == date('Y')){
				$years = 0;
			}
			
			
			
			$this->set('user_sign',$user_sign);
			$this->set('other_user_sign',$other_user_sign);
			$this->set('years',$years);
			$this->set('months',$months);
			$this->set('days',$days);
		}
		if (!is_null($user['Userprofile']['location']) && !is_null($remote_user->location->name)){
			$url = "http://where.yahooapis.com/geocode?line2=".urlencode($user['Userprofile']['location'])."&flags=J&gflags=R&appid=cENXMi4g";
			$address = json_decode(file_get_contents($url));
					
			$lat_home = $address->ResultSet->Results[0]->latitude;
			$long_home = $address->ResultSet->Results[0]->longitude;
					
			$url2 = "http://where.yahooapis.com/geocode?line2=".urlencode($remote_user->location->name)."&flags=J&gflags=R&appid=cENXMi4g";
			$address2 = json_decode(file_get_contents($url2));
					
			$lat_away = $address2->ResultSet->Results[0]->latitude;
			$long_away = $address2->ResultSet->Results[0]->longitude;
					
			$earth_radius = 6371;
			$delta_lat = deg2rad($lat_home - $lat_away);
			$delta_long = deg2rad($long_home - $long_away);
			$a = sin($delta_lat/2) * sin($delta_lat/2) + cos(deg2rad($lat_home)) * cos(deg2rad($lat_away)) * sin($delta_long/2) * sin($delta_long/2);
			$c = 2 * atan2(sqrt($a),sqrt(1-$a));
			$distance = $earth_radius * $c;
					
			$d_miles = $distance * 0.621371192;
			$this->set('l_miles',$d_miles);
		}
		// compare school and work
		$matches = array();
		$count = 0;
		var_dump($user['School']['body']);
		var_dump($remote_user->education);
		if (!is_null($user['School']['body']) && !is_null($remote_user->education)){
			$my_schools = json_decode($user['School']['body']);
			for ($counter = 0;$counter<sizeof($my_schools);$counter++){
				for ($inner_counter =0;$inner_counter<sizeof($remote_user->education); $inner_counter++){
					similar_text($my_schools[$counter]->school->name, $remote_user->education[$inner_counter]->school->name,$percent);
					if (($my_schools[$counter]->school->id==$remote_user->education[$inner_counter]->school->id &&
						$my_schools[$counter]->school->id!=0) || $percent > 90 ){
						$matches[$count]->value = $my_schools[$counter]->school;
						$matches[$count]->type = 'school';
						$count++;	
					}
					if ($my_schools[$counter]->degree->id == $remote_user->education[$inner_counter]->degree->id &&
						$my_schools[$counter]->degree->id!=0){
						$matches[$count]->value = $my_schools[$counter]->degree;
						$matches[$count]->type = 'degree';
						$count++;
					}
					for ($concentration_counter = 0;$concentration_counter <  sizeof($my_schools[$counter]->concentration); $concentration_counter++){
						if ($my_schools[$counter]->concentration[$concentration_counter]->id == $remote_user->education[$inner_counter]->concentration[$concentration_counter]->id &&
							$my_schools[$counter]->concentration[$concentration_counter]->id!=0){
							//echo 'match';
							$matches[$count]->value = $my_schools[$counter]->concentration[$concentration_counter];
							$matches[$count]->type = 'concentration';
							$count++;
						}
					}
				}
			}
		}
		$this->set('school_matches',$matches);
	//	var_dump($remote_user->work);
	//	var_dump($user['Work']['body']);
	
	
	// let's do a free text search match on work as well i.e. the teddy platt problem of Bloomberg and Bloomberg LP
	
		$matches = array();
		if (!is_null($user['Work']['body']) && !is_null($remote_user->work)){
			$my_work = json_decode($user['Work']['body']);
			for ($counter = 0;$counter<sizeof($my_work);$counter++){
				for ($inner_counter =0;$inner_counter<sizeof($remote_user->work); $inner_counter++){
					similar_text($my_work[$counter]->employer->name, $remote_user->work[$inner_counter]->employer->name,$percent);
					if (($my_work[$counter]->employer->id==$remote_user->work[$inner_counter]->employer->id && 
						$my_work[$counter]->employer->id!=0) || $percent > 80){
						$match->value = $my_work[$counter]->employer;
						$match->type = 'employer';
						array_push($matches, $match);	
					}
					if ($my_work[$counter]->location->id == $remote_user->work[$inner_counter]->location->id &&
						$my_work[$counter]->location->id!=0){
						$match->value = $my_work[$counter]->location;
						$match->type = 'location';
						array_push($matches, $match);
					}
					if ($my_work[$counter]->position->id == $remote_user->work[$inner_counter]->position->id &&
						$my_work[$counter]->position->id!=0){
						$match->value = $my_work[$counter]->position;
						$match->type = 'position';
						array_push($matches, $match);
					}
				}
			}
		}
		$this->set('work_matches',$matches);
		
		
		// get activities and interests
		
		
		
		
	}
	
	function view_my_profile(){
	
		if(is_null($this->Auth->getUserId())){
       		Controller::render('/deny');
        }
		else {
						
	
			$user = $this->Auth->getUserInfo();
			$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
			if (!empty($db_results)){
				$movie_data = (isset($db_results['Movie']['body'])) ? true : false;
			}
			
		
			$this->set('pic',$db_results['User']['path']);
			if (!empty($db_results['Movie']['body'])){
				$movies = json_decode($db_results['Movie']['body']);
				$top_movies = array();
				foreach ($movies as $key=>$value){
					array_push($top_movies,$key);
				}
				$this->set('top_movies',$top_movies);
			}
			if (!empty($db_results['Interest']['body'])){
				$interests = json_decode($db_results['Interest']['body']);
				$top_interests = array();
				foreach ($interests as $key=>$value){
					array_push($top_interests,$key);
				}
				$this->set('top_interests',$top_interests);
			}
			if (!empty($db_results['Place']['locations'])){
				$locations = json_decode($db_results['Place']['locations']);
				$top_locations = array();
				foreach ($locations as $key=>$value){
					array_push($top_locations,$key);
				}
				$this->set('top_locations',$top_locations);
			}
			if (!empty($db_results['Place']['categories'])){
				$categories = json_decode($db_results['Place']['categories']);
				$top_categories = array();
				//var_dump($db_results['Place']['categories']);
				foreach ($categories as $key=>$value){
					array_push($top_categories,$key);
				}
				$this->set('top_categories',$top_categories);
			}
			if (!empty($db_results['Interest']['you_body'])){
				$you = json_decode($db_results['Interest']['you_body']);
				$top_you = array();
				foreach ($you as $key=>$value){
					array_push($top_you,$key);
				}
				$this->set('top_you',$top_you);
			}
			
			if (!empty($db_results['Work']['body'])){
				$work = json_decode($db_results['Work']['body']);
				
				
			}
			if (!empty($db_results['Work']['titles'])){
				$work = json_decode($db_results['Work']['titles']);
		
				foreach ($work as $key=>$value){
					$this->set('titles',$key);			
					break;
				}
			
			}
			if (!empty($db_results['Work']['industries'])){
				$work = json_decode($db_results['Work']['industries'],true);
				$first = true;
				arsort($work, SORT_NUMERIC);
				$top_industries = array();
				foreach ($work as $key=>$value){
					if ($first){
						$this->set('industries',$key);			
						$first = false;
					}
					array_push($top_industries, $key);
				}
				$this->set('top_industries',$top_industries);
				
			}
			if (!empty($db_results['School']['body'])){
				$school = json_decode($db_results['School']['body'],true);
				$parsable_array = array();
				$schools =array();
				$areas_of_focus = array();
				for ($counter = 0;$counter<sizeof($school);$counter++){
					foreach($school[$counter] as $key=>$value){
						if ($key == 'degree') $parsable_array[$key].=$value;
						if ($key == 'school') array_push($schools,$value);
						if ($key == 'major') array_push($areas_of_focus,$value); 
					}
				}
				$master_degree = false;
				$bach_degree = false;
				$doctor_degree = false;
				$doctor_array = array('/\b(?i)phd*\b/','/\bdoctor*\b/');
				$master_array = array('/\bMS\b/','/\b(?i)master*/');
				$bach_array = array('/\b(?i)bachelor*\b/','/\bBS\b/');
				preg_replace($doctor_array,'',$parsable_array['degree'],-1,$doctor);
				if ($doctor>0) $doctor_degree = true;
				preg_replace($master_array,'',$parsable_array['degree'],-1,$masters);
				if ($masters>0) $master_degree = true;
				preg_replace($bach_array,'',$parsable_array['degree'],-1,$bachelors);
				if ($bachelors>0) $bach_degree = true;
				$this->set('bach_degree',$bach_degree);
				$this->set('master_degree',$master_degree);
				$this->set('areas_of_focus',$areas_of_focus);
				$this->set('schools',$schools);
				
			}
			//list($your_interests,$aboutme) = $this->getCategories($db_results['Interest']['body']);
			//$this->set('your_interests',$your_interests);
			//$this->set(compact('aboutme'));

/*			$books = array();
			if (!empty($db_results['Interest']['likes'])){
				$likes = json_decode($db_results['Interest']['likes']);
				for ($counter =0;$counter<sizeof($likes);$counter++){
					if ($likes[$counter]->category == "Book"){
						array_push($books , $likes[$counter]);
					}
				}
					
			}
	*/
	
			$this->set('user',$db_results);
			
	
			
		}
		
		// for travel look at 4sq for outside of the country
	}
	function view_my_friends($limit){
		$user = $this->Auth->getUserInfo();
		$this->set('pic',$user['path']);
		$friend_array = $this->getFriends();
		$this->set('friends',$friend_array);
		$this->set('start',$limit-50);
		$this->set('limit',$limit);
	}
	function getFacebookInterests($tag_cloud,$fb_user_likes){
		$fb_interests=array();
		for($counter=0;$counter<sizeof($fb_user_likes->data);$counter++){
			//if($fb_user_likes->data[$counter]->category == "Interest"){
				array_push($fb_interests,$fb_user_likes->data[$counter]->name);
			//}
		}
		
		// weighting is heavier because of explicit interest on fb
		for($counter=0;$counter<sizeof($fb_interests);$counter++){
			if (!isset($tag_cloud[$fb_interests[$counter]])){
				$tag_cloud[$fb_interests[$counter]]=5;   
			}
			else $tag_cloud[$fb_interests[$counter]]+=5; 
		}
		return $tag_cloud;
	}
	
	function scrub_interests($tag_cloud,$mu_interests,$tw_following=NULL,$tw_lists=NULL){
		$sizes = array(sizeof($mu_interests),sizeof($tw_following),sizeof($tw_lists));
		arsort($sizes,SORT_NUMERIC);
			
			
		if (!is_null($tw_lists) && !is_null($tw_following)){
			
			if ($sizes[0]==sizeof($mu_interests)) $small=$mu_interests;
			elseif ($sizes[0]==sizeof($tw_following)) $small=$tw_following;
			else $small=$tw_lists;
		
			if ($sizes[1]==sizeof($mu_interests)) $med=$mu_interests;
			elseif ($sizes[1]==sizeof($tw_following)) $med=$tw_following;
			else $med=$tw_lists;
		
			if ($sizes[2]==sizeof($mu_interests)) $large=$mu_interests;
			elseif ($sizes[2]==sizeof($tw_following)) $large=$tw_following;
			else $large=$tw_lists;
			
			$sort_size=3;
		}
		elseif (!is_null($tw_following)) {
			if (sizeof($mu_interests)<sizeof($tw_following)) {
				$med=$mu_interests;
				$large=$tw_following;
			}
			else {
				$med=$tw_following;
				$large=$mu_interests;
			}
			$sort_size=2;
		}
		else {
			$large=$mu_interests;
			$sort_size=1;
		}
		if ($sort_size>0){
			//echo $sizes[0]. ' SIZES';
			//for($counter=$sizes[1];$counter<$sizes[2];$counter++){
			for($counter=0;$counter<$sizes[0];$counter++){
				$interest_string_lge = preg_split('/[,? ]+/',$large[$counter]->description); 
				$interest_string_lge = preg_replace($this->stop_words,'',$interest_string_lge);
				//$interest_string_lge = preg_split('/[,? ]+/',$interest_string_lge); 
				$large_in = $interest_string_lge;
			
				for ($inner_counter=0;$inner_counter<sizeof($interest_string_lge);$inner_counter++){
					if (!isset($tag_cloud[strtolower($large_in[$inner_counter])])){
						//echo $large_in[$inner_counter];
						$tag_cloud[strtolower($large_in[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($large_in[$inner_counter])]=$tag_cloud[strtolower($large_in[$inner_counter])]+1;
				}
			}
		}
		if ($sort_size>1){
			for($counter=$sizes[0];$counter<$sizes[1];$counter++){
				$interest_string_med = preg_split('/[,? ]+/',$med[$counter]->description); 
				$interest_string_med = preg_replace($this->stop_words,'',$interest_string_med);
			
				$interest_string_lge = preg_split('/[,? ]+/',$large[$counter]->description); 
				$interest_string_lge = preg_replace($this->stop_words,'',$interest_string_lge);
			
				$inner_loop_strings = array(sizeof($interest_string_med),sizeof($interest_string_lge));
				sort($inner_loop_strings,SORT_NUMERIC);
			
				if ($inner_loop_strings[0]==sizeof($interest_string_med)) {
					$med_in=$interest_string_med;
					$large_in=$interest_string_lge;
				}
				else {
					$med_in=$interest_string_lge;
					$large_in=$interest_string_med;
				}
	
				for ($inner_counter=0;$inner_counter<$inner_loop_strings[0];$inner_counter++){
					if (!isset($tag_cloud[strtolower($med_in[$inner_counter])])){
						$tag_cloud[strtolower($med_in[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($med_in[$inner_counter])]++;
					if (!isset($tag_cloud[strtolower($large_in[$inner_counter])])){
						$tag_cloud[strtolower($large_in[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($large_in[$inner_counter])]++;
				}
				for ($inner_counter=$inner_loop_strings[0];$inner_counter<$inner_loop_strings[1];$inner_counter++){
					if (!isset($tag_cloud[strtolower($large_in[$inner_counter])])){
						$tag_cloud[strtolower($large_in[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($large_in[$inner_counter])]++;
				}
			}
		}
		if ($sort_size>2){
			for($counter=$sizes[1];$counter<$sizes[2];$counter++){
				$interest_string_mu = preg_split('/[,? ]+/',$small[$counter]); 
				$interest_string_mu = preg_replace($this->stop_words,'',$interest_string_mu->description);
			
				$interest_string_twf = preg_split('/[,? ]+/',$med[$counter]->description); 
				$interest_string_twf = preg_replace($this->stop_words,'',$interest_string_twf);
				
				$interest_string_twl = preg_split('/[,? ]+/',$large[$counter]->description); 
				$interest_string_twl = preg_replace($this->stop_words,'',$interest_string_twl);
			
				$inner_loop_strings = array(sizeof($interest_string_mu),sizeof($interest_string_twf),sizeof($interest_string_twl));
				sort($inner_loop_strings,SORT_NUMERIC);
			
				if ($inner_loop_strings[0]==sizeof($interest_string_mu)) $small_in=$interest_string_mu;
				elseif ($inner_loop_strings[0]==sizeof($interest_string_twf)) $small_in=$interest_string_twf;
				else $small_in=$interest_string_twl;
			
				if ($inner_loop_strings[1]==sizeof($interest_string_mu)) $med_in=$interest_string_mu;
				elseif ($inner_loop_strings[1]==sizeof($interest_string_twf)) $med_in=$interest_string_twf;
				else $med_in=$interest_string_twl;
		
				if ($inner_loop_strings[2]==sizeof($interest_string_mu)) $large_in=$interest_string_mu;
				elseif ($inner_loop_strings[2]==sizeof($interest_string_twf)) $large_in=$interest_string_twf;
				else $large_in=$interest_string_twl;
			
				for ($inner_counter=0;$inner_counter<$inner_loop_strings[0];$inner_counter++){
					if (!isset($tag_cloud[strtolower($interest_string_mu[$inner_counter])])){
						$tag_cloud[strtolower($interest_string_mu[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($interest_string_mu[$inner_counter])]++;
					if (!isset($tag_cloud[strtolower($interest_string_twf[$inner_counter])])){
						$tag_cloud[strtolower($interest_string_twf[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($interest_string_twf[$inner_counter])]++;
					if (!isset($tag_cloud[strtolower($interest_string_twl[$inner_counter])])){
						$tag_cloud[strtolower($interest_string_twl[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($interest_string_twl[$inner_counter])]++;
				}
				for ($inner_counter=$inner_loop_strings[0];$inner_counter<$inner_loop_strings[1];$inner_counter++){
					if (!isset($tag_cloud[strtolower($med_in[$inner_counter])])){
						$tag_cloud[strtolower($med_in[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($med_in[$inner_counter])]++;
					if (!isset($tag_cloud[strtolower($large_in[$inner_counter])])){
						$tag_cloud[strtolower($large_in[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($large_in[$inner_counter])]++;
				}
				for ($inner_counter=$inner_loop_strings[1];$inner_counter<$inner_loop_strings[2];$inner_counter++){
					if (!isset($tag_cloud[strtolower($large_in[$inner_counter])])){
						$tag_cloud[strtolower($large_in[$inner_counter])]=1;
					}
					else $tag_cloud[strtolower($large_in[$inner_counter])]++;
				}
			}
		}
		
		
		//	$lists_f[$counter]->name = $tw_user->lists[$counter]->name;
		//	$lists_f[$counter]->description = $tw_user->lists[$counter]->description;
		
		arsort($tag_cloud, SORT_NUMERIC);
		unset($tag_cloud['']);
		unset($tag_cloud[' ']);
	//	var_dump($tag_cloud);
		
		return $tag_cloud;
		
	}
	function like_sort($a,$b){
		if ($a['category'] > $b['category']) return -1;
		elseif ($a['category'] == $b['category']) return 0;
		else return 1;
	}
	function edit($type=null){
		
	 	if(is_null($this->Auth->getUserId())){
          Controller::render('/deny');
         }
		else {
			if (!empty($this->data)) {
				if ($this->data['User']['new_password']!='' && $this->data['User']['new_password']==$this->data['User']['confirm_password']){
					$this->data['User']['password'] = $this->Auth->hasher($this->data['User']['new_password']); 
				}
				$this->data['User']['screen_name']=strtolower($this->data['User']['screen_name']);
				switch ($type){
				}
				$username=$this->User->read(null,$this->Auth->getUserId());
				
				$this->User->set($this->data);
	    		if ($this->User->validates()){
				    $this->User->save();
					$this->_login($username['User']['email'],$username['User']['password']);
		    	    $this->redirect(array( 'action'=>'view_my_profile'));
				}	
				else {
					$this->set('errors', $this->User->validationErrors);
				}
			}
			else {
				$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
				
				
				// let's sort this by category
				$interest = json_decode($user['Interest']['likes'],true);
				
			
				usort($interest, array(&$this, "like_sort"));
				//	var_dump($interest);
				
				$aspirations = json_decode($user['Interest']['body'],true);
				$work = json_decode($user['Work']['body'],true);
				$schools = json_decode($user['School']['body'],true);
				$this->set(compact('schools'));
				$this->set(compact('work'));
				$this->set(compact('aspirations'));
				$this->set(compact('interest'));
				$this->set(compact('user'));
				$relationship = array(
								'Single'=>'Single',
								'In a relationship'=>'In a relationship',
								'Engaged'=>'Engaged',
								'Married'=>'Married',
								'Widowed'=>'Widowed',
								'Separated'=>'Separated',
								'Divorced'=>'Divorced'
							);
				$this->set(compact('relationship'));			
				$months = array(
							"Jan"=>"Jan",
							"Feb"=>"Feb",
							"Mar"=>"Mar",
							"Apr"=>"Apr",
							"May"=>"May",
							"Jun"=>"Jun",
							"Jul"=>"Jul",
							"Aug"=>"Aug",
							"Sep"=>"Sep",
							"Oct"=>"Oct",
							"Nov"=>"Nov",
							"Dec"=>"Dec"
							);
				$this->set(compact('months'));
				$this->set('dates',range(1,31));
				$this->set('years',range(1900,(int)date('Y')-18));
			}
		}
	}
	function edit_interests($type){
		$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
		if ($type==1){
			// need to pull new data 
			$interest = json_decode($user['Interest']['likes'],true);
		//	var_dump($this->data);
			$new_array = array();
			for ($counter=0;$counter<sizeof($interest);$counter++){
				$name = 'delete_'.$counter;
				if (!$this->data['User'][$name]){
					array_push($new_array,$interest[$counter]);
				}
			}
			$this->data['Interest']['likes'] = json_encode($new_array);
			$this->Interest->read(null,$user['Interest']['id']);
			$this->Interest->set($this->data);
			$this->Interest->save();
			// if the registration cookie is set then go thru each page
			//otherwise redirect to view my profile
			//var_dump($this->data);
		}
		elseif ($type==2){
			$aspirations = json_decode($user['Interest']['body'],true);
			$new_array = array();
			foreach ($aspirations as $key=>$value){
				$name = 'delete_'.$key;
				if (!$this->data['User'][$name]){
					$new_array[$key]=$aspirations[$key];
				}
			}
			$this->data['Interest']['body'] = json_encode($new_array);
			$this->Interest->read(null,$user['Interest']['id']);
			$this->Interest->set($this->data);
			$this->Interest->save();
			//var_dump($this->data);
				
		}
		$this->redirect(array('action'=>'view_my_profile'));
	}
	function edit_pic($service){
		if(is_null($this->Auth->getUserId())){
    		Controller::render('/deny');
        }
		else {
			//echo 'hihihi';
			$user = $this->Auth->getUserInfo();
			$consumer = $this->createConsumer($service);
			$access_key = $service.'_access_key';
			$access_secret = $service.'_access_secret';
			switch ($service){
				case 'linkedin':
					$pic_url = $consumer->get($user[$access_key],$user[$access_secret],'http://api.linkedin.com/v1/people/~:(picture-url)', array());;
					$li_user = simplexml_load_string($pic_url);
	//			var_dump($li_user->children());
//							$pic = $li_user->children[0];
					foreach($li_user->children() as $child){
						if ($child->getName()=='picture-url'){
							$pic = $child;
						}
					}
			//}
					break;
			case 'foursquare':
				$fs_user = json_decode(file_get_contents('https://api.foursquare.com/v2/users/self?oauth_token='.$user['foursquare_access_token']));
				$pic = $fs_user->response->user->photo;
				break;
			
			case 'meetup':
				$getData = array('relation'=>'self',
						 'sess'=>'oauth_session');
				$pic_url = $consumer->get($user[$access_key],$user[$access_secret],'https://api.meetup.com/members.json',$getData);
				$mu_user = json_decode($pic_url);
	//			var_dump($mu_user);
				$pic = $mu_user->results[0]->photo_url;
				break;
		
			case 'facebook':
				$fb_user = json_decode(file_get_contents('https://graph.facebook.com/me?' . $user['facebook_access_key']));
				$pic = 'http://graph.facebook.com/'.$fb_user->id.'/picture';
				
				
				break;
				
				
				
			case 'twitter':

				$pic_url = $consumer->get($user[$access_key],$user[$access_secret],'http://api.twitter.com/1/account/verify_credentials.json', array());;
				$tw_user = json_decode($pic_url);
				$pic = $tw_user->profile_image_url;
				break;
		}
		//var_dump($user);
		$this->User->read(null,$this->Auth->getUserId());
		$this->data['User']['path']=$pic;
		$this->User->set($this->data);
		$this->User->save();
		$this->redirect(array('action'=>'view_my_profile'));
			
	}
	}
	
	function view($screen_name = null){
		$user = $this->Auth->getUserInfo();
		$screen_name = strtolower($screen_name);
		if ($screen_name == $user['screen_name']){
			$this->set('own_profile', true);
		}
		else $this->set('own_profile',false);
		$db_results = $this->User->find('first', array('conditions' => (array('User.screen_name'=>$screen_name))));
		//var_dump($db_results);
		if (empty($db_results)){
			$this->set('exists',false);
		}
		else{
			$this->set('exists',true);
			$this->set('pic',$db_results['User']['path']);
			if (!empty($db_results['Movie']['body'])){
				$movies = json_decode($db_results['Movie']['body']);
				$top_movies = array();
				foreach ($movies as $key=>$value){
					array_push($top_movies,$key);
				}
				$this->set('top_movies',$top_movies);
			}
			if (!empty($db_results['Interest']['body'])){
				$interests = json_decode($db_results['Interest']['body']);
				$top_interests = array();
				foreach ($interests as $key=>$value){
					array_push($top_interests,$key);
				}
				$this->set('top_interests',$top_interests);
			}
			if (!empty($db_results['Interest']['likes'])){
				$interests = json_decode($db_results['Interest']['likes']);
				$hobbies = array();
				foreach ($interests as $key=>$value){
					array_push($hobbies,$key);
				}
				$this->set('top_hobbies',$hobbies);
			}
			if (!empty($db_results['Place']['locations'])){
				$locations = json_decode($db_results['Place']['locations']);
				$top_locations = array();
				foreach ($locations as $key=>$value){
					array_push($top_locations,$key);
				}
				$this->set('top_locations',$top_locations);
			}
			if (!empty($db_results['Place']['categories'])){
				$categories = json_decode($db_results['Place']['categories']);
				$top_categories = array();
				foreach ($categories as $key=>$value){
					array_push($top_categories,$key);
				}
				$this->set('top_categories',$top_categories);
			}
			if (!empty($db_results['Interest']['you_body'])){
				$you = json_decode($db_results['Interest']['you_body']);
				$top_you = array();
				foreach ($you as $key=>$value){
					array_push($top_you,$key);
				}
				$this->set('top_you',$top_you);
			}
			if (!empty($db_results['Work']['body'])){
				$work = json_decode($db_results['Work']['body']);
			}	
			if (!empty($db_results['Work']['titles'])){
				$work = json_decode($db_results['Work']['titles']);
		
				foreach ($work as $key=>$value){
					$this->set('titles',$key);			
					break;
				}
			}
			if (!empty($db_results['Work']['industries'])){
				$work = json_decode($db_results['Work']['industries'],true);
				$first = true;
				arsort($work, SORT_NUMERIC);
				$top_industries = array();
				foreach ($work as $key=>$value){
					if ($first){
						$this->set('industries',$key);			
						$first = false;
					}
					array_push($top_industries, $key);
				}
				$this->set('top_industries',$top_industries);
			}
			if (!empty($db_results['School']['body'])){
				$school = json_decode($db_results['School']['body']);
				$parsable_array = array();
				$schools =array();
				$areas_of_focus = array();
				for ($counter = 0;$counter<sizeof($school);$counter++){
					foreach($school[$counter] as $key=>$value){
						if ($key == 'degree') {
							if (!isset($parsable_array['degree'])) $parsable_array[$key]=$value;
							else $parsable_array[$key].=(string)$value;
						}
						if ($key == 'school') array_push($schools,$value);
						if ($key == 'major') array_push($areas_of_focus,$value); 
					}
				}
				$master_degree = false;
				$bach_degree = false;
				$doctor_degree = false;
				$doctor_array = array('/\b(?i)phd*\b/','/\bdoctor*\b/');
				$master_array = array('/\bMS\b/','/\b(?i)master*/');
				$bach_array = array('/\b(?i)bachelor*\b/','/\bBS\b/');
				if (isset($parsable_array['degree'])){
					preg_replace($doctor_array,'',$parsable_array['degree'],-1,$doctor);
					if ($doctor>0) $doctor_degree = true;
					preg_replace($master_array,'',$parsable_array['degree'],-1,$masters);
					if ($masters>0) $master_degree = true;
					preg_replace($bach_array,'',$parsable_array['degree'],-1,$bachelors);
					if ($bachelors>0) $bach_degree = true;
				}
				$this->set('bach_degree',$bach_degree);
				$this->set('master_degree',$master_degree);
				$this->set('doctor_degree',$doctor_degree);
				$this->set('areas_of_focus',$areas_of_focus);
				$this->set('schools',$schools);
			}
			$sign = $this->getSign($db_results['Userprofile']['birthday']);
			$this->set('zodiac', $sign);
			$this->set('user',$db_results);
			$this->set('screen_name',$screen_name);
		}
	}
	function compare($screen_name=null){
		if(is_null($this->Auth->getUserId())){
    		Controller::render('/deny');
        }
		
		$this->set('exists',true);
		$this->set('screen_name',$screen_name);
		$user = $this->Auth->getUserInfo();
		if ($screen_name == $user['screen_name']){
			// you are comparing yourself to yourself
			$this->redirect(array('action'=>'view_my_profile'));
		}
		else {
			$score = 0;
			$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
			$other_user = $this->User->find('first', array('conditions' => (array('User.screen_name'=>$screen_name))));
			$this->set(compact('user'));
			$this->set('other_user',$other_user);
			if (empty($other_user)) $this->set('exists',false);
			// compare interests
			//var_dump($user['Interest']);
			
			
			
//			var_dump($other_user['Interest']);
			$astrology = 0;
			$personal = 0;
			
			if (!is_null($user['Userprofile']['id']) && !is_null($other_user['Userprofile']['id'])){
				// check difference in birthday
				// same sign?
				$user_sign = $this->getSign($user['Userprofile']['birthday']);
				$other_user_sign = $this->getSign($other_user['Userprofile']['birthday']);
				
				$diff = abs(strtotime($user['Userprofile']['birthday']) - strtotime($other_user['Userprofile']['birthday']));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
				
				if ($months == 0 && $days < 10) {
					$astrology += 10;
					$score += 5;
				}
				elseif ($month > 1 && $month < 3) {
					$astrology += 5;
					$score+=2;
				}
				if ($years < 10){
					$score++;
				}
				if ($user_sign == $other_user_sign){
					$astrology += 10;
					$score += 3;
				}
			
				if ($user['Userprofile']['gender']==$other_user['Userprofile']['gender']){
					$score++;
					$personal++;
				}
				similar_text($user['Userprofile']['relationship'],$other_user['Userprofile']['relationship'],$r_match);
				if ($r_match > 50) {
					$personal++;
					$score++;	
				}
				similar_text($user['Userprofile']['religion'],$other_user['Userprofile']['religion'],$re_match);
				if ($re_match > 50) {
					$personal += 2;
					$score+=2;			
				}
				similar_text($user['Userprofile']['political'],$other_user['Userprofile']['political'],$p_match);
				if ($p_match > 50) {
					$personal += 3;
					$score+=3;			
				}
				
				if (!is_null($user['Userprofile']['hometown']) && !is_null($other_user['Userprofile']['hometown'])){
					
					$url = "http://where.yahooapis.com/geocode?line2=".urlencode($user['Userprofile']['hometown'])."&flags=J&gflags=R&appid=cENXMi4g";
					$address = json_decode(file_get_contents($url));
					
					
					$lat_home = $address->ResultSet->Results[0]->latitude;
					$long_home = $address->ResultSet->Results[0]->longitude;
					
					
					
					$url2 = "http://where.yahooapis.com/geocode?line2=".urlencode($other_user['Userprofile']['hometown'])."&flags=J&gflags=R&appid=cENXMi4g";
					$address2 = json_decode(file_get_contents($url2));
					
					$lat_away = $address2->ResultSet->Results[0]->latitude;
					$long_away = $address2->ResultSet->Results[0]->longitude;
					
					
					$earth_radius = 6371;
					$delta_lat = deg2rad($lat_home - $lat_away);
					$delta_long = deg2rad($long_home - $long_away);
					$a = sin($delta_lat/2) * sin($delta_lat/2) + cos(deg2rad($lat_home)) * cos(deg2rad($lat_away)) * sin($delta_long/2) * sin($delta_long/2);
					$c = 2 * atan2(sqrt($a),sqrt(1-$a));
					$distance = $earth_radius * $c;
					
					
					$d_miles = $distance * 0.621371192;
	
					if ($d_miles < 1) {
						$score += 20;
					}
					elseif ($d_miles < 10) {
						$score += 16;
					}
					elseif ($d_miles < 25) {
						$score += 12;
					}
					elseif ($d_miles < 50) {
						$score += 10;
					}
					elseif ($d_miles < 100) {
						$score += 7;
					}
					elseif ($d_miles < 150) {
						$score += 3;
					}
					elseif ($d_miles < 200) {
						$score++;
					}
					$this->set('distance',$d_miles);
				}
			}
			$this->set('astrology',$astrology);
			$this->set('personal',$personal);
			
			if (!is_null($user['Interest']['id']) && !is_null($other_user['Interest']['id'])){
				
				$user_interest = json_decode($user['Interest']['body'], true);
				$other_user_interest =json_decode($other_user['Interest']['body'], true);
				arsort($user_interest,SORT_NUMERIC);
				arsort($other_user_interest,SORT_NUMERIC);
				$common_interests = array_intersect_key($user_interest,$other_user_interest);
	//			var_dump($user_interest);
	//			var_dump($other_user_interest);
				
			}
			
			
			
			
			/***************
			
			array_ intersect_ key
			
			
			array_count_values
			
			
			
			******************/			
			/* put data into arrays
			   if simliar tag a 1
			   if not skip and continue
			   
			*/
			
			// use fb ids?
			
			
			// compare places
			if (!is_null($user['Place']['id']) && !is_null($other_user['Place']['id'])){
				//var_dump($user['Place']['body']);
		
				//var_dump($other_user['Place']['body']);			echo 'checking places';
			}
			
			
			// locations
			// categories
			
			
			// compare movies
			if (!is_null($user['Movie']['id']) && !is_null($other_user['Movie']['id'])){
							echo 'checking movies';
	
				
			}
			
			// compare schools
			if (!is_null($user['School']['id']) && !is_null($other_user['School']['id'])){
				
				//var_dump($user['School']['body']);
				$my_schools = json_decode($user['School']['body'],true);
				$your_schools = json_decode($other_user['School']['body'],true);
				$earth_radius = 6371;
				$education = 0;
				
				
			
				
				$doctor_array = array('/\b(?i)phd*\b/','/\bdoctor*\b/');
				$master_array = array('/\bMS\b/','/\b(?i)master*/');
				$bach_array = array('/\b(?i)bachelor*\b/','/\bBS\b/');
				
				for ($counter = 0;$counter<sizeof($my_schools);$counter++){
					if (isset($my_schools[$counter]['degree'])){
						preg_replace($doctor_array,'',$my_schools[$counter]['degree'],-1,$doctor);
						if ($doctor>0) $my_doctor_degree = true;
						preg_replace($master_array,'',$my_schools[$counter]['degree'],-1,$masters);
						if ($masters>0) $my_master_degree = true;
						preg_replace($bach_array,'',$my_schools[$counter]['degree'],-1,$bachelors);
						if ($bachelors>0) $my_bach_degree = true;
					}
				}
				for ($counter = 0;$counter<sizeof($your_schools);$counter++){
					if (isset($your_schools[$counter]['degree'])){
						preg_replace($doctor_array,'',$your_schools[$counter]['degree'],-1,$doctor);
						if ($doctor>0) $your_doctor_degree = true;
						preg_replace($master_array,'',$your_schools[$counter]['degree'],-1,$masters);
						if ($masters>0) $your_master_degree = true;
						preg_replace($bach_array,'',$your_schools[$counter]['degree'],-1,$bachelors);
						if ($bachelors>0) $your_bach_degree = true;
					}
				}
				
				
				if ($my_bach_degree && $your_bach_degree) $bach_degree = true;
				if ($my_master_degree && $your_master_degree) $master_degree = true;
				if ($my_doctor_degree && $your_doctor_degree) $doctor_degree = true;
				
				
				$this->set('bachelor',$bach_degree);
				$this->set('master',$master_degree);
				$this->set('doctor',$doctor_degree);
				
				
				$my_major = array();
				$your_major = array();
				// look at majors
				for ($counter = 0;$counter<sizeof($my_schools);$counter++){
					if (isset($my_schools[$counter]['major'])){
						$tok = strtok($my_schools[$counter]['major']," ");
						while ($tok !== false) {
							array_push($my_major, $tok);
							$tok = strtok(" ");
						}
	
					}
				}
				for ($counter = 0;$counter<sizeof($your_schools);$counter++){
					if (isset($your_schools[$counter]['major'])){
						$tok = strtok($your_schools[$counter]['major']," ");
						while ($tok !== false) {
							array_push($your_major, $tok);
							$tok = strtok(" ");
						}
					}
				}
				
				$majors = 0;
				for ($counter = 0; $counter < sizeof($my_major); $counter++){
					for ($inner_counter = 0; $inner_counter<sizeof($your_major); $inner_counter++){
						similar_text($my_major[$counter],$your_major[$inner_counter],$match);
						if ($match > 50) {	
//							var_dump($my_major[$counter]);
	//						var_dump($your_major[$inner_counter]);
							$score += 20;
							$majors += 10;
						}
					}
				}
				$this->set('majors',$majors);
				
				for ($counter=0;$counter<sizeof($my_schools);$counter++){
					$url = "http://where.yahooapis.com/geocode?q=".urlencode($my_schools[$counter]['school'])."&flags=J&gflags=R&appid=cENXMi4g";
					$address = json_decode(file_get_contents($url));
				//	echo $my_schools['counter']['school'];
					//var_dump($address);
					if (!$address->ResultSet->Error){
						$my_lat[$counter] = $address->ResultSet->Results[0]->latitude;
						$my_long[$counter] = $address->ResultSet->Results[0]->longitude;
					}
					
					for ($inner_counter=0;$inner_counter<sizeof($your_schools);$inner_counter++){
						similar_text($my_schools[$counter]['school'],$your_schools[$inner_counter]['school'],$match);
						if ($match > 75) {
							$education += 10;
							$score+=30;
						}
						if ($counter==0){
							$url = "http://where.yahooapis.com/geocode?q=".urlencode($your_schools[$inner_counter]['school'])."&flags=J&gflags=R&appid=cENXMi4g";
							$address = json_decode(file_get_contents($url));
								//	echo $your_schools[$inner_counter]['school'];
									//		var_dump($address);

							if (!$address->ResultSet->Error){
								$your_lat[$inner_counter] = $address->ResultSet->Results[0]->latitude;
								$your_long[$inner_counter] = $address->ResultSet->Results[0]->longitude;
							}
						}
						
						$delta_lat = deg2rad($my_lat[$counter] - $your_lat[$inner_counter]);
						$delta_long = deg2rad($my_long[$counter] - $your_long[$inner_counter]);
						$a = sin($delta_lat/2) * sin($delta_lat/2) + cos(deg2rad($my_lat[$counter])) * cos(deg2rad($your_lat[$inner_counter])) * sin($delta_long/2) * sin($delta_long/2);
						$c = 2 * atan2(sqrt($a),sqrt(1-$a));
						$distance = $earth_radius * $c;
						$d_miles = $distance * 0.621371192;
						
						if ($d_miles < 1) $score += 20;
						elseif ($d_miles < 10) $score += 16;
						elseif ($d_miles < 25) $score += 12;
						elseif ($d_miles < 50) $score += 10;
						elseif ($d_miles < 100) $score += 7;
						elseif ($d_miles < 150) $score += 3;
						elseif ($d_miles < 200) $score++;
						
						$this->set('edu_distance',$d_miles);
						
					}
				}
				$this->set('education',$education);
				
			}
			// compare works
			if (!is_null($user['Work']['id']) && !is_null($other_user['Work']['id'])){
				$my_industries = array();
				$your_industries = array();
				$work = 0;
				$my_work = json_decode($user['Work']['body']);
				$your_work = json_decode($other_user['Work']['body']);
				for($counter = 0; $counter < sizeof($my_work); $counter++){
					$cats = $this->Wlookup->find('first',array('conditions' => (array('Wlookup.description'=>$my_work[$counter]->industry))));
					$tok = strtok($cats['Wlookup']['group']," ");
					while ($tok !== false) {
						array_push($my_industries, $tok);
						$tok = strtok(" ");
					}
				}
				for($counter = 0; $counter < sizeof($your_work); $counter++){
					$cats = $this->Wlookup->find('first',array('conditions' => (array('Wlookup.description'=>$your_work[$counter]->industry))));
					$tok = strtok($cats['Wlookup']['group']," ");
					while ($tok !== false) {
						array_push($your_industries, $tok);
						$tok = strtok(" ");
					}
				}
				
				$result = array_intersect($my_industries, $your_industries);
				if (!empty($result)) {
					$score += sizeof($result) * 2;
					$work += 10;
				}
			
				
				
				// titles
				
				// we need a list of titles  that are similar
				
				
				for($counter = 0; $counter < sizeof($my_work); $counter++){
					for($inner_counter = 0; $inner_counter < sizeof($your_work); $inner_counter++){
						similar_text($my_work[$counter]->company,$your_work[$inner_counter]->company,$match);
						if ($match > 50){
							$work += 10;
							$score += 10;
						}
						
					}
				}
				
				//companys
				// how do we compare companies
				
				
				for($counter = 0; $counter < sizeof($my_work); $counter++){
					for($inner_counter = 0; $inner_counter < sizeof($your_work); $inner_counter++){
						similar_text($my_work[$counter]->title,$your_work[$inner_counter]->title,$match);
						if ($match > 50){
							$work += 10;
							$score += 10;
						}
						
					}
				}
				
				
				
				
				$this->set('work',$work);
	
				
				
				
				
				
				
				
				
				
				
				
			}
		
			
			$this->set('score',$score);
		
		}
	}
	function getSign($birthday){
		$birthmonth = date('n',strtotime($birthday));
		$birthdate = date('d',strtotime($birthday));
		$sign = '';
		switch($birthmonth){
				case '1':
					if ($birthdate>19) $sign = "Aquarius";
					else $sign = "Capricorn";
					break;
				case '2':
					if ($birthdate>18) $sign = "Pisces";
					else $sign = "Aquarius";
					break;
				case '3':
					if ($birthdate>20) $sign = "Aries";
					else $sign = "Pisces";
					break;
				case '4':
					if ($birthdate>19) $sign = "Taurus";
					else $sign = "Aries";
					break;
				case '5':
					if ($birthdate>20) $sign = "Gemini";
					else $sign = "Taurus";
					break;
				case '6':
					if ($birthdate>20) $sign = "Cancer";
					else $sign = "Gemini";
					break;
				case '7':
					if ($birthdate>22) $sign = "Leo";
					else $sign = "Cancer";
					break;
				case '8':
					if ($birthdate>22) $sign = "Virgo";
					else $sign = "Leo";
					break;
				case '9':
					if ($birthdate>22) $sign = "Libra";
					else $sign = "Virgo";
					break;
				case '10':
					if ($birthdate>22) $sign = "Scorpio";
					else $sign = "Libra";
					break;
				case '11':
					if ($birthdate>21) $sign = "Sagittarius";
					else $sign = "Scorpio";
					break;
				case '12':
					if ($birthdate>21) $sign = "Capricorn";
					else $sign = "Sagittarius";
					break;
		}
		return $sign;
	}
	function edit_interest($id=null){
		$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
		$interests = json_decode($user['Interest']['body'],true);
	//			var_dump($interests);
	//var_dump($id);
		$div_name = 'Interest_'.$id; 
		$this->set('editing',true);
		$this->set('div_name',$div_name);
		$this->set('id',$id);	
		// need to make sure you are the owner
		if (is_null($this->Auth->getUserId())){
			Controller::render('/deny');
		}
		if (!empty($this->data)){
	//		var_dump($this->data);
			$id = $this->data['User']['id'];
			$key = $this->data['User']['key'];
			$interests[$key]=(int)$interests[$id];
			unset($interests[$id]);
			arsort($interests,SORT_NUMERIC);
			$this->Interest->read(null,$user['Interest']['id']);
			$this->data['Interest']['body'] = json_encode($interests);
			$this->Interest->set($this->data);
			$this->Interest->save();
			$this->set('editing',false);
			$this->set('key',$key);
			$this->render();
		}
		else {
//			$this->set(
			$this->render();
		}	
	}
	function edit_work($id=null,$key=null,$type='Work'){
		$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
		//$work = json_decode($user[$type]['body'],true);
	//	var_dump($user);
		//echo $this->Auth->getUserId();
//		var_dump($user['Work']['body']);
				//var_dump($work);
	//echo $id.' id';
	//echo $key.' key';
	//var_dump($this->data);
		if (!empty($this->data)){
				$id = $this->data['User']['id'];
				$key = $this->data['User']['key'];
				$type = $this->data['User']['type'];		
		$work = json_decode($user[$type]['body'],true);
				$work[$id][$key] = $this->data['User']['val'];
		//			var_dump($work);
			
				if ($type=='Work'){
					$this->Work->read(null,$user[$type]['id']);
					$this->data[$type]['body'] = json_encode($work);
					$this->Work->set($this->data);
					$this->Work->save();
				}
				else { // must be school then
					$this->School->read(null,$user[$type]['id']);
					$this->data[$type]['body'] = json_encode($work);
					$this->School->set($this->data);
					$this->School->save();
				}
			
		//	var_dump($this->data);
			$this->set('editing',false);
			$this->set('value',$this->data['User']['val']);
			$this->set('id',$id);
			$this->set('key',$key);
			$this->set('type',$type);
		}
		elseif ($key == 'delete'){
			echo 'Data Deleted';
			//echo $type;
				$work = json_decode($user[$type]['body'],true);
	
			//echo $user['Work']['id'];
			//echo $user[$type]['id'];
				// delete the whole entry
							if ($type=='Work'){
					$this->Work->delete($user[$type]['id']);
					//$this->data[$type]['body'] = json_encode($work);
					//$this->Work->set($this->data);
					//$this->Work->save();
				}
				else { // must be school then
					$this->School->delete($user[$type]['id']);
					//$this->data[$type]['body'] = json_encode($work);
					//$this->School->set($this->data);
					//$this->School->save();
				}

			}
		else {
			$this->set('value',$work[$id][$key]); 
			$this->set('editing',true);
				$this->set('id',$id);
			$this->set('type',$type);
			$this->set('key',$key);
		}
		$this->set('div_name','edit_'.$type.'_'.$key.'_'.$id);
		$this->render();
	}
		function add_work($type='Work'){
			$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
			
			if (!empty($this->data)){
	//			var_dump($this->data);
				$type = $this->data['User']['type'];
				$work = json_decode($user[$type]['body'],true);
			if (sizeof($work)<1) $work = array();
				foreach($this->data['User'] as $key=>$value){
					if ($key != 'type'){
						$temp[$type][$key] = $value;
					}
				}
				array_push($work,$temp[$type]);
	
//			var_dump($work);
				if ($type=='Work'){
					$this->Work->read(null,$user[$type]['id']);
					$this->data[$type]['body'] = json_encode($work);
					$this->Work->set($this->data);
					$this->Work->save();
				}
				else { // must be school then
					$this->School->read(null,$user[$type]['id']);
					$this->data[$type]['body'] = json_encode($work);
					$this->School->set($this->data);
					$this->School->save();
				}
			
		//	var_dump($this->data);
			$this->set('editing',true);
			$this->set('value',$this->data['User']['val']);
			$this->set('id',$id);
			$this->set('key',$key);
			$this->set('type',$type);
		}
		
		else {
			/*if ($type=='Work'){
				$this->set('first','title');
				$this->set('second','company');
				$this->set('third','industry');
				$this->set('type',$type);
			
			}
			else {
				$this->set('value',$work[$id][$key]); 
				$this->set('editing',true);
				$this->set('id',$id);
				$this->set('type',$type);
				$this->set('key',$key);
			}*/
		}
		if ($type=='Work'){
				$this->set('first','title');
				$this->set('second','company');
				$this->set('third','industry');
				$this->set('type',$type);
			
			}
			elseif ($type=='School'){
				$this->set('first','degree');
				$this->set('second','school');
				$this->set('third','major');
				$this->set('type',$type);
			
			
			
			
			}
			
		$this->set('div_name','add_'.$type);
		$this->render();
	}

}

?>