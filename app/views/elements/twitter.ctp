<?

	$search ="http://api.twitter.com/1/statuses/user_timeline.xml?screen_name=rogerwu99"; 
	$x = new DOMDocument();
  	$x->load($search);
	$titles = $x->getElementsByTagName("text");
	echo $titles->item(0)->nodeValue; 
?>
