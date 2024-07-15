<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);

if($_SERVER["REQUEST_METHOD"] == "POST" ) {
  $password =$_POST["password"];
  // Validate password strength
  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number    = preg_match('@[0-9]@', $password);
  if(!$uppercase || !$lowercase || !$number  || strlen($password) < 8) {
      echo 'Password should be at least 8 characters in length and should include at least one upper case letter and one number.';
  }else{
      echo 'Strong password.';
      $pass_nosql =mysqli_real_escape_string($con,md5($_POST["password"]));
      $pass = htmlspecialchars($pass_nosql); 

  

    #No sql injection
    $nome_nosql =mysqli_real_escape_string($con,$_POST["username"]);
    $mail_nosql =mysqli_real_escape_string($con,$_POST["email"]);
    $cell_nosql =mysqli_real_escape_string($con,$_POST["cellphone"]);
    $loca_nosql =mysqli_real_escape_string($con,$_POST["country"]);
    $region_nosql =mysqli_real_escape_string($con,$_POST["localizacao"]);
    $cidade_nosql =mysqli_real_escape_string($con,$_POST["cidade"]);
    $postal_nosql =mysqli_real_escape_string($con,$_POST["postal"]);
    $acomodacao_nosql =mysqli_real_escape_string($con,$_POST["acomodacao"]);
    $preco_nosql =mysqli_real_escape_string($con,$_POST["preco"]);
    $message_nosql =mysqli_real_escape_string($con,$_POST["message"]);

    #no xss
    $nome = htmlspecialchars($nome_nosql); 
    $mail = htmlspecialchars($mail_nosql); 
    $cell = htmlspecialchars($cell_nosql); 
    $hst = 0;
    $loca = htmlspecialchars($loca_nosql); 
    $region = htmlspecialchars($region_nosql); 
    $cidade = htmlspecialchars($cidade_nosql); 
    $postal = htmlspecialchars($postal_nosql); 
    $acomodacao = htmlspecialchars($acomodacao_nosql); 
    $preco = htmlspecialchars($preco_nosql); 
    $message = htmlspecialchars($message_nosql); 
    

    if (!empty($nome)){
      if(!empty($region)){
        $hst=1;
      }
      $sql = "INSERT INTO users ( password_, email, name_, cellphone, country, host) VALUES ('$pass', '$mail', '$nome', '$cell', '$loca', 0)";


      if (mysqli_query($con, $sql)) {
        echo "New record created successfully<br>";
        $latest = "SELECT * FROM users ORDER BY userId DESC LIMIT 1";
        $result = mysqli_query($con, $latest);
        $row=mysqli_fetch_assoc($result);

        $_SESSION['loggedin'] = true;
        $_SESSION["userId"] = $row['userId'];
        $_SESSION["username_"] = $mail;
        $_SESSION["name"]= $nome;

        echo "<script> location.replace('index.php'); </script>";


      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        $region = "";
      }

      // if(!empty($region)){
      //   $sql2 = "INSERT INTO `apartments` (`hostID`,`neighbourhood_cleansed`, `city`, `zipcode`, `accommodates`, `price_per_night`, `description_`, `image_`) VALUES ('$row[userId]','$region', '$cidade', '$postal', '$acomodacao', '$preco', '$message', NULL);";


      //   if (mysqli_query($con, $sql2)) {
      //     echo "New record created successfully2<br>";
      //   } else {
      //     echo "Error: " . $sql2 . "<br>" . mysqli_error($con);
      //   }



      // }

    }

  }
}
  
