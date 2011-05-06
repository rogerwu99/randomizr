<?php

App::import('Core',array('Folder'));

class WhitespaceShell extends Shell
{
	var $tasks = array();
	var $uses = array();
		
	
	function main()
	{
		$App = new Folder(APP);
		
		$r = $App->findRecursive('.*\.php');
		$this->out("Checking *.php in ".APP);
		foreach($r as $file) {
			$c = file_get_contents($file);
			if(preg_match('/^[\n\r|\n\r|\n|\r|\s]+\<\?php/',$c)) {
				$this->out('!!!contains leading whitespaces: '.$this->shortPath($file));
			}
			if(preg_match('/\?\>[\n\r|\n\r|\n|\r|\s]+$/',$c)) {
				$this->out('!!!contains trailing whitespaces: '.$this->shortPath($file));
			}
			
			
		}
		
	}

}

?>