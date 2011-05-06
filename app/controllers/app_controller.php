<?php 
App::import('Vendor', 'mobile-detect', array('file'=> 'mobile-detect'.DS.'Mobile_Detect.php'));
App::import('Vendor', 'browscap', array('file'=>'Browser.php'));
class AppController extends Controller 
{
  var $components = array('Auth', 'RequestHandler', 'Utils', 'Zend.Amf');
  var $helpers = array('Session', 'Javascript', 'Form', 'Text', 'Html', 'Crumb');
  var $uses = array('User');

   
	var $facebook;
    
	 function beforeFilter() 
    {
	    $this->RequestHandler->setContent('json', 'text/x-json');
		
	}
	
		
	
	
	
	function _login()
  {	
  	if(is_array($this->data) && array_key_exists('Auth',$this->data) )
    { 
	  $check_auth=$this->Auth->authenticate_from_post($this->data['Auth']);
      $this->data['Auth']['password'] = '';
      if ($check_auth)
      {
	  		if (empty($this->data['Auth']['flash']))
			{
            	$this->redirect(array('controller'=>'beta','action'=>'index'));
      		}
			else
			{
				$user_id = $this->Auth->getUserId();
			}
	  }
      else
      {	//echo 'cool';
            $this->redirect(array('controller'=>'users','action'=>'login'));
      }
    }
	
  }
  
  function logout()
  {
    $this->Auth->logout();
  }





}

?>