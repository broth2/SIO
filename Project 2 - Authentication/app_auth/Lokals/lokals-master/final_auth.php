<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);

if(isset($_SESSION['loggedin'])){
  header("Location:hosts_ap.php");
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_GET['user'];
    
    $query  ="SELECT * FROM `users` WHERE  `email` LIKE '$name' ";

    $result = mysqli_query($con,$query);

    if(mysqli_num_rows($result)>0 ){
        $current_user = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true;
        $_SESSION["userId"] = $current_user['userId'];
        $_SESSION["username_"] = $current_user['email'];
        $_SESSION["name"]= $current_user['name_'];
        echo "<script> location.replace('index.php'); </script>";
    }else{
        echo "Bad credentials";
      }


}


?>