<?php
 session_start();
 session_destroy();
 echo "<script> location.replace('index.php'); </script>";
 unset($_SESSION['userId']);
     unset($_SESSION['name']);
                      unset($_SESSION['loggedin']);
                      unset($_SESSION['username_']);
                      $_SESSION['loggedin'] = false;
?>
