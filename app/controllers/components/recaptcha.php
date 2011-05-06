<?php
class RecaptchaComponent extends Object
{
  var $publickey = "6LdScwMAAAAAAHLKgZyO0d4TnrMCDSZxxF9f2a-r"; //production  
  var $privatekey = "6LdScwMAAAAAANUSe23orKU0sTkVamhESZlDH5Tx"; //production  

// var $publickey = "6LdUcwMAAAAAALdi4mvitwmi2yig5Q-P4pjZECDG";  //staging
// var $privatekey = "6LdUcwMAAAAAAJ7xgbfQnDpHuoZ0Sp4a5gsXoBW-"; //staging
 

    function startup(&$controller)
    {
        $this->controller = $controller;
    }
 
    function render()
    {
        App::import('vendor', 'Recaptcha', array('file'=>'recaptcha/recaptchalib.php'));
 
        $error = null;
 
        echo recaptcha_get_html($this->publickey, $error);
    }
 
    function verify()
    {
        App::import('vendor', 'Recaptcha', array('file'=>'recaptcha/recaptchalib.php'));
 
        $resp = recaptcha_check_answer ($this->privatekey,
                                  $_SERVER["REMOTE_ADDR"],
                                  $_POST["recaptcha_challenge_field"],
                                  $_POST["recaptcha_response_field"]);
 
        if ($resp->is_valid) {
            return true;
        } else {
            return false;
        }
    }
}
?>