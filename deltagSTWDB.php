<?php

//DELETE SINGLE TAG FROM DATABASE
header("Content-Type: application/json");

//bring in encryption function
require 'encdec.php';

//test parameters
if (!isset($_REQUEST['key'])  || !isset($_REQUEST['userdb']) || !isset($_REQUEST['tag'])) {  die("No pin, tag or userdb present"); }
$key = trim($_REQUEST['key']);
$userdb = trim($_REQUEST['userdb']);
$tag = trim($_REQUEST['tag']);

//get encrypted db contents
$file = file_get_contents($userdb);

//decrypt db contents
$json = base64_decode(encdec($file,$key));

//decode json to php array
$data = json_decode($json,true);

//remove supplied tag and value
unset($data[$tag]);

//encode php array to json
$final = json_encode($data);

//encrypt json
$newData = encdec(base64_encode($final),$key);

//set data to db
file_put_contents($userdb, $newData);

//output
$result = array("DELETED", $tag);
echo json_encode($result);

?>

