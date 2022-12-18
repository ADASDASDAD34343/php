<?php

//EMPTY JSON DATABASE
header("Content-Type: application/json");
require 'encdec.php';
if (!isset($_REQUEST['key'])  || !isset($_REQUEST['userdb'])) {  die("No pin or userdb present"); }
$key = trim($_REQUEST['key']);
$userdb = trim($_REQUEST['userdb']);

//get encrypted db contents
$file = file_get_contents($userdb);

//decrypt db contents to json
$json = base64_decode(encdec($file,$key));

//clear db with new encrypted brackets
$data = encdec(base64_encode("{}"),$key);

//set data to db
file_put_contents($userdb,$data);

//output (inc. old data)
$result = array("EMPTIED",$json);
echo json_encode($result);


?>
