<?php
include_once './classes/Loader.php';


session_start();

if(isset($_SESSION['who'])){
  header("Location:index.php");
}

/**
 * 
 * @param string $param
 * @param long $minsize
 * @return boolean
 */
function validate($param, $minsize) {

  if (!isset($_POST[$param])) {
    return null;
  }
  $chaine = html_entity_decode($_POST[$param]);

  if (count_chars($chaine) < $minsize) {
    return null;
  }

  return $chaine;
}
?>





<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/acfim.png">

    <title>Association Culturelle Franco-Iranienne de Montpellier</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>

    <?php
    include './menu/menutop.php';
    ?>



    <?php
    if (isset($_GET['login'])) {

      $email = validate('emaillogin', 10);
      $password = validate('passwordlogin', 8);
      $who = Member::FindByEmail($email);
      
      

      if ($who != null && $who->password == md5($password) ) {
        if( $who->activated){
          $_SESSION['who'] = $email;
          $_SESSION['hash'] = md5($password);
          header("Location:index.php");
        } else {
          echo '<div class=" alert alert-warning text-center" >  Votre compte est en attente d\'activation </div>';
        }
      } else {
        echo '<div class="alert alert-danger text-center" >Votre <strong>email</strong> ou votre <strong>mot de passe </strong> est érroné </div>';
      }
      
      
    }
    ?>

    <div class="container">
      <div class="raw">

        <form class=" form-signin col-lg-offset-4 col-lg-4" role="form" method="post" action="login.php?login" autocomplete="off">
          <h2 class="form-signin-heading">Connectez Vous</h2>
          <input type="email" name="emaillogin" class="form-control" placeholder="Adresse Email" required  autofocus >
          <input type="password" name="passwordlogin" class="form-control" placeholder="Mot De passe" required>
          <a class="pull-right" href="" >Mot de passe oublié </a>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Se Connecter</button>
        </form>

      </div> <!-- /container -->





      <?php
      if (isset($_GET['create'])) {
        $lastname = validate('lastname', 3);
        $firstname = validate('firstname', 3);
        $email = validate('email', 10);
        $phone = validate('phone', 14);
        $workon = validate('workon', 4);
        $password = validate('password', 8);
        $cpassword = validate('confirmpassword', 8);

        /// @todo  Make verfication

        if (Member::FindByEmail($email) != null) {
          echo " Exist Deja";
        } else if ($password == $cpassword) {


          $member = new Member();
          $member->firstname = $firstname;
          $member->lastname = $lastname;
          $member->email = $email;
          $member->phonenumber = $phone;
          $member->proffession = $workon;
          $member->password = md5($password);

          $member->save();

          header("Location:index.php?inscriptionOK");
        }
      }
      ?>
      <div class="row">

        <form class="form-signin col-lg-offset-4 col-lg-4" role="form"  method="post" action="login.php?create" autocomplete="off">
          <h2 class="form-signin-heading">Inscription</h2>
          <input name="lastname" class="form-control" placeholder="Nom" required autofocus>
          <input name="firstname" class="form-control" placeholder="Prénom" required >
          <input name="email" class="form-control" placeholder="Adresse Email " required >
          <input name="phone" class="form-control" placeholder="N° Téléphone " required >
          <input name="workon" class="form-control" placeholder="Proffession" required >
          <br/>
          <input  name="password"  type="password" class=" form-control" placeholder="Mot de passe" required>
          <input name="confirmpassword" type="password" class="form-control" placeholder="Confirmation de Mot de passe" required>
          <br/>
          <button class="btn btn-lg btn-primary btn-block" type="submit">S'inscrire</button>
        </form>

      </div> 
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>


  </body></html>