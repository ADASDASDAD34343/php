<?php

//GET ALL TAGS IN DATABASE
header("Content-Type: application/json");

//bring in encryption function
require 'encdec.php';

//test parameters
if (!isset($_REQUEST['key'])  || !isset($_REQUEST['userdb'])) {  die("No pin or userdb present"); }
$key = trim($_REQUEST['key']);
$userdb = trim($_REQUEST['userdb']);

//get db contents
$file = file_get_contents($userdb);

//decrypt db contents
$json = base64_decode(encdec($file,$key));

//encode json to php array
$data = json_decode($json, true);

//get array of tags
$tags = array_keys($data);

//encode array to json
$taglist =  json_encode($tags);

//output
echo $taglist;

?>

