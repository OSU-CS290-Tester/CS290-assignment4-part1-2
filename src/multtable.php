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
  <title>Multiplication Table</title>
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

// Function to get, check and set variables
// Variables passed by reference
function setVariable(&$variable, &$name){
  if(isset($_GET[$name])){
    if(null !== ($_GET[$name] = filter_input(INPUT_GET, $name, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE))){
      $variable = (int)$_GET[$name];
      // echo $variable;
    }
    else{
      echo "ERROR: " . $name . " must be an integer.";
      exit();
    }
  }
  else{
    echo "ERROR: " . $name . " parameter is missing";
    exit();
  }
}

// Function to build the tables
// Variables passed by reference
function buildTable(&$a, &$b, &$c, &$d){
  $columns = $d - $c + 2; //width
  $rows = $b - $a + 2; //height
  echo "<p><h3>Multiplication Table</h3>";
  echo '<table border="1">';
  echo "<tr><th>";
  // Build Header Row
  for($i = 0; $i < $columns - 1; $i++){
    echo '<th>' . ($c + $i) . '</th>';
  }
  echo '</tr>';
  // Build the Remaining Rows
  for($j = 0; $j < $rows - 1; $j++){
    for($k = 0; $k < $columns; $k++){
      if($k == 0){
        // Build Header for 1st item in row, min-multiplicand + row index $j
        echo '<th>' . ($a + $j) . '</th>';
      }
      else {
        //else min-multiplicand + row index * min-multiplier + col index $k - 1
        echo '<td>' . (($a + $j) * ($c + $k - 1)) . '</td>';
      }
    }
    echo '</tr>';
  }
  echo "</table>";
}

// Declaring Variables for Function calls
$minMultiplicand = null;
$minMultiplicand_name = 'min-multiplicand';
$maxMultiplicand = null;
$maxMultiplicand_name = 'max-multiplicand';

$minMultiplier = null;
$minMultiplier_name = 'min-multiplier';
$maxMultiplier = null;
$maxMultiplier_name = 'max-multiplier';

// Call Functions to get Variable Values
setVariable($minMultiplicand, $minMultiplicand_name);
setVariable($maxMultiplicand, $maxMultiplicand_name);
setVariable($minMultiplier, $minMultiplier_name);
setVariable($maxMultiplier, $maxMultiplier_name);

// Check the Min and Maxs Values agree
if($minMultiplicand > $maxMultiplicand) {
  echo "<p>ERROR: Minimum Multiplicand is greater than Maximum.";
}
elseif($minMultiplier > $maxMultiplier) {
  echo "<p>ERROR: Minimum Multiplier is greater than Maximum.";
}
else {
  buildTable($minMultiplicand, $maxMultiplicand, $minMultiplier, $maxMultiplier);
}
//?min-multiplicand=1&max-multiplicand=12&min-multiplier=1&max-multiplier=12
?>
  </body>
</html>
