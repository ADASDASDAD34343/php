<?php

//CREATE JSON DATABASE
header("Content-Type: application/json");

//bring in encryption function
require 'encdec.php';

//test parameters
if (!isset($_REQUEST['key'])) {  die("No pin present"); }
$key = trim($_REQUEST['key']);

//create unique db filename
$file = tempnam('.', 'db_');
$newdb = $file.".json";
unlink($file);

//encrypt brackets
$data = encdec(base64_encode("{}"),$key);

//set brackets to db file
file_put_contents($newdb,$data);

//output
$result = array("CREATED",basename($newdb));
echo json_encode($result);

?>
