<?php
// Create connection
$DBUSER = 'user';
$DBPASS = 'user';

$con=mysqli_connect('db',$DBUSER,$DBPASS,'Lokals');

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "<font style=\"color:#FF0000\">Could not connect:". mysqli_connect_error()."</font\>";
  }
?>