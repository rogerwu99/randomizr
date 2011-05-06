<?php

class UtilsComponent extends Object
{
    
    var $components = array('Auth');
	

	function make_bitly($url){
		$apikey='R_6a63c69f28608206105aca1834a94799';
		$login = 'moocrunch';
		
		$service= 'http://api.bit.ly/v3/shorten?login='.$login.'&apiKey='.$apikey.'&longUrl='.urlencode($url).'&format=xml&history=1';
		$doc = new DOMDocument;
    	$doc->load($service);
    	$this->data=array();
		$this->data['bitly']['url'] =$doc->getElementsByTagName("url")->item(0)->nodeValue;
		$this->data['bitly']['hash'] =$doc->getElementsByTagName("hash")->item(0)->nodeValue;
		$this->data['bitly']['new_hash'] =$doc->getElementsByTagName("new_hash")->item(0)->nodeValue;
		return $this->data;
	}




	function url_exists($url) 
	{
        $hdrs = @get_headers($url);
        return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
    } 

    function html_to_db($string)
    {
        $out = mb_convert_encoding($string, 'UTF-8', 'ISO-8859-1');
        return $out;        
    }
    
    function db_to_html($string)
    {
         $out =  mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');
         return $out;   
    }
    function hasVisited($uid, $type){
		App::import('Model','User');
		$this->User=new User();
		if ($type=='fb') $query = "select count(*) as c from users where fb_uid=$uid;";
		else $query = "select count(*) as c from users where tw_uid=$uid;"; 
	    $res=$this->User->query($query);
		$results=$res[0][0]['c'];
		if ($results>0) {
			return true;
		}
		else {
			return false;
		}
	}
}


?>