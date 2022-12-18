<?php

header("Content-Type: application/json");

//bring in encryption function
require 'encdec.php';

//test parameters
if (!isset($_REQUEST['key'])  || !isset($_REQUEST['userdb'])) {  die("No pin or userdb present"); }
$key = trim($_REQUEST['key']);
$userdb = trim($_REQUEST['userdb']);

//get encrypted db contents
$file = file_get_contents($userdb);

//decrypt db contents to json
$json = base64_decode(encdec($file,$key));

//output
echo $json;

?>
