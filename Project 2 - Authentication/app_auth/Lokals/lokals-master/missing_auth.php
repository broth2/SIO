<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ERRO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Oswald:400,700"> 
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
    <h1 style="color:red">ERROR: missing auth</h1>

    <a href="/login.php" style="text-align:center; color:blue; padding-left:40px;">LOGIN NECESSARIO</a>
    <a style="text-align:center; color:black; padding-left:40px;"><br>nao tem autorizacao para aceder aquela pagina</a>
</body>
</html>