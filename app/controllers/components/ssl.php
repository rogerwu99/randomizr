<?php
class SslComponent extends Object {

	var $components = array('RequestHandler');

	var $Controller = null;

	function initialize(&$Controller) {
		$this->Controller = $Controller;
	}

	function force() {
		if(!$this->RequestHandler->isSSL()) {
			$this->Controller->redirect('https://'.$this->__url(443));
		}
	}

	function unforce() {
		if($this->RequestHandler->isSSL()) {
			$this->Controller->redirect('http://'.$this->__url());
		}
	}

	/**This method updated from John Isaacks**/
	function __url($default_port = 80)
	{
		$port = env('SERVER_PORT') == $default_port ? '' : ':'.env('SERVER_PORT');
		return env('SERVER_NAME').$port.env('REQUEST_URI');
	}
}
?>