<?php
// Create connection
$DBUSER = 'user';
$DBPASS = 'user';

$con=mysqli_connect('db',$DBUSER,$DBPASS,'Lokals');

$_SESSION["comm_key"] = "938365b28a1f033d86a82cae22acf06b";
$vasgorda="4937e3e7abd5fdbb0783cbdc6e4bd6d3";
// Check connection
if (mysqli_connect_errno($con))
  {
  echo "<font style=\"color:#FF0000\">Could not connect:". mysqli_connect_error()."</font\>";
  }
?>