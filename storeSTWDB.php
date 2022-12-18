<?php

// All values MUST be stored as json arrays, even single texts/strings e.g.
// ["value"]  or ["value1","value2","value3"] for a list


header("Content-Type: application/json");

//bring in encryption function
require 'encdec.php';

//test for parameters
if (!isset($_REQUEST['tag']) || !isset($_REQUEST['value']) || !isset($_REQUEST['key']) || !isset($_REQUEST['userdb'])) { die("No tag, value, pin or userdb present"); }
$tag = $_REQUEST['tag'];
$value = trim($_REQUEST['value']);
$key = trim($_REQUEST['key']);
$userdb = trim($_REQUEST['userdb']);

//get encrypted db contents
$file = file_get_contents($userdb);

//decrypt db contents
$json = base64_decode(encdec($file,$key));

//decode json to php array
$parsedData = json_decode($json, true);

//add or update tag and value, decoding value to make a json array
$parsedData[$tag] = json_decode($value);

//encode array to json
$final = json_encode($parsedData);

//encrypt json
$newData = encdec(base64_encode($final),$key);

//set encrypted content to db
file_put_contents($userdb, $newData);

//output
$result = array("STORED", $tag, $value);
echo json_encode($result);

?>
