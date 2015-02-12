<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();

//***** File Path Variables *****
$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
$filePath = implode('/', $filePath);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
$redirectLogin = $redirect . '/login.php';
$redirectContent1 = $redirect . '/content1.php';

if(!isset($_SESSION['sessionActive'])){
  header("Location: {$redirectLogin}");
}
else{
  $displayText = "<p>Click <a href=\"$redirectContent1\">here</a> to visit Content 1.";
}
?>

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
  <title>Content 2 Page</title>
</head>
<body>
  <p>Content 1 page main body.  This page is only accessible if you are logged in ... hopefully.</p>
  <?php echo $displayText; ?>
</body
</html>
