
<?php 

error_reporting(E_ALL|E_STRICT);
ini_set("display_errors", "on");


require_once('Zend/Amf/Server.php');
require_once('Tutorials.php');

$server = new Zend_Amf_Server();
$server->setClass("Tutorials");

echo($server->handle());