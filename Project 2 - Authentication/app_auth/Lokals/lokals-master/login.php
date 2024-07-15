<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);

if(isset($_SESSION['loggedin'])){
  header("Location:hosts_ap.php");
}
if(isset($_POST['btnnn'])){
  echo  '<script> 
        send_post(); 
        </script>';

  if(empty(trim($_POST["password"])) or empty(trim($_POST["fullname"]))) {
      echo 'fill all fields!';
  }else{
      #echo 'Strong password.';
      $password_nosql =mysqli_real_escape_string($con,trim($_POST["password"]));
      $password_= htmlspecialchars($password_nosql);
      $passdec = md5($password_);

      #No sql injection
      $email_nosql =mysqli_real_escape_string($con,$_POST["fullname"]);
      #no xss
      #$email_= htmlspecialchars($email_nosql); 

      $query  ="SELECT * FROM `users` WHERE `password_` LIKE '$passdec' AND `email` LIKE '$email_nosql' ";

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
}




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lokals</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Oswald:400,700"> 
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>

    
  
  <div class="site-wrap">

    <div class=" row site-navbar mt-3 col-lg-8  ">
      <div class="container py-1 ">
        <nav class="navbar  navbar-expand-lg navbar-dark">
          
        
          <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item col-lg-5">
                <a class="nav-link" href="index.php">Início</a>
              </li>
              <li class="nav-item col-lg-2">
                <a class="nav-link" href="about.php">Acerca</a>
              </li>
              <li class="col-lg-3 nav-item">
                <a class="nav-link" href="apartments.php">Alojamentos</a>
              </li>
              <li class="nav-item col-lg-2">
              </li>
              <li class="nav-item col-lg-11 active">
                  <a class="nav-link" href="candidatura.php">Junte-se a nós</a>
                </li>
          
            </ul>
          </div>
        </nav>
      </div>
    
  </div>

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('images/hero_bg_1.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-7 text-center">
          <h1 class="text-white">Login</h1>
        </div>
      </div>
    </div>
  </div>

  
    
    <div class="site-section border-bottom">
    <div class="container">
      <div class="row">
  
        <div class="col-md-12 col-lg-7 mb-5">
  
          
     <form name= " loginform" method="POST" class="contact-form" onsubmit="return checkform(this)">
            
              
            
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <h5 class="font-weight-bold">Dados login</h5>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="fullname">Email</label>
                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Email" required>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password"  required>
              </div>
             
            </div>
            <div class="row" style="justify-content: center;">
              <hr style="height:2px; width: 80%; border-width:0; color:gray; background-color:gray; margin: 50px 0px 50px 0px;">
            </div>
              <div style="padding-top: 50px; text-align: center;" class="pl-6 col-12">
               <a href="/candidatura.php" style="text-align:center">Registe-se</a>
              </div>
               <div style=" text-align: center;" class="pl-6 col-12">
                <button   id="login" type="submit" name="btnnn" class="btn btn-primary"  style="height: 60px; width:300px; ">Login</button>
               </div>
             
            
              
            
            </form>
          </div>
            
        </div>

        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Utilizador Registado! </h4>
              </div>
              <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
            </div>       
          </div>
        </div>
        
      </div>
    </div>
  </div>
    
    
    <div class="bg-primary">
      <div class="container">
        <div class="row">
          <a href="#" class="col-2 text-center py-4 social-icon d-block"><i class="fa fa-facebook" aria-hidden="true" style="color: white"></i></a>
          <a href="#" class="col-2 text-center py-4 social-icon d-block"><i class="fa fa-twitter" aria-hidden="true" style="color: white"></i></a>
          <a href="#" class="col-2 text-center py-4 social-icon d-block"><i class="fa fa-instagram" aria-hidden="true" style="color: white"></i></a>
          <a href="#" class="col-2 text-center py-4 social-icon d-block"><i class="fa fa-linkedin" aria-hidden="true" style="color: white"></i></a>
          <a href="#" class="col-2 text-center py-4 social-icon d-block"><i class="fa fa-pinterest-p" aria-hidden="true" style="color: white"></i></a>
          <a href="#" class="col-2 text-center py-4 social-icon d-block"><i class="fa fa-youtube" aria-hidden="true" style="color: white"></i></a>
        </div>
      </div>
    </div>

    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row mb-5">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navegação</h3>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="index.php">Início</a></li>
                  <li><a href="apartments.php">Alojamentos</a></li>
                  <li><a href="about.php">Acerca</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                  <li><a href="candidatura.php">Junte-se a nós</a></li>
                </ul>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Siga-nos</h3>

                <div>
                  <a href="#" class="pl-0 pr-3"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  <a href="#" class="pl-3 pr-3"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  <a href="#" class="pl-3 pr-3"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                  <a href="#" class="pl-3 pr-3"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </footer>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script src="js/main.js"></script>
  <script>
    function highg () {
      $(this).toggleClass('c');
    };

    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
    function login() {
       window.location.href="index.php";
     }
    function checkform(form) {
      // get all the inputs within the submitted form
      var inputs = form.getElementsByTagName('input');
      for (var i = 0; i < inputs.length; i++) {
          // only validate the inputs that have the required attribute
          if(inputs[i].hasAttribute("required")){
              if(inputs[i].value == ""){
                  // found an empty field that is required
                  alert("Please fill all required fields");
                  return false;
              }
          }
      }
      $('#myModal').modal('show');
      return true;
    }

    function send_post(){
      alert("hello wordl");
      // $.ajax({
      //           url: 'localhost:5000', // url where to submit the request
      //           type : "POST", // type of action POST || GET
      //           dataType : 'json', // data type
      //           data : $("#form").serialize(), // post data || get data
      //           success : function(result) {
      //               // you can see the result from the console
      //               // tab of the developer tools
      //               console.log(result);
      //               console.log("cheguei aqui3");
      //           },
      //           error: function(xhr, resp, text) {
      //               console.log(xhr, resp, text);
      //               console.log("cheguei aqui4");
      //           }
      // })
    }

    $(document).ready(function(){
        //click on button submit
        console.log("cheguei aqui1");
        $("#btnnn").on('click', function(){
          console.log("cheguei aqui2");
            // send ajax
            $.ajax({
                url: 'localhost:5000', // url where to submit the request
                type : "POST", // type of action POST || GET
                dataType : 'json', // data type
                data : $("#form").serialize(), // post data || get data
                success : function(result) {
                    // you can see the result from the console
                    // tab of the developer tools
                    console.log(result);
                    console.log("cheguei aqui3");
                },
                error: function(xhr, resp, text) {
                    console.log(xhr, resp, text);
                    console.log("cheguei aqui4");
                }
            })
        });
    });
</script>
 
  </body>
</html>
