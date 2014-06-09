<?php
session_start();

include_once './classes/Loader.php';
?>

<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/acfim.png">

    <title>Association Culturelle Franco-Iranienne de Montpellier</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">



    <!-- Add custom CSS here -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>

<?php
include './menu/menutop.php';
?>


    <section class=" container" role="main">
<?php
if (isset($_GET['inscriptionOK'])) {
  echo '<div class="alert alert-info" > Votre Inscription a été bien enregistrer et elle est en attente de validation par un Administrateur (un membre de l\'association) </div>';
}
?>
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
<?php
include './index/events.php';
?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
<?php
include './index/news.php';
?>
        </div>

      </div> 
    </section>








<?php
include './menu/footer.php';
?>




    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modern-business.js"></script>

  </body>

</html>
