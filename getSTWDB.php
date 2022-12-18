<?php

header("Content-Type: application/json");

//bring in encryption function
require 'encdec.php';

//test for parameters
if (!isset($_REQUEST['tag']) || !isset($_REQUEST['key']) || !isset($_REQUEST['userdb'])) { die("No tag, pin or userdb present"); }
$tag = $_REQUEST['tag'];
$key = trim($_REQUEST['key']);
$userdb = trim($_REQUEST['userdb']);

//get encrypted db contents
$file = file_get_contents($userdb);

//decrypt db contents
$json = base64_decode(encdec($file,$key));

//decode json to php array
$data = json_decode($json, true);

//output - return value for supplied tag
$result = array("VALUE", $tag, ($data[$tag] ==null ? "" : $data[$tag]));
echo json_encode($result);

?>
