<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();

//***** Set Up Variables ****
$filePath = explode('/', $_SERVER['PHP_SELF'], -1);
$filePath = implode('/', $filePath);
$redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
$redirectLogin = $redirect . '/login.php';
$redirectLogout = $redirectLogin . '?loggedOut=true';
$redirectContent1 = $redirect . '/content1.php';
$redirectContent2 = $redirect . '/content2.php';

$displayText = "";


//checks if 'logged' exists in URL
//and logged is true, i.e. user is logged off
if(isset($_GET['loggedOut']) && $_GET['loggedOut'] === 'true'){
  //destroy session code
  $_SESSION = array(); //empty session data array
  session_destroy(); //destroy session
  $displayText = "<p>You have succesfully logged out.";
}
if(isset($_SESSION['sessionActive']) && $_SESSION['sessionActive'] === 'true'){
  $sessionActiveText = "<p>Hi $_SESSION[name].<p>Click <a href=\"$redirectContent1\">here</a> to visit Content 1.<p> If this is not you, click <a href=\"$redirectLogout\">here</a> to logout.";
  $displayText = $sessionActiveText;
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
  <title>Login Page</title>
</head>
<body>
  <?php echo $displayText; ?>
  <form action=<?=$redirectContent1?> method="post">
    <fieldset>
      <label>Username:</label>
      <input type="text" name="username" size="30" maxlength="100">
    </fieldset>
    <br>
    <fieldset>
      <input type="submit" value="Login">
    </fieldset>
  </form>
</body>
</html>
