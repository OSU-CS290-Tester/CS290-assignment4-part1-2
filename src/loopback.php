<!DOCTYPE html>
<!--
Micheal Willard
Oregon State University
CS 290-400
Winter 2015
Assignment 4 Part 1
-->
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Loopback</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

// Function to Return Input
function getInput(&$type){
  if($_SERVER['REQUEST_METHOD'] === 'GET'){
    // echo 'GET';
    $type = 'GET';
    return $_GET;
  }
  elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    // echo 'POST';
    $type = 'GET';
    return $_POST;
  }
}

// Function to build the object
function buildObject(&$type, &$input){
  if($input === null){
    // No Parameters (key/value pairs) Passed in
    $input = array('Type' => $type, 'parameters' => 'null');
    return $input;
  }
  else{
    // Check for null parameters
    foreach($input as $key => $value){
      if($value === null){
        $input[$key] = null;
      }
    }
    $input = array('Type' => $type, 'parameters' => $input);
    return $input;
  }
}

//***** Main Code Section *****
$inputType = null;
$inputParams = getInput($inputType);
$inputParams = buildObject($inputType, $inputParams);
$jsonObj = json_encode($inputParams);
echo $jsonObj . "<br>";
?>
  </body>
</html>
