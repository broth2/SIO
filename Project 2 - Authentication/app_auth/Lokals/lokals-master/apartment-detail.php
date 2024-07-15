<?php
ob_start();
session_start();
include("config_db.php");
ini_set('display_errors', 1);

$usrid=$_SESSION["userId"];

#No sql injection
$comuserName_nosql =mysqli_real_escape_string($con,$_POST["Nome"]);
$comEmail_nosql =mysqli_real_escape_string($con,$_POST["Email"]);
$comCom_nosql =mysqli_real_escape_string($con,$_POST["Com"]);

#no xss
$comuserName = htmlspecialchars($comuserName_nosql); 
$comEmail = htmlspecialchars($comEmail_nosql);
$comCom = htmlspecialchars($comCom_nosql);

$sql = "SELECT users.userId AS ID FROM users WHERE 'users.username_'= '$comuserName'";
$result = $con->query($sql);
$apid= htmlspecialchars($_GET["Ap"]);
$row=mysqli_fetch_assoc($result);

if(!empty($comCom)&& ($_POST['randcheck']==$_SESSION['rand'])){
  $sql2 = "INSERT INTO review (user_id_fk,ap_id_fk, review_score,comment) VALUES ('$usrid'  ,$apid,'9','$comCom')";

  if(mysqli_query($con, $sql2)){
    echo "Records for review inserted successfully.<br>";
  } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
  }


}

//$comCom="";