mysqli_close($con);

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
                <?php
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo "
                    <li class=\"nav-item col-lg-3\">
                      <a class=\"nav-link\"  href=\"hosts_ap.php\" name= \"hostsAp\" style=\"color: white;\"> Os meus alojamentos</a>
                    </li>
                   
                     <li class=\"nav-item col-lg-3 \" style=\"position: absolute top:0 right:0\">
                  <div class= \"box \" name= \"logoutbtn\" onclick=\"location.href='logout.php'\">
                    <a class=\"nav-link\" name= \"logoutbtn\" style=\"color: white;\" href=\"logout.php\"> Log out</a>
                  </div>";
                  }
                  else{
                    echo"
                    <li class=\"nav-item col-lg-3\">
                      <a class=\"nav-link\" href=\"candidatura.php\">Junte-se a nós</a>
                    </li>
                    <li class=\"nav-item col-lg-8 \" style=\"position: absolute top:0 right:0\">
                    <div class= \"box \" onclick=\"location.href='http://127.0.0.1:5000/access?link=170.2.0.4:5001/server_auth'\">
                      <a class=\"nav-link\" style=\"color: white;\" href=\"http://127.0.0.1:5000/access?link=170.2.0.4:5001/server_auth\"> Login</a>
                    </div>";
                  }
                  ?>
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
            <h1 class="text-white">Registe-se</h1>
          </div>
        </div>
      </div>
    </div>

  
    
    <div class="site-section border-bottom">
      <div class="container">
        <div class="row">
    
          <div class="col-md-12 col-lg-7 mb-5">
    
            <form action="#" class="contact-form" method="POST">
              
              <div class="row form-group">
                <div class="col-md-12 mb-3 mb-md-0">
                  <h5 class="font-weight-bold">Dados pessoais</h5>
                </div>
              </div>



              <div class="wrapper">
                <!--<form action="" method="POST">-->
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="username" class="form-control" placeholder="Nome">
                        <span class="invalid-feedback"></span>
                    </div>    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="row form-group">
                      <div class="form-group col-md-12">
                        <label class="font-weight-bold" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                      </div>
                    </div>
                  
                    <div class="row form-group">
                      <div class="col-md-12">
                        <label class="font-weight-bold" for="telemovel" style="width: 100%;">Telemóvel</label>
                        <select class="form-control form-control-sm" name="country" style="width: 30%; float: left;">
                          <option>País</option>
                          <option value="África do Sul">África do Sul</option>
                          <option value="Albânia">Albânia</option>
                          <option value="Alemanha">Alemanha</option>
                          <option value="Andorra">Andorra</option>
                        </select>
                        <input type="text" id="telemovel" name="cellphone" class="form-control" placeholder="Número" style="width: 70%; float: left;">
                      </div>
                    </div>

                    <?php

                        if($_SERVER["REQUEST_METHOD"] == "POST" ) {
                          $nome = $_POST["username"];
                          $pass = $_POST["password"];
                          $mail = $_POST["email"];
                          $loca = $_POST["country"];
                          $cell = $_POST["cellphone"];

                          $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i"; // regex for email confirmation

                          if (isset($_POST['confirmar'])) {
                            if ((empty($nome) or empty($pass) or empty($mail) or empty($loca) or empty($cell))) {
                              $error = "Preencha todos os campos para se registar!";
                              echo "<script type='text/javascript'>alert('$error');</script>";
                            }
                            elseif (!preg_match("/^[a-zA-Z ]*$/", $nome)) {
                              $error = "Nome inválido!";
                              echo "<script type='text/javascript'>alert('$error');</script>";
                            }
                            elseif (!preg_match($regex, $mail)) {
                              $error = "Insira um e-mail válido!";
                              echo "<script type='text/javascript'>alert('$error');</script>";
                            }
                            elseif (!preg_match("/^\d+$/", $cell)) {
                              $error = "Número de telemóvel inválido!";
                              echo "<script type='text/javascript'>alert('$error');</script>";
                            }
                          }
                        }
                    ?>
              
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="Submit" name="confirmar">
                      </div>
                    </div>

          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Candidatura Submetida. Deverá receber resposta nos próximos três dias</h4>
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
  </script>
  </body>
</html>

</body>
  