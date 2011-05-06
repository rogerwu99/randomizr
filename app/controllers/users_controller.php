<?php
App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'oauth_consumer.php'));
App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'OAuth.php'));
App::import('Vendor', 'oauth', array('file' => 'OAuth'.DS.'OAuth2.php'));

class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Ajax');
	var $components = array('Auth', 'Email','Paypal','Session');
	var $uses = array('User', 'Mail', 'Movie', 'Interest','Place','Work','School','Userprofile');
	var $stop_words = array('/\b[a-zA-Z0-9]\b/','/[\&\'\/\:\-\!\;\(\)]/','/[\^\$\.\|\?\*\+]/','/\ba\b/','/\bI\b/','/\b(?i)able\b/','/\b(?i)about\b/','/\b(?i)above\b/','/\b(?i)abroad\b/','/\b(?i)according\b/','/\b(?i)accordingly\b/','/\b(?i)across\b/','/\b(?i)actually\b/','/\b(?i)adj\b/','/\b(?i)after\b/','/\b(?i)afterwards\b/','/\b(?i)again\b/','/\b(?i)against\b/','/\b(?i)ago\b/','/\b(?i)ahead\b/','/\b(?i)ain\'t\b/','/\b(?i)all\b/','/\b(?i)allow\b/','/\b(?i)allows\b/','/\b(?i)almost\b/','/\b(?i)alone\b/','/\b(?i)along\b/','/\b(?i)alongside\b/','/\b(?i)already\b/','/\b(?i)also\b/','/\b(?i)although\b/','/\b(?i)always\b/','/\b(?i)am\b/','/\b(?i)amid\b/','/\b(?i)amidst\b/','/\b(?i)among\b/','/\b(?i)amongst\b/','/\b(?i)an\b/','/\b(?i)and\b/','/\b(?i)another\b/','/\b(?i)any\b/','/\b(?i)anybody\b/','/\b(?i)anyhow\b/','/\b(?i)anyone\b/','/\b(?i)anything\b/','/\b(?i)anyway\b/','/\b(?i)anyways\b/','/\b(?i)anywhere\b/','/\b(?i)apart\b/','/\b(?i)appear\b/','/\b(?i)appreciate\b/','/\b(?i)appropriate\b/','/\b(?i)are\b/','/\b(?i)aren\'t\b/','/\b(?i)around\b/','/\b(?i)as\b/','/\b(?i)a\'s\b/','/\b(?i)aside\b/','/\b(?i)ask\b/','/\b(?i)asking\b/','/\b(?i)associated\b/','/\b(?i)at\b/','/\b(?i)available\b/','/\b(?i)away\b/','/\b(?i)awfully\b/','/\b(?i)back\b/','/\b(?i)backward\b/','/\b(?i)backwards\b/','/\b(?i)be\b/','/\b(?i)became\b/','/\b(?i)because\b/','/\b(?i)become\b/','/\b(?i)becomes\b/','/\b(?i)becoming\b/','/\b(?i)been\b/','/\b(?i)before\b/','/\b(?i)beforehand\b/','/\b(?i)begin\b/','/\b(?i)behind\b/','/\b(?i)being\b/','/\b(?i)believe\b/','/\b(?i)below\b/','/\b(?i)beside\b/','/\b(?i)besides\b/','/\b(?i)best\b/','/\b(?i)better\b/','/\b(?i)between\b/','/\b(?i)beyond\b/','/\b(?i)both\b/','/\b(?i)brief\b/','/\b(?i)but\b/','/\b(?i)by\b/','/\b(?i)came\b/','/\b(?i)can\b/','/\b(?i)cannot\b/','/\b(?i)cant\b/','/\b(?i)can\'t\b/','/\b(?i)caption\b/','/\b(?i)cause\b/','/\b(?i)causes\b/','/\b(?i)certain\b/','/\b(?i)certainly\b/','/\b(?i)changes\b/','/\b(?i)clearly\b/','/\b(?i)c\'mon\b/','/\b(?i)co\b/','/\b(?i)co.\b/','/\b(?i)com\b/','/\b(?i)come\b/','/\b(?i)comes\b/','/\b(?i)concerning\b/','/\b(?i)consequently\b/','/\b(?i)consider\b/','/\b(?i)considering\b/','/\b(?i)contain\b/','/\b(?i)containing\b/','/\b(?i)contains\b/','/\b(?i)corresponding\b/','/\b(?i)could\b/','/\b(?i)couldn\'t\b/','/\b(?i)course\b/','/\b(?i)c\'s\b/','/\b(?i)currently\b/','/\b(?i)dare\b/','/\b(?i)daren\'t\b/','/\b(?i)definitely\b/','/\b(?i)described\b/','/\b(?i)despite\b/','/\b(?i)did\b/','/\b(?i)didn\'t\b/','/\b(?i)different\b/','/\b(?i)directly\b/','/\b(?i)do\b/','/\b(?i)does\b/','/\b(?i)doesn\'t\b/','/\b(?i)doing\b/','/\b(?i)done\b/','/\b(?i)don\'t\b/','/\b(?i)down\b/','/\b(?i)downwards\b/','/\b(?i)during\b/','/\b(?i)each\b/','/\b(?i)edu\b/','/\b(?i)eg\b/','/\b(?i)eight\b/','/\b(?i)eighty\b/','/\b(?i)either\b/','/\b(?i)else\b/','/\b(?i)elsewhere\b/','/\b(?i)end\b/','/\b(?i)ending\b/','/\b(?i)enough\b/','/\b(?i)entirely\b/','/\b(?i)especially\b/','/\b(?i)et\b/','/\b(?i)etc\b/','/\b(?i)even\b/','/\b(?i)ever\b/','/\b(?i)evermore\b/','/\b(?i)every\b/','/\b(?i)everybody\b/','/\b(?i)everyone\b/','/\b(?i)everything\b/','/\b(?i)everywhere\b/','/\b(?i)ex\b/','/\b(?i)exactly\b/','/\b(?i)example\b/','/\b(?i)except\b/','/\b(?i)fairly\b/','/\b(?i)far\b/','/\b(?i)farther\b/','/\b(?i)few\b/','/\b(?i)fewer\b/','/\b(?i)fifth\b/','/\b(?i)first\b/','/\b(?i)five\b/','/\b(?i)followed\b/','/\b(?i)following\b/','/\b(?i)follows\b/','/\b(?i)for\b/','/\b(?i)forever\b/','/\b(?i)former\b/','/\b(?i)formerly\b/','/\b(?i)forth\b/','/\b(?i)forward\b/','/\b(?i)found\b/','/\b(?i)four\b/','/\b(?i)from\b/','/\b(?i)further\b/','/\b(?i)furthermore\b/','/\b(?i)get\b/','/\b(?i)gets\b/','/\b(?i)getting\b/','/\b(?i)given\b/','/\b(?i)gives\b/','/\b(?i)go\b/','/\b(?i)goes\b/','/\b(?i)going\b/','/\b(?i)gone\b/','/\b(?i)got\b/','/\b(?i)gotten\b/','/\b(?i)greetings\b/','/\b(?i)had\b/','/\b(?i)hadn\'t\b/','/\b(?i)half\b/','/\b(?i)happens\b/','/\b(?i)hardly\b/','/\b(?i)has\b/','/\b(?i)hasn\'t\b/','/\b(?i)have\b/','/\b(?i)haven\'t\b/','/\b(?i)having\b/','/\b(?i)he\b/','/\b(?i)he\'d\b/','/\b(?i)he\'ll\b/','/\b(?i)hello\b/','/\b(?i)help\b/','/\b(?i)hence\b/','/\b(?i)her\b/','/\b(?i)here\b/','/\b(?i)hereafter\b/','/\b(?i)hereby\b/','/\b(?i)herein\b/','/\b(?i)here\'s\b/','/\b(?i)hereupon\b/','/\b(?i)hers\b/','/\b(?i)herself\b/','/\b(?i)he\'s\b/','/\b(?i)hi\b/','/\b(?i)him\b/','/\b(?i)himself\b/','/\b(?i)his\b/','/\b(?i)hither\b/','/\b(?i)hopefully\b/','/\b(?i)how\b/','/\b(?i)howbeit\b/','/\b(?i)however\b/','/\b(?i)hundred\b/','/\b(?i)i\'d\b/','/\b(?i)ie\b/','/\b(?i)if\b/','/\b(?i)ignored\b/','/\b(?i)i\'ll\b/','/\b(?i)i\'m\b/','/\b(?i)immediate\b/','/\b(?i)in\b/','/\b(?i)inasmuch\b/','/\b(?i)inc\b/','/\b(?i)inc.\b/','/\b(?i)indeed\b/','/\b(?i)indicate\b/','/\b(?i)indicated\b/','/\b(?i)indicates\b/','/\b(?i)inner\b/','/\b(?i)inside\b/','/\b(?i)insofar\b/','/\b(?i)instead\b/','/\b(?i)into\b/','/\b(?i)inward\b/','/\b(?i)is\b/','/\b(?i)isn\'t\b/','/\b(?i)it\b/','/\b(?i)it\'d\b/','/\b(?i)it\'ll\b/','/\b(?i)its\b/','/\b(?i)it\'s\b/','/\b(?i)itself\b/','/\b(?i)i\'ve\b/','/\b(?i)just\b/','/\b(?i)k\b/','/\b(?i)keep\b/','/\b(?i)keeps\b/','/\b(?i)kept\b/','/\b(?i)know\b/','/\b(?i)known\b/','/\b(?i)knows\b/','/\b(?i)last\b/','/\b(?i)lately\b/','/\b(?i)later\b/','/\b(?i)latter\b/','/\b(?i)latterly\b/','/\b(?i)least\b/','/\b(?i)less\b/','/\b(?i)lest\b/','/\b(?i)let\b/','/\b(?i)let\'s\b/','/\b(?i)like\b/','/\b(?i)liked\b/','/\b(?i)likely\b/','/\b(?i)likewise\b/','/\b(?i)little\b/','/\b(?i)look\b/','/\b(?i)looking\b/','/\b(?i)looks\b/','/\b(?i)low\b/','/\b(?i)lower\b/','/\b(?i)ltd\b/','/\b(?i)made\b/','/\b(?i)mainly\b/','/\b(?i)make\b/','/\b(?i)makes\b/','/\b(?i)many\b/','/\b(?i)may\b/','/\b(?i)maybe\b/','/\b(?i)mayn\'t\b/','/\b(?i)me\b/','/\b(?i)mean\b/','/\b(?i)meantime\b/','/\b(?i)meanwhile\b/','/\b(?i)merely\b/','/\b(?i)might\b/','/\b(?i)mightn\'t\b/','/\b(?i)mine\b/','/\b(?i)minus\b/','/\b(?i)miss\b/','/\b(?i)more\b/','/\b(?i)moreover\b/','/\b(?i)most\b/','/\b(?i)mostly\b/','/\b(?i)mr\b/','/\b(?i)mrs\b/','/\b(?i)much\b/','/\b(?i)must\b/','/\b(?i)mustn\'t\b/','/\b(?i)my\b/','/\b(?i)myself\b/','/\b(?i)name\b/','/\b(?i)namely\b/','/\b(?i)nd\b/','/\b(?i)near\b/','/\b(?i)nearly\b/','/\b(?i)necessary\b/','/\b(?i)need\b/','/\b(?i)needn\'t\b/','/\b(?i)needs\b/','/\b(?i)neither\b/','/\b(?i)never\b/','/\b(?i)neverf\b/','/\b(?i)neverless\b/','/\b(?i)nevertheless\b/','/\b(?i)new\b/','/\b(?i)next\b/','/\b(?i)nine\b/','/\b(?i)ninety\b/','/\b(?i)no\b/','/\b(?i)nobody\b/','/\b(?i)non\b/','/\b(?i)none\b/','/\b(?i)nonetheless\b/','/\b(?i)noone\b/','/\b(?i)no-one\b/','/\b(?i)nor\b/','/\b(?i)normally\b/','/\b(?i)not\b/','/\b(?i)nothing\b/','/\b(?i)notwithstanding\b/','/\b(?i)novel\b/','/\b(?i)now\b/','/\b(?i)nowhere\b/','/\b(?i)obviously\b/','/\b(?i)of\b/','/\b(?i)off\b/','/\b(?i)often\b/','/\b(?i)oh\b/','/\b(?i)ok\b/','/\b(?i)okay\b/','/\b(?i)old\b/','/\b(?i)on\b/','/\b(?i)once\b/','/\b(?i)one\b/','/\b(?i)ones\b/','/\b(?i)one\'s\b/','/\b(?i)only\b/','/\b(?i)onto\b/','/\b(?i)opposite\b/','/\b(?i)or\b/','/\b(?i)other\b/','/\b(?i)others\b/','/\b(?i)otherwise\b/','/\b(?i)ought\b/','/\b(?i)oughtn\'t\b/','/\b(?i)our\b/','/\b(?i)ours\b/','/\b(?i)ourselves\b/','/\b(?i)out\b/','/\b(?i)outside\b/','/\b(?i)over\b/','/\b(?i)overall\b/','/\b(?i)own\b/','/\b(?i)particular\b/','/\b(?i)particularly\b/','/\b(?i)past\b/','/\b(?i)per\b/','/\b(?i)perhaps\b/','/\b(?i)placed\b/','/\b(?i)please\b/','/\b(?i)plus\b/','/\b(?i)possible\b/','/\b(?i)presumably\b/','/\b(?i)probably\b/','/\b(?i)provided\b/','/\b(?i)provides\b/','/\b(?i)que\b/','/\b(?i)quite\b/','/\b(?i)qv\b/','/\b(?i)rather\b/','/\b(?i)rd\b/','/\b(?i)re\b/','/\b(?i)really\b/','/\b(?i)reasonably\b/','/\b(?i)recent\b/','/\b(?i)recently\b/','/\b(?i)regarding\b/','/\b(?i)regardless\b/','/\b(?i)regards\b/','/\b(?i)relatively\b/','/\b(?i)respectively\b/','/\b(?i)right\b/','/\b(?i)round\b/','/\b(?i)said\b/','/\b(?i)same\b/','/\b(?i)saw\b/','/\b(?i)say\b/','/\b(?i)saying\b/','/\b(?i)says\b/','/\b(?i)second\b/','/\b(?i)secondly\b/','/\b(?i)see\b/','/\b(?i)seeing\b/','/\b(?i)seem\b/','/\b(?i)seemed\b/','/\b(?i)seeming\b/','/\b(?i)seems\b/','/\b(?i)seen\b/','/\b(?i)self\b/','/\b(?i)selves\b/','/\b(?i)sensible\b/','/\b(?i)sent\b/','/\b(?i)serious\b/','/\b(?i)seriously\b/','/\b(?i)seven\b/','/\b(?i)several\b/','/\b(?i)shall\b/','/\b(?i)shan\'t\b/','/\b(?i)she\b/','/\b(?i)she\'d\b/','/\b(?i)she\'ll\b/','/\b(?i)she\'s\b/','/\b(?i)should\b/','/\b(?i)shouldn\'t\b/','/\b(?i)since\b/','/\b(?i)six\b/','/\b(?i)so\b/','/\b(?i)some\b/','/\b(?i)somebody\b/','/\b(?i)someday\b/','/\b(?i)somehow\b/','/\b(?i)someone\b/','/\b(?i)something\b/','/\b(?i)sometime\b/','/\b(?i)sometimes\b/','/\b(?i)somewhat\b/','/\b(?i)somewhere\b/','/\b(?i)soon\b/','/\b(?i)sorry\b/','/\b(?i)specified\b/','/\b(?i)specify\b/','/\b(?i)specifying\b/','/\b(?i)still\b/','/\b(?i)sub\b/','/\b(?i)such\b/','/\b(?i)sup\b/','/\b(?i)sure\b/','/\b(?i)take\b/','/\b(?i)taken\b/','/\b(?i)taking\b/','/\b(?i)tell\b/','/\b(?i)tends\b/','/\b(?i)th\b/','/\b(?i)than\b/','/\b(?i)thank\b/','/\b(?i)thanks\b/','/\b(?i)thanx\b/','/\b(?i)that\b/','/\b(?i)that\'ll\b/','/\b(?i)thats\b/','/\b(?i)that\'s\b/','/\b(?i)that\'ve\b/','/\b(?i)the\b/','/\b(?i)their\b/','/\b(?i)theirs\b/','/\b(?i)them\b/','/\b(?i)themselves\b/','/\b(?i)then\b/','/\b(?i)thence\b/','/\b(?i)there\b/','/\b(?i)thereafter\b/','/\b(?i)thereby\b/','/\b(?i)there\'d\b/','/\b(?i)therefore\b/','/\b(?i)therein\b/','/\b(?i)there\'ll\b/','/\b(?i)there\'re\b/','/\b(?i)theres\b/','/\b(?i)there\'s\b/','/\b(?i)thereupon\b/','/\b(?i)there\'ve\b/','/\b(?i)these\b/','/\b(?i)they\b/','/\b(?i)they\'d\b/','/\b(?i)they\'ll\b/','/\b(?i)they\'re\b/','/\b(?i)they\'ve\b/','/\b(?i)thing\b/','/\b(?i)things\b/','/\b(?i)think\b/','/\b(?i)third\b/','/\b(?i)thirty\b/','/\b(?i)this\b/','/\b(?i)thorough\b/','/\b(?i)thoroughly\b/','/\b(?i)those\b/','/\b(?i)though\b/','/\b(?i)three\b/','/\b(?i)through\b/','/\b(?i)throughout\b/','/\b(?i)thru\b/','/\b(?i)thus\b/','/\b(?i)till\b/','/\b(?i)to\b/','/\b(?i)together\b/','/\b(?i)too\b/','/\b(?i)took\b/','/\b(?i)toward\b/','/\b(?i)towards\b/','/\b(?i)tried\b/','/\b(?i)tries\b/','/\b(?i)truly\b/','/\b(?i)try\b/','/\b(?i)trying\b/','/\b(?i)t\'s\b/','/\b(?i)twice\b/','/\b(?i)two\b/','/\b(?i)un\b/','/\b(?i)under\b/','/\b(?i)underneath\b/','/\b(?i)undoing\b/','/\b(?i)unfortunately\b/','/\b(?i)unless\b/','/\b(?i)unlike\b/','/\b(?i)unlikely\b/','/\b(?i)until\b/','/\b(?i)unto\b/','/\b(?i)up\b/','/\b(?i)upon\b/','/\b(?i)upwards\b/','/\b(?i)us\b/','/\b(?i)use\b/','/\b(?i)used\b/','/\b(?i)useful\b/','/\b(?i)uses\b/','/\b(?i)using\b/','/\b(?i)usually\b/','/\b(?i)v\b/','/\b(?i)value\b/','/\b(?i)various\b/','/\b(?i)versus\b/','/\b(?i)very\b/','/\b(?i)via\b/','/\b(?i)viz\b/','/\b(?i)vs\b/','/\b(?i)want\b/','/\b(?i)wants\b/','/\b(?i)was\b/','/\b(?i)wasn\'t\b/','/\b(?i)way\b/','/\b(?i)we\b/','/\b(?i)we\'d\b/','/\b(?i)welcome\b/','/\b(?i)well\b/','/\b(?i)we\'ll\b/','/\b(?i)went\b/','/\b(?i)were\b/','/\b(?i)we\'re\b/','/\b(?i)weren\'t\b/','/\b(?i)we\'ve\b/','/\b(?i)what\b/','/\b(?i)whatever\b/','/\b(?i)what\'ll\b/','/\b(?i)what\'s\b/','/\b(?i)what\'ve\b/','/\b(?i)when\b/','/\b(?i)whence\b/','/\b(?i)whenever\b/','/\b(?i)where\b/','/\b(?i)whereafter\b/','/\b(?i)whereas\b/','/\b(?i)whereby\b/','/\b(?i)wherein\b/','/\b(?i)where\'s\b/','/\b(?i)whereupon\b/','/\b(?i)wherever\b/','/\b(?i)whether\b/','/\b(?i)which\b/','/\b(?i)whichever\b/','/\b(?i)while\b/','/\b(?i)whilst\b/','/\b(?i)whither\b/','/\b(?i)who\b/','/\b(?i)who\'d\b/','/\b(?i)whoever\b/','/\b(?i)whole\b/','/\b(?i)who\'ll\b/','/\b(?i)whom\b/','/\b(?i)whomever\b/','/\b(?i)who\'s\b/','/\b(?i)whose\b/','/\b(?i)why\b/','/\b(?i)will\b/','/\b(?i)willing\b/','/\b(?i)wish\b/','/\b(?i)with\b/','/\b(?i)within\b/','/\b(?i)without\b/','/\b(?i)wonder\b/','/\b(?i)won\'t\b/','/\b(?i)would\b/','/\b(?i)wouldn\'t\b/','/\b(?i)yes\b/','/\b(?i)yet\b/','/\b(?i)you\b/','/\b(?i)you\'d\b/','/\b(?i)you\'ll\b/','/\b(?i)your\b/','/\b(?i)you\'re\b/','/\b(?i)yours\b/','/\b(?i)yourself\b/','/\b(?i)yourselves\b/','/\b(?i)you\'ve\b/','/\b(?i)zero\b/');

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
			case 'linkedin':
				return new OAuth_Consumer('sFajlCC9PGccRCY4m-yRPAQLWauM26UqGzPRmLe3C8nvmIUZiDWametm5c1bP4F8','eHM3ipLIzPLcBOd5h8_VFCJYtI93r1oJLoiW68xbOJj37F2uxyaRps__9ke5pMPJ');
			case 'foursquare':
				return new OAuth_Consumer('ABYPSPX1NG33H3ESSSUGJE0AMKHQDFWPUTZ5YDOWI2ENSG4R','P4IJZ43KKSFEXN2A3UW3JH44BI1LWLUIT5NEW1VP1FSGBD4B');
			case 'netflix':
				return new OAuth_Consumer('ydz4hr2m35f6rp6wqqbu4amw','JvZxjsMRpr');
			case 'meetup':
				return new OAuth_Consumer('pd41j62jc6lt2rb1554l764bhs','eecf5odl2hdtraul2qcap23ttc');
			case 'google':
				return new OAuth_Consumer('splurky.com','TfJbfxWqBSO9lZvbopvsbvy2');
			case 'facebook':
				return new OAuth_Consumer('189267044425329','b127d742f40502d8a9c05b31d6acc43b');
			default: //twitter
		        return new OAuth_Consumer('3PnqSPtc9vf4jj9sXehROw', 'eY8760Xe74NupOEq4Ey9wzp1rahNo85QCXQ8dAtNCq8');
		}
    }
	
	function reg($service=null){
		$this->Session->write('register','true');
		$this->getOAuth($service);
		
	}
	
	function getOAuth($service=NULL){
		$consumer = $this->createConsumer($service);
		$requestTokenName = $service.'_request_token';
		$request_url = '';
		$redirect_url = '';
		$oauth2 = false;
		$nf = false;
		switch ($service){
			case 'linkedin':
				$request_url = 'https://api.linkedin.com/uas/oauth/requestToken';
				$redirect_url = 'https://www.linkedin.com/uas/oauth/authenticate?oauth_token=';
				break;
			case 'foursquare':
				$redirect_url = 'https://foursquare.com/oauth2/authenticate?client_id=ABYPSPX1NG33H3ESSSUGJE0AMKHQDFWPUTZ5YDOWI2ENSG4R&response_type=code&redirect_uri='.ROOT_URL.'/users/callback/foursquare';
				$oauth2 = true;
				break;
			case 'netflix':
				$request_url = 'http://api.netflix.com/oauth/request_token';
				$nf = true;
				break;
			case 'meetup':
				$request_url = 'https://api.meetup.com/oauth/request/';
				$redirect_url = 'http://www.meetup.com/authorize/?oauth_token=';
				break;
			case 'google':
			case 'facebook':
				$redirect_url = 'https://www.facebook.com/dialog/oauth?client_id=189267044425329&redirect_uri='.ROOT_URL.'/users/callback/facebook'.'&scope=user_about_me,user_activities,user_birthday,user_education_history,user_events,user_groups,user_hometown,user_interests,user_relationships,user_religion_politics,user_status,user_website,user_work_history,email,user_checkins';
				$oauth2 = true;
				break;
			case 'twitter':
				$request_url = 'http://twitter.com/oauth/request_token';
				$redirect_url = 'http://twitter.com/oauth/authenticate?oauth_token=';
				break;
		}
		if (!$oauth2){
			$requestToken = $consumer->getRequestToken($request_url,ROOT_URL.'/users/callback/'.$service);
			$this->Session->write($requestTokenName, $requestToken);
			if ($nf) $redirect_url = 'https://api-user.netflix.com/oauth/login?application_name='.$requestToken->app_name.'&oauth_callback='.ROOT_URL.'/users/callback/netflix'.'&oauth_consumer_key=ydz4hr2m35f6rp6wqqbu4amw&oauth_token=';
			$this->redirect($redirect_url.$requestToken->key);
		}
		else {
			$this->redirect($redirect_url);
		}
	}
	
	
	
	function getGoogle(){
		$consumer=$this->createConsumer('google');
	
		$postdata=array('scope'=>'http://www.google.com/calendar/feeds http://picasaweb.google.com/data');
		$requestToken = $consumer->getRequestToken('https://www.google.com/accounts/OAuthGetRequestToken', 	ROOT_URL.'/users/googleCallback','POST',$postdata);
		$this->Session->write('google_request_token', $requestToken);
		var_dump($requestToken);
		$this->redirect('https://www.google.com/accounts/OAuthAuthorizeToken/?oauth_token='.$requestToken->key.'&hd=default');
		exit();
	}
	
	

	function callback($service=NULL){
		$consumer = $this->createConsumer($service);
		$requestTokenName = $service.'_request_token';
		$accessTokenName = $service.'_access_token';
		$accessKeyName = $service.'_access_key';
		$accessSecretName = $service.'_access_secret';
		$access_url = '';
		$nf = false;
		$oauth2 = false;
		switch ($service){
			case 'linkedin':
				$access_url = 'https://api.linkedin.com/uas/oauth/accessToken';
				break;
			case 'foursquare':
				$access_url ='https://foursquare.com/oauth2/access_token?client_id=ABYPSPX1NG33H3ESSSUGJE0AMKHQDFWPUTZ5YDOWI2ENSG4R&client_secret=P4IJZ43KKSFEXN2A3UW3JH44BI1LWLUIT5NEW1VP1FSGBD4B&grant_type=authorization_code&redirect_uri='.ROOT_URL.'/users/callback/foursquare/&code='.$this->params['url']['code'];
				$oauth2 = true;
				break;
			case 'netflix':
				$access_url = 'http://api.netflix.com/oauth/access_token';
				$nf = true;
				break;
			case 'meetup':
				$access_url = 'https://api.meetup.com/oauth/access/';
				break;
			case 'google':
			case 'facebook':
				$access_url = 'https://graph.facebook.com/oauth/access_token?client_id=189267044425329&redirect_uri='.ROOT_URL.'/users/callback/facebook&client_secret=b127d742f40502d8a9c05b31d6acc43b&code='.$this->params['url']['code'];
				$oauth2 = true;
				break;
			case 'twitter':
				$access_url = 'http://twitter.com/oauth/access_token';
				break;
		}
		$this->User->read(null,$this->Auth->getUserId());
		if (!$oauth2){
			$requestToken = $this->Session->read($requestTokenName);
			$accessToken = $consumer->getAccessToken($access_url, $requestToken);
			$this->Session->write($accessTokenName,$accessToken);
			if ($nf) $this->data['User']['netflix_uid'] = $accessToken->user_id;
			$this->data['User'][$accessKeyName] = $accessToken->key;
			$this->data['User'][$accessSecretName] = $accessToken->secret;
		}
		else {
			$accessToken = file_get_contents($access_url);
			
			if ($service=='facebook'){
				$this->data['User']['facebook_access_key'] = $accessToken;
				$this->Session->write('facebook_access_key',$accessToken);
			}
			elseif ($service=='foursquare'){
				$content = json_decode($accessToken);
				$this->data['User']['foursquare_access_token'] = $content->access_token;
				$this->Session->write('foursquare_access_token',$content->access_token);
			}
		}
		$this->User->save($this->data);
		$this->new_data($service);
		if ($this->Session->check('register') && $this->Session->read('register')=='true'){
			$this->redirect(array('action'=>'register/2'));
		}
		else {
			$this->redirect(array('action'=>'view_my_profile'));
		}
	}
	

	/*
		
	
	function googleCallback(){
		$requestToken = $this->Session->read('google_request_token');
		$consumer = $this->createConsumer('google');
		$accessToken = $consumer->getAccessToken('https://www.google.com/accounts/OAuthGetAccessToken', $requestToken);
		$this->Session->write('google_access_token',$accessToken);
		
		$updated_id = $this->Auth->getUserId();
		$this->User->read(null,$updated_id);
		$this->data['User']['go_access_key'] =  $accessToken->key;
		$this->data['User']['go_access_secret'] =  $accessToken->secret;
		$this->User->save($this->data);
		
		$this->redirect(array('action'=>'view_my_profile'));
	}*/
	
	
	
	
	
	
	function new_data($type){
		
		$user = $this->Auth->getUserInfo();
		$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
			
		switch ($type){
			case 'foursquare':
				$places = $this->getFoursquareData();
				$locations = array();
				$categories = array();
				if (!empty($db_results['Place']['categories']) && !empty($db_results['Place']['locations'])){
					$locations = $db_results['Place']['locations'];
					$categories = $db_results['Place']['categories'];
				}
				list ($locations, $categories) = $this->scrub_foursquare_data($places, $locations, $categories);
				if (!empty($db_results['Place']['body'])){
					$this->data['Place']['body']=json_encode($places).$db_results['Place']['body'];
					$this->Place->read(null,$db_results['Place']['id']);
				}
				else {
					$this->data['Place']['body']=json_encode($places);
					$this->Place->create();
				}
				$this->data['Place']['locations']=json_encode($locations);
				$this->data['Place']['categories']=json_encode($categories);
					
				$this->data['Place']['user_id']=$this->Auth->getUserId();
				$this->Place->set($this->data);
				$this->Place->save();
				
				
				break;
				
				
			case 'linkedin':
				list($work,$education) = $this->getLinkedInData();
				
				$industries = (!empty($db_results['Work']['industries'])) ? $db_results['Work']['industries'] : array();
				$titles = (!empty($db_results['Work']['titles'])) ? $db_results['Work']['titles']: array(); 
				
				list ($titles,$industries) = $this->scrub_work($titles, $industries, $work);
				if (!empty($db_results['School']['body'])){
					$this->data['School']['body']=json_encode($education).$db_results['School']['body'];
					$this->School->read(null,$db_results['School']['id']);
				}
				else {
					$this->School->create();
					$this->data['School']['body']=json_encode($education);
				}
				$this->data['School']['user_id']=$this->Auth->getUserId();
				$this->School->set($this->data);
				$this->School->save();
			
				if (!empty($db_results['Work']['body'])){
					$this->data['Work']['body']=json_encode($work).$db_results['Work']['body'];
					$this->Work->read(null,$db_results['Work']['id']);
				}
				else {
					$this->Work->create();
					$this->data['Work']['body']=json_encode($work);
				}
			
				$this->data['Work']['industries']=json_encode($industries);
				$this->data['Work']['titles']=json_encode($titles);
				$this->data['Work']['user_id']=$this->Auth->getUserId();
				$this->Work->set($this->data);
				$this->Work->save();
				break;
				
			
				
			
			case 'facebook':
			
				list ($master, $fb_data, $fb_movies, $fb_user_likes) = $this->getFacebookData();
				
				//var_dump($fb_user_likes);
				
				if (empty($db_results['Userprofile']['id'])) $this->store_master_data($master);
				$this->compareToLinkedInData($master);
				if ($user['foursquare_access_token']!=''){
					$facebook_place_data = $this->normalize_facebook_data_to_foursquare($fb_data);
					//var_dump($facebook_place_data);
					if (!empty($db_results['Place']['body'])){
						$this->data['Place']['body']=$db_results['Place']['body'].json_encode($facebook_place_data);
						$this->Place->read(null,$db_results['Place']['id']);
					}
					else {
						$this->data['Place']['body']=json_encode($facebook_place_data);
						$this->Place->create();
					}
					$locations = array();
					$categories = array();
					if (!empty($db_results['Place']['categories']) && !empty($db_results['Place']['locations'])){
						$locations = json_decode($db_results['Place']['locations'], true);
						$categories = json_decode($db_results['Place']['categories'], true);
					}
					
				
					
					
					list ($locations, $categories) = $this->scrub_foursquare_data($facebook_place_data, $locations, $categories);
					// locations and categories got messed up
					
					
					$this->data['Place']['locations']=json_encode($locations);
					$this->data['Place']['categories']=json_encode($categories);
				}
				$this->data['Place']['user_id']=$this->Auth->getUserId();
				$this->Place->set($this->data);
				$this->Place->save();
				
				if (!empty($db_results['Interest']['id'])){
			
//					$tag_cloud = json_decode($db_results['Interest']['likes'],true);
	//				$tag_cloud=$this->getFacebookInterests($tag_cloud,$fb_user_likes);
					$this->Interest->read(null,$db_results['Interest']['id']);
				}
				else {
		//			$tag_cloud = $this->getFacebookInterests(array(),$fb_user_likes);
					$this->Interest->create();
				}
				$this->data['Interest']['likes']=json_encode($fb_user_likes->data);
				$this->data['Interest']['user_id']=$this->Auth->getUserId();
				$this->Interest->set($this->data);
				$this->Interest->save();
				break;
			
			case 'meetup':
				
				$interests = $this->getMeetupData();
				
				if (!empty($db_results['Interest']['id'])){
				
					$twitter_tags = json_decode($db_results['Interest']['body'],true);	
					$tag_cloud = $this->scrub_interests($twitter_tags, $interests);
					$this->Interest->read(null,$db_results['Interest']['id']);
				
				}
				else {
					$tag_cloud = $this->scrub_interests(array(), $interests);
					$this->Interest->create();
	
				}
				$this->data['Interest']['body']=json_encode($tag_cloud);
				$this->data['Interest']['user_id']=$this->Auth->getUserId();
				$this->Interest->set($this->data);
				$this->Interest->save();
				break;
			case 'twitter':
			/*
				if ($user['tw_access_key']!=''){
					$user_info = $this->scrub_data_tw($user_info);	
				}
			*/
			
			
				list ($following,$lists_members,$lists_f,$user_list) = $this->getTwitterData();
				if (!empty($db_results['Interest']['id'])){
					$meetup_tags = json_decode($db_results['Interest']['body'], true);
					$tag_cloud = $this->scrub_interests($meetup_tags, $following,$lists_f);
					$this->Interest->read(null,$db_results['Interest']['id']);
				}
				else {
					$tag_cloud = $this->scrub_interests(array(), $following,$lists_f);
					$this->Interest->create();
				}
				$rep_followers = $this->getRepresentativeFollowers($tag_cloud,$user_list,$following);
				var_dump($rep_followers);
				$you = $this->scrub_interests(array(),$lists_members);
				$this->data['Interest']['you_body']=json_encode($you);
				$this->data['Interest']['body']=json_encode($tag_cloud);
				$this->data['Interest']['user_id']=$this->Auth->getUserId();
				$this->Interest->set($this->data);
				$this->Interest->save();
				break;
			case 'netflix':
				list ($in_queue,$seen,$recos) = $this->getNetflixContent();
				$nf_data = array_merge($in_queue,$seen,$recos);	
				$your_genres = $this->figure_out_movie_genre(array(), $nf_data, false);
				if ($user['facebook_access_key']!='' ){
					$fb_user_movies=$this->grab_facebook_movie_data($fb_user_movies);
					$your_genres = $this->figure_out_movie_genre($your_genres,$fb_user_movies,true);
				}
				$this->Movie->create();
				$this->data['Movie']['body'] = json_encode($your_genres);
				$this->data['Movie']['user_id']=$this->Auth->getUserId();
				$this->Movie->set($this->data);
				$this->Movie->save();
			
				break;
		}
		
	}
	function store_master_data($master){
		$user = $this->Auth->getUserInfo();
		$name = preg_split('/[\f\n\r\t\v ]/',$master->name);
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
		
		$this->Userprofile->create();
		if (sizeof($name) == 1) $this->data['Userprofile']['first_name'] = $name[0];
		else {
			$this->data['Userprofile']['first_name']=ucwords($first_name);
			$this->data['Userprofile']['last_name'] = ucwords($last_name);
		}
		$this->data['Userprofile']['hometown']= $master->hometown;
		$this->data['Userprofile']['birthday']=date("Y-m-d H:i:s", strtotime($master->birthday));
		$this->data['Userprofile']['gender']=$master->gender;
		$this->data['Userprofile']['relationship']=$master->status;
		$this->data['Userprofile']['religion']=$master->religion;
		$this->data['Userprofile']['political']=$master->political;
		$this->data['Userprofile']['user_id']=$this->Auth->getUserId();
		$this->Userprofile->set($this->data);
		$this->Userprofile->save();
		$this->User->read(null,$this->Auth->getUserId());
		$this->data['User']['name']=$this->data['Userprofile']['first_name'].' '.$this->data['Userprofile']['last_name'];
		$this->User->set($this->data);
		$this->User->save();
		
	}
	function getRepresentativeFollowers($tag_cloud,$user_id_list,$following){
		$user = $this->Auth->getUserInfo();
		$consumer = $this->createConsumer('twitter');
		$control_value = 0;
		$modified_cloud = array();
		$rep_users = array();
		$rep_user_count = 0;
		$total = array_sum($tag_cloud);
		foreach ($tag_cloud as $key=>$value){
			if ($value > $control_value) $control_value = $value;
			if ($value > 2 && ((($value / $total) * 2) > ($control_value / $total))){
				$modified_cloud[$key]=$value; 
			}
		}
		var_dump($modified_cloud);
		var_dump($following);
		for ($counter = 0; $counter < sizeof($following); $counter++){
			
			$interest_string = preg_split('/[,? ]+/',$following[$counter]->description); 
			$interest_string = preg_replace($this->stop_words,'',$interest_string);
				
			var_dump($interest_string);
			for ($inner_counter=0;$inner_counter<sizeof($interest_string);$inner_counter++){
				if (array_key_exists($interest_string[$inner_counter],$modified_cloud)){
					$rep_users[$rep_user_count++] = $user_id_list[$counter];
				}
			}
		}
		
		return $rep_users;
		
	}
	function getMeetupData(){
		$user=$this->Auth->getUserInfo();
		$accessToken = $this->Session->read('meetup_access_token');
		$consumer_mu = $this->createConsumer('meetup');
		$getData = array('relation'=>'self',
						 'sess'=>'oauth_session');
		$interests=array();
		$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));

		
	
		
		
		$content_mu = $consumer_mu->get($accessToken->key,$accessToken->secret,'https://api.meetup.com/members.json',$getData);
		$mu_user = json_decode($content_mu);
		if ($user['path']=='default.png'){
			$this->User->read(null,$this->Auth->getUserId());
			$this->data['User']['path']=$mu_user->results[0]->photo_url;
			$this->User->set($this->data);
			$this->User->save();
		
		}
		if (empty($db_results['Userprofile']['id'])){
			$this->Userprofile->create();
			$name = preg_split('/[\f\n\r\t\v ]/',$mu_user->results[0]->name);
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
			$this->data['Userprofile']['first_name'] = $first_name;
			$this->data['Userprofile']['last_name'] = $last_name;
			$this->data['Userprofile']['user_id']=$this->Auth->getUserId();
			$this->Userprofile->set($this->data);
			$this->Userprofile->save();	
				$this->User->read(null,$this->Auth->getUserId());
		$this->data['User']['name']=$this->data['Userprofile']['first_name'].' '.$this->data['Userprofile']['last_name'];
		$this->User->set($this->data);
		$this->User->save();
	
		}
	
		for($counter=0;$counter<sizeof($mu_user->results[0]->topics);$counter++){
			$interests[$counter]->description=$mu_user->results[0]->topics[$counter]->name;
		}
		return $interests;
	}
	function getTwitterData(){
		$user=$this->Auth->getUserInfo();
$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
			$accessToken = $this->Session->read('twitter_access_token');
		$consumer = $this->createConsumer('twitter');
		$content=$consumer->get($accessToken->key,$accessToken->secret,'http://twitter.com/account/verify_credentials.xml', array());
		$tw_user = simplexml_load_string($content);
		
		if ($user['path']=='default.png'){
			$this->User->read(null,$this->Auth->getUserId());
			$this->data['User']['path']=$tw_user->profile_image_url;
			$this->User->set($this->data);
			$this->User->save();
		
		}
		$screen_name = $tw_user->screen_name;
		
		
		if (empty($db_results['Userprofile']['id'])){
			$this->Userprofile->create();
			$name = preg_split('/[\f\n\r\t\v ]/',$tw_user->name);
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
			$this->data['Userprofile']['first_name'] = $first_name;
			$this->data['Userprofile']['last_name'] = $last_name;
			$this->data['Userprofile']['user_id']=$this->Auth->getUserId();
			$this->Userprofile->set($this->data);
			$this->Userprofile->save();	
				$this->User->read(null,$this->Auth->getUserId());
		$this->data['User']['name']=$this->data['Userprofile']['first_name'].' '.$this->data['Userprofile']['last_name'];
		$this->User->set($this->data);
		$this->User->save();
	
		}
		$content_tw=$consumer->get($accessToken->key,$accessToken->secret,'http://api.twitter.com/1/statuses/friends.json', array());
		$tw_user = json_decode($content_tw);
		$following=array();
		for ($counter=0;$counter<sizeof($tw_user);$counter++){
			$following[$counter]->name=$tw_user[$counter]->name; 
			$following[$counter]->description=$tw_user[$counter]->description;
		}
		
		$members_on_lists=array();
		
		
		
		
		
		$content_lists_on=$consumer->get($accessToken->key,$accessToken->secret,'http://api.twitter.com/1/'.$screen_name.'/lists/memberships.json', array());
		
		
		
		
		$tw_user = json_decode($content_lists_on);
	
		for ($counter=0;$counter<sizeof($tw_user->lists);$counter++){
			$list_members = json_decode($consumer->get($accessToken->key,$accessToken->secret,'http://api.twitter.com/1/'.$tw_user->lists[$counter]->user->screen_name.'/'.$tw_user->lists[$counter]->id.'/members.json', array()));
			for ($inner_counter=0;$inner_counter<sizeof($list_members->users);$inner_counter++){
				array_push($members_on_lists, $list_members->users[$inner_counter]);
			}
		}
		$lists_f=array();
		$content_lists_f=$consumer->get($accessToken->key,$accessToken->secret,'http://api.twitter.com/1/'.$screen_name.'/lists/subscriptions.json', array());
		$tw_user = json_decode($content_lists_f);
		
		for ($counter=0;$counter<sizeof($tw_user->lists);$counter++){
			$list_members = json_decode($consumer->get($accessToken->key,$accessToken->secret,'http://api.twitter.com/1/'.$tw_user->lists[$counter]->user->screen_name.'/'.$tw_user->lists[$counter]->id.'/members.json', array()));
			for ($inner_counter=0;$inner_counter<sizeof($list_members->users);$inner_counter++){
				array_push($lists_f, $list_members->users[$inner_counter]);
			}
		}
		
		
		
		
		$content_friend_list =$consumer->get($accessToken->key,$accessToken->secret,'http://api.twitter.com/1/friends/ids.json?screen_name='.$screen_name, array());
		$tw_user = json_decode($content_friend_list);
		
		
		
		
		
		
		
		
		return array($following,$members_on_lists,$lists_f,$tw_user);
	}
	
	function compareToLinkedInData($master){
		$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
		if (!empty($db_results['Work']['body'])){
			$work = json_decode($db_results['Work']['body'],true);
		
			foreach ($work as $key=>$value){
				foreach ($value as $title=>$co){
					if ($title == 'company'){
						for ($counter=0;$counter<sizeof($master->work);$counter++){
							if (similar_text($master->work[$counter], $co, $percent)){
								if ($percent > 60){
									$work[$key][$title] = $master->work[$counter];
									array_splice($master->work,$counter,1);
								}
							}
						}
					}
				}
			}
			if (!empty($master->work)){
				$index = sizeof($work);
				for ($counter=0;$counter<sizeof($master->work);$counter++){
					$work[$index++]['company'] = $master->work[$counter];
				}
			}
			$this->Work->read(null, $db_results['Work']['id']);	
		}
		else {
			for($counter=0;$counter<sizeof($master->work);$counter++){
				$work[$counter]['company'] = $master->work[$counter];
			}
			$this->Work->create();
		}
		$this->data['Work']['body']=json_encode($work);
		$this->Work->set($this->data);
		$this->Work->save();
		
		if (!empty($db_results['School']['body'])){
			$school = json_decode($db_results['School']['body'],true);
			foreach ($school as $key=>$value){
				foreach ($value as $title=>$co){
					if ($title == 'school'){
						for ($counter=0;$counter<sizeof($master->education);$counter++){
							if (similar_text($master->education[$counter], $co, $percent)){
								if ($percent > 60){
									$school[$key][$title] = $master->education[$counter];
									array_splice($master->education,$counter,1);
								}
							}
						}
					}
				}
			}
			if (!empty($master->education)){
				$index = sizeof($school);
				for ($counter=0;$counter<sizeof($master->education);$counter++){
					$school[$index++]['school'] = $master->education[$counter];
				}
			}
			$this->School->read(null, $db_results['School']['id']);	
	
		}
		else {
			for($counter=0;$counter<sizeof($master->education);$counter++){
				$school[$counter]['school'] = $master->education[$counter];
			}
			$this->School->create();
		}
		$this->data['School']['body']=json_encode($school);
		$this->School->set($this->data);
		$this->School->save();
		
	}
	
	
	function getFacebookData(){
		$user=$this->Auth->getUserInfo();
		$accessToken = $this->Session->read('facebook_access_key');
		$fb_user = json_decode(file_get_contents('https://graph.facebook.com/me?' . $accessToken));
		$user_info->name=$fb_user->name;
		$user_info->hometown=$fb_user->hometown->name;
		$user_info->location=$fb_user->location->name;
		$user_info->birthday=$fb_user->birthday;
	
				// get the lat long of this and compare to foursquare for travel information
				
		for ($counter=0;$counter<sizeof($fb_user->work);$counter++){
			$user_info->work[$counter]=$fb_user->work[$counter]->employer->name;
		}
			
				for ($counter=0;$counter<sizeof($fb_user->education);$counter++){
					$user_info->education[$counter]=$fb_user->education[$counter]->school->name;
				}
				$user_info->gender=$fb_user->gender;
				$user_info->status=$fb_user->relationship_status;
				$user_info->religion=$fb_user->religion;
				$user_info->political=$fb_user->political;
				
				//get likes 
				$fb_user_likes = json_decode(file_get_contents('https://graph.facebook.com/me/likes?'.$accessToken));
			
					$fb_user_movies = json_decode(file_get_contents('https://graph.facebook.com/me/movies?'.$accessToken));
				
				//get music
				$fb_user_music = json_decode(file_get_contents('https://graph.facebook.com/me/music?'.$accessToken));
				//$this->set('fb_user_music',$fb_user_music);
				
				//get books
				$fb_user_books = json_decode(file_get_contents('https://graph.facebook.com/me/books?'.$accessToken));
				//$this->set('fb_user_books',$fb_user_books);
				
				//get places
				$fb_user_checkins = json_decode(file_get_contents('https://graph.facebook.com/me/checkins?'.$accessToken));
				//$this->set('fb_user_checkins',$fb_user_checkins);
				
	//		var_dump($user_info);	
			return array($user_info, $fb_user_checkins, $fb_user_movies, $fb_user_likes);
	}
	function getLinkedInData(){
		$user=$this->Auth->getUserInfo();
		$dob='';
		$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));

		$consumer_li = $this->createConsumer('linkedin');
		$accessToken = $this->Session->read('linkedin_access_token');
		$content_li=$consumer_li->get($accessToken->key,$accessToken->secret,'http://api.linkedin.com/v1/people/~:(id,first-name,last-name,headline,location,date-of-birth,positions,industry,educations,picture-url,summary,specialties,associations,honors,interests,publications,patents,languages,skills,certifications)', array());
		$li_user = simplexml_load_string($content_li);
		
	
		
		
		
			$user_info['linkedin']->location=$li_user->location->name.','.$li_user->location->country->code;
			foreach($li_user->children() as $child){
				if ($child->getName()=='first-name'){
					$first = $child[0]->value;
				}
				if ($child->getName()=='last-name'){
					$last = $child[0]->value;
				}
				if ($child->getName()=='date-of-birth'){
					$dob=$child[0]->value;
				}
				if ($child->getName()=='picture-url'){
					$pic = $child[0]->value;
				}
			}
			if (empty($db_results['Userprofile']['id'])){
				$this->Userprofile->create();
				$this->data['Userprofile']['first_name'] = $first;
				$this->data['Userprofile']['last_name'] = $last;
				$this->data['Userprofile']['birthday']=(is_null($dob)) ? '': date("Y-m-d H:i:s", strtotime($dob));
				$this->data['Userprofile']['user_id']=$this->Auth->getUserId();
				$this->Userprofile->set($this->data);
				$this->Userprofile->save();
				$this->User->read(null,$this->Auth->getUserId());
				$this->data['User']['name']=$this->data['Userprofile']['first_name'].' '.$this->data['Userprofile']['last_name'];
				$this->User->set($this->data);
				$this->User->save();
			}
			if ($user['path']=='default.png'){
				$this->User->read(null,$this->Auth->getUserId());
				$this->data['User']['path']=$pic;
				$this->User->set($this->data);
				$this->User->save();
			}
		
		$work=array();
		$education=array();
				//$work->stated_industry=$li_user->industry;
	//	var_dump($li_user->positions);		
		for ($counter = 0;$counter<$li_user->positions->attributes();$counter++){
			$work[$counter]->title=(string)$li_user->positions->position[$counter]->title[0];
			// we can also get type (public or private) and size
			$work[$counter]->company=(string)$li_user->positions->position[$counter]->company->name[0];
			$work[$counter]->industry=(string)$li_user->positions->position[$counter]->company->industry[0];
		}
	
		for ($counter = 0;$counter<$li_user->educations->attributes();$counter++){
			$education[$counter]->degree=$li_user->educations->education[$counter]->degree;
			foreach ($li_user->educations->education[$counter]->children() as $child){
				if ($child->getName()=='school-name'){
					$education[$counter]->school=(string)$child[0];
				}
				if ($child->getName()=='field-of-study'){
					$education[$counter]->major=(string)$child[0];
				}
				if ($child->getName()=='degree'){
					$education[$counter]->degree = (string)$child[0];
				}
				if ($child->getName()=='activities'){
					$education[$counter]->activities = (string)$child[0];
				}
				
			}
		}
		return array($work,$education);
	}
	function getFoursquareData(){
		$user=$this->Auth->getUserInfo();
				$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));

		$accessToken = $this->Session->read('foursquare_access_token');
		if (empty($db_results['Userprofile']['id'])){
			//get foursquare user data
			$fs_user_info = json_decode(file_get_contents('https://api.foursquare.com/v2/users/self?oauth_token='.$accessToken));
		
			$this->Userprofile->create();
			$this->data['Userprofile']['first_name'] = $fs_user_info->response->user->firstName;
			$this->data['Userprofile']['last_name'] = $fs_user_info->response->user->lastName;
			//$this->data['Userprofile']['hometown']= $fs_user_info->response->user->homeCity;
			$this->data['Userprofile']['gender']=$fs_user_info->response->user->gender;
			$this->data['Userprofile']['user_id']=$this->Auth->getUserId();
			$this->Userprofile->set($this->data);
			$this->Userprofile->save();
			
				$this->User->read(null,$this->Auth->getUserId());
		$this->data['User']['name']=$this->data['Userprofile']['first_name'].' '.$this->data['Userprofile']['last_name'];
		$this->User->set($this->data);
		$this->User->save();
	
			
		}
		if ($user['path']=='default.png'){
			$this->User->read(null,$this->Auth->getUserId());
			$this->data['User']['path']=$fs_user_info->response->user->photo;
			$this->User->set($this->data);
			$this->User->save();
		}
		
		$fs_user = json_decode(file_get_contents('https://api.foursquare.com/v2/users/self/venuehistory?oauth_token='.$accessToken));
				
		$limit = $fs_user->response->venues->count;
		$venues = array();
		for($counter=0;$counter<$limit;$counter++){
			$venues[$counter]->name=$fs_user->response->venues->items[$counter]->venue->name;
			$venues[$counter]->foursquare_id = $fs_user->response->venues->items[$counter]->venue->id;
			$venues[$counter]->lat = $fs_user->response->venues->items[$counter]->venue->location->lat;
			$venues[$counter]->lon = $fs_user->response->venues->items[$counter]->venue->location->lng;
			if (!isset($fs_user->response->venues->items[$counter]->venue->location->city)){
				$url = "http://where.yahooapis.com/geocode?location=".$venues[$counter]->lat.",+".$venues[$counter]->lon."&gflags=R&flags=J&appid=cENXMi4g";
				$address = json_decode(file_get_contents($url));
				$venues[$counter]->city = $address->ResultSet->Results[0]->city;
				$venues[$counter]->state = $address->ResultSet->Results[0]->statecode;
				$venues[$counter]->country = $address->ResultSet->Results[0]->countrycode;
			}
			else {
				
				$venues[$counter]->city = $fs_user->response->venues->items[$counter]->venue->location->city;
				$venues[$counter]->state = $fs_user->response->venues->items[$counter]->venue->location->state;
				$venues[$counter]->country = (!isset($fs_user->response->venues->items[$counter]->venue->location->country)) ? 'US' : $fs_user->response->venues->items[$counter]->venue->location->country;
	//			pr($fs_user->response->venues->items[$counter]);
			}
			
			for ($inner_count=0;$inner_count<sizeof($fs_user->response->venues->items[$counter]->venue->categories);$inner_count++){
				$venues[$counter]->sub_categories[$inner_count]->name=$fs_user->response->venues->items[$counter]->venue->categories[$inner_count]->name;
				for ($double_inner_count = 0; $double_inner_count < sizeof($fs_user->response->venues->items[$counter]->venue->categories[$inner_count]->parents); $double_inner_count++){
					$venues[$counter]->categories[$inner_count]->name=$fs_user->response->venues->items[$counter]->venue->categories[$inner_count]->parents[$double_inner_count];
				}
			}
		}

		return $venues;
	}
	function scrub_work($titles, $industries, $work){
		for ($counter = 0;$counter<sizeof($work);$counter++){
			if (!isset($titles[$work[$counter]->title])) $titles[$work[$counter]->title]=1;
			else $titles[$work[$counter]->title]=$titles[$work[$counter]->title]+1;
			if (!isset($industries[$work[$counter]->industry])) $industries[$work[$counter]->industry]=1;
			else $industries[$work[$counter]->industry]=$industries[$work[$counter]->industry]+1;
		}
		return array($titles,$industries);
	}
		
		
		
		
	
	function normalize_facebook_data_to_foursquare($venues){
		$user = $this->Auth->getUserInfo();
		$foursquare_venue_list = array();
		if ($user['foursquare_access_token']!=''){
			for ($counter = 0; $counter < sizeof($venues->data); $counter++) {
				
				
				$result = json_decode(file_get_contents('https://api.foursquare.com/v2/venues/search?ll='.$venues->data[$counter]->place->location->latitude.','.$venues->data[$counter]->place->location->longitude.'&query='.urlencode($venues->data[$counter]->place->name).'&oauth_token='.$user['foursquare_access_token']));
				for ($inner_counter = 0; $inner_counter<sizeof($result->response->groups); $inner_counter++ ){
					if ($result->response->groups[$inner_counter]->name=='Matching Places'){
						
						$place = $result->response->groups[$inner_counter]->items[0];
						$foursquare_venue_list[$counter]->name=$place->name;
						$foursquare_venue_list[$counter]->foursquare_id=$place->id;
						$foursquare_venue_list[$counter]->lat=$place->location->lat;
						$foursquare_venue_list[$counter]->lon=$place->location->lng;
						
						if (!isset($place->location->city)){
							$url = "http://where.yahooapis.com/geocode?location=".$foursquare_venue_list[$counter]->lat.",+".$foursquare_venue_list[$counter]->lon."&gflags=R&flags=J&appid=cENXMi4g";
							$address = file_get_contents($url);
							$foursquare_venue_list[$counter]->city = $address->ResultSet->Results[0]->city;
							$foursquare_venue_list[$counter]->state = $address->ResultSet->Results[0]->statecode;
							$foursquare_venue_list[$counter]->country = $address->ResultSet->Results[0]->country;
						}
						else {
							$foursquare_venue_list[$counter]->city=$place->location->city;
							$foursquare_venue_list[$counter]->state=$place->location->state;
							$foursquare_venue_list[$counter]->country=$place->location->country;
						}
						for ($inner_count=0;$inner_count<sizeof($place->categories);$inner_count++){
							$foursquare_venue_list[$counter]->sub_categories[$inner_count]->name=$place->categories[$inner_count]->name;
							for ($double_inner_count = 0; $double_inner_count < sizeof($place->categories[$inner_count]->parents); $double_inner_count++){
								$foursquare_venue_list[$counter]->categories[$inner_count]->name=$place->categories[$inner_count]->parents[$double_inner_count];
							}
						}					
					}
				}
			}
		}
		return $foursquare_venue_list;
	}
	function scrub_foursquare_data($venues, $location, $categories){
		for ($counter=0;$counter<sizeof($venues);$counter++){
			$outer_loc = $venues[$counter]->city.' ,'.$venues[$counter]->state.' ,'.$venues[$counter]->country;
			if ($outer_loc == '') break;
			if (!isset($location[$outer_loc])){
				$url = "http://where.yahooapis.com/geocode?line2=".urlencode($venues[$counter]->city).",+".urlencode($venues[$counter]->state)."&flags=J&appid=cENXMi4g";
				$address = json_decode(file_get_contents($url));
				$loc = $address->ResultSet->Results[0]->city.' ,'.$address->ResultSet->Results[0]->statecode.' ,'.$address->ResultSet->Results[0]->countrycode;
				if ($loc == '') break;
				if (!isset($location[$loc])){
					$location[$loc]=1;
				}
				else {
					$location[$loc]=$location[$loc]+1;
				}
			}
			else $location[$outer_loc]=$location[$outer_loc]+1;
		
			
			if (isset($venues[$counter]->sub_categories)){
				for ($inner_counter=0;$inner_counter<sizeof($venues[$counter]->sub_categories); $inner_counter++){
					if (!isset($categories[$venues[$counter]->categories[$inner_counter]->name])){
						$categories[$venues[$counter]->categories[$inner_counter]->name]=1;
					}
					else $categories[$venues[$counter]->categories[$inner_counter]->name]=$categories[$venues[$counter]->categories[$inner_counter]->name]+1;
				}
			}
		}
		arsort($location, SORT_NUMERIC);
		arsort($categories, SORT_NUMERIC);
		return array($location,$categories);
	}
	function view_my_profile(){
		$user_info=array();
	
		if(is_null($this->Auth->getUserId())){
       		Controller::render('/deny');
        }
		else {
						
	
			$user = $this->Auth->getUserInfo();
			$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
			if (!empty($db_results)){
				$movie_data = (isset($db_results['Movie']['body'])) ? true : false;
			}
			//var_dump($db_results);
		
			//google
			/*
			if ($user['go_access_key']!=''){
				$consumer_go = $this->createConsumer('google');
				$getData_go = array('orderby'=>'starttime');
				$content_go=$consumer->get($accessToken->key,$accessToken->secret,'http://www.google.com/calendar/feeds/default/allcalendars/full?orderby=starttime.', $getData_go);
				$go_user = json_decode($content_go);
				$this->set('go_user',$go_user);
			}
			*/		//var_dump($db_results);
	
			
				$this->set('pic',$db_results['User']['path']);
			//pandora
//			$this->set(compact('user'));
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
				var_dump($db_results['Place']['categories']);
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
				
				//$this->set('work'
				
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
		
			
			
	
			$this->set('user',$db_results);
	
	
			
		}
		
		// for travel look at 4sq for outside of the country
	}
	// movie_data not as much weight unless its facebook
	
	function figure_out_movie_genre($type_of_liked_movies, $in_queue, $fb_flag){
		if (!$fb_flag){
			for($counter=0;$counter<sizeof($in_queue);$counter++){
				for ($inner_counter=0;$inner_counter<sizeof($in_queue[$counter]->categories);$inner_counter++){
					if(!isset($type_of_liked_movies[(string)$in_queue[$counter]->categories[$inner_counter]])){
						$type_of_liked_movies[(string)$in_queue[$counter]->categories[$inner_counter]]=1;
					}
					else $type_of_liked_movies[(string)$in_queue[$counter]->categories[$inner_counter]]++;
				}
			}
		}
		else{
			for($counter=0;$counter<sizeof($in_queue);$counter++){
				if(!isset($type_of_liked_movies[$in_queue[$counter]])){
					$type_of_liked_movies[(string)$in_queue[$counter]]=3;
				}
				else $type_of_liked_movies[(string)$in_queue[$counter]]+=3;
			}
		}
		arsort($type_of_liked_movies, SORT_NUMERIC);
		return $type_of_liked_movies;
	}
	
	
	
	function grab_facebook_movie_data($fb){
		$facebook_movie_data_scrubbed=array();
		for($counter=0;$counter<sizeof($fb);$counter++){
			$film_details = json_decode(file_get_contents('https://graph.facebook.com/'.$fb->data[$counter]->id));
			$facebook_movie_data_scrubbed[$counter]->title=$film_details->name;
			$facebook_movie_data_scrubbed[$counter]->categories[0]=$film_details->genre;
		}
		return $facebook_movie_data_scrubbed;
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
	
	function scrub_data_li($main_array, $work, $education){
		if (!empty($work) || !empty($education)){
			if (!is_null($main_array['facebook'])){
				for ($counter = 0;$counter<sizeof($main_array['facebook']->work);$counter++){
					for ($inner_counter=0;$inner_counter<sizeof($work);$inner_counter++){
						if (preg_match ('/\b(?i)'.$main_array['facebook']->work[$counter].'\b/',$work[$inner_counter]->company )){
							break;
						}
					}
					$work[sizeof($work)]->company=$main_array['facebook']->work[$counter];
				}
				for ($counter = 0;$counter<sizeof($main_array['facebook']->education);$counter++){
					for ($inner_counter=0;$inner_counter<sizeof($education);$inner_counter++){
						if (preg_match ('/\b(?i)'.$main_array['facebook']->education[$counter].'\b/',$education[$inner_counter]->school)){
							break;
						}
					}
					$education[sizeof($education)]->company=$main_array['facebook']->education[$counter];
				}
				if (!preg_match ('/\b(?i)'.$main_array['facebook']->name.'\b/',$main_array['linkedin']->name )){
					$main_array['main']->name=$main_array['facebook']->name.' '.$main_array['linkedin']->name;
				}
				if (!preg_match ('/\b(?i)'.$main_array['facebook']->location.'\b/',$main_array['linkedin']->location )){
					$main_array['main']->location=$main_array['facebook']->location.' '.$main_array['linkedin']->location;
				}
				// compare birthdays
				if (!preg_match ('/\b(?i)'.$main_array['facebook']->location.'\b/',$main_array['linkedin']->location )){
					$main_array['main']->location=$main_array['facebook']->location.' '.$main_array['linkedin']->location;
				}
				echo 'linkedin complete';
			}
		}
		return array($main_array,$work,$education);
	}
	/*
				$user_info['linkedin']->location=$li_user->location->name.','.$li_user->location->country->code;
				$user_info['linkedin']->name = $first.' '.$last;
				$user_info['linkedin']->birthday=$dob;
				$user_info['linkedin']->description = $li_user->headline;
	*/
	function scrub_data_tw($main_array){
		if (!is_null($main_array['twitter'])){
			if (!preg_match ('/\b(?i)'.$main_array['twitter']->name.'\b/',$main_array['facebook']->name )){
				$main_array['main']->name=$main_array['twitter']->name.' '.$main_array['facebook']->name;
			}
			if (!preg_match ('/\b(?i)'.$main_array['twitter']->location.'\b/',$main_array['facebook']->location )){
				$main_array['main']->location=$main_array['twitter']->location.' '.$main_array['facebook']->location;
			}
			echo 'twitter complete';
		}
		return array($main_array);
	}
	
	function edit(){
		
	 	if(is_null($this->Auth->getUserId())){
          Controller::render('/deny');
         }
		else {
			if (!empty($this->data)) {
				if ($this->data['User']['new_password']!='' && $this->data['User']['new_password']==$this->data['User']['confirm_password']){
					$this->data['User']['password'] = $this->Auth->hasher($this->data['User']['new_password']); 
				}
				$this->data['User']['screen_name']=strtolower($this->data['User']['screen_name']);
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
				$interest = json_decode($user['Interest']['likes'],true);
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
	
	function getNetflixContent(){
		$user=$this->Auth->getUserInfo();
		$consumer_nf = $this->createConsumer('netflix');
					$db_results = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));

		
		// this will never be false - $user is not bringing in linked tables	
		if (empty($db_results['Userprofile']['id'])){
			$response = $consumer_nf->get($user['netflix_access_key'],$user['netflix_access_secret'],'http://api.netflix.com/users/'.$user['netflix_uid'], array());
			$nf_user=simplexml_load_string($response);
			$this->Userprofile->create();
			$this->data['Userprofile']['first_name']=$nf_user->user->first_name;
			$this->data['Userprofile']['last_name']=$nf_user->user->last_name;
			$this->data['Userprofile']['user_id']=$this->Auth->getUserId();
			$this->Userprofile->set($this->data);
			$this->Userprofile->save();
				$this->User->read(null,$this->Auth->getUserId());
		$this->data['User']['name']=$this->data['Userprofile']['first_name'].' '.$this->data['Userprofile']['last_name'];
		$this->User->set($this->data);
		$this->User->save();
	
		}
		$content_nf = $consumer_nf->get($user['netflix_access_key'],$user['netflix_access_secret'],'http://api.netflix.com/users/'.$user['netflix_uid'].'/queues/disc',array());
		$nf_user = simplexml_load_string($content_nf);
				$in_queue=array();
				for($counter=0;$counter<$nf_user->number_of_results;$counter++){
					if (!is_null($nf_user->queue_item[$counter])){ 	
						foreach($nf_user->queue_item[$counter]->link[1]->attributes() as $a => $b) {
 							if ($a=='title') $in_queue[$counter]->title=$b;
							if ($a=='href') $in_queue[$counter]->url = $b;
						}
						for($counter_inner=2;$counter_inner<sizeof($nf_user->queue_item[$counter]->category);$counter_inner++){
							$genre_count=0;
							foreach($nf_user->queue_item[$counter]->category[$counter_inner]->attributes() as $a => $b){
								if ($a=='term') $in_queue[$counter]->categories[$genre_count++]=$b;
							}
						}
					}
				}
				$offset = sizeof($in_queue);
				$content_nf_instant = $consumer_nf->get($user['netflix_access_key'],$user['netflix_access_secret'],'http://api.netflix.com/users/'.$user['netflix_uid'].'/queues/instant',array());
				$nf_user = simplexml_load_string($content_nf_instant);
				for($counter=0;$counter<$nf_user->number_of_results;$counter++){
					if (!is_null($nf_user->queue_item[$counter])){ 	
						foreach($nf_user->queue_item[$counter]->link[1]->attributes() as $a => $b) {
 							if ($a=='title') $in_queue[$counter+$offset]->title=$b;
							if ($a=='href') $in_queue[$counter+$offset]->url = $b;
						}
						for($counter_inner=2;$counter_inner<sizeof($nf_user->queue_item[$counter]->category);$counter_inner++){
							$genre_count=0;
							foreach($nf_user->queue_item[$counter]->category[$counter_inner]->attributes() as $a => $b){
								if ($a=='term') $in_queue[$counter+$offset]->categories[$genre_count++]=$b;
							}
						}
					}
				}
				$seen=array();
				$content_nf_rental = $consumer_nf->get($user['netflix_access_key'],$user['netflix_access_secret'],'http://api.netflix.com/users/'.$user['netflix_uid'].'/rental_history',array());
				$nf_user = simplexml_load_string($content_nf_rental);
				for($counter=0;$counter<$nf_user->number_of_results;$counter++){
					if (!is_null($nf_user->rental_history_item[$counter])){ 	
						foreach($nf_user->rental_history_item[$counter]->link[0]->attributes() as $a => $b) {
 							if ($a=='title') $seen[$counter]->title=$b;
							if ($a=='href') $seen[$counter+$offset]->url = $b;
	
						}
						for($counter_inner=1;$counter_inner<sizeof($nf_user->rental_history_item[$counter]->category);$counter_inner++){
							$genre_count=0;
							foreach($nf_user->rental_history_item[$counter]->category[$counter_inner]->attributes() as $a => $b){
								if ($a=='term') $seen[$counter]->categories[$genre_count++]=$b;
							}
						}
					}
				}
				$recos=array();
				$content_nf_reco = $consumer_nf->get($user['netflix_access_key'],$user['netflix_access_secret'],'http://api.netflix.com/users/'.$user['netflix_uid'].'/recommendations',array());
				$nf_user = simplexml_load_string($content_nf_reco);
				for($counter=0;$counter<$nf_user->number_of_results;$counter++){
					if (!is_null($nf_user->recommendation[$counter])){ 	
						foreach($nf_user->recommendation[$counter]->link[0]->attributes() as $a => $b) {
 							if ($a=='title') $recos[$counter]->title=$b;
							if ($a=='href') $recos[$counter+$offset]->url = $b;
	
						}
						for($counter_inner=0;$counter_inner<sizeof($nf_user->recommendation[$counter]->category);$counter_inner++){
							$genre_count=0;
							foreach($nf_user->recommendation[$counter]->category[$counter_inner]->attributes() as $a => $b){
								if ($a=='term') $recos[$counter]->categories[$genre_count]=$b;
							}
						}
					}
				}
				
				
				
				return array($in_queue,$seen,$recos);
			}
	
	
	
		function scrub_movie_data($fb,$nf_seen){
		$added_film=0;
		$dupe=false;
		for ($fb_counter=0;$fb_counter<sizeof($fb_counter);$fb_counter++){
			for ($counter=0;$counter<sizeof($nf_seen);$counter++){
				similar_text($fb[$fb_counter]->name,$nf_seen[$counter]->name,$percent);
				if ($percent>80) {
					$dupe=true;
					break;
				}
			}
			if (!$dupe) {
				$nf_seen[sizeof($nf_seen)+$added_film]->name=$fb[$fb_counter]->name;
				$nf_seen[sizeof($nf_seen)+$added_film]->categories[0]=$fb[$fb_counter]->categories[0];
				$added_film++;
			}
		}
		return $nf_seen;
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
					$score += 5;
				}
				elseif ($month > 1 && $month < 3) {
					$score+=2;
				}
				if ($years < 10){
					$score++;
				}
				if ($user_sign == $other_user_sign){
					$score += 3;
				}
			
				if ($user['Userprofile']['gender']==$other_user['Userprofile']['gender']){
					$score++;
				}
				similar_text($user['Userprofile']['relationship'],$other_user['Userprofile']['relationship'],$r_match);
				if ($r_match > 50) $score++;	
							
				similar_text($user['Userprofile']['religion'],$other_user['Userprofile']['religion'],$re_match);
				if ($re_match > 50) $score+=2;			
	
				similar_text($user['Userprofile']['political'],$other_user['Userprofile']['political'],$p_match);
				if ($p_match > 50) $score+=3;			
				
				
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
	
					if ($d_miles < 1) $score += 20;
					elseif ($d_miles < 10) $score += 16;
					elseif ($d_miles < 25) $score += 12;
					elseif ($d_miles < 50) $score += 10;
					elseif ($d_miles < 100) $score += 7;
					elseif ($d_miles < 150) $score += 3;
					elseif ($d_miles < 200) $score++;
	
	
				}
			}
			
			
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
				
				for ($counter=0;$counter<sizeof($my_schools);$counter++){
					$url = "http://where.yahooapis.com/geocode?q=".urlencode($my_schools[$counter]['school'])."&flags=J&gflags=R&appid=cENXMi4g";
					$address = json_decode(file_get_contents($url));
					if (!$address->ResultSet->Error){
						$my_lat[$counter] = $address->ResultSet->Results[0]->latitude;
						$my_long[$counter] = $address->ResultSet->Results[0]->longitude;
					}
					
					for ($inner_counter=0;$inner_counter<sizeof($your_schools);$inner_counter++){
						similar_text($my_schools[$counter]['school'],$your_schools[$inner_counter]['school'],$match);
						if ($match > 75) $score+=30;
						if ($counter==0){
							$url = "http://where.yahooapis.com/geocode?q=".urlencode($your_schools[$inner_counter]['school'])."&flags=J&gflags=R&appid=cENXMi4g";
							$address = json_decode(file_get_contents($url));
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
						
					
					}
				}
				
				
			}
			// compare works
			if (!is_null($user['Work']['id']) && !is_null($other_user['Work']['id'])){
				
				//var_dump($user['Work']['body']);
							echo 'checking work';
	
				//var_dump($other_user['Work']['body']);
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
	function edit_work($id=null,$key=null){
		$user = $this->User->find('first', array('conditions' => (array('User.id'=>$this->Auth->getUserId()))));
		$work = json_decode($user['Work']['body'],true);
		
		if (!empty($this->data)){
			var_dump($work);
			$work[$id][$key] = $this->data['User']['val'];
			$this->Work->read(null,$user['Work']['id']);
			$this->data['Work']['body'] = json_encode($work);
			$this->Work->set($this->data);
			$this->Work->save();
			var_dump($this->data);
			$this->set('editing',false);
			$this->set('key',$this->data['User']['val']);
			$this->set('id',$id);
			$this->set('key',$key);
		}
		else {
			$this->set('value',$work[$id][$key]); 
			$this->set('editing',true);
		}
		$this->set('div_name','edit_'.$key.'_'.$id);
		$this->render();
	}
}

?>