//verificar se está logado no site nao vulneravel
if(mysqli_query($con, $sql)){ 
  echo "Selected successfully: $comuserName .<br>";
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

  if ($_SESSION['loggedin'] and empty($_POST["Com"])) {
  
  
    $usrid = $_SESSION["userId"]  ;
    $apid = $_GET["Ap"];
    $datestring = (isset($_POST['dateCheckIn'])) ? $_POST['dateCheckIn'] : "not";
    $date_arr = explode('/',$datestring);
    $date = date("Y-m-d", strtotime($date_arr[2].$date_arr[1].$date_arr[0]));
    $dayz = $_POST["nmr_nts"];
    $acomodates = $_POST["nmr"];



      #No sql injection
    $cardName_nosql =mysqli_real_escape_string($con,$_POST["nome"]);
    $cardNum_nosql =mysqli_real_escape_string($con,$_POST["cardnum"]);
    $expr_nosql =mysqli_real_escape_string($con,$_POST["expr"]);
    $cvv_nosql =mysqli_real_escape_string($con,$_POST["cvv"]);

    #no xss
    $cardname= htmlspecialchars($comuserName_nosql); 
    $cardnum= htmlspecialchars($cardNum_nosql);
    $expr = htmlspecialchars($expr_nosql);
    $cvv = htmlspecialchars($cvv_nosql);

    
    $sql8 = "INSERT INTO `booking` ( `fk_user_id`, `ap_id`, `booking_date`, `n_days`,  `n_people`, `name`, `card_number`, `expiry_date`, `cvv`) VALUES ('$usrid', '$apid', '$bkdate', '$dayz', '$acomodates','$cardname', '$cardnum', '$expr', '$cvv');";


    if (mysqli_query($con, $sql8)) {
        echo "New booking inserted <br>";
    } else {
        echo "Error: " . $sql8 . "<br>" . mysqli_error($con);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" href="css/style.css">
    <script>
    function clearForms()
    {
      var i;
      for (i = 0; (i < document.forms.length); i++) {
        document.forms[i].reset();
      }
    }
</script>
  </head>
  <body onload="clearForms()" onunload="clearForms()">

  
    
  
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
              <li class="col-lg-3 nav-item  active">
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
    


    <?php
          $sql3 = "SELECT ap_id, city, neighbourhood_cleansed, description_,  image_, price_per_night, accommodates FROM apartments WHERE ap_id=".$_GET["Ap"]."";
          
          $result = $con->query($sql3); //tabela que resulta do select
          
          if (mysqli_num_rows($result) > 0) { //se existe um tuplo
            while($row = mysqli_fetch_assoc($result)) {
              $pricePerNight = $row["price_per_night"];
              
                echo "          
                <div class=\"site-blocks-cover inner-page-cover overlay\" style=\"background-image: url('images/hero_bg_1.jpg');\">
                <div class=\"container\">
                  <div class=\"row align-items-center justify-content-center\">
                    <div class=\"col-md-7 text-center\">
                      <h1 class=\"text-white\">Alojamento - ".$row["city"].",".$row["neighbourhood_cleansed"]." </h1>
                    </div>
                  </div>
                </div>
              </div>

              <div class=\"container\">
                  <div class=\"featured-property-half d-flex\">
                    <div class=\"image\" style=\"background-image: url('".$row["image_"]."')\"></div>
                    <div class=\"text\">
                      
                      <h3>Preço</h3>
                      <h5>por noite: ".$row["price_per_night"]."</h5>
                      <br>
                      <br> ";
                      
                    }
                  } else {
                      echo "0 results";
                  }
        
                ?>
                  
                  <form method="post" action="">
                  
                  <input type="text" class="form-control form-control-sm" name = "dateCheckIn" id="datepickercheckin" placeholder="Check-in" style="width: 50%; float: left;">
                    <label for="datepickercheckin" style="float: left;">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </label>
                  
                  <select class="form-control form-control-sm numeroDePessoas" name="nmr_nts" style="width: 64.5%;">
                    <option value="noites">Número de noites</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>

                    

                      
                  </select>
                  <select class="form-control form-control-sm numeroDePessoas" name="nmr" style="width: 64.5%;">
                    <option value="apartamento">Número de pessoas</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
        
                  <br>
                  <br>
                  <?php
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo"
                    <p><a href=\"#\" class=\"btn btn-primary px-4 py-3\" data-toggle=\"modal\" data-target=\"#pagamentoModal\" style=\"width: 64.5%; border-radius: 0.2rem;\">Alugar</a></p>
";
                  }else
                  echo"
                  <p><a href=\"login.php\" class=\"btn btn-primary px-4 py-3\"  style=\"width: 85%; border-radius: 0.2rem;\">Para reservar tem de estar registado! </a></p>

                  ";
                  ?>
                </div>
              </div>
            </div>
              
                <!-- Modal para pagamento -->

                <div class="modal fade" id="pagamentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLongTitle">Pagamento com cartão de crédito/débito</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        

                        <div style="width: 100%; height: 150px; padding: 20px 10px 20px 10px; float: left; text-align: center;">


                          
                        </div>

                        <!-- Pagamento com cartao -->
                        <div class="pagamento-cartao" style="width: 50%; float: left; padding: 0px 10px 0px 10px;">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" name="nome" id="exampleInputEmail1" placeholder="Nome">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Número do cartão</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="cardnum" placeholder="Número do cartão">
                          </div>
                          
                         
                        </div>

                        <div class="pagamento-cartao" style="width: 50%; float: left; padding: 0px 10px 0px 10px;">
                          
                          <div class="form-group" style="width: 40%; float: left;">
                            <label for="exampleInputPassword1">Data de validade</label>
                            <input type="text" class="form-control" name="expr" id="exampleInputPassword1" placeholder="MM/YY">
                          </div>
                          <div class="form-group" style="width: 40%; float: left; padding-left: 50px;">
                            <label for="exampleInputPassword1">CVV</label>
                            <input type="text" class="form-control" name="cvv" id="exampleInputPassword1" placeholder="CVV">
                          </div>
                          

                          <?php
                            $cardnumber = $_POST["cardnum"];
                            $name = $_POST["nome"];
                            $exp_date = $_POST["expr"];
                            $get_cvv = $_POST["cvv"];
                            $checkin_date = $_POST["dateCheckIn"];
                            $num_nights = $_POST["nmr_nts"];
                            $num_people = $_POST["nmr"];

                            $this_month = "11/21";

                            if (isset($_POST['confirmar'])) {
                              $date_without_slash = str_replace('/', '', $exp_date);

                              $actual_month = substr($this_month, 0, 2);
                              $actual_year = substr($this_month, 3, 4);
                              $card_month = substr($exp_date, 0, 2);
                              $card_year = substr($exp_date, 3, 4);

                              if (empty($cardnumber) or empty($name) or empty($exp_date) or empty($get_cvv) or empty($checkin_date) or empty($num_nights) or empty($num_people)) { // caso algum campo nao esteja preenchido
                                $error = "Preencha todos os campos!";
                                echo "<script type='text/javascript'>alert('$error');</script>";
                              }
                              elseif (!preg_match("/^\d+$/", $cardnumber) and !empty($cardnumber)) { // se o numero contiver carateres que nao sejam numericos = invalido
                                $error = "Introduza um número de cartão válido!";
                                echo "<script type='text/javascript'>alert('$error');</script>";
                              } 
                              elseif ((!preg_match("/^\d+$/", $get_cvv) and !empty($get_cvv)) or strlen($get_cvv) != 3) { // se o cvv for invalido ou len > 3
                                $error = "Introduza um cvv válido!";
                                echo "<script type='text/javascript'>alert('$error');</script>";
                              } 
                              elseif (!preg_match("/^\d+$/", $date_without_slash) or strlen($exp_date) != 5) { // se a data so contem numeros para alem da barra '/'
                                $error = "Introduza uma data de expiração válida!";
                                echo "<script type='text/javascript'>alert('$error');</script>";
                              }
                              elseif ( (intval($card_year) < intval($actual_year)) or (intval($card_year) == intval($actual_year) and intval($card_month) < intval($this_month)) ) {  // se a data e invalida, isto e, se ja expirou
                                $error = "Introduza uma data de expiração válida!";
                                echo "<script type='text/javascript'>alert('$error');</script>";
                              }
                            }
                          ?>
                          
                        </div>
                        <!-- Fim de pagamento com cartao -->


                       
                      </div>

                      <hr style="height:2px; width: 90%; border-width:0; color:gray; background-color:gray">

                      <div style="width: 100%; float: left; padding: 20px 35px 0px 35px;">
                      <?php
                        $numNoites = (int)$dayz;
                        $pricePerNight2 = (int)trim($pricePerNight,"$"); 

                        echo"
                        <br>
                        $numNoites 
                        <br>
                        $pricePerNight2
                        
                        <p style=\"width: 50%; float: left; font-size: larger;\">Total : ".( $numNoites * $pricePerNight2)." </p>";
                      ?>
                      </div>

                      <div class="modal-footer" style="padding: 15px 15px 15px 15px; justify-content: center;">
                        <button type="submit" name="confirmar" value="Submit" class="btn btn-primary" id="confirmar">Confirmar</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
                <!-- Fim de modal para pagamento -->
                <?php
                    $sql2 = "SELECT city, neighbourhood_cleansed, image_, description_, price_per_night , accommodates FROM apartments WHERE ap_id=".htmlspecialchars($_GET["Ap"])."";

                    $result2 = $con->query($sql2); //tabela que resulta do select

                    if (mysqli_num_rows($result2) > 0) { //se existe um tuplo
                        // output data of each row
                        while($row2 = mysqli_fetch_assoc($result2)) {
                            echo " 
                               
                            <div class=\"site-section\" style=\"padding-top: 50px;\">
                              <div class=\"container\">
                                <div class=\"row\">
                                  <div class=\"mb-5 w-border col-md-12 mx-auto\">
                                    <p style=\"line-height: 15px; float: left; width: 50%; font-size: larger;\">Localização:
                                      <span style=\"padding-left: 15px; padding-right: 15px; font-size: medium;\">".$row2["city"].", ".$row2["neighbourhood_cleansed"]."</span>
                                    </p>
                                    <p style=\"line-height: 15px; float: left; width: 50%; font-size: larger;\">Acomoda:
                                      <span style=\"padding-left: 15px; font-size: medium\">".$row2["accommodates"]."</span>
                                    </p>
                                    
                                  </div>
                                </div>

                                <hr style=\"height:2px;border-width:0;color:gray;background-color:gray\">

                                <div class=\"row\" style=\"padding-top: 50px;\">
                                  <div class=\"mb-5 w-border col-md-12 mx-auto\">
                                    <div style=\"width: 20%; line-height: 30px; float: left; font-size: larger; float: left;\">
                                      <p>Descrição:</p>
                                    </div>
                                    <div style=\"width: 70%; font-size: medium; line-height: 30px; float: left;\">
                                      <span>".$row2["description_"]."</span>
                                    </div>
                                  </div>
                                </div>"; 
                              }
                              } else {
                                echo "0 results";
                            }
                        ?>
                  

              <hr style="height:2px;border-width:0;color:gray;background-color:gray">

              <div class="row" style="padding-top: 50px;">
                <div class="mb-5 w-border col-md-12 mx-auto">
                  <div style="width: 20%; line-height: 30px; float: left; font-size: larger; float: left;">
                    <p>Amenidades:</p>
                  </div>
                  <div style="width: 70%; font-size: xx-large; line-height: 30px; float: left;">
                    <div style="float: left; text-align: center; width: 150px;">
                      <i class="fa fa-wifi" aria-hidden="true"></i>
                      <p style="font-size: medium; line-height: 15px;">Wifi</p>
                    </div>
                    <div style="float: left; text-align: center; width: 150px;">
                      <i class="fa fa-television" aria-hidden="true"></i>
                      <p style="font-size: medium; line-height: 15px;">Televisão</p>
                    </div>
                    <div style="float: left; text-align: center; width: 150px;">
                      <i class="fa fa-phone" aria-hidden="true"></i>
                      <p style="font-size: medium; line-height: 15px;">Telefone</p>
                    </div>
                    <div style="float: left; text-align: center; width: 150px;">
                      <i class="fa fa-snowflake-o" aria-hidden="true"></i>
                      <p style="font-size: medium; line-height: 15px;">Aquecimento</p>
                    </div>
                    <div style="float: left; text-align: center; width: 150px;">
                      <i class="fa fa-bath" aria-hidden="true"></i>
                      <p style="font-size: medium; line-height: 15px;">Chuveiro</p>
                    </div>
                  </div>
                </div>
              </div>




              <hr style="height:2px;border-width:0;color:gray;background-color:gray">

<div class="row" style="padding-top: 50px;">
  <div class="mb-5 w-border col-md-12 mx-auto">
    <div style="width: 20%; line-height: 30px; float: left; font-size: larger; float: left;">
      <p>Check-in e check-out:</p>
    </div>
    <div style="font-size: medium; line-height: 30px; float: left; padding-left: 50px;">
      <p>Check-in:<span style="padding-left: 27px;">9:00</span></p>
      <p>Check-out:<span style="padding-left: 18px;">20:00</span></p>
    </div>
  </div>
</div>

<hr style="height:2px;border-width:0;color:gray;background-color:gray">

<div class="row" style="padding-top: 50px;">
  <div class="mb-5 w-border col-md-12 mx-auto">
    <div style=" line-height: 30px; float: left; font-size: larger; float: left;">
    <p>Avaliação Lokals:</p>
    
    <div class="row"  >
      
      <div class="row" style="padding-left: 68px" >

      <span class=" col-md-1 fa fa-star checked"></span>
      <span class="col-md-1 fa fa-star checked"></span>
      <span class="col-md-1 fa fa-star checked"></span>
      <span class="fa  col-md-1  fa-star"></span>
      <span class="fa fa-star col-md-1 "></span>
    </div>            </div>

    

</div>

  </div>



</div>

<hr style="height:2px;border-width:0;color:gray;background-color:gray">
<div class="container">
<div class="be-comment-block">
<h1 class="comments-title">Comments </h1>
<?php
          $sql = "SELECT users.name_ AS username , review.comment   AS comment       FROM users
          INNER JOIN review ON users.userId=review.user_id_fk WHERE ap_id_fk=".($_GET["Ap"])."";
          
          $result = $con->query($sql); //tabela que resulta do select
          if ($result ) { //se existe um tuplo
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                  
                echo"
                <div class=\"be-comment\">

                  <div class=\"be-comment-content\">
                    <span class=\"be-comment-name\">
                      <p> ".$row["username"]."</p>
                    </span>

                    <p class=\"be-comment-text\">
                    ".$row["comment"]."

                    </p>
                    </div>
                </div>"
;
              }
          } else {
              echo "No results";
          }

          mysqli_close($con);
          ?>
<?php
                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    $rand=rand();
                    $_SESSION['rand']=$rand;

echo"
<form class=\"form-block\" method=\"POST\" name=\"ComentaryForm\" >
<div class=\"row\">
<div class=\"col-xs-12 col-sm-6\">
<br>
<div class=\"form-group fl_icon\">
  <h3> Name: ".$_SESSION["name"]."</h2>
</div>
</div>

<div class=\"col-xs-12 col-md-12\">									
<div class=\"form-group\">
  <textarea class=\"form-input\" required=\"\" name=\"Com\" placeholder=\"Your text\"></textarea>
  <input type=\"hidden\" value=\"$rand\" name=\"randcheck\" />
</div>
</div>
<button   id=\"submitcomment\" type=\"submit\" class=\"btn btn-primary\"  style=\"height: 60px; width:300px; \">Comentar!</button>
</div>
</form>

";}
?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){

$('#new-review').autosize({append: "\n"});

var reviewBox = $('#post-review-box');
var newReview = $('#new-review');
var openReviewBtn = $('#open-review-box');
var closeReviewBtn = $('#close-review-box');
var ratingsField = $('#ratings-hidden');

openReviewBtn.click(function(e)
{
reviewBox.slideDown(400, function()
{
$('#new-review').trigger('autosize.resize');
newReview.focus();
});
openReviewBtn.fadeOut(100);
closeReviewBtn.show();
});

closeReviewBtn.click(function(e)
{
e.preventDefault();
reviewBox.slideUp(300, function()
{
newReview.focus();
openReviewBtn.fadeIn(200);
});
closeReviewBtn.hide();

});

$('.starrr').on('starrr:change', function(e, value){
ratingsField.val(value);
});
});</script>
<script src="js/main.js"></script>
</body>
</html>