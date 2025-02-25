<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);
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
              <li class="nav-item col-lg-5 active">
                <a class="nav-link" href="index.php">Início</a>
              </li>
              <li class="nav-item col-lg-2">
                <a class="nav-link" href="about.php">Acerca</a>
              </li>
              <li class="col-lg-3 nav-item  ">
                <a class="nav-link" href="apartments.php">Alojamentos</a>
              </li>
              <li class="nav-item col-lg-3">
                <?php
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo "
                    <li class=\"nav-item col-lg-3\">
                      <a class=\"nav-link\"  href=\"hosts_ap.php\" name= \"hostsAp\" style=\"color: white;\"> Os meus alojamentos</a>
                    </li>
                    <li class=\"nav-item col-lg-3\">
                      <a class=\"nav-link\" href=\"candidatura.php\">Junte-se a nós</a>
                    </li>
                     <li class=\"nav-item col-lg-3 \" style=\"position: absolute top:0 right:0\">
                  <div class= \"box \" name= \"logoutbtn\" onclick=\"location.href='logout.php'\">
                    <a class=\"nav-link\" name= \"logoutbtn\" style=\"color: white;\" href=\"logout.php\"> Log out</a>
                  </div>";
                  }
                  else{
                    echo"
                    
                    <li class=\"nav-item col-lg-8 \" style=\"position: absolute top:0 right:0\">
                    <div class= \"box \" onclick=\"location.href='login.php'\">
                      <a class=\"nav-link\" style=\"color: white;\" href=\"login.php\"> Login</a>
                    </div>";
                  }
                  ?>
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
    
    <div class="site-blocks-cover overlay" style="background-image: url('images/hero_bg_2.jpg');">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-8 text-center">
            <h1 class="mb-4" style="font-size: 80px;">Lokals</h1>
          </div>
        </div>
      </div>
    </div>


    <div class="container" style="padding-bottom: 100px;">
      <div class="featured-property-half d-flex">
        <div class="image" style="background-image: url('images/hero_bg_1.jpg')"></div>
        <div class="text" style="text-align: center;">
        <?php
          if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

          echo "        
          <h2>Encontre o melhor alojamento local para si, ".$_SESSION["name"]."</h2>
          ";
          }else{
            echo "        
            <h2>Encontre o melhor alojamento local para si</h2>
            ";
          }
          ?>
          <p class="mb-5" style="padding-top: 30px;">
            Junte-se a milhares de utilizadores que usam a plataforma nº1 de procura e reserva de alojamentos locais em território nacional 
          </p>
          <p><a href="#" class="btn btn-primary px-4 py-3">Saiba Mais</a></p>
        </div>
      </div>
    </div>

    <hr style="height:2px; width: 30%; border-width:0;color:gray;background-color:gray">

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
            <h2 class="mb-5">Os nossos Serviços</h2>
            <p>
              Esta plataforma tem como propósito ajudar o utilizador a encontrar o alojamento local ideal consoante as suas preferências.
              Para isso, a Lokals reúne uma série de características que tornam tudo isto possível...
            </p>
          </div>
        </div>
        
        <div class="row" style="border: 1px solid #ced4da; border-radius: 0.2rem;">
          <div class="col-md-5" style="text-align: center; padding-top: 75px; height: 400px;">
            <h2 class="mb-5">Pesquisa eficiente</h2>
            <p style="border: 1px solid #ced4da; height: 100%; width: 100%; border-width: 1px 0px 0px 0px; padding-top: 20px;">
              O método de pesquisa da Lokals apresenta uma grande variedade de filtros que permitem ao utilizador escolher
              o alojamento mais adequado consoante as propriedades selecionadas!
            </p>
          </div>
          <div class="col-md-7" style="background-image: url('images/img_1.jpg'); background-position: center; height: 400px;"></div>
        </div>

        <div class="row" style="border: 1px solid #ced4da; border-radius: 0.2rem;">
          <div class="col-md-5" style="background-image: url('images/img_2.jpg'); background-position: center; height: 400px;"></div>
          <div class="col-md-7" style="text-align: center; padding-top: 100px; height: 400px;">
            <h2 class="mb-5">Seleção premium de alojamentos</h2>
            <p style="border: 1px solid #ced4da; height: 100%; width: 100%; border-width: 1px 0px 0px 0px; padding-top: 20px;">
              A nossa pataforma possui parcerias com centenas de alojamentos locais espalhados por todo o território português.
              Assim, o utilizador tem ao seu dispor uma seleção de habitações disponíveis para reserva. Tudo à distância de um clique!
            </p>
          </div>
        </div>

        <div class="row" style="border: 1px solid #ced4da; border-radius: 0.2rem;">
          <div class="col-md-5" style="text-align: center; padding-top: 100px; height: 400px;">
            <h2 class="mb-5">Staff ativa</h2>
            <p style="border: 1px solid #ced4da; height: 100%; width: 100%; border-width: 1px 0px 0px 0px; padding-top: 20px;">
              Apresentamos uma equipa de profissionais dispostos a ajudar o cliente sempre que surgir algum problema ou dúvida.
              Tudo para tornar a sua experiência na plataforma mais simples e segura.
            </p>
          </div>
          <div class="col-md-7" style="height: 400px;">
            <div class="row" style="text-align: center; ">
              <div class="col-md-3" style="height: 400px; ">
                <img src="images/person_1.jpg" alt="Pessoa 1" style="height: auto; width: 100%; padding-top: 80px;">
                <p style="padding-top: 30px;">Rita Silva</p>
              </div>
              <div class="col-md-3" style="height: 400px; ">
                <img src="images/person_2.jpg" alt="Pessoa 2" style="height: auto; width: 100%; padding-top: 80px;">
                <p style="padding-top: 30px;">Maria Almeida</p>
              </div>
              <div class="col-md-3" style="height: 400px; ">
                <img src="images/person_3.jpg" alt="Pessoa 3" style="height: auto; width: 100%; padding-top: 80px;">
                <p style="padding-top: 30px;">André Moniz</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <hr style="height:2px; width: 30%; border-width:0;color:gray;background-color:gray">
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
            <h2>Alojamento</h2>
          </div>
        </div>
        
        <div class="row" style="height: 220px; text-align: center; border: 1px solid #ced4da; border-radius: 0.2rem;">
          <div class="col-md-12">
            <p style="padding-top: 40px; padding-bottom: 30px;">Procure agora o alojamento local que deseja!</p>
            <p><a href="apartments.php" class="btn btn-primary px-4 py-3">Procurar alojamentos</a></p>
          </div>
        </div>


        <div class="row">
          <div class="site-section-heading text-center mb-5 w-border col-md-6 mx-auto">
            <h2 style="padding-top: 100px;">Candidatura</h2>
          </div>
        </div>
        
        <div class="row" style="height: 220px; text-align: center; border: 1px solid #ced4da; border-radius: 0.2rem;">
          <div class="col-md-12">
            <p style="padding-top: 40px; padding-bottom: 30px;">Deseja expor o seu alojamento no site? Candidate-se agora!</p>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
              echo "
              <p><a href=\"candidatura.php\" class=\"btn btn-primary px-4 py-3\">Candidate-se já</a></p>

              ";

              }else
              echo"
              <p><a href=\"login.php\" class=\"btn btn-primary px-4 py-3\">Dê login primeiro</a></p>

              
              ";
            ?>
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
  </body>
</html>
