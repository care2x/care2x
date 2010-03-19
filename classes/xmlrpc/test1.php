<?php
require('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
require_once($root_path.'classes/ixr_library.inc.php');
$client = new IXR_Client('http://scripts.incutio.com/xmlrpc/simpleserver.php');
$client->query('test.getTime');
print $client->getResponse();
// Prints the current time, according to our web server
$test = new IXR_Client('http://scripts.incutio.com/xmlrpc/simpleserver.php');
if (!$test->query('test.addArray', array(3, 5, 7))) {
   die('An error occurred - '.$test->getErrorCode().":".$test->getErrorMessage());
}
print $test->getResponse();



$client = new IXR_Client('http://scripts.incutio.com/xmlrpc/simpleserver.php');
if (!$client->query('test.add', 4, 5)) {
   die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
}
print $client->getResponse();



?>
