<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();

//***** File Path Variables *****
$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
$filePath = implode('/', $filePath);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
$redirectLogin = $redirect . '/login.php';
$redirectLogout = $redirectLogin . '?loggedOut=true';
$redirectContent2 = $redirect . '/content2.php';

//***** Text Display Variables *****
$displayText = "";
$sessionNotActiveText = "<p>ERROR: You didn't enter a Username.
<p>Please click <a href=\"$redirectLogout\">here</a> to return to the login page.";

//***** Main Body Code *****
// Approach adapted from O'Reilly PHP and MySQL Ch. 10-11.
// Check for user name on first visit.

if(isset($_POST['username'])){
  // If username is empty redirect to login.
  if($_POST['username'] === "" || $_POST['username'] === null){
    $displayText =  $sessionNotActiveText;
    $_SESSION['sessionActive'] = false;
    // echo "baldwin";
  }
  //Else a Username was entered.
  else{
    // Confirm $_SESSION[username] not set
    if(!isset($_SESSION['name'])){
      $_SESSION['name'] = $_POST['username'];
      $_SESSION['sessionActive'] = true;
      $_SESSION['visits'] = 0;
      $displayText =  "<p>Hi $_SESSION[name], you have visited this page
      $_SESSION[visits] times.<p>Click <a href=\"$redirectLogout\">here</a>
      to logout.
      <p>Click <a href=\"$redirectContent2\">here</a> to visit Content 2.";
      // echo "sherman";
      $_SESSION['visits']++;
    }
  }
}

// Check if user is already logged in.
if(isset($_SESSION['name'])){
  if(isset($_POST['username'])){
    if($_SESSION['name'] != $_POST['username']){
      $_SESSION['name'] = $_POST['username'];
      $_SESSION['sessionActive'] = 'true';
      $_SESSION['visits'] = 0;
      $displayText =  "<p>Hi $_SESSION[name], you have visited this page
      $_SESSION[visits] times.<p>Click <a href=\"$redirectLogout\">here</a>
      to logout.
      <p>Click <a href=\"$redirectContent2\">here</a> to visit Content 2.";
      // echo "wilson";
      $_SESSION['visits']++;
    }
    else{
      $displayText =  "<p>Hi $_SESSION[name], you have visited this page
      $_SESSION[visits] times.<p>Click <a href=\"$redirectLogout\">here</a>
      to logout.
      <p>Click <a href=\"$redirectContent2\">here</a> to visit Content 2.";
      // echo "lynch";
      $_SESSION['visits']++;
    }
  }
  else{
    $displayText =  "<p>Hi $_SESSION[name], you have visited this page
    $_SESSION[visits] times.<p>Click <a href=\"$redirectLogout\">here</a>
    to logout.
    <p>Click <a href=\"$redirectContent2\">here</a> to visit Content 2.";
    // echo "thomas";
    $_SESSION['visits']++;
  }
}
// Redirect final condition for sessionActive not set
if(!isset($_SESSION['sessionActive'])){
  header("Location: {$redirect}/login.php");
  // echo "wagner";
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
  <title>Content 1 Page</title>
</head>
<body>
  <?php echo $displayText; ?>
</body
</html>
