<?php 
class MailController extends AppController 
{
    var $name = 'Mail';
    var $uses = array('User','Merchant');//, 'Error', 'ErrorCode', 'Alert');
    var $components = array('Email');
    
    function send_new_registrant($email, $name) 
    {
        $this->Email->to = 'rogerwu99@yahoo.com';
        $this->Email->subject = 'NEW REGISTRANT';
        $this->Email->replyTo = 'robot@klickable.tv';
        $this->Email->from = 'ROBOT <robot@klickable.tv>';
        $this->Email->template = 'new_registrant';
        $this->set('email', $email);
        $this->set('name', $name); 
	
		 $this->Email->send();
		//exit;	
    } 
	function send_welcome_message($email, $name)
	{
		$this->Email->to = $email;
        $this->Email->subject = 'Welcome to Bantana';
        $this->Email->replyTo = 'roger@alumni.upenn.edu';
        $this->Email->from = 'Bantana <rogerwu99@bantana.com>';
        $this->Email->template = 'welcome';
        $this->set('email', $email);
        $this->set('name', $name); 
		
		$this->Email->send();
		
		$this->send_new_registrant($email,$name);
		$this->redirect('/');	
		
		
		
	//	return;
	//exit;
	}
	function send_redeem_message($user_id,$discount_id)
	{
		$user = $this->User->findById($user_id);
		$discount = $this->Discount->findById($discount_id);
	//	var_dump($user);
	//	var_dump($discount);
		$this->Email->to = $user['User']['email'];
        $this->Email->subject = 'Your Bantana Deal is Ready!';
        $this->Email->replyTo = 'roger@alumni.upenn.edu';
        $this->Email->from = 'Bantana <rogerwu99@bantana.com>';
        $this->Email->template = 'deal';
        $this->set(compact('user'));
        $this->set(compact('discount'));
		//user_name 
		//discount_name
		//discount_text
		$this->Email->send();
		//$this->redirect(array('controller'=>'discounts','action'=>'show',$discount['Discount']['id']));

	}
	function send_feedback($type,$user_id){
		$user = $this->User->findById($user_id);
		$this->Email->to = 'rogerwu99@gmail.com';
        if ($type=='Merchant') $this->Email->subject = 'Merchant Feedback!';
        else $this->Email->subject = 'User Feedback!';
		$this->Email->from = 'Bantana <rogerwu99@bantana.com>';
        $this->Email->template = 'feedback';
        $this->set(compact('user'));
		$this->set('mail_sent',true);
		$this->set('user_type',$type);
		$this->render('/elements/feedback');
	}
}
?>