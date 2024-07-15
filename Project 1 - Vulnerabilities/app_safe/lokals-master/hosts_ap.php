<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);

echo $_SESSION['loggedin'];

if(!isset($_SESSION['loggedin'])){
  header("Location:missing_auth.php");
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
              <li class="nav-item col-lg-2 active">
                <a class="nav-link" href="about.php">Acerca</a>
              </li>
              <li class="col-lg-3 nav-item  ">
                <a class="nav-link" href="apartments.php">Alojamentos</a>
              </li>
              <li class="nav-item col-lg-2">
              </li>
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                  echo "<li class=\"nav-item col-lg-8 \" style=\"position: absolute top:0 right:0\">
                    <div class= \"box \" onclick=\"location.href='logout.php'\">
                      <a class=\"nav-link\" style=\"color: white;\" href=\"logout.php\"> Logout</a>
                    </div>";
                  }else {
                    echo "
                    
                    <li class=\"nav-item col-lg-3\">
                      <a class=\"nav-link\" href=\"candidatura.php\">Junte-se a nós</a>
                    </li>
                    <li class=\"nav-item col-lg-8 \" style=\"position: absolute top:0 right:0\">
                    <div class= \"box \" onclick=\"location.href='login.php'\">
                      <a class=\"nav-link\" style=\"color: white;\" href=\"login.php\"> Login</a>
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
        <?php
            echo"
            <h1 class=\"text-white\"> Os seus alojamentos, ".$_SESSION["name"]."</h1>
            ";
            ?>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
        <?php
          $sql = "SELECT ap_id, city, hostID, city neighbourhood_cleansed,  image_, price_per_night, accommodates FROM apartments WHERE hostID='".$_SESSION["userId"]."'";          
          $result = $con->query($sql);   

          if (empty($result)){

            echo"
            <h5> Ainda não registou nenhum alojamento! Faça na página \"Junte-se a nós\"! </h5>
            ";

          }else {   
            while($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class=\"col-md-12 col-lg-12 mb-5\">
                  <a href=\"apartment-detail.php?Ap=".$row["ap_id"]."\" class=\"unit-9\">
                  <div class=\"image\" style=\"background-image: url('".$row["image_"]."');\"></div>

                  <div class=\"unit-9-content\">
                      <h2 class=\"apartamento porto 4\" id=\"30/7/2020\">Alojamento - ".$row["city"]." </h2>
                      <h3 id=\"35\" class=\"nome-apartamento apartamento porto 4\">".$row["neighbourhood_cleansed"]."</h3>
                      <i class=\"fa fa-wifi\" aria-hidden=\"true\"></i></i>+
                      <i class=\"fa fa-phone\" aria-hidden=\"true\"></i>
                      <p class=\"n-pessoas\">".$row["accommodates"]." pessoas</p>
                      <p>A partir de:</p>
                      <p class=\"preco-por-noite\">".$row["price_per_night"]."/noite</p>
                  </div>
                  </a>
              </div> ";

            }                                                                                                        
          }
          ?>
        
        </div>
        <div class="col-lg-6">
          <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
          
        </div>
        </div>
      </div>
    </div>
  </div>

    
    
  
        
  
        <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
  
  
            <div class="text">
  
             
                <a href="#" class="text-white p-2"><span class="icon-facebook"></span></a>
                <a href="#" class="text-white p-2"><span class="icon-twitter"></span></a>
                <a href="#" class="text-white p-2"><span class="icon-linkedin"></span></a>
              </p>
            </div>
  
          </div>
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
  <!--<script src="js/jquery-migrate-3.0.1.min.js"></script>-->
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!--<script src="js/owl.carousel.min.js"></script>-->
  <!--<script src="js/mediaelement-and-player.min.js"></script>-->
  <!--<script src="js/jquery.stellar.min.js"></script>-->
  <!--<script src="js/jquery.countdown.min.js"></script>-->
  <!--<script src="js/jquery.magnific-popup.min.js"></script>-->

  <script src="js/main.js"></script>
  </body>
</html>
