<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);



if(!isset($_SESSION['loggedin'])){
   header("Location:missing_auth.php");
}else{
  $usrmail = $_SESSION["username_"];
  $query  ="SELECT * FROM `users` WHERE `email` LIKE '$usrmail' ";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result)!=1){
    header("Location:missing_auth.php");
  }
}


// #No sql injection
// $nome_nosql =mysqli_real_escape_string($con,$_POST["username"]);
// $mail_nosql =mysqli_real_escape_string($con,$_POST["email"]);
// $pass_nosql =mysqli_real_escape_string($con,$_POST["password"]);
// $cell_nosql =mysqli_real_escape_string($con,$_POST["cellphone"]);
// $loca_nosql =mysqli_real_escape_string($con,$_POST["country"]);
// $region_nosql =mysqli_real_escape_string($con,$_POST["localizacao"]);
// $cidade_nosql =mysqli_real_escape_string($con,$_POST["cidade"]);
// $postal_nosql =mysqli_real_escape_string($con,$_POST["postal"]);
// $acomodacao_nosql =mysqli_real_escape_string($con,$_POST["acomodacao"]);
// $preco_nosql =mysqli_real_escape_string($con,$_POST["preco"]);
// $message_nosql =mysqli_real_escape_string($con,$_POST["message"]);

 

if($_SERVER["REQUEST_METHOD"] == "POST" ) {
  $local = mysqli_real_escape_string($con,trim($_POST["localizacao"]));
  $city = mysqli_real_escape_string($con,trim($_POST["cidade"]));
  $zip = mysqli_real_escape_string($con,trim($_POST["postal"]));
  $n_rooms = mysqli_real_escape_string($con,trim($_POST["acomodacao"]));
  $price = mysqli_real_escape_string($con,trim($_POST["preco"]));
  $description = mysqli_real_escape_string($con,trim($_POST["message"]));
  
  if (empty($local) or empty($city) or empty($zip) or empty($n_rooms) or empty($price) or empty($description)) {
    $error = "Preencha todos os campos!";
    echo "<script type='text/javascript'>alert('$error');</script>";
  }
  elseif (!preg_match("/^[a-zA-Z ]*$/", $local)) {
    $error = "Insira uma localidade válida!";
    echo "<script type='text/javascript'>alert('$error');</script>";
  }
  elseif (!preg_match("/^[a-zA-Z ]*$/", $city)) {
    $error = "Insira uma cidade válida!";
    echo "<script type='text/javascript'>alert('$error');</script>";
  }
  elseif (!preg_match("/^\d+$/", $zip) or strlen($zip) != 4) {
    $error = "Insira um código postal válido!";
    echo "<script type='text/javascript'>alert('$error');</script>";
  }
  elseif (!preg_match("/^\d+$/", $n_rooms) or strlen($n_rooms) < 1) {
    $error = "Insira um número de quartos válido!";
    echo "<script type='text/javascript'>alert('$error');</script>";
  }
  elseif (!preg_match("/^\d+$/", $price) or strlen($price) > 5) {
    $error = "Insira um preço válido!";
    echo "<script type='text/javascript'>alert('$error');</script>";
  }
  else{
    $curr_usr = $_SESSION["userId"];
    $sql2 = "INSERT INTO `apartments` (`hostID`,`neighbourhood_cleansed`, `city`, `zipcode`, `accommodates`, `price_per_night`, `description_`, `image_`) VALUES ('$curr_usr','$local', '$city', '$zip', '$n_rooms', '$price', '$description', NULL);";


    if (mysqli_query($con, $sql2)) {
      echo "New apartment created successfully<br>";
    } else {
      echo "Error: " . $sql2 . "<br>" . mysqli_error($con);
    }
  }
  
}




// if(!empty($region)){
//   $sql2 = "INSERT INTO `apartments` (`hostID`,`neighbourhood_cleansed`, `city`, `zipcode`, `accommodates`, `price_per_night`, `description_`, `image_`) VALUES ('$_SESSION["userId"]','$region', '$cidade', '$postal', '$acomodacao', '$preco', '$message', NULL);";


//   if (mysqli_query($con, $sql2)) {
//     echo "New record created successfully2<br>";
//   } else {
//     echo "Error: " . $sql2 . "<br>" . mysqli_error($con);
//   }



// }

  


  
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
          <h1 class="text-white">Junte-se a nós</h1>
        </div>
      </div>
    </div>
  </div>

  
    
    <div class="site-section border-bottom">
    <div class="container">
      <div class="row">
  
        <div class="col-md-12 col-lg-7 mb-5">
  
        <form action=""  method="POST" class="contact-form">
            
            <div class="wrapper">

            <div class="row form-group">
              <div class="col-md-12">
                <h5 class="font-weight-bold">Dados do alojamento</h5>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="localizacao">Localização</label>
                <input type="text" name="localizacao" id="localizacao" class="form-control" placeholder="Localização">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="localizacao">Cidade</label>
                <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Cidade">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="localizacao" style="width: 100%;">Código-postal</label>
                <input type="text" name="postal" id="localizacao" class="form-control" style="width: 20%; float: left;">
                <p style="float: left; padding: 9px 10px 0px 10px;">-</p>
                <input type="text" id="localizacao" class="form-control" style="width: 10%; float: left;">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="quartos">Número de quartos</label>
                <input type="number" name="acomodacao" id="quartos" class="form-control" placeholder="Número de quartos">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="quartos">Preço por noite</label>
                <input type="number" name="preco" id="preco" class="form-control" placeholder="Preço">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="message">Descrição geral</label>
                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Descrição"></textarea>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" style="width: 100%;">Selecione as amenidades do alojamento</label>
                <button onclick="highg.call(this)" class="icon btn btn-custom btn-sm" type="button"><i  class ="fa fa-wifi pr-2 " style="font-size:28px; margin-left: 7px"></i></button> 
                <button  onclick="highg.call(this)" class="btn btn-custom btn-sm icon" type="button" ><i  class="fa fa-shower pr-2  " style="font-size:28px; margin-left: 7px"></i></button> 
                <button  onclick="highg.call(this)" class="icon btn btn-custom btn-sm" type="button"><i  class="fa fa-tv pr-2 " style="font-size:28px; margin-left: 7px"></i></button> 
                <button  onclick="highg.call(this)" class="icon btn btn-custom btn-sm" type="button"><i   class="fa fa-phone pr-2 "  style="font-size:28px; margin-left: 7px"></i></button> 
                <button onclick="highg.call(this)"  class="icon btn btn-custom btn-sm" type="button"><i   class="fa fa-snowflake-o pr-2 " style="font-size:28px; margin-left: 7px" ></i></button>
              </div>
            </div>
  
            <div class="row form-group">
              <div style="padding-top: 50px; text-align: center;" class="pl-6 col-12">
                <!--button data-toggle="modal" data-target="#myModal" type="submit" class="btn btn-primary" style="height: 60px; width:300px;">Submeter Candidatura</button><-->
              </div>
            </div>
            <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Submit" name="confirmar">
            </div>
          </form>
        
          <?php ?>

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
  